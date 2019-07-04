<?php

class Kategori_model extends CI_Model {

	// method untuk membaca data profile user
	public function showKategori($id = false){
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
		}
	}

	// method untuk hapus data user berdasarkan username
	public function delKategori($idkategori){
		$this->db->delete('kategori', array("idkategori" => $idkategori));
	}

	// method untuk mencari data user berdasarkan key
	public function findKategori($key){

		$query = $this->db->query("SELECT * FROM kategori WHERE kategori LIKE '%$key%'");
		return $query->result_array();
	}

	// method untuk insert data user ke tabel 'users'
	public function insertKategori($kategori){
		$data = array(
					"kategori" => $kategori
		);
		$query = $this->db->insert('kategori', $data);
	}

	// method untuk update data user ke tabel 'users'
	public function editKategori($idkategori, $kategori){
		$data = array(
					"idkategori" => $idkategori,
					"kategori" => $kategori
		);
		$this->db->where('idkategori', $idkategori);
		$query = $this->db->update('kategori', $data);
	}

	// method untuk menghitung jumlah user
	public function countKategori(){
		$query = $this->db->query("SELECT count(*) as total FROM kategori");
		return $query->row()->total;
	}
}

?>