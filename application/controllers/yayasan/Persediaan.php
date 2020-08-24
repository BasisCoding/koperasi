<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Persediaan extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('MasterModel');
		}
	
	// Persediaan
		public function index()
		{
			$this->load->view('partials/head');
			$this->load->view('partials/header');
			$this->load->view('partials/sidebar');
			$this->load->view('yayasan/persediaan');
			$this->load->view('partials/footer');
		}

		public function data_persediaan()
		{
			$html = '';
			$data = $this->MasterModel->data_barang();
			$no = 1;
			foreach ($data as $dp) {
				$html .= '<tr>
							<th class="text-center align-middle">'.$no++.'</th>
							<th class="text-center align-middle">'.$dp->kode_barang.'</th>
							<th class="align-middle">'.$dp->nama_barang.'</th>
							<th class="align-middle text-center">'.$dp->nama_kategori.'</th>
							<td class="align-middle">Rp. '.number_format($dp->harga).'</td>
							<td class="align-middle text-center">'.$dp->stok.'</td>
							<td class="align-middle">'.substr($dp->deskripsi, 0,30).'...</td>
						</tr>';
			}
			echo $html;
		}

		public function riwayat_persediaan()
		{
			$html = '';
			$data = $this->MasterModel->riwayat_persediaan();
			$no = 1;
			foreach ($data as $dp) {
				
				$html .= '<tr>
							<th class="text-center align-middle">'.$no++.'</th>
							<th class="text-center align-middle">'.$dp->kode_barang.'</th>
							<th class="align-middle">'.$dp->nama_barang.'</th>
							<td class="align-middle text-center">'.$dp->stok_lama.'</td>
							<td class="align-middle text-center">'.$dp->tambah_stok.'</td>
							<th class="align-middle">'.$dp->nama_supplier.'</th>
							<td class="align-middle text-center">'.date('d-m-Y H:i:s', strtotime($dp->created_at)).'</td>
							<td class="align-middle text-center">'.$dp->nama_user.'</td>
						</tr>';
			}
			echo $html;
		}

	// End Persediaan
	
	}
	
	/* End of file Persediaan.php */
	/* Location: ./application/controllers/admin/Persediaan.php */
?>