<?php
if ( ! function_exists('areas_select')){
	function areas_select($id,$value=false){
		$CI=&get_instance();
		$CI->load->model('areas','areas_db');
		$list=$CI->areas_db->get_all();
		$CI->load->helper('tree');
		$str="<option value='\$id' \".(\$ststctd==\$id?\"selected='selected'\":\"\").\" >\$icon\$name</option>";
		return arrtree($list,$str,array('ststctd'=>$value),'<select name="'.$id.'" id="'.$id.'" ><option value="0" >--无--</option>','</select>','id',"\$parent_id",array('│','├','&nbsp;&nbsp;','└'));
	}
}
if ( ! function_exists('areas_select3')){
	function areas_select3($id,$value=false,$index){
		$selectx=array();
		$parent_id=0;
		$CI->load->model('areas','areas_db');
		
		if(is_array($value)){
			
		}
		for($i=0;$i<$index;$i++){
			if($i==$index-1){
				$selectx[$i]='<select name="'.$id.($i+1).'" id="'.$id.($i+1).'"  ><option value="0" >--无--</option>';
			}
			else{
				$selectx[$i]='<select name="'.$id.($i+1).'" id="'.$id.($i+1).'" ><option value="0" >--无--</option>';
			}
			if($i==0){
				$lists=$CI->areas_db->get_query(array('parent_id'=>0));
			}else{
				if($parent_id!=0){
					$lists=$CI->areas_db->get_query(array('parent_id'=>$parent_id));
				}
			}
			foreach($lists as $list){
				$selectx[$i].='<option value="'.$list['id'].'" '.($parent_id==$list['id']?'selected="selected"':'').'>'.$list['name'].'</option>';
			}
			$selectx[$i].='</select>';
		}
		$selectinput='<input id="'.$id.'" name="'.$id.'" type="hidden" >';
	}
}
if ( ! function_exists('areas_box')){
	function areas_box($value){
	}
}
?>