<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class LoginModel extends CI_Model {
	
		function proses_login($username, $password)
		{
			$this->db->select('*');
			$this->db->from('user');
			$this->db->join('user_group', 'user_group.id_group = user.level', 'left');
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$this->db->where('status', 1);
			$this->db->limit(1);
			$get = $this->db->get();
			if ($get->num_rows() == 0) {
				return FALSE;
			}else{
				return $get->result();
			}
		}		
	
	}
	
	/* End of file LoginModel.php */
	/* Location: ./application/models/LoginModel.php */
?>