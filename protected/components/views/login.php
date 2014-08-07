
<style>
#login_modal {
	padding: 14px 22px;
	position: relative;
	width: 400px;
}
#login_modal #login_form {
    margin-top: 13px;
}
#login_modal label {
    color: #536376;
    display: block;
    font-size: 0.9em;
    margin-bottom: 10px;
}
#login_modal label input {
    background-position: -201px 0;
    display: block;
    font-size: 1.2em;
    height: 21px;
    line-height: 21px;
    padding: 7px 8px;
    width: 393px;
}
:focus{outline:0;}
</style>

			<div id="login_modal">
				<?php echo closeFloatWindow();?>
				<?php 
					if ($_REQUEST['infloat']){
						$submit = "ajaxpost('loginform');";
					}else{
						$submit = "$('#loginform').get(0).submit()";
					}
				?>
            	<form name="login" id="loginform" action="<?php echo url('site/login');?>" method="POST">
             		<input type="hidden" name="login-form" value="1">
             		<input type="hidden" name="login[pf]" value="<?php echo TableUserPlatform::EMAIL_LOGIN;?>">
                	<input type="hidden" name="nexturl" value="<?php echo $_REQUEST['nexturl'] ? urldecode($_REQUEST['nexturl']) : app()->request->getUrlReferrer();?>"; >
                	<span>Please sign in using the form below</span>
	                <div id="login_form">
	                    <label><strong>E-Mail:</strong> <input type="text" id="loginemail" class="sprited" name="login[username]" /></label>
	                    <label><strong>Password:</strong> <input  type="password" id="loginpasswd"  class="sprited" name="login[password]" onkeydown="if (event.keyCode==13)<?php echo $submit;?>;"/></label>
	                    <div id="actions" class="cl">
	                        <a class="close form_button sprited" id="cancel" href="#" onclick="hideWindow('<?php echo $_REQUEST['handlekey'];?>');">Cancel</a>
	                        <a class="form_button sprited" id="log_in" href="javascript:;" onclick="<?php echo $submit;?>">Sign in</a>
	                    </div>
	                </div>
        		</form>	
               

 <script>
 function errorhandle_login(msg)
 {
	showDialog(msg,'error',null,null,null,null,null,null,null,3)
 }
 </script>