<script>
        $(function () {
            $(".opt-drop>ul").children().remove();
            var ss = [
                 {
                     title: "信托产品",
                     url: "index.php?c=products&a=lists&cpxl=1",
                     type: 'xintuo'
                 },
                 {
                     title: "资管计划",
                     url: "index.php?c=products&a=lists&cpxl=2",
                     type: 'ziguanjh'
                 },
                {
                    title: "阳光私募",
                    url: "index.php?c=products&a=lists&cpxl=3",
                    type: 'yanggsm'
                },
                 {
                     title: "海外资产",
                     url: "index.php?c=products&a=lists&cpxl=4",
                     type: 'zhuanrzq'
                 }
            ];
            var litem = "";
            for (var i = 0; i < 4; i++) {
                if (ss[i].type != $(".opt>span").attr("data-type")) {
                    litem += "<li><a ><span  data-type=" + ss[i].type + " data-action=" + ss[i].url + "   >" + ss[i].title + "</span></a></li>";
                }
               

            }
            $(".opt-drop>ul").append(litem);


        });




        $(".opt").hover(function () {
           $(".opt-drop").stop(true, true).slideDown(300);
            $(" .head-h1rght .input-wrap .opt .icon").addClass("reverse");
        }, function () {
              $(".opt-drop").stop(true, true).slideUp(300);
            $(" .head-h1rght .input-wrap .opt .icon").removeClass("reverse");
        });



        $(".opt-drop li").live("click",function() {
            var txt_d = $(".opt>span").text();
            var txt_d_action = $(".opt>span").attr("data-action");
            var txt_s = $(this).find("span").text();
            var txt_s_action = $(this).find("span").attr("data-action");
            $(".opt>span").text(txt_s).attr("data-action", txt_s_action);
            $(this).find("span").text(txt_d).attr("data-action", txt_d_action);;
            $(".opt-drop").stop(true, true).slideUp(300);
        });


        //$(".head-h1rght").on(".opt-drop li", "click", function () {

        //});


        //$(".opt-drop li").click(function () {

        //});


    </script>
    <script>
        $('#head-searchtxt').keydown(function (e) {
            if (e.keyCode == 13) {
                $("#head-txtsearch").focus();
                $("#head-txtsearch").click();
            }

        });

        $("#head-txtsearch").click(function () {
            var title = $.trim($("#head-searchtxt").val());
            window.location.href = $(".opt>span").attr("data-action") + "&title=" + title;
        });
    </script>
<footer>
    <div class="footer"> 
        <div class="footer_top">
            <div class="footer_top_body">
                <div class="footer_logo">
                    <img src="<!--{IMG_PATH}-->footer_logo.png"  />
                </div>
                <dl class="footer_section">
                    <dt class="section_title">产品中心</dt>
                    <dd class="section_item">
                        <a href="index.php?c=products&a=lists&cid=1" title="信托产品">信托产品</a>
                        <a href="index.php?c=products&a=lists&cid=2" title="资管产品">资管产品</a>
                        <a href="index.php?c=introduce&a=subscription" title="信托认购导航">信托认购导航</a>
                    </dd>
                </dl>
                <dl class="footer_section">
                    <dt class="section_title">了解我们</dt>
                    <dd class="section_item">
                        <a href="index.php?c=introduce&a=aboutus" title="关于华良财富">关于华良财富</a>
                        <a href="index.php?c=introduce&a=joinus" title="加入我们">加入我们</a>
                        <a href="index.php?c=introduce&a=law" title="法律声明">法律声明</a>
                        <a href="index.php?c=introduce&a=aboutcloud" title="关于云系统">关于云系统</a>
                    </dd>
                </dl>
                <dl class="footer_section">
                    <dt class="section_title">其他</dt>
                    <dd class="section_item">
                    	<a href="index.php?c=introduce&a=contactus">联系我们</a>
                    	<a href="index.php?c=introduce&a=actlog" title="更新日志">更新日志</a>
                    	<a href="index.php?c=introduce&a=partner" title="合作伙伴">合作伙伴</a>
                    </dd>
                </dl>
                <div class="footer_tel">
                    <img src="<!--{IMG_PATH}-->footer_tel_icon.png"  />
                    <h3 style="margin-left:-60px;"><img src="<!--{IMG_PATH}-->tel2.jpg" style="width:171px; height:35px;" /></h3>
                    <span>服务时间：9:00 - 21:00</span>
                </div>
                <div class="footer_weixin">
                    <img src="<!--{IMG_PATH}-->wx_pic.png"  />
                    <span>扫描官方二维码</span>
                </div>
            </div>
        </div>
        <div class="footer_btm">
            <div>
                  Copyright © 2014<a href="/">财来电</a> cailaidian.cn All Rights Reserved 版权所有  浙ICP备12023130号-4  
            </div>
        </div>
    </div>
</footer>
<script language="javascript" src="http://float2006.tq.cn/floatcard?adminid=9650025&sort=0"></script>
</body>
</html>