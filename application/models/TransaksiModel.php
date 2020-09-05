<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class TransaksiModel extends CI_Model {

		function get_no_trx()
		{
			$q = $this->db->query("SELECT MAX(RIGHT(kode_transaksi,3)) AS kd_max FROM transaksi WHERE DATE(created_at)=CURDATE()");
	        $kd = "";
	        if($q->num_rows()>0){
	            foreach($q->result() as $k){
	                $tmp = ((int)$k->kd_max)+1;
	                $kd = sprintf("%04s", $tmp);
	            }
	        }else{
	            $kd = "0001";
	        }
	        date_default_timezone_set('Asia/Jakarta');
	        return date('dmy').$kd;
		}
	
		function add_transaksi($data)
		{
			$this->db->insert_batch('transaksi', $data);
		}

		function riwayat_transaksi($start, $end)
		{
			$this->db->select('transaksi.kode_transaksi, user.nama_user, transaksi.created_at, SUM(transaksi.jumlah) as total_quantity, COUNT(transaksi.kode_barang) as jumlah_barang, SUM(transaksi.total_bayar) as total_harga');
			$this->db->from('transaksi');
			$this->db->join('user', 'user.id_user = transaksi.created_by', 'left');
			$this->db->group_by('kode_transaksi');

			if ($start != '') {
				$this->db->where('DATE(created_at) >=', $start);
				$this->db->where('DATE(created_at) <=', $end);
			}
			$this->db->order_by('created_at', 'desc');
			return $this->db->get();
		}

		function riwayat_all_transaksi($start, $end)
		{
			$this->db->select('*');
			$this->db->from('transaksi');
			$this->db->join('user', 'user.id_user = transaksi.created_by', 'left');
			$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'left');
			if ($start != '') {
				$this->db->where('DATE(created_at) >=', $start);
				$this->db->where('DATE(created_at) <=', $end);
			}
			$this->db->order_by('created_at', 'desc');
			return $this->db->get();
		}

		function get_detail_transaksi($kode)
		{
			$this->db->select('transaksi.*, barang.nama_barang, barang.kode_barang');
			$this->db->from('transaksi');
			$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'left');
			$this->db->where('kode_transaksi', $kode);
			return $this->db->get();
		}
	
	}
	
	/* End of file TransaksiModel.php */
	/* Location: ./application/models/TransaksiModel.php */
?>