<?php /* Smarty version Smarty-3.1.11, created on 2014-12-18 13:42:34
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\content\adv\adv_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:189045492694a4eb6b3-34396387%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b1b1c90d6d6df22a80db513df8aa0e516ab3640' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\content\\adv\\adv_edit.html',
      1 => 1389083068,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189045492694a4eb6b3-34396387',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
    'adv' => 0,
    'ap' => 0,
    'v' => 0,
    'IMG_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5492694a871210_91805557',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5492694a871210_91805557')) {function content_5492694a871210_91805557($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/adv_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>新增广告</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_manage/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>管理广告位</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>新增广告位</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>修改</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="adv_form" enctype="multipart/form-data" method="post" name="advForm">
    <input type="hidden" name="adv_id" value="<?php echo $_smarty_tpl->tpl_vars['adv']->value['adv_id'];?>
" />
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2">
      <tbody>
                <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="type_adv_name">广告名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="adv_name" id="type_adv_name" class="txt" value="<?php echo $_smarty_tpl->tpl_vars['adv']->value['adv_title'];?>
"></td>
          <td class="vatop tips"></td>
        </tr>
                                                                                                                                                        <tr>
          <td colspan="2" class="required"><label>所属广告位:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          		<select name="ap_id" id="ap_id">
	              	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ap']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
				  	<option <?php if ($_smarty_tpl->tpl_vars['v']->value['ap_id']==$_smarty_tpl->tpl_vars['adv']->value['ap_id']){?>selected="selected"<?php }?> value='<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_id'];?>
'><?php echo $_smarty_tpl->tpl_vars['v']->value['ap_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_width'];?>
*<?php echo $_smarty_tpl->tpl_vars['v']->value['ap_height'];?>
)</option>
				  	<?php } ?> 
			  	</select>
          </td>
          <td class="vatop tips"></td>
        </tr>
       
        <tr>
          <td colspan="2" class="required"><label for="adv_start_date">开始时间:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="adv_start_date" id="adv_start_date" class="txt date" value="<?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['adv']->value['adv_start_date']);?>
"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="adv_end_date">结束时间:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="adv_end_date" id="adv_end_date" class="txt date" value="<?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['adv']->value['adv_end_date']+3600*8);?>
"></td>
          <td class="vatop tips"></td>
        </tr>
   
		<!--图片-->
		<tr id="adv_pic" >
          <input type="hidden" name="mark" value="0">
          <td colspan="2" class="required"><label for="file_adv_pic">图片上传:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><span class="type-file-show"><img class="show_image" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
preview.png">
            <div class="type-file-preview"><img src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
<?php echo $_smarty_tpl->tpl_vars['adv']->value['content']['adv_pic'];?>
" onload="javascript:DrawImage(this,500,500);"></div>
            </span><span class="type-file-box">
            <input type="file" class="type-file-file" id="file_adv_pic" name="adv_pic" size="30" />
            </span>
            <input type="hidden" name="pic_ori" value="<?php echo $_smarty_tpl->tpl_vars['adv']->value['content']['adv_pic'];?>
"></td>
          <td class="vatop tips">系统支持的图片格式为:gif,jpg,jpeg,png </td>
        </tr>
        <tr id="adv_pic_url">
          <td colspan="2" class="required"><label for="type_adv_pic_url">链接地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="type_adv_pic_url" name="adv_pic_url" value="<?php if (isset($_smarty_tpl->tpl_vars['adv']->value['content']['adv_pic_url'])){?><?php echo $_smarty_tpl->tpl_vars['adv']->value['content']['adv_pic_url'];?>
<?php }?>" class="txt"></td>
          <td class="vatop tips">链接地址以两种格式添加1:全地址,http://www.(yourmain).com/index.php?m=(dir)&c=(controllers)&a=(method)&(attribute)=(attribute_value)。
           		2.局部地址：index.php?m=(dir)&c=(controllers)&a=(method)&(attribute)=(attribute_value).建议使用全地址。</td>
        </tr>
       
		<tr>
          <td colspan="2" class="required"><label for="type_adv_slide_sort">幻灯片排序:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="adv_slide_sort" value='<?php echo $_smarty_tpl->tpl_vars['adv']->value['slide_sort'];?>
' id="type_adv_slide_sort" class="txt"></td>
          <td class="vatop tips">数字越小排序越靠前</td>
        </tr>
	   
	  </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" onclick="document.advForm.submit()"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery-ui/themes/ui-lightness/jquery.ui.css"/>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
swfobject_modified.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
    $('#adv_start_date').datepicker({dateFormat: 'yy-mm-dd'});
    $('#adv_end_date').datepicker({dateFormat: 'yy-mm-dd'});
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
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>