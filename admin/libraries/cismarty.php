<?php defined('BASEPATH') or die('Access restricted!');
/*
 * 作者：晋勇
 */
//require(APPPATH.'libraries/smarty/Smarty.class.php');
require_once FCPATH.'/libs/smarty/SmartyBC.class.php';
class cismarty extends Smarty
{
    public $ext = 'tpl';
    public $dir = '';
		public $layout = 'layout/main';
		public $tpltemp='admin';
	/**
	  * 构造函数
	  *
	  * @access public
	  * @param array/string $template_dir
	  * @return obj  smarty obj
	*/
    public function __construct($config=NULL)
    {
         parent::__construct();

         if(isset($config['tpltemp'])) $this->tpltemp=$config['tpltemp'];

         $this->cache_dir    = realpath(APPPATH.'../cache/'.$this->tpltemp.'/');
         $this->template_dir  = realpath(APPPATH.'../tplviews/'.$this->tpltemp.'/');

         $this->compile_dir   = realpath(APPPATH.'../tplviews_c/'.$this->tpltemp.'/');
         $this->compile_check =   true;
         $this->debugging     =   false;  //debug模式
         $this->caching       =   0;  //启用缓存
         $this->cache_lifetime=   120;//缓存时间s
         $this->left_delimiter=   '<!--{';
         $this->right_delimiter=  '}-->';

         log_message('debug', "Smarty Class Initialized");
    }
    /**
     *
		
	public function  display($template = null, $cache_id = null, $compile_id = null, $parent = null)
	{
		echo 'display';
		parent:: display($template, $cache_id, $compile_id, $parent);
	}
	 */
    /**
     * 显示输出页面
     * @access public
     * @return string
     */
    public function show($tpl){
        $this->assign('jsFiles',$this->getJsHtml());
        $this->assign('jsFiles1',$this->getJsHtml(1));
				$this->assign('LAYOUT', $this->dir ? $this->dir.'/'.$tpl.'.'.$this->ext : $tpl.'.'.$this->ext);
				$this->display($this->layout.'.'.$this->ext);
    }
    /**
     * 添加一个CSS文件包含
     * @param string $file 文件名
     * @access public
     * @return void
     */
    public function addCss($file) {
        if (strpos($file,'/')==false) {
            $file = config_item('css') . $file;
        }
        $GLOBALS['cssFiles'][$file] = $file;
    }
    /**
     * 添加一个JS文件包含
     * @param string $file 文件名
     * @access public
     * @return void
     */
    public function addJs($file,$btm=NULL) {
        if (strpos($file,'/')==false) {
            $file = config_item('js') . $file;
        }
        if ($btm==NULL) {
            $GLOBALS['jsfiles'][$file] = $file;
        } else {
            $GLOBALS['jsbtmfiles'][$file] = $file;
        }
    }
    /**
     * 取生成的包含JS HTML
     * @access public
     * @return string
     */
    public function getJsHtml($btm=NULL) {
        $html = '';
        if (!$GLOBALS['jsfiles']) {
            return;
        }
        $jsFile = $btm?'jsbtmfiles':'jsfiles';
        if (@$GLOBALS[$jsFile]) {
            foreach ($GLOBALS[$jsFile] as $value) {
                $html .= $this->jsInclude($value,true)."/n";
            }
            return $html;
        } else {
            return ;
        }
    }
    /**
     * 添加html标签
     * @param string $tag 标签名
     * @param mixed $attribute 属性
     * @param string $content 内容
     * @return string
     */
    public function addTag($tag, $attribute = NULL, $content = NULL) {
        $this->js();
        $html = '';
        $tag = strtolower($tag);
        $html .= '<'.$tag;
        if ($attribute!=NULL) {
            if (is_array($attribute)) {
                foreach ($attribute as $key=>$value) {
                    $html .= ' '.strtolower($key).'="'.$value.'"';
                }
            } else {
                $html .= ' '.$attribute;
            }
        }
        if ($content) {
            $html .= '>'.$content.'</'.$tag.'>';
        } else {
            $html .= ' />';
        }
        $this->output .= $html;
        return $html;
    }
    /**
     * 添加html文本
     * @param string $content 内容
     * @return string
     */
    public function addText($content) {
        $this->js();
        $content = htmlentities($content);
        $this->output .= $content;
        return $content;
    }
    /**
     * 添加js代码
     * @param string $jscode js代码
     * @param bool $end 是否关闭js 代码块
     * @return void
     */
    public function js($jscode = NULL, $end = false) {
        if (!$this->inJsArea && $jscode) {
            $this->output .= "/n<mce:script language='JavaScript' type='text/javascript'><!--
/n//<!--[CDATA[/n";
            $this->inJsArea = true;
        }
        if ($jscode==NULL && $this->inJsArea==true) {
            $this->output .= "/n//]]-->/n
// --></mce:script>/n";
            $this->inJsArea = false;
        } else {
            $this->output .= "/t$jscode/n";
            if ($end) {
                $this->js();
            }
        }
        return;
    }
    /**
     * 添加js提示代码
     * @param string $message 提示内容
     * @param bool $end 是否关闭js 代码块
     * @return void
     */
    public function jsAlert($message, $end = false) {
        $this->js('alert("' . strtr($message, '"', '//"') . '");', $end);
    }
    /**
     * 添加js文件包含
     * @param string $fileName 文件名
     * @param bool $defer 是否添加defer标记
     * @return string
     */
    public function jsInclude($fileName,$return = false, $defer = false) {
        if (!$return) {
            $this->js();
        }
        $html = '<mce:script language="JavaScript" type="text/javascript" src="'
                . $fileName . '" mce_src="'
                . $fileName . '"' . ( ($defer) ? ' defer' : '' )
                . '></mce:script>';
        if (!$return) {
            $this->output .= $html;
        } else {
            return $html;
        }
    }
    /**
     * 添加css文件包含
     * @param string $fileName 文件名
     * @return string
     */
    public function cssInclude($fileName,$return = false) {
        if (!$return) {
            $this->js();
        }
        $html = '<LINK href="' . $fileName . '" mce_href="' . $fileName . '" rel=stylesheet>' . chr(13);
        if (!$return) {
            $this->output .= $html;
        } else {
            return $html;
        }
    }
    /**
     * 输出html内容
     * @param bool $print 是否直接输出，可选，默认返回
     * @return void
     */
    public function output($print = false) {
        $this->js();
        if ($print) {
            echo $this->output;
            $this->output = '';
            return;
        } else {
            $output = $this->output;
            $this->output = '';
            return $output;
        }
    }

	/**
	*  Parse a template using the Smarty engine
	*
	* This is a convenience method that combines assign() and
	* display() into one step.
	*
	* Values to assign are passed in an associative array of
	* name => value pairs.
	*
	* If the output is to be returned as a string to the caller
	* instead of being output, pass true as the third parameter.
	*
	* @access    public
	* @param    string
	* @param    array
	* @param    bool
	* @return    string
	*/
    function view($template, $data = array(), $return = FALSE)
	{
		foreach ($data as $key => $val)
		{
			$this->assign($key, $val);
		}

		if ($return == FALSE)
 		{
    		$CI =& get_instance();
        	if (method_exists( $CI->output, 'set_output' ))
         	{
              	$CI->output->set_output( $this->fetch($template) );
            }
            else
            {
                $CI->output->final_output = $this->fetch($template);
            }
            return;
		}
		else
        {
            return $this->fetch($template);
       	}
    }
}
// END Smarty Class
