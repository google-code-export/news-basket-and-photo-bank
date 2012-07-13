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
		function process_pic()
    {   
        //Connect to database
        $this->load->database();

        //Get File Data Info
        $uploads = array($this->upload->data());

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
            $config['quality'] = 75;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 175;
            $config['height'] = 175;
            $config['new_image'] = '/pictures/'.$newimagename;

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
			$title = $value['title'];

            //Add Pic Info To Database
            $this->db->set('image_name', $imagename);
            $this->db->set('thumbnail', $thumbnail);
            $this->db->set('filesize', $filesize);
            $this->db->set('image_width', $width);
            $this->db->set('image_height', $height);
           $this->db->set('timestamp', $timestamp);
			$this->db->set('path', $filepath);
			$this->db->set('type',$filetype);
			$this->db->set('title',$title);
            //Insert Info Into Database
            $this->db->insert('images');

        }
		
		
		
		
    }
}
?>