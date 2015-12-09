<?php /* Smarty version Smarty-3.1.11, created on 2015-05-20 17:03:28
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\member\member\user_list.html" */ ?>
<?php /*%%SmartyHeaderCode:149795550713e178942-73854932%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd19907628284b6dc5689edb1e4e732a613b4f23c' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\member\\member\\user_list.html',
      1 => 1432112445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149795550713e178942-73854932',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5550713e597441_27675034',
  'variables' => 
  array (
    'COM' => 0,
    'name' => 0,
    'value' => 0,
    'sort' => 0,
    'state' => 0,
    'form_submit' => 0,
    'infolist' => 0,
    'v' => 0,
    'infopage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5550713e597441_27675034')) {function content_5550713e597441_27675034($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <h3>会员管理</h3>
            <ul class="tab-base">
                <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_add?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" ><span>新增</span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form method="get" name="formSearch">
        <input type="hidden" name="loghash" value="<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" />
        <input type="hidden" name="dosubmit" value="ok" />
        <table class="tb-type1 noborder search">
            <tbody>
                <tr>
                    <td><select name="search_field_name" >
                            <option  value="member_name" <?php if (isset($_smarty_tpl->tpl_vars['name']->value)){?><?php if ($_smarty_tpl->tpl_vars['name']->value=='member_name'){?>selected='selected'<?php }?><?php }?>>会员名</option>
                            <option  value="member_email" <?php if (isset($_smarty_tpl->tpl_vars['name']->value)){?><?php if ($_smarty_tpl->tpl_vars['name']->value=='member_email'){?>selected='selected'<?php }?><?php }?>>电子邮箱</option>
                            <option  value="member_truename" <?php if (isset($_smarty_tpl->tpl_vars['name']->value)){?><?php if ($_smarty_tpl->tpl_vars['name']->value=='member_truename'){?>selected='selected'<?php }?><?php }?>>真实姓名</option>
                        </select></td>
                    <td><input type="text" value="<?php if (isset($_smarty_tpl->tpl_vars['value']->value)){?><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
<?php }?>" name="search_field_value" class="txt"></td>
                    <th><label>排序</label></th>
                    <td><select name="search_sort" >
                            <option  value="register_time desc" <?php if (isset($_smarty_tpl->tpl_vars['sort']->value)){?><?php if ($_smarty_tpl->tpl_vars['sort']->value=='register_time desc'){?>selected='selected'<?php }?><?php }?>>注册时间</option>
                            <option  value="last_login_time desc" <?php if (isset($_smarty_tpl->tpl_vars['sort']->value)){?><?php if ($_smarty_tpl->tpl_vars['sort']->value=='last_login_time desc'){?>selected='selected'<?php }?><?php }?>>最后登录</option>
                            <option  value="login_num desc" <?php if (isset($_smarty_tpl->tpl_vars['sort']->value)){?><?php if ($_smarty_tpl->tpl_vars['sort']->value=='llogin_num desc'){?>selected='selected'<?php }?><?php }?>>登录次数</option>
                        </select></td>
                    <td><select name="search_state" >
                            <option <?php if (isset($_smarty_tpl->tpl_vars['state']->value)==''){?>selected='selected'<?php }?> value="">会员状态</option>
                            <option  value="no_ischeck0" <?php if (isset($_smarty_tpl->tpl_vars['state']->value)){?><?php if ($_smarty_tpl->tpl_vars['state']->value=='no_ischeck0'){?>selected='selected'<?php }?><?php }?>>待审核</option>
                            <option  value="no_ischeck1" <?php if (isset($_smarty_tpl->tpl_vars['state']->value)){?><?php if ($_smarty_tpl->tpl_vars['state']->value=='no_ischeck1'){?>selected='selected'<?php }?><?php }?>>审核通过</option>
                            <option  value="no_ischeck2" <?php if (isset($_smarty_tpl->tpl_vars['state']->value)){?><?php if ($_smarty_tpl->tpl_vars['state']->value=='no_ischeck2'){?>selected='selected'<?php }?><?php }?>>审核不通过</option>
                            <option  value="no_memberstate" <?php if (isset($_smarty_tpl->tpl_vars['state']->value)){?><?php if ($_smarty_tpl->tpl_vars['state']->value=='no_memberstate'){?>selected='selected'<?php }?><?php }?>>禁止登录</option>
                        </select></td>
                    <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="查询">&nbsp;</a>
                        <?php if (isset($_smarty_tpl->tpl_vars['form_submit']->value)){?><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/lists?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" class="btns tooltip"><span>撤销检索</span></a><?php }?>
                    </td>
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
                    <li>通过会员管理，你可以进行查看、编辑会员资料以及删除会员等操作</li>
                    <li>你可以根据条件搜索会员，然后选择相应的操作</li>
                </ul></td>
        </tr>
        </tbody>
    </table>
    <form method="post" id="listfrom">

        <table class="table tb-type2 nobdb">
            <thead>
                <tr class="thead">
                    <th>&nbsp;</th>
                    <th colspan="2">会员名</th>
                    <th class="align-center">姓名</th>
                    <th class="align-center">推荐人手机号</th>
                    <th class="align-center">名片</th>
                    <th class="align-center"><span fieldname="logins" nc_type="order_by">登录次数</span></th>
                    <th class="align-center"><span fieldname="last_login" nc_type="order_by">最后登录</span></th>
                    <th class="align-center">会员等级</th>
                    <th class="align-center">登录</th>
                    <th class="align-center">审核状态</th>
                    <th class="align-center">操作</th>
                </tr>
            <tbody>
                <?php if ($_smarty_tpl->tpl_vars['infolist']->value){?>
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infolist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                <tr class="hover member">
                    <td class="w24"><input type="checkbox" name='del_id[]' value="<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
" class="checkitem"></td>
                    <td class="w48 picture"><div class="size-44x44"><span class="thumb size-44x44"><i></i><img src="/<?php echo $_smarty_tpl->tpl_vars['v']->value['head_ico'];?>
"  onload="javascript:DrawImage(this, 44, 44);"/></span></div></td>
                    <td><p class="name"><strong><?php echo $_smarty_tpl->tpl_vars['v']->value['truename'];?>
</strong>(登录帐号: <?php echo $_smarty_tpl->tpl_vars['v']->value['username'];?>
)</p>
                        <p class="smallfont">注册时间:&nbsp;<?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['v']->value['register_time']);?>
</p>
                        <div class="relative" >
                            <div class="im">
                                <span class="email" ><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['v']->value['email'];?>
" class="tooltip yes" title="电子邮箱:<?php echo $_smarty_tpl->tpl_vars['v']->value['email'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['email'];?>
</a></span>

                            </div>
                        </div></td>
                    <td class="align-center"><?php echo $_smarty_tpl->tpl_vars['v']->value['truename'];?>
</td>
                    <td class="align-center"><?php echo $_smarty_tpl->tpl_vars['v']->value['cardno'];?>
</td>
                    <td class="align-center"><?php if ($_smarty_tpl->tpl_vars['v']->value['businesscard']!=''){?>已传 | <a href="javascript:void(0);" onclick="return showBusinessCard('<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
','<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
');">查看</a><?php }else{ ?>未传<?php }?></td>
                    <td class="align-center"><?php echo $_smarty_tpl->tpl_vars['v']->value['login_num'];?>
</td>
                    <td class="w150 align-center"><p><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['v']->value['last_login_time']);?>
</p>
                        <p><?php echo $_smarty_tpl->tpl_vars['v']->value['login_ip'];?>
</p></td>
                    <td class="align-center"><?php echo $_smarty_tpl->tpl_vars['v']->value['groupname'];?>
</td>
                    <td class="align-center"><?php if ($_smarty_tpl->tpl_vars['v']->value['isclose']==1){?>允许<?php }else{ ?>不允许<?php }?></td>
                    <td class="align-center"><?php if ($_smarty_tpl->tpl_vars['v']->value['ischeck']==0){?>待审核<?php }elseif($_smarty_tpl->tpl_vars['v']->value['ischeck']==1){?>审核通过<?php }else{ ?>审核未通过<?php }?></td>
                    <td class="w150 align-center"> <a href="javascript:void(0);" onclick="return showDetial('<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
','<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
');">详情</a> | <a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_edit?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&user_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
">编辑</a> | <a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]',<?php echo $_smarty_tpl->tpl_vars['v']->value['user_id'];?>
);">删除</a></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot class="tfoot">
                <tr>
                    <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
                    <td colspan="16"><label for="checkallBottom">全选</label>
                        <a href="JavaScript:void(0);" class="btn" onclick="dodel('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
', 'del_id[]');"><span>删除</span></a>
                        <a href="JavaScript:void(0);" class="btn" onclick="docheck('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_check/?istag=1&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
', 'del_id[]');"><span>审核</span></a>
                        <a href="JavaScript:void(0);" class="btn" onclick="docheck('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_check/?istag=0&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
', 'del_id[]');"><span>反审核</span></a>
                        <a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_level/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
', 'del_id[]');"><span>设置级别</span></a>
                        <a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_status/?istag=1&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
', 'del_id[]');"><span>允许登录</span></a>
                        <a href="JavaScript:void(0);" class="btn" onclick="doOrder('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
member/member/user_status/?istag=0&loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
', 'del_id[]');"><span>禁止登录</span></a>
                        <?php echo $_smarty_tpl->tpl_vars['infopage']->value;?>

                    </td>
                </tr>
            </tfoot>
            <?php }else{ ?>
            <tr class="no_data">
                <td colspan="10">没有符合条件的记录</td>
            </tr>
            <?php }?>
        </table>
    </form>
</div>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['JS_PATH'];?>
jquery.artDialog.js?skin=blue" ></script>
<script type="text/javascript">
            function showDetial(id,loghash){
                $.ajax({
                        url: '/admin.php/member/member/detial?uid='+id+'&loghash='+loghash,
                        success: function(data) {
                            art.dialog({
                                lock: true,
                                background: '#DDD', // 背景色
                                opacity: 0.50, // 透明度
                                content: data,
                                icon: 'succeed',
                                cancel: true,
                            });
                        },
                        cache: false
                    });
            }
            
            
            function showBusinessCard(id,loghash){
                $.ajax({
                        url: '/admin.php/member/member/showBusinessCard?uid='+id+'&loghash='+loghash,
                        success: function(data) {
                            art.dialog({
                                lock: true,
                                background: '#DDD', // 背景色
                                opacity: 0.50, // 透明度
                                content: data,
                                icon: 'succeed',
                                cancel: true,
                            });
                        },
                        cache: false
                    });
            }
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>