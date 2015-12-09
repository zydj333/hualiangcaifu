$(function(){
	$("#province2").change(function(){
		var area_id = $(this).val();
		$.ajax({
		    type:'get',
			url: 'index.php?m=member&c=user&a=ajax_area&area_id='+area_id,
			dataType: 'json',
			success:function(data){
				var html = '<option value="0">请选择</option>';
				var l = data.length;
				var i = 0;
				for(i = 0; i < l; i++) {
					html += '<option value="'+data[i]["id"]+'">'+data[i]['name']+'</option>';
				}
				$("#city2").html(html);
				$("#city2").show();
				
//				$("#county").hide();
//				$("#county").html('');
			}
		});
	});
	
	$("#city2").change(function(){
		var area_id = $(this).val();
		$.ajax({
		    type:'get',
			url: 'index.php?m=member&c=user&a=ajax_area&area_id='+area_id,
			dataType: 'json',
			success:function(data){
				var html = '<option value="0">请选择</option>';
				var l = data.length;
				var i = 0;
				for(i = 0; i < l; i++) {
					html += '<option value="'+data[i]["id"]+'">'+data[i]['name']+'</option>';
				}
				$("#county2").html(html);
				$("#county2").show();
			}
		});
	});
});

function setup(province_id, city_id, country_id) {
	$.ajax({
	  type:'get',
		url: 'index.php?m=member&c=user&a=ajax_area&area_id='+province_id,
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
			$("#city2").html(html);
		}
	});
	
	$.ajax({
	  type:'get',
		url: 'index.php?m=member&c=user&a=ajax_area&area_id='+city_id,
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
			$("#county2").html(html);
		}
	});
}