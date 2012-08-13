<h2><?php echo $breadcrumb ?></h2>
<p class='flip'><strong>Add New Article</strong></p>
<form id="edit-article-form" action="<?php echo $form_action_add;?>"method="post">
	<br />
	<table style="margin-left: 120px;">
		<tr class="alternate">
			<td class="bold"><label for="headline">Headline</label></td>
			<td class="label"><input type="text" name="headline" size="50px;"></td>
		</tr>
		<tr>
			<td class="bold"><label for="lead-article">Lead Article</label></td>
				<td class="label"><input type="text" name="lead-article" size="50px;"></td>
			</td>
		</tr>	
		<tr class="alternate">
			<td class="bold"><label for="body-article">Body Article</label></td>
			<td class="label">
				<textarea name="body-article" id="article-body" rows="30" cols="80"></textarea>
			</td>
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
			<td class="label"><input type="text" name="tag" size="50px;"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<span style="float: right;">
					<input type="submit" class="button" value="Save Article" />
					<input type="button" value="cancel" class="button" onclick="window.location='<?php echo site_url('editor/manage_article');?>'">
				</span>
			</td>
		</tr>
	</table>
</form>
	