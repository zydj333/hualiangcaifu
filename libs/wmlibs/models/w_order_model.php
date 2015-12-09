<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class w_order_model extends MY_model {

	/**
	 * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
 		parent::__construct();
    }


	/**
	 * 订单日志
	 */
	public function logOrderResult($order_id,$order_state,$change_state,$state_info,$operator){
		$data['order_id']=$order_id;
		$data['order_state']=$order_state;
		$data['change_state']=$change_state;
		$data['state_info']=$state_info;
		$data['operator']=$operator;
		$data['log_time']=time();
		$this->add($data,'order_log');
	}

	/**
	 * 网上支付相关信息写入日志表
	 */
	public function logPayResult($order_sn,$payment_code,$logsign,$log_notice){
		$data['order_sn']=$order_sn;
		$data['payment_code']=$payment_code;
		$data['log_sign']=$logsign;
		$data['log_notice']=$log_notice;
		$data['log_time']=time();
		$this->add($data,'payment_log');
	}

	/**
	 * 网上支付相关信息写入日志表
	 * 网站支付日志：积分商城、以及预存款
	 */
	public function logGoldPayResult($order_sn,$payment_code,$logsign,$log_notice){
		$data['order_sn']=$order_sn;
		$data['payment_code']=$payment_code;
		$data['log_sign']=$logsign;
		$data['log_notice']=$log_notice;
		$data['log_time']=time();
		$this->add($data,'gold_payment_log');
	}

	/**
	 * 购物消费赠送 添加积分
	 */
	public function logPointsResult($pointscount,$buyer_id,$buyer_name){

		if($pointscount>0){
			$pglog['pl_memberid']=$buyer_id;
			$pglog['pl_membername']=$buyer_name;
			$pglog['pl_adminid']=0;
			$pglog['pl_adminname']='';
			$pglog['pl_points']=intval($pointscount);
			$pglog['pl_addtime']=time();
			$pglog['pl_desc']='购物消费赠送';
			$pglog['pl_stage']='order';
			$pglog['sts']=0;
			$this->add($pglog,'points_log');
		}
	}

	/**
	 * 预存款充值日志
	 */
	public function logPredepositResult($price,$buyer_id,$buyer_name){

		$pdr_log['pdlog_membername'] =  $buyer_name;
		$pdr_log['pdlog_memberid'] = $buyer_id;
		$pdr_log['pdlog_adminid'] = 0;
		$pdr_log['pdlog_adminname'] = 0;
		$pdr_log['pdlog_stage'] = 'recharge';
		$pdr_log['pdlog_desc'] ='会员充值';
		$pdr_log['pdlog_addtime'] = SYS_TIME;
		$pdr_log['pdlog_type'] = 1;
		$pdr_log['pdlog_price'] = $price;
		$pdr_log['pdlog_addtime'] = time();
		$this->add($pdr_log,'predeposit_log');

	}


	/**
	 * 提交订单或取消订单,更新商品库存数量
	 */
	public function updateGoodsStorage($spec_id,$goods_id,$goodsnum,$type='sub'){
		if($type=='sub'){//增加时候使用
			$this->_db_write->set('spec_goods_storage','spec_goods_storage - '.$goodsnum,false);
			$this->_db_write->set('spec_salenum','spec_salenum + '.$goodsnum,false);
			$this->_db_write->where('spec_id',$spec_id);
			$this->_db_write->where('goods_id',$goods_id);
			$this->_db_write->update('goods_spec');

		}else{//取消订单时候使用
			$this->_db_write->set('spec_goods_storage','spec_goods_storage + '.$goodsnum,false);
			$this->_db_write->set('spec_salenum','spec_salenum - '.$goodsnum,false);
			$this->_db_write->where('spec_id',$spec_id);
			$this->_db_write->where('goods_id',$goods_id);
			$this->_db_write->update('goods_spec');
		}
	}

	/**
	 * 提交订单或取消订单,更新商品团购库存数量
	 */
	public function updateGroupbuyStorage($group_id,$goodsnum,$type='sub'){
		if($type=='sub'){//增加时候使用
			$this->_db_write->set('buyer_count','buyer_count + '.$goodsnum,false);
			$this->_db_write->set('def_quantity','def_quantity + 1',false);
			$this->_db_write->set('max_num','max_num - '.$goodsnum,false);
			$this->_db_write->where('group_id',$group_id);
			$this->_db_write->update('goods_group');

		}else{//取消订单时候使用
			$this->_db_write->set('buyer_count','buyer_count - '.$goodsnum,false);
			$this->_db_write->set('def_quantity','def_quantity - 1',false);
			$this->_db_write->set('max_num','max_num + '.$goodsnum,false);

			$this->_db_write->where('group_id',$group_id);
			$this->_db_write->update('goods_group');
		}
	}

}