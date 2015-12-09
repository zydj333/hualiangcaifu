<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *继承系统基类
 */
class MY_Controller extends CI_Controller
{
	public $_language='zh';
  public function __construct()
	{
		parent::__construct();

		//加载URL处理类
		$this->load->helper('url');

		//语言包配置---加载
		$lang = $this->config->item('language');
		if($lang) $this->_language=$lang;
	}
}
/**
 *	管理后台基类
 */
class Admin_Controller extends MY_Controller
{
	/**
	 *模块
	 */
	private $_roule_m;
	/**
	 * 类
	 */
	private $_roule_c;
	/**
	 * 方法
	 */
	private $_roule_a;
	/**
	 * 后台管理页面url
	 */
	public $admin_url;

	public function __construct()
	{
		parent::__construct();
		$this->_roule_m=$this->uri->segment(1) === FALSE?null:$this->uri->segment(1);//模块如sysadmin
		$this->_roule_c=$this->uri->segment(2) === FALSE?null:$this->uri->segment(2);//类
		$this->_roule_a=$this->uri->segment(3) === FALSE?null:$this->uri->segment(3);//方法


		//加载公共语言包
		$this->lang->load('common', $this->_language);

		//加载帮助类
		$this->load->helper('global');
		$this->load->helper('language');

		//加载类库
		$this->load->library('session');

		$this->admin_url=base_url().ADMINPHP.'/';

		$this->init_smarty();

		$this->checkadmin();
		$this->checkauth();
		$this->init_para();
	}
		/**
    * 初始化---公共参数
    */
   private function init_para()
   {

   		/**站点设置的基本信息**/
		$this->sitesetup = getcache('setup','commons');
		$this->sitesetup['cookie_prefix'] = $this->config->item('cookie_prefix');

		$time_zone= isset($this->sitesetup['time_zone']) ? $this->sitesetup['time_zone']: "8";
		if(intval($time_zone)>0)
			$gmt_time_zone='Etc/GMT-'.$time_zone;
		else{
			$gmt_time_zone='Etc/GMT+'.abs($time_zone);
		}

		function_exists('date_default_timezone_set') && date_default_timezone_set($gmt_time_zone);
		//设置本地时差
		define('SYS_TIME', time());

   }

	/**
	 *初始化模板设置
	 */
	public function init_smarty()
	{

		$this->load->library('cismarty');
		$common_data['BASE_URL']=base_url();
		$common_data['ADMIN_URL']=$this->admin_url;
		$common_data['CSS_PATH']=base_url().'statics/admin/css/';
		$common_data['JS_PATH']=base_url().'statics/admin/js/';
		$common_data['IMG_PATH']=base_url().'statics/admin/images/';
		$common_data['UPLOAD_PATH']=base_url().'statics/uploadfile';
		$common_data['LOGHASH']=$this->session->userdata('loghash');
		$common_data['CHARSET']=$this->config->item('charset');
		$common_data['M']=$this->_roule_m;
		$common_data['C']=$this->_roule_c;
		$common_data['A']=$this->_roule_a;

		$this->cismarty->assign('base_url',base_url());
		$this->cismarty->assign('admin_url',$this->admin_url);
		$this->cismarty->assign('CSS_PATH',base_url().'statics/admin/css/');
		$this->cismarty->assign('JS_PATH',base_url().'statics/admin/js/');
		$this->cismarty->assign('IMG_PATH',base_url().'statics/admin/images/');
		$this->cismarty->assign('UPLOAD_PATH',base_url().'statics/uploadfile');
	  $this->cismarty->assign('LOGHASH',$this->session->userdata('loghash'));

		//输出常用变量
	  $this->cismarty->assign('COM',$common_data);
	  
	  //前台显示语言包时--调用
	  //调用格式：<!--{showlang la='com_error'}-->
	  //等同于后台的 echo lang('com_error');
	  $this->cismarty->registerPlugin("function","showlang", 'show_lang');
	  
		//输出页面字符集
		header('Content-type: text/html; charset='.$common_data['CHARSET']);
	}



	/**
	 * 判断用户是否已经登陆
	 */
	 public function checkadmin() {
		if($this->_roule_m =='main_index' && $this->_roule_c =='login' ){// && in_array($this->_roule_a, array('login', 'public_card'))) {
			return true;
		} else {
			if(!isset($this->session->userdata['admin_user_id']) || !isset($this->session->userdata['admin_role_id']) || !$this->session->userdata['admin_user_id'] || !$this->session->userdata['admin_role_id'])
			 	echo "<script>window.top.location.href='".$this->admin_url."main_index/login';</script>";
			//$this->showmessage('goback','请登录！',$this->admin_url.'main_index/login',3, '', 'window.top.location.href="'.$this->admin_url.'main_index/login";');
		}
	}

	/**
	 * 记录日志
	 */
	final private function manage_log() {

	}

