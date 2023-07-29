<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends CI_Controller {

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
		$data['title'] = 'Ruangan';
		$data['user'] = $this->_userdata();
		$data['ruangan'] = $this->masterm->get_ruangan(null);
		$data['content'] = 'master/ruangan';

		$kode = $this->masterm->find_kode_master('kd_ruang', 'ruangan');
		$data['kode'] = '0' . str_pad($kode, STR_PAD_LEFT);

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required|is_unique[ruangan.ruang]',
		[
			'required' => 'Masukkan ruangan dengan benar!',
			'is_unique' => 'Ruangan sudah ada!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kd_ruang' => $this->input->post('kode'),
				'ruang' => $this->input->post('ruangan'),
				'no_ruang' => $this->input->post('no_ruangan')
			];
			$result = $this->masterm->insert_ruangan($data);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			redirect('ruangan');
		}
	}

	public function ubah($kd)
	{
		$data['title'] = 'Ruangan';
		$data['user'] = $this->_userdata();
		$data['ruangan'] = $this->masterm->get_ruangan($kd);
		$data['content'] = 'master/ruangan_edit';

		$this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required|is_unique[ruangan.ruang]', [
				'required' => 'Masukkan ruangan dengan benar!',
				'is_unique' => 'Ruangan sudah ada!'
			]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$input = [
				'ruang' => $this->input->post('ruangan')
			];
			$result = $this->masterm->update_ruangan($kd, $input);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('ruangan');
		}
	}

	public function hapus($kd)
	{
		$result = $this->masterm->delete_ruangan($kd);
		
		$this->session->set_flashdata('h', $result);
		$this->session->set_flashdata('t', 'delete');
		redirect('ruangan');
	}

}

/* End of file Ruangan.php */
/* Location: ./application/controllers/Ruangan.php */