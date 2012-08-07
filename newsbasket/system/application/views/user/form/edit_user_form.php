<p class='flip'><strong>edit <?php echo $user['id_user'];?></strong></p>
<form id="edit-user-form" method="post" action="<?php echo $form_action_edit;?>">
	<br />
	<table style="margin-left: 3px;">
		<tr>
			<td class="bold"><label for="name">Full Name</label></td>
			<td class="label"><input type="text" id="name" name="name" size="40px;" style="margin-left: 3px;" required="required" autofocus="autofocus" value="<?php echo $default['name']; ?>"/></td>
		</tr>
		<tr>
			<td class="label"><input type="hidden" id="old-password" name="old-password" size="40px;" style="margin-left: 3px;" required="required" value="<?php echo $default['password']; ?>"/></td>
		</tr>
		<tr>
			<td class="bold"><label for="phone">Phone</label></td>
			<td class="label"><input type="text" id="phone" name="phone" size="40px;" style="margin-left: 3px;" required="required" value="<?php echo $default['phone']; ?>" /></td>
			<td><span id="check-numeric" style="display: none;"></span></td>
		</tr>
		<tr>
			<td class="bold"><label for="new-password">New Password</label></td>
			<td class="label"><input type="password" id="new-password" name="new-password" size="40px;" style="margin-left: 3px;" /></td>
		</tr>
		<tr>
			<td class="bold"><label for="confirm-password">Retype Password</label></td>
			<td class="label"><input type="password" id="confirm-password" name="confirm-password" size="40px;" style="margin-left: 3px;" /></td>
			<td><span id="check-password" style="display: none;"></span></td>
		</tr>
		<tr>
			<td class="bold"><label for="email">Email</label></td>
			<td class="label"><input type="email" id="email" name="email" size="40px;" style="margin-left: 3px;" required="required" value="<?php echo $default['email']; ?>" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align="right">
				<input type="submit" name="btn-edit-user" class="button" value="Save" />
				<!--<button id="btn-add-user" type="button" onclick="">Add</button>-->
				<button class="button" onclick="location.href='<?php echo site_url('user/manage_user/detail_user'.'/'.$user['id_user']);?>'" type="button">Cancel</button>
			</td>
		</tr>
	</table>
</form>