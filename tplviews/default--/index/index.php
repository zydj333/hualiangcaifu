<!--{template 'index','header',SITE_TEMP }-->
<script type="text/javascript">
myLoad(100);
</script>

<div class="index_banner clearfix">
	<div class="index_banner2">
		<!--{cc:a_adv action="get_promotion_list" apid="1" cache="3600"}-->
		<ul> 
			<!--{foreach $data $value}-->
			<li><img src="<!--{BASE_URL}--><!--{$value['adv_content']['adv_pic']}-->" width="1440" height="400" /></li>
			<!--{/foreach}-->
		</ul>
		<!--{/cc}-->
	</div>
	<div class="hengtiao">
		<div class="htcen">
			<div class="shuzi">
      	<span class="current"></span><span></span><span></span><span></span><span></span>
      </div>
		</div>
  </div>
	<script src="<!--{JS_PATH}-->qiehuan1.js" type="text/javascript"></script>
</div>	

<div class="sygnys">
	<div class="snnewbg"><h3>新闻：&nbsp;<!--{cc:a_article action="get_article_index" cache="3600"}--><!--{foreach $data $v}--><a href="<!--{if !empty($v['article_url'])}--><!--{$v['article_url']}--><!--{else}-->index.php?c=news&a=detail&id=<!--{$v['article_id']}--><!--{/if}-->" class="white" target="_blank"><!--{mb_substr($v['article_title'],0,16)}--></a><!--{/foreach}--><!--{/cc}--></h3></div>
	<img src="<!--{IMG_PATH}-->sngnpic.png" width="1002" height="133" border="0" usemap="#Map"/>
	<map name="Map" id="Map">
		<area shape="rect" coords="28,85,113,112" href="index.php?c=cases&a=lists&cid=4" />
		<area shape="rect" coords="377,86,461,113" href="index.php?c=customer&a=login" />
		<area shape="rect" coords="884,96,997,137" href="index.php?c=news&a=lists&cid=13" />
	</map>
</div>

<div class="snmain clearfix">
	<div class="snsylf">
		<div class="sntopbg1">
	    <a href="index.php?c=news&a=lists&cid=13">MORE</a>
	    <span class="sp1">新闻中心</span> <span class="sp2">NEWS</span>
		</div>
		<div class="sncon clearfix">
			<!--{cc:a_article action="get_article_list" cache="3600"}-->
			<div class="snconpic"><img src="<!--{if !empty($data[0]['article_focus'])}--><!--{$data[0]['article_focus']}--><!--{else}--><!--{IMG_PATH}-->snewpic.jpg<!--{/if}-->" width="108" height="144" /></div>
			<div class="snconrg">
				
				<ul>
					<!--{foreach $data $v}-->
					<li><a href="<!--{if !empty($v['article_url'])}--><!--{$v['article_url']}--><!--{else}-->index.php?c=news&a=detail&id=<!--{$v['article_id']}--><!--{/if}-->" target="_blank"><!--{mb_substr($v['article_title'],0,16)}--></a></li>
					<!--{/foreach}-->
				</ul>
				
			</div>
			<!--{/cc}-->
		</div>
	</div>
<div class="snsyrg">
<div class="sntopbg2">
    <a href="index.php?c=products&a=lists">MORE</a>
    <span class="sp1">产品中心</span> <span class="sp2">Product Center</span>
</div>
<div class="rollBox clearfix">
	<div class="pipjt1"><img onMouseDown="ISL_GoDown()" onMouseUp="ISL_StopDown()" onMouseOut="ISL_StopDown()"  class="img1" src="<!--{IMG_PATH}-->proicon1.gif" width="7" height="13" /></div>
	<div class="pipcon">
    <div class="Cont" id="ISL_Cont">
      <div class="ScrCont">
      	<!--{cc:a_product action="get_indexproducts" cache="1=0"}-->
       <div id="List1">
        <!-- 图片列表 begin -->
        <!--{foreach $data $v}-->
				<div class="pic"><a href="index.php?c=products&a=detail&id=<!--{$v['goods_id']}-->"><img src="<!--{if $v['goods_image']}--><!--{BASE_URL}--><!--{$v['goods_image']}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->" width="135" height="125"/></a><br /><a href="index.php?c=products&a=detail&id=<!--{$v['goods_id']}-->"><!--{mb_substr($v['goods_name'],0,10)}--></a></div>
		  	<!--{/foreach}-->
       	<!-- 图片列表 end -->
       </div>
       <!--{/cc}-->
       <div id="List2"></div>
      </div>
     </div>
	 </div>
		<div class="pipjt2"><img  onmousedown="ISL_GoUp()" onMouseUp="ISL_StopUp()" onMouseOut="ISL_StopUp()"  class="img2" src="<!--{IMG_PATH}-->proicon2.gif" width="7" height="13" /></div>
    </div>
