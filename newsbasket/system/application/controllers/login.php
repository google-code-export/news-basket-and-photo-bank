<?php

class Login extends Controller {

	function Login() {
		parent::Controller();	
	}
	
	function index() {
		$data_login['main_content'] = 'login_view';
		$data_login['form_action']	= site_url('login/loginProcess');
		$this->load->view('template', $data_login);
	}
	
	function loginProcess() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		//$this->form_validation->set_message('required','Isikan %s Anda');
        
		$this->load->helper('security');
		if ($this->form_validation->run() == TRUE) {
			$username = $this->input->post('username');
			$password = dohash($this->input->post('password'));
			
			$this->load->model('Users_model','',TRUE);
			if ($this->Users_model->checkUser($username, $password) == TRUE)
			{
				$user_level = $this->Users_model->getLevel($username)->row()->user_level;
                $data = array('id_user' => $username, 'login' => TRUE, 'user_level' => $user_level);
				$this->session->set_userdata($data);
				if ($user_level == 'administrator') {
					redirect('admin/manage_user');
				}
				else {
					redirect('user/home');
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