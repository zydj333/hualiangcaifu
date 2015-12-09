<?php

if (!defined('SITEPHP'))
    exit('No direct script access allowed');

class Customer extends Site_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('a_com_model');
        $this->load->model('areas');
    }

    /* loginMsg 0 返回登录成功;1登录失败;2验证码失败; */

    public function login() {
        $this->seosetup['keywords'] = '登录';
        $this->seosetup['description'] = '登录';
        if (isset($_POST['dosubmit'])) {
            $callback = array();
            $username = trim($this->input->post('loginname'));
            $password = trim($this->input->post('loginpsd'));
            $urll = trim($this->input->post('urll'));
            $urll = empty($urll) ? base_url() . 'index.php?m=member&c=user&a=index' : urldecode($urll);
            $callback['urll'] = urldecode($urll);
            $this->load->model('user');

            $where = array('sts' => '0', 'isclose' => '1', 'ischeck' => '1');
            $type = "email";
            $where['username'] = $username;

            //帐号是否存在
            $r = $this->user->get_one($where, 'user');

            if (!$r) {
                $this->showmessage('error', '用户名不存在', HTTP_REFERER);
                return;
            }

            $password = md5(md5($password . $r['random']));
            $maxloginfailedtimes = 5;
            $now_time = time() - 2 * 3600;
            $rtime = $this->user->get_one(array('username' => $username, 'isadmin' => 0, 'logintime >' => $now_time), 'sys_times');

            //密码核对失败
            if ($r['password'] != $password) {
                $ip = ip();
                if ($rtime && $rtime['times'] < $maxloginfailedtimes) {
                    $times = $maxloginfailedtimes - intval($rtime['times']);
                    $this->user->update_set(array('username' => $username), array('ip' => $ip, 'data_set' => array('times' => 'times+1')), 'sys_times');
                } else {
                    $this->user->del(array('username' => $username), 'sys_times');
                    $this->user->add(array('username' => $username, 'ip' => $ip, 'isadmin' => 0, 'logintime' => time(), 'times' => 1), 'sys_times');
                    $times = $maxloginfailedtimes;
                }
                if ($times >= 3) {//密码输入错误小于3次时提示
                    $callback['loginMsg'] = '1';
                    $callback['loginnum'] = 5 - $times;
                    $this->showmessage('error', '密码输入错误', HTTP_REFERER);
                    return;
                } else {
                    $callback['loginMsg'] = '1';
                    $this->showmessage('error', '密码输入错误', HTTP_REFERER);
                    return;
                }
            }

            $this->user->del(array('username' => $username), 'sys_times');
            $loghash = random(6, 'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');

            $ses_data = array('member_user_id' => $r['user_id'],
                'member_username' => $username,
                'member_truename' => $r['truename'],
                'member_headico' => $r['head_ico'],
                'member_role_id' => 0, //$r['role_id'],
                'member_site_id' => 0, //$r['site_id'],
                'member_login' => 'logined',
                'onhash' => $loghash
            );
            $this->session->set_userdata($ses_data);

            $input_auto_login = $this->input->post('rememberUsername');
            $this->load->helper('cookie');
            if ($input_auto_login) {
                set_cookie('self_login_time', 2 * 7 * 24 * 3600, 2 * 7 * 24 * 3600);
            } else {
                set_cookie('self_login_time', 0, 2 * 7 * 24 * 3600);
            }

            $callback['loginMsg'] = '0';
            $this->showmessage('success', '您已经登录成功！', $urll, 500);
            //redirect(base_url().'index.php?m=member&c=order&a=lists');
            //return '';
        } else {
            $user_id = isset($this->session->userdata['member_user_id']) ? $this->session->userdata['member_user_id'] : 0;
            if ($user_id > 0) {//表示已经登录，不需要重新登录
//				$this->showmessage('success', '您已经登录成功！','index.php?m=member&c=user&a=index');
//				return '';
                redirect(base_url() . 'index.php?m=member&c=user&a=index');
                return '';
            }
            $urll = $this->input->get_post('urll');
            $urll = empty($urll) ? '' : urlencode($urll);
            $data['urll'] = $urll;
            //网站基本设置
            $setup_setting = getcache('setup', 'commons');
            $this->seo_title = "客户专区 - " . $setup_setting['site_title'];
            $this->load->helper('captcha');
            //$img=create_captcha();
            $this->view('user_login', $data);
        }
    }

    public function register() {
        $this->seosetup['keywords'] = '注册';
        $this->seosetup['description'] = '注册';

        if (isset($_POST['dosubmit']) && $_POST['dosubmit'] == 1) {
            $this->load->model('user');

            $message = array();
            $username = trim($this->input->post('regname'));
            $regtruename = trim($this->input->post('regtruename'));
            $email = trim($this->input->post('regemail'));
            $password = trim($this->input->post('regpwd1'));
            $password2 = trim($this->input->post('regpwd2'));
            $regcardno = trim($this->input->post('regcardno'));
            $yzcode = trim($this->input->post('yzcode'));
            $businesscard=trim($this->input->post('image_url'));
            $urll = trim($this->input->post('urll'));
            //验证用户名
            if (!$this->check_name(array('user_name' => $username))) {
                $this->showmessage('error', '手机号码已存在!', HTTP_REFERER);
                return;
            }
            if ($password != $password2) {
                $this->showmessage('error', '两次输入的密码不一致!', HTTP_REFERER);
                return;
            }
            //验证邮箱
            if (!$this->check_member(array('email' => $email))) {
                $this->showmessage('error', '邮箱已被注册，请更换!', HTTP_REFERER);
                return;
            }
            //验证码
            if ($this->session->userdata('login_verifycode') != strtolower($yzcode)) {//判断验证码
                $this->showmessage('error', '输入的验证码错误！', HTTP_REFERER);
                return;
            }
            //名片
            if($businesscard==""){
                 $this->showmessage('error', '请上传名片！', HTTP_REFERER);
                 return;
            }

            //保存临时数据
            $this->session->set_userdata('temp_regname', $username);
            $this->session->set_userdata('temp_truename', $regtruename);
            $this->session->set_userdata('temp_regemail', $email);
            $this->session->set_userdata('temp_regpwd1', $password);
            $this->session->set_userdata('temp_regpwd2', $password2);
            $this->session->set_userdata('temp_regcardno', $regcardno);
            $this->session->set_userdata('temp_businesscard', $businesscard);

            redirect(base_url() . 'index.php?c=customer&a=yzphone');
            return '';
        } else {
            $user_id = isset($this->session->userdata['member_user_id']) ? $this->session->userdata['member_user_id'] : 0;
            if ($user_id > 0) {//表示已经登录，不能注册
                $this->showmessage('success', '您已经登录成功！', base_url());
                redirect(base_url());
                return '';
            }
            $urll = $this->input->get_post('urll');
            $urll = empty($urll) ? '' : urlencode($urll);
            $data['urll'] = $urll;
            //网站基本设置
            $setup_setting = getcache('setup', 'commons');
            $this->seo_title = "会员注册 - " . $setup_setting['site_title'];
            $this->view('user_register', $data);
        }
    }

    public function register222shuangniao() {
        $this->seosetup['keywords'] = '注册';
        $this->seosetup['description'] = '注册';

        if (isset($_POST['dosubmit']) && $_POST['dosubmit'] == 1) {
            $this->load->model('user');

            $message = array();
            $username = trim($this->input->post('regname'));
            $regtruename = trim($this->input->post('regtruename'));
            $email = trim($this->input->post('regemail'));
            $password = trim($this->input->post('regpwd1'));
            $password2 = trim($this->input->post('regpwd2'));
            $regcardno = trim($this->input->post('regcardno'));
            $yzcode = trim($this->input->post('yzcode'));

            $urll = trim($this->input->post('urll'));

            //验证用户名
            if (!$this->check_name(array('user_name' => $username))) {
                $this->showmessage('error', '手机号码已存在!', HTTP_REFERER);
                return;
            }
            if ($password != $password2) {
                $this->showmessage('error', '两次输入的密码不一致!', HTTP_REFERER);
                return;
            }
            //验证邮箱
            if (!$this->check_member(array('email' => $email))) {
                $this->showmessage('error', '邮箱已被注册，请更换!', HTTP_REFERER);
                return;
            }
            //验证码
            if ($this->session->userdata('login_verifycode') != strtolower($yzcode)) {//判断验证码
                $this->showmessage('error', '输入的验证码错误！', HTTP_REFERER);
                return;
            }

            $_data['email'] = $email;
            $_data['phone'] = $username;
            $_data['username'] = $username;
            $_data['iscate'] = 1;
            $_data['ischeck'] = 0;
            $_data['cardno'] = '';
            $_data['truename'] = $regtruename;
            $_data['province_id'] = '';
            $_data['city_id'] = '';
            $_data['area_id'] = '';
            $_data['address'] = '';
            $_data['cardno'] = $regcardno;
            //默认头像
            $_data['head_ico'] = 'statics/default/images/head_ico.gif';
            $_data['sex'] = 0;
            $_data['birthday'] = '';
            $random_num = random(6, 'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
            $_data['password'] = md5(md5($password . $random_num));
            $_data['random'] = $random_num;
            $_data['qq'] = '';
            $_data['group'] = 0;
            $_data['isclose'] = 0;
            $_data['msn'] = '';
            $_data['ww'] = '';
            $_data['login_num'] = 1;
            $_data['register_time'] = SYS_TIME;
            $_data['login_time'] = SYS_TIME;
            $_data['last_login_time'] = SYS_TIME;
            $_data['login_ip'] = $this->input->ip_address();
            $_data['last_login_ip'] = $this->input->ip_address();

            $user_id = $this->user->add($_data, 'user');
            if ($user_id > 0) {//注册成功
//				$loghash = random(6,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
//				$ses_data = array('member_user_id'=>$user_id,
//							'member_username'=>$username,
//							'member_role_id'=>0,//$r['role_id'],
//							'member_site_id'=>0,//$r['site_id'],
//							'member_login'=>'logined',
//							'onhash'=>$loghash
//						);
//				$this->session->set_userdata($ses_data);
                $this->showmessage('success', '注册成功，请验证手机号码！', base_url() . 'index.php?c=customer&a=yzphone');
                return '';
            } else {
                $this->showmessage('error', '注册失败!', HTTP_REFERER);
                return '';
            }
        } else {
            $user_id = isset($this->session->userdata['member_user_id']) ? $this->session->userdata['member_user_id'] : 0;
            if ($user_id > 0) {//表示已经登录，不能注册
                $this->showmessage('success', '您已经登录成功！', base_url());
                redirect(base_url());
                return '';
            }
            $urll = $this->input->get_post('urll');
            $urll = empty($urll) ? '' : urlencode($urll);
            $data['urll'] = $urll;
            //网站基本设置
            $setup_setting = getcache('setup', 'commons');
            $this->seo_title = "客户专区-注册 - " . $setup_setting['site_title'];
            $this->view('user_register', $data);
        }
    }

    public function yzphone() {
        $this->seosetup['keywords'] = '注册';
        $this->seosetup['description'] = '注册';

        if (isset($_POST['dosubmit']) && $_POST['dosubmit'] == 1) {
            $this->load->model('user');

            $message = array();
            $username = trim($this->input->post('temp_regname'));
            $regtruename = trim($this->input->post('temp_truename'));
            $email = trim($this->input->post('temp_regemail'));
            $password = trim($this->input->post('temp_regpwd1'));
            $password2 = trim($this->input->post('temp_regpwd2'));
            $regcardno = trim($this->input->post('temp_regcardno'));
            $businesscard = trim($this->input->post('temp_businesscard'));
            $msn = trim($this->input->post('new_rec'));
            $urll = trim($this->input->post('urll'));
            $checkcode = trim($this->input->post('checkcode'));

            //验证用户名
            if (!$this->check_name(array('user_name' => $username))) {
                $this->showmessage('error', '手机号码已存在!', HTTP_REFERER);
                return;
            }
            if ($password != $password2) {
                $this->showmessage('error', '两次输入的密码不一致!', HTTP_REFERER);
                return;
            }
            //验证邮箱
            if (!$this->check_member(array('email' => $email))) {
                $this->showmessage('error', '邮箱已被注册，请更换!', HTTP_REFERER);
                return;
            }
            //验证手机验证码
            $this->load->model('a_phone_code');
            $phonecode=$this->a_phone_code->getcode($checkcode,$username);
            if (empty($phonecode)) {
                $this->showmessage('error', '手机验证码错误!', HTTP_REFERER);
                return;
            }

            $_data['email'] = $email;
            $_data['phone'] = $username;
            $_data['username'] = $username;
            $_data['iscate'] = 1;
            $_data['ischeck'] = 0;
            $_data['cardno'] = '';
            $_data['truename'] = $regtruename;
            $_data['province_id'] = '';
            $_data['city_id'] = '';
            $_data['area_id'] = '';
            $_data['address'] = '';
            $_data['cardno'] = $regcardno;
            $_data['businesscard']=$businesscard;
            //默认头像
            $_data['head_ico'] = 'statics/default/images/head_ico.gif';
            $_data['sex'] = 0;
            $_data['birthday'] = '';
            $random_num = random(6, 'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
            $_data['password'] = md5(md5($password . $random_num));
            $_data['random'] = $random_num;
            $_data['qq'] = '';
            $_data['group'] = 0;
            $_data['isclose'] = 1;
            $_data['msn'] = $msn;
            $_data['ww'] = '';
            $_data['login_num'] = 1;
            $_data['register_time'] = SYS_TIME;
            $_data['login_time'] = SYS_TIME;
            $_data['last_login_time'] = SYS_TIME;
            $_data['login_ip'] = $this->input->ip_address();
            $_data['last_login_ip'] = $this->input->ip_address();
            $_data['available_predeposit']=50;
            $user_id = $this->user->add($_data, 'user');
            if ($user_id > 0) {//注册成功
                $codedata=array(
                    'status'=>2
                );
                $this->a_phone_code->editCodeStatus($codedata,$phonecode->id);
                //添加资金变动记录
                $datacharge=array(
                    'member_name'=>$regtruename,
                    'member_email'=>$email,
                    'member_id'=>$user_id,
                    'province_id'=>0,
                    'money_total'=>$_data['available_predeposit'],
                    'money_type'=>"注册赠送",
                    'money_time'=>date('Y-m-d',  time()),
                    'poster'=>0,
                    'add_time'=>SYS_TIME
                );
                $user_id = $this->user->add($datacharge, 'user_charge');
                $this->showmessage('success', '注册成功，请登录！', base_url() . 'index.php?c=customer&a=login');
                return '';
            } else {
                $this->showmessage('error', '注册失败!', HTTP_REFERER);
                return '';
            }
        } else {
            $user_id = isset($this->session->userdata['member_user_id']) ? $this->session->userdata['member_user_id'] : 0;
            if ($user_id > 0) {//表示已经登录，不能注册
                $this->showmessage('success', '您已经登录成功！', base_url());
                redirect(base_url());
                return '';
            }
            $urll = $this->input->get_post('urll');
            $urll = empty($urll) ? '' : urlencode($urll);
            $data['urll'] = $urll;
            $data['temp_regname'] = isset($this->session->userdata['temp_regname']) ? $this->session->userdata['temp_regname'] : "";
            $data['temp_truename'] = isset($this->session->userdata['temp_truename']) ? $this->session->userdata['temp_truename'] : "";
            $data['temp_regemail'] = isset($this->session->userdata['temp_regemail']) ? $this->session->userdata['temp_regemail'] : "";
            $data['temp_regpwd1'] = isset($this->session->userdata['temp_regpwd1']) ? $this->session->userdata['temp_regpwd1'] : "";
            $data['temp_regpwd2'] = isset($this->session->userdata['temp_regpwd2']) ? $this->session->userdata['temp_regpwd2'] : "";
            $data['temp_regcardno'] = isset($this->session->userdata['temp_regcardno']) ? $this->session->userdata['temp_regcardno'] : "";
            $data['temp_businesscard'] = isset($this->session->userdata['temp_businesscard']) ? $this->session->userdata['temp_businesscard'] : "";

            //网站基本设置
            $setup_setting = getcache('setup', 'commons');
            $this->seo_title = "客户专区-注册 - " . $setup_setting['site_title'];
            $this->view('user_yzphone', $data);
        }
    }

    public function ajax_check_login() {
        $data['msg'] = '0';
        if (isset($this->session->userdata['member_user_id']) && intval($this->session->userdata['member_user_id'] > 0)) {
            $data['msg'] = '1';
        }
        echo cc_json_encode($data);
    }

    /**
     * ajax验证用户名
     */
    public function ajax_check_member() {
        $user_name = $this->input->post('user_name');
        $register_type = $this->input->post('register_type');
        $data['user_name'] = $user_name;
        $data['register_type'] = $register_type;
        if ($this->check_member($data)) {
            echo '0';
        } else {
            echo '1';
        }
    }

    /**
     * 验证用户名
     */
    private function check_name($data) {
        $user_name = $data['user_name'];
        if (!empty($user_name)) {
            $user_name = trim($user_name);
            $this->load->model('user');
            $where = array('username' => $user_name);
            $con = $this->user->count($where, 'user');
            if (intval($con) > 0) {
                return false;
            } else {
                return true;
            }
        }
        return false;
    }

    /**
     * 验证邮箱
     */
    private function check_member($data) {
        $user_name = $data['email'];
        if (!empty($user_name)) {
            $user_name = trim($user_name);
            $this->load->model('user');
            $where = array('email' => $user_name);
            $con = $this->user->count($where, 'user');
            if (intval($con) > 0) {
                return false;
            } else {
                return true;
            }
        }
        return false;
    }

    /**
     * ajax验证邮箱
     */
    public function ajax_check_email() {
        $email = $this->input->get('email');
        $column = $this->input->get('column');
        $data['email'] = $email;
        if ($column == 1 && $this->check_email($data)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * ajax验证吗
     */
    public function ajax_check_captcha() {
        $captcha = trim($this->input->get('captcha'));
        $login_verifycode = $this->session->userdata('login_verifycode');
        if ($login_verifycode == strtolower($captcha)) {//判断验证码
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * 注销用户
     */
    function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php?c=customer&a=login');
    }

    /**
     * 忘记密码
     */
    function forget_password() {
        if (isset($_POST['dosubmit']) && $_POST['dosubmit'] == 1) {
            $regname = $this->input->post('regname');
            $user_email = "";
            $where = array('sts' => '0', 'isclose' => '1', 'ischeck' => '1');
            $where2 = array('sts' => '0', 'isclose' => '1', 'ischeck' => '1');
            $where['email'] = $regname;
            $where2['username'] = $regname;
            $user_info = $this->a_com_model->get_one($where, 'user');
            $user_info2 = $this->a_com_model->get_one($where2, 'user');

            if (empty($user_info) && empty($user_info2) && empty($regname)) {
                //网站基本设置
                $setup_setting = getcache('setup', 'commons');
                $this->seo_title = "找回密码 - 客户专区 - " . $setup_setting['site_title'];
                $this->view('forget_password');
            } else {
                $user_email = empty($user_info2) ? $user_info['email'] : $user_info2['email'];
                $random_num = empty($user_info2) ? $user_info['random'] : $user_info2['random'];
                $user_id = empty($user_info2) ? $user_info['user_id'] : $user_info2['user_id'];
                //发送邮件验证
                $token = md5(md5($user_email . $random_num));
                $email_link = base_url() . 'index.php?c=customer&a=modify_password&uid=' . $user_id . '&token=' . $token;
                $email_setup = getcache('email_setup', 'commons');
                $email_setup['email_test'] = $user_email;
                $email_setup['email_link'] = $email_link;
                $result = $this->send_email($email_setup);
                $this->showmessage('success', '系统已经成功发送重置密码确认邮件到:' . $user_email . '！');
            }
        } else {
            //网站基本设置
            $setup_setting = getcache('setup', 'commons');
            $this->seo_title = "找回密码 - 客户专区 - " . $setup_setting['site_title'];
            $this->view('forget_password');
        }
    }

    /* 发送邮件---ok */

    public function send_email($data) {
        $this->load->library('email');
        $email_enabled = $data['email_enabled'];

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $data['email_host'];
        $config['smtp_user'] = $data['email_id'];
        $config['smtp_pass'] = $data['email_pass'];
        $config['smtp_port'] = $data['email_port'];
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $email_addr = $data['email_addr'];
        $email_test = $data['email_test'];
        $email_link = $data['email_link'];

        $this->email->from($email_addr, '双鸟机械');
        $this->email->to($email_test);
        $this->email->subject('请完成双鸟机械邮箱确认！');
        $this->email->message('亲爱的会员：<br>您好，这是一封找回密码确认邮件。<br>请点击以下链接完成确认:<a href="' . $email_link . '" target="_blank">' . $email_link . '<br>如果链接不能点击，请复制地址到浏览器，然后直接打开。');

        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function modify_password() {
        if (isset($_POST['dosubmit']) && $_POST['dosubmit'] == 1) {
            $uid = $this->input->get_post('uid');
            $uemail = $this->input->get_post('uemail');
            $newpwd1 = $this->input->get_post('newpwd1');
            $where = array('sts' => '0', 'isclose' => '1', 'user_id' => $uid);
            $user_info = $this->a_com_model->get_one($where, 'user');
            $random = $user_info['random'];
            $password = md5(md5($newpwd1 . $random));
            $this->a_com_model->update(array('user_id' => $uid), array('password' => $password), 'user');
            $this->showmessage('success', '密码修改成功，请登录!', 'index.php?c=customer&a=login');
        } else {
            //传来一个32位的验证码和一个可以验证的唯一user信息
            $uid = $this->input->get('uid');
            $token = $this->input->get('token');
            $data = array('uid' => $uid, 'token' => $token);
            $rs = $this->check_uuid($data);
            if ($rs == 1) {
                $where = array('sts' => '0', 'isclose' => '1', 'user_id' => $uid);
                $user_info = $this->a_com_model->get_one($where, 'user');
                $data['user_info'] = $user_info;
                //网站基本设置
                $setup_setting = getcache('setup', 'commons');
                $this->seo_title = "找回密码 - 客户专区 - " . $setup_setting['site_title'];
                $this->view('modify_password', $data);
            } else {
                //网站基本设置
                $setup_setting = getcache('setup', 'commons');
                $this->seo_title = "找回密码 - 客户专区 - " . $setup_setting['site_title'];
                $this->view('forget_password');
            }
        }
    }

    public function user_resetPassword() {
        $uuid = $this->input->get_post('uuid');
        $newPsd1 = $this->input->get_post('newPsd1');
        $arr = array();
        $rs = $this->check_uuid($uuid);
        if (strlen($newPsd1) < 6 || strlen($newPsd1) > 32) {
            $arr['psd_msg'] = '3';
        } elseif ($rs == -1) {
            $arr['psd_msg'] = '1';
        } elseif ($rs == -2) {
            $arr['psd_msg'] = '2';
        } elseif ($rs == -3) {
            $arr['psd_msg'] = '5';
        } elseif ($rs == -4) {
            $arr['psd_msg'] = '4';
        } else if ($rs == 1 && strlen($newPsd1) > 6 || strlen($newPsd1) < 32) {
            $email = substr($uuid, 32);
            $random = random(6, uniqid());
            $password = md5(md5($newPsd1 . $random));
            $this->a_com_model->update(array('email' => $email), array('validateCode' => '', 'random' => $random, 'password' => $password), 'user');
            $arr['psd_msg'] = '0';
        } else {
            $arr['psd_msg'] = '未知错误';
        }
        echo json_encode($arr);
    }

    /**
     * -1 id为空
     * -2 code 为空
     * -3 验证码错误
     * -4 没有此用户
     * Enter description here ...
     * @param unknown_type $uuid
     */
    private function check_uuid($data) {
        if (empty($data)) {
            return -1;
        } else {
            $uid = $data['uid'];
            $token = $data['token'];
            $where = array('sts' => '0', 'isclose' => '1', 'user_id' => $uid);
            $user_info = $this->a_com_model->get_one($where, 'user');
            if (!empty($user_info)) {
                $random = $user_info['random'];
                $user_email = $user_info['email'];
                if (empty($token)) {
                    return -2;
                } elseif ($token != md5(md5($user_email . $random))) {
                    return -3;
                } else {
                    return 1;
                }
            } else {
                return -4;
            }
        }
    }

    public function error() {
        $data['msg'] = '测试';
        $this->view('show_message', $data);
    }

}
