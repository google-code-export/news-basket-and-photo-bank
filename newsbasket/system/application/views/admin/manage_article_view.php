<h2>Manage Article<?php echo anchor('admin/manage_article/retrieve_email','<button class="btn-add">Retrieve Email</button>');?></h2>
<div id="article-table" class="table-menu" style="border: none;">
	<div class="search">
		<form id="search-by" name="search-by" action="<?php echo $form_action_search;?>" method="POST">
			Enter keywords : <input type="text" name="key" id="key" required="required" />
			<input type="submit" name="search" id="search" value="Search" />
		</form>
	</div>
	<div id="change-flag" class="search" style="display: none;">
		Change flag checked article : 
		<select name="article-flag">
			<option value="1">row_article</option>
			<option value="2">edited</option>
			<option value="3">published</option>
			<option value="4">deleted</option>
		</select>
		<input type="submit" name="change" value="Change Status" />
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
<form name="change-flag" action="<?php echo site_url('admin/manage_article/edit_multiple_flag');?>" method="POST">
<div id="table-list" class="table-list">
	<table id="article" class="tablesorter">
		<thead> 
		<tr>
			<th class="center">No</th>
			<th>Title</th>
			<th>Article Source</th>
			<th>Author</th>
			<th>Created On</th>
			<th>Flag</th>
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
						<td>$column->source_name</td>
						<td>$column->author</td>
						<td>$column->created_on</td>
						<td>$column->article_flag</td>
						<td class='center'><input name='checkbox[]' type='checkbox' value='$column->id_article' /></td>
					</tr>
				";
				$no++;
			}
		?>
		</tbody>
	</table>
	<div class="table-menu" style="background-color: #A7C942;">
		<div class="paging">
		<?php
			echo "<p>Showing ".$start." to ".$finish." of ".$total." articles</p>" ; 
		?>
		</div>
		
	</div>
</div>
</form>