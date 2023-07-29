<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

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
		$data['title'] = 'Jenis';
		$data['user'] = $this->_userdata();
		$data['jenis'] = $this->masterm->get_jenis(null);
		$data['content'] = 'master/jenis';

		$kode = $this->masterm->find_kode_master('kd_jenis', 'jenis');
		$data['kode'] = '0' . str_pad($kode, 0, '0', STR_PAD_LEFT);

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('inisial', 'inisial', 'trim|required');
		$this->form_validation->set_rules('jenis', 'jenis', 'trim|required',
		[
			'required' => 'Masukkan jenis dengan benar!',
			'is_unique' => 'jenis sudah ada!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kd_jenis' => $this->input->post('kode'),
				'jenis' => $this->input->post('jenis'),
				'inisial' => $this->input->post('inisial')
			];
			$result = $this->masterm->insert_jenis($data);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			redirect('jenis');
		}
	}

	public function ubah($kd)
	{
		$data['title'] = 'jenis';
		$data['user'] = $this->_userdata();
		$data['jenis'] = $this->masterm->get_jenis($kd);
		$data['content'] = 'master/jenis_edit';
		$this->form_validation->set_rules('inisial', 'inisial', 'trim|required');
		$this->form_validation->set_rules('jenis', 'jenis', 'trim|required', [
				'required' => 'Masukkan jenis dengan benar!',
				'is_unique' => 'jenis sudah ada!'
			]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$input = [
				'jenis' => $this->input->post('jenis'),
				'inisial' => $this->input->post('inisial')
			];
			$result = $this->masterm->update_jenis($kd, $input);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('jenis');
		}
	}

	public function hapus($kd)
	{
		$result = $this->masterm->delete_jenis($kd);
		
		$this->session->set_flashdata('h', $result);
		$this->session->set_flashdata('t', 'delete');
		redirect('jenis');
	}

}

/* End of file Ruangan.php */
/* Location: ./application/controllers/Ruangan.php */