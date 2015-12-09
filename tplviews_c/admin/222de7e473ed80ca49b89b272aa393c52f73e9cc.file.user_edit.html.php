<?php /* Smarty version Smarty-3.1.11, created on 2015-06-30 15:52:15
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\member\member\user_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:3232555924aafdf3df9-38843581%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '222de7e473ed80ca49b89b272aa393c52f73e9cc' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\member\\member\\user_edit.html',
      1 => 1416329584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3232555924aafdf3df9-38843581',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
    'info' => 0,
    'IMG_PATH' => 0,
    'ac_list' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55924ab013c2b2_73669864',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55924ab013c2b2_73669864')) {function content_55924ab013c2b2_73669864($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
selarea.js"></script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>会员管理</h3>
      <ul class="tab-base">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/lists?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_add?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>新增</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>编辑</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="user_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="dosubmit" value="ok" />
    <input type="hidden" name="member_id" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['user_id'];?>
" />
    <input type="hidden" name="old_member_avatar" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['head_ico'];?>
" />
    <input type="hidden" name="member_name" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['username'];?>
" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label>会员名:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $_smarty_tpl->tpl_vars['info']->value['username'];?>
</td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="member_passwd">密码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="member_passwd" name="member_passwd" class="txt"></td>
          <td class="vatop tips">留空表示不修改密码</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="member_email">电子邮箱:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['email'];?>
" id="member_email" name="member_email" class="txt"></td>
          <td class="vatop tips">电子邮箱</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="member_truename">真实姓名:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['truename'];?>
" id="member_truename" name="member_truename" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label> 性别:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<ul>
              <li><label><input type="radio" value="0" name="member_sex" <?php if ($_smarty_tpl->tpl_vars['info']->value['sex']==0){?>checked<?php }?>>保密</label></li>
              <li><label><input type="radio" value="1" name="member_sex" <?php if ($_smarty_tpl->tpl_vars['info']->value['sex']==1){?>checked<?php }?>>男</label></li>
              <li><label><input type="radio" value="2" name="member_sex" <?php if ($_smarty_tpl->tpl_vars['info']->value['sex']==2){?>checked<?php }?>>女</label></li>
            </ul>
          </td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="member_birthday">生日:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['birthday'];?>
" id="member_birthday" name="member_birthday" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>头像:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">            <span class="type-file-show"><img class="show_image" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
preview.png">
            <div class="type-file-preview"><img src="/<?php echo $_smarty_tpl->tpl_vars['info']->value['head_ico'];?>
" onload="javascript:DrawImage(this,128,128);"></div>
            </span>
                        <span class="type-file-box">
            <input type="file" class="type-file-file" id="member_avatar" name="member_avatar" size="30">
            </span></td>
          <td class="vatop tips">支持格式gif,jpg,jpeg,png</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="member_phone">电话:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['phone'];?>
" id="member_phone" name="member_phone" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="member_tel">手机:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['tel'];?>
" id="member_tel" name="member_tel" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="member_province">地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<select name="province_id" id="province_id" style="width:100px;">
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ac_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
              <option  value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['info']->value['province_id']==$_smarty_tpl->tpl_vars['v']->value['id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</option>
							<?php } ?>
          	</select>
          	<select name="city_id" id="city_id" style="width:80px;">
      			</select>
      			<select name="area_id" id="area_id" style="width:80px;">
      			</select>
      			<script language="javascript">
      			setup(<?php echo $_smarty_tpl->tpl_vars['info']->value['province_id'];?>
,<?php echo $_smarty_tpl->tpl_vars['info']->value['city_id'];?>
,<?php echo $_smarty_tpl->tpl_vars['info']->value['area_id'];?>
);
      			</script>
          	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['address'];?>
" id="member_address" name="member_address" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>允许登录:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="memberstate_1" class="cb-enable <?php if ($_smarty_tpl->tpl_vars['info']->value['isclose']=='1'){?>selected<?php }?>" ><span>允许</span></label>
            <label for="memberstate_2" class="cb-disable <?php if ($_smarty_tpl->tpl_vars['info']->value['isclose']=='0'){?>selected<?php }?>" ><span>禁止</span></label>
            <input id="memberstate_1" name="memberstate" <?php if ($_smarty_tpl->tpl_vars['info']->value['isclose']==1){?>checked="checked"<?php }?> value="1" type="radio">
            <input id="memberstate_2" name="memberstate" <?php if ($_smarty_tpl->tpl_vars['info']->value['isclose']==0){?>checked="checked"<?php }?> value="0" type="radio"></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript">
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#user_form").valid()){
     $("#user_form").submit();
	}
	});
});
//
$(function(){
    $('#user_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        onkeyup    : false,
        rules : {
            member_passwd: {
                maxlength: 20,
                minlength: 6
            },
            member_email   : {
                required : true,
                email : true,
				remote   : {
                    url :'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/ajax_user_email/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&mt'+Math.random(),
                    type:'get',
                    data:{
                        user_email : function(){
                            return $('#member_email').val();
                        },
                        member_id : '<?php echo $_smarty_tpl->tpl_vars['info']->value['user_id'];?>
'
                    }
                }
            }
        },
        messages : {
            member_passwd : {
                maxlength: '密码长度应在6-20个字符之间',
                minlength: '密码长度应在6-20个字符之间'
            },
            member_email  : {
                required : '电子邮箱不能为空',
                email   : '请您填写有效的电子邮箱',
				remote : '邮件地址已存在，请您换一个'
            }
        }
    });
});

$(function(){
	var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
    $(textButton).insertBefore("#member_avatar");
    $("#member_avatar").change(function(){
	$("#textfield1").val($("#member_avatar").val());
    });
});
</script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['JS_PATH'];?>
jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['JS_PATH'];?>
jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['JS_PATH'];?>
jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript">
$(function(){
    $('#member_birthday').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
</body>
</html><?php }} ?>