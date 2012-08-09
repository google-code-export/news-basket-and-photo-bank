<h2>Manage Tag<button class="btn-add">+ Add New Tag</button></h2>
<div id="add-tag" class="add-form">
	<form id="add-tag-form" method="post" action="<?php echo $form_action; ?>">
		<table id="tag-form" class="table-form">
			<tr>
				<td><label for="id-tag">ID Tag</label></td>
				<td>:</td>
				<td><input type="text" id="id-tag" name="id-tag" required="required" autofocus="autofocus" /></td>
				<td><span id="check-tag" style="display: none;"></span></td>
				
				<td class="label"><label for="tag-name">Category Name</label></td>
				<td>:</td>
				<td><input type="text" id="tag-name" name="tag-name" required="required" /></td>	
				
				<td class="label">	
					<input type="submit" name="btn-add-tag" value="Add" />
					<button class="btn-cancel" type="button">Cancel</button>
				</td>
			</tr>
			
		</table>
	</form>
</div>
<div id="edit-tag" class="edit-form">
	<?php
		!empty($form_edit_tag)? $this->load->view($form_edit_tag) : '';
	?>
</div>
<div id="tag-table" class="table-menu" style="border: none;">
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
	<?php //echo ! empty($table) ? $table : ''; ?>
	<table id="tag" class="tablesorter">
		<thead> 
		<tr>
			<th class="center" >No</th>
			<th>ID Tag</th>
			<th>Tag Name</th>
			<th class="center" colspan="2">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$this->load->helper('text');
			$no = 0 + $start;
			foreach ($tag_table as $column) {
				$deleteLink = anchor(
					'admin/manage_tag/delete_tag/'.$column->id_tag,
					'<button>Delete</button>',
					array('class'=>'delete', 'onclick'=>"return confirm('Are you sure want to delete this tag?')")
				);
				$editLink = anchor(
					'admin/manage_tag/edit_tag/'.$column->id_tag,
					'<button>Edit</button>',
					array('class'=>'btn-edit-tag')
				);
				
				($no%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td class='center'>$no</td>
						<td id='id-tag'>$column->id_tag</td>
						<td>$column->tag_name</td>
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
		echo "<p>Showing ".$start." to ".$finish." of ".$total." tags</p>" ; 
	?>
	</div>
</div>