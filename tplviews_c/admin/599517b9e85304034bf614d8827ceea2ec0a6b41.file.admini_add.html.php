<?php /* Smarty version Smarty-3.1.11, created on 2014-12-19 16:38:54
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\rights\admini\admini_add.html" */ ?>
<?php /*%%SmartyHeaderCode:130045493e41e8b6b91-85441223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '599517b9e85304034bf614d8827ceea2ec0a6b41' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\rights\\admini\\admini_add.html',
      1 => 1408948710,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '130045493e41e8b6b91-85441223',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sitelist' => 0,
    'v' => 0,
    'rolelist' => 0,
    'arealist' => 0,
    'k' => 0,
    'COM' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5493e41eb1cf56_85855054',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5493e41eb1cf56_85855054')) {function content_5493e41eb1cf56_85855054($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <form id="infoform" name="infoform" method="post">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2">
      <tbody>
       <tr><td colspan="2" class="required"><label class="validation" for="username">用户名：</label></td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="username" id="username" class="txt"></td>
          <td class="vatop tips">请输入您要添加的管理员用户名</td>
        </tr>
       <tr ><td colspan="2" class="required"><label class="validation" for="password">密码：</label></td></tr>
       <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="password" id="password" class="txt"></td>
          <td class="vatop tips">请输入您要添加的管理员密码</td>
       </tr>
        <?php if (false){?>
       <tr><td colspan="2" class="required"><label  class="validation"  for="site_id">站点:</label></td></tr>
       <tr class="noborder">
	         <td class="vatop rowform">
	         <select name="site_id" id="site_id">
	         	<option value="" >---未选择---</option>
	         	 <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sitelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['sitename'];?>
</option>
	         	 <?php } ?>
	         	  </select>
			  </td>
              <td class="vatop tips">请选择管理员需要管理的站点</td>
        </tr>
        <?php }?>
       <tr><td colspan="2" class="required"><label  class="validation"  for="role_id">角色:</label></td></tr>
       <tr class="noborder">
	         <td class="vatop rowform">
	         <select name="role_id" id="role_id">
	         	<option value="" >---未选择---</option>
	         	 <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rolelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
	         	 <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['rolename'];?>
</option>
				 <?php } ?>
	         </select>
			 </td>
             <td class="vatop tips">请先选择站点，然后选择需要的角色</td>
        </tr>
        <tr><td colspan="2" class="required"><label    for="areaids">负责区域:</label></td></tr>
       	<tr class="noborder">
	         <td class="vatop ">
	         	 <?php $_smarty_tpl->tpl_vars["k"] = new Smarty_variable(1, null, 0);?>
	         	 <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arealist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
	         	 <input type="checkbox" name="areaids[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
&nbsp;&nbsp;<?php if (($_smarty_tpl->tpl_vars['k']->value%4)==0){?><br><?php }?>
				 		 <?php $_smarty_tpl->tpl_vars["k"] = new Smarty_variable($_smarty_tpl->tpl_vars['k']->value+1, null, 0);?>
				 		 <?php } ?>
			 			</td>
            <td class="vatop tips">仅当觉色为区域经理时需要选择负责区域</td>
        </tr>
      </tbody>
    </table>
    <input style='display:none;' type="submit" name="dosubmit" id="dosubmit" value=" 提交 ">
  </form>
</div>
<script>
$(document).ready(function(){

	$("#site_id").change(function(){
	  	var value = $(this).val();
		$.getJSON('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
system/admini/public_rolelist/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&site_id='+value, function(data){
			if (data != null) {
				str='';
				$.each(data, function(i,n){
						str +='<option value="'+n.roleid+'" >'+n.rolename+'</option>'
				});
				$('#role_id').html(str);
			} else {
				$('#role_id').html('<option value="" >---未选择---</option>');
			}
		});
	});

	$('#infoform').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        onfocusout : false,
        onkeyup    : false,
        rules : {
       		'username' : {
                required : true,
                minlength: 2,
				maxlength: 20,
				remote	: {
                    url :'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
system/admini/public_check_admini/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
',
                    type:'get',
                    data:{
                    	'username' : function(){
                            return $('#username').val();
                        }
                    }
               }
            },
            'password' : {
                required : true,
            },
            'role_id' : {
                required : true,
            }
        },
        messages : {
        	'username'  : {
                required : '用户名不能为空',
				minlength: '用户名长度为2-20',
				maxlength: '用户名长度为2-20',
				remote	 : '该管理员名称已存在'
            },
            'password'  : {
                required : '请输入密码',
            },
            'role_id'  : {
                required : '请输入选择所属角色',
            }
        }
    });
});



</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>