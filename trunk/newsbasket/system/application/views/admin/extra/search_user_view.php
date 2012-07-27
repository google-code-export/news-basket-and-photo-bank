<h2>
	<a href="<?php echo site_url('admin/manage_user');?>" style="color: white;">Manage User</a> > Search User
	<?php echo "> keyword '$key' shows result ($first_result - $last_result dari $count) :";?>
</h2>
<div id="user-table" class="table-menu">
	<div class="search">
		<form id="search-by" name="search-by" action="<?php echo $form_action_search;?>" method="GET">
			Search by username : <input type="text" name="key" id="key" required="required" />
			<input type="submit" name="search" id="search" value="Search" />
		</form>
	</div>
	<div class="paging">
	</div>
</div>
<div id="search-result" style="height: 500px; overflow-y:auto;">
	<table id="user" class="tablesorter">
		<thead> 
		<tr>
			<th>No</th>
			<th>Username</th>
			<th>Publisher</th>
			<th>Full Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Level</th>
			<th class="center" colspan="2">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		if (!empty($result) && $count != 0) {
			$No = 1;
			foreach ($result as $column) {
				$deleteLink = anchor(
					'admin/manage_user/delete_user/'.$column->id_user,
					'<button>Delete</button>',
					array('class'=>'btn-delete', 'onclick'=>"return confirm('Are you sure want to delete this user?')")
				);
				$detailLink = anchor(
					'admin/manage_user/detail_user/'.$column->id_user,
					'<button>Detail</button>',
					array('class'=>'btn-detail-user')
				);
				
				($No%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class='$class_tr'>
						<td class='center'>$No</td>
						<td id='id-user'>$column->id_user</td>
						<td>$column->source_name</td>
						<td>$column->name</td>
						<td>$column->phone</td>
						<td>$column->email</td>
						<td>$column->user_level</td>
						<td class='center'>$detailLink</td>
						<td class='center'>$deleteLink</td>
					</tr>
				";
				$No++;
			}
		}
		else {
			echo "<h3 style='font-size: 16px; padding: 10px'>No result, try different keywords</h3>";
		}
	?>
		</tbody>
	</table>
</div>