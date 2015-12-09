<?php
return array (
  'system_dir' => 'uploadfile',/*****/
  'system_goods_image_dir' => '{shop_id}/{y}/{m}',
  'w' =>
  array (
    'width' => 60,
    'height' => 60,
    'thumb_marker' => '_w',
    'quality' => 90,
  ),
  's' =>
  array (
    'width' => 160,
    'height' => 160,
    'thumb_marker' => '_s',
    'quality' => 90,
  ),
  'm' =>
  array (
    'width' => 300,
    'height' => 300,
    'thumb_marker' => '_m',
    'quality' => 90,
  ),
  'b' =>
  array (
    'thumb_marker' => '_b',
    'quality' => 90,
  ),
  'system_allows_types' => 'gif|jpg|jpeg|png|zip|rar',
  'system_allows_size' => '1024',
  'module' =>
  array (
    'default' =>
    array (
      'sign' => 'default',
      'allows_size' => '1024',
      'allows_type' => 'jpg|jpeg|png|gif|zip|rar',
      'allows_dir' => 'uploadfile',
      'allows_rel' => '1',
      'allows_thumb' => 'w',
    ),
    'shop_goods' =>
    array (
      'sign' => 'shop_goods',
      'allows_type' => 'jpg|jpeg|png|gif|zip|rar',
      'allows_dir' => 'uploadfile/shops',
      'allows_rel' => 'N',
      'allows_thumb' => 'w|s|m|b',
    ),
    'shop_logo' =>
    array (
      'sign' => 'shop_logo',
      'allows_type' => 'jpg|jpeg|png|gif|zip|rar',
      'allows_dir' => 'uploadfile/logo',
      'allows_rel' => 'N',
      'allows_thumb' => 's',
    ),
    'goods_col_img' =>
    array (
      'sign' => 'goods_col_img',
      'allows_type' => 'jpg|jpeg|png|gif|zip|rar',
      'allows_dir' => 'uploadfile',
      'allows_rel' => 'N',
      'allows_thumb' => 'w|s|m|b',
    ),
    'bank_logo'=>
    array (
      'sign' => 'bank_logo',
      'allows_type' => 'jpg|jpeg|png|gif|zip|rar',
      'allows_dir' => 'uploadfile/bank',
      'allows_rel' => 'N',
      'allows_thumb' => 'w',
    ),
    'theme'=>
    array (
      'sign' => 'theme',
      'allows_type' => 'jpg|jpeg|png|gif|zip|rar',
      'allows_dir' => 'uploadfile/theme',
      'allows_rel' => 'N',
      'allows_thumb' => '',
    ),
  ),
);
?>