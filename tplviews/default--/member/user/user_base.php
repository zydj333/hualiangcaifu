<!--{template 'index','header_user',SITE_TEMP }-->
<script type="text/javascript" src="<!--{JS_PATH}-->selarea.js"></script>
<script type="text/javascript" src="<!--{JS_PATH}-->My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
myLoad(108);
</script>
<div class="member_banner clearfix">

</div>	


<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">账户信息</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">账户信息</span></div></div>
		  
  <div class="main_con clearfix">
  <div class="pencet clearfix">
  	<!--{template 'index','user_left',SITE_TEMP }-->
  <div class="pencetr">
  
  <div class="snpclines clearfix">
  <div class="pclf1"><img src="<!--{if !empty($userInfo['head_ico'])}--><!--{$userInfo['head_ico']}--><!--{else}-->statics/default/images/head_ico.gif<!--{/if}-->" width="103" height="81" /><span>您好，<font style="color:#e4393c; font-size:18px;"><b><?php echo $this->session->userdata['member_username']; ?></b></font>&nbsp;&nbsp;[<a href="index.php?c=customer&a=logout" class="purple">退出</a>]<br />欢迎登录双鸟机械官网！<br />会员等级：<!--{if !empty($groupInfo['groupname'])}--><!--{$groupInfo['groupname']}--><!--{else}-->暂无级别<!--{/if}--></span></div>
  <div class="pclf2">账户余额：<br /><font style="color:#e4393c; font-size:18px;"><b><!--{$userInfo['available_predeposit']}--></b></font> 元</div>
  <div class="pclf2">信用额度：<br /><font style="color:#e4393c; font-size:18px;"><b><!--{$userInfo['freeze_predeposit']}--></b></font> 元</div>
  </div>
  <div class="dindan">
  	<div class="dindtop"><h3 style="float:left; width:200px; font-size:14px; color:#666666;">个人资料</h3></div>
		<div class="pcadd">
			<form action="" method="post" enctype="multipart/form-data" onsubmit="return checkform();" >
  		<input type="hidden" name="dosubmit" value="1">
			<table width="98%" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#dddddd" align="center">
							<tr>
								<th width="100" align="right" height="28">真实姓名：</th>
								<td><input name="truename" id="truename" type="text" value="<!--{$userInfo['truename']}-->" class="khinput2" style="width:300px;" /></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">性别：</th>
								<td><input type="radio" name="sex" id="sex1" value="0" <!--{if $userInfo['sex']==0}-->checked<!--{/if}--> />保密&nbsp;&nbsp;<input type="radio" name="sex" id="sex1" value="1" <!--{if $userInfo['sex']==1}-->checked<!--{/if}--> />男&nbsp;&nbsp;<input type="radio" name="sex" id="sex2" value="2" <!--{if $userInfo['sex']==2}-->checked<!--{/if}--> />女</td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">头像：</th>
								<td >
									<span class="type-file-box">
									<input type="text" id="textfield1" name="textfield" style="width:197px;">							
									<input name="head_ico" id="head_ico" type="file" class="type-file-file" style="width:265px;" />
									<input type="button" class="type-file-button" value="" id="button1" name="button">
									</td>
								</span>
								
							</tr>
							<tr>
								<th width="100" align="right" height="28">生日：</th>
								<td><input name="birthday" id="birthday" type="text" value="<!--{$userInfo['birthday']}-->" class="khinput2" onClick="WdatePicker({el:'birthday'})" style="width:300px;" /></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">手机：</th>
								<td><input name="phone" id="phone" type="text" value="<!--{$userInfo['phone']}-->" class="khinput2" style="width:300px;" /></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">电话：</th>
								<td><input name="tel" id="tel" type="text" value="<!--{$userInfo['tel']}-->" class="khinput2" style="width:300px;" /></td>
							</tr>
							<tr>
								<th align="right" height="28">邮箱：</th>
								<td><input name="email" id="email" type="text" value="<!--{$userInfo['email']}-->" class="khinput2" style="width:300px;" /></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">公司名称：</th>
								<td><input name="web" id="web" type="text" value="<!--{$userInfo['web']}-->" class="khinput2" style="width:300px;" /></td>
							</tr>
							<tr>
								<th align="right" height="28">地址：</th>
								<td>
									<select name="province2" id="province2" class="khinput2" style="width:75px;">
  								<!--{foreach $area $v}-->
  									<option value="<!--{$v['id']}-->" <!--{if $userInfo['province_id'] == $v['id']}-->selected<!--{/if}-->><!--{$v['name']}--></option>
  								<!--{/foreach}-->
  								</select>
  								<select name="city2" id="city2" class="khinput2" style="width:75px;">
      						</select>
      						<select name="county2" id="county2" class="khinput2" style="width:75px;">
      						</select>
  								<input name="address" id="address" type="text" value="<!--{$userInfo['address']}-->" class="khinput2" style="width:200px;" />
									<script language="javascript">
      							setup(<!--{$userInfo['province_id']}-->,<!--{$userInfo['city_id']}-->,<!--{$userInfo['area_id']}-->);
      						</script>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td height="20"></td></tr>
				<tr><td align="center"><input class="tjsmzc" type="submit" value=""></td></tr>
			</table>
			</form>
		</div>
  </div>
  
  </div>

  
  
  
  </div>  
  </div>
  <div class="ddlfbg"></div>  
  <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>
<script language="javascript">
$(function(){
    $("#head_ico").change(function(){
	$("#textfield1").val($("#head_ico").val());
    });
});
</script>



<!--{template 'index','footer',SITE_TEMP }-->