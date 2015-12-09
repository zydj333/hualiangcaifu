<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_com_model extends MY_model {
   
    public function __construct()
    {
 		parent::__construct();
    }
    
    //图文列表
    public function getGraphicList($data) {
    	$where = 'g.isshow = 0 ';
			if(!empty($data['cateid'])){
		   	$where .= ' and g.pic_category = '.$data['cateid'];
			} 
    	
    	$sql_data['table'] = 'graphic as g';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'g.*';
    	$sql_data['orderby'] = 'g.listorder ASC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	
    	return $res;
    }
    
    //新闻列表
    public function getNewsList($data) {
    	$where = 'g.sts=0 and g.article_show = 1 ';
			if(!empty($data['cateid'])){
		   	$where .= ' and g.ac_id = '.$data['cateid'];
			} 
    	
    	$sql_data['table'] = 'article as g';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'g.*';
    	$sql_data['orderby'] = 'g.article_time DESC,g.listorder ASC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	
    	return $res;
    }
    //新闻中心分类列表
    public function getnewscatelist(){
    	$res_list = $this->get_query(array('ac_code' => 'news','parent_id' => 1,'order_by' => 'listorder ASC'), 'article_category');
    	return $res_list;
    }
    
    //研修培训分类列表
    public function getresearchcatelist(){
    	$res_list = $this->get_query(array('ac_code' => 'news','parent_id' => 2,'order_by' => 'listorder ASC'), 'article_category');
    	return $res_list;
    }
    
    //成功案列分类列表
    public function getcasecatelist(){
    	$res_list = $this->get_query(array('ac_code' => 'help','parent_id' => 0,'order_by' => 'listorder ASC'), 'article_category');
    	return $res_list;
    }
    
    //图文管理分类列表
    public function getgraphiccatelist(){
    	$res_list = $this->get_query(array('order_by' => 'listorder ASC'), 'graphic_category');
    	return $res_list;
    }
    
    //新闻列表~搜索
    public function getNewsSearch($data) {
    	$where = 'g.sts=0 and g.article_show = 1 ';
			if(!empty($data['keywords'])){
				$where .=  ' and  g.article_title like \'%'.$this->_db_read->escape_str($data['keywords']).'%\'';
			}
    	
    	$sql_data['table'] = 'article as g';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'g.*';
    	$sql_data['orderby'] = 'g.article_time DESC,g.listorder ASC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	
    	return $res;
    }
    
    //产品列表~搜索
    public function getProductsSearch($data) {
    	$where = 'g.sts=0 and g.goods_show = 1 AND g.goods_state = 0 ';
			if(!empty($data['keywords'])){
				$where .=  ' and  g.goods_name like \'%'.$this->_db_read->escape_str($data['keywords']).'%\'';
			}

    	$sql_data['table'] = 'goods as g';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'g.*';
    	$sql_data['orderby'] = 'g.goods_add_time DESC,g.goods_listorder ASC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	
    	return $res;
    }
    
    //产品购买咨询列表
    public function getConsultBuyList($data) {
    	$where = 'g.type_id=1 ';
			if(!empty($data['goodsid'])){
		   	$where .= ' and g.goods_id = '.$data['goodsid'];
			} 
    	
    	$sql_data['table'] = 'consult_buy as g';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 10;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'g.*';
    	$sql_data['orderby'] = 'g.consult_addtime DESC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	
    	return $res;
    }
 }