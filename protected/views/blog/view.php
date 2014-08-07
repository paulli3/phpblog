<?php 
$this->ExtraData['leftHtml'] = $leftHtml;
$this->ExtraData['pager'] = "";
$this->script	 = array('highlight.pack.js');
$this->styles = array('css/github.css');
?>
<style>
.main pre{white-space:pre;}
</style>
<script>hljs.initHighlightingOnLoad();</script>
	<div class="article_container row box"> 
	<h1><?php echo $Html['filename'];?></h1>
	 <div class="article_info"> 
	 	<span class="info_author info_ico"><?php echo $Html['author'];?></span>
	 	<span class="info_category info_ico"><a href="/blogtheme/" title="<?php echo $Html['filename'];?>" rel="category tag"><?php echo $Html['type'];?></a></span> 
	 	<span class="info_date info_ico"><?php echo mydate($Html['filetime']);?></span> 
	 	<span class="info_views info_ico">704</span> 
	 	<span class="info_comment info_ico"><a href="/forceful/#comments" title="<?php echo $Html['filename'];?>的评论">11</a></span> 
	 </div> 
	 <div class="clear"></div> 
	 
	 <div id="context"  class="context">
	 	<?php 
	 	echo $Html['body'];
	 	?>
	 </div> 
	 
	 
	 
