<p class='flip'><strong>Last Version Article</strong>
	<a id="edit-article" href="<?php echo $form_action_edit;?>">
		<button style="float: right; margin-top: -5px;" >Edit Article</button>
	</a>
</p>
<?php
	$message_success = $this->session->flashdata('message_success');
	echo !empty($message_success) ? "<p class='success'>" . $message_success . "</p>": "";
	$message_failed = $this->session->flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>": "";
?>
<table style="margin-left: 3px; border-collapse:collapse;">
	<tr class="alternate">
		<td class="bold">Headline</td>
		<td class="label"><?php echo $article['headline'];?></td>
	</tr>	
	<tr>	
		<td class="bold"><label for="author-by">Author</td>
		<td class="label">
			<?php
				$authorstr = array();
				foreach ($article['author'] as $column) {
					$detailAuthor = anchor(
						'admin/manage_user/detail_user/'.$column->id_user,
						$column->name,
						array('class'=>'btn-detail-user')
					);
					
					$authorstr[] = $detailAuthor;
				}
				$author = implode(", ", $authorstr);
				echo $author;
			?>
		</td>
	</tr>
	<tr class="alternate">
		<td class="bold">Editor</td>
		<td class="label">
			<?php
				$editorstr = array();
				foreach ($article['editor'] as $column) {
					$detailEditor = anchor(
						'admin/manage_user/detail_user/'.$column->id_user,
						$column->name,
						array('class'=>'btn-detail-user')
					);
					$editorstr[] = $detailEditor;
				}
				$editor = implode(", ", $editorstr);
				echo $editor;
			?>
		</td>
	</tr>	
	<tr>
		<td class="bold"><label for="published-by">Published By</td>
		<td class="label"></td>
	</tr>	
	<tr>
		<td class="bold">Article Source</td>
		<td class="label"><?php echo $article['source'];?></td>
	</tr>			
	<tr class="alternate">
		<td class="bold">Slugline</td>
		<td class="label"><?php echo $article['slug'];?></td>
	</tr>	
	<tr><td class="bold">&nbsp;</td></tr>
	
	<tr>
		<td class="bold">Lead Article</td>
		<td class="label">
			<?php 
			$this->load->helper('text');
			echo word_limiter($article['lead_article'], 25);
			?>
		</td>
	</tr>	
	<tr class="alternate">
		<td class="bold">Body Article</td>
		<td class="label">
			<?php 
			echo word_limiter($article['body_article'], 35);
			?>
		</td>
	</tr>	
	<tr><td class="bold">&nbsp;</td></tr>
	
	<tr>
		<td class="bold">Category</td>
		<td class="label"><?php echo $article['category'];?></td>
	</tr>	
	<tr>
		<td class="bold">Tag</td>
		<td class="label">
			<?php
				$tagstr = array();
				foreach ($article['tag'] as $column) {
					$tagstr[] = $column->id_tag;
				}
				$tag = implode(", ", $tagstr);
				echo $tag;
			?>
		</td>
	</tr>	
	<tr><td class="bold">&nbsp;</td></tr>
	
	<tr class="alternate">
		<td class="bold">ID Article</td>
		<td class="label"><?php echo $article['id_article'];?></td>
	</tr>	
	<tr>
		<td class="bold">Created On</td>
		<td class="label"><?php echo $article['created_on'];?></td>
	</tr>	
	<tr>
		<td class="bold">Last Edited On</td>
		<td class="label"></td>
	</tr>	
	<tr>
		<td class="bold">Published On</td>
		<td class="label"></td>
	</tr class="alternate">	
	<tr>
		<td class="bold">Status Flag</td>
		<td class="label"><?php echo $article['article_flag']?></td>
	</tr>
</table>