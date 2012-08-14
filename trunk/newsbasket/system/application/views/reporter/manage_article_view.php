<h2>Manage Article</h2>

<div id="add-article" class="add-form">
</div>
<div id="edit-article" class="edit-form">
</div>
<div id="advance-search" class="add-form">
	<form id="advance-search" method="GET" action="<?php echo $form_action_adv; ?>">
		<table class="table-form">
			<tr>
				<td><label for="article-date">Article Date</label></td>
				<td>:</td>
				<td colspan="4">
					<input type="text" id="from-date" name="from-date" value="<?php echo ($fromdate != null)? $fromdate : '';?>"  style="width: 140px;"/>
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
			Enter keywords : <input type="text" name="key" id="key" value="<?php echo ($key != null)? $key : '';?>"/>
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
					'reporter/manage_article/detail_article/'.$column->id_article,
					'<button class="button">Detail</button>',
					array('class'=>'btn-detail-article')
				);
				$editLink = anchor(
					'reporter/manage_article/edit_article/'.$column->id_article,
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
						<td class='$column->article_flag'>$column->article_flag</td>
						<td class='center'>$detailLink $editLink</td>
					</tr>
				";
				$no++;
			}
		?>
		</tbody>
	</table>
	<style type="text/css">
		.edited {
			color : green;
		}
		.row_article{
			color : red;
		}
		.published{
			color : blue;
		}
	</style>
	<div id="article-table" class="table-bottom">
		<div class="paging" style="margin: 7px;">
			<?php echo (!empty($pagination))? 'Page : '.$pagination : 'Page : <a style="cursor:auto; color:black;"><strong>1</strong></a>';?>
		</div>
	</div>
</div>