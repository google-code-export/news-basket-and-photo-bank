<?php

class Manage_author extends Controller {
	
	//limitasi tabel
	var $limit = 13;
	
	function Manage_author() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load_author();
		}
		else {
			redirect('login');
        }
	}
	
	function load_author() {
		$data_author['page_title']			= 'Manage Author | Admin News Basket';
		$data_author['main_view'] 			= 'admin/manage_author_view';
		$data_author['form_action']			= site_url('admin/manage_author/add_author');
		$data_author['form_add_author'] 	= 'admin/form/add_author_form';
		$data_author['form_action_search']	= site_url('admin/manage_author/search_author');
		
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_author['publisher'] = $publisher;	
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_author['username'] = $username;
		$data_author['active']   = 'author';
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		$this->load->model('Author_model','',TRUE);
		$authors  	= $this->Author_model->getAllAuthor($this->limit, $offset);
		$num_rows 	= $this->Author_model->countAll();
		$data_author['author_table'] = $authors;

		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_author/load_author');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_author['pagination']   	= $this->pagination->create_links();
		
		$this->load->view('admin/template', $data_author);
	}
	
	function add_author() {
		if ($this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
			$new_author  = array(
				'id_author'		=> $this->input->post('id-author'),
				'id_source'		=> $this->input->post('publisher'),
				'name'      	=> $this->input->post('name'),
				'phone'       	=> $this->input->post('phone'),
				'email'   		=> $this->input->post('email'),
				'date_created'	=> date('Y-m-d G:i:s')
			);
			// Proses simpan data absensi
			$this->load->model('Author_model','',TRUE);
			$this->Author_model->addAuthor($new_author);
			
			$message = 'Add new author '.$new_author['id_author'].' successfull!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_author');
		}
		
		else {
			$message = 'Add new author '.$new_author['id_author'].' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('admin/manage_author');
		}
	}
	
	function edit_author($id_author) { 
		$data_author['page_title']	 		= 'Edit Author | Admin News Basket';
		$data_author['main_view'] 	 		= 'admin/manage_author_view';
		$data_author['form_action']	 		= site_url('admin/manage_author/add_author');
		$data_author['form_action_edit']	= site_url('admin/manage_author/edit_author_process');
		$data_author['form_edit_author'] 	= 'admin/form/edit_author_form';
		$data_author['form_action_search']	= site_url('admin/manage_author/search_author');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_author['username'] = $username;
		$data_author['active']   = 'author';
		
		// untuk option form
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_author['publisher'] = $publisher;
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		$this->load->model('Author_model','',TRUE);	
		$authors  	= $this->Author_model->getAllAuthor($this->limit, $offset);
		$num_rows 	= $this->Author_model->countAll();
		$data_author['author_table'] = $authors;
		
		// ambil data author dari ID nya
		$author = $this->Author_model->getAuthorByID($id_author)->row();
		
		//simpan session id-author yang ingin di edit
		$this->session->set_userdata('id_author', $author->id_author);
			
		$data_author['default']['name'] 		= $author->name;
		$data_author['default']['phone'] 		= $author->phone;
		$data_author['default']['email'] 		= $author->email;
		$data_author['default']['publisher']	= $author->id_source;
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_author);
		}
	}
	
	function edit_author_process() {
		if ($this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
			
			// Prepare data untuk disimpan di tabel
			$author  = array(
				'name'		=> $this->input->post('name'),
				'id_source'	=> $this->input->post('publisher'),
				'email'     => $this->input->post('email'),
				'phone'     => $this->input->post('phone')
			);
			
			// Proses simpan data
			$id_author = $this->session->userdata('id_author');
			$this->load->model('Author_model','',TRUE);
			$this->Author_model->updateAuthor($id_author, $author);
			
			$message = 'Author '.$id_author.' has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			//$key = $this->session->userdata('current_table');
			redirect('admin/manage_author');
		}
		else {
			$message = 'Update author '.$id_author.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			//$key = $this->session->userdata('current_table');
			redirect('admin/manage_author');
		}
	}
	
	function delete_author($id_author) {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->model('Author_model','',TRUE);
			$this->Author_model->deleteAuthor($id_author);
			$this->session->set_flashdata('message_success', 'Delete author successfull!');

			redirect('admin/manage_author');
		}  
	}
	
	function search_author($start = 0) {
		$data_author['page_title']			= 'Search Author | Admin News Basket';
		$data_author['main_view'] 			= 'admin/extra/search_author_view';
		$data_author['form_action_search']	= site_url('admin/manage_author/search_author');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_author['username'] = $username;
		$data_author['active']   = 'author';
		
		// Limit & Offset
		$uri_segment = 4;
		$offset      = $this->uri->segment($uri_segment);

		$key = $this->input->get('key');
		$data_author['key'] = $key;
		
		$this->load->model('Author_model','',TRUE);
		$data_author['result'] = $this->Author_model->searchAuthor($this->limit, $offset, $key);
		$data_author['count']  = $this->Author_model->countSearch($key);
		
		// Membuat pagination			
		$config['base_url']    = site_url('admin/manage_author/search_author');
		$config['total_rows']  = $data_author['count'];
		$config['per_page']    = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data_author['pagination']    = $this->pagination->create_links();

		$data_author['first_result'] = $start + 1;
		$data_author['last_result']  = min($start + $this->limit, $data_author['count']);

		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_author);
		}
	}
	
	
	// validasi dengan AJAX
	function checkAuthorAvailability() {
		$id_author = $this->input->post('id-author');
		$this->load->model('Author_model','',TRUE);
		$this->Author_model->checkAuthorAvailability($id_author);
		
		if ($this->Author_model->checkAuthorAvailability($id_author) == TRUE) {
			echo "no"; // id author ini terpakai
		} 
		else if (strlen($id-author) == 0) {
			echo "no";  // id author ini terpakai
		}
		else {
			echo "yes";  // id author ini tidak terpakai
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

/* End of file manage_author.php */
/* Location: ./system/application/controllers/admin/manage_author.php */