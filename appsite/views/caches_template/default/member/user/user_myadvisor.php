<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php include APPPATH.'views/'.template('index','header',SITE_TEMP ); ?>

<script language="javascript">
var parttenmob = /^1[3,5,8]\d{9}$/;
var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

function checkform()
{
	var oldPsd = document.getElementById("oldPsd").value;
	var newPsd1 = document.getElementById("newPsd1").value;
	var newPsd2 = document.getElementById("newPsd2").value;
	var msg = "";

	if(oldPsd.length == 0)
  {
    msg += '请输入您的旧密码!\n';
  }
  
  if(newPsd1.length == 0)
  {
    msg += '请输入您的新密码!\n';
  }
  
  if(newPsd2.length == 0)
  {
    msg += '请输入您的确认密码!\n';
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

<link href="<?php echo CSS_PATH;?>css.css" rel="stylesheet" type="text/css" /> 
<div class="user_620">
    <!--lt-->
    <div class="user_lt">
        <div class="user_lt_top">
             <a href="index.php?m=member&c=user&a=udefault"    target="main" class="list">
             <?php if($this->session->userdata['member_headico']) { ?>
             	<img src="/<?php echo $this->session->userdata['member_headico']; ?>"  style="width:150px; height:150px;" />
             	<?php } else { ?>
             	<img src="<?php echo IMG_PATH;?>head.jpg"  style="width:150px; height:150px;" />
             	<?php } ?>
             </a>
             <h4><?php echo $this->session->userdata['member_truename']; ?></h4>
             <h4><?php echo $this->session->userdata['member_username']; ?></h4>
        </div>
        <?php include APPPATH.'views/'.template('index','user_left',SITE_TEMP ); ?>
    </div>
    <!--rt-->
    <div class="user_rt">
        <!--border layout-->
        <div class="user_rt_layout">

    <table width="800" height="236" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td height="234" valign="top"   bgcolor="#FFFFFF"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="3">
      <tr>
        <td width="47%" height="36" style="border-bottom:1px dashed #ccc">&nbsp;<strong style=" font-size:14px;">服务经理介绍</strong></td>
        </tr>
      <tr>
        <td height="148" valign="top">
           
          
            <table width="100%" height="128" border="0" align="center" cellpadding="0" cellspacing="0">
          
          <tr>
            <td width="10%" height="128" valign="top"><div align="center" style=" padding-top:10px; padding-right:5px;">  <img  src="<?php echo IMG_PATH;?>fuwujingli.jpg"   id="headpic"  width="150" height="150" style="border:5px solid #ccc" />  </div></td>
            <td width="90%" valign="top" style="line-height:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="69%" height="120" style=" font-size:14px; line-height:30px;"> 服务经理：张有钢&nbsp; <br />
 
手机号码：13989484358 <br />
Q Q号码：356483183<br />
电子邮箱：356483183@qq.com </td>
                  </tr>
              </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="165" valign="top"><p>华良财富产品经理。</p></td>
        </tr>
    </table></td>
  </tr>
</table>

        &nbsp;</div>
        
    </div>
    
    
</div>


 <script>
     //注意：下面的代码是放在test.html调用
     $(function () {
         
        /* $(window.parent.document).find("#main").load(function () {
             var main = $(window.parent.document).find("#main");
             var thisheight = $(document).height() + 30;
		 
             main.height(thisheight);
         });*/
     })
 </script>
  
   
<!--云系统结束-->
<?php include APPPATH.'views/'.template('index','footer',SITE_TEMP ); ?>