<?php /* Smarty version Smarty-3.1.11, created on 2014-12-15 10:18:56
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\mypanel\welcome\welcome.html" */ ?>
<?php /*%%SmartyHeaderCode:2574548e451093ac52-18756751%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71503bc0160e15e4829452971f85801a5e3b86ef' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\mypanel\\welcome\\welcome.html',
      1 => 1415468966,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2574548e451093ac52-18756751',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548e4510b793b1_64847872',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548e4510b793b1_64847872')) {function content_548e4510b793b1_64847872($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
span {color:#F00}
</style>
<div class="page">
  <div class="item-title">
    <h3>您好,<span><?php echo $_smarty_tpl->tpl_vars['data']->value['admin_name'];?>
</span>,欢迎使用<span>华良财富后台管理系统</span>.  您上次登录的时间是<span><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['data']->value['last_login_time']);?>
</span><?php if ($_smarty_tpl->tpl_vars['data']->value['admin_role_id']==6){?>&nbsp;&nbsp;管理区域：<?php echo $_smarty_tpl->tpl_vars['data']->value['areaids_name'];?>
<?php }?></h3>
  </div>
  <table class="table tb-type2">
    <thead class="thead">
      <tr>
        <th colspan="10">
        </th>
      </tr>
      <tr class="space">
        <th colspan="10">一周动态</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="w12"></td>
        <td class="w108"><strong>新增会员数:</strong></td>
        <td class="w25pre"><span><?php echo $_smarty_tpl->tpl_vars['data']->value['user_num'];?>
</span></td>
        <td class="w120"><strong>新增订单数:</strong></td>
        <td><span><?php echo $_smarty_tpl->tpl_vars['data']->value['order_num'];?>
</span></td>
      </tr>
    </tbody>
    <tfoot>
      <tr class="tfoot">
        <td colspan="10"></td>
      </tr>
    </tfoot>
  </table>
  <table class="table tb-type2">
    <thead class="thead">
      <tr class="space">
        <th colspan="10">统计信息</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="w12"></td>
        <td class="w108"><strong>会员总数:</strong></td>
        <td class="w25pre"><span><?php echo $_smarty_tpl->tpl_vars['data']->value['user'];?>
</span></td>
        <td class="w120"><strong>产品总数:</strong></td>
        <td><span><?php echo $_smarty_tpl->tpl_vars['data']->value['goods'];?>
</span></td>
      </tr>
      <tr>
        <td></td>
        <td><strong>订单总数:</strong></td>
        <td><span><?php echo $_smarty_tpl->tpl_vars['data']->value['order'];?>
</span></td>
        <td><strong>留言总数:</strong></td>
        <td><span><?php echo $_smarty_tpl->tpl_vars['data']->value['message'];?>
</span></td>
      </tr>
      <tr>
        <td></td>
        <td><strong>订单总金额:</strong></td>
        <td><span><?php echo $_smarty_tpl->tpl_vars['data']->value['order_sum'];?>
</span></td>
        <td><strong></strong></td>
        <td><span></span></td>
      </tr>
    </tbody> <tfoot>
      <tr class="tfoot">
        <td colspan="10"></td>
      </tr>
    </tfoot>
  </table>
  <table class="table tb-type2">
    <thead class="thead">
      <tr class="space">
        <th colspan="10">系统信息</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="w12"></td>
        <td class="w108"><strong>服务器操作系统:</strong></td>
        <td class="w25pre"><span><?php echo $_smarty_tpl->tpl_vars['data']->value['system_os'];?>
</span></td>
        <td class="w120"><strong>WEB 服务器:</strong></td>
        <td><span><?php echo $_smarty_tpl->tpl_vars['data']->value['system_env'];?>
</span></td>
      </tr>
      <tr>
        <td></td>
        <td><strong>PHP 版本:</strong></td>
        <td><span><?php echo $_smarty_tpl->tpl_vars['data']->value['php_system'];?>
</span></td>
        <td><strong>MYSQL 版本:</strong></td>
        <td><span><?php echo $_smarty_tpl->tpl_vars['data']->value['mysql_system'];?>
</span></td>
      </tr>
      <tr>
        <td></td>
        <td><strong>系统版本:</strong></td>
        <td><span>CH-V3.2</span></td>
        <td><strong>安装时间:</strong></td>
        <td><span><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['data']->value['inst_time']);?>
</span></td>
      </tr>
    </tbody> <tfoot>
      <tr class="tfoot">
        <td colspan="10"></td>
      </tr>
    </tfoot>
  </table>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>