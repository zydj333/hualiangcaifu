<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Document extends Admin_Controller {
    /**[后台]系统文章航管理**/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('document');
	}
	public function lists(){

		$list=$this->document->get_query(array('order_by'=>'doc_id asc'));

		$this->cismarty->assign('infolist',$list);
		$this->cismarty->assign('infopage','');

	    $this->cismarty->display('content/document/document.html');
	}

	public function doc_edit(){
	    if(isset($_POST['dosubmit'])){
		    $doc_id=$this->input->post('doc_id');
		    $doc_id=intval($doc_id);
		    $doc['doc_title']=$this->input->post('doc_title');
		    $doc['doc_content']=$this->input->post('doc_content');
		    $doc['doc_time']=time();
		    $file_ids=$this->input->post('file_id');
			$this->document->update(array('doc_id'=>$doc_id),$doc);
			if(!empty($file_ids)){
				$this->document->del(array('rel_id'=>$doc_id,'module'=>'document_content'),'uploadfile_rel');
				foreach($file_ids as $v){
					$this->document->add(array('file_id'=>intval($v),'rel_id'=>$doc_id,'shop_id'=>0,'module'=>'document_content'),'uploadfile_rel');
				}
			}
		    $this->showmessage('edit',lang('com_edit'),$this->admin_url.'content/document/lists?loghash='.$this->session->userdata('loghash'));

		}else{
		    $doc_id=$this->input->get('doc_id');
		    $doc_id=intval($doc_id);
		    $doc_info=$this->document->get_one(array('doc_id'=>$doc_id),'document');
			if($doc_info){
				$this->load->model('uploadfile');
				$file_rel_list=$this->uploadfile->get_query(array('rel_id'=>$doc_info['doc_id'],'module'=>'document_content'),'uploadfile_rel');
				$file_list=array();
				if(!empty($file_rel_list)){
					$ids=0;
					foreach($file_rel_list as $v){
						$ids.=','.$v['file_id'];
					}
					$file_list=$this->uploadfile->get_query('file_id in('.$ids.')','uploadfile');
				}
				$this->cismarty->assign('doc',$doc_info);
				$this->cismarty->assign('file_list',$file_list);
				$this->cismarty->display('content/document/document_edit.html');
			}else{
			    $this->showmessage('doc_edit',lang('com_parameter'),HTTP_REFERER);
			}
		}
	}
}