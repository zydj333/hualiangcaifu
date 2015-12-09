<?php
require_once(FCPATH."libs/wmlibs/libraries/payment/alipay_notify.class.php");
require_once(FCPATH."libs/wmlibs/libraries/payment/alipay_submit.class.php");

/**
 * @class alipay_lib
 * @brief 支付宝处理类
 */
class alipay_lib
{
	function __construct()
	{

	}

	/**
	 * 生成支付代码
	 */
	function get_pay_code($order_info,$pay_info,$order_address){

		/***设置支付宝config Start*****/
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式

		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';
		/***设置支付宝config End*****/

		//支付类型
        $payment_type = "1"; //1代表商品购买

        $notify_url = base_url()."payment/alipay_notify_url.php";
        $return_url = base_url()."payment/alipay_return_url.php";
        $seller_email = $alipay_account;
        $out_trade_no = $order_info['order_sn'] ;
		$CI = & get_instance();
		$CI->load->helper('global');


		$setup= getcache('setup','commons');
		if(intval($order_info['group_id'])>0)
			$subject = '团购订单 '.$order_info['order_sn'];//订单名称
		else
			$subject = '购物订单 '.$order_info['order_sn'];//订单名称
		if(!empty($setup)) $subject=$setup['site_name'].$subject;

        $price = $order_info['order_amount'];
        $quantity = "1"; //必填，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品

		//运费
        if(intval($order_address['shipping_fee'])==0){
        	 $logistics_payment = "SELLER_PAY";//卖家承担费用
        	 $logistics_fee = "0.00";
        }else{
        	$logistics_fee= $order_address['shipping_fee'];
 			$logistics_payment = "BUYER_PAY";//买家承担费用
        }
        //必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
       	$logistics_type=$this->get_transport_type($order_address['shipping_name']);

        $show_url = base_url()."index.php?m=member&c=order&a=my_order_info&order_id=".$order_info['order_id'];

		//收货人信息
        $receive_name = $order_address['true_name'];
        $receive_address = $order_address['area_info'].$order_address['address'];
        $receive_zip = $order_address['zip_code'];
        $receive_phone = $order_address['tel_phone'];
        $receive_mobile = $order_address['mob_phone'];

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		if($alipay_pay_method==1){
			//构造要请求的参数数组，无需改动
			$parameter = array(
					"service" => "trade_create_by_buyer",
					"partner" => trim($alipay_config['partner']),
					"payment_type"	=> $payment_type,
					"notify_url"	=> $notify_url,
					"return_url"	=> $return_url,
					"seller_email"	=> $seller_email,
					"out_trade_no"	=> $out_trade_no,
					"subject"	=> $subject,
					"price"	=> $price,
					"quantity"	=> $quantity,
					"logistics_fee"	=> $logistics_fee,
					"logistics_type"	=> $logistics_type,
					"logistics_payment"	=> $logistics_payment,
					"body"	=> '',//订单描述
					"show_url"	=> $show_url,
					"receive_name"	=> $receive_name,
					"receive_address"	=> $receive_address,
					"receive_zip"	=> $receive_zip,
					"receive_phone"	=> $receive_phone,
					"receive_mobile"	=> $receive_mobile,
					"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			);
		}elseif($alipay_pay_method==2){//担保交易接口
			//构造要请求的参数数组，无需改动
			$parameter = array(
					"service" => "create_partner_trade_by_buyer",
					"partner" => trim($alipay_config['partner']),
					"payment_type"	=> $payment_type,
					"notify_url"	=> $notify_url,
					"return_url"	=> $return_url,
					"seller_email"	=> $seller_email,
					"out_trade_no"	=> $out_trade_no,
					"subject"	=> $subject,
					"price"	=> $price,
					"quantity"	=> $quantity,
					"logistics_fee"	=> $logistics_fee,
					"logistics_type"	=> $logistics_type,
					"logistics_payment"	=> $logistics_payment,
					"body"	=> '',//订单描述
					"show_url"	=> $show_url, //商品展示地址
					"receive_name"	=> $receive_name,//收货人姓名
					"receive_address"	=> $receive_address,//收货人地址
					"receive_zip"	=> $receive_zip, //收货人邮编
					"receive_phone"	=> $receive_phone,//收货人电话号码
					"receive_mobile"	=> $receive_mobile,//收货人手机号码
					"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			);
		}elseif($alipay_pay_method==3){//即时到帐接口
	        //防钓鱼时间戳
	        $anti_phishing_key = $alipaySubmit->query_timestamp_pay_by();

	        //客户端的IP地址
	        $exter_invoke_ip = ip();
			//构造要请求的参数数组，无需改动
			$parameter = array(
					"service" => "create_direct_pay_by_user",
					"partner" => trim($alipay_config['partner']),
					"payment_type"	=> $payment_type,
					"notify_url"	=> $notify_url,
					"return_url"	=> $return_url,
					"seller_email"	=> $seller_email,
					"out_trade_no"	=> $out_trade_no,
					"subject"	=> $subject,
					"total_fee"	=> $price,
					"body"	=> '',
					"show_url"	=> $show_url,
					"anti_phishing_key"	=> $anti_phishing_key,
					"exter_invoke_ip"	=> $exter_invoke_ip,
					"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			);
		}

		$html_text = $alipaySubmit->buildRequestButton($parameter,"get", "确认支付");
		return $html_text;

	}

	/**
	 * 支付响应操作
	 */
	function post_respond_url($pay_info=''){

		$CI = & get_instance();
		$out_trade_no = $CI->input->get_post('out_trade_no');//商户订单号
		$CI->load->model('w_order_model');
		$order_info=$CI->w_order_model->get_one(array('order_sn'=>$out_trade_no),'order');
		if(empty($order_info))  return "fail";
		$pay_info =$CI->w_order_model->get_one(array('payment_code'=>'alipay','shop_id'=>$order_info['shop_id']),'payment');

		/***设置支付宝config Start*****/
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式

		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';
		/***设置支付宝config End*****/
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功

		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			$trade_no = $CI->input->get_post('trade_no');//支付宝交易号
			$trade_status = $CI->input->get_post('trade_status');//交易状态

			$payment_direct=1;//默认即时到帐
			if($alipay_pay_method==2){$payment_direct=2;}//担保交易
			if($alipay_pay_method==3){$payment_direct=1;}//即时到帐

			if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
				$submit_data['payment_id']=$pay_info['payment_id'];
				$submit_data['payment_name']=$pay_info['payment_name'];
				$submit_data['payment_code']=$pay_info['payment_code'];
				$submit_data['payment_direct']=$payment_direct;
				$submit_data['out_payment_code']=$trade_no;
				$submit_data['order_state']=11;

				$res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$submit_data,'order');
				if($res){
			        $CI->w_order_model->logOrderResult($order_info['order_id'],'已提交','待付款','买家已提交支付宝，待付款',$order_info['buyer_name']);
					$CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','WAIT_BUYER_PAY','买家已在支付宝交易管理中产生了交易记录，但没有付款');
			   		return "success";
				}else{
					return "fail";
				}
		    }else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货
				if($alipay_pay_method==1){$payment_direct=2;}//双向功能时候，担保交易

				$payment_data['payment_id']=$pay_info['payment_id'];
				$payment_data['payment_name']=$pay_info['payment_name'];
				$payment_data['payment_code']=$pay_info['payment_code'];
				$payment_data['payment_direct']=$payment_direct;
				$payment_data['payment_time']=time();
				$payment_data['out_payment_code']=$trade_no;
				$payment_data['order_state']=20;
			    $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$payment_data,'order');
				if($res){
			        $CI->w_order_model->logOrderResult($order_info['order_id'],'已提交','已付款','支付宝付款',$order_info['buyer_name']);
			        $CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','WAIT_SELLER_SEND_GOODS','买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货');
			        return "success";
				}else{
					return "fail";
				}
		    }else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
				//该判断表示卖家已经发了货，但买家还没有做确认收货的操作
				 $shipping_data['order_state']=30;
				 $shipping_data['shipping_time']=strtotime($_POST['gmt_send_goods']);
			     $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$shipping_data,'order');
			     if($res){
			     	$user_info=$CI->w_order_model->get_one(array('user_id'=>$order_info['seller_id']),'user','username');
			     	$CI->w_order_model->logOrderResult($order_info['order_id'],'已付款','已发货','买家在支付宝提交发货，请在支付宝查询物流信息',$user_info['username']);
			        $CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','WAIT_BUYER_CONFIRM_GOODS','支付宝卖家已经发了货，但买家还没有做确认收货的操作');
			     	return "success";
				}else{
					return "fail";
				}

		    }else if($_POST['trade_status'] == 'TRADE_FINISHED' && $alipay_pay_method==1) {//双向功能
				//该判断表示买家已经确认收货，这笔交易完成
				if($order_info['payment_direct']==1){//双向功能中的即时到帐
					$payment_data['payment_id']=$pay_info['payment_id'];
					$payment_data['payment_name']=$pay_info['payment_name'];
					$payment_data['payment_code']=$pay_info['payment_code'];
					$payment_data['payment_direct']=$payment_direct;
					$payment_data['payment_time']=time();
					$payment_data['out_payment_code']=$trade_no;
					$payment_data['order_state']=20;
				    $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$payment_data,'order');
					if($res){
				        $CI->w_order_model->logOrderResult($order_info['order_id'],'已提交','已付款','支付宝付款',$order_info['buyer_name']);
				        $CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','TRADE_FINISHED','买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货');
				        return "success";
					}else{
						return "fail";
					}
				}else{//双向功能中的担保交易
					$finished_data['finnshed_time']=time();
					$finished_data['order_state']=40;
			        $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$finished_data,'order');
					if($res){
				        $CI->w_order_model->logOrderResult($order_info['order_id'],'已完成','待评价','',$order_info['buyer_name']);
				        $CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','TRADE_FINISHED','买家确认收货，交易成功结束');

						/*****购物积分 添加积分Start***************/
						$CI->w_order_model->logPointsResult(intval($order_info['order_pointscount']),$order_info['buyer_id'],$order_info['buyer_name']);
						/******购物积分添加积分End***************/

				        return "success";
					}else{
						return "fail";
					}
				}
		    }else if($_POST['trade_status'] == 'TRADE_FINISHED' && $alipay_pay_method==2) {//担保交易专用
				//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['finnshed_time']=time();
				$finished_data['order_state']=40;
		        $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$finished_data,'order');
				if($res){
			        $CI->w_order_model->logOrderResult($order_info['order_id'],'已完成','待评价','',$order_info['buyer_name']);
			        $CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','TRADE_FINISHED','买家确认收货，交易成功结束');

					/*****购物积分 添加积分Start***************/
					$CI->w_order_model->logPointsResult(intval($order_info['order_pointscount']),$order_info['buyer_id'],$order_info['buyer_name']);
					/******购物积分添加积分End***************/

			        return "success";
				}else{
					return "fail";
				}
		    }else if(($_POST['trade_status'] == 'TRADE_SUCCESS' || $_POST['trade_status'] == 'TRADE_FINISHED') && $alipay_pay_method==3) {//即时到帐专用
				//该判断表示买家已在支付宝交易管理中产生了交易，并且支付成功
				$payment_data['payment_id']=$pay_info['payment_id'];
				$payment_data['payment_name']=$pay_info['payment_name'];
				$payment_data['payment_code']=$pay_info['payment_code'];
				$payment_data['payment_direct']=$payment_config['alipay_pay_method'];
				$payment_data['payment_time']=time();
				$payment_data['out_payment_code']=$trade_no;
				$payment_data['order_state']=20;
			    $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$payment_data,'order');
				if($res){
			        $CI->w_order_model->logOrderResult($order_info['order_id'],'已提交','已付款','支付宝付款',$order_info['buyer_name']);
			        $CI->w_order_model->logPayResult($order_info['order_sn'],'alipay',$_POST['trade_status'],'买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货');
			        return "success";
				}else{
					return "fail";
				}
		    }else if($_POST['trade_status'] == 'TRADE_PENDING' && $alipay_pay_method==3) {//即时到帐专用
				//该判断表示买家已在支付宝交易管理中产生了交易记录且卖家账户被冻结，没有支付成功
			    $CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','TRADE_PENDING','买家提交付款，但卖家账户被冻结，支付失败');
			    return "success";
		    }else if($_POST['trade_status'] == 'TRADE_CLOSED'){
		    	//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['finnshed_time']=time();
				$finished_data['order_state']=0;
		        $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$finished_data,'order');
				if($res){
			         $CI->w_order_model->logOrderResult($order_info['order_id'],'已完成','','交易中途关闭',$order_info['buyer_name']);
			         $CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','TRADE_CLOSED','交易中途关闭');
			        return "success";
				}else{
					return "fail";
				}
		    }else {
		    	$CI->w_order_model->logPayResult($order_info['order_sn'],'alipay',$_POST['trade_status'],'');
			    return "success";
		    }
		}else {
			$CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','ALIPAY_VERIFY_ERROR','支付宝请求验证失败');
		    //验证失败
		    return "fail";
		}

	}

	/**
	 * 支付响应操作
	 */
	function get_respond_url($pay_info=''){

		$CI = & get_instance();
		$out_trade_no = $CI->input->get_post('out_trade_no');//商户订单号
		$CI->load->model('w_order_model');
		$order_info=$CI->w_order_model->get_one(array('order_sn'=>$out_trade_no),'order');
		if(empty($order_info))  return "fail";
		$pay_info =$CI->w_order_model->get_one(array('payment_code'=>'alipay','shop_id'=>$order_info['shop_id']),'payment');

		/***设置支付宝config Start*****/
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式


		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';
		/***设置支付宝config End*****/
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();

		if($verify_result) {//验证成功

		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			$trade_no = $CI->input->get_post('trade_no');//支付宝交易号
			$trade_status = $CI->input->get_post('trade_status');//交易状态

			$payment_direct=1;//默认即时到帐
			if($alipay_pay_method==2){$payment_direct=2;}//担保交易
			if($alipay_pay_method==3){$payment_direct=1;}//即时到帐

			if($trade_status == 'WAIT_BUYER_PAY') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
				$res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),array('out_payment_code'=>$trade_no,'order_state'=>11),'order');
		    }else if($trade_status == 'WAIT_SELLER_SEND_GOODS') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货

				if($alipay_pay_method==1){$payment_direct=2;}//双向功能时候，担保交易

				$payment_data['payment_id']=$pay_info['payment_id'];
				$payment_data['payment_name']=$pay_info['payment_name'];
				$payment_data['payment_code']=$pay_info['payment_code'];
				$payment_data['payment_direct']=$payment_direct;
				$payment_data['out_payment_code']=$trade_no;
				$payment_data['order_state']=20;
			    $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$payment_data,'order');
		    }else if($trade_status == 'WAIT_BUYER_CONFIRM_GOODS') {
				//该判断表示卖家已经发了货，但买家还没有做确认收货的操作
				 $shipping_data['order_state']=30;
				 $shipping_data['shipping_time']=strtotime($_POST['gmt_send_goods']);
			     $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$shipping_data,'order');
		    }else if($trade_status == 'TRADE_FINISHED' && $alipay_pay_method==1) {//双向功能
				//该判断表示买家已经确认收货，这笔交易完成
				if($order_info['payment_direct']==1){//双向功能中的即时到帐
					$payment_data['payment_id']=$pay_info['payment_id'];
					$payment_data['payment_name']=$pay_info['payment_name'];
					$payment_data['payment_code']=$pay_info['payment_code'];
					$payment_data['out_payment_code']=$trade_no;
					$payment_data['order_state']=20;
				    $CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$payment_data,'order');

				}else{//双向功能中的担保交易
					$finished_data['order_state']=40;
			        $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$finished_data,'order');

				}
		    }else if($trade_status == 'TRADE_FINISHED' && $alipay_pay_method==2) {//担保交易专用
				//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['order_state']=40;
		        $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$finished_data,'order');
		    }else if(($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') && $alipay_pay_method==3) {//即时到帐专用
				//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['order_state']=20;
		        $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$finished_data,'order');
		    }else if($trade_status == 'TRADE_PENDING' && $alipay_pay_method==3) {//即时到帐专用
			   //该判断表示买家已在支付宝交易管理中产生了交易记录且卖家账户被冻结，没有支付成功
		       $CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','TRADE_PENDING','买家提交付款，但卖家账户被冻结，支付失败');
		    }else if($trade_status == 'TRADE_CLOSED'){
		    	//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['finnshed_time']=time();
				$finished_data['order_state']=0;
		        $res=$CI->w_order_model->update(array('order_id'=>$order_info['order_id']),$finished_data,'order');
		    }
		}
	}

	/**
	 * 支付宝(担保交易时---通知支付宝已经发货)
	 */
	function get_goods_send($order_info,$shopping_info){

        $CI = & get_instance();
		$CI->load->model('w_order_model');
		$oadd =$CI->w_order_model->get_one(array('order_id'=>$order_info['order_id']),'order_address');

		$trade_no = $order_info['out_payment_code'];//支付宝交易号
        $logistics_name = $shopping_info['shipping_company'];//物流公司名称
        $invoice_no = $shopping_info['shipping_code'];//物流发货单号
		$transport_type =$this->get_transport_type($oadd['shipping_name']);        //三个值可选：POST（平邮）、EXPRESS（快递）、EMS（EMS）

		//config
		$pay_info =$CI->w_order_model->get_one(array('payment_code'=>'alipay','shop_id'=>$order_info['shop_id']),'payment');
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式
		if($order_info['payment_direct']==1){return 'T';}//表示即时到帐时候物流返回，及即时到帐接口和双向功能即时到帐接口出现
		if($alipay_pay_method==3) {return 'T';}//即时到帐没有物流信息接口

		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "send_goods_confirm_by_platform",
				"partner" => trim($alipay_config['partner']),
				"trade_no"	=> $trade_no,
				"logistics_name"	=> $logistics_name,
				"invoice_no"	=> $invoice_no,
				"transport_type"	=> $transport_type,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestHttp($parameter);
		$doc = new DOMDocument();
		$doc->loadXML($html_text);
		//解析XML
		$res='';
		if( ! empty($doc->getElementsByTagName( "alipay" )->item(0)->nodeValue) ) {
			$is_success =$doc->getElementsByTagName( "is_success" )->item(0)->nodeValue;
			if($is_success=='T'){
				$trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;
				if($trade_status=='WAIT_BUYER_CONFIRM_GOODS'){
					$res = 'T';
				}else{
					$res = 'F';
				}
			}else{//$is_success=='F'请求失败
				$res = '请求支付宝参数错误！';
			}
		}else{
			$res = '请求支付宝参数错误！';
		}
		$CI->w_order_model->logPayResult($order_info['order_sn'],'alipay','GET_GOODS_SEND',$html_text.'@');
		return $res;

	}

	/**
	 * 物流
	 */
	private function get_transport_type($name){
 		//必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
        if($name=='平邮'){
        	return  "POST";
        }elseif($name=='EMS'){
        	return "EMS";
        }else{//免运费，快递，默认为快递
        	return "EXPRESS";
        }
	}


	/**
	 * 积分商城订单提交代码PayCode
	 * $order_info积分订单
	 * $pay_info支付方式配置
	 * $address_info订单地址
	 */
	function get_point_pay_code($order_info,$pay_info,$address_info){
		/***设置支付宝config Start*****/
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式

		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';
		/***设置支付宝config End*****/

		//支付类型
        $payment_type = "1"; //1代表商品购买

        $notify_url = base_url()."point/alipay_notify_url.php";
        $return_url = base_url()."point/alipay_return_url.php";
        $seller_email = $alipay_account;
        $out_trade_no = $order_info['point_ordersn'] ;
		$CI = & get_instance();
		$CI->load->helper('global');

		$setup= getcache('setup','commons');
		$subject = '积分兑换订单 '.$order_info['point_ordersn'];//订单名称

		if(!empty($setup)) $subject=$setup['site_name'].$subject;

        $price = $order_info['point_orderamount'];//订单中已经把运费当作订单费用了，这里运费当作是免费

        $quantity = "1"; //必填，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品

		//运费
        if(intval($order_info['point_shippingcharge'])==0){
        	 $logistics_payment = "SELLER_PAY";//卖家承担费用
        	 $logistics_fee = "0.00";
        }else{
        	//$logistics_fee= $order_info['point_shippingfee'];
        	$logistics_payment = "BUYER_PAY";//买家承担费用
        	$logistics_fee= "0.00";
        }


        //必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）默认快递
       	$logistics_type='EXPRESS';

        $show_url = base_url().'index.php?m=member&c=point&a=gift_show&order_id='.$order_info['point_orderid'];

		//收货人信息
        $receive_name = $address_info['point_truename'];
        $receive_address = $address_info['point_areainfo'].$address_info['point_address'];
        $receive_zip = $address_info['point_zipcode'];
        $receive_phone = $address_info['point_telphone'];
        $receive_mobile = $address_info['point_mobphone'];

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		if($alipay_pay_method==1){
			//构造要请求的参数数组，无需改动
			$parameter = array(
					"service" => "trade_create_by_buyer",
					"partner" => trim($alipay_config['partner']),
					"payment_type"	=> $payment_type,
					"notify_url"	=> $notify_url,
					"return_url"	=> $return_url,
					"seller_email"	=> $seller_email,
					"out_trade_no"	=> $out_trade_no,
					"subject"	=> $subject,
					"price"	=> $price,
					"quantity"	=> $quantity,
					"logistics_fee"	=> $logistics_fee,
					"logistics_type"	=> $logistics_type,
					"logistics_payment"	=> $logistics_payment,
					"body"	=> '',//订单描述
					"show_url"	=> $show_url,
					"receive_name"	=> $receive_name,
					"receive_address"	=> $receive_address,
					"receive_zip"	=> $receive_zip,
					"receive_phone"	=> $receive_phone,
					"receive_mobile"	=> $receive_mobile,
					"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))


			);
		}elseif($alipay_pay_method==2){//担保交易接口
			//构造要请求的参数数组，无需改动
			$parameter = array(
					"service" => "create_partner_trade_by_buyer",
					"partner" => trim($alipay_config['partner']),
					"payment_type"	=> $payment_type,
					"notify_url"	=> $notify_url,
					"return_url"	=> $return_url,
					"seller_email"	=> $seller_email,
					"out_trade_no"	=> $out_trade_no,
					"subject"	=> $subject,
					"price"	=> $price,
					"quantity"	=> $quantity,
					"logistics_fee"	=> $logistics_fee,
					"logistics_type"	=> $logistics_type,
					"logistics_payment"	=> $logistics_payment,
					"body"	=> '',//订单描述
					"show_url"	=> $show_url, //商品展示地址
					"receive_name"	=> $receive_name,//收货人姓名
					"receive_address"	=> $receive_address,//收货人地址
					"receive_zip"	=> $receive_zip, //收货人邮编
					"receive_phone"	=> $receive_phone,//收货人电话号码
					"receive_mobile"	=> $receive_mobile,//收货人手机号码
					"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			);
		}elseif($alipay_pay_method==3){//即时到帐接口
	        //防钓鱼时间戳
	        $anti_phishing_key = $alipaySubmit->query_timestamp_pay_by();

	        //客户端的IP地址
	        $exter_invoke_ip = ip();
			//构造要请求的参数数组，无需改动
			$parameter = array(
					"service" => "create_direct_pay_by_user",
					"partner" => trim($alipay_config['partner']),
					"payment_type"	=> $payment_type,
					"notify_url"	=> $notify_url,
					"return_url"	=> $return_url,
					"seller_email"	=> $seller_email,
					"out_trade_no"	=> $out_trade_no,
					"subject"	=> $subject,
					"total_fee"	=> $price,
					"body"	=> '',
					"show_url"	=> $show_url,
					"anti_phishing_key"	=> $anti_phishing_key,
					"exter_invoke_ip"	=> $exter_invoke_ip,
					"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			);
		}
		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestButton($parameter,"get", "确认支付");
		return $html_text;
	}


	/**
	 * 积分商城订单--支付宝同步返回订单代码
	 */
	function get_point_respond_url($pay_info=''){

		$CI = & get_instance();
		$out_trade_no = $CI->input->get_post('out_trade_no');//商户订单号
		$CI->load->model('w_order_model');
		//$_data_post=$CI->input->get();
		//$CI->w_order_model->logGoldPayResult(11111,'alipay','return',serialize($_data_post));

		$order_info=$CI->w_order_model->get_one(array('point_ordersn'=>$out_trade_no),'points_order');
		if(empty($order_info))  return "fail";
		$pay_info =$CI->w_order_model->get_one(array('payment_code'=>'alipay'),'gold_payment');

		/***设置支付宝config Start*****/
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式

		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';

		/***设置支付宝config End*****/
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();

		if($verify_result) {//验证成功

		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			$trade_no = $CI->input->get_post('trade_no');//支付宝交易号
			$trade_status = $CI->input->get_post('trade_status');//交易状态

			$payment_direct=1;//默认即时到帐
			if($alipay_pay_method==2){$payment_direct=2;}//担保交易
			if($alipay_pay_method==3){$payment_direct=1;}//即时到帐

			if($trade_status == 'WAIT_BUYER_PAY') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
				$res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),array('point_outsn'=>$trade_no,'point_orderstate'=>11),'points_order');
		    }else if($trade_status == 'WAIT_SELLER_SEND_GOODS') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货

				if($alipay_pay_method==1){$payment_direct=2;}//双向功能时候，担保交易

				$payment_data['point_paymentid']=$pay_info['payment_id'];
				$payment_data['point_paymentname']=$pay_info['payment_name'];
				$payment_data['point_paymentcode']=$pay_info['payment_code'];
				$payment_data['point_paymentdirect']=$payment_direct;
				$payment_data['point_outsn']=$trade_no;
				$payment_data['point_orderstate']=20;
			    $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$payment_data,'points_order');
		    }else if($trade_status == 'WAIT_BUYER_CONFIRM_GOODS') {
				//该判断表示卖家已经发了货，但买家还没有做确认收货的操作
				 $shipping_data['point_orderstate']=30;
			     $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$shipping_data,'points_order');
		    }else if($trade_status == 'TRADE_FINISHED' && $alipay_pay_method==2) {//担保交易
		    	//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['point_orderstate']=40;
		        $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$finished_data,'points_order');
		    }else if(($trade_status == 'TRADE_FINISHED'|| $trade_status == 'TRADE_SUCCESS') && $alipay_pay_method==3) {//即时到帐专用
				//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['point_orderstate']=20;
		        $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$finished_data,'points_order');
		    }else if($trade_status == 'TRADE_PENDING' && $alipay_pay_method==3) {//即时到帐专用
			    //该判断表示买家已在支付宝交易管理中产生了交易记录且卖家账户被冻结，没有支付成功
			}else if($trade_status == 'TRADE_CLOSED'){
		    	//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['point_orderstate']=0;
		        $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$finished_data,'points_order');
		    }
		}
	}

	/**
	 * 积分商城订单--支付宝异步返回订单代码
	 */
	function post_point_respond_url($pay_info=''){
		$CI = & get_instance();
		$out_trade_no = $CI->input->get_post('out_trade_no');//商户订单号
		$CI->load->model('w_order_model');
		$order_info=$CI->w_order_model->get_one(array('point_ordersn'=>$out_trade_no),'points_order');
		if(empty($order_info))  return "fail";
		$pay_info =$CI->w_order_model->get_one(array('payment_code'=>'alipay'),'gold_payment');

		/***设置支付宝config Start*****/
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式

		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';
		/***设置支付宝config End*****/
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功

		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			$trade_no = $CI->input->get_post('trade_no');//支付宝交易号
			$trade_status = $CI->input->get_post('trade_status');//交易状态

			$payment_direct=1;//默认即时到帐
			if($alipay_pay_method==2){$payment_direct=2;}//担保交易
			if($alipay_pay_method==3){$payment_direct=1;}//即时到帐

			if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
				$submit_data['point_paymentid']=$pay_info['payment_id'];
				$submit_data['point_paymentname']=$pay_info['payment_name'];
				$submit_data['point_paymentcode']=$pay_info['payment_code'];
				$submit_data['point_paymentdirect']=$payment_direct;
				$submit_data['point_outsn']=$trade_no;
				$submit_data['point_orderstate']=11;
				$res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$submit_data,'points_order');
				if($res){
			        $CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','WAIT_BUYER_PAY','买家已在支付宝交易管理中产生了交易记录，但没有付款');
			   		return "success";
				}else{
					return "fail";
				}
		    }else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货

				if($alipay_pay_method==1){$payment_direct=2;}//双向功能时候，担保交易

				$payment_data['point_paymentid']=$pay_info['payment_id'];
				$payment_data['point_paymentname']=$pay_info['payment_name'];
				$payment_data['point_paymentcode']=$pay_info['payment_code'];
				$payment_data['point_paymentdirect']=$payment_direct;
				$payment_data['point_paymenttime']=time();
				$payment_data['point_outsn']=$trade_no;
				$payment_data['point_orderstate']=20;
			    $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$payment_data,'points_order');
				if($res){
			        $CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','WAIT_BUYER_PAY','买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货');
			        return "success";
				}else{
					return "fail";
				}
		    }else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
				//该判断表示卖家已经发了货，但买家还没有做确认收货的操作
				 $shipping_data['point_orderstate']=30;
				 $shipping_data['point_shippingtime']=strtotime($_POST['gmt_send_goods']);
			     $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$shipping_data,'points_order');
			     if($res){
			     	$CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','WAIT_BUYER_CONFIRM_GOODS','支付宝卖家已经发了货，但买家还没有做确认收货的操作');
			     	return "success";
				}else{
					return "fail";
				}

		    }else if($_POST['trade_status'] == 'TRADE_FINISHED' && $alipay_pay_method==1) {//双向功能
				//该判断表示买家已经确认收货，这笔交易完成
				if($order_info['point_paymentdirect']==1){//双向功能中的即时到帐
					$payment_data['point_paymentid']=$pay_info['payment_id'];
					$payment_data['point_paymentname']=$pay_info['payment_name'];
					$payment_data['point_paymentcode']=$pay_info['payment_code'];
					$payment_data['point_paymentdirect']=$payment_direct;
					$payment_data['point_paymenttime']=time();
					$payment_data['point_outsn']=$trade_no;
					$payment_data['point_orderstate']=20;
				    $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$payment_data,'points_order');
					if($res){
				        $CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','TRADE_FINISHED','买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货');
				        return "success";
					}else{
						return "fail";
					}
				}else{//双向功能中的担保交易
					$finished_data['point_finnshedtime']=time();
					$finished_data['point_orderstate']=40;
			        $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$finished_data,'points_order');
					if($res){
				        $CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','TRADE_FINISHED','买家确认收货，交易成功结束');

				        return "success";
					}else{
						return "fail";
					}
				}
		    }else if($_POST['trade_status'] == 'TRADE_FINISHED' && $alipay_pay_method==2) {//担保交易
				//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['point_finnshedtime']=time();
				$finished_data['point_orderstate']=40;
		        $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$finished_data,'points_order');
				if($res){
			        $CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','TRADE_FINISHED','买家确认收货，交易成功结束');
			        return "success";
				}else{
					return "fail";
				}
		    }else if(($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS')  && $alipay_pay_method==3) {//即时到帐交易
				//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货
				$payment_data['point_paymentid']=$pay_info['payment_id'];
				$payment_data['point_paymentname']=$pay_info['payment_name'];
				$payment_data['point_paymentcode']=$pay_info['payment_code'];
				$payment_data['point_paymentdirect']=$payment_direct;
				$payment_data['point_paymenttime']=time();
				$payment_data['point_outsn']=$trade_no;
				$payment_data['point_orderstate']=20;
			    $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$payment_data,'points_order');
				if($res){
			        $CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay',$_POST['trade_status'],'买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货');
			        return "success";
				}else{
					return "fail";
				}
		    }else if($_POST['trade_status'] == 'TRADE_PENDING' && $alipay_pay_method==3) {//即时到帐专用
				//该判断表示买家已在支付宝交易管理中产生了交易记录且卖家账户被冻结，没有支付成功
			    $CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','TRADE_PENDING','买家提交付款，但卖家账户被冻结，支付失败');
			    return "success";
			}else if($_POST['trade_status'] == 'TRADE_CLOSED'){
		    	//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['finnshed_time']=time();
				$finished_data['point_orderstate']=0;
		        $res=$CI->w_order_model->update(array('point_orderid'=>$order_info['point_orderid']),$finished_data,'points_order');
				if($res){
			        $CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','TRADE_CLOSED','交易中途关闭');
			        return "success";
				}else{
					return "fail";
				}
		    }else {
		    	$CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay',$_POST['trade_status'],'');
			    return "success";
		    }
		}else {
			$CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','ALIPAY_VERIFY_ERROR','支付宝请求验证失败');
		    //验证失败
		    return "fail";
		}
	}

	 /*
	 * 支付宝(担保交易时---通知支付宝已经发货)---积分商城
	 */
	function get_point_goods_send($order_info,$shipping_info){

        $CI = & get_instance();
		$CI->load->model('w_order_model');
		$trade_no = $order_info['point_outsn'];//支付宝交易号
        $logistics_name = $shipping_info['point_shippingcompany'];//物流公司名称
        $invoice_no = $shipping_info['point_shippingcode'];//物流发货单号
		$transport_type =$shipping_info['point_transporttype'];        //三个值可选：POST（平邮）、EXPRESS（快递）、EMS（EMS）

		//config
		$pay_info =$CI->w_order_model->get_one(array('payment_code'=>'alipay'),'gold_payment');
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式
		if($order_info['point_paymentdirect']==1){return 'T';}//表示即时到帐时候物流返回，及即时到帐接口和双向功能即时到帐接口出现
		if($alipay_pay_method==3) {return 'T';}//即时到帐没有物流信息接口


		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "send_goods_confirm_by_platform",
				"partner" => trim($alipay_config['partner']),
				"trade_no"	=> $trade_no,
				"logistics_name"	=> $logistics_name,
				"invoice_no"	=> $invoice_no,
				"transport_type"	=> $transport_type,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestHttp($parameter);
		$doc = new DOMDocument();
		$doc->loadXML($html_text);
		//解析XML
		$res='';
		if( ! empty($doc->getElementsByTagName( "alipay" )->item(0)->nodeValue) ) {
			$is_success =$doc->getElementsByTagName( "is_success" )->item(0)->nodeValue;
			if($is_success=='T'){
				$trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;
				if($trade_status=='WAIT_BUYER_CONFIRM_GOODS'){
					$res = 'T';
				}else{
					$res = 'F';
				}
			}else{//$is_success=='F'请求失败
				$res = '请求支付宝参数错误！';
			}
		}else{
			$res = '请求支付宝参数错误！';
		}

		$CI->w_order_model->logGoldPayResult($order_info['point_ordersn'],'alipay','GET_GOODS_SEND',$html_text.'@');
		return $res;

	}
	/**
	 * 生成预存款支付代码
	 */
	function get_predeposit_pay_code($order_info,$pay_info){
		/***设置支付宝config Start*****/
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式

		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';
		/***设置支付宝config End*****/

		//支付类型
        $payment_type = "1"; //1代表商品购买

        $notify_url = base_url()."predeposit/alipay_notify_url.php";
        $return_url = base_url()."predeposit/alipay_return_url.php";
        $seller_email = $alipay_account;
        $out_trade_no = $order_info['pdr_sn'] ;
        $subject = '预存款充值订单'.$out_trade_no ;
        $price = $order_info['pdr_price'] ;

        $show_url = base_url()."index.php?m=member&c=predeposit&a=recharge_list";

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		if($alipay_pay_method==3){//即时到帐接口
	        //防钓鱼时间戳
	        $anti_phishing_key = $alipaySubmit->query_timestamp_pay_by();
	        //客户端的IP地址
	        $exter_invoke_ip = ip();
			//构造要请求的参数数组，无需改动
			$parameter = array(
					"service" => "create_direct_pay_by_user",
					"partner" => trim($alipay_config['partner']),
					"payment_type"	=> $payment_type,
					"notify_url"	=> $notify_url,
					"return_url"	=> $return_url,
					"seller_email"	=> $seller_email,
					"out_trade_no"	=> $out_trade_no,
					"subject"	=> $subject,
					"total_fee"	=> $price,
					"body"	=> '',
					"show_url"	=> $show_url,
					"anti_phishing_key"	=> $anti_phishing_key,
					"exter_invoke_ip"	=> $exter_invoke_ip,
					"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			);
			$html_text = $alipaySubmit->buildRequestButton($parameter,"get", "确认支付");
		}else{
			$html_text='网站不支持支付宝预存款，请选择其他充值方式或联系网站管理员！';
		}

		return $html_text;
	}


	/**
	 * 支付响应操作--异步
	 */
	function post_predeposit_respond_url($pay_info=''){

		$CI = & get_instance();
		$out_trade_no = $CI->input->get_post('out_trade_no');//商户订单号
		$CI->load->model('w_order_model');

		$order_info=$CI->w_order_model->get_one(array('pdr_sn'=>$out_trade_no),'predeposit_recharge');
		if(empty($order_info))  return "fail";
		$pay_info =$CI->w_order_model->get_one(array('payment_code'=>'alipay'),'gold_payment');

		/***设置支付宝config Start*****/
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式

		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';
		/***设置支付宝config End*****/
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功

		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			$trade_no = $CI->input->get_post('trade_no');//支付宝交易号
			$trade_status = $CI->input->get_post('trade_status');//交易状态

			if($trade_status == 'WAIT_BUYER_PAY') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
				$submit_data['pdr_onlinecode']=$trade_no;
				$CI->w_order_model->update(array('pdr_id'=>$order_info['pdr_id']),$submit_data,'predeposit_recharge');
				$CI->w_order_model->logGoldPayResult($order_info['pdr_sn'],'alipay','WAIT_BUYER_PAY','充值记录产生，但没有付款');
			   	return "success";
		    }else if($trade_status == 'TRADE_SUCCESS' || $_POST['trade_status'] == 'TRADE_FINISHED') {//即时到帐专用
				$finished_data['pdr_onlinecode']=$trade_no;
				$finished_data['pdr_state']=1;//已完成
				$finished_data['pdr_paystate']=1;//已支付
			    $CI->w_order_model->update(array('pdr_id'=>$order_info['pdr_id']),$finished_data,'predeposit_recharge');
			    $CI->w_order_model->update_set(array('user_id'=>$order_info['pdr_memberid']),array('data_set'=>array('available_predeposit'=>'available_predeposit+'.$order_info['pdr_price'])),'user');
				$CI->w_order_model->logGoldPayResult($order_info['pdr_sn'],'alipay',$_POST['trade_status'],'充值记录产生，并付款成功');
			    $CI->w_order_model->logPredepositResult($order_info['pdr_price'],$order_info['pdr_memberid'],$order_info['pdr_membername']);
				return "success";

		    }else if($trade_status == 'TRADE_PENDING') {//即时到帐专用
				//该判断表示买家已在支付宝交易管理中产生了交易记录且卖家账户被冻结，没有支付成功
			    $CI->w_order_model->logGoldPayResult($order_info['pdr_sn'],'alipay','TRADE_PENDING','买家提交充值，但卖家账户被冻结，支付失败');
			    return "success";
		    }else if($trade_status == 'TRADE_CLOSED'){
				$finished_data['pdr_state']=2;//已关闭
		        $res=$CI->w_order_model->update(array('pdr_id'=>$order_info['pdr_id']),$finished_data,'order');
			    $CI->w_order_model->logGoldPayResult($order_info['pdr_sn'],'alipay','TRADE_CLOSED','交易中途关闭');
			    return "success";
		    }else {
		    	$CI->w_order_model->logGoldPayResult($order_info['pdr_sn'],'alipay',$_POST['trade_status'],'');
			    return "success";
		    }
		}else {
			$CI->w_order_model->logGoldPayResult($order_info['pdr_sn'],'alipay','ALIPAY_VERIFY_ERROR','支付宝请求验证失败');
		    //验证失败
		    return "fail";
		}

	}

	/**
	 * 支付响应操作--同步
	 */
	function get_predeposit_respond_url($pay_info=''){

		$CI = & get_instance();
		$out_trade_no = $CI->input->get_post('out_trade_no');//商户订单号
	    $CI->load->model('w_order_model');

		$order_info=$CI->w_order_model->get_one(array('pdr_sn'=>$out_trade_no),'predeposit_recharge');
		if(empty($order_info))  return "fail";
		$pay_info =$CI->w_order_model->get_one(array('payment_code'=>'alipay'),'gold_payment');


		/***设置支付宝config Start*****/
		$payment_config= unserialize($pay_info['payment_config']);
		$alipay_account=$payment_config['alipay_account'];//支付宝账户
		$alipay_partner=$payment_config['alipay_partner'];//开发者ID
		$alipay_key=$payment_config['alipay_key'];//开发者key
		$alipay_pay_method=$payment_config['alipay_pay_method'];//接口模式


		$alipay_config['partner']		= $alipay_partner;
		$alipay_config['key']			= $alipay_key;
		$alipay_config['sign_type']    = strtoupper('MD5');
		$alipay_config['input_charset']= strtolower('utf-8');
		$alipay_config['cacert']    = FCPATH."libs\\wmlibs\\libraries\\payment\\cacert.pem";
		$alipay_config['transport']    = 'http';
		/***设置支付宝config End*****/
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();

		if($verify_result) {//验证成功
		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			$trade_no = $CI->input->get_post('trade_no');//支付宝交易号
			$trade_status = $CI->input->get_post('trade_status');//交易状态

			if($trade_status == 'WAIT_BUYER_PAY') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
				$res=$CI->w_order_model->update(array('pdr_id'=>$order_info['pdr_id']),array('pdr_onlinecode'=>$trade_no),'predeposit_recharge');
		    }else if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {//即时到帐专用
				//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['pdr_onlinecode']=$trade_no;
				$finished_data['pdr_state']=1;//已完成
				$finished_data['pdr_paystate']=1;//已支付
		        $CI->w_order_model->update(array('pdr_id'=>$order_info['pdr_id']),$finished_data,'predeposit_recharge');
		    }else if($trade_status == 'TRADE_CLOSED'){
		    	//该判断表示买家已经确认收货，这笔交易完成
				$finished_data['pdr_state']=2;//已关闭
		        $res=$CI->w_order_model->update(array('pdr_id'=>$order_info['pdr_id']),$finished_data,'predeposit_recharge');
		    }
		}
	}
}
