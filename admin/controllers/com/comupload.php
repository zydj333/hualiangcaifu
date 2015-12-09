<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Comupload extends Admin_Controller {

	var $file_id = 0;
	var $class_id = 0;
    var $belong = 0;
    var $store_id = 0;
    var $script='';
    var $instance = null; //同一个模型可以设置多个不同实例（goods模型可以有商品相册或商品描述两个实例）

	public function __construct()
	{
		parent::__construct();
		$this->init();
    }


    private function init()
    {
    	$this->file_id=$this->input->get_post('file_id');//文件id
    	$this->filedir=$this->input->get_post('filedir');//文件夹标识
    	$this->instance=$this->input->get_post('instance');//图标位置标识
    	$this->btnname=$this->input->get_post('btnname');//按钮名字
    	if(empty($this->btnname)) $this->btnname='上传';
        $this->admin_id = isset($this->session->userdata['admin_user_id'])?$this->session->userdata['admin_user_id']:0;
    }

	/**
	 * 上传单个文件
	 */
    public function public_upload_one(){
		if(isset($_POST['dosubmit'])){
			$this->upload_admin_post();
		}
		$this->cismarty->assign('file_id',$this->file_id);
		$this->cismarty->assign('script',$this->script);
		$this->cismarty->assign('filedir',$this->filedir);
		$this->cismarty->assign('instance',$this->instance);
		$this->cismarty->assign('btnname',$this->btnname);
		$this->cismarty->assign('admin_id',$this->admin_id);
		$this->cismarty->display('com/public_upload_one.html');
    }

    private function upload_admin_post(){

			//语言包配置---加载
			$lang = $this->config->item('language');
			if($lang) $this->_language=$lang;
			$this->lang->load('jslang', $this->_language);

			//检测用户是否session失效
	    	if(intval($this->admin_id)<=0){
				$this->script="alert('".lang('js_session_error')."');";
	            return false;
	    	}

	    	$config=array(
				'module'=>$this->instance,
				'dir'=>$this->filedir,
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
		    return true;
    }
    
	function image_upload()
    {
    	$field_id=$this->input->get_post('id');


		$config=array(
				'module'=>'shop_goods',
				'isadmin'=>1,
				'sts'=>0,
				'class_id'=>1
		);
		$this->load->library('ifile_lib', $config);
		$this->ifile_lib->initialize();//配置初始化文件
		$this->ifile_lib->do_uploadfile($field_id);//上传附件

		$re_msg  = $this->ifile_lib->error_data();
		$re_data = $this->ifile_lib->file_data();

		if(!empty($re_msg))
		{
			$res['error']=$re_msg[0];
			$json=cc_json_encode($res);echo $json;
            return false;
		}

		$this->file_id=$this->ifile_lib->save_data();//保存数据到数据库

		//if ($this->instance=='shop_goods'){

			/**生成水印图片**/
//			$wm_info=$this->a_shop_model->get_one(array('shop_id'=>$this->shop_id),'shop_watermark');
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