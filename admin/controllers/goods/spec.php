<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Spec extends Admin_Controller {
    /*
	    规格管理
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->model('spec_value');
		$this->load->model('uploadfile');
		$this->load->model('spec');
		$this->tb_spec='spec';//规格表
		$this->tb_spec_value='spec_value';//规格属性表
		$this->tb_uploadfile='uploadfile';//附件表
	}

	/**
	 * 规格管理
	 */
	public function spec_list()
	{
		$this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$data['page']=$page;
    	$data['pagesize']=10;

		$this->load->model('a_goods_model');
		$list=$this->a_goods_model->get_spec_search($data);

		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);
	    $this->cismarty->display('goods/spec/spec_list.html');
	}
	/**
	 * 规格添加
	 */
	public function spec_add()
	{
	    if(isset($_POST['dosubmit'])){

			$sp_name = $_POST['sp_name'];
	    $sp_listorder = $_POST['sp_listorder'];
			$sp_format = $_POST['sp_format'];

			$s_value_list= isset($_POST['s_value'])?$_POST['s_value']:array();
			$_data_post=$this->input->post();

			$info = array('sp_name' => $sp_name,'listorder' => $sp_listorder,'sp_format' => $sp_format,'sp_value' => '|',);
			$sp_id = $this->spec->add($info,$this->tb_spec);
			if($sp_id){
				if($sp_format == 'text'){
					foreach($s_value_list as $k=>$v){
						$image_path_list[$k]='';
					}
				}elseif($sp_format == 'image'){
				    //图片格式编辑
					$image_path_list = $_POST['textfield'];
					$this->user_id=$this->session->userdata('admin_user_id');
					$this->load->library('iupload_lib');
					$config=array(
						'module'=>'spec_logo',
						'dir'=>'spec',
						'shop_id'=>$this->user_id,
						'isadmin'=>1,
					);
					foreach($s_value_list as $k=>$v){
						$s_value_key = $_FILES['s_value_image_'.$k];
					    if($s_value_key['error']==0){
						    $this->iupload_lib->initialize($config);//配置初始化文件
					        $this->iupload_lib->do_uploadfile('s_value_image_'.$k);//上传附件
					        $file_id=$this->iupload_lib->save_data();//保存数据到数据库
					        if($file_id>0){
								$file_data=$this->iupload_lib->file_data();
								$image_path_list[$k] =$file_data['savepath'];
					        }else{
								$image_path_list[$k] ='';
					        }
						}
					}
				}

				//更新规格值表数据
				foreach($s_value_list as $k => $v){
					$value_data = array('sp_value_name' => $v['name'],'listorder' => $v['sort'],'sp_id' => $sp_id,'sp_value_image'=>$image_path_list[$k]);
					$this->spec_value->add($value_data,$this->tb_spec_value);
				}
				//组装后的数据排序
				$spec_value_list = $this->spec_value->get_query(array('sp_id'=>$sp_id,'order_by'=>'listorder asc'),'spec_value','sp_value_name');
				foreach($spec_value_list as $v){
					$sp_value_name[]=$v['sp_value_name'];
				}
				//更新规格表数据
				$vlaue = implode(',',$sp_value_name);
	      $data = array('sp_value' => $vlaue,);
				$return = $this->spec->update(array('sp_id'=>$sp_id),$data,$this->tb_spec);
				$this->showmessage('success',lang('com_add'),$this->admin_url.'goods/spec/spec_list?loghash='.$this->session->userdata('loghash'));
			}else{
				$this->showmessage('error',lang('com_error'),$this->admin_url.'goods/spec/spec_list?loghash='.$this->session->userdata('loghash'));
			}
		}else{
		    $this->cismarty->display('goods/spec/spec_add.html');
		}

	}
	//规格编辑
	public function spec_edit()
	{
		if(isset($_POST['dosubmit'])){
		    $sp_id = $_POST['sp_id'];
			$sp_name = $_POST['sp_name'];
	        $sp_listorder = $_POST['sp_listorder'];
			$sp_format = $_POST['sp_format'];
			$sp_value = $_POST['sp_value'];
			$sp_value_list = explode(',',$sp_value);

			$s_value_list= isset($_POST['s_value'])?$_POST['s_value']:array();
			$s_name_list=array();
			foreach ($s_value_list as $key => $val) {
				$s_name_list[] = $val['key']['name'];
			}
			//取出元素规格中的差级别，并且删除
			$sp_name_del_list = array_diff($sp_value_list,$s_name_list);
			foreach($sp_name_del_list as $val){
				$this->spec_value->del(array('sp_value_name'=>$val,'sp_id'=>$sp_id),'spec_value');
			}

			if($sp_format == 'text'){
				foreach($s_value_list as $k=>$v){
					$image_path_list[$k]='';
				}
			}elseif($sp_format == 'image'){
			    //图片格式编辑
				$image_path_list = $_POST['textfield'];
				$this->user_id=$this->session->userdata('admin_user_id');
				$this->load->library('iupload_lib');
				$config=array(
					'module'=>'spec_logo',
					'dir'=>'spec',
					'shop_id'=>$this->user_id,
					'isadmin'=>1,
				);
				foreach($s_value_list as $k=>$v){
					$s_value_key = $_FILES['s_value_image_'.$k];
				    if($s_value_key['error']==0){
					    $this->iupload_lib->initialize($config);//配置初始化文件
				        $this->iupload_lib->do_uploadfile('s_value_image_'.$k);//上传附件
				        $file_id=$this->iupload_lib->save_data();//保存数据到数据库
				        if($file_id>0){
							$file_data=$this->iupload_lib->file_data();
							$image_path_list[$k] =$file_data['savepath'];
				        }else{
							$image_path_list[$k] ='';
				        }
					}
				}
			}



			//更新规格值表数据
			foreach($s_value_list as $key => $vlaue){
			    foreach($vlaue as $v){
			    	$spec_value_info=$this->spec_value->get_one(array('sp_value_name'=>$v['name'],'sp_id'=>$sp_id),'spec_value');
					if(empty($spec_value_info)){
					    $photo_data = array('sp_value_name' => $v['name'],'listorder' => $v['sort'],'sp_id' => $sp_id,'sp_value_image'=>$image_path_list[$k]);
						$return = $this->spec_value->add($photo_data);
					}else{
					    $photo_data = array('listorder' => $v['sort'],);
						$spec_photo = $this->spec_value->update(array('sp_value_name'=>$v['name'],'sp_id'=>$sp_id),$photo_data);
					}
				}
			}

			//组装后的数据排序
			$spec_value_list = $this->spec_value->get_query(array('sp_id'=>$sp_id,'order_by'=>'listorder asc'),'spec_value','sp_value_name');
			foreach($spec_value_list as $v){
				$sp_value_name[]=$v['sp_value_name'];
			}
			//更新规格表数据
			$vlaue = implode(',',$sp_value_name);
            $data = array('sp_name' => $sp_name,'listorder' => $sp_listorder,'sp_format' => $sp_format,'sp_value' => $vlaue,);
			$return = $this->spec->update(array('sp_id'=>$sp_id),$data);
			$this->showmessage('success',lang('com_edit'),$this->admin_url.'goods/spec/spec_list?loghash='.$this->session->userdata('loghash'));
		}else{
		    $sp_id = $this->input->get('id');
			$spec_info = $this->spec->get_one(array('sp_id'=>intval($sp_id)),$this->tb_spec);
			if(empty($spec_info)){$this->showmessage('error',lang('com_oninfo'),$this->admin_url.'goods/spec/spec_list?loghash='.$this->session->userdata('loghash'));}
			$spec_value_list = $this->spec_value->get_query(array('sp_id'=>$sp_id,'order_by'=>'listorder desc'),$this->tb_spec_value);
		    $this->cismarty->assign('spec_value_list',$spec_value_list);
			$this->cismarty->assign('spec_info',$spec_info);
	        $this->cismarty->display('goods/spec/spec_edit.html');
		}
	}
	//规格删除
	public function spec_del(){
	    $_data_post = $this->input->post();
		$sp_id = isset($_data_post['del_id'])?$_data_post['del_id']:null;
		foreach($sp_id as $val){
		    //查询规格是否存在
			$spec = $this->spec->get_one(array('sp_id'=>$val),'spec');
			//规格值不存在返回上一页
			if($spec==FALSE){
			    $this->showmessage('error',lang('com_parameter'),HTTP_REFERER);
			}
			//删除图片规格的图片
			if($spec['sp_format']=='image'){
			    $spec_value = $this->spec_value->get_query(array('sp_id'=>$spec['sp_id']),'spec_value');
				foreach($spec_value as $val){
				    $image = explode('.',$val['sp_value_image']);
					@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$val['sp_value_image']);
				    @unlink($_SERVER['DOCUMENT_ROOT'].'/'.$image[0].'_w'.'.'.$image[1]);
				}
			}
			//删除规格值
			$this->spec_value->del(array('sp_id'=>$spec['sp_id']),'spec_value');
			//删除规格
			$return = $this->spec->del(array('sp_id'=>$spec['sp_id']),'spec');
		}
		$this->showmessage('category_list',lang('com_del'),$this->admin_url.'goods/spec/spec_list?loghash='.$this->session->userdata('loghash'));

	}
	/**
	 * AJAX判断规格名称是否存在
	 */
	public function ajax_spec_name(){
	    $sp_name = $this->input->get('sp_name');
		$sp_id = $this->input->get('sp_id');

		$spec_list=$this->spec->get_query(array('sp_name' => $sp_name),$this->tb_spec);

		if( intval($sp_id) >0){
			foreach($spec_list as $v){
				if($v['sp_id'] != $sp_id){
					echo 'false';exit;
				}
			}
		}else{
			if(count($spec_list)>0){
				echo 'false';exit;
			}
		}
		echo 'true';exit;
	}
	/**
	 * 排序
	 */
	public function spec_order(){
	    $sp_id = $this->input->post('hdnid');
		$listorder = $this->input->post('listorder');

		foreach($listorder as $key => $val){
		    $data = array('listorder' => $val);
		    $this->spec->update(array('sp_id'=>$sp_id[$key]),$data);
		}
		$this->showmessage('success',lang('com_order'),$this->admin_url.'goods/spec/spec_list?loghash='.$this->session->userdata('loghash'));
	}
}