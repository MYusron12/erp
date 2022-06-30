<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hrd extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('Hrd_model', 'hrd');
       
    }

    public function index() {
        $data['title'] = "Dashboard HRD";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
     
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('hrd/index', $data);
        $this->load->view('templates/footer');
    }

    // master obat
    public function masterObat()
    {
        $data['title'] = "Master Obat";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['masterobat'] = $this->db->get('master_obat')->result();
        $data['getallobat'] = $this->hrd->queryGetAllObat();
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('hrd/masterObat', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('master_obat', [
                'kode_obat' => $this->input->post('kode_obat'),
                'nama_obat' => $this->input->post('nama_obat')
            ]);
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('hrd/masterObat');
        }
    }
    public function tambahMasterObat()
    {
        $data['title'] = "Tambah Master Obat";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['getallobat'] = $this->hrd->queryGetAllObat();
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('hrd/tambahMasterObat', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('master_obat', [
                'kode_obat' => $this->input->post('kode_obat'),
                'nama_obat' => $this->input->post('nama_obat')
            ]);
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('hrd/masterObat');
        }
    }
    public function ubahMasterObat($id)
    {
        $data['title'] = "Ubah Master Obat";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['obatid'] = $this->db->get_where('master_obat', ['id' => $id])->result();
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('hrd/ubahMasterObat', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->where('id', $id);
            $this->db->update('master_obat', [
                'nama_obat' => $this->input->post('nama_obat'),
                'kode_obat' => $this->input->post('kode_obat')
            ]);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('hrd/masterObat');
        }
    }
    public function hapusMasterObat($id)
    {
        $this->db->delete('master_obat', ['id' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('hrd/masterObat');
    }

    // request obat
    public function requestObat()
    {
        $data['title'] = "Master HRD";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('hrd/requestObat', $data);
        $this->load->view('templates/footer');
    }

   

}
