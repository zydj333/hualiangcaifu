<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');

class Admini extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->tb_admini='sys_admini';
		$this->tb_role='sys_role';
		$this->tb_area='areas';
	}

    function admini_list()
	{
		$this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');
		$username=$this->input->get('username');
		$site_id=1;//$this->ichar->act($this->input->get('site_id'),'int');

		$seldata['page']=$page;
    	$seldata['pagesize']=10;
    	$seldata['username']=$username;
    	$seldata['site_id']=$site_id;
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_admini_search($seldata);

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);
		$this->cismarty->display('system/admini/admini_list.html');

	}

	function admini_del()
	{
		if(isset($_POST['dosubmit'])){
			$_data_post=$this->input->post();
			$ids=isset($_data_post['ckbid'])?$_data_post['ckbid']:null;
			if(!empty($ids))
 			{
				$this->load->model('a_system_model');
				foreach($ids as $key=>$val)
				{
					if($val !=1){//id=1禁止删除
						$this->a_system_model->update(array('id'=>$val),array('sts'=>1),$this->tb_admini);
					}
				}
 			}
 			$this->showmessage('go',lang('com_success'),HTTP_REFERER);
		}
		$this->showmessage('goback',lang('com_parameter'),HTTP_REFERER);
	}

	function admini_edit()
	{
		if(isset($_POST['dosubmit'])){
			$this->load->model('a_system_model');

 			$_data_post=$this->input->post();
 			$_data['id']=$_data_post['id'];
			$_data['username']=$_data_post['username'];
			$password=trim($_data_post['password']);
			if(!empty($password)) $password=$_data_post['password'];
			$_data['role_id']=$_data_post['role_id'];
			$_data['site_id']=$_data_post['site_id'];
			$_data['isclose']=$_data_post['isclose'];
			$encrypt = $this->a_system_model->get_one(array('id'=>$_data['id']),$this->tb_admini);
			$_data['password'] = md5(md5($password.$encrypt['encrypt']));


		    $this->a_system_model->update(array('id'=>$_data['id']),$_data,$this->tb_admini);
			$this->showmessage('editdialog',lang('com_edit'),HTTP_REFERER);
		}else{
			$id=$this->input->get('id');
			$id=intval($id);
			if( $id == 0 ) $this->showmessage('editdialog',lang('com_parameter'),HTTP_REFERER);

			$this->load->model('a_system_model');
			$info=$this->a_system_model->get_info($id,$this->tb_admini);
			if(empty($info)) $this->showmessage('editdialog',lang('com_parameter'),HTTP_REFERER);

			$rolelist=$this->a_system_model->get_query(array('sts'=>0,'site_id'=>1),$this->tb_role);
			$this->cismarty->assign('info',$info);
			$this->cismarty->assign('rolelist',$rolelist);
			$this->cismarty->display('system/admini/admini_edit.html');
		}
	}

	function admini_add()
	{
		if(isset($_POST['dosubmit'])){
 			$_data_post=$this->input->post();
			$_data['username']=$_data_post['username'];
			$password=$_data_post['password'];
			$_data['role_id']=$_data_post['role_id'];
			$_data['site_id']=$_data_post['site_id'];
			$_data['create_time']=time();
            $key = '';
			$pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ,./&lt;>?;#:@~[]{}-_=+)(*&^%___FCKpd___0pound;"!';
			$key = random(6,$pattern);
			$_data['password'] = md5(md5($password.$key));
			$_data['encrypt'] = $key;

			$this->load->model('a_system_model');
		    $this->a_system_model->add($_data,$this->tb_admini);
			$this->showmessage('adddialog',lang('com_add'),HTTP_REFERER);
		}else{
			$this->load->model('a_system_model');
			$rolelist=$this->a_system_model->get_query(array('sts'=>0,'site_id'=>1),$this->tb_role);
			$arealist=$this->a_system_model->get_query(array('parent_id'=> 0),$this->tb_area);
			$this->cismarty->assign('rolelist',$rolelist);
			$this->cismarty->assign('arealist',$arealist);
			$this->cismarty->display('system/admini/admini_add.html');
		}
	}

	/**
	 * 判断管理员名称是否重复
	 */
	function public_check_admini(){
		$username=trim($this->input->get('username'));
		$userid=trim($this->input->get('userid'));
		$this->load->model('a_system_model');
		$r=$this->a_system_model->get_one(array('username'=>$username),$this->tb_admini);
		if(count($r)){
			if($r['id']==$userid) echo 'true';else echo 'false';
		}else {
			echo 'true';
		}
	}

	/**
	 *  获取角色列表
	 */
	public function public_rolelist() {
		$site_id=$_GET['site_id'];
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_query(array('site_id'=>$site_id,'sts'=>0),$this->tb_role);
		$result=array();
		foreach($list as $item){
			$result[]=array('roleid'=>$item['id'],'rolename'=>$item['rolename']);
		}
		//$result = $this->db->select("$field LIKE('$catname%') AND site_id='$this->site_id' AND child=0 $sqlwhere",'catid,type,catname,letter',10);
		//if (CHARSET == 'gbk') {
			//$result = array_iconv($result, 'gbk', 'utf-8');
		//}
		echo json_encode($result);
	}

}