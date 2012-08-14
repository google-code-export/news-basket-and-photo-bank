<?php

class Tag_model extends Model {
    
	// Inisialisasi nama tabel tags
	var $table = 'tag';
	
	function Tag_model() {
		parent::Model();
	}
	
	function getAllTag($limit, $offset) {
		$this->db->select("tag.id_tag, tag_name, 
						   SUM(CASE WHEN article_flag = 'row_article' THEN 1 ELSE 0 END) as row_article,
						   SUM(CASE WHEN article_flag = 'edited' THEN 1 ELSE 0 END) as edited,
						   SUM(CASE WHEN article_flag = 'published' THEN 1 ELSE 0 END) as published,
						   SUM(CASE WHEN article_flag = 'deleted' THEN 1 ELSE 0 END) as deleted,
						   COUNT(article_flag) as total_article");
		$this->db->order_by('id_tag');
        $this->db->join('tag_article', 'tag_article.id_tag = tag.id_tag');
        $this->db->join('article', 'article.id_article = tag_article.id_article');
        $this->db->limit($limit, $offset);
		$this->db->group_by('tag.id_tag');
        return $this->db->get($this->table)->result();
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