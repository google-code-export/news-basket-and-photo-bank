<p class='flip'><strong><?php echo $user['id_user']?> profile</strong>
	<a id="edit-article" href="<?php echo $form_action_edit;?>">
		<button style="float: right; margin-top: -4px;" >Edit User</button>
	</a>
</p>
<?php
	$message_success = $this->session->flashdata('message_success');
	echo !empty($message_success) ? "<p class='success'>" . $message_success . "</p>": "";
	$message_failed = $this->session->flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>": "";
?>
<br />
<table style="margin-left: 3px;">
	<tr>
		<td class="bold"><label for="id-user">ID User</label></td>
		<td class="label"><p id="id-user"><?php echo $user['id_user']?></p></td>
	</tr>	
	<tr>	
		<td class="bold"><label for="publisher">Publisher</label></td>
		<td class="label"><p id="publisher"><?php echo $user['publisher']?></p></td>
	</tr>
	<tr>
		<td class="bold"><label for="name">Full Name</label></td>
		<td class="label"><p id="name"><?php echo $user['name']?></p></td>
	</tr>	
	<tr>
		<td class="bold"><label for="phone">Phone</label></td>
		<td class="label"><p id="phone"><?php echo $user['phone']?></p></td>
	</tr>	
	<tr>
		<td class="bold"><label for="email">Email</label></td>
		<td class="label"><p id="email"><?php echo $user['email']?></p></td>
	</tr>				
	<tr>
		<td class="bold"><label for="user-level">User Level</label></td>
		<td class="label"><p id="user-level"><?php echo $user['user_level']?></p></td>
	</tr>	
</table>