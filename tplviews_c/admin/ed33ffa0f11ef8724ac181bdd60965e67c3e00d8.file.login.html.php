<?php /* Smarty version Smarty-3.1.11, created on 2014-12-15 10:18:00
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\login.html" */ ?>
<?php /*%%SmartyHeaderCode:17174548e44d859e062-32619700%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed33ffa0f11ef8724ac181bdd60965e67c3e00d8' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\login.html',
      1 => 1408935728,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17174548e44d859e062-32619700',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'admin_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548e44d86e8298_47593388',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548e44d86e8298_47593388')) {function content_548e44d86e8298_47593388($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['JS_PATH'];?>
jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['JS_PATH'];?>
jquery.validation.min.js"></script>
<title>PHP用户管理中心</title>
<style type="text/css">
*{margin:0;padding:0;border:0; vertical-align:middle}
body{background:#3a6ea5;}
img{ vertical-align:middle}
.login_box{width:580px;height:320px;position:absolute;top:50%;left:50%;margin-left:-290px;margin-top:-160px;}
.login_box_top{background:url(<?php echo $_smarty_tpl->tpl_vars['COM']->value['IMG_PATH'];?>
login/login_box_top.gif) no-repeat;width:580px;height:13px; overflow:hidden}
.login_box_mid{background:url(<?php echo $_smarty_tpl->tpl_vars['COM']->value['IMG_PATH'];?>
login/login_box_mid.gif) repeat-y;width:580px;height:289px;}
.login_box_bot{background:url(<?php echo $_smarty_tpl->tpl_vars['COM']->value['IMG_PATH'];?>
login/login_box_bot.gif) no-repeat;width:580px;height:13px;}
.login_logo{float:left;display:inline; background:url() no-repeat;width:97px;height:67px;margin:30px 20px 0px 60px;}
.logo_content{float:left;width:360px;overflow:hidden;margin-top:36px;}
.logo_content .tit{ margin:0 0 30px}
.logo_content p{color:#464646;}
.valid{ border:1px solid #ccc;}
.error{ border:1px dashed red;}  
.login_input {background:url(<?php echo $_smarty_tpl->tpl_vars['COM']->value['IMG_PATH'];?>
login/login_input.gif) no-repeat;height:19px;padding:2px 0px 2px 4px;font-family: Arial, Helvetica, sans-serif}
.login_list li{margin-bottom:10px;display:inline;font-size:14px;width:360px;float:left; line-height:24px}
.login_list li label{display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline; width:55px; font-family:"宋体"; font-size:14px; }
.login_button{ background:url(<?php echo $_smarty_tpl->tpl_vars['COM']->value['IMG_PATH'];?>
login/login_button.gif) no-repeat;width:60px;height:28px;border:none; text-align:center; cursor:pointer;font-size:14px;margin-left:55px;}
.cr{font-size:12px;font-style:inherit;text-align:center;color:#87CEFA;width:100%; position:absolute; bottom:58px;}
.cr a{color:#A52A2A;text-decoration:none;}
</style>
</head>
<body>
<div class="login_box">
<div class="login_box_top"></div>
<div class="login_box_mid">
<div class="login_logo"></div>
<div class="logo_content">
<div class="tit"><img src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['IMG_PATH'];?>
login/guanli_center.gif" /></div>
<form action="<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
main_index/login?dosubmit=1" method="post" name="myform" id="myform">
<ul class="login_list">
<li><label>用户名</label><input type="text" class="login_input valid" name="username" id="username" size="24" /></li>
<li><label>密&nbsp;&nbsp;&nbsp;码</label><input type="password" class="login_input valid" name="password" id="password" size="24"/></li>
<!--<li><label>验证码</label><input name="code" id="code" onclick='this.src=this.src+"&"+Math.random()' type="text" class="login_input valid" size="4" /><span>&nbsp;<img id='code_img' src="com/common/verifycode?vcode=adlogin_verifycode&code_len=4&font_size=15&width=90&height=28&font_color=&background=" onclick='this.src=this.src+"&"+Math.random()' ></span></li>-->
<li><input type="button" class="login_button" id="submitBtn" name="submitBtn" value="登&nbsp;录"/></li>
</ul>
</form>
</div>
<div class="cr">CopyRight 2007-2013  <!--<a href="http://www.hzchihu.com" target="_blank">杭州赤虎科技有限公司</a>--> HZCH MALL </div>
<script type="text/javascript">
$(function(){
	$('#username').focus();
	$("#submitBtn").click(function(){
		if($("#myform").valid()){
			$("#myform").submit();
		}
	});
	
})
$(document).ready(function(){
	$('#myform').validate({
        errorPlacement: function(error, element){
        },
        success: function(label){
            label.addClass('valid');
        },
        onkeyup    : false,
        rules : {
            username : {
                required : true
            },
            password : {
                required   : true
            },
			code:{
				required  : '*'
			}
        },
        messages : {
            username : {
                required : '*',
            },
            password  : {
                required  : '*'
            },
			code:{
				required  : '*'
			}
        }
    });
});

</script>
</div>
<div class="login_box_bot"></div>
</div>

</body>
</html><?php }} ?>