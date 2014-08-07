<style>
body{background:#FFF;}
div.mainleft{float:right;}
#sidebar{float:left;margin-left:0;margin-right:16px;}
.list li.maintitle{font-size:16px;}
.list li{margin-bottom:15px;font-size:14px;}
.list li a{color:#0088cc; }
.list li.file {font-size:12px;}
.list li.file a{color:#00aacc;} 
.list li a:hover{color:#d14836;}
</style>
<?php 

function showLeft($d,$s,$isstart="0")
{
	//if (!is_array($d['child']))return;
	$ret = "";
	$add = 0;
	$s = $s + $add;
	$s = 0;
	$ret .= "<ul>";
	foreach ($d as $k =>$v){
		$ret .= '<li style="margin-left:'.$s.'em;" '.($isstart ? "class='maintitle' " : "").'><a href="javascript:;" title="'.$v['name'].'">'.$v['name'].'('.$v['count'].')</a></li>';
		if (!empty($v['data'])){
			$ret .= "<ul>";
			foreach ($v['data'] as $id=>$file){
				$ret .= '<li style="margin-left:'.($s + $add).'em;" class="file"><a href="'.url('view/'.$file['id']).'" title="">'.$file['filename'].'</a></li>';				
			}
			$ret .= "</ul>";
		}
		if (!empty($v['child']))
		{
			$ret .= showLeft($v['child'], $s);
		}
		
	}
	$ret .= "</ul>";
	return $ret;
}
//print_r($leftData);die;
$leftHtml = showLeft($leftData,$step=0.5,1);

?>
<div class="row list box" id="left-menu">
	<?php echo $leftHtml;?>
</div>


<!--<div class="widget box row"><h3>最新教程&插件&新闻</h3> -->
<!-- 	<ul class="line"> -->
<!-- 		<li class="w_box"><a href="/wordpress-links-gra/" title="WordPress带头像的友情链接页面制作教程"> -->
<!-- 			<div class="r_pic"> <img src="http://wpmeeimg.b0.upaiyun.com/2014/06/20140625150034.jpg!s" alt="WordPress带头像的友情链接页面制作教程" /> </div> -->
<!-- 			<div class="w_title"> WordPress带头像的友情链接页面制作教程 </div></a>-->
<!-- 		</li> -->
<!-- 		<li class="w_box"><a href="/wordpress-links-gra/" title="WordPress带头像的友情链接页面制作教程"> -->
<!-- 			<div class="r_pic"> <img src="http://wpmeeimg.b0.upaiyun.com/2014/06/20140625150034.jpg!s" alt="WordPress带头像的友情链接页面制作教程" /> </div> -->
<!-- 			<div class="w_title"> WordPress带头像的友情链接页面制作教程 </div></a>-->
<!-- 		</li> -->
<!-- 		<li class="w_box"><a href="/wordpress-links-gra/" title="WordPress带头像的友情链接页面制作教程"> -->
<!-- 			<div class="r_pic"> <img src="http://wpmeeimg.b0.upaiyun.com/2014/06/20140625150034.jpg!s" alt="WordPress带头像的友情链接页面制作教程" /> </div> -->
<!-- 			<div class="w_title"> WordPress带头像的友情链接页面制作教程 </div></a>-->
<!-- 		</li> -->
<!-- 	</ul>			-->
<!-- </div>-->