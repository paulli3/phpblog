
<div class="article_container box"> 
	<h1>添加/修改 博客</h1>
	<p class="article_info"></p>
	
	<form action="">
		<table class="">
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
			<tr class="<?php echo $model->getError('mean') ? 'error' : '';?>">
				<td align="right">Code:</td><td>
				<?php echo CHtml::textField("data[mean]",$model->mean ? $model->mean : '' , $htmlOptions)?>
				<span><?php echo $model->getError('mean');?></span> </td>
			</tr>
			<tr>
				<td><button type="submit">确定</button></td>
			</tr>
		</table>
	</form>
	
	

</div>
