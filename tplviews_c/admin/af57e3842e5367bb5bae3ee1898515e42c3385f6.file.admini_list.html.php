<?php /* Smarty version Smarty-3.1.11, created on 2015-06-30 16:01:06
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\rights\admini\admini_list.html" */ ?>
<?php /*%%SmartyHeaderCode:1793655924cc2772344-28161642%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af57e3842e5367bb5bae3ee1898515e42c3385f6' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\rights\\admini\\admini_list.html',
      1 => 1381081050,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1793655924cc2772344-28161642',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'sel' => 0,
    'infolist' => 0,
    'v' => 0,
    'base_url' => 0,
    'infopage' => 0,
    'admin_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55924cc2909180_87357790',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55924cc2909180_87357790')) {function content_55924cc2909180_87357790($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\workstation\\wamp\\www\\hualiangcaifu\\libs\\smarty\\plugins\\modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>管理员管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="javascript:add();" ><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="serachfrom" action='<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
rights/admini/admini_list/'>
    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" name="loghash">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_nav_title">管理员名称</label></th>
          <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['sel']->value['username'];?>
" name="username" id="username" class="txt"></td>
          <td><a href="javascript:document.serachfrom.submit();" class="btn-search tooltip" title="查询">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
 </form>
 <form method="post" name="listfrom" id="listfrom" action='<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
rights/admini/admini_list/'>
 	<input type="hidden" name="dosubmit" value="1" />
    <table class="table tb-type2">
      <thead>
        <tr class="space"><th colspan="15">管理员列表</th> </tr>
        <tr class="thead">
          <th><input type="checkbox" class="checkall" id="checkallBottom"></th>
          <th>管理员</th>
          <!--<th>站点</th>-->
          <th>角色</th>
          <th class="align-center">锁定</th>
          <th>创建时间</th>
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
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['username'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['rolename'];?>
</td>
          <td class="align-center yes-onoff"><a href="JavaScript:void(0);" class="<?php if ($_smarty_tpl->tpl_vars['v']->value['isclose']==1){?>enabled<?php }else{ ?>disabled<?php }?>" ><img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
statics/admin/images/transparent.gif"></a></td>
          <td class="w120"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['create_time'],'%Y-%m-%d');?>
</td>
          <td class="w120 align-center"><a href="javascript:edit('<?php echo $_smarty_tpl->tpl_vars['v']->value['rolename'];?>
',<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
);">编辑</a> | <?php if ($_smarty_tpl->tpl_vars['v']->value['id']!=1){?><a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
system/admini/admini_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
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
rights/admini/admini_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
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
	window.top.art.dialog({title:'添加管理员',id:'adddialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
rights/admini/admini_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
',width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'adddialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'adddialog'}).close()});
}
function edit(name,id) {
	window.top.art.dialog({id:'editdialog'}).close();
	window.top.art.dialog({title:'修改管理员《'+name+'》',id:'editdialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
rights/admini/admini_edit/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&id='+id,width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'editdialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'editdialog'}).close()});
}
</script>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>