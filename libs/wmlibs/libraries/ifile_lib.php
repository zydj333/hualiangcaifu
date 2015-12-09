<?php
/**
 * @class ifile_lib
 * @brief 文件夹文件处理
 */
class ifile_lib
{
	private $resource = null; //文件资源句柄
	public static $except = array('.','..','.svn'); //无效文件或目录名
	function __construct()
	{

	}
	/***
	 *@brief  文件操作时，打开资源流，并独占锁定
	 * @param String $fileName 文件路径名
	 * @param String $mode     操作方式，默认为读操作，可供选择的项为：r,r+,w+,w+,a,a+
	 * @note $mod，'r'  只读方式打开，将文件指针指向文件头
	 *             'r+' 读写方式打开，将文件指针指向文件头
	 * 			   'w'  写入方式打开，将文件指针指向文件头并将文件大小截为零。如果文件不存在则尝试创建之。
	 * 			   'w+' 读写方式打开，将文件指针指向文件头并将文件大小截为零。如果文件不存在则尝试创建之。
	 * 			   'a'  写入方式打开，将文件指针指向文件末尾。如果文件不存在则尝试创建之。
	 * 			   'a+' 读写方式打开，将文件指针指向文件末尾。如果文件不存在则尝试创建之。
	 */
	function initialize($filename=null,$mode='r'){
		if($filename!=null){

			$dirName  = dirname($filename);
			$baseName = basename($filename);

			//检查并创建文件夹
			self::mkdir($dirName);

			$this->resource = fopen($filename,$mode.'b');
			if($this->resource)
			{
				flock($this->resource,LOCK_EX);
			}
		}
	}


	/**
	 * @brief  创建文件夹
	 * @param String $path  路径
	 * @param int    $chmod 文件夹权限
	 * @note  $chmod 参数不能是字符串(加引号)，否则linux会出现权限问题
	 */
	public function mkdir($path,$chmod=0777)
	{
		return is_dir($path) or (self::mkdir(dirname($path),$chmod) and mkdir($path,$chmod));
	}

	/**
	 * @brief  删除$dir文件夹 或者 其下所有文件
	 * @param  String $dir       文件路径
	 * @param  bool   $recursive 是否强制删除，如果强制删除则递归删除该目录下的全部文件，默认为false
	 * @return bool true:删除成功; false:删除失败;
	 */
	public function rmdir($dir,$recursive = false)
	{
		if(is_dir($dir) && is_writable($dir))
		{
			//强制删除
			if($recursive == true)
			{
				self::clearDir($dir);
				self::rmdir($fullpath,false);
			}
			//非强制删除
			else
			{
				if(rmdir($dir))
					return true;

				else
					return false;
			}
		}
	}

