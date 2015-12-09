<?php /* Smarty version Smarty-3.1.11, created on 2015-06-30 16:01:00
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\setup\email_setup.html" */ ?>
<?php /*%%SmartyHeaderCode:1013855924cbcb123a5-68290734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71d8d12806d663b66f542a37ca2419434bbffbb6' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\setup\\email_setup.html',
      1 => 1381081050,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1013855924cbcb123a5-68290734',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'email_setup' => 0,
    'COM' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55924cbcc019b7_62366284',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55924cbcc019b7_62366284')) {function content_55924cbcc019b7_62366284($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>Email设置</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>Email设置</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" id="form_email" name="settingForm">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="email_type">邮件功能开启:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="email_enabled_1" class="cb-enable <?php if ($_smarty_tpl->tpl_vars['email_setup']->value['email_enabled']==1){?>selected<?php }?>" title="开启"><span>开启</span></label>
            <label for="email_enabled_0" class="cb-disable <?php if ($_smarty_tpl->tpl_vars['email_setup']->value['email_enabled']==0){?>selected<?php }?>" title="关闭"><span>关闭</span></label>
            <input type="radio"  value="1" name="email_enabled" id="email_enabled_1" />
            <input type="radio" checked="checked" value="0" name="email_enabled" id="email_enabled_0" />
            <input type="hidden" name="email_type" value="1" /></td>
          <td class="vatop tips">&nbsp;</td>
        </tr>
        <!--<tr>
          <td colspan="2" class="required">
				<label for="email_type">邮件发送方式:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
					<label><input type="radio" checked="checked" value="1" name="email_type" id="email_type_1" />&nbsp;采用其他的SMTP服务</label>&nbsp;
					<label><input type="radio"  value="0" name="email_type" id="email_type_0" />&nbsp;采用服务器内置的Mail服务</label>&nbsp;
					<label class="field_notice">如果您选择服务器内置方式则无须填写以下选项</label>
				</td>
          <td class="vatop tips">&nbsp;</td>
        </tr>-->
        <tr>
          <td colspan="2" class="required">SMTP 服务器:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['email_setup']->value['email_host'];?>
" name="email_host" id="email_host" class="txt"></td>
          <td class="vatop tips"><label class="field_notice">设置 SMTP 服务器的地址</label></td>
        </tr>
        <tr>
          <td colspan="2" class="required">SMTP 端口:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['email_setup']->value['email_port'];?>
" name="email_port" id="email_port" class="txt"></td>
          <td class="vatop tips"><label class="field_notice">设置 SMTP 服务器的端口，默认为 25</label></td>
        </tr>
        <tr>
          <td colspan="2" class="required">发信人邮件地址:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['email_setup']->value['email_addr'];?>
" name="email_addr" id="email_addr" class="txt"></td>
          <td class="vatop tips"><label class="field_notice">如果 SMTP 服务器要求身份验证，必须为本服务器的邮件地址</label></td>
        </tr>
        <tr>
          <td colspan="2" class="required">SMTP 身份验证用户名:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['email_setup']->value['email_id'];?>
" name="email_id" id="email_id" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required">SMTP 身份验证密码:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" value="<?php echo $_smarty_tpl->tpl_vars['email_setup']->value['email_pass'];?>
" name="email_pass" id="email_pass" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required">测试邮件地址:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="email_test" id="email_test" class="txt"></td>
          <td class="vatop tips"><input type="button" value="测试" name="send_test_email" class="btn" id="send_test_email"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.settingForm.submit()"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
$(document).ready(function(){
	/*$("#form_email").validate({
		rules: {
			email_host: {required:"#email_type_1:checked"},
			email_port: {required:"#email_type_1:checked"},
			email_addr: {required:"#email_type_1:checked"},
			email_id: {required:"#email_type_1:checked"},
			email_pass: {required:"#email_type_1:checked"}
		},
		messages: {
			email_host: {required:""},
			email_port: {required:""},
			email_addr: {required:""},
			email_id: {required:""},
			email_pass: {required:""}
		}
	});*/
	$('#send_test_email').click(function(){
		$.ajax({
			type:'post',
			url:'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
setup/setup/ajax_email?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
',
			data:'email_host='+$('#email_host').val()+'&email_port='+$('#email_port').val()+'&email_addr='+$('#email_addr').val()+'&email_id='+$('#email_id').val()+'&email_pass='+$('#email_pass').val()+'&email_type='+1+'&email_test='+$('#email_test').val(),
			error:function(){
					alert('测试邮件发送失败，请重新配置邮件服务器');
				},
			success:function(html){
                for(var item in html)
                {
                    alert(html[item]);
                }
				//alert(html);
			},
			dataType:'json'
		});
	});
});
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>