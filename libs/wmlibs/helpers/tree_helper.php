<?php

if ( ! function_exists('tr_sortdata'))
{
		/**
	 * @param
	 * @return array
	 * @brief 无限极分类递归函数
	 */
	function tr_sortdata($catArray, $id = 0 , $prefix = '')
	{
		static $formatCat = array();
		static $floor     = 0;

		$cat_parent=array();
		$stack=array();
		$stackx=array();
		foreach($catArray as $key => $val){
			$cat_parent_id[$val['parent_id']][]=$val;
			if($val['parent_id']==0){
				$val['floor']=$floor;
				$stack[]=$val;
			}
		}
		$stack=array_reverse($stack);
		while(count($stack)){
			$val=array_pop($stack);
			if(isset($cat_parent_id[$val['id']])){
				$stackx=$cat_parent_id[$val['id']];
				$val['isdel']=0;
			}else{
				$val['isdel']=1;
			}
			$str=tr_nstr($prefix,$floor);
			$val['name'] = $str.$val['name'];
			$floor=$val['floor']+1;
			$formatCat[]  = $val;
			while(count($stackx)){
				$valx=array_pop($stackx);
				$valx['floor']=$floor;
				$stack[]=$valx;
			}
		}
		return $formatCat;
	}
}
if ( ! function_exists('tr_nstr'))
{
	//显示缩进
	function tr_nstr($str,$num=0)
	{
		$return = '';
		for($i=0;$i<$num;$i++)
		{
			$return .= $str;
		}
		return $return;
	}
}
if( ! function_exists('tr_getsub'))
{
	/**
	 * 获取某一个节点的子节点
	 *
	 */
	function tr_getsub($catArray,$pid,$type=true)
	{
		$retlist=array();
		//---获取所有子节点
		if($type==true){
			foreach($catArray as $key => $val){
				if($val['parent_id']==$pid){
					$retlist[$key]=$val;
					$list=tr_getsub($catArray,$val['id']);
					$retlist=array_merge($retlist,$list);
				}
			}
		}else{
			foreach($catArray as $key => $val){
				if($val['parent_id']==$pid){
					$retlist[$key]=$val;
				}
			}
		}
		return $retlist;
	}
}

if( ! function_exists('tr_getsubid'))
{
	/**
	 * 获取某一个节点的子节点的ID
	 * 返回字符串格式
	 */
	function tr_getsubid($catArray,$pid,$type=true)
	{
		$str='';
		$list=tr_getsub($catArray,$pid,$type);
		$i=0;
		$arr_n=count($list)-1;
		foreach($list as $item){
			$str.=$item['id'];
			if($arr_n!=$i){$str.= ',';}
			$i++;
		}
		return $str;
	}
}

if ( ! function_exists('tr_script'))
{
	/**
	 * 输出树形菜单 需要应用的js文件
	 */
	function tr_script($type=''){
		$res='<link rel="stylesheet" href="'.base_url().'statics/admin/js/ztree/zTreeStyle/zTreeStyle.css" type="text/css">';
		$res.= '<script  type="text/javascript" src="'.base_url().'statics/admin/js/ztree/jquery-1.4.4.min.js"></script>';
		$res.= '<script  type="text/javascript" src="'.base_url().'statics/admin/js/ztree/jquery.ztree.core-3.2.min.js"></script>';
		if(!empty($type)){
			$pos = strpos($type, 'check');
			if($pos !== false)
				$res.= '<script  type="text/javascript" src="'.base_url().'statics/admin/js/ztree/jquery.ztree.excheck-3.2.min.js"></script>';
			$pos = strpos($type, 'edit');
			if($pos !== false)
				$res.= '<script  type="text/javascript" src="'.base_url().'statics/admin/js/ztree/jquery.ztree.exedit-3.2.min.js"></script>';
		}

		return $res;

	}
}
if ( ! function_exists('arrtree')){
	function arrtree($data,$str,$variable=false,$herder='',$foot='',$key='id',$_parent_id="\$parent_id",$icons=array('&nbsp;&nbsp;&nbsp;│','&nbsp;&nbsp;&nbsp;├─','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;└─')){
		if($variable){
			@extract($variable);
		}
		$datax=array();
		$datas=array();
		$stack=array();
		$return=$herder;
		$stack1=array();
		foreach($data as $k=>$v){
			//$parent_id=eval('$v'.$parent_id);
			@extract($v);
			eval('$parentid="'.$_parent_id.'";');
			$v['childids']=array();
			if(isset($datas[$v[$key]]['childids'])){
				$v['childids']=$datas[$v[$key]]['childids'];
			}
			//echo 'id:'.$key.'<br>';
			$datas[$v[$key]]=$v;
			if($parent_id){
				$datas[$parent_id]['childids'][]=$v[$key];
			}else{
				$stack1[]=$v[$key];
			}
			foreach($v as $kc=>$vc){
				eval('unset($'.$kc.');');
			}
		}

		while(count($stack1)){
			$k=array_pop($stack1);
			$stack[]=$k;
			$datas[$k]['icon']='';
		}
		
		while(count($stack)){
			$t_id=array_pop($stack);

			$t=$datas[$t_id];
			$childids=array();
			$icon='';
			@extract($t);
			$x=$t['icon'];
			$ret='';
			eval('$ret = "'.$str.'";');
			//echo '$ret = "'.$str.'";';
			$return.=$ret;
			if(isset($childids) && is_array($childids)){
				$i=0;
				while(count($childids)){
					$k=array_pop($childids);
					$stack[]=$k;
					$x=str_replace($icons[1],$icons[0],$x);
					$x=str_replace($icons[3],$icons[2],$x);
					if($i==0){
						$datas[$k]['icon']=$x.$icons[3];
						$i++;
					}else{
						$datas[$k]['icon']=$x.$icons[1];
					}
				}
			}
			foreach($t as $kc=>$vc){
				eval('unset($'.$kc.');');
			}
		}
		$return.=$foot;
		return $return;
	}
}