<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');

class Mypanel extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->tb_admini	='sys_admini';
		$this->tb_role		='sys_role';
		$this->tb_site		='sys_site';
		$this->tb_times		='sys_times';
		$this->tb_menu		='sys_menu';
	}
	//欢迎页面
	public function public_welcome(){
		//获取用户所属角色,并当用户的角色==6时，显示该用户角色所管理的区域
		$admin_role_id = $this->session->userdata('admin_role_id');
    //获取管理员名称
    $data['admin_name'] = $this->session->userdata('admin_username');
		//获取最后登录时间
    $admin_id = $this->session->userdata('admin_user_id');
		$this->load->model('sys_admini');
		$admini = $this->sys_admini->get_one(array('id'=>$admin_id),'sys_admini');
		$areaids = empty($admini['areaids']) ? 0 : $admini['areaids']; 
		$areaids_name = "";
		if(!empty($areaids)){
			$areaids_arr = explode(",",$areaids);
			foreach($areaids_arr as $val){
				$area_info = $this->sys_admini->get_one(array('id' => $val),'areas');
				$areaids_name .= $area_info['name'].",";
			}
		}
		$data['areaids'] = $areaids;
		$data['areaids_name'] = substr($areaids_name,0,-1);
		$data['admin_role_id'] = $admin_role_id;
		$data['last_login_time'] = $admini['last_login_time'];
		
		//获取网站名称
		$this->load->helper('global');
		$setup = getcache('setup','commons');
		$data['site_name'] = $setup['site_name'];
		//获取一周动态
		$this->load->model('user');
		$date = time()-604800;
		$user = $this->user->get_query(array('register_time >'=>$date),'user','count(*) as num');
		$data['user_num'] = $user[0]['num'];
		$this->load->model('order');
		$order = $this->order->get_query(array('add_time >'=>$date),'order','count(*) as num');
		$data['order_num'] = $order[0]['num'];
		//获取所有动态
		$user = $this->user->get_query(array(),'user','count(*) as num');
		$data['user'] = $user[0]['num'];$this->load->model('goods');
		$this->load->model('goods');
		$goods = $this->goods->get_query(array(),'goods','count(*) as num');
		$data['goods'] = $goods[0]['num'];
		$order = $this->order->get_query(array('order_id >'=>0),'order','count(*) as num');
		$this->load->model('message');
		$message = $this->message->get_query(array(),'message','count(*) as num');
		$data['message'] = $message[0]['num'];
		$order = $this->order->get_query(array('order_id >'=>0),'order','count(*) as num');
		$data['order'] = $order[0]['num'];
		$order_sum = $this->order->get_query(array('order_id >'=>0),'order','sum(order_amount) as num');
		$data['order_sum'] = $order_sum[0]['num'];
		//获取服务器信息
		$data['system_os'] = php_uname('s') ;
		$system_env = php_sapi_name();
		switch($system_env){
		    case 'apache2handler':
				$data['system_env'] = 'Apache';
			break;
			case 'cgi-fcgi':
				$data['system_env'] = 'CGI';
			break;
			default:
			    $data['system_env'] = 'Apache';
		}
		$data['php_system'] = PHP_VERSION;
		$data['mysql_system'] = mysql_get_server_info();
		$version = getcache('version','commons');
		$data['version'] = $version['version'];
		$data['inst_time'] = $version['inst_time'];

		$this->cismarty->assign('data',$data);
	  $this->cismarty->display('mypanel/welcome/welcome.html');
	}
	//修改密码
	public function edit_password(){
	    if(isset($_POST['dosubmit'])){
		    $ori_passwd = trim ( $this->input->post ( 'ori_passwd' ) );
			$password = trim ( $this->input->post ( 'password' ) );
			$user_id  = $this->session->userdata('admin_user_id');
			$this->load->model('sys_admini');
		    $admin = $this->sys_admini->get_one(array('id'=>$user_id),'sys_admini');
			if(!empty($admin))$ori_passwds = md5(md5($ori_passwd.$admin['encrypt']));
			if($ori_passwds != $admin['password']){
			    $this->showmessage('edit_password',lang('ori_passwd'),HTTP_REFERER);
			}
			if(!empty($admin))$admin_passwd = md5(md5($password.$admin['encrypt']));
			$this->sys_admini->update(array('id'=>$user_id),array('password'=>$admin_passwd),'sys_admini');
			$this->showmessage('edit_password',lang('edit_password'),$this->admin_url.'mypanel/mypanel/edit_password?loghash='.$this->session->userdata('loghash'));
		}else{
		    $this->cismarty->display('mypanel/password/edit_password.html');
		}
	}
	//cnzziframe
	public function cnzzframe(){
	$this->cismarty->display('mypanel/cnzzframe/cnzzframe.html');
	}
	//AJAX判断原密码是否正确
	public function ajax_passwd(){
	    $password = trim ( $this->input->get ( 'ori_passwd' ) );
		$user_id  = $this->session->userdata('admin_user_id');

		$this->load->model('sys_admini');
		$admin = $this->sys_admini->get_one(array('id'=>$user_id),'sys_admini');
		if(!empty($admin))$admin_passwd = md5(md5($password.$admin['encrypt']));
		if($admin_passwd==$admin['password']){
		    echo 'true';
		}else{
		    echo 'false';
		}
	}
}