<?php

class Category_model extends Model {
    
	// Inisialisasi nama tabel categorys
	var $table = 'category';
	
	function Category_model() {
		parent::Model();
	}
	
	function getAllCategories() {
        $this->db->from($this->table); //tabel category
		$this->db->order_by('id_category');
        return $this->db->get()->result();
    }
	
	function getAllCategory($limit, $offset) {
        $this->db->from($this->table); //tabel category
		$this->db->order_by('id_category');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function countAll() {
		return $this->db->count_all($this->table);
    }
	
	function getCategoryByID($id_category) {
		$this->db->where('id_category', $id_category);
		return $this->db->get($this->table);
    }
	
	function addCategory($new_category){
		$this->db->insert($this->table, $new_category);
    }
    
    function updateCategory($id_category, $new_category) {
        $this->db->where('id_category', $id_category);
        $this->db->update($this->table, $new_category);
    }
    
    function deleteCategory($id_category) {
		$this->db->where('id_category', $id_category);
		$this->db->delete($this->table);
    }
}

?>