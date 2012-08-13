// DATE PICKER
$(function() {
	$("#from-date").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd' });
	$("#to-date").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd' });
});


// MULTIPLE CHECKBOX
var MyCheckboxes=$("#table-list :checkbox");

MyCheckboxes.change(function() {
  $("#change-flag").toggle(MyCheckboxes.is(":checked"));
});

// TABLE SORTER
$(document).ready(function() { 
		$("#article").tablesorter({sortList: [[0,0]], headers: {6:{sorter: false}}});
		$("#author").tablesorter({sortList: [[0,0]], headers: {6:{sorter: false}}});
		$("#category").tablesorter({sortList: [[0,0]], headers: {3:{sorter: false}}});
		$("#source").tablesorter({sortList: [[0,0]], headers: {3:{sorter: false}}});
		$("#user").tablesorter({sortList: [[0,0]], headers: {7:{sorter: false}}});
		$("#tag").tablesorter({sortList: [[0,0]], headers: {3:{sorter: false}}});
    } 
);  
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

//SLIDER DIV
$(document).ready(function(){
	$(".btn-add").click(function(){
		$("#add-user").slideToggle("fast");
		$("#add-category").slideToggle("fast");
		$("#add-source").slideToggle("fast");
		$("#add-author").slideToggle("fast");
		$("#add-tag").slideToggle("fast");
	});
});

$(document).ready(function(){
	$(".btn-cancel").click(function(){
		$("#add-user").slideToggle("fast");
		$("#add-category").slideToggle("fast");
		$("#add-source").slideToggle("fast");
		$("#add-author").slideToggle("fast");
		$("#add-tag").slideToggle("fast");
		$("#advance-search").slideToggle("fast");
	});
});

$(document).ready(function(){
	$("#btn-advance-search").click(function(){
		$("#advance-search").slideToggle("fast");
	});
});

$(document).ready(function(){
$(".flip1").click(function(){
    $(".panel1").slideToggle("slow");
  });
});

$(document).ready(function(){
$(".flip2").click(function(){
    $(".panel2").slideToggle("slow");
  });
});

$(document).ready(function(){
$(".flip3").click(function(){
    $(".panel3").slideToggle("slow");
  });
});

$(document).ready(function(){
$(".flip4").click(function(){
    $(".panel4").slideToggle("slow");
  });
});

$(document).ready(function(){
$(".flip5").click(function(){
    $(".panel5").slideToggle("slow");
  });
});