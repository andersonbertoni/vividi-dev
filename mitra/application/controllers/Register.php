<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_register');
		$this->load->library('session');
		$this->load->database();
	}

	public function index()
	{
		$this->load->view('register');
	}

	public function send_email($email, $user, $properti, $nama)
	{
		// Konfigurasi email
		$config = [
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'protocol' => 'smtp',
			'smtp_host' => 'mail.vividi.id',
			'smtp_user' => 'info@vividi.id',  // Email gmail
			'smtp_pass' => 'devano2019',  // Password gmail
			'smtp_crypto' => 'ssl',
			'smtp_port' => 465,
			'crlf' => "\r\n",
			'newline' => "\r\n"
		];

		// Load library email dan konfigurasinya
		$this->load->library('email', $config);

		// Email dan nama pengirim
		$this->email->from('info@vividi.id', 'Pendaftaran Member Baru Mitra Properti');

//        $list = array($mitra, $cust);
		// Email penerima
		$this->email->to($email); // Ganti dengan email tujuan

		// Lampiran email, isi dengan url/path file
		//$this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

		// Subject email
		$this->email->subject('Pendaftaran Member Baru Mitra Properti');
		// Isi email
		$data['data'] = $email;
		$data['user'] = $user;
		$data['nama'] = $nama;
		$data['properti'] = $properti;
		$body = $this->load->view('Test/email_register.php', $data, TRUE);
		$this->email->message($body);

		// Tampilkan pesan sukses atau error
		if ($this->email->send()) {
//            redirect(base_url(''));
		} else {
			echo 'Error! email Mitra tidak dapat dikirim.';
		}
	}

	public function send_admin($email, $user, $pass, $nama, $jabatan, $properti)
	{
		// Konfigurasi email
		$config = [
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'protocol' => 'smtp',
			'smtp_host' => 'mail.vividi.id',
			'smtp_user' => 'info@vividi.id',  // Email gmail
			'smtp_pass' => 'devano2019',  // Password gmail
			'smtp_crypto' => 'ssl',
			'smtp_port' => 465,
			'crlf' => "\r\n",
			'newline' => "\r\n"
		];

		// Load library email dan konfigurasinya
		$this->load->library('email', $config);

		// Email dan nama pengirim
		$this->email->from('info@vividi.id', 'Pendaftaran Member Baru Mitra Properti');

		//$list = array($mitra, $cust);
		// Email penerima
		$this->email->to('order@vividi.id'); // Ganti dengan email tujuan

		// Lampiran email, isi dengan url/path file
		//$this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

		// Subject email
		$this->email->subject('Pendaftaran Member Baru Mitra Properti');
		// Isi email
		$data['data'] = $email;
		$data['user'] = $user;
		$data['pass'] = $pass;
		$data['nama'] = $nama;
		$data['jabatan'] = $jabatan;
		$data['properti'] = $properti;
		$body = $this->load->view('Test/email_register_admin.php', $data, TRUE);
		$this->email->message($body);

		// Tampilkan pesan sukses atau error
		if ($this->email->send()) {
//            redirect(base_url(''));
		} else {
			echo 'Error! email Admin tidak dapat dikirim.';
		}
	}

	public function cek_register()
	{
		$this->db->select_max('ID');
		$data = $this->db->get('wpwj_users');
		$id = "";
		foreach ($data->result() as $row) {
			$id = $row->ID + 1;
		}
		$user = $this->input->post('username');
		$pass = random_string('alnum', 16);
		$email = $this->input->post('email');
		$n_depan = $this->input->post('depan');
		$n_belakang = $this->input->post('belakang');
		$jabatan = $this->input->post('role');
		$properti = $this->input->post('properti');
		$status = 0;
		$nama = $n_depan . " " . $n_belakang;
		$telepon = $this->input->post('telp');
		$mitra = "Hotel";
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('telp', 'Telephone', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]|max_length[12]');
		date_default_timezone_set('Asia/Jakarta');
		$time = date("Y-m-d h:i:s");
		if ($this->form_validation->run() == FALSE) {
			redirect('Register');
		} else {
			$cek_email = $this->Model_register->cek_email($email);
			if ($cek_email == true) {
				$this->Model_register->save_mitra($user, $pass, $email, $n_depan, $n_belakang, $telepon, $time, $jabatan, $properti, $status, $mitra, $id);
				$this->send_email($email, $user, $properti, $nama);
				$this->send_admin($email, $user, $pass, $nama, $jabatan, $properti);
				$message = "Pendaftaran anda berhasil. Silahkan tunggu pihak Vividi mengaktifkan akun anda. Cek E-mail anda untuk mendapatkan password jika sudah akun sudah aktif.";
				echo "<script type='text/javascript'>alert('$message');</script>";
				$this->load->view('login');
			} else {
				redirect('Register');
			}
		}
	}

	public function cek_register_dashboard()
	{
		$id = $_SESSION['ID'];
		$user = $this->input->post('username');
		$pass = random_string('alnum', 16);
		$email = $this->input->post('email');
		$n_depan = $this->input->post('depan');
		$n_belakang = $this->input->post('belakang');
		$jabatan = $this->input->post('role');
		$properti = $this->input->post('properti');
		$status = 0;
		$nama = $n_depan . " " . $n_belakang;
		$telepon = $this->input->post('telp');
		$mitra = "Hotel";
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('telp', 'Telephone', 'trim|required|numeric|greater_than[0.99]|regex_match[/^[0-9,]+$/]|max_length[12]');
		date_default_timezone_set('Asia/Jakarta');
		$time = date("Y-m-d h:i:s");
		if ($this->form_validation->run() == FALSE) {
			redirect('Register');
		} else {
			$cek_email = $this->Model_register->cek_email($email);
			if ($cek_email == true) {
				$this->Model_register->save_mitra($user, $pass, $email, $n_depan, $n_belakang, $telepon, $time, $jabatan, $properti, $status, $mitra, $id);
				$this->send_email($email, $user, $properti, $nama);
				$this->send_admin($email, $user, $pass, $nama, $jabatan, $properti);
				$message = "Pendaftaran anda berhasil. Silahkan tunggu pihak Vividi mengaktifkan akun anda. Cek E-mail anda untuk mendapatkan password jika sudah akun sudah aktif.";
				echo "<script type='text/javascript'>alert('$message');</script>";
				redirect('Home/daftar');
			} else {
				redirect('Register');
			}
		}
	}
}
