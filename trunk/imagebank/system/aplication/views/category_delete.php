		<td>&nbsp;</td>
		<h1>Album - Delete</h1>
		<td>&nbsp;</td>
		<p>Are you sure you wish to delete this?</p>
		<td>&nbsp;</td>
		<?php $deleteMe = $rows[0]->id_album; ?>
		<p><a href="<?php echo site_url("album/deleterow/$deleteMe")?>">Yes</a> | <a href="javascript:history.go(-1)">No</a></p>
		<hr />
		<p><span class="data-label">Title: <br /></span><?php echo $rows[0]->album_name; ?></p>
		<td>&nbsp;</td>
		<p><span class="data-label">Description: <br /></span><?php echo $rows[0]->description; ?></p>
