<?php

class Manage_editor extends Controller {
	
	//limitasi tabel
	var $limit = 13;
	
 
	function Manage_editor() {
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
	
	function detail_editor($id_user) {
		$data_user['page_title']		= 'Detail Editor | News Basket';
		$data_user['main_view'] 		= 'editor/detail/editor_detail_view';
		$data_user['user_property']		= 'editor/detail/editor_detail_property';
		$link_manage_editor				= site_url('editor/manage_editor');
		$data_user['breadcrumb']		= "<a href='$link_manage_editor' style='color: white;'>Manage Editor</a> > Editor Detail";
		$data_user['form_action_edit']	= site_url('editor/manage_editor/edit_editor').'/'.$id_user;
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_user['username'] = $username;
		$data_user['active']   = 'editor';
		
		// ambil data editor dari ID nya
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
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'editor') {
			$this->load->view('editor/template', $data_user);
		}
	}
	
	function edit_editor($id_user) { 
		$data_user['page_title']	 	= 'Edit Editor | News Basket';
		$data_user['main_view'] 	 	= 'editor/detail/editor_detail_view';
		$data_user['edit_user_form']	= 'editor/form/edit_editor_form';
		$link_manage_editor				= site_url('editor/manage_editor');
		$link_detail_editor				= site_url('editor/manage_editor/detail_editor').'/'.$id_user;
		$data_user['breadcrumb']		= "<a href='$link_manage_editor' style='color: white;'>Manage editor</a> > 
											   <a href='$link_detail_editor' style='color: white;'>Editor Detail</a> 
											   > Edit editor";
		$data_user['form_action_edit']	= site_url('editor/manage_editor/edit_editor_process').'/'.$id_user;
		
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
		$data_user['active']   = 'editor';
		
		// Opsi load data dari tabel editor 
		$this->load->model('Users_model','',TRUE);
		$users  	= $this->Users_model->getAllUser($this->limit, $offset, $username);
		$num_rows 	= $this->Users_model->countAll();
		$data_user['user_table'] = $users;
		
		// Membuat pagination
		$config['base_url']    		= site_url('editor/manage_editor/load_editor');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_user['pagination']   	= $this->pagination->create_links();
		
		// ambil data editor dari ID nya
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
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'editor') {
			$this->load->view('editor/template', $data_user);
		}
	}
	
	function edit_editor_process() {
		if ($this->session->userdata('user_level') == 'editor' && $this->session->userdata('login') == TRUE) {
			
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
			
			$message = 'Editor '.$id_user.' has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			//$key = $this->session->userdata('current_table');
			redirect('editor/manage_editor/detail_editor'.'/'.$id_user);
		}
		else {
			$message = 'Update editor '.$id_user.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			//$key = $this->session->userdata('current_table');
			redirect('editor/manage_editor/detail_editor'.'/'.$id_user);
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
/* Location: ./system/application/controllers/editor/manage_user.php */