<div style="display:none">
	<form id="edit-article-form" method="post" action="">
		<table>
			<tr class="alternate">
				<td class="bold"><label for="headline">Headline</label></td>
				<td class="label"><p id="headline"><?php echo $article['headline']?></p></td>
			</tr>	
			<tr>	
				<td class="bold"><label for="author-by">Author</label></td>
				<td class="label"><p id="author-by">
					<?php
						foreach ($article['author'] as $column) {
							$detailEditor = anchor(
								'admin/manage_user/detail_user/'.$column->id_user,
								$column->name,
								array('class'=>'btn-detail-user')
							);
							echo "$detailEditor ";
						}
					?>
				</p></td>
			</tr>
			<tr class="alternate">
				<td class="bold"><label for="edited-by">Editor</label></td>
				<td class="label"><p id="edited-by">
					<?php
						foreach ($article['editor'] as $column) {
							$detailEditor = anchor(
								'admin/manage_user/detail_user/'.$column->id_user,
								$column->name,
								array('class'=>'btn-detail-user')
							);
							echo "$detailEditor ";
						}
					?>
				</p></td>
			</tr>	
			<tr>
				<td class="bold"><label for="published-by">Published By</label></td>
				<td class="label"><p id="published-by"> </p></td>
			</tr>	
			<tr>
				<td class="bold"><label for="source-name">Article Source</label></td>
				<td class="label"><p id="source-name"><?php echo $article['source']?></p></td>
			</tr>			
			<tr class="alternate">
				<td class="bold"><label for="slug">Slugline</label></td>
				<td class="label"><p id="slug"><?php echo $article['slug']?></p></td>
			</tr>	
			<tr><td class="bold">&nbsp;</td></tr>
			
			<tr>
				<td class="bold"><label for="lead-article">Lead Article</label></td>
				<td class="label"><p id="lead-article"><?php echo $article['lead_article']?></p></td>
			</tr>	
			<tr class="alternate">
				<td class="bold"><label for="body-article">Body Article</label></td>
				<td class="label"><p id="body-article"><?php echo $article['body_article']?></p></td>
			</tr>	
			<tr><td class="bold">&nbsp;</td></tr>
			
			<tr>
				<td class="bold"><label for="category">Category</label></td>
				<td class="label"><p id="category">
					<?php
						foreach ($article['category'] as $column) {
							echo "$column->category_name ";
						}
					?>
				</p></td>
			</tr>	
			<tr>
				<td class="bold"><label for="tag">Tag</label></td>
				<td class="label"><p id="tag"> </p></td>
			</tr>	
			<tr><td class="bold">&nbsp;</td></tr>
			
			<tr class="alternate">
				<td class="bold"><label for="id-article">ID Article</label></td>
				<td class="label"><p id="id-article"><?php echo $article['id_article']?></p></td>
			</tr>	
			<tr>
				<td class="bold"><label for="created-on">Created On</label></td>
				<td class="label"><p id="created-on"><?php echo $article['created_on']?></p></td>
			</tr>	
			<tr>
				<td class="bold"><label for="last-edited">Last Edited On</label></td>
				<td class="label"><p id="last-edited"> </p></td>
			</tr>	
			<tr>
				<td class="bold"><label for="published-on">Published On</label></td>
				<td class="label"><p id="published-on"> </p></td>
			</tr class="alternate">	
			<tr>
				<td class="bold"><label for="flag">Status Flag</label></td>
				<td class="label"><p id="flag"><?php echo $article['article_flag']?></p></td>
			</tr>
		</table>
	</form>
</div>	
	