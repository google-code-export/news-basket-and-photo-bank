<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title><?php echo "$page_title";?></title>
    <meta charset="utf-8" />
    <meta name="description" content="Login News Basket" />
    <meta name="author" content="BeritaSatu" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/template.css';?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/user.css';?>" />
	
</head>

<body>
	<div class="header-bar">
		<?php $this->load->view('header', $username); ?>
	</div>
	<div class="container">
		<div class="navigation">
			<div class="navigation-inner">
				<?php $this->load->view('user_navigation'); ?>
			</div>
		</div>
		<div id="main" class="main">
			<div class="search-bar">
        		<?php $this -> load -> view('search', $dropdown); ?>
        		</div>
			<?php $this->load->view($main_view); ?>
		</div>
		
	</div>
	<div class="footer-bar">
		<?php $this->load->view('footer');?>
	</div>
</body>

</html>