<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title><?php echo $page_title; ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="Manage News Basket" />
    <meta name="author" content="BeritaSatu" />
        
        <style type="text/css">@import url("<?php echo base_url() . 'css/template.css'; ?>
			");
</style>
        <style type="text/css">@import url("<?php echo base_url() . 'css/admin.css'; ?>
			");
</style>
		<style type="text/css">@import url("<?php echo base_url() . 'styles/jquery.fancybox.css'; ?>
			");
</style>



      
        
</head>
<?php flush(); ?>
<body>
        <div class="header-bar">
                <?php $this -> load -> view('header', $username); ?>
        </div>
        <div class="container">
        	
        	
                <div class="navigation">
                        <div class="navigation-inner">
                                <?php $this -> load -> view('admin_navigation'); ?>
                        </div>
                </div>
               <h2><?$h2_title;?></h2>
                <div id="main" class="main">
            
                     <?php $this -> load -> view($main_view); ?>
                         
                </div>
                <div class="footer-bar">
                        <?php $this -> load -> view('footer'); ?>
                </div>
        </div>
        
        
</body>

</html>
