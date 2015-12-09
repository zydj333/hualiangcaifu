<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><!--{$goods_info['goods_name']}--></title>
<meta name="keywords" content="双鸟机械">
<meta name="description" content="双鸟机械">
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<link href="<!--{CSS_PATH}-->master.css" rel="stylesheet" type="text/css" />
<link href="<!--{CSS_PATH}-->productView.css" rel="stylesheet" type="text/css" />
<link href="<!--{CSS_PATH}-->products.css" rel="stylesheet" type="text/css" />
<script src="<!--{JS_PATH}-->jquery.min.js" type="text/javascript"></script>
<script src="<!--{JS_PATH}-->jquery18.js" type="text/javascript"></script>
<script src="<!--{JS_PATH}-->jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="<!--{JS_PATH}-->js.js" type="text/javascript"></script>
<script src="<!--{JS_PATH}-->jquery.fn.TabBox.js" type="text/javascript"></script>
<script src="<!--{JS_PATH}-->jquery.js" type="text/javascript"></script>
<script src="<!--{JS_PATH}-->sn_lazyload.js" type="text/javascript"></script>
<script src="<!--{JS_PATH}-->showdate.js" type="text/javascript"></script>
<script type="text/javascript">
/*<![CDATA[*/
var mileftnav = "mileftnav";
var isSekillOpen = 1;
var isCommentOpen = 1;
var default_word = "";
/*]]>*/
</script>
<script type="text/javascript">
var sn=sn||{"imageVisitUrl":'',"zrDomain":'',"snShopMainPh":'',"field5":'',"currPrice":'',"catentryId":'',"shopImageDomain":'',"snMainPh":'',"imageHost":'',"productHostDomain":'',"elecProductDomain":'',"context":'',"domain":'',"storeId":'',"catalogId":'',"newCatalogId":'',"typeFlg":'',"productType":'',"memberDomain":'',"cartPath":"","imageDomianDir":"","scriptDomianDir":"","reviewPath":'',"adId":'',"online":'',"conline":'',"cookieDomain":'',"langId":"-7","productId":"","partNumber":"","SPIKE_HOST":"","cityId":"","searchDomain" : '',"elecProductDomain":'',"qiangDomain":'',"tuijianDomain":'',"preBuyDomain":'', "brandDomain":''};
function d(b) { var a; return (a = document.cookie.match(RegExp("(^| )" + b + "=([^;]*)(;|$)"))) ? decodeURIComponent(a[2].replace(/\+/g, "%20")): null}
</script>
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

function checkform(){
	var prod_message = document.getElementById("prod_message").value;
	var msg = "";

	if(prod_message.length == 0)
  {
    msg += '请输入你要咨询的内容!';
  }
  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}
</script>
</head>
<body>
<div class="sntop">
<div class="snhead">
<div class="snlogox"><img src="<!--{IMG_PATH}-->logosnx.png" /></div>
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
	<script type="text/javascript">
	myLoad(103);
	</script>
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

<div class="index_banner clearfix">
	<div class="index_banner2">
		<ul>                    
									<!--{cc:a_adv action="get_promotion_single" apid="13" cache="3600"}-->
									<!--{foreach $data $val}-->
									 <!--{if $val['adv_content']['adv_pic']}-->                   
                    <li><img src="<!--{BASE_URL}--><!--{$val['adv_content']['adv_pic']}-->" /></li>
                    <!--{/if}-->
                  <!--{/foreach}-->
									<!--{/cc}-->
		</ul>
	</div>
</div>	

