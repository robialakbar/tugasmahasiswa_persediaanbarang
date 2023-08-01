<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('inventory_model', 'invenm');
		$this->load->model('master_model', 'masterm');
		is_login();
		is_admin();
	}

	private function _userdata()
	{
		$this->load->model('user_model', 'userm');
		return $this->userm->get_user('kd_user', $this->session->userdata('id'));
	}

	// public function index()
	// {
	// 	$data['title'] = 'Data Barang';
	// 	$data['user'] = $this->_userdata();
	// 	$data['content'] = 'user/info_barang';
	// 	$data['ruang'] = $this->masterm->get_ruangan(null);

	// 	$this->form_validation->set_rules('ruangan', 'Ruangan', 'trim');
	// 	if ($this->form_validation->run() == FALSE) {
	// 		$data['barang'] = $this->invenm->get_barang()->result_array();
	// 	} else {
	// 		$data['barang'] = $this->invenm->get_barang('ruang_kd', $this->input->post('ruangan'))->result_array();
	// 	}
	// 	$this->load->view('layout', $data);
	// }

	public function ubah_barang()
	{
		$data['title'] = 'Edit Barang';
		$data['user'] = $this->_userdata();
		$data['barang'] = $this->invenm->get_barang('kd_barang',$this->input->get('id'))->row_array();
		$data['content'] = 'inventory/barang_ubah';

		$this->load->model('master_model','masterm');
		$data['kondisi'] = $this->masterm->get_kondisi(null);

		$this->form_validation->set_rules('kondisi', 'Kondisi', 'trim|required', ['required'=>'Pilih kondisi!']);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kondisi_kd'=>$this->input->post('kondisi'),
				'status' => $this->input->post('status', TRUE)
			];
			
			$result = $this->invenm->update_barang($this->input->get('id'), $data);
			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'update');
			redirect('info','refresh');
		}
	}

	public function transaksi_masuk()
	{
		$data['title'] = 'Transaksi Barang Masuk';
		$data['user'] = $this->_userdata();

		$data['ruangan'] = $this->masterm->get_ruangan(null);
		$data['barang'] = $this->masterm->get_nama(null);
		$data['kondisi'] = $this->masterm->get_kondisi(null);
		$data['sumber'] = $this->masterm->get_sumber(null);
		$data['jenis'] = $this->masterm->get_jenis(null);
		$data['tahun'] = $this->masterm->get_tahun(null);

		$data['content'] = 'inventory/transaksi_tambah';

		// var_dump(substr("B00100", -4, 3));die;

		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|is_natural_no_zero|less_than[51]', [
			'required' => 'Isikan Jumlah!',
			'is_natural_no_zero' => 'Isikan dengan angka 1(satu) atau lebih!',
			'less_than' => 'Jumlah yang  diperbolehkan 1-50!'
		]);
		$this->form_validation->set_rules('barang', 'Barang', 'trim|required', ['required' => 'Pilih Barang!']);
		$this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required', ['required' => 'Pilih Ruangan!']);
		$this->form_validation->set_rules('kondisi', 'Kondisi', 'trim|required', ['required' => 'Pilih Kondisi!']);
		$this->form_validation->set_rules('sumber', 'Sumber', 'trim|required', ['required' => 'Pilih Sumber!']);
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required', ['required' => 'Pilih Jenis Barang!']);
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required', ['required' => 'Pilih Tahun Perolehan!']);




		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$jumlah = intval($this->input->post('jumlah'));
			$barang = $this->input->post('barang');
			$kategori = $this->input->post('ruangan');
			$sumber = $this->input->post('sumber');
			$jenis = $this->input->post('jenis');
			$tahun = $this->input->post('tahun');

			$kode = substr($kategori, 0).'.'.substr($jenis, 0).'.'.substr($sumber, 0).'.'.substr($tahun, 0).'.';
			$kodemax = $this->masterm->find_kode_master('kd_barang', 'barang', -1, $kode);

			$data = [];
			$input = [
				'nama_kd' => $barang,
				'ruang_kd' => $kategori,
				'sumber_kd' => $sumber,
				'jenis_kd' => $jenis,
				'tahun_kd' => $tahun,
				'kondisi_kd' => $this->input->post('kondisi'),
				'user_kd' => $this->session->userdata('id'),
				'status' => 'Tersedia'
			];

			for ($i=0; $i < $jumlah; $i++) { 
				$kd_barang = $kode. str_pad($kodemax, 0, '0', STR_PAD_LEFT);
				$input += ['kd_barang'=>$kd_barang];
				array_push($data, $input);
				unset($input['kd_barang']);
				$kodemax++;
				$ada = TRUE;
				while ($ada == TRUE) {
					if($this->invenm->get_barang('kd_barang', $kode.str_pad($kodemax, 3, '0', STR_PAD_LEFT))->row_array()) {
						$kodemax++;
					} else {
						$ada=FALSE;
					}
				}
			} 
			$result = $this->invenm->insert_barang($data, $jumlah);

			$this->session->set_flashdata('h', $result);
			$this->session->set_flashdata('t', 'add');
			if ($result=="success") {
				redirect('info');
			} else {
				redirect('transaksi_masuk');
			}
		}
	}

	public function hapus_barang()
	{
		$id = $this->input->post('id_brg', TRUE);
		if ($id) {
			$cekBarang = $this->invenm->get_barang('kd_barang', $id)->num_rows();
			if ($cekBarang<1) {
				$this->session->set_flashdata('hapusBarang', 'Tidak ada barang dengan kode '.$id.'!');
			} else {
				$kdNama = $this->invenm->get_barang('kd_barang', $id)->row_array()['nama_kd'];
				$result = $this->invenm->delete_barang($id);
				if ($result=='success') {
					$stokNama = intval( $this->masterm->get_nama($kdNama)['stok'])-1;
					$this->masterm->update_nama($kdNama, ['stok'=>$stokNama]);
				}
				$this->session->set_flashdata('h', $result);
				$this->session->set_flashdata('t', 'delete');
			}
		} else {
			$this->session->set_flashdata('hapusBarang', 'Masukkan Id Barang!');
		}
		redirect('info');
	}

	public function cetak_laporan()
	{
		$data['title'] = 'Cetak Laporan Barang';
		$data['user'] = $this->_userdata();
		
		$this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required', ['required'=>'Pilih Ruangan!']);
		if ($this->form_validation->run() == FALSE) {
			$data['ruang'] = $this->masterm->get_ruangan(null);
			// array_push($data['ruang'], ['kd_ruang'=>'all', 'ruang'=>'Semua Data Barang']);
			$data['content'] = 'inventory/form_cetak';
			$this->load->view('layout', $data);
		} else {
			$ruangan = $this->input->post('ruangan');
			$kondisi = $this->masterm->get_kondisi_laporan(null);

			if ($ruangan === "all") {
				$barang = $this->invenm->get_laporan_barang()->result_array();
			} else {
				$kdNama = $this->invenm->get_laporan_barang($ruangan); //nama barang by ruangan dari barang
			}
			$data['kondisi'] = $kondisi->result_array();
			$data['laporan'] = $this->get_laporan($kdNama, $kondisi);
			$data['content'] = 'inventory/view_cetak';
			$data['ruangan'] = $ruangan;
			$this->load->view('layout', $data);
		}
	}

	public function cetak()
	{
		$data['title'] = 'Cetak Laporan Barang';
		$data['user'] = $this->_userdata();

		$kdRuang = $this->input->get('k');
		$kdNama = $this->invenm->get_laporan_barang($kdRuang);
		$kondisi = $this->masterm->get_kondisi_laporan(null);
		$data['keterangan'] = $this->input->post('keterangan');
		$data['kondisi'] = $kondisi->result_array();
		$data['laporan'] = $this->get_laporan($kdNama, $kondisi);
		$data['ruang'] = $this->masterm->get_ruangan($kdRuang)['ruang'];
		$data['content'] = 'inventory/laporan';
		$this->load->view('layout', $data);
	}

	public function get_laporan($kdNama, $kondisi)
	{		
		$laporan = [];
		for ($i=0; $i < $kdNama->num_rows(); $i++) {
			$nama = $this->masterm->get_nama($kdNama->result_array()[$i]['nama_kd']);
			$laporan += [$nama['nama']=>[]];
			$laporan[$nama['nama']] += [
				'kode' => $this->invenm->get_barang('nama_kd', $nama['kd_nama'])->result()[0]->kd_barang,
				'stok' => $nama['stok'],
				'keterangan'	=> '',
			];
			$nama = $nama['nama'];
			for ($j=0; $j < $kondisi->num_rows(); $j++) {
				$kondisibrg = $this->invenm->get_laporan_kondisi($kdNama->result_array()[$i]['nama_kd'], $kondisi->result_array()[$j]['kd_kondisi'])->row_array();
				$laporan[$nama] += [
					$kondisibrg['kondisi'] => $kondisibrg['jumlah']
				];
			}
		}
		return $laporan;
	}

	// public function transaksi_keluar()
	// {
	// 	$data['title'] = 'Transaksi Barang Masuk';
	// 	$data['formname'] = 'Form Transaksi Barang Masuk';
	// 	$data['kembali'] = 'transaksi_masuk';
	// 	$data['user'] = $this->_userdata();

	// 	$this->load->model('master_model','masterm');
	// 	$data['kategori'] = [];
	// 	$data['barang'] = [];
	// 	$data['kondisi'] = [];

	// 	$data['content'] = 'inventory/transaksi_tambah';

	// 	// $this->validasi_transaksi();
	// 	$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|is_natural_no_zero', [
	// 		'required' => 'Isikan Jumlah!',
	// 		'is_natural_no_zero' => 'Isikan dengan angka 1(satu) atau lebih!'
	// 	]);

	// 	if ($this->form_validation->run() == FALSE) {
	// 		$this->load->view('layout', $data);
	// 	} else {
	// 		$data = [
	// 			'kd_transaksi' => $data['kodeTransaksi'],
	// 			'barang_kd' => $this->input->post('barang'),
	// 			'kategori_kd' => $this->input->post('kategori'),
	// 			'jumlah' => $this->input->post('jumlah'),
	// 			'kondisi_id' => $this->input->post('kondisi'),
	// 			'user_kd' => $this->session->userdata('id'),
	// 			'tanggal' => date('Y-m-d', time()),
	// 			'jenis_trans' => 'Barang Masuk'
	// 		];
	// 		// $result = $this->barangm->transaksi_tambah($data);

	// 		$this->session->set_flashdata('h', $result);
	// 		$this->session->set_flashdata('t', 'add');
	// 		redirect('transaksi_masuk');
	// 	}
	// }


	// public function transaksi_masuk()
	// {
	// 	$data['title'] = 'Transaksi Barang Masuk';
	// 	$data['user'] = $this->userm->getuser('kd_user', $this->session->userdata('id'));

	// 	$this->load->model('inventory_model', 'invenm');
	// 	$data['transaksi'] = $this->barangm->transaksi('Barang Masuk');
	// 	$data['content'] = 'inventory/transaksi';
		
	// 	$this->load->view('layout', $data);
	// }

	// public function transaksi_keluar()
	// {
	// 	$data['title'] = 'Transaksi Barang keluar';
	// 	$data['user'] = $this->userm->getuser('kd_user', $this->session->userdata('id'));

	// 	$this->load->model('inventory_model', 'invenm');
	// 	$data['transaksi'] = $this->barangm->transaksi('Barang Keluar');
	// 	$data['content'] = 'inventory/transaksi';
		
	// 	$this->load->view('layout', $data);
	// }

	// private function validasi_transaksi()
	// {
	// 	$this->form_validation->set_rules('barang', 'Barang', 'trim|required', ['required' => 'Pilih Barang!']);
	// 	$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required', ['required' => 'Pilih Kategori!']);
	// 	$this->form_validation->set_rules('kondisi', 'Kondisi', 'trim|required', ['required' => 'Pilih Kondisi!']);
	// }

	// private function kode_transaksi($kode)
	// {
	// 	$max = $this->invenm->kode_max('kd_transaksi', 'transaksi', $kode);
	// 	$nourut = substr($max, -4);
	// 	$nourut++;
	// 	if ($nourut == 0) {
	// 		$nourut = $nourut+1;
	// 	}
	// 	return $nourut;
	// }


	// public function transaksi_keluar_tambah()
	// {
	// 	$data['title'] = 'Transaksi Barang Keluar';
	// 	$data['formname'] = 'Form Transaksi Barang Keluar';
	// 	$data['kembali'] = 'transaksi_keluar';
	// 	$data['user'] = $this->userm->getuser('kd_user', $this->session->userdata('id'));

	// 	$this->load->model('inventory_model', 'invenm');
	// 	$kode = "T-BK-".date('y');
	// 	$nourut = $this->kode_transaksi($kode);

	// 	$data['kodeTransaksi'] = 'T-BK-' . date('ymd'). str_pad($nourut, 4, '0', STR_PAD_LEFT);

	// 	$data['kategori'] = [];
	// 	$data['kondisi'] = [];
	// 	$data['barang'] = $this->barangm->get_barang_notnull_stok();

	// 	$data['content'] = 'inventory/transaksi_tambah';

	// 	$this->validasi_transaksi();

	// 	$jumlah = 0;
	// 	$input_barang = $this->input->post('barang');
	// 	$input_kategori = $this->input->post('kategori');
	// 	if ($input_barang && $input_kategori) {
	// 		$jumlah = $this->barangm->get_stok_kondisi_barang($input_barang, $input_kategori)['jumlah'];
	// 	}

	// 	$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|is_natural_no_zero|less_than_equal_to['.$jumlah.']', [
	// 		'required' => 'Isikan Jumlah!',
	// 		'is_natural_no_zero' => 'Isikan dengan angka 1(satu) atau lebih!',
	// 		'less_than_equal_to' => 'Jumlah tidak boleh lebih dari '.$jumlah
	// 	]);

	// 	if ($this->form_validation->run() == FALSE) {
	// 		$this->load->view('layout', $data);
	// 	} else {

	// 		$data = [
	// 			'kd_transaksi' => $data['kodeTransaksi'],
	// 			'barang_kd' => $this->input->post('barang'),
	// 			'kategori_kd' => $this->input->post('kategori'),
	// 			'jumlah' => $this->input->post('jumlah'),
	// 			'kondisi_id' => $this->input->post('kondisi'),
	// 			'user_kd' => $this->session->userdata('id'),
	// 			'tanggal' => date('Y-m-d', time()),
	// 			'jenis_trans' => 'Barang Keluar'
	// 		];
	// 		$result = $this->barangm->transaksi_tambah($data);

	// 		$this->session->set_flashdata('h', $result);
	// 		$this->session->set_flashdata('t', 'add');
	// 		redirect('transaksi_keluar');
	// 	}
	// }

	// public function cetak_laporan()
	// {
	// 	$data['title'] = 'Laporan Barang';
	// 	$data['user'] = $this->userm->getuser('kd_user', $this->session->userdata('id'));
	// 	$this->load->model('inventory_model', 'invenm');
	// 	$data['kategori'] = $this->invenm->getkategori(null);
	// 	array_push($data['kategori'], ['kd_kategori'=>'all', 'nama'=>'Semua Data Barang']);
	// 	$data['content'] = 'inventory/cetak';

	// 	$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required', [
	// 		'required' => 'Pilih kategori!'
	// 	]);
	// 	if ($this->form_validation->run() == FALSE) {
	// 		$this->load->view('layout', $data);
	// 	} else {
	// 		redirect('laporan/cetak?kategori='.$this->input->post('kategori'));
	// 	}
	// }

	// public function cetak()
	// {
	// 	$kategori = $this->input->get('kategori');
	// 	$data['kd'] = $this->barangm->laporan($kategori);
	// 	$this->load->view('inventory/laporan', $data, FALSE);
	// }

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */