<!--{template 'index','header_user',SITE_TEMP }-->
<script type="text/javascript">
myLoad(108);
</script>
<div class="member_banner clearfix">

</div>	


<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">我的礼物</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">我的礼物</span></div></div>
		  
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
  	<div class="dindtop"><h3 style="float:left; width:200px; font-size:14px; color:#666666;">我的礼物</h3></div>
  	<div class="dindcon">
  		<table width="98%" cellpadding="0" cellspacing="0" border="1" bordercolor="#e8e7e7" align="center">
  			<tr>
  				<th align="center" width="50%" height="30">礼物内容</th>
  				<th align="center" width="20%">赠送时间</th>
  				<th align="center" width="15%">操作</th>
  			</tr>
  			<!--{foreach $list $v}-->
  			<tr>
  				<td align="left" height="28" style="line-height:20px;"><!--{$v['message_body']}--></td>
  				<td align="center"><!--{date('Y-m-d H:m:s', $v['message_time'])}--></td>
  				<td align="center" style="line-height:22px; font-size:13px;"><a href="index.php?m=member&c=present&a=del&id=<!--{$v['message_id']}-->" class="grey2">删除</a></td>
  			</tr>
    		<!--{/foreach}-->
  		</table>
  	</div>
  	<!--{$page}-->
  </div>
  </div>  
  </div>
  <div class="ddlfbg"></div>  
  <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->