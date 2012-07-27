<div class="image-gallery">
	<h3 class="menu">Image Gallery</h3>
	<ul>
		<li><a href="<?php echo site_url('gallery');?>">All</a></li>
		<li><a href="http://csandre.wordpress.com/category/belajar/">Wires</a></li>
		<!--<li class="children"><a href="http://csandre.wordpress.com/category/belajar/">AFP</a></li>
		<li class="children"><a href="http://csandre.wordpress.com/category/belajar/">ANTARA</a></li>-->
		<li><a href="http://csandre.wordpress.com/category/belajar/">Publisher</a></li>
		<!--<li class="children"><a href="http://csandre.wordpress.com/category/belajar/">beritasatu.com</a></li>-->
	</ul>
</div>
<div class="my-images">
	<h3 class="menu">My Images</h3>
	<ul>
		<li><a href="<?php echo site_url('album/index');?>">My Gallery</a></li>
		<li><a href="<?php echo site_url('user/upload');?>">Upload</a></li>
	</ul>
</div>
<div class="my-profile">
	<h3 class="menu">My Profile</h3>
	<ul>
		<li class="parent"><a href="http://csandre.wordpress.com/category/belajar/">Change Profile</a>
	</ul>
</div>
<div class="admin-menu">
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manageCategory');?>'">Categories</h3>
	<ul>
		<?php
		//foreach($navigasi['category'] as $column) {
			//$link = site_url('admin/manage_user/loadUsers').'/'.$column->id_category;
			//echo "
				//<li class='parent'><a href='$link'>$column->category_name</a></li>
			//";
		//}
		?>
	</ul>
	
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manageUser');?>'">Users</h3>
	<ul>
		<!--<li class="none">By Publisher</li>-->
		<?php
		//foreach($navigasi['publisher'] as $column) {
		//	$link = site_url('admin/manage_user/loadUsers').'/'.$column->id_source;
		//	echo "
		//		<li class='children'><a href='$link'>$column->source_name</a></li>
		//	";
		//}
		?>
		<!--<li class="none">By Level</li>
		<li class="parent"><a href="<?php //echo site_url('admin/manage_user/loadUsers/viewer');?>">Viewer</a></li>
		<li class="parent"><a href="<?php //echo site_url('admin/manage_user/loadUsers/reporter');?>">Reporter</a></li>
		<li class="parent"><a href="<?php //echo site_url('admin/manage_user/loadUsers/editor');?>">Editor</a></li>
		<li class="parent"><a href="<?php //echo site_url('admin/manage_user/loadUsers/publisher');?>">Publisher</a></li>
		<li class="parent"><a href="<?php //echo site_url('admin/manage_user/loadUsers/administrator');?>">Administrator</a></li>-->
	</ul>
	
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manageSource');?>'">Sources</h3>
	<ul>
		<!--<li class="none">By Publisher</li>
		<?php
		//foreach($navigasi['publisher'] as $column) {
		//	$link = site_url('admin/manage_user/loadUsers').'/'.$column->id_source;
		//	echo "
		//		<li class='children'><a href='$link'>$column->source_name</a></li>
		//	";
		//}
		?>
		<li class="none">By Level</li>
		<li class="parent"><a href="<?php //echo site_url('admin/manage_source/loadSources/wires');?>">Wires</a></li>
		<li class="parent"><a href="<?php //echo site_url('admin/manage_source/loadSources/publisher');?>">Publisher</a></li>-->
	</ul>
</div>