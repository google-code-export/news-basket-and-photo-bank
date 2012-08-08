<h2>Manage User<button class="btn-add">+ Add New User</button></h2>
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
<div id="user-table" class="table-menu" style="border: none;">
	<div class="search">
		<form id="search-by" name="search-by" action="<?php echo $form_action_search;?>" method="POST">
			Search by name : <input type="text" name="key" id="key" value="" required="required" />
			<input type="submit" name="search" id="search" value="Search" />
		</form>
	</div>
	<div class="paging">
		<?php echo (!empty($pagination))? 'Page : '.$pagination : 'Page : <a style="cursor:auto; color:black;"><strong>1</strong></a>';?>
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
			<th class="center">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$this->load->helper('text');
			$no = 0 + $start;
			foreach ($user_table as $column) {
				$deleteLink = anchor(
					'admin/manage_user/delete_user/'.$column->id_user,
					'<button>Delete</button>',
					array('class'=>'btn-delete', 'onclick'=>"return confirm('Are you sure want to delete this user?')")
				);
				$detailLink = anchor(
					'admin/manage_user/detail_user/'.$column->id_user,
					$column->id_user,
					array('class'=>'btn-detail-user')
				);
				
				($no%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class='$class_tr'>
						<td class='center'>$no</td>
						<td id='id-user'>$detailLink</td>
						<td>$column->source_name</td>
						<td>$column->name</td>
						<td>$column->phone</td>
						<td>$column->email</td>
						<td>$column->user_level</td>
						<td class='center'>$deleteLink</td>
					</tr>
				";
				$no++;
			}
		?>
		</tbody>
	</table>
	<div class="table-menu" style="background-color: #A7C942;">
		<div class="paging">
		<?php
			echo "<p>Showing ".$start." to ".$finish." of ".$total." users</p>" ; 
		?>
		</div>
	</div>
</div>