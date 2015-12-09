<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class a_pointer_model extends MY_model {
   
    public function __construct()
    {
 		parent::__construct();
    }
    
    public function getTickectList() {
    	$ticket_list = $this->get_query(array('sts'=>0, 'order_by'=>'listorder ASC'), 'ticket');
    	return $ticket_list;
    }
 }