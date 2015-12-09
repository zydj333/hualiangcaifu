<!--{template 'index','header',SITE_TEMP }-->

<!--header end-->
<!--banner-->

<link href="<!--{CSS_PATH}-->user_620.css" type="text/css" rel="stylesheet" />   
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
            <h5 class="welcome_user">您好，<?php echo $this->session->userdata['member_truename']; ?>，欢迎登录华良财富云系统</h5>
            <div class="user_licais_xx" style="width:120px;  ">
                 <div style=" background:#009966;color:#fff;padding:10px; line-height:40px;height:130px;">
                           
                           <strong >积分：</strong><br /><span style="font-size:30px; color:#fff;">0</span>分
                    </div>   
                  
            </div>


            <div class="user_licais_xx" style="width:260px;">
               <div style=" background:#ff6a00;color:#fff;padding:10px; line-height:40px;height:130px;">
                 
                            <strong >我累计赚取佣金（元）：</strong><br /> 
                        
                            <span id="Label1" style="font-size:30px; color:#fff;">￥0.00</span>
                       
             
                </div>
            </div>


            <div class="user_mag_mp">
                <span>
                    <img src="<!--{IMG_PATH}-->fuwujingli.jpg" style="width:120px; height:120px;"  />
                </span>
                <div>
                    <ul>
                        <li>服务经理：张有钢</li>
                        <li>手机号码：13989484358</li>
                        <li>QQ号码：356483183</li>
                    </ul>
                    <a href="index.php?m=member&c=user&a=myadvisor">了解更多</a>
                </div>
            </div>
           
        </div>
        <!--border layout-->
        <div class="user_rt_layout">
            <h3 style="float:left">
                <img src="<!--{IMG_PATH}-->user_lcs_pic03.png"  />
                <strong>我的最新预约</strong>
            </h3>
			
			<h3 style="float:right;width:60px;"><a href="index.php?m=member&c=reserve&a=lists">更多</a>+</h3>	
			
            <table class="user_rt_table_01" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="15%">姓名</th>
                    <th class="auto-style1">手机号码</th>
                    <th width="15%">预定金额</th>
                    <th width="25%">产品名称</th>
                    <th width="15%">时间</th>
                    <th width="12%">状态</th>
                </tr>
								<!--{foreach $reserve_list $v}-->
								<tr>
									<td><!--{$v['name']}--></td>	
									<td><!--{$v['phone']}--></td>
									<td><!--{$v['money']}--></td>	
									<td><!--{$v['product_name']}--></td>
									<td><!--{date('Y-m-d', $v['post_time'])}--></td>
									<td><!--{$v['order_state_name']}--></td>
								</tr>
								<!--{/foreach}-->
                
            </table>

        </div>
         <!--border layout-->
        <div class="user_rt_layout">
            <h3 style="float:left">
                <img src="<!--{IMG_PATH}-->user_lcs_pic04.png" />
                <strong>我的最新报单列表</strong>
            </h3>
				<h3 style="float:right;width:60px;"><a href="index.php?m=member&c=order&a=lists">更多</a>+</h3>	
			
             <table  cellpadding="0" cellspacing="0" class="user_rt_table_01">
                <tr>
                    <th width="8%">客户</th>
                    <th width="9%">成交金额</th>
                    <th width="25%">产品名称</th>
                    <th width="8%">打款日</th>
                    <th width="14%">成立日</th>
                    <th width="8%">成交价</th>
                    <th width="7%">状态</th>
                    <th width="9%">查看详细</th>
                </tr>
								<!--{foreach $order_list $v}-->
                <tr>
										<td><!--{$v['name']}--></td>	
										<td><!--{if $v['real_money']}--><!--{$v['real_money']}--><!--{/if}--></td>
										<td><!--{$v['product_name']}--></td>	
										<td><!--{$v['dk_date']}--></td>
										<td><!--{$v['real_date']}--></td>	
										<td><!--{$v['real_money']}--></td>
										<td><!--{$v['order_state_name'])}--></td>	
										<td>查看详细</td>
								</tr>
                <!--{/foreach}-->
                
          </table>

        &nbsp;</div>
        
    </div>
    
    
</div>


 <script>
     //注意：下面的代码是放在test.html调用
     $(function () {
         
        /* $(window.parent.document).find("#main").load(function () {
             var main = $(window.parent.document).find("#main");
             var thisheight = $(document).height() + 30;
		 
             main.height(thisheight);
         });*/
     })
 </script>
  
   
<!--云系统结束-->
<!--{template 'index','footer',SITE_TEMP }-->