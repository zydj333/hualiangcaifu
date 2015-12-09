<?php if ( ! defined('SITEPHP')) exit('No direct script access allowed');

class Common extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/***
	 * 获得验证码图片
	 */
	public function verifycode(){

		$vcode=$this->input->get('vcode');
		$vcode=empty($vcode)?'verifycode':$vcode;

		$this->load->library('iverifycode');

		if (isset($_GET['code_len']) && intval($_GET['code_len'])) $this->iverifycode->code_len = intval($_GET['code_len']);
		if ($this->iverifycode->code_len > 8 || $this->iverifycode->code_len < 2) {
			$this->iverifycode->code_len = 4;
		}
		if (isset($_GET['font_size']) && intval($_GET['font_size'])) $this->iverifycode->font_size = intval($_GET['font_size']);
		if (isset($_GET['width']) && intval($_GET['width'])) $this->iverifycode->width = intval($_GET['width']);
		if ($this->iverifycode->width <= 0) {
			$this->iverifycode->width = 130;
		}
		if (isset($_GET['height']) && intval($_GET['height'])) $this->iverifycode->height = intval($_GET['height']);
		if ($this->iverifycode->height <= 0) {
			$this->iverifycode->height = 50;
		}
		if (isset($_GET['font_color']) && trim(urldecode($_GET['font_color'])) && preg_match('/(^#[a-z0-9]{6}$)/im', trim(urldecode($_GET['font_color'])))) $this->iverifycode->font_color = trim(urldecode($_GET['font_color']));
		if (isset($_GET['background']) && trim(urldecode($_GET['background'])) && preg_match('/(^#[a-z0-9]{6}$)/im', trim(urldecode($_GET['background'])))) $this->iverifycode->background = trim(urldecode($_GET['background']));
		$this->iverifycode->doimage();
		$code=$this->iverifycode->get_code();
		$this->session->set_userdata($vcode,$code);

	}

	/**
	 * AJAX判断验证码
	 */
	public function check_verifycode(){
		$vcode=$this->input->get('vcode');
		$vcode=empty($vcode)?'verifycode':$vcode;
		//加载类库
		$this->load->library('session');
		if(isset($this->session->userdata[$vcode])){
			//echo $this->session->userdata[$vcode];
			$code = trim ( $this->input->get_post ( 'captcha' ) );
			if ($this->session->userdata[$vcode] != strtolower($code)) {//判断验证码
				echo 'false';exit;
			}else{
				echo 'true';exit;
			}
		}
		echo 'false';exit;
	}

	/**
	 *jslang打印出html
	 */
	public function jslang()
	{
		$lang=$this->input->get('lang');
		$lang = $this->config->item('language');
		if($lang) $this->_language=$lang;


		$lang_data=array();
		switch($lang){
			case '1':
			break;
			case '2':
			break;
			default://默认为base
				$lang_data=$this->lang->load('jslang', $this->_language,TRUE);
		}

		header('Content-Encoding:'.CHARSET);
		header("Content-Type: application/x-javascript\n");
		header("Expires: " .date(DATE_RFC822, strtotime("+1 hour")). "\n");
		if (!$lang_data){
			echo 'var lang = null;';
		}else{
			$this->load->library('ijson');
			$json_data=$this->ijson->encode($lang_data);
			echo 'var lang = ' . $json_data . ';';
			echo "
				lang.get = function(key){
				eval('var langKey = lang.' + key);
				if(typeof(langKey) == 'undefined'){
					return key;
				}else{
					return langKey;
				}
			}";
		}
	}

	//AJAX获取地区
	public function ajax_shop_areas(){
	    $parent_id = $this->input->get('area_id');
		$where = array(
		                'parent_id' => intval($parent_id),
					  );
		$this->load->model('s_com_model');
		$areas = $this->s_com_model->get_query($where,'areas');
		echo json_encode($areas);
	}

	public function apifalsh(){
		//$webid = $this->input->get('webid');
		//$webid = intval($webid);
		//if($webid == 0){ $siteid=1;}else{$siteid=$webid; }
		$webid=0;
		$baseURL = base_url();

		$tid=$this->input->get('tid');
		if(empty($tid)) return "";
		//判断摊位是否存在
	    $this->load->model('s_market_model');
	    $booth_info = $this->s_market_model->get_one(array('id'=>$tid,'sts'=>0),'market_booth');
		if(empty($booth_info)) return "";
		//读取缓存数组组合成xml
		$mk=getcache('booth_'.$webid.'_'.$tid,'booth','file','array');
		if(empty($mk)){
			//重新生成缓存
			$this->load->helper('flash');
			setcache_flash($webid,$tid);
			//重新获取缓存
			$mk = getcache('booth_'.$webid.'_'.$tid,'booth','file','array');
		}
		if(empty($mk)){ return "";}
		if(!empty($mk)){
			/***（暂时没用)3个产生没有用：加长url显示
			$rand_1=random(16,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
			$rand_2=rand(1000,999999);
			$rand_3=random(16,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
			***/
			$str="<?xml version='1.0' encoding='UTF-8'?>".
				'<root>'.
				'<number>'.$mk['number'].'</number>'.
				'<bgurl></bgurl>'.
				'<imimg>'.$baseURL.'uploadfile/booth/im.jpg</imimg>'.
				//'<imurl>'.$baseURL.'/im/wwwcheck.php?UIN='.$mk['uin'].'&proid=0&m=NITalk&a='.$rand_1.'&b='.$rand_2.'&c='.$rand_3.'</imurl>'.
				'<name>'.$mk['name'].'</name>'.
				'<detailPage>'.$baseURL.$mk['detailPage'].'</detailPage>';
				//$infos=$mk['infos'];
				if(!empty($infos)){
					$str.="<info>";
					$str.='<detailPage>'.$baseURL.$infos['detailPage'].'</detailPage>';
					$entrys=$infos['entry'];
					foreach($entrys as $entry_key => $entry){
						$str.='<entry><name>'.$entry['name'].'</name><time>'.$entry['time'].'</time><url>'.$baseURL.$entry['url'].'</url><cat>'.$entry['cat'].'</cat></entry>';
					}
					$str.="</info>";
				}
				$products=$mk['products'];
				if(!empty($products)){
					$str.="<products>";
					$str.='<detailPage>'.$baseURL.$products['detailPage'].'</detailPage>';
					$pros=$products['product'];
					if(!empty($pros)){
						foreach($pros as $pro_key => $pro){
							$simage=$pro['ishttp']==1?$pro['image']:$baseURL.$pro['image'];
							$str.='<product><image>'.$baseURL.$simage.'</image><url>'.$baseURL.$pro['url'].'</url></product>';
						}
					}
					$str.="</products>";
				}
			 	$str.="</root>";
         	echo $str;
		}

return "";
	    if($this->input->get('tid')){
	    	$id = $this->input->get('tid');
	    }else{
	    	$id ='100';
	    }

		if(empty($id)) return "";

		$baseURL = base_url();

		//判断摊位是否存在
	    $this->load->model('s_market_model');
	    $b_data = $this->s_market_model->get_one(array('id'=>$id,'sts'=>0),'market_booth');
	    if(!empty($b_data)){
		    //读取缓存数组组合成xml
			$mk=getcache('booth_'.$webid.'_'.$id,'booth','file','array');
			if(empty($mk)){
			//重新生成缓存
			$this->load->helper('flash');
			//setcache('booth_'.$webid.'_'.$tid,$bcache,'booth','file','0','array');
			$return=setcache_flash($webid,$id);
			//重新获取缓存
			$mk=getcache('booth_'.$webid.'_'.$id,'booth','file','array');
			}

			if(!empty($mk)){
		   //3个产生没有用：加长url显示
			$rand_1=random(16,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
			$rand_2=rand(1000,999999);
			$rand_3=random(16,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');

		$str="<?xml version='1.0' encoding='UTF-8'?>".
		'<root>'.
			'<number>'.$mk['number'].'</number>'.
			'<bgurl></bgurl>'.
			'<imimg>'.$baseURL.'uploadfile/booth/im.jpg</imimg>'.
			//'<imurl>'.$baseURL.'/im/wwwcheck.php?UIN='.$mk['uin'].'&proid=0&m=NITalk&a='.$rand_1.'&b='.$rand_2.'&c='.$rand_3.'</imurl>'.
			'<name>'.$mk['name'].'</name>'.
			'<detailPage>'.$baseURL.$mk['detailPage'].'</detailPage>';
			//$infos=$mk['infos'];
			if(!empty($infos)){
				$str.="<info>";
				$str.='<detailPage>'.$baseURL.$infos['detailPage'].'</detailPage>';
				$entrys=$infos['entry'];
				foreach($entrys as $entry_key => $entry){
					$str.='<entry><name>'.$entry['name'].'</name><time>'.$entry['time'].'</time><url>'.$baseURL.$entry['url'].'</url><cat>'.$entry['cat'].'</cat></entry>';
				}
				$str.="</info>";
			}
			$products=$mk['products'];
			if(!empty($products)){
				$str.="<products>";
				$str.='<detailPage>'.$baseURL.$products['detailPage'].'</detailPage>';
				$pros=$products['product'];
				if(!empty($pros)){
					foreach($pros as $pro_key => $pro){
						$simage=$pro['ishttp']==1?$pro['image']:$baseURL.$pro['image'];
						$str.='<product><image>'.$simage.'</image><url>'.$baseURL.$pro['url'].'</url></product>';
					}
				}
				$str.="</products>";
			}
		 $str.="</root>";
         echo $str;
		}

	    }else{
	    return "";
	    }

	}


}