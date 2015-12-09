<?php /* Smarty version Smarty-3.1.11, created on 2014-12-23 14:54:07
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\system\menu\menu_list.html" */ ?>
<?php /*%%SmartyHeaderCode:205175499118f125a36-31242652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2709a716617762418586f9340de56456c3934a71' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\system\\menu\\menu_list.html',
      1 => 1382059202,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205175499118f125a36-31242652',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'admin_url' => 0,
    'COM' => 0,
    'menulist' => 0,
    'v' => 0,
    'base_url' => 0,
    'JS_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5499118f62b759_62272937',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5499118f62b759_62272937')) {function content_5499118f62b759_62272937($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['data']->value['isleft']==1&&$_smarty_tpl->tpl_vars['data']->value['site_id']==0){?>
<script>
parent.document.getElementById('display_center_id').style.display='';
parent.document.getElementById('center_frame').src='<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_left?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
';
</script>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['data']->value['ac']==1){?>
<script>
var _parentWin = window.parent ;
_parentWin.center_frame.refreashNode.click();
</script>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['data']->value['site_id']!=0){?>
<div class="page">
  	<div class="fixed-bar">
    	<div class="item-title">
      		<h3>系统菜单</h3>
      		<ul class="tab-base">
        		<li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
		        <li><a href="javascript:add(<?php echo $_smarty_tpl->tpl_vars['data']->value['pid'];?>
);" ><span>新增</span></a></li>
		        <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_cache?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&site_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['site_id'];?>
" ><span>更新缓存</span></a></li>
      		</ul>
    	</div>
  	</div>
	<div class="fixed-empty"></div>
<?php if (count($_smarty_tpl->tpl_vars['data']->value['menuinfo'])!=0){?>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title"><h5>当前权限/菜单描述</h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li>权限菜单：<?php echo $_smarty_tpl->tpl_vars['data']->value['menuinfo']['name'];?>
</li>
            <li>参数说明：模块名=<?php echo $_smarty_tpl->tpl_vars['data']->value['menuinfo']['m'];?>
;文件名=<?php echo $_smarty_tpl->tpl_vars['data']->value['menuinfo']['c'];?>
;方法名=<?php echo $_smarty_tpl->tpl_vars['data']->value['menuinfo']['a'];?>
</li>
            <li>额外参数：<?php if ($_smarty_tpl->tpl_vars['data']->value['menuinfo']['data']==null){?>无<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['data']->value['menuinfo']['data'];?>
<?php }?>;显示状态：<?php if ($_smarty_tpl->tpl_vars['data']->value['menuinfo']['isshow']==1){?>是<?php }else{ ?>否<?php }?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
<?php }?>
<form method='post'>
    <input type="hidden" name="dosubmit" value="1" />
    <input type="hidden" name="parent_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['pid'];?>
" />
    <input type="hidden" name="site_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['site_id'];?>
" />
    <table class="table tb-type2">
      	<thead>
        <tr class="thead">
        	<th>排序</th>
          	<th>ID</th>
          	<th></th>
          	<th>子权限/菜单名称</th>
          	<th>m/c/a</th>
          	<th class="align-center">显示</th>
          	<th class="align-center">菜单</th>
          	<th>操作</th>
        </tr>
      	</thead>
<tbody>
<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menulist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
<tr class="hover edit">
	<td class="w48 sort"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" name="id[]" id="id[]" /><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['listorder'];?>
" name="listorder[]" id="listorder[]" class="txt-short"></td>
	<td style='width:40px'><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
<td>
	<td class="w25pre name"><span ><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</span></td>
	<td><?php echo $_smarty_tpl->tpl_vars['v']->value['m'];?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value['c'];?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value['a'];?>
</td>
	<td class="align-center yes-onoff"><a href="JavaScript:void(0);" class="<?php if ($_smarty_tpl->tpl_vars['v']->value['isshow']==1){?>enabled<?php }else{ ?>disabled<?php }?>" ><img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
statics/admin/images/transparent.gif"></a></td>
	<td class="align-center yes-onoff"><a href="JavaScript:void(0);" class="<?php if ($_smarty_tpl->tpl_vars['v']->value['ismenu']==1){?>enabled<?php }else{ ?>disabled<?php }?>" ><img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
statics/admin/images/transparent.gif"></a></td>
	<td class="w120"><a href="javascript:edit('<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
');">编辑</a> | <a href="javascript:del(<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
);">删除</a></td>
</tr>
<?php } ?>
</tbody>
		<tfoot>
        <tr class="tfoot">
          <td id="batchAction" colspan="15"><a href="JavaScript:void(0);" class="btn" onclick="order();"><span>排序</span></a></td>
        </tr>
      	</tfoot>
	</table>
</form>
<?php }?>
</div>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jalert/jquery.alerts.css" type="text/css" />
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery.alerts.js"></script>

<script type="text/javascript">
function add(pid) {
	window.location.href='<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_add?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&site_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['site_id'];?>
&pid='+pid;
	//window.top.art.dialog({id:'adddialog'}).close();
	//window.top.art.dialog({title:'添加菜单',id:'adddialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_add?site_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['site_id'];?>
&pid='+pid,width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'adddialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'adddialog'}).close()});
}
function edit(id, name) {
	window.location.href='<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_edit?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&site_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['site_id'];?>
&id='+id;
	//window.top.art.dialog({id:'editdialog'}).close();
	//window.top.art.dialog({title:'修改菜单《'+name+'》',id:'editdialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_edit?site_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['site_id'];?>
&id='+id,width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'editdialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'editdialog'}).close()});
}
function del(id) {
	jConfirm('删除该分类将会同时删除该分类的所有下级分类，您确定要删除吗?', '提示对话框', function(r) {
		 if(r){ $("form:eq(0)").attr("action", "<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_del?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&id="+id).submit();}
	});
//	if(confirm('删除该分类将会同时删除该分类的所有下级分类，您确定要删除吗?')){
//		$("form:eq(0)").attr("action", "<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_del?id="+id).submit();
//	}
}
function order() {
	 $("form:eq(0)").attr("action", "<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_order?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
").submit();
}
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>