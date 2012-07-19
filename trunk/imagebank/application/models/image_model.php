<?php
    class Image_model extends Model
    {
    	public function Image_model(){
    		
			parent::Model;
			$this->table_name = 'images';
    	
		}
		
		
		function updateImage($image_data, $image_id){
			$this->db->where('id_image',$image_id);
			$this->db->update($this->table_name, $image_data);
		}
    }
?>