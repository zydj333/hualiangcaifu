<?php if ( ! defined('ADMINPHP')) exit('No direct script access allowed');
class Help extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dbclass_model');
		$this->load->model('article_category');
		$this->load->model('article');
	}
	//帮助中心管理列表
    public function lists(){
	    $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$seldata['page']=$page;
    	$seldata['pagesize']=10;
    	$seldata['codetype']='help';
    	$seldata['title']=trim($this->input->post('search_title'));
    	$seldata['acid']=trim($this->input->post('search_ac_id'));

		$this->load->model('a_web_model');
		$list=$this->a_web_model->get_acticle_search($seldata);

		$ac_list = $this->article_category->get_query(array('ac_code' => 'help','order_by'=>'listorder desc'),'article_category');

		foreach($ac_list as $key=>$val){
			$ac_list[$key]['id']=$val['ac_id'];
			$ac_list[$key]['name']=$val['ac_name'];
		}
		$this->load->helper('tree');
		$ac_list=tr_sortdata($ac_list);

		$this->cismarty->assign('ac_list',$ac_list);
		$this->cismarty->assign('sel',$seldata);
		$this->cismarty->assign('infolist',$list['list']);
		$this->cismarty->assign('infopage',$list['page']);
    	$this->cismarty->display('content/help/help_lists.html');
    }
	//文章添加
	public function article_add(){
	    if(isset($_POST['dosubmit'])){
			$article['article_title'] = $this->input->post('article_title');
			$article['ac_id'] = $this->input->post('ac_id');
			$article['code_type'] = $this->input->post('codetype');
			$article['article_url'] = $this->input->post('article_url');
			$article['article_show'] = $this->input->post('article_show');
			$article['listorder'] = $this->input->post('article_sort');
			$article['article_content'] = $this->input->post('article_content');
			$article['article_time'] = time();
			$file_ids=$this->input->post('file_id');

			if($_FILES['acticle_logo']['error'] == 0){
			    /***保存图片***/
			    $this->user_id=$this->session->userdata('admin_user_id');
			    $this->load->library('iupload_lib');
			    $config=array(
				       'module'=>'acticle_logo',
				       'dir'=>'acticle',
				       'shop_id'=>0,
				       'isadmin'=>1,
			                     );
		        $this->iupload_lib->initialize($config);//配置初始化文件
	            $this->iupload_lib->do_uploadfile('acticle_logo');//上传附件
			    $file_id=$this->iupload_lib->save_data();//保存数据到数据库
			    if($file_id == TRUE){
		            $link_pic = $this->article->get_one(array('file_id'=>$file_id),'uploadfile','filepath');
		            $article['article_logo'] = $link_pic['filepath'];

			    }
			}
			$id=$this->article->add($article);
			if($id){
				if(!empty($file_ids)){
					foreach($file_ids as $v){
						$this->article->add(array('file_id'=>intval($v),'rel_id'=>$id,'shop_id'=>0,'module'=>'article_content'),'uploadfile_rel');
					}
				}
				if(isset($file_id) && $file_id>0){
					$this->article->add(array('file_id'=>$file_id,'rel_id'=>$id,'shop_id'=>0,'module'=>'article_logo'),'uploadfile_rel');
				}
			}
			$this->showmessage('article_add',lang('com_add'),$this->admin_url.'content/help/lists?loghash='.$this->session->userdata('loghash'));
		}else{
			$codetype=$this->input->get('code');
		    $ac_list = $this->article_category->get_query(array('ac_code' => $codetype,'order_by'=>'listorder desc'),'article_category');
			foreach($ac_list as $key=>$val){
				$ac_list[$key]['id']=$val['ac_id'];
				$ac_list[$key]['name']=$val['ac_name'];
			}
			$this->load->helper('tree');
			$ac_list=tr_sortdata($ac_list);

			$this->cismarty->assign('ac_list',$ac_list);
			$this->cismarty->assign('codetype',$codetype);
		    $this->cismarty->display('content/help/help_add.html');
		}

	}
	//文章编辑
	public function article_edit(){
	    if(isset($_POST['dosubmit'])){
	    	$_data_post=$this->input->post();

		    $article_id = $this->input->post('article_id');
			$article['article_title'] = $this->input->post('article_title');
			$article['ac_id'] = $this->input->post('ac_id');
			$article['code_type'] = $this->input->post('code_type');
			$article['article_url'] = $this->input->post('article_url');
			$article['article_show'] = $this->input->post('article_show');
			$article['listorder'] = $this->input->post('article_sort');
			$article['article_content'] = $this->input->post('article_content');
			$article['article_time'] = time();

			if($_FILES['acticle_logo']['error'] == 0){
			    /***保存图片***/
			    $this->user_id=$this->session->userdata('admin_user_id');
			    $this->load->library('iupload_lib');
			    $config=array(
				       'module'=>'acticle_logo',
				       'dir'=>'acticle',
				       'shop_id'=>0,
				       'isadmin'=>1,
			                     );
		        $this->iupload_lib->initialize($config);//配置初始化文件
	            $this->iupload_lib->do_uploadfile('acticle_logo');//上传附件
			    $file_id=$this->iupload_lib->save_data();//保存数据到数据库
			    if($file_id == TRUE){
		            $link_pic = $this->article->get_one(array('file_id'=>$file_id),'uploadfile','filepath');
		            $article['article_logo'] = $link_pic['filepath'];
		            $this->article->del(array('rel_id'=>$article_id,'shop_id'=>0,'module'=>'article_logo'),'uploadfile_rel');
		            $this->article->add(array('file_id'=>$file_id,'rel_id'=>$article_id,'shop_id'=>0,'module'=>'article_logo'),'uploadfile_rel');
			    }
			}

			$this->article->update(array('article_id'=>$article_id),$article);

			$file_ids=$this->input->post('file_id');
			if(!empty($file_ids)){
				$this->article->del(array('rel_id'=>$article_id,'module'=>'article_content'),'uploadfile_rel');
				foreach($file_ids as $v){
					$this->article->add(array('file_id'=>intval($v),'rel_id'=>$article_id,'shop_id'=>0,'module'=>'article_content'),'uploadfile_rel');
				}
			}
			$this->showmessage('success',lang('com_edit'),$this->admin_url.'content/help/lists?loghash='.$this->session->userdata('loghash'));
		}else{
		    $article_id = $this->input->get('article_id');
		    $article_info = $this->article->get_one(array('article_id'=>intval($article_id)),'article');
		    if(empty($article_info)) $this->showmessage('error',lang('com_parameter'),HTTP_REFERER);

		    $ac_list = $this->article_category->get_query(array('ac_code' => 'help','order_by'=>'listorder desc'),'article_category');
			foreach($ac_list as $key=>$val){
				$ac_list[$key]['id']=$val['ac_id'];
				$ac_list[$key]['name']=$val['ac_name'];
			}
			$this->load->helper('tree');
			$ac_list=tr_sortdata($ac_list);

			$this->load->model('uploadfile');

			$file_rel_list=$this->article_category->get_query(array('rel_id'=>$article_info['article_id'],'module'=>'article_content'),'uploadfile_rel');
			$file_list=array();
			if(!empty($file_rel_list)){
				$ids=0;
				foreach($file_rel_list as $v){
					$ids.=','.$v['file_id'];
				}
				$file_list=$this->article_category->get_query('file_id in('.$ids.')','uploadfile');
			}

		    $this->cismarty->assign('article',$article_info);
			$this->cismarty->assign('ac_list',$ac_list);
			$this->cismarty->assign('file_list',$file_list);
			$this->cismarty->display('content/help/help_edit.html');
		}
	}
	//文章删除
	public function article_del(){
	    $_data_post=$this->input->post();
		$article_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;
		if($article_id !== false){
		    foreach($article_id as $val){
			    $where = array('sts' => 1);
				$return = $this->article->update(array('article_id'=>$val),$where);
			}
		}else{
		    $this->showmessage('article',lang('com_parameter'),HTTP_REFERER);
		}
		$this->showmessage('article',lang('com_del'),$this->admin_url.'content/help/lists?loghash='.$this->session->userdata('loghash'));
	}
    //帮助分类列表
    public function article_category(){
	    $this->load->library('ichar');
		$page=$this->input->get('page');
		$page=$this->ichar->act($page,'int');

		$list=$this->article_category->get_query(array('ac_code'=>'help','order_by'=>'listorder desc'));

		$gc_list = array();
		foreach($list as $key=>$val){
			if($val['parent_id'] ==0 ) {
				$gc_list[$val['ac_id']]=$val;
				$gc_list[$val['ac_id']]['have_child']=0;
			}
		}
		foreach($list as $key=>$val){
			if($val['parent_id'] >0 ){
				if(isset($gc_list[$val['parent_id']])) $gc_list[$val['parent_id']]['have_child']=1;
			}
		}
		$this->cismarty->assign('codetype','help');
		$this->cismarty->assign('infolist',$gc_list);
    	$this->cismarty->display('content/help/help_category.html');
    }

	/**
	 * 更新分类缓存
	 */
    public function article_category_cache(){

		$where = array('order_by'=>'listorder asc,ac_id asc');
		$catedatalist = $this->article_category->get_query($where,'article_category');
		$arr=array();
		foreach($catedatalist as $v){
			$arr[$v['ac_id']]=$v;
		}
		foreach($arr as $v){
			if(intval($v['parent_id'])>0){
				$allson=isset($arr[$v['parent_id']]['allson'])?$arr[$v['parent_id']]['allson']:'';
				$arr[$v['parent_id']]['allson']=$allson.','.$v['ac_id'];
			}
		}
		foreach($arr as $v){
			if(isset($arr[$v['ac_id']]['allson']) && !empty($arr[$v['ac_id']]['allson'])){
				$allson=$arr[$v['ac_id']]['allson'];
				$arr_allson=explode(',',$allson);
				foreach($arr_allson as $sv){
					$s_allson=isset($arr[$sv]['allson'])?$arr[$sv]['allson']:'';
					$allson=empty($s_allson)?$allson:$allson.$s_allson;
				}
				$arr[$v['ac_id']]['allson']=$v['ac_id'].$allson;
			}else{
				$arr[$v['ac_id']]['allson']='';
			}
		}
		setcache('article_category', $arr, 'commons');
		$this->showmessage('article_category',lang('com_cache'),HTTP_REFERER);
    }

	//AJAX获取子分类
	public function ajax_category_class(){
	    $gc_parent_id = $this->input->get('parent_id');
	    $gc_code = $this->input->get('code');
		$where = array('order_by'=>'listorder desc','parent_id' => $gc_parent_id,'ac_code' => $gc_code);
		$data = $this->article_category->get_query($where,'article_category');
		foreach($data as $key => $val){
		    $where = array('parent_id' => $val['ac_id'],);
		    $v = $this->article_category->get_query($where,'article_category');
			if($v){
			    $data[$key]['have_child'] = '1';
				$data[$key]['deep'] = '0';
			}else{
			    $data[$key]['have_child'] = '2';
			    $data[$key]['deep'] = '1';
			}
		}
		echo json_encode($data);
	}
	//分类新增
	public function article_category_add(){
	    if(isset($_POST['dosubmit'])){
	    	$code_type = $this->input->post('code_type');
		    $article_category['ac_name'] = $this->input->post('ac_name');
		    $article_category['ac_code'] = $this->input->post('code_type');
			$article_category['parent_id'] = $this->input->post('ac_parent_id');
			$article_category['listorder'] = $this->input->post('ac_sort');
			//$article_category['ac_url'] = $this->input->post('ac_url');

			$this->article_category->add($article_category);
			if($code_type == 'news'){
				$this->showmessage('article_category',lang('com_add'),$this->admin_url.'content/help/article_category?loghash='.$this->session->userdata('loghash'));
	    	}else{
	    		$this->showmessage('article_category',lang('com_add'),$this->admin_url.'content/help/article_category?loghash='.$this->session->userdata('loghash'));
	    	}
		}else{
		    $parent_id = $this->input->get('parent_id');
		    $code_type = $this->input->get('code');
		    $article_category = $this->article_category->get_query(array('ac_id'=>$parent_id,'ac_code' => $code_type),'article_category');

			if($parent_id != ''){
			    $this->cismarty->assign('parent_id',$parent_id);
			}
			$this->cismarty->assign('code_type',$code_type);
			$this->cismarty->assign('article_category',$article_category);
	        $this->cismarty->display('content/help/help_category_add.html');
		}
	}
	//分类编辑
	public function article_category_edit(){
	    if(isset($_POST['dosubmit'])){
	    	$ac_code = $this->input->post('ac_code');
		    $article_category['ac_name'] = $this->input->post('ac_name');
			$article_category['listorder'] = $this->input->post('ac_sort');
			$article_category['ac_url'] = $this->input->post('ac_url');
			$ac_id = $this->input->post('ac_id');
			$this->article_category->update(array('ac_id'=>$ac_id),$article_category);
			if($ac_code == 'news'){
				$this->showmessage('article_category',lang('com_edit'),$this->admin_url.'content/article/article_category?loghash='.$this->session->userdata('loghash'));
	    	}else{
	    		$this->showmessage('article_category',lang('com_edit'),$this->admin_url.'content/help/article_category?loghash='.$this->session->userdata('loghash'));
	    	}
        }else{
		    $ac_id = $this->input->get('ac_id');
			$article_category = $this->article_category->get_one(array('ac_id'=>intval($ac_id)),'article_category');
			if(empty($article_category)) $this->showmessage('error',lang('com_parameter'),HTTP_REFERER);

			$this->cismarty->assign('category',$article_category);
		    $this->cismarty->display('content/help/help_category_edit.html');
		}
	}
	//分类删除
	public function article_category_del(){
	    $_data_post=$this->input->post();
		$ac_id=isset($_data_post['del_id'])?$_data_post['del_id']:null;
		if($ac_id !== false){
		    foreach($ac_id as $val){
			    //删除该分类下的子分类
			    $where = array('parent_id' => $val);
					$category = $this->dbclass_model->get_one($where,'article_category');
					if($category !== false){
				    $parent = $this->article_category->del($where,'article_category');
					}else{
				    $parent = 'Null';
					}
					//子分类删除成功，则删除分类，否则返回上一页
					if($parent !== false){
				    //删除分类
				    $where = array('ac_id' => $val);
				    $return = $this->article_category->del($where,'article_category');
					}else{
				    $this->showmessage('article_category',lang('com_parameter'),HTTP_REFERER);
					}
				}
		}else{
		    $this->showmessage('article_category',lang('com_parameter'),HTTP_REFERER);
		}
		$this->showmessage('article_category',lang('com_del'),$this->admin_url.'content/help/article_category?loghash='.$this->session->userdata('loghash'));
	}
	//分类排序
	public function article_category_order(){
	    $ac_id = $this->input->post('hdnid');
		$listorder = $this->input->post('listorder');


		foreach($listorder as $key => $val){
		    $data = array('listorder' => $val);
			$this->load->model('article_category');
		    $edit = $this->article_category->update(array('ac_id'=>$ac_id[$key]),$data);
		}
		$this->showmessage('article_category',lang('com_order'),$this->admin_url.'content/help/article_category?loghash='.$this->session->userdata('loghash'));
	}
	//AJAX判断分类名称是否存在
	public function ajax_ac_name(){
	    $ac_name = $this->input->get('ac_name');
		$parent_id = $this->input->get('ac_parent_id');
		$ac_id = $this->input->get('ac_id');
		if(isset($ac_id)){
		    $where = array('ac_name' => $ac_name,'ac_id' => $ac_id,'parent_id' => $parent_id);
		    $d = $this->article_category->get_one($where,'article_category');
		}
		if(isset($d['ac_name'])==$ac_name){
		    echo 'true';
		}else{
		    $where = array('ac_name' => $ac_name);
		    $r = $this->article_category->get_one($where,'article_category');
		    if(isset($r)){
			    if(isset($r['ac_name'])==$ac_name) echo 'false';else echo 'true';
		    }else {
			    echo 'true';
	     	}
		}
	}
}