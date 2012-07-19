<?php
class Gallery_model extends Model {
	
	function Gallery_model() {
		parent::Model();
	}
	
	function tampil_foto(){
		$this->db->select('*');
		$this->db->from('images');
		return $this->db->get()->result();		
	}
	
	function detail_foto($id){
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where('id_images', $id);
		return $this->db->get()->result();
	}
}



