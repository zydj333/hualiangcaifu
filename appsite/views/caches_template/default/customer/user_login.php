<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=".html-Type" .html="text/html; charset=utf-8" />
<title>登录_财来电-中国最大最专业的理财师一站式服务平台</title>
<link href="<?php echo CSS_PATH;?>log_reg.css" type="text/css" rel="stylesheet" />
<script src="<?php echo JS_PATH;?>jquery-1.7.2.min.js"></script>
<script language="javascript">
var parttenmob = /^1[3,5,8]\d{9}$/;
var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

function checkform()
{
	var loginname = document.getElementById("loginname").value;
	var loginpsd = document.getElementById("loginpsd").value;
	var msg = "";

	if(loginname.length == 0)
  {
    msg += '请输入手机号码!\n';
  }else if(!parttenmob.test(loginname)){
  	msg += '请输入正确的手机号码!\n';
  }
  
  if(loginpsd.length == 0)
  {
    msg += '请输入登录密码!\n';
  }
	
	if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}
</script> 
</head>

<body>

<!--header-->
<header>
    <div class="lr_head">
        <div class="lr_head_top">
            <a href="index.php"><img src="<?php echo IMG_PATH;?>logo.jpg" title="财来电标志"  /></a>
            <span title="咨询热线"></span>
        </div>
        <div class="lr_head_btm"></div>    
    </div>
</header>
<!--header end-->
<!--big banner-->
<div class="lr_banner">
    <div class="lr_banner_body">
    		<form action="" method="post" onsubmit="return checkform();" >
  			<input type="hidden" name="dosubmit" value="1">
        <div class="lr_log">
            <h3>用户登录</h3>
            <dl>
                <dt>
                    <font>手机</font>
                    <strong id="error" style="color:red;padding-left:90px;"></strong> 
                </dt>
                <dd>
                    <span><img src="<?php echo IMG_PATH;?>lr_mob_icon.jpg"  /></span>
                   <input name="loginname" type="text" id="loginname" />
                </dd>
            </dl>
            <dl>
                <dt>
                    <font>密码</font>
                      <strong id="error2" style="color:red;padding-left:90px;"></strong> 
               
                </dt>
                <dd>
                    <span><img src="<?php echo IMG_PATH;?>lr_password_icon.jpg" /></span>
                   <input name="loginpsd" type="password" id="loginpsd" />
                </dd>
            </dl>
            <div>
                <input type="submit" name="loginbt" value="" id="loginbt" class="lr_log_submit" />
                <a href="index.php?c=customer&a=forget_password">忘记密码？</a>
            </div>
            <a href="index.php?c=customer&a=register" title="秒快速注册" class="lr_log_regbtn"></a>
        </div>
      </form>
        <div class="lr_banner_body_pic01"  ></div>
        <div class="lr_banner_body_pic02"></div>
        <div class="lr_banner_body_pic03"></div>
    </div>
</div>
<!--big banner end-->
<!--登录页面专有底部-->
<div class="lr_footer">
    <div>
        <p>Copyright © 2014 财来电 1caifu.com All Rights Reserved 版权所有   浙ICP备12023130号-4</p>
        <span><img src="<?php echo IMG_PATH;?>footer_tel.jpg" title="咨询热线"  /></span>
    </div>
</div>
</body>
</html>
