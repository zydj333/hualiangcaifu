/**
*	公共JS处理类库
**/

var _init_serachform_name='searchfrom';
var _init_listform_name='listfrom';
//---查找---//
function searchList(fname){
	if("undefined" == typeof fname) fname=_init_serachform_name;
	alert(fname);
	var pro =document.getElementById(fname);
	pro.method = "post";
 	pro.submit();
}

//搜索
function search(url,fname){
	if(fname=='') fname=_init_form_name;
	var pro =document.getElementById(fname);
	pro.action = url;
	pro.method = "post";
 	pro.submit();
}

/*****删除--批量排序*****/
/*****列表专用：listform*****/
function doOrder(url){
	var formObj = document.getElementById(_init_listform_name);
	formObj.action = url;
	formObj.method = "post";
	formObj.submit();

}
/*****审核-批量删除*****/
function docheck(url,ckbid){
    if (!hasChecked(ckbid)){
    	jAlert('请先选中要审核的项！', '提示框');
	    return;
	}
	jConfirm('您确定要审核吗?', '提示对话框', function(r) {
		if(r){
			var formObj = document.getElementById(_init_listform_name);
			
			formObj.action = url;
			formObj.method = "post";
			formObj.submit();
		}
		return ;
	});
}
/*****删除--批量删除*****/
function dodel(url,ckbid){
    if (!hasChecked(ckbid)){
    	jAlert('请先选中要删除的项！', '提示框');
	    return;
	}
	jConfirm('您确定要删除吗?', '提示对话框', function(r) {
		if(r){
			var formObj = document.getElementById(_init_listform_name);
			//formObj.action = url +"?"+id+"="+ getCheckedValue(ckbid);
			
			formObj.action = url;
			formObj.method = "post";
			formObj.submit();
		}
		return ;
	});
}


/*****删除--删除一条*****/
function del(url,ckbid,id){
	setChecked(ckbid,id)
	dodel(url,ckbid);
}
/*****直接挑战的某一页面******/
/*****编辑，添加等*****/
function gourl(url){
	window.location.href=url;
}

/*****根据ID选择某个checkbox*****/
function setChecked(itemName,id){
	var items = document.getElementsByName(itemName);
    if(items){
		if(items.length){
        	for(var i=0;i<items.length;i++){
        		if(items[i].value==id)
        		{
        			items[i].checked=true;
        		}else{
        			items[i].checked=false;
        		}
			}
	  	}
   }
   return false;
}

/*****检查有没有被选中*****/
function hasChecked(itemName){
	var items = document.getElementsByName(itemName);
    if(items){
	  if(items.length){
        for(var i=0;i<items.length;i++){
			if(items[i].checked){
				return true;
			}
		}
	  }else{
		return items.checked;
	  }
   }
   return false;
}

/*****取选中的多选框*****/
function getCheckedValue(itemName){
	var items = document.getElementsByName(itemName);
	var ids = "";
    if(items){
	  if(items.length){
        for(var i=0;i<items.length;i++){
			if(items[i].checked){
				 if(ids == ""){
				 	ids = items[i].value;
				 }else{
				 	ids += "," +items[i].value;
				 }
			}
		}
	  }else{
		if(items.checked){
			ids= items.value;
		}
	  }
   }
   return ids;
}