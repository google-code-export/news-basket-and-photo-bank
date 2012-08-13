<?php

class Source_model extends Model {
    
	// Inisialisasi nama tabel sources
	var $table = 'source';
	
	function Source_model() {
		parent::Model();
	}
    
	function getAllSource($limit, $offset) {
		$this->db->order_by('id_source');
        $this->db->limit($limit, $offset);
        return $this->db->get($this->table)->result();
    }
	
	function getAllSource2() {
		$this->db->order_by('source_type');
        return $this->db->get($this->table)->result();
    }
	
	function getAllSourceByType($limit, $offset, $key) {
		$this->db->where('source_type', $key);
		$this->db->order_by('id_source');
        $this->db->limit($limit, $offset);
        return $this->db->get($this->table)->result();
    }
	
	function getAllPublisher() {
		$this->db->where('source_type', 'publisher');
		$this->db->order_by('id_source');
        return $this->db->get($this->table)->result();
    }
	
	function getAllWires() {
		$this->db->where('source_type', 'wires');
		$this->db->order_by('id_source');
        return $this->db->get($this->table)->result();
    }
	
	function getSourceByID($id_source) {
		$this->db->where('id_source', $id_source);
		return $this->db->get($this->table);
	}
    
	function countAll() {
		return $this->db->count_all($this->table);
    }
	
	function countSourceByType($key) {
		$this->db->where('source_type',  $key);
		return $this->db->get($this->table)->num_rows();
    }
	
	function countArticleBySource() {
		$this->db->select('source_name, count(article.id_source) as total_article');
		$this->db->join('article', 'source.id_source = article.id_source'); //join sama tabel article
		$this->db->group_by('article.id_source');
		return $this->db->get($this->table)->result();
    }	
	
	function addSource($new_source){
		$this->db->insert($this->table, $new_source);
    }
    
    function updateSource($id_source, $new_source) {
        $this->db->where('id_source', $id_source);
        $this->db->update($this->table, $new_source);
    }
    
    function deleteSource($id_source) {
		$this->db->where('id_source', $id_source);
		$this->db->delete($this->table);
    }
	
}

?>