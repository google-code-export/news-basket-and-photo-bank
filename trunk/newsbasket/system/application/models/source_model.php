<?php

class Source_model extends Model {
    
	// Inisialisasi nama tabel users
	var $table = 'source';
	
	function Source_model() {
		parent::Model();
	}
    
	function getSourceByID($id_source) {
		$this->db->select('*');
		$this->db->where('id_source', $id_source);
		return $this->db->get($this->table)->result();
	}
    
	function countAll() {
		return $this->db->count_all($this->table);
    }
}

?>