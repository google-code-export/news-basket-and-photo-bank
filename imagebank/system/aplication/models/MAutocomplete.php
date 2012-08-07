<?php
class MAutocomplete extends Model {

	function MAutocomplet() {
		parent::Model();
	}

	function lookup($keyword) {
		$this -> db -> select('*') -> from('imagetag');
		$this -> db -> like('id_tag', $keyword, 'after');
		$query = $this -> db -> get();
		return $query -> result();
	}

}
?>