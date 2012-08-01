<?php
    class UploadModel extends Model {
    	function UploadModel(){
    		parent::Model();
			$this->load->library('image_lib');
			
				function generate_code($length = 10){

                if ($length <= 0)
                {
                    return false;
                }

                $code = "";
                $chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
                srand((double)microtime() * 1000000);
                for ($i = 0; $i < $length; $i++)
                {
                    $code = $code . substr($chars, rand() % strlen($chars), 1);
                }
                return $code;

                }
				
			
    	}
		function process_pic($uploads,$title,$caption,$album)
    {   
        //Connect to database
        $this->load->database();

        //Get File Data Info
        $uploads = array($this->upload->data());
		$row =array();
		$row['title'] = $title;
		$row['caption']= $caption;
		//$this->db->insert('images',$row) ;
        $this->load->library('image_lib');
		
        //Move Files To User Folder
        foreach($uploads as $key[] => $value)
        {

             //Get Random code for new file name
            $randomcode = generate_code(12);

            $newimagename = $randomcode.$value['file_ext'];

            //Create Thumbnail
            $config['image_library'] = 'GD2';
            $config['source_image'] = $value['full_path'];
            $config['create_thumb'] = TRUE;
            $config['thumb_marker'] = '_tn';
            $config['master_dim'] = 'height';
            $config['quality'] = 160;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 160;
            $config['height'] = 75;
            $config['new_image'] = 'images/galeri/thumbs/'.$newimagename;

            //$this->image_lib->clear();
            $this->image_lib->initialize($config);
            //$this->load->library('image_lib', $config);
            $this->image_lib->resize();

            //Move Uploaded Files with NEW Random name
            rename($value['full_path'],'images/galeri/'.$newimagename);

            //Make Some Variables for Database
            $imagename = $newimagename;
            $thumbnail = $randomcode.'_tn'.$value['file_ext'];
            $filesize = $value['file_size'];
            $width = $value['image_width'];
            $height = $value['image_height'];
            $timestamp = time();
			$filepath =$value['file_path'];
			$filetype = $value['image_type'];
			
			 $now = date('Y-m-d H:i:s');
			$row['image_name'] = $imagename;
			$row['thumbnail']= $thumbnail;
			$row['filesize']= $filesize;
			$row['image_width'] = $width;
			$row['image_height']= $height;
			$row['timestamp']= $timestamp;
			$row['path'] =$filepath;
			$row['filetype']= $filetype;
			$row['update_at'] = $now;
            $row['id_album'] = $album;
            //Insert Info Into Database
            $this->db->insert('images',$row);
			
			return $this->db->insert_id();

        }
		
		
		
		
    }
	function getAllCategory() {
		$data = array();
	
		$this->db->select('*');
		$this->db->from('category');

		 return $this->db->get()->result();

	
	}
	function getId(){
  	$this->db->select('id_images');
	$this->db->from('images');
	$this->db->where('timestamp',time());
	return $this->db->get()->row()->id_images;
  }
	
	function getAlbumByIdUser($id_user){
		
		
		$this->db->select('*');
		$this->db->where('id_user',$id_user);
		$this->db->from('album');
		return $this->db->get()->result();
		}
}
?>