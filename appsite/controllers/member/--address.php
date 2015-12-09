<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Address extends Member_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->user_id=isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
	}
	public function lists() {
			$this->seo_title = '会员中心-收货地址';
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
	    $list = $this->a_member_model->get_address_search($sel);
	    
	    $data['list'] = $list['list'];
	    $data['page'] = $list['page'];
	    $this->view('address_list', $data);
	}
	
	public function address_add(){
			$this->load->model('address');
			$this->load->model('user');
	  	$data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  	$data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
			if(isset($_POST['dosubmit']) && $_POST['dosubmit']==1) {
				$this->load->model('areas');
			
				$user_id = $this->session->userdata['member_user_id'];
				$_data['member_id'] = $user_id;
				$_data['true_name'] = $this->input->get_post('true_name');
				$_data['province_id'] = intval($this->input->get_post('province2'));
				$_data['area_info'] = '';
				if ($_data['province_id']) {
					$province = $this->areas->get_one(array('id'=>$_data['province_id']), 'areas');
					$_data['area_info'] .= $province['name'];
				}
				$_data['city_id'] = intval($this->input->get_post('city2'));
				if ($_data['city_id']) {
					$city = $this->areas->get_one(array('id'=>$_data['city_id']), 'areas');
					$_data['area_info'] .= '	'.$city['name'];
				}
				$_data['area_id'] = intval($this->input->get_post('county2'));
				if ($_data['area_id']) {
					$county= $this->areas->get_one(array('id'=>$_data['area_id']), 'areas');
					$_data['area_info'] .= '	'.$county['name'];
				}
				$_data['address'] = $this->input->get_post('address');
				$_data['zip_code'] = $this->input->get_post('zip_code');
				$_data['tel_phone'] = $this->input->get_post('tel_phone');
				$_data['mob_phone'] = $this->input->get_post('mob_phone');
				$_data['d_add'] = intval($this->input->get_post('d_add'));
						
				$this->load->model('address');
				if ($_data['d_add']) {
					$this->address->update(array('member_id'=>$user_id), array('d_add'=>0), 'address');
				}

				$id = $this->address->add($_data,'address');
				
				$this->showmessage('success','收货地址保存成功','index.php?m=member&c=address&a=lists');
				return;
			}else{
				$user_id = $this->session->userdata['member_user_id'];
	   		$area = $this->user->get_query(array('parent_id'=>0, 'order_by'=>'listorder asc'), 'areas');
				//网站基本设置
				$setup_setting = getcache('setup','commons');
				$this->seo_title = "会员中心 - 新增收货地址".$setup_setting['site_title'];
				$data['area'] = $area;
				$this->view('address_add', $data);
			}
	}
	
	public function address_edit(){
			$this->load->model('address');
			$this->load->model('user');
	  	$data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  	$data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
			if(isset($_POST['dosubmit']) && $_POST['dosubmit']==1) {
				$this->load->model('areas');
				$addressid = $this->input->get_post('addressid');
				$user_id = $this->session->userdata['member_user_id'];
				$_data['true_name'] = $this->input->get_post('true_name');
				$_data['province_id'] = intval($this->input->get_post('province2'));
				$_data['area_info'] = '';
				if ($_data['province_id']) {
					$province = $this->areas->get_one(array('id'=>$_data['province_id']), 'areas');
					$_data['area_info'] .= $province['name'];
				}
				$_data['city_id'] = intval($this->input->get_post('city2'));
				if ($_data['city_id']) {
					$city = $this->areas->get_one(array('id'=>$_data['city_id']), 'areas');
					$_data['area_info'] .= '	'.$city['name'];
				}
				$_data['area_id'] = intval($this->input->get_post('county2'));
				if ($_data['area_id']) {
					$county= $this->areas->get_one(array('id'=>$_data['area_id']), 'areas');
					$_data['area_info'] .= '	'.$county['name'];
				}
				$_data['address'] = $this->input->get_post('address');
				$_data['zip_code'] = $this->input->get_post('zip_code');
				$_data['tel_phone'] = $this->input->get_post('tel_phone');
				$_data['mob_phone'] = $this->input->get_post('mob_phone');
				$_data['d_add'] = intval($this->input->get_post('d_add'));
						
				$this->load->model('address');
				if ($_data['d_add']) {
					$this->address->update(array('member_id'=>$user_id), array('d_add'=>0), 'address');
				}

				$this->address->update(array('address_id'=>$addressid, 'member_id'=>$user_id), $_data, 'address');
				
				$this->showmessage('success','收货地址修改成功','index.php?m=member&c=address&a=lists');
				return;
			}else{
				$address_id = $this->input->get('id');
				$user_id = $this->session->userdata['member_user_id'];
	   		$data['addressInfo'] = $this->address->get_one(array('address_id' => $address_id), 'address');
	   		$area = $this->user->get_query(array('parent_id'=>0, 'order_by'=>'listorder asc'), 'areas');
				//网站基本设置
				$setup_setting = getcache('setup','commons');
				$this->seo_title = "会员中心 - 新增收货地址".$setup_setting['site_title'];
				$data['area'] = $area;
				$this->view('address_edit', $data);
			}
	}
	
	public function address_del(){
		$address_id = intval($this->input->get('id'));
		if ($address_id) {
			$user_id = $this->session->userdata['member_user_id'];
			$this->load->model('address');
			$this->address->del(array('member_id'=>$user_id, 'address_id'=>$address_id), 'address');
		}
		
		$this->showmessage('success','收货地址删除成功','index.php?m=member&c=address&a=lists');
		return;
	}
	
}