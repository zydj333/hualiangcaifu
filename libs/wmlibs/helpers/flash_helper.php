<?php

if ( ! function_exists('setcache_flash'))
{
		/**
	 * @webid 站点
	 * @return bool
	 * @tid 摊位符号
	 */
	function setcache_flash($webid, $tid)
	{

		if(!isset($CI)){$CI =& get_instance();}

		$CI->load->helper('global');
        $CI->load->model('user');
        $CI->load->model('market_booth');
        $CI->load->model('goods');
        $CI->load->model('shop');
        $CI->load->model('market_regional');

		$baseURL = base_url();

		//获取用户id关联摊位
        if(empty($tid)){return 0;}

        $booth_info=$CI->market_booth->get_one(array('id'=>$tid,'sts'=>0,'webid'=>$webid),'market_booth');

		if(empty($booth_info)){return 0;}
		$userid=$booth_info['userid'];

		$shop_info = $CI->shop->get_one(array('shop_id'=>$userid));
		$shop_name=substr($shop_info['shop_name'],0,44);
	    $shop_id=$shop_info['shop_id'];


		//组装缓存数组 bcache
		$bcache['id']=$tid;
		$bcache['siteid']=$booth_info['siteid'];
		$bcache['number']=$booth_info['boothnum'];
		$bcache['userid']=$booth_info['userid'];
		$bcache['username']=$booth_info['username'];
		$bcache['name']=$shop_name;
		$bcache['detailPage']='index.php?c=shop&shop_id='.$shop_id;

		//$bcache['detailPage']=$shopdata['shop_domain'];//2级域名
		//$bcache['uin']=$memberinfo['uin'];//用户IM后期扩展

		//读取店铺产品
		$bcache['products']['detailPage']='index.php?c=shop&a=goods_list&shop_id='.$userid;

		/****获取产品列表：首先取推荐并且带图片的商品，推荐没有到达六张，取最近发布的商品****/
		$where_1='shop_id ='.$userid.' and goods_commend = 1 ';
		$where_2='and goods_show = 1 and goods_starttime <= '.time() .' and goods_endtime >= '.time() .' and sts = 0 and goods_state = 0 and length(goods_image) > 2 order by goods_id desc limit 6';
		$pro_commend_list=$CI->goods->get_query($where_1.$where_2,'goods');

		$pro_commend_count=count($pro_commend_list);
		$product_arr=array();

		foreach($pro_commend_list as $k=> $v){
			$imgurl=empty($v['goods_image'])?"":$v['goods_image'];
			$imgurl=remain_image_path($imgurl,'s');//获取缩略图路径
			$url='index.php?c=shop&a=goods&goods_id='.$v['goods_id'].'&shop_id='.$shop_info['shop_id'];
			$product_arr[$k]=array('url'=>$url,'image'=>$imgurl,'ishttp'=>1);
			//$keyword.=$pro_info['keywords'].',';
		}
		//小于6商机推荐的商品没有达到6个，取最近发布的商品
		if($pro_commend_count < 6 ){
			$where_3='shop_id ='.$userid.' and goods_commend = 0 ';
			$pro_news_list=$CI->goods->get_query($where_3.$where_2,'goods');
			$i= $pro_commend_count;
			foreach($pro_news_list as $v){
				if($i < 6){
					$imgurl=empty($v['goods_image'])?"":$v['goods_image'];
					$imgurl=remain_image_path($imgurl,'s');//获取缩略图路径
					$url='index.php?c=shop&a=goods&goods_id='.$v['goods_id'].'&shop_id='.$shop_info['shop_id'];
					$product_arr[$i]=array('url'=>$url,'image'=>$imgurl,'ishttp'=>1);
				}
				$i++;
			}
		}
		$bcache['products']['product']=$product_arr;

		$return = setcache('booth_'.$webid.'_'.$tid,$bcache,'booth','file','0','array');
		if($return){
		   	 return '1';
		}else{
		   	 return '0';
		}

	}
}