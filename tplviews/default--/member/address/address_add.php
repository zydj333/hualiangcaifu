<!--{template 'index','header_user',SITE_TEMP }-->
<script type="text/javascript">
myLoad(108);
</script>
<script type="text/javascript" src="<!--{JS_PATH}-->selarea.js"></script>
<div class="member_banner clearfix">

</div>	
<script language="javascript">
var parttenmob = /^1[3,5,8]\d{9}$/;
var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

function checkoption(field) 
{
 for (i = 0; i < field.length; i++){
 		if (field.options[field.selectedIndex].selected){
 			return true;
 		}
 }
 
 return false;
}

function checkform()
{
	var true_name = document.getElementById("true_name").value;
	var address = document.getElementById("address").value;
	var mob_phone = document.getElementById("mob_phone").value;
	var msg = "";

	if(true_name.length == 0)
  {
    msg += '请填写您的姓名!\n';
  }
	if(address.length == 0){
		msg += '请输入您的详细地址!\n';
	}
	if(mob_phone.length == 0){
		msg += '请输入您的联系电话!\n';
	}else if(!parttenmob.test(mob_phone) && !parttentel.test(mob_phone)){
		msg += '请输入正确的联系电话!\n';
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
<div class="mntopbg"><span class="info_navzi2">收货地址</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">收货地址</span></div></div>
		  
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
  	<div class="dindtop"><h3 style="float:left; width:200px; font-size:14px; color:#666666;">收货地址</h3></div>
		<div class="pcadd">
			<form action="" method="post" onsubmit="return checkform();" >
  		<input type="hidden" name="dosubmit" value="1">
			<table width="98%" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#dddddd" align="center">
							<tr>
								<th width="100" align="right" height="28">收货人：</th>
								<td><input type="text" name="true_name" id="true_name" class="khinput2" style="width:150px;" />&nbsp;<font color="red">*</font></td>
							</tr>
							<tr>
								<th align="right" height="28">地址：</th>
								<td>
									<select name="province2" id="province2" class="khinput2" style="width:75px;">
									<option value="">请选择</option>
  								<!--{foreach $area $v}-->
  									<option value="<!--{$v['id']}-->"><!--{$v['name']}--></option>
  								<!--{/foreach}-->
  								</select>
  								<select name="city2" id="city2" class="khinput2" style="width:75px;">
      						</select>
      						<select name="county2" id="county2" class="khinput2" style="width:75px;">
      						</select>&nbsp;<font color="red">*</font>
								</td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">详细地址：</th>
								<td><input type="text" name="address" id="address" class="khinput2" style="width:300px;" />&nbsp;<font color="red">*</font></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">邮编：</th>
								<td><input type="text" name="zip_code" id="zip_code" class="khinput2" style="width:200px;" /></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">移动电话：</th>
								<td><input type="text" name="mob_phone" id="mob_phone" class="khinput2" style="width:200px;" />&nbsp;<font color="red">*</font></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">固定电话：</th>
								<td><input type="text" name="tel_phone" id="tel_phone" class="khinput2" style="width:200px;" /></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">默认地址：</th>
								<td><input value="1" style="width:20px" name="d_add" id="d_add" type="checkbox"></td>
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
  <div class="ddlfbg"></div>  
  <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->