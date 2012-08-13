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
		$this->db->order_by('created_on', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
		function getAllArticleDel($limit, $offset) {
        $this->db->from($this->table); //tabel article
		$this->db->join('source', 'source.id_source = article.id_source'); //join sama tabel source
		$article = array('deleted');	
		$this->db->where_not_in('article_flag', $article);
		$this->db->order_by('created_on', 'desc');
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
	
	function getAllArticleByUser($id_user, $limit, $offset) {
        $this->db->from('users_article');
		$this->db->where('id_user', $id_user);
        $this->db->join('article', 'users_article.id_article = article.id_article');
        $this->db->join('source', 'source.id_source = article.id_source'); //join sama tabel source
		$this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function countAllArticleByUser($id_user) {
        $this->db->from('users_article');
		$this->db->where('id_user', $id_user);
        $this->db->join('article', 'users_article.id_article = article.id_article');
        $this->db->join('source', 'source.id_source = article.id_source'); //join sama tabel source
		return $this->db->get()->num_rows();
    }
	
	function countAll() {
		return $this->db->count_all($this->table);
    }
	
	function countArticleByFlag($key) {
		$this->db->where('article_flag',  $key);
		return $this->db->get($this->table)->num_rows();
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
		$this->db->join('category', 'category.id_category = article.id_category'); //join sama tabel category
		return $this->db->get($this->table);
    }
	
	function getUserArticleByIDArticle($id_article, $flag) {
        $this->db->where('id_article', $id_article);
		$this->db->where('users_article.flag', $flag);
		$this->db->from('users_article');
		$this->db->join('users', 'users_article.id_user = users.id_user'); //join sama tabel user_article
		$this->db->group_by('users.id_user');
		return $this->db->get()->result();
    }
	
	function getTagArticle($id_article) {
		$this->db->where('id_article', $id_article);
		$this->db->from('tag_article');
		return $this->db->get()->result();
	}
	
	function getArticleVersion($id_article) {
        $this->db->where('article.id_article', $id_article);
		$this->db->join('article_version', 'article_version.id_article = article.id_article'); //join sama tabel version
		$this->db->order_by('edited_on', 'desc');
		$this->db->limit(5);
		return $this->db->get($this->table)->result();
    }
	
	function searchArticle($limit, $offset, $key) {
        $this->db->from('article');
		if ($key != "") {
			$this->db->like('body_article', $key);
		}
		$this->db->join('source', 'source.id_source = article.id_source'); //join sama tabel source
		$this->db->join('category', 'category.id_category = article.id_category'); //join sama tabel source
        $this->db->order_by('created_on', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	 
    function countSearch($key) {
		$this->db->like('body_article', $key);
        return $this->db->get($this->table)->num_rows();
    }
	
    function advanceSearch($limit, $offset, $key, $author, $category, $source, $flag, $order, $fromdate, $todate, $date) {
        $this->db->like('body_article', $key);
		if ($author != "") {
			$this->db->like('author', $author);
        }
		if ($category != "all") {
			$this->db->like('article.id_category', $category);
        }
		if ($source != "all") {
			$this->db->like('article.id_source', $source);
        }
		if ($flag != "all") {
			$this->db->like('article_flag', $flag);
        }
		if ($date == "" && (!empty($fromdate) && !empty($todate))) {
			$this->db->where('created_on >=', $fromdate);
			$this->db->where('created_on <=', $todate);
		}
		else if ($date != "") {
			$this->db->where('created_on =', $date);
		}
		$this->db->join('source', 'source.id_source = article.id_source'); //join sama tabel source
		$this->db->join('category', 'category.id_category = article.id_category'); //join sama tabel source
        $this->db->order_by('created_on', $order);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->table)->result();
    }
   
	function countAdvanceSearch($key, $author, $category, $source, $flag, $order, $fromdate, $todate, $date) {
		$this->db->like('body_article', $key);
		if ($author != "") {
			$this->db->like('author', $author);
        }
		if ($category != "all") {
			$this->db->like('article.id_category', $category);
        }
		if ($source != "all") {
			$this->db->like('article.id_source', $source);
			$this->db->like('article.id_source', $source);
        }
		if ($flag != "all") {
			$this->db->like('article_flag', $flag);
        }
		if ($date == "" && (!empty($fromdate) && !empty($todate))) {
			$this->db->where('created_on >=', $fromdate);
			$this->db->where('created_on <=', $todate);
		}
		else if ($date != "") {
			$this->db->where('created_on =', $date);
		}
		return $this->db->get($this->table)->num_rows();
    }
	
	function addArticle($new_article){
		$this->db->insert($this->table, $new_article);
    }
    
    function updateArticle($id_article, $new_article) {
        $this->db->where('id_article', $id_article);
        $this->db->update($this->table, $new_article);
    }
	
	function changeArticleFlag($new_flag, $id_article) {
		$this->db->where('id_article', $id_article);
        $this->db->update($this->table, $new_flag);
	}
	
	function AddUserArticle($new_users_article) {
		$this->db->insert('users_article', $new_users_article);
	}
    
    function deleteArticle($id_article) {
		$this->db->where('id_article', $id_article);
		$this->db->delete($this->table);
    }
	
	function addArticleVersion($new_article_version){
		$this->db->insert('article_version', $new_article_version);
    }
	
	function lockArticle($id_article){
		$this->db->where('id_article', $id_article);
		$this->db->update($this->table, array('locked' => 'yes'));
	}
	
	function unlockArticle($id_article){
		$this->db->where('id_article', $id_article);
		$this->db->update($this->table, array('locked' => 'no'));
	}
	
	function checkLockArticle($id_article){
		$this->db->select('locked');
		$this->db->where('id_article', $id_article);
		$query = $this->db->get($this->table)->row()->locked;
		
		if ($query == 'no') {
			return TRUE; // not locked
		}
		else {
			return FALSE; // locked
		}
		
	}
}

?>