	/**
	 * @brief  清空目录下的所有文件
	 * @return bool false:失败; true:成功;
	 */
	public function cleardir($dir)
	{
		if(!in_array($dir,self::$except) && is_dir($dir) && is_writable($dir))
		{
			$dirRes = opendir($dir);
			while($fileName = readdir($dirRes))
			{
				if(!in_array($fileName,self::$except))
				{
					$fullpath = $dir.'/'.$fileName;
					if(is_file($fullpath))
					{
						self::unlink($fullpath);
					}

					else
					{
						self::clearDir($fullpath);
						rmdir($fullpath);
					}
				}
			}
			closedir($dirRes);
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * 判断文件夹是否存在
	 */
	 public function is_dir_exists($path)
	 {
		return is_dir($path);
	 }


	/**
	 * @brief 检测文件夹是否为空
	 * @param String $dir 路径地址
	 * @return bool true:$dir为空目录; false:$dir为非空目录;
	 */
	public function is_dir_empty($dir)
	{
		if(is_dir($dir))
		{
			$isEmpty = true;
			$dirRes  = opendir($dir);
			while($fileName = readdir($dirRes))
			{
				if($fileName!='.' && $fileName!='..')
				{
					$isEmpty = false;
					break;
				}
			}
			closedir($dirRes);
			return $isEmpty;
		}
	}


	 /**
	 * 判断文件是否存在
	 */
	 public function is_file_exists($path)
	 {
		return is_file($path);
	 }


	/**
	 * @brief 获取文件内容
	 * @return String 文件内容
	 */
	public function read()
	{
		$content = null;
		while(!feof($this->resource))
		{
			$content.= fread($this->resource,1024);
		}
		return $content;
	}

	/**
	 * @brief 文件写入操作
	 * @param  String $content 要写入的文件内容
	 * @return Int or false    写入的字符数; false:写入失败;
	 */
	public function write($content)
	{
		$worldsnum = fwrite($this->resource,$content);
		return is_bool($worldsnum) ? false : $worldsnum;
	}

	/**
	 * @brief 释放文件锁定
	 */
	public function save()
	{
		flock($this->resource,LOCK_UN);
	}

	/**
	 * @brief 释放文件连接句柄
	 */
	public function close()
	{
		if(is_resource($this->resource))
		{
			fclose($this->resource);
		}
	}

	/**
	 * @brief 删除文件
	 * @param String $fileName 文件路径
	 * @return bool  操作结果 false:删除失败;
	 */
	public function unlink($filename)
	{
		if(is_file($filename) && is_writable($filename))
		{
			unlink($filename);
		}
		else
			return false;
	}

		/**
	 * @brief 复制文件
	 * @param String $from 源文件路径
	 * @param String $to   目标文件路径
	 * @param String $mod  操作模式，c:复制(默认); x:剪切(删除$from文件)
	 * @return bool  操作结果 true:成功; false:失败;
	 */
	public function copy($from,$to,$mode = 'c')
	{
		if(is_file($from))
		{
			$dir = dirname($to);
			//创建目录
			self::mkdir($dir);
			copy($from,$to);
			if(is_file($to))
			{
				if($mode == 'x')
				{
					self::unlink($from);
				}
				return true;
			}
			else
			{
				return false;
			}
		}
		else
			return false;
	}


	/**
	 * @brief  文件对拷贝
	 * @param  String $source   源地址
	 * @param  String $dest     目标地址
	 * @param  String $oncemore 是否支持子目录拷贝
	 * @return bool true:成功; false:失败;
	 */
	public function xcopy($source, $dest ,$oncemore = true)
	{
		if(!file_exists($source))
		{
			return "error: $source is not exist!";
		}
		if(is_dir($source))
		{
			if(file_exists($dest) && !is_dir($dest))
			{
				return "error: $dest is not a dir!";
			}
			if(!file_exists($dest))
			{
				mkdir($dest,0777);
			}
			$od = opendir($source);
			while($one = readdir($od))
			{
				if(in_array($one,self::$except))
				{
					continue;
				}
				$result = self::xcopy($source.DIRECTORY_SEPARATOR.$one, $dest.DIRECTORY_SEPARATOR.$one, $oncemore);
				if($result !== true)
				{
					return $result;
				}
			}
			closedir($od);
		}
		else
		{
			if(file_exists($dest) || is_dir($dest) )
			{
				if( func_num_args()>2 || $oncemore===true )
				{
					return "error: $dest is a dir!";
				}
				$result = self::xcopy($source, $dest.DIRECTORY_SEPARATOR.basename($source), $oncemore);
				if( $result !== true )
				{
					return $result;
				}
			}
			else
			{
				if(!file_exists(dirname($dest))) self::mkdir(dirname($dest));
				copy($source, $dest);
				chmod($dest,0777) and touch($dest, filemtime($source));
			}
		}
		return true;
	}


	/**
	 * @brief 获取文件信息
	 * @param String $filename 文件路径
	 * @return array or null   array:文件信息; null:文件不存在;
	 */
	public function get_file_info($filename)
	{
		if(is_file($filename))
			return stat($filename);
		else
			return null;
	}

	/**
	 * @brief 获取文件名
	 * @param String $filename 文件路径
	 * @return bool  操作结果 false:删除失败;
	 */
	public function get_file_name($filename){
		if(!is_file($filename)) return null;
		$fileInfoArray = pathinfo($filename);
		return strtolower($fileInfoArray['filename']);
	}

	/**
	 * @brief 获取文件扩展名
	 * @param String $fileName 文件路径
	 * @return bool  操作结果 false:删除失败;
	 */
	public function get_file_ext($filename){
		if(!is_file($filename)) return null;
		$fileInfoArray = pathinfo($filename);
		return strtolower($fileInfoArray['extension']);
	}

	/**
	 * @brief 获取文件大小
	 * @param String $fileName 文件路径
	 * @return bool  操作结果 false:删除失败;
	 */
	public function get_file_size($filename){
		return is_file($filename) ? filesize($filename):null;
	}

}
