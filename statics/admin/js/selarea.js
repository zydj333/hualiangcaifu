$(function(){
	$("#province_id").change(function(){
		var area_id = $(this).val();
		$.ajax({
		  type:'get',
			url: '/admin.php/member/member/ajax_area?area_id='+area_id,
			dataType: 'json',
			success:function(data){
				var html = '<option value="0">请选择</option>';
				var l = data.length;
				var i = 0;
				for(i = 0; i < l; i++) {
					html += '<option value="'+data[i]["id"]+'">'+data[i]['name']+'</option>';
				}
				$("#city_id").html(html);
				$("#city_id").show();
				
//				$("#county").hide();
//				$("#county").html('');
			}
		});
	});
	
	$("#city_id").change(function(){
		var area_id = $(this).val();
		$.ajax({
		    type:'get',
			url: '/admin.php/member/member/ajax_area?area_id='+area_id,
			dataType: 'json',
			success:function(data){
				var html = '<option value="0">请选择</option>';
				var l = data.length;
				var i = 0;
				for(i = 0; i < l; i++) {
					html += '<option value="'+data[i]["id"]+'">'+data[i]['name']+'</option>';
				}
				$("#area_id").html(html);
				$("#area_id").show();
			}
		});
	});
});

function setup(province_id, city_id, country_id) {
	$.ajax({
	  type:'get',
		url: '/admin.php/member/member/ajax_area?area_id='+province_id,
		dataType: 'json',
		success:function(data){
			var html = '<option value="0">请选择</option>';
			var l = data.length;
			var i = 0;
			for(i = 0; i < l; i++) {
				if (data[i]["id"] == city_id) {
					html += '<option value="'+data[i]["id"]+'" selected="selected">'+data[i]['name']+'</option>';
				}else {
					html += '<option value="'+data[i]["id"]+'">'+data[i]['name']+'</option>';
				}
			}
			$("#city_id").html(html);
		}
	});
	
	$.ajax({
	  type:'get',
		url: '/admin.php/member/member/ajax_area?area_id='+city_id,
		dataType: 'json',
		success:function(data){
			var html = '<option value="0">请选择</option>';
			var l = data.length;
			var i = 0;
			for(i = 0; i < l; i++) {
				if (data[i]["id"] == country_id) {
					html += '<option value="'+data[i]["id"]+'" selected="selected">'+data[i]['name']+'</option>';
				}else {
					html += '<option value="'+data[i]["id"]+'">'+data[i]['name']+'</option>';
				}
			}
			$("#area_id").html(html);
		}
	});
}