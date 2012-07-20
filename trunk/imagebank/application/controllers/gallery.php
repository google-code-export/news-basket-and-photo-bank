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
		
		$id = $this->uri->segment(3);
		$data['images'] = $this->Gallery_model->tampil_foto();
		$this->load->view('index_gambar',$data);
	}	
	
	function detail_foto($id)
	{
		
		$data['images'] = $this->Gallery_model->detail_foto($id);
		$this->load->view('detail_gambar',$data);
		
	}
	
		function updateImage($id=null){
			
			if($_POST==NULL){
				$this->load->model('gallery_model');
				$data['images'] = $this->gallery_model->selectImage($id);
				$this->load->view('edit_image',$data);
				
			}else {
				$this->load->model('gallery_model');
				$this->gallery_model->updateImage($id);
				redirect('gallery');
			}
			
			
			
		}
	
	function download ($id){
		
		
		
	}
	
	
	
}
