<?php
class UserModel extends Model {

	//table name
	private $users = 'users';

	function User() {
		parent::Model();

	}

	function list_all() {
		$this -> db -> order_by('id_user', 'asc');
		return $this -> db -> get('users');
	}

	//get number of user in database
	function count_all() {
		return $this -> db -> count_all($this -> users);
	}

	//get users with paging
	function get_paged_list($limit = 10, $offset = 0) {
		$this -> db -> order_by('id_user', 'asc');
		return $this -> db -> get($this -> users, $limit, $offset);

	}

	//get user by id
	function get_by_id($id) {
		$this -> db -> where('id_user', $id);
		return $this -> db -> get($this -> users);

	}

	//add new user
	function save($users) {
		$this -> db -> insert($this -> users, $users);
		return $this -> db -> insert_id();
	}

	//update user by id
	function update($id, $users) {
		$this -> db -> where('id_user', $id);
		$this -> db -> update($this -> users, $users);
	}

	//delete users by id
	function delete($id) {
		$this -> db -> where('id_user', $id);
		$this -> db -> delete($this -> users);
	}

}
?>