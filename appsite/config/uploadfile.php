<?php
$config['dir']='uploadfile';
/***
 * {shop_id}/{y}/{m}/{d}	: 店铺ID/年/月/日
 */
$config['shop_goods_image_dir']='{shop_id}/{y}/{m}/{d}';
$config['w']=array(
	'width'=>60,
	'height'=>60,
	'thumb_marker'=>'_w',
	'quality'=>90
);

$config['s']=array(
	'width'=>160,
	'height'=>160,
	'thumb_marker'=>'_s',
	'quality'=>90
);
$config['m']=array(
	'width'=>300,
	'height'=>300,
	'thumb_marker'=>'_m',
	'quality'=>90
);
$config['b']=array(
	'thumb_marker'=>'_b',
	'quality'=>90
);

/*********
 * 	系统全局上传格式以module里面个性化的优先
 * 	default标识表示公共 没有找到表示默认是default
 *
 ********/
$config['system_allows_types']='gif|jpg|jpeg|png';// 系统全局上传图片格式
$config['system_allows_size']='1024';// 系统全局上传文件大小为1024KB,为1M
$config['module']=array(
	'default'=>array(
		'sign'=>'default',
		'allows_type'=>'jpg|jpeg|png|gif',
		'allows_dir'=>'uploadfile',
		'allows_rel'=>'1',//上传模式1表示1:1关系,只被某一地方使用;N表示1:N关系,文件被多个地方使用
		'allows_thumb'=>'w',
	),
	'shop_goods'=>array(
		'sign'=>'shop_goods',
		'allows_type'=>'jpg|jpeg|png|gif',
		'allows_dir'=>'uploadfile/shops',
		'allows_rel'=>'N',
		'allows_thumb'=>'w|s|m|b',//生成缩略图：微、小、中、大,注意width和height、allows_thumb只能出现一组，优先级别allows_thumb高
	),
	'shop_logo'=>array(
		'sign'=>'shop_goods',
		'allows_type'=>'jpg|jpeg|png|gif',
		'allows_dir'=>'uploadfile/logo',
		'allows_rel'=>'N',
		'width'=>100,
		'height'=>100,
	),
);

/*********
 * 用户允许上传图片配置
 * 路径说明：
 * goods:		 uploadfile/shops/{{shop_id/5000}}/{{shop_id}}/goods_{{time()/10}}
 * acticle:		 uploadfile/shops/{{shop_id/5000}}/{{shop_id}}/acticle
 * other:		 uploadfile/shops/{{shop_id/5000}}/{{shop_id}}/other
 *********/
$config['allows_types']='gif|jpg|jpeg|png';// 图片类型，上传图片时使用
$config['belong']=array(
	0=>array(		//默认值
		'sign'=>'shop_default',//店铺默认上传图片大小为1M
		'allows_size'=>'1024',
	),
	1=>array(
		'sign'=>'shop_goods_switch',//店铺商品
		'allows_size'=>'1024',//单位KB，上传允许2M：2097152;1M：1048576;
	),
	2=>array(
		'sign'=>'shop_goods_editor',//店铺商品
		'allows_size'=>'1024',//单位KB，上传允许2M：2097152;1M：1048576;
	),
	3=>array(
		'sign'=>'shop_acticle',//店铺文章图片
		'allows_size'=>'2048',//上传允许2M
	),
	4=>array(
		'sign'=>'shop_other',//店铺其他图片
		'allows_size'=>'2048',//上传允许2M
	),
);

?>