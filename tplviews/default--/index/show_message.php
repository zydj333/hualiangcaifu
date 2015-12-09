<!--{template 'index','header_bg',SITE_TEMP }-->
<script type="text/javascript">
	<!--{if !empty($returnjs)}-->
		<!--{$returnjs}-->
	<!--{else}-->
		window.setTimeout("javascript:window.top.location.href='<!--{if !empty($url_forward)}--><!--{$url_forward}--><!--{else}-->/<!--{/if}-->'", <!--{if !empty($ms)}--><!--{$ms}--><!--{else}-->5000<!--{/if}-->);
	<!--{/if}-->
</script>
<div class="index_banner clearfix">
            <div class="index_banner2">
                <ul>                    
                    <li><img src="<!--{IMG_PATH}-->snbanner7k.jpg" /></li>
                </ul>
            </div>
</div>	


<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">客户专区</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=customer&a=login" class="grey">客户专区</a> > <span class="font_red">信息提示</span></div></div>
		  
  <div class="main_con clearfix">
  	<!--{if $msgtype == 'success'}-->
    <div class="zcsucceed">
			<h3><!--{if isset($msg)}--><!--{$msg}--><!--{/if}--></h3>
			<div class="zcgm"><font color="red"><!--{php echo $ms/1000;}-->秒后页面自动跳转</font></div>
		</div> 
		<!--{else}-->
		<div class="zcerror">
			<h3><!--{if isset($msg)}--><!--{$msg}--><!--{/if}--></h3>
			<div class="zcgm"><font color="red"><!--{(php echo $ms/1000;}-->秒后页面自动跳转</font></div>
		</div> 
		<!--{/if}-->
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->