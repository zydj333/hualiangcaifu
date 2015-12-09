<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><!--{$seo_title}--></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META http-equiv="keywords" content="<!--{$seo_keywords}-->">
<META http-equiv="description" content="<!--{$seo_description}-->">
<link href="<!--{CSS_PATH}-->index.css" type="text/css" rel="stylesheet" />
<link href="<!--{CSS_PATH}-->top_foot.css" type="text/css" rel="stylesheet" />
<script src="<!--{JS_PATH}-->jquery-1.7.2.min.js"></script>
<script src="<!--{JS_PATH}-->jquery.flexslider-min.js"></script>
<script src="<!--{JS_PATH}-->scrolltop.js"></script>
<script>
    $(window).load(function () {
        $('.flexslider').flexslider({
            directionNav: false,
            pauseOnAction: false
        });
    });
</script>
	<script type="text/javascript">
	    $(function ($) {
	        //弹出登录
	        $(".jd").on('click', function () {
	            $("body").append("<div id='mask'></div>");
	            $("#mask").addClass("mask").fadeIn("slow");
	            $("#LoginBox").fadeIn("slow");
	            var ids = $(this).attr("id");
	            $.post("index.php?c=index&a=getjd&id="+ids, {}, function (result) {
	                $(".contents").html(result);
	                if ( $("#LoginBox").height()-$(".contents").find("table").height()  <= 30) {
	                    $("#LoginBox").css({"overflow-y":"scroll","width":"540px"});
	                } else {
	                    $("#LoginBox").css({ "overflow-y": "hidden", "width": "520px" });
	                }
	            });
	        });
	        //
	        $("#loginbt").click(function () {
	            if ($("#username").val()=="") {
	                $("#error").html("手机不能为空");
	                $("#username").focus();
	                return false;
	            }
	            if ($("#password").val() == "") {
	                $("#error").html("密码不能为空");
	                $("#password").focus();
	                return false;
	            }
	            return true;
	        });

	        $(document).keyup(function (event) {
	            switch (event.keyCode) {
	                case 27:
	                    $("#LoginBox").fadeOut("fast");
	                    $("#mask").css({ display: 'none' });
	                case 96:
	                    $("#LoginBox").fadeOut("fast");
	                    $("#mask").css({ display: 'none' });
	            }
	        });

	        $(window).scroll(function () {
	            // if ($.browser.msie && $.browser.version == "6.0") {
	            $("#LoginBox").css("top", $(window).height() - $("#LoginBox").height() + $(document).scrollTop() - 100);
	            //  };
	        });
	        
	        //弹出登录
          $(".about").on('click', function () {
              $("#mtitle").val($(this).attr("ids"));
              $("body").append("<div id='mask'></div>");
              $("#mask").addClass("mask").fadeIn("slow");
              $("#LoginBox").fadeIn("slow");
          });
          //邮箱格式验证
					function isEmail(email) {
              var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
              if (!myreg.test(email)) {
                  return false;
              }
              else {
                  return true;
              }
          }
	        //关闭
	        $(".close_btn").hover(function () { $(this).css({ color: 'black' }) }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
	            $("#LoginBox").fadeOut("fast");
	            $("#mask").css({ display: 'none' });
	        });
	        //发送邮件
	        $(".fs").click(function () {
						$(".m1_err").html("");

						if ($("#mname1").val() == "") {
  						$(".m1_err").html("收件人不能为空");
  						$("#mname1").focus();
  						return false;
						}

						if (!isEmail($("#mname1").val())) {
  						$(".m1_err").html("收件人邮箱格式不正确");
  						$("#mname1").focus();
  						return false;
						}
						var mid = $("#mtitle").val();
						var mmail = $("#mname1").val();
						$.post("index.php?c=index&a=stemail&mid="+mid+"&mmail="+mmail, {}, function (result) {
							alert(result);
							$("#LoginBox").fadeOut("fast");
							$("#mask").css({ display: 'none' });
						});
});
	    });
	</script>	
</head>

<body style="overflow-x:hidden">
	<script>
		function cls() {
			$("#adimage").slideUp();
		}
	</script>
   
	<div id='adimage' style='width:100%; background:#DF2816; margin:0px auto;'>
		<div id='adSmall' >
			<div id='ads' style="text-align:center"><a href='#'><img src='<!--{IMG_PATH}-->ad2.jpg' alt="华良财富全国经纪人招募" title="华良财富全国经纪人招募" /></a><div id="cls"  onclick='cls()' style=" cursor:pointer;  color:#000; background:yellow;width:50px;height:20px; line-height:20px; text-align:center; position:absolute; top:5px; right:5px;">[关闭]</div></div>
    </div>
  </div> 

