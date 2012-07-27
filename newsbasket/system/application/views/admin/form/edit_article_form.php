<p class='flip'><strong>Edit Article</strong></p>
<form id="edit-article-form" method="post" action="<?php echo $form_action_edit;?>" >
	<br />
	<table style="margin-left: 3px;">
		<tr class="alternate">
			<td class="bold"><label for="headline">Headline</label></td>
			<td class="label"><input type="text" name="headline" size="46px;" style="margin-left: 3px;" value="<?php echo $article['headline']?>"/></td>
		</tr>
		<tr>
			<td class="bold"><label for="lead-article">Lead Article</label></td>
			<td class="label">
				<textarea name="lead-article" rows="5" cols="50"><?php echo $article['lead_article']?></textarea>
			</td>
		</tr>	
		<tr class="alternate">
			<td class="bold"><label for="body-article">Body Article</label></td>
			<td class="label">
				<textarea name="body-article" rows="10" cols="50"><?php echo $article['body_article']?></textarea>
			</td>
		</tr>
		<tr>
			<td class="bold">Category</td>
			<td class="label">
				<select name="id-category">
					<?php
					foreach ($categories as $column) {
						if ($column->id_category == $article['id_category']) {
							echo "<option value='$column->id_category' SELECTED>$column->category_name</option>";
						}
						else {
							echo "<option value='$column->id_category'>$column->category_name</option>";
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="bold">Tag</td>
			<td class="label"><input type="text" name="tag" size="46px;" style="margin-left: 3px;"/></td>
		</tr>
		<tr>
			<td class="bold">Status Flag</td>
			<td class="label">
				<select name="article-flag">
					<?php
					$level = array('row_article','edited','published','deleted');
					for ($i=0; $i<=3; $i++) {
						$value = $i + 1;
						if ($level[$i] == $article['article_flag']) {
							echo "<option value='$value' SELECTED>$level[$i]</option>";
						}
						else {
							echo "<option value='$value'>$level[$i]</option>";			
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<span style="float: right;">
					<input type="submit" value="Save Article" />
					<a id="edit-article" href="<?php echo site_url('admin/manage_article/detail_article').'/'.$article['id_article'];?>"><button>Cancel</button></a>
				</span>
			</td>
		</tr>
	</table>
	<!-- data untuk membuat article_version -->
	<input type="hidden" name="headline-version" value="<?php echo $article['headline']?>"/>
	<input type="hidden" name="lead-article-version" value="<?php echo $article['lead_article']?>"/>
	<input type="hidden" name="body-article-version" value="<?php echo $article['body_article']?>"/>
</form>
	