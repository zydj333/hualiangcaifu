<?php /* Smarty version Smarty-3.1.11, created on 2014-12-15 16:09:34
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\maintenance\dictionary\dictionary_list.html" */ ?>
<?php /*%%SmartyHeaderCode:27372548e973e656b80-31941185%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea55aba0663efebaa0c3deaa5add8c4d32ea0918' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\maintenance\\dictionary\\dictionary_list.html',
      1 => 1402818088,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27372548e973e656b80-31941185',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'form_submit' => 0,
    'infolist' => 0,
    'v' => 0,
    'infopage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548e973e978242_13929337',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548e973e978242_13929337')) {function content_548e973e978242_13929337($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>数据字典</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dictionary/dictionary_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
  	<input type="hidden" name="dosubmit" value="ok" />
    <input type="hidden" name="loghash" value="<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" />
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_tbname">表名</label></th>
          <td><input class="txt" type="text" name="search_tbname" id="search_tbname" value="" /></td>
          <th><label for="member_name">列名</label></th>
          <td><input class="txt" type="text" name="search_colname" id="search_colname" value="" /></td>
          <th><label for="member_name">字段值</label></th>
          <td><input class="txt" type="text" name="search_colvalue" id="search_colvalue" value="" /></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="查询">&nbsp;</a>
              <?php if (isset($_smarty_tpl->tpl_vars['form_submit']->value)){?><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dictionary/lists?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" class="btns tooltip"><span>撤销检索</span></a><?php }?></tr>
      </tbody>
    </table>
  </form>

  <form method="get" name="serachfrom" id="listfrom">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2 nobdb">
      <thead>
        <tr class="thead">
          <th>&nbsp;</th>
          <th>排序号</th>
          <th>表名称</th>
          <th>列名称</th>
          <th>字段含义</th>
          <th>字段值</th>
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
				<tr class="hover edit">
          <td class="w24"><input type="checkbox" name="del_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="checkitem"></td>
          <td class="w48 sort">
          	<input type="hidden" name="hdnid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" /><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['listorder'];?>
" name="listorder[]" id="listorder[]" class="txt-short">
          	<div style='display:none;'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" name="id[]" id="id[]" /><input type="checkbox" name="ckbid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="checkitem"><div>
          </td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['table_name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['column_name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
</td>
          <td class="w96 align-center"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dictionary/dictionary_edit/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">编辑</a> | <a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dictionary/dictionary_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]',<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
);">删除</a></td>
        </tr>
				<?php } ?>
      </tbody>
      <tfoot>
        <tr class="tfoot" id="dataFuncs">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16" id="batchAction"><label for="checkallBottom">全选</label>
             &nbsp;&nbsp; <a href="JavaScript:void(0);" class="btn" onclick="dodel('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dictionary/dictionary_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]');" ><span>删除</span></a>
						 <a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dictionary/dictionary_order/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
');"><span>排序</span></a>
           <?php echo $_smarty_tpl->tpl_vars['infopage']->value;?>

	    </tr>
      </tfoot>
      <?php }else{ ?>
              <tfoot>
		<tr class="no_data">
          <td colspan="10">没有符合条件的记录</td>
        </tr>
        </tbody>
		<?php }?>
          </table>
  </form>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>