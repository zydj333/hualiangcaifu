<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>双鸟机械</title>
<meta name="keywords" content="双鸟机械">
<meta name="description" content="双鸟机械">
<link href="css/master.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://misc.360buyimg.com/product/skin/2012/pshow.css?t=20120717.css" media="all" />
<script type="text/javascript" src="http://misc.360buyimg.com/lib/js/2012/base-v1.js" charset="gb2312"></script>
<script type="text/javascript" src="http://misc.360buyimg.com/lib/js/e/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="http://misc.360buyimg.com/lib/js/2012/lib-v1.js"></script>		
<script type="text/javascript" src="http://misc.360buyimg.com/product/js/2012/iplocation_server.js?t=20130520"></script>
<script type="text/javascript" src="http://misc.360buyimg.com/product/js/2012/product.js?t=20120717.js"></script>
<script type="text/javascript">
    	window.pageConfig = {
			compatible: true,
       		product: {
				skuid: 1025149,
				name: '\u98de\u5229\u6d66\uff08\u0050\u0048\u0049\u004c\u0049\u0050\u0053\uff09\u0020\u0033\u0032\u0050\u0046\u004c\u0033\u0030\u0034\u0035\u002f\u0054\u0033\u0020\u0033\u0032\u82f1\u5bf8\u0020\u9ad8\u6e05\u004c\u0045\u0044\u6db2\u6676\u7535\u89c6\uff08\u9ed1\u8272\uff09',
				skuidkey:'66B49677D6712C906B8D8F9CFE04F132',
				href: 'http://item.jd.com/1025149.html',
				src: 'g10/M00/1E/15/rBEQWFNnczoIAAAAAAHH_JTnqw0AAGA1gKdL2YAAcgU483.jpg',
				cat: [737,794,798],
				brand: 6742,
				nBrand: 6742,
				tips: false,
				type: 1,
				venderId:0,
				TJ:'0',
				specialAttrs:["isHaveYB","isFitService","isCanUseJQ","packType","CheckMachine","IsCheckCode","isCanVAT"],
				videoPath:''
			}
		};
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="http://www.xiaomi.com/js/libs/jquery18.js" ></script>
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/js.js" type="text/javascript"></script>
<script src="js/jQuery.js" type="text/javascript"></script>
<script src="js/jquery.fn.TabBox.js" type="text/javascript"></script>
<script>
function correctPNG() 
{
for(var i=0; i<document.images.length; i++)
{
var img = document.images[i];
var imgName = img.src.toUpperCase();
if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
{
var imgID = (img.id) ? "id='" + img.id + "' " : "";
var imgClass = (img.className) ? "class='" + img.className + "' " : "";
var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' ";
var imgStyle = "display:inline-block;" + img.style.cssText;
if (img.align == "left") imgStyle = "float:left;" + imgStyle;
if (img.align == "right") imgStyle = "float:right;" + imgStyle;
if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle;
var strNewHTML = "<span "+ imgID + imgClass + imgTitle + "style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";" 
+ "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader" + "(src='" + img.src + "', sizingMethod='scale');\"></span>";
img.outerHTML = strNewHTML;
i = i-1;}}
}
window.attachEvent("onload", correctPNG);
</script>
<script type="text/javascript">
/*<![CDATA[*/
var mileftnav = "mileftnav";
var isSekillOpen = 1;
var isCommentOpen = 1;
/*]]>*/
</script>
<script type="text/javascript">
/*<![CDATA[*/
var default_word = "小米活塞耳机";
/*]]>*/
</script>   

