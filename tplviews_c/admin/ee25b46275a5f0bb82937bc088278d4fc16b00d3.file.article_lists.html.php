<?php /* Smarty version Smarty-3.1.11, created on 2015-06-30 15:50:10
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\content\article\article_lists.html" */ ?>
<?php /*%%SmartyHeaderCode:640055924a326cd346-81649190%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee25b46275a5f0bb82937bc088278d4fc16b00d3' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\content\\article\\article_lists.html',
      1 => 1406771976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '640055924a326cd346-81649190',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'sel' => 0,
    'ac_list' => 0,
    'v' => 0,
    'form_submit' => 0,
    'infolist' => 0,
    'ac' => 0,
    'infopage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55924a3286e841_82536855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55924a3286e841_82536855')) {function content_55924a3286e841_82536855($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>文章管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_add?code=<?php echo $_smarty_tpl->tpl_vars['sel']->value['codetype'];?>
&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>新增</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
	<input type="hidden" name="dosubmit" value="ok" />
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_title">标题</label></th>
          <td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['sel']->value['title'];?>
" name="search_title" id="search_title" class="txt"></td>
          <th><label for="search_ac_id">文章分类</label></th>
          <td><select name="search_ac_id" id="search_ac_id" class="">
              <option value="">请选择...</option>
			    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ac_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                <option  value="<?php echo $_smarty_tpl->tpl_vars['v']->value['ac_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['v']->value['ac_id']==$_smarty_tpl->tpl_vars['sel']->value['acid']){?>selected<?php }?>><?php if ($_smarty_tpl->tpl_vars['v']->value['floor']==1){?>&nbsp;&nbsp;<?php }?><?php echo $_smarty_tpl->tpl_vars['v']->value['ac_name'];?>
</option>
				<?php } ?>
                </select></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="查询">&nbsp;</a>
		  <?php if (isset($_smarty_tpl->tpl_vars['form_submit']->value)){?><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/lists?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" class="btns tooltip"><span>撤销检索</span></a><?php }?>
            </td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5>操作提示</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>区别于系统文章，可在文章列表页点击查看</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="listfrom" >
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w48">排序</th>
          <th>标题</th>
          <th>文章分类</th>
          <th class="align-center">显示</th>
          <th class="align-center">添加时间</th>
          <th class="w60 align-center">操作</th>
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
          <td><input type="checkbox" name='del_id[]' value="<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
" class="checkitem"></td>
          <td class="w48 sort"> <input type="hidden" name="hdnid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
" /><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['listorder'];?>
" name="listorder[]" id="listorder[]" class="txt-short">
          	<div style='display:none;'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
" name="id[]" id="id[]" /><input type="checkbox" name="ckbid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
" class="checkitem"><div>
          </td>
          <td><?php echo $_smarty_tpl->tpl_vars['v']->value['article_title'];?>
</td>
          <td>
		    <?php  $_smarty_tpl->tpl_vars['ac'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ac']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ac_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ac']->key => $_smarty_tpl->tpl_vars['ac']->value){
$_smarty_tpl->tpl_vars['ac']->_loop = true;
?>
			    <?php if ($_smarty_tpl->tpl_vars['ac']->value['ac_id']==$_smarty_tpl->tpl_vars['v']->value['ac_id']){?><?php echo $_smarty_tpl->tpl_vars['ac']->value['ac_name'];?>
<?php }?>
			<?php } ?>
		  </td>
          <td class="align-center"><?php if ($_smarty_tpl->tpl_vars['v']->value['article_show']==1){?>是<?php }else{ ?>否<?php }?></td>
          <td class="nowrap align-center"><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['v']->value['article_time']);?>
</td>
          <td class="align-center"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_edit?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&article_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['article_id'];?>
">编辑</a></td>
        </tr>
        <?php } ?>
         </tbody>
      <tfoot>
                <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom">全选</label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="dodel('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]');"><span>删除</span></a>
             <a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_order/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
');"><span>排序</span></a>
            <?php echo $_smarty_tpl->tpl_vars['infopage']->value;?>

			</td>
        </tr>
              <?php }else{ ?>
              <tfoot>
		<tr class="no_data">
          <td colspan="10">没有符合条件的记录</td>
        </tr>
        </tbody>
		<?php }?>
    </table>
  </form>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>