<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Orderpoints extends Admin_Controller {

	/*
	×  积分订单管理
	*/
	public function __construct()
	{
		parent::__construct();
		$this->tb_order='caifu_orderpoints';
		$this->load->model('uploadfile');
		$this->load->model('caifu_orderpoints');
		$this->load->model('a_caifu_model');
	}
	//分页列表
	public function lists(){
	  $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    $seldata['pagesize']=10;
		
		$list=$this->a_caifu_model->get_orderpoints_search($seldata);
		$order_list = $list['list'];
		foreach($order_list as $key => $val){
				$order_list[$key]['status_name'] = $this->get_state_name($val['status']);	
		}

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$order_list);
		$this->cismarty->assign('infopage',$list['page']);

	  $this->cismarty->display('caifu/orderpoints/order_list.html');
	}

	//编辑
	public function order_view(){
		$order_id = $this->input->get('id');
		if(isset($_POST['dosubmit'])){

		}else{
			$order_id=intval($order_id);
		  $order = $this->a_caifu_model->get_one(array('id'=>$order_id),$this->tb_order);
		  if(empty($order)) $this->showmessage('error',lang('com_parameter'),$this->admin_url.'caifu/orderpoints/lists?loghash='.$this->session->userdata('loghash'));
			$user_id = $order['user_id'];
			$product_id = $order['product_id'];
			$user_info = $this->a_caifu_model->get_one(array('user_id'=>$user_id), 'user');
			$product_info = $this->a_caifu_model->get_one(array('id'=>$product_id),'caifu_points');
			$order_state = $this->get_state_name($order['status']);
			
			$this->cismarty->assign('oinfo',$order);
			$this->cismarty->assign('order_state', $order_state);
			$this->cismarty->assign('ouser',$user_info);
			$this->cismarty->assign('oproduct',$product_info);
		  $this->cismarty->display('caifu/orderpoints/order_info.html');
		}
	}
	 //删除
    public function order_del(){
	    $_data_post=$this->input->post();
			$order_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;

			foreach($order_id as $val){
				$where = array('id' => $val);
				$return = $this->a_caifu_model->del($where,$this->tb_order,$val);
			}

			$this->showmessage('link_del',lang('com_del'),$this->admin_url.'caifu/orderpoints/lists?loghash='.$this->session->userdata('loghash'));
	}
	
	public function state_next(){
	    $order_sn=$this->input->get('order_sn');
	    $arr = array();
			$order_info=$this->a_caifu_model->get_one(array('id'=>$order_sn),$this->tb_order);
		   switch($order_info['status']){
			 	case '1':
			    $val=2; 
			    $arr = array('status' => $val);
					break;//待审核 
				case '2':
				  $val=3;
				  $arr = array('status' => $val);
				  break;//已成立
		   }
		  
			$res=$this->a_caifu_model->update(array('id' => $order_sn),$arr,$this->tb_order);
			if($res>0){
		  	$this->showmessage ( '','状态修改成功', $this->admin_url . 'caifu/order/lists?loghash=' . $this->session->userdata ( 'loghash' ));	
			}
	}
	
	private function get_state_name($status = 0) {
		$arr = array (
				'0' => '待审核',
				'1' => '待审核',
				'2' => '已成立',
				'3' => '已驳回'
		);
		return isset ( $arr [$status] ) ? $arr [$status] : '';
	}
}