<script type="text/javascript">
$(function() {
	var sWidth = $("#focus").width(); //获取焦点图的宽度（显示面积）
	var len = $("#focus ul li").length; //获取焦点图个数
	var index = 0;
	var picTimer;
	
	//以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
	var btn = "<div class='btnBg'></div><div class='btn'>";
	for(var i=0; i < len; i++) {
		btn += "<span></span>";
	}
	btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
	$("#focus").append(btn);
	$("#focus .btnBg").css("opacity",0.5);

	//为小按钮添加鼠标滑入事件，以显示相应的内容
	$("#focus .btn span").css("opacity",0.4).mouseenter(function() {
		index = $("#focus .btn span").index(this);
		showPics(index);
	}).eq(0).trigger("mouseenter");

	//上一页、下一页按钮透明度处理
	$("#focus .preNext").css("opacity",0.2).hover(function() {
		$(this).stop(true,false).animate({"opacity":"0.5"},300);
	},function() {
		$(this).stop(true,false).animate({"opacity":"0.2"},300);
	});

	//上一页按钮
	$("#focus .pre").click(function() {
		index -= 1;
		if(index == -1) {index = len - 1;}
		showPics(index);
	});

	//下一页按钮
	$("#focus .next").click(function() {
		index += 1;
		if(index == len) {index = 0;}
		showPics(index);
	});

	//本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
	$("#focus ul").css("width",sWidth * (len));
	
	//鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
	$("#focus").hover(function() {
		clearInterval(picTimer);
	},function() {
		picTimer = setInterval(function() {
			showPics(index);
			index++;
			if(index == len) {index = 0;}
		},4000); //此4000代表自动播放的间隔，单位：毫秒
	}).trigger("mouseleave");
	
	//显示图片函数，根据接收的index值显示相应的内容
	function showPics(index) { //普通切换
		var nowLeft = -index*sWidth; //根据index值计算ul元素的left值
		$("#focus ul").stop(true,false).animate({"left":nowLeft},300); //通过animate()调整ul元素滚动到计算出的position
		//$("#focus .btn span").removeClass("on").eq(index).addClass("on"); //为当前的按钮切换到选中的效果
		$("#focus .btn span").stop(true,false).animate({"opacity":"0.4"},300).eq(index).stop(true,false).animate({"opacity":"1"},300); //为当前的按钮切换到选中的效果
	}
});

</script>

    <script type="text/javascript">
 $(function(){
	$("#pro_nav .firstdiv").hide();
	$("#pro_nav .firstdiv .secenddiv").hide();

	$("#pro_nav .first").toggle(function(){
		$(this).next().slideDown();	
	 
		 
	},function(){
		$(this).next().slideUp();
	 
		
	});
	
		$("#pro_nav .firstdiv .secend").click(function(){
	  
  if ($(this).next().css("display") =="none"){
   
		$(this).next().slideDown();	
		$(this).removeClass("secendbj");
		
		 }else{
		 $(this).next().slideUp();	
		 
		$(this).addClass("secendbj");
		 
		 }
		 
	});
});
   </script>
</head>
<body>
<div class="sntop">
<div class="snhead">
<div class="snlogox"><img src="images/logosnx.png" /></div>
<div class="snnav">
<div class="snnav1">北京时间： 2014年3月4日 星期二 9:53 <img src="images/snline.gif" style="vertical-align:middle" /> <input name="a" value="请输入关键字" type="text" class="serch" /><img src="images/snline.gif" style="vertical-align:middle" /> EN &nbsp;&nbsp;中文<img src="images/snline.gif" style="vertical-align:middle" /></div>
<div id="nav">
      <ul class="c">
        <li id="100"><span class="v"><a href="index.html" >首页</a></span></li>
        <li id="101"><span class="v"><a href="about-us.html" >走进双鸟</a></span></li>
        <li id="102"><span class="v"><a href="news-list.html" >新闻中心</a></span></li>
        <li id="103"><span class="v"><a href="product-list.html" >产品信息</a></span></li>
        <li id="104"><span class="v"><a href="case-list.html" >成功案例</a></span></li>
        <li id="105"><span class="v"><a href="sn-industries.html" >研修/培训</a></span></li>
        <li id="108"><span class="v"><a href="kehuzq.html" >客户专区</a></span> </li>
				<li id="109"><span class="v"><a href="contact-us1.html" >联系我们</a></span> </li>
      </ul>
    </div>
    <script type="text/javascript" src="js/nav.js"></script>    
	<script type="text/javascript">
	myLoad(103);
	</script>
</div>
</div>
</div>
<div class="submenu">
<div class="nav_menu">
      <ul>
        <li><a href="products.asp?classid=86&n=1" class="white">环链电动葫芦</a>
          <div class="ch_men">
            <div class="men_left">
              <dl>
                
                <dt class="h3">环链电动葫芦</dt>
                
                <dd><a href="product-detail1.html" title="SHH">SHH</a></dd>
                <dd><a href="product-detail2.html" title="HHXG">HHXG</a></dd> 
				<dd><a href="product-detail3.html" title="SHH816">SHH816</a></dd>                        
              </dl>
            </div>
            <div class="men_right">
              
              <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                  <td><p class="h4">SHH</p>1、安全可靠性高<br />
