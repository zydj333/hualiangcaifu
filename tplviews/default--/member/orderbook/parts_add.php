<!--{template 'index','header_user',SITE_TEMP }-->
<script type="text/javascript">
myLoad(108);
</script>
<div class="member_banner clearfix">

</div>	
<script type="text/javascript" src="<!--{JS_PATH}-->orderbook.js"></script>
<script type="text/javascript" src="<!--{JS_PATH}-->shop.js"></script>
<script language="javascript">
var parttenmob = /^1[3,5,8]\d{9}$/;
var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

function checkform()
{
	var parts_name = document.getElementById("parts_name").value;
	var msg = "";
	
 	
	if(parts_name.length == 0){
		alert("请输入配件名称!");
		return false;
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
<div class="mntopbg"><span class="info_navzi2">产品下单</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">产品下单</span></div></div>
		  
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
  	<div class="dindtop"><h3 style="float:left; width:200px; font-size:14px; color:#666666;">配件下单<span id="spec_info"></span></h3></div>
		<div class="pcadd">
			<form action="" method="post" onsubmit="return checkform();" >
  		<input type="hidden" name="dosubmit" value="ok">
			<table width="98%" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#dddddd" align="center">
							<tr>
								<th width="100" align="right" height="28">配件名称：</th>
								<td><input name="parts_name" id="parts_name" type="text" value="" class="khinput2" style="width:300px;" /></td>
							</tr>
							<tr>
								<th align="right" height="28">数量：</th>
								<td><input name="add_numbs" id="add_numbs" type="text" value="1" onblur="javascript:numchange2();" class="khinput2" style="width:100px;" /></td>
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