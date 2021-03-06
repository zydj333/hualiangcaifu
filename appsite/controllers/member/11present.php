<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Present extends Member_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_member_model');
		$this->user_id=isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
	}
	
	public function lists() {
		$this->seo_title = '客户专区-我的礼物';
	  $user_id = $this->session->userdata['member_user_id'];
		$this->load->model('user');
	  $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	  
	  $page=$this->input->get('page');
		$page=intval($page) > 0 ? $page : 1;

		$sel['member_id']=$user_id;
		$sel['page']=$page;
	  $sel['pagesize']=10;

		$list = $this->a_member_model->get_present_search($sel);
		$list_present = $list['list'];
		foreach($list_present as $k => $v){
			$message_more = $v['message_ismore'];
			$to_user_id = $v['to_user_id'];
			$del_user_id = $v['del_user_id'];
			//多用户，判断该用户是否在当前用户范围内
			if($message_more == 1){
				$to_user_ids = explode(",",$to_user_id);
				if(!in_array($user_id,$to_user_ids)){
					unset($list_present[$k]);
				}
			}
			//判断该用户是否删除
			if(!empty($del_user_id)){
				$del_user_ids = explode(",",$del_user_id);
				if(in_array($user_id,$del_user_ids)){
					unset($list_present[$k]);
				}
			}
		}
	  $data['list'] = $list_present;
	  $data['page'] = $list['page'];
	  $this->view('present_list', $data);
	}
	
//咨询内容删除
	public function del(){
		$this->load->model('notice');
		$message_id = $this->input->get('id');
		
		if($message_id !== false){
			  //更新删除用户ID
			  $message_info = $this->notice->get_one(array('message_id' => $message_id), 'notice');
			  $del_user_id = $message_info['del_user_id'];
			  $now_user_id = "";
			  if(empty($del_user_id)){
			  	$now_user_id = $this->user_id;
			  } else {
			  	$now_user_id = $del_user_id.",".$this->user_id;
			  }
				$return = $this->notice->update(array('message_id' => $message_id),array('del_user_id' => $now_user_id),'notice');
		}else{
		    $this->showmessage('article','参数错误！','index.php?m=member&c=present&a=lists');
		}
		$this->showmessage('article','礼物删除成功！','index.php?m=member&c=present&a=lists');
	}
}