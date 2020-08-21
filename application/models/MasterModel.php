<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class MasterModel extends CI_Model {
	
		function data_barang()
		{
			$this->db->select('*');
			$this->db->from('barang');
			$this->db->join('kategori', 'kategori.id_kategori = barang.kategori', 'left');
			return $this->db->get()->result();
		}
		
		function add_barang($data)
		{
			$this->db->insert('barang', $data);
		}

		function update_barang($id, $data)
		{
			$this->db->update('barang', $data, array('id' => $id));
		}

		function delete_barang($id)
		{
			$this->db->delete('barang', array('id'=>$id));
		}

		function data_kategori()
		{
			$this->db->select('*, COUNT(barang.kategori) as jumlah_barang');
			$this->db->from('kategori');
			$this->db->join('barang', 'barang.kategori = kategori.id_kategori', 'left');
			$this->db->group_by('kategori.id_kategori');
			return $this->db->get()->result();
		}

		function add_kategori($data)
		{
			$this->db->insert('kategori', $data);
		}

		function update_kategori($id, $data)
		{
			$this->db->update('kategori', $data, array('id_kategori'=>$id));
		}

		function delete_kategori($id)
		{
			$this->db->delete('kategori', array('id_kategori'=>$id));
		}
	
	}
	
	/* End of file MasterModel.php */
	/* Location: ./application/models/MasterModel.php */
?>