<?php /* Smarty version Smarty-3.1.11, created on 2015-07-02 16:24:22
         compiled from "E:\workstation\wamp\www\hualiangcaifu\tplviews\admin\member\member\user_level.html" */ ?>
<?php /*%%SmartyHeaderCode:96365594f536476674-67697302%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56a3731bef94c37ae18e623750c7782ba3168091' => 
    array (
      0 => 'E:\\workstation\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\member\\member\\user_level.html',
      1 => 1400954856,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96365594f536476674-67697302',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'user_id' => 0,
    'levellist' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5594f5366b3270_28950694',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5594f5366b3270_28950694')) {function content_5594f5366b3270_28950694($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>会员等级批量操作</h3>
      <ul class="tab-base">
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="form1">
    <input type="hidden" value="ok" name="form_submit">
    <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" name="del_id">
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td class="required"><label>设置为:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul class="nofloat w830" >
          <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['levellist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
              <li class="left w18pre h36">
                <input type="radio" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" name="group_id" id="group_id<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">
                <label for="group_id<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['groupname'];?>
</label>
              </li>
          <?php } ?>
          </ul></td>
        </tr>
      <tfoot>
        <tr class="tfoot">
          <td ><a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>