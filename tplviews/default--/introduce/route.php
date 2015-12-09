<!--{template 'index','header_bg',SITE_TEMP }-->
<script type="text/javascript">
myLoad(109);
</script>

<div class="index_banner clearfix">
            <div class="index_banner2">
                <ul>                    
                    <!--{cc:a_adv action="get_promotion_single" apid="17" cache="3600"}-->
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
<div class="mntopbg"><span class="info_navzi2">来司路线</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=introduce&a=contactus" class="grey">联系我们</a> > <span class="font_red">来司路线</span></div></div>
		  
  <div class="main_con clearfix">
    <div class="main_con_left"> <img src="<!--{IMG_PATH}-->left_img.png" class="font_size fix div_block" /> <img src="<!--{IMG_PATH}-->news_img7.jpg" class="font_size fix div_block" />
      <ul class="left_menu">
  			<li><a href="index.php?c=introduce&a=contactus">联系方式</a></li>
  			<li class="current"><a href="index.php?c=introduce&a=route">来司线路</a></li>
  			<li><a href="index.php?c=introduce&a=message">访客留言</a></li>
  			<li><a href="admin.php/main_index/login" target="_blank">管理登录</a></li>
			</ul>
      <img src="<!--{IMG_PATH}-->left_img_bottom.png" class="font_size fix div_block" />
      <img src="<!--{IMG_PATH}-->cont.jpg" border="0" class="fix contd_img" />
      <img src="<!--{IMG_PATH}-->weixin.jpg" border="0" class="fix contd_img" />
    </div>
    <div class="main_con_right">
      <div class="about_con">    
	   <div class="contact mapbg">
	   <div class="contbt1"><h3>来司路线</h3></div>	   
       <div class="lxmap"> 
					<!--{$article_info['doc_content']}-->
	   </div>  
	</div>   
	   	    
      </div>
    </div>
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->