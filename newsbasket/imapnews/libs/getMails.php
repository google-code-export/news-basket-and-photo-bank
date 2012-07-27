<?php
	if(isset($_GET['param']))
	{
		$search_for = $_GET['param'];
	}
	else
	{
		$search_for = 'UNSEEN';
	}
	require_once('ImapMailbox.php');
	include_once( 'config.php' );
	$mailbox = new ImapMailbox('{imap.gmail.com:993/imap/novalidate-cert/ssl}imap', GMAIL_EMAIL, GMAIL_PASSWORD,ATTACHMENTS_DIR,'utf-8');
	$mails = array();
	foreach($mailbox->searchMails($search_for) as $mailId) {
		$mail = $mailbox->getMail($mailId);
		$mails[] = $mail;
	}
?>