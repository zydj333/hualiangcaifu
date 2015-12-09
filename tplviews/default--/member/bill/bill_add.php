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
var reg_number=/^[0-9-]*$/;

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
	var compname = document.getElementById("compname").value;
	var compcode = document.getElementById("compcode").value;
	var address2 = document.getElementById("address2").value;
	var tel = document.getElementById("tel").value;
	var bank = document.getElementById("bank").value;
	var bankcode = document.getElementById("bankcode").value;
	var msg = "";

	if(compname.length == 0)
  {
    msg += '请填写单位名称!\n';
  }
	if(compcode.length == 0){
		msg += '请输入纳税人识别码!\n';
	}else if(!reg_number.test(compcode)){
		msg += '纳税人识别号错误，请检查!\n';
	}
	if(address2.length == 0){
		msg += '请输入注册地址';
	}
	if(tel.length == 0){
		msg += '请输入注册电话!\n';
	}else if(!parttenmob.test(tel) && !parttentel.test(tel)){
		msg += '请输入正确的联系电话!\n';
	}
	if(bank.length == 0){
		msg += '请输入开户银行信息!\n';
	}
	if(bankcode.length == 0){
		msg += '请输入开户银行账户！';
	}else if(!reg_number.test(bankcode)){
		msg += '银行账号只能输入数字，请重新输入!\n';
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
<div class="mntopbg"><span class="info_navzi2">开票信息</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">开票信息</span></div></div>
		  
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
  <div class="dindtop"><h3 style="float:left; width:200px; font-size:14px; color:#666666;">开票信息</h3><span style="float:right; width:200px; padding-right:10px; text-align:right; font-size:14px;"><h10><!--{if !empty($bill['bill_id'])}--><a href="index.php?m=member&c=bill&a=delkaipiao&bid=<!--{$bill['bill_id']}-->">[删除]</a><!--{/if}--></h10></span></div>
		<div class="pcadd">
			<form action="" method="post" onsubmit="return checkform();" >
  		<input type="hidden" name="dosubmit" value="1">
  		<input type="hidden" name="billid" value="<!--{if isset($bill['bill_id'])}--><!--{$bill['bill_id']}--><!--{/if}-->">
			<table width="98%" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#dddddd" align="center">
							<tr>
								<th width="100" align="right" height="28">单位名称：</th>
								<td><input type="text" name="compname" id="compname" value="<!--{if isset($bill['compname'])}--><!--{$bill['compname']}--><!--{/if}-->" class="khinput2" style="width:150px;" />&nbsp;<font color="red">*</font></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">纳税人识别码：</th>
								<td><input type="text" name="compcode" id="compcode" value="<!--{if isset($bill['compcode'])}--><!--{$bill['compcode']}--><!--{/if}-->" class="khinput2" style="width:300px;" />&nbsp;<font color="red">*</font></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">注册地址：</th>
								<td><input type="text" name="address2" id="address2" value="<!--{if isset($bill['address'])}--><!--{$bill['address']}--><!--{/if}-->" class="khinput2" style="width:200px;" />&nbsp;<font color="red">*</font></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">注册电话：</th>
								<td><input type="text" name="tel" id="tel" value="<!--{if isset($bill['tel'])}--><!--{$bill['tel']}--><!--{/if}-->" class="khinput2" style="width:200px;" />&nbsp;<font color="red">*</font></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">开户银行：</th>
								<td><input type="text" name="bank" id="bank" value="<!--{if isset($bill['bank'])}--><!--{$bill['bank']}--><!--{/if}-->" class="khinput2" style="width:200px;" />&nbsp;<font color="red">*</font></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">银行账户：</th>
								<td><input type="text" name="bankcode" id="bankcode" value="<!--{if isset($bill['bankcode'])}--><!--{$bill['bankcode']}--><!--{/if}-->" class="khinput2" style="width:200px;" />&nbsp;<font color="red">*</font></td>
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