	<td>&nbsp;</td>
	<h1>Album</h1>
	<a class="btn btn-primary" href="album/add">Add New</a>
		<table class="table-bordered" cellpadding="4" cellspacing="1" border="0" bgcolor="#cccccc" width="100%">
			<tr>
				<td  bgcolor="#cccccc" style="text-align: center"><strong>Categories</strong></td>
			</tr>
		<?php if(isset($rows)) {
			foreach($rows as $r) { ?>
			<tr onmouseover="this.bgColor='#dddddd'" onmouseout ="this.bgColor='#ffffff'" bgcolor="#ffffff">
				<td class="meta"><?php echo $r->album_name; ?></td>
				<td class="meta" width="200"><a class="btn btn-primary" href="
				<?
				if ($this->session->userdata('user_level') == 'administrator') {
					echo site_url("album/images/".$r->id_album);
					} 
					else {
					echo site_url("album_user/images/".$r->id_album);}
				?>
				">Manage Images</a></td>
				<td class="meta" width="150"><a class="btn btn-primary" href="				
				<?
				if ($this->session->userdata('user_level') == 'administrator') {
					echo site_url("album/view/".$r->id_album);
					} 
					else {
					echo site_url("album_user/view/".$r->id_album);}
				?>
				">View</a></td>
				<td class="meta" width="150"><a class="btn btn-primary" href="
				<?
				if ($this->session->userdata('user_level') == 'administrator') {
					echo site_url("album/update/".$r->id_album);
					} 
					else {
					echo site_url("album_user/update/".$r->id_album);}
				?>
				">Edit</a></td>
				<td class="meta" width="150"><a class="btn btn-primary" href="
				<?
				if ($this->session->userdata('user_level') == 'administrator') {
					echo site_url("album/delete/".$r->id_album);
					} 
					else {
					echo site_url("album_user/delete/".$r->id_album);}
				?>
				">Delete</a></td>
			</tr>
			
		<?php } } ?>
		</table>
		&nbsp;</td>
		&nbsp;</td>
			<div class="paging">
			<?php echo (!empty($pagination))? 'Page : '.$pagination : 'Page : <a style="cursor:auto; color:black;"><strong>1</strong></a>';?>
			</div>