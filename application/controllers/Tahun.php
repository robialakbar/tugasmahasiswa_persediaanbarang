<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun extends CI_Controller {

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
		$data['title'] = 'tahun';
		$data['user'] = $this->_userdata();
		$data['tahun'] = $this->masterm->get_tahun(null);
		$data['content'] = 'master/tahun';

		$kode = $this->masterm->find_kode_master('kd_tahun', 'tahun');
		$data['kode'] = '0' . str_pad($kode, 0, '0', STR_PAD_LEFT);

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|is_unique[tahun.tahun]',
		[
			'required' => 'Masukkan tahun dengan benar!',
			'is_unique' => 'tahun sudah ada!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kd_tahun' => $this->input->post('kode'),
				'tahun' => $this->input->post('tahun')
			];
			$result = $this->masterm->insert_tahun($data);
			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			redirect('tahun');
		}
	}

	public function ubah($kd)
	{
		$data['title'] = 'tahun';
		$data['user'] = $this->_userdata();
		$data['tahun'] = $this->masterm->get_tahun($kd);
		$data['content'] = 'master/tahun_edit';

		$this->form_validation->set_rules('tahun', 'tahun', 'trim|required|is_unique[tahun.tahun]', [
				'required' => 'Masukkan tahun dengan benar!',
				'is_unique' => 'tahun sudah ada!'
			]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$input = [
				'tahun' => $this->input->post('tahun')
				
			];
			$result = $this->masterm->update_tahun($kd, $input);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('tahun');
		}
	}

	public function hapus($kd)
	{
		$result = $this->masterm->delete_tahun($kd);
		
		$this->session->set_flashdata('h', $result);
		$this->session->set_flashdata('t', 'delete');
		redirect('tahun');
	}

}

/* End of file Ruangan.php */
/* Location: ./application/controllers/Ruangan.php */