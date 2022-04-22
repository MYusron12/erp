<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crudb_model extends CI_Model {

	public function getAllCrudb()
	{
        //$this->db->order_by('account', 'DESC');
		return $this->db->get('coa_na')->result_array();
	}

	public function getDataCrudb($limit, $start, $keyword = null)
	{
      if ($keyword) {

         $this->db->like('nama', $keyword);
         $this->db->or_like('account', $keyword);
      	
      } 
      return $this->db->get('coa_na', $limit, $start)->result_array();
	}

	public function CountDataCrudb()
	{
		return $this->db->get('coa_na')->num_rows();
	}

	public function getchangeCrudbById($id)
	{
		return $this->db->get_where('coa_na', ['id_coa_na' => $id])->row_array();
	}

}
