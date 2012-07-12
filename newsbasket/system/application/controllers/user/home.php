<?php

class Home extends Controller {

	function Home()
	{
		parent::Controller();
	}
	
	function index()
	{
		$data_home['main_content'] = 'user/home_view';
		$this->load->view('user/template', $data_home);
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/user/home.php */