///* 替换参数 */
function replaceParam(key, value, arg)
{
	if(!arguments[2]) arg = 'string';
    var params = location.search.substr(1).split('&');

    var found  = false;
    for (var i = 0; i < params.length; i++)
    {
        param = params[i];
        arr   = param.split('=');
        pKey  = arr[0];
        // 如果存在分页，跳转到第一页
        if (pKey == 'curpage')
        {
            params[i] = 'curpage=1';
        }
        if(arg == 'string'){
	        if (pKey == key)
	        {
	            params[i] = key + '=' + value;
	            found = true;
	        }
        }else{
        	for(var j = 0; j < key.length; j++){
        		if(pKey ==  key[j]){
        			params[i] = key[j] + '=' + value[j];
    	            found = true;
        		}
        	}
        }
    }
    if (!found)
    {
        if (arg == 'string'){
            value = transform_char(value);
            params.push(key + '=' + value);
        }else{
        	for(var j = 0; j < key.length; j++){
        		params.push(key[j] + '=' + transform_char(value[j]));
        	}
        }
    }
    location.assign('index.php?' + params.join('&'));
}
function transform_char(str)
{
    if(str.indexOf('&'))
    {
        str = str.replace(/&/g, "%26");
    }
    return str;
}

function search_title(){
	var s_title = $("#search_title").val();
	replaceParam('search_title', s_title);
}