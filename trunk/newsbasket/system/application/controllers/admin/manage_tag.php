<?php

class Manage_tag extends Controller {
	
	//limitasi tabel
	var $limit = 13;
	
	function Manage_tag() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load_tags();
		}
		else {
			redirect('login');
        }
	}
	
	function load_tags() {
		$data_tag['page_title']	 = 'Manage Tag | Admin News Basket';
		$data_tag['main_view'] 	 = 'admin/manage_tag_view';
		$data_tag['form_action'] = site_url('admin/manage_tag/add_tag');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_tag['username'] = $username;
		$data_tag['active']   = 'tag';
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Load data dari tabel tag
		$this->load->model('Tag_model','',TRUE);
		$tags 		= $this->Tag_model->getAllTag($this->limit, $offset);
		$num_rows 	= $this->Tag_model->countAll();
		$data_tag['tag_table'] = $tags;
		
		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_tag/load_tags');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_tag['pagination']   	= $this->pagination->create_links();

		$this->load->view('admin/template', $data_tag);
	}
	
	function add_tag() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$new_tag  = array(
				'id_tag'		=> $this->input->post('id-tag'),
				'tag_name'		=> $this->input->post('tag-name')
			);
			// Proses simpan data absensi
			$this->load->model('Tag_model','',TRUE);
			$this->Tag_model->addTag($new_tag);
			
			$this->session->set_flashdata('message_success', 'Add new tag successfull!');
			redirect('admin/manage_tag');
		}
		else {
			$this->session->set_flashdata('message_failed', 'Add new tag failed!');
			redirect('admin/manage_tag');
		}
	}
	
	function edit_tag($id_tag) {
		$data_tag['page_title']	 		= 'Edit Tag | Admin News Basket';
		$data_tag['main_view'] 	 		= 'admin/manage_tag_view';
		$data_tag['form_action']	 	= site_url('admin/manage_tag/add_tag');
		$data_tag['form_action_edit']	= site_url('admin/manage_tag/edit_tag_process');
		$data_tag['form_edit_tag'] 		= 'admin/form/edit_tag_form';
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_tag['username'] = $username;
		$data_tag['active']   = 'tag';
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		// Opsi load data dari tabel tag 
		$this->load->model('Tag_model','',TRUE);
		$tags 		= $this->Tag_model->getAllTag($this->limit, $offset);
		$num_rows 	= $this->Tag_model->countAll();
		$data_tag['tag_table'] = $tags;
		
		// ambil data tag dari ID nya
		$tag = $this->Tag_model->getTagByID($id_tag)->row();
		
		//simpan session username yang ingin di edit
		$this->session->set_userdata('id_tag', $tag->id_tag);
			
		$data_tag['default']['tag_name'] = $tag->tag_name;
	
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_tag);
		}
	}
	
	function edit_tag_process() {
		if ($this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
			
			// Siapkan data untuk disimpan di tabel
			$tag  = array(
				'tag_name'	=> $this->input->post('tag-name')
			);
			
			// Proses simpan data
			$id_tag = $this->session->userdata('id_tag');
			$this->load->model('Tag_model','',TRUE);
			$this->Tag_model->updateTag($id_tag, $tag);
			
			$message = 'Tag '.$id_tag.' has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_tag');
		}
		else {
			$message = 'Update tag '.$id_tag.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('admin/manage_tag');
		}
	}
	
	function delete_tag($id_tag) {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->model('Tag_model','',TRUE);
			$this->Tag_model->deleteTag($id_tag);
			$this->session->set_flashdata('message_success', 'Delete tag successfull!');

			redirect('admin/manage_tag');
		}  
	}
}

/* End of file manage_tag.php */
/* Location: ./system/application/controllers/admin/manage_tag.php */