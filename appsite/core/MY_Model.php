<?php

class MY_model extends CI_model
{

	/**
	 * 表前缀
	 */
	private $_tablepre='';

	/**
	 * 表名称
	 */
	public $_tablename='';

	/**
	 * 主键名称
	 */
	public $_pkname='id';
	/**
	 * 数据库名
	 */
	private $_dbname='';

	/**
	 * 默认链接 config中配置文件的default
	 */
	public $_db_read;
	public $_db_write;

	public function __construct()
	{
		parent::__construct();
		$this->_db_read=$this->load->database('default',TRUE);
		$this->_db_write=$this->load->database('gtwo',TRUE);
		$this->setTablePre();
	}


	/**
    * 设置主键名称，默认值为id
    */
	public function setPKName($pk){
		$this->_pkname = empty( $pk ) ? 'id' : $pk;
	}

    /**
     * @brief 取得表前缀
     * @return String 表前缀
     */
    private function setTablePre(){
    	$this->_tablepre=$this->_db_read->dbprefix;
    }
    /**
     * @brief 取得表前缀
     * @return String 表前缀
     */
    public function getTablePre(){
    	return $this->_tablepre;
    }

    	/**
	 * 验证数据库字段：如果$data中的字段在数据库中没有 ，则从$data数组中移除该字段
	 *
	 * @param	Array	The data array to clean
	 * @param	String	Reference table. $this->table if not set.
	 *
	 */
	private function clean_data($data, $table = FALSE)
	{
		$cleaned_data = array();
		if ( ! empty($data))
		{
			$table = ($table !== FALSE) ? $table : $this->_tablename;
			$fields = $this->db->list_fields($table);
			$fields = array_fill_keys($fields,'');
			$cleaned_data = array_intersect_key($data, $fields);
		}
		return $cleaned_data;
	}



	/**
	 * 更新一行数据
	 * @return	int			返回影响的行数
	 */
	public function update($where = NULL, $data = NULL, $table = FALSE)
	{
		$table = (FALSE !== $table) ? $table : $this->_tablename;
		if ( is_array($where) )
		{
			$where_and=$where_in=array();
			foreach($where as $k=>$v){
				if($k == 'where_in'){
					foreach($v as $s_k=>$s_v){$where_in[$s_k]=$s_v;}
				}else{
					$where_and[$k]=$v;
				}
			}
			if(!empty($where_and)) $this->_db_write->where($where_and);;
			foreach($where_in as $k=>$v){
				$this->_db_write->where_in($k,$v);
			}
		}else{
			$this->_db_write->where($where);
		}
		$this->_db_write->update($table, $data);

		return (int) $this->_db_write->affected_rows();
	}

	/**
	 * 更新一行数据---set 可以设置 times=times+1
	 * 使用方法			data_set=array('times'=>'times+1')
	 * @return	int			返回影响的行数
	 */
	public function update_set($where = NULL, $data = NULL, $table = FALSE)
	{
		$table = (FALSE !== $table) ? $table : $this->_tablename;
		if ( is_array($where) )
		{
			$this->_db_write->where($where);
		}else{
			$this->_db_write->where($this->_pkname, $where);
		}
		if(is_array($data)){
			foreach($data as $k=>$v){
				if($k=='data_set'){
					foreach($v as $sub_k=>$sub_v){
						$this->_db_write->set($sub_k, $sub_v,false);
					}
				}else{
					$this->_db_write->set($k, $v);
				}
			}
			$this->_db_write->update($table);
			return (int) $this->_db_write->affected_rows();
		}
		return 0;
	}

	/**
	 *  插入一行
	 * @param 	数组
	 * @return	返回插入后的ID
	 */
	public function add($data = null,$table = FALSE)
	{
		$table = (FALSE !== $table) ? $table : $this->_tablename;
		//数组字段是否数据库字段匹配，不匹配则 过滤
		//$data = $this->clean_data($data);
		$this->_db_write->insert($table, $data);
		return $this->_db_write->insert_id();
	}


	/**
	 *  删除方法
	 */
	public function del($where = null,$table = FALSE)
	{
		$table = (FALSE !== $table) ? $table : $this->_tablename;
		return $this->_db_write-> delete($table, $where);
	}

