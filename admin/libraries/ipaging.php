<?php

class ipaging {
	/**
	 * 初始化链接实例
	 */
	private static $instance;
	/**
	 *初始化分页类
	 */
	private $pagination;

	/**
	 * 类的初始化
	 */
	public function __construct(){
		self::$instance =& $this;

		log_message('debug', "IPagination Class Initialized");

		$CI =& get_instance();
		$CI->load->library('pagination');
		$this->pagination =& $CI->pagination;

	}


	/**
	 * 分页函数--后台专用
	 *
	 *	@base_url		页面url
	 *	@cur_page		当前页码
	 *	@total_rows		总计条数
	 *	@pagesize		页面大小，默认值为20
	 *	@num_link		当前页码
	 *
	 *  @return  		分页后的html内容
	 */
	public function getSysPageBar($total_rows=0,$cur_page=0,$pagesize=20,$base_url='',$num_link=3){

		if($total_rows==0) return '';

		if(empty($base_url)){
			$base_url = $this->rewrite_url($this->get_url());
		}

	    $base_url=$this-> clear_per_page($base_url);

		$config['base_url'] = $base_url;
		$config['total_rows'] = $total_rows;//总条数
		$config['num_links'] = $num_link;//放在你当前页码的前面和后面的“数字”链接的数量。
		$config['per_page'] = $pagesize;//页面大小pagesize
		$config['cur_page'] =$cur_page;//当前页
		$config['use_page_numbers'] = TRUE;//启用use_page_numbers后显示的是当前页码
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] ='page';


		//配置添加封装标签
		//如果你希望在整个分页周围围绕一些标签
		$config['full_tag_open'] = '<div class="pagination"><ul><li><span>共'.$total_rows.'条</span></li>';
		$config['full_tag_close'] = '</ul></div>';

		$config['num_tag_open'] = '<li><span>';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li><span class=\'currentpage\' >';
		$config['cur_tag_close'] = '</span></li>';


		$config['first_link'] = '首页';
		$config['first_tag_open'] = '<li><span>';
		$config['first_tag_close'] = '</span></li>';


		$config['last_link'] = '末页';
		$config['last_tag_open'] = '<li><span>';
		$config['last_tag_close'] = '</span></li>';

		$config['next_link'] = '下一页';
		$config['next_tag_open'] = '<li><span>';
		$config['next_tag_close'] = '</span></li>';

		$config['prev_link'] = '上一页';
		$config['prev_tag_open'] = '<li><span>';
		$config['prev_tag_close'] = '</span></li>';

		//给链接添加 CSS 类
		$config['anchor_class'] = " class='demo' ";

		$this->pagination->initialize($config);

		$res=$this->pagination->create_links();
		return $res;
	}

	/**
	 *  清除原先路径中的per_page的值,
	 *  举例说明：原先url为http://xxx.com/index.php/test/per_page=2
	 * 			替换后为 http://xxx.com/index.php/test/
	 */
	private function clear_per_page($base_url){
		$string = $base_url;
		$pattern = "/\&page\=(\d*)/";
		$replacement = "";
		$base_url=preg_replace($pattern, $replacement, $string);

		return $base_url;
	}

	/**
	 *  查找字符有没有问号（?）,没有最后加一个问号
	 */
	private function rewrite_url($base_url){

		$regex = '/\?/';
		$matches = array();
		preg_match($regex, $base_url, $matches);
		$base_url=empty($matches)?$base_url.'?':$base_url;

		return $base_url;
	}


	/**
	 * 安全过滤函数
	 *
	 * @param $string
	 * @return string
	 */
	function safe_replace($string) {
		$string = str_replace('%20','',$string);
		$string = str_replace('%27','',$string);
		$string = str_replace('%2527','',$string);
		$string = str_replace('*','',$string);
		$string = str_replace('"','&quot;',$string);
		$string = str_replace("'",'',$string);
		$string = str_replace('"','',$string);
		$string = str_replace(';','',$string);
		$string = str_replace('<','&lt;',$string);
		$string = str_replace('>','&gt;',$string);
		$string = str_replace("{",'',$string);
		$string = str_replace('}','',$string);
		$string = str_replace('\\','',$string);
		return $string;
	}


	/**
	 * 获取当前页面完整URL地址
	 */
	private function get_url() {
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		$php_self = $_SERVER['PHP_SELF'] ? $this->safe_replace($_SERVER['PHP_SELF']) : $this->safe_replace($_SERVER['SCRIPT_NAME']);
		$path_info = isset($_SERVER['PATH_INFO']) ? $this->safe_replace($_SERVER['PATH_INFO']) : '';
		$relate_url = isset($_SERVER['REQUEST_URI']) ? $this->safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$this->safe_replace($_SERVER['QUERY_STRING']) : $path_info);
		return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	}
}
?>