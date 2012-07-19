<?php

class Dashboard extends Controller {
	
	function Dashboard() {
		parent::Controller();	
	}
	
	function index() {
		$this->load->view('admin/dashboard');
	}
	
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/admin/dashboard.php */