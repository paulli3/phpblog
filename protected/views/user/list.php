<?php 
if ($list):

$roleList = TableRole::model()->findAll();
foreach ($roleList as $k=>$v){
	$NEWroleList[$v->roleID] = $v->roleName;
}
?>
<table class="common">
	<tr>
		<th>用户编号</th>
		<th>用户名</th>
		<th>角色名</th>
		<th>用户状态</th>
		<th>操作</th>
	</tr>
	<?php foreach ($list as $k => $v):?>
	<tr>
		<td><?php echo $v['uid'];?></td>
		<td><?php echo $v['UserName'];?></td>
		<td><?php echo $NEWroleList[$v['roleID']];?></td>
		<td><?php if ($v['isEnable']):?>  <font color="green">可用</font>  <?php else: ?>  <font color="red">禁用</font> <?php endif;?></td>
		<td><a href="<?php echo url('user/edit',array('uid'=>$v['uid']));?>" onclick="showWindow('useredit<?php echo $v['uid'];?>',this.href);">编辑</a>
			 <a href="<?php echo url('user/del',array('uid'=>$v['uid']));?>" onclick="load(this.href);return false;">删除</a> </td>		
	</tr>
	<?php endforeach;?>
	<tr>
		<td colspan="5">
			<?php 
				$this->widget('LinkPager',array(   
					'header'=>'',   
					'firstPageLabel' => '首页',  
			 		'lastPageLabel' => '末页',   
					'prevPageLabel' => '上一页',   
					'nextPageLabel' => '下一页',   
					'pages' => $pages,   
					'htmlOptions' => array('onclick'=>'load(this.href);return false;'),
					'maxButtonCount'=>13   
					)  
				);  
			?>
		</td>
	</tr>
</table>
<?php endif;?>









