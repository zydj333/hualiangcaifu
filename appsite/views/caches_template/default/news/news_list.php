<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php include APPPATH.'views/'.template('index','header',SITE_TEMP ); ?>

<!--header end-->
<!--banner-->
<div id="banner" class="banner_help">
    
</div>
<!--banner end-->
<!--内容-->
<div class="news">
    
    <!--lt-->
    <div class="lt">
        <h2>新闻中心</h2>
        <a href="index.php?c=news&a=lists&cid=1">信托快报</a>
        <span></span>
        <a href="index.php?c=news&a=lists&cid=2">新手帮助</a>
    </div>
    <!--lt end-->
    <!--rt-->
    <div class="rt">
        <h2><?php if(!empty($cate_info)){echo $cate_info['ac_name'];}else{echo '新闻中心';} ?></h2>
        <!--新闻条目-->
        <div class="sub_main">
            <ul>
                <?php if(is_array($list)) foreach($list AS $v) { ?>
            		<li class="newslist">
									<a href="<?php if(!empty($v['article_url'])) { ?><?php echo $v['article_url'];?><?php } else { ?>index.php?c=news&a=detail&id=<?php echo $v['article_id'];?><?php } ?>"><?php echo $v['article_title'];?></a>
                  <span><?php echo date('Y/m/d', $v['article_time']);?></span>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div>
            <div class="page">
              
<!-- AspNetPager 7.4.5 Copyright:2003-2013 Webdiyer (www.webdiyer.com) -->
<!--记录总数只有一页，AspNetPager已自动隐藏，若需在只有一页数据时显示AspNetPager，请将AlwaysShow属性值设为true！-->
<!-- AspNetPager 7.4.5 Copyright:2003-2013 Webdiyer (www.webdiyer.com) -->


                </div>
        </div>
        <!--新闻条目结束-->
    </div>
    <!--rt end-->
</div>
<!--内容结束-->
<!--news end-->
<!--footer-->
 
<?php include APPPATH.'views/'.template('index','footer',SITE_TEMP ); ?>