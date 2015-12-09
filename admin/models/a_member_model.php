<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class a_member_model extends MY_model {
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

    //会员列表分页
	public function get_member_search($data){

		$where = 'u.sts=0';
		if(!empty($data['search_field_name'])){
			switch($data['search_field_name']){
		    case 'member_name':
			    $where .= ' and  u.username like \'%'.$this->_db_read->escape_str($data['search_field_value']).'%\'';
					break;
				case 'member_email':
			    $where .= ' and  u.email like \'%'.$this->_db_read->escape_str($data['search_field_value']).'%\'';
					break;
				case 'member_truename':
			    $where .= ' and  u.truename like \'%'.$this->_db_read->escape_str($data['search_field_value']).'%\'';
					break;
			}
		}
		if(!empty($data['search_state'])){
		switch($data['search_state']){
		  	case 'no_informallow':
			    $where .= ' and  u.inform_allow=2';
					break;
				case 'no_isbuy':
			    $where .= ' and  u.isbuy=0';
					break;
				case 'no_isallowtalk':
			    $where .= ' and  u.isallowtalk=0';
					break;
				case 'no_memberstate':
			    $where .= ' and  u.isclose=0';
					break;
				case 'no_ischeck0':
			    $where .= ' and  u.ischeck=0';
					break;
				case 'no_ischeck1':
			    $where .= ' and  u.ischeck=1';
					break;
				case 'no_ischeck2':
			    $where .= ' and  u.ischeck=2';
					break;
			}
		}
		if(!empty($data['admin_areaids'])) $where .= ' and u.province_id in ('.$this->_db_read->escape_str($data['admin_areaids']).')';
    if(!empty($data['search_sort'])) $order_by = $this->_db_read->escape_str($data['search_sort']); else $order_by = 'user_id asc';

		$sql_data['table']='user as u';
		$sql_data['join']=' left join  user_group as g on g.id =u.group ';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' u.*,g.groupname ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' u.'.$order_by;

		$res=$this->get_search_page($sql_data);
		return $res;
	}
	
	//售后服务列表分页
	public function get_consult_search($data){
	    
		$where ='1 = 1';
		if(isset($data['member_name']) && !empty($data['member_name'])) $where.= ' and c.cmember_name =\''.$data['member_name'].'\'';
		if(isset($data['consult_content']) && !empty($data['consult_content'])) $where.= ' and c.consult_content like \'%'.$this->_db_read->escape_str($data['consult_content']).'%\' ';

		if ($data['flag'] == 1) {
			$where .= ' and c.consult_reply = "" or c.consult_reply is null';
		}elseif ($data['flag'] == 2) {
			$where .= ' and c.consult_reply !=""';
		}
		
		$sql_data['table']='consult as c';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'c.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' c.consult_id desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
	}
	
	//购买咨询管理列表分页
	public function get_buyconsult_search($data){
	    
		$where ='1 = 1';
		if(isset($data['member_name']) && !empty($data['member_name'])) $where.= ' and c.cmember_name =\''.$data['member_name'].'\'';
		if(isset($data['consult_content']) && !empty($data['consult_content'])) $where.= ' and c.consult_content like \'%'.$this->_db_read->escape_str($data['consult_content']).'%\' ';

		if ($data['flag'] == 1) {
			$where .= ' and c.consult_reply = "" or c.consult_reply is null';
		}elseif ($data['flag'] == 2) {
			$where .= ' and c.consult_reply !=""';
		}
		
		$sql_data['table']='consult_buy as c';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'c.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' c.consult_id desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
	}

 }