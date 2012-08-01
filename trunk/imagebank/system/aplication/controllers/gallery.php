<?php
class Gallery extends Controller {
	function Gallery (){
		
		parent::Controller();
		$this->load->model('Gallery_model');
	}
	function index() {
			
		$this->tampil_foto();
		//$id_images = $this->uri->segment(3);
		//$data['id_images'] = $id_images;
		//$this->load->view('gallery', $data);
		}
		
		//$data['images'] = $this->Gallery_model->get_images();
	function tampil_foto()
	{
		$username = $this->session->userdata('username');
		$user_level = $this->session->userdata('user_level');
		$id = $this->uri->segment(3);
		$data['page_title'] =  'Gallery Image Bank';
		$data['images'] = $this->Gallery_model->tampil_foto();
		$data['main_view'] = 'gallery';
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		
	if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator'){
			$this->load->view('template',$data);
			}else {
			$this->load->view('user/template',$data);
		}
		
	}	
	function tampil_wire(){
		
		$username = $this->session->userdata('username');
		$user_level = $this->session->userdata('user_level');
		$id = $this->uri->segment(3);
		$data['page_title'] =  'Gallery Image Bank';
		$data['images'] = $this->Gallery_model->tampil_wire();
		$data['main_view'] = 'gallery';
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		
	if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator'){
			$this->load->view('template',$data);
			}else {
			$this->load->view('user/template',$data);
		}
	}
	function tampil_publisher(){
		
		$username = $this->session->userdata('username');
		$user_level = $this->session->userdata('user_level');
		$id = $this->uri->segment(3);
		$data['page_title'] =  'Gallery Image Bank';
		$data['images'] = $this->Gallery_model->tampil_publisher();
		$data['main_view'] = 'gallery';
		$data['username'] = $username;
		$data['user_level'] = $user_level;
		
	if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator'){
			$this->load->view('template',$data);
			}else {
			$this->load->view('user/template',$data);
		}
	}
	
	
	function detail_foto($id)
	{
		
		$data['images'] = $this->Gallery_model->detail_foto($id);
		$this->load->view('detail_gambar',$data);
		
	}
	
		function updateImage($id=null){
			
			if($_POST==NULL){
				$this->load->model('gallery_model');
				$username = $this->session->userdata('username');
				$user_level = $this->session->userdata('user_level');
				$id = $this->uri->segment(3);
				$data['images'] = $this->gallery_model->selectImage($id);
				$data['main_view']  = 'edit_image';
				$data['page_title'] = 'Edit Image';
				$data['h2_title'] = 'Image > Edit Image';
				$data['username'] = $username;
				$data['user_level'] = $user_level;
				//ambil tag image
				$this->load->model('Tag_model','',TRUE);
				$tag_image = $this->Tag_model->getTagImage($id);
				$tagstr = array();
				foreach ($tag_image as $coloumn ) {
					$tagstr[] = $coloumn->id_tag;
					
				}
				$data['tag'] =implode(", ", $tagstr);
				
			if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator'){
			$this->load->view('template',$data);
			}else {
			$this->load->view('user/template',$data);
		}
				
			}else {
				$this->load->model('gallery_model');
				$this->gallery_model->updateImage($id);
				
				//data tag
			$tag_pieces = explode(", " ,$this->input->post('tag'));
		
			$this->load->model('Tag_model','',TRUE);
			for ($i=0;$i<sizeof($tag_pieces);$i++){
				if($this->Tag_model->checkTag($tag_pieces[$i] )==FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' '){
				$tag = array('id_tag'=>$tag_pieces[$i]);
				$this->Tag_model->addTag($tag);		
					
				}
			 		}
		
			for ($i=0;$i<sizeof($tag_pieces);$i++){
				if($this->Tag_model->checkImageTag($id,$tag_pieces[$i] )==FALSE && !empty($tag_pieces[$i]) && $tag_pieces[$i] != ' '){
			 $tag_Image = array('id_image'=>$id,'id_tag'=>$tag_pieces[$i]);
			$this->Tag_model->addTagImage($tag_Image);	
		//proses simpan ke tabel tag
		}
				
				redirect('gallery');
			}
			

			
		}
	
	function download ($id=null){
		$this->load->model('gallery_model');
		$data['images'] =  $this->gallery_model->download($id);
		$this->load->helper('download');
		foreach ($data['images'] as $row ) {
			$img = file_get_contents(base_url().'/images/galeri/'.$row->image_name);
			$name = $row->image_name;
			force_download($name, $img);
		}
		redirect('gallery');
		
	}
		
		
	}
	
	
	
	}
