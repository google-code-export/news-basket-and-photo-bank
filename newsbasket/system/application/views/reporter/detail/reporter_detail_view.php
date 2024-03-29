<h2><?php echo $breadcrumb?></h2>
<div class="detail">
	<div id="property" class="detail-left">
		<?php
			echo !empty($edit_user_form)? $this->load->view($edit_user_form) : $this->load->view($user_property);
		?>
		<br />
		<br />
		<br />
		<p class='flip'><strong><?php echo $user['id_user']?> statistic</strong></p>
		<div style="height: 330px; overflow-y: auto;">
		<table style="margin-left: 3px;">
			<tr>
				<td class="bold">Create Article</td>
				<td class="label"><?php echo $user['create']?></td>
			</tr>	
			<tr>	
				<td class="bold">Edit Article</td>
				<td class="label"><?php echo $user['edit']?></td>
			</tr>
			<tr>
				<td class="bold">Delete Article</td>
				<td class="label"><?php echo $user['delete']?></td>
			</tr>
		</table>
		</div>
	</div>
	<div class="detail-right">
		<p class='flip'><strong><?php echo $user['id_user']?> activity</strong></p>
		<table style="margin-left: 3px;">
			<th style="padding: 1px">Date Process</th>
			<th style="padding: 1px">Activity</th>
			<?php
				foreach($user['activity_log'] as $column) {
					$date_process	= $column->process_date;
					$id_article		= $column->id_article;
					$flag			= $column->flag;
					
					$detailArticle = anchor(
						'reporter/manage_article/detail_article/'.$id_article,
						$column->headline,
						array('class'=>'btn-detail-article')
					);
					
					switch ($flag) {
						case 'row_article':
							$message = 'create article '.$detailArticle;
							break;
						case 'edited':
							$message = 'edit article '.$detailArticle;
							break;
						case 'published':
							$message = 'publish article '.$detailArticle;
							break;
						case 'deleted':
							$message = 'delete article '.$detailArticle;
							break;
					}
					echo "
						<tr>
							<td style='text-align:center; width: 150px;'>$date_process</td>
							<td class='label'>$message</td>
						</tr>	
			
					";
				}
			?>
		</table>
	</div>
	
</div>