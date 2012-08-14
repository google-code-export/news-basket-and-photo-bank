<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin extends Controller {

	function Admin() {
		parent::Controller();

		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> library('grocery_CRUD');

	}

	//set userdata
	function index() {
		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> loadArticle();
		} else {
			redirect('login');
		}
	}

	//fungsi grocery CRUD untuk manage USer

	public function manageUser() {

		$username = $this -> session -> userdata('username');
		$crud = new grocery_CRUD();
		//bikin obyek baru dinamakan Crud
		$crud -> set_table('users');
		//set table yang akan diproses
		//$crud->where('id_user',$username);
		$crud -> set_theme('datatables');
		//tema defauult
		$crud -> columns('id_user', 'name', 'email', 'id_source', 'user_level', 'phone', 'last_login');
		//colom yang akan ditampilkan dalam melihat pengaturan
		$crud -> display_as('id_source', 'source name');
		// tampilkan sebagai
		$crud -> required_fields('id_user', 'name', 'email');
		// field yang harus diisi
		$crud -> fields('id_user', 'password', 'name', 'email', 'user_level', 'phone', 'id_source');
		// field yang nanti akan diedit dan ditambahkan
		$crud -> display_as('id_group');
		$crud -> change_field_type('password', 'password');
		// set field untuk password
		$crud -> callback_before_insert(array($this, 'encrypt_pw'));
		// fungsi password yang nanti diproses pada fungsi enkripsi
		$crud -> callback_before_update(array($this, 'encrypt_pw'));
		$crud -> callback_edit_field('password', array($this, 'decrypt_pw'));

		$crud -> set_relation('id_source', 'source', 'source_name');
		// relasi dua table

		$output = $crud -> render();
		// proses render dari crud
		$output = (array)$output;
		// buat output sebagai array supaya bisa diproses
		$output['page_title'] = 'Manage Users| Administrator Image Bank ';
		$output['username'] = $username;
		$output['h2_title'] = 'Admin > Manage User';
		
		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load->view('admin/template_admin',$output);
		} else {
			redirect('login');
		}

	}

	//fungsi buat enkrip password dengan algoritma SHA 1

	function encrypt_pw($post_array) {
		$this -> load -> library('encrypt');

		if (!empty($post_array['password'])) {
			$post_array['password'] = SHA1($_POST['password']);
		}
		return $post_array;
	}

	function decrypt_pw($value) {
		$this -> load -> library('encrypt');
		$key = 'sha1';
		$decrypted_password = $this -> encrypt -> decode($value, $key);

		return "<input type='password' name='password' value='$decrypted_password' />";

	}

	public function manageCategory() {
		$username = $this -> session -> userdata('username');
		$crud = new grocery_CRUD();
		$crud -> set_table('category');
		$crud -> set_theme('datatables');
		$crud -> display_as('short_desc', 'Short Description');
		$crud -> display_as('long_desc', 'Long Description');
		$output = $crud -> render();
		$output = (array)$output;
		$output['page_title'] = 'Manage Category| Administrator Image Bank ';
		$output['username'] = $username;
		$output['h2_title'] = 'Admin > Manage Category';
		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load->view('admin/template_admin',$output);
		} else {
			redirect('login');
		}

	}

	public function manageSource() {
		$username = $this -> session -> userdata('username');
		$crud = new grocery_CRUD();
		$crud -> set_table('source');
		$crud -> set_theme('datatables');
		$crud -> fields('source_name', 'source_type');
		$output = $crud -> render();
		$output = (array)$output;
		$output['page_title'] = 'Manage Source| Administrator Image Bank ';
		$output['username'] = $username;
		$output['h2_title'] = 'Admin > Manage Source';
		if ($this -> session -> userdata('login') == TRUE && $this -> session -> userdata('user_level') == 'administrator') {
			$this -> load->view('admin/template_admin',$output);
		} else {
			redirect('login');
		}
	}

	//fungsi untuk membaca layout css file dan js file nanti di view
	protected function get_layout() {
		$js_files = $this -> get_js_files();
		$css_files = $this -> get_css_files();
		$tvs = $this -> get_tvs();

		if ($this -> unset_jquery)
			unset($js_files['763b4d272e158bdb8ed5a12a1824c94f494954bd']);

		if ($this -> echo_and_die === false) {
			return (object) array('output' => $this -> views_as_string, 'js_files' => $js_files, 'css_files' => $css_files, 'tv' => $tvs);
		} elseif ($this -> echo_and_die === true) {
			echo $this -> views_as_string;
			die();
		}
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
