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
		$user_id = 0;
		$query = $this->db->get_where($this->table, array('id_user'=>$username, 'password'=>$password), 10, 0);
		$is_valid = ($query->num_rows()>0);
		if ($is_valid == TRUE) {
			$this->update_last_logged_in($id_user);
			
			$this->update_last_ip($id_user);	
			return TRUE;
			
		}
		else {
			return FALSE;
		}
	}
	
	function update_last_logged_in($id_user)
	{
		$now = date('Y-m-d H:i:s');
		$this->db->where('id_user',$id_user);
		$this->db->update('users',array('last_login' =>$now));
		
		
		return $id_user;
	}
	
	function update_last_ip($id_user)
	{
		$ip_address = $this->session->userdata['ip_address'];
		$this->db->where('id_user',$id_user);
		$this->db->update('users', array('last_ip'=>$ip_address));
	}
	
	function update_last_logged_out($id_user){
		
		$now = date('Y-m-d H:i:s');
		$this->db->where('id_user',$id_user);
		$this->db->update('users',array('last_logout'=>$now));
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
		//$this->db->order_by('date_created', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function getAllUserByLevel($limit, $offset, $key) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel user
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
        $this->db->where('user_level', $key);
        $this->db->order_by('date_created');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	
	
	function countAll() {
		return $this->db->count_all($this->table);
    }
	

	
	function countUserByLevel($key) {
		$this->db->where('user_level',  $key);
		return $this->db->get($this->table)->num_rows();
    }
	
	function getUserByID($id_user)
    {
        $this->db->distinct('id_user');
		$this->db->where('users.id_user', $id_user);
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
        return $this->db->get($this->table);
    }
	
	function getUserArticleByIDUser($id_user)
    {
        $this->db->distinct('');
		$this->db->where('users_article.id_user', $id_user);
		$this->db->from('users_article');
		$this->db->join('article', 'article.id_article = users_article.id_article'); //join sama tabel source
		$this->db->order_by('process_date');
		return $this->db->get()->result();
    }
	
	function addUser($new_user){
		$this->db->insert($this->table, $new_user);
    }
    
    function updateUser($id_user, $new_user) {
        $this->db->where('id_user', $id_user);
        $this->db->update($this->table, $new_user);
    }
    
    function deleteUser($id_user) {
		$this->db->where('id_user', $id_user);
		$this->db->delete($this->table);
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
