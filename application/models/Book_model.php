<?php

class Book_model extends CI_Model {
	
	// method untuk menampilkan data buku limit untuk pagination
	public function getBook($limit, $start){
		$this->db->where('books.idkategori=kategori.idkategori');
        $query = $this->db->get('books,kategori', $limit, $start);
        return $query->result_array();
    }

	// method untuk menampilkan data buku
	public function showBook($id = false){
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$query = $this->db->query("SELECT * FROM books,kategori WHERE books.idkategori=kategori.idkategori");
		return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('books', array("idbuku" => $id));
			return $query->row_array();
		}
	}

	// method untuk menampilkan data kategori
	public function showKategori($idkategori = false){
		// membaca semua data kategori dari tabel 'kategori'
		if ($idkategori == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca data kategori berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $idkategori));
			return $query->row_array();
		}
	}

	// method untuk hapus data buku berdasarkan id
	public function delBook($id){
		$this->db->delete('books', array("idbuku" => $id));
	}

	// method untuk hapus data kategori berdasarkan id
	public function delKategori($idkategori){
		$this->db->delete('kategori', array("idkategori" => $idkategori));
	}

	// method untuk mencari data buku berdasarkan key
	public function findBook($key, $limit, $start){

		$this->db->where('books.idkategori=kategori.idkategori');
		$this->db->like('judul', $key);
		$this->db->or_like('pengarang', $key);
		$this->db->or_like('penerbit', $key);
		$this->db->or_like('thnterbit', $key);
		$query = $this->db->get('books,kategori', $limit, $start);
		return $query->result_array();
	}

	// method untuk mencari data kategori berdasarkan key
	public function findKategori($key){

		$query = $this->db->query("SELECT * FROM kategori WHERE kategori LIKE '%$key%'");
		return $query->result_array();
	}

	// method untuk insert data buku ke tabel 'books'
	public function insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename){
		$data = array(
					"judul" => $judul,
					"pengarang" => $pengarang,
					"penerbit" => $penerbit,
					"sinopsis" => $sinopsis,
					"idkategori" => $idkategori,
					"thnterbit" => $thnterbit,
					"imgfile" => $filename
		);
		$query = $this->db->insert('books', $data);
	}

	// method untuk insert data kategori ke tabel 'kategori'
	public function insertKategori($kategori){
		$data = array(
					"kategori" => $kategori
		);
		$query = $this->db->insert('kategori', $data);
	}

	// method untuk update data buku ke tabel 'books'
	public function editBook($idbuku, $judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename){
		$data = array(
					"judul" => $judul,
					"pengarang" => $pengarang,
					"penerbit" => $penerbit,
					"sinopsis" => $sinopsis,
					"idkategori" => $idkategori,
					"thnterbit" => $thnterbit,
					"imgfile" => $filename
		);
		$this->db->where('idbuku', $idbuku);
		$query = $this->db->update('books', $data);
	}

	// method untuk update data kategori ke tabel 'kategori'
	public function editKategori($idkategori, $kategori){
		$data = array(
					"idkategori" => $idkategori,
					"kategori" => $kategori
		);
		$this->db->where('idkategori', $idkategori);
		$query = $this->db->update('kategori', $data);
	}

	// method untuk membaca data kategori buku dari tabel 'kategori'
	public function getKategori($id = false){
		if ($id == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			$query = $this->db->query("SELECT * FROM books,kategori WHERE books.idbuku=$id AND kategori.idkategori=books.idkategori");
			return $query->row()->kategori;
	}
}

	// method untuk menghitung jumlah buku berdasarkan idkategori
	public function countByCat($idkategori){
		$query = $this->db->query("SELECT count(*) as jum FROM books WHERE idkategori = '$idkategori'");
		return $query->row()->jum;
	}

	// method untuk menghitung jumlah buku
	public function countBook(){
		$query = $this->db->query("SELECT count(*) as total FROM books");
		return $query->row()->total;
	}

	// method untuk menghitung jumlah kategori
	public function countKategori(){
		$query = $this->db->query("SELECT count(*) as total FROM kategori");
		return $query->row()->total;
	}

	// method untuk menghitung jumlah buku berdasarkan pencarian
	public function countBookSearch($key){
		$query = $this->db->query("SELECT count(*) as total FROM books WHERE judul LIKE '%$key%' 
		OR pengarang LIKE '%$key%' 
		OR penerbit LIKE '%$key%'
		OR sinopsis LIKE '%$key%'
		OR thnterbit LIKE '%$key%'");
		return $query->row()->total;
	}

	// method untuk menghitung jumlah kategori berdasarkan pencarian
	public function countKategoriSearch($key){
		$query = $this->db->query("SELECT count(*) as totalcat FROM kategori WHERE kategori LIKE '%$key%' ");
		return $query->row()->totalcat;
	}

}
?>