<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Message extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dbclass_model');
		$this->load->model('sn_message');
	}
	
	//留言列表
	public function lists(){
	  $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$data['page']=$page;
		$data['pagesize']=10;

		if(isset($_GET['dosubmit'])){
		  $data['search_title'] = $this->input->get('search_title');

			$this->cismarty->assign('title',$data['search_title']);
			$this->cismarty->assign('form_submit',$_GET['dosubmit']);
		}

		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_message_search($data);

		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);

	    $this->cismarty->display('content/message/message_list.html');

	}
	
	//留言查看
	public function message_view(){
		  $id = $this->input->get('id');
		  $this->load->model('message');
		  $message_info = $this->message->get_one(array('id'=>intval($id)),'message');
		  if(empty($message_info)) $this->showmessage('error',lang('com_parameter'),HTTP_REFERER);

		  $this->cismarty->assign('message_info',$message_info);
			$this->cismarty->display('content/message/message_view.html');
	}

	//留言删除
	public function message_del(){
	  $_data_post=$this->input->post();
		$channel_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;
		$this->load->model('message');
		if($channel_id !== false){
		    foreach($channel_id as $val){
		    	$this->message->del(array('id' => $val),'message');
				}
		}else{
		    $this->showmessage('channel',lang('com_parameter'),HTTP_REFERER);
		}
		$this->showmessage('channel',lang('com_del'),$this->admin_url.'content/message/lists?loghash='.$this->session->userdata('loghash'));
	}

}