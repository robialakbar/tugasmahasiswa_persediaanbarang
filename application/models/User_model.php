<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_user($by=null, $param=null)
	{
		if ($by!=null && $param!=null) { 
			$this->db->select('user.*, role.role as namarole');
			$this->db->join('role', 'user.role = role.kd_role');
			return $this->db->get_where('user', [$by=>$param])->row_array(); 
		} else {
			$this->db->select('user.*, role.role as namarole');
			$this->db->join('role', 'user.role = role.kd_role');
			$this->db->where(['kd_user !='=> $this->session->userdata('id'), 'kd_user != '=>'P0000']);
			return $this->db->get('user')->result_array(); 
		}
	}

	public function insert_user($data)
	{
		$this->db->insert('user', $data);
		if ($this->db->affected_rows()) {
			return 'success';
		} else {
			return 'error';
		}
	}

	public function update_user($kd, $data)
	{
		$this->db->where('kd_user', $kd);
		$this->db->update('user', $data);
		if ($this->db->affected_rows()) {
			return 'success';
		} else {
			return 'error';
		}
	}

	public function delete_user($kd)
	{
		$this->db->delete('user', ['kd_user'=>$kd]);
		if ($this->db->affected_rows()) {
			return 'success';
		} else {
			return 'error';
		}
	}

	// public function change_password($newpass, $kd_user)
	// {
	// 	$this->db->where('kd_user', $kd_user);
	// 	return $this->db->update('user', ['password'=>$newpass]);
	// }

	public function change_status($kd, $status)
	{
		if ($status == 'unactive') {
			$aktif = 1;
		} else {
			$aktif = 0;
		}
		$result = $this->update_user($kd, ['aktif'=>$aktif]);
		if ($aktif===1) {
			if ($result=='success') {
				return 'successaktif' ;
			} else {
				return 'erroraktif' ;
			}
		} else {
			if ($result=='success') {
				return 'successunaktif' ;
			} else {
				return 'errorunaktif' ;
			}
		}
	}

	public function get_role($kd_role=null)
	{
		if ($kd_role) {
			return $this->db->get_where('role', ['kd_role'=>$kd_role])->row_array()['role'];
		} else {
			return $this->db->get('role')->result_array();
		}
	}

	public function field_unique($by, $value)
	{
		$this->db->select($by);
		return $this->db->get_where('user', [$by.' != '=>$value])->result_array();
	}

	public function reset_foto($id_user)
	{
		$this->db->set('image', 'default.jpg');
		$this->db->where('kd_user', $id_user);
		$this->db->update('user');
		if($this->db->affected_rows()) {
			return 'success';
		} else {
			return 'error';
		}
	}

	public function reset_password($kd)
	{
		return $this->update_user($kd, ['password'=>password_hash("unula", PASSWORD_DEFAULT)]);
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */