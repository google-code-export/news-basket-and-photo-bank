<?php
class Gallery_model extends Model {
	
	function Gallery_model() {
		parent::Model();
	}
	
	function tampil_foto(){
		$this->db->select('*');
		$this->db->from('images');
		return $this->db->get()->result();		
	}
	
	function detail_foto($id){
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where('id_images', $id);
		return $this->db->get()->result();
	}
	
	function updateImage( $id){
			$now = date('Y-m-d H:i:s');
			$title = $this->input->post('title');
			$caption = $this->input->post('caption');
			$update_at = $now;
			$data = array(
				'title' => $title,
				'caption' => $caption,
				'update_at' => $update_at
				);	
			$this->db->where('id_images',$id);
			$this->db->update('images',$data);
		}
		
	function selectImage($id){
		return $this->db->get_where('images',array('id_images'=>$id))->row();
		
	}
}



