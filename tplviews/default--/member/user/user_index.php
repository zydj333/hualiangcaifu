
<!--{template 'index','header_user',SITE_TEMP }-->

<script type="text/javascript">
myLoad(108);
</script>
<div class="member_banner clearfix">

</div>	
<script type="text/javascript" src="<!--{JS_PATH}-->orderbook.js"></script>
<script type="text/javascript" src="<!--{JS_PATH}-->highcharts.js"></script>
<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">客户专区</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">客户专区</span></div></div>
		  
  <div class="main_con clearfix">
  <div class="pencet clearfix">
  	<!--{template 'index','user_left',SITE_TEMP }-->
  <div class="pencetr">
  <div class="snpclines clearfix">
  <div class="pclf1"><img src="<!--{if !empty($userInfo['head_ico'])}--><!--{$userInfo['head_ico']}--><!--{else}-->statics/default/images/head_ico.gif<!--{/if}-->" width="103" height="81" /><span>您好，<font style="color:#e4393c; font-size:18px;"><b><?php echo $this->session->userdata['member_username']; ?></b></font>&nbsp;&nbsp;[<a href="index.php?c=customer&a=logout" class="purple">退出</a>]<br />欢迎登录双鸟机械官网！<br />会员等级：<!--{if !empty($groupInfo['groupname'])}--><!--{$groupInfo['groupname']}--><!--{else}-->暂无级别<!--{/if}--></span></div>
  <div class="pclf2">账户余额：<br /><font style="color:#e4393c; font-size:18px;"><b><!--{$userInfo['available_predeposit']}--></b></font> 元</div>
  <div class="pclf2">信用额度：<br /><font style="color:#e4393c; font-size:18px;"><b><!--{$userInfo['freeze_predeposit']}--></b></font> 元</div>
  </div>
  
  <div class="tfzkb">
  <div class="tfzktop">订单状况</div>
  	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr><td height="15"></td></tr>
   	<tr>
   		<td>
   			<select name="count_order_sel" id="count_order_sel" style="width:200px;">
   				<option value="dangmon">本月</option>
   				<option value="lastmon">上月</option>
   				<option value="dangyear">本年度</option>
   				<option value="lastyear">上一年</opiton>
   			</select>
   	</td>
  </tr>
   <tr><td height="20"></td></tr>
   <tr><td>订单总额：<font style="color:#e4393c; font-size:22px;"><b><span id="count_order_val"><!--{$order_sum}-->元</span></b></font></td></tr>  
</table>
  </div>
  
   <div class="tfzkb">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td align="left"></td></tr>
	<tr><td height="10"></td></tr>
	<tr><td colspan="2">
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</td></tr>
	</table>
<script>
$(function () {
        $('#container').highcharts({
            title: {
                text: '年度销售曲线表',
                x: -20 //center
            },
            subtitle: {
                text: '来源: 浙江双鸟机械',
                x: -20
            },
            xAxis: {
                categories: ['1月', '2月', '3月', '4月', '5月', '6月',
                    '7月', '8月', '9月', '10月', '11月', '12月']
            },
            yAxis: {
                title: {
                    text: '金额 (单位：元)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '元'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '2014年',
                data: [<!--{$amount_month}-->]
            }]
        });
    });
    
</script>
	</div>
  </div>  
  </div>
  <div class="ddlfbg"></div>  
  <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->