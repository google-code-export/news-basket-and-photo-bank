<div class="image-gallery">
	<h3 class="menu">Image Gallery</h3>
	<ul>
		<li><a href="<?php echo site_url('gallery/tampil_foto');?>">All</a></li>
		<li><a href="<?php echo site_url('gallery/tampil_wire'); ?>">Wires</a></li>
		<li><a href="<?php echo site_url('gallery/tampil_publisher'); ?>">Publisher</a></li>
	</ul>
</div>
<div class="my-images">
	<h3 class="menu">My Images</h3>
	<ul>
		<li><a href="<?php echo site_url('album');?>">My Gallery</a></li>
		<li><a href="<?php echo site_url('user/upload');?>">Upload</a></li>
	</ul>
</div>
<div class="my-profile">
	<h3 class="menu" onclick="location.href='<?php echo site_url('manage_user/detail_user').'/'.$username;?>'">My Profile</h3>
</div>
<div class="admin-menu">
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manageCategory');?>'">Categories</h3>
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manageUser');?>'">Users</h3>
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manageSource');?>'">Sources</h3>
</div>