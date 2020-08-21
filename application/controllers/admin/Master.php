<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Master extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('MasterModel');
		}
	// Master Barang
		public function barang()
		{
			$this->load->view('partials/head');
			$this->load->view('partials/header');
			$this->load->view('partials/sidebar');
			$this->load->view('admin/data_barang');
			$this->load->view('partials/footer');
		}

		public function data_barang()
		{
			$html = '';
			$data = $this->MasterModel->data_barang();
			$no = 1;
			foreach ($data as $dp) {
				$html .= '<tr>
							<th class="align-middle">
								<button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
			                      <span class="fa fa-align-justify"></span>
				                    <ul class="dropdown-menu">
				                      <li class="dropdown-item">
				                      	<a class="update-barang" data-id="'.$dp->id.'" data-nama="'.$dp->nama_barang.'" data-kode="'.$dp->kode_barang.'" data-deskripsi="'.$dp->deskripsi.'" data-kategori="'.$dp->kategori.'" data-harga="'.$dp->harga.'">Update</a>
				                      </li>
				                      <li class="dropdown-item">
				                      	<a class="delete-barang" data-id="'.$dp->id.'" data-nama="'.$dp->nama_barang.'" data-kode="'.$dp->kode_barang.'" data-deskripsi="'.$dp->deskripsi.'" data-kategori="'.$dp->kategori.'" data-harga="'.$dp->harga.'">Delete</a>
				                      </li>
				                      <li class="dropdown-item"><a href="#">View</a></li>
				                    </ul>
			                    </button>
							</th>
							<th class="text-center align-middle">'.$dp->kode_barang.'</th>
							<th class="align-middle">'.$dp->nama_barang.'</th>
							<th class="align-middle text-center">'.$dp->nama_kategori.'</th>
							<td class="align-middle">Rp. '.number_format($dp->harga).'</td>
							<td class="align-middle text-center">'.$dp->stok.'</td>
							<td class="align-middle">'.substr($dp->deskripsi, 0,10).'...</td>
						</tr>';
			}
			echo $html;
		}

		public function add_barang()
		{	
			$data['kode_barang'] = $this->input->post('kode_barang');
			$data['nama_barang'] = $this->input->post('nama_barang');
			$data['kategori'] = $this->input->post('kategori');
			$data['harga'] = $this->input->post('harga');
			$data['stok'] = $this->input->post('stok');
			$data['deskripsi'] = $this->input->post('deskripsi');
			$data['create_at'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('id');

			$cek = $this->db->get_where('barang', array('kode_barang' => $data['kode_barang']));
			if ($cek->num_rows() > 0)  {
				$response = array(
					'status' => 'error',
					'message' => 'Data Gagal Di Simpan Kode Barang Sudah Tersedia',
				);
			}else{
				$this->MasterModel->add_barang($data);
				$response = array(
					'status' => 'success',
					'message' => 'Data Berhasil Disimpan',
				);
			}

			echo json_encode($response);
		}

		public function update_barang()
		{
			$id = $this->input->post('id_barang_update');
			$data['nama_barang'] = $this->input->post('nama_barang_update');
			$data['kategori'] = $this->input->post('kategori_update');
			$data['harga'] = $this->input->post('harga_update');
			$data['deskripsi'] = $this->input->post('deskripsi_update');
			$data['update_at'] = date('Y-m-d H:i:s');

			$this->MasterModel->update_barang($id, $data);
			$response = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diubah',
			);

			echo json_encode($response);
		}

		public function delete_barang()
		{
			$id = $this->input->post('id');
			$this->MasterModel->delete_barang($id);
			$response = array(
				'status' => 'success',
				'message' => 'Data Berhasil Di Hapus',
			);
			echo json_encode($response);
		}

		public function data_kategori()
		{
			$html = '';
			$data = $this->MasterModel->data_kategori();
			$no = 1;
			foreach ($data as $dp) {
				$html .= '<div class="card p-0">
							<div class="card-body p-2 row">
								<div class="col-4">
									<button class="btn btn-warning btn-sm update-kategori" data-id="'.$dp->id_kategori.'" data-nama="'.$dp->nama_kategori.'"><span class="fa fa-edit"></span></button>
									<button class="btn btn-danger btn-sm delete-kategori" data-id="'.$dp->id_kategori.'" data-nama="'.$dp->nama_kategori.'"><span class="fa fa-trash"></span></button>
								</div>
								<div class="col-6">'.$dp->nama_kategori.'</div>
								<div class="col-2">
									<span class="badge badge-danger align-middle text-md">'.$dp->jumlah_barang.'</span>
								</div>
							</div>
						</div>';
			}
			echo $html;
		}

		public function add_kategori()
		{	
			$data['nama_kategori'] = $this->input->post('nama_kategori');
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('id');
			
			$this->MasterModel->add_kategori($data);
			$response = array(
				'status' => 'success',
				'message' => 'Data Berhasil Disimpan',
			);

			echo json_encode($response);
		}


		public function update_kategori()
		{
			$id = $this->input->post('id_kategori_update');
			$data['nama_kategori'] = $this->input->post('nama_kategori_update');

			$this->MasterModel->update_kategori($id, $data);
			$response = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diubah',
			);

			echo json_encode($response);
		}

		public function delete_kategori()
		{
			$id = $this->input->post('id');
			$this->MasterModel->delete_kategori($id);
			$response = array(
				'status' => 'success',
				'message' => 'Data Berhasil Di Hapus',
			);
			echo json_encode($response);
		}
	// Master Barang

	}
	
	/* End of file Master.php */
	/* Location: ./application/controllers/admin/Master.php */
?>