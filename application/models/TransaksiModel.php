<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class TransaksiModel extends CI_Model {
	
		function add_transaksi($data)
		{
			$this->db->insert('transaksi', $data);
		}

		function riwayat_transaksi()
		{
			$this->db->select('*');
			$this->db->from('transaksi');
			$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'left');
			$this->db->join('user', 'user.id_user = transaksi.created_by', 'left');

			return $this->db->get()->result();
		}
	
	}
	
	/* End of file TransaksiModel.php */
	/* Location: ./application/models/TransaksiModel.php */
?>