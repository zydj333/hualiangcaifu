<?php
if (! defined ( 'ADMINPHP' ))
	exit ( 'No direct script access allowed' );
class Order extends Admin_Controller {
	public function __construct() {
		parent::__construct ();
		$this->tb_order = "order";
		$this->tb_gold_payment_log='gold_payment_log';
		$this->tb_order_goods = "order_goods";
		$this->tb_order_address = "order_address";
		$this->tb_order_log = "order_log";
		$this->tb_shop = "shop";
		$this->tb_user = 'user';
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
	 * 订单列表---ok
	 */
	public function lists() {
		$this->load->library ( 'ichar' );
		$page = $this->input->get ( 'page' );
		$page = $this->ichar->act ( $page, 'int' );
		
		
		$data ['page'] = $page;
		$data ['pagesize'] = 10;
		
		$status = $this->input->get_post ( 'status' );
		$add_time_st = $this->input->get_post ( 'add_time_st' );
		$add_time_en = $this->input->get_post ( 'add_time_en' );
		$order_amount_from = $this->input->get_post ( 'order_amount_from' );
		$order_amount_to = $this->input->get_post ( 'order_amount_to' );
		$field = $this->input->get_post ( 'field' );
		$search_ordersn = $this->input->get_post ( 'search_ordersn' );
		$search_buyer = $this->input->get_post ( 'search_buyer' );
		$dosubmit = $this->input->get_post('dosubmit');
		
		$data ['status'] = strlen ( $status ) == 0 ? '-1' : intval ( $status );
		$data ['add_time_st'] = $add_time_st;
		$data ['add_time_en'] = $add_time_en;
		$data ['order_amount_from'] = $order_amount_from;
		$data ['order_amount_to'] = $order_amount_to;
		$data ['field'] = $field;
		$data ['search_ordersn'] = $search_ordersn;
		$data ['search_buyer'] = $search_buyer;
		//获取该管理员下的经销商
		$admin_areaids = $this->session->userdata('admin_area_id');
		if(!empty($admin_areaids)){
			$data['admin_areaids']= $admin_areaids;
		}
		//获取该管理员下的经销商名单
		$userwhere = 'sts = 0 ';
		if(!empty($admin_areaids)){
			$userwhere .= ' and province_id in ('.$admin_areaids.')';
		}
		$member_list = $this->a_orders_model->get_query($userwhere,$this->tb_user);
		$this->load->model ( 'a_orders_model' );
		$list = $this->a_orders_model->get_order_search ( $data );
		$alllist = $this->a_orders_model->get_order_all ( $data );
		$order_list = $list ['list'];
		
		$total_money = 0;
		$total_numbs = 0;
		$total_records = 0;
		foreach ( $order_list as $k => $v ) {
			$order_list [$k] = $v;
			$order_list [$k] ['state_name'] = $this->getstatename ( $v ['order_state'] );
			$user_id = $v['buyer_id'];
			$user_info = $this->a_orders_model->get_one(array('user_id' => $user_id),'user');
			$order_list [$k] ['comp_name'] = empty($user_info['web']) ? '暂未填写' : $user_info['web'];
		}
		foreach ($alllist as $k => $v){
			$order_money = empty($v['goods_amount']) ? 0 : $v['goods_amount'];
			$total_money += $order_money;
			$list_goodsdata = $this->a_orders_model->get_query(array('order_id' => $v['order_id']), 'order_goods');
			foreach($list_goodsdata as $kk => $vv){
				$goods_num = empty($vv['goods_num']) ? 0 : $vv['goods_num'];
				$total_numbs = $total_numbs + $goods_num;	
			}
		}
		$total_records = count($alllist);
		$data['total_money'] = sprintf('%.2f',round($total_money));
		$data['total_numbs'] = $total_numbs;
		$data['total_records'] = $total_records;
		$this->cismarty->assign('form_submit',$dosubmit);
		$this->cismarty->assign ( 'sel', $data );
		$this->cismarty->assign ( 'memberlist', $member_list);
		$this->cismarty->assign ( 'infolist', $order_list );
		$this->cismarty->assign ( 'infopage', $list ['page'] );
		$this->cismarty->display ( 'order/order/order_lists.html' );
	}
	
	/**
	 * 订单列表---ok
	 */
	public function order_today() {
		$this->load->library ( 'ichar' );
		$page = $this->input->get ( 'page' );
		$page = $this->ichar->act ( $page, 'int' );
		
		$data ['page'] = $page;
		$data ['pagesize'] = 10;
		
		$status = $this->input->get_post ( 'status' );
		$add_time_st = $this->input->get_post ( 'add_time_st' );
		$add_time_en = $this->input->get_post ( 'add_time_en' );
		$order_amount_from = $this->input->get_post ( 'order_amount_from' );
		$order_amount_to = $this->input->get_post ( 'order_amount_to' );
		$field = $this->input->get_post ( 'field' );
		$search_name = $this->input->get_post ( 'search_name' );
		$dosubmit = $this->input->get_post('dosubmit');
		
		$data ['status'] = strlen ( $status ) == 0 ? '-1' : intval ( $status );
		$data ['add_time_st'] = date('20y-m-d',time());
		$data ['add_time_en'] = date('20y-m-d',time());
		$data ['order_amount_from'] = $order_amount_from;
		$data ['order_amount_to'] = $order_amount_to;
		$data ['field'] = $field;
		$data ['search_name'] = $search_name;
		//获取该管理员下的经销商
		$admin_areaids = $this->session->userdata('admin_area_id');
		if(!empty($admin_areaids)){
			$data['admin_areaids']= $admin_areaids;
		}
		
		$this->load->model ( 'a_orders_model' );
		$list = $this->a_orders_model->get_order_search ( $data );
		
		$order_list = $list ['list'];
		foreach ( $order_list as $k => $v ) {
			$order_list [$k] = $v;
			$order_list [$k] ['state_name'] = $this->getstatename ( $v ['order_state'] );
			$user_id = $v['buyer_id'];
			$user_info = $this->a_orders_model->get_one(array('user_id' => $user_id),'user');
			$order_list [$k] ['comp_name'] = empty($user_info['web']) ? '暂未填写' : $user_info['web'];
		}
		$this->cismarty->assign('form_submit',$dosubmit);
		$this->cismarty->assign ( 'sel', $data );
		$this->cismarty->assign ( 'infolist', $order_list );
		$this->cismarty->assign ( 'infopage', $list ['page'] );
		$this->cismarty->display ( 'order/order/order_today.html' );
	}
	
	/**
	 * 订单详情---ok
	 */
	public function info() {
		$order_id = $this->input->get ( 'order_id' );
		$act=$this->input->get('act');
		$order_id = intval ( $order_id );
		$this->load->model ( 'a_orders_model' );
		$order_info = $this->a_orders_model->get_one ( array (
				'order_id' => $order_id 
		), $this->tb_order );

		if (! empty ( $order_info )) {
			$order_address_info = $this->a_orders_model->get_one ( array ('oadd_id' => $order_id ), $this->tb_order_address );
			$order_goods_list = $this->a_orders_model->get_query ( array ('order_id' => $order_id ), $this->tb_order_goods );
			$order_log_list = $this->a_orders_model->get_query ( array ('order_id' => $order_id ), $this->tb_order_log );
			foreach($order_goods_list as $key => $val){
				$tonsspec_id = $val['spec_id'];
				//获取价格库中规则名称
				$tonsspec_info=$this->a_orders_model->get_one(array('id' => $tonsspec_id),$this->tb_price);
				$order_goods_list[$key]['spec_tons']=empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'];
				$order_goods_list[$key]['sub_total'] = sprintf('%.2f',$val['goods_price'] * $val['goods_num']);
			}
			$invoice = unserialize($order_info['invoice']);
			$this->cismarty->assign ( 'order_id', $order_id );
			$this->cismarty->assign ( 'order_state_name', $this->getstatename ( $order_info ['order_state'] ) );
			$this->cismarty->assign ( 'oinfo', $order_info );
			$this->cismarty->assign ( 'ainfo', $order_address_info );
			$this->cismarty->assign ('invoice', $invoice);
			$this->cismarty->assign ( 'goodslist', $order_goods_list );
			$this->cismarty->assign ( 'logslist', $order_log_list );
			
			$this->cismarty->display ( 'order/order/order_info.html' );
		} else {
			$this->showmessage ( 'goback', lang ( 'com_parameter' ), HTTP_REFERER );
		}
	}
	/**
	*订单 打印
	*/
	public function orderprint(){
		$order_id = $this->input->get ( 'oid' );
		$order_id = intval ( $order_id );
		$this->load->model ( 'a_orders_model' );
		$admin_name = $this->session->userdata('admin_username');
		$order_info = $this->a_orders_model->get_one ( array ('order_id' => $order_id ), $this->tb_order );
	  $num_total = 0;
	  $amount_total = 0;
		if (! empty ( $order_info )) {
			$order_address_info = $this->a_orders_model->get_one ( array ('oadd_id' => $order_id ), $this->tb_order_address );
			$order_goods_list = $this->a_orders_model->get_query ( array ('order_id' => $order_id ), $this->tb_order_goods );
			$user_info = $this->a_orders_model->get_one(array('user_id' => $order_info['buyer_id']),'user');
			$order_info['comp_name'] = empty($user_info['web']) ? '暂未填写' : $user_info['web'];
			foreach($order_goods_list as $key => $val){
				$tonsspec_id = $val['spec_id'];
				//获取价格库中规则名称
				$tonsspec_info=$this->a_orders_model->get_one(array('id' => $tonsspec_id),$this->tb_price);
				$order_goods_list[$key]['spec_tons']=empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'];
				$order_goods_list[$key]['sub_total'] = $val['goods_price'] * $val['goods_num'];
				$num_total += $val['goods_num'];
				$amount_total += $val['goods_price'] * $val['goods_num'];
			}
			$order_info['num_total'] = $num_total;
			$order_info['amount_total'] = $amount_total;
			$order_info['admin_name'] = $admin_name;
			$this->cismarty->assign ( 'order_id', $order_id );
			$this->cismarty->assign ( 'order_state_name', $this->getstatename ( $order_info ['order_state'] ) );
			$this->cismarty->assign ( 'oinfo', $order_info );
			$this->cismarty->assign ( 'ainfo', $order_address_info );
			$this->cismarty->assign ( 'goodslist', $order_goods_list );
			
			$this->cismarty->display ( 'order/order/order_print.html' );
		} else {
			$this->showmessage ( 'goback', lang ( 'com_parameter' ), HTTP_REFERER );
		}
	}
	//订单删除--ok
	public function order_del() {
		$_data_post = $this->input->post ();
		$user_id = isset ( $_data_post ['del_id'] ) ? $_data_post ['del_id'] : null;
		$this->load->model ( 'a_orders_model' );
		foreach ( $user_id as $val ) {
			$return = $this->a_orders_model->update ( array (
					'order_id' => $val 
			), array (
					'sts' => '1' 
			), 'order' );
		}
		$this->showmessage ( 'order_list', lang ( 'com_del' ), $this->admin_url . 'order/order/lists?loghash=' . $this->session->userdata ( 'loghash' ) );
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
	//退货单列表
	public function order_returns_list() {
		$this->load->model ( 'a_orders_model' );
		$this->load->library ( 'ichar' );
		$page = $this->input->get ( 'page' );
		$page = $this->ichar->act ( $page, 'int' );
		$act = $this->input->get ( 'act' );
		$act = $act?$act:0;
		$sel ['page'] = $page;
		$sel ['pagesize'] = 10;
		$sel ['sts']=$act;
		$sel ['fields']=' o.returns_id,o.order_id,o.return_sn,o.goods_id,o.return_goodsnum,o.add_time,o.update_time,o.re_state,o.sts,g.goods_name,g.goods_num,g.goods_price';
		if (isset ( $_POST ['dosubmit'] )) {
			
			$order_sn = $this->input->get_post ( 'order_sn' ); // 订单编号
			$status = $this->input->get_post ( 'status' ); // 订单状态
			
			$add_time_st = $this->input->get_post ( 'add_time_st' ); // 处理时间开始
			$add_time_en = $this->input->get_post ( 'add_time_en' ); // 处理时间结束
			
			$sel ['order_sn'] = $order_sn;
			$sel ['status'] = strlen ( $status ) == 0 ? '-1' : intval ( $status );
			$sel ['add_time_st'] = $add_time_st;
			$sel ['add_time_en'] = $add_time_en;
			$this->cismarty->assign ( 'sel', $sel );
			$this->cismarty->assign ( 'dosubmit', $_POST ['dosubmit'] );
			$refund_info = $this->a_orders_model->get_returns_search ( $sel );
			
		} else {
			$refund_info = $this->a_orders_model->get_returns_search ( $sel );
		}
		  
		if (! empty ( $refund_info ['list'] )) {
			foreach ( $refund_info ['list'] as $k => $v ) {
				$refund_info ['list'] [$k] = $v;
				$refund_info ['list'] [$k] ['state_name'] = $this->getstatenames ( $v ['re_state'] );
			}
		}
		$arr=$this->getstatenames('6');
		if($act==0){
			$url="order/order/order_returns_list.html";
		}else{
			$url="order/order/order_returns_recycle.html";
		}
		$this->cismarty->assign ( 'arr', $arr );
		$this->cismarty->assign ( 'refund_info', $refund_info ['list'] );
		$this->cismarty->display ( $url );
	}
	//退货单查看
	public function order_returns_look() {
		$this->load->model ( 'a_orders_model' );
		$return_sn = $this->input->get ( 'return_sn' );
		
		$returns_info = $this->a_orders_model->get_one ( array (
				'return_sn' => $return_sn 
		), $this->tb_returns );
		$goods_info = $this->a_orders_model->get_one ( array (
					'order_id' => $returns_info['order_id'],'goods_id'=>$returns_info['goods_id']
		), 'order_goods');

			$this->cismarty->assign ( 'goods_info', $goods_info );
			$this->cismarty->assign ( 'returns_info', $returns_info);	
			$this->cismarty->display ( 'order/order/order_returns_look.html' );
		
	}
	//退货单删除
	public function returns_del() {
		$act = $this->input->get ( 'act' );
		$act=$act?$act:0;
		$_data_post = $this->input->post ();
		$del_id = isset ( $_data_post ['del_id'] ) ? $_data_post ['del_id'] : null;	
		if ($del_id !== false) {
			foreach ( $del_id as $val ) {
				$data = array('sts' => $act);
				$return = $this->a_orders_model->update(array('returns_id'=>$val),$data,$this->tb_returns);
			}
	     	if($act==1){
			    $this->showmessage ( '','删除操作成功', $this->admin_url . 'order/order/order_returns_list?loghash=' . $this->session->userdata ( 'loghash' ) );
			 }else if($act==0){
			    $this->showmessage ( '','数据恢复成功', $this->admin_url . 'order/order/order_returns_list?loghash=' . $this->session->userdata ( 'loghash' ).'&act=1');
			}	
		} else {
			$this->showmessage ( 'order', lang ( 'com_parameter' ), HTTP_REFERER );
		}
		
	}
	//退货单状态修改
	public function return_state(){
	   $re_state=$this->input->post('re_state');
	   $return_sn=$this->input->get('return_sn');
	   $return_info=$this->a_orders_model->get_one(array('return_sn' => $return_sn),'returns');
		 $return_num = empty($return_info['return_goodsnum']) ? 0 : $return_info['return_goodsnum'];
		 $rec_id = empty($return_info['rec_id']) ? 0 : $return_info['rec_id'];
		 $order_id = empty($return_info['order_id']) ? 0 : $return_info['order_id'];
		 $user_id = empty($return_info['user_id']) ? 0 : $return_info['user_id'];
		 //获取订单产品信息
		 $order_goods = $this->a_orders_model->get_one(array('rec_id' => $rec_id),'order_goods');
	   //状态：2/4--未通过/取消时--（更新订单产品数量--更新订单状态）
	   //状态：3--通过（更新订单状态、会员帐户退款）
	   if($re_state == 3){
	   		$ogoods_price = empty($order_goods['goods_price']) ? 0 : $order_goods['goods_price'];
	   		$return_price = $ogoods_price * $return_num;
	   		//获取会员帐户信息
	   		$user_info=$this->a_orders_model->get_one(array('user_id' => $user_id),'user');
	   		$user_money = empty($user_info['available_predeposit']) ? 0 : $user_info['available_predeposit'];
	   		$user_money = $user_money + $return_price;
	   		//更新会员帐户余额
	   		$this->a_orders_model->update(array('user_id' => $user_id), array('available_predeposit' => $user_money), 'user');
	 	 } else {
				$ogoods_num = empty($order_goods['goods_num']) ? 0 : $order_goods['goods_num'];
				$ogoods_num = $ogoods_num + $return_num;
				//更新订单产品数量
				$this->a_orders_model->update(array('rec_id' => $rec_id), array('goods_num' => $ogoods_num), 'order_goods');		
	 	 }
	 	 //更新订单状态
		 $this->a_orders_model->update(array('order_id' => $order_id), array('re_state' => $re_state), 'order');
	   //退货单信息修改
	   $dat['re_state']=$re_state;
	   $dat['return_message']=$this->input->post('return_message');
	   $dat['update_time']=time();
	   $dat['admin_name']=$this->session->userdata('admin_username');
	   $res=$this->a_orders_model->update ( array ('return_sn'=>$return_sn),$dat ,'returns');
	   if($res>0){
	   		$this->showmessage ( '','修改成功', $this->admin_url . 'order/order/order_returns_list?loghash=' . $this->session->userdata ( 'loghash' ));
     }
	}
	
	//返修单列表
	public function order_fix_list() {
		$this->load->model ( 'a_orders_model' );
		$this->load->library ( 'ichar' );
		$page = $this->input->get ( 'page' );
		$page = $this->ichar->act ( $page, 'int' );
		$act = $this->input->get ( 'act' );
		$act = $act?$act:0;
		$sel ['page'] = $page;
		$sel ['pagesize'] = 10;
		$sel ['sts']=$act;
		$sel ['fields']=' o.returns_id,o.order_id,o.return_sn,o.goods_id,o.return_goodsnum,o.add_time,o.update_time,o.re_state,o.sts,g.goods_name,g.goods_num,g.goods_price';
		if (isset ( $_POST ['dosubmit'] )) {
			
			$order_sn = $this->input->get_post ( 'order_sn' ); // 订单编号
			$status = $this->input->get_post ( 'status' ); // 订单状态
			
			$add_time_st = $this->input->get_post ( 'add_time_st' ); // 处理时间开始
			$add_time_en = $this->input->get_post ( 'add_time_en' ); // 处理时间结束
			
			$sel ['order_sn'] = $order_sn;
			$sel ['status'] = strlen ( $status ) == 0 ? '-1' : intval ( $status );
			$sel ['add_time_st'] = $add_time_st;
			$sel ['add_time_en'] = $add_time_en;
			$this->cismarty->assign ( 'sel', $sel );
			$this->cismarty->assign ( 'dosubmit', $_POST ['dosubmit'] );
			$refund_info = $this->a_orders_model->get_fix_search ( $sel );
			
		} else {
			$refund_info = $this->a_orders_model->get_fix_search ( $sel );
		}
		  
		if (! empty ( $refund_info ['list'] )) {
			foreach ( $refund_info ['list'] as $k => $v ) {
				$refund_info ['list'] [$k] = $v;
				$refund_info ['list'] [$k] ['state_name'] = $this->getstatenames ( $v ['re_state'] );
			}
		}
		$arr=$this->getstatenames('6');
		if($act==0){
			$url="order/order/order_fix_list.html";
		}else{
			$url="order/order/order_fix_recycle.html";
		}
		$this->cismarty->assign ( 'arr', $arr );
		$this->cismarty->assign ( 'refund_info', $refund_info ['list'] );
		$this->cismarty->display ( $url );
	}
	//返修单查看
	public function order_fix_look() {
		$this->load->model ( 'a_orders_model' );
		$return_sn = $this->input->get ( 'return_sn' );
		
		$returns_info = $this->a_orders_model->get_one ( array (
				'return_sn' => $return_sn 
		), $this->tb_fix );
		$goods_info = $this->a_orders_model->get_one ( array (
					'order_id' => $returns_info['order_id'],'goods_id'=>$returns_info['goods_id']
		), 'order_goods');

			$this->cismarty->assign ( 'goods_info', $goods_info );
			$this->cismarty->assign ( 'returns_info', $returns_info);	
			$this->cismarty->display ( 'order/order/order_fix_look.html' );
		
	}
	//返修单删除
	public function fix_del() {
		$act = $this->input->get ( 'act' );
		$act=$act?$act:0;
		$_data_post = $this->input->post ();
		$del_id = isset ( $_data_post ['del_id'] ) ? $_data_post ['del_id'] : null;	
		if ($del_id !== false) {
			foreach ( $del_id as $val ) {
				$data = array('sts' => $act);
				$return = $this->a_orders_model->update(array('returns_id'=>$val),$data,$this->tb_returns);
			}
	     	if($act==1){
			    $this->showmessage ( '','删除操作成功', $this->admin_url . 'order/order/order_fix_list?loghash=' . $this->session->userdata ( 'loghash' ) );
			 }else if($act==0){
			    $this->showmessage ( '','数据恢复成功', $this->admin_url . 'order/order/order_fix_list?loghash=' . $this->session->userdata ( 'loghash' ).'&act=1');
			}	
		} else {
			$this->showmessage ( 'order', lang ( 'com_parameter' ), HTTP_REFERER );
		}
		
	}
	//返修单状态修改
	public function fix_state(){
	   $re_state=$this->input->post('re_state');
	   $return_sn=$this->input->get('return_sn');
	   $dat['re_state']=$re_state;
	   $dat['return_message']=$this->input->post('return_message');
	   $dat['update_time']=time();
	   $dat['admin_name']=$this->session->userdata('admin_username');
	   $res=$this->a_orders_model->update ( array ('return_sn'=>$return_sn),$dat ,'fix');
	   if($res>0){
	    $this->showmessage ( '','修改成功', $this->admin_url . 'order/order/order_fix_list?loghash=' . $this->session->userdata ( 'loghash' ));
	   
       }
	}

	private function get_collection($type = 0) {
		$arr = array (
		        '10' => '未付款',
				'20' => '已审核',
				'30' => '已发货',
				'40' => '已开票',
				'50' => '取消',
				'60' => '已确认' 
		);
		if($type==0){
		return $arr;
		}
		return isset ( $arr [$type] ) ? $arr [$type] : '';
	}
	private function getstatenames($type = 0) {
		$arr = array (
				'0' => '未审核',
				'1' => '审核中',
				'2' => '未通过',
				'3' => '通过',
				'4' => '取消'				
		);
		if($type==6){
	     	return $arr;
		}
		return isset ( $arr [$type] ) ? $arr [$type] : '';
	}
	public function refundment_del() {
		$act = $this->input->get ( 'act' );
		$act=$act?$act:0;
		$_data_post = $this->input->post ();
		$del_id = isset ( $_data_post ['del_id'] ) ? $_data_post ['del_id'] : null;
		
		if ($del_id !== false) {	
			foreach ( $del_id as $val ) {
				$data = array('sts' => $act);
				$return = $this->a_orders_model->update(array('log_id'=>$val),$data,$this->tb_refund_log);
			}
			if($act==1){
			   $this->showmessage ( '','删除操作成功', $this->admin_url . 'orders/order/order_refundment_list?loghash=' . $this->session->userdata ( 'loghash' ) );
			}else if($act==0){
			   $val='数据恢复成功';
			   $this->showmessage ( '',$val, $this->admin_url . 'orders/order/order_refundment_list?loghash=' . $this->session->userdata ( 'loghash' ).'&act=1' );
			}
		} else {
			$this->showmessage ( 'order', lang ( 'com_parameter' ), HTTP_REFERER );
		}
		
	}
	public function collection_del(){	
	    $act = $this->input->get ( 'act' );
		$act=$act?$act:0;
		$_data_post = $this->input->post ();
		$del_id = isset ( $_data_post ['del_id'] ) ? $_data_post ['del_id'] : null;	
		if ($del_id !== false) {
			foreach ( $del_id as $val ) {
				$data = array('sts' => $act);
				$return = $this->a_orders_model->update(array('order_sn'=>$val),$data,$this->tb_gold_payment_log);
			}
	     	if($act==1){
			  $this->showmessage ( '','删除操作成功', $this->admin_url . 'orders/order/order_collection_list?loghash=' . $this->session->userdata ( 'loghash' ));
			 }else if($act==0){
			   $this->showmessage ( '','订单恢复成功', $this->admin_url . 'orders/order/order_collection_list?loghash=' . $this->session->userdata ( 'loghash' ).'&act=1' );
			}	
		} else {
			$this->showmessage ( 'order', lang ( 'com_parameter' ), HTTP_REFERER );
		}
		
	}
	public function delivery_del(){	
	    $act = $this->input->get ( 'act' );
		$act=$act?$act:0;
		$_data_post = $this->input->post ();
		$del_id = isset ( $_data_post ['del_id'] ) ? $_data_post ['del_id'] : null;	
		if ($del_id !== false) {
			foreach ( $del_id as $val ) {
				$data = array('sts' => $act);
				$return = $this->a_orders_model->update(array('order_sn'=>$val),$data,$this->tb_delivery_log);
			}
	     	if($act==1){
			  $this->showmessage ( '','删除操作成功', $this->admin_url . 'orders/order/order_delivery_list?loghash=' . $this->session->userdata ( 'loghash' ));
			 }else if($act==0){
			   $this->showmessage ( '','订单恢复成功', $this->admin_url . 'orders/order/order_delivery_list?loghash=' . $this->session->userdata ( 'loghash' ).'&act=1' );
			}	
		} else {
			$this->showmessage ( 'order', lang ( 'com_parameter' ), HTTP_REFERER );
		}
		
	}
	//修改订单状态---ok
	public function state_next(){
	    $order_sn=$this->input->get('order_sn');
	    $arr_time = array();
			$order_info=$this->a_orders_model->get_one(array('order_sn'=>$order_sn),'order');
		   switch($order_info['order_state']){
			 	case '10':
			    $val=20; 
			    $arr_time = array('payment_time' => time(),'order_state' => $val);
			    //更新用户余额
			    $order_amount = empty($order_info['goods_amount']) ? 0 : $order_info['goods_amount'];
			    $order_userid = $order_info['buyer_id'];
			    $user_info=$this->a_orders_model->get_one(array('user_id' => $order_userid),'user');
			    $user_balance = empty($user_info['available_predeposit']) ? 0 : $user_info['available_predeposit'];
			    $user_balance = floatval($user_balance) - floatval($order_amount);
			    $userres=$this->a_orders_model->update(array('user_id' => $order_userid),array('available_predeposit' => $user_balance),'user');
					break;//待确认 下一步是已付款 
				case '20':
				  $val=30;
				  $arr_time = array('shipping_time' => time(),'order_state' => $val);
				  break;//已付款 下一步是已发货
			 	case '30':
 					$val=40; 
 					$arr_time = array('evaluation_time' => time(),'order_state' => $val);
				 	break;//已发货 下一步是已收货
			 	case '40':
			    $val=60; 
			    $arr_time = array('finnshed_time' => time(),'order_state' => $val);
			    break;//已收货 下一步是已确认 
		   }
		  
		$res=$this->a_orders_model->update(array('order_sn' => $order_sn),$arr_time,'order');
		if($res>0){
		  $this->showmessage ( '','状态修改成功', $this->admin_url . 'order/order/lists?loghash=' . $this->session->userdata ( 'loghash' ));	
		}
	}
	
	public function order_logistics_add(){
	   $order_id=$this->input->get_post('order_id');
		 $order_info=$this->a_orders_model->get_one(array('order_id'=>$order_id),'order','order_sn');
		 $order_sn=$order_info['order_sn'];
		 $shipping_info=$this->input->post();
		 if($shipping_info['order_state']==20){
		    $this->a_orders_model->add(array('order_sn'=>$order_sn),'delivery_log');
		    $shipping_info['order_state']=30;
		 }
		 $shipping_info['shipping_time']=time();
		 $url=$this->admin_url . 'orders/order/lists/?loghash=' . $this->session->userdata ( 'loghash' );
		 $res=$this->a_orders_model->update(array('order_sn'=>$order_sn),$shipping_info,'order');		
		if($res>0){
		    $this->showmessage ('','状态修改成功', $this->admin_url . 'orders/order/lists?loghash=' . $this->session->userdata ( 'loghash' ));
		 }    
		 
	}
	
	public function order_remove(){
		$orderId = intval($this->input->get('orderId'));
		$orderNo = $this->input->get('orderNo');
		$this->load->model('a_member_model');
		$check_order = $this->a_member_model->get_one(array('order_id'=>$orderId, 'order_sn'=>$orderNo, 'sts'=>0), 'order');
		if (count($check_order)) {
			$this->a_member_model->update(array('order_id'=>$orderId, 'order_sn'=>$orderNo,'sts'=>0), array('order_state'=>'50'), 'order');
			$arr['msg'] = 'success';
		}else {
			$arr['msg'] = 'fail';
		}
		echo json_encode($arr);
	}
	//申请退货
	public function apply_return(){
		if(isset($_POST['dosubmit'])){
			$goods_id = $this->input->post('goods_id');//商品id
	  	$order_id = $this->input->post('order_id');//订单ID
	  	$rec_id = $this->input->post('rec_id');//订单ID
	 		$goods_info=$this->a_orders_model->get_one(array('goods_id' => $goods_id,'order_id' => $order_id),'order_goods');
	 		$order_info=$this->a_orders_model->get_one(array('order_id' => $order_id),'order');

	 		$returns_state='1';
	   	$this->a_orders_model->update(array('rec_id' => $rec_id),array('returns_state' => $returns_state),'order_goods');
			$arr['buyer_message']=$this->input->post('return_msg');//退货留言
	 		$arr['add_time']=time();//申请时间
	 		$arr['return_sn']=uniqid();//退货编号
	 		$arr['order_id'] = $order_id;
	 		$arr['goods_id'] = $goods_id;
	 		$arr['rec_id'] = $rec_id;
	 		$arr['order_sn'] = $order_info['order_sn'];
	 		$arr['user_id'] = $order_info['buyer_id'];
	 		$arr['buyer_name'] = $order_info['buyer_name'];
	 		$arr['return_goodsnum'] = $this->input->post('retrun_num');
	 		$res=$this->a_orders_model->add($arr,'returns');
    	
    	$this->showmessage('adddialog',lang('com_success'),HTTP_REFERER);
    }else{
    		$rec_id=$this->input->get('rec_id');
    		$rec_id=intval($rec_id);
    		if($rec_id>0){
					$this->load->model('a_orders_model');
					$info=$this->a_orders_model->get_one(array('rec_id' => $rec_id),'order_goods');
					if(!empty($info)){
						$this->cismarty->assign('info',$info);
						$this->cismarty->display('order/order/apply_return.html');
						return;
					}
				}
			$this->showmessage('error',lang('com_parameter'),$this->admin_url.'order/order/lists?loghash='.$this->session->userdata('loghash'));
    }
	}
	//申请返修
	public function apply_fix(){
		if(isset($_POST['dosubmit'])){
			$goods_id = $this->input->post('goods_id');//商品id
	  	$order_id = $this->input->post('order_id');//订单ID
	  	$rec_id = $this->input->post('rec_id');//订单ID
	 		$goods_info=$this->a_orders_model->get_one(array('goods_id' => $goods_id,'order_id' => $order_id),'order_goods');
	 		$order_info=$this->a_orders_model->get_one(array('order_id' => $order_id),'order');

	 		$returns_state='1';
	   	$this->a_orders_model->update(array('rec_id' => $rec_id),array('returns_state' => $returns_state),'order_goods');
			$arr['buyer_message']=$this->input->post('fix_msg');//退货留言
	 		$arr['add_time']=time();//申请时间
	 		$arr['return_sn']=uniqid();//退货编号
	 		$arr['order_id'] = $order_id;
	 		$arr['goods_id'] = $goods_id;
	 		$arr['rec_id'] = $rec_id;
	 		$arr['order_sn'] = $order_info['order_sn'];
	 		$arr['user_id'] = $order_info['buyer_id'];
	 		$arr['buyer_name'] = $order_info['buyer_name'];
	 		$arr['return_goodsnum'] = $this->input->post('fix_num');
	 		$res=$this->a_orders_model->add($arr,'fix');
    	
    	$this->showmessage('adddialog',lang('com_success'),HTTP_REFERER);
    }else{
    		$rec_id=$this->input->get('rec_id');
    		$rec_id=intval($rec_id);
    		if($rec_id>0){
					$this->load->model('a_orders_model');
					$info=$this->a_orders_model->get_one(array('rec_id' => $rec_id),'order_goods');
					if(!empty($info)){
						$this->cismarty->assign('info',$info);
						$this->cismarty->display('order/order/apply_fix.html');
						return;
					}
				}
			$this->showmessage('error',lang('com_parameter'),$this->admin_url.'order/order/lists?loghash='.$this->session->userdata('loghash'));
    }
	}
	//订单详情页动态改价
	public function ajax_change_price(){
		$rec_id = $this->input->get('rec_id');
		$goods_price = $this->input->get('goods_price');
		$rec_id = intval($rec_id);
		$sub_total = 0;
		$order_total = 0;
		$data = array();
		//更新价格
		$return = $this->a_orders_model->update (array('rec_id' => $rec_id), array ('goods_price' => $goods_price), 'order_goods');
		//获取订单产品信息
		$order_goods_info = $this->a_orders_model->get_one(array('rec_id' => $rec_id),'order_goods');
		//根据订单产品中的订单，计算并更新订单总金额
		$order_id = $order_goods_info['order_id'];
		$order_goods_list = $this->a_orders_model->get_query ( array ('order_id' => $order_id ), $this->tb_order_goods );
		foreach($order_goods_list as $key => $val){
			$s_recid = $val['rec_id'];
			if($s_recid == $rec_id){
				$sub_total = $val['goods_price'] * $val['goods_num'];
			}
			$order_total += $val['goods_price'] * $val['goods_num'];
		}
		//更新价格
		$return2 = $this->a_orders_model->update (array('order_id' => $order_id), array ('goods_amount' => $order_total), 'order');
		$data['sub_total'] = round($sub_total,2);
		$data['order_total'] = round($order_total,2);
		
		echo json_encode($data);
	}
	//订单详情页动态改数量
	public function ajax_change_num(){
		$rec_id = $this->input->get('rec_id');
		$goods_num = $this->input->get('goods_num');
		$rec_id = intval($rec_id);
		$sub_total = 0;
		$order_total = 0;
		$data = array();
		//更新价格
		$return = $this->a_orders_model->update (array('rec_id' => $rec_id), array ('goods_num' => $goods_num), 'order_goods');
		//获取订单产品信息
		$order_goods_info = $this->a_orders_model->get_one(array('rec_id' => $rec_id),'order_goods');
		//根据订单产品中的订单，计算并更新订单总金额
		$order_id = $order_goods_info['order_id'];
		$order_goods_list = $this->a_orders_model->get_query ( array ('order_id' => $order_id ), $this->tb_order_goods );

		foreach($order_goods_list as $key => $val){
			$s_recid = $val['rec_id'];
			if($val['rec_id'] == $rec_id){
				$sub_total = $val['goods_price'] * $val['goods_num'];
			}
			$order_total += $val['goods_price'] * $val['goods_num'];
		}
		//更新价格
		$return2 = $this->a_orders_model->update (array('order_id' => $order_id), array ('goods_amount' => $order_total), 'order');
		$data['sub_total'] = round($sub_total,2);
		$data['order_total'] = round($order_total,2);
		
		echo json_encode($data);
	}
	
}