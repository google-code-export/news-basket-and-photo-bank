<div class="dashboard">
	<h3 class="menu">Dashboard</h3>
	<ul>
		<li><a href="<?php echo site_url('admin/dashboard');?>">Home</a></li>
		<li><a href="<?php echo site_url('login/logoutProcess');?>">Logout</a></li>
	</ul>
</div>
<div class="user-menu">
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manageUser');?>'">Users</h3>
	<ul>
		<!--<li class="parent"><a href="http://csandre.wordpress.com/category/belajar/">Row Article</a></li>
		<li class="parent"><a href="http://csandre.wordpress.com/category/belajar/">Edited</a></li>
		<li class="parent"><a href="http://csandre.wordpress.com/category/belajar/">Published</a></li>
		<li class="parent"><a href="http://csandre.wordpress.com/category/belajar/">Deleted</a></li>-->
	</ul>
	
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manageCategory');?>'">Categories</h3>
	<ul>
	</ul>
	
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manageGroup');?>'">Group</h3>
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
	
	<h3 class="menu" onclick="location.href='<?php echo site_url('admin/manage_source');?>'">Sources</h3>
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