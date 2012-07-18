<form id="edit-category-form" method="post" action="<?php echo $form_action_edit; ?>">
	<table id="category-form" class="table-form">
		<tr>
			<td class="label"><label for="category-name">Category Name</label></td>
			<td>:</td>
			<td><input type="text" id="category-name" name="category-name" required="required" autofocus="autofocus" value="<?php echo $default['category_name']; ?>"/></td>	
			
			<td class="label">	
				<input type="submit" name="btn-edit-category" value="Edit" />
				<button class="btn-cancel-edit" onclick="location.href='<?php echo site_url('admin/manage_category');?>'" type="button">Cancel</button>
			</td>
		</tr>
		
	</table>
</form>