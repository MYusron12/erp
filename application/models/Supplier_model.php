<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

public function getSupplierCode()
{
      $this->db->select('RIGHT(suplier.kode_suplier,3) as kode', FALSE);
      $this->db->order_by('id_suplier','DESC');    
      $this->db->limit(1);     
      $query = $this->db->get('suplier');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){       
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;     
      }
      else{       
       //jika kode belum ada      
       $kode = 1;     
      }
      $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);    
      $kodejadi = "SPL-".$kodemax;     
      return $kodejadi;
}


public function simpanSupplier()
{
	$kodesuplier = $this->input->post('supliercode');
	$suplier = $this->input->post('suplier');
	$bank = $this->input->post('bank');
	$account = $this->input->post('account');
	$city = $this->input->post('city');
	$branch = $this->input->post('branch');
	$approved = $this->input->post('is_approved');

	if ($approved == NULL) {
		
		$approved = 0;
	}

	$data = [
    
    'kode_suplier' => $kodesuplier,
    'suplier' => $suplier,
    'bank' => $bank,
    'rekening' => $account,
    'kota' => $city,
    'cabang' => $branch,
    'approve' => $approved

	];

	$this->db->insert('suplier', $data);
}

 public function getchangeSupplierById($id)
 {
    return $this->db->get_where('suplier', ['id_suplier' => $id])->row_array();
 }

 public function getUpdateSuplier()

 {
 	$idsuplier = $this->input->post('idsuplier');
 	$suplier = $this->input->post('suplier');
	$bank = $this->input->post('bank');
	$account = $this->input->post('account');
	$city = $this->input->post('city');
	$branch = $this->input->post('branch');
	$approved = $this->input->post('is_approved');

	if ($approved == NULL) {
		
		$approved = 0;
	}

	$data = [
    
    'suplier' => $suplier,
    'bank' => $bank,
    'rekening' => $account,
    'kota' => $city,
    'cabang' => $branch,
    'approve' => $approved

	];
    
    $this->db->where('id_suplier', $idsuplier);
	$this->db->update('suplier', $data);

 }

 public function getHapusSuplier($id)
 {
    $this->db->delete('suplier', ['id_suplier' => $id]);
    
 }





}