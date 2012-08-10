<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title>Home | News Basket</title>
    <meta charset="utf-8" />
    <meta name="description" content="Login News Basket" />
    <meta name="author" content="BeritaSatu" />
	
	<style type="text/css">@import url("<?php echo base_url().'css/template.css'; ?>");</style>
	<style type="text/css">@import url("<?php echo base_url().'css/user.css'; ?>");</style>
	
</head>
<?php flush();?>
<body>
	<div class="header-bar">
		<?php $this->load->view('header_user', $username); ?>
	</div>
	<div class="container">
		<div class="navigation">
			<div class="navigation-inner">
				<?php $this->load->view('editor_navigation'); ?>
			</div>
		</div>
		<div id="main" class="main">
			<?php $this->load->view($main_view); ?>
		</div>
	</div>
	
	<script type="text/javascript" src="<?php echo base_url().'/library/jquery-1.7.2.min.js'; ?>"></script> 
	<script type="text/javascript" src="<?php echo base_url().'/library/tablesorter/jquery.tablesorter.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'/library/myscript.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'/library/FusionCharts.js';?>"></script>	
	<script type="text/javascript" src="../library/tinymcpuk-0.3/tiny_mce.js"></script>
</body>

</html>