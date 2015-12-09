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

function check_name( ntitle ){
	if ( ntitle.length == 0 ){
		document.getElementById('regname_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请填写EMAIL或用户名!';
	} else {
		document.getElementById('regname_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}

function check_code(code){
	if ( code.length == 0 ){
		document.getElementById('regcode_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请输入正确的验证码!';
	} else {
		document.getElementById('regcode_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}

function checkform()
{
	var regname = document.getElementById("regname").value;
	var yzcode = document.getElementById("yzcode").value;
	var msg = "";

	if(regname.length == 0)
  {
    msg += '请填写您的EMAIL或用户名!\n';
  }
	if(yzcode.length == 0){
		msg += '请输入验证码!\n';
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
  <table width="500" cellpadding="0" cellspacing="0" border="0" align="center">
  	<tr><td width="70">用户名：</td><td><input name="regname" id="regname" type="text" placeholder="请输入E-mail或用户名" value="" onblur="check_name(this.value);" class="khinput2" style="width:250px;" /></td><td><div id="regname_notice"></div></td></tr>
    <tr><td height="16"></td></tr>
 	 	<tr><td>验证码：</td><td><input name="yzcode" id="yzcode" type="text" value="" onblur="check_code(this.value);" class="khinput2" style="width:150px;" />
    	<img id='code_img' style=" vertical-align:middle; border:1px solid #dddddd;" onclick='this.src=this.src+"&"+Math.random()' src='<!--{BASE_URL}-->index.php?m=com&c=common&a=verifycode&vcode=login_verifycode&code_len=4&font_size=15&width=90&height=28&font_color=&background=' title="看不清,点击更换验证码"></td><td><div id="regcode_notice"></div></td>
  	</tr>
    <tr><td height="20"></td></tr>
	 	<tr><td></td><td><input class="passwordbt" type="submit" value=" " onclick=""></td></tr>
  </table>
 	</form>
  </div>  
    
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->