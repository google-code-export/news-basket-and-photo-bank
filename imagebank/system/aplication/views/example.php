<head>
	<?php
	$message_success = $this -> session -> flashdata('message_success');
	echo !empty($message_success) ? "<p class='alert alert-success'>" . $message_success . "</p>" : "";

	$message_failed = $this -> session -> flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>" : "";
?>
<?php 

foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

</head>
	<div>
		
		
<?php
			if (isset($modules -> report))
				foreach ($modules->report as $module)
					echo $module;
    ?></div>
    <div style='height:20px;'></div>  
   <div class="for_CURD">
<?php echo $output; ?> 
</div>  

