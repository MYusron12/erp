<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminops extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('Truck_model', 'truck');
    }

    public function index()
    {
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck'] = $this->truck->getDataTax();
       
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
        $this->load->view('adminops/index', $data);
        $this->load->view('templates/footer');
    }
    public function totservice(){
        $data['title'] = "Daftar Mobil Wajib Service";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck_service'] = $this->truck->truck_service(); 
        $data['truck_service_wo'] = $this->truck->truck_service_wo(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminops/totservice', $data);
        $this->load->view('templates/footer');
    }
    
     public function totstnk(){
        $data['title'] = "Daftar Mobil Wajib Perpanjang STNK";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck_stnk'] = $this->truck->truck_stnk(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminops/totstnk', $data);
        $this->load->view('templates/footer');
    }
    
     public function totbpkb(){
        $data['title'] = "Daftar Mobil Wajib Perpanjang BPKB";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck_bpkb'] = $this->truck->truck_bpkb(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminops/totbpkb', $data);
        $this->load->view('templates/footer');
    }
    public function totkir(){
        $data['title'] = "Daftar Mobil Wajib Perpanjang KIR";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck_kir'] = $this->truck->truck_kir(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminops/totkir', $data);
        $this->load->view('templates/footer');
    }
    public function totbks(){
        $data['title'] = "Daftar Mobil Wajib Perpanjang SIPA BKS";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck_sipa_bks'] = $this->truck->truck_sipa_bks(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminops/totbks', $data);
        $this->load->view('templates/footer');
    }

   public function totimbbks(){
        $data['title'] = "Daftar Mobil Wajib Perpanjang IBM BKS";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck_ibm_bks'] = $this->truck->truck_ibm_bks(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminops/totibmbks', $data);
        $this->load->view('templates/footer');
    }
    public function totibmclg(){
        $data['title'] = "Daftar Mobil Wajib Perpanjang IBM CLG";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck_ibm_clg'] = $this->truck->truck_ibm_clg(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminops/totibmclg', $data);
        $this->load->view('templates/footer');
    }
    
    public function totizin(){
        $data['title'] = "Daftar Mobil Wajib Perpanjang izin lintas";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['izin_lintas'] = $this->truck->izin_lintas(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminops/totizin', $data);
        $this->load->view('templates/footer');
    }
    public function totspbgr(){
        $data['title'] = "Daftar Mobil Wajib Sipa Bogor";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck_sipa_bgr'] = $this->truck->truck_sipa_bgr(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminops/totspbgr', $data);
        $this->load->view('templates/footer');
    }
}
