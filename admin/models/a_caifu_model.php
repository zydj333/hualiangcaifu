<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * 系统相关设置相关模型类
 */
class a_caifu_model extends MY_model {
	/**
	 * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
 		parent::__construct();
 		$this->_tablename='sys_menu';
		$this->_rolename ='sys_role_priv';
    }
    
    /**
	 *	财富产品---并分页
	 */
    public function get_product_search($data)
    {

		$sql_data['table']='caifu_product';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' * ';
	//	$sql_data['where']=$where;
		$sql_data['orderby']=' post_time desc ';

		$res=$this->get_search_page($sql_data);
		return $res;

    }
    
    /**
	 *	财富积分---并分页
	 */
    public function get_points_search($data)
    {

		$sql_data['table']='caifu_points';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' * ';
	//	$sql_data['where']=$where;
		$sql_data['orderby']=' post_time desc ';

		$res=$this->get_search_page($sql_data);
		return $res;

    }
    
    /**
	 *	报单订单---并分页
	 */
    public function get_order_search($data)
    {

		$sql_data['table']='caifu_order as o left join db_caifu_product as p on o.product_id=p.id';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.*,p.name as product_name ';
	//	$sql_data['where']=$where;
		$sql_data['orderby']='o.post_time desc ';

		$res=$this->get_search_page($sql_data);
		return $res;

    }
    
    /**
	 *	积分订单---并分页
	 */
    public function get_orderpoints_search($data)
    {

		$sql_data['table']='caifu_orderpoints as o left join db_caifu_points as p on o.product_id=p.id';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.*,p.name as product_name ';
	//	$sql_data['where']=$where;
		$sql_data['orderby']='o.post_time desc ';

		$res=$this->get_search_page($sql_data);
		return $res;

    }
    
     /**
	 *	积分订单---并分页
	 */
    public function get_orderreserve_search($data)
    {

		$sql_data['table']='caifu_reserve as o left join db_caifu_product as p on o.product_id=p.id';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.*,p.name as product_name ';
	//	$sql_data['where']=$where;
		$sql_data['orderby']='o.post_time desc ';

		$res=$this->get_search_page($sql_data);
		return $res;

    }
    
    /**
	 		*	数据字典---并分页
	 		*/
    public function get_dictionary_search($data)
    {
    	$where =' sts=0 ';
			if(!empty($data['search_tbname'])){
				$where .= ' and table_name like \'%'.$this->_db_read->escape_str($data['search_tbname']).'%\'';
			}
			if(!empty($data['search_colname'])){
				$where .= ' and column_name like \'%'.$this->_db_read->escape_str($data['search_colname']).'%\'';
			}
			if(!empty($data['search_colvalue'])){
				$where .= ' and column_value like \'%'.$this->_db_read->escape_str($data['search_colvalue']).'%\'';
			}
			
			$sql_data['table']='sys_dictionary';
			$sql_data['page']=$data['page'];
			$sql_data['pagesize']=$data['pagesize'];
			$sql_data['fields']=isset($data['fields'])?$data['fields']:' * ';
	  	$sql_data['where']=$where;
			$sql_data['orderby']='table_name asc,listorder desc ';

			$res=$this->get_search_page($sql_data);
			return $res;

    }
    
    //获取数据字典内容
    public function get_dictionary_list($tablename,$columnname){
    	$res = $this->get_query("sts = 0 AND table_name='".$tablename."' and column_name='".$columnname."' order by listorder asc",'sys_dictionary', array('id','column_title', 'column_value'));
			
			return $res;
    }
    
    //获取数据字典某个字段为某个值时的标题
    public function get_dict_column_title($tablename,$columnname,$columnvalue){
    	$res = $this->get_one(array('sts' => 0,'table_name' => $tablename,'column_name' => $columnname,'column_value' => $columnvalue),'sys_dictionary');
			$cname = $res['column_title'];
			
			return $cname;
    }
}