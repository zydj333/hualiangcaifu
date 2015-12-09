<?php /* Smarty version Smarty-3.1.11, created on 2015-05-25 12:50:12
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\marketing\link\link_list.html" */ ?>
<?php /*%%SmartyHeaderCode:148825562aa04858673-30947444%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1940b9cd328d58b4c749b44d1f1bf19a5b24ce2a' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\marketing\\link\\link_list.html',
      1 => 1381081046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '148825562aa04858673-30947444',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'infolist' => 0,
    'v' => 0,
    'infopage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5562aa04a449f6_56607515',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5562aa04a449f6_56607515')) {function content_5562aa04a449f6_56607515($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>友情链接</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
marketing/link/link_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>新增</span></a></li>
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
marketing/link/link_category_manage/?op=list&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>管理分类</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5>操作提示</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>通过友情链接管理你可以，编辑、查看、删除友情链接信息</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="get" name="serachfrom" id="listfrom">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2 nobdb">
      <thead>
        <tr class="thead">
          <th>&nbsp;</th>
          <th>排序</th>
          <th>标题</th>
          <th>图片标识</th>
          <th>链接</th>
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
          <td class="w24"><input type="checkbox" name="del_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['link_id'];?>
" class="checkitem"></td>
          <td class="w48 sort">
		  <input type="hidden" name="hdnid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['link_id'];?>
" /><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['listorder'];?>
" name="listorder[]" id="listorder[]" class="txt-short">
		  </td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['link_title'];?>
</td>
          <td class="picture"><div class='size-88x31'><span class='thumb size-88x31'><i></i><?php if ($_smarty_tpl->tpl_vars['v']->value['link_pic']){?><img width="88" height="31" src='/<?php echo $_smarty_tpl->tpl_vars['v']->value['link_pic'];?>
' onload='javascript:DrawImage(this,88,31);' /><?php }?></span></div></td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['link_url'];?>
</td>
          <td class="w96 align-center"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
marketing/link/link_edit/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&link_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['link_id'];?>
">编辑</a> |  <a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
system/link/link_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]',<?php echo $_smarty_tpl->tpl_vars['v']->value['link_id'];?>
);">删除</a></td>
        </tr>
		<?php } ?>
                      </tbody>
      <tfoot>
        <tr class="tfoot" id="dataFuncs">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16" id="batchAction"><label for="checkallBottom">全选</label>
            &nbsp;&nbsp; <a class="btn" onclick="dodel('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
marketing/link/link_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]');" href="JavaScript:void(0);"><span>删除</span></a>
			<a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
marketing/link/link_order/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
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