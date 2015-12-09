<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>华良财富-中国最大最专业的理财师一站式服务平台-注册</title>
<link href="<!--{CSS_PATH}-->top_foot.css" type="text/css" rel="stylesheet"  />
<link href="<!--{CSS_PATH}-->log_reg.css" type="text/css" rel="stylesheet" />
<script src="<!--{JS_PATH}-->jquery-1.4.1.min.js"></script>
<script src="<!--{JS_PATH}-->jquery-1.4.3.min.js" type="text/javascript"></script>
<script src="<!--{JS_PATH}-->.html-compressed.js" type="text/javascript"></script>
<link href="<!--{CSS_PATH}-->.html.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <style>
        .red {
            display: block;
            float: left;
            line-height:20px;
            height:20px;
            margin:0px;
            padding-left:0px;
            color:red;
            }
    </style>
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
	var regname = document.getElementById("regname").value;
	var regtruename = document.getElementById("regtruename").value;
	var regpwd1 = document.getElementById("regpwd1").value;
	var regpwd2 = document.getElementById("regpwd2").value;
	var regemail = document.getElementById("regemail").value;
	var yzcode = document.getElementById("yzcode").value;
	var msg = "";

	if(regname.length == 0)
  {
    msg += '请填写您的手机号码!\n';
  }else if(!parttenmob.test(regname)){
  	msg += '请输入正确的手机号码!\n';
  }
  if(regtruename.length == 0){
		msg += '请输入您的真实姓名!\n';
	}
	if(regemail.length == 0){
		msg += '请填写您的邮箱!\n';
	}else if(!checkemail(regemail)){
		msg += '请输入正确格式的电子邮箱!\n';
	}
	if(regpwd1.length == 0){
		msg += '请输入您的登录密码!\n';
	}
	if(regpwd2.length == 0){
		msg += '请再吃输入您的登录密码!\n';
	}
	if(yzcode.length == 0){
		msg += '请输入验证码!\n';
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
<!--header-->
<header>
    <div class="lr_head">
        <div class="lr_head_top">
            <a href="index.php"><img src="<!--{IMG_PATH}-->logo.jpg" title="华良财富"  /></a>
            <span title="咨询热线"></span>
        </div>
        <div class="lr_head_btm"></div>    
    </div>
</header>
<!--header end-->
<!--中间-->
<div class="body_mid">
    <!--左边-->
    <div class="reg_lt">
        <h2>账户注册</h2>
        <div class="reg_lt_dpic">
            <img src="<!--{IMG_PATH}-->lr_dao_01.png" title="填写注册信息"  />
        </div>
        <!--注册表单-->
        <form action="" method="post" onsubmit="return checkform();" >
  			<input type="hidden" name="dosubmit" value="1">
        <div class="reg_form">
            <h4>为了保障您的账户安全，华良财富需要进行手机验证（带 * 号为必填项）。我们会对您的个人信息严格保密。</h4>
            <ul>
                <li>
                    <label>手机号码：</label>
                    <input name="regname" type="text" maxlength="11" id="regname" class="linputs" />
                    <label style="float:left; width:200px; margin-left:0; display:block; "><span class="red" style="margin-left:0;width:200px; padding-left:20px; text-align:left; color:red;"></span></label>
                </li>
                <li>
                    <label>姓名：</label>
                    <input name="regtruename" type="text" maxlength="20" id="regtruename" class="linputs" />     
                        <label style="float:left; width:200px; margin-left:0; display:block; "><span class="red" style="margin-left:0;width:200px; padding-left:20px; text-align:left; color:red;"></span></label>      
                </li>
                <li>
                    <label>电子邮箱：</label>
                      <input name="regemail" type="text" maxlength="50" id="regemail" class="linputs" />   
                       <label style="float:left; width:200px; margin-left:0; display:block; "><span class="red" style="margin-left:0;width:200px; padding-left:20px; text-align:left; color:red;"></span></label>
                </li>
                <li>
                    <label>账户密码：</label>
                    <input name="regpwd1" type="password" maxlength="20" id="regpwd1" class="linputs" />
                    <label style="float:left; width:200px; margin-left:0; display:block; "><span class="red" style="margin-left:0;width:200px; padding-left:20px; text-align:left; color:red;"></span></label>
                </li>
                <li>
                    <label>确认密码：</label>
                    <input name="regpwd2" type="password" maxlength="20" id="regpwd2" /> 
                    <label style="float:left; width:200px; margin-left:0; display:block; "><span class="red" style="margin-left:0;width:200px; padding-left:20px; text-align:left; color:red;"></span></label>
                </li>
                <li>
                    <label>推荐人手机：</label>
                    <input name="regcardno" type="text" maxlength="20" id="regcardno" style="" /> 
                </li>
                <li>
                	<label>验证码：</label>
                	<input name="yzcode" id="yzcode" type="text" value="" onblur="check_code(this.value);" class="khinput2" style="width:150px;" />
  							<img id='code_img' style=" vertical-align:middle; border:1px solid #dddddd;" onclick='this.src=this.src+"&"+Math.random()' src='<!--{BASE_URL}-->index.php?m=com&c=common&a=verifycode&vcode=login_verifycode&code_len=4&font_size=15&width=90&height=38&font_color=&background=' title="看不清,点击更换验证码">
                </li>
            </ul>
            <span>  我已经阅读并同意 <a href="#TB_inline?height=500&width=550&inlineId=myOnPageContent" title="  《用户使用协议》及《隐私保护协议》。 " class=".html"  > 《用户使用协议》及《隐私保护协议》。 </a>
  <div id='myOnPageContent' style="display:none;"> <p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">本协议由您与华良财富会员系统的经营者共同缔结，本协议具有合同效力。</span></p><p style="text-align: left; line-height: 20px; margin-top: auto; margin-bottom: auto;"><span style="font-size: 12px;"><span style="color: rgb(51, 51, 51); font-family: Symbol; font-size: 13px;">·<span style="font: 9px/normal &quot;Times New Roman&quot;; font-size-adjust: none; font-stretch: normal;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">一、华良财富会员系统使用规范： </span></span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">1. 您根据华良财富会员系统的理财资讯向客户进行推广宣传业务的，需保证客户是符合相关法律规定的投资人。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">2. 您应严格按照国家各金融监管机构的规定开展业务活动，不采用误导或可能误导客户的方式和内容进行宣传推广。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">3. 您保证在接到客户的投诉后，积极妥善处理。您与客户的一切纠纷，均与华良财富会员系统经营者无关。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">4. 华良财富会员系统中的资料信息，仅供推广业务参考，未得华良财富会员系统经营者同意，不得将之在业务范围外交予第三方使用。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">5. 华良财富会员系统经营者与您不具有雇佣、代理等关系，您不得利用华良财富的名称或公司数据（包括但不限于地址及电话等），行不实夸大之宣传而误导客户及其他损害客户利益的行为。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">6. 您在推广活动中，不得利用不正当竞争手段、恶意手段发展客户。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">7. 您提交的注册信息及您设置的银行卡信息，都将严格进行保密。除法律另有规定或监管机构要求披露外，华良财富会员系统均不会任意对外泄露。</span></p><p style="text-align: left; line-height: 20px; margin-top: auto; margin-bottom: auto;"><span style="font-size: 12px;"><span style="color: rgb(51, 51, 51); font-family: Symbol; font-size: 13px;">·<span style="font: 9px/normal &quot;Times New Roman&quot;; font-size-adjust: none; font-stretch: normal;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">二、协议内容及签署： </span></span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">1. 本协议内容包括协议正文及所有华良财富会员系统已经发布的或将来可能发布的各类规则。所有规则为本协议不可分割的组成部分，与协议正文具有同等法律效力。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">2. 您应当在使用华良财富会员系统服务之前认真阅读全部协议内容，对于协议中以加粗字体显示的内容，您应重点阅读。如您使用华良财富会员系统服务，则本协议即对您产生约束，届时您不应以未阅读本协议的内容为由，主张本协议无效，或要求撤销本协议。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">3. 您承诺接受并遵守本协议的约定。如果您不同意本协议的约定，您应立即停止注册使用华良财富会员系统。如果您注册完成本平台，将被视为接受本协议全部条款，接受本协议约束。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">4. 华良财富会员系统有权根据需要不时地制订、修改本协议及/或各类规则，并以网站公示的方式进行公告，不再单独通知您。变更后的协议和规则一经在网站公布后，立即自动生效。如您不同意相关变更，应当立即停止使用华良财富会员系统服务。您继续使用华良财富会员系统服务的，即表示您接受经修订的协议和规则。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">5. 华良财富会员系统即华良财富提供给您用于查看理财资讯、进行专业投资管理服务的平台。</span></p><p style="text-align: left; line-height: 20px; margin-top: auto; margin-bottom: auto;"><span style="font-size: 12px;"><span style="color: rgb(51, 51, 51); font-family: Symbol; font-size: 13px;">·<span style="font: 9px/normal &quot;Times New Roman&quot;; font-size-adjust: none; font-stretch: normal;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">三、违约责任 </span></span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">您未按本协议约定履行其义务，出现违反上述条款之一的，华良财富会员系统经营者有权终止支付服务费。情节严重的，华良财富会员系统经营者有权单方终止本协议。协议终止后，华良财富会员系统经营者依旧有权要求您承担违约责任。</span></p><p style="text-align: left; line-height: 20px; margin-top: auto; margin-bottom: auto;"><span style="font-size: 12px;"><span style="color: rgb(51, 51, 51); font-family: Symbol; font-size: 13px;">·<span style="font: 9px/normal &quot;Times New Roman&quot;; font-size-adjust: none; font-stretch: normal;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">四、其他约定 </span></span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">1. 本协议之效力、解释、变更、执行与争议解决均适用中华人民共和国大陆地区法律，如无相关法律规定的，则应参照通用国际商业惯例和（或）行业惯例。</span></p><p style="text-align: left; line-height: 20px;"><span style="color: rgb(51, 51, 51); font-family: 宋体; font-size: 12px;">2. 因本协议产生之争议的，您与华良财富会员系统经营者均同意以华良财富会员系统经营者住所地人民法院为管辖法院。</span></p><p><span style="font-family: Calibri; font-size: 12px;">&nbsp;</span></p><p>&nbsp;</p> </div> </span>
            <input type="submit" name="name" value="" id="Button1" class="reg_form_join" />
        </div>
        </form>
        <!--注册表单结束-->
    </div>



    <!--右边-->
    <div class="reg_rt">
        <!--ICON块-->
        <div class="reg_rt_icon">
            <img src="<!--{IMG_PATH}-->lr_rt_icon_01.jpg"  />
            <div>
                <h6>产品多&nbsp;&nbsp;&nbsp;尽情挑选</h6>
                <p>不同收益期限，付息方式，类型，地域，<b style="color:red">100</b>  余款产品满足客户多样化需求</p>
            </div>
        </div>
        <div class="reg_rt_icon">
            <img src="<!--{IMG_PATH}-->lr_rt_icon_02.jpg"  />
            <div>
                <h6>佣金高&nbsp;&nbsp;&nbsp;欢迎比价</h6>
                <p>高出市场价千<b style="color:red">8</b> 以上的佣金使理财师及客户的利益最大化</p>
            </div>
        </div>
        <div class="reg_rt_icon">
            <img src="<!--{IMG_PATH}-->lr_rt_icon_03.jpg"  />
            <div>
                <h6>结款快&nbsp;&nbsp;&nbsp;安全保障</h6>
                <p>成立<b style="color:red">24</b> 小时内快速现结保障理财师及客户的切身利益</p>
            </div>
        </div>
        <!--ICON块结束-->
        <!--二维码-->
        <div class="reg_rt_weixin">
            <img src="<!--{IMG_PATH}-->lr_rt_2weima.jpg"  />
            <span>华良财富官方微信</span>
        </div>
        <!--二维码结束-->
    </div>
 </div>
           
<!--中间结束-->
<!--底部-->
<script>
        
        function verEmpty(obj,objprv, i) {
            var _cuvalue = $.trim(obj.val());
            var flag = false;
            var _cunext = obj.next();
            var _cuneprev = obj.prev();
            //空字符
            if (_cuvalue == "") {
                _cunext.find("span").text(_cuneprev.html().substring(0, _cuneprev.html().length-1) + "不为空");
                flag = false;
            } else {
                _cunext.find("span").text("");
                flag = true;
            }
            //手机格式
            if (i=="sj") {
                var sjreg = /^(130|131|132|133|134|135|136|137|138|139|145|147|150|151|152|153|154|155|156|157|158|159|180|181|188|189|186|183|182|184|185|187)\d{8}$/;
                if (!sjreg.test(_cuvalue)) {
                    _cunext.find("span").text("手机格式不正确");
                    flag = false;
                } else {
                    _cunext.find("span").text("");
                    flag = true;
                }
            }
            //邮箱格式
            if (i=="yx") {
                var yxreg = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
                if (!yxreg.test(_cuvalue)) {
                    _cunext.find("span").text("邮箱格式不正确");
                    flag = false;
                } else {
                    _cunext.find("span").text("");
                    flag = true;
                }
            }
            
            //确认密码
            if (objprv != null) {
                if (_cuvalue != $.trim(objprv.val())) {
                    _cunext.find("span").text("两次密码不一致");
                    flag = false;
                } else {
                    _cunext.find("span").text("");
                    flag = true;
                }
            }
            return flag;
        }





        $(function () {
            //$("#txtMob"), $("#txtRealName"), $("#txtEmail"), $("#txtPassWord"), $("#txtPassWord2")
            $("#txtRealName,#txtPassWord").blur(function() {
                verEmpty($(this), null, "");
            });
            $("#txtMob").blur(function () {
                if (verEmpty($(this), null, "")) {
                    verEmpty($(this), null, "sj");
                }
                
            });
            $("#txtEmail").blur(function () {
                if (verEmpty($(this), null, "")) {
                     verEmpty($(this), null, "yx");
                }
                
               
            });
            $("#txtPassWord2").blur(function () {
                if (verEmpty($(this), null, "")) {
                    verEmpty($(this), $("#txtPassWord"), "");
                }
               
            });
            $("#Button1").click(function () {
                var fsj = verEmpty($("#txtMob"), null, "");
                var fsjv = false;
                if (fsj) {
                    if (verEmpty($("#txtMob"), null, "sj")) {
                        fsjv = true;
                    }
                    
                }
                
                var frn = verEmpty($("#txtRealName"), null, "");
                var ftm = verEmpty($("#txtEmail"), null, "");
                var ftmv = false;
                if (ftm) {
                    if (verEmpty($("#txtEmail"), null, "yx")) {
                        ftmv = true;
                    }

                }
               
                var fpw= verEmpty($("#txtPassWord"), null, "");
                var fpw2 = verEmpty($("#txtPassWord2"), null, "");
                var fpw2v = false;
                if (fpw2) {
                    if (verEmpty($("#txtPassWord2"), $("#txtPassWord"), "")) {
                        fpw2v = true;
                    }

                }

                if (fsj && fsjv && frn && ftm && ftmv && fpw && fpw2 && fpw2v) {
                    $("#form1").submit;
                    return true;
                } else {
                    return false;
                }
                
                

            });
        });
    </script> 
    
<!--{template 'index','footer',SITE_TEMP }-->