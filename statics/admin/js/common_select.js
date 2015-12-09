/* 多级选择相关函数，如地区选择，分类选择
 * common_select
 */

/* 地区选择函数 */
function regionInit(divId)
{
    $("#" + divId + " > select").change(regionChange); // select的onchange事件
    $("#" + divId + " > input:button[class='edit_region']").click(regionEdit); // 编辑按钮的onclick事件
}

function regionChange()
{
    // 删除后面的select
    $(this).nextAll("select").remove();

    // 计算当前选中到id和拼起来的name
    var selects = $(this).siblings("select").andSelf();
    //var id = 0;
    var id = '';
    var names = new Array();
    for (i = 0; i < selects.length; i++)
    {
        sel = selects[i];
        if (sel.value > 0)
        {
            id = sel.value;
            name = sel.options[sel.selectedIndex].text;
            names.push(name);
        }
    }
    $(".area_ids").val(id);
    $(".area_name").val(name);
    $(".area_names").val(names.join("\t"));

    // ajax请求下级地区
    if (this.value > 0)
    {
        var _self = this;
        var url = SITE_URL + '/index.php?m=com&c=common&a=ajax_shop_areas';
        $.getJSON(url, {'area_id':this.value}, function(data){
            if (data)
            {
                if (data.length > 0)
                {
                    $("<select class='.area_select'><option>请选择</option></select>").change(regionChange).insertAfter(_self);
                    var data  = data;
                    for (i = 0; i < data.length; i++)
                    {
                        $(_self).next("select").append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                    }
                }
            }
            else
            {
                alert(data.msg);
            }
        });
    }
}

function regionEdit()
{
    $(this).siblings("select").show();
    $(this).siblings("span").andSelf().hide();
}

/* 商品分类选择函数 */
function gcategoryInit(divId)
{
    $("#" + divId + " > select").get(0).onchange = gcategoryChange; // select的onchange事件
    window.onerror = function(){return true;}; //屏蔽jquery报错
    $("#" + divId + " .edit_gcategory").click(gcategoryEdit); // 编辑按钮的onclick事件
}

function gcategoryChange()
{
    // 删除后面的select
    $(this).nextAll("select").remove();

    // 计算当前选中到id和拼起来的name
    var selects = $(this).siblings("select").andSelf();
    var id = 0;
    var names = new Array();
    for (i = 0; i < selects.length; i++)
    {
        sel = selects[i];
        if (sel.value > 0)
        {
            id = sel.value;
            name = sel.options[sel.selectedIndex].text;
            names.push(name);
        }
    }
    $(".mls_id").val(id);
    $(".mls_name").val(name);
    $(".mls_names").val(names.join("\t"));

    // ajax请求下级分类
    if (this.value > 0)
    {
        var _self = this;
        var url = SITE_URL + '/index.php?act=index&op=josn_class';
        $.getJSON(url, {'gc_id':this.value}, function(data){
            if (data)
            {
                if (data.length > 0)
                {
                    $("<select><option>请选择</option></select>").change(gcategoryChange).insertAfter(_self);
                    var data  = data;
                    for (i = 0; i < data.length; i++)
                    {
                        $(_self).next("select").append("<option value='" + data[i].gc_id + "'>" + data[i].gc_name + "</option>");
                    }
                }
            }
            else
            {
                alert(data.msg);
            }
        });
    }
}

function gcategoryEdit()
{
    $(this).siblings("select").show();
    $(this).siblings("span").andSelf().remove();
}

