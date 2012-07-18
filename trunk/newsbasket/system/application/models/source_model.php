<?php

class Source_model extends Model {
    
	// Inisialisasi nama tabel sources
	var $table = 'source';
	
	function Source_model() {
		parent::Model();
	}
    
	function getAllSource($limit, $offset) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel source
		$this->db->order_by('id_source');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function getAllSourceByType($limit, $offset, $key) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel source
		$this->db->where('source_type', $key);
		$this->db->order_by('id_source');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function getAllPublisher() {
        $this->db->select('*');
        $this->db->from($this->table); //tabel publisher
		$this->db->where('source_type', 'publisher');
		$this->db->order_by('id_source');
        return $this->db->get()->result();
    }
	
	function getAllWires() {
        $this->db->select('*');
        $this->db->from($this->table); //tabel publisher
		$this->db->where('source_type', 'wires');
		$this->db->order_by('id_source');
        return $this->db->get()->result();
    }
	
	function getSourceByID($id_source) {
		$this->db->select('*');
		$this->db->where('id_source', $id_source);
		return $this->db->get($this->table);
	}
    
	function countAll() {
		return $this->db->count_all($this->table);
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