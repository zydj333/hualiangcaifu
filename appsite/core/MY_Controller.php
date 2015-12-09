<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *继承系统基类
 */
class MY_Controller extends CI_Controller
{
	public $_language='zh';
	public $sitesetup;
	public $seo_title;
	public $seo_keywords;
	public $seo_description;
	public $seosetup;
	public $shop_site_temp ='default';

	/**
	 * 类---url（index.php）后面第一个'/'后面的参数
	 */
	protected $_roule_m;
	/**
	 * 类---url（index.php）后面第二个'/'后面的参数
	 */
	protected $_roule_c;
	/**
	 * 方法---url（index.php）后面第三个'/'后面的参数
	 */
	protected $_roule_a;

    public function __construct()
	{
		parent::__construct();

		//加载URL处理类
		$this->load->helper('url');
		$this->load->helper('global');
		$this->load->helper('language');

		//加载类库
		$this->load->library('session');

		//根据二级域名--加载--语言包配置
		$domain = $_SERVER['SERVER_NAME'];
		$sec_do = explode(".",$domain);
		$lang = $sec_do[0];
		if($lang != 'fr' && $lang != 'de') $lang = 'zh';
		if($lang) $this->_language=$lang;
		$this->lang->load('common', $lang);
		define('SITE_LANG',$lang);

		$this->_roule_m=$this->input->get_post('m');//模型，即文件夹d
		$this->_roule_c=$this->input->get_post('c')===FALSE?'index':$this->input->get_post('c');//类
		$this->_roule_a=$this->input->get_post('a')===FALSE?'index':$this->input->get_post('a');//方法

		//初始化参数
		$this->init_para();

		$this->input->set_cookie('name','123456');
	}



		/**
    * 自动模板调用
    *
    * @param $module
    * @param $template
    * @param $istag
    * @return unknown_type
    */
   protected function view($view_file,$page_data=false,$module='',$default_emptlate='default')
   {

   	   //$module=$module===''?$this->_roule_m:$module;

		if(empty($module)){
			$module=$this->_roule_m===FALSE?$this->_roule_c:$this->_roule_m.'/'.$this->_roule_c;
		}
	   $page_data['seo_title'] = $this->seo_title;
	   $page_data['seo_keywords'] = $this->seo_keywords;
	   $page_data['seo_description'] = $this->seo_description;
	   $page_data['sitesetup']=$this->sitesetup;
	   $page_data['seosetup']=$this->seosetup;

       $view_file=template($module,$view_file,$default_emptlate);
       $page_data['mca']=array('m'=>$this->_roule_m,'c'=>$this->_roule_c,'a'=>$this->_roule_a,);

       $this->load->view($view_file,$page_data);
   }


    /**
	 * 提示信息页面跳转，跳转地址如果传入数组，页面会提示多个地址供用户选择，默认跳转地址为数组的第一个值，时间为5秒。
	 * showmessage('登录成功', array('默认跳转地址'=>'网站首页'));
	 * @param string $msg 提示信息
	 * @param mixed(string/array) $url_forward 跳转地址
	 * @param int $ms 跳转等待时间(毫秒)
	 */
	protected function showmessage($type='error',$msg, $url_forward = '', $ms = 3000, $returnjs = '') {

		//----$type:error、success、goback
		$data['msgtype']=$type;
		$data['msg']=$msg;

		$data['url_forward']= $url_forward=='' ? HTTP_REFERER : $url_forward;
		$data['ms']=$ms;
		$data['returnjs']=$returnjs;
		$data['current_nav'] = "index";
		$data['nav_category'] = array();
		$data['hot_arr'] = array();

		$data['seo_title'] = "Message Notice";
		$data['seo_keywords'] = "Message Notice";
		$data['seo_description'] = "Message Notice";

		self::view('show_message',$data,'index',SITE_TEMP);

	}
	
