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
		case 'user':
			$user = 'active';
			$dashboard = $author = $category = $article = $source = $tag = '';
			break;
	}
?>
		
<div class="dashboard">
	<ul class="menu">
		<li id="dashboard"><?php echo anchor('user/dashboard', 'Dashboard', array('class'=>$dashboard));?></li>
		<ul>
			<li class="child"><a href="<?php echo site_url('user/manage_user/detail_user').'/'.$username;?>">My Profile</a></li>
		</ul>
	</ul>
</div>
<br />
<div class="user-menu">
	<ul class="menu">
		<li id="menu-article"><?php echo anchor('user/manage_article', 'Article', array('class'=>$article));?></li>
		<ul>
			<li class="child"><a href="<?php echo site_url('user/manage_article/add_article');?>">Add New Article</a></li>
		</ul>
	</ul>
</div>