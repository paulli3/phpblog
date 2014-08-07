<!DOCTYPE html>
<html lang="en">
  <meta charset="utf-8"/>
  <meta name="description" content="" />
<script type="text/javascript">
CONFIG = {
		MEDIA : '<?php echo baseDir();?>',
		IMGDIR : '<?php echo baseDir();?>/imgs/',
		'SITEURL' : '<?php echo app()->baseUrl;?>',
}
IMGDIR = CONFIG.IMGDIR;
</script>
  <link rel="shortcut icon" href="<?php echo baseDir();?>/imgs/favicon.ico">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <?php if($this->getId() == 'site' && $this->getAction() && $this->getAction()->getId()=='index'):?>
  <script src="<?php echo baseDir();?>/js/jquery.js"></script>

  <?php else :?>
  <script src="<?php echo baseDir();?>/js/jquery-1.6.2.js"></script>
  <?php endif;?>
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