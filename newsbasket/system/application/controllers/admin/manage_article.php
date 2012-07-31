<?php

class Manage_article extends Controller {
	
	//limitasi tabel
	var $limit = 15;
	
	function Manage_article() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load_article();
		}
		else {
			redirect('login');
        }
	}
	
	function load_article() {
		$data_article['page_title']			= 'Manage Article | Admin News Basket';
		$data_article['main_view'] 			= 'admin/manage_article_view';
		$data_article['form_action']		= site_url('admin/manage_article/add_article');
		$data_article['form_action_search']	= site_url('admin/manage_article/search_article');
		$data_article['form_action_edit']	= site_url('admin/manage_article/edit_article');
		
		$this->load->model('Source_model','',TRUE);
		$publisher = $this->Source_model->getAllPublisher();
		$data_article['publisher'] = $publisher;	
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		
		// Offset
		$uri_segment 	= 4;
		$offset 		= $this->uri->segment($uri_segment);
		
		$this->load->model('Article_model','',TRUE);
		$articles  	= $this->Article_model->getAllArticle($this->limit, $offset);
		$num_rows 	= $this->Article_model->countAll();
		$data_article['article_table'] = $articles;

		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_article/load_article');
		$config['total_row']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_article['pagination'] = $this->pagination->create_links();
		
		$this->load->view('admin/template', $data_article);
	}
	
	function detail_article($id_article) {
		$data_article['page_title']	 		= 'Detail Article | Admin News Basket';
		$data_article['main_view'] 	 		= 'admin/detail/article_detail_view';
		$data_article['article_property']	= 'admin/detail/article_detail_property';
		$link_manage_article				= site_url('admin/manage_article');
		$data_article['breadcrumb']			= "<a href='$link_manage_article' style='color: white;'>Manage Article</a> > Article Detail";
		$data_article['form_action_edit']	= site_url('admin/manage_article/edit_article').'/'.$id_article;
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		
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
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_article);
		}
	}
	/*
	function add_article() {
		$this->load->helper('security');
		if ($this->session->userdata('user_level') == 'administrator' && $this->session->userdata('login') == TRUE) {
			$new_article  = array(
				'id_article'	=> $this->input->post('id-article'),
				'id_source'		=> $this->input->post('publisher'),
				'password'		=> dohash($this->input->post('password')),
				'name'      	=> $this->input->post('name'),
				'phone'       	=> $this->input->post('phone'),
				'email'   		=> $this->input->post('email'),
				'date_created'	=> date('Y-m-d G:i:s')
			);
			// Proses simpan data absensi
			$this->load->model('Article_model','',TRUE);
			$this->Article_model->addUrticle($new_article);
			
			$message = 'Add new article '.$new_article['id_article'].' successfull!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_article');
		}
		
		else {
			$message = 'Add new article '.$new_article['id_article'].' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('admin/manage_article');
		}
	}*/
	
	function edit_article($id_article) { 
		$data_article['page_title']	 		= 'Edit Article | Admin News Basket';
		$data_article['main_view'] 	 		= 'admin/detail/article_detail_view';
		$data_article['edit_article_form']	= 'admin/form/edit_article_form';
		$link_manage_article				= site_url('admin/manage_article');
		$link_detail_article				= site_url('admin/manage_article/detail_article').'/'.$id_article;
		$data_article['breadcrumb']			= "<a href='$link_manage_article' style='color: white;'>Manage Article</a> > 
											   <a href='$link_detail_article' style='color: white;'>Article Detail</a> 
											   > Edit Article";
		$data_article['form_action_edit']	= site_url('admin/manage_article/edit_article_process').'/'.$id_article;
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		
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
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_article);
		}
	}
	
	function edit_article_process() {
		if ((($this->session->userdata('user_level') == 'editor') || ($this->session->userdata('user_level') == 'administrator')) && $this->session->userdata('login') == TRUE) {
		
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
				if ($this->Tag_model->checkTag($tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ') { // jika tag belum ada maka di tambahkan
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
			if ($this->session->userdata('user_level') == 'administrator') {
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
			redirect('admin/manage_article/detail_article'.'/'.$id_article);
		}
		else {
			$message = 'Update article '.$id_article.' failed!'; 
			$this->session->set_flashdata('message_failed', $message);
			redirect('admin/manage_article/detail_article'.'/'.$id_article);
		}
	}
	
	/*
	function delete_article($id_article) {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->model('Article_model','',TRUE);
			$this->Article_model->deleteArticle($id_article);
			$this->session->set_flashdata('message_success', 'Delete article successfull!');

			redirect('admin/manage_article');
		}  
	}*/
	
	function search_article($start = 0) {
		$data_article['page_title']			= 'Search Article | Admin News Basket';
		$data_article['main_view'] 			= 'admin/extra/search_article_view';
		$data_article['form_action_search']	= site_url('admin/manage_article/search_article');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		
		// Limit & Offset
		$uri_segment = 4;
		$offset      = $this->uri->segment($uri_segment);

		$key = $this->input->get('key');
		$data_article['key'] = $key;
		
		$this->load->model('Article_model','',TRUE);
		$data_article['result'] = $this->Article_model->searchArticle($this->limit, $offset, $key);
		$data_article['count']  = $this->Article_model->countSearch($key);
		
		// Membuat pagination			
		$config['base_url']    = site_url('admin/manage_article/search_article');
		$config['total_rows']  = $data_article['count'];
		$config['per_page']    = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data_article['pagination']    = $this->pagination->create_links();

		$data_article['first_result'] = $start + 1;
		$data_article['last_result']  = min($start + $this->limit, $data_article['count']);

		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_article);
		}
	}
	
	function retrieve_email() {
		/*$config['type'] = 'imap';
		$config['host'] = 'mail.google.com';
		$config['username'] = 'andrefadila@gmail.com';
		$config['password'] = 'p72412714';
		$config['port'] = 993;
		//$config['secure'] = TRUE;
		$config['timeout'] = 15;
		$this->load->library('mailbox', $config);
		
		//$mailbox  = new Mailbox('imap', 'imap.gmail.com', 'andrefadila@gmail.com', 'p72412714', 993);
		$messages = $this->mailbox->listMessages(5);
		*/
		
		$this->load->helper('imapmailbox');
		
		define('GMAIL_EMAIL', 'andrefadila@gmail.com');
		define('GMAIL_PASSWORD', 'p72412714');
		
		$mailbox = new ImapMailbox('{imap.gmail.com:993/imap/novalidate-cert/ssl}imap', GMAIL_EMAIL, GMAIL_PASSWORD,'','utf-8');
		$mails = array();
		foreach($mailbox->searchMails('UNSEEN') as $mailId) { // mencari email yang belum terbaca
			$mail = $mailbox->getMail($mailId, 1);
			$mails[] = $mail; // simpan semuanya kedalam array
		}
		
		// load model author dan article
		$this->load->model('Author_model','',TRUE);
		$this->load->model('Article_model','',TRUE);
		
		// proses loop simpan ke database
		foreach($mails as $key => $value) {
			$new_author = array(
				'id_author' => $value->fromAddress,
				'id_source'	=> 1,
				'name' 		=> $value->fromName,
				'email' 	=> $value->fromAddress
			);
			
			if ($this->Author_model->checkAuthorAvailability($new_author['id_author']) == FALSE) { // jika author belum ada maka di tambahkan
				$this->Author_model->addAuthor($new_author);
			}
			
			$new_article = array(
				'id_source'		=> 1,
				'id_category'	=> 'tes',
				'author'		=> $value->fromName,
				'created_on'	=> $value->date,
				'headline'		=> $value->subject,
				'body_article'	=> strip_tags($value->textHtml),
				'article_flag'	=> 'row_article',
				'locked'		=> 'no'
			);
			
			$this->Article_model->addArticle($new_article);
		}
		
		$data['mails'] = $mails;
		
		$this->load->view('test', $data);
	}
}

/* End of file manage_article.php */
/* Location: ./system/application/controllers/admin/manage_article.php */