	 /**
	 * 提示信息页面跳转，跳转地址如果传入数组，页面会提示多个地址供用户选择，默认跳转地址为数组的第一个值，时间为5秒。
	 * showmessage('登录成功', array('默认跳转地址'=>'网站首页'));
	 * @param string $msg 提示信息
	 * @param mixed(string/array) $url_forward 跳转地址
	 * @param int $ms 跳转等待时间(毫秒)
	 */
	protected function showmessagetpl($type='error',$msg, $url_forward = '',$tpl = 'show_message', $ms = 3000, $returnjs = '', $arr = array()) {

		//----$type:error、success、goback
		$data['msgtype']=$type;
		$data['msg']=$msg;
		$data['dd'] = $arr;

		$data['url_forward']= $url_forward=='' ? HTTP_REFERER : $url_forward;
		$data['ms']=$ms;
		$data['returnjs']=$returnjs;

		$data['seo_title'] = "Message Notice";
		$data['seo_keywords'] = "Message Notice";
		$data['seo_description'] = "Message Notice";

		self::view($tpl ,$data,'index',SITE_TEMP);

	}

	/**
    * 初始化---公共参数
    */
   private function init_para()
   {

   		$this->seosetup  = getcache('seo_setup','commons');
		$this->seosetup['keywords']='';
	    $this->seosetup['description']='';
	    $this->seo_title = '';
		$domain = $_SERVER['SERVER_NAME'];

   		/**站点设置的基本信息**/
			$this->sitesetup = getcache('setup','commons');
			$this->sitesetup['cookie_prefix'] = $this->config->item('cookie_prefix');
			$time_zone=$this->sitesetup['time_zone'];
			if(intval($time_zone)>0)
				$gmt_time_zone='Etc/GMT-'.$time_zone;
			else{
				$gmt_time_zone='Etc/GMT+'.abs($time_zone);
			}

		function_exists('date_default_timezone_set') && date_default_timezone_set($gmt_time_zone);
		//设置本地时差
		define('SYS_TIME', time());
		define('BASE_URL',base_url());

		$default_emptlate=$this->config->item('shop_site_temp');
	  if(empty($default_emptlate)) $default_emptlate=$this->shop_site_temp;
	  define('SITE_DOM',$domain);
		define('SITE_TEMP',$default_emptlate);
		define('CSS_PATH',base_url().'statics/'.$default_emptlate.'/css/');
		define('JS_PATH',base_url().'statics/'.$default_emptlate.'/js/');
		define('IMG_PATH',base_url().'statics/'.$default_emptlate.'/images/');

		define('UPLOAD_PATH',base_url().'statics/uploadfile');
		define('CHARSET',$this->config->item('charset'));
		define('NOWURL',$this->nowurl());

		//输出页面字符集
		header('Content-type: text/html; charset='.CHARSET);

   }
	/**
	 * 返回当前URL
	 */
	private function nowurl(){
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	    $php_self     = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	    $path_info    = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
	    $relate_url   = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $path_info);
	    return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
	}

}

/**
 * 前台--普通专用
 */
class Site_Controller extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->lang->load('site', $this->_language);

	}
   /*
	 * 判断用户是否已经登陆
	 */
	protected function checklogin( $urll ='') {
		if($urll== '') $urll=NOWURL;
		$gourl=base_url().'index.php?c=customer&a=login&urll='.urlencode($urll);


		if(!isset($this->session->userdata['member_user_id']))
		{
			$roule_a=$this->_roule_a;
			/**ajax_开始表示ajax请求专用，如果session不存在，直接返回false***/
			if(preg_match('/^ajax_/',$roule_a,$_match)){ return 'false';exit;}

			/**uri:弹出窗口专用处理--start***/
			$uri=$this->input->get_post('uri');
			$js='';
			if($uri=='1')
			{
			   $dialog_id = '';
				if(empty($dialog_id))
            	{
                	$dialog_id = $this->_roule_a.'_dialog';
            	}
				echo '<script type=\'text/javascript\'>window.parent.location.reload()</script>';
				exit;
			}
			/**uri:弹出窗口专用处理---end***/

			$this->showmessage('error',lang('com_login'),$gourl);
		}

	}

	/**
    * 自动模板调用
    *
    * @param $module
    * @param $template
    * @param $istag
    * @return unknown_type
    */
   protected function view($view_file,$page_data=false,$module='')
   {

   	   parent::view($view_file,$page_data,$module,SITE_TEMP);
   	   //$module=$module===''?$this->_roule_c:$module;
       //$view_file=template($module,$view_file);
       //$this->load->view($view_file,$page_data);
   }


}
 /**
 * 前台---member专用
 */
