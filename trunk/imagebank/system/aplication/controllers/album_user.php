<?php
class Album_user extends Controller{

		//limitasi tabel
		var $limit = 9;
		var $limit2 = 4;
	
	function Album_user() {
		parent::Controller();
		$this->load->model('album_model_user');
	}

	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'user') {
			$this->home_album_user();
		}
		else {
			redirect('login');
        }
	}
	
	function home_album_user(){
	
		$username = $this->session->userdata('username');
		$user_level = $this->session->userdata('user_level');
		$data['page_title'] = 'my Album';
		$data['main_view'] = 'album_view_user';
		$data['h2_title'] = 'Album > Create Album';
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		$num_rows = $this->album_model_user->countAlbum();
		
		// Offset	
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		$this->load->model('album_model_user','',TRUE);
		$num_rows 	= $this->album_model_user->countAllAlbumByUser($username);
		
		// Membuat pagination	
		$data['rows'] = $this->album_model_user->getAllAlbumByUser($username, $this->limit, $offset);
		$this->load->library('pagination');
		$config['base_url']    		= site_url('album_user/index');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination']   	= $this->pagination->create_links();
		$this->load->view('template_user', $data);
	}
	
	function view() {
		$data['page_title'] = 'View Album';
		$data['rows'] = $this->album_model_user->viewParticular($this->uri->segment(3));
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['main_view'] = 'category_view_id_user';
		$this->load->view('template_user', $data);
	}
	function add() {
		$data['page_title'] = 'Add New Album';
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['main_view'] = 'category_insert_user';
		$this->load->view('template_user', $data);
	}
	function insert() {
		$this->album_model_user->insertCategory();
	}
	function update() {
		$data['page_title'] = 'Update Album';
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['rows'] = $this->album_model_user->viewParticular($this->uri->segment(3));
		$data['main_view'] = 'category_update_user';
		$this->load->view('template_user', $data);
	}
	function updatecat($id_album) {
		$this->album_model_user->updateCategory($id_album);
	}
	function delete() {
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['rows'] = $this->album_model_user->viewParticular($this->uri->segment(3));
		$data['page_title'] = 'Delete Album';
		$data['main_view'] = 'category_delete_user';
		$this->load->view('template_user', $data);
	}
	function deleterow() {
		$this->album_model_user->deleteCategory();
	}
	function images() {
	if ($this->session->userdata('user_level') == 'user' && $this->session->userdata('login') == TRUE) {
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['page_title'] = 'Manage Images';
		$data['info'] = $this->album_model_user->viewParticular($this->uri->segment(3));
		$data['main_view'] = 'image_view_user';
		$id_album = $this->uri->segment(3);
		$num_rows = $this->album_model_user->countImagesByAlbum($id_album);
		
		
		//Membuat pagination		
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$data['rows'] = $this->album_model_user->showImages($this->uri->segment(3), $this->limit2, $offset);
		
		$this->load->library('pagination');
		$config['base_url']    		= site_url('album_user/images');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit2;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination']   	= $this->pagination->create_links();
		$this->load->view('template_user', $data);
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
		$data['info'] = $this->album_model_user->particularImage($this->uri->segment(3));
		$data['main_view'] = 'image_delete_user';
		$this->load->view('template_user', $data);
	}
	function do_remove() {
		$full = $this->album_model_user->imgToDelete($this->uri->segment(3));
		$thumb = $this->album_model_user->thumbToDelete($this->uri->segment(3));
		if(isset($full)) unlink('./images/galeri/'.$full);
		if(isset($thumb)) unlink('./images/galeri/thumbs/'.$thumb);
		$this->album_model_user->deleteImage();
	}
	
}
?>