<h2><?php echo $breadcrumb ?></h2>
<p class='flip'><strong>Add New Article</strong></p>
<form id="edit-article-form" action="<?php echo $form_action_add;?>"method="post">
	<br />
	<table style="margin-left: 2px;">
		<tr class="alternate">
			<td class="bold"><label for="headline">Headline</label></td>
			<td class="label"><input type="text" name="headline" size="46px;"></td>
		</tr>
		<tr>
			<td class="bold"><label for="lead-article">Lead Article</label></td>
			<td class="label">
				<textarea name="lead-article" rows="5" cols="80"></textarea>
			</td>
		</tr>	
		<tr class="alternate">
			<td class="bold"><label for="body-article">Body Article</label></td>
			<td class="label">
				<textarea name="body-article" rows="10" cols="80"></textarea>
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
			<td class="label"><input type="text" name="tag" size="46px;"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<span style="float: right;">
					<input type="submit" class="button" value="Save Article" />
					<a id="add-article" href="<?php echo site_url('editor/manage_article')?>"><button class="button">Cancel</button></a>
				</span>
			</td>
		</tr>
	</table>
</form>
	