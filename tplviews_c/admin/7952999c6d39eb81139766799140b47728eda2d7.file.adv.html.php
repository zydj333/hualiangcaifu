<?php /* Smarty version Smarty-3.1.11, created on 2014-12-18 13:42:03
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\content\adv\adv.html" */ ?>
<?php /*%%SmartyHeaderCode:59215492692bda51a0-66801782%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7952999c6d39eb81139766799140b47728eda2d7' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\content\\adv\\adv.html',
      1 => 1389083068,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59215492692bda51a0-66801782',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COM' => 0,
    'sel' => 0,
    'infolist' => 0,
    'v' => 0,
    'infopage' => 0,
    'JS_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5492692c267cc4_91437357',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5492692c267cc4_91437357')) {function content_5492692c267cc4_91437357($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>广告</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理广告</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/adv_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>新增广告</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_manage/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>管理广告位</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/ap_add/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>新增广告位</span></a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/adv_cache_refresh/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
"><span>清理缓存</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch" >
	<input type="hidden" name="loghash" value="<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" />
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th>广告名称</th>
          <td><input class="txt" type="text" name="search_name" value="<?php echo $_smarty_tpl->tpl_vars['sel']->value['name'];?>
" /></td>
          <th>开始时间</th>
          <td><input class="txt date" type="text" id="add_time_from" name="add_time_from" value="<?php echo $_smarty_tpl->tpl_vars['sel']->value['startdate'];?>
"/>
            <label for="add_time_to">~</label>
            <input class="txt date" type="text" id="add_time_to" name="add_time_to" value="<?php echo $_smarty_tpl->tpl_vars['sel']->value['enddate'];?>
"/>
		  </td>
		  <td><select name="act">
				<option value="">全部</option>
          		<option value="1"  <?php if ($_smarty_tpl->tpl_vars['sel']->value['act']==1){?>selected<?php }?> >未过期</option>
		  		<option value="2"  <?php if ($_smarty_tpl->tpl_vars['sel']->value['act']==2){?>selected<?php }?> >已过期</option>
		    </select></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="查询">&nbsp;</a></td>
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
            <li>添加广告时，需要指定所属广告位</li>
            <li>将广告位调用代码放入前台页面，将显示该广告位的广告</li>
            <!--<li>店主可使用金币购买广告</li>-->
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="listfrom">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th></th>
          <th>广告名称</th>
          <th>所属广告位</th>
          <th class="align-center">开始时间</th>
          <th class="align-center">结束时间</th>
          <th class="align-center"><span class="paixv"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/lists/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&order=click_num">点击率ˇ</a></span></th>
          <th class="align-center">操作</th>
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
          <td class="w24"><input type="checkbox" class="checkitem" name="del_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['adv_id'];?>
" /></td>
          <td><span title="<?php echo $_smarty_tpl->tpl_vars['v']->value['adv_title'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['adv_title'];?>
</span></td>
                    <td><span title="<?php echo $_smarty_tpl->tpl_vars['v']->value['ap']['ap_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['ap']['ap_name'];?>
</span></td>
                    <td class="align-center nowrap"><?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['v']->value['adv_start_date']);?>
</td>
          <td class="align-center nowrap"><?php echo date('Y-m-d',$_smarty_tpl->tpl_vars['v']->value['adv_end_date']);?>
</td>
          <td class="align-center"><?php echo $_smarty_tpl->tpl_vars['v']->value['click_num'];?>
</td>
          <td class="w72 align-center"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/adv_edit/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&adv_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['adv_id'];?>
">编辑</a>&nbsp;|&nbsp;<a href="javascript:del('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/adv_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]',<?php echo $_smarty_tpl->tpl_vars['v']->value['adv_id'];?>
);">删除</a></td>
        </tr>
		<?php } ?>
	 </tbody>
		<tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkall"/></td>
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall">全选</label>
            </span>&nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="dodel('<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
content/adv/adv_del/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
','del_id[]');"><span>删除</span></a>
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
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
    $('#add_time_from').datepicker({dateFormat: 'yy-mm-dd'});
    $('#add_time_to').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>