/**初始化地区函数第一级别（省级）**/
function initProvinceSelect(select_province_id,data_id)
{
	var obj="#"+select_province_id;
	$(obj).append("<option value='0'>请选择...</option>");
	var url = SITE_URL+'/index.php?m=com&c=common&a=ajax_shop_areas';
    $.getJSON(url, {'area_id':0}, function(data){
		if (data){
			if (data.length > 0){
				var data  = data;
				for (i = 0; i < data.length; i++){
					var selected='';
					if(data[i].id==data_id)  selected='selected';
					$(obj).append("<option value='" + data[i].id + "' "+selected+" >" + data[i].name + "</option>");
				}
			}
		}
    });
}
/**初始化地区函数第一级别（省级）**/
function initCitySelect(select_city_id,province_id,data_id)
{
	var obj="#"+select_city_id;
	$(obj).find("option").remove();
	$(obj).append("<option value='0'>请选择...</option>");
	if(province_id==0) return ;
	var url = SITE_URL+'/index.php?m=com&c=common&a=ajax_shop_areas';
    $.getJSON(url, {'area_id':province_id}, function(data){
		if (data){
			if (data.length > 0){
				var data  = data;
				for (i = 0; i < data.length; i++){
					var selected='';
					if(data[i].id==data_id)  selected='selected';
					$(obj).append("<option value='" + data[i].id + "' "+selected+" >" + data[i].name + "</option>");
				}
			}
		}
    });
}
/**选择第二级别（市级）**/
function changeProvinceSelect(obj,select_city_id)
{
	var _city="#"+select_city_id;
	if($(_city).length==0) return ;
	$(_city).find("option").remove();
	$(_city).append("<option value='0'>请选择...</option>");
	if(obj.value==0) return ;
	var url = SITE_URL+'/index.php?m=com&c=common&a=ajax_shop_areas';
    $.getJSON(url, {'area_id':obj.value}, function(data){
		if (data){
			if (data.length > 0){
				var data  = data;
				for (i = 0; i < data.length; i++){
					$(_city).append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
				}
			}
		}
    });
}


function setComSelectCity(obj,objname){
	$('#'+objname+'_city').empty();
	$('#'+objname+'_area').empty();
	$('#'+objname+'_areaid').val('');
	$('#'+objname+'_city').append('<option value="" > --请选择-- </option>');
	$('#'+objname+'_area').append('<option value="" > --请选择-- </option>');
	var provice_val=$('#'+objname+'_province').val();
	if(provice_val =='' && provice_val==0){return false; }
	var url = SITE_URL+'/index.php?m=com&c=common&a=ajax_shop_areas';
	$.getJSON(url, {'area_id':obj.value}, function(data){
		if (data){
			if (data.length > 0){
				var data  = data;
				for (i = 0; i < data.length; i++){
					$('#'+objname+'_city').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
				}
			}
		}else{
			alert(data.msg);
		}
	});
}
function setComSelectArea(obj,objname){
	$('#'+objname+'_area').empty();
	$('#'+objname+'_areaid').val('');
	$('#'+objname+'_area').append('<option value="" > --请选择-- </option>');
	var city_val=$('#'+objname+'_city').val();
	if(city_val =='' && city_val==0){return false; }
	var url = SITE_URL+'/index.php?m=com&c=common&a=ajax_shop_areas';
	$.getJSON(url, {'area_id':obj.value}, function(data){
		if (data){
			if (data.length > 0){
				var data  = data;
				for (i = 0; i < data.length; i++){
					$('#'+objname+'_area').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
				}
			}
		}else{
			alert(data.msg);
		}
	});
}
function setComSelectAreaID(obj,objname){
	var txt1=$('#'+objname+'_province option:selected').text();
	var txt2=$('#'+objname+'_city option:selected').text();
	var txt3=$('#'+objname+'_area option:selected').text();
	var val3=$('#'+objname+'_area').val();
	if(val3=='' || val3==0){
		$('#'+objname+'_areaid').val('');
	}else{
		$('#'+objname+'_areaid').val(txt1+'&nbsp;'+txt2+'&nbsp;'+txt3+'|'+obj.value);
	}
}
function initComSelectAreaID(objname,areaid){
	if(areaid > 0){
		$('#select_areas_a_'+objname).show();
		$('#select_areas_div_'+objname).find('span').show();
		$('#select_areas_div_'+objname).find('select').hide();
	}else{
		$('#select_areas_a_'+objname).hide();
		$('#select_areas_div_'+objname).find('span').hide();
		$('#select_areas_div_'+objname).find('select').show();
	}
}