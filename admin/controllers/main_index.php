<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');

class Main_index extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->tb_admini	='sys_admini';
		$this->tb_role		='sys_role';
		//$this->tb_site		='sys_site';
		$this->tb_times		='sys_times';
		$this->tb_menu		='sys_menu';
	}
	function index()
	{
		$this->load->model('a_system_model');
		$menulist=$this->admin_menu(0);
		$admin_role_id=$this->session->userdata('admin_role_id');
//		$admin_site_id=$this->session->userdata('admin_site_id');
		$roleinfo=$this->a_system_model->get_one(array('id'=>$admin_role_id),$this->tb_role);
//		$siteinfo=$this->a_system_model->get_one(array('id'=>$admin_site_id),$this->tb_site);

		$this->cismarty->assign('menulist',$menulist);
		$this->cismarty->assign('username',	$this->session->userdata('admin_username'));
//		$this->cismarty->assign('siteinfo',$siteinfo);
		$this->cismarty->assign('roleinfo',$roleinfo);
		$this->cismarty->display('index.html');

	}
	function login()
	{
		if(isset($_GET['dosubmit'])) {
			$username = trim ( $this->input->post ( 'username' ) );
			$password = trim ( $this->input->post ( 'password' ) );
			$code = trim ( $this->input->post ( 'code' ) );

			$login_url=$this->admin_url.'main_index/index/login';

			$this->load->model('a_system_model');
			$r=$this->a_system_model->get_one(array('username'=>$username,'sts'=>0),$this->tb_admini);
			//if ($this->session->userdata('adlogin_verifycode') != strtolower($code)) {//判断验证码
				//$this->showmessage('error',lang('com_verifycode_error'),$login_url);
			//}
		  if(!$r) $this->showmessage('goback',lang('password_error'),$login_url);
			$password = md5(md5($password.$r['encrypt']));

			$maxloginfailedtimes=5;
			$logintime= time() - 7200;
			$rtime = $this->a_system_model->get_one(array('username'=>$username,'isadmin'=>1,'logintime >'=>$logintime),$this->tb_times);
//			if($rtime && $rtime['times'] > $maxloginfailedtimes) {
//				$this->showmessage('error',lang('com_login_maxtimes_error'),$login_url);
//			}

			if($r['password'] != $password) {
				$ip = ip();
				if($rtime && $rtime['times'] < $maxloginfailedtimes + 1) {
					$times = $maxloginfailedtimes-intval($rtime['times']);
					$this->a_system_model->update_set(array('username'=>$username),array('ip'=>$ip,'isadmin'=>1,'data_set'=>array('times'=>'times+1')),$this->tb_times);
				} else {
					$this->a_system_model->del(array('username'=>$username,'isadmin'=>1),'sys_times');
					$this->a_system_model->add(array('username'=>$username,'ip'=>$ip,'isadmin'=>1,'logintime'=>time(),'times'=>1),$this->tb_times);
					$times = $maxloginfailedtimes;
				}
				if($times >= 3){//密码输入错误小于3次时提示
					$this->showmessage('error',lang('com_login_error'),$login_url);
				}else{
					$com_login_error=lang('com_login_times_error');
					$com_login_error=cc_str_replace($com_login_error,array('times'=>$times));
					$this->showmessage('error',$com_login_error,$login_url);
				}

			}
			$this->a_system_model->del(array('username'=>$username,'isadmin'=>1),$this->tb_times);
			$last_login_time = empty($r['this_login_time']) ? time() : $r['this_login_time'];
			$loghash = random(6,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
			$this->a_system_model->update(array('id'=>$r['id']),array('last_login_ip'=>ip(),'last_login_time'=>$last_login_time,'this_login_time'=>time()),$this->tb_admini);

			$ses_data = array('admin_user_id'=>$r['id'],
							'admin_username'=>$username,
							'admin_role_id'=>$r['role_id'],
							'admin_area_id'=>$r['areaids'],
//							'admin_site_id'=>$r['site_id'],
							'admin_login'=>'logined',
							'loghash'=>$loghash
						);
			$this->session->set_userdata($ses_data);
			redirect($this->admin_url.'main_index/index/?loghash='.$loghash);
		}
		$this->cismarty->display('login.html');
	}
	/**
	 * 注销用户
	 */
	function logout()
	{
		$this->session->sess_destroy();
		redirect($this->admin_url.'main_index/login');
	}

	/**
	 * 左侧菜单
	 */
	public function public_menu_left() {
		$menuid = intval($_GET['menuid']);
		$datas = $this->admin_menu($menuid);
		if (isset($_GET['parent_id']) && $parent_id = intval($_GET['parent_id']) ? intval($_GET['parent_id']) : 10) {
			foreach($datas as $_value) {
	        	if($parent_id==$_value['id']) {
	        		echo '<li id="_M'.$_value['id'].'" class="on top_menu"><a href="javascript:_M('.$_value['id'].',\'?m='.$_value['m'].'&c='.$_value['c'].'&a='.$_value['a'].'\')" hidefocus="true" style="outline:none;">'.$_value['name'].'</a></li>';

	        	} else {
	        		echo '<li id="_M'.$_value['id'].'" class="top_menu"><a href="javascript:_M('.$_value['id'].',\'?m='.$_value['m'].'&c='.$_value['c'].'&a='.$_value['a'].'\')"  hidefocus="true" style="outline:none;">'.$_value['name'].'</a></li>';
	        	}
	        }
		} else {
			foreach($datas as $_value) {
				echo '<h3 class="f14"><span class="switchs cu on" title="展开与收缩"></span>'.$_value['name'].'</h3>';
				echo '<ul>';
				$sub_array = $this->admin_menu($_value['id']);
				foreach($sub_array as $_key=>$_m) {
					//附加参数
					$data = $_m['data'] ? '&'.$_m['data'] : '';
					if($menuid == 5) { //左侧菜单不显示选中状态
						$classname = 'class="sub_menu"';
					} else {
						$classname = 'class="sub_menu"';
					}
					echo '<li id="_MP'.$_m['id'].'" '.$classname.'><a href="javascript:_MP('.$_m['id'].',\''.$this->admin_url.$_m['m'].'/'.$_m['c'].'/'.$_m['a'].'\');" hidefocus="true" style="outline:none;">'.$_m['name'].'</a></li>';
				}
				echo '</ul>';
			}
			//$this->load->view('dbmanage/left');
		}

	}
	/**
	 * 当前位置
	 */
	public function public_current_pos() {
		$menuid=intval($_GET['menuid']);
		echo $this->current_pos($menuid);
		exit;
	}
	private function current_pos($menuid)
	{
		$this->load->model('a_system_model');
		$r=$this->a_system_model->get_one(array('id'=>$menuid),$this->tb_menu);
		$str = '';
		if(isset($r['parent_id']) && !empty($r['parent_id'])) {
			$str = $this->current_pos($r['parent_id']);
		}
		return $str.$r['name'].' > ';
	}

	public function public_map(){
		$this->load->model('a_system_model');
		$roleid=$this->session->userdata('admin_role_id');
		$list=$this->a_system_model->get_role_menu($roleid);

		$this->load->helper('tree');
		$list=tr_sortdata($list);

		$list0=array();
		$i=1;
		foreach($list as $key=>$val){
			if($val['parent_id']==0){$val['i']=$i;$i++;}else{$val['i']=0;}
			$list0[]=$val;
		}
		$this->cismarty->assign('list',$list0);
		$this->cismarty->display('map.html');
	}
	//欢迎页面
	/*public function public_welcome(){
        //获取管理员名称
        $data['admin_name'] = $this->session->userdata('admin_username');
		//获取最后登录时间
        $admin_id = $this->session->userdata('admin_user_id');
		$this->load->model('sys_admini');
		$admini = $this->sys_admini->get_one(array('id'=>$admin_id),'sys_admini');
		$data['last_login_time'] = $admini['last_login_time'];
		//获取网站名称
		$this->load->helper('global');
		$setup = getcache('setup','commons');
		$data['site_name'] = $setup['site_name'];
		//获取一周动态
		$this->load->model('user');
		$date = time()-604800;
		$user = $this->user->get_query(array('register_time >'=>$date,'sts'=>0),'user','count(*) as num');
		$data['user_num'] = $user[0]['num'];
		$this->load->model('shop');
		$shop = $this->shop->get_query(array('shop_time >'=>$date,'shop_audit'=>1,'sts'=>0),'shop','count(*) as num');
		$data['shop_num'] = $shop[0]['num'];
		$shop_apply = $this->shop->get_query(array('shop_time >'=>$date,'shop_audit'=>0,'sts'=>0),'shop','count(*) as num');
		$data['shop_apply_num'] = $shop[0]['num'];
		$this->load->model('goods');
		$goods = $this->goods->get_query(array('goods_add_time >'=>$date,'sts'=>0),'goods','count(*) as num');
		$data['goods_num'] = $goods[0]['num'];
		$this->load->model('order');
		$order = $this->order->get_query(array('add_time >'=>$date),'order','count(*) as num');
		$data['order_num'] = $order[0]['num'];
		//获取所有动态
		$user = $this->user->get_query(array('sts'=>0),'user','count(*) as num');
		$data['user'] = $user[0]['num'];
		$this->load->model('shop');
		$shop = $this->shop->get_query(array('shop_audit'=>1,'sts'=>0),'shop','count(*) as num');
		$data['shop'] = $shop[0]['num'];
		$shop_apply = $this->shop->get_query(array('shop_audit'=>0,'sts'=>0),'shop','count(*) as num');
		$data['shop_apply'] = $shop_apply[0]['num'];
		$this->load->model('goods');
		$goods = $this->goods->get_query(array('sts'=>0),'goods','count(*) as num');
		$data['goods'] = $goods[0]['num'];
		$this->load->model('order');
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
	    $this->cismarty->display('system/welcome/welcome.html');
	}*/
}
