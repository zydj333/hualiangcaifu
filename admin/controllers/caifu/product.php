<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Product extends Admin_Controller {

	/*
	    产品管理管理
	*/
	public function __construct()
	{
		parent::__construct();
		$this->tb_product='caifu_product';
		$this->load->model('uploadfile');
		$this->load->model('caifu_product');
		$this->load->model('a_caifu_model');
	}
	//分页列表
	public function lists(){
	  $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    $seldata['pagesize']=10;
		
		$list=$this->a_caifu_model->get_product_search($seldata);
		$product_list = $list ['list'];
		foreach ( $product_list as $k => $v ) {
			$product_list[$k] = $v;
			$product_list[$k]['categoryname'] = $this->a_caifu_model->get_dict_column_title ('db_caifu_product','category',$v ['category'] );
		}

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$product_list);
		$this->cismarty->assign('infopage',$list['page']);

	  $this->cismarty->display('caifu/product/product_list.html');
	}
	//添加产品
	public function product_add(){
		if(isset($_POST['dosubmit'])){
			$product['category'] 			= $this->input->post('category');
			$product['name'] 					= $this->input->post('name2');
			$product['issuer'] 				= $this->input->post('issuer');
			$product['investment'] 		= $this->input->post('investment');
			$product['expenses_area'] = $this->input->post('expenses_area');
			$product['expenses'] = $this->input->post('expenses');
			$product['yield'] = $this->input->post('yield');
			$product['yield_year'] = $this->input->post('yield_year');
		  $product['fee_scale'] = $this->input->post('fee_scale');
		  $product['earning'] = $this->input->post('earning');
			$product['interest'] = $this->input->post('interest');
			$product['area'] = $this->input->post('area');
			$product['size'] = $this->input->post('size');
			$product['size_intro'] = $this->input->post('size_intro');
			$product['lifetime'] = $this->input->post('lifetime');
			$product['scale'] = $this->input->post('scale');
			$product['threshold'] = $this->input->post('threshold');
			$product['progress_percent'] = $this->input->post('progress_percent');
			$product['account'] = $this->input->post('account');
			$product['income'] = $this->input->post('income');
			$product['progress'] = $this->input->post('progress');
			$product['content'] = $this->input->post('content');
			$product['status'] = $this->input->post('status');
			$product['iscommend'] = $this->input->post('iscommend');
			$product['isshow'] = $this->input->post('isshow');
			$product['listorder'] = $this->input->post('listorder');
			$product['post_time'] = time();
			
			if($_FILES['download']['name'] <> ""){
				$this->load->library('iupfile_lib');
				$savePath = "uploadfile/".date("Y-m");
				$upmsg  = "";
				$this->iupfile_lib->initialize($savePath);
				$this->iupfile_lib->doUpload( $savePath);
				if (!$this->iupfile_lib->run('download',1)) $upmsg = $this->iupfile_lib->errmsg();
				$file_data = $this->iupfile_lib->getInfo();
				$product['download'] = $file_data[0]['savepath'];
			}
			  
			$link = $this->a_caifu_model->add($product,$this->tb_product);
			$this->showmessage('success',lang('com_add'),$this->admin_url.'caifu/product/lists?loghash='.$this->session->userdata('loghash'));
		}else{
			$category_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			$investment_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','investment');
			$expenses_area_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','expenses_area');
			$yield_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','yield');
			$interest_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','interest');
			$area_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','area');
			$size_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','size');
			$earning_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','earning');
			$this->cismarty->assign('earning_list',$earning_list);
			$this->cismarty->assign('size_list',$size_list);
			$this->cismarty->assign('area_list',$area_list);
			$this->cismarty->assign('interest_list',$interest_list);
			$this->cismarty->assign('yield_list',$yield_list);
			$this->cismarty->assign('expenses_area_list',$expenses_area_list);
			$this->cismarty->assign('investment_list',$investment_list);
			$this->cismarty->assign('category_list',$category_list);
		  $this->cismarty->display('caifu/product/product_add.html');
		}
	}
	//编辑
	public function product_edit(){
		$product_id = $this->input->get('id');
		if(isset($_POST['dosubmit'])){
			$product_id = $this->input->post('product_id');
			$old_download = $this->input->post('old_download');
			$product['category'] 			= $this->input->post('category');
			$product['name'] 					= $this->input->post('name2');
			$product['issuer'] 				= $this->input->post('issuer');
			$product['investment'] 		= $this->input->post('investment');
			$product['expenses_area'] = $this->input->post('expenses_area');
			$product['expenses'] = $this->input->post('expenses');
			$product['yield'] = $this->input->post('yield');
			$product['yield_year'] = $this->input->post('yield_year');
		  $product['fee_scale'] = $this->input->post('fee_scale');
		  $product['earning'] = $this->input->post('earning');
			$product['interest'] = $this->input->post('interest');
			$product['area'] = $this->input->post('area');
			$product['size'] = $this->input->post('size');
			$product['size_intro'] = $this->input->post('size_intro');
			$product['lifetime'] = $this->input->post('lifetime');
			$product['scale'] = $this->input->post('scale');
			$product['threshold'] = $this->input->post('threshold');
			$product['progress_percent'] = $this->input->post('progress_percent');
			$product['account'] = $this->input->post('account');
			$product['income'] = $this->input->post('income');
			$product['progress'] = $this->input->post('progress');
			$product['content'] = $this->input->post('content');
			$product['status'] = $this->input->post('status');
			$product['iscommend'] = $this->input->post('iscommend');
			$product['isshow'] = $this->input->post('isshow');
			$product['listorder'] = $this->input->post('listorder');
			
			if($_FILES['download']['name'] <> ""){
				$this->load->library('iupfile_lib');
				$savePath = "uploadfile/".date("Y-m");
				$upmsg  = "";
				$this->iupfile_lib->initialize($savePath);
				$this->iupfile_lib->doUpload( $savePath);
				if (!$this->iupfile_lib->run('download',1)) $upmsg = $this->iupfile_lib->errmsg();
				$file_data = $this->iupfile_lib->getInfo();
				@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$old_download);
				$product['download'] = $file_data[0]['savepath'];
			}else{
				$product['download'] = $old_download;
			}
			
			$this->a_caifu_model->update(array('id' => $product_id),$product,$this->tb_product);
			$this->showmessage('success',lang('com_edit'),$this->admin_url.'caifu/product/lists?loghash='.$this->session->userdata('loghash'));
		}else{
			$product_id=intval($product_id);
		  $product = $this->a_caifu_model->get_one(array('id' => $product_id),$this->tb_product);
		  if(empty($product)) $this->showmessage('error',lang('com_parameter'),$this->admin_url.'caifu/product/lists?loghash='.$this->session->userdata('loghash'));
		  $category_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			$investment_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','investment');
			$expenses_area_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','expenses_area');
			$yield_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','yield');
			$interest_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','interest');
			$area_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','area');
			$size_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','size');
			$earning_list = $this->a_caifu_model->get_dictionary_list('db_caifu_product','earning');
			$this->cismarty->assign('earning_list',$earning_list);
			$this->cismarty->assign('size_list',$size_list);
			$this->cismarty->assign('area_list',$area_list);
			$this->cismarty->assign('interest_list',$interest_list);
			$this->cismarty->assign('yield_list',$yield_list);
			$this->cismarty->assign('expenses_area_list',$expenses_area_list);
			$this->cismarty->assign('investment_list',$investment_list);
			$this->cismarty->assign('category_list',$category_list);
			$this->cismarty->assign('product',$product);
			$this->cismarty->assign('product_id',$product_id);

		    $this->cismarty->display('caifu/product/product_edit.html');
		}
	}
	 //删除
    public function product_del(){
	    $_data_post=$this->input->post();
			$product_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;

			foreach($product_id as $val){
				$where = array('id' => $val);
				$return = $this->a_caifu_model->del($where,$this->tb_product,$val);
			}

			$this->showmessage('link_del',lang('com_del'),$this->admin_url.'caifu/product/lists?loghash='.$this->session->userdata('loghash'));
	}
	
	//排序
	public function product_order(){
	  $product_id = $this->input->post('hdnid');
		$listorder = $this->input->post('listorder');
		if(!empty($product_id)){
			foreach($listorder as $key => $val){
			    $data = array('listorder' => $val);
			    $this->a_caifu_model->update(array('id'=>$product_id[$key]),$data,$this->tb_product);
			}
		}
		$this->showmessage('link_list',lang('com_order'),$this->admin_url.'caifu/product/lists?loghash='.$this->session->userdata('loghash'));
	}
	

	//AJAX判断图文管理标题不能为空
	public function ajax_public_check_graphic(){
	  $link_title=$this->input->get('pic_title');
		$link_id=$this->input->get('pic_id');
		$this->load->model('a_system_model');
		if(isset($link_id)){
		    $where = array('pic_title' => $link_title,'pic_id' => $link_id);
		    $d = $this->a_system_model->get_one($where,'graphic');
		}
		if(isset($d['pic_title'])==$link_title){
		    echo 'true';
		}else{
		    $where = array('pic_title' => $link_title);
		    $r = $this->a_system_model->get_one($where,'graphic');
		    if(isset($r)){
			    if(isset($r['pic_title'])==$link_title) echo 'false';else echo 'true';
		    }else {
			    echo 'true';
	     	}
		}
	}


}