2、机体结构新颖<br />
本机采用高强度的铝合金机体，外形美观、机体紧凑、体积小、重量轻。采用二级齿轮传动，高速级为斜齿轮传动，因而传动平稳、噪声小。<br />
3、零部件强度高<br />
4、本机设有贮链袋，运行时链条能自动贮存于贮链袋内，以防链条自由下坠时卡住和沾上污物。
<span><img src="images/snproimgshh1.jpg" border="0" width="230" height="230" /></span></td>
                </tr>
              </table>
               <table width="100%" border="0" cellspacing="0" cellpadding="0" style="display:none">
                <tr>
                  <td><p class="h4">HHXG</p>1、高效、质轻电机，无石棉刹车系统，低能耗。<br />
2、冲压钢构壳体，轻巧而坚固。<br />
3、高强度安全吊钩，承受意外超负荷冲击不会发生断裂，只是逐渐变形。<br />
4、轻巧、美观而耐用的塑制链袋。<br />
5、极限开关：吊上吊下都有极限快关装置，使电机自动停止，反防止链条超出，确保安全。
<span><img src="images/subming1.jpg" border="0" width="230" height="230" /></span></td>
                </tr>
              </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="display:none">
                <tr>
                  <td><p class="h4">SHH816</p>1.维修方便<br />
2.高工作级别，使用寿命更长<br />
3.高性能的先进设计<br />
4.拓宽产品适用范围<br />
5.可靠的安全装置<br />
6.安全的电控操作系统<br />
7.低净空起升高度
<span><img src="images/subming5.jpg" border="0" width="230" height="230" /></span></td>
                </tr>
              </table>       
            </div>
          </div>
        </li>
       
	  	    
        <li><a href="products.asp?classid=86&n=1" class="white">手动葫芦</a>
          <div class="ch_men">
            <div class="men_left">
              <dl>
                
                <dt class="h3">手拉葫芦</dt>
                
                <dd><a href="product-detail4.html" title="手拉葫芦">手拉葫芦</a></dd>
                
                <dt class="h3">手扳葫芦</dt>
                
                <dd><a href="product-detail5.html" title="手扳葫芦">手扳葫芦</a></dd>                                      
              </dl>
            </div>
            <div class="men_right">
              
              <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                  <td><p class="h4">手拉葫芦</p>1、依据《En13157》标准设计制造，主要零部件和整机性能均经严格的检查和测试，产品的可靠度大大提高，保证使用安全。<br />
2、低合金结构钢板采用，安全可靠、经久耐用。<br />
3、采用800Mpa高强度起重链条，锻打式的吊钩设计确保缓慢起升以防过载；符合欧洲CE安全标准。安全系数高，使用寿命长。<br />
4、整体轴承采用，大大提高了产品的性能、使用寿命和易维修性。<br />
5、转动平稳，效率高，手拉力小。<br />
6、双棘爪、冲压件导链板（双导轮结构选用），更加安全可靠。
<span><img src="images/snproimgsl1.jpg" border="0" width="230" height="230" /></span></td>
                </tr>
              </table>
              
              <table width="100%" border="0" cellspacing="0" cellpadding="0" style="display:none">
                <tr>
                  <td><p class="h4">手扳葫芦</p>1、依据《En13157》标准设计制造，主要零部件和整机性能均经严格的检查和测试，产品的可靠度大大提高，在使用中保证了使用人员的安全性。<br />
2、采用低合金结构钢板，安全可靠、经久耐用。<br />
3、采用800Mpa高强度起重链条，锻打式的吊钩设计确保缓慢起升以防过载；符合欧洲CE安全标准。安全系数高，使用寿命长。<br />
4、采用整体轴承，大大提高了产品的性能、使用寿命和易维修性。<br />
5、转动平稳，效率高，手板力小。
<span><img src="images/subming3.jpg" border="0"  width="230" height="230"/></span></td>
                </tr>
              </table>
                               
            </div>
          </div>
        </li>
		 <li><a href="products.asp?classid=86&n=1" class="white">单轨行车</a>
          
        </li>
		        <li><a href="products.asp?classid=86&n=1" class="white">吊索具</a>
        </li>
		        <li><a href="products.asp?classid=86&n=1" class="white">起重链条</a>
        </li> 
