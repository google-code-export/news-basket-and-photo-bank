<?php

class Category_model extends Model {
    
	// Inisialisasi nama tabel categorys
	var $table = 'category';
	
	function Category_model() {
		parent::Model();
	}
	
	function getAllCategories() {
        $this->db->order_by('id_category');
        return $this->db->get($this->table)->result();
    }
	
	function getAllCategory($limit, $offset) {
        $this->db->select("category.id_category, category_name, , 
						   SUM(CASE WHEN article_flag = 'row_article' THEN 1 ELSE 0 END) as row_article,
						   SUM(CASE WHEN article_flag = 'edited' THEN 1 ELSE 0 END) as edited,
						   SUM(CASE WHEN article_flag = 'published' THEN 1 ELSE 0 END) as published,
						   SUM(CASE WHEN article_flag = 'deleted' THEN 1 ELSE 0 END) as deleted,
						   SUM(CASE WHEN article.id_category = category.id_category THEN 1 ELSE 0 END) as total_article");
		$this->db->join('article', 'category.id_category = article.id_category');
        $this->db->order_by('id_category');
        $this->db->limit($limit, $offset);
        $this->db->group_by('category.id_category');
        return $this->db->get($this->table)->result();
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