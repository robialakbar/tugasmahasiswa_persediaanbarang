<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_barang($by=null, $param=null)
	{
		if ($by!=null && $param!=null) { 
			$this->db->select('barang.*, nama_barang.nama, nama_barang.harga_perolehan, kondisi.kondisi, ruangan.ruang, sumber.sumber, jenis.jenis, tahun.tahun , user.username');
			$this->db->join('nama_barang', 'barang.nama_kd = nama_barang.kd_nama');
			$this->db->join('kondisi', 'barang.kondisi_kd = kondisi.kd_kondisi');
			$this->db->join('ruangan', 'barang.ruang_kd = ruangan.no_ruang');
			$this->db->join('sumber', 'barang.sumber_kd = sumber.sumber');
			$this->db->join('jenis', 'barang.jenis_kd = jenis.inisial');
			$this->db->join('tahun', 'barang.tahun_kd = tahun.tahun');
			$this->db->join('user', 'barang.user_kd = user.kd_user');
			return $this->db->get_where('barang', [$by => $param]);
		} else {
			$this->db->select('barang.*, nama_barang.nama, nama_barang.harga_perolehan, kondisi.kondisi, ruangan.ruang, sumber.sumber, jenis.jenis, tahun.tahun ,user.username');
			$this->db->join('nama_barang', 'barang.nama_kd = nama_barang.kd_nama');
			$this->db->join('kondisi', 'barang.kondisi_kd = kondisi.kd_kondisi');
			$this->db->join('ruangan', 'barang.ruang_kd = ruangan.no_ruang');
			$this->db->join('sumber', 'barang.sumber_kd = sumber.sumber');
			$this->db->join('jenis', 'barang.jenis_kd = jenis.inisial');
			$this->db->join('tahun', 'barang.tahun_kd = tahun.tahun');
			$this->db->join('user', 'barang.user_kd = user.kd_user');
			return $this->db->get('barang');
		}
	}

	public function insert_barang($data, $jumlah)
	{			
		$this->db->select('stok');
		$stok = $this->db->get_where('nama_barang', ['kd_nama'=>$data[0]['nama_kd']])->row_array()['stok'];
		$stok += $jumlah;

		$this->db->where('kd_nama', $data[0]['nama_kd']);
		$this->db->update('nama_barang', ['stok'=>$stok]);
		if ($this->db->affected_rows()) {
			$this->db->insert_batch('barang', $data);
			// var_dump($this->db->affected_rows());die;
			if ($this->db->affected_rows()) {
				return 'success';
			} else {
				$stok-=$jumlah;
				$this->db->update('nama_barang', ['stok'=>$stok]);
				return 'error';
			}

		} else {
			return 'error';
		}
	}

	public function update_barang($id, $data)
	{
		$this->db->where('kd_barang', $id);
		$this->db->update('barang', $data);
		if ($this->db->affected_rows()) {
			return 'success';
		} else {
			return 'error';
		}
	}

	public function delete_barang($id)
	{
		$this->db->delete('barang', ['kd_barang'=>$id]);
		if ($this->db->affected_rows()) {
			return 'success';
		} else {
			return 'error';
		}
	}

	public function get_laporan_barang($ruangKd="")
	{
		if($ruangKd){
			return $this->db->query('SELECT DISTINCT(`nama_kd`)
									FROM `barang`
									JOIN `nama_barang`
									ON `barang`.`nama_kd` = `nama_barang`.`kd_nama`
									WHERE `ruang_kd` = "'.$ruangKd.'"');
		} else {

		}
	}

	public function get_laporan_kondisi($kdnama, $kdkond)
	{
		return $this->db->query('SELECT COUNT(`kondisi_kd`) as `jumlah`, `kondisi`
								FROM `barang` 
								JOIN `kondisi`
								ON `barang`.`kondisi_kd` = `kondisi`.`kd_kondisi`
								WHERE `nama_kd`="'.$kdnama.'"
								AND `kondisi_kd` = "'.$kdkond.'"' );
	}
}

/* End of file Barang_model.php */
/* Location: ./application/models/Barang_model.php */