<h2>Manage Category<button class="btn-add" style="float: right; height: 30px; margin-top: -2px;">+ Add New Category</button></h2>
<div id="add-category" style="background-color:#EAF2D3;">
	<form id="add-category-form" method="post" action="<?php echo $form_action; ?>">
		<table id="category-form">
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
					<button class="btn-cancel type="button">Cancel</button>
				</td>
			</tr>
			
		</table>
	</form>
</div>
<div id="category-table" class="table-menu">
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
	<?php //echo ! empty($table) ? $table : ''; ?>
	<table id="zebra">
		<tr>
			<th>No</th>
			<th>ID Category</th>
			<th>Category Name</th>
			<th class="center" colspan="2">Action</th>
		</tr>
		<?php
			$No = 1;
			$this->load->helper('text');
			foreach ($category_table as $column) {
				$deleteLink = anchor(
					'admin/manage_category/deleteCategory/'.$column->id_category,
					'Delete',
					array('class'=>'delete', 'onclick'=>"return confirm('Are you sure want to delete this category?')")
				);
				
				($No%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td>$No</td>
						<td id='id-user'>$column->id_category</td>
						<td>$column->category_name</td>
						<td class='center'><button class='btn-edit-category'>Edit</button></td>
						<td class='center'>$deleteLink</td>
					</tr>
				";
				$No++;
			}
		?>
	</table>
</div>