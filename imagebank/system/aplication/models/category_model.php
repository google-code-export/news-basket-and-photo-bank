<?php
class Category_model extends Model {

	function category_model() {
		parent::Model();
	}

	function addCategory($new_category) {
		$this -> db -> insert('category', $new_category);
	}

	function addImageCategory($new_image_category) {
		$this -> db -> insert('images', $new_image_category);
	}

	function getImageCategory($id_image) {
		
		$this -> db -> where('id_images', $id_image);
		$this -> db -> from('imagescategory');
		$this->db->join('category','imagescategory.id_category=category.id_category');
		return $this -> db -> get() -> result();
	}

}
?>