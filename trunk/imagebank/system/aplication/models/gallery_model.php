<?php
class Gallery_model extends Model {

	function Gallery_model() {
		parent::Model();
	}

	function tampil_foto($limit, $offset) {
		$this -> db -> select('*');
		$this -> db -> from('images');
		$this -> db -> limit($limit, $offset);
		return $this -> db -> get() -> result();
	}
	
	function data_foto($id){
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where('images.id_images',$id);
		$this->db->join('imagescategory','images.id_images = imagescategory.id_images');
		$this->db->where('images.id_images',$id);
		return $this -> db -> get() -> result();
	}

	function count_foto() {
		return $this -> db -> count_all('images');
	}

	function tampil_wire($limit, $offset) {
		$this -> db -> select('*');
		$this -> db -> from('images');
		$this -> db -> limit($limit, $offset);
		$this -> db -> join('album', 'images.id_album=album.id_album');
		$this -> db -> join('users', 'album.id_user=users.id_user');
		$this -> db -> join('source', 'users.id_source=source.id_source');
		$this -> db -> where('source.source_type', 'wires');
		return $this -> db -> get() -> result();

	}

	function countWire() {
		$this -> db -> select('*');
		$this -> db -> from('images');

		$this -> db -> join('album', 'images.id_album=album.id_album');
		$this -> db -> join('users', 'album.id_user=users.id_user');
		$this -> db -> join('source', 'users.id_source=source.id_source');
		$this -> db -> where('source.source_type', 'wires');
		return $this -> db -> get() -> num_rows();

	}

	function tampil_publisher($limit, $offset) {
		$this -> db -> select('*');
		$this -> db -> from('images');
		$this -> db -> limit($limit, $offset);
		$this -> db -> join('album', 'images.id_album=album.id_album');
		$this -> db -> join('users', 'album.id_user=users.id_user');
		$this -> db -> join('source', 'users.id_source=source.id_source');
		$this -> db -> where('source.source_type', 'publisher');
		return $this -> db -> get() -> result(); ;
	}

	function countPublisher() {
		$this -> db -> select('*');
		$this -> db -> from('images');
		$this -> db -> join('album', 'images.id_album=album.id_album');
		$this -> db -> join('users', 'album.id_user=users.id_user');
		$this -> db -> join('source', 'users.id_source=source.id_source');
		$this -> db -> where('source.source_type', 'publisher');
		return $this -> db -> get() -> num_rows();
	}

	function detail_foto($id) {
		$this -> db -> select('*');
		$this -> db -> from('images');
		$this -> db -> where('id_images', $id);
		return $this -> db -> get() -> result();
	}

	function searchImage($key) {

		$this -> db -> distinct();
		$this -> db -> from('imagetag');
		$this -> db -> where('id_tag', $key);
		$this -> db -> join('images', 'imagetag.id_image=images.id_images');
		$this -> db -> group_by('id_image');
		return $this -> db -> get() -> result();

	}

	function countSearch($key) {
		$this -> db -> select('*');
		$this -> db -> from('imagetag');
		$this -> db -> where('id_tag', $key);
		$this -> db -> join('images', 'imagetag.id_image=images.id_images');
		return $this -> db -> get() -> num_rows();

	}

	function searchCategory($id_categories) {

		$this -> db -> select('*');
		$this -> db -> from('imagescategory');
		$this -> db -> where('id_category', $id_categories);
		$this -> db -> join('images', 'imagescategory.id_images = images.id_images');
		return $this -> db -> get() -> result();
	}

	function countCategory($id_categories) {
		$this -> db -> select('*');
		$this -> db -> from('imagescategory');
		$this -> db -> where('id_category', $id_categories);
		$this -> db -> join('images', 'imagescategory.id_images = images.id_images');
		return $this -> db -> get() -> num_rows();

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
	
	function getImage($id) {
		return $this -> db -> get_where('images', array('id_images' => $id)) -> result();

	}

	function deleteImage($id) {
		$this -> db -> delete('images', array('id_images' => $id));
		

	}
	function deleteTag($id){
		$this -> db -> delete('imagetag', array('id_image' => $id));
	}
	
	function deleteCategory($id){
		$this -> db -> delete('imagescategory', array('id_images' => $id));
	}

	function download($id) {
		return $this -> db -> get_where('images', array('id_images' => $id)) -> result();

	}

}
