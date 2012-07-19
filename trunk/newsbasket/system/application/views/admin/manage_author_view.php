<h2>Manage Author<button class="btn-add" style="float: right; height: 30px; margin-top: -2px;">+ Add New Author</button></h2>
<div id="manage_author">
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
					
					<td class="label"><label for="phone">Phone</label></td>
					<td>:</td>
					<td><input type="text" id="phone" name="phone" required="required" /></td>
					<td><span id="check-numeric" style="display: none;"></span></td>
					
					<td class="label"><label for="publisher">Publisher</label></td>
					<td>:</td>
					<td>
						<select id="publisher" name="publisher">
						<?php
						foreach ($navigasi['publisher'] as $column) {
							echo "
							<option value='$column->id_source'>$column->source_name</option>
							";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td><label for="password">Password</label></td>
					<td>:</td>
					<td><input type="password" id="password" name="password" required="required" /></td>
					<td>&nbsp;</td>

					<td class="label"><label for="confirm-password">Retype Password</label></td>
					<td>:</td>
					<td><input type="password" id="confirm-password" name="confirm-password" required="required" /></td>
					<td><span id="check-password" style="display: none;"></span></td>
					
					<td class="label"><label for="email">Email</label></td>
					<td>:</td>
					<td><input type="email" id="email" name="email" required="required" /></td>
					<td>&nbsp;</td>
					
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
	<div id="edit-author" class="edit-form">
		<?php
			!empty($form_edit_author)? $this->load->view($form_edit_author) : '';
		?>
	</div>
	<div id="author-table" class="table-menu">
		<div class="search">
			<form id="search-by" name="search_by" action="" method="post">
				<input type="text" name="search_key" id="search-key" value="" required="required" />
				<input type="submit" name="search" id="search" value="Search" />
			</form>
		</div>
		<div class="paging">
			<p><?php echo !empty($pagination) ? $pagination : ''; ?></p>
			<!--<span class="disabled">
				<a class="disabled" href=#><< Prev</a>
			</span>
			<span class="current">
				<a href=#>1</a>
			</span>
			<span class="disabled">
				<a class="disabled" href=#>2</a>
			</span>
			<span class="disabled">
				<a class="disabled" href=#>3</a>
			</span>
			<span class="prevnext">
				<a href="#">Next >></a>
			</span>-->
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
				<th>ID Author</th>
				<th>Password</th>
				<th>Publisher</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Email</th>
				<th class="center" colspan="2">Action</th>
			</tr>
			<?php
				$No = 1;
				$this->load->helper('text');
				foreach ($author_table as $column) {
					$deleteLink = anchor(
						'admin/manage_author/deleteAuthor/'.$column->id_author,
						'<button>Delete</button>',
						array('class'=>'btn-delete', 'onclick'=>"return confirm('Are you sure want to delete this author?')")
					);
					$editLink = anchor(
						'admin/manage_author/editAuthor/'.$column->id_author,
						'<button>Edit</button>',
						array('class'=>'btn-edit-author')
					);
					
					($No%2 == 1) ? $class_tr='odd' : $class_tr = '';
					echo "
						<tr class=$class_tr>
							<td>$No</td>
							<td id='id-author'>$column->id_author</td>
							<td>$column->password</td>
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
			?>
		</table>
	</div>
</div>