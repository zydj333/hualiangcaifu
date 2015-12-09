<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_promotion_model extends MY_model {
   
    public function __construct()
    {
 		parent::__construct();
    }
 	//限时抢购列表分页
	public function get_promotion_list($data){
	    
		$where = 'g.sts = 0 AND g.is_close = 1 AND g.type = 1 AND g.start_time <= NOW() AND g.end_time > NOW()';

		$sql_data['table']='promotion as g';
		$sql_data['page']= isset($data['page']) ? $data['page'] : 1;
		$sql_data['pagesize']=isset($data['pagesize']) ? $data['pagesize'] : 5;
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' g.*, a.goods_id, a.goods_words, a.goods_name, a.goods_english, a.goods_shop_price, a.goods_image, a.commentgood, a.commentnum, s.spec_id, s.spec_goods_spec,s.xianshi_discount';
		$sql_data['where']=$where;
		$sql_data['join'] = 'LEFT JOIN goods AS a ON a.goods_id = g.promotion_condition LEFT JOIN db_goods_spec s ON s.spec_id = g.promotion_condition1';
		$sql_data['orderby']=' g.start_time desc';
        
		$res=$this->get_search_page($sql_data);
		foreach ($res['list'] as $key=>$value) {
			$all_attr_value_index = $this->get_query(array('goods_id'=>$value['goods_id']), 'goods_attr_index');
			$temp_arr0 = array();
			$temp_arr1 = array();
			foreach ($all_attr_value_index as $a_v) {
				if ($a_v['attr_id']) {
					$attr_info = $this->get_one(array('attr_id'=>$a_v['attr_id']), 'attribute');
					if ($attr_info) {
						if (count($temp_arr0) < 3) {
							$temp_arr0[$attr_info['attr_id']] = array($attr_info["attr_name"]=>$a_v["attr_value"]);
						}else {
							$temp_arr1[$attr_info['attr_id']] = array($attr_info["attr_name"]=>$a_v["attr_value"]);
						}
					}
				}
			}
			$res['list'][$key]['sub0'] = $temp_arr0;
			$res['list'][$key]['sub1'] = $temp_arr1;
			
			$res['list'][$key]['spec_goods_spec'] = '';
			$temp = unserialize($value['spec_goods_spec']);
			if ($temp) {
				$res['list'][$key]['spec_goods_spec'] = array_pop($temp);
			}
			
			$t_where = 'g.geval_goodsid ='.$value['goods_id']. ' AND g.geval_state =0 AND geval_scores > 3';
			$t_data['table'] = 'order_evaluate as g';
			$t_data['fields'] = 'g.*, u.username';
			$t_data['join'] = 'LEFT JOIN user AS u ON u.user_id = g.geval_userid';
			$t_data['orderby'] = 'g.geval_showtime DESC';
			$t_data['where'] = $t_where;
			$t_data['limit'] = 3;
			$evluate = $this->get_search_page($t_data);
			$res['list'][$key]['evluate'] = $evluate['list'];
		}
		
		return $res;
	}
	
	public function get_promotion_over($data) {
		$where = 'g.sts = 0 AND g.is_close = 1 AND g.type = 1 AND g.end_time < NOW()';

		$sql_data['table']='promotion as g';
		$sql_data['page']= isset($data['page']) ? $data['page'] : 1;
		$sql_data['pagesize']=isset($data['pagesize']) ? $data['pagesize'] : 5;
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' g.*, a.goods_id, a.goods_words, a.goods_name, a.goods_english, a.goods_shop_price, a.goods_image, a.commentgood, a.commentnum, s.spec_id, s.spec_goods_spec,s.xianshi_discount';
		$sql_data['where']=$where;
		$sql_data['join'] = 'LEFT JOIN goods AS a ON a.goods_id = g.promotion_condition LEFT JOIN db_goods_spec s ON s.spec_id = g.promotion_condition1';
		$sql_data['orderby']=' g.start_time desc';
		
		$res=$this->get_search_page($sql_data);
		return $res;
	}
 }