<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');

class Notice extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dbclass_model');
		$this->load->model('type_model');
		$this->load->model('user_model');
		$this->load->model('notice');
		$this->load->model('noticesys');
		$this->load->model('uploadfile');
	}
	
	//会员通知
	public function user_notice(){
		if(isset($_POST['form_submit'])){
			$send_type= $this->input->post('send_type');
		  $user_name = $this->input->post('user_name');
			$message['message_body'] = $this->input->post('content1');

			if($send_type==1){
				$user_name= explode(',',$user_name);
			 	if(count($user_name)>1){
			 		$message['message_ismore']='1';
			 	}
			 	$t_user_id=0;
				foreach($user_name as $key => $val){
		    	if(!empty($val)){
		     		$user_id = $this->user_model->get_one(array('username' =>$val,'sts'=>0),'user','user_id');
		     		if($user_id['user_id']){
		     			$t_user_id.= $user_id['user_id'].',';
					  }else{
							$message='发送失败！用户'.$val.'不存在,请核对用户名正确之后再发送!';
							$this->showmessage('error',$message,$this->admin_url.'member/notice/user_notice?loghash='.$this->session->userdata('loghash'));
						}
		      }
			  }
				$uid_t=substr($t_user_id,1,-1);
				$message['to_user_id']=$uid_t;
				$message['to_user_name']=$this->input->post('user_name');
			}
			$message['message_type']='1';
			$message['from_user_id']='0';
			$message['message_time']=time();
		  $message['from_user_name']='系统';

			$message = $this->notice->add($message);
			$this->showmessage('success',lang('com_add'),$this->admin_url.'member/notice/user_notice?loghash='.$this->session->userdata('loghash'));
		}else{
		    $this->cismarty->display('member/notice/user_notice.html');
		}
	}
	
	//系统消息
	public function sys_notice(){
		if(isset($_POST['form_submit'])){
			$send_type= $this->input->post('send_type');
		  $user_name = $this->input->post('user_name');
		  $message['message_title'] = $this->input->post('message_title');
			$message['message_body'] = $this->input->post('content1');

			if($send_type==1){
				$user_name= explode(',',$user_name);
			 	if(count($user_name)>1){
			 		$message['message_ismore']='1';
			 	}
			 	$t_user_id=0;
				foreach($user_name as $key => $val){
		    	if(!empty($val)){
		     		$user_id = $this->user_model->get_one(array('username' =>$val,'sts'=>0),'user','user_id');
		     		if($user_id['user_id']){
		     			$t_user_id.= $user_id['user_id'].',';
					  }else{
							$message='发送失败！用户'.$val.'不存在,请核对用户名正确之后再发送!';
							$this->showmessage('error',$message,$this->admin_url.'member/notice/sys_notice?loghash='.$this->session->userdata('loghash'));
						}
		      }
			  }
				$uid_t=substr($t_user_id,1,-1);
				$message['to_user_id']=$uid_t;
				$message['to_user_name']=$this->input->post('user_name');
			}
			$message['message_type']='1';
			$message['from_user_id']='0';
			$message['message_time']=time();
		  $message['from_user_name']='系统';

			$message = $this->noticesys->add($message);
			$this->showmessage('success',lang('com_add'),$this->admin_url.'member/notice/sys_notice?loghash='.$this->session->userdata('loghash'));
		}else{
		    $this->cismarty->display('member/notice/sys_notice.html');
		}
	}
}