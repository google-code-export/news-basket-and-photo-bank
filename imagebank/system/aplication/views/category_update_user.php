
	<h2>Category - Edit</h2>
	<div id="work-update" class="form-page">
		<form action="<?php echo site_url("album_user/updatecat")."/".$rows[0]->id_album?>" method="post" name="insert_work">
			<div>
				<span>Title:<br /></span>
				<input type="text" name="album_name" id="album_name" value="<?php echo $rows[0]->album_name; ?>" />
			</div>
			<div>
				<span>Description:<br /></span>
				<textarea name="description" id="description"><?php echo $rows[0]->description; ?></textarea>
			</div>
			<div>
				<input type="hidden" name="id" value="<?php echo $this->uri->segment(3)?>">
				<input type="submit" value="Submit" id="submit" />
			</div>
		</div>
		</form>
