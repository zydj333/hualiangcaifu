<!--{template 'index','header',SITE_TEMP }-->

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
								<!--{foreach $list $v}-->
                <!--条目-->
                <div class="jf_list">
                    <table class="jf_tb" cellpadding="0" cellspacing="0" style="height:255px;">
                        <tr>
                            <td><a href="index.php?c=points&a=detail&id=<!--{$v['id']}-->"  class="jf_tb_btn"><img src="<!--{if !empty($v['points_image'])}--><!--{$v['points_image']}--><!--{else}--><!--{IMG_PATH}-->nopic.jpg<!--{/if}-->"  /></a></td>
                        </tr>
                    </table>
                    <a href="#" class="jf_text_name"><!--{mb_substr($v['name'],0,16)}--></a>
                    <font>市场参考价格：<!--{$v['market_price']}-->元</font>
                    <div>
                        <span><strong><!--{$v['points']}--></strong>积分</span>
                        <a href="index.php?c=points&a=detail&id=<!--{$v['id']}-->" class="jf_text_jf">立即兑换</a>
                    </div>
                </div>
                <!--条目结束-->
                <!--{/foreach}-->

            </div>
            <!--积分商城结束-->
           
        </div>
    </div>
</div>        




    <!--云系统结束-->
<!--footer-->
<!--{template 'index','footer',SITE_TEMP }-->