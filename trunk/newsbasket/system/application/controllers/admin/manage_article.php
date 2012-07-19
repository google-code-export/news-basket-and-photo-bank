<?php

class Manage_article extends Controller {
	
	//limitasi tabel
	var $limit = 10;
	
	function Manage_article() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->loadArticle();
		}
		else {
			redirect('login');
        }
	}
	
	function loadArticle() {
		$data_article['page_title']			= 'Manage Article | Admin News Basket';
		$data_article['main_view'] 			= 'admin/manage_article_view';
		$data_article['form_action']		= site_url('admin/manage_article/addArticle');
		$data_article['form_add_article'] 	= 'admin/form/add_article_form';
		
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_article['publisher'] = $publisher;	
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		$this->load->model('Article_model','',TRUE);
		$articles  	= $this->Article_model->getAllArticle($this->limit, $offset);
		$num_rows 	= $this->Article_model->countAll();
		$data_article['article_table'] = $articles;

		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_article/loadArticle');
		$config['total_row']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_article['pagination']   	= $this->pagination->create_links();
		
		$this->load->view('admin/template', $data_article);
	}
	/*
	function detailArticle($id_article) {
		$data_article['page_title']	 = 'Detail Article | Admin News Basket';
		$data_article['main_view'] 	 = 'admin/manage_article_view';
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_author['username'] = $username;
		
		// ambil data article dari ID nya
		$this->load->model('Article_model','',TRUE);
		$article = $this->Article_model->getArticleByID($id_article)->row();
		
		//simpan session id-article yang ingin di edit
		$this->session->set_userdata('id_article', $article->id_article);
			
		$data_article['article']['id_article'] 		= $article->name;
		$data_article['article']['author'] 			= $article->password;
		$data_article['article']['created_on'] 		= $article->phone;
		$data_article['article']['headline'] 		= $article->email;
		$data_article['article']['body_article']	= $article->id_source
		
		$this->load->view('admin/detail/article_detail_view', $data_article);
	}*/
	/*
	function addArticle() {
		$this->load->helper('security');
		if ($this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
			$new_article  = array(
				'id_article'	=> $this->input->post('id-article'),
				'id_source'		=> $this->input->post('publisher'),
				'password'		=> dohash($this->input->post('password')),
				'name'      	=> $this->input->post('name'),
				'phone'       	=> $this->input->post('phone'),
				'email'   		=> $this->input->post('email'),
				'date_created'	=> date('Y-m-d G:i:s')
			);
			// Proses simpan data absensi
			$this->load->model('Article_model','',TRUE);
			$this->Article_model->addArticle($new_article);
			
			$message = 'Add new article '.$new_article['id_article'].' successfull!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_article');
		}
		
		else {
			$message = 'Add new article '.$new_article['id_article'].' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('admin/manage_article');
		}
	}
	
	function editArticle($id_article) { 
		$data_article['page_title']	 		= 'Edit Article | Admin News Basket';
		$data_article['main_view'] 	 		= 'admin/manage_article_view';
		$data_article['form_action']	 	= site_url('admin/manage_article/addArticle');
		$data_article['form_action_edit']	= site_url('admin/manage_article/editArticleProcess');
		$data_article['form_edit_article'] 	= 'admin/form/edit_article_form';
		
		// untuk option form
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_article['publisher'] = $publisher;
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		$this->load->model('Article_model','',TRUE);	
		$articles  	= $this->Article_model->getAllArticle($this->limit, $offset);
		$num_rows 	= $this->Article_model->countAll();
		$data_article['article_table'] = $articles;
		
		// ambil data article dari ID nya
		$article = $this->Article_model->getArticleByID($id_article)->row();
		
		//simpan session id-article yang ingin di edit
		$this->session->set_userdata('id_article', $article->id_article);
			
		$data_article['default']['name'] 		= $article->name;
		$data_article['default']['password'] 	= $article->password;
		$data_article['default']['phone'] 		= $article->phone;
		$data_article['default']['email'] 		= $article->email;
		$data_article['default']['publisher']	= $article->id_source;
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_article);
		}
	}
	
	function editArticleProcess() {
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
			$article  = array(
				'name'		=> $this->input->post('name'),
				'id_source'	=> $this->input->post('publisher'),
				'password'  => $password,
				'email'     => $this->input->post('email'),
				'phone'     => $this->input->post('phone')
			);
			
			// Proses simpan data
			$id_article = $this->session->userdata('id_article');
			$this->load->model('Article_model','',TRUE);
			$this->Article_model->updateArticle($id_article, $article);
			
			$message = 'Article '.$id_article.' has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			//$key = $this->session->userdata('current_table');
			redirect('admin/manage_article');
		}
		else {
			$message = 'Update article '.$id_article.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			//$key = $this->session->userdata('current_table');
			redirect('admin/manage_article');
		}
	}
	
	function deleteArticle($id_article) {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->model('Article_model','',TRUE);
			$this->Article_model->deleteArticle($id_article);
			$this->session->set_flashdata('message_success', 'Delete article successfull!');

			redirect('admin/manage_article');
		}  
	}
	
	// validasi dengan AJAX
	function checkArticlenameAvailability() {
		$id_article = $this->input->post('id-article');
		$this->load->model('Article_model','',TRUE);
		$this->Article_model->checkArticlenameAvailability($id_article);
		
		if ($this->Article_model->checkArticlenameAvailability($id_article) == TRUE) {
			echo "no"; // id article ini terpakai
		} 
		else if (strlen($id-article) == 0) {
			echo "no";  // id article ini terpakai
		}
		else {
			echo "yes";  // id article ini tidak terpakai
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
	}*/
}

/* End of file manage_article.php */
/* Location: ./system/application/controllers/admin/manage_article.php */