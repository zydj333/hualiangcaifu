<?php /* Smarty version Smarty-3.1.11, created on 2015-05-11 17:00:18
         compiled from "D:\wamp\www\hualiangcaifu\tplviews\admin\index.html" */ ?>
<?php /*%%SmartyHeaderCode:2148855506fa222d9a7-27534564%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '811d0f536e12abbd0a8a8e1ce9aca7dba2b9c0dd' => 
    array (
      0 => 'D:\\wamp\\www\\hualiangcaifu\\tplviews\\admin\\index.html',
      1 => 1381081052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2148855506fa222d9a7-27534564',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CSS_PATH' => 0,
    'JS_PATH' => 0,
    'COM' => 0,
    'username' => 0,
    'roleinfo' => 0,
    'menulist' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_55506fa240a310_13857080',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55506fa240a310_13857080')) {function content_55506fa240a310_13857080($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="off">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>后台管理中心</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
zh-cn-system.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
dialog.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
style/zh-cn-styles1.css" title="styles1" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
style/zh-cn-styles2.css" title="styles2" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
style/zh-cn-styles3.css" title="styles3" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['CSS_PATH']->value;?>
style/zh-cn-styles4.css" title="styles4" media="screen" />
<script language="javascript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
styleswitch.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['JS_PATH']->value;?>
dialog.js"></script>
<script type="text/javascript">
var loghash = '<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
'
</script>
<style type="text/css">
.objbody{overflow:hidden}
</style>
</head>
<body scroll="no" class="objbody">
<div id="dvLockScreen" class="ScreenLock" style="display:none">
    <div id="dvLockScreenWin" class="inputpwd">
    <h5><b class="ico ico-info"></b><span id="lock_tips">锁屏状态，请输入密码解锁</span></h5>
    <div class="input">
    	<label class="lb">密码：</label><input type="password" id="lock_password" class="input-text" size="24">
        <input type="submit" class="submit" value="&nbsp;" name="dosubmit" onclick="check_screenlock();return false;">
    </div></div>
</div>
<div class="header">
	<div class="logo lf"><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
" target="_blank"><span class="invisible">后台管理系统</span></a></div>
    <div class="rt-col">
    </div>
    <div class="col-auto">
    	<div class="log white cut_line">您好！<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
  [<?php echo $_smarty_tpl->tpl_vars['roleinfo']->value['rolename'];?>
]<span>|</span><a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
main_index/logout">[退出]</a><span>|</span>
    		<a href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['BASE_URL'];?>
" target="_blank" id="site_homepage">站点首页</a>
    	</div>
        <ul class="nav white" id="top_menu">
<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menulist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
<li id="_M<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="top_menu"><a href="javascript:_M(<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
,'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
<?php echo $_smarty_tpl->tpl_vars['v']->value['m'];?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value['c'];?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value['a'];?>
/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
')" hidefocus="true" style="outline:none;"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a></li>
<?php } ?>
       <!-- <li class="tab_web"><a href="javascript:;"><span>默认站点</span></a></li>-->
        </ul>
    </div>
</div>
<div id="content">
	<div class="col-left left_menu">
    	<div id="Scroll"><div id="leftMain"></div></div>
<script type="text/javascript">
$(".switchs").each(function(i){
	var ul = $(this).parent().next();
	$(this).click(
	function(){
		if(ul.is(':visible')){
			ul.hide();
			$(this).removeClass('on');
				}else{
			ul.show();
			$(this).addClass('on');
		}
	})
});
</script>
        <a href="javascript:;" id="openClose" style="outline-style: none; outline-color: invert; outline-width: medium;" hideFocus="hidefocus" class="open" title="展开与关闭"><span class="hidden">展开</span></a>
    </div>
	<div class="col-1 lf cat-menu" id="display_center_id" style="display:none" height="100%">
	<div class="content">
        	<iframe name="center_frame" id="center_frame" src="" frameborder="false" scrolling="auto" style="border:none" width="100%" height="auto" allowtransparency="true"></iframe>
           </div>
        </div>
    <div class="col-auto mr8">
    <div class="crumbs">
    <div class="shortcut cu-span"><a href="javascript:art.dialog({id:'map',iframe:'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
main_index/public_map?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
', title:'后台地图', width:'870', height:'500', lock:true});void(0);"><span>后台地图</span></a></div>
    当前位置：<span id="current_pos"></span></div>
    	<div class="col-1">
        	<div class="content" style="position:relative; overflow:hidden">
                <iframe name="right" id="rightMain" src="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
mypanel/mypanel/public_welcome?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
" frameborder="false" scrolling="auto" style="border:none; margin-bottom:30px" width="100%" height="auto" allowtransparency="true" > </iframe>
                <div class="fav-nav">
					<div id="panellist"></div>
					<div id="paneladd"></div>
					<input type="hidden" id="menuid" value="">
					<input type="hidden" id="bigid" value="" />
                    <div id="help" class="fav-help"></div>
				</div>
        	</div>
        </div>
    </div>
</div>
<div class="tab-web-panel hidden" style="position:absolute; z-index:999; background:#fff">
<ul>
	<li style="margin:0"><a href="javascript:void(0)">默认站点</a></li>
</ul>
</div>
<div class="scroll"><a href="javascript:;" class="per" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(1);"></a><a href="javascript:;" class="next" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(2);"></a></div>
<script type="text/javascript">
if(!Array.prototype.map)
Array.prototype.map = function(fn,scope) {
  var result = [],ri = 0;
  for (var i = 0,n = this.length; i < n; i++){
	if(i in this){
	  result[ri++]  = fn.call(scope ,this[i],i,this);
	}
  }
return result;
};

var getWindowSize = function(){
		return ["Height","Width"].map(function(name){
  		return window["inner"+name] ||
		document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
	});
}

window.onload = function (){
	if(!+"\v1" && !document.querySelector) { // for IE6 IE7
	  document.body.onresize = resize;
	} else {
	  window.onresize = resize;
	}
	function resize() {
		wSize();
		return false;
	}
}

function wSize(){
	//这是一字符串
	var str=getWindowSize();
	var strs= new Array(); //定义一数组
	strs=str.toString().split(","); //字符分割
	var heights = strs[0]-150,Body = $('body');
	$('#rightMain').height(heights);
	//iframe.height = strs[0]-46;
	if(strs[1]<980){
		$('.header').css('width',980+'px');
		$('#content').css('width',980+'px');
		Body.attr('scroll','');
		Body.removeClass('objbody');
	}else{
		$('.header').css('width','auto');
		$('#content').css('width','auto');
		Body.attr('scroll','no');
		Body.addClass('objbody');
	}

	var openClose = $("#rightMain").height()+39;
	$('#center_frame').height(openClose+9);
	$("#openClose").height(openClose+30);
	$("#Scroll").height(openClose-20);
	windowW();
}

wSize();

function windowW(){
	if($('#Scroll').height()<$("#leftMain").height()){
		$(".scroll").show();
	}else{
		$(".scroll").hide();
	}
}

windowW();

//站点下拉菜单

$(function(){
	var offset = $(".tab_web").offset();
	var tab_web_panel = $(".tab-web-panel");
	$(".tab_web").mouseover(function(){
			tab_web_panel.css({ "left": +offset.left+4, "top": +offset.top+$('.tab_web').height()+2});
			tab_web_panel.show();
			if(tab_web_panel.height() > 200){
				tab_web_panel.children("ul").addClass("tab-scroll");
			}
		});
	$(".tab_web span").mouseout(function(){hidden_site_list_1()});
	$(".tab-web-panel").mouseover(function(){clearh();$('.tab_web a').addClass('on')}).mouseout(function(){hidden_site_list_1();$('.tab_web a').removeClass('on')});
	//默认载入左侧菜单
	$("#leftMain").load("<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
main_index/public_menu_left?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&menuid=10");
})

//隐藏站点下拉。

var s = 0;
var h;
function hidden_site_list() {
	s++;
	if(s>=3) {
		$('.tab-web-panel').hide();
		clearInterval(h);
		s = 0;
	}
}

function clearh(){
	if(h)clearInterval(h);
}

function hidden_site_list_1() {
	h = setInterval("hidden_site_list()", 1);
}



//左侧开关

$("#openClose").click(function(){
	if($(this).data('clicknum')==1) {
		$("html").removeClass("on");
		$(".left_menu").removeClass("left_menu_on");
		$(this).removeClass("close");
		$(this).data('clicknum', 0);
		$(".scroll").show();
	} else {
		$(".left_menu").addClass("left_menu_on");
		$(this).addClass("close");
		$("html").addClass("on");
		$(this).data('clicknum', 1);
		$(".scroll").hide();
	}
	return false;
});



function _M(menuid,targetUrl) {
	$("#menuid").val(menuid);
	$("#bigid").val(menuid);
	//$("#paneladd").html('<a class="panel-add" href="javascript:add_panel();"><em>添加</em></a>');
	$("#leftMain").load("<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
main_index/public_menu_left?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&menuid="+menuid, {limit: 25}, function(){
		 windowW();
	});

	//$("#rightMain").attr('src', targetUrl);
	$('.top_menu').removeClass("on");
	$('#_M'+menuid).addClass("on");

	$.get("<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
main_index/public_current_pos?menuid="+menuid+'&loghash='+loghash, function(data){
		$("#current_pos").html(data);
	});
	//当点击顶部菜单后，隐藏中间的框架
	//$('#display_center_id').css('display','none');
	//显示左侧菜单，当点击顶部时，展开左侧
	$(".left_menu").removeClass("left_menu_on");
	$("#openClose").removeClass("close");
	$("html").removeClass("on");
	$("#openClose").data('clicknum', 0);
	$("#current_pos").data('clicknum', 1);
}

function _MP(menuid,targetUrl) {
	$("#menuid").val(menuid);
	$("#display_center_id").hide();
	$("#center_frame").attr("src","");
	//$("#paneladd").html('<a class="panel-add" href="javascript:add_panel();"><em>添加</em></a>');
	$("#rightMain").attr('src', targetUrl+'?menuid='+menuid+'&loghash='+loghash);
	$('.sub_menu').removeClass("on fb blue");
	$('#_MP'+menuid).addClass("on fb blue");
	$.get("<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
main_index/public_current_pos?menuid="+menuid+'&loghash='+loghash, function(data){
		$("#current_pos").html(data);
	});
	//$("#current_pos").data('clicknum', 1);
	show_help(targetUrl);
}



function show_help(targetUrl) {
/*	$("#help").slideUp("slow");
	var str = '';
	$.getJSON("http://v9.help.phpcms.cn/api.php?jsoncallback=?",{op:'help',targetUrl: targetUrl},
	function(data){
		if(data!=null) {
			$("#help").slideDown("slow");
			$.each(data, function(i,item){
				str += '<a href="'+item.url+'" target="_blank">'+item.title+'</a>';
			});
			str += '<a class="panel-delete" href="javascript:;" onclick="$(\'#help\').slideUp(\'slow\')"></a>';
			$('#help').html(str);
		}
	});
	$("#help").data('time', 1);*/
}

