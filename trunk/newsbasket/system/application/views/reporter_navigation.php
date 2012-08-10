<br />
<br />
<?php
	switch($active) {
		case 'dashboard':
			$dashboard = 'active';
			$article = $author  = $category = $reporter = $source = $tag = '';
			break;
		case 'article':
			$article = 'active';
			$dashboard = $author  = $category = $reporter = $source = $tag = '';
			break;
		case 'reporter':
			$reporter = 'active';
			$dashboard = $author = $category = $article = $source = $tag = '';
			break;
	}
?>
		
<div class="dashboard">
	<ul class="menu">
		<li id="dashboard"><?php echo anchor('reporter/dashboard', 'Dashboard', array('class'=>$dashboard));?></li>
		<ul>
			<li class="child"><a href="<?php echo site_url('reporter/manage_reporter/detail_reporter').'/'.$username;?>">My Profile</a></li>
		</ul>
	</ul>
</div>
<br />
<div class="reporter-menu">
	<ul class="menu">
		<li id="menu-article"><?php echo anchor('reporter/manage_article', 'Article', array('class'=>$article));?></li>
		<ul>
			<li class="child"><a href="<?php echo site_url('reporter/manage_article/add_article');?>">Add New Article</a></li>
		</ul>
	</ul>
</div>