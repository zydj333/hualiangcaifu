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
  	<form method="post" action="index.php?m=member&c=order&a=lists" name="formSearch">
    <input type="hidden" name="dosubmit" value="ok">
 		<div class="snpclines clearfix">
  		<div><input name="search_name" value="" placeholder="输入订单号进行搜索" type="text" class="ordertx"/><input name="searchbtn" type="submit" value="订单搜索" class="orderbt" /></div>
  		<div style="margin-top:27px;">
  			<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
  				<tr bgcolor="#f5f5f5"><td height="40" align="center" width="40%" class="odbord1">商品</td><td align="center" width="10%" class="odbord2">单价(元)</td><td align="center" width="10%" class="odbord2">数量</td><td align="center" width="10%" class="odbord2">商品操作</td><td align="center" width="10%" class="odbord2">实付款(元)</td><td align="center" width="10%" class="odbord2">交易状态</td></tr>
  				<!--{foreach $list $v}-->
  				<tr><td height="8"></td></tr>
  				<tr>
  					<td colspan="7" valign="top">
  						<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#f0dca7" align="center">
  							<tr bgcolor="#faf7d8"><td colspan="7" height="45"> <b style="margin-left:10px;"><!--{date('Y-m-d', $v['add_time'])}--></b> 订单号：<!--{$v['order_sn']}--></td></tr>
  							<!--{php $i=0;}-->
  							<!--{foreach $v['goodsdata'] $vv}-->
  							<tr>
  								<td valign="top" width="40%" style="padding:10px 5px 10px 10px; line-height:22px;"><img src="<!--{if !empty($vv['goods_image'])}--><!--{$vv['goods_image']}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" style="width:80px;height:80px;border:1px solid #dddddd; float:left; margin-right:8px;" /><!--{$vv['goods_name']}--><br><font color="#999">吨位：<!--{$vv['goods_tons']}--><br>米数：<!--{$vv['spec_mishu']}--></font></td>
  								<td width="10%" align="center"><!--{$vv['goods_price']}--></td>
  								<td width="10%" align="center"><!--{$vv['goods_num']}--></td>
  								<td width="10%" align="center">
  									<!--{if $v['order_state'] != '10' && $v['order_state'] != '50'}-->
  									<!--{if $v['re_state']!=1}-->
  									<a href="index.php?m=member&c=order&a=refund&oid=<!--{$v['order_id']}-->&gid=<!--{$vv['goods_id']}-->&id=<!--{$vv['rec_id']}-->">申请退货</a></br>
  									<!--{/if}-->
  									<!--{/if}-->
  									<a href="index.php?m=member&c=order&a=order_returns&oid=<!--{$v['order_id']}-->&gid=<!--{$vv['goods_id']}-->">查看退货</a></br>
  									<!--{if $v['order_state'] != '10' && $v['order_state'] != '50'}-->
  									<a href="index.php?m=member&c=order&a=fix&oid=<!--{$v['order_id']}-->&gid=<!--{$vv['goods_id']}-->&id=<!--{$vv['rec_id']}-->">申请返修</a></br>
  									<!--{/if}-->
  									<a href="index.php?m=member&c=order&a=order_fix&oid=<!--{$v['order_id']}-->&gid=<!--{$vv['goods_id']}-->">查看返修</a></br>
  								</td>
  								<!--{if $i == 0}-->
  								<td width="10%" align="center" rowspan="<!--{$v['goodsnumb']}-->"><!--{$v['goods_amount']}--></td>
  								<td width="10%" align="center" rowspan="<!--{$v['goodsnumb']}-->">
  									<font color="red"><!--{$v['order_state_name']}--></font><br><br>
  									<a href="index.php?m=member&c=order&a=info&id=<!--{$v['order_id']}-->">订单详情</a><br><br>
  								</td>
  								<!--{/if}-->
  							</tr>
  							<!--{php $i++;}-->
  							<!--{/foreach}-->
  						</table>
  					</td>
  				</tr>
  				<!--{/foreach}-->
  				<tr><td height="8"></td></tr> 
 					<tr>
 						<td>
							<div class="mypage page"><!--{$page}--></div>
 						</td>
 					</tr>
  			</table>
  		</div>
  	</div>
  	</form>
  </div>  
  </div>
  <div class="ddlfbg"></div>  
  <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>

<!--{template 'index','footer',SITE_TEMP }-->