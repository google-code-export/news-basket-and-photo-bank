<?php
class Gallery extends Controller {
	function Gallery() {

		parent::Controller();
		$this -> load -> model('Gallery_model');
	}

	function index() {

		$this -> tampil_foto();
		//$id_images = $this->uri->segment(3);
		//$data['id_images'] = $id_images;
		//$this->load->view('gallery', $data);
	}

	//$data['images'] = $this->Gallery_model->get_images();
	function tampil_foto() {
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$id = $this -> uri -> segment(3);
		$this -> load -> model('UploadModel', '', TRUE);
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();
		$data['page_title'] = 'Gallery Image Bank';
		$data['main_view'] = 'gallery';
		$data['username'] = $username;
		$data['user_level'] = $user_level;

		// Membuat pagination
		$limit = 30;
		$uri_segment = 3;
		$offset = $this -> uri -> segment($uri_segment);

		$data['images'] = $this -> Gallery_model -> tampil_foto($limit, $offset);
		$num_rows = $this -> Gallery_model -> count_foto();

		$this -> load -> library('pagination');
		$config['last_link'] = 'Last';
		$config['cur_tag_open'] = '<b>';
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = site_url('gallery/tampil_foto');
		$config['total_rows'] = $num_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;
		$this -> pagination -> initialize($config);
		$data['pagination'] = $this -> pagination -> create_links();

		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('templateSearch', $data);
		} else {
			$this -> load -> view('user/templateSearch', $data);
		}

	}

	function tampil_wire() {

		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$id = $this -> uri -> segment(3);
		$data['page_title'] = 'Gallery Image Bank';
		$this -> load -> model('UploadModel', '', TRUE);
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();
		$data['images'] = $this -> Gallery_model -> tampil_wire();
		$data['main_view'] = 'gallery';
		$data['username'] = $username;
		$data['user_level'] = $user_level;

		// Membuat pagination
		$limit = 20;
		$uri_segment = 3;
		$offset = $this -> uri -> segment($uri_segment);
		$num_rows = $this -> Gallery_model -> count_foto();
		$this -> load -> library('pagination');
		$config['base_url'] = site_url('gallery/tampil_wire');
		$config['total_rows'] = $num_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;
		$this -> pagination -> initialize($config);
		$data['pagination'] = $this -> pagination -> create_links();

		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('templateSearch', $data);
		} else {
			$this -> load -> view('user/templateSearch', $data);
		}
	}

	function tampil_publisher() {

		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$id = $this -> uri -> segment(3);
		$this -> load -> model('UploadModel', '', TRUE);
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();
		$data['page_title'] = 'Gallery Image Bank';
		$data['images'] = $this -> Gallery_model -> tampil_publisher();
		$data['main_view'] = 'gallery';
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		//pagination
		$limit = 20;
		$uri_segment = 3;
		$offset = $this -> uri -> segment($uri_segment);
		$num_rows = $this -> Gallery_model -> count_foto();
		$this -> load -> library('pagination');
		$config['base_url'] = site_url('gallery/tampil_publisher');
		$config['total_rows'] = $num_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;
		$this -> pagination -> initialize($config);
		$data['pagination'] = $this -> pagination -> create_links();
		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('templateSearch', $data);
		} else {
			$this -> load -> view('user/templateSearch', $data);
		}
	}

	function detail_foto($id) {

		$data['images'] = $this -> Gallery_model -> detail_foto($id);
		$this -> load -> view('detail_gambar', $data);

	}

	function detail_foto_user($id) {

		$data['images'] = $this -> Gallery_model -> detail_foto($id);
		$this -> load -> view('detail_gambar_user', $data);

	}

	function updateImage($id = null) {

		if ($_POST == NULL) {
			$this -> load -> model('gallery_model');
			$username = $this -> session -> userdata('username');
			$user_level = $this -> session -> userdata('user_level');
			$id = $this -> uri -> segment(3);
			$data['images'] = $this -> gallery_model -> selectImage($id);
			$data['main_view'] = 'edit_image';
			$data['page_title'] = 'Edit Image';
			$data['h2_title'] = 'Image > Edit Image';
			$data['username'] = $username;
			$data['user_level'] = $user_level;
			//ambil tag image
			$this -> load -> model('Tag_model', '', TRUE);
			$tag_image = $this -> Tag_model -> getTagImage($id);
			$tagstr = array();
			foreach ($tag_image as $coloumn) {
				$tagstr[] = $coloumn -> id_tag;

			}
			$data['tag'] = implode(", ", $tagstr);

			if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
				$this -> load -> view('template', $data);
			} else {
				$this -> load -> view('user/template', $data);
			}

		} else {
			$this -> load -> model('gallery_model');
			$this -> gallery_model -> updateImage($id);

			//data tag
			$tag_pieces = explode(", ", $this -> input -> post('tag'));

			$this -> load -> model('Tag_model', '', TRUE);
			for ($i = 0; $i < sizeof($tag_pieces); $i++) {
				if ($this -> Tag_model -> checkTag($tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ') {
					$tag = array('id_tag' => $tag_pieces[$i]);
					$this -> Tag_model -> addTag($tag);

				}
			}

			for ($i = 0; $i < sizeof($tag_pieces); $i++) {
				if ($this -> Tag_model -> checkImageTag($id, $tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ') {
					$tag_Image = array('id_image' => $id, 'id_tag' => $tag_pieces[$i]);
					$this -> Tag_model -> addTagImage($tag_Image);
					//proses simpan ke tabel tag
				}

				redirect('gallery');
			}

		}
	}

	function download($id) {
		$this -> load -> model('gallery_model');
		$data['images'] = $this -> gallery_model -> download($id);
		$this -> load -> helper('download');
		foreach ($data['images'] as $row) {
			$img = file_get_contents(base_url() . '/images/galeri/' . $row -> image_name);
			$name = $row -> image_name;
			force_download($name, $img);
		}
		redirect('gallery');

	}

	function searchImage($start = 0) {
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		$this -> load -> model('UploadModel', '', TRUE);
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();
		$data['page_title'] = 'search Result: ImageBank';
		$data['h2_title'] = 'Hasil Pencarian';
		$data['main_view'] = 'gallery';
		$key = $this -> input -> post('key');
		$data['key'] = $key;

		if (($key != '') && ($key != 'enter keyword')) {
			$this -> load -> model('gallery_model', '', TRUE);
			$data['images'] = $this -> gallery_model -> searchImage($key);

			
			//pagination
			$limit = 20;
			$uri_segment = 3;
			$offset = $this -> uri -> segment($uri_segment);
			$num_rows = $this -> Gallery_model -> countSearch($key);
			$this -> load -> library('pagination');
			$config['base_url'] = site_url('gallery/getCategories');
			$config['total_rows'] = $num_rows;
			$config['per_page'] = $limit;
			$config['uri_segment'] = $uri_segment;
			$this -> pagination -> initialize($config);
			$data['pagination'] = $this -> pagination -> create_links();
			$data['images'] = $this -> Gallery_model -> searchImage($key);
			
			
			
			//$news['first_result'] = $start + 1;
			//$news['last_result'] = min($start + $this -> limit, $num_rows);
			if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
				$this -> load -> view('templateSearch', $data);
			} else {
				$this -> load -> view('user/templateSearch', $data);
			}

		} else {//pencarian tanpa input
			$data['key'] = '';
			$data['images'] = '';
			$num_rows = 0;
			$data['count'] = $num_rows;
		}

	}

	function getCategories() {

		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$this -> load -> model('UploadModel', '', TRUE);
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		$data['page_title'] = 'get Category Result:: Imagebank';
		$data['h2_title'] = 'Hasil Pencarian';
		$data['main_view'] = 'gallery';
		$id_categories = $this -> input -> post('id_categories');
		$data['id_categories'] = $id_categories;
		$this -> load -> model('gallery_model', '', TRUE);
		//pagination
		$limit = 20;
		$uri_segment = 3;
		$offset = $this -> uri -> segment($uri_segment);
		$num_rows = $this -> Gallery_model -> count_foto();
		$this -> load -> library('pagination');
		$config['base_url'] = site_url('gallery/getCategories');
		$config['total_rows'] = $num_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;
		$this -> pagination -> initialize($config);
		$data['pagination'] = $this -> pagination -> create_links();
		$data['images'] = $this -> gallery_model -> searchCategory($id_categories);
		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('templateSearch', $data);
		} else {
			$this -> load -> view('user/templateSearch', $data);
		}
	}

}
