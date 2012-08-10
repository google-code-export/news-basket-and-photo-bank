<br />
<div class="dashboard">
	<ul class="menu">
		<li id="dashboard"><?php echo ($active == 'dashboard' || $active == 'profile')? anchor('admin/dashboard', 'Dashboard', array('class'=>'active')) : anchor('admin/dashboard', 'Dashboard');?></li>
		<ul>
			<li class="child"><?php echo ($active == 'profile')? anchor('admin/dashboard/myprofile', 'My Profile', array('class'=>'active')) : anchor('admin/dashboard/myprofile', 'My Profile');?></li>
		</ul>
	</ul>
</div>
<br />
<div class="user-menu">
	<ul class="menu">
		<li id="menu-article"><?php echo ($active == 'article')? anchor('admin/manage_article', 'Article', array('class'=>'active')) : anchor('admin/manage_article', 'Article');?></li>
		<li id="menu-author"><?php echo ($active == 'author')? anchor('admin/manage_author', 'Author', array('class'=>'active')) : anchor('admin/manage_author', 'Author');?></li>
		<li id="menu-category"><?php echo ($active == 'category')? anchor('admin/manage_category', 'Category', array('class'=>'active')) : anchor('admin/manage_category', 'Category');?></li>
		<li id="menu-user"><?php echo ($active == 'user')? anchor('admin/manage_user', 'User', array('class'=>'active')) : anchor('admin/manage_user', 'User');?></li>
		<li id="menu-source"><?php echo ($active == 'source')? anchor('admin/manage_source', 'Source', array('class'=>'active')) : anchor('admin/manage_source', 'Source');?></li>
		<li id="menu-tag"><?php echo ($active == 'tag')? anchor('admin/manage_tag', 'Tag', array('class'=>'active')) : anchor('admin/manage_tag', 'Tag');?></li>
	</ul>
</div>