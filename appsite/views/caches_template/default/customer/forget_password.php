<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <title>财来电-中国最大最专业的理财师一站式服务平台-忘记密码</title>
    <style>
        a {
          font-size:14px; text-decoration:none;   color: red; font-size:18px; padding:3px;
        }

    </style>
     <script type="text/javascript" src="<?php echo JS_PATH;?>jquery-1.7.2.min.js"></script>
   
 <script>
 
 
         var wait=60;
        function time(o) {
            if (wait == 0) {
                document.getElementById("btn").removeAttribute("disabled");
                document.getElementById("btn").value = "免费获取验证码";
                wait = 60;
            } else {
                document.getElementById("btn").setAttribute("disabled", true);
                document.getElementById("btn").value = "重新发送(" + wait + ")";
                wait--;
                setTimeout(function() {
                    time(document.getElementById("btn"))
                },
                1000)
            }
        }
        //document.getElementById("btn").onclick=function(){}
 			
			$(function(){
			    $(".ret_yzm").click(function () {
                
					  
						if (!$("#txtMob").val().match(/^1[3|4|5|8|9][0-9]\d{4,8}$/)) {
							$("#moileMsg").show();
							$("#moileMsg").html("<font color='red'>请重新输入正确手机号！</font>");
							$("#txtMob").focus();
							return false;
						} else {
							$("#moileMsg").html(" ");
							$.post("Controller/GetMobPwd.ashx", { mob: $("#txtMob").val() }, function (result) {
		
							    if (result == "不存在的账号") {
									$("#moileMsg").show();
									$("#moileMsg").html("<font color='red'>不存在的账号！</font>");
								}
								else {
									time("o");
									$("#moileMsg").show();
									$("#moileMsg").html("<font color='red'>" + result + "</font>");
								}
							});
						}
					});
			})
        

</script>

   <link href="<?php echo CSS_PATH;?>top_foot.css" type="text/css" rel="stylesheet"  />
<link href="<?php echo CSS_PATH;?>log_reg.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <form method="post" action="findpwd.aspx" onsubmit="javascript:return WebForm_OnSubmit();" id="form1">
<div class="aspNetHidden">
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTEwOTcxNjY5NmRkpNtP528Q8HI4rKr3jrLM+IS/+J9iu4ozeROmkakmiQw=" />
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['form1'];
if (!theForm) {
    theForm = document.form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>


<script src="/WebResource.axd?d=guZxk8kOYU9YBQupMckJJA2&amp;t=635301410579355894" type="text/javascript"></script>


<script src="/WebResource.axd?d=uMx9Mja_-l7Iinw-ZqWIzkUsxolD56TGLMqEWneWywY1&amp;t=635301410579355894" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
if (typeof(ValidatorOnSubmit) == "function" && ValidatorOnSubmit() == false) return false;
return true;
}
//]]>
</script>

<div class="aspNetHidden">

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWBAKVk6OGCAKF+778DALCws23BwKM54rGBtaGKECURauPTr/x7fmIJ6pbt/WM88RsKl6D+ObNFC+W" />
</div>


        <header>
    <div class="lr_head">
        <div class="lr_head_top">
            <a href="index.php"><img src="<?php echo IMG_PATH;?>logo.jpg" title="财来电"  /></a>
            <span title="咨询热线"></span>
        </div>
        <div class="lr_head_btm"></div>    
    </div>


</header>


        <div class="ret_password">
    <!--重设密码-->
    <h2>重设密码</h2>

    <div>
        <span>手机号码：</span>
       <input name="txtMob" type="text" maxlength="11" id="txtMob" class="ret_mob" style="width:150px;" />
       
        <input name="button" type="button" class="ret_yzm" id="btn"     value="免费获取验证码"  style="color:#fff;"/>
        	<br />
        <span id="moileMsg" class="red" style="width:300px;display:none;">手机号码不能为空</span>
        <br />
        <span id="RegularExpressionValidator2" class="red" style="display:none;">格式不正确</span>

    </div>
    <div>
        <span>验证码：</span>
      
          <input name="txtMobCode" type="text" maxlength="4" id="txtMobCode" class="ret_text" />
    </div>
 
      <input type="submit" name="Button1" value="" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;Button1&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="Button1" class="ret_btn" />
                
                <br />
                  <h2> <a href="index.php?c=customer&a=login" style="font-size:20px; color:#31CB97;">返回登录</a></h2>          
           
    <!--重设密码结束-->    
</div>


 
      

</form>        
<?php include APPPATH.'views/'.template('index','footer',SITE_TEMP ); ?>

<script>
    $('#head-searchtxt').keydown(function (e) {
        if (e.keyCode == 13) {
            $("#head-txtsearch").focus();
            $("#head-txtsearch").click();
        }

    });


    $("#head-txtsearch").click(function () {
        var title = $.trim($("#head-searchtxt").val());
        window.location.href = "product.aspx?title=" + title + "&bid=0&sy=0&qx=0&fsrq=0&fxfy=0&syl=0&fxfs=0&tzly=0&manager=0&types=0&addr=0&daxiao=0";
    });
</script>

