
<?php echo showFormHead(url("user/edit"),'post',array('id'=>'form','key'=>'form'));?>

	<input type="hidden" name="uid" value="<?php echo $model->uid;?>">
	<table>
		<tr class="<?php echo $model->getError('UserName') ? 'error' : '';?>">
			<td align="right">用户名:</td><td>
			<?php echo CHtml::textField("data[UserName]",$model->UserName ? $model->UserName : '' , $htmlOptions)?>
			<span><?php echo $model->getError('UserName');?></span> </td>
		</tr>
		<tr class="<?php echo $model->getError('passWd') ? 'error' : '';?>">
			<td align="right">密码 :</td><td>
			<?php echo CHtml::textField("data[passWd]",$model->passWd ? $model->passWd : '' , $htmlOptions)?>
			<span><?php echo $model->getError('passWd');?></span> </td>
		</tr>
		
		<?php 
		
			$rolelist = TableRole::model()->findAll();
			foreach ($rolelist as $k=>$v)
			{
				$select[$v['roleID']] = $v->roleName;
			}
		?>
		
		<tr>
			<td align="right">所属角色 :</td><td>
			<?php echo CHtml::listBox('data[roleID]', $model->roleID, $select , array('size'=>1));?>
			<span><?php echo $model->getError('roleID');?></span> </td>
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