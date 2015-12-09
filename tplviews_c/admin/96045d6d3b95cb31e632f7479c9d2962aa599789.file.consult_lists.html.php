<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:07:16
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\member\buyconsult\consult_lists.html" */ ?>
<?php /*%%SmartyHeaderCode:2953855507144e22ce8-74304407%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96045d6d3b95cb31e632f7479c9d2962aa599789' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\member\\buyconsult\\consult_lists.html',
      1 => 1404815480,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2953855507144e22ce8-74304407',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'sel' => 0,
    'infolist' => 0,
    'v' => 0,
    'k' => 0,
    'infopage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_555071451036e0_78077894',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555071451036e0_78077894')) {function content_555071451036e0_78077894($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>咨询管理</h3>
      <ul class="tab-base"><li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li></ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" name="loghash" value="<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" />
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="member_name">咨询人</label></th>
          <td><input class="txt" type="text" name="member_name" id="member_name" value="<?php echo $_smarty_tpl->tpl_vars['sel']->value['member_name'];?>
" /></td>
          <th><label for="consult_content"> 咨询内容</label></th>
          <td><input class="txt" type="text" name="consult_content" id="consult_content" value="<?php echo $_smarty_tpl->tpl_vars['sel']->value['consult_content'];?>
" /></td>
          <td>
          	<select name="flag">
          		<option value="0">请选择</option>
				<option value="1" <?php if ($_smarty_tpl->tpl_vars['sel']->value['flag']==1){?>selected="selected"<?php }?>>未回复</option>
				<option value="2" <?php if ($_smarty_tpl->tpl_vars['sel']->value['flag']==2){?>selected="selected"<?php }?>>已回复</option>
          	</select>
          </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="查询">&nbsp;</a>
                    </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title"><h5>操作提示</h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li>会员可在商品信息页对商品进行咨询，系统设置处可设置游客是否能够咨询</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="POST" action="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/buyconsult/del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" onsubmit="return checkForm() && confirm('您确定要删除吗?');" name="form1">
    <table class="table tb-type2">
      <tbody>
		<?php if ($_smarty_tpl->tpl_vars['infolist']->value){?>
		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['infolist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
		<tr class="space">
		<th class="w24"><input type="checkbox" class="checkitem" name="consult_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['consult_id'];?>
" /></th>
		<th><strong>咨询对象:&nbsp;</strong>
		    <span><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
index.php?c=products&a=detail&id=<?php echo $_smarty_tpl->tpl_vars['v']->value['goods_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['cgoods_name'];?>
</a></span>
		</th>
		<th colspan="2"><strong>操作:</strong><a href="javascript:add(<?php echo $_smarty_tpl->tpl_vars['v']->value['consult_id'];?>
)">回复</a>&nbsp;<a href="javascript:if(confirm('您确定要删除吗?')){location.href='<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/buyconsult/del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&consult_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['consult_id'];?>
';}" class="normal" >删除</a></th>
		</tr>
		<tr>
		    <td colspan="4"><fieldset class="w mtn">
		        <legend><span><strong>咨询人:</strong>&nbsp;<?php echo $_smarty_tpl->tpl_vars['v']->value['cmember_name'];?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;<span><strong>咨询时间:</strong>&nbsp;<?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['v']->value['consult_addtime']);?>
</span></legend>
		              <div class="formelement" id="hutia_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['consult_content'];?>
</div>
		            </fieldset>
		            <fieldset class="d mtm mbw">
		              <legend><strong>店主回复:</strong></legend>
		              <div class="formelement" id="hutia2_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php if (empty($_smarty_tpl->tpl_vars['v']->value['consult_reply'])){?>暂无回复<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['v']->value['consult_reply'];?>
<?php }?></div>
		            </fieldset>
		    </td>
		</tr>
		<?php } ?>
		<?php }else{ ?>
		<tr class="no_data"><td colspan="4">没有符合条件的记录</td></tr>
		<?php }?>
      </tbody>
<?php if ($_smarty_tpl->tpl_vars['infolist']->value){?>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="3"><label for="checkallBottom">全选</label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span>删除</span></a>
           <?php echo $_smarty_tpl->tpl_vars['infopage']->value;?>
</td>
        </tr>
        </tfoot>
<?php }?>
    </table>
  </form>
</div>

<script>
function add(c_id) {
	window.top.art.dialog({id:'adddialog'}).close();
	window.top.art.dialog({title:'添加菜单',id:'adddialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/buyconsult/consult_reply/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&consult_id='+c_id,width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'adddialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'adddialog'}).close()});
}
</script>
<script type="text/javascript">
function checkForm(){
	flag = false;
	$.each($("input[name='consult_id[]']"),function(i,n){
		if($(n).attr('checked')){
			flag = true;
			return false;
		}
	});
	if(!flag)alert('请选择要删除的商品咨询');
	return flag;
}
</script> 
<script>
(function(){
  $('.w').each(function(i){
  var o = document.getElementById("hutia_"+i);
  var s = o.innerHTML;
  var p = document.createElement("span");
  var n = document.createElement("a");
  p.innerHTML = s.substring(0,50);
  n.innerHTML = s.length > 50 ? "... 【展开】" : "";
  n.href = "###";
  n.onclick = function(){
    if (n.innerHTML == "... 【展开】"){
      n.innerHTML = " 【收起】";
      p.innerHTML = s;
    }else{
      n.innerHTML = "... 【展开】";
      p.innerHTML = s.substring(0,50);
    }
  }
  o.innerHTML = "";
  o.appendChild(p);
  o.appendChild(n);
  });
})();
(function(){
	  $('.d').each(function(i){
	  var o = document.getElementById("hutia2_"+i);
	  var s = o.innerHTML;
	  var p = document.createElement("span");
	  var n = document.createElement("a");
	  p.innerHTML = s.substring(0,50);
	  n.innerHTML = s.length > 50 ? "... 【展开】" : "";
	  n.href = "###";
	  n.onclick = function(){
	    if (n.innerHTML == "... 【展开】"){
	      n.innerHTML = " 【收起】";
	      p.innerHTML = s;
	    }else{
	      n.innerHTML = "... 【展开】";
	      p.innerHTML = s.substring(0,50);
	    }
	  }
	  o.innerHTML = "";
	  o.appendChild(p);
	  o.appendChild(n);
	  });
	})();
  </script>
  <?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>