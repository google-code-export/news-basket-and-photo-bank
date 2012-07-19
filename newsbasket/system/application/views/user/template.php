<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title>Home | News Basket</title>
    <meta charset="utf-8" />
    <meta name="description" content="Login News Basket" />
    <meta name="author" content="BeritaSatu" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/template.css';?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/user.css';?>" />
	<script type="text/javascript" src="../library/tinymcpuk-0.3/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			plugins : "advimage,fullscreen,searchreplace",
			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,cut,copy,paste,|,undo,redo,|,image,link,unlink,|,search,replace,|,sub,sup,|,fullscreen",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_buttons4 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "center",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : false,
			file_browser_callback : "fileBrowserCallBack",
			apply_source_formatting : true
		});
		
		function fileBrowserCallBack(field_name, url, type, win) {
			var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
			var enableAutoTypeSelection = true;
			
			var cType;
			tinymcpuk_field = field_name;
			tinymcpuk = win;
			
			switch (type) {
				case "image":
					cType = "Image";
					break;
				case "flash":
					cType = "Flash";
					break;
				case "file":
					cType = "File";
					break;
			}
			
			if (enableAutoTypeSelection && cType) {
				connector += "&Type=" + cType;
			}
			
			window.open(connector, "tinymcpuk", "modal,width=600,height=400");
		}
	</script>
</head>

<body>
	<div class="header-bar">
		<?php $this->load->view('header', $username); ?>
	</div>
	<div class="container">
		<div class="navigation">
			<div class="navigation-inner">
				<?php $this->load->view('user_navigation'); ?>
			</div>
		</div>
		<div id="main" class="main">
			<?php $this->load->view($main_view); ?>
		</div>
		<div class="footer-bar">
			<?php $this->load->view('footer'); ?>
		</div>
	</div>
</body>

</html>