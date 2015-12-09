<!--{template 'index','header',SITE_TEMP }-->
<style type="text/css">
body{ background:#fff;}
.mask{margin:0;padding:0;border:none;width:100%;height:100%;background:url(<!--{IMG_PATH}-->bg.png);z-index:9999;position:fixed;top:0;left:0;display:none;}
#LoginBox{position:absolute;left:30%;top:500px;background:white;width:520px;height:510px;   border-radius:15px;   border:5px solid #009966; z-index:10000;display:none;}
.jdbox {position: absolute;background:#efefef;left:10px;top:30px;display:none;width: 520px;z-index:9999;height: 300px;}
.jdbox td {text-align: left;border:1px solid #ccc;}
.fx {margin: 0px auto;}
.fx td {border: 1px solid #ccc;padding:3px;}
.close_btn{font-family:arial;font-size:30px;font-weight:700;color:#999;text-decoration:none;float:right;padding-right:4px;}
</style>
<div id="LoginBox"  >
	<div class="row1" style="height:30px; line-height:30px;">
		<a href="javascript:void(0)" title="关闭窗口" class="close_btn" id="closeBtn">×</a>
	</div>
	<div class="contents"></div>
</div>
<!--login-->
<script language="javascript">
var parttenmob = /^1[3,5,8]\d{9}$/;
var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

function checkform()
{
	var loginname = document.getElementById("loginname").value;
	var loginpsd = document.getElementById("loginpsd").value;
	var msg = "";

	if(loginname.length == 0)
  {
    msg += '请输入手机号码!\n';
  }else if(!parttenmob.test(loginname)){
  	msg += '请输入正确的手机号码!\n';
  }
  
  if(loginpsd.length == 0)
  {
    msg += '请输入登录密码!\n';
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
<div class="login"   style="display:none" >
    <div class="login_body">
  
        <h3>理财师登录窗口</h3>
        <a href="index.php?c=customer&a=login" class="loginbar"></a>
        <a href="index.php?c=customer&a=register" class="regbar"></a>    
      </div>

</div>
<!--<div class="login">-->
				<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
				<div class="login_body">
        <h3>会员中心</h3>
        <p><b style="line-height:35px;"> 您好，<?php echo $this->session->userdata['member_truename']; ?> 欢迎登录!<br> 这里是理财师的一站式服务平台</b></p>
        <div>
            <a href="index.php?c=products&a=lists" class="proCenter" style="width:80px; float:left">产品中心</a>   
                  <a href="index.php?m=member&c=user&a=index" class="proCenter" style="width:80px; margin-left:15px;float:right" title="壹财富会员中心">会员中心</a>  
            <a href="index.php?c=customer&a=logout" class="memCenter">安全退出</a>   
				</div>
     
    		</div>
				<!--{else}-->
        <div class="login_body">
                <h5>
                <font>快速登录</font>   
                <a href="index.php?c=customer&a=register" class="login_new_reg" title="华良财富注册新账户">注册新账户</a>
                </h5>
                <!--newform-->
                <form action="index.php?c=customer&a=login" method="post" onsubmit="return checkform();" >
  							<input type="hidden" name="dosubmit" value="1">
                <ul>
                    <li>
                       <label>手机</label>
                        <input name="loginname" type="text" id="loginname" class="linput" />
                    </li>
                    <li>
                        <label>密码</label>
                       <input name="loginpsd" type="password" id="loginpsd" class="linput" />
                    </li>
                     <b id="error"></b>
                </ul>
              
                <strong class="login_new_an">
                	<input type="submit" name="loginbt" value="" id="loginbt" class="login_new_btn" />
                </strong>
                </form>
                <div>
                    <a href="index.php?c=customer&a=forget_password" class="login_new_pass">忘记密码？</a>
                </div>   
            </div>
            <!--{/if}-->
<!--</div>-->



<!--login end-->
<!--banner-->

<div class="flexslider" style="height:345px;">
	<ul class="slides" style="height:345px;">
			<!--{cc:a_adv action="get_promotion_list" apid="1" cache="3600"}-->
			<!--{foreach $data $value}-->
	    <li style="background: url(<!--{BASE_URL}--><!--{$value['adv_content']['adv_pic']}-->) 50% 0 no-repeat;"  title="<!--{$value['adv_title']}-->"><a class="tlink" href="<!--{$value['adv_content']['adv_pic_url']}-->"></a></li>
      <!--{/foreach}-->
      <!--{/cc}-->
	</ul>
</div>
<!--banner end-->
<!--feature-->
<div class="ys_bg">
    <div class="ys">
        <div class="ys_1">
            <h2 title="产品多-华良财富">产品多&nbsp;&nbsp;&nbsp;&nbsp;尽情挑选</h2>
            <p style=" font-weight:normal;">不同收益期限，付息方式，类型，地域，<font>100</font>余款产品满足客户多样化需求</p>
        </div>
        <div class="ys_2">
            <h2 title="佣金高-华良财富">佣金高&nbsp;&nbsp;&nbsp;&nbsp;欢迎比价</h2>
            <p style=" font-weight:normal;">高出市场价千<font>8</font>以上的佣金<br />
            使理财师及客户的利益最大化</p>
        </div>
        <div class="ys_3">
            <h2  title="结款快-华良财富">结款快&nbsp;&nbsp;&nbsp;&nbsp;安全保障</h2>
            <p style=" font-weight:normal;">数千万资金储备，成立<font>24</font>小时内快速现结保障理财师及客户的切身利益</p>
        </div>
    </div>
</div>
<!--feature end-->
        
        <!--#########################-->
        <div id="cptab" style="margin-bottom:20px;">
    <h2 class="index_cp_title">
        <b>
            <ul>
                <li class="lixz">信托产品</li>
                <li>资管产品</li>
            </ul>
        </b>
        <a href="index.php?c=products&a=lists">更多</a>
    </h2>
    <!--信托-->
    <div class="divxz">
        <table class="index_cp_table" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                  <th width="23%">产品名称</th>
          
                <th width="6%">期限</th>
                <th width="11%">年化收益</th>
                 <th width="11%">费用区间</th>
                <th width="8%">付息方式</th>
                <th width="7%">投资领域</th>
                <th width="7%">发行方案</th>
                <th width="21%">募集进度</th>
                <th width="6%">预约</th>
            </tr>
						<!--{cc:a_caifu action="get_product_index" cid="1" cache="3600"}-->
						<!--{foreach $data $v}-->
           	<tr>
            	<td width="21%"><a href="index.php?c=products&a=detail&id=<!--{$v['id']}-->"  class="index_cp_name"><!--{mb_substr($v['name'],0,15)}--></a></td>
							<td width="6%" style="text-align:center"><span class="ft"><!--{$v['lifetime']}--></span>个月</td>
            	<td width="11%" style="text-align:center"  ><span><!--{$v['yield_year']}--></span></td>
            	<td width="11%" style="text-align:center">
            		<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
								<!--{$v['fee_scale']}-->
								<!--{else}-->
								<a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >登录可见</a>
								<!--{/if}-->
							</td>
            	<td width="8%" style="text-align:center"><!--{$v['interest_name']}--></td>
            	<td width="7%" style="text-align:center"><!--{$v['investment_name']}--></td>
            	<td width="7%" style="text-align:center; border:0; border-bottom:1px solid #efefef; " >
								<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
								<a href="javascript:void(0)" class="index_cp_look jd"  style="width:60px;"  id="<!--{$v['id']}-->">查看</a>
								<!--{else}-->
								<a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >查看</a>
								<!--{/if}-->
              </td>
              <td width="21%"><p><!--{mb_substr($v['progress'],0,70)}--></p></td>
              <td width="6%"><a href="index.php?c=products&a=detail&id=<!--{$v['id']}-->" class="index_cp_yue" title="预约"></a></td>
            </tr>
            <!--{/foreach}-->
          	<!--{/cc}-->
        </table>


    </div>
    <!--资管-->
    <div class="div">
        <table class="index_cp_table" width="100%" cellpadding="0" cellspacing="0">
             <tr>
                   <th width="23%">产品名称</th>
          
                <th width="6%">期限</th>
                <th width="11%">年化收益</th>
                 <th width="11%">费用区间</th>
                <th width="8%">付息方式</th>
                <th width="7%">投资领域</th>
                <th width="7%">发行方案</th>
                <th width="21%">募集进度</th>
                <th width="6%">预约</th>
            </tr>
            <!--{cc:a_caifu action="get_product_index" cid="2" cache="3600"}-->
						<!--{foreach $data $v}-->
           	<tr>
            	<td width="21%"><a href="index.php?c=products&a=detail&id=<!--{$v['id']}-->"  class="index_cp_name"><!--{mb_substr($v['name'],0,15)}--></a></td>
							<td width="6%" style="text-align:center"><span class="ft"><!--{$v['lifetime']}--></span>个月</td>
            	<td width="11%" style="text-align:center"  ><span><!--{$v['yield_year']}--></span></td>
            	<td width="11%" style="text-align:center">
            		<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
								<!--{$v['fee_scale']}-->
								<!--{else}-->
								<a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >登录可见</a>
								<!--{/if}-->
							</td>
            	<td width="8%" style="text-align:center"><!--{$v['interest_name']}--></td>
            	<td width="7%" style="text-align:center"><!--{$v['investment_name']}--></td>
            	<td width="7%" style="text-align:center; border:0; border-bottom:1px solid #efefef; " >
								<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
								<a href="javascript:void(0)" class="index_cp_look jd"  style="width:60px;"  id="<!--{$v['id']}-->">查看</a>
								<!--{else}-->
								<a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >查看</a>
								<!--{/if}-->
              </td>
              <td width="21%"><p><!--{mb_substr($v['progress'],0,70)}--></p></td>
              <td width="6%"><a href="index.php?c=products&a=detail&id=<!--{$v['id']}-->" class="index_cp_yue" title="预约"></a></td>
            </tr>
            <!--{/foreach}-->
          	<!--{/cc}-->
        </table>

    </div>
</div>
<script type="text/javascript">
    function chageSelect(nIndex) {
        var oLis = document.getElementById("cptab").getElementsByTagName("li");
        var oDivs = document.getElementById("cptab").getElementsByTagName("div");
        for (var i = 0; i < oLis.length; i++) {
            oLis.item(i).className = null;
            oDivs.item(i).className = null;
        }
        oLis.item(nIndex).className = "lixz";
        oDivs.item(nIndex).className = "divxz";
    }

    var oLis = document.getElementById("cptab").getElementsByTagName("li");
    oLis.item(0).onclick = function () { chageSelect(0); }
    oLis.item(1).onclick = function () { chageSelect(1); }
</script>


        <!--#########################-->
<div class="index_main">
    <div class="index_news">
        <h2>
            <b>信托快报</b>
            <a href="index.php?c=news&a=lists&cid=1" title="信托快报-华良财富">更多</a>
        </h2>
        <ul>
					<!--{cc:a_article action="get_article_list" cid="1" cache="3600"}-->
					<!--{foreach $data $v}-->
        	<li>
          	<a href="<!--{if !empty($v['article_url'])}--><!--{$v['article_url']}--><!--{else}-->index.php?c=news&a=detail&id=<!--{$v['article_id']}--><!--{/if}-->"><!--{mb_substr($v['article_title'],0,30)}--></a>
          	<span style=" font-weight:normal;"><!--{date('Y/m/d', $v['article_time'])}--></span>
          </li>
          <!--{/foreach}-->
          <!--{/cc}-->      
        </ul>
    </div>
    <div class="index_news index_help">
        <h2>
            <b>新手帮助</b>
            <a href="index.php?c=news&a=lists&cid=2" title="信托快报-华良财富">更多</a>
        </h2>
        <ul>
            <!--{cc:a_article action="get_article_list" cid="2" cache="3600"}-->
					<!--{foreach $data $v}-->
        	<li>
          	<a href="<!--{if !empty($v['article_url'])}--><!--{$v['article_url']}--><!--{else}-->index.php?c=news&a=detail&id=<!--{$v['article_id']}--><!--{/if}-->"><!--{mb_substr($v['article_title'],0,30)}--></a>
          	<span style=" font-weight:normal;"><!--{date('Y/m/d', $v['article_time'])}--></span>
          </li>
          <!--{/foreach}-->
          <!--{/cc}-->
                
        </ul>
    </div>
</div>


<!--footer-->
<!--{template 'index','footer',SITE_TEMP }-->


        

