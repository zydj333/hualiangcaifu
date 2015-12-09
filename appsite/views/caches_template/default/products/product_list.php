<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php include APPPATH . 'views/' . template('index', 'header', SITE_TEMP); ?>
<script src="<?php echo JS_PATH; ?>multichoose.js" type="text/javascript"></script>
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
<!--header end-->
<!--banner-->
<div class="banner_about" style="display:none">
</div>
<!--banner end-->
<!--云系统-->
<div class="subpage">
    <div class="content">
        <h2 class="content_title"><b>产品中心</b></h2>
        <!--搜索-->
        <div class="cp_center_ss">
            <span>产品关键字：</span>
            <input type="text" value="" placeholder="请输入产品关键字" id="search_title"  class="cp_center_ss_text" />
            <input type="button" value="" class="cp_center_ss_btn" id="search" onclick="javascript:search_title();"/>
            <a href="index.php?c=products&a=lists&cpxl=<?php echo $sel['cpxl']; ?>" class="cp_center_ss_all"></a>
        </div>
        <div class="content_body">
            <!--产品索引-->
            <div class="cp_center_top">
                <div>
                    <h4>产品状态：</h4>
                    <a class="cp_center_top_btn"  href="javascript:void(0);" onclick="javascript:replaceParam('cpzt', '0');" <?php if ($sel['cpzt'] == 0) { ?>id='cp_center_select'<?php } ?>>全部</a>    
                    <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('cpzt', '1');" <?php if ($sel['cpzt'] == 1) { ?>id='cp_center_select'<?php } ?>>在售</a>
                    <a class="cp_center_top_btn"  href="javascript:void(0);" onclick="javascript:replaceParam('cpzt', '2');" <?php if ($sel['cpzt'] == 2) { ?>id='cp_center_select'<?php } ?>>预热</a>
                </div>
                <span style=""></span>
                <div>
                    <h4>产品系列：</h4>
                    <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('cpxl', '0');" <?php if ($sel['cpxl'] == 0) { ?>id='cp_center_select'<?php } ?>>全部</a>
                    <?php if (is_array($sel_category)) foreach ($sel_category AS $v) { ?>
                            <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('cpxl', '<?php echo $v['column_value']; ?>');" <?php if ($sel['cpxl'] == $v['column_value']) { ?>id='cp_center_select'<?php } ?>><?php echo $v['column_title']; ?></a> 
                        <?php } ?>
                </div>
                <span></span>
                <div>
                    <h4>产品期限：</h4>
                    <a class="cp_center_top_btn" href="javascript:void(0);"  onclick="javascript:replaceParam('cpqx', '0');" <?php if ($sel['cpqx'] == 0) { ?>id='cp_center_select'<?php } ?>>全部</a>
                    <?php if (is_array($sel_lifetime)) foreach ($sel_lifetime AS $v) { ?>
                            <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('cpqx', '<?php echo $v['column_value']; ?>');" <?php if ($sel['cpqx'] == $v['column_value']) { ?>id='cp_center_select'<?php } ?>><?php echo $v['column_title']; ?></a> 
                        <?php } ?>
                </div>
                <span></span>
                <div>
                    <h4>发行费用：</h4>
                    <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('fxfy', '0');" <?php if ($sel['fxfy'] == 0) { ?>id='cp_center_select'<?php } ?>>全部</a>
                    <?php if (is_array($sel_expenses_area)) foreach ($sel_expenses_area AS $v) { ?>
                            <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('fxfy', '<?php echo $v['column_value']; ?>');" <?php if ($sel['fxfy'] == $v['column_value']) { ?>id='cp_center_select'<?php } ?>><?php echo $v['column_title']; ?></a> 
                        <?php } ?>
                </div>
                <span></span>    
                <div>
                    <h4>收益率：</h4>
                    <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('syl', '0');" <?php if ($sel['syl'] == 0) { ?>id='cp_center_select'<?php } ?>>全部</a> 
                    <?php if (is_array($sel_yield)) foreach ($sel_yield AS $v) { ?>
                            <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('syl', '<?php echo $v['column_value']; ?>');" <?php if ($sel['syl'] == $v['column_value']) { ?>id='cp_center_select'<?php } ?>><?php echo $v['column_title']; ?></a> 
                        <?php } ?>
                </div>
                <span></span>    
                <div>
                    <h4>付息方式：</h4>
                    <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('fxfs', '0');" <?php if ($sel['fxfs'] == 0) { ?>id='cp_center_select'<?php } ?>>全部</a>
                    <?php if (is_array($sel_interest)) foreach ($sel_interest AS $v) { ?>
                            <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('fxfs', '<?php echo $v['column_value']; ?>');" <?php if ($sel['fxfs'] == $v['column_value']) { ?>id='cp_center_select'<?php } ?>><?php echo $v['column_title']; ?></a> 
                        <?php } ?>
                </div>
                <span></span>
                <div>
                    <h4>投资领域：</h4>
                    <a class="cp_center_top_btn"  href="javascript:void(0);" onclick="javascript:replaceParam('tzly', '0');" <?php if ($sel['tzly'] == 0) { ?>id='cp_center_select'<?php } ?>>全部</a>
                    <?php if (is_array($sel_investment)) foreach ($sel_investment AS $v) { ?>
                            <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('tzly', '<?php echo $v['column_value']; ?>');" <?php if ($sel['tzly'] == $v['column_value']) { ?>id='cp_center_select'<?php } ?>><?php echo $v['column_title']; ?></a> 
                        <?php } ?>
                </div>
                <span></span>    
                <div>
                    <h4>所在区域：</h4>
                    <a  class="cp_center_top_btn"  href="javascript:void(0);" onclick="javascript:replaceParam('szqy', '0');" <?php if ($sel['szqy'] == 0) { ?>id='cp_center_select'<?php } ?>>全部</a>
                    <?php if (is_array($sel_area)) foreach ($sel_area AS $v) { ?>
                            <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('szqy', '<?php echo $v['column_value']; ?>');" <?php if ($sel['szqy'] == $v['column_value']) { ?>id='cp_center_select'<?php } ?>><?php echo $v['column_title']; ?></a> 
                        <?php } ?>
                </div>
                <span></span>    
                <div>
                    <h4>大小配比：</h4>
                    <a class="cp_center_top_btn"  href="javascript:void(0);" onclick="javascript:replaceParam('dxpb', '0');" <?php if ($sel['dxpb'] == 0) { ?>id='cp_center_select'<?php } ?>>全部</a>
                    <?php if (is_array($sel_size)) foreach ($sel_size AS $v) { ?>
                            <a class="cp_center_top_btn" href="javascript:void(0);" onclick="javascript:replaceParam('dxpb', '<?php echo $v['column_value']; ?>');" <?php if ($sel['dxpb'] == $v['column_value']) { ?>id='cp_center_select'<?php } ?>><?php echo $v['column_title']; ?></a> 
                        <?php } ?>
                </div>
                <span></span>
            </div> 
            <!--产品表格-->
            <table width="100%" class="cp_center_table tab" cellpadding="0" cellspacing="0"   >
                <tr>
                    <th width="18%">产品名称</th>
                    <th width="6%">期限</th>
                    <th width="8%">年化收益</th>
                    <th width="8%">费用区间</th>
                    <th width="7%">付息方式</th>
                    <th width="7%">投资领域</th>
                    <th width="6%">发行方案</th>
                    <th width="10%"  >进度</th>
                    <th width="19%">募集进度</th>
                    <th width="5%">预约</th>
                </tr>
                <?php if (is_array($list)) foreach ($list AS $v) { ?>
                        <tr>
                            <td width="18%">
                                <a href="index.php?c=products&a=detail&id=<?php echo $v['id']; ?>"  class="cp_center_table_name"><?php echo mb_substr($v['name'], 0, 15); ?></a>
                            </td>
                            <td width="6%">
                                <span class="cp_center_table_text"><font class="ft"><?php echo $v['lifetime']; ?></font>个月</span>
                            </td>
                            <td width="8%">
                                <span class="cp_center_table_text"><font class="ft"><?php echo $v['yield_year']; ?></font></span>
                            </td>
                            <td width="8%">
                                <span class="cp_center_table_text">
                                    <?php if (isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']) { ?>
                                        <?php echo $v['fee_scale']; ?>
                                    <?php } else { ?>
                                        <a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >登录可见</a>
                                    <?php } ?>
                                </span>
                            </td>
                            <td width="7%">
                                <span class="cp_center_table_text"><?php echo $v['interest_name']; ?></span>
                            </td>
                            <td width="7%">
                                <span class="cp_center_table_text"><?php echo $v['investment_name']; ?></span>
                            </td>
                            <td width="6%" style="text-align:center;">
                                <?php if (isset($this->session->userdata['member_user_id']) && $this->session->userdata['member_user_id']) { ?>
                                    <a href="javascript:void(0)" class="index_cp_look jd"  style="width:60px;"  id="<?php echo $v['id']; ?>">查看</a>
                                <?php } else { ?>
                                    <a href="index.php?c=customer&a=login" class="index_cp_look" style="width:60px;"  >查看</a>
                                <?php } ?>
                            </td>
                            <td width="10%" style="text-align:center;">
                                <div class="load_lists"><i style="width: <?php echo $v['progress_percent']; ?>%"></i></div><?php echo $v['progress_percent']; ?>%
                            </td>
                            <td width="19%">
                                <div><?php echo mb_substr($v['progress'], 0, 70); ?></div>
                            </td>
                            <td width="5%" style="text-align:center"><a  href="index.php?c=products&a=detail&id=<?php echo $v['id']; ?>" class="cp_center_table_yue" title="预约"></a></td>
                        </tr>
                    <?php } ?>
            </table>

            <div style="height:30px; line-height:30px; margin-top:10px; float:left; width:850px;">
                <div id="err"></div>

                <!-- AspNetPager 7.4.5 Copyright:2003-2013 Webdiyer (www.webdiyer.com) -->
                <div id="AspNetPager1" class="page">
                    <?php echo $page; ?>
                    <!--
                    <div class="page" style="width:60%;float:left;">
                            <a disabled="disabled" style="margin-right:5px;">首页</a><a disabled="disabled" style="margin-right:5px;">上一页</a><span style="margin-right:5px;font-weight:Bold;color:red;">1</span><a href="product.aspx?page=2" style="margin-right:5px;">2</a><a href="product.aspx?page=3" style="margin-right:5px;">3</a><a href="product.aspx?page=4" style="margin-right:5px;">4</a><a href="product.aspx?page=5" style="margin-right:5px;">5</a><a href="product.aspx?page=6" style="margin-right:5px;">6</a><a href="product.aspx?page=2" style="margin-right:5px;">下一页</a><a href="product.aspx?page=6" style="margin-right:5px;">尾页</a>
                    </div>
                    <div class="page" style="width:40%;float:left;">
                            当前第 1 页, 共 6页,共找到 <b style="color:red">116</b> 条产品
                    </div>-->
                </div>
                <!-- AspNetPager 7.4.5 Copyright:2003-2013 Webdiyer (www.webdiyer.com) -->



            </div>

        </div> 
    </div>
</div>
<!--云系统结束-->
<!--footer-->

<?php include APPPATH . 'views/' . template('index', 'footer', SITE_TEMP); ?>