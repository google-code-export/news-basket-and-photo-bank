<?php

class Manage_article extends Controller {
	
	//limitasi tabel
	var $limit = 13;
	
	function Manage_article() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer') {
			$this->load_article();
		}
		else {
			redirect('login');
        }
	}
	
	function load_article() {
		$data_article['page_title']			= 'Manage Article | News Basket';
		$data_article['main_view'] 			= 'user/manage_article_view';
		$data_article['form_action']		= site_url('user/manage_article/add_article');
		$data_article['form_action_search']	= site_url('user/manage_article/search_article');
		$data_article['form_action_edit']	= site_url('user/manage_article/edit_article');
		
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_article['publisher'] = $publisher;	
		
		// Siapa yang login dan membuat navigasi aktif
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username']	= $username;
		$data_article['active'] 	= 'article';
		
		// Offset
		$uri_segment 		= 4;
		$offset 			= $this->uri->segment($uri_segment);
		
		$this->load->model('Article_model','',TRUE);
		$articles  	= $this->Article_model->getAllArticle($this->limit, $offset);
		$num_rows 	= $this->Article_model->countAll();
		$data_article['article_table'] = $articles;
		$data_article['no'] 		   = $offset + 1; // untuk penomoran tabel
		
		// Membuat pagination			
		$config['base_url']    		= site_url('user/manage_article/load_article/');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_article['pagination'] = $this->pagination->create_links();
		
		$this->load->view('user/template', $data_article);
	}
	
	function detail_article($id_article) {
		$data_article['page_title']	 		= 'Detail Article |  News Basket';
		$data_article['main_view'] 	 		= 'user/detail/article_detail_view';
		$data_article['article_property']	= 'user/detail/article_detail_property';
		$link_manage_article				= site_url('user/manage_article');
		$data_article['breadcrumb']			= "<a href='$link_manage_article' style='color: white;'>Manage Article</a> > Article Detail";
		$data_article['form_action_edit']	= site_url('user/manage_article/edit_article').'/'.$id_article;
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		$data_article['active']   = 'article';
		
		// ambil data article dari ID nya
		$this->load->model('Article_model','',TRUE);
		$article = $this->Article_model->getArticleByID($id_article)->row();
		
		//simpan session id-article
		$this->session->set_userdata('id_article', $article->id_article);
			
		$data_article['article']['id_article'] 		= $article->id_article;
		$data_article['article']['source'] 			= $article->source_name;
		$data_article['article']['created_on'] 		= $article->created_on;
		$data_article['article']['lead_article']	= $article->lead_article;
		$data_article['article']['headline'] 		= $article->headline;
		$data_article['article']['body_article']	= $article->body_article;
		$data_article['article']['category'] 		= $article->category_name;
		$data_article['article']['slug']			= $article->slug;
		$data_article['article']['article_flag']	= $article->article_flag;
		
		// ambil tag artikel
		$data_article['article']['tag'] = $this->Article_model->getTagArticle($id_article);
		
		// ambil versi artikel
		$data_article['article']['list_version'] = $this->Article_model->getArticleVersion($id_article);
		
		// ambil data editor
		$data_article['article']['editor'] = $this->Article_model->getUserArticleByIDArticle($id_article, 'edited');
		
		// ambil data author
		$data_article['article']['author'] = $this->Article_model->getUserArticleByIDArticle($id_article, 'row_article');
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer') {
			$this->load->view('user/template', $data_article);
		}
	}
	
	function add_article() {
		$data_article['page_title']	 		= 'Add Article | News Basket';
		$data_article['main_view']			= 'user/form/add_article_form';
		$link_manage_article				= site_url('user/manage_article');
		$data_article['breadcrumb']			= "<a href='$link_manage_article' style='color: white;'>Manage Article</a>
											   > Add  New Article";		
		$data_article['form_action_add']	= site_url('user/manage_article/add_article_process');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		$data_article['active']   = 'article';
						
		// ambil data category
		$this->load->model('Category_model','',TRUE);
		$data_article['categories']			 = $this->Category_model->getAllCategories();
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer') {
			$this->load->view('user/template', $data_article);
		}
	}
	
		function add_article_process() {
		if ((($this->session->userdata('user_level') == 'editor') || ($this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer')) && $this->session->userdata('login') == TRUE) {
			
			$this->load->model('Users_model','', TRUE);
			$id_source = $this->Users_model->getSourceUser($this->session->userdata('username'));
			$name = $this->Users_model->getNameUser($this->session->userdata('username'));
			
			// Prepare data untuk disimpan di tabel article
			$new_article  = array(
				'headline'		=> $this->input->post('headline'),
				'id_source'  	=> $id_source,
				'lead_article'	=> $this->input->post('lead-article'),
				'body_article'  => $this->input->post('body-article'),
				'id_category'   => $this->input->post('id-category'),
				'article_flag'  => 'row_article',
				'created_on'	=> date('Y-m-d'),
				'locked'		=> 'no',
				'author'		=> $name
			);
			
			// Proses simpan data ke tabel article
			$id_article = $this->session->userdata('new_article'); // ambil data dari session
			$this->load->model('Article_model','',TRUE);
			$this->Article_model->addArticle($new_article);
			$id_article = $this->db->insert_id();
			
			// Pecah input tag
			$tag_pieces = explode(", ", $this->input->post('tag'));
			
			// Prepare data sekaligus proses simpan ke tabel tag
			$this->load->model('Tag_model','',TRUE);
			for ($i=0; $i<sizeof($tag_pieces); $i++) {
				// jika tag belum ada maka di tambahkan
				if ($this->Tag_model->checkTag($tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ') {
					$tag   = array('id_tag' => $tag_pieces[$i], 'tag_name' => $tag_pieces[$i]);
					$this->Tag_model->addTag($tag);
				}
			}
			
			// Prepare data sekaligus proses simpan ke tabel tag_article
			for ($i=0; $i<sizeof($tag_pieces); $i++) {
				if ($this->Tag_model->checkTagArticle($id_article, $tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ') { // jika tag belum ada maka di tambahkan
					$tag_article = array('id_article'=> $id_article, 'id_tag' => $tag_pieces[$i]);
					$this->Tag_model->addTagArticle($tag_article);
				}
			}
			
			// update tabel user article untuk log activity
			$id_user  = $this->session->userdata('username'); // username dari saat login
			if ($this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer') {
				$activity_log = array(
					'id_article'	=> $id_article,
					'id_user'   	=> $this->session->userdata('username'), //siapa yang login saat itu
					'flag'  		=> $this->input->post('article-flag'),
					'process_date' 	=> date('Y-m-d G:i:s')
				);
				$this->Article_model->AddUserArticle($activity_log);
			}
			
			$message = 'Article '.$id_article.' has been created!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('user/manage_article');
		}
		else {
			$message = 'Add article '.$id_article.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('user/manage_article');
		}
	}


	function edit_article($id_article) { 
		$data_article['page_title']	 		= 'Edit Article |  News Basket';
		$data_article['main_view'] 	 		= 'user/detail/article_detail_view';
		$data_article['edit_article_form']	= 'user/form/edit_article_form';
		$link_manage_article				= site_url('user/manage_article');
		$link_detail_article				= site_url('user/manage_article/detail_article').'/'.$id_article;
		$data_article['breadcrumb']			= "<a href='$link_manage_article' style='color: white;'>Manage Article</a>
											   > Edit Article";
		$data_article['form_action_edit']	= site_url('user/manage_article/edit_article_process').'/'.$id_article;
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		$data_article['active']   = 'article';
		
		// ambil data article dari ID nya
		$this->load->model('Article_model','',TRUE);
		$article = $this->Article_model->getArticleByID($id_article)->row();
		
		//simpan session id-article yang ingin di edit
		$this->session->set_userdata('id_article', $article->id_article);
			
		$data_article['article']['id_article'] 		= $article->id_article;
		$data_article['article']['lead_article']	= $article->lead_article;
		$data_article['article']['headline'] 		= $article->headline;
		$data_article['article']['body_article']	= $article->body_article;
		$data_article['article']['id_category'] 	= $article->id_category;
		$data_article['article']['article_flag'] 	= $article->article_flag;
		
		// ambil tag artikel
		$tag_article = $this->Article_model->getTagArticle($id_article);
		$tagstr = array();
		foreach ($tag_article as $column) {
			$tagstr[] = $column->id_tag;
		}
		$data_article['article']['tag'] = implode(", ", $tagstr);
		
		// ambil versi artikel
		$data_article['article']['list_version'] = $this->Article_model->getArticleVersion($id_article);
		
		// ambil data category
		$this->load->model('Category_model','',TRUE);
		$data_article['categories']			 = $this->Category_model->getAllCategories();
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer') {
			$this->load->view('user/template', $data_article);
		}
	}
	
	function edit_article_process() {
		if ((($this->session->userdata('user_level') == 'editor') || ($this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer')) && $this->session->userdata('login') == TRUE) {
		
			// Prepare data untuk disimpan di tabel article
			$article  = array(
				'headline'		=> $this->input->post('headline'),
				'lead_article'	=> $this->input->post('lead-article'),
				'body_article'  => $this->input->post('body-article'),
				'id_category'   => $this->input->post('id-category'),
				'article_flag'  => $this->input->post('article-flag')
			);
			
			// Proses simpan data ke tabel article
			$id_article = $this->session->userdata('id_article'); // ambil data dari session
			$this->load->model('Article_model','',TRUE);
			$this->Article_model->updateArticle($id_article, $article);
			
			// Prepare data untuk disimpan di tabel article_version
			$article_version   = array(
				'id_article'	=> $id_article,
				'headline'		=> $this->input->post('headline-version'),
				'lead_article'	=> $this->input->post('lead-article-version'),
				'body_article'  => $this->input->post('body-article-version'),
				'edited_by'   	=> $this->session->userdata('username'), //siapa yang login saat itu
				'edited_on'  	=> date('Y-m-d G:i:s')
			);
			
			// Proses simpan data ke tabel article_version
			$this->Article_model->addArticleVersion($article_version);
			
			// Pecah input tag
			$tag_pieces = explode(", ", $this->input->post('tag'));
			
			// Prepare data sekaligus proses simpan ke tabel tag
			$this->load->model('Tag_model','',TRUE);
			for ($i=0; $i<sizeof($tag_pieces); $i++) {
				// jika tag belum ada maka di tambahkan
				if ($this->Tag_model->checkTag($tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ') {
					$tag   = array('id_tag' => $tag_pieces[$i], 'tag_name' => $tag_pieces[$i]);
					$this->Tag_model->addTag($tag);
				}
			}
			
			// Prepare data sekaligus proses simpan ke tabel tag_article
			for ($i=0; $i<sizeof($tag_pieces); $i++) {
				if ($this->Tag_model->checkTagArticle($id_article, $tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ') { // jika tag belum ada maka di tambahkan
					$tag_article = array('id_article'=> $id_article, 'id_tag' => $tag_pieces[$i]);
					$this->Tag_model->addTagArticle($tag_article);
				}
			}
			
			// update tabel user article untuk log activity
			$id_user  = $this->session->userdata('username'); // username dari saat login
			if ($this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer') {
				$activity_log = array(
					'id_article'	=> $id_article,
					'id_user'   	=> $this->session->userdata('username'), //siapa yang login saat itu
					'flag'  		=> $this->input->post('article-flag'),
					'process_date' 	=> date('Y-m-d G:i:s')
				);
				$this->Article_model->AddUserArticle($activity_log);
			}
			
			$message = 'Article '.$id_article.' has been updated!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('user/manage_article/detail_article'.'/'.$id_article);
		}
		else {
			$message = 'Update article '.$id_article.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('user/manage_article/detail_article'.'/'.$id_article);
		}
	}
	
	
	function delete_article($id_article) {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer') {
			$this->load->model('Article_model','',TRUE);
			$this->Article_model->deleteArticle($id_article);
			$this->session->set_flashdata('message_success', 'Delete article successfull!');

			redirect('user/manage_article');
		}  
	}
	
	function search_article($start = 0) {
		$data_article['page_title']			= 'Search Article |  News Basket';
		$data_article['main_view'] 			= 'user/extra/search_article_view';
		$data_article['form_action_search']	= site_url('user/manage_article/search_article');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		$data_article['active']   = 'article';
		
		// Limit & Offset
		$uri_segment = 4;
		$offset      = $this->uri->segment($uri_segment);

		$key = $this->input->get('key');
		$data_article['key'] = $key;
		
		$this->load->model('Article_model','',TRUE);
		$data_article['result'] = $this->Article_model->searchArticle($this->limit, $offset, $key);
		$data_article['count']  = $this->Article_model->countSearch($key);
		
		// Membuat pagination			
		$config['base_url']    = site_url('user/manage_article/search_article');
		$config['total_rows']  = $data_article['count'];
		$config['per_page']    = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data_article['pagination']    = $this->pagination->create_links();

		$data_article['first_result'] = $start + 1;
		$data_article['last_result']  = min($start + $this->limit, $data_article['count']);

		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'reporter' || 'publisher' || 'viewer') {
			$this->load->view('user/template', $data_article);
		}
	}
	}
	

/* End of file manage_article.php */
/* Location: ./system/application/controllers/user/manage_article.php */