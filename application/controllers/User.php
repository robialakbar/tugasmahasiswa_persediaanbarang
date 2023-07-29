<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'userm');
		is_login();
	}

	private function _userdata()
	{
		return $this->userm->get_user('kd_user', $this->session->userdata('id'));
	}

	public function index()
	{	
		$data['title'] = 'Profile';
		$data['content'] = 'profile/index';
		$data['user'] = $this->_userdata();
		if ($this->uri->segment(2)=='ubah' || $this->uri->segment(2)==null) {
			
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

			$this->form_validation->set_rules('username', 'Username', 'trim|required|regex_match[/^[a-z0-9]+([_][a-z0-9]*)*$/]', [
				'required' => 'Masukkan Username!',
				'regex_match' => 'Gunakan huruf kecil, angka dan \'_\' sebagai pemisah pada username!'
			]);
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required|regex_match[/^[A-Za-z]+([ ][A-Za-z]*)*$/]', [
				'required' => 'Masukkan Nama!',
				'regex_match' => 'Gunakan huruf pada nama!'
			]);
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',[
				'required' => 'Masukkan Email!',
				'valid_email' => 'Isikan Email dengan benar!'
			]);
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', ['required'=>'Masukkan Alamat!']);

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('layout', $data);
			} else {
				$input = [
					'username' => $this->input->post('username', TRUE),
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email', TRUE),
					'alamat' => $this->input->post('alamat')
				];

				// var_dump($_FILES['picture']);die;

				$picture = $_FILES['picture']['name'];
				if($picture) {
					$config['upload_path'] = './assets/img/user/';
					$config['allowed_types'] = 'jpeg|jpg|png';
					$config['max_size']  = 5120;
					
					$this->load->library('upload', $config);

					if ($this->upload->do_upload('picture')){
						
						// if ($data['user']['image'] != 'default.jpg') {
						//  	// unlink(FCPATH . 'assets/img/user/' . $data['user']['image']);
						// }

						$foto = $this->upload->data('file_name');
						$new_profile = $data['user']['username'].$this->upload->data('file_ext');
						rename(FCPATH.'assets/img/user/'.$foto, FCPATH.'assets/img/user/'.$new_profile);
					}else{				
						$new_profile = $data['user']['image'];
						$this->session->set_flashdata('error', $this->upload->display_errors());
					}
				} else {
					$new_profile = $data['user']['image'];
				}

				$input+=['image' => $new_profile];
				

				$result = $this->userm->update_user($this->session->userdata('id'), $input);
				var_dump($result);die;
				$this->session->set_flashdata('h', $result);
				$this->session->set_flashdata('t', 'update');
				redirect('profile','refresh');
			}
		} elseif ($this->uri->segment(2)=='password') {
			$this->ubah_password($data);
		}
	}

	public function reset_foto($kd=null)
	{
		$kode = $this->session->userdata('id');
		if ($kd) {
			$kode = $kd;
		}
		$result = $this->userm->reset_foto($kode);
		if ($result=="success") {
			$data['user'] = $this->userm->get_user('kd_user', $kode);
			if ($data['user']['image'] != "default.jpg") {
				unlink(FCPATH . 'assets/img/user/' . $data['user']['image']);
			}
		}
		$this->session->set_flashdata('reset', $result);
		if (!$kd) {
			redirect('profile','refresh');
		} else {
			redirect('users/ubah/'.$kd,'refresh');
		}
	}

	public function ubah_password($data)
	{
		$data['password_form'] = true;
		$this->form_validation->set_rules('curpass', 'Password', 'trim|required', [
			'required' => 'Isikan password!'
		]);
		$this->form_validation->set_rules('newpass', 'Password Baru', 'trim|required|min_length[5]', [
			'required' => 'Isikan password baru!',
			'min_length' => 'Password harus berisi lebih dari 5 karakter!'
		]);
		$this->form_validation->set_rules('confpass', 'Password Konfirmasi', 'trim|required|matches[newpass]', [
			'required' => 'Isikan password konfirmasi!',
			'matches' => 'Masukkan kembali password yang sama!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$this->input->post('curpass');
			$this->input->post('newpass');

			$user = $this->_userdata();

			if ($this->input->post('curpass') != $this->input->post('newpass')) {
				if (password_verify($this->input->post('curpass'), $user['password'])) {
					$data = [
						'password' => password_hash($this->input->post('newpass', TRUE), PASSWORD_DEFAULT)
					];
					$result = $this->userm->update_user($this->session->userdata('id'), $data);

					if ($result) {
						$this->session->set_flashdata('passProfile', 'sp');
					} else {
						//jika gagal mengubah password
						$this->session->set_flashdata('passProfile', 'fp3');
					}

					redirect('profile','refresh');
				} else {
					//jika password salah, kode = fp2(failur pass 2)
					$this->session->set_flashdata('passProfile', 'fp2'); 
					
					redirect('profile','refresh');
				}
			} else {
				//jika password sama, kode = fp1(failur pass 1)
				$this->session->set_flashdata('passProfile', 'fp1');
				
				redirect('profile','refresh');
			}

		}
	}

	public function lihat_barang()
	{
		$data['title'] = 'Data Barang';
		$data['user'] = $this->_userdata();
		$data['content'] = 'user/info_barang';
		$this->load->model('master_model', 'masterm');
		$this->load->model('inventory_model', 'invenm');
		$data['ruang'] = $this->masterm->get_ruangan(null);

		$this->form_validation->set_rules('ruangan', 'Ruangan', 'trim');
		if ($this->form_validation->run() == FALSE) {
			$data['barang'] = $this->invenm->get_barang()->result_array();
		} else {
			$data['barang'] = $this->invenm->get_barang('ruang_kd', $this->input->post('ruangan'))->result_array();
		}
		$this->load->view('layout', $data);
	}

	public function detail_barang()
	{
		$data['title'] = 'Detail Barang';
		$data['user'] = $this->_userdata();
		$data['content'] = 'user/detail_barang';
		$this->load->model('inventory_model', 'invenm');
		$data['barang'] = $this->invenm->get_barang('kd_barang', $this->input->get('id'))->row_array();		

		$this->load->view('layout', $data);

	}



}

/* End of file User.php */
/* Location: ./application/controllers/User.php */