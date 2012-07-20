<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title>Login | News Basket</title>
    <meta charset="utf-8" />
    <meta name="description" content="Login News Basket" />
    <meta name="author" content="BeritaSatu" />
	
	<style type="text/css">@import url("<?php echo base_url().'css/login.css'; ?>");</style>
</head>
<?php flush();?>
<body>
	<div class="header-bar-login">
		<?php $this->load->view('header_login'); ?>
	</div>
	<div class="container">
		<div id="main" class="main-login">
			<?php $this->load->view($main_content); ?>
		</div>
		<div class="footer-bar">
			<?php $this->load->view('footer'); ?>
		</div>
	</div>
</body>

</html>