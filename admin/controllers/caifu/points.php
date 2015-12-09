<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Points extends Admin_Controller {

	/*
	×  积分产品管理
	*/
	public function __construct()
	{
		parent::__construct();
		$this->tb_points='caifu_points';
		$this->load->model('uploadfile');
		$this->load->model('caifu_points');
		$this->load->model('a_caifu_model');
	}
	//分页列表
	public function lists(){
	  $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    $seldata['pagesize']=10;
		
		$list=$this->a_caifu_model->get_points_search($seldata);

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);

	  $this->cismarty->display('caifu/points/points_list.html');
	}
	//添加产品
	public function points_add(){
		if(isset($_POST['dosubmit'])){
		  $points['name'] = $this->input->post('name2');
			$points['market_price'] = $this->input->post('market_price');
			$points['points'] = $this->input->post('points');
			$points['listorder'] = $this->input->post('listorder');
			$points['content'] = $this->input->post('content');
			$points['status'] = $this->input->post('status');
			$points['post_time'] = time();

			$link_pic='';
			if($_FILES['points_image']['error'] == 0){
				/***保存图片***/
			   $this->user_id=$this->session->userdata('admin_user_id');
			   $this->load->library('iupload_lib');
			   $config=array(
				       'module'=>'points',
				       'dir'=>'points',
				       'shop_id'=>$this->user_id,
				       'isadmin'=>1,
			         );
			   $this->iupload_lib->initialize($config);//配置初始化文件
			   $this->iupload_lib->do_uploadfile('points_image');//上传附件
			   $file_id=$this->iupload_lib->save_data();//保存数据到数据库
			   if($file_id == TRUE){
				 	$file_data = $this->iupload_lib->file_data();
				 	$points['points_image'] = $file_data['savepath'];
			   }
			}
			  
			$link = $this->a_caifu_model->add($points,$this->tb_points);

			$this->showmessage('success',lang('com_add'),$this->admin_url.'caifu/points/lists?loghash='.$this->session->userdata('loghash'));
		}else{
		  $this->cismarty->display('caifu/points/points_add.html');
		}
	}
	//编辑
	public function points_edit(){
		$points_id = $this->input->get('id');
		if(isset($_POST['dosubmit'])){
			$points_id = $this->input->post('points_id');
			$old_pic_thumb = $this->input->post('old_pic_thumb');
		  $points['name'] = $this->input->post('name2');
			$points['market_price'] = $this->input->post('market_price');
			$points['points'] = $this->input->post('points');
			$points['listorder'] = $this->input->post('listorder');
			$points['content'] = $this->input->post('content');
			$points['status'] = $this->input->post('status');

			if($_FILES['points_image']['error'] == 0){
				/***保存图片***/
			    $this->user_id=$this->session->userdata('admin_user_id');
			    $this->load->library('iupload_lib');
			    $config=array(
				       'module'=>'points',
				       'dir'=>'points',
				       'shop_id'=>$this->user_id,
				       'isadmin'=>1,
			        );
			    $this->iupload_lib->initialize($config);//配置初始化文件
			    $this->iupload_lib->do_uploadfile('points_image');//上传附件
			    $file_id=$this->iupload_lib->save_data();//保存数据到数据库
			    if($file_id == TRUE){
				    $points_pic = $this->uploadfile->get_one(array('file_id'=>$file_id),'uploadfile','filepath');
			    }
          $image = explode('.',$old_pic_thumb);
					@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$image[0].'_w'.'.'.$image[1]);
					@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$old_pic_thumb);
					$points['points_image'] = $points_pic['filepath'];
			}else{
				$points['points_image'] = $old_pic_thumb;
			}

			$this->a_caifu_model->update(array('id'=>$points_id),$points,$this->tb_points);
			$this->showmessage('success',lang('com_edit'),$this->admin_url.'caifu/points/lists?loghash='.$this->session->userdata('loghash'));

		}else{
			$points_id=intval($points_id);
		  $points = $this->a_caifu_model->get_one(array('id'=>$points_id),$this->tb_points);
		  if(empty($points)) $this->showmessage('error',lang('com_parameter'),$this->admin_url.'caifu/points/lists?loghash='.$this->session->userdata('loghash'));

			$this->cismarty->assign('points',$points);
		  $this->cismarty->display('caifu/points/points_edit.html');
		}
	}
	 //删除
    public function points_del(){
	    $_data_post=$this->input->post();
			$points_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;

			foreach($points_id as $val){
				$points = $this->a_caifu_model->get_one(array('id'=>$val),$this->tb_points);
				$image = explode('.',$points['points_image']);
				@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$image[0].'_w'.'.'.$image[1]);
				@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$points['points_image']);
				$where = array('id' => $val);
				$return = $this->a_caifu_model->del($where,$this->tb_points,$val);
			}

			$this->showmessage('link_del',lang('com_del'),$this->admin_url.'caifu/points/lists?loghash='.$this->session->userdata('loghash'));
	}
	

	//排序
	public function points_order(){
	  $link_id = $this->input->post('hdnid');
		$listorder = $this->input->post('listorder');
		if(!empty($link_id)){
			foreach($listorder as $key => $val){
			    $data = array('listorder' => $val);
			    $this->a_caifu_model->update(array('id'=>$link_id[$key]),$data,$this->tb_points);
			}
		}
		$this->showmessage('link_list',lang('com_order'),$this->admin_url.'caifu/points/lists?loghash='.$this->session->userdata('loghash'));
	}

}