<h2>
	<a href="<?php echo site_url('admin/manage_article');?>" style="color: white;">Manage Article</a> > Search Article
	<?php echo "> keyword '$key' shows result ($first_result - $last_result dari $count)";?>
</h2>
<div id="advance-search" class="add-form" style="display: block">
	<form id="advance-search" method="GET" action="<?php echo $form_action_adv; ?>">
		<table class="table-form">
			<tr>
				<td><label for="article-date">Article Date</label></td>
				<td>:</td>
				<td colspan="4">
					<input type="text" id="from-date" name="from-date" value="<?php echo ($fromdate != null)? $fromdate : '';?>" style="width: 140px;"/>
					to
					<input type="text" id="to-date" name="to-date" value="<?php echo ($todate != null)? $todate : '';?>" style="width: 140px;"/>
				</td>
				
				<td class="label"><label for="author">Author</label></td>
				<td>:</td>
				<td><input type="text" id="author" name="author" value="<?php echo ($author != null)? $author : '';?>"/></td>
				
			</tr>
			<tr>
				<td><label for="category">Category</label></td>
				<td>:</td>
				<td>
					<select id="category" name="category">
						<option value="all">All</option>
						<?php
						foreach ($categories as $column) {
							if ($column->id_category == $category) {
								echo "<option value='$column->id_category' SELECTED>$column->category_name</option>";
							}
							else {
								echo "<option value='$column->id_category'>$column->category_name</option>";
							}
						}
						?>
					</select>
				</td>
				
				<td><label for="flag">Flag Status</label></td>
				<td>:</td>
				<td align="right">
					<select id="flag" name="flag">
						<option value="all">All</option>
						<?php
						$level = array('row_article','edited','published','deleted');
						for ($i=0; $i<=3; $i++) {
							if ($level[$i] == $flag) {
								echo "<option value='$level[$i]' SELECTED>$level[$i]</option>";
							}
							else {
								echo "<option value='$level[$i]'>$level[$i]</option>";			
							}
						}
						?>
					</select>
				</td>
				
				<td class="label"><label for="source">Source</label></td>
				<td>:</td>
				<td>
					<select id="source" name="source">
						<option value="all">All</option>
						<?php
						foreach ($source as $column) {
							if ($column->id_source == $sel_source) {
								echo "<option value='$column->id_source' SELECTED>$column->source_name</option>";
							}
							else {
								echo "<option value='$column->id_source'>$column->source_name</option>";
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="order-by">Order By</label></td>
				<td>:</td>
				<td>
					<select id="order-by" name="order-by">
						<option value="desc" SELECTED>Date, Descending</option>
						<option value="asc">Date, Ascending</option>
					</select>
				</td>
				
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				
				<td class="label" align="right">
					<input type="submit" name="advance-search" value="Search" />
					<button class="btn-cancel" type="button">Cancel</button>
				</td>
			</tr>
		</table>
	</form>
</div>
<div id="article-table" class="table-menu" style="border: none;">
	<div class="search">
		<form id="search-by" name="search-by" action="<?php echo $form_action_search;?>" method="GET" style="float: right;">
			Enter keywords : <input type="text" name="key" id="key" value="<?php echo ($key != null)? $key : '';?>" />
			<input type="submit" name="search" id="search" value="Search" />
			<input type="button" id="btn-advance-search" value="Advance Search" />
		</form>
	</div>
	<div class="paging">
	<?php
		if (!empty($pagination)) {
			echo '<p>Page : '.$pagination. "</p>" ; 
		}
		else {
			echo 'Page : <a style="cursor:auto; color:black;"><strong>1</strong></a>';
		}
	?>
	</div>
</div>
<div id="search-result">
	<?php
		$this->load->helper('text');
		$this->load->helper('search');
		if (!empty($result) && $count != 0) {
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