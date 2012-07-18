<form id="edit-author-form" method="post" action="<?php echo $form_action_edit; ?>">
	<table id="table-edit-author" class="table-form">
		<tr>			
			<td><label for="name">Full Name</label></td>
			<td>:</td>
			<td><input type="text" id="name" name="name" required="required" autofocus="autofocus" value="<?php echo $default['name']; ?>"/></td>
			<td>&nbsp;</td>
			
			<td class="label"><label for="old-password">Old Password</label></td>
			<td>:</td>
			<td><input type="text" id="old-password" name="old-password" required="required" value="<?php echo $default['password']; ?>"/></td>
			<td>&nbsp;</td>

			<td class="label"><label for="phone">Phone</label></td>
			<td>:</td>
			<td><input type="text" id="phone" name="phone" required="required" value="<?php echo $default['phone']; ?>" /></td>
			<td><span id="check-numeric" style="display: none;"></span></td>
			
			<td class="label"><label for="publisher">Publisher</label></td>
			<td>:</td>
			<td>
				<select id="publisher" name="publisher">
				<?php
				foreach ($navigasi['publisher'] as $column) {
					if ($column->id_source == $default['publisher']) {
						echo "<option value='$column->id_source' SELECTED>$column->source_name</option>";
					}
					else {
						echo "<option value='$column->id_source'>$column->source_name</option>";
					}
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="new-password">New Password</label></td>
			<td>:</td>
			<td><input type="password" id="new-password" name="new-password" /></td>
			<td>&nbsp;</td>
			
			<td class="label"><label for="confirm-password">Retype Password</label></td>
			<td>:</td>
			<td><input type="password" id="confirm-password" name="confirm-password"/></td>
			<td><span id="check-password" style="display: none;"></span></td>
			
			<td class="label"><label for="email">Email</label></td>
			<td>:</td>
			<td><input type="email" id="email" name="email" required="required" value="<?php echo $default['email']; ?>"/></td>
			<td>&nbsp;</td>

			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">
				<input type="submit" name="btn-edit-author" value="Edit" />
				<button class="btn-cancel-edit" onclick="location.href='<?php echo site_url('admin/manage_author');?>'" type="button">Cancel</button>
			</td>
		</tr>
	</table>
</form>