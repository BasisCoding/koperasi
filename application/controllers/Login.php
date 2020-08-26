<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Login extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('LoginModel');
		}
	
		public function index()
		{
			$this->load->view('login');	
		}

		public function cekLogin()
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cek = $this->LoginModel->proses_login($username, $password);
			if ($cek != FALSE) {
				foreach ($cek as $ck) {
					$data_session = array(
						'username'		=> $username,
						'nama_lengkap' 	=> $ck->nama_user,
						'id'			=> $ck->id_user,
						'level'			=> $ck->level,
						'foto'			=> $ck->foto,
						'nama_akses'	=> $ck->nama_group,
						'link'			=> $ck->link,
						'status' 		=> "login"
					);
					$response = array(
								'status' => 'success',
								'message' => 'Anda Berhasil Login',
								'redirect' => $ck->link
							);
				}
				$this->session->set_userdata($data_session);
			}else{
				$response = array(
							'status' => 'error',
							'message' => 'Anda Gagal Login',
							'redirect' => ''
						);
			}
			echo json_encode($response);
		}
		
		public function Logout()
		{
			$logout = $this->session->sess_destroy();
			$response = array(
							'status' => 'success',
							'message' => 'Anda Berhasil Logout',
							'redirect' => 'Login'
						);
			echo json_encode($response);
		}
	}
	
	/* End of file Login.php */
	/* Location: ./application/controllers/Login.php */
?>