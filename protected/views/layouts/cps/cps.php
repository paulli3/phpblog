<?php $this->beginContent('//layouts/common'); ?>
<style>
.yiiPager li{float:left;border:1px solid #eee;padding:3px 6px;margin:0 5px;}
.yiiPager .hidden{display:none;}
.yiiPager .selected{background:#DDD;}
</style>
<div class="header">
  <h1 width="253" height="52"><a href="http://7433.com" title="">7433点击推广中心</a></h1>
  <h2>页游推广首选</h2>
</div>
<!--页眉 结束--><!--顶部导航 开始-->
<div class="nav">
  <ul>
<!--    <li><a class="s1 " href="http://tg.1797wan.com/index.php/welcome">-->
<!--      <h2>联盟首页</h2>-->
<!--      </a></li>-->

    <li><a class="s6 on" href="<?php url('cps/index');?>">
      <h2>个人中心</h2>
      </a></li>
<!--    <li><a class="s8 " href="http://tg.1797wan.com/index.php/schedule">-->
<!--      <h2>开服排期</h2>-->
<!--      </a></li>-->
<!--    <li><a class="s9 " href="http://tg.1797wan.com/index.php/first">-->
<!--      <h2>推量首充</h2>-->
<!--      </a></li>-->
  </ul>
</div><!--顶部导航 结束-->
<div class="userArea hasLayout">
  <div class="content"><!--左侧菜单 开始-->
    <div class="sidebar">
	      <h2>广告列表</h2>
      <ul>
        <li class="">
          <h3><a href="<?php echo url('cps/getpage');?>" onclick="load(this.href);return false;" >提取链接</a></h3>
        </li>
        <li class="">
          <h3><a href="<?php echo url('cps/getpagelist');?>" onclick="load(this.href);return false;" >链接列表</a></h3>
        </li>
      </ul>
	        <h2>数据管理</h2>
      <ul>
        <li class="">
          <h3><a href="<?php echo url('cps/userlist');?>" onclick="load(this.href);return false;" >用户查询</a></h3>
        </li>
        <li class="">
          <h3><a href="<?php echo url('cps/paylist');?>" onclick="load(this.href);return false;" >充值查询</a></h3>
        </li>
        <li class="">
          <h3><a href="<?php echo url('cps/firstpay');?>" onclick="load(this.href);return false;" >首冲</a></h3>
        </li>
        <li class="">
          <h3><a href="<?php echo url('cps/firstpaylist');?>" onclick="load(this.href);return false;" >首冲历史</a></h3>
        </li>
        <?php 
        	if (user()->getName()=='admin'):
        ?>
		<li class="">
          <h3><a href="<?php echo url('cps/parseTxT');?>" onclick="load(this.href);return false;" >更新数据</a></h3>
        </li>
        
        <?php endif;?>
	</ul>
      <h2>账号管理</h2>
      <ul>
        
        <li>
          <h3><a href="<?php echo url('site/loginout');?>">退出登录</a></h3>
        </li>
      </ul>
      <div class="blank24"></div>
    </div>
    <!--左侧菜单 结束--><!--主要内容 开始-->
    <div class="userMain" id="userMain">
  
  
   	<?php echo $content; ?>
   
   
   </div>
    <!--主要内容 结束--></div>
</div>
<div class="footer">
  
  <p><a href="http://7433.com" target="_blank">中联畅想</a>版权所有 ©2008-2012 &nbsp; </p>
  <div class="blank24"></div>
</div>
<script>

function load(url){
	ajaxget(url,'userMain');
}
</script>
<?php $this->endContent(); ?>
