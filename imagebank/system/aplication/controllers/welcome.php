<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('welcome_message');
	}
	
	function verify(){
		if($this->input->post('username')){
			$u=$this->input->post('username');
			$pw = $this->input->post('password');
			$this->MAdmins->verifyUser($u,$pw);
			if($_SESSION['id_user']>0){
				redirect('admin/dashboard','refresh');
			}
		}
		$data['main']= 'login';
		$data['title']="Image Bank | Admin Login";
		$this->load->vars($data);
		$this->load->view('home_admin');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */