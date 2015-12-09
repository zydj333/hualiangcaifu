<!--{template 'index','header_bg',SITE_TEMP }-->
<script type="text/javascript">
myLoad(101);
</script>
<link href="<!--{CSS_PATH}-->jquery.lightbox-0.5.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<!--{JS_PATH}-->jquery.lightbox-0.5.js"></script>
<script type="text/javascript">
$(function() {
	$("#honiilist a").lightBox();
});
</script>
<div class="index_banner clearfix">
            <div class="index_banner2">
                <ul>                    
                   <!--{cc:a_adv action="get_promotion_single" apid="11" cache="3600"}-->
									<!--{foreach $data $val}-->
									 <!--{if $val['adv_content']['adv_pic']}-->                   
                    <li><img src="<!--{BASE_URL}--><!--{$val['adv_content']['adv_pic']}-->" /></li>
                    <!--{/if}-->
                  <!--{/foreach}-->
									<!--{/cc}-->
                </ul>
            </div>
</div>	


<div class="main_body clearfix">
<div class="mntopbg"><span class="info_navzi2"><!--{$code_title}--></span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=introduce&a=aboutus" class="grey">走进双鸟</a> > <span class="font_red"><!--{$code_title}--></span></div></div>
		  
  <div class="main_con clearfix">
    <div class="main_con_left"> <img src="<!--{IMG_PATH}-->left_img.png" class="font_size fix div_block" /> <img src="<!--{IMG_PATH}-->news_img2.jpg" class="font_size fix div_block" />
      <ul class="left_menu">
      	<li ><a href="index.php?c=introduce&a=industry">集团产业</a></li>
  			<li <!--{if $code == 'aboutus'}-->class="current"<!--{/if}-->><a href="index.php?c=introduce&a=aboutus">企业介绍</a></li>
  			<li <!--{if $code == 'chairman'}-->class="current"<!--{/if}-->><a href="index.php?c=introduce&a=chairman">董事长致辞</a></li>
  			<li <!--{if $code == 'history'}-->class="current"<!--{/if}-->><a href="index.php?c=introduce&a=history">发展历程</a></li>
  			<li <!--{if $code == 'structure'}-->class="current"<!--{/if}-->><a href="index.php?c=introduce&a=structure">组织结构</a></li>
  			<!--{cc:a_com action="getgraphiccatelist" cache="3600"}-->
        <!--{foreach $data $v}-->
        <li <!--{if $code == $v['lc_id']}-->class="current"<!--{/if}-->><a href="index.php?c=graphic&a=lists&cid=<!--{$v['lc_id']}-->"><!--{$v['lc_name']}--></a></li>
        <!--{/foreach}-->
       	<!--{/cc}-->
			</ul>
      <img src="<!--{IMG_PATH}-->left_img_bottom.png" class="font_size fix div_block" />
      <img src="<!--{IMG_PATH}-->cont.jpg" border="0" class="fix contd_img" />
      <img src="<!--{IMG_PATH}-->weixin.jpg" border="0" class="fix contd_img" />
    </div>
    <div class="main_con_right">
	<div class="lxfsbot"><a href="index.php?c=introduce&a=contactus"><img src="<!--{IMG_PATH}-->confsbt.png" border="0" /></a></div>
      <div class="about_con">
       <div class="snhonor clearfix list">
	   		<ul class="clear" id="honiilist">
	   			<!--{foreach $list $v}-->
	      	<li >
      			<a href="<!--{$v['pic_thumb']}-->" title="<!--{$v['pic_title']}-->">
      			<img src="<!--{$v['pic_thumb']}-->" width="140" height="98" alt="" title="" />
      			<h2 class="honwd"><!--{mb_substr($v['pic_title'],0,10)}--></h2>
      			</a>
     			</li>
	 	      <!--{/foreach}-->     
	   		</ul>
	   	</div>
	  <!--{$page}-->    	    
      </div>
    </div>
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->