<br />
<br />
<?php
	switch($active) {
		case 'dashboard':
			$dashboard = 'active';
			$article = $author  = $category = $user = $source = $tag = '';
			break;
		case 'article':
			$article = 'active';
			$dashboard = $author  = $category = $user = $source = $tag = '';
			break;
		case 'author':
			$author  = 'active';
			$dashboard = $article = $category = $user = $source = $tag = '';
			break;
		case 'category':
			$category = 'active';
			$dashboard = $author = $article = $user = $source = $tag = '';
			break;
		case 'user':
			$user = 'active';
			$dashboard = $author = $category = $article = $source = $tag = '';
			break;
		case 'source':
			$source = 'active';
			$dashboard = $author = $category = $user = $article = $tag = '';
			break;
		case 'tag':
			$tag = 'active';
			$dashboard = $author = $category = $user = $source = $article = '';
			break;
	}
?>
		
<div class="dashboard">
	<ul class="menu">
		<li id="dashboard"><?php echo anchor('admin/dashboard', 'Dashboard', array('class'=>$dashboard));?></li>
		<ul>
			<li class="child"><a href="<?php echo site_url('admin/manage_user/detail_user').'/'.$username;?>">My Profile</a></li>
			<li class="child"><a href="<?php echo site_url('login/logoutProcess');?>">Logout</a></li>
		</ul>
	</ul>
</div>
<br />
<div class="user-menu">
	<ul class="menu">
		<li id="menu-article"><?php echo anchor('admin/manage_article', 'Article', array('class'=>$article));?></li>
		<li id="menu-author"><?php echo anchor('admin/manage_author', 'Author', array('class'=>$author));?></li>
		<li id="menu-category"><?php echo anchor('admin/manage_category', 'Category', array('class'=>$category));?></li>
		<li id="menu-user"><?php echo anchor('admin/manage_user', 'User', array('class'=>$user));?></li>
		<li id="menu-source"><?php echo anchor('admin/manage_source', 'Source', array('class'=>$source));?></li>
		<li id="menu-tag"><?php echo anchor('admin/manage_tag', 'Tag', array('class'=>$tag));?></li>
	</ul>
</div>