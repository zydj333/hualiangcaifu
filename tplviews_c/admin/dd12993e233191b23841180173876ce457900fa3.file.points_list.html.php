<?php /* Smarty version Smarty-3.1.11, created on 2015-06-30 16:00:16
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\caifu\points\points_list.html" */ ?>
<?php /*%%SmartyHeaderCode:756655924c90627d04-58930931%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd12993e233191b23841180173876ce457900fa3' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\caifu\\points\\points_list.html',
      1 => 1415517840,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '756655924c90627d04-58930931',
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
  'unifunc' => 'content_55924c9073acb9_13404666',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55924c9073acb9_13404666')) {function content_55924c9073acb9_13404666($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>积分产品</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/points/points_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>新增</span></a></li>
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
            <li>通过积分产品管理，你可以编辑、查看、删除积分产品信息</li>
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
          <th colspan="2">商品名称</th>
          <th>参考市场价</th>
          <th>所需积分</th>
          <th>发布时间</th>
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
          <td class="w48 sort"><input type="hidden" name="hdnid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" /><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['listorder'];?>
" name="listorder[]" id="listorder[]" class="txt-short"></td>
          <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><i></i><img src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
<?php echo remain_image_path($_smarty_tpl->tpl_vars['v']->value['points_image'],'w');?>
" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
uploadfile/common/default_goods_image.gif_tiny.gif'" onload="javascript:DrawImage(this,56,56);"/></span></div></td>
          <td class="goods-name w270"><p><span class="editable-tarea tooltip" required="1" ajax_branch_textarea="name" fieldid="84" fieldname="name" nc_type="inline_edit_textarea"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</span></p></td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['market_price'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['points'];?>
</td>
          <td><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['v']->value['post_time']);?>
</td>
          <td class="w96 align-center"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/points/points_edit/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">编辑</a> |  <a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/points/points_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]',<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
);">删除</a></td>
        </tr>
				<?php } ?>
      </tbody>
      <tfoot>
        <tr class="tfoot" id="dataFuncs">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16" id="batchAction"><label for="checkallBottom">全选</label>
            &nbsp;&nbsp; <a class="btn" onclick="dodel('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/points/points_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]');" href="JavaScript:void(0);"><span>删除</span></a>
			<a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/points/points_order/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
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