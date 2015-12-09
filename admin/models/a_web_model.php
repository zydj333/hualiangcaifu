<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_web_model extends MY_model {
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
	 * 文章搜索
	 */
	public function get_acticle_search($data){

		$where='a.sts=0';

		if(! empty($data['codetype'])) $where .= ' and a.code_type=\''.$data['codetype'].'\'';
		if(!empty($data['title'])) $where .= ' and  a.article_title like \'%'.$this->_db_read->escape_str($data['title']).'%\'';
		if(isset($data['acid']) && intval($data['acid'])>0){
			//$this->article_category->
			$ac_info=$this->get_one(array('ac_id'=>intval($data['acid'])),'article_category');
			$ac_list=array();
			if(!empty($ac_info) && $ac_info['parent_id']==0){
				$ac_list=$this->get_query(array('parent_id'=>$ac_info['ac_id']),'article_category');
			}
			if(empty($ac_list)){
				$where .= ' and a.ac_id = '.intval($data['acid']);
			}else{
				$ac_ids=$ac_info['ac_id'];
				foreach($ac_list as $v){
					$ac_ids.=','.$v['ac_id'];
				}
				$where .= ' and a.ac_id in('.$ac_ids.') ';
			}
		}

		$sql_data['table']='article as a';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'  a.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' a.listorder desc,a.article_time desc';

		$res=$this->get_search_page($sql_data);
		return $res;
	}

	/**
	 * 广告搜索
	 */
	public function get_adv_search($data){

		$where='a.sts=0';
		if(isset($data['startdate']) && !empty($data['startdate'])) $where .= ' and  a.adv_start_date >= '.strtotime($data['startdate']);
		if(isset($data['enddate']) && !empty($data['enddate'])) $where .= ' and  a.adv_start_date <= '.strtotime($data['enddate'].' 23:59:59');
		if(isset($data['act']) && intval($data['act'])>0 ){
			if(intval($data['act']) ==1 ){
				$where .= ' and a.adv_end_date >= '.time();
			}elseif(intval($data['act'])==2){
				$where .= ' and a.adv_start_date <= '.time();
			}
		}
		if(!empty($data['name'])) $where .= ' and  a.adv_title like \'%'.$this->_db_read->escape_str($data['name']).'%\'';

		$sql_data['table']='adv as a';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' a.* ';
		$sql_data['where']=$where;

		$res=$this->get_search_page($sql_data);
		return $res;
	}

	/**
	 * 广告位置搜索
	 */
	public function get_adv_position_search($data){

		$where='ap.sts=0';

		if(!empty($data['name'])) $where .= ' and  ap.ap_name like \'%'.$this->_db_read->escape_str($data['name']).'%\'';

		$sql_data['table']='adv_position as ap';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'  ap.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']='ap.ap_id desc';

		$res=$this->get_search_page($sql_data);
		return $res;
	}

	/**
	 * 导航栏置搜索
	 */
	public function get_navigation_search($data){

		$where='n.sts=0';

		if(!empty($data['navtitle'])) $where .= ' and  n.nav_title like \'%'.$this->_db_read->escape_str($data['navtitle']).'%\'';
		if(!empty($data['navlocation'])) $where .= ' and  n.nav_location = '.intval($data['navlocation']);

		$sql_data['table']='navigation as n';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:'  n.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']='n.listorder asc';

		$res=$this->get_search_page($sql_data);
		return $res;
	}

	/**
	 *faq列表
	 */
	public function get_faq_search($data){

		$where = '1 ';
		if(!empty($data['search_name'])){
 			$where.= ' and g.question LIKE \'%'.$this->_db_read->escape_str($data['search_name']).'%\'';
		}

		$sql_data['table']='faq as g ';
		$sql_data['page']=$data['page'];
		$sql_data['pagesize']=$data['pagesize'];
		$sql_data['fields']=isset($data['fields'])?$data['fields']:' g.* ';
		$sql_data['where']=$where;
		$sql_data['orderby']=' g.ordering asc,g.create_time desc';

		$res=$this->get_search_page($sql_data);
		return $res;
	}
}