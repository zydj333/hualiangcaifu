<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');

class Role extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->tb_role='sys_role';
		$this->tb_role_priv='sys_role_priv';
		$this->tb_site='sys_site';
		$this->tb_menu='sys_menu';
	}

    function role_list()
	{
		$this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');
		$rolename=trim($this->input->get('rolename'));

		$seldata['page']=$page;
    	$seldata['pagesize']=10;
    	$seldata['rolename']=$rolename;
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_role_search($seldata);

		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);
		$this->cismarty->display('system/role/role_list.html');

	}

	function role_del()
	{
		if(isset($_POST['dosubmit'])){
			$_data_post=$this->input->post();
			$ids=isset($_data_post['ckbid'])?$_data_post['ckbid']:null;
			if(!empty($ids))
 			{
				$this->load->model('a_system_model');
				foreach($ids as $key=>$val)
				{
					if($val != 1){//角色id=1时禁止删除
						$this->a_system_model->update(array('id'=>$val),array('sts'=>1),$this->tb_role);
						$this->a_system_model->del(array('role_id'=>$val),$this->tb_role_priv);
					}
				}
 			}
 			$this->showmessage('go',lang('com_success'),HTTP_REFERER);
		}
		$this->showmessage('goback',lang('com_parameter'),HTTP_REFERER);
	}

	function role_edit()
	{
		if(isset($_POST['dosubmit'])){
 			$_data_post=$this->input->post();
			$_data=$_data_post['info'];

			$this->load->model('a_system_model');
		    $this->a_system_model->update(array('id'=>$_data['id']),$_data,$this->tb_role);
			$this->showmessage('editdialog',lang('com_edit'),HTTP_REFERER);
		}else{
			$id=$this->input->get('id');
			$id=intval($id);
			if( $id == 0 ) $this->showmessage('editdialog',lang('com_parameter'),HTTP_REFERER);

			$this->load->model('a_system_model');
			$info=$this->a_system_model->get_info($id,$this->tb_role);
			$sitelist=$this->a_system_model->get_query(array('sts'=>0,'order_by'=>'listorder asc'),$this->tb_site);

			$this->cismarty->assign('info',$info);
			$this->cismarty->assign('sitelist',$sitelist);
			$this->cismarty->display('system/role/role_edit.html');
		}
	}

	function role_add()
	{
		if(isset($_POST['dosubmit'])){
 			$_data_post=$this->input->post();
			$_data=$_data_post['info'];

			$this->load->model('a_system_model');
		    $this->a_system_model->add($_data,$this->tb_role);
			$this->showmessage('adddialog',lang('com_add'),HTTP_REFERER);
		}else{
			$this->load->model('a_system_model');
			$sitelist=$this->a_system_model->get_query(array('sts'=>0,'order_by'=>'listorder asc'),$this->tb_site);
			$this->cismarty->assign('sitelist',$sitelist);
			$this->cismarty->display('system/role/role_add.html');
		}
	}

	/**
	 * 设置角色管理权限
	 */
	function role_menu()
	{
		if(isset($_POST['dosubmit'])){
 			$_data_post=$this->input->post();
			$_data=$_data_post['info'];

			$this->load->model('a_system_model');
			$this->a_system_model->del(array('role_id'=>$_data['id'],'site_id'=>$_data['site_id']),$this->tb_role_priv);
		    $ids=$_data['hdnids'];
			$arr_ids=	explode(',',$ids);
		    foreach($arr_ids as $item){
		    	if(intval($item)>0){
					$info_menu=$this->a_system_model->get_info($item,$this->tb_menu);
					$role_priv['role_id']=$_data['id'];
					$role_priv['site_id']=$_data['site_id'];
					$role_priv['m']=$info_menu['m'];
					$role_priv['c']=$info_menu['c'];
					$role_priv['a']=$info_menu['a'];
					$role_priv['data']=$info_menu['data'];
					$role_priv['menu_id']=$info_menu['id'];

					$this->a_system_model->add($role_priv,$this->tb_role_priv);
					unset($role_priv);
					unset($info_menu);
		    	}
		    }
			$this->showmessage('editdialog',lang('com_edit'),HTTP_REFERER);

		}else{
			$id=$this->input->get('id');
			$id=intval($id);
			if( $id == 0 ) $this->showmessage('editdialog',lang('com_parameter'),HTTP_REFERER);

			$this->load->model('a_system_model');
			$info=$this->a_system_model->get_info($id,$this->tb_role);
			$this->load->helper('tree');
			$trscript=tr_script('checkedit');

			$siteinfo=$this->a_system_model->get_info($info['site_id'],$this->tb_site);

			$menulist=$this->a_system_model->get_query(array('site_id'=>intval($info['site_id']),'isshow'=>1),$this->tb_menu);

			$rlist=$this->a_system_model->get_query(array('role_id'=>$id),$this->tb_role_priv);
			$rolelist=array();
			foreach($rlist as $key=>$val){
				$rolelist[]=$val['menu_id'];
			}


			$this->cismarty->assign('menulist',$menulist);
			$this->cismarty->assign('rolelist',$rolelist);
			$this->cismarty->assign('treescript',$trscript);
			$this->cismarty->assign('info',$info);
			$this->cismarty->assign('siteinfo',$siteinfo);
			$this->cismarty->display('system/role/role_menu.html');
		}
	}

}