o<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kondisi extends CI_Controller {

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
		$data['title'] = 'Kondisi Barang';
		$data['user'] = $this->_userdata();
		$data['kondisi'] = $this->masterm->get_kondisi(null);
		$data['content'] = 'master/kondisi';

		$kode = $this->masterm->find_kode_master('kd_kondisi', 'kondisi');
		$data['kode'] = '0' . str_pad($kode, 0, '0', STR_PAD_LEFT);

		$this->form_validation->set_rules('kondisi', 'Kondisi', 'trim|required|is_unique[kondisi.kondisi]', [
			'required' => 'Isikan kondisi dengan benar!',
			'is_unique' => 'Kondisi sudah ada!'
		]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kd_kondisi' => $this->input->post('kode'),
				'kondisi' => $this->input->post('kondisi')
			];
			$result = $this->masterm->insert_kondisi($data);
			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			redirect('kondisi');
		}
	}

	public function ubah($kd)
	{
		$data['title'] = 'Kondisi Barang';
		$data['user'] = $this->_userdata();
		$data['kondisi'] = $this->masterm->get_kondisi($kd);
		$data['content'] = 'master/kondisi_edit';

		$this->form_validation->set_rules('kondisi', 'Kondisi', 'trim|required|is_unique[kondisi.kondisi]', [
				'required' => 'Masukkan kondisi dengan benar!',
				'is_unique' => 'Kondisi sudah ada!'
			]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$input = [
				'kondisi' => $this->input->post('kondisi')
			];
			$result = $this->masterm->update_kondisi($kd, $input);
			
			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('kondisi');
		}
	}

	public function hapus($kd)
	{
		$result = $this->masterm->delete_kondisi($kd);
		
		$this->session->set_flashdata('h', $result);
		$this->session->set_flashdata('t', 'delete');
		redirect('kondisi');
	}


}

/* End of file Ruangan.php */
/* Location: ./application/controllers/Ruangan.php */