<table width="98%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFD0A2" style="margin:5px auto;font-size:14px;">
	<tbody>
		<tr>
			<td bgcolor="#FFE3C8"><div align="center" style="font-size:14px; "><b>产品名称</b></div></td>
			<td width="47%" bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['name']}--></td>
			<td width="8%" bgcolor="#FFE3C8" style="font-size:14px; "><div align="center"><b>发行机构</b></div></td>
			<td width="34%" bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['issuer']}--></td>
		</tr>
		<tr>
			<td bgcolor="#FFE3C8"><div align="center" style="font-size:14px; "><b>产品类别</b></div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['category_name']}--></td>
			<td bgcolor="#FFE3C8"><div align="center" style="font-size:14px; "> <b>收益类</b>型 </div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['earning_name']}--></td>
		</tr>
		<tr>
			<td bgcolor="#FFE3C8" style="font-size:14px; "><div align="center"><b>投资领</b>域</div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['investment_name']}--></td>
			<td bgcolor="#FFE3C8" style="font-size:14px; "><div align="center"><b>付息方式</b></div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['interest_name']}--></td>
		</tr>
		<tr>
			<td bgcolor="#FFE3C8" style="font-size:14px; "><div align="center"><b> 规模</b> </div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['scale']}-->亿</td>
			<td bgcolor="#FFE3C8" style="font-size:14px; "><div align="center"><b>期限</b></div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['lifetime']}-->个月</td>
		</tr>
		<tr>
			<td bgcolor="#FFE3C8" style="font-size:14px; "><div align="center"><b>发行费用</b></div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['expenses']}--></td>
			<td bgcolor="#FFE3C8" style="font-size:14px; "><div align="center"><b>投资门槛</b></div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['threshold']}-->万元</td>
		</tr>
		<tr>
			<td bgcolor="#FFE3C8" style="font-size:14px; "><div align="center"> <b>年化收益</b> </div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><!--{$product_info['yield_year']}--></td>
			<td bgcolor="#FFE3C8" style="font-size:14px; "><div align="center"> <b>募集进度</b> </div></td>
			<td bgcolor="#FFFFFF" style="font-size:14px; "><div style="background:#FF2400; color:#fff;padding:5px;"><!--{$product_info['progress']}--></div></td>
		</tr>
		<!--{if $product_info['download']}-->
		<tr>
			<td colspan="4" bgcolor="#FFFFFF" align="center" style="font-size:24px; ;color:#06f;text-algin:center">下载资料:<b></b><a href="http://<!--{SITE_DOM}-->/<!--{$product_info['download']}-->" style="color:blue;font-size:24px;padding:3px; font-family:微软雅黑" target="_blank"><b><!--{$product_info['name']}--></b></a></td>
		</tr>
		<!--{/if}-->
		<tr>
			<td bgcolor="#FFE3C8" class="auto-style1" style="font-size:14px; "><div align="center"><b>产品说明</b></div></td>
			<td colspan="3" bgcolor="#FFFFFF"><div align="left" style="font-size:14px; "><!--{$product_info['content']}--></div></td>
		</tr>
	</tbody>
</table>