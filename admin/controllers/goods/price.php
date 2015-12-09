<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Price extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dbclass_model');
		$this->load->model('a_system_model');
		$this->load->model('goods_price_library');
	}
	
	//价格库列表
	public function lists(){
	  $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$data['page']=$page;
		$data['pagesize']=10;

		if(isset($_GET['dosubmit'])){
		  $data['search_cateid'] = $this->input->get('search_cateid');

			$this->cismarty->assign('search_cateid',$data['search_cateid']);
			$this->cismarty->assign('form_submit',$_GET['dosubmit']);
		}

		$list=$this->a_system_model->get_pricelib_search($data);
		$price_list = $list ['list'];
		foreach ( $price_list as $k => $v ) {
			$price_list [$k] = $v;
			$price_list [$k] ['catename'] = $this->a_system_model->get_dict_column_title ('goods_price_library','cateid',$v ['cateid'] );
		}
		
		$dict_list = $this->a_system_model->get_dictionary_list('goods_price_library','cateid');

		$this->cismarty->assign('infolist',$price_list);
		$this->cismarty->assign('infopage',$list['page']);
		$this->cismarty->assign('catelist',$dict_list);
	  $this->cismarty->display('goods/price/price_list.html');

	}
	
	//产品价格添加
	public function price_add(){
	   if(isset($_POST['dosubmit'])){
			$price['cateid'] = $this->input->post('cateid');
			$price['prod_spec'] = $this->input->post('prod_spec');
			$price['stand_height'] = $this->input->post('stand_height');
			$price['each_price'] = $this->input->post('each_price');
			$price['price'] = $this->input->post('price');
			$price['listorder'] = $this->input->post('listorder');

			$id=$this->goods_price_library->add($price);
			$this->showmessage('article_add',lang('com_add'),$this->admin_url.'goods/price/lists?loghash='.$this->session->userdata('loghash'));
		}else{
			$dict_list = $this->a_system_model->get_dictionary_list('goods_price_library','cateid');
			$this->cismarty->assign('catelist',$dict_list);
		  $this->cismarty->display('goods/price/price_add.html');
		}

	}
	//产品价格编辑
	public function price_edit(){
	  if(isset($_POST['dosubmit'])){
	    $_data_post=$this->input->post();

		  $id = $this->input->post('id');
			$price['cateid'] = $this->input->post('cateid');
			$price['prod_spec'] = $this->input->post('prod_spec');
			$price['stand_height'] = $this->input->post('stand_height');
			$price['each_price'] = $this->input->post('each_price');
			$price['price'] = $this->input->post('price');
			$price['listorder'] = $this->input->post('listorder');

			$this->goods_price_library->update(array('id'=>$id),$price);

			$this->showmessage('success',lang('com_edit'),$this->admin_url.'goods/price/lists?loghash='.$this->session->userdata('loghash'));
		}else{
		  $id = $this->input->get('id');
		  $price_info = $this->goods_price_library->get_one(array('id'=>intval($id)),'goods_price_library');
		  if(empty($price_info)) $this->showmessage('error',lang('com_parameter'),HTTP_REFERER);
			$dict_list = $this->a_system_model->get_dictionary_list('goods_price_library','cateid');
			
			$this->cismarty->assign('catelist',$dict_list);			
		  $this->cismarty->assign('price_info',$price_info);
			$this->cismarty->display('goods/price/price_edit.html');
		}
	}

	//产品价格删除
	public function price_del(){
	  $_data_post=$this->input->post();
		$channel_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;
		if($channel_id !== false){
		    foreach($channel_id as $val){
		    	$this->goods_price_library->del(array('id' => $val),'goods_price_library');
				}
		}else{
		    $this->showmessage('channel',lang('com_parameter'),HTTP_REFERER);
		}
		$this->showmessage('channel',lang('com_del'),$this->admin_url.'goods/price/lists?loghash='.$this->session->userdata('loghash'));
	}
	
	//排序
	public function price_order(){
	    $lc_id = $this->input->post('id');
			$listorder = $this->input->post('listorder');

			foreach($listorder as $key => $val){
		    $data = array('listorder' => $val);
		    $this->goods_price_library->update($lc_id[$key],$data);
			}
			$this->showmessage('success',lang('com_order'),HTTP_REFERER);
		}
	
	//获取充值方式
	private function getstatename($type) {
		$arr = array (
				'1' => 'HSZ-A620/619系列手拉葫芦',
				'2' => 'HSH-A619系列手扳葫芦',
				'3' => 'GCL610系列手拉单轨小车',
				'4' => 'GCT610系列手推单轨小车',
				'5' => 'HSZ-A710系列手拉葫芦',
				'6' => 'HSH-A719（CKⅡ）系列手扳葫芦',
				'7' => 'SNT-A铝合金环链紧线器',
		);
		return isset ( $arr [$type] ) ? $arr [$type] : $type;
	}

}