<?php
if (! defined ( 'ADMINPHP' )) exit ( 'No direct script access allowed' );
class Statics extends Admin_Controller {
	public function __construct() {
		parent::__construct ();
		$this->tb_order = "order";
		$this->tb_gold_payment_log='gold_payment_log';
		$this->tb_order_goods = "order_goods";
		$this->tb_order_address = "order_address";
		$this->tb_order_log = "order_log";
		$this->tb_shop = "shop";
		$this->tb_refund_log = 'refund_log';
		$this->tb_returns = 'returns';
		$this->tb_returns_goods = 'returns_goods';
		$this->tb_fix = 'fix';
		$this->tb_price = 'goods_price_library';
		$this->tb_order_address = 'order_address';
		$this->load->model ( 'a_orders_model' );
		$this->tb_delivery_log='delivery_log';
	}
	/**
	 * 订单统计
	 */
	public function lists() {
		$this->load->library ( 'ichar' );
		$page = $this->input->get ( 'page' );
		$page = $this->ichar->act ( $page, 'int' );
		
		$statics = array();
		$sel = array();
		$where = array();
		
		$status = $this->input->get_post ( 'status' );
		$add_time_st = $this->input->get_post ( 'add_time_st' );
		$add_time_en = $this->input->get_post ( 'add_time_en' );
		$search_name = $this->input->get_post ( 'search_name' );
		$dosubmit = $this->input->get_post('dosubmit');
		
		if(isset($status) && intval($status)>=0) array_push($where,array('order_state' => intval($status)));
		if(isset($add_time_st) && !empty($add_time_st)) array_push($where,array('add_time >=' => strtotime($add_time_st)));
		if(isset($add_time_en) && !empty($add_time_en)) array_push($where,array('add_time <=' => strtotime($add_time_en)));
		if(isset($search_name) && !empty($search_name)) array_push($where,array('buyer_name' => $search_name));
		$total_amount = 0;
		$order_list = $this->a_orders_model->get_query($where,$this->tb_order);
		if(!empty($order_list)){
			foreach($order_list as $key => $val){
				$goods_amount = empty($val['goods_amount']) ? 0 : $val['goods_amount']; 
				$total_amount = $total_amount + $goods_amount;
			}
		}
		$statics['total_amount'] = $total_amount;
		$sel['status'] = $status;
		$sel['add_time_st'] = $add_time_st;
		$sel['add_time_en'] = $add_time_en;
		$sel['search_name'] = $search_name;
		$this->cismarty->assign('form_submit',$dosubmit);
		$this->cismarty->assign ( 'statics', $statics );
		$this->cismarty->assign ( 'sel', $sel );
		$this->cismarty->display ( 'order/statics/order_lists.html' );
	}
	
	/**
	 * 区域统计
	 */
	public function arealist() {
		$this->load->library ( 'ichar' );
		$statics = array();
		$sel = array();
		$where = array();
		
		$status = $this->input->get_post ( 'status' );
		$add_time_st = $this->input->get_post ( 'add_time_st' );
		$add_time_en = $this->input->get_post ( 'add_time_en' );
		$dosubmit = $this->input->get_post('dosubmit');
		
		if(isset($status) && intval($status)>=0) array_push($where,array('order_state' => intval($status)));
		if(isset($add_time_st) && !empty($add_time_st)) array_push($where,array('add_time >=' => strtotime($add_time_st)));
		if(isset($add_time_en) && !empty($add_time_en)) array_push($where,array('add_time <=' => strtotime($add_time_en)));
		$area_list = $this->a_orders_model->get_query(array('parent_id' => 0),'areas');
		foreach($area_list as $key => $val){
			$where2 = array();
			$where2 = $where;
			array_push($where2,array('province_id' => $val['id']));
			$total_amount = 0;
			$order_list = $this->a_orders_model->get_query($where2,$this->tb_order);
			
			if(!empty($order_list)){
				foreach($order_list as $k => $v){
					$goods_amount = empty($v['goods_amount']) ? 0 : $v['goods_amount']; 
					$total_amount = $total_amount + $goods_amount;
				}
			}
			$area_list[$key]['total_amount'] = $total_amount;
		}
		
		$sel['status'] = $status;
		$sel['add_time_st'] = $add_time_st;
		$sel['add_time_en'] = $add_time_en;
		$this->cismarty->assign('form_submit',$dosubmit);
		$this->cismarty->assign ( 'statics', $area_list );
		$this->cismarty->assign ( 'sel', $sel );
		$this->cismarty->display ( 'order/statics/area_lists.html' );
	}
	
