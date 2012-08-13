<?php

class User extends Controller {

	function user() {
		parent::Controller();

		$this -> load -> helper(array('form', 'url', 'file'));
	}

	function index() {
		$this -> load -> view('user');
	}

	function upload() {
		$data['page_title'] = 'upload Image';
		$data['main_view'] = 'Image/uploadform';

		//siapa yang login
		$username = $this -> session -> userdata('username');
		$user_level = $this -> session -> userdata('user_level');
		$data['username'] = $username;
		$data['user_level'] = $user_level;

		$this -> load -> model('uploadModel', '', TRUE);
		$data['album'] = $this -> uploadModel -> getAlbumByIdUser($username);

		$data['category'] = $this -> uploadModel -> getAllCategory();
		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load -> view('template', $data);
		} else {
			$this -> load -> view('user/template', $data);
		}

	}

	function picupload() {

		//load Model
		$this -> load -> model('uploadModel');
		$config['upload_path'] = './images/galeri/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048';
		//$config['max_width']  = '1024';
		// $config['max_height']  = '768';
		$data['form_action'] = site_url('user/picupload');
		$this -> form_validation -> set_rules('kat[]', 'categories', 'required');
		$this -> form_validation -> set_rules('id_album', 'album name', 'required');
		$id = $this -> db -> insert_id();
		if (($this -> form_validation -> run() == TRUE) && ($this -> session -> userdata('login') == TRUE)) {
			$this -> load -> library('upload');
			
			//untuk kategori
			foreach ($_FILES as $key => $value) {
				if (!empty($key['name'])) {
					$this -> upload -> initialize($config);
					if (!$this -> upload -> do_upload($key)) {
						$errors[] = $this -> upload -> display_errors();
					} else {
						$uploads = array($this -> upload -> data());
						$id_gambar = $this -> uploadModel -> process_pic($uploads, $this -> input -> post('title'), $this -> input -> post('caption'), $this -> input -> post('id_album'));

						foreach ($_POST['kat'] as $k) {
							$data = array('id_images' => $id_gambar, 'id_category' => $k);
							$this -> db -> insert('imagescategory', $data);
						}
					}
				}
			}
			//untuk tag

			$tag_pieces = explode(", ", $this -> input -> post('tag'));

			$this -> load -> model('Tag_model', '', TRUE);
			for ($i = 0; $i < sizeof($tag_pieces); $i++) {
				if ($this -> Tag_model -> checkTag($tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ') {
					$tag = array('id_tag' => $tag_pieces[$i]);
					$this -> Tag_model -> addTag($tag);
					for ($i = 0; $i < sizeof($tag_pieces); $i++) {
						if ($this -> Tag_model -> checkImageTag($id, $tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ') {
							$tag_Image = array('id_image' => $id, 'id_tag' => $tag_pieces[$i]);
							$this -> Tag_model -> addTagImage($tag_Image);
						}
					}

				}
			}

			$this -> session -> set_flashdata('message', 'Succesfully Uploaded Photo to Your Album!');
			redirect('gallery/tampil_foto');

		} else {
			$this -> session -> set_flashdata('message', 'all field must be filled');
			redirect('user/upload');
		}

	}

	function lookup() {
		$this -> load -> view('search');
	}

	function search() {
		$this -> load -> model('MAutocomplete', '', TRUE);

		// procces posted form data(the requested items like province)
		$keyword = $this -> input -> post('term');
		$data['response'] = 'false';
		//set default response
		$query = $this -> MAutocomplete -> lookup($keyword);
		//search DB
		if (!empty($query)) {
			$data['response'] = 'true';
			$data['message'] = array();
			foreach ($query as $row) {
				$data['message'][] = array('id' => $row -> id_image_tag, 'value' => $row -> id_tag, '');
				//add a row to array
			}
		}
		if ('IS_AJAX') {
			echo json_encode($data);
		} else {
			$this -> load -> view('search', $data);
		}
	}

}
?>