class Member_Controller extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		//$this->lang->load('member', $this->_language);
		$this->checklogin();
	}

	/**
	 * 判断用户是否已经登陆
	 */
	protected function checklogin() {
		$urll=NOWURL;
		$gourl=BASE_URL.'index.php?c=customer&a=login&urll='.urlencode($urll);


		if(!isset($this->session->userdata['member_user_id']))
		{
			$roule_a=$this->_roule_a;
			/**ajax_开始表示ajax请求专用，如果session不存在，直接返回false***/
			if(preg_match('/^ajax_/',$roule_a,$_match)){ return 'false';exit;}

			/**uri:弹出窗口专用处理--start***/
			$uri=$this->input->get_post('uri');
			$js='';
			if($uri=='1')
			{
			   $dialog_id = '';
				if(empty($dialog_id))
            	{
                	$dialog_id = $this->_roule_a.'_dialog';
            	}
				echo '<script type=\'text/javascript\'>window.parent.location.reload()</script>';
				exit;
			}
			/**uri:弹出窗口专用处理---end***/
			redirect($gourl);
			//$this->showmessage('error',lang('com_login'),$gourl);
		}

	}

	/**
    * 自动模板调用
    *
    * @param $module
    * @param $template
    * @param $istag
    * @return unknown_type
    */
   	protected function view($view_file,$page_data=false,$module='')
   	{

   		$now_pos=array('name'=>'','isshop'=>'0');
		if(isset($page_data['isleft']) && $page_data['isleft']==1){
	  		$member_left=getcache('member_left','member','file','array');


	   		foreach($member_left as $k=> $v){
				if($this->_roule_c==$v['sel_c'] && $this->_roule_a==$v['sel_a']){
					$now_pos=array('name'=>$v['name'],'isshop'=>$v['isshop']);
				}
				if($v['sel_c'] == 'shop'){
					$msg=$v['url'];
					$member_left[$k]['url']=cc_str_replace($msg,array('shop_id'=>$this->session->userdata['member_user_id']));
				}
	   		}

	   		$page_data['member_left']=$member_left;
	  	}

	   $url['m']=$this->_roule_m;
   	   $url['c']=$this->_roule_c;
   	   $url['a']=$this->_roule_a;
   	   $page_data['mvc']=$url;
   	   $page_data['now_pos']=$now_pos;

       parent::view($view_file,$page_data,$module);
   }

    protected function pop_warning($msg, $dialog_id = '',$url = '')
    {
        if($msg == 'ok')
        {
            if(empty($dialog_id))
            {
                $dialog_id = $this->_roule_a.'_dialog';
            }
            if (!empty($url))
            {
                echo "<script type='text/javascript'>window.parent.location.href='".$url."';</script>";
            }
            echo "<script type='text/javascript'>window.parent.js_success('" . $dialog_id ."');</script>";
        }
        else
        {
        	$msg = is_array($msg) ? $msg : array('msg' => $msg);
        	$msg['msgtype']=isset($msg['msgtype'])?$msg['msgtype']:'error';

        	$this->view('dialog_message',$msg,'member');
        	/*
            $msg = is_array($msg) ? $msg : array('msg' => $msg);
            $errors = '';
            foreach ($msg as $k => $v)
            {
                //$error = $v[obj] ? lang($v[msg]) . " [" . lang($v[obj]) . "]" : lang($v[msg]);
                $error = $v;
                $errors .= $errors ? "<br />" . $error : $error;
            }
            $this->view('block_message',null,'member/order');
            echo "<script type='text/javascript'>window.parent.js_fail('" . $errors . "');</script>";
            */
        }
    }
}

