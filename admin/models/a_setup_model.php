<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_setup_model extends MY_model {
    /**
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
 		parent::__construct();
    }

	//邮件模板
	public function get_mail_templates_search($data){

		$where='';
		if(isset($data['type'])) $where= ' m.type = '.intval($data['type']);

		$sql_data['table']='mail_msg_temlates as m';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' m.* ';
		$sql_data['where']=$where;

		$res=$this->get_search_page($sql_data);
		return $res;

	}
 }
