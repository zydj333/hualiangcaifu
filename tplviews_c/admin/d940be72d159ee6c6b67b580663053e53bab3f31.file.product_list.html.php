<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:00:31
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\caifu\product\product_list.html" */ ?>
<?php /*%%SmartyHeaderCode:1107755506fafcdb225-31373376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd940be72d159ee6c6b67b580663053e53bab3f31' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\caifu\\product\\product_list.html',
      1 => 1415516056,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1107755506fafcdb225-31373376',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'infolist' => 0,
    'v' => 0,
    'IMG_PATH' => 0,
    'infopage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55506fafe6d809_39948256',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55506fafe6d809_39948256')) {function content_55506fafe6d809_39948256($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>产品管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/product/product_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
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
            <li>通过产品管理，你可以编辑、查看、删除产品信息</li>
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
          <th>产品系列</th>
          <th>产品名称</th>
          <th>期限</th>
          <th>年化收益</th>
          <th>费用区间</th>
          <th>上架</th>
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
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['categoryname'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['lifetime'];?>
个月</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['yield_year'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['fee_scale'];?>
</td>
          <td class="align-center yes-onoff">
						<a href="JavaScript:void(0);" class="tooltip <?php if ($_smarty_tpl->tpl_vars['v']->value['isshow']==1){?>enabled<?php }else{ ?>disabled<?php }?>" ajax_branch="isshow" nc_type="inline_edit" fieldname="isshow" fieldid="84" fieldvalue="0"><img src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
transparent.gif"></a>
          </td>
          <td><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['v']->value['post_time']);?>
</td>
          <td class="w96 align-center"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/product/product_edit/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">编辑</a> |  <a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/product/product_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
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
caifu/product/product_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]');" href="JavaScript:void(0);"><span>删除</span></a>
			<a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/product/product_order/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
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