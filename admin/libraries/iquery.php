<?php
/**
 * @copyright Copyright(c) 2010 jooyea.net
 * @file query_class.php
 * @brief 系统统一查询类文件，处理复杂的查询问题
 * @author webning
 * @date 2010-12-17
 * @version 0.6
 * @note
 */
/**
 * @brief IQuery 系统统一查询类
 * @class IQuery
 * @note
 */
class iquery
{
	private $dbo;
	private $sql=array('table'=>'','fields'=>'*','where'=>'','join'=>'','group'=>'','having'=>'','order'=>'','limit'=>'limit 500','distinct'=>'');
    private $paging;
	private $tablePre='';
    /**
     * @brief 构造函数
     */
	public function __construct()
	{
	}
	/**
	 *	@brief 设置表前缀
	 *	@brief 设置表名
	 */
	public function initialize($tbname,$tbPre){
		$this->tablePre=$tbPre;
		$this->table=$tbname;

	}
    /**
     * @brief 给表添加表前缀
     * @param string $name 可以是多个表名用逗号(,)分开
     */
	private function setTable($name)
	{
		if(strpos($name,',') === false)
		{
			$this->sql['table']= $this->tablePre.$name;
		}
		else
		{
			$tables = explode(',',$name);
			foreach($tables as $key=>$value)
			{
				$tables[$key] = $this->tablePre.trim($value);
			}
			$this->sql['table'] = implode(',',$tables);
		}
	}

    private function setWhere($str)
    {
    	if(!empty($str))
        	$this->sql['where']= 'where '.preg_replace('/from\s+(\S+)/i',"from {$this->tablePre}$1 ",$str);
        else
        	$this->sql['where'] ='';
    }
    /**
     * @brief 实现属性的直接存
     * @param string $name
     * @param string $value
     */
    private function setJoin($str)
    {
		$this->sql['join'] = preg_replace('/(\w+)(?=\s+as\s+\w+(,|\)|\s))/i',"{$this->tablePre}$1 ",$str);
    }
	public function __set($name,$value)
	{
		switch($name)
		{
			case 'table':$this->setTable($value);break;
			case 'fields':$this->sql['fields'] = $value;break;
			case 'where':$this->setWhere($value);break;
			case 'join':$this->setJoin($value);break;
			case 'group':$this->sql['group'] = 'GROUP BY '.$value;break;
			case 'having':$this->sql['having'] = 'having '.$value;break;
			case 'order':$this->sql['order'] = 'order by '.$value;break;
			case 'limit':$value == 'all' ? '' : ($this->sql['limit'] = 'limit '.$value);break;
            case 'page':$this->sql['page'] =intval($value); break;
            case 'pagesize':$this->sql['pagesize'] =intval($value); break;
            case 'pagelength':$this->sql['pagelength'] =intval($value); break;
			case 'distinct':
			{
				if($value)$this->sql['distinct'] = 'distinct';
				else $this->sql['distinct'] = '';
				break;
			}
		}
	}
    /**
     * @brief 实现属性的直接取
     * @param mixed $name
     * @return String
     */
	public function __get($name)
	{
		if(isset($this->sql[$name]))return $this->sql[$name];
	}

    public function __isset($name)
    {
        if(isset($this->sql[$name]))return true;
    }
    /**
     * @brief 取得查询结果的SQL语句
     * @return array
     */
	public function query_list()
	{
        if( is_int($this->page) )
        {
            $sql="select $this->distinct $this->fields from $this->table $this->join $this->where $this->group $this->having $this->order";
			$pagesize = isset($this->pagesize)?intval($this->pagesize):20;
            $page=intval($this->page)<=0?1:intval($this->page);
			$sql.=" limit ".($page-1)*$pagesize.",".($pagesize);
		}
		else
		{
            $sql="select $this->distinct $this->fields from $this->table $this->join $this->where $this->group $this->having $this->order $this->limit";
        }
        return $sql;
	}
	 /**
     * @brief 取得查询条数的SQL语句
     * @return array
     */
	public function query_count()
	{
        $sql="select count(1) from $this->table $this->join $this->where $this->group $this->having ";
        if(strpos($sql,'GROUP BY') === false)
        {
	        $endstr = strstr($sql,'from');
	        $endstr = preg_replace('/^(.*)order\s+by.+$/i','$1',$endstr);
        	$res='select count(1) as total '.$endstr;
        }
        else
        {
        	$res='select count(1) as total from ('.$sql.') as IPaging';
        }
		return $res;

	}
	/**
		*当类重复调用时，用函数来手动释放资源。
	 **/
	 function uniquery()
	 {

	 	foreach ($this->sql as $key => $val)
		{
			$this->$key = '';
		}
	 }


}
?>
