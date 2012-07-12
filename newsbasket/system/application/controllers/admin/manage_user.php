<?php

class Manage_user extends Controller {

	function Manage_user()
	{
		parent::Controller();
	}
	
	function index()
	{
		$data_manage_user['main_content'] = 'admin/manage_user_view';
		$this->load->view('admin/template', $data_manage_user);
	}
	
	function add_user() {
		$this->load->view('admin/form/add_user_form');
	}
}

/* End of file manage_user.php */
/* Location: ./system/application/controllers/admin/manage_user.php */