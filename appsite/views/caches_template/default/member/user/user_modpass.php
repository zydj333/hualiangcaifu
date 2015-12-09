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
            <form method="post" action="" onsubmit="return checkform();" id="form1" style=" background:#FFF; border:none;">
		<input type="hidden" name="dosubmit" value="1">

    <div class="title4">修改密码</div>
    <table border="0" align="center" cellpadding="0" cellspacing="3" style="padding:5px; width: 51%;">
        <tr>
          <td style="line-height:35px;" class="auto-style1">   您的旧密码：<input name="oldPsd" type="password" id="oldPsd" class="linputs" style="width:200px;" />
              <br />
              您的新密码：<input name="newPsd1" type="password" id="newPsd1" class="linputs" style="width:200px;" />
              <br />
              确认新密码：<input name="newPsd2" type="password" id="newPsd2" class="linputs" style="width:200px;" />
              <br />
              <br />
              <input type="submit" name="Button2" value="确认修改" id="Button2" class="bt" /> 
					</td>
        </tr>
    </table>
	</form>

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