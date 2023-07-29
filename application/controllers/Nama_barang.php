<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nama_barang extends CI_Controller {

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
		$data['title'] = 'Nama Barang';
		$data['user'] = $this->_userdata();
		$data['nama'] = $this->masterm->get_nama(null);
		$data['content'] = 'master/nama';
		//jika data kosong kode = 1, jika terlewat kode = kd yg terlewat, jika berurut kode = max+1
		$kode = $this->masterm->find_kode_master('kd_nama', 'nama_barang');
		$data['kode'] = '0' . str_pad($kode, 0, '0', STR_PAD_LEFT);

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('harga_perolehan', 'harga_perolehan', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required',
		[
			'required' => 'Masukkan nama barang dengan benar!',
			'is_unique' => 'Nama barang sudah ada!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kd_nama' => $this->input->post('kode'),
				'nama' => $this->input->post('nama'),
				'harga_perolehan' => $this->input->post('harga_perolehan')
			];
			$result = $this->masterm->insert_nama($data);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			redirect('nama');
		}	
	}

	public function ubah($kd)
	{
		$data['title'] = 'Nama Barang';
		$data['user'] = $this->_userdata();
		$data['nama'] = $this->masterm->get_nama($kd);
		$data['content'] = 'master/nama_edit';

		$this->form_validation->set_rules('harga_perolehan', 'harga_perolehan', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
				'required' => 'Masukkan nama barang dengan benar!',
				'is_unique' => 'Nama barang sudah ada!'
			]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$input = [
				'nama' => $this->input->post('nama'),
				'harga_perolehan' => $this->input->post('harga_perolehan')
			];
			$result = $this->masterm->update_nama($kd, $input);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('nama');
		}
	}

	public function hapus($kd)
	{
		$result = $this->masterm->delete_nama($kd);
		
		$this->session->set_flashdata('h', $result);
		$this->session->set_flashdata('t', 'delete');
		redirect('nama');
	}

}

/* End of file nama_barang.php */
/* Location: ./application/controllers/nama_barang.php */