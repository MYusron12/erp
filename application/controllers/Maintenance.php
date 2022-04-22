<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('Truck_model', 'truck');
         $this->load->model('Wo_model', 'wo');
    }

    public function index() {
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck'] = $this->truck->getDataTax();
        $data['count_service'] = $this->truck->count_service();
        $data['count_wo1'] = $this->wo->jumlahwoperludicheck();
        $data['count_wo2'] = $this->wo->jumlahwosudahdicheck();
        $data['count_wo3'] = $this->wo->jumlahwosudahselesai();
        
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('maintenance/index', $data);
        $this->load->view('templates/footer');
    }

    public function totservice() {
        $data['title'] = "Daftar Mobil Wajib Service";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck_service'] = $this->truck->truck_service(); 
        $data['truck_service_wo'] = $this->truck->truck_service_wo(); 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('maintenance/totservice', $data);
        $this->load->view('templates/footer');
    }

    public function woperludicheck() {
        $data['title'] = "Daftar WO perlu di check";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo1'] = $this->wo->woperludicheck();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('maintenance/totstnk', $data);
        $this->load->view('templates/footer');
    }

    public function wosudahdicheck() {
        $data['title'] = "Daftar WO yang sudah di check";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo2'] = $this->wo->wosudahdicheck();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('maintenance/totbpkb', $data);
        $this->load->view('templates/footer');
    }

    public function wosudahselesai() {
        $data['title'] = "Daftar Wo yang sudah selesai";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo3'] = $this->wo->wosudahselesai();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('maintenance/totkir', $data);
        $this->load->view('templates/footer');
    }

    

    public function workorder() {
        $data['title'] = "Work Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select a.*,b.no_polisi,c.nama_bagian from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.is_deleted='0' order by id_permintaan_pengerjaan desc")->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('maintenance/wo', $data);
        $this->load->view('templates/footer');
    }

    public function tambahwo() {
        $data['title'] = "Form Tambah Work Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['loc'] = $this->db->get('bagian')->result_array();
        $data['kendaraan'] = $this->db->query("
    SELECT a.*, 
    d.merek,
    b.nama as driver, 
    c.nama as helper
    FROM truck a
   left  JOIN driver b on a.driver_id = b.id_driver
   left JOIN driver c on a.helper_id = c.id_driver
   JOIN mobil d on a.idmobil=d.idmobil
    ")->result();
        // var_dump($data['loc']);
        $this->load->model('Driver_model', 'driver');
        $this->form_validation->set_rules('no_pengerjaan', 'No Pengerjaan', 'required');
        $this->form_validation->set_rules('tgl_order', 'Tgl Pemohon', 'required');
        $this->form_validation->set_rules('id_bagian', 'Dept', 'required');
        $this->form_validation->set_rules('deskripsi_peminta', 'Jenis Pengerjaan', 'required');
        $this->form_validation->set_rules('id_truck', 'Mobil', 'required');

        //$list['datatgl'] = $this->input->get('tgllahir');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('maintenance/tambahwo', $data);
            $this->load->view('templates/footer');
        } else {
            $this->driver->simpanwo();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Work Order Sudah ditambah!.</div>');
            redirect('ekspedisi/workorder');
        }
    }

    public function editwo($id) {
        $data['title'] = "Form Edit Work Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select a.*,b.no_polisi,b.no_urut,c.nama_bagian from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.id_permintaan_pengerjaan='$id'")->row();
        $data['loc'] = $this->db->get('bagian')->result_array();
        $this->load->model('Driver_model', 'driver');
         $this->load->model('wo_model', 'wo');
        $data['categori'] = ['Perawatan', 'Pergantian Suku cadang', 'Perawatan & Pergantian Suku cadang'];

        $data['kendaraan'] = $this->db->query("
            SELECT a.*, 
            d.merek,
            b.nama as driver, 
            c.nama as helper
            FROM truck a
           left JOIN driver b on a.driver_id = b.id_driver
           left JOIN driver c on a.helper_id = c.id_driver
           JOIN mobil d on a.idmobil=d.idmobil
    ")->result();

        $this->form_validation->set_rules('no_pengerjaan', 'No Pengerjaan', 'required');
        $this->form_validation->set_rules('tgl_order', 'Tgl Pemohon', 'required');
        $this->form_validation->set_rules('id_bagian', 'Dept', 'required');
        $this->form_validation->set_rules('deskripsi_peminta', 'Jenis Pengerjaan', 'required');
        $this->form_validation->set_rules('id_truck', 'Mobil', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('maintenance/editwo', $data);
            $this->load->view('templates/footer');
        } else {
            $this->wo->checkWo();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Work Order Sudah dirubah!.</div>');
            redirect('maintenance/workorder');
        }
    }

    public function detailwo($id) {
        $data['title'] = "Detail WO";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //$data['truck'] = $this->truck->getDataTruck();
        $data['detil_wo'] = $this->db->query("select a.*,b.*, c.*,d.* from truck a join permintaan_pengerjaan b on a.id_truck=b.id_truck join bagian c on c.idbagian=b.id_bagian join user d on d.id=b.id_user where b.id_permintaan_pengerjaan='$id'")->row();
        //$data['pendidikan'] = ['SD', 'SMP', 'SMA', 'DIPLOMA'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('maintenance/detailwo', $data);
        $this->load->view('templates/footer');
    }

 

    public function checkwo($id) {
        $data['title'] = "Form Edit Work Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select a.*,b.no_polisi,b.no_urut,c.nama_bagian from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.id_permintaan_pengerjaan='$id'")->row();
        $data['loc'] = $this->db->get('bagian')->result_array();
        $this->load->model('Wo_model', 'wo');
        $data['categori'] = ['Perawatan', 'Pergantian Suku cadang', 'Perawatan & Pergantian Suku cadang'];
        $data['kendaraan'] = $this->db->query("
            SELECT a.*, 
            d.merek,
            b.nama as driver, 
            c.nama as helper
            FROM truck a
            left JOIN driver b on a.driver_id = b.id_driver
            left JOIN driver c on a.helper_id = c.id_driver
           JOIN mobil d on a.idmobil=d.idmobil
    ")->result();

        $this->form_validation->set_rules('no_pengerjaan', 'No Pengerjaan', 'required');
        $this->form_validation->set_rules('tgl_order', 'Tgl Pemohon', 'required');
        $this->form_validation->set_rules('id_bagian', 'Dept', 'required');
        $this->form_validation->set_rules('deskripsi_peminta', 'Jenis Pengerjaan', 'required');
        $this->form_validation->set_rules('id_truck', 'Mobil', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('maintenance/checkwo', $data);
            $this->load->view('templates/footer');
        } else {
            $this->wo->checkWo();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Work Order Sudah dirubah!.</div>');
            redirect('maintenance/workorder');
        }
    }
    public function truck() {


        $data['title'] = "Truck";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Truck_model', 'truck');
        $data['truck'] = $this->truck->getDataTruck();

        $data['mobil'] = $this->db->get('mobil')->result();
        $data['driver'] = $this->db->get('driver')->result();

        $this->form_validation->set_rules('nourut', 'No Urut', 'required');
        $this->form_validation->set_rules('nopolisi', 'No Polisi', 'required');
        $this->form_validation->set_rules('mobil', 'Mobil', 'required');
        //$this->form_validation->set_rules('bbmperliter', 'BBM Perliter', 'required');
        //$this->form_validation->set_rules('bbmakumulasi', 'BBM Akumulasi', 'required');
        // $this->form_validation->set_rules('toleran', 'Toleran', 'required');
        //  $this->form_validation->set_rules('driver', 'Driver', 'required');
        // $this->form_validation->set_rules('helper', 'Helper', 'required');
        $this->form_validation->set_rules('km_service', 'KM service', 'required');
        $this->form_validation->set_rules('tgl_stnk', 'TGL STNK', 'required');
        $this->form_validation->set_rules('tgl_bpkb', 'TGL BPKB', 'required');
        $this->form_validation->set_rules('tgl_kir', 'TGL KIR', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('maintenance/truck', $data);
            $this->load->view('templates/footer');
        } else {
            $this->truck->simpandatatruck();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Data Truck Sudah Tersimpan!.
         </div>');
            redirect('ekspedisi/truck');
        }
    }
    public function Detailtruck($id) {
        $data['title'] = "Detail service mobil";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Truck_model', 'truck');
        $data['header'] = $this->truck->truck_header($id);
        $data['details'] = $this->truck->truck_detail($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/detailtruck', $data);
        $this->load->view('templates/footer');
    }

}
