<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Goods extends Admin_Controller {

	private $tb_gc = 'goods_category';
	private $tb_gc_tag = 'goods_category_tag';
	private $tb_type_spec = 'type_spec';
	private $tb_spec = 'spec';
	private $tb_spec_value = 'spec_value';
//	private $tb_attribute = 'attribute';
//	private $tb_attribute_value = 'attribute_value';
//	private $tb_brand = 'brand';
//	private $tb_type_brand = 'type_brand';
//	private $tb_brand_c = 'brand_category';
	private $tb_goods = 'goods';
	private $tb_goods_spec = 'goods_spec';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('goods');
		$this->load->model('a_system_model');
		$this->load->model('a_goods_model');
	}
	//ok - 产品列表
	public function goods_list(){
	    $this->load->library('ichar');
			$page=$this->input->get('page');
			$page=$this->ichar->act($page,'int');

			$data['page']=$page;
    	$data['pagesize']=10;
	    if(isset($_GET['dosubmit'])){

		  $data['goods_name'] = $this->input->get('search_goods_name');
			$data['goods_category'] = $this->input->get('search_goods_category');
			$data['goods_show'] = $this->input->get('search_show');
			$data['goods_state']= $this->input->get('search_lock');

			$this->cismarty->assign('form_submit',$_GET['dosubmit']);
			$this->cismarty->assign('goods_name',$data['goods_name']);
			$this->cismarty->assign('category',$data['goods_category']);
			$this->cismarty->assign('goods_show',$data['goods_show']);
			$this->cismarty->assign('goods_state',$data['goods_state']);
		}

		$this->load->model('a_goods_model');
		$list=$this->a_goods_model->get_goods_search($data);

		$this->load->model('goods_category');
		$goods_category = $this->goods_category->get_query(array('parent_id'=>0,'order_by'=>'listorder desc'),'goods_category');
		foreach($goods_category as $key=>$val){
			$goods_category[$key]['sub'] = $this->goods_category->get_query(array('parent_id'=>$val['gc_id']),'goods_category');
			foreach($goods_category[$key]['sub'] as $keys=>$v){
			    $goods_category[$key]['sub'][$keys]['end'] = $this->goods_category->get_query(array('parent_id'=>$v['gc_id']),'goods_category');
		    }
		}
		
		$this->cismarty->assign('goods_category',$goods_category);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);
		$this->cismarty->display('goods/goods/lists.html');
	}

	public function goods_edit(){
		if(isset($_POST['dosubmit'])){
			$_data_post=$this->input->post();
			//商品基本信息
			$_data['goods_id']=$_data_post['goods_id'];
			$this->load->model('a_goods_model');
			$ginfo=$this->a_goods_model->get_one(array('goods_id'=>$_data['goods_id']),$this->tb_goods);
			if(empty($ginfo)) $this->showmessage('error',lang('com_parameter'),base_url().'index.php?m=myshop&c=goods&a=goods_list');
            
			$_data['gc_id']=$_data_post['cate_id'];//goods category id
			$_data['gc_name']=$_data_post['cate_name'];//goods category name
			$_data['type_id']=$_data_post['type_id'];//type id
			$_data['isjiajia']=$_data_post['isjiajia'];//是否开启加价按钮
			$_data['ispromotion']=$_data_post['ispromotion'];//是否开启加价按钮
			$_data['goods_name']=$_data_post['goods_name'];// goods name
			$_data['goods_shop_price']=$_data_post['goods_shop_price'];// goods price
			$_data['goods_shop_price_interval']=$_data_post['goods_shop_price_interval2'];//价格阶梯
			$_data['goods_market_price'] = $_data_post['goods_shop_price'];//市场价
			$_data['goods_market_price_interval']=$_data_post['goods_shop_price'];//原隐藏域 市场价格阶梯字段 现抛弃
			$_data['goods_serial']=999;//商品货号

			$sp_val=isset($_data_post['sp_val'])?$_data_post['sp_val']:'';//选择的规模 比如 颜色 尺码
			$_data['goods_spec']=empty($sp_val)?'':serialize($sp_val);

			//商品详情描述
			$image_path=$_data_post['image_path'];
			$_data['goods_image']=$image_path[0];
			$_data['goods_image_more']=serialize($image_path);


			$_data['brand_id']=$_data_post['brand_id'];
			$_data['goods_body']=$_data_post['goods_body'];
			$_data['goods_tech']='';
			$_data['goods_sell']=0;//$_data_post['goods_sell'];

			//其他信息
			$_data['goods_indate']= 7;
			$_data['goods_words'] = 999;
			$_data['goods_english'] = 999;
			$_data['goods_weight'] = 999;
			$_data['goods_listorder'] = $_data_post['goods_listorder'];
			$_data['goods_commend']=$_data_post['goods_commend'];
			$_data['goods_show']=$_data_post['goods_show'];
			$_data['goods_keywords']=$_data_post['seo_keywords'];
			$_data['goods_description']=$_data_post['seo_description'];
			$_data['goods_add_time']=time();

			$goods_starttime=$_data['goods_add_time'];
			$goods_indate=$_data['goods_indate'];
			$_data['goods_starttime']=$goods_starttime;
			$_data['goods_endtime']=strtotime("+$goods_indate day",$goods_starttime);
			
			//更新属性、产品的关联表数据
			//$this->a_goods_model->del(array('goods_id'=>$_data['goods_id']),'goods_attr_index');
			$type_id=intval($_data['type_id']);
			//$_data['goods_attr']=array();

			//更新规格、产品的关联表数据(表goods_spec_index)goods_id, gc_id, type_id,sp_id,sp_value_id,sp_value_name
//			$this->a_goods_model->del(array('goods_id'=>$_data['goods_id']),'goods_spec_index');
//			if(!empty($sp_val)){
//				foreach($sp_val as $sp_k => $sp_v){
//					foreach($sp_v as $k => $v){
//						$this->a_goods_model->add(array('goods_id'=>$_data['goods_id'],'gc_id'=>$_data['gc_id'],'type_id'=>$_data['type_id'],'sp_id'=>$sp_k,'sp_value_id'=>$k,'sp_value_name'=>$v),'goods_spec_index');
//					}
//				}
//			}
			//更新规格、库存、产品的关联表数据(表goods_spec)
			$goods_spec_list=$this->a_goods_model->get_query(array('goods_id'=>$_data['goods_id']),'goods_spec');
			$spec_list=isset($_data_post['spec'])?$_data_post['spec']:'';
			$sp_name=isset($_data_post['sp_name'])?serialize($_data_post['sp_name']):'';
			//$_data['spec_name']=$sp_name;
			if(!empty($spec_list)){
				foreach($spec_list as $spec_k=>$spec_v){
					foreach($goods_spec_list as $key=>$val){
						$sp_value_sel=serialize($spec_v['sp_value']);
						if($sp_value_sel==$val['spec_goods_spec'])
						{
							$goods_spec_list[$key]['nodel']=1;
							$spec_list[$spec_k]['exist']=$val['spec_id'];
						}
					}
				}
				foreach($goods_spec_list as $spec_v){
					if(!isset($spec_v['nodel'])){
						$this->a_goods_model->del(array('goods_id'=>$_data['goods_id'],'spec_id'=>$spec_v['spec_id']),'goods_spec');
					}
				}
				foreach($spec_list as $key=>$val){
					$goods_spec_id=isset($val['exist'])?$val['exist']:0;
					$spec_where['goods_id']=$_data['goods_id'];
					$spec_where['spec_name']=$sp_name;
					$spec_where['spec_goods_price']=$val['price'];
					$spec_where['spec_goods_market_price']=$val['market_price'];
					$spec_where['spec_goods_storage']=$val['stock'];
					$spec_where['spec_goods_serial']=$val['sku'];
					$spec_where['spec_goods_spec']=serialize($val['sp_value']);
					$spec_where['spec_goods_user_group_price']=serialize(json_decode($val['group_price'],1));
					if($goods_spec_id>0){
						$this->a_goods_model->update(array('goods_id'=>$_data['goods_id'],'spec_id'=>$goods_spec_id),$spec_where,'goods_spec');
					}else{
						$goods_spec_id = $this->a_goods_model->add($spec_where,'goods_spec');
					}
					if (!isset($_data['spec_id'])) {
						$_data['spec_id'] = $goods_spec_id;
					}
					if (!isset($_data['goods_shop_price'])) {
						$_data['goods_shop_price'] = $val['price'];
					}
				}
			}else{
				//$this->a_goods_model->del(array('goods_id'=>$_data['goods_id']),'goods_spec');
				$spec_where['goods_id']=$_data['goods_id'];
				$spec_where['spec_name']='';
				$spec_where['spec_goods_price']=$_data['goods_shop_price'];
				$spec_where['spec_goods_storage']=isset($_data_post['goods_storage'])?$_data_post['goods_storage']:0;
				$spec_where['spec_goods_serial']=$_data['goods_serial'];
				$spec_where['spec_goods_spec']='';
				if (count($goods_spec_list)) {
					$goods_spec_id = 0;
					foreach ($goods_spec_list as $tgsl) {
						if (!$goods_spec_id) {
							$goods_spec_id = $tgsl['spec_id'];
						}
					}
					
					if ($goods_spec_id){
						$this->a_goods_model->del(array('goods_id'=>$_data['goods_id'], 'spec_id !='=>$goods_spec_id), 'goods_spec');
						$this->a_goods_model->update(array('goods_id'=>$_data['goods_id'],'spec_id'=>$goods_spec_id),$spec_where,'goods_spec');
					}else {
						$this->a_goods_model->del(array('goods_id'=>$_data['goods_id']), 'goods_spec');
						$goods_spec_id=$this->a_goods_model->add($spec_where,'goods_spec');
					}
				}else {
					$goods_spec_id=$this->a_goods_model->add($spec_where,'goods_spec');
				}
				$_data['spec_id']=$goods_spec_id;
				$_data['goods_shop_price'] = $_data['goods_shop_price'];
			}
			//颜色图片上传操作
			$goods_col_img=$old_goods_col_img=array();
			$old_goods_col_img=unserialize($ginfo['goods_col_img']);
			if(!empty($sp_val)){
				$this->load->library('iupload_lib');
				foreach($sp_val as $sp_k => $sp_v){
					if($sp_k==1){//1表示图片
						foreach($sp_v as $k => $v){
							$config=array(
								'module'=>'goods_col_img',
								'shop_id'=>0,
								'rel_id'=>$_data['goods_id'],
								'allows_thumb'=>'w|s|m|b',
							);
							$this->iupload_lib->initialize($config);//配置初始化文件
							$this->iupload_lib->do_uploadfile($v);
							$file_id=$this->iupload_lib->save_data();
							$file_data=$this->iupload_lib->file_data();
							if($file_id!==false){
								$config['file_id']=$file_id;
								$this->iupload_lib->set($config);//配置初始化文件
								$this->iupload_lib->save_rel_data();//上传附件
								$goods_col_img[$k]=array('filepath'=>$file_data['savepath'],'name'=>$v);
							}else{
								if(isset($old_goods_col_img[$k])){
									$goods_col_img[$k]=$old_goods_col_img[$k];
								}
							}
						}
					}
				}
				$_data['goods_col_img']=serialize($goods_col_img);
			}

		    $this->a_goods_model->update(array('goods_id'=>$_data['goods_id']),$_data,$this->tb_goods);
		    $this->showmessage('success','产品信息更新成功！',$this->admin_url.'goods/goods/goods_list?loghash='.$this->session->userdata('loghash'));
		}else{

			$goods_id = $this->input->get('goods_id');
			$change_class_id = $this->input->get('class_id');
			$change_class_id=intval($change_class_id);
			$this->load->model('a_goods_model');
			//商品的信息
			$goods_info=$this->a_goods_model->get_one(array('goods_id'=>$goods_id),$this->tb_goods);
			if(empty($goods_info)) $this->showmessage('error',lang('com_parameter'),HTTP_REFERER);

			$class_id=$change_class_id==0?intval($goods_info['gc_id']):$change_class_id;

			//商品的分类
			$gc_info=$this->a_goods_model->get_one(array('gc_id'=>$class_id),$this->tb_gc);
			$type_id=intval($gc_info['type_id']);
			//商品的分类的tag
			$gc_tag_name = '';
			$tag_info=$this->a_goods_model->get_one(array('gc_id' => $class_id),$this->tb_gc_tag);
			if(empty($tag_info)){
				$tag_info=$this->a_goods_model->get_one(array('gc_id'=>$class_id,'type_id'=>$type_id),$this->tb_gc);
				$gc_tag_name = $tag_info['gc_name'];
			}else{
				$gc_tag_name = $tag_info['gc_tag_name'];
			};

			/***商品规格**start***/
//			$ts_list=$this->a_goods_model->get_query(array('type_id'=>$type_id),$this->tb_spec);
//			$sp_ids=cc_array_to_str($ts_list,'sp_id');
//			$spec_list=array();
//			if(!empty($sp_ids)) $spec_list=$this->a_goods_model->get_query('sp_id in ('.$sp_ids.')',$this->tb_spec);
			$spec_list=array();
		  $spec_list=$this->a_goods_model->get_query(array('order_by'=>'listorder desc'),$this->tb_spec);
			
			$sp_list=array();
			foreach($spec_list as $key=>$val){
				$sp_list[$key]=$val;
				$spec_photo_list=$this->a_goods_model->get_query(array('sp_id'=>$val['sp_id']),$this->tb_spec_value,'sp_value_id,sp_value_name,sp_value_image');
				$sp_list[$key]['sp_value_photo']=$spec_photo_list;
			}

			//商品自己的规格,同时计算库存
			$self_goods_spec=$this->a_goods_model->get_query(array('goods_id'=>$goods_id),$this->tb_goods_spec);
			$e_sp_list=$e_spv_list=array();$goods_info['goods_kc']=0;
			$e_user_group_list = array();
			if(!empty($self_goods_spec)){
				foreach($self_goods_spec as $v){
					$spec_goods_spec=$v['spec_goods_spec'];
						if(!empty($spec_goods_spec)){
							$spec_goods_spec=unserialize($spec_goods_spec);
							$e_spv='';
							foreach($spec_goods_spec as $k=>$c){
								$e_sp_list[$k]=$c;
								$e_spv.=$k;
							}
							$spec_goods_user_group_list = $v['spec_goods_user_group_price'];
							if (!empty($spec_goods_user_group_list)) {
								$spec_goods_user_group_list = json_encode(unserialize($spec_goods_user_group_list));
								$v['spec_goods_user_group_price'] = $spec_goods_user_group_list;
							}
							$e_spv_list[$e_spv]=$v;
						}

					$goods_info['goods_kc']=$goods_info['goods_kc']+$v['spec_goods_storage'];
				}
			}
			/***商品规格**end***/


			/***用户自定义商品类型**start***/
//			$category_list=$this->a_goods_model->get_query(array('shop_id'=>$this->user_id,'order_by'=>'listorder asc'),$this->tb_sgc);
//			$this->load->helper('tree');
//			$category_list=tr_sortdata($category_list);

			//产品自定义分类
//			$self_category_list=$this->a_goods_model->get_query(array('goods_id'=>$goods_info['goods_id']),'shop_goods_category_rel');
			/***用户自定义商品类型**end***/
			/*规格处理*/
			$goods_spec_more=@unserialize($goods_info['goods_spec']);
			$goods_spec_new = array();
			if(!empty($goods_spec_more)){
				foreach($goods_spec_more as $key => $val){
					foreach($val as $k => $v){
						array_push($goods_spec_new,$v);
					}
				}
			}
			$goods_info['goods_spec_more']=$goods_spec_new;
			/****图片处理*start**/
			$goods_image_more=@unserialize($goods_info['goods_image_more']);
			$goods_info['goods_image_more']=$goods_image_more;

			$goods_col_img=unserialize($goods_info['goods_col_img']);
			$goods_info['goods_col_img']=$goods_col_img;
			/****图片处理*end**/

			//$data['sp_list']=$sp_list;
			//$data['attr_list']=$attr_list;
			//$data['attr_value_list']=$attr_value_list;
			//$data['brand_list']=$brand_list;

			//s$data['category_list']=$category_list;
			//$data['tag_info']=$tag_info;

			//$data['sgc_list']=$self_category_list;
			//$data['self_goods_spec']=$self_goods_spec;
			//$data['e_sp_list']=$e_sp_list;
			//$data['e_spv_list']=$e_spv_list;
			//$data['self_attr_list']=$self_attr_list;
			//$data['tp_val']=$t_val;
			//产品系列
			$dict_list = $this->a_system_model->get_dictionary_list('goods_price_library','cateid');
			//$data['goods_info']=$goods_info;
			$this->cismarty->assign('class_id',$class_id);
			$this->cismarty->assign('catelist',$dict_list);
			$this->cismarty->assign('goods_info',$goods_info);
			$this->cismarty->assign('tag_info',$tag_info);
			$this->cismarty->assign('sp_list',$sp_list);
			$this->cismarty->assign('e_sp_list',$e_sp_list);
			$this->cismarty->assign('e_spv_list',$e_spv_list);
			$this->cismarty->assign('gc_tag_name',$gc_tag_name);
			$this->cismarty->display('goods/goods/goods_edit.html');

		}
	}

	public function goods_up(){
        $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$data['page']=$page;
    	$data['pagesize']=10;
	    if(isset($_GET['dosubmit'])){

		    $data['goods_name'] = $this->input->get('search_goods_name');
			$data['brand_id'] = $this->input->get('search_brand_id');
			$data['goods_category'] = $this->input->get('search_goods_category');

			$this->cismarty->assign('form_submit',$_GET['dosubmit']);
			$this->cismarty->assign('goods_name',$data['goods_name']);
			$this->cismarty->assign('brand_id',$data['brand_id']);
			$this->cismarty->assign('category',$data['goods_category']);
			$this->cismarty->assign('shop_name',$data['shop_name']);
		}

		$this->load->model('a_goods_model');
		$list=$this->a_goods_model->get_goodsup_search($data);

		$this->load->model('goods_category');
		$goods_category = $this->goods_category->get_query(array('parent_id'=>0),'goods_category');
		foreach($goods_category as $key=>$val){
			$goods_category[$key]['sub'] = $this->goods_category->get_query(array('parent_id'=>$val['gc_id']),'goods_category');
			foreach($goods_category[$key]['sub'] as $keys=>$v){
			    $goods_category[$key]['sub'][$keys]['end'] = $this->goods_category->get_query(array('parent_id'=>$v['gc_id']),'goods_category');
		    }
		}
		$this->load->model('brand');
		$brand_all = $this->brand->get_query(array('sts'=>0),'brand');

		foreach($list['list'] as $key=>$val){
		    if($val['brand_id']){
			    $this->load->model('brand');
			    $brand = $this->brand->get_one(array('sts'=>0,'id'=>$val['brand_id']),'brand');
			    $list['list'][$key]['brand_name'] = $brand['name'];
			}
		}

		$this->cismarty->assign('brand',$brand_all);
		$this->cismarty->assign('goods_category',$goods_category);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);
	    $this->cismarty->display('goods/goods/goods_up.html');
	}

	public function goods_del(){
	  $act = $this->input->get('act');
	  $_data_post=$this->input->post();
		$goods_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;
		if($goods_id !== false){
		    foreach($goods_id as $val){
			    $where = array('sts' => 1,'goods_state' => 1,'goods_show' => 0);
				$return = $this->goods->update(array('goods_id'=>$val),$where);
			}
		}else{
		    $this->showmessage('goods',lang('com_parameter'),HTTP_REFERER);
		}
		if($act == true){
		    $this->showmessage('goods',lang('com_del'),$this->admin_url.'goods/goods/goods_up?loghash='.$this->session->userdata('loghash'));
		}else{
		    $this->showmessage('goods',lang('com_del'),$this->admin_url.'goods/goods/goods_list?loghash='.$this->session->userdata('loghash'));
		}
	}
	
	public function goods_add()
	{   
         	
		$ac=$this->input->get_post('ac');
		if(empty($ac)) $ac='one';
		$data['ac']=$ac;
       
		
		switch($ac){
			case 'one':
				$this->goods_add_one($data);
				break;
			case 'two':
				$this->goods_add_two($data);
				break;
			default://默认为base
				$this->shop_base($data);
		}
	}
	//ok - 产品添加 - 第一步
	private function goods_add_one($data){

		$goods_id = $this->input->get('goods_id');
		$goods_id=intval($goods_id);
		$this->load->model('a_goods_model');
		$cat_list = $this->a_goods_model->get_query(array('parent_id'=>0,'order_by'=>'listorder desc'),$this->tb_gc);

		$this->cismarty->assign('cat_list',$cat_list);
		$this->cismarty->assign('goods_id',$goods_id);
		$this->cismarty->display('goods/goods/goods_add_one.html');

	}

	public function ajax_category_class(){
	    $gc_parent_id = $this->input->get('gc_id');
		$where = array('parent_id' => $gc_parent_id,'order_by'=>'listorder asc, gc_id asc');
		$this->load->model('a_goods_model');
		$data = $this->a_goods_model->get_query($where,$this->tb_gc,'gc_id,parent_id,gc_name,type_id');

		if(!empty($data)){
			$json=cc_json_encode($data);echo $json;
		}
		exit(0);
	}

	private function goods_add_two($data){
	
	
		if(isset($_POST['dosubmit'])){

			$_data_post=$this->input->post();
			$class_id=intval($_data_post['cate_id']);
			
			$this->load->model('a_goods_model');
			$gc_info=$this->a_goods_model->get_one(array('gc_id'=>$class_id),$this->tb_gc);//goods_category
			if(empty($gc_info)) $this->showmessage('error',lang('com_parameter'),base_url().'index.php?m=myshop&c=goods&a=goods_list');
			//商品基本信息
			$_data['gc_id']=$class_id;//db_good_categroy 的id 商品分类的id
			$_data['gc_name']=$_data_post['gc_tag_name'];//商品分类的name. e.g 品牌女装 > 裙装 > 连衣裙  db_goods_category_tag
			$_data['type_id']=$_data_post['type_id'];
			$_data['goods_name']=$_data_post['goods_name'];//商品的名字
			$_data['isjiajia']=$_data_post['isjiajia'];//是否开启加价按钮
			$_data['ispromotion']=$_data_post['ispromotion'];//是否开启加价按钮
			$_data['goods_shop_price']=$_data_post['goods_shop_price'];//商品的价格
			$_data['goods_market_price'] = $_data_post['goods_shop_price'];//市场价
			$_data['goods_shop_price_interval']=$_data_post['goods_shop_price_interval2'];//原隐藏域 商店价格阶梯字段 现抛弃
			$_data['goods_market_price_interval']=$_data_post['goods_shop_price_interval2'];//原隐藏域 市场价格阶梯字段 现抛弃
			$_data['goods_serial']=999;//商品货号
			$_data['goods_nofeesum']=0;//商品满多少件免运费

			$sp_val=isset($_data_post['sp_val'])?$_data_post['sp_val']:'';
			$_data['goods_spec']=empty($sp_val)?'':serialize($sp_val);

			//商品详情描述
			$image_path=$_data_post['image_path'];
			$_data['goods_image']=$image_path[0];
			$_data['goods_image_more']=serialize($image_path);

			$goods_attr_arr=isset($_data_post['attr'])?$_data_post['attr']:'';
			$goods_attr=empty($goods_attr_arr)?'':serialize($goods_attr_arr);
			$_data['goods_attr']=$goods_attr;
			$_data['brand_id']=$_data_post['brand_id'];
			$_data['goods_body']=$_data_post['goods_body'];
			$_data['goods_tech']='';

			$sp_name=isset($_data_post['sp_name'])?serialize($_data_post['sp_name']):'';
			$_data['spec_name']=$sp_name;
			$_data['spec_open']=empty($sp_name)?0:1;

			//其他信息
			$_data['goods_indate']= 7;
			$_data['goods_words'] = 999;
			$_data['goods_english'] = 999;
			$_data['goods_weight'] = 999;
			$_data['goods_listorder'] = $_data_post['goods_listorder'];
			$_data['goods_commend']=$_data_post['goods_commend'];
			$_data['goods_show']=$_data_post['goods_show'];
			$_data['goods_keywords']=$_data_post['seo_keywords'];
			$_data['goods_description']=$_data_post['seo_description'];
			$_data['goods_add_time']=time();

			//放入仓库的三种逻辑：
			//1、立即发布：goods_show=1,goods_starttime=now,goods_endtime=now+7
			$goods_starttime=$_data['goods_add_time'];
			$goods_indate=$_data['goods_indate'];
			$_data['goods_starttime']=$goods_starttime;
			$_data['goods_endtime']=strtotime("+$goods_indate day",$goods_starttime);
			
			$this->load->model('a_goods_model');
			$goods_id=$this->a_goods_model->add($_data,$this->tb_goods);

			$_data_2=array();
			if($goods_id>0){
				//更新规格、产品的关联表数据(表goods_spec_index)goods_id, gc_id, type_id,sp_id,sp_value_id,sp_value_name
//				if(!empty($sp_val)){
//					foreach($sp_val as $sp_k => $sp_v){
//						foreach($sp_v as $k => $v){
//							$goods_spec_index_id=$this->a_goods_model->add(array('goods_id'=>$goods_id,'gc_id'=>$_data['gc_id'],'type_id'=>$_data['type_id'],'sp_id'=>$sp_k,'sp_value_id'=>$k,'sp_value_name'=>$v),'goods_spec_index');
//						}
//					}
//				}
				//更新规格、库存、产品的关联表数据(表goods_spec)
				$spec_list=isset($_data_post['spec'])?$_data_post['spec']:'';
				if(!empty($spec_list)){
					$sp_val_i=0;
					foreach($spec_list as $key=>$val){
						$spec_where['goods_id']=$goods_id;
						$spec_where['spec_name']=$sp_name;
						$spec_where['spec_goods_price']=$val['price'];
						$spec_where['spec_goods_market_price']=$val['market_price'];
						$spec_where['spec_goods_storage']=$val['stock'];
						$spec_where['spec_goods_serial']=$val['sku'];
						$spec_where['spec_goods_user_group_price']=serialize(json_decode($val['group_price'],1));
						$spec_where['spec_goods_spec']=serialize($val['sp_value']);
						$spec_where['spec_goods_weight'] = $_data_post['goods_weight'];
						$goods_spec_id=$this->a_goods_model->add($spec_where,'goods_spec');
						if($sp_val_i==0) {$_data_2['spec_id']=$goods_spec_id;}
						$sp_val_i++;
					}
				}else{//没有规格时候
					$spec_where['goods_id']=$goods_id;
					$spec_where['spec_name']='';
					$spec_where['spec_goods_price']=$_data['goods_shop_price'];
					$spec_where['spec_goods_storage']=isset($_data_post['goods_storage'])?$_data_post['goods_storage']:0;
					$spec_where['spec_goods_serial']=$_data['goods_serial'];
					$spec_where['spec_goods_spec']='';
					$spec_where['spec_goods_weight'] = 999;
					$goods_spec_id=$this->a_goods_model->add($spec_where,'goods_spec');
					$_data_2['spec_id']=$goods_spec_id;
				}
				//颜色图片上传操作
				$goods_col_img=array();
				if(!empty($sp_val)){
					$this->load->library('iupload_lib');
					foreach($sp_val as $sp_k => $sp_v){
						if($sp_k==1){//1表示图片
							foreach($sp_v as $k => $v){
								$config=array(
									'module'=>'goods_col_img',
									'shop_id'=>0,
									'rel_id'=>$goods_id
								);
								$this->iupload_lib->initialize($config);//配置初始化文件
								$this->iupload_lib->do_uploadfile($v);
								$file_id=$this->iupload_lib->save_data();
								$file_data=$this->iupload_lib->file_data();
								if($file_id!==false){
									$config['file_id']=$file_id;
									$this->iupload_lib->set($config);//配置初始化文件
									$this->iupload_lib->save_rel_data();//上传附件
									$goods_col_img[$k]=array('filepath'=>$file_data['savepath'],'name'=>$v);
								}
							}
						}
					}
					$_data_2['goods_col_img']=serialize($goods_col_img);
				}
				if(!empty($_data_2)) $this->a_goods_model->update(array('goods_id'=>$goods_id),$_data_2,$this->tb_goods);
			}
			$this->showmessage('success',lang('com_add'),$this->admin_url.'goods/goods/goods_list?loghash='.$this->session->userdata('loghash'));

		}else{

			$class_id = $this->input->get('class_id');
			$type_id = $this->input->get('t_id');
			$class_id=intval($class_id);
			$type_id=intval($type_id);
			
			$this->load->model('a_goods_model');
			
			$gc_tag_name = '';
			$tag_info=$this->a_goods_model->get_one(array('gc_id' => $class_id),$this->tb_gc_tag);
			if(empty($tag_info)){
				$tag_info=$this->a_goods_model->get_one(array('gc_id'=>$class_id,'type_id'=>$type_id),$this->tb_gc);
				$gc_tag_name = $tag_info['gc_name'];
			}else{
				$gc_tag_name = $tag_info['gc_tag_name'];
			};

			/***商品规格**start***/
			$spec_list=array();
		  $spec_list=$this->a_goods_model->get_query(array('order_by'=>'listorder desc'),$this->tb_spec);

			$sp_list=array();
			foreach($spec_list as $key=>$val){
				$sp_list[$key]=$val;
				$spec_photo_list=$this->a_goods_model->get_query(array('sp_id'=>$val['sp_id'],'order_by'=>'listorder desc'),$this->tb_spec_value,'sp_value_id,sp_value_name,sp_value_image');
				$sp_list[$key]['sp_value_photo']=$spec_photo_list;
			}
			/***商品规格**end***/
			//产品系列
			$dict_list = $this->a_system_model->get_dictionary_list('goods_price_library','cateid');
			
			$this->cismarty->assign('catelist',$dict_list);		
			$this->cismarty->assign('sp_list',$sp_list);
			$this->cismarty->assign('class_id',$class_id);
			$this->cismarty->assign('type_id',$type_id);
			$this->cismarty->assign('gc_tag_name',$gc_tag_name);
			$this->cismarty->display('goods/goods/goods_add_two.html');
		}
	}

	function user_group_price() {
		$group_price = $this->input->get('sell_price');
		$this->load->model('a_goods_model');
		$user_group_list = $this->a_goods_model->get_query(array('order_by'=>'listorder asc'), 'user_group');

		$this->cismarty->assign('sell_price', $group_price);
		$this->cismarty->assign('user_group_list',$user_group_list);
		$this->cismarty->display('goods/goods/group_price_add.html');
	}
	
	//排序
	public function goods_order(){
	    $lc_id = $this->input->post('id');
			$listorder = $this->input->post('listorder');

			foreach($listorder as $key => $val){
		    $data = array('goods_listorder' => $val);
		    $this->a_goods_model->update(array('goods_id' => $lc_id[$key]),$data,'goods');
			}
			$this->showmessage('success',lang('com_order'),HTTP_REFERER);
		}

}