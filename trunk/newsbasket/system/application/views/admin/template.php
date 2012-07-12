<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title>Manage User | Admin News Basket</title>
    <meta charset="utf-8" />
    <meta name="description" content="Manage News Basket" />
    <meta name="author" content="BeritaSatu" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/template.css';?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/admin.css';?>" />
	<script type="text/javascript" src="../library/tablesorter/jquery-latest.js"></script> 
	<script type="text/javascript" src="../library/tablesorter/jquery.tablesorter.js"></script>
	<script  type="text/javascript">
		//TABLE SORTER
		$(document).ready(
			function() {$("#myTable").tablesorter();}
		);
		$(document).ready(
			function() {$("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} );} 
		);
		
		//MENAMPILKAN FORM MENAMBAH DATA USER
		function formAddUser(){
			$("#main").load("manage_user/add_user");
			$("title").text("Add User | Admin News Basket");
		}
		
		function backManageUser(){
			$("#main").load("manage_user.php");
			$("title").text("Manage User | Admin News Basket");
		}
	</script>
</head>

<body>
	<?php $this->load->view('header'); ?>
	<?php $this->load->view('admin_navigation'); ?>
	<?php $this->load->view($main_content); ?>
	<?php $this->load->view('footer'); ?>
</body>

</html>