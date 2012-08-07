<h2>Manage User</h2>
<div id="add-user" class="add-form">
	<form id="add-user-form" method="post" action="<?php echo $form_action; ?>">
		<table id="table-edit-user" class="table-form">
			<tr>
				<td><label for="username">Username</label></td>
				<td>:</td>
				<td><input type="text" id="username" name="username" required="required" autofocus="autofocus" /></td>
				<td><span id="check-user" style="display: none;"></span></td>
				
				<td class="label"><label for="name">Full Name</label></td>
				<td>:</td>
				<td><input type="text" id="name" name="name" required="required" /></td>
				<td>&nbsp;</td>
				
				<td class="label"><label for="phone">Phone</label></td>
				<td>:</td>
				<td><input type="text" id="phone" name="phone" required="required" /></td>
				<td><span id="check-numeric" style="display: none;"></span></td>
				
				<td class="label"><label for="level">Level</label></td>
				<td>:</td>
				<td>
					<select id="user-level" name="user-level">
						<option value="1">user</option>
						<option value="2">administrator</option>
					</select>
				</td>
			</tr>
			<tr>				
				<td><label for="password">Password</label></td>
				<td>:</td>
				<td><input type="password" id="password" name="password" required="required" /></td>
				<td>&nbsp;</td>
				
				<td class="label"><label for="confirm-password">Retype Password</label></td>
				<td>:</td>
				<td><input type="password" id="confirm-password" name="confirm-password" required="required" /></td>
				<td><span id="check-password" style="display: none;"></span></td>
				
				<td class="label"><label for="email">Email</label></td>
				<td>:</td>
				<td><input type="email" id="email" name="email" required="required" /></td>
				<td>&nbsp;</td>
				
				<td class="label"><label for="publisher">Publisher</label></td>
				<td>:</td>
				<td>
					<select id="publisher" name="publisher">
					<?php
					foreach ($navigasi['publisher'] as $column) {
						echo "
						<option value='$column->id_source'>$column->source_name</option>
						";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>&nbsp;</td><td>&nbsp;</td>
				<td align="right">
					<input type="submit" name="btn-add-user" value="Add" />
					<!--<button id="btn-add-user" type="button" onclick="">Add</button>-->
					<button class="btn-cancel" type="button">Cancel</button>
				</td>
			</tr>
			
		</table>
	</form>
</div>
<div id="user-table" class="table-menu">
	</div>
</div>
<?php
	$message_success = $this->session->flashdata('message_success');
	echo !empty($message_success) ? "<p class='success'>" . $message_success . "</p>": "";
	
	$message_failed = $this->session->flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>": "";
?>
		
<div>
	<table id="user" class="tablesorter">
		<thead> 
		<tr>
			<th class="center">No</th>
			<th>Username</th>
			<th>Publisher</th>
			<th>Full Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Level</th>
			<th class="center" colspan="2">Action</th>
		</tr>
		</thead>
	</table>
</div>