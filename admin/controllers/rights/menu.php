<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');

class Menu extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->tb_menu='sys_menu';
	}

	function menu_list()
	{
		$pid=$this->input->get('pid');
		$ac=$this->input->get('ac');
		$menulist=$menuinfo=array();

		//获取子菜单权限
		$this->load->model('a_system_model');
		$menudata['parent_id']=intval($pid);
		$menudata['order_by']='listorder asc';
		$menulist=$this->a_system_model->get_query($menudata,$this->tb_menu);

		//添加树型菜单层级
		$this->load->helper('tree');
		$menuinfo=$this->a_system_model->get_info($pid,$this->tb_menu);

		$data['menulist']=$menulist;
		$data['menuinfo']=$menuinfo;
		$data['pid']=intval($pid);
		$data['isleft']=1;
		$data['ac']=$ac;

		$this->cismarty->assign('data',$data);
		$this->cismarty->assign('menulist',$menulist);
		$this->cismarty->display('rights/menu/menu_list.html');
	}

	function menu_add()
	{
		if(isset($_POST['dosubmit'])){
 			$_data_post=$this->input->post();
			$_data=$_data_post['info'];

			$this->load->model('a_system_model');
		  $this->a_system_model->add($_data,$this->tb_menu);

 			$this->showmessage('add','操作成功',$this->admin_url.'rights/menu/menu_list?loghash='.$this->session->userdata('loghash').'&pid='.$_data['parent_id'].'&ac=1');
		}else{
			$this->load->model('a_system_model');
			$pid=$this->input->get('pid');

			$pinfo=$this->a_system_model->get_info(intval($pid),$this->tb_menu);

			$this->cismarty->assign('pid',$pid);
			$this->cismarty->assign('pinfo',$pinfo);
			$this->cismarty->display('rights/menu/menu_add.html');
		}
	}

	function menu_edit()
	{
		if(isset($_POST['dosubmit'])){
 			$_data_post=$this->input->post();
			$_data=$_data_post['info'];

			$this->load->model('a_system_model');
		    $this->a_system_model->update(array('id'=>$_data['id']),$_data,$this->tb_menu);

 			$this->showmessage('edit','操作成功',$this->admin_url.'rights/menu/menu_list?loghash='.$this->session->userdata('loghash').'&pid='.$_data['parent_id'].'&ac=1');
		}else{
			$id=$this->input->get('id');
			$this->load->model('a_system_model');
			$info=$this->a_system_model->get_info($id,$this->tb_menu);
			$pinfo=$this->a_system_model->get_info($info['parent_id'],$this->tb_menu);

			$this->cismarty->assign('info',$info);
			$this->cismarty->assign('pinfo',$pinfo);
			$this->cismarty->display('rights/menu/menu_edit.html');
		}
	}
	function menu_left(){
		$this->load->model('a_system_model');
		$this->load->helper('tree');
		$trscript=tr_script('checkedit');

		$this->cismarty->assign('treescript',$trscript);
		$this->cismarty->display('rights/menu/menu_left.html');
	}

	function menu_del()
	{
		$id=$this->input->get('id');
		if(empty($id)) $this->showmessage('goback','请选择要删除的项！',HTTP_REFERER);
		$this->load->model('a_system_model');
		$info=$this->a_system_model->get_info($id,$this->tb_menu);
		$_data_post=$this->input->post();
		if(!empty($info)){
			$list=$this->a_system_model->get_query(array('parent_id' => $id),$this->tb_menu);

			$this->load->helper('tree');
			$subids=tr_getsubid($list,$info['id']);
			$delids=$info['id'];
			if(!empty($subids)){
				$delids=$subids.','.$delids;
			}
			exit;
			$info=$this->a_system_model->del_menu_in($delids);
		}
		$this->showmessage('go','操作成功',$this->admin_url.'rights/menu/menu_list?loghash='.$this->session->userdata('loghash').'&pid='.$_data_post['parent_id'].'&ac=1');

	}

	function menu_order()
	{
		if(isset($_POST['dosubmit'])){
 			$_data_post=$this->input->post();
 			$ids=isset($_data_post['id'])?$_data_post['id']:null;
 			if(!empty($ids))
 			{
 				$this->load->model('a_system_model');
 				$listorders=$_data_post['listorder'];

				foreach($ids as $key=>$val)
				{
					$this->a_system_model->update(array('id'=>$val),array('listorder'=>$listorders[$key]),$this->tb_menu);
				}
 			}
 			$this->showmessage('go','操作成功',$this->admin_url.'rights/menu/menu_list?loghash='.$this->session->userdata('loghash').'&pid='.$_data_post['parent_id'].'&ac=1');
		}
	}

	/**
	 * 更新缓存
	 */
	function menu_cache()
	{
		$this->load->model('a_system_model');
		$list=$this->a_system_model->get_query(array('1'=>1),$this->tb_menu);
		$this->load->driver('cache');
		$this->cache->file->save('admin/menulist',$list, 10*365*24*60);
		$s= $this->cache->file->get('admin/menulist');
		$this->showmessage('goback','缓存更新成功',HTTP_REFERER);

	}

	/**
	 * 根据父ID获取子节点列表
	 */
	function get_sub_menu()
	{
		$id=$this->input->get('id');
		$data['parent_id'] = intval($id);
		$menudata['order_by']='listorder asc';
		$this->load->model('a_system_model');
		$menulist =$this->a_system_model->get_query($data,$this->tb_menu);
		$i=0;
		$arr_n=count($menulist)-1;
		echo '[';
		foreach($menulist as $item){
			echo "{ id:'". $item['id']."',	name:'".$item['name']."',isParent:true,click:'gourl(".$item['id'].");'}";
			if($arr_n!=$i){echo ',';}
			$i++;
		}
		echo ']';
	}

}