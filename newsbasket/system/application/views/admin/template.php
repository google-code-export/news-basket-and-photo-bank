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
		
		/*MENAMBAH DATA USER
		function addUser(){
			var dataForm = $("#form-user").serialize();
			$.ajax({
				type	: "POST",
				url		: "manage_user/addUser",
				data	: dataForm,
				success	: function(data){
							$("#message").html(data);
							$("#message").hide();
							$("#message").fadeIn();
						},
				error	: function(){
							alert("Error.");
						}		
			});
		}*/
		
		/*MENGHAPUS USER
		function deleteUser() {
			var x;
			var r=confirm("Press a button!");
			if (r==true) {
				$().load("manage_user/deleteUser/");
			}
			else {
			}
		}
		
		MENAMPILKAN FORM MENAMBAH DATA USER
		function formAddUser(){
			$("#add-user").load("manage_user/add_user");
			$("title").text("Add User | Admin News Basket");
		}
		
		function backManageUser(){
			$("#main").load("manage_user/defaults");
			$("title").text("Manage User | Admin News Basket");
		}*/
		
		$(document).ready(function(){
			$("#btn-add-user").click(function(){
				$("#add-user").slideToggle("fast");
				$("#add-user").css({"display":"block"});
			  });
		});
		
		$(document).ready(function(){
			$("#btn-cancel-user").click(function(){
				$("#add-user").slideToggle("fast");
			  });
		});
</script>
</head>

<body>
	<?php $this->load->view('header'); ?>
	<?php $this->load->view('admin_navigation'); ?>
	<div id="main" class="main">
		<?php $this->load->view($main_view); ?>
	</div>
	<?php $this->load->view('footer'); ?>
</body>

</html>