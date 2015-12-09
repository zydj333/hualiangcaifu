<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:07:16
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\member\notice\sys_notice.html" */ ?>
<?php /*%%SmartyHeaderCode:2953855507144485dd9-01870908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30340ababc78293c9198e9893d48fe71cb524f52' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\member\\notice\\sys_notice.html',
      1 => 1404807284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2953855507144485dd9-01870908',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_555071444d3fd8_27011626',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555071444d3fd8_27011626')) {function content_555071444d3fd8_27011626($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>系统消息</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>发送消息</span></a></li>
       
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="notice_form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label>发送类型: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul class="nofloat">
              <li>
                <label><input type="radio" checked="" value="1" name="send_type">指定会员</label>
              </li>
              <li>
                <label><input type="radio" value="2" name="send_type" />全部会员</label>
              </li>
            </ul>
          </td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tbody id="user_list">
        <tr>
          <td colspan="2" class="required"><label class="validation" for="user_name">会员列表: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea id="user_name" name="user_name" rows="6" class="tarea" ></textarea></td>
          <td class="vatop tips">多个会员请用逗号分隔</td>
        </tr>
      </tbody>
      <tbody id="msg">
      	<tr>
          <td colspan="2" class="required"><label class="validation">消息标题: </label></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="vatop rowform"><input  type="text" value="" name="message_title" id="message_title"  class="txt"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation">消息内容: </label></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="vatop rowform"><textarea name="content1" rows="6" class="tarea"></textarea></td>
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
    if($("#notice_form").valid()){
        $("#notice_form").submit();
	}

	});
});
$(document).ready(function(){
	$('#notice_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : { 
            user_name : {
                required : check_user_name  
            },
            "store_grade[]":{
            	required : check_store_grade
            },
            content1 :{
            	required : true
            }
        },
        messages : {
            user_name :{
                required     : '指定会员发送，会员名不能为空且一行一个会员名'
            },
            "store_grade[]":{
            	required : '店铺等级不能为空'
            },
            content1 :{
            	required : '礼物内容不能为空'
            }
        },
		submitHandler: function(form) {
			form.submit();
		}
    });
    function check_user_name()
    {
        var rs = $(":input[name='send_type']:checked").val();
        return rs == 1 ? true : false; 
    }
    function check_store_grade()
    {
        var rs = $(":input[name='send_type']:checked").val();
        return rs == 3 ? true : false; 
    }
    
    $("input[name='send_type']").click(function(){
        var rs = $(this).val();
        switch(rs)
        {
            case '1':
                $('#user_list').show();
                $('#store_grade_list').hide();
                break;
            case '2':
                $('#user_list').hide();
                $('#store_grade_list').hide();
                break;
        }
    });
});
</script>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>