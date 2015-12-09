<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Dictionary extends Admin_Controller {

	/*
	    数据字典管理
	*/
	public function __construct()
	{
		parent::__construct();
		$this->tb_dict='sys_dictionary';
		$this->load->model('sys_dictionary');
	}
	//分页列表
	public function lists(){
	  $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    $seldata['pagesize']=10;
    if(isset($_GET['dosubmit'])){
		  $seldata['search_tbname'] = $this->input->get('search_tbname');
			$seldata['search_colname'] = $this->input->get('search_colname');
			$seldata['search_colvalue'] = $this->input->get('search_colvalue');

			$this->cismarty->assign('search_tbname',$seldata['search_tbname']);
			$this->cismarty->assign('search_colname',$seldata['search_colname']);
			$this->cismarty->assign('search_colvalue',$seldata['search_colvalue']);
			$this->cismarty->assign('form_submit',$_GET['dosubmit']);
		}
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_dictionary_search($seldata);
		$funds_list = $list ['list'];

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$list ['list']);
		$this->cismarty->assign('infopage',$list['page']);

	  $this->cismarty->display('maintenance/dictionary/dictionary_list.html');
	}
	//添加
	public function dictionary_add(){
		if(isset($_POST['dosubmit'])){
			$dict['table_name'] = $this->input->post('table_name');
		  $dict['column_name'] = $this->input->post('column_name');
		  $dict['column_title'] = $this->input->post('column_title');
		  $dict['column_value'] = $this->input->post('column_value');
		  $dict['listorder'] = $this->input->post('listorder');
		  $dict['remark'] = $this->input->post('remark');
		  $dict['sts'] = 0;

			//添加记录
			$res = $this->sys_dictionary->add($dict,$this->tb_dict);
			  
			$this->showmessage('success',lang('com_add'),$this->admin_url.'maintenance/dictionary/lists?loghash='.$this->session->userdata('loghash'));
		}else{
		  $this->cismarty->display('maintenance/dictionary/dictionary_add.html');
		}
	}
	
	//添加
	public function dictionary_edit(){
		if(isset($_POST['dosubmit'])){
			$dict_id = $this->input->post('dict_id');
			$dict['table_name'] = $this->input->post('table_name');
		  $dict['column_name'] = $this->input->post('column_name');
		  $dict['column_title'] = $this->input->post('column_title');
		  $dict['column_value'] = $this->input->post('column_value');
		  $dict['listorder'] = $this->input->post('listorder');
		  $dict['remark'] = $this->input->post('remark');
		  $dict['sts'] = 0;

			$res = $this->sys_dictionary->update(array('id'=>$dict_id),$dict);
			  
			$this->showmessage('success',lang('com_edit'),$this->admin_url.'maintenance/dictionary/lists?loghash='.$this->session->userdata('loghash'));
		}else{
			$dict_id=$this->input->get('id');
			$dict_id=intval($dict_id);
			if( $dict_id == 0 ) $this->showmessage('success',lang('com_parameter'),$this->admin_url.'maintenance/dictionary/lists?loghash='.$this->session->userdata('loghash'));


			$dict = $this->sys_dictionary->get_one(array('id' => $dict_id),'sys_dictionary');
			if($dict==FALSE){
				$this->showmessage('success',lang('com_parameter'),$this->admin_url.'maintenance/dictionary/lists?loghash='.$this->session->userdata('loghash'));
			}
			
			$this->cismarty->assign('dict',$dict);
		  $this->cismarty->display('maintenance/dictionary/dictionary_edit.html');
		}
	}

	 //删除
    public function dictionary_del(){
	    $_data_post=$this->input->post();
			$ids = isset($_data_post['del_id'])?$_data_post['del_id']:null;

			foreach($ids as $val){
				$where = array('id' => $val);
				$return = $this->sys_dictionary->update($where,array('sts' => '1'));
			}

			$this->showmessage('link_del',lang('com_del'),$this->admin_url.'maintenance/dictionary/lists?loghash='.$this->session->userdata('loghash'));
		}
		
		
		//排序
		public function dictionary_order(){
	    $lc_id = $this->input->post('id');
			$listorder = $this->input->post('listorder');

			foreach($listorder as $key => $val){
		    $data = array('listorder' => $val);
		    $this->sys_dictionary->update($lc_id[$key],$data);
			}
			$this->showmessage('success',lang('com_order'),HTTP_REFERER);
		}

}