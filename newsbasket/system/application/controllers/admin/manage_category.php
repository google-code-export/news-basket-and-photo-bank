<?php

class Manage_category extends Controller {
	
	//limitasi tabel
	var $limit = 10;
	
	function Manage_category() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load_categories();
		}
		else {
			redirect('login');
        }
	}
	
	function load_categories() {
		$data_category['page_title']	= 'Manage Category | Admin News Basket';
		$data_category['main_view'] 	= 'admin/manage_category_view';
		$data_category['form_action']	= site_url('admin/manage_category/add_category');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_category['username'] = $username;
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Load data dari tabel category
		$this->load->model('Category_model','',TRUE);
		$categories = $this->Category_model->getAllCategory($this->limit, $offset);
		$num_rows 	= $this->Category_model->countAll();
		$data_category['category_table'] = $categories;
		
		
		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_category/load_categories');
		$config['total_row']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_category['pagination']   	= $this->pagination->create_links();

		$this->load->view('admin/template', $data_category);
	}
	
	function add_category() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$new_category  = array(
				'id_category'		=> $this->input->post('id-category'),
				'category_name'		=> $this->input->post('category-name')
			);
			// Proses simpan data absensi
			$this->load->model('Category_model','',TRUE);
			$this->Category_model->addCategory($new_category);
			
			$this->session->set_flashdata('message_success', 'Add new category successfull!');
			redirect('admin/manage_category');
		}
		
		else {
			$this->session->set_flashdata('message_failed', 'Add new category failed!');
			redirect('admin/manage_category');
		}
	}
	
	function edit_category($id_category) {
		$data_category['page_title']	 		= 'Edit Category | Admin News Basket';
		$data_category['main_view'] 	 		= 'admin/manage_category_view';
		$data_category['form_action']	 		= site_url('admin/manage_category/add_category');
		$data_category['form_action_edit']		= site_url('admin/manage_category/edit_category_process');
		$data_category['form_edit_category'] 	= 'admin/form/edit_category_form';
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_category['username'] = $username;
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Opsi load data dari tabel category 
		$this->load->model('Category_model','',TRUE);
		$categories = $this->Category_model->getAllCategory($this->limit, $offset);
		$num_rows 	= $this->Category_model->countAll();
		$data_category['category_table'] = $categories;
		
		// ambil data category dari ID nya
		$category = $this->Category_model->getCategoryByID($id_category)->row();
		
		//simpan session username yang ingin di edit
		$this->session->set_userdata('id_category', $category->id_category);
			
		$data_category['default']['category_name'] 	= $category->category_name;
	
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_category);
		}
	}
	
	function edit_category_process() {
		if ($this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
			
			// Siapkan data untuk disimpan di tabel
			$category  = array(
				'category_name'	=> $this->input->post('category-name')
			);
			
			// Proses simpan data
			$id_category = $this->session->userdata('id_category');
			$this->load->model('Category_model','',TRUE);
			$this->Category_model->updateCategory($id_category, $category);
			
			$message = 'Category '.$id_category.' has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_category');
		}
		else {
			$message = 'Update category '.$id_category.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('admin/manage_category');
		}
	}
	
	function delete_category($id_category) {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->model('Category_model','',TRUE);
			$this->Category_model->deleteCategory($id_category);
			$this->session->set_flashdata('message_success', 'Delete category successfull!');

			redirect('admin/manage_category');
		}  
	}
}

/* End of file manage_category.php */
/* Location: ./system/application/controllers/admin/manage_category.php */