setInterval("hidden_help()", 10000);

function hidden_help() {
	var htime = $("#help").data('time')+1;
	$("#help").data('time', htime);
	if(htime>2) $("#help").slideUp("slow");
}

function add_panel() {
	var menuid = $("#menuid").val();
	$.ajax({
		type: "POST",
		url: "?m=admin&c=index&a=public_ajax_add_panel",
		data: "menuid=" + menuid,
		success: function(data){
			if(data) {
				$("#panellist").html(data);
			}
		}
	});
}

function delete_panel(menuid, id) {
	$.ajax({
		type: "POST",
		url: "?m=admin&c=index&a=public_ajax_delete_panel",
		data: "menuid=" + menuid,
		success: function(data){
			$("#panellist").html(data);
		}
	});
}



function paneladdclass(id) {
	//$("#panellist span a[class='on']").removeClass();
	//$(id).addClass('on')
}

setInterval("session_life()", 160000);

function session_life() {
	$.get("?m=admin&c=index&a=public_session_life");
}

function lock_screen() {
	$.get("?m=admin&c=index&a=public_lock_screen");
	$('#dvLockScreen').css('display','');
}

function check_screenlock() {
	var lock_password = $('#lock_password').val();
	if(lock_password=='') {
		$('#lock_tips').html('<font color="red">密码不能为空。</font>');
		return false;
	}
	$.get("?m=admin&c=index&a=public_login_screenlock", { lock_password: lock_password},function(data){
		if(data==1) {
			$('#dvLockScreen').css('display','none');
			$('#lock_password').val('');
			$('#lock_tips').html('锁屏状态，请输入密码解锁');
		} else if(data==3) {
			$('#lock_tips').html('<font color="red">密码重试次数太多</font>');
		} else {
			strings = data.split('|');
			$('#lock_tips').html('<font color="red">密码错误，您还有'+strings[1]+'次尝试机会！</font>');
		}
	});
}

