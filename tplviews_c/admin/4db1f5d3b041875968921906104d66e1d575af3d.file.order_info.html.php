<?php /* Smarty version Smarty-3.1.11, created on 2014-12-16 01:36:37
         compiled from "D:\wamp\www\20141111_hualiangcaifu\tplviews\admin\caifu\orderreserve\order_info.html" */ ?>
<?php /*%%SmartyHeaderCode:25515548f1c25f42395-17008912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4db1f5d3b041875968921906104d66e1d575af3d' => 
    array (
      0 => 'D:\\wamp\\www\\20141111_hualiangcaifu\\tplviews\\admin\\caifu\\orderreserve\\order_info.html',
      1 => 1415529038,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25515548f1c25f42395-17008912',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'oinfo' => 0,
    'order_state' => 0,
    'ouser' => 0,
    'oproduct' => 0,
    'COM' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548f1c26321426_02275100',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548f1c26321426_02275100')) {function content_548f1c26321426_02275100($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page">
  <table class="table tb-type2 order">
    <tbody>
      <tr class="space">
        <th colspan="15">订单状态</th>
      </tr>
      <tr>
        <td colspan="2"><ul>
            <li><strong>订单号:</strong>&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['oinfo']->value['order_sn'];?>
</li>
            <li><strong>订单状态:</strong><font color="red"><?php echo $_smarty_tpl->tpl_vars['order_state']->value;?>
</font></li>
            <li><strong>客户姓名：<?php echo $_smarty_tpl->tpl_vars['oinfo']->value['name'];?>
</strong></li>
            <li><strong>会员帐号：<?php echo $_smarty_tpl->tpl_vars['ouser']->value['username'];?>
(<?php echo $_smarty_tpl->tpl_vars['ouser']->value['truename'];?>
)</strong></li>
            <li><strong>手机号码:</strong><?php echo $_smarty_tpl->tpl_vars['oinfo']->value['phone'];?>
</li>
            <li><strong>预约金额:</strong><font color="red"><?php echo $_smarty_tpl->tpl_vars['oinfo']->value['money'];?>
</font></li>
            <li><strong>地址:</strong><?php echo $_smarty_tpl->tpl_vars['oinfo']->value['address'];?>
</li>
            <li><strong>备注:</strong><?php echo $_smarty_tpl->tpl_vars['oinfo']->value['remark'];?>
</li>
          </ul></td>
      </tr>
      <tr>
        <th>产品信息</th>
      </tr>
      <tr>
        <td><ul>
            <li><strong>产品名称:</strong><?php echo $_smarty_tpl->tpl_vars['oproduct']->value['name'];?>
</li>
            <li><strong>产品期限:</strong><?php echo $_smarty_tpl->tpl_vars['oproduct']->value['lifetime'];?>
</li>
            <li><strong>预约时间:</strong><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['oinfo']->value['post_time']);?>
</li>
       </ul></td>
      </tr>

      <tr>
	 
	  
	  
<!--物流信息添加开始 将订单状态修改为已发货的时候 需要填写下面的信息-->	  

    </tbody>
    <tfoot>
      <tr class="tfoot">
	  		<td colspan="5">
	  			<a href="JavaScript:void(0);" class="btn" onclick="history.go(-1)"><span>返回</span></a>
	  			
	  			<a href="JavaScript:void(0);" class="<?php if ($_smarty_tpl->tpl_vars['oinfo']->value['status']==1){?>btn<?php }else{ ?>btn2<?php }?>" <?php if ($_smarty_tpl->tpl_vars['oinfo']->value['status']==1){?>onclick="nextstate('<?php echo $_smarty_tpl->tpl_vars['oinfo']->value['id'];?>
')"<?php }?>>
		      	<span>已成立</span>
		   		</a>
		
		   		<a href="JavaScript:void(0);" class="<?php if ($_smarty_tpl->tpl_vars['oinfo']->value['status']==2){?>btn<?php }else{ ?>btn2<?php }?>"  <?php if ($_smarty_tpl->tpl_vars['oinfo']->value['status']==2){?>onclick="nextstate('<?php echo $_smarty_tpl->tpl_vars['oinfo']->value['id'];?>
')"<?php }?>>
		     		<span>已驳回</span>
		   		</a>
		   
		 		</td> 

		
	
	  
	  
	  
	  
	  </tr>
    </tfoot>
  </table>
</div>
<script type="text/javascript">

function nextstate(orderSn){
  if(confirm('您确定修改订单的当前状态?')){
           
           location.href="<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
caifu/order/state_next/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&order_sn="+orderSn;
 	}
}

function changeprice(recid){
	if(confirm('您确定要修改订单的价格吗？')){
		var rec_id = recid;
		var goods_price = $("#orderprice_"+recid).val();

		$.ajax({
		  type:'get',
			url: '/admin.php/order/order/ajax_change_price?rec_id='+rec_id+'&goods_price='+goods_price,
			dataType: 'json',
			success:function(data){
				$("#order_amount1").html(data["order_total"]);
				$("#order_amount2").html(data["order_total"]);
				$("#subtotal_"+rec_id).html(data["sub_total"]);
			}
		});
	}
}

function changenum(recid){
	if(confirm('您确定要修改订单的数量吗？')){
		var rec_id = recid;
		var goods_num = $("#ordernum_"+recid).val();

		$.ajax({
		  type:'get',
			url: '/admin.php/order/order/ajax_change_num?rec_id='+rec_id+'&goods_num='+goods_num,
			dataType: 'json',
			success:function(data){
				$("#order_amount1").html(data["order_total"]);
				$("#order_amount2").html(data["order_total"]);
				$("#subtotal_"+rec_id).html(data["sub_total"]);
			}
		});
	}
}

function addreturn(recid) {
	window.top.art.dialog({id:'adddialog'}).close();
	window.top.art.dialog({title:'退货',id:'adddialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
order/order/apply_return/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&rec_id='+recid,width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'adddialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'adddialog'}).close()});
}

function addfix(recid) {
	window.top.art.dialog({id:'adddialog'}).close();
	window.top.art.dialog({title:'返修',id:'adddialog',iframe:'<?php echo $_smarty_tpl->tpl_vars['COM']->value['ADMIN_URL'];?>
order/order/apply_fix/?loghash=<?php echo $_smarty_tpl->tpl_vars['COM']->value['LOGHASH'];?>
&rec_id='+recid,width:'800',height:'500'}, function(){var d = window.top.art.dialog({id:'adddialog'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'adddialog'}).close()});
}
</script> 
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>