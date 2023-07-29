<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

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
		$data['title'] = 'User Role';
		$data['user'] = $this->_userdata();
		$data['role'] = $this->masterm->get_role(null);
		$data['content'] = 'master/role';

		$kode = $this->masterm->find_kode_master('kd_role', 'role');
		$data['kode'] = 'R' . str_pad($kode, 3, '0', STR_PAD_LEFT);

		$this->form_validation->set_rules('role', 'Role', 'trim|required|is_unique[role.role]', [
			'required' => 'Isikan role dengan benar!',
			'is_unique' => 'Role sudah ada!'
		]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kd_role' => $this->input->post('kode'),
				'role' => $this->input->post('role')
			];
			$result = $this->masterm->insert_role($data);
			
			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			redirect('role');
		}
	}

	public function ubah($kd)
	{
		$data['title'] = 'User Role';
		$data['user'] = $this->_userdata();
		$data['role'] = $this->masterm->get_role($kd);
		$data['content'] = 'master/role_edit';

		$this->form_validation->set_rules('role', 'Role', 'trim|required|is_unique[role.role]', [
				'required' => 'Masukkan role dengan benar!',
				'is_unique' => 'Role sudah ada!'
			]);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$input = [
				'role' => $this->input->post('role')
			];
			$result = $this->masterm->update_role($kd, $input);
			
			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('role');
		}
	}

	public function hapus($kd)
	{
		$result = $this->masterm->delete_role($kd);
		
		$this->session->set_flashdata('h', $result);
		$this->session->set_flashdata('t', 'delete');
		redirect('role');
	}

}

/* End of file Role.php */
/* Location: ./application/controllers/Role.php */