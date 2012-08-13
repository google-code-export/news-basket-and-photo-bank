<h2>Welcome Reporter</h2>
<div class="detail">
	<div id="property" class="detail-left">
		<p class='flip'><strong>Article Information</strong></p>
		<br />
		<p style="margin-left: 5px;">
			News Basket has manage <?php echo $total_article;?> articles.
		</p>
		<br />
		<table style="margin-left: 3px;">
			<tr>	
				<td class="bold" style="width: 120px;">Row Article</td>
				<td class="label"><?php echo $total_rowarticle;?> articles</td>
			</tr>
			<tr>
				<td class="bold">Edited Article</td>
				<td class="label"><?php echo $total_edited;?> articles</td>
			</tr>	
			<tr>
				<td class="bold">Published Article</td>
				<td class="label"><?php echo $total_published;?> articles</td>
			</tr>
			<tr>
				<td class="bold">Deleted Article</td>
				<td class="label"><?php echo $total_deleted;?> articles</td>
			</tr>
		</table>
		
		<br>
		<p class='flip'><strong>User Information</strong></p>
		<br />
		<p style="margin-left: 5px;">
			News Basket has manage <?php echo $total_user;?> users from <?php echo $total_publisher;?> publisher.
		</p>
		<br />
		<table style="margin-left: 3px;">
			<?php foreach ($users_source as $column){?>
			<tr>	
				<td class="bold" style="width: 120px;"><?php echo $column->source_name;?></td>
				<td class="label"><?php echo $column->total_user;?> users</td>
			</tr>
			<?php }?>
		</table>
		
		<br />
		<p class='flip'><strong>Source Information</strong></p>
		<br />
		<p style="margin-left: 5px;">
			News Basket has manage <?php echo $total_source;?> article sources 
			from <?php echo $total_publisher;?> publisher and <?php echo $total_wires;?> wires.
		</p>
		<br>
		<table style="margin-left: 3px;">
			<?php foreach ($article_source as $column){?>
			<tr>	
				<td class="bold" style="width: 120px;"><?php echo $column->source_name;?></td>
				<td class="label"><?php echo $column->total_article;?> articles</td>
			</tr>
			<?php }?>
		</table>
	</div>
	<div class="detail-right">
	</div>
	
</div>