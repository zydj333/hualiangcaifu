<?php /* Smarty version Smarty-3.1.11, created on 2015-07-02 17:31:39
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\mypanel\password\edit_password.html" */ ?>
<?php /*%%SmartyHeaderCode:8049559504fbdac042-56333984%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '110f9f7da319222f6cf5293be6dc3cfd0ed26449' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\mypanel\\password\\edit_password.html',
      1 => 1383627936,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8049559504fbdac042-56333984',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_559504fbe9df37_07841045',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_559504fbe9df37_07841045')) {function content_559504fbe9df37_07841045($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>修改密码</h3>
      <!--<ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current" ><span></span></a></li>
      </ul>-->
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="form1" id="passwd">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="ori_passwd">原密码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="ori_passwd" name="ori_passwd" class="txt"></td>
          <td class="vatop tips">请输入原密码</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="password">新密码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="password" name="password" class="txt"></td>
          <td class="vatop tips">请输入您要修改的密码</td>
        </tr>
		<tr>
          <td colspan="2" class="required"><label class="validation" for="password_confirm">确  认:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="password_confirm" name="password_confirm" class="txt"></td>
          <td class="vatop tips">请再次输入您要修改的密码</td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery.ipassword.js"></script>
<!--<script type="text/javascript">
$(document).ready(function(){
	// to enable iPass plugin
	$("input[type=password]").iPass();
});
</script>-->
<script type="text/javascript">
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#passwd").valid()){
     $("#passwd").submit();
	}
	});
});
$(function(){
    $('#passwd').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        onkeyup    : false,
        rules : {
			ori_passwd : {
                required : true,
                remote   : {
                    url : '<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
mypanel/mypanel/ajax_passwd/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&mt'+Math.random(),
                    type: 'get',
                    data:{
                        ori_passwd : function(){
                            return $('#ori_passwd').val();
                        }
                    }
                }
            },
            password : {
                required : true,
                minlength: 6,
				maxlength: 20
            },
            password_confirm : {
                required : true,
                equalTo  : '#password'
            },

        },
        messages : {
            ori_passwd : {
                required : '原密码不能为空',
				remote	 : '原密码错误！'
            },
            password  : {
                required : '密码不能为空',
                minlength: '密码长度应在6-20个字符之间',
				maxlength: '密码长度应在6-20个字符之间'
            },
            password_confirm : {
                required : '再次输入您的密码',
                equalTo  : '两次输入的密码不一致'
            },

        }
    });
});

</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>