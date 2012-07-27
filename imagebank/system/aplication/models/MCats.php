<?php
class MCats extends Model{
	function MCats(){
		parent::Model();
	}
	
	function getCategory($id){
		$data = array();
		$option = array('id'=>$id);
		$Q = $this->db->getwhere('category',$option,1);
		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	function getAllCategories(){
	$data = array();
	$Q = $this->db->get('category');
	if($Q->num_rows>0){
		foreach ($Q -> $result_array() as $row) {
			$data[]= $row;
			
		}
		$Q->free_result();
		return $data;
	}	
	
	
	}
	
	
}

?>