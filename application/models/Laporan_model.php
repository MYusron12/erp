<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

public function outstandingbs($tanggal=null)
{

   if ($tanggal) {
   	 $this->db->group_start();
     $this->db->where('tgl_terima <=', $tanggal);
     $this->db->group_end();
   }
  
   $this->db->select('transaksi_department.*, departement.nama');
	 $this->db->from('transaksi_department');
	 $this->db->join('departement', 'departement.id_departement = transaksi_department.id_dept');
	 $this->db->where('status', 2);
   $this->db->where('hub', $this->session->userdata('hub'));
	 return $this->db->get()->result_array();

    
} 

public function getBelumApprove($tanggal = null)
{

     if ($tanggal) {

      $this->db->group_start();
      $this->db->where('tanggal <=', $tanggal);
	  	$this->db->group_end();
	  	
	  }

    $this->db->select('transaksi_department.*, departement.nama');
	  $this->db->from('transaksi_department');
	  $this->db->join('departement', 'departement.id_departement = transaksi_department.id_dept');
	  $this->db->where('status', 1);
    $this->db->where('hub', $this->session->userdata('hub'));
	  return $this->db->get()->result_array();
} 


public function getRealisasi($tanggal = null)
{

     if ($tanggal) {

        $this->db->group_start();
        $this->db->where('tgl_realisasi <=', $tanggal);
	  	  $this->db->group_end();

	  	  
	}

    $this->db->select('transaksi_department.*, departement.nama');
    $this->db->from('transaksi_department');
    $this->db->join('departement', 'departement.id_departement = transaksi_department.id_dept');
    $this->db->where('status >', 2);
    $this->db->where('hub', $this->session->userdata('hub'));
    return $this->db->get()->result_array();

}

public function getKasbank($tgl1 = null, $tgl2 = null)
{
   if ($tgl1 And $tgl2) {

   	    $this->db->group_start();
        $this->db->where('tgl_pengajuan >=', $tgl1);
        $this->db->where('tgl_pengajuan <=', $tgl2);
	  	  $this->db->group_end();
   }

     $this->db->where('hub', $this->session->userdata('hub'));
     return $this->db->get('transaksi')->result_array();


} 

public function getReimburstment($tgl1 = null, $tgl2 = null)

{

  if ($tgl1 And $tgl2) {

        $this->db->group_start();
        $this->db->where('tgl_pengajuan >=', $tgl1);
        $this->db->where('tgl_pengajuan <=', $tgl2);
        $this->db->group_end();
   }

     $this->db->where('status', 1);
     $this->db->where('hub', $this->session->userdata('hub'));
     return $this->db->get('transaksi')->result_array();
}

public function getRealisasiKasbank($tgl1 = null, $tgl2 = null)

{

  if ($tgl1 And $tgl2) {

        $this->db->group_start();
        $this->db->where('tgl_penerima >=', $tgl1);
        $this->db->where('tgl_penerima <=', $tgl2);
        $this->db->group_end();
   }

    $this->db->where('status', 2);
    $this->db->where('hub', $this->session->userdata('hub'));
     return $this->db->get('transaksi')->result_array();
}

public function getbelumProsesHo($tgl1 = null, $tgl2 = null)
{

  if ($tgl1 And $tgl2) {

        $this->db->group_start();
        $this->db->where('tgl_pengajuan >=', $tgl1);
        $this->db->where('tgl_pengajuan <=', $tgl2);
        $this->db->group_end();
   }

     $this->db->where('status', 0);
     $this->db->where('hub', $this->session->userdata('hub'));
     return $this->db->get('transaksi')->result_array();
}

public function getKasbankkehobelumrealisasi($tgl1 = null, $tgl2 = null)
{
  if ($tgl1 And $tgl2) {

        $this->db->group_start();
        $this->db->where('tgl_proses >=', $tgl1);
        $this->db->where('tgl_proses <=', $tgl2);
        $this->db->group_end();
   }

    $this->db->where('status', 1);
    $this->db->where('hub', $this->session->userdata('hub'));
     return $this->db->get('transaksi')->result_array();
}
public function getReportWO($tgl1 = null, $tgl2 = null)

{

  if ($tgl1 And $tgl2) {

        $this->db->group_start();
        $this->db->where('tgl_order >=', $tgl1);
        $this->db->where('tgl_order <=', $tgl2);
        $this->db->group_end();
   }
     return $this->db->get('permintaan_pengerjaan')->result_array();
}


}