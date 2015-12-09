<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of common
 *
 * @createtime 2015-5-13 15:22:02
 * 
 * @author ZhangPing'an
 * 
 * @todo common
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 * @todo 张平安自加公共操作库
 * 
 */
class common extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_phonecode');
    }

    /**
     * 
     * @todo 生成手机验证码 
     * 
     */
    public function creatPhoneCode() {
        $phone = trim($this->input->post('phone'));
        $msg = array('flag' => 0, 'error' => '');
        if ($phone == '') {
            $msg['error'] = "手机号码丢失发送短信失败";
            echo json_encode($msg);
            exit;
        }
        $code = rand('100000', '999999');
        $content = "您本次操作的验证码为：" . $code . "。请不要向任何无关人员提供该验证码！";
        $data = array(
            'uid' => 0,
            'phonenumber' => $phone,
            'phonecode' => $code,
            'content' => $content,
            'status' => 0,
            'trytimes' => 0,
            'passtime' => time() + 1800,
            'creattime' => time()
        );
        $id = $this->user_phonecode->add($data, 'user_phonecode');
        if ($id > 0) {
            $msg['flag'] = 1;
            $msg['error'] = '创建验证码成功，等待系统发送验证码';
        } else {
            $msg['error'] = '发送验证码失败，请联系客服处理！';
        }
        echo json_encode($msg);
    }

}
