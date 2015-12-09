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
	<tr><td colspan="2" height="26" style="border-bottom:1px solid #dddddd; padding-left:15px; font-size:13px;"><b>退货信息</b></td></tr>
	<tr><td style="border-bottom:1px solid #dddddd; padding:10px 10px 10px 10px; color:#666666; line-height:22px;"><img src="<!--{IMG_PATH}-->proddpic2.jpg" style="vertical-align:middle;"/> <b>退货状态： <!--{$goods_info['state_name']}--></b></td></tr>
	<tr><td style="padding:10px 10px 10px 10px; color:#666666;">退货编号：<!--{$return_info['return_sn']}--></td></tr>
	<tr><td style="padding:10px 10px 10px 10px; color:#666666;">订单编号：<!--{$return_info['order_sn']}--></td></tr>
	
	</table>
	</td><td valign="middle" style="padding:0 0 0 20px; font-size:14px;">退货说明：<!--{$return_info['buyer_message']}--><!--{if !empty($return_info['return_message'])}--><br><br>审核意见:<!--{$return_info['return_message']}--><!--{/if}--></td></tr>
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
  <!--{if !empty( $goods_info)}-->
  <tr>
  	<td valign="top" style="padding:10px 5px 10px 10px; line-height:22px;"><img src="<!--{if !empty($goods_info['goods_image'])}--><!--{$goods_info['goods_image']}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" style="width:80px;height:80px;border:1px solid #dddddd; float:left; margin-right:8px;" /><!--{$goods_info['goods_name']}--></td>
  	<td width="10%" align="center"><!--{$goods_info['spec_name']}--></td>
  	<td width="10%" align="center"><!--{$goods_info['spec_mishu']}--></td>
  	<td width="10%" align="center"><!--{$goods_info['goods_price']}--></td>
  	<td width="10%" align="center"><!--{$return_info['return_goodsnum']}--></td>
  </tr>
  <!--{/if}-->
  </table>
  
  </div>
  
  
  </div>
  </div>  
  </div>
  <div class="ddlfbg"></div>  
  <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>

<!--{template 'index','footer',SITE_TEMP }-->