<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'userm');
		$this->load->model('master_model', 'masterm');
		is_login();
		is_admin();
	}

	private function _userdata()
	{
		return $this->userm->get_user('kd_user', $this->session->userdata('id'));
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['content'] = 'admin/index';
		$data['user'] = $this->_userdata();
		$data['barang'] = $this->masterm->count_table('barang');
		$data['nama'] = $this->masterm->count_table('nama_barang');
		$data['kondisi'] = $this->masterm->count_table('kondisi');
		$data['users'] = $this->masterm->count_table('user');


		$this->load->view('layout', $data);
	}

	public function users()
	{
		$data['user'] = $this->_userdata();
		if ($this->input->get('action') != "tambah") {
			$data['title'] = 'Daftar User';
			$data['content'] = 'user/index';
			$data['users'] = $this->userm->get_user();

			$this->form_validation->set_rules('kode', 'Kode User', 'trim|required', [
				'required' => 'Masukkan Kode User!'
			]);
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('layout', $data);
			} else {
				$result = $this->userm->reset_password($this->input->post('kode'));

				$this->session->set_flashdata('reset_password', $result);
				redirect('users');
			}
		} else {
			$data['title'] = 'Tambah User';
			$data['content'] = 'user/tambah';
			$kode = $this->masterm->find_kode_master('kd_user', 'user', null,'U');
			$data['kode'] = 'U' . str_pad($kode, 4, '0', STR_PAD_LEFT);
			$this->tambah_users($data);
		}	
	}

	public function tambah_users($data)
	{
		$data['role'] = $this->masterm->get_role(null);
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]|regex_match[/^[a-z0-9]+([_][a-z0-9]*)*$/]',[
			'required' => 'Masukkan Username!',
			'is_unique' => 'Username sudah digunakan!',
			'regex_match' => 'Gunakan huruf kecil, angka dan \'_\' sebagai pemisah pada username!'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|regex_match[/^[A-Za-z]+([ ][A-Za-z]*)*$/]', [
			'required' => 'Masukkan nama!',
			'regex_match' => 'Gunakan huruf pada nama!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]',[
			'required' => 'Masukkan email!',
			'valid_email' => 'Masukkan email dengan benar!',
			'is_unique' => 'Email sudah digunakan!'
		]);
		$this->form_validation->set_rules('role', 'Role', 'trim|required', [
			'required'=>'Pilih role!'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
			'required'=>'Masukkan alamat!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);	
		} else {
			$data = [
				'kd_user' => $this->input->post('kode'),
				'username' => $this->input->post('username', TRUE),
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email', TRUE),
				'image' => 'default.jpg',
				'role' => $this->input->post('role'),
				'alamat' => $this->input->post('alamat'),
				'password' => password_hash('sky', PASSWORD_DEFAULT),
				'aktif' => 0,
				'tgl_dibuat' => time()
			];

			$result = $this->userm->insert_user($data);
			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			redirect('users');
		}
	}
/////////////////////////DETAIL  USER\\\\\\\\\\\\\\\\\\\
	public function ubah_users($kd)
	{
		$data['title'] = 'Ubah User';
		$data['user'] = $this->_userdata();
		$data['users'] = $this->userm->get_user('kd_user',$kd);
		$data['role'] = $this->masterm->get_role(null);
		$data['content'] = 'user/ubah';

		if ($this->input->post('username')) {
			if($this->userm->field_unique('username', $this->input->post('username'))) {
				$this->form_validation->set_message('username', 'Username sudah digunakan!');
			}
		}

		if ($this->input->post('email')) {
			if($this->userm->field_unique('email', $this->input->post('email'))) {
				$this->form_validation->set_message('email', 'Email sudah digunakan!');
			}
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required|regex_match[/^[a-z0-9]+([_][a-z0-9]*)*$/]',[
			'required' => 'Masukkan Username!',
			'regex_match' => 'Gunakan huruf kecil, angka dan \'_\' sebagai pemisah pada username!'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|regex_match[/^[A-Za-z]+([ ][A-Za-z]*)*$/]', [
			'required' => 'Masukkan nama!',
			'regex_match' => 'Gunakan huruf pada nama!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',[
			'required' => 'Masukkan email!',
			'valid_email' => 'Masukkan email dengan benar!'
		]);
		$this->form_validation->set_rules('role', 'Role', 'trim|required', [
			'required'=>'Pilih role!'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
			'required'=>'Masukkan alamat!'
		]);
		$this->form_validation->set_rules('status', 'Status', 'trim|required', [
			'required'=>'Pilih Status!'
		]);


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$input = [
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email', TRUE),
				'image' => 'default.jpg',
				'role' => $this->input->post('role'),
				'alamat' => $this->input->post('alamat'),
				'password' => password_hash('sky', PASSWORD_DEFAULT),
				'aktif' => $this->input->post('status')
			];
			$result = $this->userm->update_user($kd, $input);
			
			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('users');
		}
	}

	public function hapus_users($id)
	{
		$result = $this->userm->delete_user($id);

		$this->session->set_flashdata('h', $result);
		$this->session->set_flashdata('t', 'delete');
		redirect('users');
	}

	// public function ubah_status()
	// {
	// 	$id = $this->input->get('user', TRUE);
	// 	$status = $this->input->get('status', TRUE);
	// 	$result = $this->userm->change_status($id, $status);

	// 	$this->session->set_flashdata('ubah_status', $result);
	// 	redirect('users');
	// }

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */