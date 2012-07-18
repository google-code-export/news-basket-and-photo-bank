<h2>Manage Source<button class="btn-add" style="float: right; height: 30px; margin-top: -2px;">+ Add New Source</button></h2>
<div id="add-source" class="add-form">
	<form id="add-source-form" method="post"  onsubmit="return validateForm()" action="<?php echo $form_action; ?>">
		<table id="source-form" class="table-form">
			<tr>
				<td><label for="id-source">ID Source</label></td>
				<td>:</td>
				<td><input type="text" id="id-source" name="id-source" required="required" autofocus="autofocus" /></td>
				<td><span id="check-source" style="display: none;"></span></td>
				
				<td class="label"><label for="source-name">Source Name</label></td>
				<td>:</td>
				<td><input type="text" id="source-name" name="source-name" required="required" /></td>	
				
				<td class="label"><label for="source-type">Source Type</label></td>
				<td>:</td>
				<td>
					<select id="source-type" name="source-type">
						<option value='1'>wires</option>
						<option value='2'>publisher</option>
					</select>
				</td>	
				
				<td class="label">	
					<input type="submit" name="btn-add-source" value="Add" />
					<button class="btn-cancel" type="button">Cancel</button>
				</td>
			</tr>
			
		</table>
	</form>
</div>
<div id="edit-user" class="edit-form">
	<?php
		!empty($form_edit_source)? $this->load->view($form_edit_source) : '';
	?>
</div>
<div id="source-table" class="table-menu">
	<div class="search">
	</div>
	<div class="paging">
	</div>
</div>
<?php
	$message_success = $this->session->flashdata('message_success');
	echo !empty($message_success) ? "<p class='success'>" . $message_success . "</p>": "";
	$message_failed = $this->session->flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>": "";
?>
<div id="myTable" class="tablesorter">
	<table id="zebra">
		<tr>
			<th>No</th>
			<th>ID Source</th>
			<th>Source Name</th>
			<th>Source Type</th>
			<th class="center" colspan="2">Action</th>
		</tr>
		<?php
			$No = 1;
			foreach ($source_table as $column) {
				$deleteLink = anchor(
					'admin/manage_source/deleteSource/'.$column->id_source,
					'<button>Delete</button>',
					array('class'=>'delete', 'onclick'=>"return confirm('Are you sure want to delete this source?')")
				);
				$editLink = anchor(
					'admin/manage_source/editSource/'.$column->id_source,
					'<button>Edit</button>',
					array('class'=>'btn-edit-source')
				);
				
				($No%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td>$No</td>
						<td id='id-source'>$column->id_source</td>
						<td>$column->source_name</td>
						<td>$column->source_type</td>
						<td class='center'>$editLink</td>
						<td class='center'>$deleteLink</td>
					</tr>
				";
				$No++;
			}
		?>
	</table>
</div>