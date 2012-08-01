

	
				

		
	<div class="well">
		<?php  echo form_open('gallery/updateImage/'.$images->id_images);?>
		<h2>Edit Title And Caption</h2>
		<fieldset>	
	<p> Title:<br /><input type="text" name="title" value="<?php echo $images->title;?>" /></p>
	<p>Caption <br /><textarea name="caption" rows="6" cols="25" /><?php echo $images->caption;?></textarea></p>	
	<p>Keyword<br/><input type="text" name="tag" value="<?php echo $tag;?>" /></p>	
		

		<p><button id="submit" class="btn btn-primary" value="submit" type="submit" name="submit">save</button></p>
	
	</fieldset>
	</div>


