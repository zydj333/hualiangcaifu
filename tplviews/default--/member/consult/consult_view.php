<!--{template 'index','header_user',SITE_TEMP }-->
<script type="text/javascript">
myLoad(108);
</script>
<div class="member_banner clearfix">

</div>	


<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">我要投诉</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">我要投诉</span></div></div>
		  
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
  	<div class="dindtop"><h3 style="float:left; width:200px; font-size:14px; color:#666666;">我的投诉</h3></div>
		<div class="pcadd">
			<form action="" method="post" onsubmit="return checkform();" >
  		<input type="hidden" name="dosubmit" value="1">
			<table width="98%" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#dddddd" align="center">
							
							<tr>
								<th width="100" align="right" height="28">投诉内容：</th>
								<td><textarea name="consult_content" id="consult_content" rows="6" cols="100" style="width:350px;" readonly /><!--{$consultinfo['consult_content']}--></textarea></td>
							</tr>
							<!--{if !empty($consultinfo['consult_reply'])}-->
							<tr>
								<th width="100" align="right" height="28">回复内容：</th>
								<td><textarea name="consult_content" id="consult_content" rows="12" cols="100" style="width:350px;" readonly /><!--{$consultinfo['consult_reply']}--></textarea></td>
							</tr>
							<tr>
								<th width="100" align="right" height="28">回复时间：</th>
								<td><input name="phone" id="phone" type="text" value="<!--{date('Y-m-d H:m:s', $consultinfo['consult_reply_time'])}-->" class="khinput2" style="width:300px;" readonly /></td>
							</tr>
							<!--{else}-->
							<tr>
								<th width="100" align="right" height="28">回复状态：</th>
								<td>暂未回复</td>
							</tr>
							<!--{/if}-->
						</table>
					</td>
				</tr>
				<tr><td height="20"></td></tr>
				<tr><td align="center"><input type="button" name="button" value="返回" onclick="javascript:history.go(-1);"></td></tr>
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