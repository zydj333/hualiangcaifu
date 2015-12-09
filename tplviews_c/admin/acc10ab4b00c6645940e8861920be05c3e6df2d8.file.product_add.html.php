<?php /* Smarty version Smarty-3.1.11, created on 2014-12-15 10:30:17
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\caifu\product\product_add.html" */ ?>
<?php /*%%SmartyHeaderCode:19295548e47b9f1ff36-58126795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'acc10ab4b00c6645940e8861920be05c3e6df2d8' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\caifu\\product\\product_add.html',
      1 => 1418570774,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19295548e47b9f1ff36-58126795',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CSS_PATH' => 0,
    'COM' => 0,
    'category_list' => 0,
    'v' => 0,
    'investment_list' => 0,
    'expenses_area_list' => 0,
    'yield_list' => 0,
    'earning_list' => 0,
    'interest_list' => 0,
    'area_list' => 0,
    'size_list' => 0,
    'JS_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548e47ba3efde7_77275286',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548e47ba3efde7_77275286')) {function content_548e47ba3efde7_77275286($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<link href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
member_goods.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
skin_0.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(function(){
     $('#product_form').validate({
        errorPlacement: function(error, element){
            $(element).next('.field_notice').hide();
            $(element).after(error);
        },
//        success       : function(label){
//            label.addClass('validate_right').text('OK!');
//        },
        onkeyup : false,
        rules : {
        	 category : {
								required   : true
            },
            name2 : {
                required	: true,
                minlength 	: 2,
                maxlength	: 50
            },
            fee_scale : {
								required   : true
            },
            lifetime : {
                number     : true
            },
        },
        messages : {
        		category : {
								required: '产品分类不能为空'
            },
            name2  : {
                required	: '产品名称不能为空',
                minlength 	: '产品标题名称长度至少2个字符，最长50个汉字',
                maxlength 	: '产品标题名称长度至少2个字符，最长50个汉字'
            },
            fee_scale : {
								required: '费用区间不能为空'
            },
            lifetime : {
								number  : '产品期限只能填写数字'
            },
        }
    });

});
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>产品管理</h3>
      <ul class="tab-base">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/product/lists?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>所有产品</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>产品添加</span></a></li>
      </ul>
    </div>
  </div>
  
  <div class="item-publish">
    <form method="post" id="product_form" enctype="multipart/form-data" action="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/product/product_add?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
">
      <input type="hidden" name="dosubmit" value="1" />
      <input type="hidden" name="product_id" value="" />
      <div class="goods-attribute">
        <dl class="tit">
          <h3>产品基本信息</h3>
        </dl>
        <dl>
          <dt>产品分类：</dt>
          <dd>
              <select name="category" id="category">
          		<option value="">----请选择----</option>
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          		<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
</option>
							<?php } ?>
          	</select>
          </dd>
        </dl>
        <dl>
          <dt><span class="red">*</span>产品名称：</dt>
          <dd>
            <p><input name="name2" type="text" class="text" value="" style="width:300px;"/><p>
            <p class="hint">产品标题名称长度至少2个字符，最长50个汉字</p>
          </dd>
        </dl>
        <dl>
          <dt>发行机构：</dt>
          <dd>
            <p><input name="issuer" type="text" class="text" value="" /><p>
          </dd>
        </dl>
        <dl>
          <dt>投资领域：</dt>
          <dd>
              <select name="investment" id="investment">
          		<option value="">----请选择----</option>
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['investment_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          		<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
</option>
							<?php } ?>
          	</select>
          </dd>
        </dl>
        <dl>
          <dt>发行费用区间：</dt>
          <dd>
              <select name="expenses_area" id="expenses_area">
          		<option value="">----请选择----</option>
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['expenses_area_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          		<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
</option>
							<?php } ?>
          	</select>
          </dd>
        </dl>
        <dl>
          <dt>发行费用：</dt>
          <dd>
            <p><textarea id="expenses" class="tarea" name="expenses" ></textarea><p>
          </dd>
        </dl>
        <dl>
          <dt>收益率：</dt>
          <dd>
              <select name="yield" id="yield">
          		<option value="">----请选择----</option>
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yield_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          		<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
</option>
							<?php } ?>
          	</select>
          </dd>
        </dl>
        <dl>
          <dt>年化收益：</dt>
          <dd>
            <p><input name="yield_year" type="text" class="text" value="" /><p>
          </dd>
        </dl>
        <dl>
          <dt><span class="red">*</span>费用区间：</dt>
          <dd>
            <p><input name="fee_scale" type="text" class="text" value="" /><p>
          </dd>
        </dl>
        <dl>
          <dt>收益类型：</dt>
          <dd>
            <select name="earning" id="earning">
          		<option value="">----请选择----</option>
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['earning_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          		<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
</option>
							<?php } ?>
          	</select>
          </dd>
        </dl>
        <dl>
          <dt>付息方式：</dt>
          <dd>
              <select name="interest" id="interest">
          		<option value="">----请选择----</option>
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['interest_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          		<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
</option>
							<?php } ?>
          	</select>
          </dd>
        </dl>
        <dl>
          <dt>所在区域：</dt>
          <dd>
              <select name="area" id="area">
          		<option value="">----请选择----</option>
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['area_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          		<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
</option>
							<?php } ?>
          	</select>
          </dd>
        </dl>
        <dl>
          <dt>大小配比：</dt>
          <dd>
              <select name="size" id="size">
          		<option value="">----请选择----</option>
          		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['size_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
          		<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['column_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['column_title'];?>
</option>
							<?php } ?>
          	</select>
          </dd>
        </dl>
        <dl>
          <dt>大小配比详细：</dt>
          <dd>
            <p><textarea id="size_intro" class="tarea" name="size_intro" ></textarea><p>
          </dd>
        </dl>
        <dl>
          <dt>产品期限：</dt>
          <dd>
            <p><input name="lifetime" type="text" class="text" value="" /><p>
            <p class="hint">仅填写数字，以月为单位</p>
          </dd>
        </dl>
        <dl>
          <dt>规模：</dt>
          <dd>
            <p><input name="scale" type="text" class="text" value="" /><p>
            <p class="hint">仅填写数字，以亿为单位</p>
          </dd>
        </dl>
        <dl>
          <dt>投资门槛：</dt>
          <dd>
            <p><input name="threshold" type="text" class="text" value="" /><p>
            <p class="hint">仅填写数字，以万元为单位</p>
          </dd>
        </dl>
        <dl>
          <dt>进度条设置：</dt>
          <dd>
            <p><input name="progress_percent" type="text" class="text" value="" /><p>
            <p class="hint">仅填写数字（1-100），将在前台显示募集进度百分比</p>
          </dd>
        </dl>
        <dl class="tit"><h3>详情描述</h3></dl>
        <dl>
          <dt>募集帐号：</dt>
          <dd >
            <p><textarea id="account" class="tarea" name="account"></textarea></p>
          </dd>
        </dl>  
        <dl>
          <dt>收益明细：</dt>
          <dd >
            <p><textarea id="income" class="tarea" name="income" ></textarea></p>
          </dd>
        </dl>      
        <dl>
          <dt>募集进度：</dt>
          <dd >
            <p><textarea id="progress" class="tarea" name="progress" ></textarea></p>
          </dd>
        </dl>
        <dl>
          <dt>资料下载：</dt>
          <dd >
            <p>
            	<span class="type-file-box">
            		<input type="file" name="download" id="download" class="type-file-file" size="30" >
            	</span>
            </p>
          </dd>
        </dl>
        <dl>
          <dt>产品说明：</dt>
          <dd>
            <p>
              <textarea id="content" name="content" style="width:100%;height:400px;visibility:hidden;"></textarea>
<script src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
kindeditor/kindeditor-min.js" charset="utf-8"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
kindeditor/lang/zh_CN.js" charset="utf-8"></script>
<script>
	var KE;
  KindEditor.ready(function(K) {
        KE = K.create("textarea[name='content']", {
						items : ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste',
			'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
			'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
			'superscript', '|', 'selectall', 'clearhtml','quickformat','|',
			'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
			'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
						cssPath : "<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
kindeditor/themes/default/default.css",
						//allowImageUpload : false,
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
	            </p>
          </dd>
        </dl>
        <dl class="tit">
          <h3>其他信息</h3>
        </dl>
        <dl>
          <dt>产品状态：</dt>
          <dd>
            <p>
              <label style="padding-right:8px;"><input name="status" value="1" checked="checked"  type="radio" />在售</label>
              <label><input name="status" value="2"   type="radio"/>预热</label>
            </p>
          </dd>
        </dl>
        <dl>
          <dt>商品推荐：</dt>
          <dd>
            <p>
              <label style="padding-right:8px;"><input name="iscommend" value="1" checked="checked"  type="radio" />是</label>
              <label><input name="iscommend" value="0"   type="radio"/>否</label>
            </p>
            <p class="hint">被推荐的产品将显示在网站首页</p>
          </dd>
        </dl>
        <dl>
          <dt>商品上架：</dt>
          <dd>
            <p>
              <label style="padding-right:8px;"><input name="isshow" value="1" checked="checked"  type="radio" />是</label>
              <label><input name="isshow" value="0"   type="radio"/>否</label>
            </p>
            <p class="hint">被上架的产品才能显示在前台</p>
          </dd>
        </dl>
        <dl>
          <dt>排序：</dt>
          <dd >
            <p><input name="listorder" type="text" class="text width9" value="255" maxlength="4" /></p>
          </dd>
        </dl>
        <div class="clear"></div>
        <div class="issuance" >
          <input type="submit" class="btn" value="提交" style="margin:20px 0px 20px 120px;"/>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
$(function(){
    var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
	$(textButton).insertBefore("#download");
	$("#download").change(function(){
		$("#textfield1").val($("#download").val());
	});
});
</script>
</body>
</html><?php }} ?>