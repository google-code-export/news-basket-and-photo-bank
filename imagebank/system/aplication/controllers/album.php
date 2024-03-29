<?php
class Album extends Controller{

		//limitasi tabel
		var $limit = 9;
		var $limit2 = 4;
	
	function Album() {
		parent::Controller();
		$this->load->model('album_model');
	}

	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->home_album();
		}
		else {
			redirect('login');
        }
	}
	
	function home_album(){
	
		$username = $this->session->userdata('username');
		$user_level = $this->session->userdata('user_level');
		$data['page_title'] = 'my Album';
		$data['main_view'] = 'album_view';
		$data['h2_title'] = 'Album > Create Album';
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		$num_rows = $this->album_model->countAlbum();
		
		// Offset	
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		$this->load->model('album_model','',TRUE);
		$num_rows 	= $this->album_model->countAllAlbumByUser($username);
		
		// Membuat pagination	
		$data['rows'] = $this->album_model->getAllAlbumByUser($username, $this->limit, $offset);
		$this->load->library('pagination');
		$config['base_url']    		= site_url('album/index');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination']   	= $this->pagination->create_links();
		$this->load->view('template', $data);
	}
	
	function view() {
		$data['page_title'] = 'View Album';
		$data['rows'] = $this->album_model->viewParticular($this->uri->segment(3));
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['main_view'] = 'category_view_id';
		$this->load->view('template', $data);
	}
	function add() {
		$data['page_title'] = 'Add New Album';
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['main_view'] = 'category_insert';
		$this->load->view('template', $data);
	}
	function insert() {
		$this->album_model->insertCategory();
	}
	function update() {
		$data['page_title'] = 'Update Album';
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['rows'] = $this->album_model->viewParticular($this->uri->segment(3));
		$data['main_view'] = 'category_update';
		$this->load->view('template', $data);
	}
	function updatecat($id_album) {
		$this->album_model->updateCategory($id_album);
	}
	function delete() {
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['rows'] = $this->album_model->viewParticular($this->uri->segment(3));
		$data['page_title'] = 'Delete Album';
		$data['main_view'] = 'category_delete';
		$this->load->view('template', $data);
	}
	function deleterow() {
		$this->album_model->deleteCategory();
	}
	function images() {
	if ($this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['page_title'] = 'Manage Images';
		$data['info'] = $this->album_model->viewParticular($this->uri->segment(3));
		$data['main_view'] = 'image_view';
		$id_album = $this->uri->segment(3);
		$num_rows = $this->album_model->countImagesByAlbum($id_album);

		//Membuat pagination		
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		$data['rows'] = $this->album_model->showImages($id_album, $this->limit2, $offset);
		
		$this->load->library('pagination');
		$config['base_url']    		= site_url('album/images').'/'.$id_album;
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit2;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination']   	= $this->pagination->create_links();
		$this->load->view('template', $data);
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
	
	function removeimage() {
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['page_title'] = 'Remove Image';
		$data['info'] = $this->album_model->particularImage($this->uri->segment(3));
		$data['main_view'] = 'image_delete';
		$this->load->view('template', $data);
	}
	function do_remove() {
		$full = $this->album_model->imgToDelete($this->uri->segment(3));
		$thumb = $this->album_model->thumbToDelete($this->uri->segment(3));
		if(isset($full)) unlink('./images/galeri/'.$full);
		if(isset($thumb)) unlink('./images/galeri/thumbs/'.$thumb);
		$this->album_model->deleteImage();
	}
	
}
?>