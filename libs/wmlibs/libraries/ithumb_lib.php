<?php

class ithumb_lib {
	/**
	 * 初始化链接实例
	 */
	private static $instance;

	/**
	 * 原始图片路径
	 *
	 **/
	private $img_path;

	/**
	 * 原始图片宽
	 *
	 **/
	private $img_width;

	/**
	 * 原始图片高
	 *
	 **/
	private $img_height;

	/**
	 * 缩略图是否添加水印
	 * @wm_model 0无水印 1文字水印 2图像水印
	 */
	 private $wm_model;
	 private $wm_post;


	/**
	 * 类的初始化
	 */
	public function __construct(){
		self::$instance =& $this;
		$CI = & get_instance();
		$CI->load->library('ifile_lib');
		$CI->load->library('image_lib');
		$this->image_lib = & $CI->image_lib;
		$this->ifile_lib = & $CI->ifile_lib;

	}

	/**
	 * Initialize preferences
	 *
	 * @param	array
	 * @return	void
	 */
	public function initialize($config = array())
	{
		$defaults = array(
							'img_path'			=> '',
							'img_width'			=> 0,
							'img_height'		=> 0,
							'img_quality'		=> 90,
							'img_thumb_marker' 	=> '_thumb',
							'wm_model'			=> 0,
							'wm_post'			=> 0,
							'wm_txt'			=> '',
							'wm_txt_size'		=> 20,
							'wm_txt_color'		=> '#CCCCCC',
							'wm_image_path'		=> '',
							'wm_opacity'		=> 50
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
	 *  一般为initialize函数中config的值
	 */
	public function set($config= array()){
		if(is_array($config)){
			foreach ($config as $key => $val)
			{
				$this->$key = $val;
			}
		}
	}

	/**产生缩略图
	 */
	function create_thumb()
	{
        $config['image_library'] = 'gd2';//(必须)设置图像库
        $config['source_image'] = $this->img_path;//(必须)设置原始图像的名字/路径
        $config['dynamic_output'] = FALSE;//决定新图像的生成是要写入硬盘还是动态的存在
        $config['quality'] = $this->img_quality.'%';//设置图像的品质。品质越高，图像文件越大

	    $config['width'] = $this->img_width;
        $config['height'] =  $this->img_height;

        $config['create_thumb'] = TRUE;//让图像处理函数产生一个预览图像(将_thumb插入文件扩展名之前)
        $config['thumb_marker'] =$this->img_thumb_marker;//指定预览图像的标示。它将在被插入文件扩展名之前。例如，mypic.jpg 将会变成 mypic_thumb.jpg
        $config['maintain_ratio'] = TRUE;//维持比例
        $config['master_dim'] = 'auto';//auto, width, height 指定主轴线

        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()){
			return false;
        }else{
           	return true;
        }
	}

	/**
	 *  水印图片
	 */
	function water_mark(){
		if($this->wm_model==1){
			$this->watermark_txt();
		}elseif($this->wm_model==2){
			$this->watermark_img();
		}

	}
	/**
	 * 文字水印
	 */
	function watermark_txt(){
		if(!is_file($this->img_path)) return '';
        $config['source_image'] =$this->img_path;//设置图像的目标名/路径。
  	 	$config['new_image'] =$this->img_path;//设置图像的目标名/路径。
  	 	$config['create_thumb'] = FALSE;//让图像处理函数产生一个预览图像(将_thumb插入文件扩展名之前)

		$config['image_library'] = 'gd2';//(必须)设置图像库
        $config['dynamic_output'] = FALSE;//TRUE 动态的存在(直接向浏览器中以输出图像),FALSE 写入硬盘
        $config['quality'] = '100%';//设置图像的品质。品质越高，图像文件越大

        $config['wm_type'] = 'text';//(必须)设置想要使用的水印处理类型(text, overlay)
        $config['wm_padding'] = '5';//图像相对位置(单位像素)
        $res=$this->get_wm_alignment($this->wm_post);
        $config['wm_vrt_alignment'] = $res['wm_vrt_alignment'];//竖轴位置 top, middle, bottom
        $config['wm_hor_alignment'] = $res['wm_hor_alignment'];//横轴位置 left, center, right
        $config['wm_vrt_offset'] = $res['wm_vrt_offset'];// 0;//指定一个垂直偏移量（以像素为单位）
        $config['wm_hor_offset'] = $res['wm_hor_offset'];// 0;//指定一个横向偏移量（以像素为单位）
        /* 文字水印参数设置 */
        $config['wm_text'] = $this->wm_txt;//(必须)水印的文字内容
        $config['wm_font_path'] = FCPATH.APPPATH.'helpers/font/arial.ttf';//字体名字和路径
        $config['wm_font_size'] =  $this->wm_txt_size;//(必须)文字大小
        $config['wm_font_color'] =  $this->wm_txt_color;//'FF0000';//(必须)文字颜色，十六进制数
        $config['wm_shadow_color'] = $this->wm_txt_color;//投影颜色，十六进制数
        $config['wm_shadow_distance'] = '0';//字体和投影距离（单位像素）。

        $this->image_lib->initialize($config);
        $this->image_lib->watermark();

	}


    /**
     * 图像水印
     */
    function watermark_img(){

		if(!is_file($this->img_path)) return '';
		$config['source_image'] =$this->img_path;//设置图像的目标名/路径。
  	 	$config['new_image'] =$this->img_path;//设置图像的目标名/路径。
  	 	$config['create_thumb'] = FALSE;//让图像处理函数产生一个预览图像(将_thumb插入文件扩展名之前)

        $config['image_library'] = 'gd2';//(必须)设置图像库
        $config['dynamic_output'] = FALSE;//TRUE 动态的存在(直接向浏览器中以输出图像),FALSE 写入硬盘
        $config['quality'] = '100%';//设置图像的品质。品质越高，图像文件越大

        $config['wm_type'] = 'overlay';//(必须)设置想要使用的水印处理类型(text, overlay)
        $config['wm_padding'] = '5';//图像相对位置(单位像素)
        $res=$this->get_wm_alignment($this->wm_post);
        $config['wm_vrt_alignment'] = $res['wm_vrt_alignment'];//竖轴位置 top, middle, bottom
        $config['wm_hor_alignment'] = $res['wm_hor_alignment'];//横轴位置 left, center, right
        $config['wm_vrt_offset'] = $res['wm_vrt_offset'];// 0;//指定一个垂直偏移量（以像素为单位）
        $config['wm_hor_offset'] = $res['wm_hor_offset'];// 0;//指定一个横向偏移量（以像素为单位）

        /* 图像水印参数设置 */
        $config['wm_overlay_path'] = FCPATH.$this->wm_image_path;//水印图像的名字和路径
        $config['wm_opacity'] = '50';//水印图像的透明度
        $config['wm_x_transp'] = '4';//水印图像通道
        $config['wm_y_transp'] = '4';//水印图像通道

        $this->image_lib->initialize($config);
        $this->image_lib->watermark();
    }

	/**
	 * 删除缩略图
	 */
	function del_thumb($filepath,$type='w|s|m|b',$del=TRUE){
		$filepath=FCPATH.$filepath;
		if(empty($filepath)) return false;

		$isfileexists=$this->ifile_lib->is_file_exists($filepath);
		if($isfileexists==false) return false;
		if($del===TRUE){
			$this->ifile_lib->unlink($filepath);
		}
		$type_arr=explode('|',$type);
		$path_arr=explode('.',$filepath);
		foreach($type_arr as $v){
			$spath=$path_arr[0].'_'.$v.'.'.$path_arr[1];
			$this->ifile_lib->unlink($spath);
			unset($spath);
		}
		return true;

	}

	  /**
     * 获取水印位置
     * 	$config['wm_vrt_alignment'] = 'middle';//竖轴位置 top, middle, bottom
     *  $config['wm_hor_alignment'] = 'center';//横轴位置 left, center, right
     */
    private function get_wm_alignment($post=0){

		$res['wm_vrt_offset'] =  10;//指定一个垂直偏移量（以像素为单位）
        $res['wm_hor_offset'] =  10;//指定一个横向偏移量（以像素为单位）
		switch($post){
			case '1'://左上
				$res['wm_vrt_alignment'] = 'top';
        		$res['wm_hor_alignment'] = 'left';
			break;
			case '2'://正上
				$res['wm_vrt_alignment'] = 'top';
        		$res['wm_hor_alignment'] = 'center';
        		$res['wm_hor_offset'] =  0;
			break;
			case '3'://右上
				$res['wm_vrt_alignment'] = 'top';
        		$res['wm_hor_alignment'] = 'right';
        		$res['wm_hor_offset'] =  -10;
			break;
			case '4'://左中
				$res['wm_vrt_alignment'] = 'middle';
        		$res['wm_hor_alignment'] = 'left';
			break;
			case '5'://中间
				$res['wm_vrt_alignment'] = 'middle';
        		$res['wm_hor_alignment'] = 'center';
        		$res['wm_vrt_offset'] =  0;
        		$res['wm_hor_offset'] = 0;
			break;
			case '6'://右中
				$res['wm_vrt_alignment'] = 'middle';
        		$res['wm_hor_alignment'] = 'right';
        		$res['wm_hor_offset'] =  -10;
			break;
			case '7'://左中
				$res['wm_vrt_alignment'] = 'bottom';
        		$res['wm_hor_alignment'] = 'left';
        		$res['wm_hor_offset'] = -10;
			break;
			case '8'://中间
				$res['wm_vrt_alignment'] = 'bottom';
        		$res['wm_hor_alignment'] = 'center';
        		$res['wm_vrt_offset'] =  -10;
			break;
			default ://右中//默认'9'
				$res['wm_vrt_alignment'] = 'bottom';//竖轴位置 top, middle, bottom
        		$res['wm_hor_alignment'] = 'right';//横轴位置 left, center, right
        		$res['wm_vrt_offset'] =  -10;
        		$res['wm_hor_offset'] = -10;
		}

        return $res;
    }

/**************
	//缩略图
    function resize(){

 //   注意
 //   当$config['create_thumb']等于FALSE并且$config['new_image']没有指定时，会调整原图的大小
 //   当$config['create_thumb']等于TRUE并且$config['new_image']没有指定时，生成文件名为(原图名_thumb.扩展名)
 //   当$config['create_thumb']等于FALSE并且$config['new_image']指定时，生成文件名为$config['new_image']的值
 //   当$config['create_thumb']等于TRUE并且$config['new_image']指定时，生成文件名为(原图名_thumb.扩展名)

        $config['image_library'] = 'gd2';//(必须)设置图像库
        $config['source_image'] = 'ptjsite/upload/55002.jpg';//(必须)设置原始图像的名字/路径
        $config['dynamic_output'] = FALSE;//决定新图像的生成是要写入硬盘还是动态的存在
        $config['quality'] = '90%';//设置图像的品质。品质越高，图像文件越大
        $config['new_image'] = 'ptjsite/upload/resize004.gif';//设置图像的目标名/路径。
        $config['width'] = 575;//(必须)设置你想要得图像宽度。
        $config['height'] = 350;//(必须)设置你想要得图像高度
        $config['create_thumb'] = TRUE;//让图像处理函数产生一个预览图像(将_thumb插入文件扩展名之前)
        $config['thumb_marker'] = '_thumb';//指定预览图像的标示。它将在被插入文件扩展名之前。例如，mypic.jpg 将会变成 mypic_thumb.jpg
        $config['maintain_ratio'] = TRUE;//维持比例
        $config['master_dim'] = 'auto';//auto, width, height 指定主轴线
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }else{
            echo "成功的";
        }
    }
 ***************/

}