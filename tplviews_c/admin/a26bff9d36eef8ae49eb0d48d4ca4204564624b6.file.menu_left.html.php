<?php /* Smarty version Smarty-3.1.11, created on 2015-06-30 16:01:24
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\system\menu\menu_left.html" */ ?>
<?php /*%%SmartyHeaderCode:180155924cd4050586-07329798%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a26bff9d36eef8ae49eb0d48d4ca4204564624b6' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\system\\menu\\menu_left.html',
      1 => 1381081046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180155924cd4050586-07329798',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'treescript' => 0,
    'COM' => 0,
    'admin_url' => 0,
    'JS_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55924cd40b1455_21434241',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55924cd40b1455_21434241')) {function content_55924cd40b1455_21434241($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php echo $_smarty_tpl->tpl_vars['treescript']->value;?>

<title></title>
<style>
html{_overflow-y:scroll}
div.content_wrap {width: 100%;height:100%;}
div.content_wrap div.left{float: left;width: 200px;}
div.zTreeDemoBackground {height:100%;text-align:left;}
ul.ztree {margin-top:5px;width:100px;height:100%;}
ul.log {border: 1px solid #617775;background: #f0f6e4;height:170px;overflow: hidden;}
ul.log.small {height:45px;}
ul.log li {color: #666666;list-style: none;padding-left: 10px;}
ul.log li.dark {background-color: #E3E3E3;}
</style>
</head>
<body>
	<SCRIPT type="text/javascript">
		<!--
		var setting = {
			async: {
				enable: true,
				url: getUrl
			},
			check: {
				enable: false
			},
			data: {
				simpleData: {
					enable: true
				}
			},
			view: {
				expandSpeed: ""
			},
			callback: {
				beforeExpand: beforeExpand,
				onAsyncSuccess: onAsyncSuccess,
				onAsyncError: onAsyncError
			}
		};
var zNodes =[
 {id:'p1',site_id:'1', pId:0,isParent:true,click:"gourl(0,1)", name:"系统菜单", open:true, iconOpen:"<?php echo $_smarty_tpl->tpl_vars['COM']->value['JS_PATH'];?>
ztree/zTreeStyle/img/diy/1_open.png", iconClose:"<?php echo $_smarty_tpl->tpl_vars['COM']->value['JS_PATH'];?>
ztree/zTreeStyle/img/diy/1_close.png"}
];
		var  perTime = 100;
		function getUrl(treeId, treeNode) {
			var param = "id="+treeNode.id+'&site_id='+treeNode.site_id;
			return "<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/get_sub_menu?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&" + param;
		}
		function beforeExpand(treeId, treeNode) {
			if (!treeNode.isAjaxing) {
				treeNode.times = 1;
				ajaxGetNodes(treeNode, "refresh");
				return true;
			} else {
				alert("zTree 正在下载数据中，请稍后展开节点。。。");
				return false;
			}
		}
		function onAsyncSuccess(event, treeId, treeNode, msg) {
			if (!msg || msg.length == 0) {
				return;
			}
			var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
			totalCount = treeNode.count;
			if (treeNode.children.length < totalCount) {
				setTimeout(function() {ajaxGetNodes(treeNode);}, perTime);
			} else {
				treeNode.icon = "";
				zTree.updateNode(treeNode);
				//zTree.selectNode(treeNode.children[0]);//展开后选中第一个节点
			}
		}
		function onAsyncError(event, treeId, treeNode, XMLHttpRequest, textStatus, errorThrown) {
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			alert("异步获取数据出现异常。");
			treeNode.icon = "";
			zTree.updateNode(treeNode);
		}
		function ajaxGetNodes(treeNode, reloadType) {
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			if (reloadType == "refresh") {
				treeNode.icon = "<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
ztree/zTreeStyle/img/loading.gif";
				zTree.updateNode(treeNode);
			}
			zTree.reAsyncChildNodes(treeNode, reloadType, true);
		}
		//更新事件
		function refreshNode(e) {
			var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
			type = e.data.type,
			silent = e.data.silent,
			nodes = zTree.getSelectedNodes();
			if (nodes.length == 0) {
				return '';
				//alert("请先选择一个父节点");
			}else{
				ajaxGetNodes(nodes[0],type);
			}
		}
		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
			$("#addNode").bind("click", {type:"refresh", silent:false}, refreshNode);
			$("#refreashNode").bind("click", {type:"refresh", silent:false}, refreshNode);
		});
		function gourl(id,site_id){
			$("#rightMain",window.parent.document).attr('src', '<?php echo $_smarty_tpl->tpl_vars['admin_url']->value;?>
system/menu/menu_list?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&pid='+id+'&site_id='+site_id);
		}

		//-->
	</SCRIPT>
<input type="button" id='refreashNode' name='refreashNode' style='display:none;' />
<div class="content_wrap">
	<div class="zTreeDemoBackground left">
		<ul id="treeDemo" class="ztree"></ul>
	</div>
</div>
</body>
</html><?php }} ?>