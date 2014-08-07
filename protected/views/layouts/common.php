<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11"><meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta name="description" content="" />
<script type="text/javascript">
CONFIG = {
		MEDIA : '<?php echo baseDir();?>',
		IMGDIR : '<?php echo baseDir();?>/imgs/',
		'SITEURL' : '<?php echo app()->baseUrl;?>',
}
IMGDIR = CONFIG.IMGDIR;


</script>
	<link rel="stylesheet" type="text/css" href="<?php echo baseDir();?>/css/upaiyun.wmpee.com.css" />
	<script type='text/javascript' src='http://wpmee.b0.upaiyun.com/wp-content/themes/Loostrive/js/jquery.min.js'></script>
  	<link rel="shortcut icon" type="image/x-icon"  href="<?php echo baseDir();?>/imgs/favicon.ico">
  	
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <script src="<?php echo baseDir();?>/js/config.js" type="text/javascript" charset="utf-8"></script>
	<link href="<?php echo baseDir()."/styles/common.css";?>" media="screen" rel="stylesheet" type="text/css" />
	<?php foreach ($this->styles as $url):?>
<link href="<?php echo baseDir()."/".$url;?>" media="screen" rel="stylesheet" type="text/css" />
	<?php endforeach;;?>
	<?php foreach ($this->script as $url):?>
<script src="<?php echo baseDir();?>/js/<?php echo $url;?>" type="text/javascript" charset="utf-8"></script>
	<?php endforeach;;?>
<body class="index">
	<div id="append_parent"></div>
	<div id="ajaxwaitid"></div>
	
	<div class="main">
	    <?php echo $content; ?>
	</div>
</body>
</html>