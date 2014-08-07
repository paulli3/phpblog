<?php 
$this->script=array(
	'jquery-1.6.2.js','xheditor_min.js'
);
?>
<div class="article_container box"> 
	<h1>添加/修改 博客</h1>
	<p class="article_info"></p>
	
	<form action="" id="frm" method="post" onsubmit="return false;">
		<?php echo CHtml::hiddenField("data[id]",$model->id, $htmlOptions);?>
		<table class="" width="100%">
			<tr class="<?php echo $model->getError('title') ? 'error' : '';?>">
				<td align="right">Title:</td><td>
				<?php echo CHtml::textField("data[title]",$model->title ? $model->title : '' , $htmlOptions)?>
				<span><?php echo $model->getError('title');?></span> </td>
			</tr>
			<tr class="<?php echo $model->getError('mean') ? 'error' : '';?>">
				<td align="right">Mean:</td><td>
				<?php echo CHtml::textField("data[mean]",$model->mean ? $model->mean : '' , $htmlOptions)?>
				<span><?php echo $model->getError('mean');?></span> </td>
			</tr>
			<tr class="<?php echo $model->getError('body') ? 'error' : '';?>">
				<td align="right">Code:</td><td>
				<?php echo CHtml::textArea("data[body]",$model->body ? $model->body : '' , array('class'=>'xheditor','style'=>"height:500px;width:100%"))?>
				<span><?php echo $model->getError('body');?></span> </td>
			</tr>
			<tr>
				<td><button type="submit" id="btn_submit" onclick="editor.getSource();ajaxpost('frm',undefined,undefined,undefined,this);">确定</button></td>
			</tr>
		</table>
	</form>
	
	

</div>
<script>
var plugins={
		Code:{c:'btnCode',t:'插入代码',h:1,e:function(){
			var _this=this;
			var htmlCode='<div><select id="xheCodeType"><option value="html">HTML/XML</option><option value="js">Javascript</option><option value="css">CSS</option><option value="php">PHP</option><option value="java">Java</option><option value="py">Python</option><option value="pl">Perl</option><option value="rb">Ruby</option><option value="cs">C#</option><option value="c">C++/C</option><option value="vb">VB/ASP</option><option value="">其它</option></select></div><div><textarea id="xheCodeValue" wrap="soft" spellcheck="false" style="width:300px;height:100px;" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="确定" /></div>';			var jCode=$(htmlCode),jType=$('#xheCodeType',jCode),jValue=$('#xheCodeValue',jCode),jSave=$('#xheSave',jCode);
			jSave.click(function(){
				_this.loadBookmark();
				_this.pasteHTML('<pre><code class="'+jType.val()+'">'+_this.domEncode(jValue.val())+'</code></pre>');
				_this.hidePanel();
				return false;	
			});
			_this.saveBookmark();
			_this.showDialog(jCode);
		}},
	};
var	editor=$('textarea.xheditor').xheditor(
		{	
			//tools:'Pastetext,Blocktag,Fontface,Fontface,FontColor,BackColor,Code',
			upLinkUrl:'demos/upload.php?immediate=1',upImgUrl:'demos/upload.php?immediate=1',upFlashUrl:'demos/upload.php?immediate=1',upMediaUrl:'demos/upload.php?immediate=1',localUrlTest:/^https?:\/\/[^\/]*?(xheditor\.com)\//i,remoteImgSaveUrl:'demos/saveremoteimg.php',
			editorRoot:'<?php echo baseDir('imgs/xheditor/');?>',
			plugins:plugins,loadCSS:'<style>pre{margin-left:2em;border-left:3px solid #CCC;padding:0 1em;}</style>',shortcuts:{'ctrl+enter':submitForm}});
function submitForm(){$('#frm').submit();}	
</script>