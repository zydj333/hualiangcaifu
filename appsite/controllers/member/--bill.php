<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Bill extends Member_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->model('bill');
		$this->user_id=isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
	}
	
	//开票信息
	public function kaipiao(){
			$this->load->model('user');
	    $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	    $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	    
			if(isset($_POST['dosubmit']) && $_POST['dosubmit']==1) {
				$bill_id = trim($this->input->post('billid'));
				$_data['member_id'] = $this->user_id;
				$_data['compname'] = trim($this->input->post('compname'));
				$_data['compcode'] = trim($this->input->post('compcode'));
				$_data['address'] = trim($this->input->post('address2'));
				$_data['tel'] = trim($this->input->post('tel'));
				$_data['bank'] = trim($this->input->post('bank'));
				$_data['bankcode'] = trim($this->input->post('bankcode'));
				
				if(empty($bill_id)){
					$id = $this->bill->add($_data,'bill');
					$this->showmessage('success','开票资料添加成功！',HTTP_REFERER);
					return;
				} else {
					$this->bill->update(array('member_id' => $this->user_id), $_data, 'bill');
					$this->showmessage('success','开票资料更新成功！',HTTP_REFERER);
					return;
				}																				
			}else{
				$bill = $this->bill->get_one(array('member_id' => $this->user_id), 'bill');
				//网站基本设置
				$setup_setting = getcache('setup','commons');
				$this->seo_title = "开票信息 - ".$setup_setting['site_title'];
	    	$data['bill'] = $bill;
				$this->view('bill_add', $data);
			}
	}
	
	//
	public function delkaipiao(){
		$bill_id = intval($this->input->get('bid'));
		if ($bill_id) {
			$this->bill->del(array('member_id' => $this->user_id, 'bill_id' => $bill_id), 'bill');
		}
		
		$this->showmessage('success','开票资料删除成功','index.php?m=member&c=bill&a=kaipiao');
		return;
	}
	
	
}