<li><a href="products.asp?classid=86&n=1" class="white">特种行业</a>
        </li>
      </ul>
    </div>


</div>

<div class="index_banner clearfix">
            <div class="index_banner2">
                <ul>                    
                    <li><img src="images/snbanner4k.jpg" /></li>
                </ul>
            </div>
</div>	

<div class="main_body clearfix">
<div class="mntopbg"><span class="info_navzi2">产品信息</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="news.php" class="grey">产品信息</a> > <span class="font_red">产品信息</span></div></div>

  <div class="main_con clearfix">
    <div class="main_con_left"> <img src="images/left_img.png" class="font_size fix div_block" /> <img src="images/news_img3.jpg" class="font_size fix div_block" />
         <div id="showlist" class="showlist" style="display:none">
                      <ul id="showlistUL" class="lists">
                        <li>
                            <a class="tit" href="#">环链电动葫芦</a>
							<em class="icon-common icon-common-arrowright"></em>
                            <label class="tri"><i></i></label>
                            <div class="show clearfix" style="display:none;">
                                <div class="lt">
                                    <dl class="firstdl"> 
                                        <dd><a href="product-detail1.html"><img src="images/protb3.png" style="vertical-align:middle;">SHH</a></dd>
                                        <dd><a href="product-detail2.html"><img src="images/protb1.png" style="vertical-align:middle;">HHXG</a></dd>
										<dd><a href="product-detail3.html"><img src="images/protb4.png" style="vertical-align:middle;">SHH816</a></dd>
                                    </dl>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="tit">手动葫芦</a>  
                            <em class="icon-common icon-common-arrowright"></em>
                            <label class="tri"><i></i></label>
                            <div class="show clearfix" style="display:none;">
                                <div class="lt">
                                    <dl class="firstdl"> 
                                        <dd><a href="product-detail4.html"><img src="images/protb5.png" style="vertical-align:middle;">手拉葫芦</a></dd>
                                        <dd><a href="product-detail5.html"><img src="images/protb2.png" style="vertical-align:middle;">手扳葫芦</a></dd>
                                    </dl>
                                </div>
                            </div>
                        </li>
						 <li><a class="tit" href="#">单轨行车</a></li>
						 <li><a class="tit" href="#">吊索具</a></li>
						 <li><a class="tit" href="#">起重链条</a></li>
						<li>
                            <a class="tit">特种行业</a>  
                        </li>
                    </ul>
                </div>
				
				  
      <img src="images/left_img_bottom.png" class="font_size fix div_block" />
      <img src="images/cont.jpg" border="0" class="fix contd_img" />
    </div>
    <div class="main_con_right">
	<div class="lxfsbot"><a href="contact-us1.html"><img src="images/confsbt.png" border="0" /></a></div>
      <div class="about_con">
  <div class="prodtail clearfix" id="product_main">
<div class="product-summary fix">
<div class="product-info-box">
<div class="product-main-title">
<h1 class="wb" title="SHH型环链电动葫芦">
SHH型环链电动葫芦
</h1>
</div>
<div class="jxprojg">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td height="10"></td></tr>
<tr>
<td width="100" align="right" class="jgbtwz" height="26">行业价：</td><td class="jgwz1">¥500</td>
</tr>
<tr><td height="10"></td></tr>
<tr>
<td width="100" align="right" class="jgbtwz" height="26">经销商价格：</td><td class="jgwz2">¥500</td>
</tr>
<tr><td height="10"></td></tr>
<tr>
<td width="100" align="right" class="jgbtwz" height="26">吨位：</td><td><select class="dsselt"><option>1</option><option>2</option><option>3</option></select></td>
</tr>
<tr><td height="10"></td></tr>
<tr>
<td width="100" align="right" class="jgbtwz" height="26">米数：</td><td><input name="a" type="text" value=" " class="msip" /></td>
</tr>
<tr><td height="20"></td></tr>
<tr><td colspan="2"><input name="a" type="button" value="报价" class="bjbotton2" /> &nbsp;<input name="a" type="button" value="加入订单" class="bjbotton1" /></td></tr>
</table>
</div>

</div>
</div>

