<?php
class Gallery_model extends Model {

	function Gallery_model() {
		parent::Model();
	}

	function tampil_foto() {
		$this -> db -> select('*');
		$this -> db -> from('images');
		return $this -> db -> get() -> result();
	}

	function tampil_wire() {
		$this -> db -> select('*');
		$this -> db -> from('images');
		$this -> db -> join('album', 'images.id_album=album.id_album');
		$this -> db -> join('users', 'album.id_user=users.id_user');
		$this -> db -> join('source', 'users.id_source=source.id_source');
		$this -> db -> where('source.source_type', 'wires');
		return $this -> db -> get() -> result();

	}

	function tampil_publisher() {
		$this -> db -> select('*');
		$this -> db -> from('images');
		$this -> db -> join('album', 'images.id_album=album.id_album');
		$this -> db -> join('users', 'album.id_user=users.id_user');
		$this -> db -> join('source', 'users.id_source=source.id_source');
		$this -> db -> where('source.source_type', 'publisher');
		return $this -> db -> get() -> result();
		;
	}

	function detail_foto($id) {
		$this -> db -> select('*');
		$this -> db -> from('images');
		$this -> db -> where('id_images', $id);
		return $this -> db -> get() -> result();
	}

	function searchImage($key) {

		$this -> db -> select('*');
		$this -> db -> from('imagetag');
		$this -> db -> where('id_tag', $key);
		$this -> db -> join('images', 'imagetag.id_image=images.id_images');
		return $this -> db -> get() -> result();

	}

	function searchCategory($id_categories) {

		$this -> db -> select('*');
		$this -> db -> from('imagescategory');
		$this -> db -> where('id_category', $id_categories);
		$this -> db -> join('images', 'imagescategory.id_images = images.id_images');
		return $this -> db -> get() -> result();
	}

	function updateImage($id) {
		$now = date('Y-m-d H:i:s');
		$title = $this -> input -> post('title');
		$caption = $this -> input -> post('caption');
		$update_at = $now;
		$data = array('title' => $title, 'caption' => $caption, 'update_at' => $update_at);
		$this -> db -> where('id_images', $id);
		$this -> db -> update('images', $data);
	}

	function selectImage($id) {
		return $this -> db -> get_where('images', array('id_images' => $id)) -> row();

	}

	function download($id) {
		return $this -> db -> get_where('images', array('id_images' => $id)) -> result();

	}

}