<div class="main_body clearfix">
<div class="mntopbg"><span class="info_navzi2">产品信息</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=products&a=lists" class="grey">产品信息</a> > <span class="font_red">产品信息</span></div></div>

  <div class="main_con clearfix">
    <div class="main_con_left"> <img src="<!--{IMG_PATH}-->left_img.png" class="font_size fix div_block" /> <img src="<!--{IMG_PATH}-->news_img3.jpg" class="font_size fix div_block" />
         <div id="showlist" class="showlist" style="display:none">
                    <ul id="showlistUL" class="lists">
                    		<!--{cc:a_product action="get_subproductslist" cache="3600"}-->
                    		<!--{foreach $data $v}-->
                        <li>
                            <a class="tit" href="index.php?c=products&a=lists&cid=<!--{$v['gc_id']}-->"><!--{mb_substr($v['gc_name'],0,16)}--></a>
                            <!--{if !empty($v['goods_list'])}-->
														<em class="icon-common icon-common-arrowright"></em>
                            <label class="tri"><i></i></label>
                            <div class="show clearfix" style="display:none;">
                                <div class="lt">
                                    <dl class="firstdl">
                                    		<!--{foreach $v['goods_list'] $vv}--> 
                                    		<dd><a href="index.php?c=products&a=detail&id=<!--{$vv['goods_id']}-->"><img src="<!--{if !empty($vv['goods_image'])}--><!--{$vv['goods_image']}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" style="vertical-align:middle;"><!--{$vv['goods_name']}--></a></dd>
                                    		<!--{/foreach}-->
                                    </dl>
                                </div>
                            </div>
                            <!--{/if}-->
                        </li>
                        <!--{/foreach}-->
                        <!--{/cc}-->
                    </ul>
                </div>
				
				  
      <img src="<!--{IMG_PATH}-->left_img_bottom.png" class="font_size fix div_block" />
      <img src="<!--{IMG_PATH}-->cont.jpg" border="0" class="fix contd_img" />
    </div>
    
    <div class="main_con_right">
	<div class="lxfsbot"><a href="index.php?c=introduce&a=contactus"><img src="<!--{IMG_PATH}-->confsbt.png" border="0" /></a></div>
      <div class="about_con">
  
  <div class="prodtail clearfix" id="product_main">
		<div class="product-summary fix">
			<div class="product-info-box">
				<div class="product-main-title"><h1 class="wb" title="<!--{$goods_info['goods_name']}-->"><!--{$goods_info['goods_name']}--></h1></div>
				<div class="jxprojg">
					<input type="hidden" name="real_tonsid" id="real_tonsid" value="">
					<input type="hidden" name="real_miid" id="real_miid" value="">
					<input type="hidden" name="real_mishu" id="real_mishu" value="">
					<input type="hidden" name="goodsid" id="goodsid" value="<!--{$goods_info['goods_id']}-->">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr><td height="10"></td></tr>
						<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
						<tr><td width="85" align="right" class="jgbtwz" height="26">行业价：</td><td class="jgwz1">¥<span id="show_hyprice"><!--{$goods_info['goods_shop_price_interval']}--></span></td></tr>
						<tr><td height="10"></td></tr>
						<tr><td align="right" class="jgbtwz" height="26">经销商价格：</td><td class="jgwz2">¥<span id="show_jxsprice"><!--{$goods_info['goods_shop_price_interval']}--></span></td></tr>
						<tr><td height="10"></td></tr>
						<!--{else}-->
						<tr><td width="85" align="right" class="jgbtwz" height="26">行业价：</td><td class="jgwz2">¥<span id="show_hyprice"><!--{$goods_info['goods_shop_price_interval']}--></span></td></tr>
						<tr><td height="10"></td></tr>
						<!--{/if}-->
						<!--{if !empty($tons_list)}-->
						<tr><td align="right" class="jgbtwz" height="26">吨位：</td><td><strong><span class="dwinp" id="show_tons"/></span></strong>&nbsp;&nbsp;&nbsp;<!--{if !empty($spec_list)}-->米数：<strong><span id="show_mi" class="dwinp" /></span></strong><!--{/if}--><!--{if $goods_info['isjiajia']}-->&nbsp;<input name="addonemishu" id="addonemishu" type="button" value="加一米" class="jymbot" onclick="javascript:addonemishu();" /><!--{/if}--></td></tr>
						<tr><td height="15"></td></tr>
						<!--{/if}-->
						<!--{if !empty($tons_list)}-->
						<tr>
							<td align="right" class="jgbtwz" height="26" rowspan="2">吨位：</td>
							<td class="dwfk">
								<!--{foreach $tons_list $vv}-->
								<a id="tons_spec<!--{$vv['id']}-->" href="javascript:changetons('<!--{$vv['id']}-->');" ><!--{$vv['prod_spec']}--></a>
	  						<!--{/foreach}-->
							</td>
						</tr>
						<tr><td height="15"></td></tr>
						<!--{/if}-->
						<!--{if !empty($spec_list)}-->
						<tr>
							<td align="right" class="jgbtwz" height="26">米数：</td>
							<td class="dwfk2">
								<!--{foreach $spec_list $kk}-->
								<a id="mi_spec<!--{$kk['id']}-->" href="javascript:changemi(<!--{$kk['id']}-->,<!--{$kk['name']}-->);" ><!--{$kk['name']}-->m</a>
								<!--{/foreach}-->
							</td>
						</tr>
						<tr><td height="15"></td></tr>
						<!--{/if}-->
						<tr><td align="right" class="jgbtwz" height="26">数量：</td><td><a href="javascript:numdecrease();" class="tb-iconfont">-</a> <input id="gouwuche_num" name="gouwuche_num" type="text" class="tb-text" value="1" title="请输入购买量" onblur="javascript:numchange();" /> <a href="javascript:numincrease();" class="tb-iconfont ">+</a></td></tr>
						<tr><td height="20"></td></tr>
						<tr><td></td><td><input name="a" type="button" value="加入购物车" class="bjbotton1" onclick="javascript:addtocart(<!--{$goods_info['goods_id']}-->);"/></td></tr>
					</table>
					<script src="<!--{JS_PATH}-->shop.js" type="text/javascript"></script>
				</div>
			</div>
		</div>

