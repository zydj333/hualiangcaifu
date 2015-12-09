<?php /* Smarty version Smarty-3.1.11, created on 2014-12-15 16:11:04
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\maintenance\dictionary\dictionary_add.html" */ ?>
<?php /*%%SmartyHeaderCode:6509548e97980a7679-07367918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1ebda5ae18f8c4a19355c15fcdb06d98eec11616' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\maintenance\\dictionary\\dictionary_add.html',
      1 => 1402648298,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6509548e97980a7679-07367918',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548e979816e930_00931892',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548e979816e930_00931892')) {function content_548e979816e930_00931892($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>数据字典</h3>
      <ul class="tab-base">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dictionary/lists/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>管理</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="dictionary_form" method="post">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2 nobdb">
      <tbody>
	    	<tr>
          <td colspan="2" class="required"><label class="validation" for="table_name"> 表名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="table_name" id="table_name" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="column_name"> 列名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="column_name" id="column_name" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
				<tr>
          <td colspan="2" class="required"><label class="validation" for="column_title"> 字段含义:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="column_title" id="column_title" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="column_value"> 字段值:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="column_value" id="column_value" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="listorder"> 排序号:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="listorder" id="listorder" class="txt"></td>
          <td class="vatop tips">仅为数字，数字越小越靠前</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="remark"> 备注:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea value='' name="remark" id="remark" rows="6" class="tarea"></textarea></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#dictionary_form").valid()){
     $("#dictionary_form").submit();
	}
	});
});

//
$(document).ready(function(){
	$('#dictionary_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
		    		table_name : {
                required : true
            },
						column_name : {
                required : true,
            },
            column_title : {
                required : true,
            },
            column_value : {
                required : true,
            },
            listorder  : {
                number   : true
            }
        	},
        messages : {
		    		table_name : {
                required : '表名称不能为空'
            },
						column_name  : {
                required :  '列名称不能为空'
            },
            column_title  : {
                required :  '字段含义不能为空'
            },
            column_value  : {
                required :  '字段值不能为空'
            },
            listorder  : {
                number   : '排序号仅能为数字'
            },
            
        }
    });
});
</script>
</body>
</html><?php }} ?>