<?php
  class Tag_model extends Model{
  	
	
	function Tag_model(){
		parent::Model();
	}
	
	function addTag($new_tag){
		$this->db->insert('tag',$new_tag);
			}
	
	function addTagImage($new_tag_image){
		$this->db->insert('imagetag', $new_tag_image);
	}
 
  
  function checkTag($id){
  	$this->db->from('tag');
	$this->db->where('id_tag',$id);
	if($this->db->count_all_results()>0){
		return TRUE;
	}else{
		return FALSE;
	}
  }
   function checkImageTag($id_image,$id_tag){
  	$this->db->from('imagetag');
	$this->db->where('id_image',$id_image);
	$this->db->where('id_tag',$id_tag);
	if($this->db->count_all_results()>0){
		return TRUE;
	}else{
		return FALSE;
	}
  }
   function getTagImage($id_image){
   	$this->db->where('id_image',$id_image);
	$this->db->from('imagetag');
	return $this->db->get()->result();
	
   }
  function getId(){
  	$this->db->select('id_images');
	$this->db->from('images');
	$this->db->where('timestamp',time());
	return $this->db->get()->row()->id_images;
  }
  
  function editTag($new_tag){
  	$this->db->update('tag', $new_tag);
  }
  
  function editTagImage($new_tag_image){
  	$this->db->update('imagetag',$new_tag_image);
  }
  }
?>