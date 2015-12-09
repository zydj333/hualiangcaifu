<?php /* Smarty version Smarty-3.1.11, created on 2014-12-26 13:58:18
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\marketing\link\link_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:6408549cf8facf86f3-03601893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '085a8eeb37546237811c39c35e90e10fe0808b1e' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\marketing\\link\\link_edit.html',
      1 => 1381081046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6408549cf8facf86f3-03601893',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
    'link_id' => 0,
    'link' => 0,
    'lc_list' => 0,
    'v' => 0,
    'IMG_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_549cf8fb184d19_83036878',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549cf8fb184d19_83036878')) {function content_549cf8fb184d19_83036878($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>合作伙伴</h3>
      <ul class="tab-base">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
marketing/link/link_list/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
marketing/link/link_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>新增</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>编辑</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="link_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="dosubmit" value="ok" />
    <input type="hidden" name="link_id" id="link_id" value="<?php echo $_smarty_tpl->tpl_vars['link_id']->value;?>
" />
    <input type="hidden" name="old_link_pic" value="<?php echo $_smarty_tpl->tpl_vars['link']->value['link_pic'];?>
" />
    <table class="table tb-type2">
      <tbody>
	    <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_category"> 分类:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select name="link_category" id="link_category">
                <option value="">请选择...</option>
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lc_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['lc_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['link']->value['link_category']==$_smarty_tpl->tpl_vars['v']->value['lc_id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['lc_name'];?>
</option>
				<?php } ?>
            </select></td>
          <td class="vatop tips">请选择友情链接分类</td>
        </tr>
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_class"> 链接类型:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
              <?php if ($_smarty_tpl->tpl_vars['link']->value['link_class']=='logo'){?>
			  <li>
                <input type="radio" name="link_class" id="link_class_text" value="logo" <?php if ($_smarty_tpl->tpl_vars['link']->value['link_class']=='logo'){?>checked="checked"<?php }?> />
                <label for="s_dtype_text">LOGO链接</label>
              </li>
			  <?php }?>
			  <?php if ($_smarty_tpl->tpl_vars['link']->value['link_class']=='text'){?>
              <li>
                <input type="radio" name="link_class" id="link_class_image" value="text" <?php if ($_smarty_tpl->tpl_vars['link']->value['link_class']=='text'){?>checked="checked"<?php }?> />
                <label for="s_dtype_image">文字链接</label>
              </li>
			   <?php }?>
            </ul></td>
          <td class="vatop tips">图片链接或者文字链接</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_title">标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['link']->value['link_title'];?>
" name="link_title" id="link_title" class="txt"></td>
          <td class="vatop tips">友情链接的名称</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="link_url">链接:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['link']->value['link_url'];?>
" name="link_url" id="link_url" class="txt"></td>
          <td class="vatop tips">友情链接的链接地址</td>
        </tr>
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_name"> 申请人:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['link']->value['link_name'];?>
" name="link_name" id="link_name" class="txt"></td>
          <td class="vatop tips">申请人名称</td>
        </tr>
		<?php if ($_smarty_tpl->tpl_vars['link']->value['link_class']=='logo'){?>
        <tr class="image_display">
          <td colspan="2" class="required"><label for="">图片标识:</label></td>
        </tr>
        <tr class="image_display noborder">
          <td class="vatop rowform"><span class="type-file-show"><img class="show_image" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
preview.png">
            <div class="type-file-preview"><img src="/<?php echo $_smarty_tpl->tpl_vars['link']->value['link_pic'];?>
"></div>
            </span> <span class="type-file-box">
            <input name="link_pic" type="file" value="<?php echo $_smarty_tpl->tpl_vars['link']->value['link_pic'];?>
" class="type-file-file" id="link_pic" size="30">
            </span></td>
          <td class="vatop tips">            </td>
        </tr>
		<?php }?>
        <tr>
          <td colspan="2" class="required"><label for="link_sort">排序:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['link']->value['listorder'];?>
" name="link_sort" id="link_sort" class="txt"></td>
          <td class="vatop tips">数字越小越靠前</td>
        </tr>
		<tr>
          <td colspan="2" class="required"><label for="link_info">网站介绍:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea id="link_info" name="link_info" rows="6" class="tarea" ><?php echo $_smarty_tpl->tpl_vars['link']->value['link_info'];?>
</textarea></td>
          <td class="vatop tips">网站基本介绍</td>
        </tr>
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_recommend"> 推荐:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
              <li>
                <input type="radio" name="link_recommend" id="link_recommend" value="0" <?php if ($_smarty_tpl->tpl_vars['link']->value['link_recommend']=='0'){?>checked="checked"<?php }?> />
                <label for="s_dtype_text">是</label>
              </li>
              <li>
                <input type="radio" name="link_recommend" id="link_recommend" value="1"  <?php if ($_smarty_tpl->tpl_vars['link']->value['link_recommend']=='1'){?>checked="checked"<?php }?> />
                <label for="s_dtype_image">否</label>
              </li>
            </ul></td>
          <td class="vatop tips"></td>
        </tr>
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_pass"> 通过:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
              <li>
                <input type="radio" name="link_pass" id="link_pass" value="0" <?php if ($_smarty_tpl->tpl_vars['link']->value['link_pass']=='0'){?>checked="checked"<?php }?> />
                <label for="s_dtype_text">是</label>
              </li>
              <li>
                <input type="radio" name="link_pass" id="link_pass" value="1"  <?php if ($_smarty_tpl->tpl_vars['link']->value['link_pass']=='1'){?>checked="checked"<?php }?> />
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
    if($("#link_form").valid()){
     $("#link_form").submit();
	}
	});
});

//规格图片显示与隐藏操作
	/*$('.image_display').hide();
	$('#link_class_text').click(function(){
		$('.image_display').show();
	});
	$('#link_class_image').click(function(){
		$('.image_display').hide();
	});*/
//
$(document).ready(function(){
	$('#link_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
            link_title : {
                required : true,
				remote	: {
                    url :'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
marketing/link/ajax_public_check_link/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&mt'+Math.random(),
                    type:'get',
                    data:{
                    	link_title : function(){
                            return $('#link_title').val();
                        },
						link_id : function(){
                            return $('#link_id').val();
                        },
                    }
               }
            },
            link_url  : {
                required : true,
                url      : true
            },
            link_sort : {
                number   : true
            }
        },
        messages : {
            link_title  : {
                required :  '友情链接标题不能为空',
				remote	 :  '该友情链接标题已存在'
            },
            link_url  : {
                required : '请填写合作伙伴的链接地址',
                url      : '链接格式不正确'
            },
            link_sort  : {
                number   : '排序仅能为数字'
            }
        }
    });
});
</script>
<script type="text/javascript">
$(function(){
    var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
	$(textButton).insertBefore("#link_pic");
	$("#link_pic").change(function(){
	$("#textfield1").val($("#link_pic").val());
});
});
</script>
</body>
</html><?php }} ?>