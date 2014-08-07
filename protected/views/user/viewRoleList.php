<?php 
if ($list):
?>
<a href="<?php echo url("user/roleedit");?>" onclick="showWindow('useradd',this.href);" class="add">添加角色</a>
<table class="common">
	<tr>
		<th>权限编号</th>
		<th>权限名称</th>
		<th>权限代码</th>
		
		<th>操作</th>
	</tr>
	<?php foreach ($list as $k => $v):?>
	<tr>
		<td><?php echo $v['roleID'];?></td>
		<td><?php echo $v['roleName'];?></td>
		<td><?php echo $v['roleCode'];?></td>
		
		<td><a href="<?php echo url('user/roleedit',array('roleID'=>$v['roleID']));?>" onclick="showWindow('useredit<?php echo $v['roleID'];?>',this.href);">编辑</a>
			 <a href="<?php echo url('user/roledelete',array('roleID'=>$v['roleID']));?>" onclick="load(this.href);return false;">删除</a> </td>		
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

<script reload=1>
function succeedhandle_useradd(url)
{
	load(url);
}
</script>







