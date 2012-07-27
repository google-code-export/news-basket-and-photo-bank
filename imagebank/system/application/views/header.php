
<h1 id="site_name">
	<a href="#">Image Bank | <img src="<?php echo base_url().'images/logo image bank.png';?>" width="150" style="float: right; position: absolute; z-index: 1; top: 3px; left:120px;"></a>
</h1>
<div id="search">
	<form id="siteSearch" class="autocomplete" role="search" action="" method="get">
	<input id="siteSearch" class="hint" type="text" size="20" placeholder="Image Search" autocomplete="off"  />
	<input type="hidden"  name ="placeholder" value="1"/>
	
	</form>
</div>
<div id="login_logout">
	Logged in as:
	<a href="#"><strong><?php echo $username?></strong></a>
	<a href="<?php echo site_url('login/logoutProcess');?>">Logout</a>
	

</div>