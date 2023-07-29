<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		if ($this->session->userdata('id')) {
			redirect('master'); //redirect('profile');
		}
		$this->form_validation->set_rules('username', 'Username', 'trim|required', [
			'required' => 'Isi username!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', [
			'required' => 'Isi password!'
		]);


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('auth/login');
		} else {
			$this->_login();			
		}
	}

	private function _login()
	{
		$user = $this->input->post('username', TRUE);
		$password = $this->input->post('password');
		
		$this->load->model('user_model', 'userm');
		$user = $this->userm->get_user('username', $user);

		if ($user) {
			if ($user['aktif']==1) {
				if ( password_verify($password, $user['password']) ) {
					
					$role = $this->userm->get_role($user['role']);
					$data = [
						'id' => $user['kd_user'],
						'role' => $role
					];

					$this->session->set_userdata($data);
					if ( $this->session->userdata('role') =='Petugas') {
						redirect('dashboard','refresh');
					} else {
						redirect('info','refresh');
					}
				} else {
					//username atau password salah
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  		Username atau Password Salah!</div>');
					redirect('login','refresh');
				}
			} else {
				//user tidak aktif
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                User tidak aktif!</div>');
				redirect('login','refresh');
			}
		} else {
			//user tidak ada
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 User tidak terdaftar!</div>');
			redirect('login','refresh');
		}
	}

	public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('role');

        //$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('login');
    }
}
