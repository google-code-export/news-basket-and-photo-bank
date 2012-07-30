<form id="edit-tag-form" method="post" action="<?php echo $form_action_edit; ?>">
	<table id="tag-form" class="table-form">
		<tr>
			<td class="label"><label for="tag-name">Tag Name</label></td>
			<td>:</td>
			<td><input type="text" id="tag-name" name="tag-name" required="required" autofocus="autofocus" value="<?php echo $default['tag_name']; ?>"/></td>	
			
			<td class="label">	
				<input type="submit" name="btn-edit-tag" value="Save" />
				<button class="btn-cancel-edit" onclick="location.href='<?php echo site_url('admin/manage_tag');?>'" type="button">Cancel</button>
			</td>
		</tr>
		
	</table>
</form>