<!--header-->
 
<header>
    <div class="head">
        <div class="head_top" >
            <div class="head_top_body">
                <h4>
                	<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
                	您好，<?php echo $this->session->userdata['member_truename']; ?>,欢迎登录！<a href="index.php?m=member&c=user&a=index">会员中心</a><a href="index.php?c=customer&a=logout" class="purple">[退出]</a>
                	<!--{else}-->
                    <a href="index.php?c=customer&a=register" title="注册华良财富会员">理财师申请</a>
                    <a href="index.php?c=customer&a=login" title="登录华良财富云系统">登录</a>   
                  <!--{/if}-->                
                </h4>
                <p>
                    <a href="index.php?c=introduce&a=contactus" title="联系我们-华良财富">联系我们</a>
                    <span>|</span>
                    <a href="index.php?c=introduce&a=aboutus" title="华良财富介绍">了解我们</a>
                    <span>|</span>
                    <strong class="top_new_tel">400-0590-188</strong>
                </p>
            </div>
        </div>
        
        <div class="head_mid" style="clear:both;">
            <h1 class="head-h1">
                <a href="index.php" class="logo" title="华良财富-中国最大最专业的理财师一站式服务平台">
                <img src="<!--{IMG_PATH}-->logo.jpg" title="华良财富" alt="华良财富-中国最大最专业的理财师一站式服务平台" width="400" height="95">
            </a>
            </h1>
            <div class="head-h1rght">
                <div class="search-wrap">
                    <div class="input-wrap">
                        <div class="opt">
                            <span id="newtop1_selectedProName" data-action="index.php?c=products&a=lists&cpxl=1" data-type="xintuo">信托产品</span>
                            <b class="icon"></b>
                            <div class="opt-drop" style="display: none;">
                                <ul>
                                <li><a><span data-type="ziguanjh" data-action="index.php?c=products&a=lists&cpxl=2">资管计划</span></a></li>
                                <li><a><span data-type="yanggsm" data-action="index.php?c=products&a=lists&cpxl=3">阳光私募</span></a></li>
                                <li><a><span data-type="zhuanrzq" data-action="index.php?c=products&a=lists&cpxl=4">海外资产</span></a></li>
                                <li><a><span data-type="zhuanrzq" data-action="index.php?c=products&a=lists&cpxl=5">企业债券</span></a></li>
                              	</ul>
                            </div>
                        </div>
                        <input type="text" name="name" class="input search-keyword" value="" id="head-searchtxt" autocomplete="off" placeholder="搜索您需要的产品">
                    </div>
                    <input type="button" name="name" value=" " class="insearch" id="head-txtsearch">
                </div>
                <div class="hotsearch">
                   热门搜索：
                   <!--{foreach $hot_arr $val}-->
                   <a href="index.php?c=products&a=lists&search_title=<!--{$val}-->" title="<!--{$val}-->"><!--{$val}--></a>
                   <!--{/foreach}-->
                </div>
            </div>
        </div>
        
        <div class="head-nav-frame ">
            <ul class="nav clearfix">
                <li class="fl"><a href="index.php" id="newtop1_home" <!--{if $current_nav=='index'}-->class="nav_focus"<!--{/if}-->><span>首页</span></a></li>
                <!--{foreach $nav_category $v}-->
                <li class="fl"> <a href="index.php?c=products&a=lists&cpxl=<!--{$v['column_value']}-->" <!--{if $current_nav==$v['column_value']}-->class="nav_focus"<!--{/if}-->><span><!--{$v['column_title']}-->(<em class="num"><!--{$v['numbs']}--></em>)</span></a></li>
                <!--{/foreach}-->
                <li class="hy fr">            
                <a href="index.php?c=introduce&a=aboutus" id="newtop1_usercenter" title="关于我们-壹财富">关于我们</a>
                </li>
            </ul>
        </div>
        
    </div>
</header>
<DIV style="DISPLAY: none" id=goTopBtn>
<IMG border=0 src="<!--{IMG_PATH}-->return_top.jpg"></DIV>
 
<!--header end-->