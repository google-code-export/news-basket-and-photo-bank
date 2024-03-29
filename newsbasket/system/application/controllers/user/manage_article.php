<?php

class Manage_article extends Controller {
	
	//limitasi tabel
	var $limit = 50;
	var $limit_search = 20;
	
	function Manage_article() {
		parent::Controller();	
		$this->load->helper('text');
            $this->tinyMce =
                        '
			<!-- TinyMCE -->
			<script type="text/javascript" src="'. base_url().'library/tinymcpuk-0.3/tiny_mce.js"</script>
			<script type="text/javascript">
                            tinyMCE.init({
				// General options
				mode : "textareas",
				theme : "advanced",
                                plugins : "fullscreen,searchreplace",

                                // Theme options
                                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,cut,copy,paste,|,undo,redo,|,link,unlink,|,search,replace,|,sub,sup,|,fullscreen",
                                theme_advanced_buttons2 : "",
                                theme_advanced_buttons3 : "",
                                theme_advanced_buttons4 : "",
                                theme_advanced_toolbar_location : "top",
                                theme_advanced_toolbar_align : "center",
                                theme_advanced_statusbar_location : "bottom",
                                theme_advanced_resizing : true
                            });
			</script>
			<!-- /TinyMCE -->
			';
	}
	
	function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher') {
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
		$data_article['form_action_adv']	= site_url('user/manage_article/advance_search');
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
		$articles  	= $this->Article_model->getAllArticleDel($this->limit, $offset);
		$num_rows 	= $this->Article_model->countAll();
		$data_article['article_table'] = $articles;
		$data_article['no'] 		   = $offset + 1; // untuk penomoran tabel
		
		$data_article['key'] 		= $this->session->userdata('articlekey');
		$data_article['fromdate'] 	= $this->session->userdata('adv_fromdate');
		$data_article['todate'] 	= $this->session->userdata('adv_todate');
		$data_article['author'] 	= $this->session->userdata('adv_author');
		$data_article['category'] 	= $this->session->userdata('adv_category');
		$data_article['sel_source'] = $this->session->userdata('adv_source');
		$data_article['flag'] 		= $this->session->userdata('adv_flag');
		
		// unlock article yang sudah atau tidak jadi di edit
		$this->Article_model->unlockArticle($this->session->userdata('id_article'));
		
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
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher') {
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
		$data_article['active']   = 'add_article';
						
