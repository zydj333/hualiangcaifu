<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:05:30
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\rights\role\role_list.html" */ ?>
<?php /*%%SmartyHeaderCode:1000555070da443926-15617264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b40fa229558fcc429a7ea99a23b3dd4f982aff1' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\rights\\role\\role_list.html',
      1 => 1381081050,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1000555070da443926-15617264',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'sel' => 0,
    'infolist' => 0,
    'v' => 0,
    'infopage' => 0,
    'admin_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_555070da59b579_97775225',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555070da59b579_97775225')) {function content_555070da59b579_97775225($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>角色管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="javascript:add();" ><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="serachfrom" action='<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
rights/role/role_list/'>
    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" name="loghash">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_nav_title">角色名称</label></th>
          <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['sel']->value['rolename'];?>
" name="rolename" id="rolename" class="txt"></td>
          <td><a href="javascript:document.serachfrom.submit();" class="btn-search tooltip" title="查询">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
 </form>
 <form method="post" name="listfrom" id="listfrom" action='<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
rights/role/role_list/'>
 	<input type="hidden" name="dosubmit" value="1" />
    <table class="table tb-type2">
      <thead>
        <tr class="space"><th colspan="15">角色管理列表</th> </tr>
        <tr class="thead">
          <th><input type="checkbox" class="checkall" id="checkallBottom"></th>
          <th>角色名称</th>
          <th class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
      <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infolist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
		<tr class="hover">
          <td class="w24"><?php if ($_smarty_tpl->tpl_vars['v']->value['id']!=1){?><input type="checkbox" name="ckbid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="checkitem"><?php }?></td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['rolename'];?>
</td>
          <td class="w200 align-center"><a href="javascript:setrole('<?php echo $_smarty_tpl->tpl_vars['v']->value['rolename'];?>
',<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
);">权限菜单</a> | <a href="javascript:edit('<?php echo $_smarty_tpl->tpl_vars['v']->value['rolename'];?>
',<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
);">编辑</a> | <?php if ($_smarty_tpl->tpl_vars['v']->value['id']!=1){?><a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
system/role/role_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','ckbid[]',<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
);">删除</a><?php }else{ ?><a href="javascript:void(0);"  disabled="disabled">删除</a><?php }?></td>
        </tr>
      <?php } ?>
	  </tbody>
      <tfoot>
      <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom">全选</label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="dodel('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
rights/role/role_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','ckbid[]');"><span>删除</span></a>
            <?php echo $_smarty_tpl->tpl_vars['infopage']->value;?>

          </td>
        </tr>
      </tfoot>
    </table>
    </form>
</div>
<script type="text/javascript">
function add() {
	window.top.art.dialog({id:'adddialog'}).close();
	window.top.art.dialog({title:'添加角色',id:'adddialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
rights/role/role_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
',width:'500',height:'300'}, function(){var d = window.top.art.dialog({id:'adddialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'adddialog'}).close()});

}
function edit(name,id) {
	window.top.art.dialog({id:'editdialog'}).close();
	window.top.art.dialog({title:'修改角色《'+name+'》',id:'editdialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
rights/role/role_edit/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&id='+id,width:'500',height:'300'}, function(){var d = window.top.art.dialog({id:'editdialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'editdialog'}).close()});
}
function setrole(name,id) {
	window.top.art.dialog({id:'editdialog'}).close();
	window.top.art.dialog({title:'设置角色《'+name+'》的菜单权限',id:'editdialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
rights/role/role_menu/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&id='+id,width:'600',height:'490'}, function(){var d = window.top.art.dialog({id:'editdialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'editdialog'}).close()});
}
</script>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>