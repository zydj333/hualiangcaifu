<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Link extends Admin_Controller{

	/*
	    友情链接
	*/
	public function __construct()
	{
		parent::__construct();
		$this->tb_link_category='link_category';
		$this->tb_link='link';
		$this->load->model('link_model');
		$this->load->model('link_category_model');
		$this->load->model('uploadfile');
	}
	//分页列表
	public function link_list(){
	    $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    	$seldata['pagesize']=10;
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_link_search($seldata);

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);

	    $this->cismarty->display('system/link/link_list.html');
	}
	//添加
	public function link_add(){
		if(isset($_POST['dosubmit'])){
		    $link_title = $this->input->post('link_title');
			$link_url = $this->input->post('link_url');
			$listorder = $this->input->post('link_sort');
			$link_category = $this->input->post('link_category');
			$link_class = $this->input->post('link_class');
			$link_name = $this->input->post('link_name');
			$link_info = $this->input->post('link_info');
			$link_recommend = $this->input->post('link_recommend');
			$link_pass = $this->input->post('link_pass');

			if($link_class == 'logo'){
				$link_pic='';
				if($_FILES['link_pic']['error'] == 0){
					/***保存图片***/
			        $this->user_id=$this->session->userdata('admin_user_id');
			        $this->load->library('iupload_lib');
			        $config=array(
				       'module'=>'link_logo',
				       'dir'=>'link',
				       'shop_id'=>$this->user_id,
				       'isadmin'=>1,
			                     );
			        $this->iupload_lib->initialize($config);//配置初始化文件
			        $this->iupload_lib->do_uploadfile('link_pic');//上传附件
			        $file_id=$this->iupload_lib->save_data();//保存数据到数据库
			        if($file_id == TRUE){
				        $file_data = $this->iupload_lib->file_data();
				        $link_pic = $file_data['savepath'];
			        }
				}
			    $data = array(
			        'link_title' => $link_title,
				    'link_url' => $link_url,
				    'listorder' => $listorder,
					'link_category' => $link_category,
					'link_class' => $link_class,
					'link_name' => $link_name,
					'link_info' => $link_info,
					'link_recommend' => $link_recommend,
					'link_pass' => $link_pass,
					'link_pic' => $link_pic,
			    );
			}elseif($link_class == 'text'){
			    $data = array(
			        'link_title' => $link_title,
				    'link_url' => $link_url,
				    'listorder' => $listorder,
					'link_category' => $link_category,
					'link_class' => $link_class,
					'link_name' => $link_name,
					'link_info' => $link_info,
					'link_recommend' => $link_recommend,
					'link_pass' => $link_pass,
			    );
			}

			$this->load->model('a_system_model');
			$link = $this->a_system_model->add($data,$this->tb_link);
			if($link){
				$config['file_id']=$file_id;
				$config['rel_id']='1';
				$this->iupload_lib->set($config);
				$this->iupload_lib->save_rel_data();//保存数据到关联表
			}
			$this->showmessage('success',lang('com_add'),$this->admin_url.'system/link/link_list?loghash='.$this->session->userdata('loghash'));
		}else{
			$this->load->model('a_system_model');
		    $lc_list = $this->a_system_model->get_query(array('order_by'=>'lc_id asc'),$this->tb_link_category);
			$this->cismarty->assign('lc_list',$lc_list);
		    $this->cismarty->display('system/link/link_add.html');
		}
	}
	//编辑
	public function link_edit(){
		$link_id = $this->input->get('link_id');
		if(isset($_POST['dosubmit'])){
		    $link_title = $this->input->post('link_title');
			$link_url = $this->input->post('link_url');
			$listorder = $this->input->post('link_sort');
			$link_id = $this->input->post('link_id');
			$old_link_pic = $this->input->post('old_link_pic');
			$link_category = $this->input->post('link_category');
			$link_class = $this->input->post('link_class');
			$link_name = $this->input->post('link_name');
			$link_info = $this->input->post('link_info');
			$link_recommend = $this->input->post('link_recommend');
			$link_pass = $this->input->post('link_pass');

			if($link_class == 'logo'){
			if($_FILES['link_pic']['error'] == 0){
				/***保存图片***/
			    $this->user_id=$this->session->userdata('admin_user_id');
			    $this->load->library('iupload_lib');
			    $config=array(
				       'module'=>'link_logo',
				       'dir'=>'link',
				       'shop_id'=>$this->user_id,
				       'isadmin'=>1,
			                     );
			    $this->iupload_lib->initialize($config);//配置初始化文件
			    $this->iupload_lib->do_uploadfile('link_pic');//上传附件
			    $file_id=$this->iupload_lib->save_data();//保存数据到数据库
			    if($file_id == TRUE){
				    $link_pic = $this->uploadfile->get_one(array('file_id'=>$file_id),'uploadfile','filepath');
			    }
                $image = explode('.',$old_link_pic);
				@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$image[0].'_w'.'.'.$image[1]);
				@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$old_link_pic);
				$data = array(
			        'link_title' => $link_title,
				    'link_url' => $link_url,
				    'link_pic' => $link_pic['filepath'],
				    'listorder' => $listorder,
					'link_category' => $link_category,
					'link_class' => $link_class,
					'link_name' => $link_name,
					'link_info' => $link_info,
					'link_recommend' => $link_recommend,
					'link_pass' => $link_pass,
			   );
			}else{
			   $data = array(
			        'link_title' => $link_title,
				    'link_url' => $link_url,
				    'link_pic' => $old_link_pic,
				    'listorder' => $listorder,
					'link_category' => $link_category,
					'link_class' => $link_class,
					'link_name' => $link_name,
					'link_info' => $link_info,
					'link_recommend' => $link_recommend,
					'link_pass' => $link_pass,
			   );
			}
			}elseif($link_class == 'text'){
			    $data = array(
			        'link_title' => $link_title,
				    'link_url' => $link_url,
				    'listorder' => $listorder,
					'link_category' => $link_category,
					'link_class' => $link_class,
					'link_name' => $link_name,
					'link_info' => $link_info,
					'link_recommend' => $link_recommend,
					'link_pass' => $link_pass,
			   );
			}
			$this->load->model('a_system_model');
			$this->a_system_model->update(array('link_id'=>$link_id),$data,$this->tb_link);
			$this->showmessage('link_list',lang('com_edit'),$this->admin_url.'system/link/link_list?loghash='.$this->session->userdata('loghash'));

		}else{
			$link_id=intval($link_id);
			$this->load->model('a_system_model');
		    $link = $this->a_system_model->get_one(array('link_id'=>$link_id),$this->tb_link);
		    if(empty($link)) $this->showmessage('error',lang('com_parameter'),$this->admin_url.'system/link/link_list?loghash='.$this->session->userdata('loghash'));
		    $lc_list = $this->a_system_model->get_query(array('order_by'=>'lc_id asc'),$this->tb_link_category);

			$this->cismarty->assign('lc_list',$lc_list);
			$this->cismarty->assign('link',$link);
			$this->cismarty->assign('link_id',$link_id);

		    $this->cismarty->display('system/link/link_edit.html');
		}
	}
	 //删除
    public function link_del(){
	    $_data_post=$this->input->post();
		$link_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;

		$this->load->model('a_system_model');

		foreach($link_id as $val){
			$link = $this->a_system_model->get_one(array('link_id'=>$val),$this->tb_link);
			$image = explode('.',$link['link_pic']);
			@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$image[0].'_w'.'.'.$image[1]);
			@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$link['link_pic']);
			$where = array('link_id' => $val);
			$return = $this->a_system_model->del($where,$this->tb_link,$val);
		}

		$this->showmessage('link_del',lang('com_del'),$this->admin_url.'system/link/link_list?loghash='.$this->session->userdata('loghash'));
	}
	/**
	 * 友情链接类型管理
	 */
	public function link_category_manage(){
		$op = $this->input->get_post('op');
		if(!empty($op)){
			switch($op){
				case 'list':
					$this->link_category_list();break;
				case 'edit':
					$this->link_category_edit();break;
				case 'del':
					$this->link_category_del();break;
				case 'add':
					$this->link_category_add();break;
				case 'order':
					$this->link_category_order();break;
				default:
					$this->link_category_list();
			}
		}else{
			$this->showmessage('error',lang('com_parameter'),$this->admin_url.'system/link/link_list?loghash='.$this->session->userdata('loghash'));
		}
	}
	//类型管理
	private function link_category_list(){
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_all('link_category');
		$this->cismarty->assign('infolist',$list);
		$this->cismarty->assign('infopage','');
		$this->cismarty->display('system/link/link_category_manage.html');
	}
	/***
	 * 删除友情链接分类
	 */
	private function link_category_del(){
		$_data_post=$this->input->post();
		$lc_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;

		if($lc_id){
			$this->load->model('a_system_model');
		    foreach($lc_id as $val){
		        $where = array('lc_id' => $val);
			    $return = $this->a_system_model->del($where,'link_category',$val);
		    }
		}
		$this->showmessage('success',lang('com_del'),$this->admin_url.'system/link/link_category_manage?op=list&loghash='.$this->session->userdata('loghash'));
	}
	 /***
	 * 添加友情链接分类
	 */
	private function link_category_add(){
		$dosubmit = $this->input->post('dosubmit');
		if($dosubmit == 'ok'){
			$_data_post= $this->input->post();
			if(empty($_data_post['lc_name']) || empty($_data_post['listorder']))
				$this->showmessage('error',lang('com_parameter'),$this->admin_url.'system/link/link_category_manage?op=add&loghash='.$this->session->userdata('loghash'));
			$_data['lc_name']=trim($_data_post['lc_name']);
			$_data['listorder']=trim($_data_post['listorder']);
			$_data['lc_time']=SYS_TIME;

			$link_category = $this->link_category_model->add($_data,'link_category');
			$this->showmessage('adddialog',lang('com_add'),$this->admin_url.'system/link/link_category_manage?op=list&loghash='.$this->session->userdata('loghash'));
		}else{
			$lc_id = $this->input->get('id');
		    $lc_id=intval($lc_id);
			$link_category = $this->link_category_model->get_one(array('lc_id'=>$lc_id),'link_category');
			$this->cismarty->assign('op','add');
			$this->cismarty->assign('link_category',$link_category);
		    $this->cismarty->display('system/link/link_category.html');
		}
	}
	/***
	 * 编辑友情链接分类
	*/
	private function link_category_edit(){
		$dosubmit = $this->input->post('dosubmit');
		if($dosubmit == 'ok'){
			$_data_post= $this->input->post();
			if(empty($_data_post['lc_name']) || empty($_data_post['listorder']))
				$this->showmessage('error',lang('com_parameter'),$this->admin_url.'system/link/link_category_manage?op=add&loghash='.$this->session->userdata('loghash'));
			$_data['lc_name']=trim($_data_post['lc_name']);
			$_data['listorder']=trim($_data_post['listorder']);
			$_data['lc_time']=SYS_TIME;
			$lc_id=$_data_post['lc_id'];
			$lc_id=intval($lc_id);

			$link_category = $this->link_category_model->update(array('lc_id'=>$lc_id),$_data,'link_category');
			$this->showmessage('editdialog',lang('com_edit'),$this->admin_url.'system/link/link_category_manage?op=list&loghash='.$this->session->userdata('loghash'));
		}else{
			$lc_id = $this->input->get('id');
		    $lc_id=intval($lc_id);
			$link_category = $this->link_category_model->get_one(array('lc_id'=>$lc_id),'link_category');
			$this->cismarty->assign('op','edit');
			$this->cismarty->assign('link_category',$link_category);
		    $this->cismarty->display('system/link/link_category.html');
		}
	}



	//友情链接分类排序
	private function link_category_order(){
	    $lc_id = $this->input->post('hdnid');
		$listorder = $this->input->post('listorder');

		foreach($listorder as $key => $val){
		    $data = array('listorder' => $val);
		    $this->link_category_model->lc_edit($lc_id[$key],$data);
		}
		$this->showmessage('success',lang('com_order'),HTTP_REFERER);
	}

	//AJAX判断友情链接标题不能为空
	public function ajax_public_check_link(){
	    $link_title=$this->input->get('link_title');
		$link_id=$this->input->get('link_id');
		$this->load->model('a_system_model');
		if(isset($link_id)){
		    $where = array('link_title' => $link_title,'link_id' => $link_id);
		    $d = $this->a_system_model->get_one($where,'link');
		}
		if(isset($d['link_title'])==$link_title){
		    echo 'true';
		}else{
		    $where = array('link_title' => $link_title);
		    $r = $this->a_system_model->get_one($where,'link');
		    if(isset($r)){
			    if(isset($r['link_title'])==$link_title) echo 'false';else echo 'true';
		    }else {
			    echo 'true';
	     	}
		}
	}
	//AJAX判断友情链接分类标题不能为空
	public function ajax_public_check_link_category(){
	    $lc_name=trim($this->input->get('lc_name'));
		$lc_id=trim($this->input->get('lc_id'));
		 $this->load->model('a_system_model');
		if(isset($lc_id)){
		    $where = array('lc_name' => $lc_name,'lc_id' => $lc_id);
		    $d = $this->a_system_model->get_one($where,'link_category');
		}
		if(isset($d['lc_name'])==$lc_name){
		    echo 'true';
		}else{
		    $where = array('lc_name' => $lc_name);
		    $r = $this->a_system_model->get_one($where,'link_category');
		    if(isset($r)){
			    if(isset($r['lc_name'])==$lc_name) echo 'false';else echo 'true';
		    }else {
			    echo 'true';
	     	}
		}
	}
	//友情链接排序
	public function link_order(){
	    $link_id = $this->input->post('hdnid');
		$listorder = $this->input->post('listorder');
		$this->load->model('a_system_model');
		if(!empty($link_id)){
			foreach($listorder as $key => $val){
			    $data = array('listorder' => $val);
			    $this->a_system_model->update(array('link_id'=>$link_id[$key]),$data,$this->tb_link);
			}
		}
		$this->showmessage('link_list',lang('com_order'),$this->admin_url.'system/link/link_list?loghash='.$this->session->userdata('loghash'));
	}

}