<!--{template 'index','header_bg',SITE_TEMP }-->
<script type="text/javascript">
myLoad(105);
</script>
<div class="index_banner clearfix">
            <div class="index_banner2">
                <ul>                    
                    <!--{cc:a_adv action="get_promotion_single" apid="15" cache="3600"}-->
									<!--{foreach $data $val}-->
									 <!--{if $val['adv_content']['adv_pic']}-->                   
                    <li><img src="<!--{BASE_URL}--><!--{$val['adv_content']['adv_pic']}-->" /></li>
                    <!--{/if}-->
                  <!--{/foreach}-->
									<!--{/cc}-->
                </ul>
            </div>
</div>	


<div class="main_body">
<div class="mntopbg"><span class="info_navzi2"><!--{$cate_info['ac_name']}--></span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=research&a=lists&cid=16" class="grey">研修/培训</a> > <span class="font_red"><!--{$cate_info['ac_name']}--></span></div></div>
		  
  <div class="main_con clearfix">
    <div class="main_con_left"> <img src="<!--{IMG_PATH}-->left_img.png" class="font_size fix div_block" /> <img src="<!--{IMG_PATH}-->news_img5.jpg" class="font_size fix div_block" />
      <ul class="left_menu">
      	<!--{cc:a_com action="getresearchcatelist" cache="3600"}-->
        <!--{foreach $data $v}-->
        <li <!--{if $article_info['ac_id'] == $v['ac_id']}-->class="current"<!--{/if}-->><a href="index.php?c=research&a=lists&cid=<!--{$v['ac_id']}-->"><!--{$v['ac_name']}--></a></li>
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
       <div class="jlbnew clearfix">
<div class="newdtbg"><h3><!--{$article_info['article_title']}--></h3></div>
<div class="newdtime"></div>
<div class="newdcon">
<!--{$article_info['article_content']}-->
</div>
<!--
<div class="newdtgj clearfix">
<div class="newdtgjl"><font class="wred">上一篇：</font>电动葫芦近年被用于浮顶罐的施工逐渐频繁</div>
<div class="newdtgjr"><font class="wred">下一篇：</font>防止电动葫芦钢丝绳生锈的方法</div>
</div>-->
</div> 
      </div>
    </div>
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->