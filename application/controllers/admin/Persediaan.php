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
			$this->load->view('admin/persediaan');
			$this->load->view('partials/footer');
		}

		public function data_persediaan()
		{
			$html = '';
			$status = '';
			$data = $this->MasterModel->data_barang();
			$no = 1;
			foreach ($data as $dp) {
				if ($dp->stok > 300) {
					$status = '<span class="badge badge-success">Sangat Banyak</span>';
				}else if ($dp->stok <= 300 && $dp->stok >= 100) {
					$status = '<span class="badge badge-info">Banyak</span>';
				}else if ($dp->stok > 0 && $dp->stok < 100) {
					$status = '<span class="badge badge-warning">Sedikit</span>';
				}else {
					$status = '<span class="badge badge-danger">Habis</span>';
				}
				$html .= '<tr>
							<th class="text-center align-middle">'.$no++.'</th>
							<th class="text-center align-middle">'.$dp->kode_barang.'</th>
							<th class="align-middle">'.$dp->nama_barang.'</th>
							<td class="align-middle text-center">'.$dp->stok.'</td>
							<td class="align-middle text-center">'.$status.'</td>
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

		public function add_persediaan()
		{
			$id = $this->input->post('kode_barang_persediaan');
			$stok_awal = $this->input->post('stok_persediaan');
			$tambah_stok = $this->input->post('tambah_stok_persediaan');

			$data['stok'] = $stok_awal + $tambah_stok;

			$riwayat['id_barang'] = $id;
			$riwayat['id_supplier'] = $this->input->post('supplier_barang_persediaan');
			$riwayat['stok_lama'] = $stok_awal;
			$riwayat['tambah_stok'] = $tambah_stok;
			$riwayat['created_at'] = date('Y-m-d H:i:s');
			$riwayat['created_by'] = $this->session->userdata('id');

			$this->MasterModel->update_barang($id, $data);
			$this->MasterModel->add_riwayat_persediaan($riwayat);

			$response = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diubah',
			);

			echo json_encode($response);
		}
	// End Persediaan
	
	}
	
	/* End of file Persediaan.php */
	/* Location: ./application/controllers/admin/Persediaan.php */
?>