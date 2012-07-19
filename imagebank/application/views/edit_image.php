<html>
	<title>Edit Caption</title>
	<head></head>
	
				
	<body>
		<?php  echo form_open_multipart('user/editCaption');?>
	<h2>Edit Title And Caption</h2>
	<p> Title:<br /><input type="text" name="title" /></p>
	<p>Description <br /><textarea name="caption" rows="5" cols="30"></textarea></p>	
		
		<p><input type="submit" value="save" /></p>
	</body>
	
	
</html>

