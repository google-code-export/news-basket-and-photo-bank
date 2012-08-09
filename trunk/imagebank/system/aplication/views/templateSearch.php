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
      
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />
<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/   css" media="all" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js" type="text/javascript"></script>
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
               
                <div id="main" class="main">
                    <div class="search-bar">
        		<?php $this -> load -> view('search'); ?>
        		
        			</div>
                        <?php $this -> load -> view($main_view); ?>
                         
                </div>
                
        </div>
        
       
</body>

</html>
