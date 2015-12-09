<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Points extends Member_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_member_model');
		$this->load->model('a_caifu_model');
		$this->tb_price='goods_price_library';
		$this->user_id=isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
	}
	
	//我要报单
	public function addorder(){
		$this->seo_title = '会员中心-我要报单';
		$this->seo_keywords='会员中心';
	  $this->seo_description='会员中心';
	  //导航及数量
		$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
		foreach($nav_category as $key => $val){
			$cateid = $val['column_value'];
			$where = array('category'=>$cateid);
			$con=$this->a_caifu_model->count($where,'caifu_product');
			$nav_category[$key]['numbs'] = intval($con);
		}
	  
		$data=array();		
		$data['current_nav'] = "index";
		$data['nav_category'] = $nav_category;
		$this->view('order_add', $data);
	}
	
	//订单列表--shuangniao
	public function lists() {
		$this->seo_title = '积分商城-我的订单';
		$this->seo_keywords='会员中心';
	  $this->seo_description='会员中心';
	  //导航及数量
		$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
		foreach($nav_category as $key => $val){
			$cateid = $val['column_value'];
			$where = array('category'=>$cateid);
			$con=$this->a_caifu_model->count($where,'caifu_product');
			$nav_category[$key]['numbs'] = intval($con);
		}
	  $data['heading_title'] = '我的订单';
	  $user_id = $this->session->userdata['member_user_id'];
	  $this->load->model('user');
	  $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	    
	  $status = $this->input->get('status');
	  $search_name = $this->input->get_post ( 'search_name' );
		$data['status'] = $status?$status:0;
	
		
	  $page=$this->input->get('page');
		$page=intval($page)>0?$page:1;

		$sel['buyer_id']=$user_id;
		$sel['page']=$page;
	  $sel['pagesize']=10;
		$sel['status']=$status;
		$sel['search_name'] = $search_name;

		$list = $this->a_member_model->get_orderpoints_search($sel);
		foreach ($list['list'] as $key=>$value) {
			$list['list'][$key]['order_state_name']=$this->getPointsStatusName($value['status']);
	  }
	  //网站基本设置
		$setup_setting = getcache('setup','commons');
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$data['hot_arr'] = $hot_arr;
	  $data['list'] = $list['list'];
	  $data['page'] = $list['page'];
	  $data['current_nav'] = "index";
	  $data['nav_category'] = $nav_category;
	  $this->view('points_list', $data);
	}
	//订单详情--shuangniao
	public function info() {
		$this->seo_title = '会员中心-订单详情';
		$this->seo_keywords='会员中心';
	  $this->seo_description='会员中心';
	  $order_id=$this->input->get('id');
		
		$order_info=$this->a_member_model->get_one(array('order_id'=>$order_id),'order');
		if (empty($order_info)) {
			redirect(base_url().'index.php?m=member&c=order&a=lists');
		}
		
		$area_info=$this->a_member_model->get_one(array('oadd_id'=>$order_id),'order_address');
		$order_info['state_name']=$this->getStatusName($order_info['order_state']);
		$goods_info=$this->a_member_model->get_query(array('order_id'=>$order_id),'order_goods');
		foreach($goods_info as $k => $v){
					$tonsspec_id = $v['spec_id'];
					//获取价格库中规则名称
					$tonsspec_info=$this->a_member_model->get_one(array('id' => $tonsspec_id),$this->tb_price);
					$goods_info[$k]['spec_name']=empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'];
		}
		
		$data['order_info']=$order_info;
		$data['goods_info']=$goods_info;		
		$data['area_info']=$area_info;
		$data['current_nav'] = "index";
		$data['nav_category'] = $nav_category;
		$this->view('order_info', $data);
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
	
	//订单状态：10(默认):未付款;11:待收款 20:已审核;30:已发货;40:已收货;50:取消;60已确认;
	function getStatusName($state = '10') {
		$data = array(
			'10' => '未付款',
			'11' => '待收款',
			'20' => '已审核',
			'30' => '已发货',
			'40' => '已收货',
			'50' => '已取消',
			'60' => '已完成',
		);
		return isset($data[$state]) ? $data[$state] : '未知的状态';
	}
	
	function getPointsStatusName($state = '10') {
		$data = array(
			'10' => '待处理',
			'11' => '已处理',
			'20' => '已取消',
			'30' => '已发货',
			'40' => '已收货',
			'50' => '已取消',
			'60' => '已完成',
		);
		return isset($data[$state]) ? $data[$state] : '未知的状态';
	}
	
	//退货状态:0（取消）：1(默认-未审核):2（不通过）：3（通过）：4（完结）
	function getRefundName($state = 1){
		$data = array(
			'0' => '取消',
			'1' => '审核中',
			'2' => '未通过',
			'3' => '通过',
			'4' => '完结',
			'5' => '取消'
		);
		return isset($data[$state]) ? $data[$state] : '未知状态';
	}
	
}