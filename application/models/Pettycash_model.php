<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pettycash_model extends CI_Model {


 public function getDataPettycash($limit, $start, $keyword = null)
 {

   if ($keyword) {
      $this->db->group_start();
      $this->db->like('pemohon', $keyword);
      $this->db->or_like('nama_bagian', $keyword);
      $this->db->or_like('no_bs', $keyword);
      $this->db->or_like('no_kas_bank', $keyword);
      $this->db->group_end();

   }

      $params['conditions'] = [
       'status' => 1,
       'hub' => $this->session->userdata('hub')
      ];          

    // return $this->db->get_where('qpettycash', $params['conditions'], $limit, $start)->result_array();

  $this->db->select('transaksi_department.*, bagian.nama_bagian');
  $this->db->from('transaksi_department');
  $this->db->join('bagian', 'transaksi_department.idbagian = bagian.idbagian');
  $where = $params['conditions'];
  $this->db->where($where);
  $this->db->limit($limit, $start); 
  return $this->db->get()->result_array();
           

 }


 //  public function getDataPettycashId($id)
 // {

 //       $query = "SELECT `transaksi_department`.*, `departement`.`nama`
 //                  FROM `transaksi_department` JOIN `departement`
 //                  ON `transaksi_department`.`id_department` = `departement`.`id_departement`
 //                  WHERE `transaksi_department`.`status` = 0 AND `transaksi_department`.`id_transaksi_dept` = $id
 //                ";
 //        return $this->db->query($query)->row_array();
 // }



 public function generateBsNo()
 {
      $this->db->select('*');
      $this->db->where('transaksi="BS"');  
      $query = $this->db->get('counter');
      foreach ($query->result_array() as $row):
          if($row['jumlah']>8) {
            $j=$row['jumlah']+1;
            $kode='0000';
             }else{
            $j=$row['jumlah']+1;
            $kode='00000';
             }
      endforeach;
     
      $kodejadi = $kode.$j;     
      return $kodejadi;  
 }


}