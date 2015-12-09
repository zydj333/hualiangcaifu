<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Adv extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dbclass_model');
		$this->load->model('adv');
		$this->load->model('adv_position');
		$this->load->model('uploadfile');
	}
	/**
	 * 广告列表
	 */
	public function lists(){
	  $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    	$seldata['pagesize']=10;
    	$seldata['name']=$this->input->get_post('search_name');
    	$seldata['startdate']=$this->input->get_post('add_time_from');
    	$seldata['enddate']=$this->input->get_post('add_time_to');
    	$seldata['act']=$this->input->get_post('act');
		$seldata['order']=$this->input->get('order');

		$this->load->model('a_web_model');
		$list = $this->a_web_model->get_adv_search($seldata);

    foreach($list['list'] as $key => $val){
		    $list['list'][$key]['ap'] = $this->adv_position->get_one(array('sts'=>0,'ap_id'=>$val['ap_id']),'adv_position');
		}

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);
		$this->cismarty->display('content/adv/adv.html');
	}
	//广告新增
	public function adv_add(){
	    if(isset($_POST['dosubmit'])){
		    $adv['adv_title'] = $this->input->post('adv_name');
			$adv['ap_id'] = $this->input->post('ap_id');
			$adv['adv_start_date'] = strtotime($this->input->post('adv_start_time'));
			$adv['adv_end_date'] = strtotime($this->input->post('adv_end_time')); 
			$adv['slide_sort'] = intval($this->input->post('adv_slide_sort'));
			$adv_pic_url = $this->input->post('adv_pic_url');
			//图片
			if(isset($_FILES['adv_pic']) && !$_FILES['adv_pic']['error']){
			    $adv_pic = $_FILES['adv_pic'];
				if(isset($adv_pic['name'])){
			        /***保存图片***/
			        $this->user_id=$this->session->userdata('admin_user_id');
			        $this->load->library('iupload_lib');
			        $config=array(
				       'module'=>'adv_image',
				       'dir'=>'adv',
				       'isadmin'=>1,
			                     );
			        $this->iupload_lib->initialize($config);//配置初始化文件
			        $this->iupload_lib->do_uploadfile('adv_pic');//上传附件
			        $file_id=$this->iupload_lib->save_data();//保存数据到数据库
                    if($file_id == TRUE){
				        $adv_pic = $this->uploadfile->get_one(array('file_id'=>$file_id),'uploadfile','filepath');
			        }
			    }
			    $adv_content['adv_pic'] = $adv_pic['filepath'];
			}
			$adv_content['adv_pic_url'] = $adv_pic_url;
			$adv['adv_content'] = serialize($adv_content);
			
			$this->adv->add($adv);
			$this->showmessage('adv',lang('com_add'),$this->admin_url.'content/adv/lists?loghash='.$this->session->userdata('loghash'));
		}else{
		    $position = $this->adv_position->get_query(array('sts'=>0),'adv_position');
			$this->cismarty->assign('position',$position);
		    $this->cismarty->display('content/adv/adv_add.html');
		}
	}
	public function adv_edit(){
	    if(isset($_POST['dosubmit'])){
		    $adv_id = $this->input->post('adv_id');
		    $adv['adv_title'] = $this->input->post('adv_name');
		    $adv['ap_id'] = $this->input->post('ap_id');
			$adv['adv_start_date'] = strtotime($this->input->post('adv_start_date'));
			$adv['adv_end_date'] = strtotime($this->input->post('adv_end_date'));
			$adv['slide_sort'] = intval($this->input->post('adv_slide_sort'));
			
			$adv_content['adv_pic_url'] = $this->input->post('adv_pic_url');
			//图片
			if(isset($_FILES['adv_pic']) && !$_FILES['adv_pic']['error']){
			    $adv_pic = $_FILES['adv_pic'];
				if(isset($adv_pic['name'])){
			        /***保存图片***/
			        $this->user_id=$this->session->userdata('admin_user_id');
			        $this->load->library('iupload_lib');
			        $config=array(
				       'module'=>'adv_image',
				       'dir'=>'adv',
				       'isadmin'=>1,
			                     );
			        $this->iupload_lib->initialize($config);//配置初始化文件
			        $this->iupload_lib->do_uploadfile('adv_pic');//上传附件
			        $file_id=$this->iupload_lib->save_data();//保存数据到数据库
                    if($file_id == TRUE){
				        $adv_pic = $this->uploadfile->get_one(array('file_id'=>$file_id),'uploadfile','filepath');
			        }
			    }
			    $adv_content['adv_pic'] = $adv_pic['filepath'];
				$image = explode('.',$this->input->post('pic_ori'));
			    @unlink($_SERVER['DOCUMENT_ROOT'].'/'.$image[0].'_w'.'.'.$image[1]);
				@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$this->input->post('pic_ori'));
			}else {
				$adv_content['adv_pic'] = $this->input->post('pic_ori');
			}
			$adv['adv_content'] = serialize($adv_content);

			$this->adv->update(array('adv_id'=>$adv_id),$adv);
			$this->showmessage('adv',lang('com_edit'),$this->admin_url.'content/adv/lists?loghash='.$this->session->userdata('loghash'));
		}else{
		    $adv_id = $this->input->get('adv_id');
			$adv = $this->adv->get_one(array('adv_id'=>$adv_id),'adv');
		    $ap = $this->adv_position->get_query(array('sts'=>'0'),'adv_position');
			$adv['content'] = unserialize($adv['adv_content']);
			$this->cismarty->assign('adv',$adv);
			$this->cismarty->assign('ap', $ap);
			$this->cismarty->display('content/adv/adv_edit.html');
		}
	}
	//删除
	public function adv_del(){
	    $_data_post=$this->input->post();
		$adv_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;

		if($adv_id !== false){
		    foreach($adv_id as $val){
			    $where = array('sts' => 1);
				$return = $this->adv->update(array('adv_id'=>$val),$where);
			}
		}else{
		    $this->showmessage('adv',lang('com_parameter'),HTTP_REFERER);
		}
		$this->showmessage('adv',lang('com_del'),$this->admin_url.'content/adv/lists?loghash='.$this->session->userdata('loghash'));
	}
	
	//广告位管理
	public function ap_manage(){
	    $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    	$seldata['pagesize']=10;
    	$seldata['name']=$this->input->get('search_name');
		$this->load->model('a_web_model');
		$list=$this->a_web_model->get_adv_position_search($seldata);

		foreach($list['list'] as $key => $val){
		    $list['list'][$key]['num'] = $this->adv->get_query(array('sts'=>0,'ap_id'=>$val['ap_id']),'adv','count(ap_id) as num');
		}

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);
	    $this->cismarty->display('content/adv/ap_manage.html');
	}
	//广告位新增
	public function ap_add(){
	    if(isset($_POST['dosubmit'])){
		    $ap['ap_name'] = $this->input->post('ap_name');
			$ap['ap_intro'] = $this->input->post('ap_intro');
			$ap['is_use'] = $this->input->post('is_use');
			$ap_width_media = $this->input->post('ap_width_media');
			$ap['ap_height'] = $this->input->post('ap_height');
			if($ap_width_media == ''){
			    $ap['ap_width'] = $ap_width_word;
			}else{
			    $ap['ap_width'] = $ap_width_media;
			}
			if($_FILES['default_pic']['error'] == 0){
			    $default_pic = $_FILES['default_pic'];
				if(isset($default_pic['name'])){
			        /***保存图片***/
			        $this->user_id=$this->session->userdata('admin_user_id');
			        $this->load->library('iupload_lib');
			        $config=array(
				       'module'=>'adv_postion_default',
				       'dir'=>'adv',
				       'isadmin'=>1,
			                     );
			        $this->iupload_lib->initialize($config);//配置初始化文件
			        $this->iupload_lib->do_uploadfile('default_pic');//上传附件
			        $file_id=$this->iupload_lib->save_data();//保存数据到数据库
                    if($file_id == TRUE){
				        $adv_pic = $this->uploadfile->get_one(array('file_id'=>$file_id),'uploadfile','filepath');
			        }
			    }
			    $ap['default_content'] = $adv_pic['filepath'];
			}else{
			    $ap['default_content'] = '';
			}
			$ap['click_num'] = 0;
			$this->adv_position->add($ap);
			$this->showmessage('ap_manage',lang('com_add'),$this->admin_url.'content/adv/ap_manage?loghash='.$this->session->userdata('loghash'));
		}else{
		    $this->cismarty->display('content/adv/ap_add.html');
		}
	}
	//广告位编辑
	public function ap_edit(){
	    if(isset($_POST['dosubmit'])){
		    $ap_id = $this->input->post('ap_id');
			$ap['ap_name'] = $this->input->post('ap_name');
			$ap['ap_intro'] = $this->input->post('ap_intro');
			$ap['is_use'] = $this->input->post('is_use');
			$ap['ap_width'] = $this->input->post('ap_width');
			$ap['ap_height'] = $this->input->post('ap_height');
				
		    if($_FILES['default_pic']['error'] == 0){
			    $default_pic = $_FILES['default_pic'];
				if(isset($default_pic['name'])){
			        /***保存图片***/
			        $this->user_id=$this->session->userdata('admin_user_id');
			        $this->load->library('iupload_lib');
			        $config=array(
				       'module'=>'adv_postion_default',
				       'dir'=>'adv',
				       'isadmin'=>1,
                    );
			        $this->iupload_lib->initialize($config);//配置初始化文件
			        $this->iupload_lib->do_uploadfile('default_pic');//上传附件
			        $file_id=$this->iupload_lib->save_data();//保存数据到数据库
                    if($file_id == TRUE){
				        $adv_pic = $this->uploadfile->get_one(array('file_id'=>$file_id),'uploadfile','filepath');
			        }
			    }
			    $ap['default_content'] = $adv_pic['filepath'];
		    }
			    
			$this->adv_position->update(array('ap_id'=>$ap_id),$ap);
			$this->showmessage('ap_manage',lang('com_edit'),$this->admin_url.'content/adv/ap_manage?loghash='.$this->session->userdata('loghash'));
		}else{
		    $ap_id = $this->input->get('ap_id');
			$ap = $this->adv_position->get_one(array('ap_id'=>$ap_id),'adv_position');
			if(empty($ap))  $this->showmessage('error',lang('com_parameter'),HTTP_REFERER);
			$this->cismarty->assign('ap',$ap);
		    $this->cismarty->display('content/adv/ap_edit.html');
		}

	}
	//删除广告位
	public function ap_del(){
	    $_data_post=$this->input->post();
		$ap_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;

		if($ap_id !== false){
		    foreach($ap_id as $val){
			    $where = array('sts' => 1);
				$return = $this->adv_position->update(array('ap_id'=>$val),$where);
			}
		}else{
		    $this->showmessage('ap_manage',lang('com_parameter'),HTTP_REFERER);
		}
		$this->showmessage('ap_manage',lang('com_del'),$this->admin_url.'content/adv/ap_manage?loghash='.$this->session->userdata('loghash'));
	}
	/**
	 * 查看调用代码
	 */
	public function ap_showcode(){
		$ap_id = $this->input->get('ap_id');
		$ap = $this->adv_position->get_one(array('ap_id'=>$ap_id),'adv_position');
		if(!empty($ap)){
			echo '方式1：<br>';
			echo '<input type="text" style="width:600px" value="<script type=\'text/javascript\'  src=\'index.php?m=com&c=adv&a=advshow&ap_id='.$ap_id.'\'></script>" >';
			echo '<br>方式2：<br>';
			echo '<input type="text" style="width:600px" value=\'<!--{cc:s_com action="advshow" apid="'.$ap_id.'" cache="3600"}--><!--{/cc}-->\' >' ;
			exit;
		}
	}
	//更新广告位缓存
	public function adv_cache_refresh(){
		$ap_val = $this->adv->get_query(array('sts'=>0),'adv_position');
        $this->load->helper('global');
		setcache('adv_position',$ap_val,'commons');
		$this->showmessage('adv_cache_refresh',lang('com_cache'),HTTP_REFERER);
	}
}