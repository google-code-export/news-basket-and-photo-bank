<?php

class Manage_category extends Controller {
	
	//limitasi tabel
	var $limit = 10;
	
	function Manage_category() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->loadCategories();
		}
		else {
			redirect('login');
        }
	}
	
	function loadCategories() {
		$data_category['page_title']	= 'Manage Category | Admin News Basket';
		$data_category['main_view'] 	= 'admin/manage_category_view';
		$data_category['form_action']	= site_url('admin/manage_category/addCategory');

		$this->load->model('Category_model','',TRUE);
		$category = $this->Category_model->getAllCategories();
		$data_category['navigasi']['category'] = $category;
		
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_category['navigasi']['publisher'] = $publisher;	
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Load data dari tabel category
		$categories = $this->Category_model->getAllCategory($this->limit, $offset);
		$num_rows 	= $this->Category_model->countAll();
		$data_category['category_table'] = $categories;
		
		
		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_category/loadCategories');
		$config['total_row']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_category['pagination']   	= $this->pagination->create_links();

		$this->load->view('admin/template', $data_category);
	}
	
	function addCategory() {
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
	
	function editCategory() {
		$this->load->model('Category_model','',TRUE);
		$category = $this->Categorys_model->getCategoryByID($idb)->row();
	}
	
	function deleteCategory($id_category) {
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