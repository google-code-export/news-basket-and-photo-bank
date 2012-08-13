<div id="site_name">
	<a href="<?php echo site_url('admin/dashboard');?>"><img style="" src="<?php echo base_url().'images/logo-small.png';?>" /></a>
</div>
<div id="login_logout">
	<?php echo date("l, F jS Y");?> 
	| Welcome, <strong><?php echo anchor('user/manage_user/detail_user/'.$username, $username, array('class'=>'btn-home'));?></strong>
	| <a href="<?php echo site_url('login/logoutProcess');?>">Logout</a>
</div>