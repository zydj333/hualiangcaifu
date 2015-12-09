<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_uploadfile_model extends MY_model {

	/**
	 * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
 		parent::__construct();
    }


	/**
	 * 保存信息到附件表
	 */
    public function save_uploadfile($data){

    	$id=$this->add($data,'uploadfile');
    	return $id;
    }

	/**
	 * 更新附件表信息
	 */
    public function update_uploadfile($where,$data){
		if(empty($where['file_id'])) return false;
    	$list=$this->update($where,$data,'uploadfile');
    	return $list;
    }

    /**
	 * 获取附件表信息
	 */
    public function get_uploadfile($where){

    	$list=$this->get_one($where,'uploadfile');
    	return $list;
    }

    /**
	 * 保存信息到附件(关联)表
	 */
    public function save_uploadfile_rel($data){
		if(empty($data['module'])) return false;
		if(empty($data['shop_id'])) return false;
		if(empty($data['file_id'])) return false;
		if(empty($data['rel_id'])) return false;

    	$id=$this->add($data,'uploadfile_rel');
    	return $id;
    }

    /**
	 * 获取关联表信息
	 */
    public function get_uploadfile_rel($where){

    	$list=$this->get_query($where,'uploadfile_rel');
    	return $list;
    }

    /**
	 * 更新关联表信息
	 */
    public function update_uploadfile_rel($where,$data){
		if(empty($where['module'])) return false;
		if(empty($where['shop_id'])) return false;
		if(empty($where['rel_id'])) return false;
		if(empty($data['file_id'])) return false;
    	$list=$this->update($where,$data,'uploadfile_rel');
    	return $list;
    }

    /**
	 * 删除关联表信息
	 */
    public function del_uploadfile_rel($where){

    	$res=$this->del($where,'uploadfile_rel');
    	return $res;
    }

        /**
	 * 删除附件表信息
	 */
    public function del_uploadfile($where){

    	$res=$this->del($where,'uploadfile');
    	return $res;
    }




}