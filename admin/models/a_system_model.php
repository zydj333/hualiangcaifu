<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * 系统相关设置相关模型类
 */
class a_system_model extends MY_model {
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
	 *	搜索角色---并分页
	 */
    public function get_role_search($data)
    {
		$where =' r.sts=0';
		if(!empty($data['rolename'])){
			$where.= ' and r.rolename like \'%'.$this->_db_read->escape_str($data['rolename']).'%\' ';
		}

		$sql_data['table']='sys_role as r';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' r.* ';
		$sql_data['where']=$where;

		$res=$this->get_search_page($sql_data);
		return $res;

    }


     /**
	 *	搜索友情链接---并分页
	 */
    public function get_link_search($data)
    {

		$sql_data['table']='link as l';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' l.* ';
	//	$sql_data['where']=$where;
		$sql_data['orderby']=' listorder desc ';

		$res=$this->get_search_page($sql_data);
		return $res;

    }
    
    /**
	 *	搜索图文---并分页
	 */
    public function get_graphic_search($data)
    {

		$sql_data['table']='graphic as l';
		$sql_data['join']=' left join  graphic_category as r on r.lc_id =l.pic_category ';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' l.* ';
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' l.*,r.lc_name ';
	//	$sql_data['where']=$where;
		$sql_data['orderby']=' listorder desc ';

		$res=$this->get_search_page($sql_data);
		return $res;

    }
    
     /**
	 *	搜索项目资金库---并分页
	 */
    public function get_finance_search($data)
    {
		$where =' sts=0';
		if(!empty($data['search_name'])){
			$where.= ' and name like \'%'.$this->_db_read->escape_str($data['search_name']).'%\' ';
		}
		
		$sql_data['table']='finance';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' * ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' listorder asc,add_time desc ';

		$res=$this->get_search_page($sql_data);
		return $res;

    }
    
