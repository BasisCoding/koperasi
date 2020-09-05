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
			$this->load->view('admin/transaksi');
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
		public function add_transaksi()
		{
			$id_barang			 	= $this->input->post('id_barang_transaksi');

			$result = array();
			$update = array();

			foreach ($id_barang as $id => $val) {
				$result[] = array(
					'kode_transaksi'=> $this->TransaksiModel->get_no_trx(),
					'kode_barang' 	=> $_POST['kode_barang_transaksi'][$id],
					'harga_barang' 	=> $_POST['harga_transaksi'][$id],
					'total_bayar' 	=> $_POST['jumlah_transaksi'][$id]*$_POST['harga_transaksi'][$id],
					'jumlah' 		=> $_POST['jumlah_transaksi'][$id],
					'created_at' 	=> date('Y-m-d H:i:s'),
					'created_by' 	=> $this->session->userdata('id')
				);

				$update[] = array(
					'id'		=> $_POST['id_barang_transaksi'][$id],
					'stok'		=> $_POST['stok_transaksi'][$id] - $_POST['jumlah_transaksi'][$id]
				);
			}

			$this->db->update_batch('barang', $update, 'id');
			// $this->TransaksiModel->add_transaksi($result);
			$this->db->insert_batch('transaksi', $result);

			$response = array(
				'status' => 'success',
				'message' => 'Transaksi Berhasil',
			);

			echo json_encode($response);
		}

		public function riwayat_transaksi()
		{
			$html = '';
			$start = '';
			$end = '';
			if($this->input->post('dari'))
		  	{
		   		$start = $this->input->post('dari');
		   		$end = $this->input->post('sampai');
		  	}
			$data = $this->TransaksiModel->riwayat_transaksi($start, $end);

			if ($data->num_rows() > 0) {
				$no = 1;
				foreach ($data->result() as $dp) {
					
				$html .= '<tr>
							<th class="text-center align-middle">'.$no++.'</th>
							<th class="text-center align-middle">'.$dp->kode_transaksi.'</th>
							<th class="align-middle">'.$dp->jumlah_barang.'</th>
							<td class="align-middle text-center">'.$dp->total_quantity.'</td>
							<td class="align-middle text-center">Rp. '.number_format($dp->total_harga).'</td>
							<td class="align-middle text-center">'.date('d-m-Y H:i:s', strtotime($dp->created_at)).'</td>
							<td class="align-middle text-center">'.$dp->nama_user.'</td>
							<td class="align-middle text-center">
								<button class="btn btn-info btn-sm mb-1 mb-lg-0 detail-transaksi" 
									data-kode_transaksi="'.$dp->kode_transaksi.'" 
									data-jumlah_barang="'.$dp->jumlah_barang.'" 
									data-total_quantity="'.$dp->total_quantity.'" 
									data-total_harga="'.number_format($dp->total_harga).'" 
									data-created_at="'.date('d-m-Y H:i:s', strtotime($dp->created_at)).'" 
									data-created_by="'.$dp->nama_user.'">

									<span class="fa fa-bars"></span>
								</button>
							</td>
						</tr>';
				}
			}else{
				$html .= '<tr>
							<td colspan="9" class="text-center">Tidak Ada Data</td>
						</tr>';
			}
			echo $html;
		}

		function get_detail_transaksi()
		{
			$kode_transaksi = $this->input->post('kode');
			$html = '';
			$data = $this->TransaksiModel->get_detail_transaksi($kode_transaksi);
			if ($data->num_rows() > 0) {
				foreach ($data->result() as $dp) {
					$html .= '<tr>
								<td class="text-bold">'.$dp->kode_barang.'</td>
								<td rowspan="2" class="align-middle">'.$dp->jumlah.' x Rp. '.number_format($dp->harga_barang).' = <b>Rp. '.number_format($dp->total_bayar).'</b></td>
								<tr class="ml-4">
									<td class="text-bold">'.$dp->nama_barang.'</td>
								</tr>
							</tr>';
				}
			}

			echo $html;
		}
		
		public function all_transaksi()
		{
			$this->load->view('partials/head');
			$this->load->view('partials/header');
			$this->load->view('partials/sidebar');
			$this->load->view('admin/all_transaksi');
			$this->load->view('partials/footer');
		}

		public function riwayat_all_transaksi()
		{
			$html = '';
			$start = '';
			$end = '';
			if($this->input->post('dari'))
		  	{
		   		$start = $this->input->post('dari');
		   		$end = $this->input->post('sampai');
		  	}
			$data = $this->TransaksiModel->riwayat_all_transaksi($start, $end);

			if ($data->num_rows() > 0) {
				$no = 1;
				foreach ($data->result() as $dp) {
					
					$html .= '<tr>
								<th class="text-center align-middle">'.$no++.'</th>
								<th class="text-center align-middle">'.$dp->kode_transaksi.'</th>
								<th class="text-center align-middle">'.$dp->kode_barang.'</th>
								<th class="align-middle">'.$dp->nama_barang.'</th>
								<td class="align-middle text-center">'.$dp->jumlah.'</td>
								<td class="align-middle text-center">Rp. '.number_format($dp->harga_barang).'</td>
								<td class="align-middle text-center">Rp. '.number_format($dp->total_bayar).'</td>
								<td class="align-middle text-center">'.date('d-m-Y H:i:s', strtotime($dp->created_at)).'</td>
								<td class="align-middle text-center">'.$dp->nama_user.'</td>
							</tr>';
				}
			}else{
				$html .= '<tr>
							<td colspan="9" class="text-center">Tidak Ada Data</td>
						</tr>';
			}
			echo $html;
		}
	
	}
	
	/* End of file Transaksi.php */
	/* Location: ./application/controllers/admin/Transaksi.php */
?>