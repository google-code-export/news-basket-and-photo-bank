<?php
class Login extends Controller {
	
	function Login()
	{
		parent::Controller();
		$this->load->model('user_model', '', TRUE);
	}
	
	function index()
	{
		$data['main_content']= 'login_user';
		$this->load->view('includes/template', $data);
	 }
	
	function validate_credentials()
	{
		$this->load->model('user_model');
		$query = $this->user_model->validate();
		
		if($query)
		{
			$data = array(
				'username' => $this->input->post('Username'),
				'is_logged_in' => true
			);
			
			redirect('index.php/site');
		}
		else 
			{
				$this->index();
			}
		
	}
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


?>