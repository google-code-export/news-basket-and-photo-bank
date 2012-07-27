<?php

class Tag_model extends Model {
    
	// Inisialisasi nama tabel tags
	var $table = 'tag';
	
	function Tag_model() {
		parent::Model();
	}
	
	function getAllTag($limit, $offset) {
        $this->db->from($this->table); //tabel tag
		$this->db->order_by('id_tag');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function countAll() {
		return $this->db->count_all($this->table);
    }
	
	function getTagByID($id_tag) {
		$this->db->where('id_tag', $id_tag);
		return $this->db->get($this->table);
    }
	
	function checkTag($id_tag) {
		$this->db->from($this->table);
		$this->db->where('id_tag', $id_tag);
		if ($this->db->count_all_results() > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	function checkTagArticle($id_article, $id_tag) {
		$this->db->from('tag_article');
		$this->db->where('id_article', $id_article);
		$this->db->where('id_tag', $id_tag);
		if ($this->db->count_all_results() > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	function addTag($new_tag){
		$this->db->insert($this->table, $new_tag);
    }
	
	function addTagArticle($new_tag_article){
		$this->db->insert('tag_article', $new_tag_article);
    }
    
    function updateTag($id_tag, $new_tag) {
        $this->db->where('id_tag', $id_tag);
        $this->db->update($this->table, $new_tag);
    }
    
    function deleteTag($id_tag) {
		$this->db->where('id_tag', $id_tag);
		$this->db->delete($this->table);
    }
}

?>