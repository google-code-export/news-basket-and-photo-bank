<div id="add-user">
	<form id="add-user-form">
		<table>
			<tr>
				<td><label for="username">Username</label></td>
				<td>:</td>
				<td><input type="text" id="username" name="username" required="required" autofocus="autofocus" /></td>
			</tr>
			<tr>
				<td><label for="password">Password</label></td>
				<td>:</td>
				<td><input type="text" id="password" name="password" required="required" /></td>
			</tr>
			<tr>
				<td><label for="name">Name</label></td>
				<td>:</td>
				<td><input type="text" id="name" name="name" required="required" /></td>
			</tr>
			<tr>
				<td><label for="email">Email</label></td>
				<td>:</td>
				<td><input type="email" id="email" name="email" required="required" /></td>
			</tr>
			<tr>
				<td><label for="phone">Phone</label></td>
				<td>:</td>
				<td><input type="text" id="phone" name="phone" required="required" /></td>
			</tr>
			<tr>
				<td><label for="publisher">Publisher</label></td>
				<td>:</td>
				<td>
					<select id="publisher" name="publisher">
						<option value="0" SELECTED>- Select Publisher -</option>
						<option value="1">beritasatu.com</option>
						<option value="2">Campus Life</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="level">Level</label></td>
				<td>:</td>
				<td>
					<select id="publisher" name="publisher">
						<option value="0" SELECTED>- Select Level -</option>
						<option value="1">Reporter</option>
						<option value="2">Editor</option>
						<option value="3">Publisher</option>
						<option value="4">Administrator</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td align="right">
					<button type="button" onclick="">Add</button>
					<button type="button" onclick="backManageUser()">Cancel</button>
				</td>
			</tr>
			
		</table>
	</form>
</div>