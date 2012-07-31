<div class="main content clearfix">
	
	<div class="signin-box">
		<h2>Imagebank<strong></strong></h2>
		<form id="newsbasket-login" name="newsbasket_login" action="<?php echo $form_action; ?>" method="post">
		<div class="username">
			<label for="username"><strong class="username-label">Username</strong></label>
			<input type="text" name="username" id="username" value="" required="required" autofocus="autofocus">
		</div>
		<div class="password">
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