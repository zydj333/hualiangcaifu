<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:06:33
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\setup\seo_setup.html" */ ?>
<?php /*%%SmartyHeaderCode:95955507119a03e11-49758259%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2083f91d3072510ebd236637fdeefc0fcb9dce74' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\setup\\seo_setup.html',
      1 => 1381081050,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95955507119a03e11-49758259',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'seo_setup' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55507119aa0214_15103812',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55507119aa0214_15103812')) {function content_55507119aa0214_15103812($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>SEO设置</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>SEO设置</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="form1">
    <input type="hidden" name="dosubmit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label>启用伪静态:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="rewrite_enabled"  class="cb-enable <?php if ($_smarty_tpl->tpl_vars['seo_setup']->value['rewrite_enabled']==1){?>selected<?php }?>" title="是"><span>是</span></label>
            <label for="rewrite_disabled" class="cb-disable <?php if ($_smarty_tpl->tpl_vars['seo_setup']->value['rewrite_enabled']==0){?>selected<?php }?>" title="否"><span>否</span></label>
            <input id="rewrite_enabled" name="rewrite_enabled"  value="1" type="radio">
            <input id="rewrite_disabled" name="rewrite_enabled" checked="checked" value="0" type="radio"></td>
          <td class="vatop tips">启用伪静态可以提高搜索引擎抓取<br/>
            启用前，请先确保已开启apache服务器的rewrite.module功能模块，并将商城目录下的"htaccess.txt"文件重命名为".htaccess"，然后选择“是”，保存即可。</td>
        </tr>
        <tr>
          <td colspan="2" class="required">网站关键字:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_keywords" name="site_keywords" value="<?php echo $_smarty_tpl->tpl_vars['seo_setup']->value['site_keywords'];?>
" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">网站关键字，出现在前台页面头部的 Meta 标签中，用于记录该页面的关键字，多个关键字间请用半角逗号 "," 隔开</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="site_description">网站描述:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="site_description" rows="6" class="tarea" id="site_description"><?php echo $_smarty_tpl->tpl_vars['seo_setup']->value['site_description'];?>
</textarea></td>
          <td class="vatop tips"><span class="vatop rowform">网站描述，出现在前台页面头部的 Meta 标签中，用于记录该页面的概要与描述</span></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>