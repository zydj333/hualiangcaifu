<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class a_orders_model extends MY_model {
    /**
     * 交易分页构造函数
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
 		parent::__construct();
    }
	//订单管理列表分页
	public function get_order_search($data){
	    
		$where = 'o.sts = 0';
 		if(isset($data['status']) && intval($data['status'])>=0) $where.= ' and o.order_state ='.intval($data['status']);
		if(isset($data['add_time_st']) && !empty($data['add_time_st'])) $where.= ' and o.add_time >='.strtotime($data['add_time_st']);
		if(isset($data['add_time_en']) && !empty($data['add_time_en'])) $where.= ' and o.add_time <='.strtotime($data['add_time_en'].' 23:59:59');

		if(isset($data['order_amount_from']) && !empty($data['order_amount_from'])) $where.= ' and o.goods_amount >='.intval($data['order_amount_from']);
		if(isset($data['order_amount_to']) && !empty($data['order_amount_to'])) $where.= ' and o.goods_amount <='.intval($data['order_amount_to']);
		if(!empty($data['admin_areaids'])) $where .= ' and o.province_id in ('.$this->_db_read->escape_str($data['admin_areaids']).')';
		if(isset($data['field']) && !empty($data['field'])){
			if($data['field'] == 'order_sn' && isset($data['search_ordersn']) && !empty($data['search_ordersn'])){
				$where.= ' and '.$data['field'].' = \''.$this->_db_read->escape_str($data['search_ordersn']).'\'';
			} else if($data['field'] == 'buyer_name' && isset($data['search_buyer']) && !empty($data['search_buyer'])){
				$where.= ' and '.$data['field'].' = \''.$this->_db_read->escape_str($data['search_buyer']).'\'';
			} 
		}
		//if(!empty($where)) {$where=substr($where,4);}else{$where ='1=1';}

		$sql_data['table']='order as o';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' o.add_time desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	
	public function get_order_all($data){
		$where = 'sts = 0';
 		if(isset($data['status']) && intval($data['status'])>=0) $where.= ' and order_state ='.intval($data['status']);
		if(isset($data['add_time_st']) && !empty($data['add_time_st'])) $where.= ' and add_time >='.strtotime($data['add_time_st']);
		if(isset($data['add_time_en']) && !empty($data['add_time_en'])) $where.= ' and add_time <='.strtotime($data['add_time_en'].' 23:59:59');

		if(isset($data['order_amount_from']) && !empty($data['order_amount_from'])) $where.= ' and goods_amount >='.intval($data['order_amount_from']);
		if(isset($data['order_amount_to']) && !empty($data['order_amount_to'])) $where.= ' and goods_amount <='.intval($data['order_amount_to']);
		if(!empty($data['admin_areaids'])) $where .= ' and province_id in ('.$this->_db_read->escape_str($data['admin_areaids']).')';
		if(isset($data['field']) && !empty($data['field'])){
			if($data['field'] == 'order_sn' && isset($data['search_ordersn']) && !empty($data['search_ordersn'])){
				$where.= ' and '.$data['field'].' = \''.$this->_db_read->escape_str($data['search_ordersn']).'\'';
			} else if($data['field'] == 'buyer_name' && isset($data['search_buyer']) && !empty($data['search_buyer'])){
				$where.= ' and '.$data['field'].' = \''.$this->_db_read->escape_str($data['search_buyer']).'\'';
			} 
		}
		
		$res = $this->get_query($where,'order');
		
		return $res;
	}
	//咨询管理列表分页
	public function get_consult_search($data){
	    
		$where ='1 = 1';
		if(isset($data['member_name']) && !empty($data['member_name'])) $where.= ' and c.cmember_name =\''.$data['member_name'].'\'';
		if(isset($data['consult_content']) && !empty($data['consult_content'])) $where.= ' and c.consult_content like \'%'.$this->_db_read->escape_str($data['consult_content']).'%\' ';

		if ($data['flag'] == 1) {
			$where .= ' and c.consult_reply = "" or c.consult_reply is null';
		}elseif ($data['flag'] == 2) {
			$where .= ' and c.consult_reply !=""';
		}
		
		$sql_data['table']='order_consult as c';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'c.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' c.consult_id desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
	}
	//举报管理列表分页
	public function get_inform_search($data){
	    
		$where ='1 = 1';
		$ac=isset($data['ac'])?intval($data['ac']):0;
		$where ='i.inform_state ='.$ac;
		if(isset($data['stime']) && !empty($data['stime'])) $where.= ' and i.inform_datetime >='.strtotime($data['stime']);
		if(isset($data['etime']) && !empty($data['etime'])) $where.= ' and i.inform_datetime <='.strtotime($data['etime'].' 23:59:59');
		if(isset($data['goods_name']) && !empty($data['goods_name'])) $where.= ' and i.inform_goods_name like \'%'.$this->_db_read->escape_str($data['goods_name']).'%\' ';
		if(isset($data['inform_subject']) && !empty($data['inform_subject'])) $where.= ' and i.inform_subject_content like \'%'.$this->_db_read->escape_str($data['inform_subject']).'%\' ';
		if(isset($data['member_name']) && !empty($data['member_name'])) $where.= ' and i.inform_member_name like \'%'.$this->_db_read->escape_str($data['member_name']).'%\' ';

		if(isset($data['inform_type']) && !empty($data['inform_type'])) {
			$i_sql='inform_type_state = 1 and  inform_subject_type_name like \'%'.$this->_db_read->escape_str($data['inform_type']).'%\' ';
			$inform_subject_list=$this->get_query($i_sql,'inform_subject','inform_subject_id');
			$i_ids='';
			foreach($inform_subject_list as $v){
				$i_ids.=','.$v['inform_subject_id'];
			}
			if(!empty($i_ids)){
				$i_ids=substr($i_ids,1);
				$where.= ' and inform_subject_id in('.$i_ids.')';
			}else{
				return $res;
			}
		}

		$sql_data['table']='order_inform as i';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'i.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' i.inform_datetime desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
	}
	//举报主题列表分页
	public function get_subject_search($data){
	    
		$where ='1 = 1';
		if(isset($data['subject_state']) && !empty($data['subject_state'])) $where.= ' and i.inform_subject_state ='.$data['subject_state'];
		if(isset($data['subject_type_id']) && !empty($data['subject_type_id'])) $where.= ' and i.inform_subject_type_id ='.$data['subject_type_id'];

		$sql_data['table']='order_inform_subject as i';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'i.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' i.inform_subject_id desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
    //评价管理列表分页
	public function get_evaluate_search($data){
	    
		$where =' 1 ';

		if(isset($data['state']) && strlen($data['state'])>0) $where.= ' and e.geval_state ='.intval($data['state']);
		if(is_numeric($data['grade']) && intval($data['grade']) == 1){ $where.= ' and e.geval_scores > 3';}
		elseif(is_numeric($data['grade']) && intval($data['grade']) == 0){$where.= ' and e.geval_scores between 2 AND 3';}
		elseif(is_numeric($data['grade']) && intval($data['grade']) == -1){$where.= ' and e.geval_scores < 2';}

		if(isset($data['stime']) && !empty($data['stime'])) $where.= ' and e.add_time >='.strtotime($data['stime']);
		if(isset($data['etime']) && !empty($data['etime'])) $where.= ' and e.add_time <='.strtotime($data['etime'].' 23:59:59');

		if(isset($data['shop_name']) && !empty($data['shop_name'])) $where.= ' and e.geval_shopname like \'%'.$this->_db_read->escape_str($data['shop_name']).'%\' ';
		if(isset($data['goods_name']) && !empty($data['goods_name'])) $where.= ' and e.geval_goodsname like \'%'.$this->_db_read->escape_str($data['goods_name']).'%\' ';
		$sql_data['table']='order_evaluate as e';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'e.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' e.geval_addtime desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//店铺动态评价列表分页
	public function get_shopeval_search($data){
	    
		$where ='';
		if(isset($data['grade']) && intval($data['grade'])>0) $where.= ' and e.seval_scores ='.intval($data['grade']);
		if(isset($data['stime']) && !empty($data['stime'])) $where.= ' and e.seval_addtime >='.strtotime($data['stime']);
		if(isset($data['etime']) && !empty($data['etime'])) $where.= ' and e.seval_addtime <='.strtotime($data['etime'].' 23:59:59');

		if(isset($data['shop_name']) && !empty($data['shop_name'])) $where.= ' and e.seval_storename like \'%'.$this->_db_read->escape_str($data['shop_name']).'%\' ';
		if(isset($data['from_name']) && !empty($data['from_name'])) $where.= ' and e.seval_membername like \'%'.$this->_db_read->escape_str($data['from_name']).'%\' ';

		if(!empty($where)) {$where=substr($where,4);}else{$where ='1=1';}

		$sql_data['table']='evaluate_store as e';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'e.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' e.seval_addtime desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//投诉管理分页
	public function get_complain_search($data){
	    
		$where = ' cp.complain_state = '.intval($data['complain_state']);
		if(!empty($data['input_complain_accuser'])) $where .= ' and  cp.accuser_name like \'%'.$this->_db_read->escape_str($data['input_complain_accuser']).'%\'';
		if(!empty($data['input_complain_subject_content'])) $where .= ' and  cp.complain_subject_content like \'%'.$this->_db_read->escape_str($data['input_complain_subject_content']).'%\'';
		if(!empty($data['input_complain_accused'])) {
		    if(!empty($data['input_complain_accuser'])){
			    $where .= ' or  cp.accused_name like \'%'.$this->_db_read->escape_str($data['input_complain_accused']).'%\'';
			}else{
			    $where .= ' and  cp.accused_name like \'%'.$this->_db_read->escape_str($data['input_complain_accused']).'%\'';
			}
		}
		if(!empty($data['input_complain_datetime_start'])) $where .= ' and  cp.complain_datetime >= '.intval(strtotime($data['input_complain_datetime_start']));
		if(!empty($data['input_complain_datetime_end'])) $where .= ' and  cp.complain_datetime <= '.intval(strtotime($data['input_complain_datetime_end']));

		$sql_data['table']='order_complain as cp';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' cp.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' cp.complain_datetime asc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	//投诉管理主题分页
	public function get_complainsubject_search($data){
	    
		$where = 'cs.complain_subject_state=1';
		if(!empty($data['complain_subject_type'])) $where .= ' and  cs.complain_subject_type = '.intval($data['complain_subject_type']);

		$sql_data['table']='order_complain_subject as cs';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' cs.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' cs.complain_subject_id desc';
        
		$res=$this->get_search_page($sql_data);
		return $res;
		
	}
	public function get_refund_search($data){
		$where="o.sts = ".$data['sts'];
		if(isset($data['status']) && intval($data['status'])>0){
			 $where.= ' and o.re_state ='.intval($data['status']);
		}else if(isset($data['status']) && intval($data['status'])==0){
			 $where.= ' and o.re_state ='.intval($data['status']);
		}
		if(isset($data['add_time_st']) && !empty($data['add_time_st'])) $where.= ' and o.add_time >='.strtotime($data['add_time_st']);
		if(isset($data['add_time_en']) && !empty($data['add_time_en'])) $where.= ' and o.add_time <='.strtotime($data['add_time_en'].' 23:59:59');
	
		if(isset($data['order_amount_from']) && !empty($data['order_amount_from'])) $where.= ' and o.order_amount >='.intval($data['order_amount_from']);
		if(isset($data['order_amount_to']) && !empty($data['order_amount_to'])) $where.= ' and o.order_amount <='.intval($data['order_amount_to']);
		if(isset($data['order_sn']) && !empty($data['order_sn'])){
			$where .= ' and  o.order_sn like \'%'.$data['order_sn'].'%\'';
		}
		$sql_data['table']='refund_log as o';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.* ';
		$sql_data['where']=$where;
		
		$sql_data['orderby']=' o.add_time desc';
	
		$res=$this->get_search_page($sql_data);
		
		return $res;
	
	}
	public function get_returns_search($data){
		$where="o.sts = ".$data['sts']." and g.returns_state > 0 ";
		if(isset($data['status']) && intval($data['status'])>=0) $where.= ' and o.re_state ='.intval($data['status']);
		if(isset($data['add_time_st']) && !empty($data['add_time_st'])) $where.= ' and o.add_time >='.strtotime($data['add_time_st']);
		if(isset($data['add_time_en']) && !empty($data['add_time_en'])) $where.= ' and o.add_time <='.strtotime($data['add_time_en'].' 23:59:59');	
		if(isset($data['order_id']) && !empty($data['order_id'])){
			$where .= ' and  o.order_id like \'%'.$data['order_id'].'%\'';
		}
		$sql_data['table']='returns as o';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.* ';
		$sql_data['where']=$where;
	    $sql_data['join'] = 'left join order_goods as g on g.order_id = o.order_id and g.goods_id = o.goods_id';
		$sql_data['orderby']=' o.add_time desc';
	   
		$res=$this->get_search_page($sql_data);
		return $res;
	
	}
	
	public function get_fix_search($data){
		$where="o.sts = ".$data['sts']." and g.returns_state > 0 ";
		if(isset($data['status']) && intval($data['status'])>=0) $where.= ' and o.re_state ='.intval($data['status']);
		if(isset($data['add_time_st']) && !empty($data['add_time_st'])) $where.= ' and o.add_time >='.strtotime($data['add_time_st']);
		if(isset($data['add_time_en']) && !empty($data['add_time_en'])) $where.= ' and o.add_time <='.strtotime($data['add_time_en'].' 23:59:59');	
		if(isset($data['order_id']) && !empty($data['order_id'])){
			$where .= ' and  o.order_id like \'%'.$data['order_id'].'%\'';
		}
		$sql_data['table']='fix as o';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.* ';
		$sql_data['where']=$where;
	    $sql_data['join'] = 'left join order_goods as g on g.order_id = o.order_id and g.goods_id = o.goods_id';
		$sql_data['orderby']=' o.add_time desc';
	   
		$res=$this->get_search_page($sql_data);
		return $res;
	
	}
	
	public function get_collection_search($data){    	
		$where="s.sts=".$data['sts'];
		if(isset($data['status'])) $where.= ' and s.log_sign ='.intval($data['status']);//状态;未确认 已确认 
		
		if(isset($data['add_time_st']) && !empty($data['add_time_st'])) $where.= ' and o.payment_time >='.strtotime($data['add_time_st']);
		if(isset($data['add_time_en']) && !empty($data['add_time_en'])) $where.= ' and o.payment_time <='.strtotime($data['add_time_en'].' 23:59:59');
		if(isset($data['order_sn']) && !empty($data['order_sn'])){
			$where .= ' and  o.order_sn like \'%'.$data['order_sn'].'%\'';
		}
		
		$sql_data['table']='order as o';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' o.payment_time desc';
		$sql_data['join'] = 'left join gold_payment_log as s on s.order_sn = o.order_sn';
		$res=$this->get_search_page($sql_data);
		return $res;
	
	}
	
	public function get_delivery_search($data){
	    $where="s.sts=".$data['sts'];
		if(isset($data['status'])) $where.= ' and s.delivery_state ='.intval($data['status']);
		if(isset($data['add_time_st']) && !empty($data['add_time_st'])) $where.= ' and o.payment_time >='.strtotime($data['add_time_st']);
		if(isset($data['add_time_en']) && !empty($data['add_time_en'])) $where.= ' and o.payment_time <='.strtotime($data['add_time_en'].' 23:59:59');
		if(isset($data['order_sn']) && !empty($data['order_sn'])){
			$where .= ' and  o.order_sn like \'%'.$data['order_sn'].'%\'';
		}
		$sql_data['table']='order as o';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' o.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' o.payment_time desc';
		$sql_data['join'] = 'left join delivery_log as s on s.order_sn = o.order_sn';
		$res=$this->get_search_page($sql_data);
		return $res;
	  
	}
	
	
}