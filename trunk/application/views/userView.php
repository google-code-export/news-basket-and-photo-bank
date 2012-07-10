<!DOCTYPE html PUBLIC "-//WC//DTD XHTML 1.0 Transitional//EN" "http://www.w.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	 
	<title>SIMPLE CRUD APPLICATION</title>
	 
	<link href="<?php echo base_url(); ?>style/style.css" rel="stylesheet" type="text/css" />
	 
	</head>
	<body>
	    <div class="content">
	        <h1><?php echo $title; ?></h1>
	        <div class="data">
	        <table>
	            <tr>
                <td width="30%">ID</td>
                <td><?php echo $users->id_user; ?></td>
	            </tr>
	            <tr>
	                <td valign="top">Name</td>
	                <td><?php echo $users->username; ?></td>
	            </tr>
	            <tr>
	                <td valign="top">status</td>
	                <td><?php echo $users->status ; ?></td>
	            </tr>
           <tr>
               <td valign="top">email</td>
	                <td><?php echo $users->email ; ?></td>

            </tr>
	        </table>	        </div>
	        <br />
	        <?php echo $link_back; ?>
	    </div>
	</body>
	</html>