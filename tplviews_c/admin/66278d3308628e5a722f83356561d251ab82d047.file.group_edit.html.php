<?php /* Smarty version Smarty-3.1.11, created on 2015-07-02 13:33:01
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\member\member\group_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:7235594cd0de332c5-99792300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66278d3308628e5a722f83356561d251ab82d047' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\member\\member\\group_edit.html',
      1 => 1407168734,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7235594cd0de332c5-99792300',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
    'catelist' => 0,
    'n' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5594cd0e036156_86780554',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5594cd0e036156_86780554')) {function content_5594cd0e036156_86780554($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <form id="infoform" name="infoform" method="post">
     <input type="hidden" name="dosubmit" value="1" />
      <input type="hidden" name="info[id]" id="info[id]" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
" />
    <table class="table tb-type2">
      <tbody>
        <tr><td colspan="2" class="required"><label class="validation" for="info[groupname]">会员组名称:</label></td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['groupname'];?>
" name="info[groupname]" id="info[groupname]" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr><td colspan="2" class="required"><label class="validation" for="info[listorder]">排序:</label></td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['listorder'];?>
" name="info[listorder]" id="info[listorder]" class="txt"></td>
          <td class="vatop tips">数字范围为0~255，数字越小越靠前</td>
        </tr>
        <!--
        <tr><td colspan="2" class="required"><label class="validation" for="info[discount]">折扣率:</label></td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="$info.discount" name="info[discount]" id="info[discount]" class="txt">%</td>
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
][discount]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['discount'];?>
" /></td>
                  <td class="image_display vatop rowform w300"><input type="text" name="s_value[<?php echo $_smarty_tpl->tpl_vars['n']->value;?>
][cxdiscount]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['cxdiscount'];?>
" /></td>
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