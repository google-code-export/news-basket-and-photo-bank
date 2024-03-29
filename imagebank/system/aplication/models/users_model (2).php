<?php

class Users_model extends Model {
    
	// Inisialisasi nama tabel users
	var $table = 'users';
	
	function Users_model() {
		parent::Model();
	}
	
	function checkUser($username, $password) {
		$id_user = mysql_real_escape_string($username);
		$pass_user = mysql_real_escape_string($password);
		
		$query = $this->db->get_where($this->table, array('id_user'=>$username, 'password'=>$password), 10, 0);
		
		if ($query->num_rows() == 1) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
        
	function getLevel($username) {
		$this->db->select('user_level');
		$this->db->where('id_user', $username);
		return $this->db->get($this->table);
	}
	
	function getAllUser($limit, $offset, $username) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel user
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
		$this->db->where_not_in('id_user', $username);
		$this->db->where_not_in('user_level', 'administrator');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function getAllUserByLevel($limit, $offset, $key) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel user
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
        $this->db->where('user_level', $key);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function getAllUserByPublisher($limit, $offset, $key) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel user
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
        $this->db->where('source.id_source', $key);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function countAll() {
		return $this->db->count_all($this->table);
    }
	
	function countUserByPublisher($key) {
		$this->db->where('id_source',  $key);
		return $this->db->get($this->table)->num_rows();
    }
	
	function countUserByLevel($key) {
		$this->db->where('user_level',  $key);
		return $this->db->get($this->table)->num_rows();
    }
	
	function getUserByID($id_user) {
        $this->db->distinct('id_user');
		$this->db->where('users.id_user', $id_user);
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
        return $this->db->get($this->table);
    }

    function updateUser($id_user, $new_user) {
        $this->db->where('id_user', $id_user);
        $this->db->update($this->table, $new_user);
    }

	function checkUsernameAvailability($username) {
		$query = $this->db->get_where($this->table, array('id_user'=>$username), 10, 0);
		
		if ($query->num_rows() > 0) {
			return TRUE; //username ini terpakai
		}
		else {
			return FALSE; //username belum terpakai
		}
	}
}

?>
?>