</div>
</div>
<script language="javascript" type="text/javascript">
<!--//--><![CDATA[//><!--
//图片滚动列表 mengjia 070816
var Speed = 5; //速度(毫秒)
var Space = 10; //每次移动(px)
var PageWidth = 149; //翻页宽度
var fill = 0; //整体移位
var MoveLock = false;
var MoveTimeObj;
var Comp = 0;
var AutoPlayObj = null;
GetObj("List2").innerHTML = GetObj("List1").innerHTML;
GetObj('ISL_Cont').scrollLeft = fill;
GetObj("ISL_Cont").onmouseover = function(){clearInterval(AutoPlayObj);}
GetObj("ISL_Cont").onmouseout = function(){AutoPlay();}
AutoPlay();
function GetObj(objName){if(document.getElementById){return eval('document.getElementById("'+objName+'")')}else{return eval

('document.all.'+objName)}}
function AutoPlay(){ //自动滚动
clearInterval(AutoPlayObj);
AutoPlayObj = setInterval('ISL_GoDown();ISL_StopDown();',5000); //间隔时间
}
function ISL_GoUp(){ //上翻开始
if(MoveLock) return;
clearInterval(AutoPlayObj);
MoveLock = true;
MoveTimeObj = setInterval('ISL_ScrUp();',Speed);
}
function ISL_StopUp(){ //上翻停止
clearInterval(MoveTimeObj);
if(GetObj('ISL_Cont').scrollLeft % PageWidth - fill != 0){
Comp = fill - (GetObj('ISL_Cont').scrollLeft % PageWidth);
CompScr();
}else{
MoveLock = false;
}
AutoPlay();
}
function ISL_ScrUp(){ //上翻动作
if(GetObj('ISL_Cont').scrollLeft <= 0){GetObj('ISL_Cont').scrollLeft = GetObj

('ISL_Cont').scrollLeft + GetObj('List1').offsetWidth}
GetObj('ISL_Cont').scrollLeft -= Space ;
}
function ISL_GoDown(){ //下翻
clearInterval(MoveTimeObj);
if(MoveLock) return;
clearInterval(AutoPlayObj);
MoveLock = true;
ISL_ScrDown();
MoveTimeObj = setInterval('ISL_ScrDown()',Speed);
}
function ISL_StopDown(){ //下翻停止
clearInterval(MoveTimeObj);
if(GetObj('ISL_Cont').scrollLeft % PageWidth - fill != 0 ){
Comp = PageWidth - GetObj('ISL_Cont').scrollLeft % PageWidth + fill;
CompScr();
}else{
MoveLock = false;
}
AutoPlay();
}
function ISL_ScrDown(){ //下翻动作
if(GetObj('ISL_Cont').scrollLeft >= GetObj('List1').scrollWidth){GetObj('ISL_Cont').scrollLeft =

GetObj('ISL_Cont').scrollLeft - GetObj('List1').scrollWidth;}
GetObj('ISL_Cont').scrollLeft += Space ;
}
function CompScr(){
var num;
if(Comp == 0){MoveLock = false;return;}
if(Comp < 0){ //上翻
if(Comp < -Space){
   Comp += Space;
   num = Space;
}else{
   num = -Comp;
   Comp = 0;
}
GetObj('ISL_Cont').scrollLeft -= num;
setTimeout('CompScr()',Speed);
}else{ //下翻
if(Comp > Space){
   Comp -= Space;
   num = Space;
}else{
   num = Comp;
   Comp = 0;
}
GetObj('ISL_Cont').scrollLeft += num;
setTimeout('CompScr()',Speed);
}
}
//--><!]]>
</script>

<!--{template 'index','footer',SITE_TEMP }-->