		// ambil data category
		$this->load->model('Category_model','',TRUE);
		$data_article['categories']			 = $this->Category_model->getAllCategories();
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher') {
			$this->load->view('user/template', $data_article);
		}
	}
	
		function add_article_process() {
		if ((($this->session->userdata('user_level') == 'editor') || ($this->session->userdata('user_level') == 'publisher')) && $this->session->userdata('login') == TRUE) {
			
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
				'created_on'	=> date('Y-m-d G:i:s'),
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
			if ($this->session->userdata('user_level') == 'publisher') {
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
		
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher' && $this->Article_model->checkLockArticle($id_article) == TRUE) {
			//lock article
			$this->Article_model->lockArticle($id_article);
			$this->load->view('user/template', $data_article);
		}else{
		?>
			<script>
			alert('The article is being edited');
			document.location='<?php echo site_url('user/manage_article')?>';
			</script>
			<?php
		}
	}
	
	function edit_article_process() {
		if ((($this->session->userdata('user_level') == 'editor') || ($this->session->userdata('user_level') == 'publisher')) && $this->session->userdata('login') == TRUE) {
		
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
			if ($this->session->userdata('user_level') == 'publisher') {
				$activity_log = array(
					'id_article'	=> $id_article,
					'id_user'   	=> $this->session->userdata('username'), //siapa yang login saat itu
					'flag'  		=> $this->input->post('article-flag'),
					'process_date' 	=> date('Y-m-d G:i:s')
				);
				$this->Article_model->AddUserArticle($activity_log);
			}
			
			// unlock article
			$this->Article_model->unlockArticle($id_article);
			
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
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher') {
			$this->load->model('Article_model','',TRUE);
			$this->Article_model->deleteArticle($id_article);
			$this->session->set_flashdata('message_success', 'Delete article successfull!');

			redirect('user/manage_article');
		}  
	}
	
	function search_article($start = 0) {
		$data_article['page_title']			= 'Search Article | Publisher News Basket';
		$data_article['main_view'] 			= 'user/extra/search_article_view';
		$data_article['form_action_search']	= site_url('user/manage_article/search_article');
		$data_article['form_action_adv']	= site_url('user/manage_article/advance_search');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		$data_article['active']   = 'article';
		
		// Menu untuk advance search
		$this->load->model('Category_model','',TRUE);
		$data_article['categories'] = $this->Category_model->getAllCategories();
		
		$this->load->model('Source_model','',TRUE);
		$data_article['source'] 	= $this->Source_model->getAllSource2();	
		
		$data_article['fromdate'] 	= $this->session->userdata('adv_fromdate');
		$data_article['todate'] 	= $this->session->userdata('adv_todate');
		$data_article['author'] 	= $this->session->userdata('adv_author');
		$data_article['category'] 	= $this->session->userdata('adv_category');
		$data_article['sel_source'] = $this->session->userdata('adv_source');
		$data_article['flag'] 		= $this->session->userdata('adv_flag');
		
		// Kata kunci pencarian
		$key = $this->input->get('key');
		if (empty($key)) { // jika kata kunci pencarian tidak ada
			$key = $this->session->userdata('articlekey'); // ambil dari session
		}	
		else {
			$this->session->set_userdata('articlekey', $key); // set kata kunci pencarian ke dalam session
		}
		$data_article['key'] = $key;
		
		// Limit & Offset
		$uri_segment = 4;
		$offset      = $this->uri->segment($uri_segment);
		
		$this->load->model('Article_model','',TRUE);
		$data_article['result'] = $this->Article_model->searchArticle($this->limit_search, $offset, $key);
		$data_article['count']  = $this->Article_model->countSearch($key);
		
		// Membuat pagination			
		$config['base_url']    = site_url('user/manage_article/search_article');
		$config['total_rows']  = $data_article['count'];
		$config['per_page']    = $this->limit_search;
		$config['num_links']   = 5;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data_article['pagination']    = $this->pagination->create_links();

		$data_article['first_result'] = ($data_article['count'] == 0)? 0 : $start + 1;
		$data_article['last_result']  = min($start + $this->limit_search, $data_article['count']);

		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher') {
			$this->load->view('user/template', $data_article);
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
	
	function advance_search($start = 0) {
		$data_article['page_title']			= 'Search Article | Publisher News Basket';
		$data_article['main_view'] 			= 'user/extra/search_article_view';
		$data_article['form_action_search']	= site_url('user/manage_article/search_article');
		$data_article['form_action_adv']	= site_url('user/manage_article/advance_search');
		
		// Siapa yang login
		$username  = $this->session->userdata('username'); // username dari saat login
		$data_article['username'] = $username;
		$data_article['active']   = 'article';
		
		// Menu untuk advance search
		$this->load->model('Category_model','',TRUE);
		$data_article['categories'] = $this->Category_model->getAllCategories();
		
		$this->load->model('Source_model','',TRUE);
		$data_article['source'] = $this->Source_model->getAllSource2();	
		
		// Kata kunci pencarian
		$key = $this->input->get('key');
		if (empty($key)) { // jika kata kunci pencarian tidak ada
			$key = $this->session->userdata('adv_key'); // ambil dari session
		}
		else {
			$this->session->set_userdata('adv_key', $key); // set kata kunci pencarian ke dalam session
		}
		$data_article['key'] = $key;
		
		//--------- Advance search ----------//
		// from-date
		$get_fromdate = $this->input->get('from-date');
		if(empty($get_fromdate)) {
			$fromdate 	= $this->session->userdata('adv_fromdate'); // ambil dari session
			$data_article['fromdate'] = $fromdate;
		}
		else if ($get_fromdate == "") { // jika kata kunci pencarian tidak ada
			$fromdate = "";
			$data_article['fromdate'] = $fromdate;
			$this->session->set_userdata('adv_fromdate', $fromdate); // set kata kunci pencarian ke dalam session
		}
		else {
			$fromdate = $get_fromdate;
			$data_article['fromdate'] = $fromdate;
			$this->session->set_userdata('adv_fromdate', $fromdate); // set kata kunci pencarian ke dalam session
		}
		
		// to-date
		$get_todate	= $this->input->get('to-date');
		if(empty($get_todate)) {
			$todate 	= $this->session->userdata('adv_todate'); // ambil dari session
			$data_article['todate'] = $todate;
		}
		else if ($get_todate == "") { // jika kata kunci pencarian tidak ada
			$todate = "";
			$data_article['todate'] = $todate;
			$this->session->set_userdata('adv_todate', $todate); // set kata kunci pencarian ke dalam session
		}
		else {
			$todate = $get_todate;
			$data_article['todate'] = $todate;
			$this->session->set_userdata('adv_todate', $todate); // set kata kunci pencarian ke dalam session
		}
		
		($fromdate == $todate)? $date = $fromdate : $date = ""; // jika tanggal yang dipilih sama
		
		// author
		$get_author		= $this->input->get('author');
		if(empty($get_author)) {
			$author 	= $this->session->userdata('adv_author'); // ambil dari session
			$data_article['author'] = $author;
		}
		else if ($get_author == "") { // jika kata kunci pencarian tidak ada
			$author = "";
			$data_article['author'] = $author;
			$this->session->set_userdata('adv_author', $author); // set kata kunci pencarian ke dalam session
		}
		else {
			$author = $get_author;
			$data_article['author'] = $author;
			$this->session->set_userdata('adv_author', $author); // set kata kunci pencarian ke dalam session
		}
		
		// category
 		$get_category 	= $this->input->get('category');
		if(empty($get_category)) {
			$category 	= $this->session->userdata('adv_category'); // ambil dari session
			$data_article['category'] = $category;
		}
		else if ($get_category == "all") { // jika kata kunci pencarian tidak ada
			$category = $get_category;
			$data_article['category'] = $category;
			$this->session->set_userdata('adv_category', $get_category); // set kata kunci pencarian ke dalam session
		}
		else {
			$category = $get_category;
			$data_article['category'] = $category;
			$this->session->set_userdata('adv_category', $category); // set kata kunci pencarian ke dalam session
		}
		
		// source
		$get_source	= $this->input->get('source');
		if(empty($get_source)) {
			$source = $this->session->userdata('adv_source'); // ambil dari session
			$data_article['sel_source'] = $source;
		}
		else if ($get_source == "all") { // jika kata kunci pencarian tidak ada
			$this->session->set_userdata('adv_source', $get_source); // set kata kunci pencarian ke dalam session
			$source = $get_source;
			$data_article['sel_source'] = $source;
		}
		else {
			$source = $get_source;
			$data_article['sel_source'] = $source;
			$this->session->set_userdata('adv_source', $source); // set kata kunci pencarian ke dalam session
		}
		
		$get_flag = $this->input->get('flag');
		if ($get_flag == "all") { // jika all
			$this->session->set_userdata('adv_flag', $get_flag); // set kata kunci pencarian ke dalam session
			$flag = $get_flag;
			$data_article['flag'] = $flag;
		}
		else {
			$flag = $get_flag;
			$data_article['flag'] = $flag;
			$this->session->set_userdata('adv_flag', $flag); // set kata kunci pencarian ke dalam session
		}
		
		// order-by
		$get_order = $this->input->get('order-by');
		if (empty($get_order)) { // jika kata kunci pencarian tidak ada
			$order = $this->session->userdata('adv_order'); // ambil dari session
		}
		else if($get_order == "desc") {
			$order = "desc";
			$this->session->set_userdata('adv_order', $get_order); // set kata kunci pencarian ke dalam session
		}
		else {
			$order = "asc";
			$this->session->set_userdata('adv_order', $get_order); // set kata kunci pencarian ke dalam session
		}
		
		// Limit & Offset
		$uri_segment = 4;
		$offset      = $this->uri->segment($uri_segment);
		
		$this->load->model('Article_model','',TRUE);
		$data_article['result'] = $this->Article_model->advanceSearch($this->limit_search, $offset, $key, $author, $category, $source, $flag, $order, $fromdate, $todate, $date);
		//echo $this->db->last_query();
		$data_article['count']  = $this->Article_model->countAdvanceSearch($key, $author, $category, $source, $flag, $order, $fromdate, $todate, $date);		
		
		// Membuat pagination			
		$config['base_url']    = site_url('user/manage_article/advance_search');
		$config['total_rows']  = $data_article['count'];
		$config['per_page']    = $this->limit_search;
		$config['num_links']   = 4;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		
		$data_article['pagination']   = $this->pagination->create_links();
		$data_article['first_result'] = ($data_article['count'] == 0)? 0 : $start + 1;
		$data_article['last_result']  = min($start + $this->limit_search, $data_article['count']);

		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'publisher') {
			$this->load->view('user/template', $data_article);
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
/* Location: ./system/application/controllers/user/manage_article.php */