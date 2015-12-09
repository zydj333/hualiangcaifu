<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of a_phone_code
 *
 * @createtime 2015-5-13 16:43:15
 * 
 * @author ZhangPing'an
 * 
 * @todo a_phone_code
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class a_phone_code extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据条件获取 
     * 
     */
    public function getcode($code, $phone) {
        $sql = "select * from db_user_phonecode where phonenumber='" . $phone . "' and phonecode=" . $code . ' and (status=0 or status=1) order by id desc limit 1';
        $query = $this->db->query($sql);
        return $query->row();
    }

    /**
     * 
     * @todo 修改短信状态 
     * 
     */
    public function editCodeStatus($data, $id) {
        return $this->db->update('db_user_phonecode', $data, array('id' => $id));
    }

}
