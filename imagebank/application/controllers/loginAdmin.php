<?php
class LoginAdmin extends Controller {
	
	function loginAdmin()
	{
		parent::Controller();
	}
	
	function index()
	{
		
		$this->load->view('loginAdmin');
	 }
	function verify(){
		if($this->input->post('username')){
			$u=$this->input->post('username');
			$pw = $this->input->post('password');
			$this->model('MAdmin','',TRUE)->verifyUser($u,$pw);
			if($_SESSION['id_user']>0){
				redirect('admin/dashboard','refresh');
			}
		}
		$data['main']= 'login';
		$data['title']="Image Bank | Admin Login";
		$this->load->vars($data);
		$this->load->view('loginAdmin');
	}
}