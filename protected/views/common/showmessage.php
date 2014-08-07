<div id="content" class="main" style="">
<?php 
if ( $param[msgtype] == 1 || $param[msgtype] == 2 && !$_REQUEST['inajax']):
?>

	<div class="f_c altw">
			<?php if($param['login']):?>
				<div id="messagelogin"></div>
				<script type="text/javascript">ajaxget('<?php echo url('site/login',array('infloat'=>1,'nexturl'=>$_REQUEST['nexturl']));?>', 'messagelogin');</script>
			<?php else:?>
				<div id="messagetext" class="<?php echo $alerttype ?>">
					<p><?php echo $show_message;?></p>
					<?php if ($url_forward):?>
						<?php if (!$param[redirectmsg]):?>
							<p class="alert_btnleft"><a href="<?php echo $url_forward;?>">{lang message_forward}</a></p>
						<?php else:?>
							<p class="alert_btnleft"><a href="<?php echo $url_forward;?>">{lang attach_forward}</a></p>
						<?php endif;?>
					<?php else:?>
					<script type="text/javascript">
						if(history.length > (BROWSER.ie ? 0 : 1)) {
							document.write('<p class="alert_btnleft"><a href="javascript:history.back()">[Go Back]</a></p>');
						} else {
							document.write('<p class="alert_btnleft"><a href="./">[Go Forward]</a></p>');
						}
					</script>
					<?php endif;?>
				</div>
			
			<?php endif;?>
		</div>
<?php elseif($param[msgtype] == 2):?>
		<h3 class="flb"><em>info</em>
		<?php if($_REQUEST['inajax']):?>
		<span><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_GET['handlekey']?>');" title="close">close</a></span>
		<?php endif;?>
		</h3>
		<div class="c altw">
			<div class="<?php echo $alerttype ?>"><?php echo $show_message;?></div>
		</div>
		<p class="o pns">
			<?php if ($param['closetime']):?>
				<span class="z xg1"><?php echo $param['closetime'];?> s 后关闭</span>
			<?php elseif ($param['locationtime']):?>
				<span class="z xg1"><?php echo $param['locationtime'];?> s后跳转</span>
			<?php endif;?>
			
			<?php if ($param['login']):?>
				<button type="button" class="pn pnc" onclick="hideWindow('<?php echo $_GET['handlekey']?>');showWindow('login', '<?php echo url('site/login',array('infloat'=>1));?>');"><strong>sign in</strong></button>
				
				<button type="button" class="pn" onclick="hideWindow('<?php echo $_GET['handlekey']?>');"><em>cancal</em></button>
			<?php elseif(!$param['closetime'] && !$param['locationtime']):?>
				<button type="button" class="pn pnc" id="closebtn" onclick="hideWindow('<?php echo $_GET['handlekey']?>');"><strong>确定</strong></button>
				<script type="text/javascript" reload="1">if($('#closebtn').get(0)) {$('#closebtn').get(0).focus();}</script>
			<?php endif;?>
		</p>
<?php else :?>
	<?php if ($param['postRediect']):?>
		<script reload=1>load('<?php echo $url_forward;?>');hideWindow('<?php echo $_GET['handlekey']?>');</script>
	<?php else:?>
		<?php echo $show_message;?>	
	<?php endif;?>
<?php endif;?>

	
</div>
