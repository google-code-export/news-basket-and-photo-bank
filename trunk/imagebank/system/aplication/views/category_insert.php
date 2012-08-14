	<h2>Category - Create</h2>
	<div id="work-insert" class="form-page">
		<form action="<?php echo site_url("album/insert")?>" method="post" name="insert_work">
			<div>
				<span>Title:<br /></span>
				<input type="text" name="album_name" id="album_name" value="" />
			</div>
			<div>
				<span>Description:<br /></span>
				<textarea name="description" id="description"></textarea>
			</div>
			<div>
				<input type="submit" value="Submit" id="submit" />
			</div>
		</div>
		</form>
