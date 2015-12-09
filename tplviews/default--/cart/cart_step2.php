<!--{template 'index','header_bg',SITE_TEMP }-->
<link rel="stylesheet" type="text/css" href="<!--{CSS_PATH}-->address.css"  />
<script src="<!--{JS_PATH}-->shop.js" type="text/javascript"></script>
<div class="member_banner clearfix">

</div>	


<div class="main_body"> <img src="<!--{IMG_PATH}-->body_top.png" class="font_size fix div_block" />
<div class="main_con2">

<div class="progress clearfix">
			<ul class="progress-2">
				<li class="s1"><b></b>1.我的购物车</li>
				<li class="s2"><b></b>2.填写核对订单信息</li>
				<li class="s3">3.成功提交订单</li>
			</ul>
		</div>

<div class="w m2"><a name="consigneeFocus"></a>
		<form method="post" id="order_form" name="order_form" action="index.php?c=cart&a=cart_step3">
		<input type="hidden" id="cart_code" name="cart_code" value='<!--{$cart_code}-->'/>
		<input type="hidden" id="cart_hash" name="cart_hash" value='<!--{$cart_hash}-->'/>
		<div id="checkout">
			<div class="mt">
				<h2>填写并核对订单信息</h2>
			</div>
			<div id="wizard" class="checkout-steps">
				<div id="step-1" class="step step-complete">
						<div class="step-content">
							<div id="consignee" class="sbox-wrap">
	 							<div  style="margin-top: 20px;" class="address" id="address">
									<h3>确认收货地址 
 										<span class="manage-address">
 											<a class="J_MakePoint" title="管理我的收货地址" target="_blank" href="index.php?m=member&c=address&a=lists">管理收货地址</a>
 										</span>
									</h3>
									<ul class="address-list" id="address-list">
										<!--{foreach $address_list $val}-->
     								<li id="addressid_<!--{$val['address_id']}-->" class="J_Addr J_MakePoint clearfix <!--{if $val['d_add']}-->selected<!--{/if}-->">
 											<s class="J_Marker marker"></s>
 											<span class="marker-tip">寄送至</span>
 											<div class="address-info">
 												<a class="J_Modify modify J_MakePoint" href="index.php?m=member&c=address&a=address_edit&id=<!--{$val['address_id']}-->" >修改本地址</a>
 												<input type="radio" id="addrid_<!--{$val['address_id']}-->" value="<!--{$val['address_id']}-->" onclick="javascript:setaddress(<!--{$val['address_id']}-->);" class="J_MakePoint" name="addressids">
 												<label class="user-address" for="addrid_<!--{$val['address_id']}-->"><!--{$val['area_info']}--> <!--{$val['address']}--> (<!--{$val['true_name']}--> 收) <em><!--{$val['mob_phone']}--></em></label>
 												<em style="" class="tip"><!--{if $val['d_add']}-->默认地址<!--{/if}--></em>
 											</div>
   									</li>
   									<!--{/foreach}-->
                  </ul>
									<div class="address-bar">
 										
 										<a  id="J_NewAddressBtn" style="" class="new J_MakePoint" href="index.php?m=member&c=address&a=address_add" >使用新地址</a>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
			<div id="wizard" class="checkout-steps">
				<div id="step-1" class="step step-complete">
						<div class="step-content">
							<div id="consignee" class="sbox-wrap">
	 							<div  style="margin-top: 20px;" class="address" id="address">
									<h3>发票信息 
 										<span class="manage-address">
 											<a class="J_MakePoint" title="修改开票信息" target="_blank" href="index.php?m=member&c=bill&a=kaipiao">修改</a>
 										</span>
									</h3>
									<ul class="address-list" id="address-list">
										<li class="J_Addr J_MakePoint clearfix"><div class="address-info"><input type="radio" name="kaipiaotype" id="kaipiaotype2" value="2" class="J_MakePoint" onclick="showcompany(0);">&nbsp;<label class="user-address" for="kaipiaotype2">增值税发票</label></div></li>
										<li class="J_Addr J_MakePoint clearfix"><div class="address-info"><input type="radio" name="kaipiaotype" id="kaipiaotype1" value="1" class="J_MakePoint" onclick="showcompany(1);">&nbsp;<label class="user-address" for="kaipiaotype1">普通发票</label><span id="kptt_span" style="display:none">&nbsp;&nbsp;&nbsp;&nbsp;发票抬头:<input type="text" name="kaipiaott" id="kaipiaott" style="width:200px;margin-left:180px;"></span></div></li>
                  </ul>
								
								</div>
							</div>
						</div>
				</div>
			</div>
				<div id="step-4" class="step step-complete">
					<div class="step-title"><strong>&nbsp;&nbsp;&nbsp;商品清单</strong></div>
					<div class="step-content">
						<div id="part-order" class="sbox-wrap">
							
							<div class="sbox">
								<div id="order-cart">
									<div class="order-review">
										   <!--商品清单展示-->
										<span id="span-skulist">
    									<table class="review-thead">
												<tbody>
													<tr>
														<td class="fore1">商品</td>
														<td class="fore2">行业价</td>
														<td class="fore3">会员价</td>
														<td class="fore4">数量</td>
													</tr>
												</tbody>
											</table>
											<!--**********商品清单内容列表开始************-->
											<div class="review-body">
												<!--{foreach $cart $val}-->
												<div class="review-tbody">
													<table class="order-table">
														<tbody>
														  <tr>
														    <td class="fore1">
															   <div class="p-goods">
																  <div class="p-img"><a href="" target='_blank'><img src="<!--{if empty($val['goods_images'])}--><!--{IMG_PATH}-->nopic.jpg<!--{else}--><!--{$val['goods_images']}--><!--{/if}-->" alt="<!--{$val['goods_name']}-->" width="50" height="50"></a></div>
																	<div class="p-detail">
																		<div class="p-name"><a href="" target='_blank'><!--{$val['goods_name']}--></a><br><font color="#999">吨位：<!--{$val['spec_info']}-->&nbsp;&nbsp;米数：<!--{$val['spec_mishu']}--></font></div>
																		<div class="p-more"><input type="text" name="remark_<!--{$val['cart_id']}-->" placeholder="选填：对本次交易的说明" value="" style="width:250px;color:#aaa;"></div>
																	</div>
																 </div>
													 			 </td>
															  <td class="p-price"><strong>¥ <!--{$val['goods_store_price']}--></strong></td>
															  <td class="p-price"><strong>¥ <!--{$val['goods_jxs_price']}--></strong></td>
															  <td class="fore2"><!--{$val['goods_num']}--></td>
														  </tr>
														</tbody>
											    </table>
												</div>
												<!--{/foreach}-->
											</div>
                 			<div class="order-summary">
												<div class="statistic fr">
													<div class="list"><span><em id="span-skuNum"><!--{$total_num}--></em> 件商品，总商品金额：</span><em class="price" id="warePriceId" >¥<!--{$total_price}--></em></div>
                                                <!--<div class="list"><span>会员价：</span><em class="price" id="cachBackId" v="0.00"> -￥0.00</em></div>-->
                                                <div class="list"><span>会员价：</span><em id="sumPayPriceId" class="price"> ¥<!--{$total_jxsprice}--></em></div>			
										  	</div>
									 	 	</div><!--@end div.order-summary-->
										</div>
									</div><!--@end div#order-cart-->
								</div>
							</div><!--@end div#part-order-->
							<div id="checkout-floatbar" class="checkout-buttons group">
								<div class="inner">
									<style type="text/css">.checkout-buttons .checkout-submit{background-color:#e00;position:relative;line-height:36px;overflow:hidden;color:#fff;font-weight:bold;font-size:16px;}.checkout-buttons .checkout-submit b{position:absolute;left:0;top:0;width:135px;height:36px;background:url(<!--{IMG_PATH}-->btn-submit.jpg) no-repeat;cursor:pointer;overflow:hidden;}.checkout-buttons .checkout-submit:hover{background-color:#EF494D;}.checkout-buttons  .checkout-submit:hover b{background-position:0 -36px;}.checkout-buttons .checkout-submit-disabled{background-color:#ccc;position:relative;line-height:36px;font-weight:bold;font-size:16px;cursor:not-allowed;}.checkout-buttons .checkout-submit-disabled b{position:absolute;left:0;top:0;width:135px;height:36px;background:url(http://misc.360buyimg.com/purchase/trade/skin/i/btn-disabled.png) no-repeat;cursor:not-allowed;}</style>
                                <!--input type="submit"  class="checkout-submit" value="" id="order-submit" onclick="javascript:submit_Order();"/
                                <input type="submit" class="checkout-submit"  id="order-submit" >-->
                                <button type="submit" class="checkout-submit"  id="order-submit" onclick="return checkorderform();">提交订单<b></b> </button>
									<span class="total">应付总额：<strong id="payPriceId">¥<!--{$total_jxsprice}--></strong>元</span>
								</div>
							</div>
							
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	 <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  
</div>  
<script language="javascript">
function checkorderform()
{	
	var tag = 0;
	var addressids = document.getElementsByName("addressids");
	for(var i=0;i < addressids.length;i++){
  	if(addressids[i].checked == true){
   		tag = 1;
  	}
 	}
 	
 	if(tag == 0){
 		alert("请选择收获地址！");
 		return false;
 	} else {
 		document.order_form.submit();
 	}
}

function showcompany(tag){
	if(tag == 0){
		document.getElementById("kptt_span").style.display = "none";
	} else {
		document.getElementById("kptt_span").style.display = "inline";
	}
}
</script>


<!--{template 'index','footer',SITE_TEMP }-->
