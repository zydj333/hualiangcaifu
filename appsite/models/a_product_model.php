<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_product_model extends MY_model {
   
    public function __construct()
    {
 		parent::__construct();
    }
    
    public function get_products_list111($data){
    	$where = 'g.sts=0 ';
    	if (!empty($data['gcid'])) {
    		$where .= ' AND g.gc_id = '.intval($data['gcid']);
    	}
    	if (!empty($data['iscommend'])){
    		$where .= ' AND goods_commend=1';
    	}
    	$sql_data['orderby'] = 'g.goods_starttime DESC';
    	$sql_data['table']='goods as g';
			$sql_data['page']= isset($data['page']) ? $data['page'] : 1;
			$sql_data['pagesize']=isset($data['pagesize']) ? $data['pagesize'] : 30;
			$sql_data['fields']=isset($data['fields'])?$data['fields']:' g.goods_id, g.spec_id, g.goods_name, g.goods_english, g.goods_image, g.goods_shop_price, g.goods_market_price, g.goods_words, g.goods_serial, g.commentgood, g.commentnum,g.commentscore, g.salenum, g.goods_attr';
			$sql_data['where']=$where;
			$res=$this->get_search_page($sql_data);
			
			return $res;
    }
    
    //产品列表
    public function getProductsList($data) {
    	$where = 'g.sts=0 and g.goods_show = 1 AND g.goods_state = 0 ';
			if(!empty($data['cateid'])){
				$cateid = $data['cateid'];
    		$cateids_str = $cateid;
    		//获取子分类ID
    		$goods_subcate = $this->a_product_model->get_query(array('parent_id'=>$cateid, 'isshow'=>1, 'order_by'=>'listorder asc'), 'goods_category');
    		foreach($goods_subcate as $k => $v){
    			$cateids_str .=  ','.$v['gc_id'];
    		}
		   	$where .= ' and gc_id IN ('.$cateids_str.') ';
			}

    	$sql_data['table'] = 'goods as g';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'g.*';
    	$sql_data['orderby'] = 'g.goods_listorder ASC,g.goods_add_time DESC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	
    	return $res;
    }
		//首页产品显示
		public function get_indexproducts(){
			$res = $this->a_product_model->get_query("sts = 0 AND goods_commend=1 and goods_show = 1 AND goods_state = 0 LIMIT 10",'goods', array('goods_id', 'goods_name', 'goods_image', 'goods_shop_price', 'goods_market_price'));
			
			return $res;
		}
    //产品中心左部产品分类及产品
    public function get_subproductslist($data){
    	$goods_cate = $this->a_product_model->get_query(array('parent_id'=>0, 'isshow'=>1, 'order_by'=>'listorder asc'), 'goods_category');
    	foreach($goods_cate as $k => $v){
    		$cateid = $v['gc_id'];
    		$cateids_str = $cateid;
    		//获取子分类ID
    		$goods_subcate = $this->a_product_model->get_query(array('parent_id'=>$cateid, 'isshow'=>1, 'order_by'=>'listorder asc'), 'goods_category');
    		foreach($goods_subcate as $k => $v){
    			$cateids_str .=  ','.$v['gc_id'];
    		}
    		//获取该分类下的产品
    	  $goods_list = $this->a_product_model->get_query("gc_id IN ($cateids_str) AND sts = 0 AND goods_show = 1 AND goods_commend = 1 LIMIT 10",'goods', array('goods_id', 'goods_name', 'goods_image', 'goods_shop_price', 'goods_market_price'));
    		$goods_cate[$k]['goods_list'] = $goods_list;
    	}

    	return $goods_cate;
    }
    
    //导航分类下不产品分类及产品
    public function get_navproductslist($data){
    	$goods_cate = $this->a_product_model->get_query(array('parent_id'=>0, 'isshow'=>1, 'order_by'=>'listorder asc'), 'goods_category');
    	foreach($goods_cate as $k => $v){
    		$cateid = $v['gc_id'];
    		$cateids_str = $cateid;
    		//获取子分类ID
    		$goods_subcate = $this->a_product_model->get_query(array('parent_id'=>$cateid, 'isshow'=>1, 'order_by'=>'listorder asc'), 'goods_category');
    		foreach($goods_subcate as $kk => $vv){
    			$cateids_str .=  ','.$vv['gc_id'];
    		}
    		//获取该分类下的产品
    	  $goods_list = $this->a_product_model->get_query("gc_id IN ($cateids_str) AND sts = 0 AND goods_show = 1 AND goods_commend = 1 LIMIT 10",'goods', array('goods_id', 'goods_name', 'goods_image', 'goods_shop_price', 'goods_market_price','goods_body'));
    		$goods_cate[$k]['goods_list'] = $goods_list;

    		//获取子分类ID
//    		$goods_subcate = $this->a_product_model->get_query(array('parent_id'=>$cateid, 'isshow'=>1, 'order_by'=>'listorder asc'), 'goods_category');
//    		if(empty($goods_subcate)){
//    			$goods_cate[$k]['subcate_list'] = array();
////    			$goods_cate[$k]['subcate_list']['']
////    			//获取该分类下的产品
//    	  	$goods_list = $this->a_product_model->get_query("gc_id IN ($cateid) AND sts = 0 AND goods_show = 1 AND goods_state = 0 LIMIT 5",'goods', array('goods_id', 'goods_name', 'goods_image', 'goods_shop_price', 'goods_market_price'));
//    			$goods_cate[$k]['subcate_list']['goods_list'] = $goods_list;
//    		} else {
//    			$goods_cate[$k]['subcate_list'] = $goods_subcate;
//    			foreach($goods_subcate as $kk => $vv){
//    				$cateids_str .=  $vv['gc_id'];
//    				//获取该分类下的产品
//    	  		$goods_list = $this->a_product_model->get_query("gc_id IN ($cateids_str) AND sts = 0 AND goods_show = 1 AND goods_state = 0 LIMIT 5",'goods', array('goods_id', 'goods_name', 'goods_image', 'goods_shop_price', 'goods_market_price'));
//    				$goods_cate[$k]['subcate_list']['goods_list'] = $goods_list;
//    			}
//    		}
    	}
    	
    	return $goods_cate;
    }
    
    //取限时折扣
    public function getDiscountGoodsList($data) {
    	$where = 'p.sts = 0 AND p.is_close = 1 AND p.`type` = 1 AND p.start_time <= NOW() AND p.end_time > NOW()';
    	$sql_data['table'] = 'promotion as p';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields'])?$data['fields']:'p.*, g.goods_id, g.goods_english, g.goods_name, g.goods_shop_price, g.goods_image, s.spec_id, s.xianshi_discount';
    	$sql_data['orderby'] = 'p.start_time ASC';
    	$sql_data['where']=$where;
    	$sql_data['join'] = 'LEFT JOIN goods as g on g.goods_id = p.promotion_condition LEFT JOIN goods_spec as s ON s.spec_id = p.promotion_condition1';
    	$res=$this->get_search_page($sql_data);
    	return $res;
    	
    }

 }