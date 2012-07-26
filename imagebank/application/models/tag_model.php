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
  }
?>