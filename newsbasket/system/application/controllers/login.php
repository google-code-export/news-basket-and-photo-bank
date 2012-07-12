<?php

class Login extends Controller {

	function Login()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$data_login['main_content'] = 'login_view';
		$this->load->view('template', $data_login);
	}
}

/* End of file login.php */
/* Location: ./system/application/controllers/login.php */