<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class a_superman_model extends MY_model {
    /**
     * 会员分页构造函数
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
 		parent::__construct();
    }
    //超人大赛报名
    public function get_contest_search($data){
    	$where = '1';
			if(!empty($data['search_author'])) $where .= ' and  c.author = \'%'.$this->_db_read->escape_str($data['search_author']).'%\'';
        
			$sql_data['table']='sm_contest as c';
			$sql_data['page']=$data['page'];
			$sql_data['pagesize']=$data['pagesize'];
			$sql_data['fields']=isset($data['fields'])?$data['fields']:' c.* ';
			$sql_data['where']=$where;

			$res=$this->get_search_page($sql_data);
			return $res;
    }
    
    //超人频道列表
    public function get_channel_search($data){
    	$where = '1';
			if(!empty($data['search_title'])) $where .= ' and  c.title like \'%'.$this->_db_read->escape_str($data['search_title']).'%\'';
        
			$sql_data['table']='sm_channel as c';
			$sql_data['page']=$data['page'];
			$sql_data['pagesize']=$data['pagesize'];
			$sql_data['fields']=isset($data['fields'])?$data['fields']:' c.* ';
			$sql_data['where']=$where;

			$res=$this->get_search_page($sql_data);
			return $res;
    }
    
    //公益招标列表
    public function get_bidding_search($data){
    	$where = '1';
			if(!empty($data['search_title'])) $where .= ' and  c.name like \'%'.$this->_db_read->escape_str($data['search_title']).'%\'';
        
			$sql_data['table']='sm_bidding as c';
			$sql_data['page']=$data['page'];
			$sql_data['pagesize']=$data['pagesize'];
			$sql_data['fields']=isset($data['fields'])?$data['fields']:' c.* ';
			$sql_data['where']=$where;

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
			$sql_data['orderby']=' gc.listorder desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
		}
		
		//超人任务列表
    public function get_task_search($data){
    	$where = '1';
			if(!empty($data['search_name'])) $where .= ' and  c.name like \'%'.$this->_db_read->escape_str($data['search_name']).'%\'';
      if(!empty($data['search_oname'])) $where .= ' and  c.organize_name like \'%'.$this->_db_read->escape_str($data['search_oname']).'%\'';
      if(!empty($data['search_sdate'])) $where .= ' and  c.start_date >= '.intval(strtotime($data['search_sdate']));
			if(!empty($data['search_edate'])) $where .= ' and  c.end_date <= '.intval(strtotime($data['end_date'].' 23:59:59'));
      if(!empty($data['search_status'])) $where .= ' and  c.status = \''.$this->_db_read->escape_str($data['status']).'\'';
      
			$sql_data['table']='sm_task as c';
			$sql_data['page']=$data['page'];
			$sql_data['pagesize']=$data['pagesize'];
			$sql_data['fields']=isset($data['fields'])?$data['fields']:' c.* ';
			$sql_data['where']=$where;

			$res=$this->get_search_page($sql_data);
			return $res;
    }
    
	
 }