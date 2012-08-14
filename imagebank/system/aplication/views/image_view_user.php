		<td>&nbsp;</td>
		<h1><?php echo $info[0]->album_name;?> - Images</h1>
		<td>&nbsp;</td>
		<a class="btn btn-primary" href="<?=site_url("user/upload")?>">Upload New Image</a>
		<td>&nbsp;</td>
		<?php if(!isset($rows)) { ?>
		<p>There are no images to display</p>
		<?php } else { ?>
		<table cellpadding="5" cellspacing="1" border="0" bgcolor="#cccccc" width="100%">
		<tr>
			<td><strong>Image</strong></td>
			<td><strong>Caption</strong></td>
			<td colspan="2"><strong>Action</strong></td>
		</tr>
		<?php foreach($rows as $r) : ?>
		<tr>
			<td class="gallerypic" bgcolor="#ffffff" width="70"><a href="<?php echo base_url()."gallery/detail_foto_user/".$r->id_images;?>"><img src="<?php echo base_url()."images/galeri/thumbs/".$r->thumbnail;?>" /></td>
			<td bgcolor="#ffffff" width="150"><?php echo $r->caption;?></td>
			<td class="meta" bgcolor="#ffffff" width="70"><a class="btn btn-primary" href="<?php echo site_url("gallery/updateImage/".$r->id_images)?>">Edit</a></td>
			<td class="meta" bgcolor="#ffffff" width="70"><a class="btn btn-primary" href="<?php echo site_url("album_user/removeimage/".$r->id_images)?>">Delete</a></td>
		</tr>
		<?php endforeach; ?>
		</table>
		<?php } ?>
		&nbsp;</td>
		&nbsp;</td>
			<div class="paging">
			<?php echo (!empty($pagination))? 'Page : '.$pagination : 'Page : <a style="cursor:auto; color:black;"><strong>1</strong></a>';?>
			</div>

		
