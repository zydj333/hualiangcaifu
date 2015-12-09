<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><!--{$seo_title}--></title>
<meta name="keywords" content="<!--{$seo_keywords}-->">
<meta name="description" content="<!--{$seo_description}-->">
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<link rel="stylesheet" type="text/css" href="<!--{CSS_PATH}-->master.css"  />
<link rel="stylesheet" type="text/css" href="<!--{CSS_PATH}-->lanrenzhijia.css"  />
<script type="text/javascript" src="<!--{JS_PATH}-->jquery.min.js"></script>
<script type="text/javascript" src="<!--{JS_PATH}-->jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="<!--{JS_PATH}-->js.js" ></script>
<script type="text/javascript" src="<!--{JS_PATH}-->lanrenzhijia.js"></script>
<script type="text/javascript" src="<!--{JS_PATH}-->showdate.js"></script>
<script language="javascript">
function checksearch(){
	var keywords = document.getElementById('search_keywords').value;
	if( keywords ){
		window.location.href = "index.php?c=research&a=sosuo&keywords="+keywords;
	}
	else{
		alert("请输入关键词！");
		return false;
	}
}

</script>
</head>
<body>
<div class="sntop">
	<div class="snhead">
	<div class="snlogox"><img src="<!--{IMG_PATH}-->logosnx.png" /></div>
	<!--<div class="snlogo"><img src="<!--{IMG_PATH}-->snlogo.png" /></div>-->
	<div class="snnav">
		<div class="snnav1 clear">
        <div class="bjsjwz">北京时间：<script language="javascript">showDate()</script> <img src="<!--{IMG_PATH}-->snline.gif" style="vertical-align:middle" /></div><div class="sechbg"><input type="text" name="search_keywords" id="search_keywords" value="" placeholder="请输入关键字" type="text" class="serch" style="color:#aaa;" /><input type="image" src="<!--{IMG_PATH}-->sercbt.gif" onclick="javascript:checksearch();return false;" style="vertical-align:middle" /></div><div class="gwcbt"><img src="<!--{IMG_PATH}-->snline.gif" style="vertical-align:middle" /> <img src="<!--{IMG_PATH}-->gwcico.gif" style="vertical-align:middle" /> <a href="index.php?c=cart&a=cart_step1">购物车</a><img src="<!--{IMG_PATH}-->snline.gif" style="vertical-align:middle" /> EN &nbsp;&nbsp;中文<img src="<!--{IMG_PATH}-->snline.gif" style="vertical-align:middle" /></div><div class="clear"></div></div>
		<div id="nav">
      <ul class="c">
        <li id="100"><span class="v"><a href="index.php" >首页</a></span></li>
        <li id="101"><span class="v"><a href="index.php?c=introduce&a=aboutus" >走进双鸟</a></span></li>
        <li id="102"><span class="v"><a href="index.php?c=news&a=lists&cid=13" >新闻中心</a></span></li>
        <li id="103"><span class="v"><a href="index.php?c=products&a=lists" >产品信息</a></span></li>
        <li id="104"><span class="v"><a href="index.php?c=cases&a=lists&cid=4" >成功案例</a></span></li>
        <li id="105"><span class="v"><a href="index.php?c=research&a=lists&cid=16" >研修/培训</a></span></li>
        <li id="108"><span class="v"><a href="index.php?c=customer&a=login" >客户专区</a></span> </li>
				<li id="109"><span class="v"><a href="index.php?c=introduce&a=contactus" >联系我们</a></span> </li>
      </ul>
    </div>
    <script type="text/javascript" src="<!--{JS_PATH}-->nav.js"></script>    
	</div>
</div>
</div>
<div class="submenu">
	<div class="nav_menu">
      <ul>
      	<!--{cc:a_product action="get_navproductslist" cache="3600"}-->
        <!--{foreach $data $v}-->
        <li><a href="index.php?c=products&a=lists&cid=<!--{$v['gc_id']}-->" class="white"><!--{mb_substr($v['gc_name'],0,16)}--></a>
          <div class="ch_men">
            <div class="men_left">
              <dl>
								<dt class="h3"><!--{$v['gc_name']}--></dt>
								<!--{if !empty($v['goods_list'])}-->
								<!--{foreach $v['goods_list'] $vv}--> 
								<dd><a href="index.php?c=products&a=detail&id=<!--{$vv['goods_id']}-->" title="<!--{$vv['goods_name']}-->"><!--{mb_substr($vv['goods_name'],0,13)}--></a></dd>     	
								<!--{/foreach}--> 
								<!--{/if}-->               
              </dl>
            </div>
            <div class="men_right">
              <!--{if !empty($v['goods_list'])}-->
              <!--{php $i=0;}-->
							<!--{foreach $v['goods_list'] $vv}--> 
              <table width="100%" border="0" cellspacing="0" cellpadding="0" <!--{if $i != 0}-->style="display:none"<!--{/if}--> >
                <tr>
                  <td>
                  	<p class="h4"><!--{$vv['goods_name']}--></p>
                  	<!--{mb_substr(strip_tags($vv['goods_body']),0,150)}-->
										<span><img src="<!--{if !empty($vv['goods_image'])}--><!--{$vv['goods_image']}--><!--{else}--><!--{IMG_PATH}-->protb3.png<!--{/if}-->" border="0" width="230" height="230" /></span>
									</td>
                </tr>
              </table>
              <!--{php $i++;}-->
              <!--{/foreach}-->
							<!--{/if}-->
            </div>
          </div>
        </li>
       <!--{/foreach}-->
       <!--{/cc}-->
      </ul>
	</div>
</div>