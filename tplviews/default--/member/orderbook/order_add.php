<!--{template 'index','header_user',SITE_TEMP }-->
<script type="text/javascript">
myLoad(108);
</script>
<div class="member_banner clearfix">

</div>	
<script type="text/javascript" src="<!--{JS_PATH}-->orderbook.js"></script>
<script type="text/javascript" src="<!--{JS_PATH}-->shop.js"></script>
<script language="javascript">
var parttenmob = /^1[3,5,8]\d{9}$/;
var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

function checkform()
{
	var stand_mishu = document.getElementById("spec_ku_smishu").value;
	var selprod = document.getElementById("selprod").value;
	var seltons = document.getElementById("seltons").value;
//	var addressids = document.getElementsByName("address_id");
	var add_mishu = document.getElementById("add_mishu").value;
	var add_numbs = document.getElementById("add_numbs").value;
	var msg = "";
	var addressid_tag = 0;
	
 	
	if(selprod.length == 0){
		alert("请选择产品!");
		return false;
	}
	if(seltons.length == 0){
		alert("请选择产品规格!");
		return false;
	}
//	for(var i=0;i < addressids.length;i++){
//  	if(addressids[i].checked == true){
//   		addressid_tag = 1;
//  	}
// 	}
// 	if(addressid_tag == 0){
// 		alert("请选择收获地址！");
// 		return false;
// 	}
//	if(stand_mishu)
//  {
//  	if(parseFloat(add_mishu) < parseFloat(stand_mishu)){
//    	msg += '您订购的米数不能小于标准米数!\n';
//  	}
//  }
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
<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">产品下单</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?m=member&c=user&a=index" class="grey">客户专区</a> > <span class="font_red">产品下单</span></div></div>
		  
  <div class="main_con clearfix">
  <div class="pencet clearfix">
  	<!--{template 'index','user_left',SITE_TEMP }-->
  <div class="pencetr">
  <div class="snpclines clearfix">
  <div class="pclf1"><img src="<!--{if !empty($userInfo['head_ico'])}--><!--{$userInfo['head_ico']}--><!--{else}-->statics/default/images/head_ico.gif<!--{/if}-->" width="103" height="81" /><span>您好，<font style="color:#e4393c; font-size:18px;"><b><?php echo $this->session->userdata['member_username']; ?></b></font>&nbsp;&nbsp;[<a href="index.php?c=customer&a=logout" class="purple">退出</a>]<br />欢迎登录双鸟机械官网！<br />会员等级：<!--{if !empty($groupInfo['groupname'])}--><!--{$groupInfo['groupname']}--><!--{else}-->暂无级别<!--{/if}--></span></div>
  <div class="pclf2">账户余额：<br /><font style="color:#e4393c; font-size:18px;"><b><!--{$userInfo['available_predeposit']}--></b></font> 元</div>
  <div class="pclf2">信用额度：<br /><font style="color:#e4393c; font-size:18px;"><b><!--{$userInfo['freeze_predeposit']}--></b></font> 元</div>
  </div>
  
  <div class="dindan">
  	<div class="dindtop"><h3 style="float:left; width:200px; font-size:14px; color:#666666;">产品下单<span id="spec_info"></span></h3></div>
		<div class="pcadd">
			<form action="" method="post" onsubmit="return checkform();" >
  		<input type="hidden" name="dosubmit" value="ok">
  		<input type="hidden" name="spec_ku_tonsid" id="spec_ku_tonsid" value="">
  		<input type="hidden" name="spec_ku_tons" id="spec_ku_tons" value="">
  		<input type="hidden" name="spec_ku_smishu" id="spec_ku_smishu" value="">
  		<input type="hidden" name="spec_ku_sprice" id="spec_ku_sprice" value="">
  		<input type="hidden" name="spec_ku_sjiacha" id="spec_ku_sjiacha" value="">
			<table width="98%" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#dddddd" align="center">
							<tr>
								<th width="100" align="right" height="28">产品名称：</th>
								<td>
									
									<select name="selcate" id="selcate" style="width:150px;" size="10">
										
										<!--{foreach $goods_cate $val}-->
										<option value="<!--{$val['gc_id']}-->"><!--{$val['gc_name']}--></option>
										<!--{/foreach}-->
									</select>
									<select name="selprod" id="selprod" style="width:200px;" size="10">
									
									</select>
									<select name="seltons" id="seltons" style="width:200px;" size="10">
									
									</select>
								</td>
							</tr>
							<!--
							<tr>
								<th algin="right" height="28">收货地址:</th>
								<td>
									
									<input type="radio" name="address_id" id="address_id--$val['address_id']--" value="---{$val['address_id']}---"><label for="address_id---{$val['address_id']}---">---{$val['area_info']}--- ----{$val['address']}---- (----{$val['true_name']}---- 收) <em>---{$val['mob_phone']}---</em></label><br>
									
								</td>
							</tr>-->
							<tr id="spec_mishu_show" style="display:none;">
								<th align="right" height="28">米数：</th>
								<td><input name="add_mishu" id="add_mishu" type="text" value="" class="khinput2" style="width:100px;" /></td>
							</tr>
							<tr>
								<th align="right" height="28">数量：</th>
								<td><input name="add_numbs" id="add_numbs" type="text" value="1" onblur="javascript:numchange2();" class="khinput2" style="width:100px;" /></td>
							</tr>
							<!--
							<tr>
								<th align="right" height="28">备注说明：</th>
								<td><input name="add_comment" id="add_comment" type="text" value="" class="khinput2" style="width:300px;" /></td>
							</tr>-->
						</table>
					</td>
				</tr>
				<tr><td height="20"></td></tr>
				<tr><td align="center"><input class="tjsmzc" type="submit" value=""></td></tr>
			</table>
			</form>
		</div>
  </div>
  
  </div>  
  </div>
  <div class="ddlfbg"></div>  
  <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>




<!--{template 'index','footer',SITE_TEMP }-->