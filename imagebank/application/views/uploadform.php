<html>
	<title>upload Form</title>
	<body>
<?php  echo form_open_multipart('user/picupload');?>
<?=form_hidden('project_id',"1"); ?>
<fieldset>
	<legend>Add Image</legend>
	<p> Title:<br /><input type="text" name="title" /></p>
	<p>Description <br /><textarea name="caption" rows="3" cols="20"></textarea></p>
	<p>File: <input type="file" name="file_name"/></p>
	
	<h3> Select categories</h3>
	<?php 
	foreach ($category as $row ) {
		
	echo " <input type='checkbox' name= '$row->category' value='$row->id_category'/>$row->category<br/>";
	
	}	
	 ?>
	
	<p><input type="submit" value="upload" /></p>
</fieldset>
</form>
</body>
</html>