<div>
<div id="spec-n1" class="jqzoom" onclick="window.open('images/snproimghhxg1.jpg')" clstag="shangpin|keycount|product|spec-n1">
				<img data-img="1" width="350" height="350" src="images/snproimghhxg1.jpg" alt="飞利浦（PHILIPS） 32PFL3045/T3 32英寸 高清LED液晶电视（黑色）"  jqimg="images/snproimghhxg1.jpg"/>
			</div>
<div id="spec-list" clstag="shangpin|keycount|product|spec-n5">
				<a href="javascript:;" class="spec-control" id="spec-forward"></a>
				<a href="javascript:;" class="spec-control" id="spec-backward"></a>
				<div class="spec-items">
					<ul class="lh">                        
					<li><img data-img="1" class="img-hover"  alt="" src="images/snproimghhxg1.jpg" width="50" height="50" data-url="images/snproimghhxg1.jpg"></li>
                    <li><img data-img="1" class="img-hover"  alt="" src="images/snproimghhxg1.jpg" width="50" height="50" data-url="images/snproimghhxg1.jpg"></li>
					<li><img data-img="1" class="img-hover"  alt="" src="images/snproimghhxg1.jpg" width="50" height="50" data-url="images/snproimghhxg1.jpg"></li>
					<li><img data-img="1" class="img-hover"  alt="" src="images/snproimghhxg1.jpg" width="50" height="50" data-url="images/snproimghhxg1.jpg"></li>
					<li><img data-img="1" class="img-hover"  alt="" src="images/snproimghhxg1.jpg" width="50" height="50" data-url="images/snproimghhxg1.jpg"></li>
					<li><img data-img="1" class="img-hover"  alt="" src="images/snproimghhxg1.jpg" width="50" height="50" data-url="images/snproimghhxg1.jpg"></li>
					<li><img data-img="1" class="img-hover"  alt="" src="images/snproimghhxg1.jpg" width="50" height="50" data-url="images/snproimghhxg1.jpg"></li>
					<li><img data-img="1" class="img-hover"  alt="" src="images/snproimghhxg1.jpg" width="50" height="50" data-url="images/snproimghhxg1.jpg"></li>
					</ul>
				</div>
			</div>
	</div>

<div class="clear"></div>
</div>           
<div class="proInfo">
				<ul class="Tab2"><li class="focus" onclick="fnTabBoxSlide(this,2,5);">产品介绍</li><li onclick="fnTabBoxSlide(this,2,7);">功能参数</li><li onclick="fnTabBoxSlide(this,2,8);">产品对比</li></ul>
				<div class="Box2">
					<div id="TabShow5" class="TabHide2"><div class="info"><p>1、安全可靠性高<br />
本机设有限载保护装置，可避免超载时引发的不良后果；起重吊钩设有闭锁装置，可防止锁具意外滑脱；电机设有热保护装置，当电机因频繁使用引起温升过高时，该装置会自动切断电机以保护电机不至于被烧坏；本机设有上、下限位装置，当吊钩上升或下降至极限位时，本机会自动切断电源，吊钩随即停止动作；本机设有紧急停止按钮，使操作者于危急状况是，能立即关闭电源。</p> 
<p>2、机体结构新颖<br />
本机采用高强度的铝合金机体，外形美观、机体紧凑、体积小、重量轻。采用二级齿轮传动，高速级为斜齿轮传动，因而传动平稳、噪声小。</p> 
<p>3、零部件强度高<br />
本机主要零部件均采用高级合金钢材料，并经多道特殊热处理工艺加工，具有强度高、耐磨性好等特点；上、下吊钩采用高强度合金钢制作，经强化热处理后具有很高的韧性，即使机体因超载引起破坏，吊钩也只会产生朔性变形而不会发生脆性断裂。</p> 
<p>4、本机设有贮链袋，运行时链条能自动贮存于贮链袋内，以防链条自由下坠时卡住和沾上污物。</p>
</div></div>					
				  <div id="TabShow7" class="TabHide2" style="display:none;">
				  <div class="info">
