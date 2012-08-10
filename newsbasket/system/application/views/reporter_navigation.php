<br />
<br />
<?php
	switch($active) {
		case 'dashboard':
			$dashboard = 'active';
			$article = $add_article = $profile = '';
			break;
		case 'article':
			$article = 'active';
			$dashboard = $add_article = $profile = '';
			break;
		case 'add_article':
			$article = $add_article = 'active';
			$dashboard = $profile = '';
			break;
		case 'reporter':
			$profile = $dashboard = 'active';
			$article = $add_article = '';
			break;
	}
?>
		
<div class="dashboard">
	<ul class="menu">
		<li id="dashboard"><?php echo anchor('reporter/dashboard', 'Dashboard', array('class'=>$dashboard));?></li>
		<ul>
			<li class="child"><?php echo anchor('reporter/manage_reporter/detail_reporter/'.$username, 'My Profile', array('class'=>$profile));?></li>
		</ul>
	</ul>
</div>
<br />
<div class="reporter-menu">
	<ul class="menu">
		<li id="menu-article"><?php echo anchor('reporter/manage_article', 'Article', array('class'=>$article));?></li>
		<ul>
			<li class="child"><?php echo anchor('reporter/manage_article/add_article', 'Add New Article', array('class'=>$add_article));?></li>
		</ul>
	</ul>
</div>