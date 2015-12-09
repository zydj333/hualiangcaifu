<!--{template 'index','header',SITE_TEMP }--> 

<link href="<!--{CSS_PATH}-->css.css" rel="stylesheet" type="text/css" /> 
<div class="user_620">
    <!--lt-->
    <div class="user_lt">
        <div class="user_lt_top">
             <a href="index.php?m=member&c=user&a=udefault"    target="main" class="list">
             <!--{if $this->session->userdata['member_headico']}-->
             	<img src="/<?php echo $this->session->userdata['member_headico']; ?>"  style="width:150px; height:150px;" />
             	<!--{else}-->
             	<img src="<!--{IMG_PATH}-->head.jpg"  style="width:150px; height:150px;" />
             	<!--{/if}-->
             </a>
             <h4><?php echo $this->session->userdata['member_truename']; ?></h4>
             <h4><?php echo $this->session->userdata['member_username']; ?></h4>
        </div>
        <!--{template 'index','user_left',SITE_TEMP }-->
    </div>
    <!--rt-->
    <div class="user_rt">
        <!--border layout-->
        <div class="user_rt_layout">
            <h3>
                <img src="<!--{IMG_PATH}-->user_lcs_pic03.png"  />
                <strong>积分兑换订单</strong>
            </h3>
            <table  cellpadding="0" cellspacing="0" class="user_rt_table_01">
                <tr>
                    <th width="10%">订单号</th>
                    <th width="10%">姓名</th>
                    <th width="10%">手机号码</th>
                    <th width="15%">产品名称</th>
                    <th width="15%">地址</th>
                    <th width="15%">备注</th>
                    <th width="10%">时间</th>
                    <th width="12%">状态</th>
                </tr>
								<!--{foreach $list $v}-->
								<tr>
									<td><!--{$v['order_sn']}--></td>	
									<td><!--{$v['name']}--></td>
									<td><!--{$v['phone']}--></td>	
									<td><!--{$v['product_name']}--></td>
									<td><!--{$v['address']}--></td>	
									<td><!--{$v['remark']}--></td>
									<td><!--{date('Y-m-d', $v['post_time'])}--></td>	
									<td><!--{$v['order_state_name']}--></td>
								</tr>
								<!--{/foreach}-->
                
          </table>

        </div>
        
    </div>
    
    
</div>
 
   
<!--云系统结束-->
<!--{template 'index','footer',SITE_TEMP }-->