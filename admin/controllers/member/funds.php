<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Funds extends Admin_Controller {

	/*
	    资金入账管理
	*/
	public function __construct()
	{
		parent::__construct();
		$this->tb_user='user';
		$this->tb_user_charge='user_charge';
		$this->load->model('user');
		$this->load->model('user_charge');
		$this->load->model('uploadfile');
	}
	//分页列表
	public function lists(){
	  $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    $seldata['pagesize']=10;
    if(isset($_GET['dosubmit'])){
		  $seldata['search_name'] = $this->input->get('search_name');
			$seldata['add_time_st'] = $this->input->get('add_time_st');
			$seldata['add_time_en'] = $this->input->get('add_time_en');

			$this->cismarty->assign('search_name',$seldata['search_name']);
			$this->cismarty->assign('add_time_st',$seldata['add_time_st']);
			$this->cismarty->assign('add_time_en',$seldata['add_time_en']);
			$this->cismarty->assign('form_submit',$_GET['dosubmit']);
		}
		//获取该管理员下的经销商
		$admin_areaids = $this->session->userdata('admin_area_id');
		if(!empty($admin_areaids)){
			$seldata['admin_areaids']= $admin_areaids;
		}
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_usercharge_search($seldata);
		$funds_list = $list ['list'];
		foreach ( $funds_list as $k => $v ) {
			$funds_list [$k] = $v;
			$funds_list [$k] ['type_name'] = $this->getstatename ( $v ['money_type'] );
		}
		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$funds_list);
		$this->cismarty->assign('infopage',$list['page']);

	  $this->cismarty->display('member/funds/funds_list.html');
	}
	//添加
	public function funds_add(){
		if(isset($_POST['dosubmit'])){
			$user_ids = $this->input->post('user_ids');
		  $money_time = $this->input->post('money_time');
			$money_total = $this->input->post('money_total');
			$money_type = $this->input->post('money_type');
			$add_time = time();
			if(!empty($money_type) && $money_type == 5){
				$money_type =  $this->input->post('money_type2');
			}
			//更新记录
			foreach($user_ids as $v){
				$user_id = $v;
				$user_info = $this->user->get_one(array('user_id' => $user_id), 'user');
				$user_predeposit = $user_info['available_predeposit'];
				$funds['member_name'] = $user_info['username'];
				$funds['member_email'] = $user_info['email'];
				$funds['province_id'] = $user_info['province_id'];
				$funds['member_id'] = $user_id;
				$funds['money_time'] = $money_time;
				$funds['money_total'] = $money_total;
				$funds['money_type'] = $money_type;
				$funds['add_time'] = $add_time;
			  $fundsres = $this->user_charge->add($funds,$this->tb_user_charge);
			  //更新用户余额
			  $user_predeposit = $user_predeposit + $money_total;
			  $this->user->update(array('user_id' => $user_id), array('available_predeposit' => $user_predeposit), 'user');
			}
			$this->showmessage('success',lang('com_add'),$this->admin_url.'member/funds/lists?loghash='.$this->session->userdata('loghash'));
		}else{
			$this->load->model('a_system_model');
			//获取该管理员下的经销商
	  	$where = 'sts = 0 ';
			$admin_areaids = $this->session->userdata('admin_area_id');
			if(!empty($admin_areaids)){
				$where .= ' and province_id in ('.$admin_areaids.')';
			}
			$user_list = $this->a_system_model->get_query($where,$this->tb_user);
		  //$user_list = $this->a_system_model->get_query(array('order_by'=>'register_time desc'),$this->tb_user);
			$this->cismarty->assign('user_list',$user_list);
		  $this->cismarty->display('member/funds/funds_add.html');
		}
	}

	 //删除
    public function funds_del(){
	    $_data_post=$this->input->post();
			$ids = isset($_data_post['del_id'])?$_data_post['del_id']:null;

			$this->load->model('a_system_model');

			foreach($ids as $val){
				$where = array('id' => $val);
				$return = $this->a_system_model->del($where,$this->tb_user_charge,$val);
			}

			$this->showmessage('link_del',lang('com_del'),$this->admin_url.'member/funds/lists?loghash='.$this->session->userdata('loghash'));
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