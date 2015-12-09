<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php include APPPATH . 'views/' . template('index', 'header', SITE_TEMP); ?>

<!--header end-->
<!--banner-->
<div id="banner" class="banner_contact">
</div>
<!--banner end-->
<!--云系统-->
<div class="subpage">
    <!--内容块-->
    <!--关于我们左边导航-->
    <div class="about_new_nav">
        <a href="index.php?c=introduce&a=aboutus">关于财来电</a>
        <a href="index.php?c=introduce&a=joinus">加入我们</a>
        <a href="index.php?c=introduce&a=law">法律声明</a>
        <a href="index.php?c=introduce&a=contactus" id="about_select">联系我们</a>
        <a href="index.php?c=introduce&a=aboutcloud">关于云系统</a>
    </div>
    <!--关于我们左边导航结束-->    
    <div class="about_new_rt">


        <p style=" font-size:13px; text-indent:0;">

        <h3 style="height: 40px; color: rgb(1, 153, 102); line-height: 40px; font-family: 微软雅黑; font-size: 17px; margin-top: 20px; margin-bottom: 20px; border-bottom-color: rgb(215, 215, 215); border-bottom-width: 1px; border-bottom-style: solid;">联系我们&nbsp;</h3><h4 style="height: 40px; color: rgb(1, 153, 102); line-height: 40px; font-family: 微软雅黑; font-size: 17px; margin-bottom: 10px; border-bottom-color: rgb(215, 215, 215); border-bottom-width: 1px; border-bottom-style: dashed;">财来电官方平台</h4>
        <p style="line-height: 36px; font-size: 14px; white-space: normal;">官方网站：www.cailaidian.cn</p><p style="line-height: 36px; font-size: 14px; white-space: normal;">企业热线：<span style="color: rgb(255, 0, 0);"><strong style="font-size: 14px;">4008-313-668</strong></span></p>
        <p style="line-height: 36px; font-size: 14px; white-space: normal;">微信服务号：财来电</p><p style="white-space: normal;"><br/></p>
        <h4 style="height: 40px; color: rgb(1, 153, 102); line-height: 40px; font-family: 微软雅黑; font-size: 17px; margin-bottom: 10px; border-bottom-color: rgb(215, 215, 215); border-bottom-width: 1px; border-bottom-style: dashed;">财来电（杭州总部）</h4><p style="line-height: 36px; font-size: 14px; white-space: normal;">企业热线：<span style="color: rgb(255, 0, 0);"><strong style="font-size: 14px;">0571-88333288</strong></span></p><p style="line-height: 36px; font-size: 14px; white-space: normal;">地址：浙江省杭州市拱墅区湖州街168号美好国际大厦12楼</p><p style="white-space: normal;"><br/></p>
        <p >
        <style type="text/css">
            #map1_container,#map2_container {width:808px;float:left;overflow: hidden;margin:0;}
            #allmap1{margin:0 0 20px;height:220px;}
            #allmap2{margin:10px 0 0;height:220px;}
        </style>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=vslIB5TqhHAvbfG0Qmv3sSmY"></script>
        <div id="map1_container"><div id="allmap1"></div></div>
        <br><br><br>

        </p>

        <script type="text/javascript">
            var map1 = new BMap.Map("allmap1");            // 创建Map实例
            map1.centerAndZoom(new BMap.Point(120.150935, 30.331378), 11);
            var local = new BMap.LocalSearch(map1, {
                renderOptions: {map: map1, panel: "r-result"}
            });
            local.search("美好国际大厦");
            //百度地图API功能
            //加载第一张地图
            //var map1 = new BMap.Map("allmap1");            // 创建Map实例
            //var point1 = new BMap.Point(120.150935, 30.331378);
            //map1.centerAndZoom(point1, 15);
            //map1.enableScrollWheelZoom();                  //启用滚轮放大缩小
            //加载第二张地图
            //var map2 = new BMap.Map("allmap2");            // 创建Map实例
            //var point2 = new BMap.Point(119.966011, 31.703757);
            //map2.centerAndZoom(point2, 15);
            //map2.enableScrollWheelZoom();                  //启用滚轮放大缩小
        </script>

    </div>
    <!--内容块结束-->

</div>
<!--云系统结束-->
<!--footer-->

<?php include APPPATH . 'views/' . template('index', 'footer', SITE_TEMP); ?>