<h2>Manage Category<button class="btn-add">+ Add New Category</button></h2>
<div id="add-category" class="add-form">
	<form id="add-category-form" method="post" action="<?php echo $form_action; ?>">
		<table id="category-form" class="table-form">
			<tr>
				<td><label for="id-category">ID Category</label></td>
				<td>:</td>
				<td><input type="text" id="id-category" name="id-category" required="required" autofocus="autofocus" /></td>
				<td><span id="check-category" style="display: none;"></span></td>
				
				<td class="label"><label for="category-name">Category Name</label></td>
				<td>:</td>
				<td><input type="text" id="category-name" name="category-name" required="required" /></td>	
				
				<td class="label">	
					<input type="submit" name="btn-add-category" value="Add" />
					<button class="btn-cancel" type="button">Cancel</button>
				</td>
			</tr>
			
		</table>
	</form>
</div>
<div id="edit-category" class="edit-form">
	<?php
		!empty($form_edit_category)? $this->load->view($form_edit_category) : '';
	?>
</div>
<div id="category-table" class="table-menu" style="border: none;">
	<div class="search">
	</div>
	<div class="paging">
		<?php echo (!empty($pagination))? 'Page : '.$pagination : 'Page : <a style="cursor:auto; color:black;"><strong>1</strong></a>';?>
	</div>
</div>
<?php
	$message_success = $this->session->flashdata('message_success');
	echo !empty($message_success) ? "<p class='success'>" . $message_success . "</p>" : "";
	$message_failed = $this->session->flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>" : "";
?>
		
<div>
	<?php //echo ! empty($table) ? $table : ''; ?>
	<table id="category" class="tablesorter">
		<thead> 
		<tr>
			<th class="center">No</th>
			<th>ID Category</th>
			<th>Category Name</th>
			<th class="center" colspan="2">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$this->load->helper('text');
			$no = 0 + $start;
			foreach ($category_table as $column) {
				$deleteLink = anchor(
					'admin/manage_category/delete_category/'.$column->id_category,
					'<button>Delete</button>',
					array('class'=>'delete', 'onclick'=>"return confirm('Are you sure want to delete this category?')")
				);
				$editLink = anchor(
					'admin/manage_category/edit_category/'.$column->id_category,
					'<button>Edit</button>',
					array('class'=>'btn-edit-category')
				);
				
				($no%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td class='center'>$no</td>
						<td id='id-category'>$column->id_category</td>
						<td>$column->category_name</td>
						<td class='center'>$editLink</td>
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
			echo "<p>Showing ".$start." to ".$finish." of ".$total." categories</p>" ; 
		?>
		</div>
	</div>
</div>