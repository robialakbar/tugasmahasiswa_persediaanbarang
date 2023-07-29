<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sumber extends CI_Controller {

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
		$data['title'] = 'Sumber';
		$data['user'] = $this->_userdata();
		$data['sumber'] = $this->masterm->get_sumber(null);
		$data['content'] = 'master/sumber';

		$kode = $this->masterm->find_kode_master('kd_sumber', 'sumber');
		$data['kode'] = '0' . str_pad($kode, 0, '0', STR_PAD_LEFT);

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('sumber', 'Sumber', 'trim|required|is_unique[ruangan.ruang]',
		[
			'required' => 'Masukkan Sumber dengan benar!',
			'is_unique' => 'Sumber sudah ada!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kd_sumber' => $this->input->post('kode'),
				'sumber' => $this->input->post('sumber')
			];
			$result = $this->masterm->insert_sumber($data);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			redirect('sumber');
		}
	}

	public function ubah($kd)
	{
		$data['title'] = 'Sumber';
		$data['user'] = $this->_userdata();
		$data['sumber'] = $this->masterm->get_sumber($kd);
		$data['content'] = 'master/sumber_edit';

		$this->form_validation->set_rules('sumber', 'Sumber', 'trim|required|is_unique[sumber.sumber]', [
				'required' => 'Masukkan sumber dengan benar!',
				'is_unique' => 'sumber sudah ada!'
			]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$input = [
				'sumber' => $this->input->post('sumber')
			];
			$result = $this->masterm->update_sumber($kd, $input);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('sumber');
		}
	}

	public function hapus($kd)
	{
		$result = $this->masterm->delete_sumber($kd);
		
		$this->session->set_flashdata('h', $result);
		$this->session->set_flashdata('t', 'delete');
		redirect('sumber');
	}

}

/* End of file Ruangan.php */
/* Location: ./application/controllers/Ruangan.php */