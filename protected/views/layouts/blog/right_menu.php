<?php $this->beginContent('//layouts/column1'); ?>
<?php
$this->pageTitle = "李阳的个人网站！";
?>

	<div class="mainleft"> 
		<?php echo $content; ?> 	
	</div> 
	
		 <div id="sidebar">
		 	
		 	<?php echo $this->ExtraData['leftHtml'];?>
<!--		 	<div class="widget box row"> -->
<!--			 	<div class="textwidget">-->
<!--			 		<a href="http://www.wpmee.com/i?k=hc" target="_blank" rel="nofollow" title="wordpress主机推荐">-->
<!--			 			<img src="http://wpmeeimg.b0.upaiyun.com/2014/04/hczj.jpg" alt="WordPress专业主机" width="300px" height="250px">-->
<!--			 		</a>-->
<!--			 	</div> -->
<!--		 	</div>-->
		 </div> 
		 <div class="clear"></div> 


<?php if ($this->ExtraData['pager']):?>
<div class="navigation container">
	<?php echo $this->ExtraData['pager'];?>
</div>
<?php endif;?>


<!--gototop--><div id="tbox"> <a id="gotop" href="javascript:void(0)" rel="nofollow"></a> </div>
<script type="text/javascript" src="http://wpmee.b0.upaiyun.com/wp-content/themes/Loostrive/js/jquery.masonry.js"></script>
<script type="text/javascript" src="http://wpmee.b0.upaiyun.com/wp-content/themes/Loostrive/js/loostrive.js"></script>
<?php $this->endContent(); ?>

