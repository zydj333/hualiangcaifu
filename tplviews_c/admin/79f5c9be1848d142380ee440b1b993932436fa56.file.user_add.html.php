<?php /* Smarty version Smarty-3.1.11, created on 2015-07-02 13:31:18
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\member\member\user_add.html" */ ?>
<?php /*%%SmartyHeaderCode:184755594cca6336250-70928000%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79f5c9be1848d142380ee440b1b993932436fa56' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\member\\member\\user_add.html',
      1 => 1416329558,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184755594cca6336250-70928000',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
    'ac_list' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5594cca6530713_15101916',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5594cca6530713_15101916')) {function content_5594cca6530713_15101916($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
        <li><a href="JavaScript:void(0);" class="current"><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="user_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="member_name">会员名:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="member_name" id="member_name" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="member_passwd">密码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="member_passwd" name="member_passwd" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="member_email">电子邮箱:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_email" name="member_email" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="member_truename">真实姓名:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_truename" name="member_truename" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label> 性别:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
              <li>
                <label>
                  <input type="radio" checked="checked" value="0" name="member_sex">
                  保密</label>
              </li>
              <li>
                <label>
                  <input type="radio" value="1" name="member_sex">
                  男</label>
              </li>
              <li>
                <label>
                  <input type="radio" value="2" name="member_sex">
                  女</label>
              </li>
            </ul></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="member_birthday">生日:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_birthday" name="member_birthday" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <!--<tr>
          <td colspan="2" class="required"><label for="member_qq">QQ:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_qq" name="member_qq" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="member_msn">阿里旺旺:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_ww" name="member_ww" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="member_msn">MSN:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_msn" name="member_msn" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>-->
        <tr>
          <td colspan="2" class="required"><label>头像:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><span class="type-file-box">
            <input type="file" class="type-file-file" id="member_avatar" name="member_avatar" size="30">
            </span>
            <input name="link_pic" type="file" class="type-file-file" id="link_pic" size="30">
            </span></td>
          <td class="vatop tips">支持格式gif,jpg,jpeg,png</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="member_phone">手机:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_phone" name="member_phone" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="member_tel">电话:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_tel" name="member_tel" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <!--<tr>
          <td colspan="2" class="required"><label for="member_msn">公司名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_web" name="member_web" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>-->
        <tr>
          <td colspan="2" class="required"><label class="member_province">地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<select name="province_id" id="province_id" style="width:80px;">
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ac_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
              <option  value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</option>
							<?php } ?>
          	</select>
          	<select name="city_id" id="city_id" style="width:80px;">
      			</select>
      			<select name="area_id" id="area_id" style="width:80px;">
      			</select>
          	<input type="text" value="" id="member_address" name="member_address" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <!--<tr>
          <td colspan="2" class="required"><label for="member_msn">信用额度:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" id="member_freezedeposit" name="member_freezedeposit" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>-->
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
						member_name: {
							required : true,
							minlength: 2,
							maxlength: 20,
							remote   : {
                    url : '<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/ajax_user_name/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&mt'+Math.random(),
                    type:'get',
                    data:{
                        user_name : function(){
                            return $('#member_name').val();
                        },
                    }
                }
						},
            member_passwd: {
            	  required : true,
                maxlength: 20,
                minlength: 6
            },
            member_email   : {
                required : true,
                email : true,
								remote   : {
                    url : '<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/ajax_user_email/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&mt'+Math.random(),
                    type:'get',
                    data:{
                        user_email : function(){
                            return $('#member_email').val();
                        },
                    }
                }
            },
            member_phone: {
            	  required : true
            },
						member_qq : {
							digits: true,
							minlength: 5,
							maxlength: 11
						},
						member_msn : {
							email: true
						}
        },
        messages : {
						member_name: {
							required : '会员名不能为空',
							maxlength: '用户名必须在3-20字符之间',
							minlength: '用户名必须在3-20字符之间',
							remote   : '会员名已存在，请您换一个'
						},
            member_passwd : {
            	  required : '密码不能为空',
                maxlength : '密码长度应在6-20个字符之间',
                minlength : '密码长度应在6-20个字符之间'
            },
            member_email : {
                required : '电子邮箱不能为空',
                email    : '请您填写有效的电子邮箱',
								remote   : '邮件地址已存在，请您换一个'
            },
            member_phone : {
                required : '手机号码不能为空'
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
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>