<h2>Manage Article</h2>
<div id="add-article" class="add-form">
</div>
<div id="edit-article" class="edit-form">
</div>
<div id="article-table" class="table-menu">
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
			<th>Title</th>
			<th>Article Source</th>
			<th>Author</th>
			<th>Date Created</th>
			<th>Status Flag</th>
			<th class="center" colspan="3">Action</th>
		</tr>
		<?php
			$No = 1;
			$this->load->helper('text');
			foreach ($article_table as $column) {
				$deleteLink = anchor(
					'admin/manage_article/deleteArticle/'.$column->id_article,
					'<button>Delete</button>',
					array('class'=>'btn-delete', 'onclick'=>"return confirm('Are you sure want to delete this article?')")
				);
				$detailLink = anchor(
					'admin/manage_article/detailArticle/'.$column->id_article,
					'<button>Detail</button>',
					array('class'=>'btn-detail-article')
				);
				
				($No%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td>$No</td>
						<td id='id-article'>$column->headline</td>
						<td>$column->source_name</td>
						<td>$column->author</td>
						<td>$column->created_on</td>
						<td>$column->article_flag</td>
						<td class='center'>$detailLink</td>
						<td class='center'>$deleteLink</td>
					</tr>
				";
				$No++;
			}
		?>
	</table>
</div>