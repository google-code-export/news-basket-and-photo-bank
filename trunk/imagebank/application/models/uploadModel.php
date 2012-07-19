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
		function process_pic($uploads,$title,$caption)
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
            $config['master_dim'] = 'width';
            $config['quality'] = 100;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;
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
            
            //Insert Info Into Database
            $this->db->insert('images',$row);
			
			

        }
		
		
		
		
    }
}
?>