<p>&nbsp;特点： <br />
▲容量大、比能量高：比能量达35-38wh/kg。</p>
<p>▲自放电率极低：&lt;5%/月，失水极少。</p>
<p>▲循环寿命长：400周期性(100%DOD)以上。</p>
<p>▲安全可靠。</p>
<p>▲使用形式多样：既可浮充使用，又可循环使用。&nbsp;<br />
应用： <br />
▲电动自行车▲轻便型电动车▲电动摩托车</p>
                    
                  </div></div>
					<div id="TabShow8" class="TabHide2" style="display:none;">
					<div class="info">
					<p>&nbsp;特点： <br />
▲容量大、比能量高：比能量达35-38wh/kg。</p>
<p>▲自放电率极低：&lt;5%/月，失水极少。</p>
<p>▲循环寿命长：400周期性(100%DOD)以上。</p>
<p>▲安全可靠。</p>
<p>▲使用形式多样：既可浮充使用，又可循环使用。&nbsp;<br />
应用： <br />
▲电动自行车▲轻便型电动车▲电动摩托车</p>
					</div></div>					
				</div>
			</div>

<div class="contbt1"><h3>结构图</h3></div>
<div class="textc"><img src="images/snjgt-shh1.jpg" /></div>
<div class="contbt1"><h3>技术参数</h3></div>
 <div class="textc"><img src="images/snjgt-shh2.jpg" /></div>
 <div class="contbt1"><h3>相关下载</h3></div>
 <div class="xztext">
 <ul>
 <li><a href="#" class="grey">产品手册下载</a></li>
 <li><a href="#" class="grey">电子手册下载</a></li>
 </ul>
 </div>  
  <div class="contbt1"><h3>维修视频</h3></div> 
   <div class="textc">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
   <td><a href="#"><img src="images/aboutpic5.jpg" border="0" /></a></td>
   </tr>
   </table>
   </div>
   <div class="contbt1"><h3>安装视频</h3></div> 
   <div class="textc">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
   <td><a href="#"><img src="images/aboutpic5.jpg" border="0" /></a></td>
   </tr>
   </table>
   </div>
      </div>
    </div>
    <div class="borth25"></div>
  </div>
  <img src="images/body_bottom.png"  class="font_size fix div_block" />  </div>




