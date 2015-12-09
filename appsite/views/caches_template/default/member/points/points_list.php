<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php include APPPATH.'views/'.template('index','header',SITE_TEMP ); ?> 

<link href="<?php echo CSS_PATH;?>css.css" rel="stylesheet" type="text/css" /> 
<div class="user_620">
    <!--lt-->
    <div class="user_lt">
        <div class="user_lt_top">
             <a href="index.php?m=member&c=user&a=udefault"    target="main" class="list">
             <?php if($this->session->userdata['member_headico']) { ?>
             	<img src="/<?php echo $this->session->userdata['member_headico']; ?>"  style="width:150px; height:150px;" />
             	<?php } else { ?>
             	<img src="<?php echo IMG_PATH;?>head.jpg"  style="width:150px; height:150px;" />
             	<?php } ?>
             </a>
             <h4><?php echo $this->session->userdata['member_truename']; ?></h4>
             <h4><?php echo $this->session->userdata['member_username']; ?></h4>
        </div>
        <?php include APPPATH.'views/'.template('index','user_left',SITE_TEMP ); ?>
    </div>
    <!--rt-->
    <div class="user_rt">
        <!--border layout-->
        <div class="user_rt_layout">
            <h3>
                <img src="<?php echo IMG_PATH;?>user_lcs_pic03.png"  />
                <strong>积分兑换订单</strong>
            </h3>
            <table  cellpadding="0" cellspacing="0" class="user_rt_table_01">
                <tr>
                    <th width="10%">订单号</th>
                    <th width="10%">姓名</th>
                    <th width="10%">手机号码</th>
                    <th width="15%">产品名称</th>
                    <th width="15%">地址</th>
                    <th width="15%">备注</th>
                    <th width="10%">时间</th>
                    <th width="12%">状态</th>
                </tr>
								<?php if(is_array($list)) foreach($list AS $v) { ?>
								<tr>
									<td><?php echo $v['order_sn'];?></td>	
									<td><?php echo $v['name'];?></td>
									<td><?php echo $v['phone'];?></td>	
									<td><?php echo $v['product_name'];?></td>
									<td><?php echo $v['address'];?></td>	
									<td><?php echo $v['remark'];?></td>
									<td><?php echo date('Y-m-d', $v['post_time']);?></td>	
									<td><?php echo $v['order_state_name'];?></td>
								</tr>
								<?php } ?>
                
          </table>

        </div>
        
    </div>
    
    
</div>
 
   
<!--云系统结束-->
<?php include APPPATH.'views/'.template('index','footer',SITE_TEMP ); ?>