<h2>Manage Author<button class="btn-add">+ Add New Author</button></h2>
<div id="add-author" class="add-form">
	<form id="add-author-form" method="post" action="<?php echo $form_action; ?>">
		<table id="table-edit-author" class="table-form">
			<tr>
				<td><label for="id-author">ID Author</label></td>
				<td>:</td>
				<td><input type="text" id="id-author" name="id-author" required="required" autofocus="autofocus" /></td>
				<td><span id="check-author" style="display: none;"></span></td>
				
				<td class="label"><label for="name">Full Name</label></td>
				<td>:</td>
				<td><input type="text" id="name" name="name" required="required" /></td>
				<td>&nbsp;</td>
				
				<td class="label"><label for="publisher">Publisher</label></td>
				<td>:</td>
				<td>
					<select id="publisher" name="publisher">
					<?php
					foreach ($publisher as $column) {
						echo "
						<option value='$column->id_source'>$column->source_name</option>
						";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label"><label for="email">Email</label></td>
				<td>:</td>
				<td><input type="email" id="email" name="email" required="required" /></td>
				<td>&nbsp;</td>
				
				<td class="label"><label for="phone">Phone</label></td>
				<td>:</td>
				<td><input type="text" id="phone" name="phone" required="required" /></td>
				<td><span id="check-numeric" style="display: none;"></span></td>
				
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td align="right">
					<input type="submit" name="btn-add-author" value="Add" />
					<button class="btn-cancel" type="button">Cancel</button>
				</td>
			</tr>
			
		</table>
	</form>
</div>
<div id="edit-author">
	<?php
		!empty($form_edit_author)? $this->load->view($form_edit_author) : '';
	?>
</div>
<div id="author-table" class="table-menu" style="border: none;">
	<div class="search">
		<form id="search-by" name="search-by" action="<?php echo $form_action_search;?>" method="GET" style="float: right;">
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
<div id="table-list" class="table-list2">
	<table id="author" class="tablesorter">
		<thead> 
		<tr>
			<th class="center">No</th>
			<th>ID Author</th>
			<th>Publisher</th>
			<th>Full Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th class="center" colspan="2">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$this->load->helper('text');
			$no = 0 + $start;
			foreach ($author_table as $column) {
				$deleteLink = anchor(
					'admin/manage_author/delete_author/'.$column->id_author,
					'<button>Delete</button>',
					array('class'=>'btn-delete', 'onclick'=>"return confirm('Are you sure want to delete this author?')")
				);
				$editLink = anchor(
					'admin/manage_author/edit_author/'.$column->id_author,
					'<button>Edit</button>',
					array('class'=>'btn-edit-author')
				);
				
				($no%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td class='center'>$no</td>
						<td id='id-author'>$column->id_author</td>
						<td>$column->source_name</td>
						<td>$column->name</td>
						<td>$column->phone</td>
						<td>$column->email</td>
						<td class='center'>$editLink</td>
						<td class='center'>$deleteLink</td>
					</tr>
				";
				$no++;
			}
		?>
		</tbody>
	</table>
</div>
<div class="table-bottom">
	<div class="paging">
	<?php
		echo "<p>Showing ".$start." to ".$finish." of ".$total." authors</p>" ; 
	?>
	</div>
</div>