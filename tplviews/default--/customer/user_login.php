<!--{template 'index','header_bg',SITE_TEMP }-->
<script type="text/javascript">
myLoad(108);
</script>
<div class="index_banner clearfix">
            <div class="index_banner2">
                <ul>                    
                     <!--{cc:a_adv action="get_promotion_list" apid="16" cache="3600"}-->
									<!--{foreach $data $val}-->
									 <!--{if $val['adv_content']['adv_pic']}-->                   
                    <li><img src="<!--{BASE_URL}--><!--{$val['adv_content']['adv_pic']}-->" /></li>
                    <!--{/if}-->
                  <!--{/foreach}-->
									<!--{/cc}-->
                </ul>
            </div>
<div class="shuzi">
                    <span class="current"></span><span></span><span></span><span></span><span></span> </div>

            <script src="<!--{JS_PATH}-->qiehuan1.js" type="text/javascript"></script>
</div>


<div class="main_body">
<div class="mntopbg"><span class="info_navzi2">客户专区</span>
          <div class="flast_nav2">您现在的位置：<a href="index.php" class="grey">首页</a> > <a href="index.php?c=customer&a=login" class="grey">客户专区</a> > <span class="font_red">客户专区</span></div></div>
		  
  <div class="main_con clearfix">
    <div class="khzqbg">
			<div class="khzqcon">
				<form action="" method="post" onsubmit="return checkform();" >
  			<input type="hidden" name="dosubmit" value="1">
  			<input type="hidden" name="urll" value="<!--{$urll}-->">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td style="padding:2px 0 0 34px;"><input name="loginname" id="loginname" type="text" value="" class="khinput" /></td>
					</tr>
					<tr><td height="38"></td></tr>
					<tr>
						<td style="padding:2px 0 0 34px;"><input name="loginpsd" id="loginpsd" type="password" value="" class="khinput" /></td>
					</tr>
					<tr>
						<td style=" padding:15px 0 0 0;font-family:'微软雅黑'; font-size:12px; color:#555555;"><input  type="checkbox" value="0" checked="checked" style=" vertical-align:middle"/> &nbsp;记住密码</td>
					</tr>
					<tr><td style=" padding-top:16px;"><input class="wlogin" type="submit" value=" " onclick=""></td></tr>
					<tr><td style="padding-top:20px; font-size:12px; font-family:'微软雅黑';"><img src="<!--{IMG_PATH}-->khicon1.png" style="vertical-align:middle" /> <a href="index.php?c=customer&a=register" class="grey">注册</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<!--{IMG_PATH}-->khicon2.png" style="vertical-align:middle" /> <a href="index.php?c=customer&a=forget_password" class="grey">忘记密码？</a></td></tr>
				</table>
				</form>
			</div>	
		</div>
    
    <div class="borth25"></div>
  </div>
  <img src="<!--{IMG_PATH}-->body_bottom.png"  class="font_size fix div_block" />  </div>

<!--{template 'index','footer',SITE_TEMP }-->