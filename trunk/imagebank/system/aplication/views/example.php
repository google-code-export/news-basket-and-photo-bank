<head>
<?php 

foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
	<div>
		
		
<?php 
                    if(isset($modules->report)) 
                        foreach($modules->report as $module) 
                            echo $module;
    ?></div>
    <div style='height:20px;'></div>  
   <div class="for_CURD">
<?php echo $output; ?> 
</div>  

