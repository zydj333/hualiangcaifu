<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_caifu_model extends MY_model {
   
    public function __construct()
    {
 		parent::__construct();
    }
    
    public function get_product_index($data) {
    	$cateid = empty($data['cid']) ? 1 : $data['cid'];
    	
    	$res = $this->get_query("isshow = 1 AND iscommend=1 and category='$cateid' LIMIT 5",'db_caifu_product');
    	foreach($res as $key => $val){
    		$res[$key]['interest_name'] = $this->get_dict_column_title ('db_caifu_product','interest',$val['interest']);
    		$res[$key]['investment_name'] = $this->get_dict_column_title ('db_caifu_product','investment',$val['investment']);
    	}
			
			return $res;
    }
    
    //产品列表
    public function getProductsList($data) {
    	$where = 'g.isshow = 1';
    	if (!empty($data['search_title'])) {
    		$where .= ' and g.name like \'%'.$this->_db_read->escape_str($data['search_title']).'%\' ';
    	}
    	if (!empty($data['s_title'])) {
    		$where .= ' and g.name like \'%'.$this->_db_read->escape_str($data['s_title']).'%\' ';
    	}
			if (!empty($data['cpzt'])) {
    		$where .= ' AND g.status = '.intval($data['cpzt']);
    	}
    	if (!empty($data['cpxl'])) {
    		$where .= ' AND g.category = '.intval($data['cpxl']);
    	}
    	if (!empty($data['cpqx'])) {
    		list($down,$up) = explode("-", $data['cpqx']);
    		$down = empty($down) ? 0 : $down;
    		$up 	= empty($up) ? 0 : $up;
    		$where .= ' AND g.lifetime >= '.intval($down).' AND g.lifetime <= '.intval($up);
    	}
    	if (!empty($data['fxfy'])) {
    		$where .= ' AND g.expenses_area = '.intval($data['fxfy']);
    	}
    	if (!empty($data['syl'])) {
    		$where .= ' AND g.yield = '.intval($data['syl']);
    	}
    	if (!empty($data['fxfs'])) {
    		$where .= ' AND g.interest = '.intval($data['fxfs']);
    	}
    	if (!empty($data['tzly'])) {
    		$where .= ' AND g.investment = '.intval($data['tzly']);
    	}
    	if (!empty($data['szqy'])) {
    		$where .= ' AND g.area = '.intval($data['szqy']);
    	}
    	if (!empty($data['dxpb'])) {
    		$where .= ' AND g.size = '.intval($data['dxpb']);
    	}
			
    	$sql_data['table'] = 'caifu_product as g';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'g.*';
    	$sql_data['orderby'] = 'g.listorder DESC,g.post_time DESC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	
    	return $res;
    }
    
     //积分列表
    public function getPointsList($data) {
    	$where = 'g.status = 0';

    	$sql_data['table'] = 'caifu_points as g';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'g.*';
    	$sql_data['orderby'] = 'g.listorder DESC,g.post_time DESC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	
    	return $res;
    }
    
    //获取数据字典某个字段为某个值时的标题
    public function get_dict_column_title($tablename,$columnname,$columnvalue){
    	$res = $this->get_one(array('sts' => 0,'table_name' => $tablename,'column_name' => $columnname,'column_value' => $columnvalue),'sys_dictionary');
			$cname = empty($res['column_title']) ? '' : $res['column_title'];
			
			return $cname;
    }
    
    //获取数据字典内容
    public function get_dictionary_list($tablename,$columnname){
    	$res = $this->get_query("sts = 0 AND table_name='".$tablename."' and column_name='".$columnname."' order by listorder asc",'sys_dictionary', array('id','column_title', 'column_value'));
			
			return $res;
    }
 }