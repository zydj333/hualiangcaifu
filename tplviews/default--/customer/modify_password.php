<!--{template 'index','header_bg',SITE_TEMP }-->
<script type="text/javascript">
myLoad(108);
</script>

<div class="index_banner clearfix">
            <div class="index_banner2">
                <ul>                    
                    <!--{cc:a_adv action="get_promotion_single" apid="16" cache="3600"}-->
									<!--{foreach $data $val}-->
									 <!--{if $val['adv_content']['adv_pic']}-->                   
                    <li><img src="<!--{BASE_URL}--><!--{$val['adv_content']['adv_pic']}-->" /></li>
                    <!--{/if}-->
                  <!--{/foreach}-->
									<!--{/cc}-->
                </ul>
            </div>
</div>	

<script language="javascript">
var parttenmob = /^1[3,5,8]\d{9}$/;
var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

function check_pwd1( ntitle ){
	if ( ntitle.length < 6 ){
		document.getElementById('pwd1_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请输入您的新密码且不小于6位!';
	} else {
		document.getElementById('pwd1_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}

function check_pwd2( ntitle ){
	if ( ntitle.length < 6 ){
		document.getElementById('pwd2_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请输入您的确认密码且不小于6位!';
	} else {
		document.getElementById('pwd2_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}


function checkform()
{
	var newpwd1 = document.getElementById("newpwd1").value;
	var newpwd2 = document.getElementById("newpwd2").value;
	var msg = "";

	if(newpwd1.length == 0){
		msg += '请输入您的新密码且不小于6位!\n';
	}
	if(newpwd2.length == 0){
		msg += '请输入您的确认密码且不小于6位!\n';
	}
	if(newpwd1 != newpwd2){
		msg += '您两次输入的密码不一致!\n';
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
<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">客户专区</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=customer&a=login" class="grey">找回密码</a> > <span class="font_red">找回密码</span></div></div>
		  
  <div class="main_con clearfix">
  <div class="khzqzc clearfix">
  <form action="" method="post" onsubmit="return checkform();" >
  <input type="hidden" name="dosubmit" value="1">
  <input type="hidden" name="uid" value="<!--{$user_info['user_id']}-->">
  <input type="hidden" name="uemail" value="<!--{$user_info['email']}-->">
  <table width="500" cellpadding="0" cellspacing="0" border="0" align="center">
  	<tr><td width="70">新密码：</td><td><input name="newpwd1" id="newpwd1" type="password" value="" onblur="check_pwd1(this.value);" class="khinput2" style="width:250px;" /></td><td><div id="pwd1_notice"></div></td></tr>
  	<tr><td height="20" colspan="2"></td></tr>
  	<tr><td width="70">确认密码：</td><td><input name="newpwd2" id="newpwd2" type="password" value="" onblur="check_pwd2(this.value);" class="khinput2" style="width:250px;" /></td><td><div id="pwd2_notice"></div></td></tr>
    <tr><td height="20"></td></tr>
	 	<tr><td></td><td><input class="passwordbt" type="submit" value=" " onclick=""></td></tr>
  </table>
 	</form>
  </div>  
    
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->