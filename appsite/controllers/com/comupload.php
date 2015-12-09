<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

ini_set("memory_limit", "256M"); //加大內存

class Comupload extends MY_Controller {

	var $file_id = 0;
	var $class_id = 0;
    var $belong = 0;
    var $store_id = 0;
    var $script='';
    var $instance = null; //同一个模型可以设置多个不同实例（goods模型可以有商品相册或商品描述两个实例）

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('global');
		$this->init();
    }

    private function init()
    {
    	$this->file_id=$this->input->get_post('file_id');
    	$this->class_id=$this->input->get_post('class_id');
    	$this->belong=$this->input->get_post('belong');
    	$this->instance=$this->input->get_post('instance');
    	$this->btnname=$this->input->get_post('btnname');
    	$this->admin_id=$this->input->get_post('aid');

    	if(empty($this->btnname)) $this->btnname='普通上传';
        $this->shop_id = isset($this->session->userdata['member_user_id'])?$this->session->userdata['member_user_id']:0;
    }

	/**
	 * 上传单个文件---后台专用
	 */
    public function upload_admin(){

		$data['class_id']=$this->class_id;
		$data['instance']=$this->instance;
		$data['script']=$this->script;
		$data['belong']=$this->belong;
		$data['btnname']=$this->btnname;
		$data['aid']=$this->admin_id;
		$this->view('upload_admin',$data,'com');
    }
    public function upload_admin_post(){

			//语言包配置---加载
			$lang = $this->config->item('language');
			if($lang) $this->_language=$lang;
			$this->lang->load('jslang', $this->_language);

			//检测用户是否session失效
	    	if(intval($this->admin_id)<=0){
				$this->script="alert('".lang('js_session_error')."');";
	   			$this->upload_admin();
	            return false;
	    	}

	    	$config=array(
				'module'=>$this->instance,
				'shop_id'=>0,
				'isadmin'=>1,
				'sts'=>0,
			);

			$this->load->library('iupload_lib');
			$this->iupload_lib->initialize($config);//配置初始化文件
			$this->iupload_lib->do_uploadfile('file');//上传附件

			$re_msg  = $this->iupload_lib->error_data();
			$re_data = $this->iupload_lib->file_data();

			if(!empty($re_msg))
			{
				$this->script= "alert('".$re_msg[0]."');";
				$this->upload_admin();
	            return false;
			}

			$this->file_id=$this->iupload_lib->save_data();//保存数据到数据库

			$res['state']='true';
			$res['msg']='success';
			$res['instance']=$this->instance;
			$res['file_id']=$this->file_id;
			$res['realname']=$re_data['client_name'];
			$res['filename']=$re_data['file_name'];
			$base_path=str_replace('\\','/',FCPATH);
			$res['filepath']=str_replace($base_path,'',$re_data['full_path']);

			$json=cc_json_encode($res);
			$json=new_stripslashes($json);

			$this->script="window.parent.do_uploadedfile('$json');";
			$this->upload_iframe();
		    return true;
    }

	/**
	 * 单个文件上传
	 */
	function upload_iframe(){

		$data['class_id']=$this->class_id;
		$data['instance']=$this->instance;
		$data['script']=$this->script;
		$data['belong']=$this->belong;
		$data['btnname']=$this->btnname;
		$this->view('upload_iframe',$data,'com');
	}

	/**
	 * 上传单个文件
	 */
	function uploadedfile()
    {
    	//语言包配置---加载
		$lang = $this->config->item('language');
		if($lang) $this->_language=$lang;
		$this->lang->load('jslang', $this->_language);

    	//检测用户是否session失效
    	if(intval($this->shop_id)<=0){
			$this->script="alert('".lang('js_session_error')."');";
   			$this->upload_iframe();
            return false;
    	}

		$this->load->model('m_shop_model');
		$shop_info=$this->m_shop_model->get_one(array('shop_id'=>$this->shop_id),'shop');

		//检测用户是否失效
		if(!isset($shop_info['shop_id']) || empty($shop_info['shop_id'])){
			$this->script="alert('".lang('js_session_error')."');";
			$this->upload_iframe();
            return false;
		}


		//获取该商铺拥有空间的大小
		$sg_id=empty($shop_info['sg_id'])?1:$shop_info['sg_id'];
		$sg_info=$this->m_shop_model->get_one(array('sg_id'=>$sg_id),'shop_grade');
		$space_limit=$sg_info['sg_space_limit'];
		//获取该商铺已经使用的空间大小
		$space_size=$this->m_shop_model->get_one(array('isadmin'=>0,'shop_id'=>$this->shop_id,'sts'=>0),'uploadfile','sum(filesize) as file_size');
		$now_space_size=isset($space_size['file_size'])?$space_size['file_size']:0;

		//剩余可以使用空间大小,false表示不做限制
		$remaid = $space_limit > 0 ? $space_limit * 1024 * 1024 - $now_space_size : false;
		if($remaid ===false){
			$this->script="alert('".lang('js_space_limit_arrived')."');";
			$this->upload_iframe();
            return false;
		}


		if($this->class_id > 0) //相册中图片 默认已经被使用
			$sts=0;
		else
			$sts=1;

		$config=array(
				'module'=>$this->instance,
				'shop_id'=>$this->shop_id,
				'isadmin'=>0,
				'sts'=>$sts,
		);
		$this->load->library('iupload_lib');
		$this->iupload_lib->initialize($config);//配置初始化文件
		$this->iupload_lib->do_uploadfile('file');//上传附件

		$re_msg  = $this->iupload_lib->error_data();
		$re_data = $this->iupload_lib->file_data();

		if(!empty($re_msg))
		{
			$this->script= "alert('".$re_msg[0]."');";
			$this->upload_iframe();
            return false;
		}

		$this->file_id=$this->iupload_lib->save_data();//保存数据到数据库

		if ($this->instance=='shop_goods'){

			/**生成水印图片**/
			$wm_info=$this->m_shop_model->get_one(array('shop_id'=>$this->shop_id),'shop_watermark');
			if(isset($wm_info['wm_model'])&& intval($wm_info['wm_model']) >0){
				/**生成水印**/
				$this->load->library('ithumb_lib');
				$full_path=$re_data['full_path'];
				$path_arr=explode('.',$full_path);
				$config['img_path']=$path_arr[0].'_b.'.$path_arr[1];
				$config['wm_model']=$wm_info['wm_model'];
				$config['wm_post']=$wm_info['wm_model']=='1'?$wm_info['txt_pos']:$wm_info['image_pos'];

				$config['wm_txt']=$wm_info['txt'];
				$config['wm_txt_size']=$wm_info['txt_size'];
				$config['wm_txt_font']=$wm_info['txt_font'];
				$config['wm_txt_color']=$wm_info['txt_color'];

				$config['wm_image_path']=$wm_info['image_path'];
				$config['wm_opacity']=$wm_info['image_transition'];
				$this->ithumb_lib->initialize($config);
				$this->ithumb_lib->water_mark();
			}
		}

		$res['state']='true';
		$res['msg']='success';
		$res['instance']=$this->instance;
		$res['file_id']=$this->file_id;
		$res['realname']=$re_data['client_name'];
		$res['filename']=$re_data['file_name'];
		$base_path=str_replace('\\','/',FCPATH);
		$res['filepath']=str_replace($base_path,'',$re_data['full_path']);

		$json=cc_json_encode($res);
		$json=new_stripslashes($json);

		$this->script="window.parent.do_uploadedfile('$json');";
		$this->upload_iframe();
        return true;
    }

	/**
	 * 单个图片替换上传
	 */
	function replace_iframe(){
		$data['script']=$this->script;
		$data['instance']=$this->instance;
		$data['file_id']=$this->file_id;
		$this->view('replace_iframe',$data,'com');
	}
	/**
	 * 单个图片替换上传
	 */
	function replace_image_upload()
	{
    	//语言包配置---加载
		$lang = $this->config->item('language');
		if($lang) $this->_language=$lang;
		$this->lang->load('jslang', $this->_language);

		$upload_config=getcache('upload','configs','file','array');
		$config_para=isset($upload_config['module'][$this->instance])?$upload_config['module'][$this->instance]:$upload_config['module']['default'];

		$allows_dir  	= isset($config_para['allows_dir'])?$config_para['allows_dir']:$upload_config['system_dir'];
		$allows_type 	= isset($config_para['allows_type'])?$config_para['allows_type']:$upload_config['system_allows_types'];
		$allows_size 	= isset($config_para['allows_size'])?$config_para['allows_size']:$upload_config['system_allows_size'];
		$allows_thumb 	= isset($config_para['allows_thumb'])?$config_para['allows_thumb']:'';

    	//检测用户是否session失效
    	if(intval($this->shop_id)<=0){
			$this->script="alert('".lang('js_session_error')."');";
   			$this->replace_iframe();
            return false;
    	}
		$this->load->model('m_shop_model');
		$shop_info=$this->m_shop_model->get_one(array('shop_id'=>$this->shop_id),'shop');
		$file_info=$this->m_shop_model->get_one(array('file_id'=>$this->file_id),'uploadfile');

		//检测用户是否失效
		if(!isset($shop_info['shop_id']) || empty($shop_info['shop_id'])){
			$this->script="alert('".lang('js_session_error')."');";
			$this->replace_iframe();
            return false;
		}

		$file_name=$file_info['filename'];
		$file_ext=substr(strrchr($file_name,'.'),1);
		$file_path=$file_info['filepath'];

		$dirname=str_replace($file_name,'',$file_path);

		$this->load->library('ifile_lib');
		$this->ifile_lib->mkdir($dirname);

		$this->load->library('upload');
		$config=array(
				'file_name'=>$file_name,
				'allowed_types'=>$file_ext,
				'max_size'=>$allows_size,
				'is_image'=>TRUE,
				'upload_path'=>$dirname,
				'overwrite'=>TRUE

		);


		$this->upload->initialize($config);
		$this->upload->do_upload('file');
		$re_msg=$this->upload->error_msg;
		$re_data=$this->upload->data();

		if(!empty($re_msg))
		{
			$this->script= "alert('".$re_msg[0]."');";
			$this->replace_iframe();
            return false;
		}
		/*图片信息保存到数据*/
		$pic_data['realname']=$re_data['client_name'];
		$pic_data['filename']=$re_data['file_name'];
		$pic_data['fileext']=$re_data['file_ext'];
		$base_path=str_replace('\\','/',FCPATH);
		$pic_data['filepath']=str_replace($base_path,'',$re_data['full_path']);
		$pic_data['filesize']=$re_data['file_size'];
		$pic_data['img_spec']=$re_data['image_width'].'x'.$re_data['image_height'];
		$pic_data['shop_id']=$this->shop_id;
		$pic_data['isadmin']=0;
		$pic_data['upload_ip']=$this->input->ip_address();
		$pic_data['upload_time']=time();

		$this->m_shop_model->update(array('file_id'=>$this->file_id),$pic_data,'uploadfile');

		if($allows_thumb){
			$this->load->library('iupload_lib');
			$this->iupload_lib->create_thumb_allows($allows_thumb,$re_data);
		}

		/**生成水印图片**/
		$wm_info=$this->m_shop_model->get_one(array('shop_id'=>$this->shop_id),'shop_watermark');
		if(isset($wm_info['wm_model'])&& intval($wm_info['wm_model']) >0){
			$this->load->library('ithumb_lib');
			$full_path=$re_data['full_path'];
			$path_arr=explode('.',$full_path);
			$config['img_path']=$path_arr[0].'_b.'.$path_arr[1];
			$config['wm_model']=$wm_info['wm_model'];
			$config['wm_post']=$wm_info['wm_model']=='1'?$wm_info['txt_pos']:$wm_info['image_pos'];

			$config['wm_txt']=$wm_info['txt'];
			$config['wm_txt_size']=$wm_info['txt_size'];
			$config['wm_txt_font']=$wm_info['txt_font'];
			$config['wm_txt_color']=$wm_info['txt_color'];

			$config['wm_image_path']=$wm_info['image_path'];
			$config['wm_opacity']=$wm_info['image_transition'];
			$this->ithumb_lib->initialize($config);
			$this->ithumb_lib->water_mark();
		}


		$this->script="window.parent.img_refresh('$this->file_id');";
		$this->replace_iframe();
        return true;
	}

	/*
	 * 产品添加或修改--专用
	 */
	function image_upload()
    {
    	$field_id=$this->input->get_post('id');
    	//语言包配置---加载
		$lang = $this->config->item('language');
		if($lang) $this->_language=$lang;
		$this->lang->load('jslang', $this->_language);

    	//检测用户是否session失效
//    	if(intval($this->shop_id)<=0){
//			$res['error']=lang('js_session_error');
//			$json=cc_json_encode($res);echo $json;
//            return false;
//    	}

//		$this->load->model('a_shop_model');
//		$shop_info=$this->a_shop_model->get_one(array('shop_id'=>$this->shop_id),'shop');
//
//		//检测用户是否失效
//		if(!isset($shop_info['shop_id']) || empty($shop_info['shop_id'])){
//			$res['error']=lang('js_session_error');
//			$json=cc_json_encode($res);echo $json;
//            return false;
//		}


		//获取该商铺拥有空间的大小
//		$sg_id=empty($shop_info['sg_id'])?1:$shop_info['sg_id'];
//		$sg_info=$this->m_shop_model->get_one(array('sg_id'=>$sg_id),'shop_grade');
//		$space_limit=$sg_info['sg_space_limit'];
		//获取该商铺已经使用的空间大小
//		$space_size=$this->m_shop_model->get_one(array('isadmin'=>0,'shop_id'=>$this->shop_id,'sts'=>0),'uploadfile','sum(filesize) as file_size');
//		$now_space_size=isset($space_size['file_size'])?$space_size['file_size']:0;

		//剩余可以使用空间大小,false表示不做限制
//		$remaid = $space_limit > 0 ? $space_limit * 1024 * 1024 - $now_space_size : false;
//		if($remaid ===false){
//			$res['error']=lang('js_space_limit_arrived');
//			$json=cc_json_encode($res);echo $json;
//            return false;
//		}

		$config=array(
				'module'=>'shop_goods',
				'shop_id'=>0,
				'isadmin'=>0,
				'sts'=>0,
				'class_id'=>1
		);
		$this->load->library('iupload_lib');
		$this->iupload_lib->initialize($config);//配置初始化文件
		$this->iupload_lib->do_uploadfile($field_id);//上传附件

		$re_msg  = $this->iupload_lib->error_data();
		$re_data = $this->iupload_lib->file_data();

		if(!empty($re_msg))
		{
			$res['error']=$re_msg[0];
			$json=cc_json_encode($res);echo $json;
            return false;
		}

		$this->file_id=$this->iupload_lib->save_data();//保存数据到数据库
		//if ($this->instance=='shop_goods'){

			/**生成水印图片**/
//			$wm_info=$this->m_shop_model->get_one(array('shop_id'=>$this->shop_id),'shop_watermark');
//			if(isset($wm_info['wm_model'])&& intval($wm_info['wm_model']) >0){
//				/**生成水印**/
//				$this->load->library('ithumb_lib');
//				$full_path=$re_data['full_path'];
//				$path_arr=explode('.',$full_path);
//				$config['img_path']=$path_arr[0].'_b.'.$path_arr[1];
//				$config['wm_model']=$wm_info['wm_model'];
//				$config['wm_post']=$wm_info['wm_model']=='1'?$wm_info['txt_pos']:$wm_info['image_pos'];
//
//				$config['wm_txt']=$wm_info['txt'];
//				$config['wm_txt_size']=$wm_info['txt_size'];
//				$config['wm_txt_font']=$wm_info['txt_font'];
//				$config['wm_txt_color']=$wm_info['txt_color'];
//
//				$config['wm_image_path']=$wm_info['image_path'];
//				$config['wm_opacity']=$wm_info['image_transition'];
//				$this->ithumb_lib->initialize($config);
//				$this->ithumb_lib->water_mark();
//			}
		//}

		$res['msg']='success';
		$res['file_id']=$this->file_id;
		$res['realname']=$re_data['client_name'];
		$res['filename']=$re_data['file_name'];
		$base_path=str_replace('\\','/',FCPATH);
		$res['filepath']=str_replace($base_path,'',$re_data['full_path']);

		$json=cc_json_encode($res);
		$json=new_stripslashes($json);
		echo $json;

		//$this->script="window.parent.do_uploadedfile('$json');";
		//$this->upload_iframe();
        return true;
    }
}