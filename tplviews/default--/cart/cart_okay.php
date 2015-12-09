<!--{template 'index','header_bg',SITE_TEMP }-->

<div class="member_banner clearfix">

</div>


<div class="main_body"> <img src="<!--{IMG_PATH}-->body_top.png" class="font_size fix div_block" />
<div class="main_con2">
<div class="order_ok">
<div class="cart_t cart_t_ok"><s class="yes"></s>恭喜您，订单提交成功！</div>
<div class="order_text">
    	<table cellpadding="0" cellspacing="0" width="100%">
	    	<tbody>
	    		<tr>
	    			<th height="30">订单号</th>
	        	<th>需支付金额</th>
	        	<th>预计配送时间</th>
	        </tr>
		    	<tr>
		        	<td height="30"><!--{$order_info['order_sn']}--></td>
		          <td class="color">¥<!--{$order_info['goods_amount']}--></td>
		          <td>发货后1-2天</td>
		    	</tr>
            </tbody>
        </table>
    </div>
</div>
</div>
 <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  
 </div>


<!--{template 'index','footer',SITE_TEMP }-->