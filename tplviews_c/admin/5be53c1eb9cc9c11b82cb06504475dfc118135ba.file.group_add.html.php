<?php /* Smarty version Smarty-3.1.11, created on 2015-07-02 13:33:08
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\member\member\group_add.html" */ ?>
<?php /*%%SmartyHeaderCode:152825594cd147c04a3-98357661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5be53c1eb9cc9c11b82cb06504475dfc118135ba' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\member\\member\\group_add.html',
      1 => 1407168720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152825594cd147c04a3-98357661',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'catelist' => 0,
    'n' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5594cd148d9841_48191402',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5594cd148d9841_48191402')) {function content_5594cd148d9841_48191402($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <form id="infoform" name="infoform" method="post">
     <input type="hidden" name="dosubmit" value="1" />
    <table class="table tb-type2">
      <tbody>
        <tr><td colspan="2" class="required"><label class="validation" for="info[groupname]">会员组名称:</label></td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="info[groupname]" id="info[groupname]" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <!--<tr>
          <td colspan="2" class="required"><label class="validation" for="info[minexp]">下限积分:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="info[minexp]" id="info[minexp]" class="txt"></td>
          <td class="vatop tips">下限积分值必须小于上限积分值</td>
        </tr>
               <tr>
          <td colspan="2" class="required"><label class="validation" for="info[maxexp]" >上限积分:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="info[maxexp]" id="info[maxexp]" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>-->
        <tr><td colspan="2" class="required"><label class="validation" for="info[listorder]">排序:</label></td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="info[listorder]" id="info[listorder]" class="txt"></td>
          <td class="vatop tips">数字范围为0~255，数字越小越靠前，建议等级最高等级(上限是999999999)的排序号是1。</td>
        </tr>
        <!--
        <tr><td colspan="2" class="required"><label class="validation" for="info[discount]">折扣率:</label></td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="info[discount]" id="info[discount]" class="txt">%</td>
          <td class="vatop tips">折扣率，例如：如果输入90，表示该会员组可以以商品原价的90%购买（允许包含小数）。</td>
        </tr>-->
      </tbody>
    </table>
    <table class="table tb-type2">
              <thead class="thead">
              <tr class="space"><th colspan="15"><label>添加产品系列折扣</label></th></tr>
                <tr class="noborder">
                  <th></th>
                  <th>产品系列</th>
                  <th>产品折扣</th>
                  <th>促销折扣</th>
                  <!--<th class="align-center">操作</th>-->
                </tr>
              </thead>
              <tbody id="tr_model">
              	<tr></tr>
              	<?php $_smarty_tpl->tpl_vars["n"] = new Smarty_variable(0, null, 0);?>
              	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['catelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                <tr class="hover edit">
                  <td class="w48 sort"><input type="hidden" name="s_value[<?php echo $_smarty_tpl->tpl_vars['n']->value;?>
][id]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
" /></td>
                  <td class="name w270"><input type="text" name="s_value[<?php echo $_smarty_tpl->tpl_vars['n']->value;?>
][name]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
" readonly /></td>
                  <td class="image_display vatop rowform w300"><input type="text" name="s_value[<?php echo $_smarty_tpl->tpl_vars['n']->value;?>
][discount]" value="" /></td>
                  <td class="image_display vatop rowform w300"><input type="text" name="s_value[<?php echo $_smarty_tpl->tpl_vars['n']->value;?>
][cxdiscount]" value="" /></td>
                  
                  <!--<td class="w150 align-center"><a onclick="remove_tr($(this));" href="JavaScript:void(0);">移除</a></td>-->
                </tr>
                <?php $_smarty_tpl->tpl_vars["n"] = new Smarty_variable($_smarty_tpl->tpl_vars['n']->value+1, null, 0);?>
                <?php } ?>
              </tbody>
      <tfoot>
        <tr  style='display:none;'class="tfoot"><td colspan="15" ><a href="JavaScript:void(0);"  class="btn"  id="submitBtn"><span>提交</span></a></td></tr>
      </tfoot>
    </table>
    <input style='display:none;' type="submit" name="dosubmit" id="dosubmit" value=" 提交 ">
  </form>
</div>
<script>
$(document).ready(function(){
	//按钮先执行验证再提交表单
	$("#submitBtn").click(function(){
	    if($("#infoform").valid()){
	     $("#infoform").submit();
		}
	});

	$('#infoform').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        onfocusout : false,
        onkeyup    : false,
        rules : {
            'info[groupname]' : {
                required : true,
            },
//            'info[minexp]' : {
//                number   : true
//            },
//            'info[maxexp]' : {
//                number   : true
//            },
            'info[listorder]' : {
            	required : true,
                number   : true
            },
            'info[discount]' : {
                number   : true
            },
        },
        messages : {
            'info[groupname]'  : {
                required : '请输入会员组名称',
            },
//            'info[minexp]'  : {
//                number   : '上限积分仅能为数字'
//            },
//            'info[maxexp]'  : {
//                number   : '下限积分仅能为数字'
//            },
            'info[listorder]'  : {
            	required : '请输入排序号码，这对积分兑换功能很重要！',
                number   : '排序号仅能为数字'
            },
            'info[discount]'  : {
                number   : '折扣率仅能为数字'
            }
        }
    });


});



</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>