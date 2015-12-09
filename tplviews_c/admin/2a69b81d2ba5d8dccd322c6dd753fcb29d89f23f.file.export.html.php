<?php /* Smarty version Smarty-3.1.11, created on 2015-06-30 16:01:27
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\maintenance\dbsave\export.html" */ ?>
<?php /*%%SmartyHeaderCode:2884555924cd7889b98-09902026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a69b81d2ba5d8dccd322c6dd753fcb29d89f23f' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\maintenance\\dbsave\\export.html',
      1 => 1381081046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2884555924cd7889b98-09902026',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'infolist' => 0,
    'v' => 0,
    'pdoname' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55924cd798aec3_36039674',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55924cd798aec3_36039674')) {function content_55924cd798aec3_36039674($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>数据库工具</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>数据库导出</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dbsave/import?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>数据库导入</span></a></li>
      </ul>
    </div>
  </div>
<form method="post" name="listfrom" id="listfrom" >

  <div class="fixed-empty"></div>
   <table class="table tb-type2">
    <tbody>
        <tr class="noborder">
		  <td class="required" style="width:150px;"><label class="validation" for="sizelimit">每个分卷文件大小：</label></td>
          <td class="vatop rowform"><input type="text" value="2048" name="sizelimit" id="sizelimit" class="txt-short">K</td>
          <td class="vatop tips"></td>
        </tr>
		<tr class="noborder">
		  <td class="required" style="width:150px;"><label class="validation" for="sqlcompat">建表语句格式：</label></td>
          <td class="vatop rowform">
		  <input type="radio" name="sqlcompat" value="" checked> 默认 &nbsp; 
		  <input type="radio" name="sqlcompat" value="MYSQL5" > MySQL 5.x &nbsp
		  </td>
          <td class="vatop tips"></td>
        </tr>
		<tr class="noborder">
		  <td class="required" style="width:150px;"><label class="validation" for="sqlcharset">强制字符集：</label></td>
          <td class="vatop rowform"><input type="radio" name="sqlcharset" value="" checked> 默认&nbsp; <input type="radio" name="sqlcharset" value='utf8'> UTF-8</td>
          <td class="vatop tips"></td>
        </tr>
		<tr class="noborder">
		  <td class="required" style="width:150px;">
		  </td>
          <td class="vatop rowform"><a href="JavaScript:void(0);"  class="btn"  id="submitBtn"><span>提交</span></a></td>
          <td class="vatop tips"></td>
        </tr>
	 </tbody>
	</table>
 	<input type="hidden" name="dosubmit" value="1" />
	<input type="hidden" name="tabletype" value="wmmall" />
    <table class="table tb-type2">
      <thead>
        <tr class="space"><th colspan="15">数据表列表</th> </tr>
        <tr class="thead">
          <th><input type="checkbox" class="checkall" id="checkallBottom"></th>
          <th>表名</th>
          <th>类型</th>
          <th>编码</th>
          <th>记录数</th>
		  <th>使用空间</th>
		  <th>碎片</th>
          <th class="align-center">操作</th>
        </tr>
      </thead>
	  <tbody>
        <?php if ($_smarty_tpl->tpl_vars['infolist']->value){?>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infolist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
        <tr class="hover">
          <td><input type="checkbox" name='tables[]' value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Name'];?>
" class="checkitem"></td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['Name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['Engine'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['Collation'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['Rows'];?>
</td>
		  <td><?php echo $_smarty_tpl->tpl_vars['v']->value['Data_length'];?>
</td>
		  <td><?php echo $_smarty_tpl->tpl_vars['v']->value['Data_free'];?>
</td>
          <td class="align-center">
			<a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dbsave/public_repair/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&operation=optimize&pdo_name=<?php echo $_smarty_tpl->tpl_vars['pdoname']->value;?>
&tables=<?php echo $_smarty_tpl->tpl_vars['v']->value['Name'];?>
">优化</a> |
			<a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dbsave/public_repair/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&&operation=repair&pdo_name=<?php echo $_smarty_tpl->tpl_vars['pdoname']->value;?>
&tables=<?php echo $_smarty_tpl->tpl_vars['v']->value['Name'];?>
">修复</a> |
			<a href="javascript:void(0);" onclick="showcreat('<?php echo $_smarty_tpl->tpl_vars['pdoname']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['v']->value['Name'];?>
')">结构</a>
		  </td>
        </tr>
        <?php } ?>
		<?php }?>
      </tbody>
    </table>
  
</div>
</form>
<script>
function showcreat(pdo_name, tblname) {
	window.top.art.dialog({title:tblname, id:'show', iframe:'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
maintenance/dbsave/public_repair/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&operation=showcreat&pdo_name='+pdo_name+'&tables=' +tblname,width:'650px',height:'350px'});
}
$(document).ready(function(){
	//按钮先执行验证再提交表单
	$("#submitBtn").click(function(){
	    if($("#listfrom").valid()){
	     $("#listfrom").submit();
		}
	});

	$('#listfrom').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        onfocusout : false,
        onkeyup    : false,
        rules : {
            'sizelimit' : {
                required : true,
            }
        },
        messages : {
            'sizelimit'  : {
                required : '分卷大小不能为空',
            }
        }
    });
});


</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>