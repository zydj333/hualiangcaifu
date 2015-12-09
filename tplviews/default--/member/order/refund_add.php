<!--{template 'index','header_user',SITE_TEMP }-->

<script type="text/javascript">
myLoad(108);
</script>
<div class="member_banner clearfix">

</div>	
<script language="javascript">
var parttenmob = /^1[3,5,8]\d{9}$/;
var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

function checkform()
{
	var pre_num = document.getElementById("pre_num").value;
	var now_num = document.getElementById("changequantity").value;
	var buyer_message = document.getElementById("buyer_message").value;
	var msg = "";
	
 	
	if(now_num > pre_num){
		alert("退货数量不能大于订单产品总数!");
		return false;
	}
	if(buyer_message.length == 0){
		alert("请提交退货说明!");
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

function numchange2(){
	var goodsnum = parseInt($("#changequantity").val());
	if(goodsnum <= 1 || goodsnum == null || goodsnum=="" || isNaN(goodsnum)){
		goodsnum = 1;
	}
	$("#changequantity").val(goodsnum);
}
</script> 


<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">申请退货</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=customer&a=login" class="grey">客户专区</a> > <span class="font_red">申请退货</span></div></div>
		  
  <div class="main_con clearfix">
  <div class="pencet clearfix">
  	<!--{template 'index','user_left',SITE_TEMP }-->
  <div class="pencetr">
    <div class="snpclines clearfix">
	<div style="margin-top:5px;">
  <table width="96%" cellpadding="0" cellspacing="0" border="1" bordercolor="#e6e6e6"  class="reftab">
		<tr>
			<th height="31">商品名称</th>
			<th>数量</th>
			<th>总价</th>
		</tr>
		<tr>
			<td width="70%" style="padding:10px 5px 10px 10px; line-height:22px;"><img src="<!--{if !empty($goods_info['goods_image'])}--><!--{$goods_info['goods_image']}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" style="width:80px;height:80px;border:1px solid #dddddd; float:left; margin-right:8px;" /><a href="index.php?c=products&a=detail&id=<!--{$goods_info['goods_id']}-->" target="_blank" class="wblue"><!--{$goods_info['goods_name']}--></a><br><br><font color="#999">吨位：<!--{$goods_info['spec_name']}--><br>米数：<!--{$goods_info['spec_mishu']}--></font></td>
			<td align="center" width="15%" style="line-height:24px;"><!--{$goods_info['goods_num']}--></td>
			<td width="15%" align="center"><!--{$goods_info['goods_price']}--></td>
		</tr>
	</table>

	<div style="border:1px solid #dddddd; margin-top:15px;width:746px;">
		<form method="post" action="index.php?m=member&c=order&a=refund" name="formrefund" onsubmit="return checkform();" >
  	<input type="hidden" name="dosubmit" value="ok">
  	<input type="hidden" name="order_id" value="<!--{$order_info['order_id']}-->">
  	<input type="hidden" name="goods_id" value="<!--{$goods_info['goods_id']}-->">
  	<input type="hidden" name="rec_id" value="<!--{$goods_info['rec_id']}-->">
  	<input type="hidden" name="pre_num" id="pre_num" value="<!--{$goods_info['goods_num']}-->">
  	<table width="95%" cellpadding="0" cellspacing="0" border="0" align="center">
  	<tr><td height="15"></td></tr>
  	<tr>
  		<td height="15" align="right">提交数量：</td>
  		<td>
        <input class="quantity-text" value="1" id="changequantity" name="changequantity" type="text" onblur="javascript:numchange2();" style="width:50px;">
  		</td>
  	</tr>
  <tr><td height="15"></td></tr>
  <tr><td width="90" align="right">退货说明：</td><td><textarea name="buyer_message" id="buyer_message" style="width:500px; height:70px;"></textarea><br /><font style="font-size:12px; color:#666666; line-height:24px;">请您如实填写申请原因及商品情况，字数在500字内。</font></td></tr>
  <tr><td height="15"></td></tr>
  <tr><td></td><td align="left"><input class="tjsmzc" type="submit" value=""></td></tr>
  <tr><td height="15"></td></tr>
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

<!--{template 'index','footer',SITE_TEMP }-->