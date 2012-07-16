<?php

class Manage_user extends Controller {
	
	//limitasi tabel
	var $limit = 10;
	
	function Manage_user() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->loadUsers('all');
		}
		else {
			redirect('login');
        }
	}
	
	function loadUsers($key) {
		$data_user['page_title']	= 'Manage User | Admin News Basket';
		$data_user['main_view'] 	= 'admin/manage_user_view';
		$data_user['form_action']	= site_url('admin/manage_user/addUser');

		$this->load->model('Category_model','',TRUE);
		$category = $this->Category_model->getAllCategories();
		$data_user['navigasi']['category'] = $category;
		
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_user['navigasi']['publisher'] = $publisher;	
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Load data dari tabel user
		$this->load->model('Users_model','',TRUE);
		if ($key == 'all') { // tampilkan semua
			$users  	= $this->Users_model->getAllUser($this->limit, $offset);
			$num_rows 	= $this->Users_model->countAll();
			$data_user['user_table'] = $users;
		}
		else if (is_numeric($key)) { // tampilkan dengan kriteria publisher
			$users  	= $this->Users_model->getAllUserByPublisher($this->limit, $offset, $key);
			$num_rows 	= $this->Users_model->countUserByPublisher($key);
			$data_user['user_table'] = $users;
		}
		else { // tampilkan dengan kriteria level
			$users  	= $this->Users_model->getAllUserByLevel($this->limit, $offset, $key);
			$num_rows 	= $this->Users_model->countUserByLevel($key);
			$data_user['user_table'] = $users;
		}
		
		
		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_user/loadUsers');
		$config['total_row']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_user['pagination']   	= $this->pagination->create_links();
				
		/* Set template tabel
		$tmpl = array(
			'table_open'			=> '<table id="zebra">',
			'heading_cell_start'  	=> '<th>',
			'heading_cell_end'    	=> '</th>',
			'row_alt_start'   	 	=> '<tr class="odd">',
			'row_alt_end'     	 	=> '</tr>'
		 );
		$this->table->set_template($tmpl);
	
		// Set heading untuk tabel
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Username', 'Password', 'Publisher', 'Name', 'Phone', 'Email', 'Level', 'Action');
		
		$num = 1;
		foreach ($users as $column)
		{
			$this->table->add_row(
				$num, $column->id_user, $column->password, $this->convertIDSourcetoName($column->id_source),
				$column->name, $column->phone, $column->email, $column->user_level,
				"<button id='btn-edit'>Edit</button>",
				"<button id='btn-delete'>Delete</button>"
				//anchor('admin/manage_user/update/'.$column->idb,'Edit',array('class' => 'update')).'<p></p>'.
				//anchor('admin/manage_user/delete/'.$column->idb,'Delete',array('class' => 'delete','onclick'=>"return confirm('Anda yakin akan menghapus berita ini?')"))
		    );
			$num++;
		}*/
		
		$data_user['table'] = $this->table->generate();

		$this->load->view('admin/template', $data_user);
	}
	
	function addUser() {
		// Set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required');		
		//$this->form_validation->set_rules('publisher', 'Publisher', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		//$this->form_validation->set_rules('user-level', 'User-level', 'required');
		
		$this->load->helper('security');
		if ($this->form_validation->run() == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$new_user  = array(
				'id_user'		=> $this->input->post('username'),
				'id_source'		=> $this->input->post('publisher'),
				'password'		=> dohash($this->input->post('password'), 'md5'),
				'name'      	=> $this->input->post('name'),
				'phone'       	=> $this->input->post('phone'),
				'email'   		=> $this->input->post('email'),
				'user_level' 	=> $this->input->post('user-level')
			);
			// Proses simpan data absensi
			$this->load->model('Users_model','',TRUE);
			$this->Users_model->addUser($new_user);
			
			$this->session->set_flashdata('message_success', 'Add new user successfull!');
			redirect('admin/manage_user');
		}
		
		else {
			$this->session->set_flashdata('message_failed', 'Add new user failed!');
			redirect('admin/manage_user');
		}
	}
	
	function editUser() {
		$this->load->model('Users_model','',TRUE);
		$user = $this->Users_model->getUserByID($idb)->row();
		
		/*
		$this->session->set_userdata('idb', $beritanya->idb);
			
		// Data untuk mengisi field2 form
		$berita['default']['tanggal'] 	= date('d-m-Y', strtotime($beritanya->tanggal));
		$berita['default']['judul'] 	= $beritanya->judul;
		$berita['default']['artikel'] 	= $beritanya->artikel;
		//$berita['default']['foto'] 	= $beritanya->foto;
		$berita['default']['tag'] 		= $beritanya->tag;
		$berita['default']['statusb'] 	= $beritanya->statusb;

		if ($this->session->userdata('login') == TRUE) {
			$this->load->view('admin/template', $berita);
		}*/
	}
	
	function deleteUser($id_user) {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->model('Users_model','',TRUE);
			$this->Users_model->deleteUser($id_user);
			$this->session->set_flashdata('message_success', 'Delete user successfull!');

			redirect('admin/manage_user');
		}  
	}
	
	// validasi dengan AJAX
	function checkUsernameAvailability() {
		$username = $this->input->post('username');
		$this->load->model('Users_model','',TRUE);
		$this->Users_model->checkUsernameAvailability($username);
		
		if ($this->Users_model->checkUsernameAvailability($username) == TRUE) {
			echo "no"; // username ini terpakai
		} 
		else if (strlen($username) == 0) {
			echo "no";  // username ini terpakai
		}
		else {
			echo "yes";  // username ini tidak terpakai
		}
		
	}
	
	// validasi dengan AJAX
	function checkConfirmationPassword() {
		$password = $this->input->post('password');
		$confirm_password = $this->input->post('confirm_password');
		
		if ($password == $confirm_password && strlen($password) != 0 && strlen($confirm_password) != 0) {
			echo "yes"; // password sama
		} 
		else {
			echo "no";  //password tidak sama
		}
	}

	// validasi dengan AJAX
	function checkPhoneNumber() {
		$phone = $this->input->post('phone');
		
		if (is_numeric($phone) && strlen($phone) <= 12) {
			echo "yes"; // numerik
		} 
		else {
			echo "no";  // bukan numerik
		}
	}
}

/* End of file manage_user.php */
/* Location: ./system/application/controllers/admin/manage_user.php */