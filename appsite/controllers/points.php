<?php
class Points extends Site_Controller {

	private $tb_goods = 'goods';
	private $tb_goods_cate = 'goods_category';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_com_model');
		$this->load->model('a_caifu_model');
		$this->load->model('consult_buy');
	}

	//产品列表
	public function lists()
	{
		$cid=$this->input->get('cid');
		$_data = array();
		//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		//分类基本信息
		$cate_info = $this->a_caifu_model->get_one(array('gc_id' => $cid),'goods_category');
		
		$page=$this->input->get('page');
		$page=intval($page) > 0 ? $page : 1;

		$sel['cateid'] = $cid;
		$sel['page'] = $page;
	  $sel['pagesize'] = 10;
		$list = $this->a_caifu_model->getPointsList($sel);
	  $_data['list'] = $list['list'];
	  $_data['page'] = $list['page'];
		$_data['current_nav'] = "points";
		$_data['nav_category'] = $nav_category;
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$this->seo_title = "产品中心 - ".$setup_setting['site_title'];
		$_data['cateid'] = $cid;
		$_data['hot_arr'] = $hot_arr;
		$this->view('points_list',$_data);
	}
	
	//产品---详细
	public function detail()
	{
		$id = $this->input->get('id');
			//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
			
		$points_info = $this->a_caifu_model->get_one(array('id' => $id),'db_caifu_points');
		
		$_data['points_info'] = $points_info;
		$_data['current_nav'] = "points";
		$_data['nav_category'] = $nav_category;
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$_data['hot_arr'] = $hot_arr;
		$this->seo_title = $points_info['name']." - ".$setup_setting['site_title'];
		$this->view('points_detail',$_data);
	}
	

}