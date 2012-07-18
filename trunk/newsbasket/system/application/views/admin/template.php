<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title><?php echo $page_title;?></title>
    <meta charset="utf-8" />
    <meta name="description" content="Manage News Basket" />
    <meta name="author" content="BeritaSatu" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/template.css';?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/admin.css';?>" />
	<script type="text/javascript" src="<?php echo base_url().'/library/jquery.js'; ?>"></script> 
	<!--<script type="text/javascript" src="<?php echo base_url().'/library/tablesorter/jquery.tablesorter.js'; ?>"></script>-->
	<script  type="text/javascript">
		/*TABLE SORTER
		$(document).ready(
			function() {$("#myTable").tablesorter();}
		);
		$(document).ready(
			function() {$("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} );} 
		);*/
		
		//MENGECEK USERNAME YANG ADA
		$(document).ready(function() {
			$("#username").blur(function() {
				//remove all the class, add new classes and start fading
				$("#check-user").removeClass().addClass('image-load').text('AA').fadeIn("fast");
				//check the username exists or not from ajax
				$.post("manage_user/checkUsernameAvailability",{ username:$(this).val() } ,function(data) {
					if(data=='no') { //if username not avaiable
						$("#check-user").fadeTo(200,0.1,function() { //start fading the messagebox
							//add message and change the class of the box and start fading
							$(this).html('AA').removeClass().addClass('image-no').fadeTo(900,1); //AA kontem html sembarang
						});		
					}
					else {
						$("#check-user").fadeTo(200,0.1,function() { //start fading the messagebox
							//add message and change the class of the box and start fading
							$(this).html('AA').removeClass().addClass('image-yes').fadeTo(900,1); //AA kontem html sembarang
						});
					}		
				});
			});
		});
		
		//MENGECEK KONFIRMASI PASSWORD
		$(document).ready(function() {
			$("#confirm-password").blur(function() {
				//remove all the class, add new classes and start fading
				$("#check-password").removeClass().addClass('image-load').text('AA').fadeIn("fast");
				//check the username exists or not from ajax
				$.post("manage_user/checkConfirmationPassword",{ password:$("#password").val(), confirm_password:$("#confirm-password").val() } ,function(data) {
					if(data=='no') { //if password not same
						$("#check-password").fadeTo(200,0.1,function() { //start fading the messagebox
							//add message and change the class of the box and start fading
							$(this).html('AA').removeClass().addClass('image-no').fadeTo(900,1); //AA kontem html sembarang
						});		
					}
					else {
						$("#check-password").fadeTo(200,0.1,function() { //start fading the messagebox
							//add message and change the class of the box and start fading
							$(this).html('AA').removeClass().addClass('image-yes').fadeTo(900,1); //AA kontem html sembarang
						});
					}		
				});
			});
		});
		
		//MENGECEK NOMOR TELEPON
		$(document).ready(function() {
			$("#phone").blur(function() {
				//remove all the class, add new classes and start fading
				$("#check-numeric").removeClass().addClass('image-load').text('AA').fadeIn("fast");
				//check the username exists or not from ajax
				$.post("manage_user/checkPhoneNumber",{ phone:$("#phone").val() } ,function(data) {
					if(data=='no') { //if phone not numeric
						$("#check-numeric").fadeTo(200,0.1,function() { //start fading the messagebox
							//add message and change the class of the box and start fading
							$(this).html('AA').removeClass().addClass('image-no').fadeTo(900,1); //AA konten html sembarang
						});		
					}
					else {
						$("#check-numeric").fadeTo(200,0.1,function() { //start fading the messagebox
							//add message and change the class of the box and start fading
							$(this).html('AA').removeClass().addClass('image-yes').fadeTo(900,1); //AA konten html sembarang
						});
					}		
				});
			});
		});
		
		//VALIDASI FORM TERAKHIR
		function validateForm() {
			var username = document.forms["add-user-form"]["username"].value;
			var password = document.forms["add-user-form"]["password"].value;
			var confirm_password = document.forms["add-user-form"]["confirm-password"].value;
			var name  = document.forms["add-user-form"]["name"].value;
			var phone = document.forms["add-user-form"]["phone"].value;
			var email = document.forms["add-user-form"]["email"].value;
			if	(username == null || username == "" || password == null || username == "" ||
				confirm_password == null || confirm_password == "" ||	name == null || name == "" ||
				phone == null || phone == "" || email == null || email == "")
				{
				alert("First name must be filled out");
				return false;
			}
		}
		
		//MENYIMPAN DATA USER
		function saveUser(id) {
			var dataForm = $("#form-edit").serialize();
			$.ajax({
				type	: "POST",
				url		: "simpanSiswa.php",
				data	: dataForm+"&id_siswa="+id,
				success	: function(data){
							$("#pesan").html(data);
							$("#pesan").hide();
							$("#pesan").fadeIn();
						},
				error	: function(){
							alert("Terjadi kesalahan saat proses data.");
						}
			});
		
		}
		
		//FORM MENGEDIT DATA SISWA
		function editUser(id_user) {
			$.ajax({
				type	: "POST",
				url		: "manage_user/editUser/"+id_user,
				data	: "id_user="+id_user,
				success	: function(data){
							$("#edit-user").html(data);
							$("title").text("Edit Data User");
						},
				error	: function(){
							alert("Terjadi kesalahan saat proses data.");
						}
			});
		}
		function formEditUser(id_user){
			$("#edit-user").load("manage_user/editUser/"+id_user);
		}
		//SLIDER DIV ADD NEW USER
		$(document).ready(function(){
			$(".btn-add").click(function(){
				$("#add-user").slideToggle("fast");
				$("#add-category").slideToggle("fast");
				$("#add-source").slideToggle("fast");
				$("#add-author").slideToggle("fast");
			});
		});
		
		$(document).ready(function(){
			$(".btn-cancel").click(function(){
				$("#add-user").slideToggle("fast");
				$("#add-category").slideToggle("fast");
				$("#add-source").slideToggle("fast");
				$("#add-author").slideToggle("fast");
			});
		});
</script>
</head>

<body>
	<?php $this->load->view('header'); ?>
	<div class="navigation">
		<?php $this->load->view('admin_navigation'); ?>
	</div>
	<div id="main" class="main">
		<?php $this->load->view($main_view); ?>
	</div>
	<?php $this->load->view('footer'); ?>
</body>

</html>