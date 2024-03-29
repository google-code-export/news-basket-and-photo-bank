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
	
	function getSourceUser($username) {
		$this->db->select('id_source');
		$this->db->where('id_user', $username);
		return $this->db->get($this->table)->row()->id_source;
	}
	
	function getNameUser($username) {
		$this->db->select('name');
		$this->db->where('id_user', $username);
		return $this->db->get($this->table)->row()->name;
	}
		
	function getAllUser($limit, $offset, $username) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel user
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
		$this->db->where_not_in('id_user', $username);
		$this->db->where_not_in('user_level', 'administrator');
		$this->db->order_by('date_created', 'desc');
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
	
	function getAllUserByPublisher($limit, $offset, $key) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel user
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
        $this->db->where('source.id_source', $key);
        $this->db->order_by('date_created');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function countAll() {
		return $this->db->count_all($this->table);
    }
	
	function countUserBySource() {
		$this->db->select('source_name, count(users.id_source) as total_user');
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
		$this->db->group_by('users.id_source');
		return $this->db->get($this->table)->result();
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
	
	function getUserArticleByIDUser($id_user) {
        $this->db->distinct('');
		$this->db->where('users_article.id_user', $id_user);
		$this->db->from('users_article'); // table users_article
		$this->db->join('article', 'article.id_article = users_article.id_article'); //join sama tabel article
		$this->db->order_by('process_date', 'desc');
		return $this->db->get()->result();
    }
	/*
	function countStatistic($id_user, $flag) {
		$query = $this->db->query("
			SELECT date(process_date) as date_process, COUNT(id_users_article) as statistic
			FROM users_article WHERE id_user='$id_user' and flag='$flag'
			GROUP BY date(process_date) LIMIT 10
		");
		return $query->result();
	}*/
	
	function searchUser($limit, $offset, $key) {
        $this->db->like('name', $key);
		$this->db->join('source', 'source.id_source = users.id_source'); //join sama tabel source
        $this->db->limit($limit, $offset);
        return $this->db->get($this->table)->result();
    }
	
	function countSearch($key) {
		$this->db->like('name', $key);
		return $this->db->get($this->table)->num_rows();
    }
	
	function countStatistic($id_user, $flag) {
		$this->db->from('users_article');
		$this->db->where('id_user', $id_user);
		$this->db->where('flag', $flag);
		return $this->db->count_all_results();
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

?>