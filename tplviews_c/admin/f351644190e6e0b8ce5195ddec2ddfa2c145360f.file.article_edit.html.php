<?php /* Smarty version Smarty-3.1.11, created on 2014-12-26 13:59:13
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\content\article\article_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:17815549cf931bdc808-15681443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f351644190e6e0b8ce5195ddec2ddfa2c145360f' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\content\\article\\article_edit.html',
      1 => 1405612556,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17815549cf931bdc808-15681443',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'article' => 0,
    'ac_list' => 0,
    'v' => 0,
    'IMG_PATH' => 0,
    'JS_PATH' => 0,
    'file_list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_549cf93223c4c9_32628945',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549cf93223c4c9_32628945')) {function content_549cf93223c4c9_32628945($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>文章管理</h3>
      <ul class="tab-base">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/lists?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_add?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>新增</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>编辑</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
    <form id="article_form" method="post" name="articleForm" enctype="multipart/form-data" >
    <input type="hidden" name="dosubmit" value="ok" />
	<input type="hidden" name="article_id" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['article_id'];?>
" />
	<input type="hidden" name="code_type" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['code_type'];?>
" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['article_title'];?>
" name="article_title" id="article_title" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="cate_id">所属分类:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select name="ac_id" id="ac_id">
              <option value="">请选择...</option>
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ac_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                <option  value="<?php echo $_smarty_tpl->tpl_vars['v']->value['ac_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['v']->value['ac_id']==$_smarty_tpl->tpl_vars['article']->value['ac_id']){?>selected<?php }?>><?php if ($_smarty_tpl->tpl_vars['v']->value['floor']==1){?>&nbsp;&nbsp;<?php }?><?php echo $_smarty_tpl->tpl_vars['v']->value['ac_name'];?>
</option>
				<?php } ?>
             </select></td>
          <td class="vatop tips"></td>
        </tr>
				<tr>
          <td colspan="2" class="required"><label for="article_focus">首页焦点图:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><span class="type-file-show"><img class="show_image" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
preview.png">
            <div class="type-file-preview"><img src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
<?php echo $_smarty_tpl->tpl_vars['article']->value['article_focus'];?>
" ></div>
            </span><span class="type-file-box">
            <input name="article_focus" type="file" class="type-file-file" id="article_focus" size="30" hidefocus="true" >
            </span></td>
          <td class="vatop tips">108px * 144px</td>
        </tr>
				<tr>
          <td colspan="2" class="required"><label for="acticle_logo">缩略图:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><span class="type-file-show"><img class="show_image" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
preview.png">
            <div class="type-file-preview"><img src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
<?php echo $_smarty_tpl->tpl_vars['article']->value['article_logo'];?>
" ></div>
            </span><span class="type-file-box">
            <input name="acticle_logo" type="file" class="type-file-file" id="acticle_logo" size="30" hidefocus="true" >
            </span></td>
          <td class="vatop tips">180px * 50px</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="articleForm">链接:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['article_url'];?>
" name="article_url" id="article_url" class="txt"></td>
          <td class="vatop tips">当填写&quot;链接&quot;后点击文章标题将直接跳转至链接地址，不显示文章内容。链接格式请以http://开头</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>首页推荐:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="isrecommend1" class="cb-enable <?php if ($_smarty_tpl->tpl_vars['article']->value['isrecommend']==1){?>selected<?php }?>" ><span>是</span></label>
            <label for="isrecommend0" class="cb-disable <?php if ($_smarty_tpl->tpl_vars['article']->value['isrecommend']==0){?>selected<?php }?>" ><span>否</span></label>
            <input id="isrecommend1" name="isrecommend" <?php if ($_smarty_tpl->tpl_vars['article']->value['isrecommend']==1){?>checked<?php }?> value="1" type="radio">
            <input id="isrecommend0" name="isrecommend" <?php if ($_smarty_tpl->tpl_vars['article']->value['isrecommend']==0){?>checked<?php }?> value="0" type="radio"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>是否显示:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="article_show1" class="cb-enable <?php if ($_smarty_tpl->tpl_vars['article']->value['article_show']==1){?>selected<?php }?>" ><span>是</span></label>
            <label for="article_show0" class="cb-disable <?php if ($_smarty_tpl->tpl_vars['article']->value['article_show']==0){?>selected<?php }?>" ><span>否</span></label>
            <input id="article_show1" name="article_show" <?php if ($_smarty_tpl->tpl_vars['article']->value['article_show']==1){?>checked<?php }?> value="1" type="radio">
            <input id="article_show0" name="article_show" <?php if ($_smarty_tpl->tpl_vars['article']->value['article_show']==0){?>checked<?php }?> value="0" type="radio"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required">排序:
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['listorder'];?>
" name="article_sort" id="article_sort" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation">文章内容:</label></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="vatop rowform"><textarea id="article_content" name="article_content" style="width:700px;height:300px;visibility:hidden;"><?php echo $_smarty_tpl->tpl_vars['article']->value['article_content'];?>
</textarea>
<script src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
kindeditor/kindeditor-min.js" charset="utf-8"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
kindeditor/lang/zh_CN.js" charset="utf-8"></script>
<script>
	var KE;
  KindEditor.ready(function(K) {
        KE = K.create("textarea[name='article_content']", {
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
        </tr>
        <tr>
          <td colspan="2" class="required">图片上传:</td>
        </tr>
        <tr class="noborder">
		    <td class="y-bg" >
<iframe src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
com/comupload/public_upload_one?btnname=上传图片&instance=article_content&filedir=acticle"  style="width:90px;height:30px;" scrolling="no" frameborder="0" ></iframe>
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
// 模拟网站LOGO上传input type='file'样式
$(function(){
    var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
	$(textButton).insertBefore("#acticle_logo");
	$("#acticle_logo").change(function(){
		$("#textfield1").val($("#acticle_logo").val());
	});
	var textButton2="<input type='text' name='textfield2' id='textfield2' class='type-file-text' /><input type='button' name='button2' id='button2' value='' class='type-file-button' />"
	$(textButton2).insertBefore("#article_focus");
	$("#article_focus").change(function(){
		$("#textfield2").val($("#article_focus").val());
	});
// 上传图片类型
$('input[class="type-file-file"]').change(function(){
	var filepatd=$(this).val();
	var extStart=filepatd.lastIndexOf(".");
	var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("图片限于png,gif,jpeg,jpg格式");
				$(this).attr('value','');
			return false;
		}
	});
});
</script>
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
content/article/ajax_article_pic_del?file_id=' + file_id+'&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
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
    if($("#article_form").valid()){
		$("#article_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#article_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        onfocusout : false,
        onkeyup    : false,
        rules : {
            article_title : {
                required   : true
            },
			ac_id : {
                required   : true
            },
			article_url : {
				url : true
            },
			article_content : {
                required   : true
            },
            article_sort : {
                number   : true
            }
        },
        messages : {
            article_title : {
                required   : '文章标题不能为空'
            },
			ac_id : {
                required   : '文章分类不能为空'
            },
			article_url : {
				url : '链接格式不正确'
            },
			article_content : {
                required   : '文章内容不能为空'
            },
            article_sort  : {
                number   : '文章排序仅能为数字'
            }
        }
    });

});


</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>