<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gmail IMAP</title>
	<meta name="title" content="Gmail and IMAP using Php" />
	<meta name="keywords" content="gmail,imap,php,remote connection,imap class" />
	<meta name="description" content="Using IMAP with php to retrieve gmail emails" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="css/custom.css" type="text/css" />
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap-tooltip.js"></script>
	<script src="bootstrap/js/bootstrap-popover.js"></script>
	<script src="bootstrap/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript">
		$(function(){
		 $("[rel=tooltip]").popover();
		 $('.subject').click(function(){
			$(this).parent('.mails_header').find('.mail_info').slideToggle();
		 });
		});
	</script>
</head>
<body>

	<div id="bodyWrapper">
	<div class="navbar">
	  <div class="navbar-inner">
		<div class="container">
			<a class="brand" href="index.php">
				Gmail IMAP Beritasatu Media Holdings
			</a>
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> Username
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Profile</a></li>
              <li class="divider"></li>
              <li><a href="#">Sign Out</a></li>
            </ul>
          </div>
	  </div>
	</div><!-- end navbar -->

	 <div class="container">
		<ul class="breadcrumb">
			<li>
				<a href="index.php?param=ALL">All</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="index.php?param=UNSEEN">UnRead</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="index.php?param=SEEN">Read</a> <span class="divider">/</span>
			</li>
		</ul>

