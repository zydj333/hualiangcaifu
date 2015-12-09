<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:03:51
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\com\public_upload_one.html" */ ?>
<?php /*%%SmartyHeaderCode:1978955507077742133-44779571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0408b352bead6f0afc815704644539e904e9a78f' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\com\\public_upload_one.html',
      1 => 1403461094,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1978955507077742133-44779571',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'instance' => 0,
    'admin_id' => 0,
    'filedir' => 0,
    'btnname' => 0,
    'script' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55507077835d30_97474418',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55507077835d30_97474418')) {function content_55507077835d30_97474418($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7 charset=<?php echo $_smarty_tpl->tpl_vars['COM']->value['CHARSET'];?>
" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['COM']->value['CHARSET'];?>
" />
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['JS_PATH'];?>
jquery.min.js" charset="<?php echo $_smarty_tpl->tpl_vars['COM']->value['CHARSET'];?>
"></script>
<style type="text/css">
body {margin: 0px; padding: 0px; font-size:12px;}
.upload_wrap { padding: 0; border: 0;}
.upload_wrap ul { width: 87px; height: 28px; margin-top:0px; padding-left:1px;margin-left: 1px;}
.upload_wrap li { float: left; margin-left: 1px; display: inline; line-height: 28px; font-weight: bold; color: #3f3d3e; cursor: pointer; }
.upload_wrap .btn1 { width: 86px; height: 28px; text-align: center; background: url(<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
statics/admin/images/member/btn.gif) no-repeat 0 -803px; overflow:hidden; }
.upload_wrap .btn2 { width: 79px; height: 28px; padding-left: 10px; background: url(<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
statics/admin/images/member/btn.gif) no-repeat 0 -837px; overflow:hidden; }
</style>
<script type="text/javascript">
function submit_form(obj)
{
    obj.attr('disabled', 'disabled');
    $('#image_form').submit();
    obj.removeAttr('disabled');
}
</script>
</head>
<body>
<form action="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
com/comupload/public_upload_one?instance=<?php echo $_smarty_tpl->tpl_vars['instance']->value;?>
" method="post" enctype="multipart/form-data" id="image_form">
<input type="hidden" name="dosubmit" value="1">
<input type="hidden" name="admin_id" value="<?php echo $_smarty_tpl->tpl_vars['admin_id']->value;?>
">
<input type="hidden" name="filedir" value="<?php echo $_smarty_tpl->tpl_vars['filedir']->value;?>
">
<input type="hidden" name="btnname" value="<?php echo $_smarty_tpl->tpl_vars['btnname']->value;?>
">

<div class="upload_wrap">
<ul><li class="btn1"><?php echo $_smarty_tpl->tpl_vars['btnname']->value;?>
</li></ul>
</div>
<span style="height: 28px; position: absolute; left: 3px; top: 0; width: 120px; z-index: 2; ">
<input onchange="$('#submit_button').click();" type="file" name="file" style="width: 0px; height: 28px; cursor: hand; cursor: pointer;  opacity:0; filter: alpha(opacity=0)" size="1" hidefocus="true" maxlength="0">
</span>
<input id="submit_button" style="display:none" type="button" value="上传" onclick="submit_form($(this))">
</form>
<script type="text/javascript">
<?php echo $_smarty_tpl->tpl_vars['script']->value;?>

</script>
</body>
</html><?php }} ?>