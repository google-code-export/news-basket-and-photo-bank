<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title><?php echo $page_title;?></title>
    <meta charset="utf-8" />
    <meta name="description" content="Manage News Basket" />
    <meta name="author" content="BeritaSatu" />
        
        <style type="text/css">@import url("<?php echo base_url().'css/template.css'; ?>");</style>
        <style type="text/css">@import url("<?php echo base_url().'css/admin.css'; ?>");</style>
      
        
</head>
<?php flush();?>
<body>
        <div class="header-bar">
                <?php $this->load->view('header',$username); ?>
        </div>
        <div class="container">
                <div class="navigation">
                        <div class="navigation-inner">
                                <?php $this->load->view('admin_navigation'); ?>
                        </div>
                </div>
                <div id="main" class="main">
                        <?php $this->load->view($main_view); ?>
                </div>
                <div class="footer-bar">
                        <?php $this->load->view('footer'); ?>
                </div>
        </div>
        
        <script type="text/javascript" src="<?php echo base_url().'/library/jquery.js'; ?>"></script> 
        <script type="text/javascript" src="<?php echo base_url().'/library/tablesorter/jquery.tablesorter.js'; ?>"></script>
        <script  type="text/javascript" src="<?php echo base_url().'/library/myscript.js'; ?>"></script>
</body>

</html>
