<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php include APPPATH . 'views/' . template('index', 'header', SITE_TEMP); ?>
<style type="text/css">
    body{ background:#fff;}
    .mask{margin:0;padding:0;border:none;width:100%;height:100%;background:url(<?php echo IMG_PATH; ?>bg.png);z-index:9999;position:fixed;top:0;left:0;display:none;}
    #LoginBox{position:absolute;left:30%;top:500px;background:white;width:520px;height:510px;   border-radius:15px;   border:5px solid #009966; z-index:10000;display:none;}
    .jdbox {position: absolute;background:#efefef;left:10px;top:30px;display:none;width: 520px;z-index:9999;height: 300px;}
    .jdbox td {text-align: left;border:1px solid #ccc;}
    .fx {margin: 0px auto;}
    .fx td {border: 1px solid #ccc;padding:3px;}
    .close_btn{font-family:arial;font-size:30px;font-weight:700;color:#999;text-decoration:none;float:right;padding-right:4px;}
</style>
<div id="LoginBox"  >
    <div class="row1" style="height:30px; line-height:30px;">
        <a href="javascript:void(0)" title="关闭窗口" class="close_btn" id="closeBtn">×</a>
    </div>
    <div class="contents"></div>
</div>
<!--login-->
<script language="javascript">
    var parttenmob = /^1[3,5,8]\d{9}$/;
    var parttentel = /^0(([1,2]\d)|([3-9]\d{2}))\d{7,8}$/;

    function checkform()
    {
        var loginname = document.getElementById("loginname").value;
        var loginpsd = document.getElementById("loginpsd").value;
        var msg = "";

        if (loginname.length == 0)
        {
            msg += '请输入手机号码!\n';
        } else if (!parttenmob.test(loginname)) {
            msg += '请输入正确的手机号码!\n';
        }

        if (loginpsd.length == 0)
        {
            msg += '请输入登录密码!\n';
        }

        if (msg.length > 0)
        {
            alert(msg);
            return false;
        }
        else
        {
            return true;
        }
    }
</script>        
<div class="login"   style="display:none" >
    <div class="login_body">

        <h3>理财师登录窗口</h3>
        <a href="index.php?c=customer&a=login" class="loginbar"></a>
        <a href="index.php?c=customer&a=register" class="regbar"></a>    
    </div>

</div>
<!--<div class="login">-->
<?php if (isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']) { ?>
    <div class="login_body">
        <h3>会员中心</h3>
        <p><b style="line-height:35px;"> 您好，<?php echo $this->session->userdata['member_truename']; ?> 欢迎登录!<br> 这里是理财师的一站式服务平台</b></p>
        <div>
            <a href="index.php?c=products&a=lists" class="proCenter" style="width:80px; float:left">产品中心</a>   
            <a href="index.php?m=member&c=user&a=index" class="proCenter" style="width:80px; margin-left:15px;float:right" title="会员中心">会员中心</a>  
            <a href="index.php?c=customer&a=logout" class="memCenter">安全退出</a>   
        </div>

    </div>
<?php } else { ?>
    <div class="login_body">
        <h5>
            <font>快速登录</font>   
            <a href="index.php?c=customer&a=register" class="login_new_reg" title="财来电注册新账户">注册新账户</a>
        </h5>
        <!--newform-->
        <form action="index.php?c=customer&a=login" method="post" onsubmit="return checkform();" >
            <input type="hidden" name="dosubmit" value="1">
            <ul>
                <li>
                    <label>手机</label>
                    <input name="loginname" type="text" id="loginname" class="linput" />
                </li>
                <li>
                    <label>密码</label>
                    <input name="loginpsd" type="password" id="loginpsd" class="linput" />
                </li>
                <b id="error"></b>
            </ul>

            <strong class="login_new_an">
                <input type="submit" name="loginbt" value="" id="loginbt" class="login_new_btn" />
            </strong>
        </form>
        <div>
            <a href="index.php?c=customer&a=forget_password" class="login_new_pass">忘记密码？</a>
        </div>   
    </div>
<?php } ?>
<!--</div>-->



<!--login end-->
<!--banner-->

<div class="flexslider" style="height:345px;">
    <ul class="slides" style="height:345px;">
        <?php $tag_cache_name = md5(implode('&', array('apid' => '1',)) . '6b4809a19371d80f04c32d49c44ff66b');
        if (!$data = tpl_cache($tag_cache_name)) {
            if (!isset($CI)) $CI = & get_instance();$CI->load->model("a_adv_model");
            if (method_exists($CI->a_adv_model, 'get_promotion_list')) {
                $data = $CI->a_adv_model->get_promotion_list(array('apid' => '1', 'limit' => '20',));
            }if (!empty($data)) {
                tpl_setcache($tag_cache_name, $data, 'a_adv', 3600);
            }
        } ?>
<?php if (is_array($data)) foreach ($data AS $value) { ?>
                <li style="background: url(<?php echo BASE_URL; ?><?php echo $value['adv_content']['adv_pic']; ?>) 50% 0 no-repeat;"  title="<?php echo $value['adv_title']; ?>"><a class="tlink" href="<?php echo $value['adv_content']['adv_pic_url']; ?>"></a></li>
    <?php } ?>
<?php if (defined('BASEPATH') && !defined('HTML')) {
    if (isset($data)) unset($data);
} ?>
    </ul>
</div>
<!--banner end-->
<!--feature-->
<div class="ys_bg">
    <div class="ys">
        <div class="ys_1">
            <h2 title="产品多-财来电">产品多&nbsp;&nbsp;&nbsp;&nbsp;尽情挑选</h2>
            <p style=" font-weight:normal;">不同收益期限，付息方式，类型，地域，<font>100</font>余款产品满足客户多样化需求</p>
        </div>
        <div class="ys_2">
            <h2 title="佣金高-财来电">佣金高&nbsp;&nbsp;&nbsp;&nbsp;欢迎比价</h2>
            <p style=" font-weight:normal;">高出市场价千<font>8</font>以上的佣金<br />
                使理财师及客户的利益最大化</p>
        </div>
        <div class="ys_3">
            <h2  title="结款快-财来电">结款快&nbsp;&nbsp;&nbsp;&nbsp;安全保障</h2>
            <p style=" font-weight:normal;">数千万资金储备，成立<font>24</font>小时内快速现结保障理财师及客户的切身利益</p>
        </div>
    </div>
</div>
<!--feature end-->

<!--#########################-->
<div id="cptab" style="margin-bottom:20px;">
    <h2 class="index_cp_title">
        <b>
            <ul>
                <li class="lixz">信托产品</li>
                <li>资管产品</li>
            </ul>
        </b>
        <a href="index.php?c=products&a=lists">更多</a>
    </h2>
    <!--信托-->
    <div class="divxz">
        <table class="index_cp_table" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <th width="23%">产品名称</th>

                <th width="6%">期限</th>
                <th width="11%">年化收益</th>
                <th width="11%">费用区间</th>
                <th width="8%">付息方式</th>
                <th width="7%">投资领域</th>
                <th width="7%">发行方案</th>
                <th width="21%">募集进度</th>
                <th width="6%">预约</th>
            </tr>
                    <?php $tag_cache_name = md5(implode('&', array('cid' => '1',)) . '689919a01c77b9736ced1033602a5bed');
                    if (!$data = tpl_cache($tag_cache_name)) {
                        if (!isset($CI)) $CI = & get_instance();$CI->load->model("a_caifu_model");
                        if (method_exists($CI->a_caifu_model, 'get_product_index')) {
                            $data = $CI->a_caifu_model->get_product_index(array('cid' => '1', 'limit' => '20',));
                        }if (!empty($data)) {
                            tpl_setcache($tag_cache_name, $data, 'a_caifu', 3600);
                        }
                    } ?>
                    <?php if (is_array($data)) foreach ($data AS $v) { ?>
                    <tr>
                        <td width="21%"><a href="index.php?c=products&a=detail&id=<?php echo $v['id']; ?>"  class="index_cp_name"><?php echo mb_substr($v['name'], 0, 15); ?></a></td>
                        <td width="6%" style="text-align:center"><span class="ft"><?php echo $v['lifetime']; ?></span>个月</td>
                        <td width="11%" style="text-align:center"  ><span><?php echo $v['yield_year']; ?></span></td>
                        <td width="11%" style="text-align:center">
                    <?php if (isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']) { ?>
                        <?php echo $v['fee_scale']; ?>
        <?php } else { ?>
                                <a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >登录可见</a>
        <?php } ?>
                        </td>
                        <td width="8%" style="text-align:center"><?php echo $v['interest_name']; ?></td>
                        <td width="7%" style="text-align:center"><?php echo $v['investment_name']; ?></td>
                        <td width="7%" style="text-align:center; border:0; border-bottom:1px solid #efefef; " >
        <?php if (isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']) { ?>
                                <a href="javascript:void(0)" class="index_cp_look jd"  style="width:60px;"  id="<?php echo $v['id']; ?>">查看</a>
        <?php } else { ?>
                                <a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >查看</a>
        <?php } ?>
                        </td>
                        <td width="21%"><p><?php echo mb_substr($v['progress'], 0, 70); ?></p></td>
                        <td width="6%"><a href="index.php?c=products&a=detail&id=<?php echo $v['id']; ?>" class="index_cp_yue" title="预约"></a></td>
                    </tr>
    <?php } ?>
<?php if (defined('BASEPATH') && !defined('HTML')) {
    if (isset($data)) unset($data);
} ?>
        </table>


    </div>
    <!--资管-->
    <div class="div">
        <table class="index_cp_table" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <th width="23%">产品名称</th>

                <th width="6%">期限</th>
                <th width="11%">年化收益</th>
                <th width="11%">费用区间</th>
                <th width="8%">付息方式</th>
                <th width="7%">投资领域</th>
                <th width="7%">发行方案</th>
                <th width="21%">募集进度</th>
                <th width="6%">预约</th>
            </tr>
                    <?php $tag_cache_name = md5(implode('&', array('cid' => '2',)) . '759789c58d0e1ba15be832be0961c32e');
                    if (!$data = tpl_cache($tag_cache_name)) {
                        if (!isset($CI)) $CI = & get_instance();$CI->load->model("a_caifu_model");
                        if (method_exists($CI->a_caifu_model, 'get_product_index')) {
                            $data = $CI->a_caifu_model->get_product_index(array('cid' => '2', 'limit' => '20',));
                        }if (!empty($data)) {
                            tpl_setcache($tag_cache_name, $data, 'a_caifu', 3600);
                        }
                    } ?>
<?php if (is_array($data)) foreach ($data AS $v) { ?>
                    <tr>
                        <td width="21%"><a href="index.php?c=products&a=detail&id=<?php echo $v['id']; ?>"  class="index_cp_name"><?php echo mb_substr($v['name'], 0, 15); ?></a></td>
                        <td width="6%" style="text-align:center"><span class="ft"><?php echo $v['lifetime']; ?></span>个月</td>
                        <td width="11%" style="text-align:center"  ><span><?php echo $v['yield_year']; ?></span></td>
                        <td width="11%" style="text-align:center">
        <?php if (isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']) { ?>
            <?php echo $v['fee_scale']; ?>
        <?php } else { ?>
                                <a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >登录可见</a>
        <?php } ?>
                        </td>
                        <td width="8%" style="text-align:center"><?php echo $v['interest_name']; ?></td>
                        <td width="7%" style="text-align:center"><?php echo $v['investment_name']; ?></td>
                        <td width="7%" style="text-align:center; border:0; border-bottom:1px solid #efefef; " >
        <?php if (isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']) { ?>
                                <a href="javascript:void(0)" class="index_cp_look jd"  style="width:60px;"  id="<?php echo $v['id']; ?>">查看</a>
        <?php } else { ?>
                                <a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >查看</a>
        <?php } ?>
                        </td>
                        <td width="21%"><p><?php echo mb_substr($v['progress'], 0, 70); ?></p></td>
                        <td width="6%"><a href="index.php?c=products&a=detail&id=<?php echo $v['id']; ?>" class="index_cp_yue" title="预约"></a></td>
                    </tr>
    <?php } ?>
<?php if (defined('BASEPATH') && !defined('HTML')) {
    if (isset($data)) unset($data);
} ?>
        </table>

    </div>
</div>
<script type="text/javascript">
    function chageSelect(nIndex) {
        var oLis = document.getElementById("cptab").getElementsByTagName("li");
        var oDivs = document.getElementById("cptab").getElementsByTagName("div");
        for (var i = 0; i < oLis.length; i++) {
            oLis.item(i).className = null;
            oDivs.item(i).className = null;
        }
        oLis.item(nIndex).className = "lixz";
        oDivs.item(nIndex).className = "divxz";
    }

    var oLis = document.getElementById("cptab").getElementsByTagName("li");
    oLis.item(0).onclick = function() {
        chageSelect(0);
    }
    oLis.item(1).onclick = function() {
        chageSelect(1);
    }
</script>


<!--#########################-->
<div class="index_main">
    <div class="index_news">
        <h2>
            <b>信托快报</b>
            <a href="index.php?c=news&a=lists&cid=1" title="信托快报-财来电">更多</a>
        </h2>
        <ul>
<?php $tag_cache_name = md5(implode('&', array('cid' => '1',)) . '7ecccbd43374150aa619886d3166ef04');
if (!$data = tpl_cache($tag_cache_name)) {
    if (!isset($CI)) $CI = & get_instance();$CI->load->model("a_article_model");
    if (method_exists($CI->a_article_model, 'get_article_list')) {
        $data = $CI->a_article_model->get_article_list(array('cid' => '1', 'limit' => '20',));
    }if (!empty($data)) {
        tpl_setcache($tag_cache_name, $data, 'a_article', 3600);
    }
} ?>
<?php if (is_array($data)) foreach ($data AS $v) { ?>
                    <li>
                        <a href="<?php if (!empty($v['article_url'])) { ?><?php echo $v['article_url']; ?><?php } else { ?>index.php?c=news&a=detail&id=<?php echo $v['article_id']; ?><?php } ?>"><?php echo mb_substr($v['article_title'], 0, 30); ?></a>
                        <span style=" font-weight:normal;"><?php echo date('Y/m/d', $v['article_time']); ?></span>
                    </li>
    <?php } ?>
<?php if (defined('BASEPATH') && !defined('HTML')) {
    if (isset($data)) unset($data);
} ?>      
        </ul>
    </div>
    <div class="index_news index_help">
        <h2>
            <b>新手帮助</b>
            <a href="index.php?c=news&a=lists&cid=2" title="信托快报-财来电">更多</a>
        </h2>
        <ul>
<?php $tag_cache_name = md5(implode('&', array('cid' => '2',)) . '7c30cffdf324ef9ff08c35d638bdfd6f');
if (!$data = tpl_cache($tag_cache_name)) {
    if (!isset($CI)) $CI = & get_instance();$CI->load->model("a_article_model");
    if (method_exists($CI->a_article_model, 'get_article_list')) {
        $data = $CI->a_article_model->get_article_list(array('cid' => '2', 'limit' => '20',));
    }if (!empty($data)) {
        tpl_setcache($tag_cache_name, $data, 'a_article', 3600);
    }
} ?>
<?php if (is_array($data)) foreach ($data AS $v) { ?>
                    <li>
                        <a href="<?php if (!empty($v['article_url'])) { ?><?php echo $v['article_url']; ?><?php } else { ?>index.php?c=news&a=detail&id=<?php echo $v['article_id']; ?><?php } ?>"><?php echo mb_substr($v['article_title'], 0, 30); ?></a>
                        <span style=" font-weight:normal;"><?php echo date('Y/m/d', $v['article_time']); ?></span>
                    </li>
    <?php } ?>
<?php if (defined('BASEPATH') && !defined('HTML')) {
    if (isset($data)) unset($data);
} ?>

        </ul>
    </div>
</div>
<div class="indext-hezuo" style="width:1000px; height:auto; overflow:hidden; padding-top:20px; margin:0 auto;">
        <h2 style="height:40px; background:url(./statics/default/images/index_news_line.jpg) no-repeat left bottom; margin-bottom:10px;">
			<b style="display:block; float:left; width:78px; height:40px; font-family:'微软雅黑'; font-size:16px; text-align:center; line-height:40px; color:#019966;">合作伙伴</b>
            <a class="fr mr22" href="index.php?c=news&a=lists&cid=1" style="display:block; float:right; width:40px; height:40px; background:url(./statics/default/images/index_news_more.jpg) no-repeat center left; color:#969696; line-height:40px; font-weight:normal; font-size:12px; text-align:right; font-weight:normal; -webkit-text-size-adjust:none;">
            更多</a>    
        </h2>
        <ul class="clearfix">
			<?php
				$data = $this->db->get('link')->result_array();
				foreach($data as $v):?>
            <li class="indext-hz-li">
            <a target="_blank" title="" href="<?php echo $v['link_url']?>" style="display:block; float:left; width:260px; height:40px; font-size:13px; color:#5b6763; line-height:40px; margin-left:12px; font-weight:normal; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;" onmouseover="this.style.cssText='display:block; float:left; width:260px; height:40px; font-size:13px; line-height:40px; margin-left:12px; font-weight:normal; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;color:#f47d53; text-decoration:underline;'" onmouseout="this.style.cssText='display:block; float:left; width:260px; height:40px; font-size:13px; color:#5b6763; line-height:40px; margin-left:12px; font-weight:normal; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;'">
                <?php echo $v['link_title']?>
            </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>

<!--footer-->
<?php include APPPATH . 'views/' . template('index', 'footer', SITE_TEMP); ?>




