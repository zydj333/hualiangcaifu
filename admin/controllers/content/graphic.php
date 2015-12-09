<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Graphic extends Admin_Controller {

	/*
	    图文管理
	*/
	public function __construct()
	{
		parent::__construct();
		$this->tb_graphic_category='graphic_category';
		$this->tb_graphic='graphic';
		$this->load->model('graphic_model');
		$this->load->model('graphic_category_model');
		$this->load->model('uploadfile');
		$this->load->model('graphic');
	}
	//分页列表
	public function lists(){
	  $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    $seldata['pagesize']=10;
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_graphic_search($seldata);

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);

	    $this->cismarty->display('content/graphic/graphic_list.html');
	}
	//添加
	public function graphic_add(){
		if(isset($_POST['dosubmit'])){
		  $graphic['pic_category'] = $this->input->post('pic_category');
			$graphic['pic_title'] = $this->input->post('pic_title');
			$graphic['phone'] = $this->input->post('phone');
			$graphic['qq'] = $this->input->post('qq');
			$graphic['email'] = $this->input->post('email');
			$graphic['listorder'] = $this->input->post('listorder');
			$graphic['pic_info'] = $this->input->post('pic_info');
			$graphic['isshow'] = $this->input->post('isshow');
			$graphic['pic_time'] = time();

			$link_pic='';
			if($_FILES['pic_thumb']['error'] == 0){
				/***保存图片***/
			   $this->user_id=$this->session->userdata('admin_user_id');
			   $this->load->library('iupload_lib');
			   $config=array(
				       'module'=>'graphic',
				       'dir'=>'graphic',
				       'shop_id'=>$this->user_id,
				       'isadmin'=>1,
			         );
			   $this->iupload_lib->initialize($config);//配置初始化文件
			   $this->iupload_lib->do_uploadfile('pic_thumb');//上传附件
			   $file_id=$this->iupload_lib->save_data();//保存数据到数据库
			   if($file_id == TRUE){
				 	$file_data = $this->iupload_lib->file_data();
				 	$graphic['pic_thumb'] = $file_data['savepath'];
			   }
			}
			  
			$this->load->model('a_system_model');
			$link = $this->a_system_model->add($graphic,$this->tb_graphic);
//			if($link){
//				$config['file_id']=$file_id;
//				$config['rel_id']='1';
//				$this->iupload_lib->set($config);
//				$this->iupload_lib->save_rel_data();//保存数据到关联表
//			}
			$this->showmessage('success',lang('com_add'),$this->admin_url.'content/graphic/lists?loghash='.$this->session->userdata('loghash'));
		}else{
			$this->load->model('a_system_model');
		  $lc_list = $this->a_system_model->get_query(array('order_by'=>'listorder desc'),$this->tb_graphic_category);
			$this->cismarty->assign('lc_list',$lc_list);
		  $this->cismarty->display('content/graphic/graphic_add.html');
		}
	}
	//编辑
	public function graphic_edit(){
		$pic_id = $this->input->get('pic_id');
		if(isset($_POST['dosubmit'])){
			$pic_id = $this->input->post('pic_id');
			$old_pic_thumb = $this->input->post('old_pic_thumb');
		  $graphic['pic_title'] = $this->input->post('pic_title');
		  $graphic['pic_category'] = $this->input->post('pic_category');
		  $graphic['pic_info'] = $this->input->post('pic_info');
		  $graphic['isshow'] = $this->input->post('isshow');
		  $graphic['phone'] = $this->input->post('phone');
			$graphic['qq'] = $this->input->post('qq');
			$graphic['email'] = $this->input->post('email');
		  $graphic['listorder'] = $this->input->post('listorder');

			if($_FILES['pic_thumb']['error'] == 0){
				/***保存图片***/
			    $this->user_id=$this->session->userdata('admin_user_id');
			    $this->load->library('iupload_lib');
			    $config=array(
				       'module'=>'graphic',
				       'dir'=>'graphic',
				       'shop_id'=>$this->user_id,
				       'isadmin'=>1,
			        );
			    $this->iupload_lib->initialize($config);//配置初始化文件
			    $this->iupload_lib->do_uploadfile('pic_thumb');//上传附件
			    $file_id=$this->iupload_lib->save_data();//保存数据到数据库
			    if($file_id == TRUE){
				    $graphic_pic = $this->uploadfile->get_one(array('file_id'=>$file_id),'uploadfile','filepath');
			    }
          $image = explode('.',$old_pic_thumb);
					@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$image[0].'_w'.'.'.$image[1]);
					@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$old_pic_thumb);
					$graphic['pic_thumb'] = $graphic_pic['filepath'];
			}else{
				$graphic['pic_thumb'] = $old_pic_thumb;
			}
			
			$this->load->model('a_system_model');
			$this->a_system_model->update(array('pic_id'=>$pic_id),$graphic,$this->tb_graphic);
			$this->showmessage('success',lang('com_edit'),$this->admin_url.'content/graphic/lists?loghash='.$this->session->userdata('loghash'));

		}else{
			$pic_id=intval($pic_id);
			$this->load->model('a_system_model');
		    $graphic = $this->a_system_model->get_one(array('pic_id'=>$pic_id),$this->tb_graphic);
		    if(empty($graphic)) $this->showmessage('error',lang('com_parameter'),$this->admin_url.'content/graphic/lists?loghash='.$this->session->userdata('loghash'));
		    $lc_list = $this->a_system_model->get_query(array('order_by'=>'listorder desc'),$this->tb_graphic_category);

			$this->cismarty->assign('lc_list',$lc_list);
			$this->cismarty->assign('graphic',$graphic);
			$this->cismarty->assign('pic_id',$pic_id);

		    $this->cismarty->display('content/graphic/graphic_edit.html');
		}
	}
	 //删除
    public function graphic_del(){
	    $_data_post=$this->input->post();
			$pic_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;

			$this->load->model('a_system_model');

			foreach($pic_id as $val){
				$graphic = $this->a_system_model->get_one(array('pic_id'=>$val),$this->tb_graphic);
				$image = explode('.',$graphic['pic_thumb']);
				@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$image[0].'_w'.'.'.$image[1]);
				@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$graphic['pic_thumb']);
				$where = array('pic_id' => $val);
				$return = $this->a_system_model->del($where,$this->tb_graphic,$val);
			}

			$this->showmessage('link_del',lang('com_del'),$this->admin_url.'content/graphic/lists?loghash='.$this->session->userdata('loghash'));
	}
	/**
	 * 友情链接类型管理
	 */
	public function graphic_category_manage(){
		$op = $this->input->get_post('op');
		if(!empty($op)){
			switch($op){
				case 'list':
					$this->graphic_category_list();break;
				case 'edit':
					$this->graphic_category_edit();break;
				case 'del':
					$this->graphic_category_del();break;
				case 'add':
					$this->graphic_category_add();break;
				case 'order':
					$this->graphic_category_order();break;
				default:
					$this->graphic_category_list();
			}
		}else{
			$this->showmessage('error',lang('com_parameter'),$this->admin_url.'content/graphic/lists?loghash='.$this->session->userdata('loghash'));
		}
	}
	//类型管理
	private function graphic_category_list(){
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_all('graphic_category');
		$this->cismarty->assign('infolist',$list);
		$this->cismarty->assign('infopage','');
		$this->cismarty->display('content/graphic/graphic_category_manage.html');
	}
	/***
	 * 删除图文管理分类
	 */
	private function graphic_category_del(){
		$_data_post=$this->input->post();
		$lc_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;

		if($lc_id){
			$this->load->model('a_system_model');
		    foreach($lc_id as $val){
		        $where = array('lc_id' => $val);
			    $return = $this->a_system_model->del($where,'graphic_category',$val);
		    }
		}
		$this->showmessage('success',lang('com_del'),$this->admin_url.'content/graphic/graphic_category_manage?op=list&loghash='.$this->session->userdata('loghash'));
	}
	 /***
	 * 添加图文管理分类
	 */
	private function graphic_category_add(){
		$dosubmit = $this->input->post('dosubmit');
		if($dosubmit == 'ok'){
			$_data_post= $this->input->post();
			if(empty($_data_post['lc_name']) || empty($_data_post['listorder']))
				$this->showmessage('error',lang('com_parameter'),$this->admin_url.'content/graphic/graphic_category_manage?op=add&loghash='.$this->session->userdata('loghash'));
			$_data['lc_name']=trim($_data_post['lc_name']);
			$_data['listorder']=trim($_data_post['listorder']);
			$_data['lc_time']=SYS_TIME;

			$link_category = $this->graphic_category_model->add($_data,'graphic_category');
			$this->showmessage('adddialog',lang('com_add'),$this->admin_url.'content/graphic/graphic_category_manage?op=list&loghash='.$this->session->userdata('loghash'));
		}else{
			$lc_id = $this->input->get('id');
		  $lc_id=intval($lc_id);
			$graphic_category = $this->graphic_category_model->get_one(array('lc_id'=>$lc_id),'graphic_category');
			$this->cismarty->assign('op','add');
			$this->cismarty->assign('graphic_category',$graphic_category);
		  $this->cismarty->display('content/graphic/graphic_category.html');
		}
	}
	/***
	 * 编辑图文管理分类
	*/
	private function graphic_category_edit(){
		$dosubmit = $this->input->post('dosubmit');
		if($dosubmit == 'ok'){
			$_data_post= $this->input->post();
			if(empty($_data_post['lc_name']) || empty($_data_post['listorder']))
				$this->showmessage('error',lang('com_parameter'),$this->admin_url.'content/graphic/graphic_category_manage?op=add&loghash='.$this->session->userdata('loghash'));
			$_data['lc_name']=trim($_data_post['lc_name']);
			$_data['listorder']=trim($_data_post['listorder']);
			$_data['lc_time']=SYS_TIME;
			$lc_id=$_data_post['lc_id'];
			$lc_id=intval($lc_id);

			$link_category = $this->graphic_category_model->update(array('lc_id'=>$lc_id),$_data,'graphic_category');
			$this->showmessage('editdialog',lang('com_edit'),$this->admin_url.'content/graphic/graphic_category_manage?op=list&loghash='.$this->session->userdata('loghash'));
		}else{
			$lc_id = $this->input->get('id');
		    $lc_id=intval($lc_id);
			$link_category = $this->graphic_category_model->get_one(array('lc_id'=>$lc_id),'graphic_category');
			$this->cismarty->assign('op','edit');
			$this->cismarty->assign('link_category',$link_category);
		    $this->cismarty->display('content/graphic/graphic_category.html');
		}
	}



	//友情图文管理排序
	private function graphic_category_order(){
	  $lc_id = $this->input->post('hdnid');
		$listorder = $this->input->post('listorder');

		foreach($listorder as $key => $val){
		    $data = array('listorder' => $val);
		    $this->graphic_category_model->update(array('lc_id'=>$lc_id[$key]),$data,'graphic_category');
//		    $this->graphic_category_model->update('lc_id' => $lc_id[$key],$data,'graphic_category');
		}
		$this->showmessage('success',lang('com_order'),HTTP_REFERER);
	}

	//AJAX判断图文管理标题不能为空
	public function ajax_public_check_graphic(){
	  $link_title=$this->input->get('pic_title');
		$link_id=$this->input->get('pic_id');
		$this->load->model('a_system_model');
		if(isset($link_id)){
		    $where = array('pic_title' => $link_title,'pic_id' => $link_id);
		    $d = $this->a_system_model->get_one($where,'graphic');
		}
		if(isset($d['pic_title'])==$link_title){
		    echo 'true';
		}else{
		    $where = array('pic_title' => $link_title);
		    $r = $this->a_system_model->get_one($where,'graphic');
		    if(isset($r)){
			    if(isset($r['pic_title'])==$link_title) echo 'false';else echo 'true';
		    }else {
			    echo 'true';
	     	}
		}
	}
	//AJAX判断图文管理分类标题不能为空
	public function ajax_public_check_graphic_category(){
	    $lc_name=trim($this->input->get('lc_name'));
		$lc_id=trim($this->input->get('lc_id'));
		 $this->load->model('a_system_model');
		if(isset($lc_id)){
		    $where = array('lc_name' => $lc_name,'lc_id' => $lc_id);
		    $d = $this->a_system_model->get_one($where,'graphic_category');
		}
		if(isset($d['lc_name'])==$lc_name){
		    echo 'true';
		}else{
		    $where = array('lc_name' => $lc_name);
		    $r = $this->a_system_model->get_one($where,'graphic_category');
		    if(isset($r)){
			    if(isset($r['lc_name'])==$lc_name) echo 'false';else echo 'true';
		    }else {
			    echo 'true';
	     	}
		}
	}
	//友情链接排序
	public function graphic_order(){
	  $link_id = $this->input->post('hdnid');
		$listorder = $this->input->post('listorder');
		$this->load->model('a_system_model');
		if(!empty($link_id)){
			foreach($listorder as $key => $val){
			    $data = array('listorder' => $val);
			    $this->a_system_model->update(array('pic_id'=>$link_id[$key]),$data,$this->tb_graphic);
			}
		}
		$this->showmessage('link_list',lang('com_order'),$this->admin_url.'content/graphic/lists?loghash='.$this->session->userdata('loghash'));
	}

}