<?php

class Manage_user extends Controller {
	
	//limitasi tabel
	var $limit = 10;
	
	function Manage_user() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->loadUsers();
		}
		else {
			redirect('login');
        }
	}
	
	function loadUsers() {
		$data_user['page_title']	= 'Manage User | Admin News Basket';
		$data_user['main_view'] 	= 'admin/manage_user_view';
		$data_user['form_action']	= site_url('admin/manage_user/addUser');
		$data_user['form_add_user'] = 'admin/form/add_user_form';

		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_user['navigasi']['publisher'] = $publisher;	
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_user['username'] = $username;
		
		// Opsi load data dari tabel user 
		$this->load->model('Users_model','',TRUE);
		$users  	= $this->Users_model->getAllUser($this->limit, $offset, $username);
		$num_rows 	= $this->Users_model->countAll();
		$data_user['user_table'] = $users;
	
		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_user/loadUsers');
		$config['total_row']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_user['pagination']   	= $this->pagination->create_links();
		
		$this->load->view('admin/template', $data_user);
	}
	
	function detailUser($id_user) {
		$data_user['page_title']	= 'Detail User | Admin News Basket';
		$data_user['main_view'] 	= 'admin/detail/user_detail_view';
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_user['username'] = $username;
		
		// ambil data user dari ID nya
		$this->load->model('Users_model','',TRUE);
		$user = $this->Users_model->getUserByID($id_user)->row();
		
		//simpan session id-user yang ingin di edit
		$this->session->set_userdata('id_user', $user->id_user);
			
		// user profile
		$data_user['user']['id_user'] 		= $user->id_user;
		$data_user['user']['publisher'] 	= $user->source_name;
		$data_user['user']['name'] 			= $user->name;
		$data_user['user']['phone']			= $user->phone;
		$data_user['user']['email'] 		= $user->email;
		$data_user['user']['user_level']	= $user->user_level;
		
		// activity log
		$data_user['user']['activity_log']  = $this->Users_model->getUserArticleByIDUser($id_user);
		
		// user statistic
		$data_user['user']['created'] = $this->Users_model->countStatistic($id_user,'row_article');
		$data_user['user']['edited'] = $this->Users_model->countStatistic($id_user,'edited');
		$data_user['user']['published'] = $this->Users_model->countStatistic($id_user,'published');
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_user);
		}
	}
	
	function addUser() {
		// Set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required');		
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		$this->load->helper('security');
		if ($this->form_validation->run() == TRUE && $this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
			$new_user  = array(
				'id_user'		=> $this->input->post('username'),
				'id_source'		=> $this->input->post('publisher'),
				'password'		=> dohash($this->input->post('password')),
				'name'      	=> $this->input->post('name'),
				'phone'       	=> $this->input->post('phone'),
				'email'   		=> $this->input->post('email'),
				'user_level' 	=> $this->input->post('user-level'),
				'date_created'	=> date('Y-m-d G:i:s')
			);
			// Proses simpan data absensi
			$this->load->model('Users_model','',TRUE);
			$this->Users_model->addUser($new_user);
			
			$message = 'Add new user '.$new_user['id_user'].' successfull!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_user');
		}
		
		else {
			$message = 'Add new user '.$new_user['id_user'].' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('admin/manage_user');
		}
	}
	
	function editUser($id_user) { 
		$data_user['page_title']	 	= 'Edit User | Admin News Basket';
		$data_user['main_view'] 	 	= 'admin/manage_user_view';
		$data_user['form_action']	 	= site_url('admin/manage_user/addUser');
		$data_user['form_action_edit']	= site_url('admin/manage_user/editUserProcess');
		$data_user['form_edit_user'] 	= 'admin/form/edit_user_form';
		
		// untuk option form
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_user['publisher'] = $publisher;
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_user['username'] = $username;
		
		// Opsi load data dari tabel user 
		$this->load->model('Users_model','',TRUE);
		$users  	= $this->Users_model->getAllUser($this->limit, $offset, $username);
		$num_rows 	= $this->Users_model->countAll();
		$data_user['user_table'] = $users;
		
		// ambil data user dari ID nya
		$user = $this->Users_model->getUserByID($id_user)->row();
		
		//simpan session username yang ingin di edit
		$this->session->set_userdata('id_user', $user->id_user);
			
		$data_user['default']['name'] 		= $user->name;
		$data_user['default']['password'] 	= $user->password;
		$data_user['default']['phone'] 		= $user->phone;
		$data_user['default']['email'] 		= $user->email;
		$data_user['default']['level'] 		= $user->user_level;
		$data_user['default']['publisher']	= $user->id_source;
	
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_user);
		}
	}
	
	function editUserProcess() {
		if ($this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
			
			// kondisi password
			$new_password = $this->input->post('new-password');
			if(!empty($new_password)) {
				$password = $new_password;
			}
			else {
				$password = $this->input->post('old-password');
			}
			
			// Prepare data untuk disimpan di tabel
			$user  = array(
				'name'		=> $this->input->post('name'),
				'id_source'	=> $this->input->post('publisher'),
				'password'  => $password,
				'email'     => $this->input->post('email'),
				'phone'     => $this->input->post('phone'),
				'user_level'=> $this->input->post('user-level')
			);
			
			// Proses simpan data
			$id_user = $this->session->userdata('id_user');
			$this->load->model('Users_model','',TRUE);
			$this->Users_model->updateUser($id_user, $user);
			
			$message = 'User '.$id_user.' has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			//$key = $this->session->userdata('current_table');
			redirect('admin/manage_user');
		}
		else {
			$message = 'Update user '.$id_user.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			//$key = $this->session->userdata('current_table');
			redirect('admin/manage_user');
		}
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