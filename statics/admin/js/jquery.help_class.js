$(document).ready(function(){
	//列表下拉
	$('img[ectype="flex"]').click(function(){
		var status = $(this).attr('status');
		if(status == 'open'){
			var pr = $(this).parent('td').parent('tr');
			var id = $(this).attr('fieldid');
			var code = $(this).attr('fieldcode');
			var loghash = $(this).attr('loghash');
			var url = $(this).attr('url');
			var admin_url = $(this).attr('admin_url');
			var js = $(this).attr('js');
			var obj = $(this);
			$(this).attr('status','none');
			//ajax
			$.ajax({
				url: admin_url+'content/help/ajax_category_class/?code='+code+'&loghash='+loghash+'&parent_id='+id+'&rrr='+Math.random(),
				dataType: 'json',
				success: function(data){
					var src='';
					for(var i = 0; i < data.length; i++){
						var tmp_vertline = "<img class='preimg' src='"+url+"vertline.gif'/>";
						src += "<tr class='"+pr.attr('class')+" row"+id+"'>";
						src += "<td class='w36'><input type='checkbox' name='del_id[]' value='"+data[i].ac_id+"' class='checkitem'>";
						/*if(data[i].have_child == 1){
							src += " <img fieldid='"+data[i].ac_id+"' status='open' loghash="+loghash+" js="+js+" url="+url+" admin_url="+admin_url+"  ectype='flex' src='"+url+"tv-expandable.gif' />";
						}else{
							src += "<img fieldid='"+data[i].ac_id+"' status='none' ectype='flex' src='"+url+"tv-item.gif' />";
						}*/
						//图片
						src += "</td><td class='w48 sort'>";
						//排序
						src += "<input type='hidden' name='hdnid[]' value='"+data[i].ac_id+"' /><input type='text' value='"+data[i].listorder+"' name='listorder[]' id='listorder[]' class='txt-short'></td>";
						//名称
						src += "<td class='name'>";
						for(var tmp_i=1; tmp_i < (data[i].deep-1); tmp_i++){
							src += tmp_vertline;
						}
						if(data[i].have_child == 1){
							src += " <img fieldid='"+data[i].ac_id+"' fieldcode='"+code+"' status='open' ectype='flex' src='"+url+"tv-item1.gif' />";
						}else{
							src += " <img fieldid='"+data[i].ac_id+"' fieldcode='"+code+"' status='none' ectype='flex' src='"+url+"tv-expandable1.gif' />";
						}
						src += " <span title='不可编辑' required='1' fieldid='"+data[i].ac_id+"' ajax_branch='article_class_name' fieldname='ac_name' ectype='inline_edit' class='editable'>"+data[i].ac_name+"</span>";
						//新增下级
						if(data[i].deep < 2){
							src += "<a class='btn-add-nofloat marginleft' href='"+admin_url+"content/help/article_category_add/?code="+code+"&loghash="+loghash+"&parent_id="+data[i].ac_id+"'><span>新增下级</span></a>";
						}
						src += "</td>";

						//操作
						src += "<td class='w84'>";
						src += "<a href='"+admin_url+"content/help/article_category_edit/?loghash="+loghash+"&ac_id="+data[i].ac_id+"'>编辑</a>";
						src += " | <a href=\"javascript:del('"+admin_url+"content/help/article_category_del/?loghash="+loghash+"','check_ac_id[]',"+data[i].ac_id+");\">删除</a>";
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
					$.getScript(js+"jquery.article_class.js");
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