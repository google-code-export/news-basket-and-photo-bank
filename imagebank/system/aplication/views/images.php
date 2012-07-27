<?php
  $im - imagecreatefromstring($images);
  
  if($im !== false){
  	header('Content-Type: image/jpeg');
	  imagejpeg($im);
	  imagedestroy($im);
  }
  else{
  	echo 'error';
  }
?>