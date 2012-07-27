<div class="main content clearfix">
	<img src="<?php echo base_url().'images/logo image bank.png';?>" width="170" style="float: right; position: absolute; z-index: 1; top: 14px; left:10px;">
	<img src="<?php echo base_url().'images/title.png';?>" width="300" style="float: right; position: absolute; z-index: 1; top: 73px; left:250px;">
			<div class="slideshow">
			<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Untitled Page</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
body
{
   background-color: #FFFFFF;
   color: #000000;
}
</style>
<style type="text/css">
a
{
   color: #C8D7EB;
   text-decoration: underline;
}
a:visited
{
   color: #C8D7EB;
}
a:active
{
   color: #C8D7EB;
}
a:hover
{
   color: #376BAD;
   text-decoration: underline;
}
</style>
<script type="text/javascript" src="library/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="library/wb.conveyerbelt.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   $("#SlideShow2").conveyerbelt({speed:1, spacing: 0});
});
</script>
</head>
<body>
<div id="SlideShow2" style="position:absolute;left:163px;top:180px;width:455px;height:255px;overflow:hidden;border:5px #1E1E1E solid;z-index:0;">
<img style="border-width:0;left:0px;top:0px;width:454px;height:255px;" src="images/Wallpaper-1080p-5.jpg" alt="" title="">
<img style="border-width:0;left:0px;top:0px;width:454px;height:255px;display:none;" src="images/Wallpaper-1080p-23.jpg" alt="" title="">
<img style="border-width:0;left:0px;top:0px;width:454px;height:255px;display:none;" src="images/Wallpaper-1080p-25.jpg" alt="" title="">
<img style="border-width:0;left:0px;top:0px;width:454px;height:255px;display:none;" src="images/Wallpaper-1080p-36.jpg" alt="" title="">
</div>
</body>
	</div>
	
	<div class="signin-box">
		<h2>Image Bank Login<strong></strong></h2>
		<form id="newsbasket-login" name="newsbasket_login" action="<?php echo $form_action; ?>" method="post">
		<div class="username">
			<label for="username"><strong class="username-label">Username</strong></label>
			<input type="text" name="username" id="username" value="" required="required" autofocus="autofocus">
		</div>
		<div class="password-div">
			<label for="password"><strong class="password-label">Password</strong></label>
			<input type="password" name="password" id="password" required="required">
		</div>
		<input type="submit" class="nb-button nb-button-submit" name="sign-in" id="sign-in" value="Login">
		<?php
			$flashmessage = $this->session->flashdata('message');
			echo !empty($flashmessage) ? "<p class='message'>" . $flashmessage . "</p>": "";
		?>
		<!--
		<label class="remember" onclick="">
			<input type="checkbox" name="PersistentCookie" id="PersistentCookie" value="yes">
			<strong class="remember-label">
				Tetap masuk
			</strong>
		</label>
		</form>
		<ul>
			<li>
			<a id="link-forgot-password" href="">Tidak dapat mengakses akun?</a>
			</li>
		</ul>
		-->
	</div>
</div>