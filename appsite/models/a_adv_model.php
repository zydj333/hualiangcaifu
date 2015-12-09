<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_adv_model extends MY_model {
   
    public function __construct()
    {
 		parent::__construct();
    }
    //取出某个广告位置的所有的时间满足的广告
    public function get_promotion_list($data){
    	if (empty($data['apid'])) {
    		return null;
    	}
    	$ap_id = intval($data['apid']);
    	$ap_info = $this->get_one(array('is_use'=>1, 'sts'=>0, 'ap_id'=>$ap_id), 'adv_position');
    	if (!count($ap_info)) {
    		return null;
    	}
    	$t = time();
    	//目前没有limit 和 offset 等控制
    	$adv_info = $this->get_query(array('ap_id'=>$ap_id, 'adv_start_date <'=>$t, 'adv_end_date >'=>$t, 'sts'=>0, 'order_by'=>'slide_sort ASC'), 'adv');

    	foreach ($adv_info as &$value) {
    		$value['width'] = $ap_info['ap_width'];
    		$value['height'] = $ap_info['ap_height'];
    		$value['adv_content'] = unserialize($value['adv_content']);
    	}

    	return $adv_info;
    }
    
    //取出某个广告位置的满足时间的当张广告广告
    public function get_promotion_single($data){
    	if (empty($data['apid'])) {
    		return null;
    	}

    	$ap_id = intval($data['apid']);
    	$ap_info = $this->get_one(array('is_use'=>1, 'sts'=>0, 'ap_id'=>$ap_id), 'adv_position');
    	if (!count($ap_info)) {
    		return null;
    	}
    	$t = time();
    	//目前没有limit 和 offset 等控制
    	$adv_info = $this->get_query(array('ap_id'=>$ap_id, 'adv_start_date <'=>$t, 'adv_end_date >'=>$t, 'sts'=>0,'limit'=> 1, 'order_by'=>'slide_sort DESC'), 'adv');

    	foreach ($adv_info as &$value) {
    		$value['width'] = $ap_info['ap_width'];
    		$value['height'] = $ap_info['ap_height'];
    		$value['adv_content'] = unserialize($value['adv_content']);
    	}
    	
    	return $adv_info;
    }
 }