	/**
	 * 判断某条数据是否存在
	 *
	 * @access	public
	 * @return	boolean
	 *
	 */
	public function exists($where = NULL, $table = FALSE)
	{
		$table = (FALSE !== $table) ? $table : $this->_tablename;

		$query = $this->_db_read->get_where($table, $where);

		if ($query->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	/**
	 * 查找条数
	 *
	 * @access	public
	 * @return	boolean
	 *
	 */
	public function count($where = NULL, $table = FALSE)
	{
		$table = (FALSE !== $table) ? $table : $this->_tablename;
		$query = $this->_db_read->get_where($table, $where);

		if ($query->num_rows() > 0)
			return $query->num_rows();
		else
			return 0;
	}

	 /**
	 * 获取一行数据
	 *
	 */
	public function get_one($where = NULL, $table = FALSE,$fields = FALSE)
	{
		$data=array();
		if( is_array($where)){
			$where['limit']='1';
		}
		$list=$this->get_query($where,$table,$fields);

		if(!empty($list) && count($list)>0)
		{
			$data=$list[0];
		}
		return $data;
	}




	/**
	 * 获取一条数据，根据ID获取专用
	 */
    public function get_info($id, $table = FALSE){
		$info=array();
		if ($id==NULL) return $info;
		$table = (FALSE !== $table) ? $table : $this->_tablename;

		$query=$this->_db_read->select('*')->from($table)->where($this->_pkname,$id)->limit(1)->get();
		//echo $this->_db_read->last_query();
		$info=$query->row_array();

		return  $info;
    }

   	/**
	 * 查询表中全部数据
	 */
    public function get_all($table = FALSE)
    {
    	$data=array();
		$table = (FALSE !== $table) ? $table : $this->_tablename;

 		 $result=$this->_db_read->select('*')->from($table)->get();
		 $list = array();
		 if ($result->num_rows() > 0)
		 {
		      $list = $result->result_array();
		 }
    	 return $list;
    }

    /**
	 * 获取列表记录
	 *
	 * @access	public
	 * @param 	array		An associative array
	 * @param 	string		table name. Optional.
	 * @return	array		Array of records
	 *
	 */
	function get_query($where = FALSE, $table = FALSE,$fields = FALSE)
	{
		$data = array();

		$table = (FALSE !== $table) ? $table : $this->_tablename;

		$fields = (FALSE !== $fields) ? $fields : $table.'.*';

		if( !is_array($where)){ //不推荐这样使用 这里的where是字符串格式
			$this->_db_read->select($fields);
			if($where!=FALSE){
				$where=trim($where);
				$query = $this->_db_read->get_where($table, $where);
			}else{
				$query = $this->_db_read->get($table);
			}
			if ( $query->num_rows() > 0 )
			$data = $query->result_array();

			$query->free_result();
  //echo $this->_db_read->last_query();echo '<br>';
			return $data;
		}
		// Perform conditions from the $where array
		foreach(array('limit', 'offset', 'group_by', 'order_by', 'like') as $key)
		{
			if(isset($where[$key]))
			{
				call_user_func(array($this->_db_read, $key), $where[$key]);
				unset($where[$key]);
			}
		}


		if ( !empty ($where) )
		{
			foreach($where as $cond => $value)
			{
				if (is_string($cond))
				{
					$this->_db_read->where($cond, $value);
				}
				else
				{
					$this->_db_read->where($value);
				}
			}
		}

		$this->_db_read->select($fields);

		$query = $this->_db_read->get($table);

		if ( $query->num_rows() > 0 )
			$data = $query->result_array();

		$query->free_result();
	   //echo $this->_db_read->last_query();echo '<br>';
		return $data;
	}
	
	function query($sql) {
		if ($sql) {
			$result = $this->_db_read->query($sql);
			$data = $result->result_array();
			$result->free_result();
			return $data;
		}
		return null;
	}

	/**
	 * 搜索分页
	 * $sql_data['table']			表名：必填
	 * $sql_data['page']			整型：必填
	 * $sql_data['pagesize']		整型：必填
	 * $sql_data['fields']			查询字段
	 * $sql_data['where']			查询条件：必填
	 * $sql_data['orderby']			排序
	 */
	protected function get_search_page($sql_data,$table=false,$where=false,$sort=false){
		$res['list']=array();
		$res['page']='';
		if(!isset($sql_data['table']) || empty($sql_data['table'])) return $res;

		$this->load->library('iquery');
		$this->iquery->initialize($sql_data['table'],$this->getTablePre());

		$sql_page=isset($sql_data['page'])?intval($sql_data['page']):1;
		$sql_pagesize=isset($sql_data['pagesize'])?intval($sql_data['pagesize']):10;

		$fields=isset($sql_data['fields'])?$sql_data['fields']:'';
		$this->iquery->fields = $fields;
		if(isset($sql_data['where'])) $this->iquery->where = $sql_data['where'];
		$this->iquery->page = $sql_page;
		$this->iquery->pagesize = $sql_pagesize;

		if(isset($sql_data['orderby'])&& !empty($sql_data['orderby'])){
        	$this->iquery->order = $sql_data['orderby'];
        }
        if(isset($sql_data['join'])&& !empty($sql_data['join'])){
        	$this->iquery->join = $sql_data['join'];
        }

		//返回组装后，分页的SQL语句
		$list_sql= $this->iquery->query_list();
		$count_sql= $this->iquery->query_count();
		$this->iquery->uniquery();
		//echo $list_sql;
		//执行相关查询
		$list=$this->_db_read->query($list_sql)->result_array();
		$count=$this->_db_read->query($count_sql)->result_array();

		//分页控件加载
		$count_num=$count[0]['total'];
		$this->load->library('ipaging');
		$page=$this->ipaging->getSysPageBar($count_num,$sql_page,$sql_pagesize);

		$res['list']=$list;
		$res['page']=$page;
		$res['curpage'] = $sql_page;
		$res['totalpage'] = ceil($count_num/$sql_pagesize);
		$res['totalnum'] = $count_num;
		return $res;
	}

	public function setTable($name){
		if(strpos($name,',') === false)
		{
			$this->_tablename= $this->_dbname.$this->_tablepre.$name;
		}
		else
		{
			$tables = explode(',',$name);
			foreach($tables as $key=>$value)
			{
				$tables[$key] = $this->_dbname.$this->_tablepre.trim($value);
			}
			$this->_tablename = implode(',',$tables);
		}
	}

	 /**
     * @brief 数据库名称
     * @return String 数据库名称
     */
    public function getDBName(){
    	$this->_dbname=$this->db->database;
    	$this->_dbname=empty($this->_dbname)?'':$this->_dbname.'.';
    }


}
