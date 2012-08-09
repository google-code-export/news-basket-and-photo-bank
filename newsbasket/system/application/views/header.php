<h1 id="site_name" style="color: white"> Admin News Basket</h1>
<div id="login_logout">
	<?php echo date("l, F jS Y");?> 
	| Welcome, <strong><?php echo anchor('admin/dashboard/myprofile', $username, array('class'=>'btn-home'));?></strong>
	| <a href="<?php echo site_url('login/logoutProcess');?>">Logout</a>
</div>