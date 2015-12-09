<?php

class News extends Site_Controller {

    private $tb_article = 'article';
    private $tb_article_cate = 'article_category';
    private $tb_document = 'document';

    public function __construct() {
        parent::__construct();
        $this->load->model('a_article_model');
        $this->load->model('a_caifu_model');
        $this->load->model('a_com_model');
    }

    //新闻列表
    public function lists() {
        $cid = $this->input->get('cid');
        //导航及数量
        $nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'category');
        foreach ($nav_category as $key => $val) {
            $cateid = $val['column_value'];
            $where = array('category' => $cateid);
            $con = $this->a_caifu_model->count($where, 'caifu_product');
            $nav_category[$key]['numbs'] = intval($con);
        }
        //分类基本信息
        $cate_info = $this->a_article_model->get_one(array('ac_id' => $cid), 'article_category');

        $page = $this->input->get('page');
        $page = intval($page) > 0 ? $page : 1;

        $sel['cateid'] = $cid;
        $sel['page'] = $page;
        $sel['pagesize'] = 10;
        $list = $this->a_com_model->getNewsList($sel);
        $_data['list'] = $list['list'];
        $_data['page'] = $list['page'];

        //网站基本设置
        $setup_setting = getcache('setup', 'commons');
        $hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
        $hot_arr = array();
        if (!empty($hot_search)) {
            $hot_arr = explode(",", $hot_search);
        }
        $_data['hot_arr'] = $hot_arr;
        $this->seo_title = empty($cate_info['ac_name']) ? $cate_info['ac_name'] . " - " . $setup_setting['site_title'] : $cate_info['ac_name'] . " - " . $setup_setting['site_title'];

        $_data['cid'] = $cid;
        $_data['cate_info'] = $cate_info;
        $_data['current_nav'] = "help";
        $_data['nav_category'] = $nav_category;
        $this->view('news_list', $_data);
    }

    //新闻---详细
    public function detail() {
        $id = $this->input->get('id');
        //导航及数量
        $nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'category');
        foreach ($nav_category as $key => $val) {
            $cateid = $val['column_value'];
            $where = array('category' => $cateid);
            $con = $this->a_caifu_model->count($where, 'caifu_product');
            $nav_category[$key]['numbs'] = intval($con);
        }

        $article_info = $this->a_article_model->get_one(array('article_id' => $id), 'article');
        $dot = $article_info['dot'];
        $dot += 1;
        $this->load->model('article');
        $this->article->update(array('article_id' => $id), array('dot' => $dot), 'article');
        $_data['article_info'] = $article_info;
        //分类基本信息
        $cate_info = $this->a_article_model->get_one(array('ac_id' => $article_info['ac_id']), 'article_category');
        //网站基本设置
        $setup_setting = getcache('setup', 'commons');
        $hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
        $hot_arr = array();
        if (!empty($hot_search)) {
            $hot_arr = explode(",", $hot_search);
        }
        $_data['hot_arr'] = $hot_arr;
        $this->seo_title = empty($article_info['article_title']) ? '新闻中心 - ' . $setup_setting['site_title'] : $article_info['article_title'] . $setup_setting['site_title'];
        $_data['cate_info'] = $cate_info;
        $_data['current_nav'] = "help";
        $_data['nav_category'] = $nav_category;
        $this->view('news_detail', $_data);
    }

}
