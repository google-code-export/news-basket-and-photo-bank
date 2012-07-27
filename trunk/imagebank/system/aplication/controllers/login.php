<?php

class Login extends Controller {

	function Login() {
		parent::Controller();	
		   $this->load->library('grocery_CRUD');
	}
	
	function index() {
		$data_login['main_content'] = 'login_view';
		$data_login['form_action']	= site_url('login/loginProcess');
		
		$this->load->view('templates', $data_login);
	}
	
	function loginProcess() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		//$this->form_validation->set_message('required','Isikan %s Anda');
        
		$this->load->helper('security');
		if ($this->form_validation->run() == TRUE) {
			$username = $this->input->post('username');
			$password = ($this->input->post('password'));
			
			$this->load->model('Users_model','',TRUE);
			if ($this->Users_model->checkUser($username, $password) == TRUE)
			{
				$user_level = $this->Users_model->getLevel($username)->row()->user_level;
                $data = array(
                				'username' => $username, 
                				'login' => TRUE,
                				 'user_level' => $user_level,
                				 'ip_address'>'string- user IP address'
								 
								 );
				$this->session->set_userdata($data);
				if ($user_level == 'administrator') {
					$data_article['page_title']		= 'Manage Users	| Admin ';
					$this->session->set_flashdata('flash_message','You are Logged in.');
				
				redirect('admin/manageUser');
				}
				else {
					$this->session->set_flashdata('flash_message','You are Logged in.');
					
					redirect('gallery');
				}
			}
			else {
				$this->session->set_flashdata('message', 'Wrong username or password!');
				redirect('login');
			}
		}
	}

	function logoutProcess()
	{
		$this->session->sess_destroy();
		$username = $this->session->userdata('username');
		$this->load->model('Users_model','',TRUE);
		//$this->users_model->update_last_logged_out($username);
		redirect('login', 'refresh');
	}
	
	function test() {
		$this->load->helper('security');
		$data['hash'] = dohash($this->input->post('password'));
		$this->load->view('welcome_message', $data);
	}
}

/* End of file login.php */
/* Location: ./system/application/controllers/login.php */