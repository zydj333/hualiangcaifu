<!--{template 'index','header',SITE_TEMP }-->

<link href="<!--{CSS_PATH}-->css.css" rel="stylesheet" type="text/css" /> 
<link href="<!--{CSS_PATH}-->user_620.css" rel="stylesheet" type="text/css" />
<script src="<!--{JS_PATH}-->jquery-1.7.2.min.js"></script>
<script src="<!--{JS_PATH}-->jquery-ui.min.js"></script>
<link href="<!--{CSS_PATH}-->jquery.ui.all.css" rel="stylesheet" />
<script src="<!--{JS_PATH}-->jquery.autocomplete.js"></script>
<link href="<!--{CSS_PATH}-->jquery.autocomplete.css" rel="stylesheet" />
<script type="text/javascript" src="<!--{JS_PATH}-->My97DatePicker/WdatePicker.js"></script>
<div class="user_620">
    <!--lt-->
    <div class="user_lt">
        <div class="user_lt_top">
             <a href="index.php?m=member&c=user&a=udefault"    target="main" class="list">
             <!--{if $this->session->userdata['member_headico']}-->
             	<img src="/<?php echo $this->session->userdata['member_headico']; ?>"  style="width:150px; height:150px;" />
             	<!--{else}-->
             	<img src="<!--{IMG_PATH}-->head.jpg"  style="width:150px; height:150px;" />
             	<!--{/if}-->
             </a>
             <h4><?php echo $this->session->userdata['member_truename']; ?></h4>
             <h4><?php echo $this->session->userdata['member_username']; ?></h4>
        </div>
        <!--{template 'index','user_left',SITE_TEMP }-->
    </div>
    <!--rt-->
    <div class="user_rt">
        <!--border layout-->
        <div class="user_rt_layout">
            <!--表单框架-->
         <form action="" method="post" enctype="multipart/form-data" onsubmit="return checkform();" >
				<input type="hidden" name="dosubmit" value="1">
            <table width="100%" class="user_form" cellpadding="0" cellspacing="0">
                	<tr>
                  	<td width="13%"><span>产品搜索：</span></td>
                    <td width="87%">
                    	<input name="suggest1" type="text" id="suggest1" class="user_form_text" />
                   		<input type="submit" name="Button2" value="查找" id="Button2" class="user_form_submit" style="margin-left:10px;" />
                   	</td>
                	</tr>
                	<tr style="height:30px;" >
                    <td width="13%" class="auto-style1"><span>选择产品：</span></td>
                    <td width="87%" class="auto-style1"><a href="#" style="font-size:14px;margin-left:20px;">信托产品</a>&nbsp;&nbsp;  <a href="#" style="font-size:14px;">资管产品</a>                    </td>
                	</tr>
                	<tr>
                    <td width="13%" class="auto-style1"><span>选择产品：</span></td>
                    <td width="87%" class="auto-style1">
                  		<select name="product_id" id="product_id" style="padding:3px;height:24px; font-size:16px;width:300px; ">
												<option value="1"> 渤海信托?成都协信中心项目集合资金信托计划</option>
												<option value="2"> 湖南信托-成都金堂国投应收账款投资集合信托计划 </option>
												<option value="3"> 天风证券-中融信托-宜昌旧城改造集合资产管理计划 </option>
												<option value="4">【包销】大业-银川恒大名都信托贷款集合资金信托计划</option>
												<option value="5">【包销】华富资管-成都国际医学城道路基础设施建设专项资产管理计划</option>
												<option value="6">【包销】陆家嘴-陆淮1号淮安中盛应收账款转让及回购集合资金信托计划</option>
											</select>
										</td>
                	</tr>
                	<tr>
                    <td width="13%"><span>客户姓名：</span></td>
                    <td width="87%"><input name="khname" type="text" id="khname" class="user_form_text" style="width:120px" />  </td>
                	</tr>
                	<tr>
                    <td width="13%"><span>打款金额：</span></td>
                    <td width="87%"><input name="dk_money" type="text" value="100" id="dk_money" class="user_form_text" style="width:120px;" />万</td>
                	</tr>
                	<tr>
                  	<td><span>打款日期：</span></td>
                  	<td><input name="dk_date" type="text" value="" id="dk_date" class="user_form_text" onClick="WdatePicker({el:'dk_date'})" style="width:100px;" /></td>
                	</tr>
                	<tr>
                  		<td width="13%"><span>打款凭条：<br /><b style="color:red">（*必填）</b></span></td>
                    	<td width="87%">
                 				<input name="money_slip" id="money_slip" type="file" class="type-file-file" style="width:300px;" />
                  			<img src="<!--{IMG_PATH}-->1.jpg" id="imgs" name="imgs" width="60" height="40" />
                  		</td>
                	</tr>
                 	<tr>
                    <td width="13%"><span>银行卡：<br /><b style="color:red">（*必填）</b></span></td>
                    <td width="87%">
                 			<input name="bankcard" id="bankcard" type="file" class="type-file-file" style="width:300px;" />
                   		<img src="<!--{IMG_PATH}-->2.jpg" id="imgs1" name="imgs1" width="60" height="40" />
                   	</td>
                	</tr>
                  <tr>
                    <td width="13%" rowspan="2"><p><span>身份证：</span></p><p><b style="color:red">（*至少填1项）</b></p></td>
                    <td width="87%">
                 			<input name="idcard_up" id="idcard_up" type="file" class="type-file-file" style="width:300px;" />
                    	<img src="<!--{IMG_PATH}-->3.jpg" id="imgs2" name="imgs2" width="60" height="40" />
                    </td>
                	</tr>
                  <tr>
                    <td width="87%">
                 			<input name="idcard_back" id="idcard_back" type="file" class="type-file-file" style="width:300px;" />
                    	<img src="<!--{IMG_PATH}-->4.jpg" id="imgs3" name="imgs3" width="60" height="40" />
                    </td>
                	</tr>
                  <tr>
                    <td width="13%" rowspan="2"><span>签字页：<br />（选填）</span></td>
                    <td width="87%">
                    	<input name="signature1" id="signature1" type="file" class="type-file-file" style="width:300px;" />
                    	<img src="<!--{IMG_PATH}-->5.jpg" id="imgs4" name="imgs4" width="60" height="40" />
                    </td>
                		</tr>
                  	<tr>
                    	<td width="87%">
                      	<input name="signature2" id="signature2" type="file" class="type-file-file" style="width:300px;" />
                    		<img src="<!--{IMG_PATH}-->6.jpg" id="imgs5" name="imgs5" width="60" height="40" />
                    	</td>
                		</tr>
                		<tr>
                    	<td width="13%"><span>备注：</span></td>
                    	<td>
                        <input name="remark" type="text" id="remark" class="user_form_text" style="margin-left:10px;width:300px;" />
            					</td>
                		</tr>
                		<tr>
                    	<td colspan="2">
                        <input type="submit" name="name" value="确认提交" id="form-button" class="user_form_submit"  onclick="return verSbumit();" />
                        <input type="reset" value="重置内容" class="user_form_reset" />   
                    	</td>
                		</tr>
            			</table>
            <!--表单框架结束-->
   </form>
            
      </div>
        
    </div>
    
    
</div>

 
   
<!--云系统结束-->
<!--{template 'index','footer',SITE_TEMP }-->