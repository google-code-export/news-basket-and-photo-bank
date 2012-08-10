<?php

class Manage_source extends Controller {
	
	//limitasi tabel
	var $limit = 13;
	
	function Manage_source() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load_sources();
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
	function load_sources() {
		$data_source['page_title']	= 'Manage Source | Admin News Basket';
		$data_source['main_view'] 	= 'admin/manage_source_view';
		$data_source['form_action']	= site_url('admin/manage_source/add_source');

		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_source['username'] = $username;
		$data_source['active']   = 'source';
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Load data dari tabel source
		$this->load->model('Source_model','',TRUE);
		$sources 	= $this->Source_model->getAllSource($this->limit, $offset);
		$num_rows 	= $this->Source_model->countAll();
		$data_source['source_table'] = $sources;
		
		// untuk penomoran dan menampilkan hasil
		$data_source['start']  = $offset + 1; // untuk penomoran tabel
		$data_source['finish'] = min($data_source['start'] + $this->limit - 1, $data_source['start'] + ($num_rows - $data_source['start']));
		$data_source['total']  = $num_rows;
			
		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_source/load_sources');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_source['pagination']   = $this->pagination->create_links();
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_source);
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
	function add_source() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			
			$this->load->model('Source_model','',TRUE);
			$num_rows 	= $this->Source_model->countAll();
			$new_source  = array(
				'id_source'		=> $num_rows+1,
				'source_name'	=> $this->input->post('source-name'),
				'source_type'	=> $this->input->post('source-type')
			);
			// Proses simpan data source
			$this->Source_model->addSource($new_source);
			
			$this->session->set_flashdata('message_success', 'Add new source successfull!');
			redirect('admin/manage_source');
		}
		
		else {
			$this->session->set_flashdata('message_failed', 'Add new source failed!');
			redirect('admin/manage_source');
		}
	}

	function edit_source($id_source) { 
		$data_source['page_title']	 		= 'Edit Source | Admin News Basket';
		$data_source['main_view'] 	 		= 'admin/manage_source_view';
		$data_source['form_action']	 		= site_url('admin/manage_source/add_source');
		$data_source['form_action_edit']	= site_url('admin/manage_source/edit_source_process');
		$data_source['form_edit_source'] 	= 'admin/form/edit_source_form';
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_source['username'] = $username;
		$data_source['active']   = 'source';
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= 0;
		
		$this->load->model('Source_model','',TRUE);	
		$sources  	= $this->Source_model->getAllSource($this->limit, $offset);
		$num_rows 	= $this->Source_model->countAll();
		$data_source['source_table'] = $sources;;
		
		// untuk penomoran dan menampilkan hasil
		$data_source['start']  = $offset + 1; // untuk penomoran tabel
		$data_source['finish'] = min($data_source['start'] + $this->limit - 1, $data_source['start'] + ($num_rows - $data_source['start']));
		$data_source['total']  = $num_rows;
		
		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_source/load_sources');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_source['pagination']   = $this->pagination->create_links();

		// ambil data source dari ID nya
		$source = $this->Source_model->getSourceByID($id_source)->row();
		
		//simpan session id source yang ingin di edit
		$this->session->set_userdata('id_source', $source->id_source);
		
		//siapkan data untuk form
		$data_source['default']['source_name'] 	= $source->source_name;
		$data_source['default']['source_type'] 	= $source->source_type;
	
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_source);
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
	function edit_source_process() {
		if ($this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
			
			// Prepare data untuk disimpan di tabel
			$source  = array(
				'source_name'	=> $this->input->post('source-name'),
				'source_type'	=> $this->input->post('source-type')
			);
			
			// Proses simpan data
			$id_source = $this->session->userdata('id_source');
			$this->load->model('Source_model','',TRUE);
			$this->Source_model->updateSource($id_source, $source);
			
			$message = 'Source '.$id_source.' has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_source');
		}
		else {
			$message = 'Update source '.$id_source.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('admin/manage_source');
		}
	}
	
	function delete_source($id_source) {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->model('Source_model','',TRUE);
			$this->Source_model->deleteSource($id_source);
			$this->session->set_flashdata('message_success', 'Delete source successfull!');

			redirect('admin/manage_source');
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}  
	}
}

/* End of file manage_source.php */
/* Location: ./system/application/controllers/admin/manage_source.php */