<?php

class Manage_article extends Controller {
	
	//limitasi tabel
	var $limit = 50;
	
	function Manage_article() {
		parent::Controller();	
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load_article(50);
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
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
		
		// Siapa yang login dan membuat navigasi aktif
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		$data_article['active']	  = 'article';
		
		// Offset
		$uri_segment = 4;
		$offset 	 = $this->uri->segment($uri_segment);
		
		$this->load->model('Article_model','',TRUE);
		$articles  	= $this->Article_model->getAllArticle($this->limit, $offset);
		$num_rows 	= $this->Article_model->countAll();
		$data_article['article_table'] = $articles;
		
		// untuk penomoran dan menampilkan hasil
		$data_article['start'] 	= $offset + 1; // untuk penomoran tabel
		$data_article['finish'] = min($data_article['start'] + $this->limit - 1, $data_article['start'] + ($num_rows - $data_article['start']));
		$data_article['total']  = $num_rows;
		
		// Membuat pagination			
		$config['base_url']    		= site_url('admin/manage_article/load_article/');
		$config['total_rows']		= $num_rows;
		$config['per_page']     	= $this->limit;
		$config['num_links']     	= 5;
		$config['uri_segment']  	= $uri_segment;
		$this->pagination->initialize($config);
		$data_article['pagination'] = $this->pagination->create_links();
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_article);
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
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
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_article);
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
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
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_article);
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
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
			$tags = $this->input->post('tag');
			if (!empty($tags)) {
				$tag_pieces = explode(", ", $tags);
				
				// Prepare data sekaligus proses simpan ke tabel tag
				$this->load->model('Tag_model','',TRUE);
				for ($i=0; $i<sizeof($tag_pieces); $i++) {
					// jika tag belum ada maka di tambahkan
					if ($this->Tag_model->checkTag(strtolower($tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ')) {
						$tag   = array('id_tag' => strtolower($tag_pieces[$i]), 'tag_name' => $tag_pieces[$i]);
						$this->Tag_model->addTag($tag);
					}
				}
				
				// Prepare data sekaligus proses simpan ke tabel tag_article
				for ($i=0; $i<sizeof($tag_pieces); $i++) {
					if ($this->Tag_model->checkTagArticle($id_article, strtolower($tag_pieces[$i]) == FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' ')) { // jika tag belum ada maka di tambahkan
						$tag_article = array('id_article'=> $id_article, 'id_tag' => strtolower($tag_pieces[$i]));
						$this->Tag_model->addTagArticle($tag_article);
					}
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
	
	function edit_multiple_flag() {
		if (($this->session->userdata('user_level') == 'administrator') && $this->session->userdata('login') == TRUE) {
			
			$id_user  		  = $this->session->userdata('username'); // username dari saat login
			$id_article_array = $this->input->post('checkbox');
			$article_flag 	  = $this->input->post('article-flag');
			$sum 			  = 0;
			
			if (!empty($id_article_array)) {
				foreach ($id_article_array as $checked_id) {
					
					// update flag sekaligus
					$new_flag = array('article_flag' => $article_flag);
					$this->load->model('Article_model','',TRUE);
					$this->Article_model->changeArticleFlag($new_flag, $checked_id);
					
					// untuk activity log
					$activity_log = array(
						'id_article'	=> $checked_id,
						'id_user'   	=> $this->session->userdata('username'), //siapa yang login saat itu
						'flag'  		=> $article_flag,
						'process_date' 	=> date('Y-m-d G:i:s')
					);
					$this->Article_model->AddUserArticle($activity_log);
					
					$sum++;
				}
				$message = $sum.' article flag has been updated!'; 
				$this->session->set_flashdata('message_success', $message);
				redirect('admin/manage_article');
			}
			else {
				$message = 'Update article flag has been failed!'; 
				$this->session->set_flashdata('message_failed', $message);
				redirect('admin/manage_article');
			}
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
	function search_article($start = 0) {
		$data_article['page_title']			= 'Search Article | Admin News Basket';
		$data_article['main_view'] 			= 'admin/extra/search_article_view';
		$data_article['form_action_search']	= site_url('admin/manage_article/search_article');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		$data_article['active']   = 'article';
		
		// Limit & Offset
		$uri_segment = 4;
		$offset      = $this->uri->segment($uri_segment);
		
		// kata kunci pencarian
		$key = $this->input->get('key');
		if (empty($key)) { // jika kata kunci pencarian tidak ada
			$key = $this->session->userdata('key'); // ambil dari session
		}
		else {
			$this->session->set_userdata('key', $key); // set kata kunci pencarian ke dalam session
		}
		$data_article['key'] = $key;
		
		$this->load->model('Article_model','',TRUE);
		$data_article['result'] = $this->Article_model->searchArticle($this->limit, $offset, $key);
		$data_article['count']  = $this->Article_model->countSearch($key);
		
		// Membuat pagination			
		$config['base_url']    = site_url('admin/manage_article/search_article');
		$config['total_rows']  = $data_article['count'];
		$config['per_page']    = $this->limit;
		$config['num_links']   = 5;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data_article['pagination']    = $this->pagination->create_links();

		$data_article['first_result'] = $start + 1;
		$data_article['last_result']  = min($start + $this->limit, $data_article['count']);

		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->load->view('admin/template', $data_article);
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
	function retrieve_email() {
		if (($this->session->userdata('user_level') == 'administrator') && $this->session->userdata('login') == TRUE) {
			$this->load->helper('imapmailbox');
			
			define('GMAIL_EMAIL', 'andrefadila@gmail.com');
			define('GMAIL_PASSWORD', 'p72412714');
			
			//$mailbox = new ImapMailbox('{imap.gmail.com:993/imap/novalidate-cert/ssl}imap', GMAIL_EMAIL, GMAIL_PASSWORD,'','utf-8');
			$mailbox = new ImapMailbox('{imap.gmail.com:993/imap/novalidate-cert/ssl}INBOX', GMAIL_EMAIL, GMAIL_PASSWORD,'','utf-8');
			$mails = array();
			foreach($mailbox->searchMails('UNSEEN') as $mailId) { // mencari email yang belum terbaca
				$mail = $mailbox->getMail($mailId, 1);
				$mails[] = $mail; // simpan semuanya kedalam array
			}
			
			// load model author dan article
			$this->load->model('Author_model','',TRUE);
			$this->load->model('Article_model','',TRUE);
			
			// proses loop simpan ke database
			if(!empty($mails)) {
				$sum = 0;
				foreach($mails as $key => $value) {
					
					// cek author sudah ada atau belum, jika belum tambahkan
					if ($this->Author_model->checkAuthorAvailability($value->fromAddress) == FALSE) { // jika author belum ada maka di tambahkan
						$new_author = array(
							'id_author' => $value->fromAddress,
							'id_source'	=> 1,
							'name' 		=> $value->fromName,
							'email' 	=> $value->fromAddress
						);
					
						$this->Author_model->addAuthor($new_author);
					}
					
					// proses memasukan artikel ke dalam database
					$new_article = array(
						'id_source'		=> 1,
						'id_category'	=> 'tes',
						'author'		=> $value->fromName,
						'created_on'	=> $value->date,
						'headline'		=> $value->subject,
						'slug'			=> str_replace(" ", "-", $value->subject),
						'body_article'	=> strip_tags($value->textHtml),
						'article_flag'	=> 'row_article',
						'locked'		=> 'no'
					);
					
					$this->Article_model->addArticle($new_article);
					
					$sum++;
					
					$message = 'Add '. $sum .' new article from email successfull!'; 
					$this->session->set_flashdata('message_success', $message);
				}
				redirect('admin/manage_article');
			}
			else {
				$message = 'Retrieve article from email failed!'; // bisa karena max execution time atau email udah terbaca semua
				$this->session->set_flashdata('message_failed', $message);
				redirect('admin/manage_article');
			}
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
	function retrieve_afp() {
		if (($this->session->userdata('user_level') == 'administrator') && $this->session->userdata('login') == TRUE) {
			$this->load->model('Author_model','',TRUE);
			$this->load->model('Article_model','',TRUE);
			$this->load->helper('directory');
			
			// ---------- untuk xml dari AFP ----------- //
			$afp	= directory_map("./xml_wires/Afp/");
			$sum    = 0;
			foreach ($afp as $filename) {
				$xml 	= simplexml_load_file(base_url()."xml_wires/Afp/".$filename); // baca file nya
				
				// siapkan headline, slugline, author
				$newsline 	  = $xml->xpath("//NewsLines");
				foreach ($newsline as $content) {
					$headline = $content->HeadLine;
					$slugline = $content->SlugLine;
					$author	  = substr($content->ByLine, 3);
					//echo $content->DateLine."<br><br>";
				}
				
				// siapkan body_article
				$body 		  = $xml->xpath("//body.content");
				$body_array	  = array();
				foreach ($body[0] as $content) {
					$body_array[] = $content;
				}
				$body_article = implode("\n", $body_array);
				
				if ($this->Author_model->checkAuthorAvailability($author) == FALSE) { // jika author belum ada maka di tambahkan
					$new_author = array(
						'id_author' => $author,
						'id_source'	=> 3,
						'name' 		=> $author
					);
					$this->Author_model->addAuthor($new_author);
				}
					
				// proses memasukan artikel ke dalam database
				$new_article = array(
					'id_source'		=> 3,
					'id_category'	=> 'tes',
					'author'		=> $author,
					'created_on'	=> date('Y-m-d G:i:s'),
					'headline'		=> (string)$headline,
					'slug'			=> str_replace(" ", "-", $headline),
					'body_article'	=> $body_article,
					'article_flag'	=> 'row_article',
					'locked'		=> 'no'
				);
				
				$this->Article_model->addArticle($new_article);
					
				$sum++; // counter
			}
			$message = 'Add '. $sum .' new article from AFP successfull!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_article');
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
	function retrieve_asianwire() {
		if (($this->session->userdata('user_level') == 'administrator') && $this->session->userdata('login') == TRUE) {
			$this->load->model('Author_model','',TRUE);
			$this->load->model('Article_model','',TRUE);
			$this->load->helper('directory');
			
			// ---------- untuk xml dari AsianWire ----------- //
			$asianwire  = directory_map("./xml_wires/AsianWire/");
			foreach ($asianwire as $filename) {
				$xml 	= simplexml_load_file(base_url()."xml_wires/AsianWire/".$filename); // baca file nya
				
				// siapkan headline
				$headline_array = $xml->xpath("//hl1");
				foreach ($headline_array as $content) {
					$headline = $content;
				}
				
				// siapkan body_article
				$body 		  = $xml->xpath("//block");
				$body_array	  = array();
				
				foreach ($body as $content) {
					foreach ($content as $paragraph) {
						$body_array[] = $paragraph;
					}
				}
				$body_article = implode("\n", $body_array);
				
				// proses memasukan artikel ke dalam database
				$new_article = array(
					'id_source'		=> 5,
					'id_category'	=> 'tes',
					'created_on'	=> date('Y-m-d G:i:s'),
					'headline'		=> (string)$headline,
					'slug'			=> str_replace(" ", "-", $headline),
					'body_article'	=> $body_article,
					'article_flag'	=> 'row_article',
					'locked'		=> 'no'
				);
				
				$this->Article_model->addArticle($new_article);
					
				$sum++; // counter
			}
			
			$message = 'Add '. $sum .' new article from Asian Wire successfull!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_article');
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
	function retrieve_dpa() {
		if (($this->session->userdata('user_level') == 'administrator') && $this->session->userdata('login') == TRUE) {
			$this->load->model('Author_model','',TRUE);
			$this->load->model('Article_model','',TRUE);
			$this->load->helper('directory');
			
			// ---------- untuk xml dari DPA ----------- //
			$dpa	= directory_map("./xml_wires/DPA/");
			$sum    = 0;
			foreach ($dpa as $filename) {
				$xml 	= simplexml_load_file(base_url()."xml_wires/DPA/".$filename); // baca file nya
				
				// siapkan headline
				$headline_array = $xml->xpath("//hl1");
				//print_r($headline_array);
				foreach ($headline_array as $content) {
					$headline = $content;
				}
				
				// siapkan body_article
				$body 		  = $xml->xpath("//body.content");
				$body_array	  = array();
				foreach ($body[0] as $content) {
					$body_array[] = $content;
				}
				$body_article = implode("\n", $body_array);
				
				// proses memasukan artikel ke dalam database
				$new_article = array(
					'id_source'		=> 6,
					'id_category'	=> 'tes',
					'created_on'	=> date('Y-m-d G:i:s'),
					'headline'		=> (string)$headline,
					'slug'			=> str_replace(" ", "-", $headline),
					'body_article'	=> $body_article,
					'article_flag'	=> 'row_article',
					'locked'		=> 'no'
				);
				
				$this->Article_model->addArticle($new_article);
					
				$sum++;
			}
			
			$message = 'Add '. $sum .' new article from DPA successfull!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_article');
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
	
	function retrieve_nyt() {
		if (($this->session->userdata('user_level') == 'administrator') && $this->session->userdata('login') == TRUE) {
			$this->load->model('Author_model','',TRUE);
			$this->load->model('Article_model','',TRUE);
			$this->load->helper('directory');
			
			// ---------- untuk xml dari NYT ----------- //
			$asianwire  = directory_map("./xml_wires/NYT/");
			foreach ($asianwire as $filename) {
				$xml 	= simplexml_load_file(base_url()."xml_wires/NYT/".$filename); // baca file nya
				
				// siapkan headline
				$headline_array = $xml->xpath("//hl1");
				foreach ($headline_array as $content) {
					$headline = $content;
				}
				
				// siapkan author
				$author_array = $xml->xpath("//byline");
				foreach ($author_array as $content) {
					$author = (string)$content;
				}
				
				// siapkan body_article
				$body 		  = $xml->xpath("//block");
				$body_array	  = array();
				
				foreach ($body as $content) {
					foreach ($content as $paragraph) {
						$body_array[] = $paragraph;
					}
				}
				$body_article = implode("\n", $body_array);
					
				// proses memasukan artikel ke dalam database
				$new_article = array(
					'id_source'		=> 4,
					'id_category'	=> 'tes',
					'created_on'	=> date('Y-m-d G:i:s'),
					'headline'		=> (string)$headline,
					'slug'			=> str_replace(" ", "-", $headline),
					'body_article'	=> $body_article,
					'article_flag'	=> 'row_article',
					'locked'		=> 'no'
				);
				
				$this->Article_model->addArticle($new_article);
					
				$sum++; // counter
			}
			
			$message = 'Add '. $sum .' new article from NYT successfull!'; 
			$this->session->set_flashdata('message_success', $message);
			redirect('admin/manage_article');
		} 
		else {
			?>
			<script>
				alert("You don't have privilege to access this page");
			</script>
			<?php
			$this->session->sess_destroy();	
			redirect('login', 'refresh');
		}
	}
}

/* End of file manage_article.php */
/* Location: ./system/application/controllers/admin/manage_article.php */