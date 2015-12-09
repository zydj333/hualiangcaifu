<?php /* Smarty version Smarty-3.1.11, created on 2015-05-20 16:51:39
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\member\member\detial.html" */ ?>
<?php /*%%SmartyHeaderCode:16594555c453471a822-38557019%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81f91a7d919f51d83fe760dd6c0e753ab21f66ec' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\member\\member\\detial.html',
      1 => 1432111890,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16594555c453471a822-38557019',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_555c4534757727_26618602',
  'variables' => 
  array (
    'COM' => 0,
    'detial' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_555c4534757727_26618602')) {function content_555c4534757727_26618602($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>用户详情</title>
        <link href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['CSS_PATH'];?>
skin_0.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="page">
            <form method="get" name="formSearch">
                <table class="table tb-type2 nobdb">
                    <tbody>
                        <tr class="hover member">
                            <td class="align-left" colspan="2">用户头像：<img src="/<?php echo $_smarty_tpl->tpl_vars['detial']->value['head_ico'];?>
" width="150" height="150" /></td>
                            <td class="align-left"  colspan="2">用户名片：<img src="/<?php echo $_smarty_tpl->tpl_vars['detial']->value['businesscard'];?>
" width="150" height="150" /></td>
                        </tr>
                        <tr class="hover member">
                            <td class="align-left">用户ID：<?php echo $_smarty_tpl->tpl_vars['detial']->value['user_id'];?>
</td>
                            <td class="align-left">用户帐号：<?php echo $_smarty_tpl->tpl_vars['detial']->value['username'];?>
</td>
                            <td class="align-left">用户分类：<?php if ($_smarty_tpl->tpl_vars['detial']->value['iscate']==1){?>普通用户<?php }else{ ?>其他<?php }?></td>
                            <td class="align-left">审核状态：<?php if ($_smarty_tpl->tpl_vars['detial']->value['ischeck']==0){?>待审核<?php }elseif($_smarty_tpl->tpl_vars['detial']->value['ischeck']==1){?>审核通过<?php }else{ ?>未通过<?php }?></td>
                        </tr>
                        <tr class="hover member">
                            <td class="align-left">手机：<?php echo $_smarty_tpl->tpl_vars['detial']->value['phone'];?>
</td>
                            <td class="align-left">电话：<?php echo $_smarty_tpl->tpl_vars['detial']->value['tel'];?>
</td>
                            <td class="align-left">推荐人：<?php echo $_smarty_tpl->tpl_vars['detial']->value['cardno_user'];?>
</td>
                            <td class="align-left">推荐人手机：<?php echo $_smarty_tpl->tpl_vars['detial']->value['cardno'];?>
</td>
                        </tr>
                        <tr class="hover member">
                            <td class="align-left">真实姓名：<?php echo $_smarty_tpl->tpl_vars['detial']->value['truename'];?>
</td>
                            <td class="align-left">性别：<?php if ($_smarty_tpl->tpl_vars['detial']->value['sex']==0){?>保密<?php }elseif($_smarty_tpl->tpl_vars['detial']->value['sex']==1){?>男<?php }elseif($_smarty_tpl->tpl_vars['detial']->value['sex']==2){?>女<?php }?></td>
                            <td class="align-left">生日：<?php echo $_smarty_tpl->tpl_vars['detial']->value['birthday'];?>
</td>
                            <td class="align-left">邮箱地址：<?php echo $_smarty_tpl->tpl_vars['detial']->value['email'];?>
</td>
                        </tr>
                        <tr class="hover member">
                            <td class="align-left">注册时间：<?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['detial']->value['register_time']);?>
</td>
                            <td class="align-left">上次登录时间：<?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['detial']->value['last_login_time']);?>
</td>
                            <td class="align-left">可用余额：<?php echo $_smarty_tpl->tpl_vars['detial']->value['available_predeposit'];?>
</td>
                            <td class="align-left">冻结金额：<?php echo $_smarty_tpl->tpl_vars['detial']->value['freeze_predeposit'];?>
</td>
                        </tr>
                        <tr class="hover member">
                            <td class="align-left">地区：<?php echo $_smarty_tpl->tpl_vars['detial']->value['area_name'];?>
</td>
                            <td class="align-left">地址：<?php echo $_smarty_tpl->tpl_vars['detial']->value['address'];?>
</td>
                            <td class="align-left">是否删除：<?php if ($_smarty_tpl->tpl_vars['detial']->value['sts']==0){?>否<?php }else{ ?>已删除<?php }?></td>
                            <td class="align-left">QQ号码：<?php echo $_smarty_tpl->tpl_vars['detial']->value['qq'];?>
</td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>   
    </body>
    <body><?php }} ?>