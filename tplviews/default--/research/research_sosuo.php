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

<script type="text/javascript" src="<!--{JS_PATH}-->jquery.fn.TabBox.js"></script>
<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">搜索信息</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=news&a=lists&cid=13" class="grey">新闻中心</a> > <span class="font_red">搜索信息</span></div></div>
		  
  <div class="main_con clearfix">
    <div class="main_con_left"> <img src="<!--{IMG_PATH}-->left_img.png" class="font_size fix div_block" /> <img src="<!--{IMG_PATH}-->news_img.jpg" class="font_size fix div_block" />
      <ul class="left_menu">
  			<li class="current"><a href="index.php?c=research&a=sosuo&keywords=<!--{$keywords}-->">搜索信息</a></li>
			</ul>
      <img src="<!--{IMG_PATH}-->left_img_bottom.png" class="font_size fix div_block" />
      <img src="<!--{IMG_PATH}-->cont.jpg" border="0" class="fix contd_img" />
      <img src="<!--{IMG_PATH}-->weixin.jpg" border="0" class="fix contd_img" />
    </div>
    <div class="main_con_right">
	<div class="lxfsbot"><a href="index.php?c=introduce&a=contactus"><img src="<!--{IMG_PATH}-->confsbt.png" border="0" /></a></div>
      <div class="about_con"> 
	  <div class="proInfok">
				<ul class="Tab2">
					<li class="focus" onclick="fnTabBoxSlide(this,2,5);">相关新闻</li>
					<li onclick="fnTabBoxSlide(this,2,7);">相关产品</li>
				</ul>
				<div class="Box2">
					<div id="TabShow5" class="TabHide2">
						<div class="serch_con">
	   					<ul>
	   						<!--{foreach $search_news $v}-->
	   						<li><a href="index.php?c=news&a=detail&id=<!--{$v['article_id']}-->"><!--{$v['article_title']}--></a></li>
	    					<!--{/foreach}-->
	   					</ul> 
						</div>
       			<div class="page pagges" ><!--{$search_news_page}--></div> 
					</div>					
				  <div id="TabShow7" class="TabHide2" style="display:none;">
          	<div class="serch_con">
	   					<ul>
	   						<!--{foreach $search_products $v}-->
	   						<li><a href="index.php?c=products&a=detail&id=<!--{$v['goods_id']}-->"><!--{$v['goods_name']}--></a></li>
								<!--{/foreach}-->
	   					</ul> 
						</div>
       <!--{$search_products_page}-->
			   </div>					
				</div>
			</div>

      </div>
    </div>
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>


<!--{template 'index','footer',SITE_TEMP }-->