<?php
  class Album_Model extends Model{
  	
	
	function Album(){
		parent::Model();
	}
	
  
  
  function create(){
  	$album_name =$this->input->post('album');
	$id_user = $this->session->userdata('username');
	$data = array(
			'album_name' => $album_name,
			'id_user' => $id_user 
	);
  	$this->db->insert('album',$data);
	
	
  }
  }
?>