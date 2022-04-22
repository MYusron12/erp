<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_model extends CI_Model {

	public function getAllLokasi()
	{
        $this->db->order_by('id_department', 'ASC');
		return $this->db->get('departement')->result_array();
	}

	public function getDataLokasi($limit, $start, $keyword = null)
	{
	  if ($keyword) {
	  	$this->db->like('nama', $keyword);
	  	$this->db->or_like('kode_loc', $keyword);
	  }
      return $this->db->get('departement', $limit, $start)->result_array();
	}

	public function CountDataLokasi()
	{
		return $this->db->get('departement')->num_rows();
	}

	public function getchangeLokasiById($id)
	{
		return $this->db->get_where('departement', ['id_departement' => $id])->row_array();
	}

	public function getchangeMoneyById($id)
	{
		return $this->db->get_where('validasi', ['id_validasi' => $id])->row_array();
	}

}
