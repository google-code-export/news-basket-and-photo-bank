<?php

class Manage_user extends Controller {
	
	//limitasi tabel
	var $limit = 13;
	
 
	function Manage_user() {
		parent::Controller();
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher' || 'viewer') {
			$this->load_users(0);
		}
		else {
			redirect('login');
        }
	}
	
	function load_users($offset = 0) {
		$data_user['page_title']			= 'Manage User | News Basket';
		$data_user['main_view'] 			= 'user/manage_user_view';
		$data_user['form_action']			= site_url('user/manage_user/add_user');
		$data_user['form_add_user'] 		= site_url('user/form/add_user_form');
		$data_user['form_action_search']	= site_url('user/manage_user/search_user');

		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_user['navigasi']['publisher'] = $publisher;	
		
		// Offset
		$uri_segment 	= 3;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Siapa yang login dan membuat navigasi aktif
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_user['username'] = $username;
		$data_user['active']   = 'user';
		
		// Opsi load data dari tabel user 
		$this->load->model('Users_model','',TRUE);
		$users  	= $this->Users_model->getAllUser($this->limit, $offset, $username);
		$num_rows 	= $this->Users_model->countAll() - 1;
		$data_user['user_table'] = $users;
	
		// Membuat pagination
		$config['base_url']    		= site_url('user/manage_user/load_users');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_user['pagination']   	= $this->pagination->create_links();
		
		$this->load->view('user/template', $data_user);
	}
	
	function detail_user($id_user) {
		$data_user['page_title']		= 'Detail User | News Basket';
		$data_user['main_view'] 		= 'user/detail/user_detail_view';
		$data_user['user_property']		= 'user/detail/user_detail_property';
		$link_manage_user				= site_url('user/manage_user');
		$data_user['breadcrumb']		= "<a href='$link_manage_user' style='color: white;'>Manage User</a> > User Detail";
		$data_user['form_action_edit']	= site_url('user/manage_user/edit_user').'/'.$id_user;
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_user['username'] = $username;
		$data_user['active']   = 'user';
		
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
		$data_user['user']['create'] 	= $this->Users_model->countStatistic($id_user, 'row_article');
		$data_user['user']['edit'] 		= $this->Users_model->countStatistic($id_user, 'edited');
		$data_user['user']['publish']	= $this->Users_model->countStatistic($id_user, 'published');
		$data_user['user']['delete']	= $this->Users_model->countStatistic($id_user, 'deleted');
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher' || 'viewer') {
			$this->load->view('user/template', $data_user);
		}
	}
	
	function edit_user($id_user) { 
		$data_user['page_title']	 	= 'Edit User | News Basket';
		$data_user['main_view'] 	 	= 'user/detail/user_detail_view';
		$data_user['edit_user_form']	= 'user/form/edit_user_form';
		$link_manage_user				= site_url('user/manage_user');
		$link_detail_user				= site_url('user/manage_user/detail_user').'/'.$id_user;
		$data_user['breadcrumb']		= "<a href='$link_manage_user' style='color: white;'>Manage User</a> > 
											   <a href='$link_detail_user' style='color: white;'>User Detail</a> 
											   > Edit User";
		$data_user['form_action_edit']	= site_url('user/manage_user/edit_user_process').'/'.$id_user;
		
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
		$data_user['active']   = 'user';
		
		// Opsi load data dari tabel user 
		$this->load->model('Users_model','',TRUE);
		$users  	= $this->Users_model->getAllUser($this->limit, $offset, $username);
		$num_rows 	= $this->Users_model->countAll();
		$data_user['user_table'] = $users;
		
		// Membuat pagination
		$config['base_url']    		= site_url('user/manage_user/load_users');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_user['pagination']   	= $this->pagination->create_links();
		
		// ambil data user dari ID nya
		$user = $this->Users_model->getUserByID($id_user)->row();
		$data_user['user']['id_user'] = $id_user;
		
		//simpan session username yang ingin di edit
		$this->session->set_userdata('id_user', $user->id_user);
			
		$data_user['default']['name'] 		= $user->name;
		$data_user['default']['password'] 	= $user->password;
		$data_user['default']['phone'] 		= $user->phone;
		$data_user['default']['email'] 		= $user->email;
		$data_user['default']['level'] 		= $user->user_level;
		$data_user['default']['publisher']	= $user->id_source;
		
		// activity log
		$data_user['user']['activity_log']  = $this->Users_model->getUserArticleByIDUser($id_user);
		
		// user statistic
		$data_user['user']['create'] 	= $this->Users_model->countStatistic($id_user, 'row_article');
		$data_user['user']['edit'] 		= $this->Users_model->countStatistic($id_user, 'edited');
		$data_user['user']['publish']	= $this->Users_model->countStatistic($id_user, 'published');
		$data_user['user']['delete']	= $this->Users_model->countStatistic($id_user, 'deleted');
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher' || 'viewer') {
			$this->load->view('user/template', $data_user);
		}
	}
	
	function edit_user_process() {
		if ($this->session->userdata('user_level') == 'publisher' || 'viewer' && $this->session->userdata('login') == TRUE) {
			$this->load->helper('security');
			
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
				'password'  => dohash($password),
				'email'     => $this->input->post('email'),
				'phone'     => $this->input->post('phone')
			);
			
			// Proses simpan data
			$id_user = $this->session->userdata('id_user');
			$this->load->model('Users_model','',TRUE);
			$this->Users_model->updateUser($id_user, $user);
			
			$message = 'User '.$id_user.' has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			//$key = $this->session->userdata('current_table');			
			redirect('user/manage_user/detail_user'.'/'.$id_user);
		}
		else {
			$message = 'Update user '.$id_user.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			//$key = $this->session->userdata('current_table');
			redirect('user/manage_user/detail_user'.'/'.$id_user);
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
/* Location: ./system/application/controllers/user/manage_user.php */