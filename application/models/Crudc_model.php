<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crudc_model extends CI_Model {

	public function getAllCrudc()
	{
        $this->db->order_by('account', 'ASC');
		return $this->db->get('coa_tb')->result_array();
	}

	public function getDataCrudc($limit, $start, $keyword = null)
	{
      if ($keyword) {
      	$this->db->like('nama', $keyword);
      	$this->db->or_like('account', $keyword);
      	
      }
      return $this->db->get('coa_tb', $limit, $start)->result_array();
	}

	public function CountDataCrudc()
	{
		return $this->db->get('coa_tb')->num_rows();
	}

	public function getchangeCrudcById($id)
	{
		return $this->db->get_where('coa_tb', ['id_coa_tb' => $id])->row_array();
	}

}
