<?php

class Article_model extends Model {
    
	// Inisialisasi nama tabel articles
	var $table = 'article';
	
	function Article_model() {
		parent::Model();
	}
	
	function getAllArticle($limit, $offset) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel article
		$this->db->join('source', 'source.id_source = article.id_source'); //join sama tabel source
		$this->db->order_by('created_on');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function getAllArticleBySource($limit, $offset, $key) {
        $this->db->select('*');
        $this->db->from($this->table); //tabel article
		$this->db->join('source', 'source.id_source = article.id_source'); //join sama tabel source
        $this->db->where('source.id_source', $key);
        $this->db->order_by('create_on');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function countAll() {
		return $this->db->count_all($this->table);
    }
	
	function countArticleByPublisher($key) {
		$this->db->where('id_source',  $key);
		return $this->db->get($this->table)->num_rows();
    }
	
	function countArticleByLevel($key) {
		$this->db->where('article_level',  $key);
		return $this->db->get($this->table)->num_rows();
    }
	
	function getArticleByID($id_article)
    {
        $this->db->select('*');
		$this->db->where('id_article', $id_article);
		return $this->db->get($this->table);
    }
	
	function addArticle($new_article){
		$this->db->insert($this->table, $new_article);
    }
    
    function updateArticle($id_article, $new_article) {
        $this->db->where('id_article', $id_article);
        $this->db->update($this->table, $new_article);
    }
    
    function deleteArticle($id_article) {
		$this->db->where('id_article', $id_article);
		$this->db->delete($this->table);
    }
}

?>