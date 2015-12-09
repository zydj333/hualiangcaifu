<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class iupload_lib {
	var $CI;
	private $module;
	private $res_data=array();
	private $res_msg=array();
	private $sys_config=array();
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->helper('global');
		$this->CI->load->library('upload');
		$this->CI->load->library('ifile_lib');
		$this->CI->load->library('image_lib');
		$this->ifile_lib	= & $this->CI->ifile_lib;
		$this->upload		= & $this->CI->upload;
		$this->image_lib 	= & $this->CI->image_lib;

	}

	/**
	 * 初始化变量
	 *
	 * @param	array
	 * @return	void
	 */
	public function initialize($config = array())
	{
		$defaults = array(
							'module'			=> 'default',//模块ID，即对应关联表标识
							'shop_id'			=> '0',//用户ID
							'file_id'			=> '0',//文件ID
							'rel_id'			=> '0',//关联表ID
							'isadmin'			=> '0',//0不是后台上传1后台上传
							'sts'				=> '1',
							'class_id'			=> '0',
							'dir'				=> '',//上传文件保存到文件夹
						);
		foreach ($defaults as $key => $val)
		{
			if (isset($config[$key]))
			{
				$this->$key = $config[$key];
			}
			else
			{
				$this->$key = $val;
			}
		}
	}

	/**
	 *  设置属性值
	 *  config中的值一般为、module、shop_id、file_id、ext_id、isadmin
	 */
	public function set($config= array()){
		if(is_array($config)){
			foreach ($config as $key => $val)
			{
				$this->$key = $val;
			}
		}

	}

	/**
	 * 信息保存到附件表的数据组装
	 */
	public function save_data(){
		if(empty($this->res_data)) return false;

		/*图片信息保存到数据*/
		$pic_data['realname']=$this->res_data['client_name'];
		$pic_data['filename']=$this->res_data['file_name'];
		$pic_data['fileext']=$this->res_data['file_ext'];
		$base_path=str_replace('\\','/',FCPATH);
		$pic_data['filepath']=str_replace($base_path,'',$this->res_data['full_path']);
		$pic_data['filesize']=$this->res_data['file_size'];
		$pic_data['img_spec']=$this->res_data['image_width'].'x'.$this->res_data['image_height'];
		$pic_data['shop_id']=$this->shop_id;
		$pic_data['aclass_id']=$this->class_id;
		$pic_data['isadmin']=$this->isadmin;
		$pic_data['upload_ip']=ip();
		$pic_data['upload_time']=time();
		$pic_data['sts']=$this->sts;

		if(!isset($this->CI)){$this->CI = & get_instance();}

		$this->CI->load->model('m_uploadfile_model');
		$id=$this->CI->m_uploadfile_model->save_uploadfile($pic_data);
		return $id;
	}

	/**
	 * 信息保存到附件(关联)表
	 */
	public function save_rel_data(){
		if(empty($this->res_data)) return false;

		$_rel_data['module'] = $this->module;
		$_rel_data['shop_id']= $this->shop_id;
		$_rel_data['rel_id'] = $this->rel_id;

		if(!isset($this->CI)) {$this->CI = & get_instance();}
		$this->CI->load->model('m_uploadfile_model');

		if(empty($this->sys_config)) $this->sys_config=getcache('upload','configs','file','array');
		$config_para=isset($this->sys_config['module'][$this->module])?$this->sys_config['module'][$this->module]:$this->sys_config['module']['default'];

		$allows_rel		= isset($config_para['allows_rel'])?$config_para['allows_rel']:'1';

		$list=array();
		if($allows_rel=='1'){//1对1关系，表示改文件在唯一地方使用
			$list=$this->CI->m_uploadfile_model->get_uploadfile_rel(array('module'=>$this->module,'shop_id'=>$this->shop_id,'rel_id'=>$this->rel_id));
			foreach($list as $v){
				$this->do_deletefile($v['file_id']);//删除文件
				// $this->CI->m_uploadfile_model->update_uploadfile(array('file_id'=>$v['file_id']),array('sts'=>1));
			}
		}

		$_rel_data['file_id']= $this->file_id;
		$id=$this->CI->m_uploadfile_model->save_uploadfile_rel($_rel_data);

		$this->CI->m_uploadfile_model->update_uploadfile(array('file_id'=>$this->file_id),array('sts'=>0));

		return $id;
	}



	/**
	 * 保存成功后返回的信息
	 */
	public function file_data(){
		if(empty($this->res_data)) return false;
		$base_path=str_replace('\\','/',FCPATH);
		$this->res_data['savepath']=str_replace($base_path,'',$this->res_data['full_path']);

		return $this->res_data;
	}

	/**
	 * 返回错误信息;如果成功，则返回false
	 */
	public function error_data(){
		if(empty($this->res_msg)) return false;

		return $this->res_msg;
	}

	/***
	 * 单个文件上传
	 * $fields上传文件的文本框name
	 */
	public function do_uploadfile($fields){

		$this->sys_config=getcache('upload','configs','file','array');
		$config_para=isset($this->sys_config['module'][$this->module])?$this->sys_config['module'][$this->module]:$this->sys_config['module']['default'];

		$allows_dir  	= isset($config_para['allows_dir'])?$config_para['allows_dir']:$this->sys_config['system_dir'];
		$allows_type 	= isset($config_para['allows_type'])?$config_para['allows_type']:$this->sys_config['system_allows_types'];
		$allows_size 	= isset($config_para['allows_size'])?$config_para['allows_size']:$this->sys_config['system_allows_size'];
		$allows_thumb	= isset($config_para['allows_thumb'])?$config_para['allows_thumb']:'';
		$allows_rel		= isset($config_para['allows_rel'])?$config_para['allows_rel']:'1';

		/***组装文件夹路径***/
		$system_goods_image_dir=$this->sys_config['system_goods_image_dir'];
		$dir='';
		if(isset($this->dir) && !empty($this->dir)){
			$dir=$this->sys_config['system_dir'].DIRECTORY_SEPARATOR.$this->dir;
		}else{
			$dir=$config_para['allows_dir'];
		}

		$dir_date=str_replace('/',DIRECTORY_SEPARATOR,date('Y/m/d'));
		if($this->module=='shop_goods'){
			if($system_goods_image_dir=='{shop_id}/{y}/{m}/{d}'){
				$dir=$dir.DIRECTORY_SEPARATOR.$this->shop_id.DIRECTORY_SEPARATOR.$dir_date;
			}else{
				$dir_date=str_replace('/',DIRECTORY_SEPARATOR,date('Y/m'));
				$dir=$dir.DIRECTORY_SEPARATOR.$this->shop_id.DIRECTORY_SEPARATOR.$dir_date;
			}
		}else{
			$dir=$dir.DIRECTORY_SEPARATOR.$dir_date;
		}

		/***创建文件夹***/
		$this->ifile_lib->mkdir($dir);

		$file_name=$this->create_files_name();

		$upload_config=array(
			'file_name'=>$file_name,
			'max_size'=>$allows_size,
			'allowed_types'=>$allows_type,
			'is_image'=>TRUE,
			'upload_path'=>$dir,
		);
		$this->upload->initialize($upload_config);
		$this->upload->do_upload($fields);
		$this->res_msg  = $this->upload->error_msg;
		$this->res_data = $this->upload->data();
		/***空表示上传成功***/
		if(empty($this->res_msg)){
			$this->create_thumb_allows($allows_thumb,$this->res_data);
		}else{
			$this->res_data=array();
		}

		return $this->res_data;

	}

	/**
	 * 生成缩略图
	 * $allows_thumb:w|s|m|b
	 */
	public function create_thumb_allows($allows_thumb,$data){


		if(empty($allows_thumb)) return true;

		if(empty($this->sys_config)) $this->sys_config=getcache('upload','configs','file','array');

		$types=explode('|',$allows_thumb);
		foreach($types as $v){
			$this->create_thumb_file($v,$data);
		}

	}
	/**
	 *  生成缩略图
	 *  $type:w或s或m或b
	 */
	private function create_thumb_file($type,$data){
		//$types=explode('|',$allows_thumb);
		if(empty($this->sys_config)) $this->sys_config=getcache('upload','configs','file','array');

		$thumb_para=$this->sys_config[$type];

		$thumb_config['image_library'] = 'gd2';//(必须)设置图像库
        $thumb_config['source_image'] = $data['full_path'];//(必须)设置原始图像的名字/路径
        $thumb_config['dynamic_output'] = FALSE;//决定新图像的生成是要写入硬盘还是动态的存在
        $thumb_config['quality'] = isset($thumb_para['quality'])?$thumb_para['quality'].'%':'90%';//设置图像的品质。品质越高，图像文件越大

		$width=isset($thumb_para['width'])?$thumb_para['width']: $data['image_width'];
		$height=isset($thumb_para['height'])?$thumb_para['height']:$data['image_height'];
		if($width < $data['image_width'] && $height < $data['image_height']){
	        $thumb_config['width'] = $width;//(必须)设置你想要得图像宽度。
        	$thumb_config['height'] = $height;//(必须)设置你想要得图像高度
		}else{
	        $thumb_config['width'] = $data['image_width']*0.95;
        	$thumb_config['height'] =  $data['image_height']*0.95;
		}

	    $thumb_config['create_thumb'] = TRUE;//让图像处理函数产生一个预览图像(将_thumb插入文件扩展名之前)
        $thumb_config['thumb_marker'] =isset($thumb_para['thumb_marker'])?$thumb_para['thumb_marker']:'_thumb';//指定预览图像的标示。它将在被插入文件扩展名之前。例如，mypic.jpg 将会变成 mypic_thumb.jpg
        $thumb_config['maintain_ratio'] = TRUE;//维持比例
        $thumb_config['master_dim'] = 'auto';//auto, width, height 指定主轴线

        $this->image_lib->initialize($thumb_config);
        if (!$this->image_lib->resize()){
			return false;
        }else{
           	return true;
        }
	}

	/***
	 *	生成图片名称
	 */
	private function create_files_name(){
		list($usec, $sec) = explode(" ",microtime());
		$str= ((float)$usec + (float)$sec);
		list($s1, $s2) = explode(".",$str);
		$file_name=$s1.$s2;
		return $file_name.'s'.$this->shop_id;
	}


	/**
	 * 删除附件
	 * @param $file_id 附件ID
	 * @param $del TRUE：表示删除文件和删除附件表、附件关联表内容;FALSE,只是在附件表中做标记
	 */
	function do_deletefile($file_id ,$file_path = FALSE, $del = TRUE){
		$file_id=intval($file_id);
		if($file_id==0) return false;

		if(!isset($this->CI)){$this->CI = & get_instance();}
		$this->CI->load->model('m_uploadfile_model');
		if($del){
			$r=array();
			if($file_path===FALSE)
				$r=$this->CI->m_uploadfile_model->get_uploadfile(array('file_id'=>$file_id));
			else
				$r['filepath']=$file_path;

			if(!empty($r)){
				$this->CI->load->library('ithumb_lib');
				$this->CI->ithumb_lib->del_thumb($r['filepath']);
				$this->CI->m_uploadfile_model->del_uploadfile(array('file_id'=>$file_id));
			}
			$this->CI->m_uploadfile_model->del_uploadfile_rel(array('file_id'=>$file_id));
		}else{
			$this->CI->m_uploadfile_model->update_uploadfile(array('file_id'=>$file_id),array('sts'=>1));
		}
		return true;

	}

}

?>