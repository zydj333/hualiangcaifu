<!--{template 'index','header_user',SITE_TEMP }-->

<script type="text/javascript">
myLoad(108);
</script>
<div class="member_banner clearfix">

</div>


<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">我的订单</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">我的订单</span></div></div>
		  
  <div class="main_con clearfix">
  <div class="pencet clearfix">
  <!--{template 'index','user_left',SITE_TEMP }-->
  <div class="pencetr">
  <div class="snpclines clearfix">
  <div>
    <table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#dddddd" align="center">
	<tr><td width="40%">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
	<tr><td colspan="2" height="26" style="border-bottom:1px solid #dddddd; padding-left:15px; font-size:13px;"><b>订单信息</b></td></tr>
	<tr><td style="border-bottom:1px solid #dddddd; padding:10px 10px 10px 10px; color:#666666; line-height:22px;">收货地址：<!--{if isset($area_info['true_name'])}--><!--{$area_info['true_name']}--><!--{/if}-->，<!--{if isset($area_info['mob_phone'])}--><!--{$area_info['mob_phone']}--><!--{/if}-->，<br /><!--{if isset($area_info['area_info'])}--><!--{$area_info['area_info']}--><!--{/if}--> <!--{if isset($area_info['address'])}--><!--{$area_info['address']}--><!--{/if}-->，<!--{if isset($area_info['zip_code'])}--><!--{$area_info['zip_code']}--><!--{/if}--></td></tr>
	<tr><td style="padding:10px 10px 10px 10px; color:#666666;">订单编号：<!--{$order_info['order_sn']}--></td></tr>
	</table>
	</td><td valign="middle" style="padding:0 0 0 20px; font-size:14px;"><img src="<!--{IMG_PATH}-->proddpic2.jpg" style="vertical-align:middle;"/> <b>订单状态： <!--{$order_info['state_name']}--></b></td></tr>
  </table>
  </div>
  
  <div style="margin-top:27px;">
  <table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#dddddd" align="center">
  <tr bgcolor="#f5f5f5">
  	<td height="40" align="center" width="50%">商品</td>
  	<td align="center" width="10%">吨位</td>
  	<td align="center" width="10%">米数</td>
  	<td align="center" width="10%">单价</td>
  	<td align="center" width="10%">数量</td>
  </tr>
  <!--{foreach $goods_info $v}-->
  <tr>
  	<td valign="top" style="padding:10px 5px 10px 10px; line-height:22px;"><img src="<!--{if !empty($v['goods_image'])}--><!--{$v['goods_image']}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" style="width:80px;height:80px;border:1px solid #dddddd; float:left; margin-right:8px;" /><!--{$v['goods_name']}--><br><br><br><font color="#999">说明：<!--{$v['comment']}--></font></td>
  	<td width="10%" align="center"><!--{$v['spec_name']}--></td>
  	<td width="10%" align="center"><!--{$v['spec_mishu']}--></td>
  	<td width="10%" align="center"><!--{$v['goods_price']}--></td>
  	<td width="10%" align="center"><!--{$v['goods_num']}--></td>
  </tr>
  <!--{/foreach}-->
  </table>
  <div style="text-align:right; padding:15px 20px 0 0;">实付款：<font style=" font-size:20px; font-family:Arial, Helvetica, sans-serif; color:#cc0000; font-weight:bold;">￥ <!--{$order_info['goods_amount']}-->元</font></div>
  </div>
  
  
  </div>
  </div>  
  </div>
  <div class="ddlfbg"></div>  
  <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>

<!--{template 'index','footer',SITE_TEMP }-->