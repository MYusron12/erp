<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('Purchasing_model', 'purchasing');
        $this->load->model('Approval_model', 'approval');
    }

    public function index()
    {
        $data['title'] = "PR Barang";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['permintaan'] = $this->approval->get_data_permintaan();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('approval/approvalpermintaanbarang', $data);
        $this->load->view('templates/footer');
    }
    public function listjs()
    {
        $data['title'] = "PR Barang Jasa";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['permintaan'] = $this->approval->get_data_permintaan_jasa();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('approval/approvalpermintaanbarangjs', $data);
        $this->load->view('templates/footer');
    }
    public function viewaproval($id)
    {
        $data['title'] = "Approval PR Barang";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $result = [];
        $headerpermintaan = $this->approval->get_data_header_id($id);
        $result['headerpermintaan'] = $headerpermintaan;
        $detailpermintaan = $this->approval->get_data_permintaan_detail_id($id);

        foreach ($detailpermintaan as $key => $value) {
            $result['detailpermintaan'][] = $value;
        }
        $data['permintaan'] = $result;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('approval/vpermintaanapproval', $data);
        $this->load->view('templates/footer');
    }
    
     public function viewaprovaljs($id)
    {
         $data['title'] = "View Permintaan Jasa";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $data['jasa']= $this->purchasing->get_data_jasa_id($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('approval/viewjasa', $data);
        $this->load->view('templates/footer');
    }
    
    public function getSetujuPr()
    {
        $id = $this->input->post('id', true);
        $tanggal_setuju = date('Y-m-d');
        $data = [
            'tanggal_approve' => $tanggal_setuju,
            'status' => 2
        ];
        $this->db->where('id_permintaan', $id);
        $this->db->update('permintaan_pembelian_header', $data);
    }

    public function getTidakSetujuPr()
    {
        $id = $this->input->post('id', true);
        $tanggal_setuju = date('Y-m-d');
        $data = [
            'tanggal_approve' => $tanggal_setuju,
            'status' => 0
        ];
        $this->db->where('id_permintaan', $id);
        $this->db->update('permintaan_pembelian_header', $data);
    }
    public function getSetujuPrjs()
    {
        $id = $this->input->post('id', true);
        $tanggal_setuju = date('Y-m-d');
        $data = [
            'tanggal_approve' => $tanggal_setuju,
            'status' => 2
        ];
        $this->db->where('id_permintaan_jasa', $id);
        $this->db->update('permintaan_jasa_all', $data);
    }

    public function getTidakSetujuPrjs()
    {
        $id = $this->input->post('id', true);
        $tanggal_setuju = date('Y-m-d');
        $data = [
            'tanggal_approve' => $tanggal_setuju,
            'status' => 0
        ];
        $this->db->where('id_permintaan_jasa', $id);
        $this->db->update('permintaan_jasa_all', $data);
    }
}
