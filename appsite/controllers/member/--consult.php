<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Consult extends Member_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_member_model');
		$this->user_id=isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
	}
	
	public function lists() {
		$this->seo_title = '客户专区-售后服务';
	  $user_id = $this->session->userdata['member_user_id'];
		$this->load->model('user');
	  $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	  
	  $page=$this->input->get('page');
		$page=intval($page) > 0 ? $page : 1;

		$sel['member_id']=$user_id;
		$sel['page']=$page;
	  $sel['pagesize']=10;

		$list = $this->a_member_model->get_consult_search($sel);
	  $data['list'] = $list['list'];
	  $data['page'] = $list['page'];
	  $this->view('consult_list', $data);
	}
	
	//发布咨询
	public function add(){
			$this->load->model('consult');
			$this->load->model('user');
	  	$data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  	$data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
			if(isset($_POST['dosubmit']) && $_POST['dosubmit']==1) {
				$userinfo = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
				$_data['consult_content'] = trim($this->input->post('consult_content'));
				$_data['member_id'] = $userinfo['user_id'];
				$_data['cmember_name'] = $userinfo['username'];
				$_data['province_id'] = $userinfo['province_id'];
				$_data['email'] = $userinfo['email'];
				$_data['consult_addtime'] = time();
				$this->consult->add($_data, 'consult');
				$this->showmessage('success','咨询内容提交成功！','index.php?m=member&c=consult&a=lists');
				return;
			}else{
				//网站基本设置
				$setup_setting = getcache('setup','commons');
				$this->seo_title = "个人资料 - ".$setup_setting['site_title'];
				$this->view('consult_add', $data);
			}
	}
	
	//咨询内容查看
	public function aview(){
			$this->load->model('consult');
			$data = array();
			$consult_id = $this->input->get('id');
			$data['consultinfo'] = $this->consult->get_one(array('consult_id' => $consult_id), 'consult');
			$this->load->model('user');
	  	$data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  	$data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
			//网站基本设置
			$setup_setting = getcache('setup','commons');
			$this->seo_title = "个人资料 - ".$setup_setting['site_title'];
			$this->view('consult_view', $data);
	}
//咨询内容删除
	public function del(){
		$this->load->model('consult');
		$consult_id = $this->input->get('id');
		if($consult_id !== false){
				$return = $this->consult->del(array('consult_id' => $consult_id));
		}else{
		    $this->showmessage('article','参数错误！','index.php?m=member&c=consult&a=lists');
		}
		$this->showmessage('article','咨询内容删除成功！','index.php?m=member&c=consult&a=lists');
	}
}