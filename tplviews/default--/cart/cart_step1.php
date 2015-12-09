<!--{template 'index','header_bg',SITE_TEMP }-->
<script src="<!--{JS_PATH}-->shop.js" type="text/javascript"></script>
<div class="member_banner clearfix">

</div>	


<div class="main_body"> <img src="<!--{IMG_PATH}-->body_top.png" class="font_size fix div_block" />
<div class="main_con2">

<div class="progress clearfix">
		<ul class="progress-1">
			<li class="step-1"><b></b>1.我的购物车</li>
			<li class="step-2"><b></b>2.填写核对订单信息</li>
			<li class="step-3">3.成功提交订单</li>
		</ul>
	</div>

<div class="w cart">
	<div class="cart-hd group">
		<h2>我的购物车</h2>
		<span id="show2" class="fore">   </span>
	</div>
	<div id="show"><input value="1" id="isLogin" type="hidden">
<input value="1038657" id="ids" type="hidden">
<input value="1038657" id="allSkuIds" type="hidden">
<input value="1599.00" id="shoppingmoney" type="hidden">
<!-- 延保和赠品宏定义开始 -->
<!-- 延保和赠品宏定义结束 -->
 
<div class="cart-frame">
    <div class="tl"></div>
    <div class="tr"></div>
</div>
<div class="cart-inner">
    <div class="cart-thead clearfix">
        <div class="column t-checkbox form"></div>
        <div class="column t-goods">商品</div>
        <div class="column t-quantity">吨位</div>
        <div class="column t-quantity">米数</div>
        <div class="column t-price">单价</div>
        <div class="column t-quantity">数量</div>
        <div class="column t-action">操作</div>
    </div>
    <div id="product-list" class="cart-tbody">
    		<!--{if $cart}-->
				<!--{foreach $cart $v}-->
        	<div id="product_<!--{$v['goods_id']}-->" class="item">
        		<div class="item_form clearfix">
            	<div class="cell p-checkbox"></div>
            	<div class="cell p-goods">
                <div class="p-img"><a href="index.php?c=products&a=detail&id=<!--{$v['goods_id']}-->" target="_blank"><img  src="<!--{if empty($v['goods_images'])}--><!--{IMG_PATH}-->nopic.jpg<!--{else}--><!--{$v['goods_images']}--><!--{/if}-->" alt="<!--{$v['goods_name']}-->" width="50" height="50"></a></div>    

                	<div class="p-name"><a href="index.php?c=products&a=detail&id=<!--{$v['goods_id']}-->" target="_blank"><!--{$v['goods_name']}--></a></div>    
                	
							</div>
            	<div class="cell p-quantity"><!--{$v['spec_info']}--></div>
            	<div class="cell p-quantity"><!--{$v['spec_mishu']}-->m</div>
            	<div class="cell p-price"><!--{$v['goods_store_price']}--></div>
            	<div class="cell p-quantity">
                <div class="quantity-form" data-bind="">
                    <a href="javascript:cartdecrease(<!--{$v['goods_id']}-->);" class="decrement" id="decrement_<!--{$v['goods_id']}-->">-</a>
                    <input class="quantity-text" value="<!--{$v['goods_num']}-->" id="changequantity_<!--{$v['goods_id']}-->" type="text" onblur="javascript:cartchange(<!--{$v['goods_id']}-->);">
                    <a href="javascript:cartincrease(<!--{$v['goods_id']}-->);" class="increment" id="increment_<!--{$v['goods_id']}-->">+</a>
                </div>
            	</div>
            	<div class="cell p-remove"><a id="remove-1038657-1"  class="cart-remove" href="javascript:cartdrop(<!--{$v['cart_id']}-->);">删除</a></div>
        		</div>
        	</div>
        <!--{/foreach}-->
				<!--{else}-->
        </div> 
  			<div class="item item_selected ">
        	<div class="nullgwc clearfix">
            购物车没有商品！
        	</div>
        </div> 
        <!--{/if}-->     
    </div>
    <div class="cart-toolbar clearfix">
    	<div class="control fl">
        <span class="delete"><b></b><a href="javascript:clearShoppingCart();"  id="remove-batch">清空购物车</a></span>
    	</div>
    	<div class="total fr">
        <!--<p><span id="totalSkuPrice"><!--{$total_price}--></span>总计：</p>
        <p><span id="totalRePrice">- ¥0.00</span>返现：</p>-->
    	</div>
    	<div class="amout fr">共<span id="selectedCount"><!--{$total_num}--></span> 件商品</div>
    </div>
    <div class="cart-total clearfix">
        <div class="control fl clearfix"></div>
        <div class="total fr"><span id="finalPrice" >¥<!--{$total_price}-->元</span>总计：</div>
    </div>
</div><!-- cart-inner结束 --> 
<div class="cart-button clearfix">
<div style="float:right; width:137px;"><a class="checkout" href="javascript:goOrderMain();" id="toSettlement">去结算<b></b></a></div>
<div style="width:137px; float:right; margin-right:10px;"> <input type="button" class="bjbotton2" value="继续购物" name="continuebtn" onclick="location.href='index.php?m=member&c=orderbook&a=bookadd'"></div>
</div>
</div>
</div>
</div>  
 <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  
 </div>


<!--{template 'index','footer',SITE_TEMP }-->