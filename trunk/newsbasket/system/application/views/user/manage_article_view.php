<h2>Manage Article</h2>
<div id="add-article" class="add-form">
</div>
<div id="edit-article" class="edit-form">
</div>
<div id="article-table" class="table-menu">
	<div class="search">
		<form id="search-by" name="search-by" action="<?php echo $form_action_search;?>" method="GET">
			Enter keywords : <input type="text" name="key" id="key" required="required" />
			<input type="submit" name="search" id="search" class="button" value="Search" />
		</form>
	</div>
</div>
<?php
	$message_success = $this->session->flashdata('message_success');
	echo !empty($message_success) ? "<p class='success'>" . $message_success . "</p>": "";
	$message_failed = $this->session->flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>": "";
?>
<div>
	<?php //echo ! empty($table) ? $table : ''; ?>
	<table id="article" class="tablesorter">
		<thead> 
		<tr>
			<th class="center">No</th>
			<th>Title</th>
			<th>Article Source</th>
			<th>Author</th>
			<th>Date Created</th>
			<th>Status Flag</th>
			<th class="center">Action</th>
		</tr>
		</thead> 
		<tbody>
		<?php
			$this->load->helper('text');
			foreach ($article_table as $column) {
				/*$deleteLink = anchor(
					'user/manage_article/deleteArticle/'.$column->id_article,
					'<button>Delete</button>',
					array('class'=>'btn-delete', 'onclick'=>"return confirm('Are you sure want to delete this article?')")
				);*/
				$detailLink = anchor(
					'user/manage_article/detail_article/'.$column->id_article,
					'<button class="button">Detail</button>',
					array('class'=>'btn-detail-article')
				);
				$editLink = anchor(
					'user/manage_article/edit_article/'.$column->id_article,
					'<button class="button">Edit</button>',
					array('class'=>'btn-edit-article')
				);				
				($no%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td class='center'>$no</td>
						<td id='id-article'>$column->headline</td>
						<td>$column->source_name</td>
						<td>$column->author</td>
						<td>$column->created_on</td>
						<td>$column->article_flag</td>
						<td class='center'>$detailLink $editLink</td>
					</tr>
				";
				$no++;
			}
		?>
		</tbody>
	</table>
	<div id="article-table" class="table-menu">
	<div class="paging">
		<?php echo (!empty($pagination))? 'Page : '.$pagination : 'Page : <a style="cursor:auto; color:black;"><strong>1</strong></a>';?>
	</div>
</div>
</div>