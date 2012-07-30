<h2>
	<a href="<?php echo site_url('admin/manage_author');?>" style="color: white;">Manage Author</a> > Search Author
	<?php echo (!empty($result))? "> keyword '$key' shows result ($first_result - $last_result dari $count) :" : "> No Results.";?>
</h2>
<div id="author-table" class="table-menu">
	<div class="search">
		<form id="search-by" name="search-by" action="<?php echo $form_action_search;?>" method="GET">
			Search by name : <input type="text" name="key" id="key" required="required" />
			<input type="submit" name="search" id="search" value="Search" />
		</form>
	</div>
	<div class="paging">
	</div>
</div>
<div id="search-result" style="height: 500px; overflow-y:auto;">
	<table id="author" class="tablesorter">
		<thead> 
		<tr>
			<th>No</th>
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
		if (!empty($result) && $count != 0) {
			$No = 1;
			foreach ($result as $column) {
				$deleteLink = anchor(
					'admin/manage_author/delete_author/'.$column->id_author,
					'<button>Delete</button>',
					array('class'=>'btn-delete', 'onclick'=>"return confirm('Are you sure want to delete this author?')")
				);
				$editLink = anchor(
					'admin/manage_author/edit_author/'.$column->id_author,
					'<button>Edit</button>',
					array('class'=>'btn-detail-author')
				);
				
				($No%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class='$class_tr'>
						<td class='center'>$No</td>
						<td id='id-author'>$column->id_author</td>
						<td>$column->source_name</td>
						<td>$column->name</td>
						<td>$column->phone</td>
						<td>$column->email</td>
						<td class='center'>$editLink</td>
						<td class='center'>$deleteLink</td>
					</tr>
				";
				$No++;
			}
		}
		else {
			echo "</tbody></table><h3 style='font-size: 16px; padding: 10px'>No result, try different keywords</h3>";
		}
	?>
		</tbody>
	</table>
</div>