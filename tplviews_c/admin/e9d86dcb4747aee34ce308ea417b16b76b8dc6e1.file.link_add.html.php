<?php /* Smarty version Smarty-3.1.11, created on 2015-05-25 12:50:17
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\marketing\link\link_add.html" */ ?>
<?php /*%%SmartyHeaderCode:159195562aa0956b7a5-44214975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9d86dcb4747aee34ce308ea417b16b76b8dc6e1' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\marketing\\link\\link_add.html',
      1 => 1381081046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159195562aa0956b7a5-44214975',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'COM' => 0,
    'lc_list' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5562aa09671363_61333017',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5562aa09671363_61333017')) {function content_5562aa09671363_61333017($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
        <li><a href="JavaScript:void(0);" class="current"><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="link_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2 nobdb">
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
"><?php echo $_smarty_tpl->tpl_vars['v']->value['lc_name'];?>
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
              <li>
                <input type="radio" name="link_class" id="link_class_text" value="logo" />
                <label for="s_dtype_text">LOGO链接</label>
              </li>
              <li>
                <input type="radio" name="link_class" id="link_class_image" value="text"  checked="checked" />
                <label for="s_dtype_image">文字链接</label>
              </li>
            </ul></td>
          <td class="vatop tips">图片链接或者文字链接</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_title"> 标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="link_title" id="link_title" class="txt"></td>
          <td class="vatop tips">友情链接名称</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="link_url"> 链接:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="http://" name="link_url" id="link_url" class="txt"></td>
          <td class="vatop tips">友情链接链接地址</td>
        </tr>
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_name"> 申请人:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="link_name" id="link_name" class="txt"></td>
          <td class="vatop tips">申请人名称</td>
        </tr>
        <tr class="image_display" >
          <td colspan="2" class="required"><label for="link_pic">图片标识:</label></td>
        </tr>
        <tr class="image_display noborder">
          <td class="vatop rowform"><span class="type-file-box">
            <input type="file" name="link_pic" id="link_pic" class="type-file-file" size="30" >
            </span></td>
          <td class="vatop tips">友情链接标志图片</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="link_sort">排序:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="255" name="link_sort" id="link_sort" class="txt"></td>
          <td class="vatop tips">数字越小越靠前</td>
        </tr>
		<tr>
          <td colspan="2" class="required"><label for="link_info">网站介绍:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea id="link_info" name="link_info" rows="6" class="tarea" ></textarea></td>
          <td class="vatop tips">网站基本介绍</td>
        </tr>
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="link_recommend"> 推荐:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
              <li>
                <input type="radio" name="link_recommend" id="link_recommend" value="0" />
                <label for="s_dtype_text">是</label>
              </li>
              <li>
                <input type="radio" name="link_recommend" id="link_recommend" value="1"  checked="checked" />
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
                <input type="radio" name="link_pass" id="link_pass" value="0" />
                <label for="s_dtype_text">是</label>
              </li>
              <li>
                <input type="radio" name="link_pass" id="link_pass" value="1"  checked="checked" />
                <label for="s_dtype_image">否</label>
              </li>
            </ul></td>
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
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#link_form").valid()){
     $("#link_form").submit();
	}
	});
});

//规格图片显示与隐藏操作
	$('.image_display').hide();
	$('#link_class_text').click(function(){
		$('.image_display').show();
	});
	$('#link_class_image').click(function(){
		$('.image_display').hide();
	});

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
		    link_category : {
                required : true
            },
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
		    link_category : {
                required : '分类不能为空'
            },
			link_title  : {
                required :  '友情链接标题不能为空',
				remote	 :  '该友情链接标题已存在'
            },
            link_url  : {
                required : '请填写友情链接的链接地址',
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