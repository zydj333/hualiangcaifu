<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>财来电-中国最大最专业的理财师一站式服务平台-注册</title>
        <link href="<?php echo CSS_PATH; ?>top_foot.css" type="text/css" rel="stylesheet"  />
        <link href="<?php echo CSS_PATH; ?>log_reg.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo JS_PATH; ?>jquery-1.4.1.min.js"></script>
        <script src="<?php echo JS_PATH; ?>jquery-1.4.3.min.js" type="text/javascript"></script>
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

            function checkemail(string) {
                if (string.length != 0) {
                    if (string.charAt(0) == "." || string.charAt(0) == "@" || string.indexOf('@', 0) == -1 || string.indexOf('.', 0) == -1 || string.lastIndexOf("@") == string.length - 1 || string.lastIndexOf(".") == string.length - 1)
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
                var checkcode = document.getElementById("checkcode").value;
                var msg = "";

                if (checkcode.length == 0)
                {
                    msg += '请输入手机验证码!\n';
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

            time('o');
        </script> 
    </head>

    <body>
        <!--header-->
        <header>
            <div class="lr_head">
                <div class="lr_head_top">
                    <a href="index.php"><img src="<?php echo IMG_PATH; ?>logo.jpg" title="财来电"  /></a>
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
                    <img src="<?php echo IMG_PATH; ?>lr_dao_02.png" title="填写注册信息"  />
                </div>
                <!--注册表单-->
                <form action="" method="post" onsubmit="return checkform();" >
                    <input type="hidden" name="dosubmit" value="1">
                        <!--注册表单-->
                        <div class="reg_form">
                            <h4>还差一步，只需验证您的手机号即可完成注册！</h4>
                            <div>
                                <em>注册手机号：</em>
                                <strong><span id="Label1" style="margin-left:0px; font-size:14px; color:#DB5317;padding-left:10px;"><?php echo mb_substr($temp_regname, 0, 7); ?>****</span></strong>

                            </div>
                            <div>
                                <label>手机验证码：</label>
                                <input type="hidden" name="temp_regname" id="temp_regname" value="<?php echo $temp_regname; ?>"  />
                                <input type="hidden" name="temp_truename" id="temp_truename" value="<?php echo $temp_truename; ?>" />
                                <input type="hidden" name="temp_regemail" id="temp_regemail" value="<?php echo $temp_regemail; ?>" />
                                <input type="hidden" name="temp_regpwd1" id="temp_regpwd1" value="<?php echo $temp_regpwd1; ?>" />
                                <input type="hidden" name="temp_regpwd2" id="temp_regpwd2" value="<?php echo $temp_regpwd2; ?>" />
                                <input type="hidden" name="temp_regcardno" id="temp_regcardno" value="<?php echo $temp_regcardno; ?>" />
                                <input type="hidden" name="temp_businesscard" id="temp_businesscard" value="<?php echo $temp_businesscard; ?>" />
                                <input name="checkcode" type="text" maxlength="6" id="checkcode" class="reg_form_yzm" />
                                <input name="btn" type="button" id="getphonecode" class="reg_form_yzm_btn" value="免费获取验证码" />
                                <input name="btn" type="button" id="waitphonecode" class="reg_form_yzm_btn" style=" display: none" value="60秒后重新获取" />
                                <span id="timeb2" style=" display: none" >60</span>
                            </div>
                            <p id="moileMsg">*&nbsp;点击获取验证码，请输入您手机收到的验证码 如果1分钟内未收到，请重新获取！</p>
                            <div id="jsr">
                                <div>
                                    <label>渠道经理手机号：</label>

                                    <input name="new_rec" type="text" maxlength="11" id="new_rec" class="reg_form_mob" />
                                </div>
                                <p>*&nbsp;您的渠道经理手机号，如果有请填写，如果没有请保持为空！</p>
                            </div>
                            <input type="submit" name="Button2" value="" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions( & quot; Button2 & quot; , & quot; & quot; , true, & quot; & quot; , & quot; & quot; , false, false))" id="Button2" class="reg_form_wc" />
                        </div>
                        <!--注册表单结束-->

                </form>
                <!--注册表单结束-->
            </div>



            <!--右边-->
            <div class="reg_rt">
                <!--ICON块-->
                <div class="reg_rt_icon">
                    <img src="<?php echo IMG_PATH; ?>lr_rt_icon_01.jpg"  />
                    <div>
                        <h6>产品多&nbsp;&nbsp;&nbsp;尽情挑选</h6>
                        <p>不同收益期限，付息方式，类型，地域，<b style="color:red">100</b>  余款产品满足客户多样化需求</p>
                    </div>
                </div>
                <div class="reg_rt_icon">
                    <img src="<?php echo IMG_PATH; ?>lr_rt_icon_02.jpg"  />
                    <div>
                        <h6>佣金高&nbsp;&nbsp;&nbsp;欢迎比价</h6>
                        <p>高出市场价千<b style="color:red">8</b> 以上的佣金使理财师及客户的利益最大化</p>
                    </div>
                </div>
                <div class="reg_rt_icon">
                    <img src="<?php echo IMG_PATH; ?>lr_rt_icon_03.jpg"  />
                    <div>
                        <h6>结款快&nbsp;&nbsp;&nbsp;安全保障</h6>
                        <p>成立<b style="color:red">24</b> 小时内快速现结保障理财师及客户的切身利益</p>
                    </div>
                </div>
                <!--ICON块结束-->
                <!--二维码-->
                <div class="reg_rt_weixin">
                    <img src="<?php echo IMG_PATH;?>wx_pic.png"  />
                    <span>财来电官方微信</span>
                </div>
                <!--二维码结束-->
            </div>
        </div>

        <!--中间结束-->
        <!--底部-->
        <script>

            function verEmpty(obj, objprv, i) {
                var _cuvalue = $.trim(obj.val());
                var flag = false;
                var _cunext = obj.next();
                var _cuneprev = obj.prev();
                //空字符
                if (_cuvalue == "") {
                    _cunext.find("span").text(_cuneprev.html().substring(0, _cuneprev.html().length - 1) + "不为空");
                    flag = false;
                } else {
                    _cunext.find("span").text("");
                    flag = true;
                }
                //手机格式
                if (i == "sj") {
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
                if (i == "yx") {
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





            $(function() {
                //$("#txtMob"), $("#txtRealName"), $("#txtEmail"), $("#txtPassWord"), $("#txtPassWord2")
                $("#txtRealName,#txtPassWord").blur(function() {
                    verEmpty($(this), null, "");
                });
                $("#txtMob").blur(function() {
                    if (verEmpty($(this), null, "")) {
                        verEmpty($(this), null, "sj");
                    }

                });
                $("#txtEmail").blur(function() {
                    if (verEmpty($(this), null, "")) {
                        verEmpty($(this), null, "yx");
                    }


                });
                $("#txtPassWord2").blur(function() {
                    if (verEmpty($(this), null, "")) {
                        verEmpty($(this), $("#txtPassWord"), "");
                    }

                });
                $("#Button1").click(function() {
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

                    var fpw = verEmpty($("#txtPassWord"), null, "");
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

                //发送验证码
                //<input name="btn" type="button" id="getphonecode" class="reg_form_yzm_btn" value="免费获取验证码" />
                //<input name="btn" type="button" id="waitphonecode" class="reg_form_yzm_btn" style=" display: none" value="60秒后重新获取" />
                //<span id="timeb2" style=" display: none" >60</span>
                $("#getphonecode").click(function() {
                    var phone = $("#temp_regname").val();
                    if ((/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone))) {
                        $.ajax({
                            type: "POST",
                            url: "/index.php?c=common&a=creatPhoneCode&random=" + Math.random(),
                            data: {
                                "phone": phone
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.flag === 1) {
                                    f_timeout();
                                } else {
                                    alert(data.error);
                                }
                            }
                        });
                    } else {
                        alert('手机格式不正确');
                    }
                })

            });



            //切换发送按钮
            function f_timeout() {
                $('#getphonecode').hide();
                $('#waitphonecode').show();
                $('#waitphonecode').val('60秒后重新获取');
                 $('#timeb2').html(60);
                timer = self.setInterval(addsec, 1000);
            }

            function addsec() {
                var t = $('#timeb2').html();
                if (t > 0) {
                    $('#timeb2').html(t - 1);
                    $('#waitphonecode').val((t - 1)+'秒后重新获取');
                } else {
                    window.clearInterval(timer);
                    $('#getphonecode').show();
                    $('#waitphonecode').hide();
                    //$('#timeb1').click(function(){phonecode();});
                }
            }
        </script> 

        <?php include APPPATH . 'views/' . template('index', 'footer', SITE_TEMP); ?>