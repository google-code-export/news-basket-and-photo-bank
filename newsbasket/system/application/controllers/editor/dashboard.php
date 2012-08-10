<?php

class Dashboard extends Controller {
	
	function Dashboard() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'editor') {
			$this->home();
		}
		else {
			redirect('login');
        }
	}
	
	function home() {
		$user['page_title']  = 'Dashboard | Newsbasket';
		$user['username']    = $this->session->userdata['username'];
		$user['main_view']   = 'editor/dashboard_view';
		$user['active']  	 = 'dashboard';
		$this->load->view('editor/template', $user);
	}
	
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/user/dashboard.php */