$(document).bind('keydown', 'return', function(evt){check_screenlock();return false;});

(function(){
    var addEvent = (function(){
             if (window.addEventListener) {
                return function(el, sType, fn, capture) {
                    el.addEventListener(sType, fn, (capture));
                };
            } else if (window.attachEvent) {
                return function(el, sType, fn, capture) {
                    el.attachEvent("on" + sType, fn);
                };
            } else {
                return function(){};
            }
        })(),
    Scroll = document.getElementById('Scroll');
    // IE6/IE7/IE8/Opera 10+/Safari5+
    addEvent(Scroll, 'mousewheel', function(event){
    event = window.event || event ;
		if(event.wheelDelta <= 0 || event.detail > 0) {
			Scroll.scrollTop = Scroll.scrollTop + 29;
		} else {
			Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);
    // Firefox 3.5+
    addEvent(Scroll, 'DOMMouseScroll',  function(event){
        event = window.event || event ;
		if(event.wheelDelta <= 0 || event.detail > 0) {
				Scroll.scrollTop = Scroll.scrollTop + 29;
			} else {
				Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);
})();

function menuScroll(num){
	var Scroll = document.getElementById('Scroll');
	if(num==1){
		Scroll.scrollTop = Scroll.scrollTop - 60;
	}else{
		Scroll.scrollTop = Scroll.scrollTop + 60;
	}
}
</script>
</body>
</html><?php }} ?>