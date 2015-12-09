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
        <div class="title4">我的预约</div>
 
     
        

    <table width="780" height="187" border="0" cellpadding="0" cellspacing="0"   style="margin-left:3px;">
      <tr>
        <td valign="top" style="border:1px solid #fff;"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" style="margin-top:5px;">
          <tr>
            <td width="10%" height="26" background="<!--{IMG_PATH}-->titlebg.jpg"><div align="center"><strong> 预约日期</strong></div></td>
            <td width="22%" background="<!--{IMG_PATH}-->titlebg.jpg"><div align="center"><b>产品名称</b></div></td>
            <td background="<!--{IMG_PATH}-->titlebg.jpg" class="auto-style2"><div align="center"><div align="center"><strong>姓名</strong></div></div></td>
            <td width="14%" background="<!--{IMG_PATH}-->titlebg.jpg"><div align="center" class="STYLE3"><div align="center">电话</div></div></td>
            <td width="15%" background="<!--{IMG_PATH}-->titlebg.jpg"><div align="center" class="STYLE3"><div align="center">EMAIL </div></div></td>
            <td width="9%" background="<!--{IMG_PATH}-->titlebg.jpg"><div align="center"><b>预定金额</b></div></td>
            <td width="12%" background="<!--{IMG_PATH}-->titlebg.jpg"><div align="center"><b>备注</b></div></td>
            <td width="7%" background="<!--{IMG_PATH}-->titlebg.jpg"><div align="center"><b>状态</b></div></td>
          </tr>
          <!--{foreach $list $v}-->
					<tr>
						<td><!--{$v['reserve_date']}--></td>	
						<td><!--{$v['product_name']}--></td>
						<td><!--{$v['name']}--></td>	
						<td><!--{$v['phone']}--></td>
						<td><!--{$v['email']}--></td>	
						<td><!--{$v['money']}--></td>
						<td><!--{$v['remark'])}--></td>	
						<td><!--{$v['order_state_name']}--></td>
					</tr>
				<!--{/foreach}-->
        </table>
          <table width="100%">
            <tr>
              <td class="page">
<!-- AspNetPager 7.4.5 Copyright:2003-2013 Webdiyer (www.webdiyer.com) -->
<div id="AspNetPager1" class="page">
<div class="page" style="width:60%;float:left;">
	<!--{$page}-->
</div><div class="page" style="width:40%;float:left;">
</div>
</div>
<!-- AspNetPager 7.4.5 Copyright:2003-2013 Webdiyer (www.webdiyer.com) -->


              </td>
            </tr>
          </table></td>
      </tr>
    </table>
        
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