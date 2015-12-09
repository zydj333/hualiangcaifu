<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Funds extends Member_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->user_id=isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
	}
	public function lists() {
			$this->seo_title = '会员中心-入账记录';
	  	$user_id = $this->session->userdata['member_user_id'];
	   	$this->load->model('user');
	  	$data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  	$data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	   	
	  	$page=$this->input->get('page');
			$page=intval($page)>0?$page:1;

			$sel['user_id']=$user_id;
			$sel['page']=$page;
	  	$sel['pagesize']=5;
	    
	    $this->load->model('a_member_model');
	    $list = $this->a_member_model->get_funds_search($sel);
	    $funds_list = $list ['list'];
			foreach ( $funds_list as $k => $v ) {
				$funds_list [$k] = $v;
				$funds_list [$k] ['type_name'] = $this->getstatename ( $v ['money_type'] );
			}
			
	    $data['list'] = $funds_list;
	    $data['page'] = $list['page'];
	    $this->view('funds_list', $data);
	}
	
	//获取充值方式
	private function getstatename($type) {
		$arr = array (
				'1' => '电汇',
				'2' => '承兑',
				'3' => '现金',
				'4' => '公账转入'
		);
		return isset ( $arr [$type] ) ? $arr [$type] : $type;
	}
	
}