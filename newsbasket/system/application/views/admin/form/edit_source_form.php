<form id="edit-source-form" method="post" action="<?php echo $form_action_edit; ?>">
	<table id="source-form" class="table-form">
		<tr>
			<td class="label"><label for="source-name">Source Name</label></td>
			<td>:</td>
			<td><input type="text" id="source-name" name="source-name" required="required" autofocus="autofocus" value="<?php echo $default['source_name']; ?>"/></td>	
			
			<td class="label"><label for="source-type">Source Type</label></td>
			<td>:</td>
			<td>
				<select id="source-type" name="source-type">
					<?php
					$level = array('wires','publisher');
					for ($i=0; $i<=1; $i++) {
						$value = $i + 1;
						if ($level[$i] == $default['source_type']) {
							echo "<option value='$value' SELECTED>$level[$i]</option>";
						}
						else {
							echo "<option value='$value'>$level[$i]</option>";			
						}
					}
					?>
				</select>
			</td>	
			
			<td class="label">	
				<input type="submit" name="btn-edit-source" value="Save" />
				<button class="btn-cancel-edit" onclick="location.href='<?php echo site_url('admin/manage_source');?>'" type="button">Cancel</button>
			</td>
		</tr>
		
	</table>
</form>