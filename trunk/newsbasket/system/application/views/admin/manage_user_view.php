<h2>Manage User<button class="btn-add" style="float: right; height: 30px; margin-top: -2px;">+ Add New User</button></h2>
<div id="add-user" class="add-form">
	<form id="add-user-form" method="post" action="<?php echo $form_action; ?>">
		<table id="table-edit-user" class="table-form">
			<tr>
         sosjdfjasdfasd
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
						<option value="1">viewer</option>
						<option value="2">reporter</option>
						<option value="3">editor</option>
						<option value="4">publisher</option>
						<option value="5">administrator</option>
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
<div id="edit-user" class="edit-form">
	<?php
		!empty($form_edit_user)? $this->load->view($form_edit_user) : '';
	?>
</div>
<div id="user-table" class="table-menu">
	<div class="search">
		<form id="search-by" name="search_by" action="" method="post">
			<input type="text" name="search_key" id="search-key" value="" required="required" />
			<input type="submit" name="search" id="search" value="Search" />
		</form>
	</div>
	<div class="paging">
		<p><?php echo !empty($pagination) ? $pagination : ''; ?></p>
		<!--<span class="disabled">
			<a class="disabled" href=#><< Prev</a>
		</span>
		<span class="current">
			<a href=#>1</a>
		</span>
		<span class="disabled">
			<a class="disabled" href=#>2</a>
		</span>
		<span class="disabled">
			<a class="disabled" href=#>3</a>
		</span>
		<span class="prevnext">
			<a href="#">Next >></a>
		</span>-->
	</div>
</div>
<?php
	$message_success = $this->session->flashdata('message_success');
	echo !empty($message_success) ? "<p class='success'>" . $message_success . "</p>": "";
	$message_failed = $this->session->flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>": "";
?>
		
<div id="myTable" class="tablesorter">
	<?php //echo ! empty($table) ? $table : ''; ?>
	<table id="zebra">
		<tr>
			<th>No</th>
			<th>Username</th>
			<th>Password</th>
			<th>Publisher</th>
			<th>Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Level</th>
			<th class="center" colspan="2">Action</th>
		</tr>
		<?php
			$No = 1;
			$this->load->helper('text');
			foreach ($user_table as $column) {
				$deleteLink = anchor(
					'admin/manage_user/deleteUser/'.$column->id_user,
					'<button>Delete</button>',
					array('class'=>'btn-delete', 'onclick'=>"return confirm('Are you sure want to delete this user?')")
				);
				$editLink = anchor(
					'admin/manage_user/editUser/'.$column->id_user,
					'<button>Edit</button>',
					array('class'=>'btn-edit-user')
				);
				
				($No%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td>$No</td>
						<td id='id-user'>$column->id_user</td>
						<td>$column->password</td>
						<td>$column->source_name</td>
						<td>$column->name</td>
						<td>$column->phone</td>
						<td>$column->email</td>
						<td>$column->user_level</td>
						<td class='center'>$editLink</td>
						<td class='center'>$deleteLink</td>
					</tr>
				";
				$No++;
			}
		?>
	</table>
</div>