<?php

class Products extends Site_Controller {

    private $tb_goods = 'goods';
    private $tb_goods_cate = 'goods_category';

    public function __construct() {
        parent::__construct();
        $this->load->model('a_com_model');
        $this->load->model('a_caifu_model');
    }

    //产品列表
    public function lists() {
        $cid = $this->input->get('cid');
        $_data = array();
        //导航及数量
        $nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'category');
        foreach ($nav_category as $key => $val) {
            $cateid = $val['column_value'];
            $where = array('category' => $cateid);
            $con = $this->a_caifu_model->count($where, 'caifu_product');
            $nav_category[$key]['numbs'] = intval($con);
        }
        //分类基本信息
        $cate_info = $this->a_caifu_model->get_one(array('gc_id' => $cid), 'goods_category');
        $sel_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'category');
        $sel_lifetime = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'lifetime');
        $sel_expenses_area = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'expenses_area');
        $sel_yield = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'yield');
        $sel_interest = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'interest');
        $sel_investment = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'investment');
        $sel_area = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'area');
        $sel_size = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'size');

        $page = $this->input->get('page');
        $s_title = $this->input->get('title');
        $search_title = $this->input->get('search_title');
        $cpzt = $this->input->get('cpzt');
        $cpxl = $this->input->get('cpxl');
        $cpqx = $this->input->get('cpqx');
        $fxfy = $this->input->get('fxfy');
        $syl = $this->input->get('syl');
        $fxfs = $this->input->get('fxfs');
        $tzly = $this->input->get('tzly');
        $szqy = $this->input->get('szqy');
        $dxpb = $this->input->get('dxpb');
        $page = intval($page) > 0 ? $page : 1;

        $sel['cateid'] = $cid;
        $sel['page'] = $page;
        $sel['s_title'] = empty($s_title) ? '' : $s_title;
        $sel['search_title'] = empty($search_title) ? '' : $search_title;
        $sel['cpzt'] = empty($cpzt) ? 0 : $cpzt;
        $sel['cpxl'] = empty($cpxl) ? 0 : $cpxl;
        $sel['cpqx'] = empty($cpqx) ? 0 : $cpqx;
        $sel['fxfy'] = empty($fxfy) ? 0 : $fxfy;
        $sel['syl'] = empty($syl) ? 0 : $syl;
        $sel['fxfs'] = empty($fxfs) ? 0 : $fxfs;
        $sel['tzly'] = empty($tzly) ? 0 : $tzly;
        $sel['szqy'] = empty($szqy) ? 0 : $szqy;
        $sel['dxpb'] = empty($dxpb) ? 0 : $dxpb;
        $sel['pagesize'] = 10;
        $list = $this->a_caifu_model->getProductsList($sel);
        $product_list = $list['list'];
        foreach ($product_list as $key => $val) {
            $product_list[$key]['interest_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'interest', $val['interest']);
            $product_list[$key]['investment_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'investment', $val['investment']);
        }
        $_data['list'] = $product_list;
        $_data['page'] = $list['page'];
        $_data['sel_category'] = $sel_category;
        $_data['sel_lifetime'] = $sel_lifetime;
        $_data['sel_expenses_area'] = $sel_expenses_area;
        $_data['sel_yield'] = $sel_yield;
        $_data['sel_interest'] = $sel_interest;
        $_data['sel_investment'] = $sel_investment;
        $_data['sel_area'] = $sel_area;
        $_data['sel_size'] = $sel_size;
        $_data['sel'] = $sel;
        $_data['current_nav'] = $cpxl;
        $_data['nav_category'] = $nav_category;
        //网站基本设置
        $setup_setting = getcache('setup', 'commons');
        $hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
        $hot_arr = array();
        if (!empty($hot_search)) {
            $hot_arr = explode(",", $hot_search);
        }
        $this->seo_title = "产品中心 - " . $setup_setting['site_title'];
        $_data['cateid'] = $cid;
        $_data['hot_arr'] = $hot_arr;
        $this->view('product_list', $_data);
    }

    //产品---详细
    public function detail() {
        if (isset($_POST['dosubmit']) && $_POST['dosubmit'] == 1) {
            $this->load->model('caifu_reserve');
            $user_id = isset($this->session->userdata['member_user_id']) ? $this->session->userdata['member_user_id'] : 0;
            if ($user_id <= 0) {//表示未登录，需要登录
                $this->showmessage('success', '您还没有登录，请先登录！', 'index.php?c=customer&a=login');
                return '';
            }
            $product_id = trim($this->input->post('product_id'));
            $yy_name = trim($this->input->post('yy_name'));
            $yy_phone = trim($this->input->post('yy_phone'));
            $yy_money = trim($this->input->post('yy_money'));
            $yy_remark = trim($this->input->post('yy_remark'));
            $_data['product_id'] = $product_id;
            $_data['order_sn'] =  $this->createOrderSn();
            $_data['reserve_date'] = date('Y-m-d', time());
            $_data['name'] = $yy_name;
            $_data['phone'] = $yy_phone;
            $_data['money'] = $yy_money;
            $_data['remark'] = $yy_remark;
            $_data['status'] = 10;
            $_data['poster'] = $this->session->userdata['member_username'];
            $_data['user_id'] = $user_id;
            $_data['post_time'] = time();

            $reserve_id = $this->caifu_reserve->add($_data, 'caifu_reserve');
            if ($reserve_id > 0) {//预约成功
                $this->showmessage('success', '预约成功！', HTTP_REFERER);
                return '';
            } else {
                $this->showmessage('error', '预约失败!', HTTP_REFERER);
                return '';
            }
        } else {
            $id = $this->input->get('id');
            //导航及数量
            $nav_category = $this->a_caifu_model->get_dictionary_list('db_caifu_product', 'category');
            foreach ($nav_category as $key => $val) {
                $cateid = $val['column_value'];
                $where = array('category' => $cateid);
                $con = $this->a_caifu_model->count($where, 'caifu_product');
                $nav_category[$key]['numbs'] = intval($con);
            }

            $product_info = $this->a_caifu_model->get_one(array('id' => $id), 'db_caifu_product');
            $product_info['interest_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'interest', $product_info['interest']);
            $product_info['category_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'category', $product_info['category']);
            $product_info['investment_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'investment', $product_info['investment']);
            $product_info['size_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'size', $product_info['size']);
            $product_info['earning_name'] = $this->a_caifu_model->get_dict_column_title('db_caifu_product', 'earning', $product_info['earning']);
            $_data['product_info'] = $product_info;
            $_data['current_nav'] = $product_info['category'];
            $_data['nav_category'] = $nav_category;
            //网站基本设置
            $setup_setting = getcache('setup', 'commons');
            $hot_search = empty($setup_setting['hot_search']) ? '' : $setup_setting['hot_search'];
            $hot_arr = array();
            if (!empty($hot_search)) {
                $hot_arr = explode(",", $hot_search);
            }
            $_data['hot_arr'] = $hot_arr;
            $this->seo_title = $product_info['name'] . " - " . $setup_setting['site_title'];
            $this->view('products_detail', $_data);
        }
    }

    /**
     *
     * @todo 订单号生成
     *
     */
    public function createOrderSn() {
        $year_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $order_sn = $year_code[intval(date('Y')) - 2010] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $order_sn;
    }

}
