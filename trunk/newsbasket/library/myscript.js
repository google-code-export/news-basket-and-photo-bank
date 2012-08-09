/* XPATH XML
function loadXMLDoc(dname) {
	if (window.XMLHttpRequest) {
		xhttp=new XMLHttpRequest();
	}
	else {
		xhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhttp.open("GET",dname,false);
	xhttp.send("");
	return xhttp.responseXML;
}

xml=loadXMLDoc("books.xml");
path="/bookstore/book/title";

// code for IE
if (window.ActiveXObject) {
	var nodes=xml.selectNodes(path);

	for (i=0;i<nodes.length;i++) {
		document.write(nodes[i].childNodes[0].nodeValue);
		document.write("<br />");
	}
}
// code for Mozilla, Firefox, Opera, etc.
else if (document.implementation && document.implementation.createDocument) {
	var nodes=xml.evaluate(path, xml, null, XPathResult.ANY_TYPE,null);
	var result=nodes.iterateNext();

	while(result) {
		document.write(result.childNodes[0].nodeValue);
		document.write("<br />");
		result=nodes.iterateNext();
	}
}*/

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

//MENGECEK USERNAME YANG ADA
$(document).ready(function() {
	$("#username").blur(function() {
		//remove all the class, add new classes and start fading
		$("#check-user").removeClass().addClass('image-load').text('AA').fadeIn("fast");
		//check the username exists or not from ajax
		$.post("http://localhost/newsbasket/admin/manage_user/checkUsernameAvailability",{ username:$(this).val() } ,function(data) {
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
		$.post("http://localhost/newsbasket/admin/manage_user/checkConfirmationPassword",{ password:$("#password").val(), confirm_password:$("#confirm-password").val() } ,function(data) {
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
		$.post("http://localhost/newsbasket/admin/manage_user/checkPhoneNumber",{ phone:$("#phone").val() } ,function(data) {
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

//SLIDER DIV ADD NEW USER
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