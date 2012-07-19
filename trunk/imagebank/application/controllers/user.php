<?php
 
 class User extends Controller {
 	
	function user()
	{
		parent::Controller();
		
		$this->load->helper(array('form','url','file'));
	}
	
	function index()
	{
		$this->load->view('user');
	}
	
	function upload(){
		$this->load->model('uploadModel','',TRUE);

		$data['category']=$this->uploadModel->getAllCategory();
		$this->load->view('uploadform', $data);
		
		
	}
	function picupload(){
		
		//load Model
		$this->load->model('uploadModel');
		$config['upload_path'] = './images/galeri/';
		$config['allowed_types']= 'gif|jpg|png';
		$config['max_size'] ='2048';
		//$config['max_width']  = '1024';
       // $config['max_height']  = '768';
		
		
		$this->load->library('upload');
		
		foreach ($_FILES as $key => $value) {
			if(!empty($key['name'])){
				$this->upload->initialize($config);
				if(!$this->upload->do_upload($key))
				{
					$errors[] =$this->upload->display_errors();
				}
				else{
					$uploads = array($this->upload->data());
					$id_gambar=$this->uploadModel->process_pic($uploads,$this->input->post('title'),$this->input->post('caption'));
					
				}
			}
		}
		
		foreach($_POST['kat'] as $k){
			$data = array('id_images' => $id_gambar, 'id_category'=> $k);
			$this->db->insert('imagescategory', $data);
		}

		$data['succes'] ='Thank you,FIle Uploaded';
		$this->load->view('upload_succes', $data);
		
	}
	
	function editCaption(){
		$this->load->helper('form');
		$now = date('Y-m-d H:i:s');
		
		$image_data = array(
			'title'		=>$this->input->post('title'),
			'caption'	=>$this->input->post('caption'),
			'updated_at' => $now,
			
		);
		
		$this->image_model->update($image_data, $image_id);
		redirect('gallery');
		$this->load->view('edit_image');
		
	}
	
 }   
    
    ?>