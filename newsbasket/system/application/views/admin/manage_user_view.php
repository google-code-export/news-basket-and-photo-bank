<div id="main" class="main">
	<h2>Manage User<button id="btn_add_user" style="float: right; height: 30px; margin-top: -2px;" onclick="formAddUser()">+ Add New User</button></h2>
	<div class="table-menu">
		<div class="search">
			<form id="search-by" name="search_by" action="" method="post">
				<input type="text" name="search_key" id="search-key" value="" required="required" />
				<input type="submit" name="search" id="search" value="Search" />
			</form>
		</div>
		<div class="paging">
			<span class="disabled">
				<a class="disabled" href=#><< Prev</a>
			</span>
			<span class="current">
				<a href=#>1</a>
			</span>
			<span class="disabled">
				<a class="disabled" href=#>2</a>
			</span>
			<span class="disabled">
				<a class="disabled" href=#>3</a>
			</span>
			<span class="prevnext">
				<a href="#">Next >></a>
			</span>
		</div>
	</div>
	<div id="myTable" class="tablesorter">
		<table id="zebra">
			<tr>
				<th>No</th>
				<th>ID User</th>
				<th>Password</th>
				<th>Publisher</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Level</th>
				<th class="center" colspan="2">Action</th>
			</tr>
			<tr class="odd">
				<td>1</td>
				<td>andrefadila@gmail.com</td>
				<td>12345qwe</td>
				<td>BeritaSatu</td>
				<td>Fadila Andre</td>
				<td>085717598xxx</td>
				<td>andrefadila@gmail.com</td>
				<td>Administrator</td>
				<td class="center"><button id='btn-edit'>Edit</button></td>
				<td class="center"><button id='btn-hapus'>Hapus</button></td>
			</tr>
			<tr>
				<td>2</td>
				<td>andrefadila@gmail.com</td>
				<td>12345qwe</td>
				<td>Campus Life</td>
				<td>Fadila Andre</td>
				<td>085717598xxx</td>
				<td>andrefadila@gmail.com</td>
				<td>Publisher</td>
				<td class="center"><button id='btn-edit'>Edit</button></td>
				<td class="center"><button id='btn-hapus'>Hapus</button></td>
			</tr>
			<tr class="odd">
				<td>3</td>
				<td>andrefadila@gmail.com</td>
				<td>12345qwe</td>
				<td>BeritaSatu</td>
				<td>Fadila Andre</td>
				<td>085717598xxx</td>
				<td>andrefadila@gmail.com</td>
				<td>Administrator</td>
				<td class="center"><button id='btn-edit'>Edit</button></td>
				<td class="center"><button id='btn-hapus'>Hapus</button></td>
			</tr>
			<tr>
				<td>4</td>
				<td>andrefadila@gmail.com</td>
				<td>12345qwe</td>
				<td>Campus Life</td>
				<td>Fadila Andre</td>
				<td>085717598xxx</td>
				<td>andrefadila@gmail.com</td>
				<td>Publisher</td>
				<td class="center"><button id='btn-edit'>Edit</button></td>
				<td class="center"><button id='btn-hapus'>Hapus</button></td>
			</tr>
		</table>
	</div>
</div>