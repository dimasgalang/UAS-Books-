<?php
class Book extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	// method hapus data buku berdasarkan id
	public function delete($id){
		if ($_SESSION['role'] !== 'Admin'){
		redirect('dashboard');
		} else {
		$this->book_model->delBook($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
		}
	}

	// method untuk tambah data buku
	public function insert(){

		// target direktori fileupload
		$target_dir = "C:\xampp\htdocs\UAS-Books--master\assets\images";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];

		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);

		// proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);

		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk edit data buku berdasarkan id
	public function edit($id){
		$data['kategori'] = $this->book_model->getKategori();
		$data['book'] = $this->book_model->showBook($id);
		$data['fullname'] = $_SESSION['fullname'];
		
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editbook', $data);
        $this->load->view('dashboard/footer');
	}

	// method untuk view data buku berdasarkan id
	public function view($id){
		$data['kategori'] = $this->book_model->getKategori($id);
		$data['book'] = $this->book_model->showBook($id);
		$data['fullname'] = $_SESSION['fullname'];
		
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/viewbook', $data);
        $this->load->view('dashboard/footer');
	}

	// method untuk update data buku berdasarkan id
	public function update(){

		// target direktori fileupload
		$target_dir = "C:\xampp\htdocs\UAS-Books--master\assets\images";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];

		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);

		// proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);

		// baca data dari form insert buku
		$idbuku = $_POST['idbuku'];
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];
        $strimgcover = $_POST['strimgcover'];
        
        if ($filename == ''){
            $filename = $strimgcover;
            $this->book_model->editBook($idbuku, $judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);
        } else {
		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		    $this->book_model->editBook($idbuku, $judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);
        }

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks(){
		
			// baca key dari form cari data
			if (!isset($_POST['key'])){
				$key = $_SESSION['key'];
			} else {
				$_SESSION['key'] = $_POST['key'];
				$key = $_SESSION['key'];;
			}

			$config['base_url'] = site_url('book/findbooks'); //site url
			$config['total_rows'] = $this->book_model->countBookSearch($key); //total row
			$config['per_page'] = 5;  //show record per halaman
			$config["uri_segment"] = 3;  // uri parameter
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = floor($choice);
	 
			// Membuat Style pagination untuk BootStrap v4
		  	$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
	 
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	 
			//panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
			//$data['book'] = $this->book_model->getBook($config["per_page"], $data['page']);           

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['pagination'] = $this->pagination->create_links();
		$data['book'] = $this->book_model->findBook($key, $config["per_page"], $data['page']);
		$data['fullname'] = $_SESSION['fullname'];
		$data['count'] = $this->book_model->countBookSearch($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/books', $data);
        $this->load->view('dashboard/footer');
	}

}
?>
