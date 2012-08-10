<h2>
	<a href="<?php echo site_url('admin/manage_article');?>" style="color: white;">Manage Article</a> > Search Article
	<?php echo ($key != null)? "> keyword '$key' shows result ($first_result - $last_result dari $count)" : "";?>
</h2>
<div id="article-table" class="table-menu" style="border: none;">
	<div class="search">
		<form id="search-by" name="search-by" action="<?php echo $form_action_search;?>" method="GET">
			Enter keywords : <input type="text" name="key" id="key" required="required" />
			<input type="submit" name="search" id="search" value="Search" />
		</form>
	</div>
	<div class="paging">
	<?php
		if (!empty($pagination) && $key != null) {
			echo '<p>Page : '.$pagination. "</p>" ; 
		}
		else {
			echo 'Page : <a style="cursor:auto; color:black;"><strong>1</strong></a>';
		}
	?>
	</div>
</div>
<div id="search-result" style="height: 480px; overflow-y:auto;">
	<?php
		$this->load->helper('text');
		$this->load->helper('search');
		if (!empty($result) && $count != 0 && $key != null) {
			$no = 1;
			foreach($result as $column) {
				$headline = anchor(
					'admin/manage_article/detail_article/'.$column->id_article,
					$column->headline,
					array('class'=>'btn-detail-article')
				);
				$body	  	  = search_extract($column->body_article, $key);
				$article_date = strftime('%d %B %Y',strtotime($column->created_on));
				
				$class = ($no%2 == 1)? 'result' : '';
				echo "
					<div class='$class' style='padding: 5px 10px 10px; height: 70px;'>
						<table style='float: right; font-size: 12px; line-height: 12px; margin-right: 10px; width: 270px'>
							<tr>
								<td>Article Date</td>
								<td>$article_date</td>
							</tr>
							<tr>
								<td>Categories</td>
								<td>$column->category_name</td>
							</tr>
							<tr>
								<td>Author</td>
								<td>$column->author</td>
							</tr>
							<tr>
								<td>Source</td>
								<td>$column->source_name</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>$column->article_flag</td>
							</tr>
						</table>
						<h3 style='font-size: 16px;'>$headline</h3>
						<p style='width:80%;'>$body</p>					
					</div>
				";
				$no++;
			}
		}
		else {
			echo "<h3 style='font-size: 16px; padding: 10px'>No result, try different keywords</h3>";
		}
	?>
</div>