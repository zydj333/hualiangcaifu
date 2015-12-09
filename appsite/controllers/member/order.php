<?php

if (!defined('SITEPHP'))
    exit('No direct script access allowed');

class Order extends Member_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('a_member_model');
        $this->load->model('a_caifu_model');
        $this->load->library('iupload_lib');
        $this->load->model('caifu_order');
        $this->tb_price = 'goods_price_library';
        $this->user_id = isset($this->session->userdata['member_user_id']) ? $this->session->userdata['member_user_id'] : 0;
    }

    //我要报单
    public function addorder() {
        $this->seo_title = '会员中心-我要报单';
        $this->seo_keywords = '会员中心';
        $this->seo_description = '会员中心';
        if (isset($_POST['dosubmit']) && $_POST['dosubmit'] == 1) {
            $user_id = $this->session->userdata['member_user_id'];
            $user_name = $this->session->userdata['member_username'];
            $_data['product_id'] = trim($this->input->post('product_id'));
            $_data['name'] = trim($this->input->post('khname'));
            $_data['dk_money'] = trim($this->input->post('dk_money'));
            $_data['dk_date'] = trim($this->input->post('dk_date'));
            $_data['remark'] = trim($this->input->post('remark'));
            if ($_FILES['money_slip']['error'] == 0) {
                $config = array('module' => 'order', 'shop_id' => $this->user_id, 'rel_id' => $this->user_id, 'shop_id' => $this->user_id, 'isadmin' => 0, 'sts' => 0);
                $this->iupload_lib->initialize($config); //配置初始化文件
                $this->iupload_lib->do_uploadfile('money_slip'); //上传附件
                $file_data = $this->iupload_lib->file_data();
                $_data['money_slip'] = $file_data['savepath'];
            }
            if ($_FILES['bankcard']['error'] == 0) {
                $config = array('module' => 'order', 'shop_id' => $this->user_id, 'rel_id' => $this->user_id, 'shop_id' => $this->user_id, 'isadmin' => 0, 'sts' => 0);
                $this->iupload_lib->initialize($config); //配置初始化文件
                $this->iupload_lib->do_uploadfile('bankcard'); //上传附件
                $file_data = $this->iupload_lib->file_data();
                $_data['bankcard'] = $file_data['savepath'];
            }
            if ($_FILES['idcard_up']['error'] == 0) {
                $config = array('module' => 'order', 'shop_id' => $this->user_id, 'rel_id' => $this->user_id, 'shop_id' => $this->user_id, 'isadmin' => 0, 'sts' => 0);
                $this->iupload_lib->initialize($config); //配置初始化文件
                $this->iupload_lib->do_uploadfile('idcard_up'); //上传附件
                $file_data = $this->iupload_lib->file_data();
                $_data['idcard_up'] = $file_data['savepath'];
            }
            if ($_FILES['idcard_back']['error'] == 0) {
                $config = array('module' => 'order', 'shop_id' => $this->user_id, 'rel_id' => $this->user_id, 'shop_id' => $this->user_id, 'isadmin' => 0, 'sts' => 0);
                $this->iupload_lib->initialize($config); //配置初始化文件
                $this->iupload_lib->do_uploadfile('idcard_back'); //上传附件
                $file_data = $this->iupload_lib->file_data();
                $_data['idcard_back'] = $file_data['savepath'];
            }
            if ($_FILES['signature1']['error'] == 0) {
                $config = array('module' => 'order', 'shop_id' => $this->user_id, 'rel_id' => $this->user_id, 'shop_id' => $this->user_id, 'isadmin' => 0, 'sts' => 0);
                $this->iupload_lib->initialize($config); //配置初始化文件
                $this->iupload_lib->do_uploadfile('signature1'); //上传附件
                $file_data = $this->iupload_lib->file_data();
                $_data['signature1'] = $file_data['savepath'];
            }
            if ($_FILES['signature2']['error'] == 0) {
                $config = array('module' => 'order', 'shop_id' => $this->user_id, 'rel_id' => $this->user_id, 'shop_id' => $this->user_id, 'isadmin' => 0, 'sts' => 0);
                $this->iupload_lib->initialize($config); //配置初始化文件
                $this->iupload_lib->do_uploadfile('signature2'); //上传附件
                $file_data = $this->iupload_lib->file_data();
                $_data['signature2'] = $file_data['savepath'];
            }
            $_data['poster'] = $user_name;
            $_data['user_id'] = $user_id;
            $_data['post_time'] = time();
            $id = $this->caifu_order->add($_data, 'caifu_order');

            $this->showmessage('success', '报单信息保存成功', 'index.php?m=member&c=order&a=lists');
            return;
        } else {
            //导航及数量
            $nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'category');
            foreach ($nav_category as $key => $val) {
                $cateid = $val['column_value'];
                $where = array('category' => $cateid);
                $con = $this->a_caifu_model->count($where, 'caifu_product');
                $nav_category[$key]['numbs'] = intval($con);
            }
            $data = array();
            //网站基本设置
            $setup_setting = getcache('setup', 'commons');
            $hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
            $hot_arr = array();
            if (!empty($hot_search)) {
                $hot_arr = explode(",", $hot_search);
            }
            $data['hot_arr'] = $hot_arr;
            $data['current_nav'] = "index";
            $data['nav_category'] = $nav_category;
            $this->view('order_add', $data);
        }
    }

    //订单列表--shuangniao
    public function lists() {
        $this->seo_title = '积分商城-我的订单';
        $this->seo_keywords = '会员中心';
        $this->seo_description = '会员中心';
        //导航及数量
        $nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'category');
        foreach ($nav_category as $key => $val) {
            $cateid = $val['column_value'];
            $where = array('category' => $cateid);
            $con = $this->a_caifu_model->count($where, 'caifu_product');
            $nav_category[$key]['numbs'] = intval($con);
        }
        $data['heading_title'] = '我的订单';
        $user_id = $this->session->userdata['member_user_id'];
        $this->load->model('user');
        $data['userInfo'] = $this->user->get_one(array('user_id' => $this->user_id), 'user');
        $data['groupInfo'] = $this->user->get_one(array('id' => $data['userInfo']['group']), 'user_group');

        $status = $this->input->get('status');
        $search_name = $this->input->get_post('search_name');
        $data['status'] = $status ? $status : 0;


        $page = $this->input->get('page');
        $type = $this->input->get('type');
        $type_name = $this->getPointsStatusName($type);
        $page = intval($page) > 0 ? $page : 1;

        $sel['buyer_id'] = $user_id;
        $sel['page'] = $page;
        $sel['pagesize'] = 10;
        $sel['status'] = $type;
        $sel['search_name'] = $search_name;

        $list = $this->a_member_model->get_order_search($sel);
        foreach ($list['list'] as $key => $value) {
            $list['list'][$key]['order_state_name'] = $this->getPointsStatusName($value['status']);
        }
        //网站基本设置
        $setup_setting = getcache('setup', 'commons');
        $hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
        $hot_arr = array();
        if (!empty($hot_search)) {
            $hot_arr = explode(",", $hot_search);
        }
        $data['hot_arr'] = $hot_arr;
        $data['list'] = $list['list'];
        $data['page'] = $list['page'];
        $data['type'] = $type;
        $data['type_name'] = $type_name;
        $data['current_nav'] = "index";
        $data['nav_category'] = $nav_category;
        $this->view('order_list', $data);
    }

    //订单详情--shuangniao
    public function info() {
        $this->seo_title = '会员中心-订单详情';
        $this->seo_keywords = '会员中心';
        $this->seo_description = '会员中心';
        $order_id = $this->input->get('id');

        $order_info = $this->a_member_model->get_one(array('order_id' => $order_id), 'order');
        if (empty($order_info)) {
            redirect(base_url() . 'index.php?m=member&c=order&a=lists');
        }

        $area_info = $this->a_member_model->get_one(array('oadd_id' => $order_id), 'order_address');
        $order_info['state_name'] = $this->getStatusName($order_info['order_state']);
        $goods_info = $this->a_member_model->get_query(array('order_id' => $order_id), 'order_goods');
        foreach ($goods_info as $k => $v) {
            $tonsspec_id = $v['spec_id'];
            //获取价格库中规则名称
            $tonsspec_info = $this->a_member_model->get_one(array('id' => $tonsspec_id), $this->tb_price);
            $goods_info[$k]['spec_name'] = empty($tonsspec_info['prod_spec']) ? '' : $tonsspec_info['prod_spec'];
        }

        $data['order_info'] = $order_info;
        $data['goods_info'] = $goods_info;
        $data['area_info'] = $area_info;
        $data['current_nav'] = "index";
        $this->view('order_info', $data);
    }

    public function state_next() {
        $orderSn = $this->input->get('orderSn');
        $state = $this->input->get('state');
        $user_id = $this->session->userdata['member_user_id'];
        $res = $this->a_member_model->update(array('order_sn' => $orderSn, 'buyer_id' => $user_id, 'order_state' => $state, 'sts' => 0), array('order_state' => '40'), 'order');
        if ($res > 0) {
            $arr['msg'] = 'success';
        } else {
            $arr['msg'] = 'fail';
        }
        echo json_encode($arr);
    }

    //订单状态：10(默认):未付款;11:待收款 20:已审核;30:已发货;40:已收货;50:取消;60已确认;
    function getStatusName($state = '10') {
        $data = array(
            '10' => '未付款',
            '11' => '待收款',
            '20' => '已审核',
            '30' => '已发货',
            '40' => '已收货',
            '50' => '已取消',
            '60' => '已完成',
        );
        return isset($data[$state]) ? $data[$state] : '未知的状态';
    }

    function getPointsStatusName($state = '10') {
        $data = array(
            '10' => '待审核',
            '11' => '已处理',
            '20' => '已成立',
            '30' => '已驳回',
            '40' => '已收货',
            '50' => '已取消',
            '60' => '已完成',
        );
        return isset($data[$state]) ? $data[$state] : '未知的状态';
    }

    //退货状态:0（取消）：1(默认-未审核):2（不通过）：3（通过）：4（完结）
    function getRefundName($state = 1) {
        $data = array(
            '0' => '取消',
            '1' => '审核中',
            '2' => '未通过',
            '3' => '通过',
            '4' => '完结',
            '5' => '取消'
        );
        return isset($data[$state]) ? $data[$state] : '未知状态';
    }

}
