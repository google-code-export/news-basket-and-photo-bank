<?php

class Home extends Controller {

	function Home()
	{
		parent::Controller();
	}
	
	function index()
	{
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') != 'reporter') {
			$this->loadHome();
		}
		else {
			redirect('login');
        }
	}
	
	function loadHome() {
		$data_home['main_view'] = 'reporter/home_view';
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_home['username'] = $username;
		
		$this->load->view('reporter/template', $data_home);
	}
	
}

/* End of file home.php */
/* Location: ./system/application/controllers/user/home.php */