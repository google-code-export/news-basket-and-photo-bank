<?php
class MAdmin extends  Model{
	
	function MAdmin(){
		parent::Model();
	}
	
	function verifyUser($u,$pw){
		$this->db->select('id_users','username');
		$this->db->where('username',$u);
		$this->db->where('password',$pw);
		$this->db->limit(1);
		$Q=$this->db->get('users');
		if($Q->num_rows() >0){
			$row = $Q->row_array();
			$_SESSION['id_users'] = $row['id_users'];
			$_SESSION['username'] = $row['username'];
			
		}else {
			$this->session->set_flashdata('error','Sorry, your username or password is incorect!' );
		}
	}
}


?>