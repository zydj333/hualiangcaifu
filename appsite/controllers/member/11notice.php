<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Notice extends Member_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_member_model');
		$this->load->model('noticesys');
		$this->user_id=isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
	}
	//系统消息列表
	public function lists() {
		$this->seo_title = '客户专区-系统消息';
	  $user_id = $this->session->userdata['member_user_id'];
		$this->load->model('user');
	  $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	  
	  $page=$this->input->get('page');
		$page=intval($page) > 0 ? $page : 1;

		$sel['member_id']=$user_id;
		$sel['page']=$page;
	  $sel['pagesize']=10;

		$list = $this->a_member_model->get_notice_search($sel);
		$list_present = $list['list'];
		foreach($list_present as $k => $v){
			$message_more = $v['message_ismore'];
			$to_user_id = $v['to_user_id'];
			$del_user_id = $v['del_user_id'];
			$read_user_id = $v['read_user_id'];
			$isread = 0;
			//多用户，判断该用户是否在当前用户范围内
			if($message_more == 1){
				$to_user_ids = explode(",",$to_user_id);
				if(!in_array($user_id,$to_user_ids)){
					unset($list_present[$k]);
					continue;
				}
			}
			//判断该用户是否删除
			if(!empty($del_user_id)){
				$del_user_ids = explode(",",$del_user_id);
				if(in_array($user_id,$del_user_ids)){
					unset($list_present[$k]);
					continue;
				}
			}
			//判断用户是否已读
			if(!empty($read_user_id)){
				$read_user_ids = explode(",",$read_user_id);
				if(in_array($user_id,$read_user_ids)){
					$isread = 1;
				}
			}
			$list_present[$k]['isread'] = $isread;
		}
	  $data['list'] = $list_present;
	  $data['page'] = $list['page'];
	  $this->view('notice_list', $data);
	}
//	系统消息阅读
	public function aview() {
		$this->seo_title = '客户专区-系统消息';
		$this->load->model('user');
	  $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
		$id = trim($this->input->get('id'));
		$notice_info = $this->noticesys->get_one(array('sts' => 0,'message_id' => $id),'noticesys');
		
		//更新阅读用户ID
		$read_user_id = $notice_info['read_user_id'];
		$now_user_id = "";
		if(empty($read_user_id)){
			$now_user_id = $this->user_id;
		} else {
			$read_user_ids = explode(",",$read_user_id);
			if(!in_array($this->user_id,$read_user_ids)){
					$now_user_id = $read_user_id.",".$this->user_id;
			} else {
					$now_user_id = $read_user_id;
			}
		}

		$return = $this->noticesys->update(array('message_id' => $id),array('read_user_id' => $now_user_id),'noticesys');
		
		$data['notice_info'] = $notice_info;
	  $this->view('notice_view', $data);
	}
	//系统消息删除
	public function del(){
		$message_id = $this->input->get('id');
		
		if($message_id !== false){
			  //更新删除用户ID
			  $message_info = $this->noticesys->get_one(array('message_id' => $message_id), 'noticesys');
			  $del_user_id = $message_info['del_user_id'];
			  $now_user_id = "";
			  if(empty($del_user_id)){
			  	$now_user_id = $this->user_id;
			  } else {
			  	$now_user_id = $del_user_id.",".$this->user_id;
			  }
				$return = $this->noticesys->update(array('message_id' => $message_id),array('del_user_id' => $now_user_id),'noticesys');
		}else{
		    $this->showmessage('article','参数错误！','index.php?m=member&c=notice&a=lists');
		}
		$this->showmessage('article','系统消息删除成功！','index.php?m=member&c=notice&a=lists');
	}
}