<div class="product-gallery">
<div class="product-preview-box pr">

<div class="product-preview" id="PicView">
<a id="bigImg" href="javascript:SNProduct.imgBoxAct('open');" class="view-img" name="prd_4700851_sppic_bigpic01">
<img src="<!--{if $goods_image_more_list[0]}--><!--{BASE_URL}--><!--{$goods_image_more_list[0]}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" data-src="<!--{if $goods_image_more_list[0]}--><!--{BASE_URL}--><!--{$goods_image_more_list[0]}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" alt="图片说明" />
</a>
</div>

</div>
<div class="product-thumbnai" id="preView_box">
<div class="thumbnai-box">
	<ul class="fix">
	<!--{php $i=0;}-->
	<!--{foreach $goods_image_more_list $goods_image_more_value}-->
		<!--{if !empty($goods_image_more_value)}-->
		<li <!--{if $i == 0}-->class="cur"<!--{/if}--> ><img src="<!--{BASE_URL}--><!--{$goods_image_more_value}-->" src3="<!--{BASE_URL}--><!--{$goods_image_more_value}-->" alt=""></li>
		<!--{/if}-->
		<!--{php $i++;}-->
		<!--{/foreach}-->
</ul>
</div>
<p class="ctrl-btn prev"><a name="prd_4700851_sppic_picup01" href="javascript:;" title="上一张" class="false">上一张</a></p>
<p class="ctrl-btn next"><a name="prd_4700851_sppic_picdown01" href="javascript:;" title="下一张">下一张</a></p>
</div>

</div>
<div class="clear"></div>
</div>
           
<div class="proInfo">
				<ul class="Tab2"><li class="focus" onclick="fnTabBoxSlide(this,2,5);">产品介绍</li><li onclick="fnTabBoxSlide(this,2,7);">咨询留言
</li></ul>
				<div class="Box2">
					<div id="TabShow5" class="TabHide2">
						<div class="info">
							<p><!--{$goods_info['goods_body']}--></p>
						</div>
					</div>					
				  <div id="TabShow7" class="TabHide2" style="display:none;">
          	<div class="zxly">
          		<form action="index.php?c=products&a=prodmsg" method="post" onsubmit="return checkform();" >
    					<input type="hidden" name="dosubmit" value="ok">
    					<input type="hidden" name="dogoodsid" value="<!--{$goods_info['goods_id']}-->">
			   			<div class="zxsous">购买前可先咨询，方便又快捷：<input  name="prod_message" id="prod_message" placeholder="请输入咨询关键词" value="" type="text" class="zxinp"/> &nbsp;<input name="submitmsg" type="submit" value="提交" class="zxserch" /></div>
			   			</form>
			   				<ul>
			   					<!--{foreach $listmsg $v}-->
			   					<li>
			   						<p class="grey">网&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;友：<!--{$v['cmember_name']}-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--{date('Y-m-d H:m:s', $v['consult_addtime'])}--></p>
			   						<p class="">咨询内容：<!--{$v['consult_content']}--></p>
			   						<!--{if $v['consult_reply']}-->
			   						<div class="clearfix snhf"><h3>双鸟回复：<!--{$v['consult_reply']}--></h3><span><!--{date('Y-m-d H:m:s', $v['consult_reply_time'])}--></span></div>
			   						<!--{/if}-->
			   					</li>
			   					<!--{/foreach}-->
                  <!--{/cc}-->
			   </ul>
			   </div>
			   </div>					
				</div>
			</div>


   
      </div>
    </div>
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->


 <!-- S 列表导航 -->
                
    <!-- E 列表导航 -->
     <script type="text/javascript" src="<!--{JS_PATH}-->categoryTree.js"></script>
    <script type="text/javascript" src="<!--{JS_PATH}-->base.min.js"></script>
    <script type="text/javascript">
	XIAOMI.namespace("GLOBAL_CONFIG,GLOBAL_VAR");
	XIAOMI.GLOBAL_CONFIG = {
    orderSite:"",
    wwwSite:"",            
    logoutUrl:"",
    quickLoginUrl:""
	}
	XIAOMI.app.setLoginInfo.orderUrl = XIAOMI.GLOBAL_CONFIG.logoutUrl;
	XIAOMI.app.setLoginInfo.init();
	XIAOMI.app.header.init();   
</script>
	<script language="javascript" src="<!--{JS_PATH}-->products.js"></script>
<script language="javascript" src="<!--{JS_PATH}-->productLib.js"></script>

