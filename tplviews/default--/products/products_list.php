<!--{template 'index','header_bg',SITE_TEMP }-->
<script type="text/javascript">
/*<![CDATA[*/
var mileftnav = "mileftnav";
var isSekillOpen = 1;
var isCommentOpen = 1;
var default_word = "双鸟机械";
/*]]>*/
myLoad(103);
</script>
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
                    		<!--{cc:a_product action="get_navproductslist" cache="0"}-->
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
      <img src="<!--{IMG_PATH}-->weixin.jpg" border="0" class="fix contd_img" />
    </div>
    <div class="main_con_right">
			<div class="lxfsbot"><a href="index.php?c=introduce&a=contactus"><img src="<!--{IMG_PATH}-->confsbt.png" border="0" /></a></div>
      <div class="about_con">
      	<div class="pro_lbiao">
        	<ul>
        		<!--{foreach $list $v}-->
				 		<li>
              <div class="pro_lbtu">
                <table width="164" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="142"><a href="index.php?c=products&a=detail&id=<!--{$v['goods_id']}-->" title="<!--{$v['goods_name']}-->" target="_blank"> <img src="<!--{if !empty($v['goods_image'])}--><!--{$v['goods_image']}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" height="142" title="<!--{$v['goods_name']}-->" alt="<!--{$v['goods_name']}-->" /></a> </td>
                  </tr>
                </table>
              </div>
              <div class="pro_lbwenzi">
                <div class="pro_gduo2"> <span><a href="index.php?c=products&a=detail&id=<!--{$v['goods_id']}-->" title="<!--{$v['goods_name']}-->" target="_blank" class="white"><!--{mb_substr($v['goods_name'],0,16)}--></a></span>
                	<tt><a href="index.php?c=products&a=detail&id=<!--{$v['goods_id']}-->" title="<!--{$v['goods_name']}-->" target="_blank" class="grey2">产品详细>></a></tt></div>
                	<div class="pro_jshao"><p> <!--{mb_substr(strip_tags($v['goods_body']),0,150)}--></p></div>
              </div>
            </li>
						<!--{/foreach}--> 
				 </ul>   
                </div>


        <!--{$page}-->
      </div>
    </div>
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->

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

