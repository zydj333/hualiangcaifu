<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:00:45
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\caifu\orderreserve\order_list.html" */ ?>
<?php /*%%SmartyHeaderCode:742755506fbd7cf202-08123057%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63704d8504894cc9ddc80b89686b9935ddea9847' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\caifu\\orderreserve\\order_list.html',
      1 => 1415528838,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '742755506fbd7cf202-08123057',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'infolist' => 0,
    'v' => 0,
    'COM' => 0,
    'infopage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55506fbd93cc15_68222779',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55506fbd93cc15_68222779')) {function content_55506fbd93cc15_68222779($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>客户预约</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
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
            <li>通过客户预约管理，你可以编辑、查看、删除、审核预约信息</li>
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
          <th>订单号</th>
          <th>产品名称</th>
          <th>姓名</th>
          <th>手机号</th>
          <th>预约金额</th>
          <th>会员名</th>
          <th>状态</th>
          <th>下单时间</th>
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
" /><?php echo $_smarty_tpl->tpl_vars['v']->value['order_sn'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['v']->value['product_name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['phone'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['money'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['poster'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['status_name'];?>
</td>
          <td><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['v']->value['post_time']);?>
</td>
          <td class="w96 align-center"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/orderreserve/order_view/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">查看审核</a> |  <a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/orderreserve/order_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
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
caifu/orderreserve/order_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]');" href="JavaScript:void(0);"><span>删除</span></a>
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