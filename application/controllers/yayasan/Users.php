<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Users extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('MasterModel');
		}
	
		public function index()
		{
			$this->load->view('partials/head');
			$this->load->view('partials/header');
			$this->load->view('partials/sidebar');
			$this->load->view('yayasan/users');
			$this->load->view('partials/footer');
		}

		public function data_users()
		{
			$html = '';
			$status = '';
			$data = $this->MasterModel->data_users();
			$no = 1;
			foreach ($data as $dp) {
				if ($dp->status == 1) {
					$status = 'Aktif';
				}else{
					$status = 'Tidak Aktif';
				}
				$html .= '<tr>
							<th class="text-center align-middle">'.$no++.'</th>
							<th class="text-center align-middle">'.$dp->nama_user.'</th>
							<th class="align-middle">'.$dp->username.'</th>
							<td class="align-middle text-center">'.$dp->password.'</td>
							<td class="align-middle text-center">'.$status.'</td>
							<td class="align-middle text-center">
								<button class="btn btn-danger btn-sm delete-user" data-id="'.$dp->id_user.'" data-username="'.$dp->username.'" data-nama="'.$dp->nama_user.'"><span class="fa fa-trash"></span></button>
							</td>
						</tr>';
			}
			echo $html;
		}

		public function add_user()
		{
			$cek = $this->db->get_where('user', array('username' => $this->input->post('username')));
			if ($cek->num_rows() > 0) {
				$response = array(
					'status' => 'error',
					'title' => 'GAGAL !!!',
					'message' => 'Data Sudah Ada',
				 );
			}else{
				$config['upload_path'] = './assets/dist/img/users/';
		        $config['allowed_types'] = 'gif|jpg|png|jpeg';
		        $config['max_size'] = '1024';
		        $config['file_name'] = $this->input->post('username');
		        $this->load->library('upload', $config);

		        if($this->upload->do_upload("foto")){
					$foto = $this->upload->file_name;
				} else {
					$foto = '';
				}

				$data = array(
		 			'username' 			=> $this->input->post('username'),
		 			'nama_user' 		=> $this->input->post('nama_user'),
		 			'password' 			=> $this->input->post('password'),
		 			'status' 			=> $this->input->post('status'),
		 			'level' 			=> 1,

		 			'foto' 				=> $foto
					 );

				$this->MasterModel->tambah_users($data);
				$response = array(
					'status' => 'success',
					'title' => 'SUKSES !!!',
					'message' => 'Data Berhasil DiSimpan',
				 );
			}
			echo json_encode($response);
		}
	
		public function delete_user()
		{
			$id = $this->input->post('id');
			$username = $this->input->post('username');
			$query = $this->db->get_where('user', array('username' => $username ))->row();

			$res = $this->MasterModel->delete_user($id);
			if ($res) {
				unlink("./assets/dist/img/users/$query->foto");
			}
		}
	}
	
	/* End of file Users.php */
	/* Location: ./application/controllers/yayasan/Users.php */
?>