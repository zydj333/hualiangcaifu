<?php /* Smarty version Smarty-3.1.11, created on 2014-12-15 10:19:42
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\message.php" */ ?>
<?php /*%%SmartyHeaderCode:18668548e453e75ae41-55547984%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c74f8053c34f957546a60ab94bd4cc1149aa4ef8' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\message.php',
      1 => 1381081052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18668548e453e75ae41-55547984',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548e453e9fe3f8_77071182',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548e453e9fe3f8_77071182')) {function content_548e453e9fe3f8_77071182($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
	<div class="fixed-bar">
    <div class="item-title"><h3>系统消息</h3></div>
</div>
  	<script style="text/javascript">
/*	var i='<?php echo $_smarty_tpl->tpl_vars['data']->value['ms'];?>
';
	window.setInterval("settime()",1000);
	function settime(){
		var divinner=document.getElementById("settime");
		divinner.innerText=i;
		i--;
	}*/
	</script>
<div class="fixed-empty"></div>
	<table class="table tb-type2 msg">
		<tbody class="noborder">
      		<tr>
        		<td rowspan="5" class="msgbg"></td>
        		<td class="tip"><?php echo $_smarty_tpl->tpl_vars['data']->value['msg'];?>
</td>
      		</tr>
            <tr>
       			<td class="tip2">若不选择将<span id='settime' style='font-color:red;'><?php echo $_smarty_tpl->tpl_vars['data']->value['ms'];?>
</span>秒后，自动跳转</td>
      		</tr>
	      	<tr>
	        	<td><?php if ($_smarty_tpl->tpl_vars['data']->value['returnjs']){?>
	        		<script style="text/javascript"><?php echo $_smarty_tpl->tpl_vars['data']->value['returnjs'];?>
</script>
	        		<?php }else{ ?>
		        		<?php if ($_smarty_tpl->tpl_vars['data']->value['add']==1){?>
							<a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['goback'];?>
" class="btns"><span>继续添加</span></a>
		        		<?php }?>
		        		<?php if ($_smarty_tpl->tpl_vars['data']->value['edit']==1){?>
							<a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['goback'];?>
" class="btns"><span>继续编辑</span></a>
		        		<?php }?>
		        		<?php if ($_smarty_tpl->tpl_vars['data']->value['dialog']==1){?>
							<a href="javascript:void(0);" onclick='window.top.right.location.reload();window.top.art.dialog({id:"<?php echo $_smarty_tpl->tpl_vars['data']->value['msgtype'];?>
"}).close();' class="btns"><span>关闭窗口</span></a>
							<script language="javascript">window.setTimeout("go_reload()",<?php echo $_smarty_tpl->tpl_vars['data']->value['ms'];?>
*1000);</script>
						<?php }elseif($_smarty_tpl->tpl_vars['data']->value['url_forward']!=''){?>
							<script language="javascript">window.setTimeout("go_forward()",<?php echo $_smarty_tpl->tpl_vars['data']->value['ms'];?>
*1000);</script>
							<?php if ($_smarty_tpl->tpl_vars['data']->value['dialog']!=1){?>
							<a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['url_forward'];?>
" class="btns"><span>返回上一页</span></a>
							<?php }?>
						<?php }else{ ?>
							<a href="javascript:history.go(-1);" class="btns"><span>返回上一页</span></a>
						<?php }?>
					<?php }?>
	          	</td>
	      	</tr>
		</tbody>
  	</table>
  	<script style="text/javascript">
  	function go_reload(){
		window.top.right.location.reload();window.top.art.dialog({id:"<?php echo $_smarty_tpl->tpl_vars['data']->value['msgtype'];?>
"}).close();
	}
  	function go_forward(){
		window.location.href="<?php echo $_smarty_tpl->tpl_vars['data']->value['url_forward'];?>
";
	}
	function close_dialog() {
		window.top.right.location.reload();window.top.art.dialog({id:"<?php echo $_smarty_tpl->tpl_vars['data']->value['msgtype'];?>
"}).close();
	}
</script>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>