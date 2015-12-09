$(document).ready(function(){
	//列表下拉
	$('img[ectype="flex"]').click(function(){
		var status = $(this).attr('status');
		if(status == 'open'){
			var pr = $(this).parent('td').parent('tr');
			var id = $(this).attr('fieldid');
			var loghash = $(this).attr('loghash');
			var url = $(this).attr('url');
			var admin_url = $(this).attr('admin_url');
			var js = $(this).attr('js');
			var obj = $(this);
			$(this).attr('status','none');
			//ajax
			$.ajax({
			    type:'get',
				url: admin_url+'goods/category/ajax_category_class/?loghash='+loghash+'&gc_parent_id='+id+'&rrr='+Math.random(),
				dataType: 'json',
				success: function(data){
					var src='';
					for(var i = 0; i < data.length; i++){
						var tmp_vertline = "<img class='preimg' src='"+url+"vertline.gif'/>";
						src += "<tr class='"+pr.attr('class')+" row"+id+"'>";
						src += "<td class='w36'><input type='checkbox' name='check_gc_id[]' value='"+data[i].gc_id+"' class='checkitem'>";
						//图片
						if(data[i].have_child == 1){
							src += " <img fieldid='"+data[i].gc_id+"' status='open' loghash="+loghash+" js="+js+" url="+url+" admin_url="+admin_url+"  ectype='flex' src='"+url+"tv-expandable.gif' />";
						}/*else{
							src += " <img fieldid='"+data[i].gc_id+"' status='none' ectype='flex' src='"+url+"tv-collapsable.gif' />";
						}*/
						src += "</td><td class='w48 sort'>";
						//排序
						src += "<input type='hidden' name='hdnid[]' value='"+data[i].gc_id+"' /><input type='text' value='"+data[i].listorder+"' name='listorder[]' id='listorder[]' class='txt-short'></td>";
						//名称
						src += "<td class='w50pre name'>";


						for(var tmp_i=1; tmp_i < (data[i].deep-1); tmp_i++){
							src += tmp_vertline;
						}
						if(data[i].have_child == 1){
							src += " &nbsp;&nbsp;&nbsp;&nbsp;<img fieldid='"+data[i].gc_id+"' status='open' ectype='flex' src='"+url+"tv-item1.gif' />";
						}else{
							src += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img fieldid='"+data[i].gc_id+"' status='none' ectype='flex' src='"+url+"tv-expandable1.gif' />";
						}
						src += data[i].gc_name;
						//新增下级
						if(data[i].deep < 3){
							src += "<a class='btn-add-nofloat marginleft' href='"+admin_url+"goods/category/category_add/?loghash="+loghash+"&gc_parent_id="+data[i].gc_id+"'><span>新增下级</span></a>";
						}
						src += "</td>";
						//类型
						src += "<td>"+data[i].type_name+"</td>";
						//显示状态
						src += "<td class='align-center power-onoff'>";
						if(data[i].isshow == 0){
							src += "<a href='JavaScript:void(0);' class='tooltip disabled' fieldvalue='0' fieldid='"+data[i].gc_id+"' ajax_branch='goods_class_index_show' fieldname='gc_index_show' ectype='inline_edit' title='不可编辑'><img src='"+url+"transparent.gif'></a>"
						}else {
							src += "<a href='JavaScript:void(0);' class='tooltip enabled' fieldvalue='1' fieldid='"+data[i].gc_id+"' ajax_branch='goods_class_index_show' fieldname='gc_index_show' ectype='inline_edit' title='不可编辑'><img src='"+url+"transparent.gif'></a>"
						}
						src += "</td>";
						//首页显示状态
						src += "<td class='align-center power-onoff'>";
						if(data[i].gc_index_show == 0){
							src += "<a href='JavaScript:void(0);' class='tooltip disabled' fieldvalue='0' fieldid='"+data[i].gc_id+"' ajax_branch='goods_class_show' fieldname='gc_show' ectype='inline_edit' title='不可编辑'><img src='"+url+"transparent.gif'></a>"
						}else {
							src += "<a href='JavaScript:void(0);' class='tooltip enabled' fieldvalue='1' fieldid='"+data[i].gc_id+"' ajax_branch='goods_class_show' fieldname='gc_show' ectype='inline_edit' title='不可编辑'><img src='"+url+"transparent.gif'></a>"
						}
						src += "</td>";
						//操作
						src += "<td class='w84'>";
						src += "<a href='"+admin_url+"goods/category/category_edit/?loghash="+loghash+"&gc_id="+data[i].gc_id+"'>编辑</a>";
						src += " | <a href=\"javascript:del('"+admin_url+"goods/category/category_del/?loghash="+loghash+"','check_gc_id[]',"+data[i].gc_id+");\">删除</a>";
						src += "</td>";
						src += "</tr>";
					}
					//插入
					pr.after(src);
					obj.attr('status','close');
					obj.attr('src',obj.attr('src').replace("tv-expandable","tv-collapsable"));
					$('img[ectype="flex"]').unbind('click');
					$('span[ectype="inline_edit"]').unbind('click');
					//重现初始化页面
                    $.getScript(js+"jquery.edit.js");
					$.getScript(js+"jquery.goods_class.js");
					$.getScript(js+"jquery.tooltip.js");
					$.getScript(js+"admincp.js");
				},
				error: function(){
					alert('获取信息失败');
				}
			});
		}
		if(status == 'close'){
			$(".row"+$(this).attr('fieldid')).remove();
			$(this).attr('src',$(this).attr('src').replace("tv-collapsable","tv-expandable"));
			$(this).attr('status','open');
		}
	})
});