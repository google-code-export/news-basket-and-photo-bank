		<td>&nbsp;</td>
		<h1>Delete Image</h1>
		<td>&nbsp;</td>
		<p>Delete?</p>
		<td>&nbsp;</td>
		<p><a href="<?php echo site_url("album/do_remove/".$info[0]->image_name)?>">Yes</a> | <a href="javascript:history.go(-1)">No</a></p>
		<p><img src="<?php echo base_url();?>image/galeri/<?php echo $info[0]->id_images?>" /></p>
