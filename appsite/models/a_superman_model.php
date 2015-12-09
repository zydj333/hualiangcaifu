<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_superman_model extends MY_model {
   
    public function __construct()
    {
 		parent::__construct();
    }
    
    //超人任务
    public function getTaskList($data) {
    	$where = 'p.status != 1';
    	$sql_data['table'] = 'sm_task as p';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'p.*';
    	$sql_data['orderby'] = 'p.start_date ASC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	return $res;
    	
    }
    
    //超人频道
    public function getChannelList($data) {
    	$where = ' 1 ';
    	$sql_data['table'] = 'sm_channel as p';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'p.*';
    	$sql_data['orderby'] = isset($data['orderby']) ? 'p.add_time ASC' :  'p.add_time DESC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	return $res;
    	
    }
    
    //公益招标
    public function getBiddingList($data) {
    	$where = ' 1 ';
    	$sql_data['table'] = 'sm_bidding as p';
    	$sql_data['page'] = isset($data['page']) ? $data['page'] : 1;
    	$sql_data['pagesize'] = isset($data['pagesize']) ? $data['pagesize'] : 6;
    	$sql_data['fields'] = isset($data['fields']) ? $data['fields']:'p.*';
    	$sql_data['orderby'] = isset($data['orderby']) ? 'p.add_time ASC' :  'p.add_time DESC';
    	$sql_data['where']=$where;
    	$res=$this->get_search_page($sql_data);
    	return $res;
    	
    }
    
    /***
	 * Feedback列表
	 */
	public function getfeedbacklist($data){

		$this->load->library('iquery');
		$this->iquery->initialize('game_feedback as a',$this->getTablePre());

		$where='isshow=1';
		$fields=isset($data['fields'])? $data['fields'] : ' a.title,a.note,a.reply_note,a.create_time ';
		$page=isset($data['page'])?intval($data['page']):1;
		$pagesize=isset($data['pagesize'])?intval($data['pagesize']):10;
		
		$order= ' a.create_time desc ';
		
		$this->iquery->fields=$fields;
		$this->iquery->where=$where;
		$this->iquery->page=$page;
		$this->iquery->pagesize=$pagesize;
		$this->iquery->order=$order;

		$list=$pagestr=array();
		//返回组装后，分页的SQL语句
		$list_sql= $this->iquery->query_list();
		$list=$this->_db_read->query($list_sql)->result_array();


		if(isset($data['page'])){
			$count_sql= $this->iquery->query_count();
			$count=$this->_db_read->query($count_sql)->result_array();

			//分页控件加载
			$count_num=$count[0]['total'];
			$this->load->library('ipaging');
			$pagestr=$this->ipaging->getSysPageBar($count_num,$page,$pagesize,'index.php?c=intro&a=feedback');
			//$pagestr = $count_num."--".$page."--".$pagesize;
		}
		$res['list']=$list;
		$res['page']=$pagestr;
		return $res;
	}
 }