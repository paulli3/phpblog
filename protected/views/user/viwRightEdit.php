
<?php echo showFormHead(url("user/rightEdit"),'post',array('id'=>'form','key'=>'form'));?>

	<input type="hidden" name="rightID" value="<?php echo $model->rightID;?>">
	<table class="">
		<tr class="<?php echo $model->getError('rightName') ? 'error' : '';?>">
			<td align="right">权限名称:</td><td>
			<?php echo CHtml::textField("data[rightName]",$model->rightName ? $model->rightName : '' , $htmlOptions)?>
			<span><?php echo $model->getError('rightName');?></span> </td>
		</tr>
		<tr class="<?php echo $model->getError('rightCode') ? 'error' : '';?>">
			<td align="right">权限代码:</td><td>
			<?php echo CHtml::textField("data[rightCode]",$model->rightCode ? $model->rightCode : '' , $htmlOptions)?>
			<span><?php echo $model->getError('rightCode');?></span> </td>
		</tr>
		<tr>
			<td><button type="submit">确定</button></td>
		</tr>
	</table>
</form>
<script reload=1>
function succeedhandle_(url)
{
	load(url);
}
</script>