<div class="magtop10 snfttiao"><div class="snfcon"><table width="990" align="center" cellpadding="0" cellspacing="0">
<tr><td colspan="2" class="ftwzcmwz" align="left">版权所有：浙江双鸟机械有限公司 &nbsp;&nbsp;&nbsp;©双鸟机械 | 手拉葫芦,手扳葫芦,环链电动葫芦,单轨行车,起重链条,索具链条,80级链条,电力机具</td><td align="center"><select style="width:170px;"><option>友情链接</option><option>双鸟机械</option></select></td></tr>
</table></div></div>
<div class="snftactiv clearfix">
<div class="snfcon clear"> 
<div class="snfconlf">
<ul>
<li class="widsn1">
<h3>走进双鸟</h3>
<div class="snfconsub snfline">
<a tabindex="0" href="#">企业介绍</a><br />
<a tabindex="0" href="#">董事长致辞</a><br />
<a tabindex="0" href="#">发展历史</a><br />
<a tabindex="0" href="#">组织结构</a><br />
<a tabindex="0" href="#">企业荣誉</a><br />
<a tabindex="0" href="#">企业资质</a><br />
<a tabindex="0" href="#">检测中心</a>
</div>
</li>
<li class="widsn1">
<h3>产品信息</h3>
<div class="snfconsub snfline">
<a tabindex="0" href="#">环链电动葫芦</a><br />
<a tabindex="0" href="#">手动葫芦</a><br />
<a tabindex="0" href="#">单轨行车</a><br />
<a tabindex="0" href="#">吊索具</a><br />
<a tabindex="0" href="#">起重链条</a><br />
<a tabindex="0" href="#">特种行业</a><br />
<a tabindex="0" href="#">钢丝绳电动葫芦</a>
</div>
</li>
<li class="widsn1">
<h3>联系我们</h3>
<div class="snfconsub snfline">
<a tabindex="0" href="#">联系方式</a><br />
<a tabindex="0" href="#">来司路线</a><br />
<a tabindex="0" href="#">访客留言</a>
</div>
</li>
<li class="widsn2">
<h3>集团产业</h3>
<div class="snfconsub">
<a href="news.php">浙江双鸟机械有限公司</a><br />
<a href="mediareport.php">浙江双鸟起重设备有限公司</a><br />
<a href="mediareport.php">浙江双鸟锚链有限公司</a><br />
<a href="news.php">浙江双鸟数码机床有限公司</a>
</div>
</li>
</ul>
</div>
<div class="snfconrg">
<img src="images/footrgtel.jpg" />
</div>
</div>
</div>


 <!-- S 列表导航 -->
                <script id="nav-list-template" type="text/x-dot-template">
        
            {{? it.children}}
                {{~it.children:value:index}}
                    {{? value.cat_id!=30}}
                    <li>
                        {{? value.cat_id===65 || value.cat_id===67}}
                            <a class="tit" href="http://www.xiaomi.com/accessories/{{=value.cat_id}}" target="_blank">{{=value.cat_name}}</a>
                        {{??}}
                            <a class="tit" href="http://www.xiaomi.com/accessories/{{=value.cat_id}}">{{=value.cat_name}}</a>
                        {{?}}
                        <em class="icon-common icon-common-arrowright"></em>
                        {{? value.children.length !== 0}}
                            <label class="tri"><i></i></label>
                            <div class="show clearfix" style="display:none;">
                                <div class="lt">
                                    <dl class="firstdl">
                                    {{~value.children:cvalue:cindex}}
                                        {{? cvalue.cat_icon}}
                                            <dd><a href="http://www.xiaomi.com/accessories/{{=cvalue.cat_id}}"><img src="{{=cvalue.cat_icon}}">{{=cvalue.cat_name}}</a></dd>
                                        {{??}}
                                            <dd><a href="http://www.xiaomi.com/accessories/{{=cvalue.cat_id}}"><em>&#903;</em>{{=cvalue.cat_name}}</a></dd>
                                        {{?}}
                                        
                                    {{~}}
                                    
                                    <dt class="dton"><a href="http://www.xiaomi.com/accessories/{{=value.cat_id}}"><span class="icon-common icon-common-grid"></span>全部分类</a></dt>
                                    </dl>
                                </div>
                        {{?}}
                    </li>
                    {{?}}
                {{~}}
            {{?}}
        </script>
    <!-- E 列表导航 -->
        <script>
        function createurlcdn(url,t){
            t = t || 5;
            var date = new Date();
            var hour = date.getHours();
            hour = (hour < 10 ? "0" : "") + hour;
            var min  = date.getMinutes();
            min = ( parseInt(min / t) <10?"0":"")+parseInt(min / 5);
            var day  = date.getDate();
            day = (day < 10 ? "0" : "") + day;
            var version = day + hour + min;
            document.write('<script src="'+url+'?ver=' + version + '0"><\/script>');
        }
        createurlcdn("http://www.xiaomi.com/c/service/js/categoryTree.js",5);
    </script>
    <script type="text/javascript" src="http://www.xiaomi.com/js/base.min.js?2014030305"></script>
    <script type="text/javascript">
        XIAOMI.namespace("GLOBAL_CONFIG,GLOBAL_VAR");
        XIAOMI.GLOBAL_CONFIG = {
            orderSite:"http://order.xiaomi.com",
            wwwSite:"http://www.xiaomi.com",            
            logoutUrl:"http://order.xiaomi.com/site/logout",
            quickLoginUrl:"https://account.xiaomi.com/pass/static/login.html"
        }
        XIAOMI.app.setLoginInfo.orderUrl = XIAOMI.GLOBAL_CONFIG.logoutUrl;
        XIAOMI.app.setLoginInfo.init();
        XIAOMI.app.header.init();   
        //流量统计平台
        var _msq = _msq || [] ;
            _msq.push(['setDomainId',100]); 
            _msq.push(['trackPageView']);
        (function() {
            var ms = document.createElement('script');
            ms.type ='text/javascript';
            ms.async = true ;
            ms.src = 'http://p.www.xiaomi.com/js/xmst.js';
            var s = document.getElementsByTagName('script')[0]; 
            s.parentNode.insertBefore(ms,s);
        })();
        $(function(){
            //BD流量统计数组定义
            var _hmt = _hmt || [];
            (function() {
              var hm = document.createElement("script");
              hm.src = "//hm.baidu.com/hm.js?7080c6a6aba51276281d5d595b080def";
              var s = document.getElementsByTagName("script")[0]; 
              s.parentNode.insertBefore(hm, s);
            })();
        });
    </script>
</body>
</html>
