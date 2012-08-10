<?php

class Dashboard extends Controller {
	
	function Dashboard() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'reporter') {
			$this->home();
		}
		else {
			redirect('login');
        }
	}
	
	function home() {
		$reporter['page_title']  = 'Dashboard | Newsbasket';
		$reporter['username']    = $this->session->userdata['username'];
		$reporter['main_view']   = 'reporter/dashboard_view';
		$reporter['active']  	 = 'dashboard';
		$this->load->view('reporter/template', $reporter);
	}
	
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/reporter/dashboard.php */