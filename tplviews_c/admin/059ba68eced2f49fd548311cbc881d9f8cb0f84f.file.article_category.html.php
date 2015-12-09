<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:01:07
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\content\article\article_category.html" */ ?>
<?php /*%%SmartyHeaderCode:2509755506fd33f0a75-39564247%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '059ba68eced2f49fd548311cbc881d9f8cb0f84f' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\content\\article\\article_category.html',
      1 => 1386010008,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2509755506fd33f0a75-39564247',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'codetype' => 0,
    'infolist' => 0,
    'v' => 0,
    'JS_PATH' => 0,
    'IMG_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55506fd3615176_34814197',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55506fd3615176_34814197')) {function content_55506fd3615176_34814197($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>文章分类</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_category_add?code=<?php echo $_smarty_tpl->tpl_vars['codetype']->value;?>
&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>新增</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_category_cache?code=<?php echo $_smarty_tpl->tpl_vars['codetype']->value;?>
&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>更新缓存</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title">
            <h5>操作提示</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>管理员新增文章时，可选择文章分类。文章分类将在前台文章列表页显示</li>
            <li>默认的文章分类不可以删除</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method='post' id="listfrom">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w36"></th>
          <th class="w48">排序</th>
          <th>分类名称</th>
          <th class="w96 align-center">操作</th>
        </tr>
      </thead>
      <tbody id="treet1">
        <?php if ($_smarty_tpl->tpl_vars['infolist']->value){?>
	    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infolist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
        <tr class="hover edit">
          <td><input name="" type="checkbox" disabled="disabled" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['ac_id'];?>
" /><?php if ($_smarty_tpl->tpl_vars['v']->value['have_child']==1){?><img admin_url='<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
' fieldid="<?php echo $_smarty_tpl->tpl_vars['v']->value['ac_id'];?>
" fieldcode="news" js='<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
' url='<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
' loghash='<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
' status="open" ectype="flex" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
tv-expandable.gif"><?php }else{ ?><img fieldid="1" fieldcode="news" status="close" nc_type="flex" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
tv-item.gif"><?php }?></td>
          <td class="sort"><input type="hidden" name="hdnid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['ac_id'];?>
" /><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['listorder'];?>
" name="listorder[]" id="listorder[]" class="txt-short"></td>
          <td class="name"><span title="<?php echo $_smarty_tpl->tpl_vars['v']->value['ac_name'];?>
" required="1" fieldid="1" ajax_branch='article_class_name' fieldname="ac_name" nc_type="inline_edit" class="editable tooltip"><?php echo $_smarty_tpl->tpl_vars['v']->value['ac_name'];?>
</span> <a class='btn-add-nofloat marginleft' href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_category_add?code=<?php echo $_smarty_tpl->tpl_vars['codetype']->value;?>
&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&parent_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['ac_id'];?>
"><span>新增下级</span></a></td>
          <td class="align-center"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_category_edit?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&ac_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['ac_id'];?>
">编辑</a>
            </td>
        </tr>
        <?php } ?>
                      </tbody>
      <tfoot>
                <tr>
          <td><label for="checkall1">
              <input type="checkbox" class="checkall" id="checkall_2">
            </label></td>
          <td colspan="16"><label for="checkall_2">全选</label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="dodel('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_category_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','check_ac_id[]');"><span>删除</span></a>
			<a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/article/article_category_order/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
');"><span>排序</span></a>
			</td>
        </tr>
              </tfoot>
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
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery.article_class.js" charset="utf-8"></script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>