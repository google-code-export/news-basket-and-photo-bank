<?php

class User_model extends Model {
	function validate()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password', $this->input->post('password'));
		$query = $this->db->get('users');	
		
		if($query->num_rows == 1)
		{
			return true;
		}
	}
	
	function get_all_user(){
		$this->db->from('user');
		$this->db->join('level','level_id=user_level','left');
		return $this->db->get();
		
	}
	
	
}
