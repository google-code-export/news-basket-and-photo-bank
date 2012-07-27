<?php

	if(isset($_GET['item']))
	{
		include_once( 'config.php' );
		$item = base64_decode($_GET['item']);
		$file = ATTACHMENTS_DIR.DIRECTORY_SEPARATOR.$item;
		if(file_exists($file)){
			header("Content-type: application/force-download"); 
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-length: ".filesize($file)); 
			header("Content-disposition: attachment; filename=".basename($file)."");
			readfile("$file");
		}
		else
		{
			echo 'Sorry we are not able to find the requested file';
		}
	}
	else
	{
			echo 'Sorry we are not able to find the requested file';
	}

?>