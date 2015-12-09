<!--{template 'index','header_bg',SITE_TEMP }-->
<script type="text/javascript" src="<!--{JS_PATH}-->selarea.js"></script>
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
		document.getElementById('regname_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请填写您的用户名!';
	} else {
		document.getElementById('regname_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}
function check_pwd1( pwd1 ){
	if ( pwd1.length == 0 ){
		document.getElementById('regpwd1_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请输入您的密码!';
	} else if(pwd1.length < 6 || pwd1.length >32){
		document.getElementById('regpwd1_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;密码6～32个字符之间!';
	} else {
		document.getElementById('regpwd1_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}
function check_pwd2( pwd2 ){
	var pwd1 = document.getElementById('regpwd1').value;
	if ( pwd2.length == 0 ){
		document.getElementById('regpwd2_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请再次输入您的密码!';
	} else if(pwd2.length < 6 || pwd2.length >32){
		document.getElementById('regpwd2_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;密码6～32个字符之间!';
	} else if(pwd2 != pwd1){
		document.getElementById('regpwd2_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;两次密码不一致!';
	} else {
		document.getElementById('regpwd2_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}
function check_tel(tel){
	if ( tel.length == 0 ){
		document.getElementById('regtel_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请输入您的联系电话!';
	} else if(!parttenmob.test(tel) && !parttentel.test(tel)){
	document.getElementById('regtel_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请填写正确格式的电话!';
	} else {
		document.getElementById('regtel_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}
function check_email(email){
	if ( email.length == 0 || !checkemail(email)){
		document.getElementById('regemail_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请填写正确格式的邮箱!';
	} else {
		document.getElementById('regemail_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}
function check_code(code){
	if ( code.length == 0 ){
		document.getElementById('regcode_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请输入正确的验证码!';
	} else {
		document.getElementById('regcode_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}

function checkemail(string){
   if(string.length!=0){
    if (string.charAt(0)=="." || string.charAt(0)=="@"|| string.indexOf('@', 0) == -1 || string.indexOf('.', 0) == -1 || string.lastIndexOf("@")==string.length-1 || string.lastIndexOf(".") ==string.length-1)
     {
      return false;
      }
   } else {
     return false;
   }
   return true;
}


function checkform()
{
	var regname = document.getElementById("regname").value;
	var regpwd1 = document.getElementById("regpwd1").value;
	var regpwd2 = document.getElementById("regpwd2").value;
	var regtel = document.getElementById("regtel").value;
	var regemail = document.getElementById("regemail").value;
	var msg = "";

	if(regname.length == 0)
  {
    msg += '请填写您的用户名!\n';
  }
	if(regpwd1.length == 0){
		msg += '请输入您的登录密码!\n';
	}
	if(regpwd2.length == 0){
		msg += '请再吃输入您的登录密码!\n';
	}
	if(regtel.length == 0){
		msg += '请输入您的联系电话!\n';
	}else if(!parttenmob.test(regtel) && !parttentel.test(regtel)){
		msg += '请输入正确的联系电话!\n';
	}
	if(regemail.length == 0){
		msg += '请填写您的邮箱!\n';
	}else if(!checkemail(regemail)){
		msg += '请输入正确格式的电子邮箱!\n';
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
	<div class="mntopbg">
		<span class="info_navzi2">客户专区</span>
    <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=customer&a=login" class="grey">客户专区</a> > <span class="font_red">注册</span></div>
  </div>
		  
  <div class="main_con clearfix">
  	<form action="" method="post" onsubmit="return checkform();" >
  	<input type="hidden" name="dosubmit" value="1">
  	<div class="khzqzc clearfix">
  		<div class="khzqlf">
  			<table width="100%" cellpadding="0" cellspacing="0" border="0">
  				<tr>
  					<td width="85">用户名：</td>
  					<td width="47%"><input name="regname" id="regname" type="text" onblur="check_name(this.value);" value="<!--{if isset($this->session->userdata['temp_regname'])}--><?php echo $this->session->userdata['temp_regname'];?><!--{/if}-->" class="khinput2" style="width:250px;" /></td>
  					<td><div id="regname_notice"></div></td>
  				</tr>
  				<tr><td height="16"></td></tr>
  				<tr>
  					<td>密码：</td>
  					<td width="47%"><input name="regpwd1" id="regpwd1" type="password" onblur="check_pwd1(this.value);" value="<!--{if isset($this->session->userdata['temp_regpwd1'])}--><?php echo $this->session->userdata['temp_regpwd1'];?><!--{/if}-->" class="khinput2" style="width:250px;" /></td>
  					<td><div id="regpwd1_notice"></div></td>
  				</tr>
    			<tr><td height="16"></td></tr>
  				<tr>
  					<td>确认密码：</td>
  					<td width="47%"><input name="regpwd2" id="regpwd2" type="password" onblur="check_pwd2(this.value);" value="<!--{if isset($this->session->userdata['temp_regpwd2'])}--><?php echo $this->session->userdata['temp_regpwd2'];?><!--{/if}-->" class="khinput2" style="width:250px;" /></td>
  					<td><div id="regpwd2_notice"></div></td>
  				</tr>
    			<tr><td height="16"></td></tr>
    			<tr>
  					<td>电话：</td>
  					<td width="47%"><input name="regtel" id="regtel" type="text" onblur="check_tel(this.value);" value="<!--{if isset($this->session->userdata['temp_regtel'])}--><?php echo $this->session->userdata['temp_regtel'];?><!--{/if}-->" class="khinput2" style="width:250px;" /></td>
  					<td><div id="regtel_notice"></div></td>
  				</tr>
    			<tr><td height="16"></td></tr>
    			<tr>
  					<td>邮件：</td>
  					<td width="47%"><input name="regemail" id="regemail" type="text" onblur="check_email(this.value);" value="<!--{if isset($this->session->userdata['temp_regemail'])}--><?php echo $this->session->userdata['temp_regemail'];?><!--{/if}-->" class="khinput2" style="width:250px;" /></td>
  					<td><div id="regemail_notice"></div></td>
  				</tr>
  				<tr><td height="16"></td></tr>
  				<tr>
  					<td>地址：</td>
  					<td width="47%">
  						<select name="province2" id="province2" class="khinput2" style="width:79px;">
  							<!--{foreach $area_list $v}-->
  							<option value="<!--{$v['id']}-->" <!--{if isset($this->session->userdata['temp_province2']) && $this->session->userdata['temp_province2'] == $v['id']}-->selected<!--{/if}-->><!--{$v['name']}--></option>
  							<!--{/foreach}-->
  						</select>
  						<select name="city2" id="city2" class="khinput2" style="width:79px;">
      				</select>
      				<select name="county2" id="county2" class="khinput2" style="width:81px;">
      				</select>
      				<script language="javascript">
      					setup(<?php echo $this->session->userdata['temp_province2'];?>,<?php echo $this->session->userdata['temp_city2'];?>,<?php echo $this->session->userdata['temp_county2'];?>);
      				</script>
  					</td>
  				</tr>
  				<tr><td height="16"></td></tr>
  				<tr>
  					<td></td>
  					<td width="47%">
  						<input name="regaddr" id="regaddr" type="text" value="<!--{if isset($this->session->userdata['temp_regaddr'])}--><?php echo $this->session->userdata['temp_regaddr'];?><!--{/if}-->" class="khinput2" style="width:250px;" />
  					</td>
  				</tr>
    			<tr><td height="16"></td></tr>
  				<tr>
  					<td>验证码：</td>
  					<td width="47%"><input name="yzcode" id="yzcode" type="text" value="" onblur="check_code(this.value);" class="khinput2" style="width:150px;" />
  							<img id='code_img' style=" vertical-align:middle; border:1px solid #dddddd;" onclick='this.src=this.src+"&"+Math.random()' src='<!--{BASE_URL}-->index.php?m=com&c=common&a=verifycode&vcode=login_verifycode&code_len=4&font_size=15&width=90&height=28&font_color=&background=' title="看不清,点击更换验证码">
    				</td>
    				<td><div id="regcode_notice"></div></td>
  				</tr>
    			<tr><td height="20"></td></tr>
					<tr>
						<td></td>
						<td colspan="2"><input checked="checked" type="checkbox" /> 同意“<a href="index.php?c=introduce&a=agreement" target="_blank" class="wred">双鸟服务条款</a>”</td>
					</tr>
	 				<tr><td height="20"></td></tr>
	 				<tr>
	 					<td></td>
	 					<td colspan="2"><input class="wlzc" type="submit" value=" " onclick=""></td>
	 				</tr>
  			</table>
  		</div>
  		<div class="khzqrg"><img src="<!--{IMG_PATH}-->kszcpic.gif" /></div>
  	</div>  
    </form>
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>

<!--{template 'index','footer',SITE_TEMP }-->