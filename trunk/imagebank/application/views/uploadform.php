<html>
	<title>upload Form</title>
	<body>
<?php  echo form_open_multipart('upload/picupload');?>
<?=form_hidden('project_id',"1"); ?>
<fieldset>
	<legend>Add Image</legend>
	<p> Title:<br /><input type="text" name="title" /></p>
	<p>Description <br /><textarea name="description" rows="3" cols="20"></textarea></p>
	<p>File: <input type="file" name="file_name"/></p>
	<p><input type="submit" value="upload" /></p>
</fieldset>
</form>
</body>
</html>