<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Cart extends Site_Controller {
	/**
 	* 购物车处理
	*/
	private $user_id;
	public function __construct()
	{
		parent::__construct();
		//加载模型
		$this->load->model('a_cart_model');
		$this->load->model('a_com_model');
		$this->load->library('session');
		$this->user_id=isset($this->session->userdata['member_user_id']) ? $this->session->userdata['member_user_id']:0;

		/********相关数据表*********/
		$this->tb_goods='goods';
		$this->tb_price='goods_price_library';
		$this->tb_user='user';
		$this->tb_group='user_group';
		$this->tb_discount='user_group_discount';
		$this->tb_cart='cart';
		$this->tb_order='order';
		$this->tb_order_goods='order_goods';
//		$this->tb_order_address='order_address';
		$this->tb_order_log='order_log';
	}
	
	/**
 	* shuangniao -加入购物车
 	* 逻辑：
 	* 	用post方法获取规格以及对应的数量
 	* 		两种格式：数组 或 单条记录
 	* 	判断是否登录
 	* 		未登录->session->cart_addgameno
 	* 		已登录->cart数据库->cart_addgame
	*/
	public function cart_add(){	
		//产品ID，产品吨位，产品米数，米数规格ID，和产品数量
		$goods_id = $this->input->get_post('goods_id');
		$goods_tonsid = $this->input->get_post('tons_id');
		$goods_mishu = $this->input->get_post('mishu');
		$goods_numbs = $this->input->get_post('numbs');

		if($this->user_id > 0){
			$this->cart_addshuangniao($goods_id,$goods_tonsid,$goods_mishu,$goods_numbs,$this->user_id);
			/****计算购物车中总条数、总价格*****/
			//获取产品系列ID，并计算折扣
			$goods_info=$this->a_com_model->get_one(array('goods_id' => $goods_id),$this->tb_goods);
			$series_id = empty($goods_info['brand_id']) ? 0 : $goods_info['brand_id'];
			$ispromotion = empty($goods_info['ispromotion']) ? 0 : $goods_info['ispromotion'];
			$member_discount = $this->calculate_cur_discount($series_id);
			
			$cart_list = $this->a_cart_model->get_query(array('member_id'=>$this->user_id),$this->tb_cart,'cart_id,goods_num,goods_store_price');
			$total_price=0;
			$total_jxsprice=0;
			$total_num = 0;
			foreach($cart_list as $val){
					$total_price = $val['goods_num'] * $val['goods_store_price'];
			    //$total_price = $val['goods_num'] * $val['goods_store_price'] * $member_discount;
			    $total_num += $val['goods_num'];
			}
			$data['total_price'] = $total_price;
			$data['total_num'] = $total_num;
			$data['done'] = 'yes';
		}else{
			$this->cart_addshuangniaono($goods_id,$goods_tonsid,$goods_mishu,$goods_numbs,$this->user_id);
			$cart_list = $this->session->userdata('cart');
			$total_price=0;
			$total_num = 0;
			foreach($cart_list as $v){
				$total_price = $v['goods_num'] * $v['goods_store_price'];
			  $total_num += $v['goods_num'];
			}
			$data['total_price'] = $total_price;
			$data['total_num'] = $total_num;
			$data['done'] = 'yes';
		}
		
		echo json_encode($data);
		exit;
	}
 /**
	*shuangniao - 已登录用户加入购物车
	*/
	private function cart_addshuangniao($goods_id,$goods_tonsid,$goods_mishu,$goods_numbs,$member_id){
			$goods_info  = $this->a_cart_model->get_one(array('goods_id' => $goods_id),$this->tb_goods);
			$cart_info=$this->a_cart_model->get_one(array('member_id' => $member_id,'goods_id' => $goods_id),$this->tb_cart);
			//获取价格库中规则名称
			$tonsspec_info=$this->a_com_model->get_one(array('id' => $goods_tonsid),$this->tb_price);
			if(!empty($cart_info)){//4.1、原先已经存在,则更新数量
				$c_data['spec_id'] = $goods_tonsid;
				$c_data['goods_num'] = $cart_info['goods_num'] + $goods_numbs;
				$this->a_cart_model->update(array('cart_id' => $cart_info['cart_id']),$c_data,$this->tb_cart);
			}else{//4.2、预先不存在,则插入购物车数据库
				$c_data['goods_id'] = $goods_info['goods_id'];
				$c_data['goods_name'] = $goods_info['goods_name'];
				$c_data['spec_id'] = $goods_tonsid;
				$c_data['spec_info'] = empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'];
				$c_data['spec_mishu'] = $goods_mishu;
				$c_data['goods_store_price'] = $this->calculate_cur_price($goods_id,$goods_tonsid,$goods_mishu);//计算商品价格
				$c_data['goods_num'] = $goods_numbs;
				$c_data['goods_images'] = $goods_info['goods_image'];
				$c_data['member_id'] = $member_id;
				$c_data['cart_time'] = SYS_TIME;

				$this->a_cart_model->add($c_data,$this->tb_cart);
			}
	}
	/** shuangniao - 未登录用户加入购物车
 	* 未登录用户加入购物车调用函数
 	* 	查找session是否有数据->
 	* 	有->只是数量增加
 	* 	无->插入全部信息
	*/
	private function cart_addshuangniaono($goods_id,$goods_tonsid,$goods_mishu,$goods_numbs){
			$c_data_list=$this->session->userdata('cart');
			$goods_info = $this->a_cart_model->get_one(array('goods_id'=>$goods_id),$this->tb_goods);
			$c_data_val=isset($c_data_list[$goods_id]) ? $c_data_list[$goods_id] : '';
			//获取价格库中规则名称
			$tonsspec_info=$this->a_com_model->get_one(array('id' => $goods_tonsid),$this->tb_price);
			
			if(empty($c_data_val)){
				$c_data_val=array(
							'cart_id' => create_order_number(),
							'goods_id' => $goods_info['goods_id'],
							'goods_name' => $goods_info['goods_name'],
							'spec_id' => $goods_tonsid,
							'spec_info' => empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'],
							'spec_mishu' => $goods_mishu,
							'goods_store_price' => $this->calculate_cur_price($goods_id,$goods_tonsid,$goods_mishu),
							'goods_num' => $goods_numbs,
							'goods_images' => $goods_info['goods_image'],
							'cart_time' => SYS_TIME
						);
			}else{
				$goods_numbs=$c_data_val['goods_num']+$goods_numbs;
				$c_data_val['goods_numbs']=$goods_numbs;
				$c_data_val['spec_mishu']=$goods_mishu;
			}
			
			$c_data_list[$goods_id]=$c_data_val;
			
			$this->session->set_userdata('cart',$c_data_list);
	}
		/**
 	* 查看购物车
	*/
	public function cart_step1(){
		if($this->user_id > 0){
			$member_id = $this->user_id;
			/*****合并购物车Session和Cart数据中的数据***Start***/
			$c_data_list = $this->session->userdata('cart');
			if(!empty($c_data_list)){
				foreach($c_data_list as $k=>$v){
					$this->cart_addshuangniao($v['goods_id'],$v['spec_id'],$v['spec_mishu'],$v['goods_num'],$this->user_id);
				}
			}
			$this->session->unset_userdata('cart');
			/*****合并购物车Session和Cart数据中的数据***End***/

			/*****查询购物车中的数据***Start****/
			$cart_data_list = $this->a_cart_model->get_query(array('member_id' => $member_id),$this->tb_cart);
			if(!empty($cart_data_list)){
				/*****重新构造数组，使相同的产品（即ID一样）在一起****/
				$gprod_ids=array();
				foreach($cart_data_list as $v){
					$gprod_ids[$v['goods_id']] = $v['goods_id'];
				}
				foreach($gprod_ids as $v){
					foreach($cart_data_list as $s_v){
						if($v==$s_v['goods_id']){
							$cart_val[]=$s_v;
						}
					}
				}

				$total_price=0;
				$total_num = 0;

				foreach($cart_val as $key => $val){
					$tonsspec_id = $val['spec_id'];
					//获取价格库中规则名称
					//$tonsspec_info=$this->a_com_model->get_one(array('id' => $tonsspec_id),$this->tb_price);
					//$cart_val[$key]['goods_tons']=empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'];
					$cart_val[$key]['goods_store_price'] = sprintf('%.2f',round($val['goods_store_price']));
					$total_price=$total_price+round($val['goods_store_price'],2)*$val['goods_num'];
					$cart_val[$key]['subtotal'] = $val['goods_store_price']*$val['goods_num'];
					$total_num = $total_num + $val['goods_num'];
				}
				$data['cart'] = $cart_val;
				$data['total_price'] = sprintf('%.2f',$total_price);
				$data['total_num'] = $total_num;
			}else{
			  $data['cart'] = array();
			  $data['total_price'] = 0;
			  $data['total_num'] = 0;
			}

			$carthash = random(10,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
			$this->a_cart_model->update(array('member_id' => $member_id),array('cart_hash'=>$carthash),$this->tb_cart);
			$data['cart_hash'] =$carthash;
			$this->seo_title = "我的购物车 - 双鸟机械";
			$this->seo_keywords = "我的购物车 - 双鸟机械";
			$this->seo_description = "我的购物车 - 双鸟机械";
			$this->view('cart_step1',$data);
		}else{
			$c_data_list = $this->session->userdata('cart');
			
			$total_price=0;
			$total_num = 0;
			$cart_val = array();

			if(!empty($c_data_list)){
				foreach($c_data_list as $k=>$v){
					$tonsspec_id = $v['spec_id'];
					//获取价格库中规则名称
					$tonsspec_info=$this->a_com_model->get_one(array('id' => $tonsspec_id),$this->tb_price);
					$total_num = $total_num + $v['goods_num'];
					$c_data_list[$k]['goods_tons']=empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'];
					//$c_data_list[$k]['cart_id']=$k;
					$c_data_list[$k]['goods_num']=$v['goods_num'];
					$c_data_list[$k]['goods_store_price'] = sprintf('%.2f',round($v['goods_store_price']));
					$total_price=$total_price+round($v['goods_store_price'],2)*$v['goods_num'];
					$cart_val[]=$c_data_list[$k];
				}
			}
			
			$carthash = random(10,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
			$this->session->set_userdata('cart_hash',$carthash);
			
			$data['cart'] = $cart_val;
			$data['cart_hash'] =$carthash;
			$data['total_price'] =sprintf('%.2f',$total_price);
			$data['total_num'] =$total_num;
			$this->seo_title = "购物车 - 双鸟机械";
			$this->seo_keywords = "购物车 - 双鸟机械";
			$this->seo_description = "购物车 - 双鸟机械";
			$this->view('cart_step1',$data);
		}
	}
	 //shuangniao -  确认收货人资料及订单产品
	public function cart_step2(){
		$chash = $this->input->get('r');
		$member_id = $this->user_id;
		
		$user_info = array();
		//用户未登录，先登录
		$urll =  base_url().'index.php?c=cart&a=cart_step1';
		if (!$this->user_id) {
			redirect(base_url().'index.php?c=customer&a=login&urll='.urlencode($urll));
		}
		//用户已登录，判断是否有收获地址
		$address_list = $this->a_com_model->get_query(array('member_id' => $member_id,'sts' => 0),'address');
		if(empty($address_list)){
			$data['msg'] = '对不起，请先填写您的收货地址!';
			$this->showmessage('error',$data['msg'],base_url().'index.php?m=member&c=address&a=lists');
		}
		if($this->user_id >0){
			//获取用户详细信息
			$user_info=$this->a_com_model->get_one(array('user_id' => $this->user_id),'user');
			$cart_list=$this->a_cart_model->get_query(array('member_id'=>$member_id),$this->tb_cart);
			if(empty($cart_list)){
				$data['msg'] = '对不起，您的购物车没有产品!';
				$this->showmessage('error',$data['msg'],base_url().'index.php?c=cart&a=cart_step1');
			}
				//查询用户关于此商铺在购物车中购买的商品数据
				$total_price = 0;
				$total_jxsprice = 0;
				$total_num = 0;
				$cart_val = array();
				foreach($cart_list as $key => $val){
					$cart_val[$key] = $val;
					$tonsspec_id = $val['spec_id'];
					//获取产品系列ID，并计算折扣
					$goods_info=$this->a_com_model->get_one(array('goods_id' => $val['goods_id']),$this->tb_goods);
					$series_id = empty($goods_info['brand_id']) ? 0 : $goods_info['brand_id'];
					$member_discount = $this->calculate_cur_discount($series_id);
					//获取价格库中规则名称
					//$tonsspec_info=$this->a_com_model->get_one(array('id' => $tonsspec_id),$this->tb_price);
					$total_num = $total_num + $val['goods_num'];
					//$cart_val[$key]['goods_tons']=empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'];
					$cart_val[$key]['cart_id']=$val['cart_id'];
					$cart_val[$key]['goods_num']=$val['goods_num'];
					$cart_val[$key]['goods_store_price'] = sprintf('%.2f',round($val['goods_store_price']));
					$cart_val[$key]['goods_jxs_price'] = sprintf('%.2f',round($val['goods_store_price'] * $member_discount));
					$total_price=$total_price + round($val['goods_store_price'],2) * $val['goods_num'];
					$total_jxsprice = $total_jxsprice + round(($val['goods_store_price'] * $member_discount),2) * $val['goods_num'];
					$cart_val[$key]['subtotal'] = round($val['goods_store_price'],2)*$val['goods_num'];
				}

				$data['total_price'] = sprintf('%.2f',$total_price);
				$data['total_jxsprice'] = sprintf('%.2f',$total_jxsprice);
				$data['total_num'] = $total_num;
				$data['cart'] = $cart_val;
				$data['address_list'] = $address_list;
				/*商品数据 End*/

				//写入session防止表单重复提交
				$this->load->library('session');
				$data['cart_code'] = mt_rand(0,1000000);
				$this->session->set_userdata('cart_code',$data['cart_code']);

				$carthash = random(10,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
				$this->a_cart_model->update(array('member_id'=>$member_id),array('cart_hash'=>$carthash),$this->tb_cart);
				//支付方式$data['payment']
				$data['cart_hash'] =$carthash;
				$data['user_info'] = $user_info;
				$this->seo_title = "我的购物车 - 双鸟机械";
				$this->seo_keywords = "我的购物车 - 双鸟机械";
				$this->seo_description = "我的购物车 - 双鸟机械";
		    $this->view('cart_step2',$data);
		}else{
			$c_data_list = $this->session->userdata('cart');
			$total_price=0;
			$total_num = 0;
			$cart_val = array();
			if(!empty($c_data_list)){
				foreach($c_data_list as $k=>$v){
					$tonsspec_id = $v['spec_id'];
					//获取价格库中规则名称
					$tonsspec_info=$this->a_com_model->get_one(array('id' => $tonsspec_id),$this->tb_price);
					$total_num = $total_num + $v['goods_num'];
					$c_data_list[$k]['goods_tons']=empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'];
					$c_data_list[$k]['cart_id']=$k;
					$c_data_list[$k]['goods_num']=$v['goods_num'];
					$c_data_list[$k]['goods_store_price'] = sprintf('%.2f',round($v['goods_store_price']));
					$total_price=$total_price+round($v['goods_store_price'],2)*$v['goods_num'];
					$cart_val[]=$c_data_list[$k];
				}
			}else{
				$data['msg'] = '对不起，您的购物车中暂无商品!';
				$this->showmessage('error',$data['msg'],base_url().'index.php?c=cart&a=cart_step1');
			}
			//写入session防止表单重复提交
			$this->load->library('session');
			$data['cart_code'] = mt_rand(0,1000000);
			$this->session->set_userdata('cart_code',$data['cart_code']);

			$carthash = random(10,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
			$this->session->set_userdata('cart_hash',$carthash);
			//支付方式$data['payment']
			$data['cart_hash'] =$carthash;
			$data['cart'] = $cart_val;
			$data['total_price'] = sprintf('%.2f',$total_price);
			$data['total_num'] = $total_num;
			$data['user_info'] = $user_info;
			$this->seo_title = "我的购物车 - 双鸟机械";
			$this->seo_keywords = "我的购物车 - 双鸟机械";
			$this->seo_description = "我的购物车 - 双鸟机械";
			$this->view('cart_step2',$data);
		}

	}
	//shuangniao - 购买完成
	public function cart_step3(){
		$this->load->library('session');
		
		if(isset($_POST['cart_code'])){
	    $cart_code = $this->session->userdata('cart_code');
	    if($_POST['cart_code'] == $cart_code){
	    	$member_id=$this->user_id;
				$_data_post=$this->input->post();
			
				$cart_hash=$_data_post['cart_hash'];
				$addressid = $_data_post['addressids'];
				$kaipiaotype = $_data_post['kaipiaotype'];
				$kaipiaott = $_data_post['kaipiaott'];
				//查询买家信息
				$user_info = $this->a_cart_model->get_one(array('user_id'=>$member_id),$this->tb_user,'user_id,username,email,province_id');
				/******组装订单Start****/
				$sn = create_order_number();
				$order['order_sn'] = $sn;
				$order['buyer_id'] = empty($user_info['user_id']) ? 88 : $user_info['user_id'];
				$order['buyer_name'] = empty($user_info['username']) ? 'no name' : $user_info['username'];
				$order['buyer_email'] = empty($user_info['email']) ? 'nouser@gmail.com' : $user_info['email'];
				$order['province_id'] = empty($user_info['province_id']) ? 3133 : $user_info['province_id'];
				$order['add_time'] = SYS_TIME;
				$order['order_type'] = '';// 0.普通
				$order['order_message'] = '';
				$order['order_state'] = 10;
				$order['out_sn'] = 0;
				$order['payment_id'] = 0;
				$order['payment_code'] = '';
				$order['payment_name'] = '';
				$order['payment_direct'] = 0;
				$order['payment_time'] = 0;
				/*拼装发票信息*/
				$invoice = array();
				if($kaipiaotype == 1){//普通发票
					$invoice['kaipiaotype'] = 1;
					$invoice['compname'] = $kaipiaott;
				}
				if($kaipiaotype == 2){//增值税发票
					$invoice['kaipiaotype'] = 2;
					$bill = $this->a_cart_model->get_one(array('member_id' => $this->user_id), 'bill');
					$invoice['compname'] = empty($bill['compname']) ? '' : $bill['compname'];
					$invoice['compcode'] = empty($bill['compcode']) ? '' : $bill['compcode'];
					$invoice['address'] = empty($bill['address']) ? '' : $bill['address'];
					$invoice['tel'] = empty($bill['tel']) ? '' : $bill['tel'];
					$invoice['bank'] = empty($bill['bank']) ? '' : $bill['bank'];
					$invoice['bankcode'] = empty($bill['bankcode']) ? '' : $bill['bankcode'];
				}
				$order['invoice'] = serialize($invoice);
				
				$goods_amount=$pre_amount=$discount=0;
				$order_goods_list=array();
				if($this->user_id > 0){//计算购物车数据库中总价格
					$cart_list=$this->a_cart_model->get_query(array('member_id' => $member_id,'cart_hash'=>$cart_hash),$this->tb_cart);
					if(empty($cart_list)) $this->showmessage('error','您的购物车暂无商品！',base_url().'index.php?c=cart&a=cart_step1');
					
					foreach($cart_list as $k=>$v){
						$order_goods_list[$k]['goods_id']=$v['goods_id'];
						//获取产品系列ID，并计算折扣
						$goods_info=$this->a_com_model->get_one(array('goods_id' => $v['goods_id']),$this->tb_goods);
						//获取产品的一、二级分类
						$first_cateid = 0;
						$second_cateid = 0;
						$goods_cate = empty($goods_info['gc_id']) ? 0 : $goods_info['gc_id'];
						$goods_cateinfo = $this->a_com_model->get_one(array('gc_id' => $goods_cate),'goods_category');
						if($goods_cateinfo['parent_id'] == 0){
							$first_cateid = $goods_cate;
						} else {
							$first_cateid = $goods_cateinfo['parent_id'];
							$second_cateid = $goods_cate;
						}
						$series_id = empty($goods_info['brand_id']) ? 0 : $goods_info['brand_id'];
						$member_discount = $this->calculate_cur_discount($series_id);
						
						$order_goods_list[$k]['goods_name']=$v['goods_name'];
						$order_goods_list[$k]['cate_id'] = $first_cateid;
						$order_goods_list[$k]['subcate_id'] = $second_cateid;
						$order_goods_list[$k]['spec_id']=$v['spec_id'];
						$order_goods_list[$k]['spec_info']='';
						$order_goods_list[$k]['spec_mishu']=$v['spec_mishu'];
						$order_goods_list[$k]['goods_num']=$v['goods_num'];
						$order_goods_list[$k]['goods_image']=$v['goods_images'];
						$order_goods_list[$k]['evaluation']=0;
						$order_goods_list[$k]['comment']=$_data_post['remark_'.$v['cart_id']];
						$order_goods_list[$k]['evaluation_state']=0;
						$order_goods_list[$k]['evaluation_remark']='';
						$order_goods_list[$k]['goods_returnnum']=0;
						$order_goods_list[$k]['goods_price'] = sprintf('%.2f',round($v['goods_store_price'] * $member_discount));
						$order_goods_list[$k]['pre_price'] = sprintf('%.2f',round($v['goods_store_price'] * $member_discount));
						$pre_amount = $pre_amount+$v['goods_num'] * round($v['goods_store_price'],2);
						$goods_amount = $goods_amount+$v['goods_num'] * round($v['goods_store_price'] * $member_discount,2);
					}
				}else{//计算SESSION购物车总价格
					$c_data_list = $this->session->userdata('cart');
					if(empty($c_data_list)) $this->showmessage('error','您的购物车暂无商品！',base_url().'index.php?c=cart&a=cart_step1');
					foreach($c_data_list as $k => $v){
						$order_goods_list[$k]['goods_id']=$v['goods_id'];
						$order_goods_list[$k]['goods_name']=$v['goods_name'];
						$order_goods_list[$k]['spec_id']=$v['spec_id'];
						$order_goods_list[$k]['spec_info']='';
						$order_goods_list[$k]['spec_mishu']=$v['spec_mishu'];
						$order_goods_list[$k]['goods_num']=$v['goods_num'];
						$order_goods_list[$k]['goods_image']=$v['goods_images'];
						$order_goods_list[$k]['evaluation']=0;
						$order_goods_list[$k]['comment']='';
						$order_goods_list[$k]['evaluation_state']=0;
						$order_goods_list[$k]['evaluation_remark']='';
						$order_goods_list[$k]['goods_returnnum']=0;
						$order_goods_list[$k]['goods_price'] = sprintf('%.2f',round($v['goods_store_price']));
						$order_goods_list[$k]['pre_price'] = sprintf('%.2f',round($v['goods_store_price']));
						$goods_amount = $goods_amount+$v['goods_num'] * round($v['goods_store_price'],2);
					}
					$pre_amount = $goods_amount;
				}

			$order['goods_amount'] = sprintf('%.2f',$goods_amount);
			$order['order_amount'] = sprintf('%.2f',$pre_amount);
			$order['discount'] = round($goods_amount/$pre_amount,2);
			$order['order_pointscount']=0;
		  $order['shipping_code'] = '';
		  $order_game_desc=array();
		  $order['shipping_company']='';
		  $order['shipping_remark'] = '';

			//写入订单操作状态
			$order_log['order_state'] = '已提交';
			$order_log['change_state'] = '待付款';
			$order_log['state_info'] = '';
			$order_log['log_time'] = SYS_TIME;
			$order_log['operator'] = empty($user_info['username']) ? 'no name' : $user_info['user_id'];

			/******数据保存到数据库******/
				$order_id=$this->a_cart_model->add($order,$this->tb_order);
				if(intval($order_id)>0){
					foreach($order_goods_list as $v){
						$v['order_id']=$order_id;
						$this->a_cart_model->add($v,$this->tb_order_goods);
					}
					$order_log['order_id']=$order_id;
					$this->a_cart_model->add($order_log,$this->tb_order_log);
					//清空购物车
					$this->a_cart_model->del(array('member_id'=>$member_id,'cart_hash'=>$cart_hash),$this->tb_cart);
					//清空session
					$this->session->unset_userdata('cart_code');
					//保存收获地址
					$address_info = $this->a_cart_model->get_one(array('address_id'=>$addressid,'member_id'=>$this->user_id,'sts'=>0),"address");
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
						$this->a_cart_model->add($_data, 'order_address');
					}
					
					$data['shop_id'] = 0;
					$data['order_sn'] = $sn;
					$data['order_id'] = $order_id;
					$data['order_amount'] = $goods_amount;
					//获取定单信息
					$order_info = $this->a_cart_model->get_one(array('order_id'=>$order_id),$this->tb_order);
					//获取定单产品信息
					$order_prod = $this->a_cart_model->get_query(array('order_id'=>$order_id),$this->tb_order_goods);
					
					$data['order_info'] = $order_info;
					$data['order_goods'] = $order_prod;
					
					$this->seo_title = "我的购物车 - 双鸟机械";
					$this->seo_keywords = "我的购物车 - 双鸟机械";
					$this->seo_description = "我的购物车 - 双鸟机械";
					$this->view('cart_okay',$data);
				}else{
					$data['msg'] = '订单提交失败，请重新购买商品!';
					$this->showmessage('error',$data['msg'],base_url().'index.php?c=cart&a=cart_step1');
				}
			}else{
			  $data['msg'] = '请不要重复提交订单!';
			  $this->showmessage('error',$data['msg'],base_url().'index.php?c=cart&a=cart_step1');
			}
		}else{
			$data['msg'] = '请检查您的输入！';
			$this->showmessage('error',$data['msg'],base_url().'index.php?c=cart&a=cart_step1');
		}
	}
	//shuangniao - 通过参数计算产品价格
	public function calculate_cur_price($goods_id,$tons_id,$mishu){
		$real_price = 0;
		$member_discount = 1;

		$goods_info = $this->a_cart_model->get_one(array('goods_id'=>$goods_id,'goods_show'=>1,'sts'=>0),$this->tb_goods);
		$type_id = empty($goods_info['type_id']) ? 1 : $goods_info['type_id'];//产品价格计算方法
		//计算单个产品价格
		if($type_id == 2){//价格库计算方法
			$spectons_info = $this->a_cart_model->get_one(array('id' => $tons_id),$this->tb_price);
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
	//shuangniao - 通过参数计算产品价格
	public function calculate_cur_discount($series_id){
		$member_discount = 1;

		//计算会员折扣
		if($this->user_id > 0){
			$user_info = $this->a_cart_model->get_one(array('user_id' => $this->user_id),$this->tb_user);
			$user_group = empty($user_info['group']) ? 0 : $user_info['group'];
			if(!empty($user_group)){
				$discount_info = $this->a_cart_model->get_one(array('group_id' => $user_group,'series_id' => $series_id),$this->tb_discount);
				$group_discount = empty($discount_info['discount']) ? 100 :  $discount_info['discount'];
				$member_discount = $group_discount/100;
			}
		}
		
		return $member_discount;
	}
	//shuangniao - AJAX动态计算产品价格
	public function ajax_calculate_price(){
		$goods_id = intval($this->input->get('goods_id'));//产品ID
		$tons_id = intval($this->input->get('tons_id'));//吨位ID
		$mishu = intval($this->input->get('mishu'));//具体米数
		$numbs = intval($this->input->get('numbs'));//产品数量
		$real_price = 0;
		$member_discount = 1;

		$goods_info = $this->a_cart_model->get_one(array('goods_id'=>$goods_id,'goods_show'=>1,'sts'=>0),$this->tb_goods);
		$type_id = empty($goods_info['type_id']) ? 1 : $goods_info['type_id'];//产品价格计算方法
		$series_id = empty($goods_info['brand_id']) ? 1 : $goods_info['brand_id'];//产品系列ID
		//计算单个产品价格
		if($type_id == 2){//价格库计算方法
			$spectons_info = $this->a_cart_model->get_one(array('id' => $tons_id),$this->tb_price);
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
		//计算产品折扣（通过产品系列ID和会员等级）
		if($this->user_id > 0){
			$user_info = $this->a_cart_model->get_one(array('user_id' => $this->user_id),$this->tb_user);
			$user_group = empty($user_info['group']) ? 0 : $user_info['group'];
			if(!empty($user_group)){
				$discount_info = $this->a_cart_model->get_one(array('group_id' => $user_group,'series_id' => $series_id),$this->tb_discount);
				$group_discount = empty($discount_info['discount']) ? 100 :  $discount_info['discount'];
				$cuxiao_discount = empty($discount_info['cxdiscount']) ? 100 : $discount_info['cxdiscount'];
				$member_discount = $group_discount/100;
				if(!empty($goods_info['ispromotion'])){
					$member_discount = $member_discount * ($cuxiao_discount/100);
				}
			}
			$data['single_jxsprice'] = sprintf('%.2f',round($real_price * $numbs * $member_discount));
		}
		
		$data['single_hyprice'] = sprintf('%.2f',round($real_price * $numbs));
		$data['done'] = 'yes';

		echo json_encode($data);
		exit;
	}
	//AJAX  修改购物车购买商品数量
	public function ajax_update_cart(){
	  $goods_id = intval($this->input->get('goods_id'));
		$numbs = intval($this->input->get('numbs'));
		$member_id = $this->user_id;
		$result=array();
		$total_price=0;
		$total_num = 0;
		
		if( $member_id > 0 ){//更新购物车数据库
			//修改购物车购买商品数量
			$c_val['goods_num'] = $numbs;
			$this->a_cart_model->update(array('member_id' => $member_id,'goods_id' => $goods_id),$c_val,$this->tb_cart);
			//计算总数量和总价格
			$cart_data_list = $this->a_cart_model->get_query(array('member_id' => $member_id),$this->tb_cart);
			foreach($cart_data_list as $key => $val){
					$total_price=$total_price+round($val['goods_store_price'],2)*$val['goods_num'];
					$cart_val[$key]['subtotal'] = $val['goods_store_price']*$val['goods_num'];
					$total_num = $total_num + $val['goods_num'];
			}
			$result['done'] = 'yes';
		}else{//更新session
			$c_data_list = $this->session->userdata('cart');
			foreach($c_data_list as $k => $v){
				if($v['goods_id'] == $goods_id){
					$c_data_list[$k]['goods_num'] = $numbs;
				}
			}
			$this->session->set_userdata('cart',$c_data_list);
			//计算总数量和总价格
			foreach($c_data_list as $key => $val){
					$total_price=$total_price+round($val['goods_store_price'],2)*$val['goods_num'];
					$cart_val[$key]['subtotal'] = $val['goods_store_price']*$val['goods_num'];
					$total_num = $total_num + $val['goods_num'];
			}
			$result['done'] = 'yes';
		}
		$result['total_num'] = $total_num;
		$result['total_price'] = $total_price;

		echo json_encode($result);
	}
	//AJAX  删除购物车中的商品
	public function ajax_cart_drop(){
	  $goods_id = $this->input->get('goods_id');
	  
	  if( $this->user_id > 0 ){
	  	$member_id = $this->session->userdata['member_user_id'];
	  	if($this->a_cart_model->get_one(array('cart_id' => $goods_id,'member_id' => $member_id),$this->tb_cart)){
		    $this->a_cart_model->del(array('cart_id' => $goods_id,'member_id' => $member_id),$this->tb_cart);		    
			}
		}else{
			$c_data_list = $this->session->userdata('cart');
			$data_list=array();
			foreach($c_data_list as $v){
				if($v['cart_id'] != $goods_id){
					$data_list[]=$v;
				}
			}
			$this->session->set_userdata('cart',$data_list);
		}
		$result['done'] = 'yes';
		
    echo json_encode($result);
    exit;
	}
	//AJAX 	清空购物车
	public function ajax_cart_clear(){
		$result = array();
		$result['url'] = urlencode(str_replace(base_url(), '', HTTP_REFERER));
		$member_id = $this->user_id;
		if (!$member_id) {
			//清空session
			$arr['msg'] = 'ok';
		  $this->session->unset_userdata('cart');
		}
		$this->a_cart_model->del(array('member_id'=>$member_id), $this->tb_cart);
		$arr['msg'] = 'ok';
		echo json_encode($arr);
	}
}