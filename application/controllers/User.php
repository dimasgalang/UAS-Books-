<?php
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	// method hapus data user berdasarkan username
	public function delete($username){
        if ($_SESSION['role'] !== 'Admin'){
            redirect('dashboard');
            } else {
		$this->user_model->delUser($username);
		// arahkan ke method 'users' di kontroller 'dashboard'
        redirect('dashboard/users');
            }
	}

	// method untuk tambah data user
	public function insert(){
		// baca data dari form insert user
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
        	$role = $_POST['role'];
        
		// panggil method insertUser() di model 'user_model' untuk menjalankan query insert
		$this->user_model->insertUser($username, $password, $fullname, $role);

		// arahkan ke method 'users' di kontroller 'dashboard'
		redirect('dashboard/users');
	}

	// method untuk edit data user berdasarkan id
	public function edit($id){
		$data['user'] = $this->user_model->showUser($id);
		$data['fullname'] = $_SESSION['fullname'];
		
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/edituser', $data);
        $this->load->view('dashboard/footer');
	}

	// method untuk update data user berdasarkan id
	public function update(){
        // baca data dari form insert user
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
	$role = $_POST['role'];

		// panggil method insertUserk() di model 'user_model' untuk menjalankan query insert
		$this->user_model->editUser($id, $username, $password, $fullname,$role);

		// arahkan ke method 'users' di kontroller 'dashboard'
		redirect('dashboard/users');
	}

	// method untuk mencari data user berdasarkan 'key'
	public function findusers(){
		
		// baca key dari form cari data
		$key = $_POST['key'];

		// panggil method findUser() dari model user_model untuk menjalankan query cari data
		$data['user'] = $this->user_model->findUser($key);
        $data['fullname'] = $_SESSION['fullname'];
        $data['countuser'] = $this->user_model->countUserSearch($key);

		// tampilkan hasil pencarian di view 'dashboard/users'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/users', $data);
        $this->load->view('dashboard/footer');
	}

}
?>