    /**
	 		*	会员充值---并分页
	 		*/
    public function get_usercharge_search($data)
    {
    	$where =' 1=1 ';
			if(!empty($data['search_name'])){
				$where .= ' and member_name like \'%'.$this->_db_read->escape_str($data['search_name']).'%\' or member_email like \'%'.$this->_db_read->escape_str($data['search_name']).'%\'';
			}
			if(!empty($data['admin_areaids'])) $where .= ' and province_id in ('.$this->_db_read->escape_str($data['admin_areaids']).')';
			if(isset($data['add_time_st']) && !empty($data['add_time_st'])) $where .= ' and add_time >= '.strtotime($data['add_time_st']);
			if(isset($data['add_time_en']) && !empty($data['add_time_en'])) $where .= ' and add_time <= '.strtotime($data['add_time_en'].' 23:59:59');

			$sql_data['table']='user_charge';
			$sql_data['page']=$data['page'];
			$sql_data['pagesize']=$data['pagesize'];
			$sql_data['fields']=isset($data['fields'])?$data['fields']:' * ';
	  	$sql_data['where']=$where;
			$sql_data['orderby']=' add_time desc ';

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
    /**
	 		*	产品价格库---并分页
	 		*/
    public function get_pricelib_search($data)
    {
    	$where =' 1=1 ';
			if(!empty($data['search_cateid'])){
				$where .= ' and cateid ='.$this->_db_read->escape_str($data['search_cateid']);
			}

			$sql_data['table']='goods_price_library';
			$sql_data['page']=$data['page'];
			$sql_data['pagesize']=$data['pagesize'];
			$sql_data['fields']=isset($data['fields'])?$data['fields']:' * ';
	  	$sql_data['where']=$where;
			$sql_data['orderby']=' listorder desc ';

			$res=$this->get_search_page($sql_data);
			return $res;

    }
		
		//留言列表
    public function get_message_search($data){
    	$where = '1';
			if(!empty($data['search_title'])) $where .= ' and  c.content like \'%'.$this->_db_read->escape_str($data['search_title']).'%\'';
        
			$sql_data['table']='message as c';
			$sql_data['page']=$data['page'];
			$sql_data['pagesize']=$data['pagesize'];
			$sql_data['fields']=isset($data['fields'])?$data['fields']:' c.* ';
			$sql_data['where']=$where;

			$res=$this->get_search_page($sql_data);
			return $res;
    }
    /**
     *	系统管理员搜索站点---并分页
	 */
    public function get_admini_search($data)
    {

    	$where =' a.sts=0';
		if(!empty($data['username'])){
			$where.= ' and a.username like \'%'.$this->_db_read->escape_str($data['username']).'%\' ';
		}


    	$sql_data['table']='sys_admini as a';
    	$sql_data['join']=' left join  sys_role as r on r.id=a.role_id ';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' a.*,r.rolename ';
		$sql_data['where']=$where;


		$res=$this->get_search_page($sql_data);
		return $res;

    }

    /**
	 * 删除菜单/权限
	 */
    public function del_menu_in($ids)
    {
    	 return $this->_db_write-> delete('sys_menu', 'id in ('.$ids.')');
    }

    /**
	 * 获取角色和菜单权限
	 */
    public function get_role_menu($roleid){
		$this->load->library('iquery');
		$this->iquery->initialize('sys_role_priv as r',$this->getTablePre());
		$this->iquery->fields='m.*';
		$this->iquery->join=' left join  sys_menu as m on r.menu_id=m.id';
		$this->iquery->where='m.isshow=1 and r.role_id='.$roleid;
		$this->iquery->order='listorder asc';
		$list_sql= $this->iquery->query_list();


		$list=$this->_db_read->query($list_sql)->result_array();
		return $list;
    }
    
    /**
	 * 获取子节点列表
	 * @Param $parentid	父节点
	 * @Param $siteid	站点ID
	 * @Param $display	是否显示
	 * 返回子节点列表
	 */
    public function get_menu_list($data)
    {
    	 $list = array();
		
			//$role_arr = $this->_db_read->select('menu_id')->from($this->_rolename);
			//$result = $this->_db_read->query('select m.* from db_sys_role_priv as r left join db_sys_menu as m on r.menu_id=m.id where r.role_id='.$data['roleid']);
 		 //$result=$this->_db_read->select($this->_tablename.'.*')->from($this->_tablename);
 		 $result=$this->_db_read->select($this->_tablename.'.*,'.$this->_rolename.'.role_id')->from($this->_rolename)->join($this->_tablename,$this->_rolename.'.menu_id='.$this->_tablename.'.id','left');
 		 if(isset($data['parent_id']))
    	 {
			 $result=$result->where('parent_id',intval($data['parent_id']));
    	 }
    	if(isset($data['roleid']))
    	{
			 $result=$result->where('role_id',intval($data['roleid']));
    } 
 		 //判断站点ID
 		 if(isset($data['site_id']) && intval($data['site_id']) > 0 )
 		 {
 		 	$result=$result->where('site_id',intval($data['site_id']));
 		 }
 		 //判断过滤是否显示
 		 if(isset($data['isshow']) && intval($data['isshow']) > 0 )
 		 {
 		 	$result=$result->where('isshow',intval($data['display']));
 		 }
 		 $result=$result->order_by('listorder')->get();

		 if ($result->num_rows() > 0)
		 {
		      $list = $result->result_array();
		 }
		 //echo $this->_db_read->last_query();
    	 return $list;
    }
    //获取数据字典内容
    public function get_dictionary_list($tablename,$columnname){
    	$res = $this->get_query("sts = 0 AND table_name='".$tablename."' and column_name='".$columnname."' order by listorder desc",'sys_dictionary', array('id','column_title', 'column_value'));
			
			return $res;
    }
    
    //获取数据字典某个字段为某个值时的标题
    public function get_dict_column_title($tablename,$columnname,$columnvalue){
    	$res = $this->get_one(array('sts' => 0,'table_name' => $tablename,'column_name' => $columnname,'column_value' => $columnvalue),'sys_dictionary');
			$cname = $res['column_title'];
			
			return $cname;
    }
}