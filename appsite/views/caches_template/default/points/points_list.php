<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php include APPPATH.'views/'.template('index','header',SITE_TEMP ); ?>

<!--header end-->
<!--banner-->
<div class="banner_about">
</div>
<!--banner end-->
<!--云系统-->
 
    
    <div class="subpage">
    <div class=".html">
        <h2 class=".html_title"><b style="float:left">积分商城</b><b style="float:right; border:0;font-size:15px; color:#dc2018; font-weight:100">说明：每打款100万元，系统审核通过后可获取100积分，积分不过期，可累加，上不封顶</b></h2>
        <div class=".html_body">
            <!--积分商城块-->
            <div class="jf_mall">
								<?php if(is_array($list)) foreach($list AS $v) { ?>
                <!--条目-->
                <div class="jf_list">
                    <table class="jf_tb" cellpadding="0" cellspacing="0" style="height:255px;">
                        <tr>
                            <td><a href="index.php?c=points&a=detail&id=<?php echo $v['id'];?>"  class="jf_tb_btn"><img src="<?php if(!empty($v['points_image'])) { ?><?php echo $v['points_image'];?><?php } else { ?><?php echo IMG_PATH;?>nopic.jpg<?php } ?>"  /></a></td>
                        </tr>
                    </table>
                    <a href="#" class="jf_text_name"><?php echo mb_substr($v['name'],0,16);?></a>
                    <font>市场参考价格：<?php echo $v['market_price'];?>元</font>
                    <div>
                        <span><strong><?php echo $v['points'];?></strong>积分</span>
                        <a href="index.php?c=points&a=detail&id=<?php echo $v['id'];?>" class="jf_text_jf">立即兑换</a>
                    </div>
                </div>
                <!--条目结束-->
                <?php } ?>

            </div>
            <!--积分商城结束-->
           
        </div>
    </div>
</div>        




    <!--云系统结束-->
<!--footer-->
<?php include APPPATH.'views/'.template('index','footer',SITE_TEMP ); ?>