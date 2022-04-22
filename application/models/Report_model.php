<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

public function getAllDataBsKantorPusatById($id)
{
  
  $this->db->select('bskantorpusat.*, departement.kode_loc, departement.nama AS namaloc, bisnis.nama_bisnis, coa_ec.account, coa_na.account AS accountna, coa_ec.nama, coa_na.nama AS namana');
  $this->db->from('bskantorpusat');
  $this->db->join('bagian', 'bskantorpusat.idbagian = bagian.idbagian');
  $this->db->join('departement', 'bskantorpusat.id_department = departement.id_departement');
  $this->db->join('coa_ec', 'bskantorpusat.ec = coa_ec.id_coa_ec');
  $this->db->join('coa_na', 'bskantorpusat.na = coa_na.id_coa_na');
  $this->db->join('bisnis', 'bskantorpusat.idbisnis = bisnis.idbisnis');
  $this->db->where('idbskantorpusat', $id);
  $query = $this->db->get();
  return $query->row_array();
}





}