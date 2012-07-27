<?php
	require_once('ImapMailbox.php');
	include_once( 'config.php' );
	$mailId = $_GET['id'];
	$mailbox = new ImapMailbox('{imap.gmail.com:993/imap/novalidate-cert/ssl}imap', GMAIL_EMAIL, GMAIL_PASSWORD,ATTACHMENTS_DIR,'utf-8');
	$mails[] = $mailbox->getMail($mailId,1);
?>