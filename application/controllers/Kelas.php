<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

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
		$data['title'] = 'Kelas';
		$data['user'] = $this->_userdata();
		$data['kelas'] = $this->masterm->get_kelas(null);
		$data['content'] = 'master/kelas';

		$kode = $this->masterm->find_kode_master('kd_kelas', 'kelas');
		$data['kode'] = '0'. str_pad($kode,0,'0', STR_PAD_LEFT).str_pad(2,'0', STR_PAD_LEFT);

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
		$this->form_validation->set_rules('kelas', 'kelas', 'trim|required|is_unique[kelas.kelas]',
		[
			'required' => 'Masukkan kelas dengan benar!',
			'is_unique' => 'kelas sudah ada!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kd_kelas' => $this->input->post('kode'),
				'kelas' => $this->input->post('kelas')
			];
			$result = $this->masterm->insert_kelas($data);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			redirect('kelas');
		}
	}

	public function ubah($kd)
	{
		$data['title'] = 'kelas';
		$data['user'] = $this->_userdata();
		$data['kelas'] = $this->masterm->get_kelas($kd);
		$data['content'] = 'master/kelas_edit';

		$this->form_validation->set_rules('kelas', 'kelas', 'trim|required|is_unique[kelas.kelas]', [
				'required' => 'Masukkan kelas dengan benar!',
				'is_unique' => 'kelas sudah ada!'
			]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$input = [
				'kelas' => $this->input->post('kelas')
			];
			$result = $this->masterm->update_kelas($kd, $input);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('kelas');
		}
	}

	public function hapus($kd)
	{
		$result = $this->masterm->delete_kelas($kd);
		
		$this->session->set_flashdata('h', $result);
		$this->session->set_flashdata('t', 'delete');
		redirect('kelas');
	}

}

/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */