<?php /* Smarty version Smarty-3.1.11, created on 2014-12-18 15:25:25
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\content\adv\adv_add.html" */ ?>
<?php /*%%SmartyHeaderCode:273715492816558adb2-51495852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04306bd2d22bd20c4b77c84e84a76922d36a750c' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\content\\adv\\adv_add.html',
      1 => 1389083068,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '273715492816558adb2-51495852',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
    'position' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_549281657692c7_13648797',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549281657692c7_13648797')) {function content_549281657692c7_13648797($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>广告</h3>
      <ul class="tab-base">
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/lists/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>管理广告</span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span>新增广告</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_manage/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>管理广告位</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>新增广告位</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="adv_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2" id="main_table">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="adv_name">广告名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="adv_name" id="adv_name" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="ap_id">选择广告位:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select name="ap_id" id="ap_id">
              <option value='' selected="selected" ap_type=''></option>
              <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['position']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
			  <option value='<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_id'];?>
'><?php echo $_smarty_tpl->tpl_vars['v']->value['ap_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_width'];?>
*<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_height'];?>
)</option>
			  <?php } ?> 
			  </select>
            <input type="hidden" name="aptype_hidden" id="aptype_hidden"/></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="adv_start_time">开始时间:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="adv_start_time" id="adv_start_time" class="txt date"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="adv_end_time">结束时间:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="adv_end_time" id="adv_end_time" class="txt date"></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tbody id="adv_pic">
        <tr>
          <td colspan="2" class="required"><label for="file_adv_pic">图片上传:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-box">
            	<input type="file" class="type-file-file" id="file_adv_pic" name="adv_pic" size="30"/>
            </span>
          </td>
          <td class="vatop tips">系统支持的图片格式为:gif,jpg,jpeg,png</td>
        </tr>
      </tbody>
      <tbody id="adv_pic_url">
        <tr>
          <td colspan="2" class="required"><label for="type_adv_pic_url">链接地址: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="adv_pic_url" class="txt" id="type_adv_pic_url"></td>
          <td class="vatop tips">链接地址以两种格式添加1:全地址,http://www.(yourmain).com/index.php?m=(dir)&c=(controllers)&a=(method)&(attribute)=(attribute_value)。
           		2.局部地址：index.php?m=(dir)&c=(controllers)&a=(method)&(attribute)=(attribute_value).建议使用全地址。</td>
        </tr>
      </tbody>
      
      <tbody id="adv_slide_sort">
        <tr>
          <td colspan="2" class="required"><label for="type_adv_slide_sort">幻灯片排序:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="adv_slide_sort" id="type_adv_slide_sort" class="txt"></td>
          <td class="vatop tips">数字越小排序越靠前</td>
        </tr>
      </tbody>
      
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<script type="text/javascript">
$(function(){
    $('#adv_start_time').datepicker({dateFormat: 'yy-mm-dd'});
    $('#adv_end_time').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>

<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#adv_form").valid()){
     $("#adv_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#adv_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
        	adv_name : {
                required : true
            },
            ap_id : {
                required : true
            },
            adv_start_time  : {
                required : true,
                date	 : false
            },
            adv_end_time  : {
            	required : true,
                date	 : false
            }
        },
        messages : {
        	adv_name : {
                required : '广告名称不能为空'
            },
            ap_id : {
                required : '请选择广告位'
            },
            adv_start_time  : {
                required : '广告开始时间不能为空'
            },
            adv_end_time  : {
            	required   : '广告结束时间不能为空'
            }
        }
    });
});
</script>
<script type="text/javascript">
$(function(){
	var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
    $(textButton).insertBefore("#file_adv_pic");
    $("#file_adv_pic").change(function(){
	$("#textfield1").val($("#file_adv_pic").val());
    });

	var textButton="<input type='text' name='textfield' id='textfield2' class='type-file-text' /><input type='button' name='button' id='button2' value='' class='type-file-button' />"
    $(textButton).insertBefore("#file_adv_slide_pic");
    $("#file_adv_slide_pic").change(function(){
	$("#textfield2").val($("#file_adv_slide_pic").val());
    });

	var textButton="<input type='text' name='textfield' id='textfield3' class='type-file-text' /><input type='button' name='button' id='button3' value='' class='type-file-button' />"
    $(textButton).insertBefore("#file_flash_swf");
    $("#file_flash_swf").change(function(){
	$("#textfield3").val($("#file_flash_swf").val());
    });
});
</script>
</body>
</html><?php }} ?>