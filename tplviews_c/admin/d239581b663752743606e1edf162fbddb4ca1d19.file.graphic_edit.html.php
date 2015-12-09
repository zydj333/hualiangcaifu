<?php /* Smarty version Smarty-3.1.11, created on 2015-01-16 15:24:17
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\content\graphic\graphic_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:1334254b8bca11428a6-66618871%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd239581b663752743606e1edf162fbddb4ca1d19' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\content\\graphic\\graphic_edit.html',
      1 => 1415496038,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1334254b8bca11428a6-66618871',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
    'pic_id' => 0,
    'graphic' => 0,
    'lc_list' => 0,
    'v' => 0,
    'IMG_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54b8bca1403124_44942567',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b8bca1403124_44942567')) {function content_54b8bca1403124_44942567($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>服务经理</h3>
      <ul class="tab-base">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/graphic/lists/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
marketing/graphic/graphic_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>新增</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>编辑</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="graphic_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="dosubmit" value="ok" />
    <input type="hidden" name="pic_id" id="pic_id" value="<?php echo $_smarty_tpl->tpl_vars['pic_id']->value;?>
" />
    <input type="hidden" name="old_pic_thumb" value="<?php echo $_smarty_tpl->tpl_vars['graphic']->value['pic_thumb'];?>
" />
    <table class="table tb-type2">
      <tbody>
	    <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="graphic_category"> 分类:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<select name="pic_category" id="pic_category">
               <option value="">请选择...</option>
               <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lc_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['lc_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['graphic']->value['pic_category']==$_smarty_tpl->tpl_vars['v']->value['lc_id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['lc_name'];?>
</option>
							<?php } ?>
            </select></td>
          <td class="vatop tips">请选择分类</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="pic_title">姓名:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="pic_title" id="pic_title" value="<?php echo $_smarty_tpl->tpl_vars['graphic']->value['pic_title'];?>
" class="txt"></td>
          <td class="vatop tips">请填写姓名</td>
        </tr>
        <tr class="noborder" >
          <td colspan="2" class="required"><label for="pic_thumb">头像:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show"><img class="show_image" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
preview.png">
            <div class="type-file-preview"><img src="/<?php echo $_smarty_tpl->tpl_vars['graphic']->value['pic_thumb'];?>
"></div>
            </span>
          	<span class="type-file-box">
            <input type="file" name="pic_thumb" id="pic_thumb" class="type-file-file" size="30" >
            </span></td>
          <td class="vatop tips">请选择图片</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="listorder">手机号码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['graphic']->value['phone'];?>
" name="phone" id="phone" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="listorder">QQ号码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['graphic']->value['qq'];?>
" name="qq" id="qq" class="txt"></td>
          <td class="vatop tips">数字越小越靠前</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="listorder">电子邮箱:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['graphic']->value['email'];?>
" name="email" id="email" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="listorder">排序:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="255" name="listorder" id="listorder" value="<?php echo $_smarty_tpl->tpl_vars['graphic']->value['listorder'];?>
" class="txt"></td>
          <td class="vatop tips">数字越小越靠前</td>
        </tr>
				<tr>
          <td colspan="2" class="required"><label for="pic_info">介绍:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea id="pic_info" name="pic_info" rows="6" class="tarea" ><?php echo $_smarty_tpl->tpl_vars['graphic']->value['pic_info'];?>
</textarea></td>
          <td class="vatop tips">服务经理简单介绍</td>
        </tr>
				<tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="isshow"> 显示:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
              <li>
                <input type="radio" name="isshow" id="isshow0" value="0" <?php if ($_smarty_tpl->tpl_vars['graphic']->value['isshow']=='0'){?>checked="checked"<?php }?> />
                <label for="s_dtype_text">是</label>
              </li>
              <li>
                <input type="radio" name="isshow" id="isshow1" value="1"  <?php if ($_smarty_tpl->tpl_vars['graphic']->value['isshow']=='1'){?>checked="checked"<?php }?> />
                <label for="s_dtype_image">否</label>
              </li>
            </ul></td>
          <td class="vatop tips"></td>
        </tr>
        
        
        
        
		
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#graphic_form").valid()){
     $("#graphic_form").submit();
	}
	});
});

$(document).ready(function(){
	$('#graphic_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
            pic_title : {
                required : true,
								remote	: {
                    url :'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/graphic/ajax_public_check_graphic/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&mt'+Math.random(),
                    type:'get',
                    data:{
                    	pic_title : function(){
                            return $('#pic_title').val();
                        },
											pic_id : function(){
                            return $('#pic_id').val();
                        },
                    }
               }
            },
            listorder : {
                number   : true
            }
        },
        messages : {
            pic_title  : {
                required :  '信息标题不能为空',
								remote	 :  '该信息标题已存在'
            },
            listorder  : {
                number   : '排序仅能为数字'
            }
        }
    });
});
</script>
<script type="text/javascript">
$(function(){
    var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
	$(textButton).insertBefore("#pic_thumb");
	$("#pic_thumb").change(function(){
	$("#textfield1").val($("#pic_thumb").val());
});
});
</script>
</body>
</html><?php }} ?>