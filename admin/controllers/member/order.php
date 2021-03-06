<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');

class Order extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('a_member_model');
		$this->load->model('goods_cate');
		$this->load->model('goods');
		$this->tb_price='goods_price_library';
		$this->tb_user = 'user';
		$this->tb_goods = 'goods';
		$this->tb_order_goods = 'order_goods';
		$this->tb_order_log = 'order_log';
		$this->tb_discount='user_group_discount';
	}
	//产品下单
	public function orderbook(){
	  $this->load->model('user');
	  $admin_username = $this->session->userdata('admin_username');
	  if(isset($_POST['dosubmit']) && $_POST['dosubmit']=='ok') {
	  	$spec_ku_tonsid = $this->input->post('spec_ku_tonsid');//规格ID
	  	$spec_ku_tons = $this->input->post('spec_ku_tons');//规格名称
	  	$spec_ku_smishu = $this->input->post('spec_ku_smishu');//标准米数
	  	$spec_ku_sprice = $this->input->post('spec_ku_sprice');//标准价格
	  	$spec_ku_sjiacha = $this->input->post('spec_ku_sjiacha');//每米价差
	  	$add_goodsid = $this->input->post('selprod');//当前产品
	  	$add_tonsid = $this->input->post('seltons');//当前规格ID
	  	$add_mishu = $this->input->post('add_mishu');//当前米数
	  	$add_numbs = $this->input->post('add_numbs');//当前数量
	  	$add_comment = $this->input->post('add_comment');//产品评论
	  	$addressid = $this->input->post('user_address');//收货地址
	  	$member_id=$this->input->post('user_name');//用户ID
	    $order = array();
	    $order_goods = array();
	    //查询买家信息
			$user_info = $this->a_member_model->get_one(array('user_id' => $member_id),$this->tb_user,'user_id,username,email,province_id');
			
			/******组装订单Start****/
			$sn = create_order_number();
			$order['order_sn'] = $sn;
			$order['buyer_id'] = empty($user_info['user_id']) ? 0 : $user_info['user_id'];
			$order['buyer_name'] = empty($user_info['username']) ? 'no name' : $user_info['username'];
			$order['buyer_email'] = empty($user_info['email']) ? 'nouser@gmail.com' : $user_info['email'];
			$order['province_id'] = empty($user_info['province_id']) ? 3133 : $user_info['province_id'];
			$order['add_time'] = SYS_TIME;
			$order['order_type'] = '';// 0.普通
			$order['order_message'] = '后台操作员【'.$admin_username.'】操作';
			$order['order_state'] = 10;
			$order['out_sn'] = 0;
			$order['payment_id'] = 0;
			$order['payment_code'] = '';
			$order['payment_name'] = '';
			$order['payment_direct'] = 0;
			$order['payment_time'] = 0;				
			$goods_amount=0;
			//组装订单产品数据
			$goods_info = $this->a_member_model->get_one(array('goods_id' => $add_goodsid),'goods');
			//获取产品的一、二级分类
			$first_cateid = 0;
			$second_cateid = 0;
			$goods_cate = empty($goods_info['gc_id']) ? 0 : $goods_info['gc_id'];
			$goods_cateinfo = $this->a_member_model->get_one(array('gc_id' => $goods_cate),'goods_category');
			if($goods_cateinfo['parent_id'] == 0){
				$first_cateid = $goods_cate;
			} else {
				$first_cateid = $goods_cateinfo['parent_id'];
				$second_cateid = $goods_cate;
			}
			$series_id = empty($goods_info['brand_id']) ? 0 : $goods_info['brand_id'];
			$member_discount = $this->calculate_cur_discount($member_id,$series_id);//用户折扣
	  	$order_goods['goods_id']=$goods_info['goods_id'];
			$order_goods['goods_name']=$goods_info['goods_name'];
			$order_goods['cate_id'] = $first_cateid;
			$order_goods['subcate_id'] = $second_cateid;
			$order_goods['spec_id']=$add_tonsid;
			$order_goods['spec_info']='';
			$order_goods['spec_mishu']=$add_mishu;
			$order_goods['goods_num']=$add_numbs;
			$order_goods['goods_image']=$goods_info['goods_image'];
			$order_goods['evaluation']=0;
			$order_goods['comment'] = $add_comment;
			$order_goods['evaluation_state']=0;
			$order_goods['evaluation_remark']='';
			$order_goods['goods_returnnum']=0;
			$goods_price = $this->calculate_cur_price($add_goodsid,$add_tonsid,$add_mishu);
			$order_goods['goods_price'] = round($goods_price * $member_discount,2);
			$order_goods['pre_price'] = round($goods_price * $member_discount,2);
			$goods_amount = $add_numbs * round($goods_price * $member_discount,2);
			//其余订单数据
			$order['goods_amount'] = $goods_amount;
			$order['discount'] = $member_discount;
			$order['order_pointscount']=0;
		  $order['shipping_code'] = '';
		  $order['shipping_company']='';
		  $order['shipping_remark'] = '';

			//写入订单操作状态
			$order_log['order_state'] = '已提交';
			$order_log['change_state'] = '待付款';
			$order_log['state_info'] = '';
			$order_log['log_time'] = SYS_TIME;
			$order_log['operator'] = empty($user_info['username']) ? 'no name' : $user_info['user_id'];
			//写入数据
			$order_id=$this->a_member_model->add($order,'order');
			if(intval($order_id)>0){
					$order_goods['order_id']=$order_id;
					$this->a_member_model->add($order_goods,$this->tb_order_goods);
					$order_log['order_id']=$order_id;
					$this->a_member_model->add($order_log,$this->tb_order_log);
					
					//保存收获地址
					$address_info = $this->a_member_model->get_one(array('address_id' => $addressid,'member_id' => $member_id,'sts'=>0),"address");
					if(!empty($address_info)){
						$_data = array(
							'oadd_id' => $order_id,
							'true_name' => $address_info['true_name'],	
							'area_id' => $address_info['area_id'],
							'area_info' => $address_info['area_info'],
							'address' => $address_info['address'],
							'zip_code' => $address_info['zip_code'],
							'tel_phone' => $address_info['tel_phone'],
							'mob_phone' => $address_info['mob_phone'],
							'order_id' => $sn
						);
						$this->a_member_model->add($_data, 'order_address');
					}
					
					$data['msg'] = '订单提交成功!';
					$this->showmessage('success',$data['msg'],$this->admin_url.'member/order/orderbook?loghash='.$this->session->userdata('loghash'));
				}else{
					$data['msg'] = '订单提交失败，请重新下单!';
					$this->showmessage('error',$data['msg'],$this->admin_url.'member/order/orderbook?loghash='.$this->session->userdata('loghash'));
				}
	  } else {
	  	//获取该管理员下的经销商
	  	$where = 'sts = 0 ';
			$admin_areaids = $this->session->userdata('admin_area_id');
			if(!empty($admin_areaids)){
				$where .= ' and province_id in ('.$admin_areaids.')';
			}
			$member_list = $this->a_member_model->get_query($where,$this->tb_user);
			//产品分类
	  	$goods_cate = $this->a_member_model->get_query(array('isshow'=>1,'parent_id' => 0,'order_by' => 'listorder asc'), 'goods_category');
	  	
	  	$this->cismarty->assign('member_list',$member_list);
	  	$this->cismarty->assign('goods_cate',$goods_cate);
	  	$this->cismarty->display('member/order/order_book.html');
	  }
	}
	//配件下单
	public function partsbook(){
	  $this->load->model('user');
	  $admin_username = $this->session->userdata('admin_username');
	  if(isset($_POST['dosubmit']) && $_POST['dosubmit']=='ok') {
	  	$add_parts = $this->input->post('add_parts');//当前配件名称
	  	$add_numbs = $this->input->post('add_numbs');//当前数量
	  	$add_comment = $this->input->post('add_comment');//产品评论
	  	$addressid = $this->input->post('user_address');//收货地址
	  	$member_id=$this->input->post('user_name');//用户ID
	    $order = array();
	    $order_goods = array();
	    //查询买家信息
			$user_info = $this->a_member_model->get_one(array('user_id' => $member_id),$this->tb_user,'user_id,username,email,province_id');
			/******组装订单Start****/
			$sn = create_order_number();
			$order['order_sn'] = $sn;
			$order['buyer_id'] = empty($user_info['user_id']) ? 0 : $user_info['user_id'];
			$order['buyer_name'] = empty($user_info['username']) ? 'no name' : $user_info['username'];
			$order['buyer_email'] = empty($user_info['email']) ? 'nouser@gmail.com' : $user_info['email'];
			$order['province_id'] = empty($user_info['province_id']) ? 3133 : $user_info['province_id'];
			$order['add_time'] = SYS_TIME;
			$order['order_type'] = '';// 0.普通
			$order['order_message'] = '后台操作员【'.$admin_username.'】操作';
			$order['order_state'] = 10;
			$order['out_sn'] = 0;
			$order['payment_id'] = 0;
			$order['payment_code'] = '';
			$order['payment_name'] = '';
			$order['payment_direct'] = 0;
			$order['payment_time'] = 0;				
			$goods_amount=0;
			//组装订单产品数据

	  	$order_goods['goods_id']=0;
			$order_goods['goods_name']=$add_parts;
			$order_goods['spec_id']=0;
			$order_goods['spec_info']='';
			$order_goods['spec_mishu']=0;
			$order_goods['goods_num']=$add_numbs;
			$order_goods['goods_image']='';
			$order_goods['evaluation']=0;
			$order_goods['comment'] = $add_comment;
			$order_goods['evaluation_state']=0;
			$order_goods['evaluation_remark']='';
			$order_goods['goods_returnnum']=0;
			$goods_price = 0;
			$order_goods['goods_price'] = 0;
			$goods_amount = 0;
			//其余订单数据
			$order['goods_amount'] = $goods_amount;
			$order['discount'] = 0;
			$order['order_pointscount']=0;
		  $order['shipping_code'] = '';
		  $order['shipping_company']='';
		  $order['shipping_remark'] = '';
			//写入订单操作状态
			$order_log['order_state'] = '已提交';
			$order_log['change_state'] = '待付款';
			$order_log['state_info'] = '';
			$order_log['log_time'] = SYS_TIME;
			$order_log['operator'] = empty($user_info['username']) ? 'no name' : $user_info['user_id'];
			//写入数据
			$order_id=$this->a_member_model->add($order,'order');
			if(intval($order_id)>0){
					$order_goods['order_id']=$order_id;
					$this->a_member_model->add($order_goods,$this->tb_order_goods);
					$order_log['order_id']=$order_id;
					$this->a_member_model->add($order_log,$this->tb_order_log);
					
					//保存收获地址
					$address_info = $this->a_member_model->get_one(array('address_id' => $addressid,'member_id' => $member_id,'sts'=>0),"address");
					if(!empty($address_info)){
						$_data = array(
							'oadd_id' => $order_id,
							'true_name' => $address_info['true_name'],	
							'area_id' => $address_info['area_id'],
							'area_info' => $address_info['area_info'],
							'address' => $address_info['address'],
							'zip_code' => $address_info['zip_code'],
							'tel_phone' => $address_info['tel_phone'],
							'mob_phone' => $address_info['mob_phone'],
							'order_id' => $sn
						);
						$this->a_member_model->add($_data, 'order_address');
					}
					
					$data['msg'] = '订单提交成功!';
					$this->showmessage('success',$data['msg'],$this->admin_url.'member/order/orderbook?loghash='.$this->session->userdata('loghash'));
				}else{
					$data['msg'] = '订单提交失败，请重新下单!';
					$this->showmessage('error',$data['msg'],$this->admin_url.'member/order/orderbook?loghash='.$this->session->userdata('loghash'));
				}
	  } else {
	  	//获取该管理员下的经销商
	  	$where = 'sts = 0 ';
			$admin_areaids = $this->session->userdata('admin_area_id');
			if(!empty($admin_areaids)){
				$where .= ' and province_id in ('.$admin_areaids.')';
			}
			$member_list = $this->a_member_model->get_query($where,$this->tb_user);

	  	$this->cismarty->assign('member_list',$member_list);
	  	$this->cismarty->display('member/order/parts_book.html');
	  }
	}
	//通过产品分类ID或取该分类及子分类下的产品
	public function ajax_cate(){
		$cate_id = $this->input->get('cate_id');
		$cate_id = intval($cate_id);
		$cateids_str = $cate_id;
		$where = 'sts = 0 and goods_show = 1 AND goods_state = 0 ';
    //获取子分类ID
    $goods_subcate = $this->a_member_model->get_query(array('parent_id'=>$cate_id, 'isshow'=>1, 'order_by'=>'listorder asc'), 'goods_category');
    foreach($goods_subcate as $k => $v){
    	$cateids_str .=  ','.$v['gc_id'];
    }
    $where .= ' and gc_id IN ('.$cateids_str.') ';
    //获取产品
    $goods_list = $this->a_member_model->get_query($where,'goods');
		
		echo json_encode($goods_list);
	}
	
	
	//通过产品所属价格系列，获取该价格系列的规格
	public function ajax_tons(){
		$goods_id = $this->input->get('goods_id');
		$goods_id = intval($goods_id);
		$goods_info = $this->a_member_model->get_one(array('goods_id' => $goods_id), 'goods');
		$goods_spec = empty($goods_info['brand_id']) ? 0 : $goods_info['brand_id'];
		
		$price_lib = array();
		if(!empty($goods_spec)){
			//获取规格
			$price_lib = $this->a_member_model->get_query(array('cateid' => $goods_spec),'goods_price_library');
		}
		
		echo json_encode($price_lib);
	}
	
	//通过规格ID，获取该规格的相关信息
	public function ajax_tons_info(){
		$tons_id = $this->input->get('tons_id');
		$tons_id = intval($tons_id);
		$spec_info = array();
		$spec_info = $this->a_member_model->get_one(array('id' => $tons_id), 'goods_price_library');
		
		echo json_encode($spec_info);
	}
	
	//通过用户ID，获取该用户的收货地址
	public function ajax_user_address(){
		$user_id = $this->input->get('user_id');
		$user_id = intval($user_id);

    //获取产品
    $address_list = $this->a_member_model->get_query(array('member_id'=> $user_id,'sts' => 0),'address');
		
		echo json_encode($address_list);
	}
	//shuangniao - 计算当前用户规格
	public function calculate_cur_discount($member_id,$series_id){
		$member_discount = 1;

		//计算会员折扣
		if($member_id > 0){
			$user_info = $this->a_member_model->get_one(array('user_id' => $member_id),'user');
			$user_group = empty($user_info['group']) ? 0 : $user_info['group'];
			if(!empty($user_group)){
				$discount_info = $this->a_member_model->get_one(array('group_id' => $user_group,'series_id' => $series_id),$this->tb_discount);
				$group_discount = empty($discount_info['discount']) ? 100 :  $discount_info['discount'];
				$member_discount = $group_discount/100;
			}
		}
		
		return $member_discount;
	}
	
	//shuangniao - 通过参数计算产品价格
	public function calculate_cur_price($goods_id,$tons_id,$mishu){
		$real_price = 0;
		$member_discount = 1;

		$goods_info = $this->a_member_model->get_one(array('goods_id' => $goods_id,'goods_show'=>1,'sts'=>0),'goods');
		$type_id = empty($goods_info['type_id']) ? 1 : $goods_info['type_id'];//产品价格计算方法
		//计算单个产品价格
		if($type_id == 2){//价格库计算方法
			$spectons_info = $this->a_member_model->get_one(array('id' => $tons_id),$this->tb_price);
			if(empty($mishu)){//只有吨位，直接获取价格
				$real_price = empty($spectons_info['price']) ? 0 : $spectons_info['price'];
			} else{//有米数
				$spectons_info_mishu = empty($spectons_info['stand_height']) ? 0 : $spectons_info['stand_height'];
				if($mishu < $spectons_info_mishu){//现有米数小于标准米数，直接获取价格
					$real_price = $spectons_info['price'];
				} else {//正常米数，标准价格+（现有米数-标准米数）×每米差价
					$real_price = $spectons_info['price'] + ($mishu - $spectons_info_mishu) * $spectons_info['each_price'];
				}
			}
		} else {//单价
			$real_price = empty($goods_info['goods_shop_price']) ? 0 : $goods_info['goods_shop_price'];
		}
		
		
		return $real_price;
	}
}