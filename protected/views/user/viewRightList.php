<?php 
if ($list):
?>
<a href="<?php echo url("user/rightedit");?>" onclick="showWindow('useradd',this.href);" class="add">添加权限</a>
<table class="common">
	<tr>
		<th>权限编号</th>
		<th>权限名称</th>
		<th>权限代码</th>
		
		<th>操作</th>
	</tr>
	<?php foreach ($list as $k => $v):?>
	<tr>
		<td><?php echo $v['rightID'];?></td>
		<td><?php echo $v['rightName'];?></td>
		<td><?php echo $v['rightCode'];?></td>
		
		<td><a href="<?php echo url('user/rightedit',array('rightID'=>$v['rightID']));?>" onclick="showWindow('useredit<?php echo $v['rightID'];?>',this.href);">编辑</a>
			 <a href="<?php echo url('user/rightdelete',array('rightID'=>$v['rightID']));?>" onclick="load(this.href);return false;">删除</a> </td>		
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







