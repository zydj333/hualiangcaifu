<!--{include "header.html"}-->
<div class="page">
	<div class="fixed-bar">
    <div class="item-title"><h3>系统消息</h3></div>
</div>
  	<script style="text/javascript">
/*	var i='<!--{$data.ms}-->';
	window.setInterval("settime()",1000);
	function settime(){
		var divinner=document.getElementById("settime");
		divinner.innerText=i;
		i--;
	}*/
	</script>
<div class="fixed-empty"></div>
	<table class="table tb-type2 msg">
		<tbody class="noborder">
      		<tr>
        		<td rowspan="5" class="msgbg"></td>
        		<td class="tip"><!--{$data.msg}--></td>
      		</tr>
            <tr>
       			<td class="tip2">若不选择将<span id='settime' style='font-color:red;'><!--{$data.ms}--></span>秒后，自动跳转</td>
      		</tr>
	      	<tr>
	        	<td><!--{if $data.returnjs }-->
	        		<script style="text/javascript"><!--{$data.returnjs}--></script>
	        		<!--{else}-->
		        		<!--{if $data.add eq 1}-->
							<a href="<!--{$data.goback}-->" class="btns"><span>继续添加</span></a>
		        		<!--{/if}-->
		        		<!--{if $data.edit eq 1}-->
							<a href="<!--{$data.goback}-->" class="btns"><span>继续编辑</span></a>
		        		<!--{/if}-->
		        		<!--{if $data.dialog eq 1}-->
							<a href="javascript:void(0);" onclick='window.top.right.location.reload();window.top.art.dialog({id:"<!--{$data.msgtype}-->"}).close();' class="btns"><span>关闭窗口</span></a>
							<script language="javascript">window.setTimeout("go_reload()",<!--{$data.ms}-->*1000);</script>
						<!--{elseif $data.url_forward neq ""}-->
							<script language="javascript">window.setTimeout("go_forward()",<!--{$data.ms}-->*1000);</script>
							<!--{if $data.dialog neq 1}-->
							<a href="<!--{$data.url_forward}-->" class="btns"><span>返回上一页</span></a>
							<!--{/if}-->
						<!--{else}-->
							<a href="javascript:history.go(-1);" class="btns"><span>返回上一页</span></a>
						<!--{/if}-->
					<!--{/if}-->
	          	</td>
	      	</tr>
		</tbody>
  	</table>
  	<script style="text/javascript">
  	function go_reload(){
		window.top.right.location.reload();window.top.art.dialog({id:"<!--{$data.msgtype}-->"}).close();
	}
  	function go_forward(){
		window.location.href="<!--{$data.url_forward}-->";
	}
	function close_dialog() {
		window.top.right.location.reload();window.top.art.dialog({id:"<!--{$data.msgtype}-->"}).close();
	}
</script>
</div>
<!--{include "footer.html"}-->