	/**
	 * 区域统计
	 */
	public function guestlist() {
		$this->load->library ( 'ichar' );
		$statics = array();
		$sel = array();
		$where = array();
		
		$status = $this->input->get_post ( 'status' );
		$add_time_st = $this->input->get_post ( 'add_time_st' );
		$add_time_en = $this->input->get_post ( 'add_time_en' );
		$dosubmit = $this->input->get_post('dosubmit');
		
		if(isset($status) && intval($status)>=0) array_push($where,array('order_state' => intval($status)));
		if(isset($add_time_st) && !empty($add_time_st)) array_push($where,array('add_time >=' => strtotime($add_time_st)));
		if(isset($add_time_en) && !empty($add_time_en)) array_push($where,array('add_time <=' => strtotime($add_time_en)));
		$guest_list = $this->a_orders_model->get_query(array('sts' => 0),'user');
		foreach($guest_list as $key => $val){
			$where2 = array();
			$where2 = $where;
			array_push($where2,array('buyer_id' => $val['user_id']));
			$total_amount = 0;
			$order_list = $this->a_orders_model->get_query($where2,$this->tb_order);
			
			if(!empty($order_list)){
				foreach($order_list as $k => $v){
					$goods_amount = empty($v['goods_amount']) ? 0 : $v['goods_amount']; 
					$total_amount = $total_amount + $goods_amount;
				}
			}
			$guest_list[$key]['total_amount'] = $total_amount;
		}
		
		$sel['status'] = $status;
		$sel['add_time_st'] = $add_time_st;
		$sel['add_time_en'] = $add_time_en;
		$this->cismarty->assign('form_submit',$dosubmit);
		$this->cismarty->assign ( 'statics', $guest_list );
		$this->cismarty->assign ( 'sel', $sel );
		$this->cismarty->display ( 'order/statics/guest_lists.html' );
	}
	
