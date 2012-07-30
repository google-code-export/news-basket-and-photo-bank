<?php

class Dashboard extends Controller {
	
	function Dashboard() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->home();
		}
		else {
			redirect('login');
        }
	}
	
	function home() {
		$admin['page_title'] = 'Dashboard | Admin Newsbasket';
		$admin['username']   = $this->session->userdata['username'];
		$admin['main_view']  = 'admin/dashboard';
		$this->load->view('admin/template', $admin);
	}
	
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/admin/dashboard.php */