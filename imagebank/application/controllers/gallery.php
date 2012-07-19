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
		
	
	
	
	
	
}
