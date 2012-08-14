<?php
	foreach($resultday as $column) {
		echo "<br><h3>Today</h3>";
		echo "
			<table>
				<tr>
					<td>Total Article</td>
					<td>:</td>
					<td>$column->total_article</td>
				</tr>
				<tr>
					<td>Row Article</td>
					<td>:</td>
					<td>$column->row_article</td>
					<td class='label'>Edited</td>
					<td>:</td>
					<td>$column->edited</td>
				</tr>
				<tr>
					<td>Published</td>
					<td>:</td>
					<td>$column->published</td>
					<td class='label'>Deleted</td>
					<td>:</td>
					<td>$column->deleted</td>
				</tr>
			</table>
		";
	}
	foreach($resultweek as $column) {
		echo "<br><h3>This Week</h3>";
		echo "
			<table>
				<tr>
					<td>Total Article</td>
					<td>:</td>
					<td>$column->total_article</td>
				</tr>
				<tr>
					<td>Row Article</td>
					<td>:</td>
					<td>$column->row_article</td>
					<td class='label'>Edited</td>
					<td>:</td>
					<td>$column->edited</td>
				</tr>
				<tr>
					<td>Published</td>
					<td>:</td>
					<td>$column->published</td>
					<td class='label'>Deleted</td>
					<td>:</td>
					<td>$column->deleted</td>
				</tr>
			</table>
		";
	}
	
	foreach($resultmonth as $column) {
		echo "<br><h3>This Month</h3>";
		echo "
			<table>
				<tr>
					<td>Total Article</td>
					<td>:</td>
					<td>$column->total_article</td>
				</tr>
				<tr>
					<td>Row Article</td>
					<td>:</td>
					<td>$column->row_article</td>
					<td class='label'>Edited</td>
					<td>:</td>
					<td>$column->edited</td>
				</tr>
				<tr>
					<td>Published</td>
					<td>:</td>
					<td>$column->published</td>
					<td class='label'>Deleted</td>
					<td>:</td>
					<td>$column->deleted</td>
				</tr>
			</table>
		";
	}
	
?>