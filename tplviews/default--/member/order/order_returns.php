<!--{template 'index','header_user',SITE_TEMP }-->

<script type="text/javascript">
myLoad(108);
</script>
<div class="member_banner clearfix">

</div>


<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">退货记录</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">退货记录</span></div></div>
		  
  <div class="main_con clearfix">
  <div class="pencet clearfix">
  <!--{template 'index','user_left',SITE_TEMP }-->
  
  <div class="pencetr">
    <div class="snpclines clearfix">
	<div><input name="a" value="" type="text" placeholder="请输入退货编号或订单编号搜索" class="ordertx"/><input name="b" type="button"  value="订单搜索" class="orderbt" /></div>
	<div style="margin-top:15px;">
  <table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#e6e6e6" align="center" class="reftab">
	<tr><th height="31">退货编号</th><th>订单编号</th><th>商品名称</th><th>申请时间</th><th>状态</th><th>操作</th></tr>
	<!--{foreach $return_info['list'] $v}-->
	<tr>
		<td align="center" width="15%" class="wblue"><!--{$v['return_sn']}--></td>
		<td align="center" width="15%" class="wblue"><!--{$v['order_sn']}--></td>
		<td width="40%" style="padding:10px 5px 10px 10px; line-height:22px;"><img src="<!--{if !empty($v['goods_image'])}--><!--{$v['goods_image']}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" style="width:80px;height:80px;border:1px solid #dddddd; float:left; margin-right:8px;" /><!--{$v['goods_name']}--></td>
		<td align="center" width="10%" style="line-height:24px;"><!--{date('Y-m-d H:m:s', $v['add_time'])}--></td>
		<td align="center" width="10%" style="line-height:24px;"><font color="red"><!--{$v['state_name']}--></font></td>
		<td align="center" width="10%" style="line-height:24px;"><a href="index.php?m=member&c=order&a=viewrefund&rid=<!--{$v['returns_id']}-->" class="wblue">查看</a><br>
			<!--{if $v['re_state']==1}--><a href="index.php?m=member&c=order&a=canrefund&rid=<!--{$v['returns_id']}-->" class="wblue">取消</a><!--{/if}-->
		</td>
	</tr>
	<!--{/foreach}-->
	</table>
	<div class="mypage page"><!--{$return_info['page']}--></div>
	</div>
	
	</div>
  </div>  
  </div>
  <div class="ddlfbg"></div>  
  <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>

<!--{template 'index','footer',SITE_TEMP }-->