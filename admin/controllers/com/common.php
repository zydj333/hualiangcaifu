<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');

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
		$this->load->library('session');
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

}