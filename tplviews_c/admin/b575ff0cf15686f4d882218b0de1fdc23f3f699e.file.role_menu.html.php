<?php /* Smarty version Smarty-3.1.11, created on 2014-12-19 16:40:03
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\rights\role\role_menu.html" */ ?>
<?php /*%%SmartyHeaderCode:207615493e4633aa9b3-45291359%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b575ff0cf15686f4d882218b0de1fdc23f3f699e' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\rights\\role\\role_menu.html',
      1 => 1381081050,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207615493e4633aa9b3-45291359',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
    'treescript' => 0,
    'menulist' => 0,
    'v' => 0,
    'rolelist' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5493e46357fd06_04222009',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5493e46357fd06_04222009')) {function content_5493e46357fd06_04222009($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="page">
  <form id="infoform" name="infoform" method="post" onsubmit='getCheck();'>
     <input type="hidden" name="dosubmit" value="1" />
     <input type="hidden" name="info[id]" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
" />
    <table class="table tb-type2" style='width:40%;float:left'>
      <tbody>
        <tr><td colspan="2" class="required"><label for="info[rolename]">角色名称:</label></td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $_smarty_tpl->tpl_vars['info']->value['rolename'];?>
</td>
          <td class="vatop tips"></td>
        </tr>
          <tr>
          <td colspan="2" class="required"><label for="statistics_code">角色描述:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $_smarty_tpl->tpl_vars['info']->value['description'];?>
</td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr  style='display:none;'class="tfoot"><td colspan="15" ><a href="JavaScript:void(0);"  class="btn"  id="submitBtn"><span>提交</span></a></td></tr>
      </tfoot>
    </table>
     <table style='width:60%;float:right'>
     <tr>
     	<td ><?php echo $_smarty_tpl->tpl_vars['treescript']->value;?>

<SCRIPT type="text/javascript">
		var setting = {
			check: {
				enable: true
			},
			data: {
				simpleData: {
					enable: true
				}
			}
		};
		var zNodes =[
		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menulist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['v']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['v']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['v']->iteration++;
 $_smarty_tpl->tpl_vars['v']->last = $_smarty_tpl->tpl_vars['v']->iteration === $_smarty_tpl->tpl_vars['v']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['childs']['last'] = $_smarty_tpl->tpl_vars['v']->last;
?>
{ id:'<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
', pId:<?php echo $_smarty_tpl->tpl_vars['v']->value['parent_id'];?>
,name:"<?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
"<?php if (in_array($_smarty_tpl->tpl_vars['v']->value['id'],$_smarty_tpl->tpl_vars['rolelist']->value)){?>,checked:true, open:true<?php }?>}<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['childs']['last']!="1"){?>,<?php }?>
		<?php } ?>
		];
		var code;

		function setCheck() {
			var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
			type ={ "Y" : "ps", "N" : "ps" };
			zTree.setting.check.chkboxType = type;
		}
		function getCheck() {
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			var treeNode=zTree.getCheckedNodes();
			var ids='';
			for (x in treeNode) {
				ids=ids+treeNode[x]["id"]+",";
			}
			$('#hdnids').val(ids);
		}
		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
			setCheck();
		});
	</SCRIPT>
<style type="text/css">
div.content_wrap {width: 100%;height:450px;padding-top:20px;}
div.content_wrap div.left{float: left;width: 300px;}
div.zTreeDemoBackground {border: solid 1px #329ED1;height:380px;text-align:left;overflow: scroll; }
</style>
<input type='hidden' name='info[hdnids]' id='hdnids' value='' />
<div class="content_wrap">
	<div class="zTreeDemoBackground left">
		<ul id="treeDemo" class="ztree"></ul>
	</div>
</div>
     	</td>
     </tr>
     </table>
    <input style='display:none;' type="submit" name="dosubmit" id="dosubmit" value=" 提交 " >
  </form>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>