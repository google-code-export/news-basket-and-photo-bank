<html>
	<title>Edit Image</title>
	<head></head>
	
				
	<body>
		
	
		<?php  echo form_open('gallery/updateImage/'.$images->id_images);?>
	<h2>Edit Title And Caption</h2>
	<p> Title:<br /><input type="text" name="title" value="<?php echo $images->title;?>" /></p>
	<p>Caption <br /><textarea name="caption" rows="6" cols="25" /><?php echo $images->caption;?></textarea></p>	
	<p>Keyword<br/><input type="text" name="tag" /></p>	
		<p><input type="submit" value="save" /></p>
	</body>
	
	
</html>

