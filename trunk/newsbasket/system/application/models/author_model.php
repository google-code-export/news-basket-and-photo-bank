<?php

class Author_model extends Model {
    
	// Inisialisasi nama tabel authors
	var $table = 'author';
	
	function Author_model() {
		parent::Model();
	}
	
	function checkAuthor($author, $password) {
		$id_author = mysql_real_escape_string($author);
		$pass_author = mysql_real_escape_string($password);
		
		$query = $this->db->get_where($this->table, array('id_author'=>$author, 'password'=>$password), 10, 0);
		
		if ($query->num_rows() == 1) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	function getAllAuthor($limit, $offset) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel author
		$this->db->join('source', 'source.id_source = author.id_source'); //join sama tabel source
		$this->db->order_by('date_created');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function getAllAuthorByPublisher($limit, $offset, $key) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel author
		$this->db->join('source', 'source.id_source = author.id_source'); //join sama tabel source
        $this->db->where('source.id_source', $key);
        $this->db->order_by('date_created');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function countAll() {
		return $this->db->count_all($this->table);
    }
	
	function countAuthorByPublisher($key) {
		$this->db->where('id_source',  $key);
		return $this->db->get($this->table)->num_rows();
    }
	
	function countAuthorByLevel($key) {
		$this->db->where('author_level',  $key);
		return $this->db->get($this->table)->num_rows();
    }
	
	function getAuthorByID($id_author)
    {
        $this->db->select('*');
		$this->db->where('id_author', $id_author);
		return $this->db->get($this->table);
    }
	
	function addAuthor($new_author){
		$this->db->insert($this->table, $new_author);
    }
    
    function updateAuthor($id_author, $new_author) {
        $this->db->where('id_author', $id_author);
        $this->db->update($this->table, $new_author);
    }
    
    function deleteAuthor($id_author) {
		$this->db->where('id_author', $id_author);
		$this->db->delete($this->table);
    }
	
	function checkAuthorAvailability($id_author) {
		$query = $this->db->get_where($this->table, array('id_author'=>$id_author), 10, 0);
		
		if ($query->num_rows() > 0) {
			return TRUE; //nama author terpakai
		}
		else {
			return FALSE; //nama author belum terpakai
		}
	}
}

?>