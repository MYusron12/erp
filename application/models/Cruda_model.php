<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cruda_model extends CI_Model
{

	public function getAllCruda()
	{
		//$this->db->order_by('account', "ASC");
		return $this->db->get('coa_ec')->result_array();
	}

	public function getDataCruda($limit, $start, $keyword = null)
	{
		if ($keyword) {

			$this->db->like('nama', $keyword);
			$this->db->or_like('account', $keyword);
		}

		return $this->db->get('coa_ec', $limit, $start)->result_array();
	}

	public function CountDataCruda()
	{
		return $this->db->get('coa_ec')->count_all_results();
	}

	public function getchangeCrudaById($id)
	{
		return $this->db->get_where('coa_ec', ['id_coa_ec' => $id])->row_array();
	}
}
