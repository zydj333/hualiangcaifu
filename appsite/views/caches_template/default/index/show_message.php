<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php include APPPATH.'views/'.template('index','header',SITE_TEMP ); ?>
<script type="text/javascript">
	<?php if(!empty($returnjs)) { ?>
		<?php echo $returnjs;?>
	<?php } else { ?>
		window.setTimeout("javascript:window.top.location.href='<?php if(!empty($url_forward)) { ?><?php echo $url_forward;?><?php } else { ?>/<?php } ?>'", <?php if(!empty($ms)) { ?><?php echo $ms;?><?php } else { ?>5000<?php } ?>);
	<?php } ?>
</script>

<div class="main_body">

  <div class="main_con clearfix">
  	<?php if($msgtype == 'success') { ?>
    <div class="zcsucceed">
			<h3><?php if(isset($msg)) { ?><?php echo $msg;?><?php } ?></h3>
			<div class="zcgm"><font color="red">3秒后页面自动跳转</font></div>
		</div> 
		<?php } else { ?>
		<div class="zcerror">
			<h3><?php if(isset($msg)) { ?><?php echo $msg;?><?php } ?></h3>
			<div class="zcgm"><font color="red">3秒后页面自动跳转</font></div>
		</div> 
		<?php } ?>
    <div class="borth25"></div>
  </div>
</div>




<?php include APPPATH.'views/'.template('index','footer',SITE_TEMP ); ?>