<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title><?php echo $page_title;?></title>
   
    <meta charset="utf-8" />
    <meta name="description" content="Manage Image Bank" />
    <meta name="author" content="BeritaSatu" />
	
	<style type="text/css">@import url("<?php echo base_url().'css/template.css'; ?>");</style>
	<style type="text/css">@import url("<?php echo base_url().'css/admin.css'; ?>");</style>



</head>
<?php flush();?>
<body>
	<div class="header-bar">
		<?php $this->load->view('header', $username); ?>
		
	</div>
	<div class="container">
		<div class="navigation">
			<div class="navigation-inner">
				<?php $this->load->view('admin_navigation'); ?>
			</div>
		</div>
		<div id="main" class="main">
			 <h2><?php echo $h2_title;?></h2>
			<?php $this->load->view('example'); ?>
			
		</div>
		<div class="footer-bar">
			<?php $this->load->view('footer'); ?>
		</div>
	</div>
	
	
</body>

</html>