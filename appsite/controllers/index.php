<?php

if (!defined('SITEPHP'))
    exit('No direct script access allowed');

class Index extends Site_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('a_com_model');
        $this->load->model('a_caifu_model');
    }

    public function index() {
        //网站基本设置
        $setup_setting = getcache('setup', 'commons');
        $seosetup_setting = getcache('seo_setup', 'commons');

        $this->seo_title = empty($setup_setting['site_title']) ? '浙江双鸟机械有限公司' : $setup_setting['site_title'];
        $this->seo_keywords = empty($seosetup_setting['site_keywords']) ? '双鸟机械' : $seosetup_setting['site_keywords'];
        $this->seo_description = empty($seosetup_setting['site_description']) ? '浙江双鸟机械有限公司' : $seosetup_setting['site_description'];

        $hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
        $hot_arr = array();
        if (!empty($hot_search)) {
            $hot_arr = explode(",", $hot_search);
        }
        //导航及数量
        $nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'category');
        foreach ($nav_category as $key => $val) {
            $cateid = $val['column_value'];
            $where = array('category' => $cateid);
            $con = $this->a_caifu_model->count($where, 'caifu_product');
            $nav_category[$key]['numbs'] = intval($con);
        }

        $data = array();
        $data['nav_category'] = $nav_category;
        $data['current_nav'] = "index";
        $data['hot_arr'] = $hot_arr;
        //$data['friend_list'] = $this->a_com_model->get_query(array('sts'=>0, 'order_by'=>'listorder asc'), 'cooperative');
        $this->view('index', $data);
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
            $urll = $urll ? $urll : '/';
            $callback['urll'] = urldecode($urll);
            $this->load->model('user');

            $where = array('sts' => '0', 'isclose' => '1');
            $type = "email";
            $where['email'] = $username;

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


            $this->pointlogin($r['user_id'], $r['username'], $r['points'], $r['current_points'], $r['group'], $r['login_num']);

            $callback['loginMsg'] = '0';
            $this->showmessage('success', '您已经登录成功！', base_url() . 'index.php?m=member&c=user&a=index');
            redirect(base_url() . 'index.php?m=member&c=user&a=index');
            return '';
        } else {
            $user_id = isset($this->session->userdata['member_user_id']) ? $this->session->userdata['member_user_id'] : 0;
            if ($user_id > 0) {//表示已经登录，不需要重新登录
                $this->showmessage('success', '您已经登录成功！');
                return '';
            }
            $urll = $this->input->get_post('urll');
            $urll = empty($urll) ? '' : urlencode($urll);
            $data['urll'] = $urll;
            $this->load->helper('captcha');
            //$img=create_captcha();
            $this->view('user_showlogin', $data);
        }
    }

    public function register() {
        $this->seosetup['keywords'] = '注册';
        $this->seosetup['description'] = '注册';
        if (isset($_POST['dosubmit']) && $_POST['dosubmit'] == 1) {
            $this->load->model('user');

            $message = array();
            $username = trim($this->input->post('regname_email'));
            $type = $this->input->post('cate');
            $isvol = $this->input->post('isvol');
            $password = trim($this->input->post('regpsd1_email'));
            $password2 = trim($this->input->post('regpsd2_email'));

            $urll = trim($this->input->post('urll'));
            //验证用户名
            if (!$this->check_member(array('user_name' => $username))) {
                $this->showmessage('error', '用户名已存在', HTTP_REFERER);
                return;
            }
            if ($password != $password2) {
                $this->showmessage('error', '两次输入的密码不一致', HTTP_REFERER);
                return;
            }

            $_data['email'] = $username;
            $_data['phone'] = '';
            $_data['username'] = $username;
            $_data['iscate'] = $type;
            $_data['isvol'] = $isvol;
            $_data['cardno'] = '';
            $_data['truename'] = '';
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
            if ($type == 1) {
                $_dataext['userid'] = $user_id;
                $this->user->add($_dataext, 'user_chaoren');
            } else {
                $_dataext['userid'] = $user_id;
                $this->user->add($_dataext, 'user_zuzhi');
            }
            if ($user_id > 0) {//注册成功
                //发送邮件验证
                $token = md5(md5($username . $random_num));
                $email_link = 'http://demo.chaoren.com/index.php?c=index&a=check_email&uid=' . $user_id . '&token=' . $token;
                $email_setup = getcache('email_setup', 'commons');
                $email_setup['email_test'] = $username;
                $email_setup['email_link'] = $email_link;
                $result = $this->send_email($email_setup);
                $ddata['user_email'] = $username;
                $this->showmessagetpl('success', lang('com_register_error'), HTTP_REFERER, 'show_message_register', '', '', $ddata);
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
            $this->view('user_showReg', $data);
        }
    }

    /* 邮箱确认 */

    public function check_email() {
        $userid = $this->input->get('uid');
        $token = $this->input->get('token');

        $this->load->model('user');
        $where = array('sts' => '0', 'user_id' => $userid);
        //帐号是否存在
        $r = $this->user->get_one($where, 'user');
        if (!$r) {
            $this->showmessage('error', '用户名不存在', base_url() . 'index.php?c=index&a=login');
            return;
        }
        if (!empty($r['isclose'])) {
            $this->showmessage('error', '邮箱已验证，请登录！', base_url() . 'index.php?c=index&a=login');
            return;
        }
        if ($token == md5(md5($r['username'] . $r['random']))) {
            $this->user->update(array('user_id' => $userid), array('isclose' => 1), 'user');
            $this->showmessage('success', '邮箱验证成功，请登录！', base_url() . 'index.php?c=index&a=login');
            return;
        } else {
            $this->showmessage('error', '链接失效，请重新验证！', base_url() . 'index.php?c=index&a=login');
            return;
        }
    }

    public function ajax_check_login() {
        $data['msg'] = '0';
        if (isset($this->session->userdata['member_user_id']) && intval($this->session->userdata['member_user_id'] > 0)) {
            $data['msg'] = '1';
        }
        echo cc_json_encode($data);
    }

    public function register2() {
        $this->seosetup['keywords'] = '注册';
        $this->seosetup['description'] = '注册';
        if (isset($_POST['dosubmit']) && $_POST['dosubmit'] == 1) {
            $this->load->model('user');

            //获取登录
            $group = $this->user->get_one(array('minexp' => 0), 'user_group');

            $message = array();
            $username = trim($this->input->post('user_name'));
            $type = $this->input->post('user_type');
            $password = trim($this->input->post('regpsd1'));
            $password2 = trim($this->input->post('regpsd2'));
            $validateCode = trim($this->input->post('validateCode'));
            $urll = trim($this->input->post('urll'));
            if ($type == 'phone') {
                if (!preg_match('/^(13|15|18)[0-9]{9}$/', $username)) {
                    $message['registMsg'] = '1';
                    echo json_encode($message);
                    die();
                }
            } else {
                if (!preg_match('/^[a-z0-9_\-]+(\.[_a-z0-9\-]+)*@([_a-z0-9\-]+\.)+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)$/', $username)) {
                    $message['registMsg'] = '1';
                    echo json_encode($message);
                    die();
                }
            }

            //验证用户名
            if (!$this->check_member(array('user_name' => $username, 'register_type' => $type))) {
                //$this->showmessage('error',lang('com_user_name_error'),HTTP_REFERER);
                $message['registMsg'] = '4';
                echo json_encode($message);
                die();
            }

            if ($password != $password2) {
                $message['registMsg'] = '3';
                echo json_encode($message);
                die();
            }

            //验证码
            if ($this->session->userdata('login_verifycode') != strtolower($validateCode)) {//判断验证码
                $message['registMsg'] = '9';
                echo json_encode($message);
                die();
            }

            if ($type == 'phone') {
                $_data['phone'] = $username;
                $_data['email'] = '';
            } else {
                $_data['email'] = $username;
                $_data['phone'] = '';
            }
            $_data['username'] = $username;
            $_data['cardno'] = '';
            $_data['truename'] = '';
            //默认头像
            $_data['head_ico'] = 'statics/default/images/account/head_ico.gif';
            $_data['sex'] = 0;
            $_data['birthday'] = '';
            $random_num = random(6, 'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
            $_data['password'] = md5(md5($password . $random_num));
            $_data['random'] = $random_num;
            //$_data['email']=strtolower($email);
            $_data['qq'] = '';
            $_data['group'] = intval($group['id']);
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
                $loghash = random(6, 'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
                $ses_data = array('member_user_id' => $user_id,
                    'member_username' => $username,
                    'member_role_id' => 0, //$r['role_id'],
                    'member_site_id' => 0, //$r['site_id'],
                    'member_login' => 'logined',
                    'onhash' => $loghash
                );
                $this->session->set_userdata($ses_data);

                /*                 * ***注册 添加积分Start************** */
                $points_setting = getcache('points_setting', 'commons', 'file', 'array');
                $pointer_num1 = 0;
                $pointer_num2 = 0;
                if (isset($points_setting['points_reg']) && floatval($points_setting['points_reg']) > 0) {
                    $pointer_num1 = $points_setting['points_reg'];
                    $pglog['pl_memberid'] = $user_id;
                    $pglog['pl_membername'] = $username;
                    $pglog['pl_adminid'] = 0;
                    $pglog['pl_adminname'] = '';
                    $pglog['pl_points'] = intval($pointer_num1);
                    $pglog['pl_addtime'] = time();
                    $pglog['pl_desc'] = '注册';
                    $pglog['pl_stage'] = 'regist';
                    $pglog['sts'] = 0;
                    $this->user->add($pglog, 'points_log');
                }

                if (isset($points_setting['points_login']) && floatval($points_setting['points_login']) > 0) {
                    $pointer_num2 = $points_setting['points_login'];
                    $pglog['pl_memberid'] = $user_id;
                    $pglog['pl_membername'] = $username;
                    $pglog['pl_adminid'] = 0;
                    $pglog['pl_adminname'] = '';
                    $pglog['pl_points'] = intval($pointer_num2);
                    $pglog['pl_addtime'] = time();
                    $pglog['pl_desc'] = '登录';
                    $pglog['pl_stage'] = 'login';
                    $pglog['sts'] = 0;
                    $this->user->add($pglog, 'points_log');
                }

                /*                 * ***注册 添加积分End************** */
                $pointer_num = intval($pointer_num1) + intval($pointer_num2);
                $this->user->update(array('user_id' => $user_id), array('last_login_ip' => ip(), 'last_login_time' => time(), 'points' => $pointer_num, 'current_points' => $pointer_num), 'user');
                $message['registMsg'] = '0';
                $message['urll'] = $urll ? urldecode($urll) : '/';
                echo json_encode($message);
            } else {
                $this->showmessage('error', lang('com_register_error'), HTTP_REFERER);
                return '';
            }
        } else {
            $user_id = isset($this->session->userdata['member_user_id']) ? $this->session->userdata['member_user_id'] : 0;
            if ($user_id > 0) {//表示已经登录，不能注册
                //$this->showmessage('success','您已经登录成功！',base_url());
                redirect(base_url());
                return '';
            }
            $urll = $this->input->get_post('urll');
            $urll = empty($urll) ? '' : urlencode($urll);
            $data['urll'] = $urll;
            $this->view('user_showReg', $data);
        }
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
    private function check_member($data) {
        $user_name = $data['user_name'];
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
        redirect(base_url() . 'index.php?c=index&a=login');
    }

    private function rewrite_adv_url() {
        $this->load->model('s_brand_model');
        $list = $this->s_brand_model->get_query(array('adv_id >' => 0), 'adv');
        foreach ($list as $v) {
            if (!empty($v['adv_content'])) {
                $adv_content = unserialize($v['adv_content']);
                if (isset($adv_content['adv_slide_pic'])) {
                    $arr['adv_slide_pic'] = 'uploadfile/adv/' . $adv_content['adv_slide_pic'];
                    $arr['adv_slide_url'] = '';
                    $re_adv_content = serialize($arr);
                    //$this->s_brand_model->update(array('adv_id'=>$v['adv_id']),array('adv_content'=>$re_adv_content),'adv');
                    unset($arr);
                }
                if (isset($adv_content['adv_pic'])) {
                    $arr['adv_pic'] = 'uploadfile/adv/' . $adv_content['adv_pic'];
                    $arr['adv_pic_url'] = '';
                    $re_adv_content = serialize($arr);
                    //$this->s_brand_model->update(array('adv_id'=>$v['adv_id']),array('adv_content'=>$re_adv_content),'adv');
                    unset($arr);
                }
            }
        }
    }

    /**
     * 忘记密码
     */
    function forget_password() {
        $this->view('forget_password');
    }

    function ajax_findPassword() {
        $username = $this->input->get('userName');
        $validateCode = $this->input->get('validateCode');
        $arr = array();
        if ($this->session->userdata('password_verifycode') != $validateCode) {
            $arr['checkPassword'] = '1';
        }
        $where = array('sts' => '0');
        if (is_numeric($username)) {
            $type = "phone";
            $where['phone'] = $username;
        } else {
            $type = "email";
            $where['email'] = $username;
        }
        $user_info = $this->a_com_model->get_one($where, 'user');
        if (empty($user_info)) {
            $arr['checkPassword'] = '2';
        } elseif ($user_info['isclose'] != 1) {
            $arr['checkPassword'] = '-1';
        }
        if (!isset($arr['checkPassword'])) {
            $arr['checkPassword'] = 'yes';
        }
        echo json_encode($arr);
    }

    public function findPassword() {
        $email = $this->input->post('t_email');
        $where = array('sts' => '0', 'isclose' => '1');
        $where['email'] = $email;
        $user_info = $this->a_com_model->get_one($where, 'user');
        if (!$user_info || !$email) {
            $this->view('forget_password');
        } else {
            $t = time();
            $vc = md5(uniqid() . $email . time());
            $this->a_com_model->update($where, array('validateCode' => $vc . $t), 'user');
            //email $vc.$email;
            $data['email'] = $email;
            $this->view('user_findEmailPasswordSendMail', $data);
        }
    }

    public function modifyPassword() {
        //传来一个32位的验证码和一个可以验证的唯一user信息
        $uuid = $this->input->get_post('uuid');
        $rs = $this->check_uuid($uuid);
        if ($rs == 1) {
            $data['uuid'] = $uuid;
            $this->view('modify_password', $data);
        } else {
            $this->view('forget_password');
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
     * -1 uuid 错误
     * -2 validate code 错误
     * -3 超过24小时的错误
     * -4 没有此用户
     * Enter description here ...
     * @param unknown_type $uuid
     */
    private function check_uuid($uuid) {
        if (!$uuid) {
            return -1;
        } else {
            $email = substr($uuid, 32); //不一定是email 至少不是明文email 需要修改
            $where = array('sts' => '0', 'isclose' => '1', 'email' => $email);
            $user_info = $this->a_com_model->get_one($where, 'user');
            if ($user_info) {
                $db_validateCode = $user_info['validateCode'];
                $validateCode = substr($db_validateCode, 0, 32);
                $time = substr($db_validateCode, 32);
                if (!$validateCode || $validateCode != substr($uuid, 0, 32)) {
                    return -2;
                } elseif ($time + 24 * 60 * 60 < time()) {
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

    /*     * *
     * 用户登录成功后积分增加
     */

    private function pointlogin($userid, $username, $points, $current_points, $group, $login_num = 0) {
        $where = array('last_login_ip' => ip(), 'last_login_time' => time(), 'login_num' => ($login_num + 1));
        /*         * ***每天登录 添加积分Start************** */
        $points_setting = getcache('points_setting', 'commons', 'file', 'array');
        $pointer_num = 0;
        if (isset($points_setting['points_login']) && floatval($points_setting['points_login']) > 0) {
            $nowdata = date('Y-m-d', time());
            $stime = strtotime($nowdata);
            $etime = strtotime($nowdata . ' 23:59:59');
            $points_log_info = $this->user->get_one(array('pl_memberid' => $userid, 'pl_stage' => 'login', 'pl_addtime >' => $stime, 'pl_addtime <' => $etime), 'points_log');
            if (empty($points_log_info)) {
                $pglog['pl_memberid'] = $userid;
                $pglog['pl_membername'] = $username;
                $pglog['pl_adminid'] = 0;
                $pglog['pl_adminname'] = '';
                $pglog['pl_points'] = floatval($points_setting['points_login']);
                $pglog['pl_addtime'] = time();
                $pglog['pl_desc'] = '登录';
                $pglog['pl_stage'] = 'login';
                $pglog['sts'] = 0;
                $this->user->add($pglog, 'points_log');
                $pointer_num = floatval($points_setting['points_login']);

                $where['points'] = ($points + $pointer_num);
                $where['current_points'] = ($current_points + $pointer_num);

                //需要每次去取吗？alex for question
                /*                 * $temp_pointer = intval($points+$pointer_num);
                  $group = $this->user->get_one(array('minexp <='=>$temp_pointer, 'maxexp >='=>$temp_pointer), 'user_group');
                  if (intval($group['id']) !== intval($group)) {
                  $where['group'] = $group;
                  }
                 */
            }
        }
        /*         * ***每天登录 添加积分End************** */
        $this->user->update(array('user_id' => $userid), $where, 'user');
    }

    public function getjd() {
        $id = $this->input->get('id');
        $product_info = $this->a_caifu_model->get_one(array('id' => $id), 'caifu_product');
        $data['product_info'] = $product_info;
        $this->view('getjd', $data);
    }

    public function get_email_tmpl() {
        $id = $this->input->get('id');
        $product_info = $this->a_caifu_model->get_one(array('id' => $id), 'caifu_product');
        $product_info['interest_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'interest', $product_info['interest']);
        $product_info['category_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'category', $product_info['category']);
        $product_info['investment_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'investment', $product_info['investment']);
        $product_info['earning_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'earning', $product_info['earning']);
        $data['product_info'] = $product_info;
        $this->view('email_tmpl', $data);
    }

    public function stemail() {
        $pid = $this->input->get('mid');
        $mmail = $this->input->get('mmail');
        $url = base_url() . 'index.php?c=index&a=get_email_tmpl&id=' . $pid;
        $product_info = $this->a_caifu_model->get_one(array('id' => $pid), 'caifu_product');
        $message = file_get_contents($url);
        $email_setup = getcache('email_setup', 'commons');
        $config = Array(
            'protocol' => "smtp",
            'smtp_host' => $email_setup['email_host'],
            'smtp_port' => $email_setup['email_port'],
            'smtp_user' => $email_setup['email_id'],
            'smtp_pass' => $email_setup['email_pass'],
            'wordwrap' => TRUE,
            'smtp_fromName' => '财来电',
            'smtp_from' => $email_setup['email_id']
        );
       //print_r($config);exit;
        $result = $this->sendMail($mmail, '产品资料_'.$product_info['name'],$message,$config);
        if ($result) {
            echo "邮件发送成功！";
        } else {
            echo "邮件发送失败！";
        }
    }

    public function send_email_tust($data) {
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
        $email_message = $data['email_message'];

        $this->email->from($email_addr, 'Hualiangcaifu');
        $this->email->to($email_test);
        $this->email->subject('产品资料');
        $this->email->message($email_message);

        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //邮件发送
    public function sendMail($to, $subject, $message, $config) {
        if ($to != '' && $subject != '' && $message != "") {
            //抽空补上，$to邮箱验证
            $_config = Array(
                'protocol' => $config['protocol'],
                'smtp_host' => $config['smtp_host'],
                'smtp_port' => $config['smtp_port'],
                'smtp_user' => $config['smtp_user'],
                'smtp_pass' => $config['smtp_pass'],
                'wordwrap' => $config['wordwrap'],
                'charset' => "utf-8",
                'mailtype' => 'html'
            );
            $this->load->library('email', $_config);
            $this->email->set_newline("/r/n");
            $this->email->from($config['smtp_from'], $config['smtp_fromName']);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);
            //print_r($_config);exit;
            if ($this->email->send()) {
                return true;
            } else {
                //return false;
                show_error($this->CI->email->print_debugger());
            }
        } else {
            return false;
        }
    }

}
