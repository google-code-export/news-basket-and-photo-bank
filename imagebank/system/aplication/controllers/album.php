<?php
class Album extends Controller{
	
	
	function Album(){
		parent::Controller();
	}
	
	function index(){
		$username = $this->session->userdata('username');
		$user_level = $this->session->userdata('user_level');
		$data['page_title'] = 'my galleries';
		$data['main_view'] = 'album_index';
		$data['h2_title'] = 'Album > Create Album';
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		$this->load->view('template',$data);

	}
	
	function create(){
		$username = $this->session->userdata('username');
		$user_level = $this->session->userdata('user_level');
		$data['page_title'] = 'Create New album';
		$data['form_action'] = site_url('album/add');
		$data['h2_title'] = 'Album > Create Album';
		$data['main_view'] = 'create_album';
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		
		if($this->session->userdata('login') == TRUE){
		$this->load->view('template',$data);	
		}
		
			
			
		}
		
		function add(){
			
			//inialisasi data umnum
			$username=$this->session->userdata('username');
			$user_level=$this->session->userdata('user_level');
		$data['page_title'] = 'Create New album';
		$data['form_action'] = site_url('album/add');
		$data['main_view'] = 'create_album';
		$data['h2_title'] = 'Album > Create Album';
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		$this->form_validation->set_rules('album','Name Album','required');
		
		
		if (($this->form_validation->run() == TRUE)&&($this->session->userdata('login') == TRUE)){
			
			$this->load->model('album_model','',TRUE);
			$this->album_model->create();
		
		$this->session->set_flashdata('message', 'Satu album baru berhasil disimpan!');
		redirect('album/index');
		}else{
			$this->session->set_flashdata('message', 'album name cannot empty');
			redirect('album/create');
		}
			
		
		
			
		


}
}
?>