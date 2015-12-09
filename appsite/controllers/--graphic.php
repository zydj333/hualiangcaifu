<?php
class Graphic extends Site_Controller {

	private $tb_article = 'article';
	private $tb_article_cate = 'article_category';
	private $tb_document = 'document';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_article_model');
		$this->load->model('a_com_model');
	}

	//图文列表
	public function lists()
	{
		$code = "";
		$code_title = "";
		$cid=$this->input->get('cid');
		$code = $cid;
		$code_info = $this->a_com_model->get_one(array('lc_id' => $cid),'graphic_category');
		$code_title = empty($code_info) ? "暂无分类" : $code_info['lc_name'];
		
		$page=$this->input->get('page');
		$page=intval($page) > 0 ? $page : 1;

		$sel['cateid'] = $cid;
		$sel['page'] = $page;
	  $sel['pagesize'] = 12;
		$list = $this->a_com_model->getGraphicList($sel);
	  $_data['list'] = $list['list'];
	  $_data['page'] = $list['page'];
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$this->seo_title = empty($article_info['doc_title']) ? $code_title." - ".$setup_setting['site_title'] : $code_title." - ".$setup_setting['site_title'];
		
		$_data['code'] = $code;
		$_data['code_title'] = $code_title;
		$this->view('graphic',$_data);
	}
	
	

}