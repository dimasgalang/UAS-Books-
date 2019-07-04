<?php
class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	// method hapus data user berdasarkan username
	public function delete($idkategori){
        if ($_SESSION['role'] !== 'Admin'){
            redirect('dashboard');
            } else {
		$this->book_model->delKategori($idkategori);
		// arahkan ke method 'users' di kontroller 'dashboard'
        redirect('dashboard/kategori');
            }
	}

	// method untuk tambah data user
	public function insert(){
		// baca data dari form insert user
		$kategori = $_POST['kategori'];
        
		// panggil method insertUser() di model 'user_model' untuk menjalankan query insert
		$this->book_model->insertKategori($kategori);

		// arahkan ke method 'users' di kontroller 'dashboard'
		redirect('dashboard/kategori');
	}

	// method untuk edit data buku berdasarkan id
	public function edit($idkategori){
		$data['categories'] = $this->book_model->showKategori($idkategori);
		$data['fullname'] = $_SESSION['fullname'];
		
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editkategori', $data);
        $this->load->view('dashboard/footer');
	}

	// method untuk update data buku berdasarkan id
	public function update($idkategori){
        // baca data dari form insert user
        $idkategori = $_POST['idkategori'];
        $kategori = $_POST['kategori'];
        
		// panggil method insertUserk() di model 'user_model' untuk menjalankan query insert
		$this->book_model->editKategori($idkategori, $kategori);

		// arahkan ke method 'userks' di kontroller 'dashboard'
		redirect('dashboard/kategori');
	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findkategori(){
		
		// baca key dari form cari data
		$key = $_POST['key'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['categories'] = $this->book_model->findKategori($key);
		$data['fullname'] = $_SESSION['fullname'];
		$data['countcategories'] = $this->book_model->countKategoriSearch($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/kategori', $data);
        $this->load->view('dashboard/footer');
	}

}
?>