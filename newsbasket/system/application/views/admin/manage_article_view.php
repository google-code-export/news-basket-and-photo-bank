<h2>Manage Article<?php echo anchor('admin/manage_article/retrieve_email','<button class="btn-add">Retrieve Email</button>');?></h2>
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
<form name="change-flag" action="<?php echo site_url('admin/manage_article/edit_multiple_flag');?>" method="POST">
<div id="change-flag" class="table-menu" style="display: none;">
	<div class="search">
		Change flag checked article : 
		<select name="article-flag">
			<option value="1">row_article</option>
			<option value="2">edited</option>
			<option value="3">published</option>
			<option value="4">deleted</option>
		</select>
		<input type="submit" name="change" value="Change Status" />
	</div>
</div>
		
<?php
	$message_success = $this->session->flashdata('message_success');
	echo !empty($message_success) ? "<p class='success'>" . $message_success . "</p>": "";
	$message_failed = $this->session->flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>": "";
?>
<div id="table-list">
	<table id="article" class="tablesorter">
		<thead> 
		<tr>
			<th class="center">No</th>
			<th>Title</th>
			<th class='center'>Source</th>
			<th>Author</th>
			<th class='center'>Created On</th>
			<th class='center'>Flag</th>
			<th class="center">Action</th>
		</tr>
		</thead> 
		<tbody>
		<?php
			$this->load->helper('text');
			$no = 0 + $start;
			foreach ($article_table as $column) {
				$detailLink = anchor(
					'admin/manage_article/detail_article/'.$column->id_article,
					$column->headline,
					array('class'=>'btn-link')
				);
				
				($no%2 == 1) ? $class_tr='odd' : $class_tr = '';
				echo "
					<tr class=$class_tr>
						<td class='center'>$no</td>
						<td id='id-article'>$detailLink</td>
						<td class='center'>$column->source_name</td>
						<td>$column->author</td>
						<td class='center'>$column->created_on</td>
						<td class='center'>$column->article_flag</td>
						<td class='center'><input name='checkbox[]' type='checkbox' value='$column->id_article' /></td>
					</tr>
				";
				$no++;
			}
		?>
		</tbody>
	</table>
</div>
</form>
<div class="table-bottom">
	<div class="paging">
	<?php
		echo "<p>Showing ".$start." to ".$finish." of ".$total." articles</p>" ; 
	?>
	</div>
</div>