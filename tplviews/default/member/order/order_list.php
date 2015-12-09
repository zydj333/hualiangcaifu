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
                <strong>我的交易<!--{if isset($type) && $type}-->-<span id="Label1"><!--{$type_name}--></span><!--{/if}--></strong>
            &nbsp;</h3>
            <table  cellpadding="0" cellspacing="0" class="user_rt_table_01">
                <tr>
                    <th width="14%">客户</th>
                    <th width="9%">成交金额</th>
                    <th width="25%">产品名称</th>
                    <th width="14%">打款日</th>
                    <th width="14%">成立日</th>
                    <th width="8%">成交价</th>
                    <th width="7%">状态</th>
                    <th width="9%">查看详细</th>
                </tr>
                <!--{foreach $list $v}-->
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

            <div id="p"><table border=0 width='100%' style='height:35px;' class='pager'><tr><td align='center' style='width:100%'><span> 首页 </span><span> 上一页 </span><span> 下一页 </span><span> 尾页 </span></td></tr></table></div>

        </div>
        
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