<h2>
	<a href="<?php echo site_url('admin/manage_article');?>" style="color: white;">Manage Article</a> > Search Article
</h2>
<div id="add-article" class="add-form">
</div>
<div id="edit-article" class="edit-form">
</div>
<div id="article-table" class="table-menu">
	<div class="search">
		<form id="search-by" name="search-by" action="<?php echo $form_action_search;?>" method="GET">
			Enter keywords : <input type="text" name="key" id="key" required="required" />
			<input type="submit" name="search" id="search" value="Search" />
		</form>
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
		
<div id="search-result">
	<?php
		$this->load->helper('text');
		$this->load->helper('search');
		if (!empty($result) && $count != 0) {
			echo "
				<div>
					<h2>Search result keyword '$key' shows ($first_result - $last_result dari $count) :</h2>
				</div>
			";
			foreach($result as $column) {
				$headline = anchor(
					'admin/manage_article/detail_article/'.$column->id_article,
					$column->headline,
					array('class'=>'btn-detail-article')
				);
				$body	  	  = search_extract($column->body_article, $key);
				$article_date = strftime('%d %B %Y',strtotime($column->created_on));
				$author		  = $column->author;
				$status		  = $column->article_flag;
				
				echo "
					<div style='clear: both; padding: 10px;'>
						<table style='float: right;'>
							<tr>
								<td>Article Date</td>
								<td>$article_date</td>
							</tr>
							<tr>
								<td>Author</td>
								<td>$author</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>$status</td>
							</tr>
						</table>
						<h3 style='font-size: 20px;'>$headline</h3>
						<p>$body</p>					
					</div>
				";
			}
		}
		else {
			echo "No result.";
		}
	?>
</div>