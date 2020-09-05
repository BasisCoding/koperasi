<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Transaksi extends CI_Controller {
	
		public function __construct()
		{
			parent::__construct();
			$this->load->model('MasterModel');
			$this->load->model('TransaksiModel');
		}
	
	// Persediaan
		public function index()
		{
			$this->load->view('partials/head');
			$this->load->view('partials/header');
			$this->load->view('partials/sidebar');
			$this->load->view('yayasan/transaksi');
			$this->load->view('partials/footer');
		}

		public function all_transaksi()
		{
			$this->load->view('partials/head');
			$this->load->view('partials/header');
			$this->load->view('partials/sidebar');
			$this->load->view('admin/all_transaksi');
			$this->load->view('partials/footer');
		}

		public function data_barang()
		{
			$html = '';
			$data = $this->MasterModel->data_barang();
			$no = 1;
			foreach ($data as $dp) {
				if ($dp->stok <= 0) {
					$status = '<span class="fa fa-times"></span>';
				}else{
					$status = '<button class="btn btn-info proses-transaksi" data-id="'.$dp->id.'" data-nama="'.$dp->nama_barang.'" data-stok="'.$dp->stok.'" data-harga="'.$dp->harga.'" data-kode="'.$dp->kode_barang.'"><span class="fa fa-random"></button>';
				}
				$html .= '<tr>
							<th class="text-center align-middle">'.$dp->kode_barang.'</th>
							<th class="align-middle">'.$dp->nama_barang.'</th>
							<td class="align-middle">Rp. '.number_format($dp->harga).'</td>
							<td class="align-middle text-center">'.$dp->stok.'</td>
							<td class="align-middle text-center">'.$status.'</td>
						</tr>';
			}
			echo $html;
		}
		
	}
	
	/* End of file Transaksi.php */
	/* Location: ./application/controllers/admin/Transaksi.php */
?>