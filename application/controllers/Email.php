<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Truck_model', 'truck');
        $data['truck'] = $this->truck->getDataTax();
        $data['truck_stnk'] = $this->truck->truck_stnk(); 
        $data['truck_bpkb'] = $this->truck->truck_bpkb(); 
        $data['truck_kir'] = $this->truck->truck_kir(); 
        $data['truck_service'] = $this->truck->truck_service(); 
        $data['truck_sipa_bks'] = $this->truck->truck_sipa_bks(); 
        $data['truck_sipa_bgr'] = $this->truck->truck_sipa_bgr();
        $data['truck_ibm_clg'] = $this->truck->truck_ibm_clg();
        $data['truck_ibm_clg'] = $this->truck->truck_ibm_clg();
        $data['izin_lintas'] = $this->truck->izin_lintas();
        $data['count_service'] = $this->truck->count_service(); 
        $data['count_stnk'] = $this->truck->count_stnk(); 
        $data['count_kir'] = $this->truck->count_kir(); 
        $data['count_bpkb'] = $this->truck->count_bpkb(); 
        $data['count_sipabks'] = $this->truck->count_sipabks(); 
        $data['count_sipabgr'] = $this->truck->count_sipabgr(); 
        $data['count_ibmbks'] = $this->truck->count_ibmbks(); 
        $data['count_ibmclg'] = $this->truck->count_ibmclg(); 
        $data['count_lintas'] = $this->truck->count_lintas(); 
     
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    
}
