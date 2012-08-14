<?php
  class Album_model_user extends Model{
	function Album_model_user(){
		parent::Model();
		$this->table_name = 'album';
	}
		  
	  function viewCategories($limit, $offset) {
			$this->db->select('id_album, album_name');
			$this->db->from('album');
			$this->db->order_by('album_name');
			$this->db->limit($limit, $offset);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function countAlbum()
		{
		return $this->db->count_all('album');
		}
		
		function viewParticular($catID) {
		$this->db->select('id_album, album_name, id_user, description');
		$this->db->from('album');
		$this->db->where('id_album', $catID);	
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
		function insertCategory() {
			if (isset($_POST['album_name'])) {
				$id_user = $this->session->userdata('username');
				$insertNew = $this->db->insert('album', array('album_name' => $_POST['album_name'], 'id_user' => $id_user, 'description' => $_POST['description']));
				if ($insertNew) {
					redirect('album_user');
				} else {
					echo("Fail");
				}
			}
		}
		
		function updateCategory($id_album) {
		if (isset($_POST['album_name'])) {
			$this->album_name = $_POST['album_name'];
			$this->description = $_POST['description'];
			$this->db->where('id_album', $id_album);
			$insertNew = $this->db->update('album', array('album_name' => $_POST['album_name'], 'description' => $_POST['description']));
			if ($insertNew) {
				redirect('album_user');
			} else {
				echo("Fail");
			}
		}
	}
	
			function deleteCategory() {
				$deleteRow =  $this->uri->segment(3);
				if (isset($deleteRow)) {
					$this->db->where('id_album', $deleteRow);
					$del = $this->db->delete('album');
					if ($del) {
						$delImages = $this->db->get_where('images',array('id_album'=>$deleteRow));
						if ($delImages->num_rows() > 0) {
							foreach ($delImages->result() as $img) {
								unlink('./images/galeri'.$img->filename);
								unlink('./uploads/galeri'.$img->thumbnail);
							}
						}
						$delImg = $this->db->delete('images' , array('id_album' => $deleteRow));
						redirect('album_user');
					} else {
						echo("Fail");
					}
				}
			}
			
			function showImages($catID, $limit, $offset) {
			$this->db->select('*');
			$this->db->from('images');
			$this->db->limit($limit, $offset);
			$this->db->where('id_album', $catID);
			$this->db->order_by('images.image_name', 'ASC');
			return $this->db->get()->result();
			

		}
		
		
		function countImages()
			{
			return $this->db->count_all('images');
			}
			
		function countImagesByAlbum($id_album)
		{
		$this->db->where ('id_album', $id_album);
		return $this->db->get('images')->num_rows();
		}
			
		function particularImage($id) {
		$this->db->select('id_images, image_name, thumbnail, caption, id_album');
		$this->db->from('images');
		$this->db->where('id_images', $id);	
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function insertImage($catId, $filename, $thumbname) {
		if (isset($_POST['id'])) {
			$this->id_album = $catId;
			$this->caption = $_POST['caption'];
			$this->image_name = $filename;
			$this->thumbnail = $thumbname;
			$insertNew = $this->db->insert('images', $this);
			if ($insertNew) {
				redirect('album_user/images/'.$_POST['id']);
			} else {
				echo("Fail");
			}
		}
	}
	
	function deleteImage() {
		$deleteRow =  $this->uri->segment(3);
		if (isset($deleteRow)) {
			$this->db->where('image_name', $deleteRow);
			$insertNew = $this->db->delete('images');
			if ($insertNew) {
				redirect('album_user');
			} else {
				echo("Fail");
			}
		}
	}
	function imgToDelete($fileid){
		$query = $this->db->get_where('images',array('image_name'=>$fileid));
		$result = $query->result();
		return $result[0]->filename;
	}
	function thumbToDelete($fileid){
		$query = $this->db->get_where('images',array('image_name'=>$fileid));
		$result = $query->result();
		return $result[0]->thumbnail;
	}
	
		function getAllAlbumByUser($id_user, $limit, $offset) {
        $this->db->from('album');
		$this->db->where('album.id_user', $id_user);
        // $this->db->join('album', 'album.id_user = users.id_user');
		$this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
	
	function countAllAlbumByUser($id_user) {
        $this->db->from('album');
		$this->db->where('album.id_user', $id_user);
        // $this->db->join('album', 'album.id_user = users.id_user');
		return $this->db->get()->num_rows();
    }
	

	
  }
?>