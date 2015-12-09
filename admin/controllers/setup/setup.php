<?php

if (!defined('ADMINPHP'))
    exit('No direct script access allowed');

class Setup extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dbclass_model');
    }

    //站点设置
    public function setting() {
        if (isset($_POST['dosubmit'])) {
            $setup['site_name'] = $this->input->post('site_name');
            $setup['site_title'] = $this->input->post('site_title');
            $setup['hot_search'] = $this->input->post('hot_search');
            $setup['icp_number'] = $this->input->post('icp_number');
            $setup['statistics_code'] = $this->input->post('statistics_code');
            $setup['time_zone'] = $this->input->post('time_zone');
            $setup['site_status'] = $this->input->post('site_status');
            $setup['debug_isuse'] = $this->input->post('debug_isuse');
            if ($setup['debug_isuse'] == 0) {
                $setup['closed_reason'] = $this->input->post('closed_reason');
            }

            /*             * *保存图片** */
            $this->user_id = $this->session->userdata('admin_user_id');
            $this->load->library('iupload_lib');
            $config = array(
                'module' => 'site_logo',
                'dir' => 'logo',
                'shop_id' => $this->user_id,
                'isadmin' => 1,
            );
            $this->iupload_lib->initialize($config); //配置初始化文件
            $this->iupload_lib->do_uploadfile('site_logo'); //上传附件
            $file_id = $this->iupload_lib->save_data(); //保存数据到数据库

            if ($file_id) {
                $config['file_id'] = $file_id;
                $config['rel_id'] = '1';
                $this->iupload_lib->set($config);
                $this->iupload_lib->save_rel_data(); //保存数据到关联表
                $file_data = $this->iupload_lib->file_data();
                $setup['site_logo'] = $file_data['savepath'];
            } else {
                $setup['site_logo'] = $this->input->post('old_site_logo');
            }

            $this->load->helper('global');
            setcache('setup', $setup, 'commons');
            $this->showmessage('setting', lang('com_cache'), HTTP_REFERER);
        } else {
            $this->load->helper('global');
            $setup = getcache('setup', 'commons');
            if ($setup == FALSE) {
                $setup = array(
                    'site_name' => ' ',
                    'site_title' => ' ',
                    'hot_search' => ' ',
                    'icp_number' => ' ',
                    'statistics_code' => ' ',
                    'time_zone' => ' ',
                    'site_status' => ' ',
                    'debug_isuse' => ' ',
                    'closed_reason' => ' ',
                    'site_logo' => ' ',
                );
            }

            $this->cismarty->assign('setup', $setup);

            $this->cismarty->display('setup/setup.html');
        }
    }

    //管理相关
    public function setup_related() {
        if (isset($_POST['dosubmit'])) {
            $setup_related['guest_comment'] = $this->input->post('guest_comment');
            $setup_related['captcha_status_login'] = $this->input->post('captcha_status_login');
            $setup_related['captcha_status_register'] = $this->input->post('captcha_status_register');
            $setup_related['captcha_status_goodsqa'] = $this->input->post('captcha_status_goodsqa');

            $this->load->helper('global');
            setcache('setup_related', $setup_related, 'commons');
            $this->showmessage('setup_related', lang('com_cache'), HTTP_REFERER);
        } else {
            $this->load->helper('global');
            $setup_related = getcache('setup_related', 'commons');
            if ($setup_related == FALSE) {
                $setup_related = array(
                    'guest_comment' => ' ',
                    'captcha_status_login' => ' ',
                    'captcha_status_register' => ' ',
                    'captcha_status_goodsqa' => ' ',
                );
            }

            $this->cismarty->assign('setup_related', $setup_related);

            $this->cismarty->display('setup/setup_related.html');
        }
    }

    //上传设置
    public function img_setup() {
        if (isset($_POST['dosubmit'])) {
            $img_setup['image_dir_type'] = $this->input->post('image_dir_type');
            $img_setup['image_max_filesize'] = $this->input->post('image_max_filesize');
            $img_setup['image_allow_ext'] = $this->input->post('image_allow_ext');
            $img_setup['thumb_tiny_width'] = $this->input->post('thumb_tiny_width');
            $img_setup['thumb_tiny_height'] = $this->input->post('thumb_tiny_height');
            $img_setup['thumb_small_width'] = $this->input->post('thumb_small_width');
            $img_setup['thumb_small_height'] = $this->input->post('thumb_small_height');
            $img_setup['thumb_mid_width'] = $this->input->post('thumb_mid_width');
            $img_setup['thumb_mid_height'] = $this->input->post('thumb_mid_height');
            $img_setup['thumb_max_width'] = $this->input->post('thumb_max_width');
            $img_setup['thumb_max_height'] = $this->input->post('thumb_max_height');
            if ($img_setup['image_dir_type'] == '1') {
                $img_setup['image_dir_type_value'] = '/图片';
            } elseif ($img_setup['image_dir_type'] == '2') {
                $img_setup['image_dir_type_value'] = '/年/图片';
            } elseif ($img_setup['image_dir_type'] == '3') {
                $img_setup['image_dir_type_value'] = '/年/月/图片';
            } elseif ($img_setup['image_dir_type'] == '4') {
                $img_setup['image_dir_type_value'] = '/年/月/日/图片';
            }

            $this->load->helper('global');
            setcache('img_setup', $img_setup, 'commons');
            $this->showmessage('img_setup', lang('com_cache'), HTTP_REFERER);
        } else {
            $this->load->helper('global');
            $img_setup = getcache('img_setup', 'commons');
            if ($img_setup == FALSE) {
                $img_setup = array(
                    'image_dir_type' => ' ',
                    'image_max_filesize' => ' ',
                    'image_allow_ext' => ' ',
                    'thumb_tiny_width' => ' ',
                    'thumb_tiny_height' => ' ',
                    'thumb_small_width' => ' ',
                    'thumb_small_height' => ' ',
                    'thumb_mid_width' => ' ',
                    'thumb_mid_height' => ' ',
                    'thumb_max_width' => ' ',
                    'thumb_max_height' => ' ',
                    'image_dir_type_value' => ' ',
                );
            }

            $this->cismarty->assign('img_setup', $img_setup);

            $this->cismarty->display('setup/img_setup.html');
        }
    }

    //水印字体
    public function img_setup_font() {
        $this->cismarty->display('setup/img_setup_font.html');
    }

    //基本设置
    public function img_setup_setting() {
        if (isset($_POST['dosubmit'])) {
            if ($_FILES['default_goods_image']['error'] == 0) {
                $default_goods_image = $_FILES['default_goods_image'];
                if (isset($default_goods_image['name'])) {
                    $this->load->library('Upload_photo');
                    $this->upload_photo->config['thumb']['is_on'] = false;
                    $this->upload_photo->config['dir'] = 'uploadfile\default';
                    $goods = $this->upload_photo->run();
                }
                $img_setup_setting['default_goods_image'] = $goods['default_goods_image']['url'];
            } else {
                $img_setup_setting['default_goods_image'] = $this->input->post('old_goods_image');
            }
            if ($_FILES['default_store_logo']['error'] == 0) {
                $img_setup_setting['default_store_logo'] = $goods['default_store_logo']['url'];
            } else {
                $img_setup_setting['default_store_logo'] = $this->input->post('old_store_logo');
            }
            if ($_FILES['default_user_portrait']['error'] == 0) {
                $img_setup_setting['default_user_portrait'] = $goods['default_user_portrait']['url'];
            } else {
                $img_setup_setting['default_user_portrait'] = $this->input->post('old_user_portrait');
            }

            $this->load->helper('global');
            setcache('img_setup_setting', $img_setup_setting, 'commons');
            $this->showmessage('img_setup_setting', lang('com_cache'), HTTP_REFERER);
        } else {
            $this->load->helper('global');
            $img_setup_setting = getcache('img_setup_setting', 'commons');
            if ($img_setup_setting == FALSE) {
                $img_setup_setting = array(
                    'default_goods_image' => ' ',
                    'default_store_logo' => ' ',
                    'default_user_portrait' => ' ',
                );
            }

            $this->cismarty->assign('img_setup_setting', $img_setup_setting);

            $this->cismarty->display('setup/img_setup_setting.html');
        }
    }

    //SEO设置
    public function seo_setup() {
        if (isset($_POST['dosubmit'])) {
            $seo_setup['rewrite_enabled'] = $this->input->post('rewrite_enabled');
            $seo_setup['site_keywords'] = $this->input->post('site_keywords');
            $seo_setup['site_description'] = $this->input->post('site_description');

            $this->load->helper('global');
            setcache('seo_setup', $seo_setup, 'commons');
            $this->showmessage('seo_setup', lang('com_cache'), HTTP_REFERER);
        } else {
            $this->load->helper('global');
            $seo_setup = getcache('seo_setup', 'commons');
            if ($seo_setup == FALSE) {
                $seo_setup = array(
                    'rewrite_enabled' => ' ',
                    'site_keywords' => ' ',
                    'site_description' => ' ',
                );
            }

            $this->cismarty->assign('seo_setup', $seo_setup);

            $this->cismarty->display('setup/seo_setup.html');
        }
    }

    //Email设置
    public function email_setup() {
        if (isset($_POST['dosubmit'])) {
            $email_setup['email_host'] = $this->input->post('email_host');
            $email_setup['email_id'] = $this->input->post('email_id');
            $email_setup['email_pass'] = $this->input->post('email_pass');
            $email_setup['email_port'] = $this->input->post('email_port');
            $email_setup['email_addr'] = $this->input->post('email_addr');
            $email_setup['email_enabled'] = $this->input->post('email_enabled');

            $this->load->helper('global');
            setcache('email_setup', $email_setup, 'commons');
            $this->showmessage('email_setup', lang('com_cache'), HTTP_REFERER);
        } else {
            $this->load->helper('global');
            $email_setup = getcache('email_setup', 'commons');
            if ($email_setup == FALSE) {
                $email_setup = array(
                    'email_host' => ' ',
                    'email_id' => ' ',
                    'email_pass' => ' ',
                    'email_port' => ' ',
                    'email_addr' => ' ',
                    'email_enabled' => ' ',
                );
            }

            $this->cismarty->assign('email_setup', $email_setup);

            $this->cismarty->display('setup/email_setup.html');
        }
    }

    public function ajax_email() {
        $this->load->library('email');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $this->input->post('email_host');
        $config['smtp_user'] = $this->input->post('email_id');
        $config['smtp_pass'] = $this->input->post('email_pass');
        $config['smtp_port'] = $this->input->post('email_port');
        $config['charset'] = 'GBK';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $email_addr = $this->input->post('email_addr');
        $email_test = $this->input->post('email_test');

        $this->email->from($email_addr, $this->session->userdata('admin_username'));
        $this->email->to($email_test);
        $this->email->subject('Email Test');
        $this->email->message('<font color=red>Testing the email class.</font>');

        if ($this->email->send()) {
            //$email[0]['print'] = $this->email->print_debugger();
            $email['msg'] = 'Test message sent successfully';
        } else {
            //$email[0]['print'] = $this->email->print_debugger();
            $email['msg'] = 'Failed to send a test message';
        }
        echo json_encode($email);
    }

    public function version() {
        $version['version'] = 'shop' . date('Y.0.m');
        $version['inst_time'] = time();
        $this->load->helper('global');
        setcache('version', $version, 'commons');
    }

}
