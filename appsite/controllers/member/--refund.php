<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Refund extends Member_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_member_model');
		$this->user_id=isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
	}
	public function lists() {
		$this->seo_title = '会员中心-我的订单';
		$this->seosetup['keywords']='会员中心';
	  $this->seosetup['description']='首页';
	  $data['heading_title'] = '我的订单';
	  $user_id = $this->session->userdata['member_user_id'];
	  $this->load->model('user');
	  $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	    
	  $status = $this->input->get('status');
		$data['status'] = $status?$status:0;
	
		
	  $page=$this->input->get('page');
		$page=intval($page)>0?$page:1;

		$sel['buyer_id']=$user_id;
		$sel['page']=$page;
	  $sel['pagesize']=10;
		$sel['status']=$status;

		$list = $this->a_member_model->get_order_search($sel);
		foreach ($list['list'] as $key=>$value) {
			$list['list'][$key]['order_state_name']=$this->getStatusName($value['order_state']);
			$list['list'][$key]['goodsdata'] = $this->a_member_model->get_query(array('order_id'=>$value['order_id']), 'order_goods');
	    }
	    $data['list'] = $list['list'];
	    $data['page'] = $list['page'];
	    $this->view('order_list', $data);
	}
	
	public function info() {
	    $order_id=$this->input->get('oid');
		
		$order_info=$this->a_member_model->get_one(array('order_id'=>$order_id),'order');
		if (empty($order_info)) {
			redirect(base_url().'index.php?m=member&c=order');
		}
		
		$area_info=$this->a_member_model->get_one(array('order_id'=>$order_id),'order_address');
		$order_info['state_name']=$this->getStatusName($order_info['order_state']);
		$goods_info=$this->a_member_model->get_query(array('order_id'=>$order_id),'order_goods');
		
		$data['order_info']=$order_info;
		
		$data['goods_info']=$goods_info;
		
		$data['area_info']=$area_info;
		
		 
		$this->view('order_info', $data);
	}
	//目前只有未支付的可以取消
	public function cancelOrder() {
		$arr['url'] = urlencode(str_replace(base_url(), '', HTTP_REFERER));
		$user_id = $this->session->userdata['member_user_id'];
		$orderId = intval($this->input->get('orderId'));
		$orderNo = $this->input->get('orderNo');
		$this->load->model('a_member_model');
		$check_order = $this->a_member_model->get_one(array('order_id'=>$orderId, 'order_sn'=>$orderNo, 'buyer_id'=>$user_id, 'order_state'=>'10', 'sts'=>0), 'order');
		if (count($check_order)) {
			$this->a_member_model->update(array('order_id'=>$orderId, 'order_sn'=>$orderNo, 'buyer_id'=>$user_id, 'order_state'=>'10', 'sts'=>0), array('order_state'=>'50'), 'order');
			$arr['msg'] = 'success';
		}else {
			$arr['msg'] = 'fail';
		}
		echo json_encode($arr);
	}
	
	public function state_next(){
	    $orderSn = $this->input->get('orderSn');
		$state = $this->input->get('state');
		$user_id = $this->session->userdata['member_user_id'];
	    $res=$this->a_member_model->update(array('order_sn'=>$orderSn, 'buyer_id'=>$user_id, 'order_state'=>$state, 'sts'=>0), array('order_state'=>'40'), 'order');
        if($res>0){
		    $arr['msg'] = 'success';
		}else{
	    	$arr['msg'] = 'fail';
		}
		echo json_encode($arr);
	
	
	
	
	}
	public function refund_info(){
	    $order_id=$this->input->get('oid');
		$order_info=$this->a_member_model->get_one(array('order_id'=>$order_id),'order');
		$area_info=$this->a_member_model->get_one(array('order_id'=>$order_id),'order_address');
		$order_info['state_name']=$this->getStatusName($order_info['order_state']);
		$goods_info=$this->a_member_model->get_query(array('order_id'=>$order_id),'order_goods');
		$data['order_info']=$order_info;
		$data['goods_info']=$goods_info;
		$data['area_info']=$area_info; 
		$this->view('order_refund', $data);
	}
	
	
	
	//订单状态：10(默认):未付款;11:待收款 20:已付款;30:已发货;40:已收货;50:取消;60已确认;
	function getStatusName($state = '10') {
		$data = array(
			'10' => '未付款',
			'11' => '待收款',
			'20' => '已付款',
			'30' => '已发货',
			'40' => '已收货',
			'50' => '已取消',
			'60' => '已完成',
		);
		return isset($data[$state]) ? $data[$state] : '未知的状态';
	}
	public function order_returns(){
	    $this->seo_title = '会员中心-我的订单';
		$this->seosetup['keywords']='会员中心';
	    $this->seosetup['description']='首页';
	    $data['heading_title'] = '退货管理';
	    $sel['user_id'] = $this->session->userdata['member_user_id'];
	    $sel['order_id']=$this->input->get('oid');		
		//$_data['status'] = $this->input->get('status');
        $page=$this->input->get('page');
		$page=intval($page)>0?$page:1;
        $sel['page']=$page;
	    $sel['pagesize']=5;	
     	$data['goods_info']=$this->a_member_model->get_returns($sel);
		$data['order_id']=$sel['order_id'];
		$data['user_id']=$sel['user_id'];
        $this->view('order_returns', $data);
	
	
	}
	public function returns_add(){
	 $arr_goods['goods_id']=$this->input->post('goods_id');//商品id
	 $arr_goods['order_id']=$this->input->post('order_id');//订单ID
	 $arr_goods['user_id']=$this->session->userdata['member_user_id'];
	 $goods_info=$this->a_member_model->get_one($arr_goods,'order_goods');
	 $arr_returns=$this->a_member_model->get_one($arr_goods,'returns');	 
	 $arr=$arr_goods;
	 $arr['buyer_message']=$this->input->post('buyer_message');//退货留言
	 $arr['return_goodsnum']=$this->input->post('return_goodsnum');//退货数量
	 $num=$goods_info['goods_num']-$arr['return_goodsnum']-$goods_info['returns_num'];

	 
	 if($num>0){
	   $returns_num=$arr['return_goodsnum']+$goods_info['returns_num'];
	   $returns_state='1';   
	   $this->a_member_model->update($arr_goods,array('returns_state'=>$returns_state,'returns_num'=>$returns_num),'order_goods');
	    $res['msg']=0;
	 }else if($num==0){
	    $returns_state='2';
	    $returns_num=$arr['return_goodsnum']+$goods_info['returns_num'];
	    $this->a_member_model->update($arr_goods,array('returns_state'=>$returns_state,'returns_num'=>$returns_num),'order_goods');
	    $res['msg']=0;
	 }else{
	    $res['msg']=1;
	 }
	 $arr['add_time']=time();//申请时间
	 $arr['return_sn']=uniqid();//退货编号
	 $res=$this->a_member_model->add($arr,'returns');
    
      redirect(base_url()."index.php?m=member&c=order&a=order_returns&oid=".$arr_goods['order_id']);
	}
	
	
	public function returns_ajax(){
	   $goods_id=$this->input->get('goodId');
	   $order_id=$this->input->get('orderId');
	   $user_id=$this->session->userdata['member_user_id'];
	   
	   $list = $this->a_member_model->get_one(array('order_id'=>$order_id,'user_id'=>$user_id,'goods_id'=>$goods_id),'order_goods','goods_name,goods_num,returns_state');
	   if($list){
	     if($list['returns_state']==0){
	        $data['goods_num']=$list['goods_num'];
		 }else{
		     $goods = $this->a_member_model->get_one(array('order_id'=>$order_id,'user_id'=>$user_id,'goods_id'=>$goods_id),'returns','return_goodsnum');
			 $data['goods_num']=$list['goods_num']-$goods['return_goodsnum'];
		 
		 }
		 $data['goods_id']=$goods_id;
	     $data['goods_name']=$list['goods_name'];
	     $data['msg']="success";
	   }
	   echo json_encode($data);
	}
}