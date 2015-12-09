<!--{template 'index','header',SITE_TEMP }-->

<!--header end-->
<!--banner-->
            
<div id="banner" class="banner_news">
    
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
        <h2>信托快报</h2>
         <!--新闻详情-->
        <div class="sub_main">
           <div class="news_title">
               <h1 style="text-align:center;font-size:16px;"><!--{$article_info['article_title']}--></h1>
               <p>时间：<!--{date('Y-m-d H:m:s', $article_info['article_time'])}--> 由华良财富编辑发布 </p>
           </div>
           <div class="news_det">
               <p>
               <p><!--{$article_info['article_content']}--></p><p><br/></p>
               </p>
           
            <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone"></a><a href="#" class="bds_tsina" data-cmd="tsina"></a><a href="#" class="bds_tqq" data-cmd="tqq"></a><a href="#" class="bds_renren" data-cmd="renren"></a><a href="#" class="bds_weixin" data-cmd="weixin"></a></div>
<script>window._bd_share_config = { "common": { "bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdPic": "", "bdStyle": "0", "bdSize": "16" }, "share": {}, "image": { "viewList": ["qzone", "tsina", "tqq", "renren", "weixin"], "viewText": "分享到：", "viewSize": "16" }, "selectShare": { "bdContainerClass": null, "bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"] } }; with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
           </div> 

           <b style="color:red">财来电（www.cailaidian.cn），是一家全面以互联网及移动互联网为导向的创新型第三方财富管理机构，定位于“理财师的一站式服务平台”，于2014年在杭州创立，财来电的战略体系为“一个定位+六大策略”，定位于打造中国最广大理财师的一站式B2B服务平台，通过六大策略满足理财师六大需求，即产品丰富、风控可靠、佣金给力、运营高效、增值服务、现结之王。</b> 
        </div>
        <!--新闻详情结束-->
    </div>
    <!--rt end-->
</div>
<!--内容结束-->
<!--news end-->
<!--footer-->
 
  
<!--{template 'index','footer',SITE_TEMP }-->