<?php $this->beginContent('//layouts/common'); ?>

<div id="head" class="row">
 <div class="container row"> 
 	<div class="row"> 
 		<div id="topbar"> 
 			<ul id="toolbar" class="menu">
 				<li><a rel="nofollow" href="/guestbook/">报错？建议？留言？</a></li>
 				<li><a title="WordPress相关投稿" rel="nofollow" href="/tougao/">投稿</a></li>
 				<li><a rel="nofollow" href="/wordpress-host/">主机</a></li>
 			</ul> 
 		</div> 
 		<div id="rss"> 
 			<ul> 
 				<li><a href="http://www.wpmee.com/feed/" target="_blank" class="icon1" title="欢迎订阅WordPress迷"></a></li> 
 				<li><a href="http://www.wpmee.com/sitemaps/" target="_blank" class="icon5" title="百度站点地图"></a></li> 
 				<li><a href="http://www.wpmee.com/sitemap.xml" target="_blank" class="icon6" title="站点地图"></a></li> 
 				<li><a href="http://www.wpmee.com/i?k=q" target="_blank" class="icon4" title="通过邮箱订阅本站" rel="nofollow"></a></li>
 			</ul>
 		</div> 
 	</div> 
 </div> 
 <div class="clear"></div> 
 <div class="container"> 
 	<div id="blogname" class="third">		<h1 class="logo">WordPress迷</h1> </div>
 	<div class="banner push-right"> 
 	</div> 
 </div> 
 <div class="clear"></div> 
</div> 

<div class="mainmenus">
	<div class="container">
		<div class="mainmenu"> 
			<div class="topnav"> 
				<a href="http://www.wpmee.com" title="网站首页" class="home " rel="nofollow">首页</a> 
				<ul id="menus"> 
					<li><a title="WordPress博客主题" href="/blogtheme/">博客主题</a></li>
					
				</ul> 
				<ul class="menu-right"> 
					<li class="menu-search">
					<a href="javascript:;" id="menu-search" title="搜索" rel="nofollow"></a>
					<div class="menu-search-form "> <form action="http://www.wpmee.com" method="get"> 
						<input name="s" type="text" id="search" value="" maxlength="150" placeholder="请善用搜索" x-webkit-speech> </form> 
					</div> 
					</li> 
				</ul> <!-- menus END --> 
			</div> 
		</div> 
		<div class="clear"></div> 
	</div>
</div>
<div class="container"> 
	<div class="subsidiary row box"> 
<!--		<div class="bulletin fourfifth"><span class="sixth">站点公告：</span> 出售一香港新世界机房的主机，无限站点，600M空间，10G月流量，完美运行wordpress，还有9个多月，半价出售：90元，有意者联系。 </div> -->
		<div class="bdshare_small fifth"> 
			<div class="bdsharebuttonbox"> 
				<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a> 
				<a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a> 
				<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a> 
				<a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a> 
				<a href="#" class="bds_more" data-cmd="more"></a> 
			</div> 
		</div>
	</div> 
	
   	<?php echo $content; ?>

</div> 

<div class="clear"></div>
<div id="footer"> 
	<div class="footnav container"> 
	<ul id="friendlink" class="menu">
		<li><a target="_blank" href="http://www.wpmee.com/links/">申请WordPress迷友情链接：</a></li>
		<li class="current-menu-item"><a href="http://www.wpmee.com">WordPress</a></li>
		<li><a target="_blank" href="http://www.loome.net/">洛米</a></li>
		<li><a target="_blank" href="http://www.2zzt.com/">wordpress企业主题</a></li>
		<li><a title="专注于分享好用的WordPress主题！" target="_blank" href="http://www.zhangleisir.cn">WordPress主题</a></li>
	</ul> 
	</div>
<div class="copyright"> 
	<p> Copyright &copy; 2013-2014
	 <a href="http://www.wpmee.com/" rel="nofollow"><strong>WordPress迷</strong></a> 
	 <a class="author" href="http://www.wpmee.com/i?k=i" target="_blank" rel="nofollow external">Theme By Loome</a> 
	 <a href="http://www.wpmee.com/i?k=Law" target="_blank" rel="nofollow">【本站法律顾问】：ITLAW-庄毅雄律师</a>
	 <br > <a href="http://www.wpmee.com/i?k=upyun" target="_blank" rel="nofollow" title="由又拍云提供静态CDN加速"><img src="http://pic.wpmee.com/upyun.png" style="margin-top: -3px;" alt="由又拍云提供静态CDN加速" width="24px" height="24px"></a> 
	 <a href="http://www.wpmee.com/i?k=a" target="_blank" rel="nofollow" title="运行在阿里云"><img src="http://gtms01.alicdn.com/tps/i1/T1zl_ZFmdbXXcn152t-98-20.png" style="margin-bottom:-5px" alt="运行在阿里云" width="98px" height="20px"></a> 
	 </p>
</div>
</div>
<?php $this->endContent(); ?>
