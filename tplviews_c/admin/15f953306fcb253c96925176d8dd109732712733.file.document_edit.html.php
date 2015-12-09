<?php /* Smarty version Smarty-3.1.11, created on 2014-12-19 16:39:33
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\content\document\document_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:145395493e445e035e8-21233836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15f953306fcb253c96925176d8dd109732712733' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\content\\document\\document_edit.html',
      1 => 1406621582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145395493e445e035e8-21233836',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'doc' => 0,
    'IMG_PATH' => 0,
    'JS_PATH' => 0,
    'file_list' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5493e4461b3b38_76161191',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5493e4461b3b38_76161191')) {function content_5493e4461b3b38_76161191($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>系统文章</h3>
      <ul class="tab-base">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/document/lists?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>管理</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="doc_form" method="post">
    <input type="hidden" name="dosubmit" value="ok" />
    <input type="hidden" name="doc_id" value="<?php echo $_smarty_tpl->tpl_vars['doc']->value['doc_id'];?>
" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr>
          <td colspan="2" class="required"><label class="validation">标题: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['doc']->value['doc_title'];?>
" name="doc_title" id="doc_title" class="infoTableInput"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation">文章内容: </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea id="doc_content" name="doc_content" style="width:700px;height:300px;visibility:hidden;"><?php echo $_smarty_tpl->tpl_vars['doc']->value['doc_content'];?>
</textarea>
<script src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
kindeditor/kindeditor-min.js" charset="utf-8"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
kindeditor/lang/zh_CN.js" charset="utf-8"></script>
<script>
	var KE;
  KindEditor.ready(function(K) {
        KE = K.create("textarea[name='doc_content']", {
						items : ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste',
			'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
			'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
			'superscript', '|', 'selectall', 'clearhtml','quickformat','|',
			'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
			'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|'/*, 'image'*/, 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
						cssPath : "<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
kindeditor/themes/default/default.css",
						allowImageUpload : true,
						allowFlashUpload : false,
						allowMediaUpload : false,
						allowFileManager : false,
						syncType:"form",
						afterCreate : function() {
							var self = this;
							self.sync();
						},
						afterChange : function() {
							var self = this;
							self.sync();
						},
						afterBlur : function() {
							var self = this;
							self.sync();
						}
        });
			KE.appendHtml = function(id,val) {
				this.html(this.html() + val);
				if (this.isCreated) {
					var cmd = this.cmd;
					cmd.range.selectNodeContents(cmd.doc.body).collapse(false);
					cmd.select();
				}
				return this;
			}
	});
</script>
	</td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required">图片上传:</td>
        </tr>
        <tr class="noborder">
		    <td class="y-bg" >
<iframe src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
com/comupload/public_upload_one?btnname=上传图片&instance=document_content&filedir=document"  style="width:90px;height:30px;" scrolling="no" frameborder="0" ></iframe>

</td>
		  	</tr>
			<tr>
		    	<td colspan="2" class="required">已传图片:</td>
		    </tr>
		    <tr class="noborder">
              <td colspan="2">
		    <ul id="thumbnails" class="thumblists">
<?php if (isset($_smarty_tpl->tpl_vars['file_list']->value)){?>
<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['file_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
	<li id="<?php echo $_smarty_tpl->tpl_vars['v']->value['file_id'];?>
" class="picture" >
        <input type="hidden" name="file_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['file_id'];?>
" />
        <div class="size-64x64"><span class="thumb size-64x64"><i></i><img src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
<?php echo remain_image_path($_smarty_tpl->tpl_vars['v']->value['filepath'],'w');?>
" alt="<?php echo $_smarty_tpl->tpl_vars['v']->value['realname'];?>
" onload="javascript:DrawImage(this,64,64);"/></span></div>
        <p><span><a href="javascript:insert_editor('<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
<?php echo $_smarty_tpl->tpl_vars['v']->value['filepath'];?>
');">插入</a></span><span><a href="javascript:del_file_upload('<?php echo $_smarty_tpl->tpl_vars['v']->value['file_id'];?>
');">删除</a></span></p>
    </li>
<?php } ?>
<?php }?>
            </ul>
		    </td>
		  	</tr>

<script type="text/javascript">
var SITE_URL = "<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
";
var WEB_URL = "<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
";
var LOGHASH = "<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
";
function do_uploadedfile(file_data){
		file_data = jQuery.parseJSON(file_data);
		if(file_data.state == 'true') {
			var fid=file_data.instance;
			var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb size-64x64"><i></i><img src="' + WEB_URL+'/'+file_data.filepath + '" alt="' + file_data.filename + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'' + WEB_URL+'/'+file_data.filepath + '\');">插入</a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');">删除</a></span></p></li>';
			$('#thumbnails').prepend(newImg);
		}
	}
function insert_editor(file_path){
	KE.appendHtml('article_content', '<img src="'+ file_path + '" alt="'+ file_path + '">');
}
function del_file_upload(file_id)
{
    if(!window.confirm('您确定要删除吗?')){
        return;
    }
    $.getJSON('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
market/booth/ajax_market_file_del?file_id=' + file_id+'&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
', function(result){
        if(result){
            $('#' + file_id).remove();
        }else{
            alert('删除失败');
        }
    });
}
</script>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#doc_form").valid()){
     $("#doc_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#doc_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        onfocusout : false,
        onkeyup    : false,
        rules : {
            doc_title : {
                required   : true
            },
			doc_content : {
                required   : true
            }
        },
        messages : {
            doc_title : {
                required   : '文章标题不能为空'
            },
			doc_content : {
                required   : '文章内容不能为空'
            }
        }
    });

});

</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>