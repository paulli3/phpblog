<style>
<!--
fieldset{float:left;margin-right:5px;border:1px solid #EFEFEF;}
.right input{width:auto;}
-->
</style>
<?php echo showFormHead(url("user/roleEdit"),'post',array('id'=>'form','key'=>'form'));?>

	<input type="hidden" name="roleID" value="<?php echo $model->roleID;?>">
	<table class="">
		<tr class="<?php echo $model->getError('roleName') ? 'error' : '';?>">
			<td align="right">角色名称:</td><td>
			<?php echo CHtml::textField("data[roleName]",$model->roleName ? $model->roleName : '' , $htmlOptions)?>
			<span><?php echo $model->getError('roleName');?></span> </td>
		</tr>
		<?php 
			$rightlist = TableRight::model()->findAll();
			$roleCode = explode(',', $model->roleCode);
		?>
		<tr class="right">
			<td>所拥有权限</td>
			<td>
				<?php foreach ($rightlist as $k=>$v):?>
				<?php 
					$ishave = 0;
					foreach ($roleCode as $vv):
						if ($vv == $v['rightID']){
							$ishave = 1;break;
						} 					
					endforeach;
				?>
				<fieldset><legend><?php echo $v['rightName'];?></legend><label for="<?php echo $v['rightCode'];?>"><?php echo $v['rightCode'];?></label><input id="<?php echo $v['rightCode'];?>" name="data[roleCode][]" value="<?php echo $v['rightID'];?>" type="checkbox" <?php if ($ishave)echo "checked=checked";?>/></fieldset>
				<?php endforeach;?>
			</td>
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