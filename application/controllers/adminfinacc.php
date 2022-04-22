<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminfinacc extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('Finance_model', 'fin');
    }

    public function index()
    {
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['truck'] = $this->truck->getDataTax();
       
         $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $base = "http://" . $_SERVER['HTTP_HOST'];
        $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $config['base_url'] = $base . "adminfinacc/index";
        //$config['base_url'] = 'http://localhost/dc-finance/pettycash/index';

        $params['conditions'] = [
            'status' => 1,
            'hub' => $this->session->userdata('hub')
        ];

        $this->db->group_start();
        $this->db->like('no', $data['keyword']);
        $this->db->or_like('nama', $data['keyword']);
        $this->db->or_like('hub', $data['keyword']);
        $this->db->or_like('pic1', $data['keyword']);
        $this->db->group_end();


        $this->db->from('customer');
       // $this->db->join('bagian', 'transaksi_department.idbagian = bagian.idbagian');
        $where = $params['conditions'];
        $this->db->where($where);
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 12;

        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['pettycash'] = $this->fin->getAllDataCusotmer($config['per_page'], $data['start'], $data['keyword']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminfinacc/index', $data);
        $this->load->view('templates/footer');
    }
   
}
