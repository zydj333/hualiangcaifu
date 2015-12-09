<?php /* Smarty version Smarty-3.1.11, created on 2014-12-26 13:54:46
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\setup\areas\areas_lists.html" */ ?>
<?php /*%%SmartyHeaderCode:14868549cf826c53022-55945852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f38775d9fbac65a605688df5b426b86bcfbe7ec' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\setup\\areas\\areas_lists.html',
      1 => 1400955932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14868549cf826c53022-55945852',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'admin_url' => 0,
    'parent_idx' => 0,
    'COM' => 0,
    'lists' => 0,
    'v' => 0,
    'parent_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_549cf826ea04a6_05325083',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549cf826ea04a6_05325083')) {function content_549cf826ea04a6_05325083($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>地址列表</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="javascript:add();" ><span>新增地址</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
setup/areas/lists?parent_id=<?php echo $_smarty_tpl->tpl_vars['parent_idx']->value;?>
&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>返回上层</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  
  <form method='post'>
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="submit_type" id="submit_type" value="" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th></th>
          <th>排序</th>
          <th>名称</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lists']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
<tr class="hover edit">
		<td class="w36"><input type="checkbox" name="check_gc_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="checkitem"></td>
		<td class="w48 sort"><span datatype="number" fieldid="1" fieldname="gc_sort" ectype="inline_edit" class="editable"><?php echo $_smarty_tpl->tpl_vars['v']->value['listorder'];?>
</span></td>
		<td><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</td>
		<td class="w156"><a href="<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
setup/areas/lists?parent_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
">进子地址</a> | <a href="javascript:edit('<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
');">编辑</a> | <a href="javascript:if(confirm('删除该分类将会同时删除该分类的所有下级分类，您确定要删除吗'))window.location = '<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
setup/areas/delete?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
';">删除</a></td>
</tr>
<?php } ?>
      </tfoot>
          </table>
  </form>
</div>
<script>
function add() {
	window.top.art.dialog({id:'adddialog'}).close();
	window.top.art.dialog({title:'添加地址',id:'adddialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
setup/areas/add?parent_id=<?php echo $_smarty_tpl->tpl_vars['parent_id']->value;?>
&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
',width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'adddialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'adddialog'}).close()});
}
function edit(id, name) {
	window.top.art.dialog({id:'editdialog'}).close();
	window.top.art.dialog({title:'修改地址《'+name+'》',id:'editdialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
setup/areas/edit?id='+id+'&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
',width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'editdialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'editdialog'}).close()});
}
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>