	/**
	 * 权限判断
	 */
	private function checkauth()
	{
		if($this->_roule_m ==FALSE || $this->_roule_c==FALSE ) redirect(base_url().ADMINPHP.'/main_index/login');
		//登录时一些方法放行
		if($this->_roule_m =='main_index' && in_array($this->_roule_c, array('login', 'init', 'public_card','logout'))) return true;

		$ispublic=false;
		//public_,ajax_开头的全部放行
		if(preg_match('/^public_/',$this->_roule_a)) $ispublic=true;
		if(preg_match('/^ajax_/',$this->_roule_a)) $ispublic=true;

		//验证loghash值是否存在：防止未登录情况下使用ajax或公共函数
		$loghash=$this->input->get_post('loghash');
		$se_loghash=$this->session->userdata('loghash');
		if($ispublic==true){//ajax提交时，hash验证做额外处理
			if($loghash != $se_loghash ) {return false;}
		}else{
			if($loghash != $se_loghash ) $this->showmessage('goback',lang('com_hash_error'),'');
		}
		//判断是否拥有访问权限
		$menuid=$this->input->get_post('menuid');
//echo $menuid;
		//导航菜单与当前位置放行
		if($this->session->userdata['admin_user_id']==1){
		    return false;
		}else{
		if($menuid==10 || $menuid==80 || $menuid==46 || $menuid==49 || $menuid==50 || $menuid==115 || $menuid==100 || $menuid==90 || $menuid==185 || $this->_roule_m=='main_index' || $this->_roule_c=='public_current_pos'){
		    return false;
		}else{
        $this->load->model('a_system_model');
		    $data['role_id'] = $this->session->userdata['admin_role_id'];
		    $data['menu_id'] = $menuid;
		    $role =$this->a_system_model->get_query($data,'sys_role_priv');
		    //登录时一些方法放行
		    if(!empty($role)){
			    return false;
		    }else{ 
			    $_data['role_id'] = $data['role_id'];
					$_data['m'] = $this->_roule_m;
					$_data['c'] = $this->_roule_c;
					$_data['a'] = $this->_roule_a;
		      if($menuid==FALSE){
				    if($_data['a']==false){
				        return false;
				    }else{
				    		//return true;
				        $roles =$this->a_system_model->get_query($_data,'sys_role_priv');

					    if(!empty($roles)){
					        return false;
					    }else{
					        $this->showmessage('checkauth',lang('checkauth'),HTTP_REFERER);
					    }  
				    }
			    }else{
				    $roles =$this->a_system_model->get_query($_data,'sys_role_priv');
						if(!empty($roles)){
					    return false;
						}else{
					    $this->showmessage('checkauth',lang('checkauth'),$this->admin_url.'mypanel/mypanel/public_welcome?loghash='.$this->session->userdata('loghash'));
						//echo lang('checkauth');exit;
						}
					}
		   }
		}
		}
	}
    
	/**
	 * 提示信息页面跳转，跳转地址如果传入数组，页面会提示多个地址供用户选择，默认跳转地址为数组的第一个值，时间为5秒。
	 * showmessage('登录成功', array('默认跳转地址'=>'http://www.phpcms.cn'));
	 * @param string $msg 提示信息
	 * @param mixed(string/array) $url_forward 跳转地址
	 * @param int $ms 跳转等待时间
	 */
	public function showmessage($msgtype='goback',$msg, $url_forward = 'goback', $ms = 0.5, $dialog = '', $returnjs = '') {
		//----------伪代码--------
		//error 返回上一页
		//edit	继续编辑，返回列表页面
		//add	继续添加，返回列表页面
		//dialog
		//close
		//-----------------------
		$data['msgtype']=$msgtype;
		$data['msg']=$msg;
		$data['url_forward']=$url_forward;
		$data['goback']=HTTP_REFERER;
		$data['ms']=$ms;
		$data['dialog']=0;
 		$data['add']=0;
  	$data['edit']=0;
		$data['returnjs']=$returnjs;

		$pos = strpos($msgtype, 'dialog');
		if($pos !== false) $data['dialog']=1;
		$pos = strpos($msgtype, 'add');
		if($pos !== false) $data['add']=1;
		$pos = strpos($msgtype, 'edit');
		if($pos !== false) $data['edit']=1;


		$this->cismarty->assign("data",$data);
		$this->cismarty->display('message.php');
		exit(0);
	}

	 /**
	 * 按父ID查找菜单子项
	 * @param integer $parentid   父菜单ID
	 * @param integer $with_self  是否包括他自己
	 */
	 public function admin_menu($parentid, $with_self = 0) {
		$parentid = intval($parentid);
		$this->load->model('a_system_model');
		$data['parent_id']=$parentid;
		$data['order_by']='listorder asc';
		$data['roleid']=$this->session->userdata('admin_role_id');
		//$result =$this->a_system_model->get_query($data,'sys_menu');
		//$result = $this->a_system_model->get_role_menu($data['roleid']);
		$result = $this->a_system_model->get_menu_list($data);

		if($with_self) {
			$result2[] = $this->a_system_model->get_one(array('id'=>$parentid),'sys_menu');
			$result = array_merge($result2,$result);
		}
		
		
		/*//权限检查
		if($_SESSION['roleid'] == 1) return $result;
		$checkauth = $this->admin_menu();
		if($checkauth == TRUE){
		    $this->showmessage('checkauth',lang('checkauth'),'');
		}else{
		    return $result;
		}
		$array = array();
		$privdb = pc_base::load_model('admin_role_priv_model');
		foreach($result as $v) {
			$action = $v['a'];
			if(preg_match('/^public_/',$action)) {
				$array[] = $v;
			} else {
				if(preg_match('/^ajax_([a-z]+)_/',$action,$_match)) $action = $_match[1];
				$r = $privdb->get_one(array('m'=>$v['m'],'c'=>$v['c'],'a'=>$action,'roleid'=>$_SESSION['roleid']));
				if($r) $array[] = $v;
			}
		}
		*/
		return $result;
	}
	
	
	/**
	 * 内容页面导航菜单
	 */
	public function get_top_menu($parentid,$with_self = 0){
		return $this->admin_menu($parentid,$with_self);
	}
}
/**
 * 前台使用-----no000000000000000
 */
class Site_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->init_smarty();
	}

		/**
	 *初始化模板设置
	 */
	public function init_smarty()
	{
		$this->load->library('cismarty',array('tpltemp'=>'site'));

	}
}
