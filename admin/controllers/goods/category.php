<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Category extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('type');
		$this->load->model('goods_category');
		$this->load->model('goods_category_tag');
	}
	//列表分页
	public function category_list(){
	    $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$data['page']=$page;
    	$data['pagesize']=10;

		$this->load->model('a_superman_model');
		$list=$this->a_superman_model->get_category_search($data);

		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);

		$this->cismarty->display('goods/category/category_list.html');
	}
	
	//新增
	public function category_add(){
	    $gc_parent_id = $this->input->get('gc_parent_id');
		if(isset($_POST['dosubmit'])){
		    $gc_name = $this->input->post('gc_name');
			$gc_parent_id = $this->input->post('gc_parent_id');
			$t_id = $this->input->post('t_id');
			$gc_show = $this->input->post('gc_show');
			$gc_index_show = $this->input->post('gc_index_show');
			$gc_sort = $this->input->post('gc_sort');
			$store_id  = intval($this->input->post('store_id')); 
			if ($store_id > 2 || $store_id < 0) {
				$store_id = 0;
			}

			$type_id=0;$type_name='';

			$where = array('gc_name' => $gc_name,'parent_id'=>$gc_parent_id );
			$data = $this->goods_category->get_one($where);
			if($data){
			    $this->showmessage('category_list',lang('com_hash_error'),$this->admin_url.'goods/category/category_list?loghash='.$this->session->userdata('loghash'));
			}


			$data = array(
			                'gc_name' => $gc_name,
							'parent_id' => $gc_parent_id,
							'isshow' => $gc_show,
							'gc_index_show' => $gc_index_show,
							'listorder' => $gc_sort,
							'store_id' => 0,
							'type_id' => $type_id,
							'type_name' => $type_name,
							'store_id' => $store_id
			              );
            $type = $this->goods_category->add($data);
			$this->showmessage('category_list',lang('com_add'),$this->admin_url.'goods/category/category_list?loghash='.$this->session->userdata('loghash'));

		}else{
			//查询所有1、2级分类
			$data = $this->goods_category->get_query(array('parent_id' =>0),'goods_category');
	    foreach($data as $key => $val){
				$data[$key]['have_child'] = $this->goods_category->get_query(array('parent_id' => $val['gc_id']),'goods_category');
			}
			//获取所属类型
			//$g_c_t = $this->goods_category->get_one(array('gc_id' =>$gc_parent_id),'goods_category','type_id');
			//查询类型
			//$type = $this->type->get_all('type');

			$this->cismarty->assign('data',$data);
			//$this->cismarty->assign('g_c_t',$g_c_t);
			$this->cismarty->assign('gc_parent_id',$gc_parent_id);
			//$this->cismarty->assign('type',$type);

			$this->cismarty->display('goods/category/category_add.html');
		}


	}
	
	//编辑
	public function category_edit(){
	    $gc_id = $this->input->get('gc_id');
		if(isset($_POST['dosubmit'])){
		    $data = array();
		    $gc_id = $this->input->post('gc_id');
			$data['gc_name'] = $this->input->post('gc_name');
			$data['type_name'] = $this->input->post('t_name');
			$data['type_id'] = $this->input->post('t_id');
			$data['isshow'] = $this->input->post('gc_show');
			$data['gc_index_show'] = $this->input->post('gc_index_show');
			$data['store_id'] = intval($this->input->post('store_id'));
			if ($data['store_id'] > 2 || $data['store_id'] < 0) {
				$data['store_id'] = 0;
			}
			$data['listorder'] = $this->input->post('gc_sort');
			$t_associated = $this->input->post('t_associated');
			if($data['gc_name'] == ''){
			    $this->showmessage('category_edit',lang('com_parameter'),HTTP_REFERER);
			}
			//$return = $this->category_model->category_edit($gc_id,$data);
			$return = $this->goods_category->update(array('gc_id'=>$gc_id),$data);
			//类型关联到子分类
			if($t_associated){
			    $this->goods_category->update(array('parent_id'=>$gc_id),array('type_id'=>$data['type_id'],'type_name'=>$data['type_name']));
                $category = $this->goods_category->get_query(array('parent_id'=>$gc_id),'goods_category');
                if(!empty($category)){
				    foreach($category as $v){
					    $this->goods_category->update(array('parent_id'=>$v['gc_id']),array('store_id'=>$data['store_id'], 'type_id'=>$data['type_id'],'type_name'=>$data['type_name']));
					}
				}
			}
			//echo $return;
			$this->showmessage('category_list',lang('com_edit'),$this->admin_url.'goods/category/category_list?loghash='.$this->session->userdata('loghash'));
		}else{
		    //查询分类
			$data = $this->goods_category->get_one(array('gc_id'=>$gc_id),'goods_category');

			$this->cismarty->assign('data',$data);

			$this->cismarty->display('goods/category/category_edit.html');
		}
	}
	
	//分类删除
	public function category_del(){
	    $_data_post=$this->input->post();
		$gc_id=isset($_data_post['check_gc_id'])?$_data_post['check_gc_id']:null;
		if($gc_id !== false){
		    foreach($gc_id as $val){
			    //删除该分类下的子分类
			    $where = array('parent_id' => $val);
				$category = $this->goods_category->get_query($where,'goods_category');
				if($category !== false){
				foreach($category as $value){
				    $have_child_where = array('parent_id' => $value['gc_id']);
					$categorys = $this->goods_category->get_query($have_child_where,'goods_category');
					if($categorys !== false){
						$have_child = $this->goods_category->del($have_child_where,'goods_category');
					}
				}
				$parent = $this->goods_category->del($where,'goods_category');
				}else{
				    $parent = 'Null';
				}
				//子分类删除成功，则删除分类，否则返回上一页
				if($parent !== false){
				    //删除分类
				    $where = array('gc_id' => $val);
					$return = $this->goods_category->del($where,'goods_category');
				}else{
				    $this->showmessage('category_list',lang('com_parameter'),HTTP_REFERER);
				}
			}
		}else{
		    $this->showmessage('category_list',lang('com_parameter'),HTTP_REFERER);
		}
		$this->showmessage('category_list',lang('com_del'),$this->admin_url.'goods/category/category_list?loghash='.$this->session->userdata('loghash'));
	}
	//ajax获取子分类
	/*public function ajax_category_class(){
	    $gc_parent_id = $this->input->get('gc_parent_id');
		$where = array(
		                'parent_id' => $gc_parent_id,
					  );
		$data = $this->goods_category->get_query($where,'goods_category');
		//$data = $this->dbclass_model->db_con($where,'goods_category');
		foreach($data as $key => $val){
		    $where = array(
		                'parent_id' => $val['gc_id'],
					  );
		   // $v = $this->dbclass_model->db_con($where,'goods_category');
		    $v = $this->goods_category->get_query($where,'goods_category');
			if($v){
			    $data[$key]['have_child'] = '1';
				$data[$key]['deep'] = '2';
			}else{
			    $data[$key]['have_child'] = '2';
			    $data[$key]['deep'] = '3';
			}
		}
		echo json_encode($data);
	}*/
	public function ajax_category_class(){
	    $gc_parent_id = $this->input->get('gc_parent_id');
		$where = array(
		                'parent_id' => $gc_parent_id,
					  );
		$data = $this->goods_category->get_query($where,'goods_category');
		//$data = $this->dbclass_model->db_con($where,'goods_category');
		foreach($data as $key => $val){
		    $where = array(
		                'gc_id' => $gc_parent_id,
					  );
		    $v = $this->goods_category->get_one($where,'goods_category');
		    if($v['parent_id']== 0){
		    	$data[$key]['have_child'] = '1';
			    $data[$key]['deep'] = '2';
		    }else{
		    	$data[$key]['have_child'] = '2';
			    $data[$key]['deep'] = '3';
		    }

		}
		echo json_encode($data);
	}
	
	//tag管理
	public function category_tag(){
		if(isset($_POST['dosubmit']))
		{
		    $tag_id = $this->input->post('tag_id');
			$gc_tag_value = $this->input->post('gc_tag_value');
		}else{
		    $this->load->library('ichar');
		    $page=$this->input->get('page');
		    $page=$this->ichar->act($page,'int');

		    $data['page']=$page;
    	    $data['pagesize']=10;

			$this->load->model('a_goods_model');
		    $list=$this->a_goods_model->get_categorytga_search($data);

		    $this->cismarty->assign('infolist',$list['list']);
		    $this->cismarty->assign('infopage',$list['page']);

		    $this->cismarty->display('goods/category/category_tag.html');
		}
	}
    //tag删除
    public function category_tag_del(){
	    $_data_post=$this->input->post();
		$tag_id=isset($_data_post['tag_id'])?$_data_post['tag_id']:null;
		foreach($tag_id as $val){
		    $where = array('gc_tag_id' => $val);
			$return = $this->goods_category_tag->del($where,'goods_category_tag');
			//$return = $this->type_model->type_del($where,'goods_category_tag',$val);
		}
		$this->showmessage('category_tag',lang('com_del'),$this->admin_url.'goods/category/category_tag?loghash='.$this->session->userdata('loghash'));
	}
	//tag导入
	public function category_tag_import(){
	    //查询分类
		$where = array('parent_id' => 0);
		$gc_1 = $this->goods_category->get_query($where,'goods_category');

		foreach($gc_1 as $value){
		    $where = array('parent_id' => $value['gc_id']);
		    $gc_2 = $this->goods_category->get_query($where,'goods_category');
			foreach($gc_2 as $val){
			    $where = array('parent_id' => $val['gc_id']);
		        $gc_3 = $this->goods_category->get_query($where,'goods_category');
		        if (count($gc_3)) {
	                foreach($gc_3 as $v){
					    $where = array(
						                'gc_id_1' => $value['gc_id'],
										'gc_id_2' => $val['gc_id'],
										'gc_id_3' => $v['gc_id'],
									  );
						$this->load->model('goods_category_tag');
						$tag = $this->goods_category_tag->get_query($where,'goods_category_tag');
	                    if($tag == false){
						    $data = array(
							                'gc_id_1' => $value['gc_id'],
										    'gc_id_2' => $val['gc_id'],
										    'gc_id_3' => $v['gc_id'],
							                'gc_tag_name' => $value['gc_name'].'&nbsp;&gt;&nbsp;'.$val['gc_name'].'&nbsp;&gt;&nbsp;'.$v['gc_name'],
											'gc_tag_value' => $value['gc_name'].','.$val['gc_name'].','.$v['gc_name'],
											'gc_id' => $v['gc_id'],
											'type_id' => $v['type_id'],
										 );
							$category_tag = $this->goods_category_tag->add($data,'goods_category_tag');
						}else{
						    $category_tag = 'No';
						}
					}
		        }else {
		        	$where = array(
				                'gc_id_1' => $value['gc_id'],
								'gc_id_2' => $val['gc_id'],
								'gc_id_3' => 0,
							  );
					$this->load->model('goods_category_tag');
					$tag = $this->goods_category_tag->get_query($where,'goods_category_tag');
                    if($tag == false){
					    $data = array(
					                'gc_id_1' => $value['gc_id'],
								    'gc_id_2' => $val['gc_id'],
								    'gc_id_3' => 0,
					                'gc_tag_name' => $value['gc_name'].'&nbsp;&gt;&nbsp;'.$val['gc_name'],
									'gc_tag_value' => $value['gc_name'].','.$val['gc_name'],
									'gc_id' => $val['gc_id'],
									'type_id' => $val['type_id'],
								 );
					$category_tag = $this->goods_category_tag->add($data,'goods_category_tag');		  
                    }
		        }
			}
		}
		$this->showmessage('category_tag',lang('com_updata'),$this->admin_url.'goods/category/category_tag?loghash='.$this->session->userdata('loghash'));

	}
	//AJAX判断分类名称是否存在
	public function ajax_category_name(){
	    $gc_name = $this->input->get('gc_name');
		$gc_parent_id = $this->input->get('gc_parent_id');
		$gc_id = $this->input->get('gc_id');
		if(isset($gc_id)){
		    $where = array('gc_name' => $gc_name,'parent_id' => $gc_parent_id,'gc_id' => $gc_id);
		    $d = $this->goods_category->get_one($where,'goods_category');
		}
		if(isset($d['gc_name'])==$gc_name){
		    echo 'true';
		}else{
		    $where = array('gc_name' => $gc_name,'parent_id' => $gc_parent_id);
		    $r = $this->goods_category->get_one($where,'goods_category');
		    if(isset($r)){
			    if(isset($r['gc_name'])==$gc_name) echo 'false';else echo 'true';
		    }else {
			    echo 'true';
	     	}
		}
	}
	//分类排序
	public function category_order(){
	    $gc_id = $this->input->post('hdnid');
		$listorder = $this->input->post('listorder');

		foreach($listorder as $key => $val){
		    $data = array('listorder' => $val);
		    $this->goods_category->update(array('gc_id'=>$gc_id[$key]),$data);
		    //$this->category_model->category_edit($gc_id[$key],$data);
		}
		$this->showmessage('category_list',lang('com_order'),$this->admin_url.'goods/category/category_list?loghash='.$this->session->userdata('loghash'));
	}
	/**
	 * 缓存
	 */
	public function category_cache(){
		//$where = array('isshow' => 1,'order_by'=>'listorder asc,gc_id asc');
		//$data = $this->goods_category->get_query($where,'goods_category');
		$where = array('isshow' => 1,'order_by'=>'listorder asc,gc_id asc');
		$catedatalist = $this->goods_category->get_query($where,'goods_category');
		$arr=array();
		foreach($catedatalist as $v){
			$arr[$v['gc_id']]=$v;
		}
		foreach($arr as $v){
			if(intval($v['parent_id'])>0){
				$allson=isset($arr[$v['parent_id']]['allson'])?$arr[$v['parent_id']]['allson']:'';
				$arr[$v['parent_id']]['allson']=$allson.','.$v['gc_id'];
			}
		}
		foreach($arr as $v){
			if(isset($arr[$v['gc_id']]['allson']) && !empty($arr[$v['gc_id']]['allson'])){
				$allson=$arr[$v['gc_id']]['allson'];
				$arr_allson=explode(',',$allson);
				foreach($arr_allson as $sv){
					$s_allson=isset($arr[$sv]['allson'])?$arr[$sv]['allson']:'';
					$allson=empty($s_allson)?$allson:$allson.$s_allson;
				}
				$arr[$v['gc_id']]['allson']=$v['gc_id'].$allson;
			}else{
				$arr[$v['gc_id']]['allson']='';
			}
		}
		setcache('goods_category', $arr, 'commons');
		$this->showmessage('category_list',lang('com_cache'),HTTP_REFERER);

	}
}