<!--{template 'index','header_bg',SITE_TEMP }-->
<script type="text/javascript">
myLoad(109);
</script>
<style>
.tis {background-color: #FFFFE3;border: 1px solid #CCCCCC;float: left;height: 28px;line-height: 28px;margin-left: 10px;padding-left: 5px;width: 295px;}
</style>
<div class="index_banner clearfix">
            <div class="index_banner2">
                <ul>                    
                    <!--{cc:a_adv action="get_promotion_single" apid="17" cache="3600"}-->
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
function check_name( ntitle )
{
	if ( ntitle.length == 0 )
  {
		document.getElementById('contact_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请填写您的姓名!';
	}
	else
	{
		document.getElementById('contact_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}
function check_email(email)
{
	if ( email.length == 0 || !checkemail(email))
  {
		document.getElementById('email_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请填写您的邮箱!';
	}
	else
	{
		document.getElementById('email_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}

function check_message(message)
{
	if ( message.length == 0 )
  {
		document.getElementById('message_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请输入留言内容!';
	}
	else
	{
		document.getElementById('message_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}

function check_code(code)
{
	if ( code.length == 0 )
  {
		document.getElementById('code_notice').innerHTML = '<img src="statics/default/images/terror.jpg">&nbsp;请输入验证码!';
	}
	else
	{
		document.getElementById('code_notice').innerHTML = '<img src="statics/default/images/tcorrect.jpg">';
	}
}

function checkform()
{
	var contact = document.getElementById("contact").value;
	var email = document.getElementById("email").value;
	var content = document.getElementById("content").value;
	var code = document.getElementById("yzcode").value;
	var msg = "";

	if(contact.length == 0)
  {
    msg += '请填写您的姓名!\n';
  }
	if(email.length == 0){
		msg += '请填写您的邮箱!\n';
	}else if(!checkemail(email)){
		msg += '请输入正确格式的电子邮箱!\n';
	}
	if(content.length == 0){
		msg += '请输入留言内容!\n';
	}
	if(code.length == 0){
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
</script>  

<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">访客留言</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=introduce&a=contactus" class="grey">联系我们</a> > <span class="font_red">访客留言</span></div></div>
		  
  <div class="main_con clearfix">
    <div class="main_con_left"> <img src="<!--{IMG_PATH}-->left_img.png" class="font_size fix div_block" /> <img src="<!--{IMG_PATH}-->news_img7.jpg" class="font_size fix div_block" />
      <ul class="left_menu">
  			<li><a href="index.php?c=introduce&a=contactus">联系方式</a></li>
  			<li><a href="index.php?c=introduce&a=route">来司线路</a></li>
  			<li class="current"><a href="index.php?c=introduce&a=message">访客留言</a></li>
  			<li><a href="admin.php/main_index/login" target="_blank">管理登录</a></li>
			</ul>
      <img src="<!--{IMG_PATH}-->left_img_bottom.png" class="font_size fix div_block" />
      <img src="<!--{IMG_PATH}-->cont.jpg" border="0" class="fix contd_img" />
      <img src="<!--{IMG_PATH}-->weixin.jpg" border="0" class="fix contd_img" />
    </div>
    <div class="main_con_right">
      <div class="about_con">    
	   <div class="contact mapbg">
	   <div class="contbt1"><h3>访客留言</h3></div>	   
      
	  <div class="feedbackC">
   <div class="tab">
    <form action="" method="post" onsubmit="return checkform();" >
    	<input type="hidden" name="dosubmit" value="ok">
    <table width="100%">
     <tr>
      <td width="100" align="right">您的称呼：</td>
      <td class="td1"><input type="text" name="contact" value="" class="txt" id="contact" onblur="check_name(this.value);" /></td>
      <td><div id="contact_notice"></div></td>
     </tr>
	   <tr>
      <td align="right">公司名称：</td>
      <td class="td1"><input type="text" name="company" value="" class="txt" id="company" /></td>
      <td></td>
     </tr>
     <tr>
      <td align="right">联系电话：</td>
      <td class="td1"><input type="text" name="phone" value="" class="txt" id="phone" /></td>
      <td></td>
     </tr>
     <tr>
      <td align="right">传真号码：</td>
      <td class="td1"><input type="text" name="fax" value="" class="txt" id="fax" /></td>
      <td></td>
     </tr>
	   <tr>
      <td align="right">电子邮箱：</td>
      <td class="td1"><input type="text" name="email" value="" class="txt" id="email" onblur="check_email(this.value);" /></td>
     	<td><div id="email_notice"></div></td>
     </tr>
	 	 <tr>
      <td align="right">地    址：</td>
      <td class="td1"><input type="text" name="address" value="" class="txt" id="address" /></td>
      <td></td>
     </tr>
     <tr>
      <td valign="top" align="right">留    言：</td>
      <td class="td1"><textarea name="content" id="content" style=" width:243px;" onblur="check_message(this.value);"></textarea></td>
      <td><div id="message_notice"></div></td>
     </tr>
     <tr>
  		<td valign="top" align="right">验证码：</td>
  		<td class="td1"><input name="yzcode" id="yzcode" type="text" value="" onblur="check_code(this.value);" class="khinput2" style="width:145px;" />
  			<img id='code_img' style=" vertical-align:middle; border:1px solid #dddddd;" onclick='this.src=this.src+"&"+Math.random()' src='<!--{BASE_URL}-->index.php?m=com&c=common&a=verifycode&vcode=login_verifycode&code_len=4&font_size=15&width=90&height=28&font_color=&background=' title="看不清,点击更换验证码">
    	</td>
    	<td><div id="code_notice"></div></td>
  	 </tr>
     <tr>
      <td>&nbsp;</td>
      <td class="td1" colspan="2"><input class="tjsmzc" type="submit" value=" "></td>
     </tr>
    </table>
    </form>
   </div>
  </div>
	  
	     
	</div>   
	   	    
      </div>
    </div>
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->