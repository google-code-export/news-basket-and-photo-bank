<?php

class Manage_source extends Controller {
	
	//limitasi tabel
	var $limit = 10;
	
	function Manage_source() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->loadSources('all');
		}
		else {
			redirect('login');
        }
	}
	
	function loadSources($key) {
		$data_source['page_title']	= 'Manage Source | Admin News Basket';
		$data_source['main_view'] 	= 'admin/manage_source_view';
		$data_source['form_action']	= site_url('admin/manage_source/addSource');

		$this->load->model('Category_model','',TRUE);
		$category = $this->Category_model->getAllCategories();
		$data_source['navigasi']['category'] = $category;
		
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_source['navigasi']['publisher'] = $publisher;	
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Load data dari tabel source
		if ($key == 'all') { // tampilkan semua
			$sources 	= $this->Source_model->getAllSource($this->limit, $offset);
			$num_rows 	= $this->Source_model->countAll();
			$data_source['source_table'] = $sources;
		}
		else {
			$sources 	= $this->Source_model->getAllSourceByType($this->limit, $offset, $key);
			$num_rows 	= $this->Source_model->countAll();
			$data_source['source_table'] = $sources;
		}
		
		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_source/loadSources');
		$config['total_row']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_source['pagination']   	= $this->pagination->create_links();

		$this->load->view('admin/template', $data_source);
	}
	
	function addSource() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$new_source  = array(
				'id_source'		=> $this->input->post('id-source'),
				'source_name'	=> $this->input->post('source-name'),
				'source_type'	=> $this->input->post('source-type')
			);
			// Proses simpan data absensi
			$this->load->model('Source_model','',TRUE);
			$this->Source_model->addSource($new_source);
			
			$this->session->set_flashdata('message_success', 'Add new source successfull!');
			redirect('admin/manage_source');
		}
		
		else {
			$this->session->set_flashdata('message_failed', 'Add new source failed!');
			redirect('admin/manage_source');
		}
	}
	
	function editSource() {
		$this->load->model('Source_model','',TRUE);
		$source = $this->Sources_model->getSourceByID($idb)->row();
	}
	
	function deleteSource($id_source) {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->model('Source_model','',TRUE);
			$this->Source_model->deleteSource($id_source);
			$this->session->set_flashdata('message_success', 'Delete source successfull!');

			redirect('admin/manage_source');
		}  
	}
}

/* End of file manage_source.php */
/* Location: ./system/application/controllers/admin/manage_source.php */