<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:05:21
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\content\document\document.html" */ ?>
<?php /*%%SmartyHeaderCode:5687555070d174eda4-07043329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2212adb534d1f14dbbfd08ad3c136649ec9b421' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\content\\document\\document.html',
      1 => 1395928608,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5687555070d174eda4-07043329',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'infolist' => 0,
    'v' => 0,
    'COM' => 0,
    'infopage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_555070d1821cd7_69652727',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555070d1821cd7_69652727')) {function content_555070d1821cd7_69652727($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>系统文章</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
    <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title"><h5>操作提示</h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li>在相关操作处可查看具体内容，例：在注册会员时须查看用户服务协议</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <table class="table tb-type2 nobdb">
    <thead>
      <tr class="thead">
        <th>标题</th>
        <th>标识码</th>
        <th class="align-center">时间</th>
        <th>操作</th>
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
        <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['doc_title'];?>
</td>
        <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['doc_code'];?>
</td>
        <td class="w25pre align-center"><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['v']->value['doc_time']);?>
</td>
        <td class="w96"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/document/doc_edit?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&doc_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['doc_id'];?>
">编辑</a></td>
      </tr>
	  <?php } ?>
	  <?php }else{ ?>
	  <tr class="no_data">
        <td colspan="10">没有符合条件的记录</td>
      </tr>
	  <?php }?>
      <?php echo $_smarty_tpl->tpl_vars['infopage']->value;?>

                </tbody>
  </table>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>