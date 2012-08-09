<div class="main content clearfix">
	<div class="signin-box">
		<h2>News Basket Login<strong></strong></h2>
		<form id="newsbasket-login" name="newsbasket_login" action="<?php echo $form_action; ?>" method="post">
		<div class="username">
			<label for="username"><strong>Username</strong></label>
			<br>
			<input type="text" name="username" id="username" value="" required="required" autofocus="autofocus">
		</div>
		<div class="password-div">
			<label for="password"><strong>Password</strong></label>
			<br>
			<input type="password" name="password" id="password" required="required">
		</div>
		<input type="submit" class="nb-button nb-button-submit" name="sign-in" id="sign-in" value="Login">
		<?php
			$flashmessage = $this->session->flashdata('message');
			echo !empty($flashmessage) ? "<p style='margin-top: 10px;'>" . $flashmessage . "</p>": "";
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