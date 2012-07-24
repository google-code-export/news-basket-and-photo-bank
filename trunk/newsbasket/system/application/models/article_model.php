<?php

class Article_model extends Model {
    
	// Inisialisasi nama tabel articles
	var $table = 'article';
	
	function Article_model() {
		parent::Model();
	}
	
	function getAllArticle($limit, $offset) {
        $this->db->from($this->table); //tabel article
		$this->db->join('source', 'source.id_source = article.id_source'); //join sama tabel source
		$this->db->order_by('created_on');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function getAllArticleBySource($limit, $offset, $key) {
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
	
	function getArticleByID($id_article) {
        $this->db->where('article.id_article', $id_article);
		$this->db->join('source', 'source.id_source = article.id_source'); //join sama tabel source
		return $this->db->get($this->table);
    }
	
	function getUserArticleByIDArticle($id_article, $flag) {
        $this->db->distinct('id_user');
		$this->db->where('id_article', $id_article);
		$this->db->where('users_article.flag', $flag);
		$this->db->from('users_article');
		$this->db->join('users', 'users_article.id_user = users.id_user'); //join sama tabel user_article
		return $this->db->get()->result();
    }
	
	function getArticleVersion($id_article) {
        $this->db->where('article.id_article', $id_article);
		$this->db->join('article_version', 'article_version.id_article = article.id_article'); //join sama tabel version
		$this->db->order_by('edited_on');
		return $this->db->get($this->table)->result();
    }
	
	function getArticleCategory($id_article) {
		$this->db->where('article_category.id_article', $id_article);
		$this->db->from('article_category');
		$this->db->join('category', 'category.id_category = article_category.id_category');
		return $this->db->get()->result();
	}
	
	function searchArticle($limit, $offset, $key) {
        $this->db->from('article');
        $this->db->like('headline', $key);
        $this->db->or_like('body_article', $key);
        $this->db->order_by('created_on', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    
    function countSearch($key) {
        $this->db->from('article');
		$this->db->like('body_article', $key);
        return $this->db->get()->num_rows();
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