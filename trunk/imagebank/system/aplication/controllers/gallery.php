<?php
class Gallery extends Controller {
	function Gallery() {

		parent::Controller();
		$this -> load -> model('Gallery_model');

	}

	function index() {
		if ($this -> session -> userdata('Login') == TRUE) {
			$this -> tampil_foto();
		}else{
			redirect('login');
		}

	}

	//$data['images'] = $this->Gallery_model->get_images();
	function tampil_foto() {
		$data['page_title'] = 'Gallery Image Bank';
		$data['main_view'] = 'gallery';

		//siapa yang login
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$id = $this -> uri -> segment(3);
		$data['username'] = $username;
		$data['user_level'] = $user_level;

		$this -> load -> model('UploadModel', '', TRUE);
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();

		//limit dan offset
		$limit = 24;
		$uri_segment = 3;
		$offset = $this -> uri -> segment($uri_segment);

		$data['images'] = $this -> Gallery_model -> tampil_foto($limit, $offset);

		$num_rows = $this -> Gallery_model -> count_foto();

		// Membuat pagination

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
		} elseif($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'user'){
			$this -> load -> view('user/templateSearch', $data);
		} else{
			redirect('login');
		}

	}

	function tampil_wire() {

		$data['page_title'] = " Wires Gallery";
		$data['main_view'] = 'gallery';

		//siapa yang login
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		$id = $this -> uri -> segment(3);

		$this -> load -> model('UploadModel', '', TRUE);
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();

		//limit dan offset
		$limit = 25;
		$uri_segment = 3;
		$offset = $this -> uri -> segment($uri_segment);

		$data['images'] = $this -> Gallery_model -> tampil_wire($limit, $offset);
		$num_rows = $this -> Gallery_model -> countWire();
		// Membuat pagination

		$this -> load -> library('pagination');
		$config['base_url'] = site_url('gallery/tampil_wire');
		$config['total_rows'] = $num_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;
		$this -> pagination -> initialize($config);
		$data['pagination'] = $this -> pagination -> create_links();

		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('template', $data);
		} elseif($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'user'){
			$this -> load -> view('user/template', $data);
		} else{
			redirect('login');
		}
	}

	function tampil_publisher() {

		$data['page_title'] = 'Publiser Gallery Image Bank';
		$data['main_view'] = 'gallery';

		//siapa yang login
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$id = $this -> uri -> segment(3);
		$data['username'] = $username;
		$data['user_level'] = $user_level;

		$this -> load -> model('UploadModel', '', TRUE);
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();

		//limit dan offset
		$limit = 25;
		$uri_segment = 3;
		$offset = $this -> uri -> segment($uri_segment);

		$data['images'] = $this -> Gallery_model -> tampil_publisher($limit, $offset);
		$num_rows = $this -> Gallery_model -> countPublisher();

		//pagination

		$this -> load -> library('pagination');
		$config['base_url'] = site_url('gallery/tampil_publisher');
		$config['total_rows'] = $num_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;
		$this -> pagination -> initialize($config);
		$data['pagination'] = $this -> pagination -> create_links();
			if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('template', $data);
		} elseif($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'user'){
			$this -> load -> view('user/template', $data);
		} else{
			redirect('login');
		}
	}

	function detail_foto($id) {
		$data['page_title'] = 'Image Detail Gallery Image Bank';
		$data['main_view'] = 'detail_gambar';

		//siapa yang login
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$id = $this -> uri -> segment(3);
		$data['username'] = $username;
		$data['user_level'] = $user_level;

		$data['images'] = $this -> Gallery_model -> detail_foto($id);

		//ambil tag image
		$this -> load -> model('Tag_model', '', TRUE);
		$tag_image = $this -> Tag_model -> getTagImage($id);
		$tagstr = array();
		foreach ($tag_image as $coloumn) {
			$tagstr[] = $coloumn -> id_tag;

		}
		$data['tag'] = implode(", ", $tagstr);

		//ambil category
		$this -> load -> model('Category_model', '', TRUE);
		$category_image = $this -> Category_model -> getImageCategory($id);
		$ctgstr = array();
		foreach ($category_image as $coloumn) {
			$ctgstr[] = $coloumn -> category_name;
		}
		$data['category'] = implode(", ", $ctgstr);
		
			if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('template', $data);
		}  else{
			redirect('login');
		}

	}

	function detail_foto_user($id) {

		$data['page_title'] = 'Image Detail Gallery Image Bank';
		$data['main_view'] = 'detail_gambar_user';

		//siapa yang login
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$id = $this -> uri -> segment(3);
		$data['username'] = $username;
		$data['user_level'] = $user_level;

		$data['images'] = $this -> Gallery_model -> detail_foto($id);

		//ambil tag image
		$this -> load -> model('Tag_model', '', TRUE);
		$tag_image = $this -> Tag_model -> getTagImage($id);
		$tagstr = array();
		foreach ($tag_image as $coloumn) {
			$tagstr[] = $coloumn -> id_tag;

		}
		$data['tag'] = implode(", ", $tagstr);

		//ambil category
		$this -> load -> model('Category_model', '', TRUE);
		$category_image = $this -> Category_model -> getImageCategory($id);
		$ctgstr = array();
		foreach ($category_image as $coloumn) {
			$ctgstr[] = $coloumn -> id_category;
		}
		$data['category'] = implode(", ", $ctgstr);

		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'user') {
			$this -> load -> view('user/template', $data);
		}  else{
			redirect('login');
		}
	}

	function updateImage($id = null) {

		if ($_POST == NULL) {
			$data['main_view'] = 'edit_image';
			$data['page_title'] = 'Edit Image';
			$data['h2_title'] = 'Image > Edit Image';

			//siapa yang login
			$username = $this -> session -> userdata('username');
			$user_level = $this -> session -> userdata('user_level');
			$id = $this -> uri -> segment(3);
			$data['username'] = $username;
			$data['user_level'] = $user_level;

			//inialisasi model
			$this -> load -> model('gallery_model');
			$data['images'] = $this -> gallery_model -> selectImage($id);

			//ambil tag image
			$this -> load -> model('Tag_model', '', TRUE);
			$tag_image = $this -> Tag_model -> getTagImage($id);
			$tagstr = array();
			foreach ($tag_image as $coloumn) {
				$tagstr[] = $coloumn -> id_tag;

			}
			$data['tag'] = implode(", ", $tagstr);
			//ambil value tag dengan pemisah kata berupa koma plus spasi

			if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('template', $data);
		} elseif($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'user'){
			$this -> load -> view('user/template', $data);
		} else{
			redirect('login');
		}

		} else {
			$this -> load -> model('gallery_model');
			$this -> gallery_model -> updateImage($id);

			//data tag(digunain pas edit image)
			$tag_pieces = explode(", ", $this -> input -> post('tag'));
			//kumpulin tag yang udah kepisah kebentuk spasi plus koma

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

				redirect('gallery/tampil_foto');
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
		redirect('gallery/tampil_foto');

	}

	function deleteImage($id) {
		$this -> load -> model('gallery_model', '', TRUE);
		$data['images'] = $this -> gallery_model -> getImage($id);
		foreach ($data['images'] as $row) {

			unlink('./images/galeri/' . $row -> image_name);
			unlink('./images/galeri/thumbs/' . $row -> thumbnail);

		}
		$this -> gallery_model -> deleteImage($id);
		$this -> gallery_model -> deleteTag($id);
		$this -> gallery_model -> deleteCategory($id);
		$this -> session -> set_flashdata('message', 'Succesfully delete image');

		redirect('gallery/tampil_foto');
	}

	function searchImage($start = 0) {
		$data['page_title'] = 'search Result: ImageBank';
		$data['h2_title'] = 'Hasil Pencarian';
		$data['main_view'] = 'image/search_view';

		//siapa yang login dan levelnya
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		$this -> load -> model('UploadModel', '', TRUE);

		//data buat kategori
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();

		//limit dan offsete
		$limit = 20;
		$uri_segment = 3;
		$offset = $this -> uri -> segment($uri_segment);

		$key = $this -> input -> post('key');
		$data['key'] = $key;
		$this -> load -> model('gallery_model', '', TRUE);
		$data['images'] = $this -> gallery_model -> searchImage($key);
		$num_rows = $this -> Gallery_model -> countSearch($key);

		//pagination
		$this -> load -> library('pagination');
		$config['base_url'] = site_url('gallery/searchImage');
		$config['total_rows'] = $num_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;
		$data['pagination'] = $this -> pagination -> create_links();
		$this -> pagination -> initialize($config);
		$num_rows = $this -> Gallery_model -> countSearch($key);
		$this -> load -> library('pagination');
		$data['count'] = $num_rows;
		$data['first_result'] = $start + 1;
		$data['last_result'] = min($start + $limit, $data['count']);

	if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('template', $data);
		} elseif($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'user'){
			$this -> load -> view('user/template', $data);
		} else{
			redirect('login');
		}

	}

	function getCategories($start = 0) {
		$data['page_title'] = 'Select Category Result:: Imagebank';
		$data['h2_title'] = 'Hasil Pencarian';
		$data['main_view'] = 'image/select_category';

		//siapa yang login dan levelnya
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$data['username'] = $username;
		$data['user_level'] = $user_level;

		//from dropdown category
		$this -> load -> model('UploadModel', '', TRUE);
		$data['dropdown'] = $this -> UploadModel -> getAllCategory();

		//limit dan offset
		$limit = 20;
		$uri_segment = 3;
		$offset = $this -> uri -> segment($uri_segment);

		$id_categories = $this -> input -> post('id_categories');
		$data['id_categories'] = $id_categories;
		$this -> load -> model('gallery_model', '', TRUE);
		$num_rows = $this -> Gallery_model -> countCategory($id_categories);

		//pagination
		$this -> load -> library('pagination');
		$config['base_url'] = site_url('gallery/getCategories');
		$config['total_rows'] = $num_rows;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;
		$data['count'] = $num_rows;
		$data['first_result'] = $start + 1;
		$data['last_result'] = min($start + $limit, $data['count']);
		$data['pagination'] = $this -> pagination -> create_links();
		$this -> pagination -> initialize($config);

		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('template', $data);
		} elseif($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'user'){
			$this -> load -> view('user/template', $data);
		} else{
			redirect('login');
		}
	}

}
