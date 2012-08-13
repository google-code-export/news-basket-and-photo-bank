<?php

class Dashboard extends Controller {
	
	function Dashboard() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'editor') {
			$this->home();
		}
		else {
			redirect('login');
        }
	}
	
	function home() {
		$admin['page_title'] = 'Dashboard | Editor Newsbasket';
		$admin['username']   = $this->session->userdata['username'];
		$admin['main_view']  = 'editor/dashboard_view';
		$admin['active']  	 = 'dashboard';
		
		$this->load->model('Article_model','',TRUE);
		$admin['total_article']    = $this->Article_model->countAll();
		$admin['total_rowarticle'] = $this->Article_model->countArticleByFlag('row_article');
		$admin['total_edited'] 	   = $this->Article_model->countArticleByFlag('edited');
		$admin['total_published']  = $this->Article_model->countArticleByFlag('published');
		$admin['total_deleted']    = $this->Article_model->countArticleByFlag('deleted');
		
		$this->load->model('Users_model','',TRUE);
		$admin['total_user']	   = $this->Users_model->countAll();
		$admin['users_source']	   = $this->Users_model->countUserBySource();
		
		$this->load->model('Source_model','',TRUE);
		$admin['total_source']    = $this->Source_model->countAll();
		$admin['total_publisher'] = $this->Source_model->countSourceByType('publisher');
		$admin['total_wires']     = $this->Source_model->countSourceByType('wires');
		$admin['article_source']  = $this->Source_model->countArticleBySource();
		
		$this->load->view('editor/template', $admin);
	}
	
	function myprofile() {
		// Siapa yang login
		$id_user  = $this->session->userdata('username'); // username dari saat login
		$data_user['username'] = $id_user;
		$data_user['active']   = 'profile';
		
		$data_user['page_title']		= 'Detail User | Editor News Basket';
		$data_user['main_view'] 		= 'editor/detail/user_detail_view';
		$data_user['user_property']		= 'editor/detail/user_detail_property';
		$link_manage_user				= site_url('editor/dashboard');
		$data_user['breadcrumb']		= "<a href='$link_manage_user' style='color: white;'>Dashboard</a> > My Profile";
		$data_user['form_action_edit']	= site_url('editor/dashboard/edit_profile').'/'.$id_user;
		
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
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'editor') {
			$this->load->view('editor/template', $data_user);
		}
	}
	
	function edit_profile($id_user) { 
		$data_user['page_title']	 	= 'Edit User | Editor News Basket';
		$data_user['main_view'] 	 	= 'editor/detail/editor_detail_view';
		$data_user['edit_user_form']	= 'editor/form/edit_editor_form';
		$link_manage_user				= site_url('editor/dashboard');
		$link_detail_user				= site_url('editor/dashboard/myprofile');
		$data_user['breadcrumb']		= "<a href='$link_manage_user' style='color: white;'>Dashboard</a> > 
											   <a href='$link_detail_user' style='color: white;'>My Profile</a> 
											   > Edit Profile";
		$data_user['form_action_edit']	= site_url('editor/dashboard/edit_profile_process').'/'.$id_user;
		
		// untuk option form
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_user['publisher'] = $publisher;
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Siapa yang login
		$data_user['username'] = $id_user;
		$data_user['active']   = 'profile';
		
		// ambil data user dari ID nya
		$this->load->model('Users_model','',TRUE);
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
	
	function edit_profile_process() {
		if ($this->session->userdata('user_level') == 'editor' && $this->session->userdata('login') == TRUE) {
			$this->load->helper('security');
			
			// kondisi password
			$new_password = $this->input->post('password');
			if(!empty($new_password)) {
				$password = $new_password;
				// Prepare data untuk disimpan di tabel
				$user  = array(
					'name'		=> $this->input->post('name'),
					'id_source'	=> $this->input->post('publisher'),
					'password'  => dohash($password),
					'email'     => $this->input->post('email'),
					'phone'     => $this->input->post('phone'),
					'user_level'=> $this->input->post('user-level')
				);
			}
			else {
				$password = $this->input->post('old-password');
				// Prepare data untuk disimpan di tabel
				$user  = array(
					'name'		=> $this->input->post('name'),
					'id_source'	=> $this->input->post('publisher'),
					'password'  => $password,
					'email'     => $this->input->post('email'),
					'phone'     => $this->input->post('phone'),
					'user_level'=> $this->input->post('user-level')
				);
			}
			
			
			// Proses simpan data
			$id_user = $this->session->userdata('id_user');
			$this->load->model('Users_model','',TRUE);
			$this->Users_model->updateUser($id_user, $user);
			
			$message = 'Your profile has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			//$key = $this->session->userdata('current_table');
			redirect('editor/dashboard/myprofile');
		}
		else {
			$message = 'Update profile has been failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('editor/dashboard/myprofile');
		}
	}
	
}

/* End of file dashboard.php */
/* Location: ./system/application/controllers/editor/dashboard.php */