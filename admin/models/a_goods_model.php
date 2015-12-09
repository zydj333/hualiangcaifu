<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_goods_model extends MY_model {
    /**
     * 商品分页构造函数
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
 		parent::__construct();
    }
	//商品列表分页
	public function get_goods_search($data){
	    
		$where = 'g.sts=0';
		if(!empty($data['goods_name'])) $where .= ' and  g.goods_name like \'%'.$this->_db_read->escape_str($data['goods_name']).'%\'';
		if(isset($data['goods_show']) && is_numeric($data['goods_show'])) $where .= ' and  g.goods_show = '.intval($data['goods_show']);
		if(!empty($data['brand_id'])) $where .= ' and  g.brand_id = '.intval($data['brand_id']);
		if(!empty($data['goods_category'])) $where .= ' and  g.gc_id = '.intval($data['goods_category']);
		if(isset($data['goods_state']) && is_numeric($data['goods_state'])) $where .= ' and  g.goods_state = \''.$this->_db_read->escape_str($data['goods_state']).'\'';
		if (!empty($data['start_price']) && !empty($data['end_price'])) {
			if ($data['start_price'] == $data['end_price']) {
				$where .= ' and  g.goods_shop_price = '.floatval($data['start_price']);
			}else {
				$where .= ' and  g.goods_shop_price >= '.floatval($data['start_price']);
				$where .= ' and  g.goods_shop_price <= '.floatval($data['end_price']);
			}
		}elseif (!empty($data['start_price']) && empty($data['end_price'])) {
			$where .= ' and  g.goods_shop_price >= '.floatval($data['start_price']);
		}elseif (empty($data['start_price']) && !empty($data['end_price'])) {
			$where .= ' and  g.goods_shop_price <= '.floatval($data['end_price']);
		}
	
		$sql_data['table']='goods as g';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' g.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' g.goods_listorder desc,g.goods_add_time desc';

		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	public function get_goods_search1($data){
	    
		$where = 'g.sts=0';
		if(!empty($data['goods_name'])) $where .= ' and  g.goods_name like \'%'.$this->_db_read->escape_str($data['goods_name']).'%\'';
		if(isset($data['goods_show']) && is_numeric($data['goods_show'])) $where .= ' and  g.goods_show = '.intval($data['goods_show']);
		if(!empty($data['brand_id'])) $where .= ' and  g.brand_id = '.intval($data['brand_id']);
		if(!empty($data['goods_category'])) $where .= ' and  g.gc_id = '.intval($data['goods_category']);
		if(isset($data['goods_state']) && is_numeric($data['goods_state'])) $where .= ' and  g.goods_state = \''.$this->_db_read->escape_str($data['goods_state']).'\'';
		if (!empty($data['start_price']) && !empty($data['end_price'])) {
			if ($data['start_price'] == $data['end_price']) {
				$where .= ' and  g.goods_shop_price = '.floatval($data['start_price']);
			}else {
				$where .= ' and  g.goods_shop_price >= '.floatval($data['start_price']);
				$where .= ' and  g.goods_shop_price <= '.floatval($data['end_price']);
			}
		}elseif (!empty($data['start_price']) && empty($data['end_price'])) {
			$where .= ' and  g.goods_shop_price >= '.floatval($data['start_price']);
		}elseif (empty($data['start_price']) && !empty($data['end_price'])) {
			$where .= ' and  g.goods_shop_price <= '.floatval($data['end_price']);
		}
	
		$sql_data['table']='goods as g';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' g.goods_id, g.goods_name, g.goods_shop_price, g.goods_image, s.spec_goods_spec, s.spec_id, s.spec_goods_serial, s.spec_goods_price, s.spec_goods_storage ';
		$sql_data['where']=$where;
		$sql_data['join'] = 'left join goods_spec as s on s.goods_id = g.goods_id';
		$sql_data['orderby']=' g.goods_add_time desc';

		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//违规下架商品分页
	public function get_goodsup_search($data){
	   
	    $where = 'g.sts=0 and g.goods_state=1';
		if(!empty($data['goods_name'])) $where .= ' and  g.goods_name like \'%'.$this->_db_read->escape_str($data['goods_name']).'%\'';
		if(!empty($data['brand_id'])) $where .= ' and  g.brand_id = '.intval($data['brand_id']);
		if(!empty($data['goods_category'])) $where .= ' and  g.gc_id = '.intval($data['goods_category']);
		if(!empty($data['shop_id'])) $where .= ' and  g.shop_id in(0'.$this->_db_read->escape_str($data['shop_id']).')';

		$sql_data['table']='goods as g';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' g.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' g.goods_add_time desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//分类分页
	public function get_category_search($data){
	    
		$where = 'gc.parent_id=0';

		$sql_data['table']='goods_category as gc';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' gc.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' gc.listorder asc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//分类TGA分页
	public function get_categorytga_search($data){     
		
		$sql_data['table']='goods_category_tag as gct';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' gct.* ';
		$sql_data['orderby']=' gct.gc_tag_id asc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//类型分页
	public function get_type_search($data){ 
        
		$sql_data['table']='type as t';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' t.* ';
		$sql_data['orderby']=' t.listorder asc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//类型属性管理分页
	public function get_typevalue_search($data){ 
	    
		$where = 'at.sts=0';
		if(!empty($data['type_id'])) $where .= ' and  at.type_id = '.intval($data['type_id']);

		$sql_data['table']='attribute as at';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' at.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' at.listorder asc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//品牌分页
	public function get_brand_search($data){ 
	    
		$where = 'b.sts=0';

		$sql_data['table']='brand as b';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' b.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' b.listorder asc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//规格分页
	public function get_spec_search($data){
	    
		$sql_data['table']='spec as s';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' s.* ';
		$sql_data['orderby']=' s.listorder desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//推荐类型分页
	public function get_recommend_search($data){
	    
		$where = 'r.sts=0';

		$sql_data['table']='recommend as r';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' r.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' r.recommend_id desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//推荐商品分页
	public function get_recommendgoods_search($data){
	    
		$where = 'rg.sts=0';
		if(!empty($data['recommend_id'])) $where .= ' and  rg.recommend_id = '.intval($data['recommend_id']);

		$sql_data['table']='recommend_goods as rg';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' rg.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' rg.sort asc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
 }