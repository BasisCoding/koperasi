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

		function data_supplier()
		{
			return $this->db->get('supplier')->result();
		}

		function riwayat_persediaan()
		{
			$this->db->select('*');
			$this->db->from('persediaan');
			$this->db->join('barang', 'barang.id = persediaan.id_barang', 'left');
			$this->db->join('user', 'user.id_user = persediaan.created_by', 'left');
			$this->db->join('supplier', 'supplier.id_supplier = persediaan.id_supplier', 'left');
			return $this->db->get()->result();
		}

		function add_riwayat_persediaan($data)
		{
			$this->db->insert('persediaan', $data);
		}

		function add_supplier($data)
		{
			$this->db->insert('supplier', $data);
		}

		function update_supplier($id, $data)
		{
			$this->db->update('supplier', $data, array('id_supplier' => $id));
		}

		function delete_supplier($id)
		{
			$this->db->delete('supplier', array('id_supplier' => $id));
		}

		function data_users()
		{
			return $this->db->get_where('user', array('level' => 1))->result();
		}

		function tambah_users($data){
			$this->db->insert('user', $data);
		}

		function delete_user($id){
			$this->db->delete('user', array('id_user' => $id));
		}
	
	}
	
	/* End of file MasterModel.php */
	/* Location: ./application/models/MasterModel.php */
?>