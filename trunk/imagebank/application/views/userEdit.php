<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 
<title>Edit Users</title>

<link href="<?php echo base_url(); ?>css/edit_user.css" rel="stylesheet" type="text/css" />	 
	<link href="<?php echo base_url(); ?>style/calendar.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>script/calendar.js"></script>
	 
</head>

<body>
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<?php echo $message;?>
		<form method="post" action "<?php echo $action; ?>;">
			<div class="data">
				<table>
					<tr>
						<td valign="top"> Name <span style="color: red"></span></td>
						<td> <input type="text" name="name"  class="text" value="<?php echo $this->load->validation->username; ?>"/>
					<?php echo $this->validation->username_error; ?></td>
					</tr>
					<tr>
						<td valign="top"> status <span style="color: red"></span></td>
						<td> <input type="text" name="status"  class="text" value="<?php echo $this->load->validation->status; ?>"/>
					<?php echo $this->validation->status; ?></td>
							<?php echo $this->validation->status_error; ?>
						</td>	
						</tr>
						<tr>
						<td valign="top"> email <span style="color: red"></span></td>
						<td> <input type="text" name="email"  class="text" value="<?php echo $this->load->validation->email; ?>"/>
					<?php echo $this->validation->email; ?></td>
							<?php echo $this->validation->email_error; ?>
						</td>	
						</tr>
						 <tr>
                <td>&nbsp;</td>
               <td><input type="submit" value="Save"/></td>
	            </tr>
				</table>
			</div>
	</form>
	</body>