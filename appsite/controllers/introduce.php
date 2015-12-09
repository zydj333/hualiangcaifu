<?php
class Introduce extends Site_Controller {

	private $tb_article = 'article';
	private $tb_article_cate = 'article_category';
	private $tb_document = 'document';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_article_model');
		$this->load->model('a_caifu_model');
		$this->load->model('a_com_model');
	}
	
	//更新日志
	public function actlog()
	{
		$cid=24;
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//分类基本信息
		$cate_info = $this->a_article_model->get_one(array('ac_id' => $cid),'article_category');
		
		$page=$this->input->get('page');
		$page=intval($page) > 0 ? $page : 1;

		$sel['cateid'] = $cid;
		$sel['page'] = $page;
	  $sel['pagesize'] = 10;
		$list = $this->a_com_model->getNewsList($sel);
	  $_data['list'] = $list['list'];
	  $_data['page'] = $list['page'];
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? '更新日志 - '.$setup_setting['site_title'] : $article_info['doc_title']." - ".$setup_setting['site_title'];
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$_data['cid'] = $cid;
		$_data['cate_info'] = $cate_info;
		$_data['current_nav'] = "aboutus";
		$_data['nav_category'] = $nav_category;
		$this->view('actlog',$_data);
	}
	
	//关于我们
	public function aboutus()
	{
		//分类代码
		$code = "aboutus";
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//文章基本信息
		$article_info = $this->a_article_model->get_one(array('doc_code' => $code),'document');
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? '走进财来电 - '.$setup_setting['site_title'] : $article_info['doc_title']." - ".$setup_setting['site_title'];
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$_data['code'] = $code;
		$_data['article_info']=$article_info;
		$_data['current_nav'] = "aboutus";
		$_data['nav_category'] = $nav_category;
		$this->view('aboutus',$_data);
	}
	
	//加入我们
	public function joinus()
	{
		//分类代码
		$code = "joinus";
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//文章基本信息
		$article_info = $this->a_article_model->get_one(array('doc_code' => $code),'document');
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? '加入我们 - '.$setup_setting['site_title'] : $article_info['doc_title']." - ".$setup_setting['site_title'];
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$_data['code'] = $code;
		$_data['article_info']=$article_info;
		$_data['current_nav'] = "aboutus";
		$_data['nav_category'] = $nav_category;
		$this->view('joinus',$_data);
	}
	
	//法律声明
	public function law()
	{
		//分类代码
		$code = "law";
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//文章基本信息
		$article_info = $this->a_article_model->get_one(array('doc_code' => $code),'document');
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? '法律声明 - '.$setup_setting['site_title'] : $article_info['doc_title']." - ".$setup_setting['site_title'];
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$_data['code'] = $code;
		$_data['article_info']=$article_info;
		$_data['current_nav'] = "aboutus";
		$_data['nav_category'] = $nav_category;
		$this->view('law',$_data);
	}
	
	//合作伙伴
	public function partner()
	{
 
		//分类代码
		$code = "partner";
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//文章基本信息
		$article_info = $this->a_article_model->get_one(array('doc_code' => $code),'document');
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? '合作伙伴 - '.$setup_setting['site_title'] : $article_info['doc_title']." - ".$setup_setting['site_title'];
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$_data['code'] = $code;
		$_data['article_info']=$article_info;
		$_data['current_nav'] = "aboutus";
		$_data['nav_category'] = $nav_category;
		$this->view('partner',$_data);
	}
	
	//服务条款
	public function agreement()
	{
		//分类代码
		$code = "register";
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//文章基本信息
		$article_info = $this->a_article_model->get_one(array('doc_code' => $code),'document');
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? '服务条款 - '.$setup_setting['site_title'] : $article_info['doc_title']." - ".$setup_setting['site_title'];
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$_data['code'] = $code;
		$_data['article_info']=$article_info;
		$_data['current_nav'] = "aboutus";
		$_data['nav_category'] = $nav_category;
		$this->view('agreement',$_data);
	}
	
	//联系我们
	public function contactus()
	{
		//分类代码
		$code = "contactus";
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//文章基本信息
		$article_info = $this->a_article_model->get_one(array('doc_code' => $code),'document');
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? '联系我们 - '.$setup_setting['site_title'] : $article_info['doc_title']." - ".$setup_setting['site_title'];
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$_data['code'] = $code;
		$_data['article_info']=$article_info;
		$_data['current_nav'] = "contactus";
		$_data['nav_category'] = $nav_category;
		$this->view('contactus',$_data);
	}
	
	//信托认购导航
	public function subscription()
	{
		//分类代码
		$code = "subscription";
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//文章基本信息
		$article_info = $this->a_article_model->get_one(array('doc_code' => $code),'document');
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? '信托认购导航 - '.$setup_setting['site_title'] : $article_info['doc_title']." - ".$setup_setting['site_title'];
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$_data['code'] = $code;
		$_data['article_info']=$article_info;
		$_data['current_nav'] = "aboutus";
		$_data['nav_category'] = $nav_category;
		$this->view('subscription',$_data);
	}
	
	//信托认购导航
	public function aboutcloud()
	{
		//分类代码
		$code = "aboutcloud";
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//文章基本信息
		$article_info = $this->a_article_model->get_one(array('doc_code' => $code),'document');
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? '信托认购导航 - '.$setup_setting['site_title'] : $article_info['doc_title']." - ".$setup_setting['site_title'];
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$_data['code'] = $code;
		$_data['article_info']=$article_info;
		$_data['current_nav'] = "aboutus";
		$_data['nav_category'] = $nav_category;
		$this->view('aboutcloud',$_data);
	}
	
	//访客留言
	public function message()
	{
		if(isset($_POST['dosubmit']) && $_POST['dosubmit'] == 'ok') {
			$this->load->model('message');

			$message = array();
			$yzcode = trim($this->input->post('yzcode'));
			//验证码
			if ($this->session->userdata('login_verifycode') != strtolower($yzcode)) {//判断验证码
				$this->showmessage('error','输入的验证码错误！',HTTP_REFERER);
				return;
			}
			$message['contact'] = trim($this->input->post('contact'));
			$message['company'] = $this->input->post('company');
			$message['phone'] = $this->input->post('phone');
			$message['fax'] = $this->input->post('fax');
			$message['email'] = $this->input->post('email');
			$message['address'] = $this->input->post('address');
			$message['content'] = $this->input->post('content');
			$message['add_time'] = time();
			$id=$this->message->add($message);
			$this->showmessage('success','留言提交成功',HTTP_REFERER);
		  return '';
		}else{
			//分类代码
			$code = "message";
			//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
			//网站基本设置
			$setup_setting = getcache('setup','commons');
			$this->seo_title = '访客留言 - '.$setup_setting['site_title'];
			$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
			$hot_arr = array();
			if(!empty($hot_search)){
				$hot_arr = explode(",",$hot_search);
			}
			$_data['hot_arr'] = $hot_arr;
			$_data['code'] = $code;
			$_data['current_nav'] = "aboutus";
			$_data['nav_category'] = $nav_category;
			$this->view('message',$_data);
		}
	}
	
	//联系方式～弹出框
	public function ajax_ifram(){
		$cid = trim($this->input->get('cid'));
		$tpl = 'ajax_ifram1';
		$_data = array();
		
		switch($cid) {
			case '1':
				$tpl = 'ajax_ifram1';
				break;
			case '2':
				$tpl = 'ajax_ifram2';
				break;
			case '3':
				$tpl = 'ajax_ifram3';
				break;
			case '4':
				$tpl = 'ajax_ifram4';
				break;
			case '5':
				$tpl = 'ajax_ifram5';
				break;	
			default://默认为base
				$tpl = 'ajax_ifram1';
		}
		$this->view($tpl,$_data);
	}
}