	/**
	 * 分类统计
	 */
	public function catelist() {
		$this->load->library ( 'ichar' );
		$statics = array();
		$sel = array();
		$where = array();
		
		$status = $this->input->get_post ( 'status' );
		$add_time_st = $this->input->get_post ( 'add_time_st' );
		$add_time_en = $this->input->get_post ( 'add_time_en' );
		$search_area = $this->input->get_post ( 'search_area' );
		$dosubmit = $this->input->get_post('dosubmit');
		
		if(isset($status) && intval($status)>=0) array_push($where,array('order_state' => intval($status)));
		if(isset($add_time_st) && !empty($add_time_st)) array_push($where,array('add_time >=' => strtotime($add_time_st)));
		if(isset($add_time_en) && !empty($add_time_en)) array_push($where,array('add_time <=' => strtotime($add_time_en)));
		if(isset($search_area) && !empty($search_area)) array_push($where,array('province_id' => intval($search_area)));
		$cate_list = $this->a_orders_model->get_query(array('parent_id' => 0,'order_by'=>'listorder desc'),'goods_category');
		$area_list = $this->a_orders_model->get_query(array('parent_id' => 0),'areas');
		foreach($cate_list as $key => $val){
			$subcate_list = $this->a_orders_model->get_query(array('parent_id'=>$val['gc_id'],'order_by'=>'listorder desc'),'goods_category');
			$where2 = array();
			$where2 = $where;
			$total_amount = 0;
			$total_nums = 0;
			$order_list = $this->a_orders_model->get_query($where2,$this->tb_order);

			if(!empty($order_list)){
				//一级分类统计数据
				foreach($order_list as $k => $v){
					$list_goodsdata = $this->a_orders_model->get_query(array('order_id' => $v['order_id'],'cate_id' => $val['gc_id']), 'order_goods');
					foreach($list_goodsdata as $kk => $vv){
						$goods_num = empty($vv['goods_num']) ? 0 : $vv['goods_num'];
						$goods_price = empty($vv['goods_price']) ? 0 : $vv['goods_price'];
						$total_nums = $total_nums + $goods_num;	
						$total_amount = $total_amount + ($goods_price * $goods_num);
					}
				}
				$cate_list[$key]['fprods_loop'] = $this->a_orders_model->get_query(array('sts' => 0,'gc_id' => $val['gc_id']),'goods'); 
				foreach($cate_list[$key]['fprods_loop'] as $fkk => $fvv){
					foreach($order_list as $k => $v){
						$list_goodsdata = $this->a_orders_model->get_query(array('goods_id' => $fvv['goods_id'],'order_id' => $v['order_id'],'cate_id' => $val['gc_id']), 'order_goods');
						foreach($list_goodsdata as $kk => $vv){
							$goods_num = empty($vv['goods_num']) ? 0 : $vv['goods_num'];
							$goods_price = empty($vv['goods_price']) ? 0 : $vv['goods_price'];
							$total_nums = $total_nums + $goods_num;	
							$total_amount = $total_amount + ($goods_price * $goods_num);
						}
					}
					$cate_list[$key]['fprods_loop'][$fkk]['total_nums'] = $total_nums;
					$cate_list[$key]['fprods_loop'][$fkk]['total_amount'] = $total_amount;
				}
				//二级分类统计数据
				if(!empty($subcate_list)){
					$sub_amount = 0;
					$sub_nums = 0;
					foreach($subcate_list as $kk => $vv){
						foreach($order_list as $kkk => $vvv){
							$subcate_list[$kk]['prods_loop'] = $this->a_orders_model->get_query(array('sts' => 0,'gc_id' => $vv['gc_id']),'goods');
							if(!empty($subcate_list[$kk]['prods_loop'])){
								foreach($subcate_list[$kk]['prods_loop'] as $skk => $svv){
									$list_goodsdata2 = $this->a_orders_model->get_query(array('goods_id' => $svv['goods_id'],'order_id' => $vvv['order_id'],'cate_id' => $val['gc_id'],'subcate_id' => $vv['gc_id']), 'order_goods');
									foreach($list_goodsdata2 as $lk => $lv){
										$goods_num = empty($lv['goods_num']) ? 0 : $lv['goods_num'];
										$goods_price = empty($lv['goods_price']) ? 0 : $lv['goods_price'];
										$sub_nums = $sub_nums + $goods_num;	
										$sub_amount = $sub_amount + ($goods_price * $goods_num);
									}
									$subcate_list[$kk]['prods_loop'][$skk]['total_nums'] = $sub_nums;
									$subcate_list[$kk]['prods_loop'][$skk]['total_amount'] = $sub_amount;
								}
							}
							$list_goodsdata2 = $this->a_orders_model->get_query(array('order_id' => $vvv['order_id'],'cate_id' => $val['gc_id'],'subcate_id' => $vv['gc_id']), 'order_goods');
									foreach($list_goodsdata2 as $lk => $lv){
										$goods_num = empty($lv['goods_num']) ? 0 : $lv['goods_num'];
										$goods_price = empty($lv['goods_price']) ? 0 : $lv['goods_price'];
										$sub_nums = $sub_nums + $goods_num;	
										$sub_amount = $sub_amount + ($goods_price * $goods_num);
									}
									$subcate_list[$kk]['total_nums'] = $sub_nums;
									$subcate_list[$kk]['total_amount'] = $sub_amount;
						}
						
					}
				}
			} else {
				$cate_list[$key]['fprods_loop'] = $this->a_orders_model->get_query(array('sts' => 0,'gc_id' => $val['gc_id']),'goods'); 
				foreach($cate_list[$key]['fprods_loop'] as $fk => $fv){
					$cate_list[$key]['fprods_loop'][$fk]['total_nums'] = 0;
					$cate_list[$key]['fprods_loop'][$fk]['total_amount'] = 0;
				}
				foreach($subcate_list as $kk => $vv){
					$subcate_list[$kk]['total_nums'] = 0;
					$subcate_list[$kk]['total_amount'] = 0;
					$subcate_list[$kk]['prods_loop'] = array();
					$subcate_list[$kk]['prods_loop'] = $this->a_orders_model->get_query(array('sts' => 0,'gc_id' => $vv['gc_id']),'goods'); 
					foreach($subcate_list[$kk]['prods_loop'] as $sk => $sv){
						$subcate_list[$kk]['prods_loop'][$sk]['total_nums'] = 0;
						$subcate_list[$kk]['prods_loop'][$sk]['total_amount'] = 0;
					}
				}
			}
			$cate_list[$key]['sub'] = $subcate_list;
			$cate_list[$key]['total_nums'] = $total_nums;
			$cate_list[$key]['total_amount'] = $total_amount;
		}
		$sel['status'] = $status;
		$sel['add_time_st'] = $add_time_st;
		$sel['add_time_en'] = $add_time_en;
		$this->cismarty->assign('form_submit',$dosubmit);
		$this->cismarty->assign ( 'statics', $cate_list );
		$this->cismarty->assign ( 'arealist', $area_list);
		$this->cismarty->assign ( 'sel', $sel );
		$this->cismarty->display ( 'order/statics/cate_lists.html' );
	}
	
	private function getstatename($type = 0) {
		$arr = array (
				'0' => '已取消',
				'10' => '未付款',
				'11' => '待付款',
				'20' => '已审核',
				'30' => '已发货',
				'40' => '已开票',
				'50' => '已取消',
				'60' => '已完成' 
		);
		return isset ( $arr [$type] ) ? $arr [$type] : '';
	}
	
}