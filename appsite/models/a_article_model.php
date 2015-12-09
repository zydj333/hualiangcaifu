<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_article_model extends MY_model {

    public function __construct()
    {
 		parent::__construct();
    }
    //获取文章列表
    public function getArticleSearch($data){
    	$where=' o.sts=0 and o.article_show=1';

		if(isset($data['amount_from']) && !empty($data['amount_from'])) $where.= ' and o.goods_shop_price >='.intval($data['amount_from']);
		if(isset($data['amount_to']) && !empty($data['amount_to'])) $where.= ' and o.goods_shop_price <='.intval($data['amount_to']);

		$sql_data['table']='goods as o';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.* ';
		$sql_data['where']=$where;

		$sql_data['orderby']=' o.goods_add_time desc';

		$res=$this->get_search_page($sql_data);
		return $res;
    }
    
    
    public function get_article_list($data) {
    	$cateid = empty($data['cid']) ? 1 : $data['cid'];
    	$article_list = $this->get_query(array('sts' => 0,'ac_id' => $cateid,'code_type' => 'news','article_show' => 1,'order_by' => 'listorder ASC', 'limit' => 5), 'article');
    	return $article_list;
    }
    
    public function get_article_index() {
    	$article_list = $this->get_query(array('sts' => 0,'code_type' => 'news','isrecommend' => 1,'article_show' => 1,'order_by' => 'article_time desc', 'limit' => 1), 'article');
    	return $article_list;
    }
    
    public function get_links_list() {
    	$link_list = $this->get_query(array('link_pass' => 0,'order_by' => 'listorder ASC', 'limit' => 15), 'link');
    	return $link_list;
    }
 }