<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php include APPPATH.'views/'.template('index','header',SITE_TEMP ); ?>
<script type="text/javascript" src="<?php echo JS_PATH;?>selarea.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>My97DatePicker/WdatePicker.js"></script>
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
    		<form action="" method="post" enctype="multipart/form-data" onsubmit="return checkform();" >
				<input type="hidden" name="dosubmit" value="1">
    		<div class="title4">&nbsp;个人设置</div>
						<table width="722" border="0" cellspacing="3" cellpadding="0">
            	<tr>
            		<td width="85" height="35"><div align="center">姓名</div></td>
            		<td height="35" class="auto-style1"><input name="truename" type="text" value="<?php echo $userInfo['truename'];?>" id="truename" class="linputs" /></td>
            	</tr>
            	<tr>
            		<td width="85" height="35"><div align="center">性别</div></td>
            		<td height="35"><input type="radio" name="sex" id="sex1" value="0" <?php if($userInfo['sex']==0) { ?>checked<?php } ?> />保密&nbsp;&nbsp;<input type="radio" name="sex" id="sex1" value="1" <?php if($userInfo['sex']==1) { ?>checked<?php } ?> />男&nbsp;&nbsp;<input type="radio" name="sex" id="sex2" value="2" <?php if($userInfo['sex']==2) { ?>checked<?php } ?>  />女</td>
            	</tr>
            	<tr>
            		<td width="85" height="35"><div align="center">生日</div></td>
            		<td height="35" class="auto-style1"><input name="birthday" id="birthday" type="text" value="<?php echo $userInfo['birthday'];?>" class="linputs" onClick="WdatePicker({el:'birthday'})" style="width:100px;" /></td>
            	</tr>
          		<tr>
            		<td height="35"><div align="center">工作单位</div></td>
            		<td height="35" class="auto-style1"><input name="web" type="text" id="web" value="<?php echo $userInfo['web'];?>" class="linputs" />              </td>
          		</tr>
      				<tr>
            		<td height="35"><div align="center">Email</div></td>
            		<td height="35" class="auto-style1"><input name="email" type="text" value="<?php echo $userInfo['email'];?>" id="email" class="linputs" /></td>
          		</tr>
          		<tr>
            		<td height="35"><div align="center">QQ</div></td>
            		<td height="35" class="auto-style1"><input name="qq" type="text" id="qq" value="<?php echo $userInfo['qq'];?>" class="linputs" /></td>
          		</tr>
          		<tr>
            		<td height="35"><div align="center">联系地址</div></td>
            		<td height="35" class="auto-style1">
            			<select name="province2" id="province2" class="khinput2" style="width:75px;">
  								<?php if(is_array($area)) foreach($area AS $v) { ?>
  									<option value="<?php echo $v['id'];?>" <?php if($userInfo['province_id'] == $v['id']) { ?>selected<?php } ?>><?php echo $v['name'];?></option>
  								<?php } ?>
  								</select>
  								<select name="city2" id="city2" class="khinput2" style="width:75px;">
      						</select>
      						<select name="county2" id="county2" class="khinput2" style="width:75px;">
      						</select>
            			<input name="address" type="text" id="address" class="linputs" />
            		</td>
          		</tr>
          		<script language="javascript">
      							setup(<?php echo $userInfo['province_id'];?>,<?php echo $userInfo['city_id'];?>,<?php echo $userInfo['area_id'];?>);
      				</script>
          		<tr  >
            		<td><div align="center">头像</div></td>
            		<td class="auto-style1">
            			<?php if($userInfo['head_ico']) { ?>
            			<img src="<?php echo $userInfo['head_ico'];?>" id="imgs" width="100" />
            			<?php } ?>
                 	<input name="head_ico" id="head_ico" type="file" class="type-file-file" style="width:265px;" /> 
            		</td>
          		</tr>
          		<tr>
            		<td>&nbsp;</td>
            		<td class="auto-style1">
                	<input type="submit" name="Button1" value="保存修改" id="Button1" class="bt" />
            		</td>
          		</tr>
      			</table>
    </form>

        
    </div>
    
    
</div>
  
   
<!--云系统结束-->
<?php include APPPATH.'views/'.template('index','footer',SITE_TEMP ); ?>