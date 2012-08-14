<?php
	$message_success = $this->session->flashdata('message_success');
	echo !empty($message_success) ? "<p class='alert alert-success'>" . $message_success . "</p>": "";
	
	$message_failed = $this->session->flashdata('message_failed');
	echo !empty($message_failed) ? "<p class='failed'>" . $message_failed . "</p>": "";
?>