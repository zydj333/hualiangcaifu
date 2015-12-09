<?php /* Smarty version Smarty-3.1.11, created on 2014-12-18 13:45:41
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\content\adv\ap_manage.html" */ ?>
<?php /*%%SmartyHeaderCode:525954926a053cee14-92086263%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3279d3bba8218a7ab3b358a89a16815c537d4fcc' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\content\\adv\\ap_manage.html',
      1 => 1389083068,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '525954926a053cee14-92086263',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'sel' => 0,
    'form_submit' => 0,
    'search_name' => 0,
    'infolist' => 0,
    'v' => 0,
    'IMG_PATH' => 0,
    'infopage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54926a057afcb3_61909386',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54926a057afcb3_61909386')) {function content_54926a057afcb3_61909386($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>广告</h3>
      <ul class="tab-base">
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/lists/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>管理广告</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/adv_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>新增广告</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>管理广告位</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>新增广告位</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" name="loghash" value="<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" />
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_name">广告位名称</label></th>
          <td><input class="txt" type="text" name="search_name" id="search_name" value="<?php echo $_smarty_tpl->tpl_vars['sel']->value['name'];?>
" /></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="查询">&nbsp;</a>
            </td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5>操作提示</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>广告位添加完成后可以选择是否启用广告位</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="listfrom">
    <?php if (isset($_smarty_tpl->tpl_vars['form_submit']->value)){?><input type="hidden" name="dosubmit" value="ok" /><input type="hidden" name="search_name" value="<?php echo $_smarty_tpl->tpl_vars['search_name']->value;?>
" /><?php }?>
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th><input type="checkbox" class="checkall"/></th>
          <th>广告位名称</th>
          <th class="align-center">宽度</th>
          <th class="align-center">高度</th>
          <th class="align-center">是否启用</th>
          <th class="align-center"><span class="paixv"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_manage/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&order=click_num">点击率ˇ</a></span></th>
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
          <td class="w24"><input type="checkbox" class="checkitem" name="del_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_id'];?>
" /></td>
          <td><span title="<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['ap_name'];?>
</span></td>
          <td class="align-center"><?php echo $_smarty_tpl->tpl_vars['v']->value['ap_width'];?>
</td>
          <td class="align-center"><?php echo $_smarty_tpl->tpl_vars['v']->value['ap_height'];?>
</td>
          <td class="align-center yes-onoff">            <a href="JavaScript:void(0);" class="tooltip <?php if ($_smarty_tpl->tpl_vars['v']->value['is_use']==1){?>enabled<?php }else{ ?>disabled<?php }?>" ajax_branch="is_use" nc_type="inline_edit" fieldname="is_use" fieldid="37" fieldvalue="1" title="<?php if ($_smarty_tpl->tpl_vars['v']->value['is_use']==1){?>启用<?php }else{ ?>未启用<?php }?>"><img src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
transparent.gif"></a>
            </td>
          <td class="align-center"><?php echo $_smarty_tpl->tpl_vars['v']->value['click_num'];?>
</td>
          <td class="w132 align-center"><a href='<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_edit/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&ap_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_id'];?>
'>编辑</a> | <a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]',<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_id'];?>
);">删除</a> </td>
        </tr>
        <?php } ?>
		      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkall"/></td>
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall">全选</label>
            </span>&nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="dodel('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]');"><span>删除</span></a>
            <?php echo $_smarty_tpl->tpl_vars['infopage']->value;?>

		  </td>
        </tr>
      </tfoot>
	    <?php }else{ ?>
	    <tr class="no_data">
           <td colspan="10">没有符合条件的记录</td>
        </tr>
		<?php }?>
        </tbody>
    </table>
  </form>
</div>
<script type="text/javascript">
   function get_adv_code(ap_id) {
		var ifurl="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_showcode/?ap_id="+ap_id+"&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
";
		window.top.art.dialog({id:'adddialog'}).close();
		window.top.art.dialog({title:'代码调用',id:'adddialog',iframe:ifurl,width:'650',height:'200'}, function(){var d = window.top.art.dialog({id:'adddialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'adddialog'}).close()});
   }
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>