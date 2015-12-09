<?php /* Smarty version Smarty-3.1.11, created on 2014-12-16 01:33:53
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\member\member\group_list.html" */ ?>
<?php /*%%SmartyHeaderCode:24062548f1b8132af20-86396608%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '931e01e29f21eedcc7f5c23d0180d4ee7f40264c' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\member\\member\\group_list.html',
      1 => 1402194868,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24062548f1b8132af20-86396608',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
    'infolist' => 0,
    'v' => 0,
    'admin_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548f1b815ef7b2_53266579',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548f1b815ef7b2_53266579')) {function content_548f1b815ef7b2_53266579($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>会员组管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="javascript:add();" ><span>新增</span></a></li>
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/group_cache?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>更新缓存</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
 <form method="post" name="listfrom" id="listfrom" action='<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/group_list/'>
 	<input type="hidden" name="dosubmit" value="1" />
    <table class="table tb-type2">
      <thead>
        <tr class="space"><th colspan="15">会员组列表</th> </tr>
        <tr class="thead">
          <th>排序号</th>
          <th>ID</th>
          <th>会员组名称</th>
          <th>折扣率</th>
          <th class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
      <?php if ($_smarty_tpl->tpl_vars['infolist']->value){?>
      <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infolist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
		<tr class="hover">
          <td class="w48 sort">
          <input type="hidden" name="hdnid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" /><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['listorder'];?>
" name="listorder[]" id="listorder[]" class="txt-short">
          <div style='display:none;'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" name="id[]" id="id[]" /><input type="checkbox" name="ckbid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="checkitem"><div>
          </td>
          <td class="w24"><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['groupname'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['discount'];?>
</td>
          <td class="w120 align-center"><a href="javascript:edit('<?php echo $_smarty_tpl->tpl_vars['v']->value['groupname'];?>
',<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
);">编辑</a> | <a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/group_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','ckbid[]',<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
);">删除</a></td>
        </tr>
      <?php } ?>
	  </tbody>
      <tfoot>
      <tr class="tfoot">
          <td></td>
          <td colspan="16"><a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/group_order/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
');"><span>排序</span></a>   </td>
        </tr>
      </tfoot>
      <?php }else{ ?>
		<tr class="no_data">
          <td colspan="10">没有符合条件的记录</td>
        </tr>
		<?php }?>
    </table>
    </form>
</div>
<script type="text/javascript">
function add() {
	window.top.art.dialog({id:'adddialog'}).close();
	window.top.art.dialog({title:'添加会员组',id:'adddialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
member/member/group_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
',width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'adddialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'adddialog'}).close()});
}
function edit(name,id) {
	window.top.art.dialog({id:'editdialog'}).close();
	window.top.art.dialog({title:'修改会员组《'+name+'》',id:'editdialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
member/member/group_edit/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&id='+id,width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'editdialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'editdialog'}).close()});
}
</script>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>