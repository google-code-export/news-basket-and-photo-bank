<h2><?php echo $breadcrumb?></h2>
<div class="detail">
	<div id="property" class="detail-left">
		<?php
			echo !empty($edit_article_form)? $this->load->view($edit_article_form) : $this->load->view($article_property);
		?>
	</div>
	<div id="version" class="detail-right" style="overflow-y: auto;">
		<?php
			$no = 1;
			foreach ($article['list_version'] as $column) {
				$edited_on = substr($column->edited_on, 0, 10);
				echo "
				<p class='flip$no'><strong>Article Version $no <span class='right'>Edited On: $edited_on | Edited By: $column->edited_by</span></strong></p>
				<div class='panel$no'>
					<table style='margin-left: 3px;'>
						<tr class='padding'>	
							<td class='bold'><label for='flag'>Headline</label></td>
							<td class='label'>$column->headline</td>
						</tr>
						<tr class='padding'>	
							<td class='bold'><label for='flag'>Lead Article</label></td>
							<td class='label'>$column->lead_article</td>
						</tr>
						<tr class='padding'>	
							<td class='bold'><label for='flag'>Body Article</label></td>
							<td class='label'>$column->body_article</td>
						</tr>
					</table>
				</div>
				<br />
				";
				$no++;
			}
		?>
	</div>
	
</div>