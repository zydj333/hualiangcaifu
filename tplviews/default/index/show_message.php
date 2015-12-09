<!--{template 'index','header',SITE_TEMP }-->
<script type="text/javascript">
	<!--{if !empty($returnjs)}-->
		<!--{$returnjs}-->
	<!--{else}-->
		window.setTimeout("javascript:window.top.location.href='<!--{if !empty($url_forward)}--><!--{$url_forward}--><!--{else}-->/<!--{/if}-->'", <!--{if !empty($ms)}--><!--{$ms}--><!--{else}-->5000<!--{/if}-->);
	<!--{/if}-->
</script>

<div class="main_body">

  <div class="main_con clearfix">
  	<!--{if $msgtype == 'success'}-->
    <div class="zcsucceed">
			<h3><!--{if isset($msg)}--><!--{$msg}--><!--{/if}--></h3>
			<div class="zcgm"><font color="red">3秒后页面自动跳转</font></div>
		</div> 
		<!--{else}-->
		<div class="zcerror">
			<h3><!--{if isset($msg)}--><!--{$msg}--><!--{/if}--></h3>
			<div class="zcgm"><font color="red">3秒后页面自动跳转</font></div>
		</div> 
		<!--{/if}-->
    <div class="borth25"></div>
  </div>
</div>




<!--{template 'index','footer',SITE_TEMP }-->