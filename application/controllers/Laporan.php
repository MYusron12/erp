<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct()
      {
        parent::__construct();
        check_login();
        $this->load->model('Laporan_model','laporan');
      }

public function index()
{

}


public function lapoutstandingbs()
{
  
    //$this->session->unset_userdata('tanggal');
  $this->session->unset_userdata('keyword');
   $data['title'] = "Laporan Outstanding BS";
   $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
  
    if ($this->input->post('submit')) {
     $data['tanggal'] = $this->input->post('tgl');
    } else {

      $data['tanggal'] = null;
    }

     $data['osbs'] = $this->laporan->outstandingbs($data['tanggal']);

    
  
     $data['tgl'] = $data['tanggal'];
     
		 $this->load->view('templates/header', $data);
		 $this->load->view('templates/sidebar', $data);
		 $this->load->view('templates/topbar', $data);
		 $this->load->view('laporan/bs/outstandingbs', $data);
		 $this->load->view('templates/footer');
          
}

public function belumapprove()
{
   $data['title'] = "Belum Approve";
   $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
  
    if ($this->input->post('submit')) {

      $tanggal = $this->input->post('tanggal');
      
     } else {

      $tanggal = null;
     
     }

     $data['osbs'] = $this->laporan->getBelumApprove($tanggal);
  
     $data['tgl'] = $tanggal;
     
     $this->load->view('templates/header', $data);
     $this->load->view('templates/sidebar', $data);
     $this->load->view('templates/topbar', $data);
     $this->load->view('laporan/bs/belumapprove', $data);
     $this->load->view('templates/footer');
}

public function realisasibs()
{
   $data['title'] = "Realisasi";
   $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
  
    if ($this->input->post('submit')) {

     $tanggal = $this->input->post('tanggal');
      
     } else {

      $tanggal = null;
     
     }

     $data['osbs'] = $this->laporan->getRealisasi($tanggal);
  
     $data['tgl'] = $tanggal;
     
     $this->load->view('templates/header', $data);
     $this->load->view('templates/sidebar', $data);
     $this->load->view('templates/topbar', $data);
     $this->load->view('laporan/bs/realisasi', $data);
     $this->load->view('templates/footer');
}


public function kasbank()
{

    $data['title'] = "Kasbank";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    if ($this->input->post('submit')) {
      $tgl1 = $this->input->post('tgl1');
      $tgl2 = $this->input->post('tgl2');
    } else {
      $tgl1 = null;
      $tgl2 = null;
    }

    $data['kasbank'] = $this->laporan->getKasbank($tgl1, $tgl2);

     $this->load->view('templates/header', $data);
     $this->load->view('templates/sidebar', $data);
     $this->load->view('templates/topbar', $data);
     $this->load->view('laporan/kasbank/kasbank', $data);
     $this->load->view('templates/footer');
}


public function reimburstkasbank()
{
   $data['title'] = "Reimburst Kasbank";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    if ($this->input->post('submit')) {
      $tgl1 = $this->input->post('tgl1');
      $tgl2 = $this->input->post('tgl2');
    } else {
      $tgl1 = null;
      $tgl2 = null;
    }

    $data['kasbank'] = $this->laporan->getReimburstment($tgl1, $tgl2);

   
     $this->load->view('templates/header', $data);
     $this->load->view('templates/sidebar', $data);
     $this->load->view('templates/topbar', $data);
     $this->load->view('laporan/kasbank/reimburstment', $data);
     $this->load->view('templates/footer');
}


public function realisasipembkasbank()
{
   $data['title'] = "Realisasi Kasbank";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    if ($this->input->post('submit')) {
      $tgl1 = $this->input->post('tgl1');
      $tgl2 = $this->input->post('tgl2');
    } else {
      $tgl1 = null;
      $tgl2 = null;
    }

    $data['kasbank'] = $this->laporan->getRealisasiKasbank($tgl1, $tgl2);

   
     $this->load->view('templates/header', $data);
     $this->load->view('templates/sidebar', $data);
     $this->load->view('templates/topbar', $data);
     $this->load->view('laporan/kasbank/realisasi', $data);
     $this->load->view('templates/footer');
}


public function belumprosesho()
{
   $data['title'] = "Belum Proses HO";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    if ($this->input->post('submit')) {
      $tgl1 = $this->input->post('tgl1');
      $tgl2 = $this->input->post('tgl2');
    } else {
      $tgl1 = null;
      $tgl2 = null;
    }

    $data['kasbank'] = $this->laporan->getbelumProsesHo($tgl1, $tgl2);

   
     $this->load->view('templates/header', $data);
     $this->load->view('templates/sidebar', $data);
     $this->load->view('templates/topbar', $data);
     $this->load->view('laporan/kasbank/belumproses', $data);
     $this->load->view('templates/footer');
}


public function oskbbelumrealisasiho()
{
   $data['title'] = "Laporan Kasbank ke Ho belum Realisasi";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    if ($this->input->post('submit')) {
      $tgl1 = $this->input->post('tgl1');
      $tgl2 = $this->input->post('tgl2');
    } else {
      $tgl1 = null;
      $tgl2 = null;
    }

    $data['kasbank'] = $this->laporan->getKasbankkehobelumrealisasi($tgl1, $tgl2);

   
     $this->load->view('templates/header', $data);
     $this->load->view('templates/sidebar', $data);
     $this->load->view('templates/topbar', $data);
     $this->load->view('laporan/kasbank/kasbankhobelumreal', $data);
     $this->load->view('templates/footer');
}








}
