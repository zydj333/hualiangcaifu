<!--{template 'index','header',SITE_TEMP }-->
<style>
body{ background:#FFF;}
.mask{margin:0;padding:0;border:none;width:100%;height:100%; background:url(<!--{IMG_PATH}-->bg.png); z-index:9999;position:fixed;top:0;left:0;display:none;}
#LoginBox{position:absolute;left:40%;top:500px;background:white;width:320px;height:140px;   border-radius:15px;   border:5px solid #009966; z-index:10000;display:none;}
.jdbox {position: absolute;background:#efefef;left:10px;top:30px;display:none;width: 520px;z-index:9999;height: 300px;}
.fs {width:100px; height:30px; background:#009966; color:#fff; border:0;}
.inps {width: 200px;height: 30px;line-height: 30px;}
.jdbox td {text-align: left;border:1px solid #ccc;}
.fx {margin: 0px auto;}
.fx td {border: 1px solid #ccc;padding:3px;}
.close_btn{font-family:arial;font-size:30px;font-weight:700;color:#999;text-decoration:none;float:right;padding-right:4px;}
</style>
<!--header end-->
<!--banner-->
<div class="banner_about" style="display:none">
</div>

   <div id="LoginBox"  >
   	<div class="row1" style="height:30px; line-height:30px;"><a href="javascript:void(0)" title="关闭窗口" class="close_btn" id="closeBtn">×</a></div>
		<table width="100%" border="0" cellpadding="0" cellspacing="3">
			<tr>
				<td height="30"><div align="right">收件人 </div></td>
				<td height="30">
					<input type="text" name="mtitle" id="mtitle" class="inps" value="<!--{$product_info['id']}-->" style="display:none">
          <input type="text" name="mname1" id="mname1" class="inps" value=""><b style="color:red">*</b></td>
        <td><div class="m1_err errs"></div></td>
      </tr>
 			<tr >
      	<td height="30">&nbsp;</td>
      	<td height="30"><input type="button" name="Submit" value="发送" class="fs"></td>
      	<td>&nbsp;</td>
			</tr>
		</table>
	</div>


    <!--new proDetail header-->
<div class="new_cp_header">

<script language="javascript">
var parttenmob = /^1[3,5,8]\d{9}$/;
var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

function checkemail(string){
   if(string.length!=0){
    if (string.charAt(0)=="." || string.charAt(0)=="@"|| string.indexOf('@', 0) == -1 || string.indexOf('.', 0) == -1 || string.lastIndexOf("@")==string.length-1 || string.lastIndexOf(".") ==string.length-1)
     {
      return false;
      }
   } else {
     return false;
   }
   return true;
}


function checkform()
{
	var yy_name = document.getElementById("yy_name").value;
	var yy_phone = document.getElementById("yy_phone").value;
	var yy_money = document.getElementById("yy_money").value;
	var msg = "";
	
	if(yy_name.length == 0){
		msg += '请输入您的真实姓名!\n';
	}
	if(yy_phone.length == 0)
  {
    msg += '请填写您的手机号码!\n';
  }else if(!parttenmob.test(yy_phone)){
  	msg += '请输入正确的手机号码!\n';
  }
	if(yy_money.length == 0){
		msg += '请输入您的预约金额!\n';
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

    <div class="new_pro_main">
        <div class="new_cp_header_lt">
            <h2><span class="title"><!--{$product_info['name']}--></span>                
                <img src="<!--{IMG_PATH}-->pd-mark.png" class="imark" />
                </h2>
            <div>
                <span class="pro_new_title">年化收益：</span>
                <span class="pro_new_cont" style="font-family:Verdana"><!--{$product_info['yield_year']}--></span>
                <span class="pro_new_title">收益类型：</span>
                <span class="pro_new_cont"><!--{$product_info['earning_name']}--></span>
            </div>
            <div>
                <span class="pro_new_title">付息方式：</span>
                <span class="pro_new_cont"><!--{$product_info['interest_name']}--></span>
                <span class="pro_new_title">产品期限：</span>
                <span class="pro_new_cont" style="font-family:Verdana"><!--{$product_info['lifetime']}-->个月</span>
            </div>
               <div>
                <span class="pro_new_title">大小配比：</span>
                <span class="pro_new_cont"><!--{$product_info['size_name']}--></span>
                <span class="pro_new_title">进&nbsp; 度：</span>
                <span class="pro_new_cont" style="font-family:Verdana">
                    <div class="load_list" style="margin-left:5px;width:180px;padding:0;"><i style="width:<!--{$product_info['progress_percent']}-->%"></i><font><!--{$product_info['progress_percent']}-->%</font></div>

                </span>
            </div>
            <div>
                <span class="pro_new_title">发行费用：</span>
                <span class="pro_new_cont" style="font-family:Verdana">  
                					<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
														<!--{$product_info['fee_scale']}-->
													<!--{else}-->
                          <a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >登录可见</a>
													<!--{/if}-->
                </span>
                <span class="pro_new_title">募集进度：</span>
                <span class="pro_new_cont" style="font-family:Verdana"><!--{mb_substr($product_info['progress'],0,50)}--></span>
            </div>
        </div>
        <div class="new_cp_header_rt" style="margin-left:-10px;">
            <h2><b>我要预约</b><span style="margin-left:-20px;"><img src="<!--{IMG_PATH}-->tel.jpg" style="width:150px; height:23px;"  /></span></h2>
            <form action="" method="post" onsubmit="return checkform();" >
  					<input type="hidden" name="dosubmit" value="1">
  					<input type="hidden" name="product_id" value="<!--{$product_info['id']}-->">
            <div>
                <ul>
                    <li class="pro_new_form">
                        <span>您的称呼：</span>
                         <input name="yy_name" type="text" id="yy_name" class="pro_new_text" />
                    </li>
                    <li class="pro_new_kk"><em><span id="RequiredFieldValidator2" style="color:#fff;visibility:hidden;">请填写预约姓名</span> </em></li>
                    <li class="pro_new_form">
                        <span>手机号码：</span>
                         <input name="yy_phone" type="text" id="yy_phone" class="pro_new_text" />
                    </li>
                    <li class="pro_new_kk"><em><span id="RequiredFieldValidator1" style="color:#fff;visibility:hidden;">请填写手机</span> </em></li>
                    <li class="pro_new_form">
                        <span>预约金额：</span>
                        <input name="yy_money" type="text" value="100" id="yy_money" class="pro_new_money" style="width:60px;" />
                        <b>万</b>
                    </li>
                    <li class="pro_new_kk"><em><span id="RequiredFieldValidator3" style="color:#fff;visibility:hidden;">请填写预约金额</span> </em></li>
                    <li class="pro_new_form">
                        <i>购买顾客姓名等备注信息：</i>
                        <textarea name="yy_remark" rows="2" cols="20" id="yy_remark"></textarea>
                    </li>
                </ul>
                <input type="hidden" name="pid" id="pid" value="932" />
                <input type="submit" name="Button1" value="立即预约" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;Button1&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="Button1" class="pro_new_btn" />
            &nbsp;</div>
          </form>
        </div>
    </div>
</div>

<!--new proDetail header end-->
<div class="subpage">
    
    <div class="content">
        <h2 class="content_title"><b>产品详情</b></h2>
        <div class="content_body">
            <!--我要预约，资料下载，一键分享到邮箱-->
            <div class="cpxq_btn">
            	<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
            	<a href="javascript:;" title="<!--{$product_info['name']}-->" ids="<!--{$product_info['id']}-->" class="cpxq_btn_email about"></a>
            	<a href="<!--{$product_info['download']}-->" class="cpxq_btn_download" title="资料下载"> </a>
            	<!--{else}-->
            	<a href="index.php?c=customer&a=login" class="cpxq_btn_email" title="一键分享到邮箱"></a>
            	<a href="index.php?c=customer&a=login"  class="cpxq_btn_download"  title="资料下载"> </a> 
            	<!--{/if}-->
            </div>
            <table width="100%" class="cpxq_table" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="160" class="cpxq_tb_title">产品名称</td>
                    <td width="317">
                        <h4 style="font-size:14px; padding-left:25px;"><!--{$product_info['name']}--></h4>
                    </td>
                    <td width="160" class="cpxq_tb_title">发行机构</td>
                    <td width="317">
                        <span><!--{$product_info['issuer']}--></span>
                    </td>
                </tr>
                <tr>
                    <td width="160" class="cpxq_tb_title">产品类别</td>
                    <td width="317">
                        <span><!--{$product_info['category_name']}--></span>
                    </td>
                    <td width="160" class="cpxq_tb_title">投资领域</td>
                    <td width="317">
                        <span><!--{$product_info['investment_name']}--></span>
                    </td>
                </tr>
                
                <tr>
                    <td width="160" class="cpxq_tb_title">规模</td>
                    <td width="317">
                        <span class="ft"><font class="ft"><!--{$product_info['scale']}--></font>亿</span>
                    </td>
                    <td width="160" class="cpxq_tb_title">投资门槛</td>
                    <td width="317">
                     <span>
                         <font class="ft"><!--{$product_info['threshold']}-->万</font>
                         </span> 
                    </td>
                </tr>
              
                <tr>
                    <td width="160" class="cpxq_tb_title">募集账号</td>
                    <td width="795" colspan="3"  class=""  >
                      <p style="color:#FF5F06;">
													<!--{if isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']}-->
														<!--{$product_info['account']}-->
													<!--{else}-->
                          <a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >登录可见</a>
													<!--{/if}-->
                      </p>
                    </td>
                </tr>
                <tr>
                    <td width="160" class="cpxq_tb_title">收益明细</td>
                    <td width="795" colspan="3">
                       <p style="color:#FF5F06;"> 
                            <!--{$product_info['income']}-->
                       </p>
                    </td>
                </tr>
                <tr>
                    <td width="160" class="cpxq_tb_title">产品说明</td>
                    <td width="795" colspan="3">
                        <p>
                            <!--{$product_info['content']}-->
                        </p>
                    </td>
                </tr>
           </table>

        </div>

        
    </div>
</div> 
</form>

 

<!--云系统结束-->
<!--footer-->
   
<!--{template 'index','footer',SITE_TEMP }-->


<script type="text/javascript">
//<![CDATA[
var Page_Validators =  new Array(document.getElementById("RequiredFieldValidator2"), document.getElementById("RequiredFieldValidator1"), document.getElementById("RequiredFieldValidator3"));
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
var RequiredFieldValidator2 = document.all ? document.all["RequiredFieldValidator2"] : document.getElementById("RequiredFieldValidator2");
RequiredFieldValidator2.controltovalidate = "txtRealName";
RequiredFieldValidator2.errormessage = "请填写预约姓名";
RequiredFieldValidator2.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator2.initialvalue = "";
var RequiredFieldValidator1 = document.all ? document.all["RequiredFieldValidator1"] : document.getElementById("RequiredFieldValidator1");
RequiredFieldValidator1.controltovalidate = "txtTel";
RequiredFieldValidator1.errormessage = "请填写手机";
RequiredFieldValidator1.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator1.initialvalue = "";
var RequiredFieldValidator3 = document.all ? document.all["RequiredFieldValidator3"] : document.getElementById("RequiredFieldValidator3");
RequiredFieldValidator3.controltovalidate = "txtAmount";
RequiredFieldValidator3.errormessage = "请填写预约金额";
RequiredFieldValidator3.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator3.initialvalue = "";
//]]>
</script>


<script type="text/javascript">
//<![CDATA[

var Page_ValidationActive = false;
if (typeof(ValidatorOnLoad) == "function") {
    ValidatorOnLoad();
}

function ValidatorOnSubmit() {
    if (Page_ValidationActive) {
        return ValidatorCommonOnSubmit();
    }
    else {
        return true;
    }
}
        //]]>
</script>


