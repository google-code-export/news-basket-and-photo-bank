<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title>Login | Image Bank</title>
    <meta charset="utf-8" />
    <meta name="description" content="Login Image Bank" />
    <meta name="author" content="BeritaSatu" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/login.css';?>" />
</head>

<body>
	<div class="header-bar-login">
		<?php $this->load->view('header_login'); ?>
	</div>
	<div class="container">
		<div id="main" class="main-login">
			<?php $this->load->view($main_content); ?>
		</div>
		<div class="footer-bar">
		</div>
	</div>
</body>

</html>