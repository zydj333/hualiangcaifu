<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:06:34
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\setup\setup.html" */ ?>
<?php /*%%SmartyHeaderCode:77205550711a8a4521-85831463%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1eca258f0dc5be55d1b9bb4a16b2c291eecada8f' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\setup\\setup.html',
      1 => 1401019642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77205550711a8a4521-85831463',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'JS_PATH' => 0,
    'setup' => 0,
    'IMG_PATH' => 0,
    'COM' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5550711a9dcd27_47207820',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5550711a9dcd27_47207820')) {function content_5550711a9dcd27_47207820($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
admin.tools.js"></script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>站点设置</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>基本信息</span></a></li>
        
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name="form1">
    <input type="hidden" name="dosubmit" value="ok" />
    <input type="hidden" name="old_site_logo" value="<?php echo $_smarty_tpl->tpl_vars['setup']->value['site_logo'];?>
" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="site_name">网站名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_name" name="site_name" value="<?php echo $_smarty_tpl->tpl_vars['setup']->value['site_name'];?>
" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">网站名称，将显示在前台顶部欢迎信息等位置</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="site_title">网站标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_title" name="site_title" value="<?php echo $_smarty_tpl->tpl_vars['setup']->value['site_title'];?>
" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">网站标题，将显示在浏览器窗口标题等位置</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="hot_search">热门搜索:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="hot_search" name="hot_search" value="<?php echo $_smarty_tpl->tpl_vars['setup']->value['hot_search'];?>
" class="txt" type="text"></td>
          <td class="vatop tips"><span class="vatop rowform">热门搜索，将显示在前台搜索框下面，前台点击时直接作为关键词进行搜索，多个关键词间请用半角逗号 "," 隔开</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="site_logo">网站Logo:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><span class="type-file-show"><img class="show_image" src="<?php echo $_smarty_tpl->tpl_vars['IMG_PATH']->value;?>
preview.png">
            <div class="type-file-preview"><img src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
<?php echo $_smarty_tpl->tpl_vars['setup']->value['site_logo'];?>
"></div>
            </span><span class="type-file-box">
            <input name="site_logo" type="file" class="type-file-file" id="site_logo" size="30" hidefocus="true" nc_type="change_site_logo">
            </span></td>
          <td class="vatop tips">180px * 50px</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="icp_number">ICP证书号:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="icp_number" name="icp_number" value="<?php echo $_smarty_tpl->tpl_vars['setup']->value['icp_number'];?>
" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">前台页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入你的授权码，它将显示在前台页面底部，如果没有请留空</span></td>
        </tr>
         <tr>
          <td colspan="2" class="required"><label for="statistics_code">第三方流量统计代码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="statistics_code" rows="6" class="tarea" id="statistics_code"><?php echo $_smarty_tpl->tpl_vars['setup']->value['statistics_code'];?>
</textarea></td>
          <td class="vatop tips">前台页面底部可以显示第三方统计</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="time_zone"> 默认时区:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select id="time_zone" name="time_zone">
              <option value="-12">(GMT -12:00) Eniwetok, Kwajalein</option>
              <option value="-11">(GMT -11:00) Midway Island, Samoa</option>
              <option value="-10">(GMT -10:00) Hawaii</option>
              <option value="-9">(GMT -09:00) Alaska</option>
              <option value="-8">(GMT -08:00) Pacific Time (US &amp; Canada), Tijuana</option>
              <option value="-7">(GMT -07:00) Mountain Time (US &amp; Canada), Arizona</option>
              <option value="-6">(GMT -06:00) Central Time (US &amp; Canada), Mexico City</option>
              <option value="-5">(GMT -05:00) Eastern Time (US &amp; Canada), Bogota, Lima, Quito</option>
              <option value="-4">(GMT -04:00) Atlantic Time (Canada), Caracas, La Paz</option>
              <option value="-3.5">(GMT -03:30) Newfoundland</option>
              <option value="-3">(GMT -03:00) Brassila, Buenos Aires, Georgetown, Falkland Is</option>
              <option value="-2">(GMT -02:00) Mid-Atlantic, Ascension Is., St. Helena</option>
              <option value="-1">(GMT -01:00) Azores, Cape Verde Islands</option>
              <option value="0">(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>
              <option value="1">(GMT +01:00) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome</option>
              <option value="2">(GMT +02:00) Cairo, Helsinki, Kaliningrad, South Africa</option>
              <option value="3">(GMT +03:00) Baghdad, Riyadh, Moscow, Nairobi</option>
              <option value="3.5">(GMT +03:30) Tehran</option>
              <option value="4">(GMT +04:00) Abu Dhabi, Baku, Muscat, Tbilisi</option>
              <option value="4.5">(GMT +04:30) Kabul</option>
              <option value="5">(GMT +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
              <option value="5.5">(GMT +05:30) Bombay, Calcutta, Madras, New Delhi</option>
              <option value="5.75">(GMT +05:45) Katmandu</option>
              <option value="6">(GMT +06:00) Almaty, Colombo, Dhaka, Novosibirsk</option>
              <option value="6.5">(GMT +06:30) Rangoon</option>
              <option value="7">(GMT +07:00) Bangkok, Hanoi, Jakarta</option>
              <option value="8">(GMT +08:00) Beijing, Hong Kong, Perth, Singapore, Taipei</option>
              <option value="9">(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
              <option value="9.5">(GMT +09:30) Adelaide, Darwin</option>
              <option value="10">(GMT +10:00) Canberra, Guam, Melbourne, Sydney, Vladivostok</option>
              <option value="11">(GMT +11:00) Magadan, New Caledonia, Solomon Islands</option>
              <option value="12">(GMT +12:00) Auckland, Wellington, Fiji, Marshall Island</option>
            </select></td>
          <td class="vatop tips">设置系统使用的时区，中国为+8</td>
        </tr>
        <tr>
          <td colspan="2" class="required">站点状态:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="site_status1" class="cb-enable <?php if ($_smarty_tpl->tpl_vars['setup']->value['site_status']==1){?>selected<?php }?>" ><span>开启</span></label>
            <label for="site_status0" class="cb-disable <?php if ($_smarty_tpl->tpl_vars['setup']->value['site_status']==0){?>selected<?php }?>" ><span>关闭</span></label>
            <input id="site_status1" name="site_status" checked="checked"  value="1" type="radio">
            <input id="site_status0" name="site_status"  value="0" type="radio"></td>
          <td class="vatop tips"><span class="vatop rowform">可暂时将站点关闭，其他人无法访问，但不影响管理员访问后台</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required">调试模式: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="debug_isuse_1" class="cb-enable <?php if ($_smarty_tpl->tpl_vars['setup']->value['debug_isuse']==1){?>selected<?php }?>" title="是"><span>开启</span></label>
            <label for="debug_isuse_0" class="cb-disable <?php if ($_smarty_tpl->tpl_vars['setup']->value['debug_isuse']==0){?>selected<?php }?>" title="否"><span>关闭</span></label>
            <input id="debug_isuse_1" name="debug_isuse"  value="1" type="radio">
            <input id="debug_isuse_0" name="debug_isuse" checked="checked" value="0" type="radio">
          </td>
          <td class="vatop tips"><span class="vatop rowform">开启调式模式有助于技术人员维护工作，适合于开发环境，但不建议在生产环境中开启</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="closed_reason">关闭原因:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="closed_reason" rows="6" class="tarea" id="closed_reason" ><?php echo $_smarty_tpl->tpl_vars['setup']->value['closed_reason'];?>
</textarea></td>
          <td class="vatop tips"><span class="vatop rowform">当网站处于关闭状态时，关闭原因将显示在前台</span></td>
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
<script type="text/javascript">
// 模拟网站LOGO上传input type='file'样式
$(function(){
    var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
	$(textButton).insertBefore("#site_logo");
	$("#site_logo").change(function(){
	$("#textfield1").val($("#site_logo").val());
});
// 上传图片类型
$('input[class="type-file-file"]').change(function(){
	var filepatd=$(this).val();
	var extStart=filepatd.lastIndexOf(".");
	var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("图片限于png,gif,jpeg,jpg格式");
				$(this).attr('value','');
			return false;
		}
	});

$('#time_zone').attr('value','8');
});
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>