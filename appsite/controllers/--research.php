<?php
class Research extends Site_Controller {

	private $tb_article = 'article';
	private $tb_article_cate = 'article_category';
	private $tb_document = 'document';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_article_model');
		$this->load->model('a_com_model');
	}

	//研究培训
	public function lists()
	{
		$cid=$this->input->get('cid');
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
		$this->seo_title = empty($cate_info['ac_name']) ? '研修/培训 - '.$setup_setting['site_title'] : $cate_info['ac_name']." - ".$setup_setting['site_title'];
		
		$_data['cid'] = $cid;
		$_data['cate_info'] = $cate_info;
		$this->view('research_list',$_data);
	}
	
	//研修培训---详细
	public function detail()
	{
		$id = $this->input->get('id');

		$article_info = $this->a_article_model->get_one(array('article_id' => $id),'article');
		$dot = $article_info['dot'];
		$dot += 1;
		$this->load->model('article');
		$this->article->update(array('article_id' => $id),array('dot' => $dot),'article');
		$_data['article_info']=$article_info;
		//分类基本信息
		$cate_info = $this->a_article_model->get_one(array('ac_id' => $article_info['ac_id']),'article_category');
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['article_title']) ? '研修/培训 - '.$setup_setting['site_title'] : $article_info['article_title']." - ".$setup_setting['site_title'];
		$_data['cate_info'] = $cate_info;
		$this->view('research_detail',$_data);
	}
	
	//站内搜索
	public function sosuo(){
		$keywords = $this->input->get('keywords');
		$data = array();
		
		$page=$this->input->get('page');
		$page=intval($page) > 0 ? $page : 1;

		$sel['page'] = $page;
	  $sel['pagesize'] = 10;
	  $sel['keywords'] = $keywords;
		$list_news = $this->a_com_model->getNewsSearch($sel);
		$list_products = $this->a_com_model->getProductsSearch($sel);
	  $data['search_news'] = $list_news['list'];
	  $data['search_news_page'] = $list_news['page'];
		$data['search_products'] = $list_products['list'];
		$data['search_products_page'] = $list_products['page'];
		$data['keywords'] = $keywords;
		
		$this->seo_title = '信息搜索';
		$this->view('research_sosuo',$data);
	}

}