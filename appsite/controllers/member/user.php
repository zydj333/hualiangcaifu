<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class User extends Member_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->model('a_caifu_model');
		$this->user_id=isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
	}
	public function index() {
		$this->seo_title = '会员中心-个人资料';
		$this->seo_keywords='会员中心';
	  $this->seo_description='首页';
	  //导航及数量
		$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
		foreach($nav_category as $key => $val){
			$cateid = $val['column_value'];
			$where = array('category'=>$cateid);
			$con=$this->a_caifu_model->count($where,'caifu_product');
			$nav_category[$key]['numbs'] = intval($con);
		}
		$user_id = $this->session->userdata['member_user_id'];
	  
	  $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	  $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
		
		$reserve_list = $this->user->get_query(array('user_id' => $user_id,'order_by' => 'post_time ASC', 'limit'=>5), 'caifu_reserve');
		foreach($reserve_list as $key => $val){
			$productinfo = $this->user->get_one(array('id' => $val['product_id']),'caifu_product');
			$reserve_list[$key]['order_state_name']=$this->getPointsStatusName($val['status']);
			$reserve_list[$key]['product_name'] = $productinfo['name'];
		}
		$order_list = $this->user->get_query(array('user_id' => $user_id,'order_by' => 'post_time ASC', 'limit'=>5), 'caifu_order');
		foreach($order_list as $key => $val){
			$productinfo = $this->user->get_one(array('id' => $val['product_id']),'caifu_product');
			$order_list[$key]['order_state_name']=$this->getPointsStatusName($val['status']);
			$order_list[$key]['product_name'] = $productinfo['name'];
		}
		//网站基本设置
		$setup_setting = getcache('setup','commons');
		$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
		$hot_arr = array();
		if(!empty($hot_search)){
			$hot_arr = explode(",",$hot_search);
		}
		$data['hot_arr'] = $hot_arr;
		$data['current_nav'] = "index";
		$data['nav_category'] = $nav_category;
		$data['reserve_list'] = $reserve_list;
		$data['order_list'] = $order_list;
		$this->view('user_index', $data);
	}
	//用户中心页面
	public function udefault(){
			$this->load->model('user');
	    $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	    $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	    
	    if(isset($_POST['dosubmit']) && $_POST['dosubmit']==1) {
	    	
	    }else{
	    	//网站基本设置
				$setup_setting = getcache('setup','commons');
				$data['current_nav'] = "index";
				$this->seo_title = "密码修改 - ".$setup_setting['site_title'];
				$this->view('user_default', $data);
		 }
	}
	//我的服务经理
	public function myadvisor(){
			$this->load->model('user');
			//导航及数量
			$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
			foreach($nav_category as $key => $val){
				$cateid = $val['column_value'];
				$where = array('category'=>$cateid);
				$con=$this->a_caifu_model->count($where,'caifu_product');
				$nav_category[$key]['numbs'] = intval($con);
			}
		
	    $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	    $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	    

	    	//网站基本设置
				$setup_setting = getcache('setup','commons');
				$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
				$hot_arr = array();
				if(!empty($hot_search)){
					$hot_arr = explode(",",$hot_search);
				}
				$data['hot_arr'] = $hot_arr;
				$data['current_nav'] = "index";
				$data['nav_category'] = $nav_category;
				$this->seo_title = "密码修改 - ".$setup_setting['site_title'];
				$this->view('user_myadvisor', $data);

	}
	//密码修改
	public function modpass(){
			$this->load->model('user');
	    $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	    $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	    
	    if(isset($_POST['dosubmit']) && $_POST['dosubmit']==1) {
	    	$arr = array();
				$user_id = $this->session->userdata['member_user_id'];
				$this->load->model('user');
		
				$old_password = $this->input->get_post('oldPsd');
				$pass1 = $this->input->get_post('newPsd1');
				$pass2 = $this->input->get_post('newPsd2');

				$list = $this->user->get_one(array('user_id' => $user_id), 'user');
				if (md5(md5($old_password.$list['random'])) != $list['password']) {
					$this->showmessage('error','旧密码错误！','index.php?m=member&c=user&a=modpass');
					return;
				}
				if ($pass1 != $pass2) {
					$this->showmessage('error','两次密码不一致！','index.php?m=member&c=user&a=modpass');
					return;
				}

				$this->user->update(array('user_id' => $user_id), array('password'=>md5(md5($pass1.$list['random']))), 'user');
				$this->showmessage('success','密码更新成功！','index.php?m=member&c=user&a=modpass');
				return;
	    }else{
	    	//导航及数量
				$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
				foreach($nav_category as $key => $val){
					$cateid = $val['column_value'];
					$where = array('category'=>$cateid);
					$con=$this->a_caifu_model->count($where,'caifu_product');
					$nav_category[$key]['numbs'] = intval($con);
				}
	    	//网站基本设置
				$setup_setting = getcache('setup','commons');
				$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
				$hot_arr = array();
				if(!empty($hot_search)){
					$hot_arr = explode(",",$hot_search);
				}
				$data['hot_arr'] = $hot_arr;
				$data['current_nav'] = "index";
				$data['nav_category'] = $nav_category;
				$this->seo_title = "密码修改 - ".$setup_setting['site_title'];
				$this->view('user_modpass', $data);
		 }
	}
	//基本资料
	public function base(){
			$this->load->model('user');
	    $data['userInfo'] = $this->user->get_one(array('user_id'=>$this->user_id), 'user');
	    $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']),'user_group');
	    
			if(isset($_POST['dosubmit']) && $_POST['dosubmit']==1) {
				$_data['truename'] = trim($this->input->post('truename'));
				$_data['sex'] = trim($this->input->post('sex'));
				$_data['birthday'] = trim($this->input->post('birthday'));
				$_data['web'] = trim($this->input->post('web'));
				$_data['email'] = $this->input->post('email');
				$_data['qq'] = $this->input->post('qq');
				$_data['province_id'] = $this->input->post('province2');
				$_data['city_id'] = $this->input->post('city2');
				$_data['area_id'] = $this->input->post('county2');
				$_data['address'] = $this->input->post('address');
				if($_FILES['head_ico']['error'] == 0){
					$this->load->model('m_member_model');
					$this->load->library('iupload_lib');
					//上传文件操作
					$config=array(
						'module'=>'user',
						'shop_id'=>$this->user_id,
						'rel_id'=>$this->user_id,
						'shop_id'=>$this->user_id,
						'isadmin'=>0,
						'sts'=>0,
					);
					$this->iupload_lib->initialize($config);//配置初始化文件
					$this->iupload_lib->do_uploadfile('head_ico');//上传附件
					$file_data=$this->iupload_lib->file_data();
					$_data['head_ico']=$file_data['savepath'];
				}
				
				$this->user->update(array('user_id' => $this->user_id), $_data, 'user');
				$this->showmessage('success','资料更新成功！',HTTP_REFERER);
				return;
			}else{
				$area = $this->user->get_query(array('parent_id'=>0, 'order_by'=>'listorder asc'), 'areas');
				//导航及数量
				$nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product','category');
				foreach($nav_category as $key => $val){
					$cateid = $val['column_value'];
					$where = array('category'=>$cateid);
					$con=$this->a_caifu_model->count($where,'caifu_product');
					$nav_category[$key]['numbs'] = intval($con);
				}
				//网站基本设置
				$setup_setting = getcache('setup','commons');
				$this->seo_title = "个人资料 - ".$setup_setting['site_title'];
				$hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
				$hot_arr = array();
				if(!empty($hot_search)){
					$hot_arr = explode(",",$hot_search);
				}
				$data['hot_arr'] = $hot_arr;
	    	$data['area'] = $area;
	    	$data['current_nav'] = "index";
	    	$data['nav_category'] = $nav_category;
				$this->view('user_base', $data);
			}
	}
	//获取区域
	public function ajax_area() {
		$area_id = $this->input->get('area_id');
		$area_id = intval($area_id);
		$this->load->model('address');
		$list = array();
		if ($area_id !== false) {
			$list = $this->address->get_query(array('parent_id'=>$area_id, 'order_by'=>'listorder asc'), 'areas');
		}
		echo json_encode($list);
	}
	//获取订单统计
	public function ajax_count_total(){
		$tag_id = $this->input->get('tag_id');
		$count_sql = "";
		switch($tag_id){
			 	case 'dangmon':
			    $count_sql=" sts = 0 and buyer_id='".$this->user_id."' and order_state!=10 and order_state!=50 and FROM_UNIXTIME(add_time,'20%y-%m')=DATE_FORMAT(curdate(),'20%y-%m') "; 
					break;//本月 
				case 'lastmon':
				  $count_sql=" sts = 0 and buyer_id='".$this->user_id."' and order_state!=10 and order_state!=50 and FROM_UNIXTIME(add_time,'20%y-%m')=DATE_SUB(DATE_FORMAT(curdate(),'20%y'),INTERVAL 1 MONTH) ";
				  break;//上月
			 	case 'dangyear':
 					$count_sql=" sts = 0 and buyer_id='".$this->user_id."' and order_state!=10 and order_state!=50 and FROM_UNIXTIME(add_time,'20%y')=DATE_FORMAT(curdate(),'20%y') "; 
				 	break;//本年
			 	case 'lastyear':
			    $count_sql=" sts = 0 and buyer_id='".$this->user_id."' and order_state!=10 and order_state!=50 and FROM_UNIXTIME(add_time,'20%y')=DATE_SUB(DATE_FORMAT(curdate(),'20%y'),INTERVAL 1 YEAR) "; 
			    break;//上年
		}
		
		$order_sum = $this->user->get_query($count_sql,'order','sum(goods_amount) as num');
		$data['goods_amount'] = empty($order_sum[0]['num']) ? 0 : $order_sum[0]['num'];
		
		echo json_encode($data);
	}
	
	function getPointsStatusName($state = '10') {
		$data = array(
			'10' => '待处理',
			'11' => '已处理',
			'20' => '已取消',
			'30' => '已发货',
			'40' => '已收货',
			'50' => '已取消',
			'60' => '已完成',
		);
		return isset($data[$state]) ? $data[$state] : '未知的状态';
	}

}