<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Consult extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * 咨询列表
	 */
	public function lists(){
		$this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');
		
		$member_name=$this->input->get('member_name');
		$consult_content=$this->input->get('consult_content');
		$flag = intval($this->input->get('flag'));
		
		$data['member_name']=$member_name;
		$data['consult_content']=$consult_content;
		$data['page']=$page;
		$data['pagesize']=10;
		$data['flag'] = $flag;
		
		$this->load->model('a_member_model');
		$list=$this->a_member_model->get_consult_search($data);

		$this->cismarty->assign('sel',$data);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);
		$this->cismarty->display('member/consult/consult_lists.html');
	}

	/**
	 * 删除咨询
	 */
	public function del(){
		$consult_id=$this->input->get_post('consult_id');
		$this->load->model('order_model');
		if(is_array($consult_id)){
			foreach($consult_id as $v){
				$this->order_model->del(array('consult_id'=>$v),'consult');
			}
		}else{
			$consult_id=intval($consult_id);
			$this->order_model->del(array('consult_id'=>$consult_id),'consult');
		}
		$this->showmessage('success',lang('com_del'),HTTP_REFERER);
	}

	public function consult_reply(){
		if(isset($_POST['dosubmit'])){
			$_data_post=$this->input->post();
			$consult_id=$_data_post['consult_id'];
			if($consult_id>0){
				$this->load->model('a_orders_model');
				$info=$this->a_orders_model->get_one(array('consult_id'=>$consult_id),'consult');
				if(!empty($info)){
					$_data['consult_reply']=$_data_post['content'];
					$_data['consult_reply_time']=time();

					if (empty($_data['consult_reply'])) {
						$this->showmessage('adddialog', '内容为空',HTTP_REFERER);
					}else {
						$this->a_orders_model->update(array('consult_id'=>$consult_id),$_data,'consult');
						$this->showmessage('adddialog',lang('com_success'),HTTP_REFERER);
					}
					
				}
			}else {
				$this->showmessage('adddialog',lang('com_error'),HTTP_REFERER);
			}
    	}else{
    		$consult_id=$this->input->get('consult_id');
    		$consult_id=intval($consult_id);
    		if($consult_id>0){
				$this->load->model('a_orders_model');
				$info=$this->a_orders_model->get_one(array('consult_id'=>$consult_id),'consult');
				if(!empty($info)){
					$this->cismarty->assign('info',$info);
					$this->cismarty->display('member/consult/consult_reply.html');
					return;
				}
			}
			$this->showmessage('error',lang('com_parameter'),$this->admin_url.'member/consult/lists?loghash='.$this->session->userdata('loghash'));
    	}
	}

}
