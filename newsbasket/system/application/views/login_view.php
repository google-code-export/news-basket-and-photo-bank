<div class="main content clearfix">
	<img src="<?php echo base_url().'images/comingsoon.png';?>" width="200" style="float: right; position: absolute; z-index: 1; top: 60px; right:60px;">
	<div class="signin-box">
		<h2>News Basket Login<strong></strong></h2>
		<form id="newsbasket-login" name="newsbasket_login" action="" method="post">
		<div class="email-div">
			<label for="Email"><strong class="email-label">Username</strong></label>
			<input type="email" name="Email" id="Email" value="" required="required" autofocus="autofocus">
		</div>
		<div class="passwd-div">
			<label for="Passwd"><strong class="passwd-label">Password</strong></label>
			<input type="password" name="Passwd" id="Passwd" required="required">
		</div>
		<input type="submit" class="nb-button nb-button-submit" name="signIn" id="signIn" value="Masuk">
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
			<a id="link-forgot-passwd" href="">Tidak dapat mengakses akun?</a>
			</li>
		</ul>
		-->
	</div>
</div>