<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');

class Dbsave extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db=$this->load->database('default',TRUE);
	}

	/**
	 * 展示数据库列表
	 */
	function export(){
		$dosubmit=$this->input->get_post('dosubmit');
		if(!empty($dosubmit) && $dosubmit==1){
			$tables=$this->input->get_post('tables');
			$sqlcharset = trim($this->input->get_post('sqlcharset'));//字符编码
			$sqlcompat = trim($this->input->get_post('sqlcompat'));//建表语句格式
			$sizelimit = trim($this->input->get_post('sizelimit'));//分卷大小
			$sqlcompat = trim($this->input->get_post('sqlcompat'));

			$action = trim($this->input->get_post('action'));
			$fileid = trim($this->input->get_post('fileid'));
			$random = trim($this->input->get_post('random'));
			$tableid = trim($this->input->get_post('tableid'));
			$startfrom = trim($this->input->get_post('startfrom'));
			$tabletype = trim($this->input->get_post('tabletype'));

			$this->export_database($tables,$sqlcompat,$sqlcharset,$sizelimit,$action,$fileid,$random,$tableid,$startfrom,$tabletype);

		}else{
			$sql="SHOW TABLE STATUS FROM `".$this->db->database."`";
			$list=$this->db->query($sql)->result_array();

			$this->cismarty->assign('pdoname',$this->db->database);
			$this->cismarty->assign('infolist',$list);
			$this->cismarty->display('maintenance/dbsave/export.html');
		}

	}


	/**
	 * 数据结构优化、修复、结构查看
	 */
	function public_repair(){
		$tables=trim($this->input->get_post('tables'));
		$operation = trim($this->input->get_post('operation'));
		$pdo_name = trim($this->input->get_post('pdo_name'));

		$tables = is_array($tables) ? implode(',',$tables) : $tables;

		if($tables && in_array($operation,array('repair','optimize'))) {
			$sql= "$operation TABLE $tables";
			$this->db->query($sql)->result_array();
			$this->showmessage('success',lang('com_success'),HTTP_REFERER);
		}elseif ($tables && $operation == 'showcreat') {
			$res=$this->db->query("SHOW CREATE TABLE $tables")->result_array();
			if(!empty($res[0]['Create Table'])){
				print_pre($res[0]['Create Table']);
			}
		}
		$this->showmessage('error',lang('com_parameter'),HTTP_REFERER);
	}

	/**
	 * 数据库导入
	 */
	public function import() {
		$dosubmit=$this->input->get_post('dosubmit');
		$pdoname = $this->db->database;
		if(!empty($dosubmit) && $dosubmit==1){
			$admin_id=$this->session->userdata['admin_user_id'];
			if($admin_id != 1){
				$this->showmessage('error','您没有权限恢复数据',HTTP_REFERER);
			}
			$pre=trim($this->input->get('pre'));
			$this->import_database($pre);
		} else {
			$cache_path = FCPATH.'caches'.DIRECTORY_SEPARATOR;

			$pdos = $others = array();
			$sqlfiles = glob($cache_path.'bakup/'.$pdoname.'/*.sql');
			$info = $infos = $other = $others = array();
			if(is_array($sqlfiles)) {
				asort($sqlfiles);
				$prepre = '';
				foreach($sqlfiles as $id=>$sqlfile) {
					if(preg_match("/(wmmall_[0-9]{8}_[0-9a-z]{4}_)([0-9]+)\.sql/i",basename($sqlfile),$num)) {
						$info['filename'] = basename($sqlfile);
						$info['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
						$info['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
						$info['pre'] = $num[1];
						$info['number'] = $num[2];
						if(!$id) $prebgcolor = '#CFEFFF';
						if($info['pre'] == $prepre) {
						 $info['bgcolor'] = $prebgcolor;
						} else {
						 $info['bgcolor'] = $prebgcolor == '#CFEFFF' ? '#F1F3F5' : '#CFEFFF';
						}
						$prebgcolor = $info['bgcolor'];
						$prepre = $info['pre'];
						$infos[] = $info;
					} else {
						$other['filename'] = basename($sqlfile);
						$other['filesize'] = round(filesize($sqlfile)/(1024*1024),2);
						$other['maketime'] = date('Y-m-d H:i:s',filemtime($sqlfile));
						$others[] = $other;
					}
				}
			}
			$this->cismarty->assign('pdoname',$pdoname);
			$this->cismarty->assign('infos',$infos);
			$this->cismarty->assign('others',$others);
			$this->cismarty->display('maintenance/dbsave/import.html');
		}
	}




	/**
	 * 数据库导出方法
	 * @param unknown_type $tables 数据表数据组
	 * @param unknown_type $sqlcompat 数据库兼容类型
	 * @param unknown_type $sqlcharset 数据库字符
	 * @param unknown_type $sizelimit 卷大小
	 * @param unknown_type $action 操作
	 * @param unknown_type $fileid 卷标
	 * @param unknown_type $random 随机字段
	 * @param unknown_type $tableid
	 * @param unknown_type $startfrom
	 * @param unknown_type $tabletype 备份数据库类型 （非wmmall数据与wmmall数据）
	 */
	private function export_database($tables,$sqlcompat,$sqlcharset,$sizelimit,$action,$fileid,$random,$tableid,$startfrom,$tabletype) {
		$res_url = $this->admin_url.'system/dbsave/export?loghash='.$this->session->userdata('loghash');
		$dbprefix=$this->db->dbprefix;
		$dumpcharset = $sqlcharset ? $sqlcharset : str_replace('-', '', 'utf8');
		$fileid = ($fileid != '') ? $fileid : 1;
		if($fileid==1 && $tables) {
			if(!isset($tables) || !is_array($tables)){ $this->showmessage('error','请选择数据表',$res_url);}
			$random = mt_rand(1000, 9999);
			setcache('bakup_tables',$tables,'commons');
		} else {
			if(!$tables = getcache('bakup_tables','commons')){$this->showmessage('error','请选择数据表',$res_url);}
		}
		if($this->db->version() > '4.1'){
			if($sqlcharset) {
				$this->db->query("SET NAMES '".$sqlcharset."';\n\n");
			}
			if($sqlcompat == 'MYSQL40') {
				$this->db->query("SET SQL_MODE='MYSQL40'");
			} elseif($sqlcompat == 'MYSQL41') {
				$this->db->query("SET SQL_MODE=''");
			}
		}

		$tabledump = '';

		$tableid = ($tableid!= '') ? $tableid - 1 : 0;
		$startfrom = ($startfrom != '') ? intval($startfrom) : 0;
		for($i = $tableid; $i < count($tables) && strlen($tabledump) < $sizelimit * 1000; $i++) {
			global $startrow;
			$offset = 100;
			if(!$startfrom) {
				if($tables[$i]!=$dbprefix.'session') {
					$tabledump .= "DROP TABLE IF EXISTS `$tables[$i]`;\n";
				}
				$createtable = $this->db->query("SHOW CREATE TABLE `$tables[$i]` ");
				$res=$this->db->query("SHOW CREATE TABLE $tables[$i]")->result_array();

				$tabledump .= $res[0]['Create Table'].";\n\n";

				if($sqlcompat == 'MYSQL41' && $this->db->version() < '4.1') {
					$tabledump = preg_replace("/TYPE\=([a-zA-Z0-9]+)/", "ENGINE=\\1 DEFAULT CHARSET=".$dumpcharset, $tabledump);
				}
				if($this->db->version() > '4.1' && $sqlcharset) {
					$tabledump = preg_replace("/(DEFAULT)*\s*CHARSET=[a-zA-Z0-9]+/", "DEFAULT CHARSET=".$sqlcharset, $tabledump);
				}
				if($tables[$i]==$dbprefix.'session') {
					$tabledump = str_replace("CREATE TABLE `".$dbprefix."session`", "CREATE TABLE IF NOT EXISTS `".$dbprefix."session`", $tabledump);
				}
			}

			$numrows = $offset;
			while(strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset) {
				if($tables[$i]==$dbprefix.'session' || $tables[$i]==$dbprefix.'member_cache') break;
				$sql = "SELECT * FROM `$tables[$i]` LIMIT $startfrom, $offset";
				$numfields = $this->db->query($sql)->num_fields();//字段个数
				$numrows = $this->db->query($sql)->num_rows();//数据条数
				$fields_name = $this->db->list_fields($tables[$i]);//字段名称

				$rows_list = $this->db->query($sql)->result_array();
				foreach($rows_list as $v){
					$comma = "";
					$tabledump .= "INSERT INTO `$tables[$i]` VALUES(";
					for($j = 0; $j < $numfields; $j++) {
						$tabledump .= $comma."'".mysql_escape_string($v[$fields_name[$j]])."'";
						$comma = ",";
					}
					$tabledump .= ");\n";
				}
				$startfrom += $offset;

			}
			$tabledump .= "\n";
			$startrow = $startfrom;
			$startfrom = 0;
		}

		$cache_path = FCPATH.'caches'.DIRECTORY_SEPARATOR;
		$pdo_name = $this->db->database;
		if(trim($tabledump)) {
			$tabledump = "# wmmall bakfile\n# version:MVMALL V1\n# time:".date('Y-m-d H:i:s')."\n# type:wmmall\n# \n# --------------------------------------------------------\n\n\n".$tabledump;
			$tableid = $i;
			$filename = $tabletype.'_'.date('Ymd').'_'.$random.'_'.$fileid.'.sql';
			$altid = $fileid;
			$fileid++;
			$bakfile_path = $cache_path.'bakup'.DIRECTORY_SEPARATOR.$pdo_name;
			$this->load->library('ifile_lib');
			if(!$this->ifile_lib->is_dir_exists($bakfile_path)){
				$this->ifile_lib->mkdir($bakfile_path);
			}

			$bakfile = $bakfile_path.DIRECTORY_SEPARATOR.$filename;
			if(!is_writable($cache_path.'bakup')){ $this->showmessage('error','目录无法写入文件',$res_url);}
			file_put_contents($bakfile, $tabledump);
			@chmod($bakfile, 0777);
		    $filename = '分卷：'.$altid.'#写入成功';
		    $next_url=$this->admin_url.'system/dbsave/export?dosubmit=1&sizelimit='.$sizelimit.'&sqlcompat='.$sqlcompat.'&sqlcharset='.$sqlcharset.'&tableid='.$tableid.'&fileid='.$fileid.'&startfrom='.$startrow.'&random='.$random.'&dosubmit=1&tabletype='.$tabletype.'&pdo_select='.$pdo_name.'&loghash='.$this->session->userdata('loghash');
			$this->showmessage('success',$filename,$next_url);
		} else {
		   $bakfile_path = $cache_path.'bakup'.DIRECTORY_SEPARATOR.$pdo_name.DIRECTORY_SEPARATOR;
		   file_put_contents($bakfile_path.'index.html','');
		   delcache('bakup_tables','commons');
		   $this->showmessage('success','数据备份完成!',$this->admin_url.'maintenance/dbsave/import?loghash='.$this->session->userdata('loghash'));
		}
	}

	/**
	 * 数据库恢复
	 * @param unknown_type $filename
	 */
	private function import_database($filename) {
		$cache_path = FCPATH.'caches'.DIRECTORY_SEPARATOR;
		$pdo_name = $this->db->database;
		$this->load->library('ifile_lib');

		if($filename && $this->ifile_lib->get_file_ext($filename)=='sql') {
			$filepath = $cache_path.'bakup'.DIRECTORY_SEPARATOR.$pdo_name.DIRECTORY_SEPARATOR.$filename;
			if(!file_exists($filepath)){ $this->showmessage('error','对不起'." $filepath ".'数据库文件不存在',HTTP_REFERER);}
			$sql = file_get_contents($filepath);
			sql_execute($sql);
			$this->showmessage('success',"$filename ".'中的数据已经成功导入到数据库',HTTP_REFERER);
		} else {
			$fileid=$this->input->get('fileid');
			$fileid = intval($fileid) ? intval($fileid) : 1;
			$pre = $filename;
			$filename = $filename.$fileid.'.sql';
			$filepath = $cache_path.'bakup'.DIRECTORY_SEPARATOR.$pdo_name.DIRECTORY_SEPARATOR.$filename;
			if(file_exists($filepath)) {
				$sql = file_get_contents($filepath);
				$this->sql_execute($sql);
				$fileid++;
				$this->showmessage('success','数据文件'.$filename .'上传成功',$this->admin_url.'maintenance/dbsave/import?pre='.$pre.'&fileid='.$fileid.'&loghash='.$this->session->userdata('loghash').'&dosubmit=1');
			} else {
				$this->showmessage('success','数据库恢复成功！',$this->admin_url.'maintenance/dbsave/import?loghash='.$this->session->userdata('loghash'));
			}
		}
	}


	/**
	 * 执行SQL
	 * @param unknown_type $sql
	 */
 	private function sql_execute($sql) {
	    $sqls = $this->sql_split($sql);
		if(is_array($sqls)) {
			foreach($sqls as $sql) {
				if(trim($sql) != '') {
					$this->db->query($sql);
				}
			}
		} else {
			$this->db->query($sqls);
		}
		return true;
	}


 	private function sql_split($sql) {
		if($this->db->version() > '4.1' && $this->db->char_set) {
			$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=".$this->db->char_set,$sql);
		}
		if($this->db->dbprefix != "wmmall_") $sql = str_replace("`wmmall_", '`'.$this->db->dbprefix, $sql);
		$sql = str_replace("\r", "\n", $sql);
		$ret = array();
		$num = 0;
		$queriesarray = explode(";\n", trim($sql));
		unset($sql);
		foreach($queriesarray as $query) {
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			$queries = array_filter($queries);
			foreach($queries as $query) {
				$str1 = substr($query, 0, 1);
				if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
			}
			$num++;
		}
		return($ret);
	}
}