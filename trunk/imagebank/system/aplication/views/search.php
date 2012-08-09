
<meta charset="UTF-8">


<style>
	/* Autocomplete
	 ----------------------------------*/
	.ui-autocomplete {
		position: absolute;
		cursor: default;
	}
	.ui-autocomplete-loading {
		background: white url('http://jquery-ui.googlecode.com/svn/tags/1.8.2/themes/flick/images/ui-anim_basic_16x16.gif') right center no-repeat;
	}*/

	/* workarounds */
	* html .ui-autocomplete {
		width: 1px;
	}/* without this, the menu expands to 100% in IE6 */

	/* Menu
	 ----------------------------------*/
	.ui-menu {
		list-style: none;
		padding: 2px;
		margin: 0;
		display: block;
	}
	.ui-menu .ui-menu {
		margin-top: -3px;
	}
	.ui-menu .ui-menu-item {
		margin: 0;
		padding: 0;
		zoom: 1;
		float: left;
		clear: left;
		width: 100%;
		font-size: 80%;
	}
	.ui-menu .ui-menu-item a {
		text-decoration: none;
		display: block;
		padding: .2em .4em;
		line-height: 1.5;
		zoom: 1;
	}
	.ui-menu .ui-menu-item a.ui-state-hover, .ui-menu .ui-menu-item a.ui-state-active {
		font-weight: normal;
		margin: -1px;
	}
</style>

<script type="text/javascript">
		$(this).ready( function() {
	$("#id_imagetag").autocomplete({
	minLength: 3,
	source:
	function(req, add){
	$.ajax({
	url: "<?php echo site_url('user/search'); ?>
		",
		dataType: 'json',
		type: 'POST',
		data: req,
		success:
		function(data){
		if(data.response =="true"){
		add(data.message);
		}
		},
		});
		},
		select:
		function(event, ui) {
		$("#result").append(
		"<li>"+ ui.item.value + "</li>"
		);
		},
		});
		});
</script>

<div id="menu_tab">
	<ul id="menu_tab">
		<li id="tab_dropdown">
			<form name="dropdown_cat" action="http://localhost/imagebank/gallery/getCategories" method="post">
			<select name="id_categories">
			<option value ='#' selected="selected">Select Categories</option>	
			<?php 
	foreach ($dropdown as $row) {
		echo "<option value ='$row->id_category'>$row->category_name</option>";
	}
	
	?>

			</select>
			<button id="submit" class="btn btn-primary" value="go" type="submit" name="submit">go</button>
			</form>
		</li>
		<li id="tab_search">
			<form action="http://localhost/imagebank/gallery/searchImage" method="post" name="search_form">
				<input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" name="key" id="id_imagetag" style="" type="text" value="Enter Keyword" onclick="if(this.value=='Enter Keyword'){this.value=''}" onblur="if(this.value==''){this.value='Enter Keyword'}">
				<button id="submit" class="btn btn-primary" value="search" type="submit" name="submit">
					search
				</button>
			</form>
		</li>
	</ul>
</div>

