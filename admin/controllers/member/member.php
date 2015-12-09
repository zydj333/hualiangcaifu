<?php

if (!defined('ADMINPHP'))
    exit('No direct script access allowed');

class Member extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->tb_user = 'user';
        $this->tb_user_charge = 'user_charge';
        $this->tb_user_discount = 'user_group_discount';
        $this->load->model('dbclass_model');
        $this->load->model('type_model');
        $this->load->model('user');
        $this->load->model('user_group');
        $this->load->model('user_charge');
        $this->load->model('areas');
        $this->load->model('address');
        $this->load->model('message');
        $this->load->model('uploadfile');
        $this->load->model('a_system_model');
    }

    public function index() {
        $this->cismarty->display('member/index.html');
    }

    public function group_list() {

        $this->load->model('user_group');
        $list = $this->user_group->get_query(array('order_by' => 'listorder desc'));

        $this->cismarty->assign('infolist', $list);
        $this->cismarty->display('member/member/group_list.html');
    }

    function group_add() {
        if (isset($_POST['dosubmit'])) {
            $_data_post = $this->input->post();
            $_data = $_data_post['info'];
            $s_value_list = isset($_POST['s_value']) ? $_POST['s_value'] : array();
            $group_id = $this->user_group->add($_data);
            //添加折扣数据
            foreach ($s_value_list as $k => $v) {
                $discount = empty($v['discount']) ? 100 : $v['discount'];
                $cxdiscount = empty($v['cxdiscount']) ? 100 : $v['cxdiscount'];
                $value_data = array('group_id' => $group_id, 'series_id' => $v['id'], 'discount' => $discount, 'cxdiscount' => $cxdiscount);
                $this->user_group->add($value_data, $this->tb_user_discount);
            }
            $this->showmessage('adddialog', lang('com_add'), HTTP_REFERER);
        } else {
            //产品系列
            $dict_list = $this->a_system_model->get_dictionary_list('goods_price_library', 'cateid');
            $this->cismarty->assign('catelist', $dict_list);
            $this->cismarty->display('member/member/group_add.html');
        }
    }

    public function group_edit() {
        if (isset($_POST['dosubmit'])) {
            $_data_post = $this->input->post();
            $_data = $_data_post['info'];
            $s_value_list = isset($_POST['s_value']) ? $_POST['s_value'] : array();
            $group_id = $_data['id'];

            $this->load->model('user_group');
            $this->user_group->update(array('id' => $_data['id']), $_data);
            //更新规格值表数据
            foreach ($s_value_list as $key => $value) {
                $discount = empty($value['discount']) ? 100 : $value['discount'];
                $cxdiscount = empty($value['cxdiscount']) ? 100 : $value['cxdiscount'];
                $discount_info = $this->user_group->get_one(array('group_id' => $group_id, 'series_id' => $value['id']), $this->tb_user_discount);
                if (empty($discount_info)) {
                    $value_data = array('group_id' => $group_id, 'series_id' => $value['id'], 'discount' => $discount, 'cxdiscount' => $cxdiscount);
                    $this->user_group->add($value_data, $this->tb_user_discount);
                } else {
                    $value_data = array('discount' => $discount, 'cxdiscount' => $cxdiscount);
                    $spec_photo = $this->user_group->update(array('group_id' => $group_id, 'series_id' => $value['id']), $value_data, $this->tb_user_discount);
                }
            }

            $this->showmessage('editdialog', lang('com_edit'), HTTP_REFERER);
        } else {
            $id = $this->input->get('id');
            $id = intval($id);
            if ($id == 0)
                $this->showmessage('editdialog', lang('com_parameter'), HTTP_REFERER);

            $this->load->model('user_group');
            $info = $this->user_group->get_info($id);
            //产品系列
            $dict_list = $this->a_system_model->get_dictionary_list('goods_price_library', 'cateid');
            foreach ($dict_list as $key => $val) {
                $series_id = $val['column_value'];
                $discount_info = $this->user_group->get_one(array('group_id' => $id, 'series_id' => $series_id), $this->tb_user_discount);
                $discount = empty($discount_info['discount']) ? "" : $discount_info['discount'];
                $cxdiscount = empty($discount_info['cxdiscount']) ? "" : $discount_info['cxdiscount'];
                $dict_list[$key]['discount'] = $discount;
                $dict_list[$key]['cxdiscount'] = $cxdiscount;
            }

            $this->cismarty->assign('catelist', $dict_list);
            $this->cismarty->assign('info', $info);
            $this->cismarty->display('member/member/group_edit.html');
        }
    }

    public function group_del() {
        if (isset($_POST['dosubmit'])) {
            $_data_post = $this->input->post();
            $ids = isset($_data_post['ckbid']) ? $_data_post['ckbid'] : null;
            if (!empty($ids)) {
                $this->load->model('user_group');
                foreach ($ids as $key => $val) {
                    $this->user_group->del(array('id' => $val));
                }
            }
            $this->showmessage('go', lang('com_success'), HTTP_REFERER);
        }
        $this->showmessage('goback', lang('com_parameter'), HTTP_REFERER);
    }

    //会员列表
    public function lists() {
        $this->load->library('ichar');
        $page = $this->input->get('page');
        $page = $this->ichar->act($page, 'int');

        $data['page'] = $page;
        $data['pagesize'] = 10;

        if (isset($_GET['dosubmit'])) {
            $data['search_field_name'] = $this->input->get('search_field_name');
            $data['search_field_value'] = $this->input->get('search_field_value');
            $data['search_sort'] = $this->input->get('search_sort');
            $data['search_state'] = $this->input->get('search_state');

            $this->cismarty->assign('name', $data['search_field_name']);
            $this->cismarty->assign('value', $data['search_field_value']);
            $this->cismarty->assign('sort', $data['search_sort']);
            $this->cismarty->assign('form_submit', $_GET['dosubmit']);
            $this->cismarty->assign('state', $data['search_state']);
        }
        //获取该管理员下的经销商
        $admin_areaids = $this->session->userdata('admin_area_id');
        if (!empty($admin_areaids)) {
            $data['admin_areaids'] = $admin_areaids;
        }

        $this->load->model('a_member_model');
        $list = $this->a_member_model->get_member_search($data);

        $this->cismarty->assign('infolist', $list['list']);
        $this->cismarty->assign('infopage', $list['page']);
        $this->cismarty->display('member/member/user_list.html');
    }

    //添加会员
    public function user_add() {
        if (isset($_POST['dosubmit'])) {
            $member['username'] = $this->input->post('member_name');
            $password = $this->input->post('member_passwd');
            $member['email'] = $this->input->post('member_email');
            $member['truename'] = $this->input->post('member_truename');
            $member['sex'] = $this->input->post('member_sex');
            $member['birthday'] = $this->input->post('member_birthday');
            $member['qq'] = $this->input->post('member_qq');
            $member['ww'] = $this->input->post('member_ww');
            $member['msn'] = $this->input->post('member_msn');
            $member['phone'] = $this->input->post('member_phone');
            $member['tel'] = $this->input->post('member_tel');
            $member['web'] = $this->input->post('member_web');
            $member['province_id'] = $this->input->post('province_id');
            $member['city_id'] = $this->input->post('city_id');
            $member['area_id'] = $this->input->post('area_id');
            $member['freeze_predeposit'] = $this->input->post('member_freezedeposit');
            $member['address'] = $this->input->post('member_address');
            $member['head_ico'] = 'statics/default/images/head_ico.gif';
            if ($_FILES['member_avatar']['error'] == 0) {
                $member_avatar = $_FILES['member_avatar'];
                if (isset($member_avatar['name'])) {
                    /*                     * *保存图片** */
                    $this->user_id = $this->session->userdata('admin_user_id');
                    $this->load->library('iupload_lib');
                    $config = array(
                        'module' => 'user_logo',
                        'dir' => 'user',
                        'shop_id' => $this->user_id,
                        'isadmin' => 1,
                    );
                    $this->iupload_lib->initialize($config); //配置初始化文件
                    $this->iupload_lib->do_uploadfile('member_avatar'); //上传附件
                    $file_id = $this->iupload_lib->save_data(); //保存数据到数据库
                    if ($file_id == TRUE) {
                        $link_pic = $this->uploadfile->get_one(array('file_id' => $file_id), 'uploadfile', 'filepath');
                    }
                }
                $member['head_ico'] = $link_pic['filepath'];
            }
            $key = '';
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ,./&lt;>?;#:@~[]{}-_=+)(*&^%___FCKpd___0pound;"!';
            $key = random(6, $pattern);
            $member['password'] = md5(md5($password . $key));
            $member['random'] = $key;
            $member['register_time'] = time();
            $member['login_time'] = time();
            $member['last_login_time'] = time();

            $user = $this->user->add($member);
            $this->showmessage('user_list', lang('com_add'), $this->admin_url . 'member/member/lists?loghash=' . $this->session->userdata('loghash'));
        } else {
            $ac_list = $this->areas->get_query(array('order_by' => 'listorder asc', 'parent_id' => 0), 'areas');
            $this->cismarty->assign('ac_list', $ac_list);
            $this->cismarty->display('member/member/user_add.html');
        }
    }

    //编辑会员
    public function user_edit() {
        if (isset($_POST['dosubmit'])) {
            $passwd = $this->input->post('member_passwd');
            $user_id = $this->input->post('member_id');
            $head_ico = $this->input->post('old_member_avatar');
            $username = $this->input->post('member_name');
            $member['email'] = $this->input->post('member_email');
            $member['truename'] = $this->input->post('member_truename');
            $member['birthday'] = $this->input->post('member_birthday');
            $member['sex'] = $this->input->post('member_sex');
            $member['qq'] = $this->input->post('member_qq');
            $member['ww'] = $this->input->post('member_ww');
            $member['msn'] = $this->input->post('member_msn');
            $member['inform_allow'] = $this->input->post('inform_allow');
            $member['isbuy'] = $this->input->post('isbuy');
            $member['isallowtalk'] = $this->input->post('allowtalk');
            $member['isclose'] = $this->input->post('memberstate');
            $member['phone'] = $this->input->post('member_phone');
            $member['tel'] = $this->input->post('member_tel');
            $member['web'] = $this->input->post('member_web');
            $member['province_id'] = $this->input->post('province_id');
            $member['city_id'] = $this->input->post('city_id');
            $member['area_id'] = $this->input->post('area_id');
            $member['freeze_predeposit'] = $this->input->post('member_freezedeposit');
            $member['address'] = $this->input->post('member_address');
            if ($_FILES['member_avatar']['error'] == 0) {
                /*                 * *保存图片** */
                $this->user_id = $this->session->userdata('admin_user_id');
                $this->load->library('iupload_lib');
                $config = array(
                    'module' => 'user_logo',
                    'dir' => 'user',
                    'shop_id' => $this->user_id,
                    'isadmin' => 1,
                );
                $this->iupload_lib->initialize($config); //配置初始化文件
                $this->iupload_lib->do_uploadfile('member_avatar'); //上传附件
                $file_id = $this->iupload_lib->save_data(); //保存数据到数据库
                if ($file_id == TRUE) {
                    $link_pic = $this->uploadfile->get_one(array('file_id' => $file_id), 'uploadfile', 'filepath');
                }
                $member['head_ico'] = $link_pic['filepath'];
            } else {
                $member['head_ico'] = $head_ico;
            }
            if ($passwd) {
                $key = '';
                $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ,./&lt;>?;#:@~[]{}-_=+)(*&^%___FCKpd___0pound;"!';
                $key = random(6, $pattern);
                $member['password'] = md5(md5($passwd . $key));
                $member['random'] = $key;
            }
            $edit = $this->user->update(array('user_id' => $user_id), $member);
            $this->showmessage('user_list', lang('com_edit'), $this->admin_url . 'member/member/lists?loghash=' . $this->session->userdata('loghash'));
        } else {
            $user_id = $this->input->get('user_id');
            $user_id = intval($user_id);
            if ($user_id == 0)
                $this->showmessage('user_list', lang('com_parameter'), $this->admin_url . 'member/member/lists?loghash=' . $this->session->userdata('loghash'));


            $info = $this->user->get_one(array('user_id' => $user_id), 'user');
            if ($info == FALSE) {
                $this->showmessage('user_list', lang('com_parameter'), $this->admin_url . 'member/member/lists?loghash=' . $this->session->userdata('loghash'));
            }

            $ac_list = $this->areas->get_query(array('order_by' => 'listorder asc', 'parent_id' => 0), 'areas');
            $this->cismarty->assign('ac_list', $ac_list);

            $this->cismarty->assign('info', $info);
            $this->cismarty->display('member/member/user_edit.html');
        }
    }
    
    
    /**
     * 
     * @todo  查看用户详细信息
     * 
     */
    public function detial(){
       $uid=  $this->input->get('uid');
       //获取用户信息
       $user_info = $this->user->get_one(array('user_id' => $uid),'user');
       if(!empty($user_info)){
           if($user_info['cardno']!=''){
               $phonenum = str_replace(" ", "", $user_info['cardno']);
               $phonenum = str_replace("-", "", $phonenum);
               $user=$this->user->get_one(array('username' => $phonenum),'user');
               if(!empty($user)){
                   $user_info['cardno_user']=$user['truename'];
               }else{
                   $user_info['cardno_user']='没获取到';
               }
           }else{
                $user_info['cardno_user']='无推荐';
           }
            $this->cismarty->assign('detial', $user_info);
            $this->cismarty->display('member/member/detial.html');
       }else{
           echo '没有获取到用户的信息';
       }
    }
    
    /**
     * 
     * @todo 显示名片 
     * 
     */
    public function showBusinessCard(){
         $uid=  $this->input->get('uid');
       //获取用户信息
       $user_info = $this->user->get_one(array('user_id' => $uid),'user');
       echo '<img src="/'.$user_info['businesscard'].'" width="500px" />';
    }
    

    //会员删除
    public function user_del() {
        $_data_post = $this->input->post();
        $user_id = isset($_data_post['del_id']) ? $_data_post['del_id'] : null;
        foreach ($user_id as $val) {
            $user_info = $this->user->get_one(array('user_id' => $val), 'user');
            $return = $this->user->update(array('user_id' => $val), array('sts' => '1', 'username' => $user_info['username'] . "delete", 'phone' => $user_info['phone'] . "delete"));
        }
        $this->showmessage('user_list', lang('com_del'), $this->admin_url . 'member/member/lists?loghash=' . $this->session->userdata('loghash'));
    }

    //会员审核
    public function user_check() {
        $istag = $this->input->get('istag');
        $_data_post = $this->input->post();
        $user_id = isset($_data_post['del_id']) ? $_data_post['del_id'] : null;
        foreach ($user_id as $val) {
            $return = $this->user->update(array('user_id' => $val), array('ischeck' => $istag));
        }
        $this->showmessage('user_list', '审核状态设置成功！', $this->admin_url . 'member/member/lists?loghash=' . $this->session->userdata('loghash'));
    }

    //设置等级
    public function user_level() {
        $user_id = $this->input->post('del_id');

        if ($user_id == false) {
            $this->showmessage('shop_order', '请选择要设置的会员', $this->admin_url . 'member/member/lists?loghash=' . $this->session->userdata('loghash'));
        } else {
            if (isset($_POST['form_submit'])) {
                $group_id = $this->input->post('group_id');
                $user_id = $this->input->post('del_id');
                $user_id = explode(',', $user_id);
                foreach ($user_id as $key => $val) {
                    $data = array('group' => $group_id);
                    $this->user->update(array('user_id' => $val), $data);
                }
                $this->showmessage('shop_order', '设置成功!', $this->admin_url . 'member/member/lists?loghash=' . $this->session->userdata('loghash'));
            } else {
                $commend_data = $this->user_group->get_query(array('order_by' => 'listorder'), 'user_group');
                $user_id = implode(',', $user_id);
                $this->cismarty->assign('user_id', $user_id);
                $this->cismarty->assign('levellist', $commend_data);
                $this->cismarty->display('member/member/user_level.html');
            }
        }
    }

    //会员登录状态设置
    public function user_status() {
        $istag = $this->input->get('istag');
        $_data_post = $this->input->post();
        $user_id = isset($_data_post['del_id']) ? $_data_post['del_id'] : null;
        foreach ($user_id as $val) {
            $return = $this->user->update(array('user_id' => $val), array('isclose' => $istag));
        }
        $this->showmessage('user_list', '登录状态设置成功！', $this->admin_url . 'member/member/lists?loghash=' . $this->session->userdata('loghash'));
    }

    //会员通知
    public function user_notice() {
        $this->load->model('shop_grade_model');
        $this->load->model('shop_model');
        $shop_grade = $this->shop_grade_model->get_query(array('order_by' => 'sg_id asc'), 'shop_grade');

        if (isset($_POST['form_submit'])) {
            $send_type = $this->input->post('send_type');
            $user_name = $this->input->post('user_name');
            $message['message_body'] = $this->input->post('content1');
            $store_grade = $this->input->post('store_grade');

            if ($send_type == 1) {
                $user_name = explode(',', $user_name);
                if (count($user_name) > 1) {
                    $message['message_ismore'] = '1';
                }
                $t_user_id = 0;
                foreach ($user_name as $key => $val) {
                    if (!empty($val)) {
                        $user_id = $this->user->get_one(array('username' => $val, 'sts' => 0), 'user', 'user_id');
                        if ($user_id['user_id']) {
                            $t_user_id.= $user_id['user_id'] . ',';
                        } else {
                            $message = '发送失败！用户' . $val . '不存在,请核对用户名正确之后再发送!';
                            $this->showmessage('error', $message, $this->admin_url . 'member/member/user_notice?loghash=' . $this->session->userdata('loghash'));
                        }
                    }
                }
                $uid_t = substr($t_user_id, 1, -1);
                $message['to_user_id'] = $uid_t;
                $message['to_user_name'] = $this->input->post('user_name');
            } elseif ($send_type == 2) {
                //发送全部会员
                $uid = 0;
                $uname = 0;
                $user_data = $this->user->get_query(array('order_by' => 'user_id asc'), 'user', 'user_id,username');
                if (isset($user_data)) {
                    foreach ($user_data as $key => $val) {
                        $uid.=$val['user_id'] . ',';
                        $uname.=$val['username'] . ',';
                    }
                } else {
                    $error = '发送错误，系统暂无注册会员！';
                    $this->showmessage('error', $error, $this->admin_url . 'member/member/user_notice?loghash=' . $this->session->userdata('loghash'));
                }
                $uid_l = substr($uid, 1, -1);
                $uname_l = substr($uname, 1, -1);
                $message['to_user_id'] = $uid_l;
                $message['message_ismore'] = '1';
                $message['to_user_name'] = $uname_l;
            } elseif ($send_type == 3) {
                //发送指定店铺等级
                $uid = 0;
                $uname = 0;
                $user_data = $this->shop_model->get_query(array('grade_id' => $store_grade['0']), 'shop', 'member_id,member_name');
                if (count($user_data) > 1) {
                    $message['message_ismore'] = '1';
                }
                foreach ($user_data as $key => $val) {
                    $uid.=$val['member_id'] . ',';
                    $uname.=$val['member_name'] . ',';
                }
                $uid_l = substr($uid, 1, -1);
                $uname_l = substr($uname, 1, -1);
                $message['to_user_id'] = $uid_l;
                $message['to_user_name'] = $uname_l;
            } else {
                //发送全部店铺
                $uid = 0;
                $uname = 0;
                $user_data = $this->shop_model->get_query('', 'shop', 'member_id,member_name');
                if (isset($user_data)) {
                    foreach ($user_data as $key => $val) {
                        $uid.=$val['member_id'] . ',';
                        $uname.=$val['member_name'] . ',';
                    }
                } else {
                    $error = '发送错误，系统暂无会员开设店铺！';
                    $this->showmessage('error', $error, $this->admin_url . 'member/member/user_notice?loghash=' . $this->session->userdata('loghash'));
                }
                $uid_l = substr($uid, 1, -1);
                $uname_l = substr($uname, 1, -1);
                $message['to_user_id'] = $uid_l;
                $message['to_user_name'] = $uname_l;
                $message['message_ismore'] = '1';
            }
            $message['message_type'] = '1';
            $message['from_user_id'] = '0';
            $message['message_time'] = time();
            $message['from_user_name'] = '系统';

            $message = $this->message->add($message);
            $this->showmessage('success', lang('com_add'), $this->admin_url . 'member/member/user_notice?loghash=' . $this->session->userdata('loghash'));
        } else {

            $this->cismarty->assign('infolist', $shop_grade);
            $this->cismarty->display('member/member/user_notice.html');
        }
    }

    //会员充值
    public function user_charge() {
        if (isset($_POST['dosubmit'])) {
            $user_id = $this->input->post('user_id');
            $money_time = $this->input->post('money_time');
            $money_total = $this->input->post('money_total');
            $money_type = $this->input->post('money_type');
            $add_time = time();
            if (!empty($money_type) && $money_type == 5) {
                $money_type = $this->input->post('money_type2');
            }
            //更新记录
            $user_info = $this->user->get_one(array('user_id' => $user_id), 'user');
            $user_predeposit = $user_info['available_predeposit'];
            $funds['member_name'] = $user_info['username'];
            $funds['member_email'] = $user_info['email'];
            $funds['member_id'] = $user_id;
            $funds['money_time'] = $money_time;
            $funds['money_total'] = $money_total;
            $funds['money_type'] = $money_type;
            $funds['add_time'] = $add_time;
            $fundsres = $this->user_charge->add($funds, $this->tb_user_charge);
            //更新用户余额
            $user_predeposit = $user_predeposit + $money_total;
            $this->user->update(array('user_id' => $user_id), array('available_predeposit' => $user_predeposit), 'user');

            $this->showmessage('success', lang('com_add'), $this->admin_url . 'member/funds/lists?loghash=' . $this->session->userdata('loghash'));
        } else {
            $user_id = $this->input->get('user_id');
            $user_id = intval($user_id);
            $this->load->model('a_system_model');
            $user_info = $this->a_system_model->get_one(array('user_id' => $user_id), $this->tb_user);
            $this->cismarty->assign('user_info', $user_info);
            $this->cismarty->display('member/member/user_charge.html');
        }
    }

    //会员收获地址
    public function user_addresses() {
        $user_id = $this->input->get('user_id');
        $list = $this->address->get_query(array('member_id' => $user_id, 'order_by' => 'address_id desc'));

        $this->cismarty->assign('addresslist', $list);
        $this->cismarty->assign('userid', $user_id);
        $this->cismarty->display('member/member/address_list.html');
    }

    //新增收货地址
    function address_add() {
        if (isset($_POST['dosubmit'])) {
            $this->load->model('areas');
            $_data_post = $this->input->post();
            $user_id = $this->input->get('uid');
            $_data['member_id'] = $user_id;
            $_data['true_name'] = $this->input->post('true_name');
            $_data['province_id'] = intval($this->input->post('province_id'));
            $_data['area_info'] = '';
            if ($_data['province_id']) {
                $province = $this->areas->get_one(array('id' => $_data['province_id']), 'areas');
                $_data['area_info'] .= $province['name'];
            }
            $_data['city_id'] = intval($this->input->post('city_id'));
            if ($_data['city_id']) {
                $city = $this->areas->get_one(array('id' => $_data['city_id']), 'areas');
                $_data['area_info'] .= '	' . $city['name'];
            }
            $_data['area_id'] = intval($this->input->post('area_id'));
            if ($_data['area_id']) {
                $county = $this->areas->get_one(array('id' => $_data['area_id']), 'areas');
                $_data['area_info'] .= '	' . $county['name'];
            }
            $_data['address'] = $this->input->post('address');
            $_data['zip_code'] = $this->input->post('zip_code');
            $_data['tel_phone'] = $this->input->post('tel_phone');
            $_data['mob_phone'] = $this->input->post('mob_phone');
            //$_data['d_add'] = intval($this->input->post('d_add'));
            $address = $this->address->add($_data);
            $this->showmessage('address_list', lang('com_add'), $this->admin_url . 'member/member/user_addresses?user_id=' . $user_id . '&loghash=' . $this->session->userdata('loghash'));
        } else {
            $user_id = $this->input->get('uid');
            $ac_list = $this->areas->get_query(array('order_by' => 'listorder asc', 'parent_id' => 0), 'areas');
            $this->cismarty->assign('ac_list', $ac_list);
            $this->cismarty->assign('uid', $user_id);
            $this->cismarty->display('member/member/address_add.html');
        }
    }

    //编辑收货地址
    public function address_edit() {
        if (isset($_POST['dosubmit'])) {
            $this->load->model('areas');
            $_data_post = $this->input->post();
            $user_id = $this->input->get('uid');
            $address_id = $this->input->post('address_id');
            $_data['member_id'] = $user_id;
            $_data['true_name'] = $this->input->post('true_name');
            $_data['province_id'] = intval($this->input->post('province_id'));
            $_data['area_info'] = '';
            if ($_data['province_id']) {
                $province = $this->areas->get_one(array('id' => $_data['province_id']), 'areas');
                $_data['area_info'] .= $province['name'];
            }
            $_data['city_id'] = intval($this->input->post('city_id'));
            if ($_data['city_id']) {
                $city = $this->areas->get_one(array('id' => $_data['city_id']), 'areas');
                $_data['area_info'] .= '	' . $city['name'];
            }
            $_data['area_id'] = intval($this->input->post('area_id'));
            if ($_data['area_id']) {
                $county = $this->areas->get_one(array('id' => $_data['area_id']), 'areas');
                $_data['area_info'] .= '	' . $county['name'];
            }
            $_data['address'] = $this->input->post('address');
            $_data['zip_code'] = $this->input->post('zip_code');
            $_data['tel_phone'] = $this->input->post('tel_phone');
            $_data['mob_phone'] = $this->input->post('mob_phone');
            //$_data['d_add'] = intval($this->input->post('d_add'));
            $address = $this->address->update(array('address_id' => $address_id), $_data);

            $this->showmessage('address_list', lang('com_edit'), $this->admin_url . 'member/member/user_addresses?user_id=' . $user_id . '&loghash=' . $this->session->userdata('loghash'));
        } else {
            $address_id = $this->input->get('addid');
            $uid = $this->input->get('uid');
            $address_id = intval($address_id);
            if ($address_id == 0)
                $this->showmessage('editdialog', lang('com_parameter'), HTTP_REFERER);

            $info = $this->address->get_one(array('address_id' => $address_id), 'address');
            $ac_list = $this->areas->get_query(array('order_by' => 'listorder asc', 'parent_id' => 0), 'areas');
            $this->cismarty->assign('ac_list', $ac_list);
            $this->cismarty->assign('info', $info);
            $this->cismarty->assign('uid', $uid);
            $this->cismarty->display('member/member/address_edit.html');
        }
    }

    //删除地址
    public function address_del() {
        if (isset($_POST['dosubmit'])) {
            $_data_post = $this->input->post();
            $ids = isset($_data_post['ckbid']) ? $_data_post['ckbid'] : null;
            if (!empty($ids)) {
                $this->load->model('address');
                foreach ($ids as $key => $val) {
                    $this->address->del(array('address_id' => $val));
                }
            }
            $this->showmessage('go', lang('com_success'), HTTP_REFERER);
        }
        $this->showmessage('goback', lang('com_parameter'), HTTP_REFERER);
    }

    //AJAX判断会员名称是否存在
    public function ajax_user_name() {
        $user_name = trim($this->input->get('user_name'));
        $member_id = trim($this->input->get('member_id'));
        if (isset($member_id)) {
            $where = array('username' => $user_name, 'user_id' => $member_id);
            $d = $this->user->get_one($where, 'user');
        }
        if (isset($d['username']) == $user_name) {
            echo 'true';
        } else {
            $where = array('username' => $user_name);
            $r = $this->user->get_one($where, 'user');
            if (isset($r)) {
                if (isset($r['username']) == $user_name)
                    echo 'false';
                else
                    echo 'true';
            }else {
                echo 'true';
            }
        }
    }

    //AJAX判断邮件地址是否存在
    public function ajax_user_email() {
        $user_email = trim($this->input->get('user_email'));
        $member_id = trim($this->input->get('member_id'));
        if (isset($member_id)) {
            $where = array('email' => $user_email, 'user_id' => $member_id);
            $d = $this->user->get_one($where, 'user');
        }
        if (isset($d['email']) == $user_email) {
            echo 'true';
        } else {
            $where = array('email' => $user_email);
            $r = $this->user->get_one($where, 'user');
            if (isset($r)) {
                if (isset($r['email']) == $user_email)
                    echo 'false';
                else
                    echo 'true';
            }else {
                echo 'true';
            }
        }
    }

    //AJAX获取地区
    public function ajax_area() {
        $area_id = $this->input->get('area_id');
        $area_id = intval($area_id);
        $this->load->model('address');
        $list = array();
        if ($area_id !== false) {
            $list = $this->address->get_query(array('parent_id' => $area_id, 'order_by' => 'listorder asc'), 'areas');
        }
        echo json_encode($list);
    }

    //更新会员组缓存
    public function group_cache() {
        $this->load->model('user_group');
        $list = $this->user_group->get_query(array('order_by' => 'listorder asc'));
        $this->load->helper('global');
        setcache('group', $list, 'commons');
        $this->showmessage('group_list', lang('com_cache'), $this->admin_url . 'member/member/group_list?loghash=' . $this->session->userdata('loghash'));
    }

    public function group_order() {
        $id = $this->input->post('hdnid');
        $listorder = $this->input->post('listorder');

        foreach ($listorder as $key => $val) {
            $data = array('listorder' => $val);
            $this->load->model('user_group');
            $this->user_group->update(array('id' => $id[$key]), $data);
        }
        $this->showmessage('group_list', lang('com_order'), $this->admin_url . 'member/member/group_list?loghash=' . $this->session->userdata('loghash'));
    }

}
