<h2>Manage Source<button class="btn-add">+ Add New Source</button></h2>
<div id="add-source" class="add-form">
	<form id="add-source-form" method="post"  onsubmit="return validateForm()" action="<?php echo $form_action; ?>">
		<table id="source-form" class="table-form">
			<tr>
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
<div id="source-table" class="table-menu" style="border: none;">
	<div class="search">
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
	<table id="source" class="tablesorter">
		<thead> 
		<tr>
			<th class="center">ID Source</th>
			<th>Source Name</th>
			<th>Source Type</th>
			<th class="center">Row</th>
			<th class="center">Edited</th>
			<th class="center">Published</th>
			<th class="center">Deleted</th>
			<th class="center">Total Article</th>
			<th class="center" colspan="2">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$no = 0 + $start; 
			foreach ($source_table as $column) {
				$deleteLink = anchor(
					'admin/manage_source/delete_source/'.$column->id_source,
					'<button>Delete</button>',
					array('class'=>'delete', 'onclick'=>"return confirm('Are you sure want to delete this source?')")
				);
				$editLink = anchor(
					'admin/manage_source/edit_source/'.$column->id_source,
					'<button>Edit</button>',
					array('class'=>'btn-edit-source')
				);
				$rowLink = anchor(
					'admin/manage_article/advance_search?from-date=&to-date=&author=&category=all&flag=row_article&source='.$column->id_source.'&order-by=desc&advance-search=Search',
					$column->row_article
				);
				$editedLink = anchor(
					'admin/manage_article/advance_search?from-date=&to-date=&author=&category=all&flag=edited&source='.$column->id_source.'&order-by=desc&advance-search=Search',
					$column->edited
				);
				$publishedLink = anchor(
					'admin/manage_article/advance_search?from-date=&to-date=&author=&category=all&flag=published&source='.$column->id_source.'&order-by=desc&advance-search=Search',
					$column->published
				);
				$deletedLink = anchor(
					'admin/manage_article/advance_search?from-date=&to-date=&author=&category=all&flag=deleted&source='.$column->id_source.'&order-by=desc&advance-search=Search',
					$column->deleted
				);
				$totalLink = anchor(
					'admin/manage_article/advance_search?from-date=&to-date=&author=&category=all&flag=all&source='.$column->id_source.'&order-by=desc&advance-search=Search',
					$column->total_article
				);
				
				($no%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td id='id-source' class='center'>$column->id_source</td>
						<td>$column->source_name</td>
						<td>$column->source_type</td>
						<td class='center'>$rowLink</td>
						<td class='center'>$editedLink</td>
						<td class='center'>$publishedLink</td>
						<td class='center'>$deletedLink</td>
						<td class='center'>$totalLink</td>
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
		echo "<p>Showing ".$start." to ".$finish." of ".$total." sources</p>" ; 
	?>
	</div>
</div>