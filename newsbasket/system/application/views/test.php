<html>
<body>
	<?php foreach($mails as $key => $value) {
		echo "Nama : ".$value->fromName."<br>"; //author
		echo "Dari : ".$value->fromAddress."<br>"; //author
		echo "Tanggal : ".$value->date."<br>"; //article
		echo "Ke : ".$value->toString."<br><br>";
		$headers = '<div><i>from:</i> '.$value->fromAddress.'</div>
					<div><i>to:</i> '.$value->toString.'</div>
					<div><i>date:</i> '.$value->date.'</div>
					<div><i>subject:</i> '.$value->subject.'</div>
					';
		echo $headers."<br>";
		echo $value->subject."<br>";
		echo $value->textHtml;
	} ?>
</body>
</html>