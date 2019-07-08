<?php

class User_model extends CI_Model {

	// method untuk membaca data profile user
	public function getUserProfile($username){
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row_array();
	}

	// method untuk menampilkan data user
	public function showUser($id = false){
		// membaca semua data user dari tabel 'users'
		if ($id == false){
			$query = $this->db->get('users');
			return $query->result_array();
		} else {
			// membaca data user berdasarkan username
			$query = $this->db->get_where('users', array("id" => $id));
			return $query->row_array();
		}
	}

	// method untuk hapus data user berdasarkan username
	public function delUser($id){
		$this->db->delete('users', array("id" => $id));
	}

	// method untuk mencari data user berdasarkan key
	public function findUser($key){

		$query = $this->db->query("SELECT * FROM users WHERE username LIKE '%$key%' 
									OR fullname LIKE '%$key%'");
		return $query->result_array();
	}

	// method untuk insert data user ke tabel 'users'
	public function insertUser($username, $password, $fullname, $role){
		$data = array(
					"username" => $username,
					"password" => $password,
					"fullname" => $fullname,
					"role" => $role
		);
		$query = $this->db->insert('users', $data);
	}

	// method untuk update data user ke tabel 'users'
	public function editUser($id, $username, $password, $fullname){
		$data = array(
					"id" => $id,
					"username" => $username,
					"password" => $password,
					"fullname" => $fullname,
		);
		$this->db->where('id', $id);
		$query = $this->db->update('users', $data);
	}

	// method untuk menghitung jumlah user
	public function countUser(){
		$query = $this->db->query("SELECT count(*) as total FROM users");
		return $query->row()->total;
	}

	public function countUserSearch($key){
		$query = $this->db->query("SELECT count(*) as total FROM users WHERE username LIKE '%$key%' 
		OR fullname LIKE '%$key%'");
		return $query->row()->total;
	}
}

?>
