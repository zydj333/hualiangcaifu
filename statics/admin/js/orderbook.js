$(function(){
	$("#selcate").change(function(){
		var cate_id = $(this).val();
		$.ajax({
		  type:'get',
			url: '/admin.php/member/order/ajax_cate?cate_id='+cate_id,
			dataType: 'json',
			success:function(data){
				var html = '<option value="">----请选择产品----</option>';
				var l = data.length;
				var i = 0;
				for(i = 0; i < l; i++) {
					html += '<option value="'+data[i]["goods_id"]+'">'+data[i]['goods_name']+'</option>';
				}
				$("#selprod").html(html);
				$("#selprod").show();
				
				$("#seltons").html("");
			}
		});
	});
	
	$("#selprod").change(function(){
		var goods_id = $(this).val();
		$.ajax({
		  type:'get',
			url: '/admin.php/member/order/ajax_tons?goods_id='+goods_id,
			dataType: 'json',
			success:function(data){
				var html = '<option value="0">----请选择规格----</option>';
				var l = data.length;
				var i = 0;
				for(i = 0; i < l; i++) {
					html += '<option value="'+data[i]["id"]+'">'+data[i]['prod_spec']+'</option>';
				}
				$("#seltons").html(html);
				$("#seltons").show();
			}
		});
	});
	
	$("#seltons").change(function(){
		var tons_id = $(this).val();
		$.ajax({
		  type:'get',
			url: '/admin.php/member/order/ajax_tons_info?tons_id='+tons_id,
			dataType: 'json',
			success:function(data){
				$("#spec_ku_tonsid").val(data["id"]);
				$("#spec_ku_tons").val(data["prod_spec"]);
				$("#spec_ku_smishu").val(data["stand_height"]);
				$("#spec_ku_sprice").val(data["price"]);
				$("#spec_ku_sjiacha").val(data["each_price"]);
				if(data["stand_height"]){
					$("#spec_mishu_show1").show();
					$("#spec_mishu_show2").show();
					$("#add_mishu").val(data["stand_height"]);
				}
			}
		});
	});
	
	$("#user_name").change(function(){
		var user_id = $(this).val();
		$.ajax({
		  type:'get',
			url: '/admin.php/member/order/ajax_user_address?user_id='+user_id,
			dataType: 'json',
			success:function(data){
				var html = '';
				var l = data.length;
				var i = 0;
				for(i = 0; i < l; i++) {
					html += '<li><label><input type="radio" value="'+data[i]["address_id"]+'" name="user_address" />'+data[i]['area_info']+'&nbsp;&nbsp;'+data[i]['address']+'&nbsp;('+data[i]['true_name']+')&nbsp;</label></li>';
				}
				$("#user_address_html").html(html);
			}
		});
	});
	
	$("#count_order_sel").change(function(){
		var tag_id = $(this).val();
		$.ajax({
		  type:'get',
			url: '/admin.php/member/order/ajax_count_total?tag_id='+tag_id,
			dataType: 'json',
			success:function(data){
				$("#count_order_val").html(data["goods_amount"]+"元");
			}
		});
	});
});

/*手动输入数量控制----产品下单*/
function numchange2(){
	var goodsnum = parseInt($("#add_numbs").val());
	if(goodsnum <= 1 || goodsnum == null || goodsnum=="" || isNaN(goodsnum)){
		goodsnum = 1;
	}
	$("#add_numbs").val(goodsnum);
}
