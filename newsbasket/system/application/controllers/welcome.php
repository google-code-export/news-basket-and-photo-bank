<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
		$this->load->scaffolding('users');
	}
	
	function index()
	{
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */