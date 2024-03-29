<?php
    echo $this->tinyMce;
?>	
<p class='flip'><strong>Edit Article</strong></p>
<form id="edit-article-form" method="post" action="<?php echo $form_action_edit;?>" >
	<br />
	<table style="margin-left: 2px;">
		<tr class="alternate">
			<td class="bold"><label for="headline">Headline</label></td>
			<td class="label"><input type="text" name="headline" size="50px;" value="<?php echo $article['headline']?>"/></td>
		</tr>
		<tr>
			<td class="bold"><label for="lead-article">Lead Article</label></td>
				<td class="label"><input type="text" name="lead-article" size="50px;" value="<?php echo $article['lead_article']?>"/></td>
			</td>
		</tr>	
		<tr class="alternate">
			<td class="bold"><label for="body-article">Body Article</label></td>
			<td class="label">
				<textarea name="body-article" rows="30" cols="80"><?php echo $article['body_article']?></textarea>
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
			<td class="bold">&nbsp;</td>
		</tr>
		<tr>
			<td class="bold">&nbsp;</td>
			<td class="label"><span style="margin-left: 3px;"><i>Example : Life, Love, Long, Live</i></span></td>
		</tr>
		<tr>
			<td class="bold">Tag</td>
			<td class="label"><input type="text" name="tag" size="50px;" value="<?php echo $article['tag']?>"/></td>
		</tr>
		<tr>
			<td class="bold">Status Flag</td>
			<td class="label">
				<select name="article-flag">
					<?php
					$level = array('row_article','edited', 'deleted');
					for ($i=0; $i<=2; $i++) {
						$value = $i + 1;
						if ($level[$i] == $article['article_flag']) {
							echo "<option value='$level[$i]' SELECTED>$level[$i]</option>";
						}
						else {
							echo "<option value='$level[$i]'>$level[$i]</option>";			
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
					<input type="submit" class="button" value="Save Article" />
					<input type="button" value="cancel" class="button" onclick="window.location='<?php echo site_url('reporter/manage_article');?>'">
				</span>
			</td>
		</tr>
	</table>
	<!-- data untuk membuat article_version -->
	<input type="hidden" style="display: none;" name="headline-version" value="<?php echo $article['headline']?>"/>
	<input type="hidden" style="display: none;" name="lead-article-version" value="<?php echo $article['lead_article']?>"/>
	<input type="hidden" style="display: none;" name="body-article-version" value="<?php echo $article['body_article']?>"/>
</form>
	