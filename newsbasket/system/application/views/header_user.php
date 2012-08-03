<h1 id="site_name">
	<a href="#">News Basket | BeritaSatu</a>
</h1>
<div id="login_logout">
	<?php echo date("l, F jS Y");?> 
	| Welcome, <strong><?php echo anchor('user/manage_user/detail_user/'.$username, $username, array('class'=>'btn-home'));?></strong>
	| <a href="<?php echo site_url('login/logoutProcess');?>">Logout</a>
</div>