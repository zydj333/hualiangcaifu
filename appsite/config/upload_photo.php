<?php
$config['dir']='uploadfile';
$config['thumb']=array(
	'is_on'=>true,
	'width'=>200,
	'height'=>200,
	'thumb_marker'=>'_thumb',
);
$config['thumbx']=array(
	'width'=>400,
	'height'=>400,
	'thumb_marker'=>'_thumbx',
);

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
		'sign'=>'shop_goods',//店铺商品
		'allows_size'=>'2048',//单位KB，上传允许2M：2097152;1M：1048576;
	),
	2=>array(
		'sign'=>'shop_acticle',//店铺文章图片
		'allows_size'=>'2048',//上传允许2M
	),
	3=>array(
		'sign'=>'shop_other',//店铺其他图片
		'allows_size'=>'2048',//上传允许2M
	),
);

?>