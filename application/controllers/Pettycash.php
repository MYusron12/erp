<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pettycash extends CI_Controller {

 public function __construct()
      {
           parent::__construct();
           check_login();
      }


public function index ()

{

    // menghapus data session di keyword
   $this->session->unset_userdata('keyword');

   $data['title'] = "Petty-cash";
   $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

      // load library

       $this->load->library('pagination');

       if ($this->input->post('submit')) {
         $data['keyword'] = $this->input->post('keyword');
         $this->session->set_userdata('keyword', $data['keyword']);
       } else {
         $data['keyword'] = $this->session->userdata('keyword');
       }

      $base  = "http://" . $_SERVER['HTTP_HOST'];
      $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
      $config['base_url'] = $base ."pettycash/index";


      //$config['base_url'] = 'http://localhost/dc-finance/pettycash/index';

      $params['conditions'] = [
       'status' => 0
      ];

       $this->db->group_start();
       $this->db->like('pemohon', $data['keyword']);
       $this->db->or_like('nama', $data['keyword']);
       $this->db->or_like('no_bs', $data['keyword']);
       $this->db->or_like('no_kas_bank', $data['keyword']);
       $this->db->group_end();


       $this->db->from('transaksi_department');
       $this->db->join('departement', 'transaksi_department.id_department = departement.id_departement');
       $where = $params['conditions'];
       $this->db->where($where);
       $config['total_rows'] = $this->db->count_all_results();
       $data['total_rows'] = $config['total_rows'];
       $config['per_page'] = 12;



         // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        
        $this->load->model('Pettycash_model', 'pettycash');


        $data['pettycash'] = $this->pettycash->getDataPettycash($config['per_page'],$data['start'], $data['keyword']);

     
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petty-cash/index', $data);
        $this->load->view('templates/footer');

}


public function create()

{
   $data['title'] = "Create Form";
   $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Pettycash_model', 'pettycash');
        $data['bsno'] = $this->pettycash->generateBsNo();
        $data['bcno'] = $this->pettycash->generateBcNo();
        $data['department'] = $this->db->get('departement')->result_array();

        $this->form_validation->set_rules('department_id', 'Department', 'required');
        $this->form_validation->set_rules('applicant', 'Aplicant Name', 'required');
        $this->form_validation->set_rules('typetransaction', 'Type Of Transaction', 'required');
        $this->form_validation->set_rules('credit', 'Credit', 'required');

         if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('petty-cash/create', $data);
            $this->load->view('templates/footer');
         } else {
            $date = date("Y-m-d H:i:s");
            $credit = $this->input->post('credit');
            $simpan = str_replace(['.',','],['','.'], $credit);

            $data =[
            'no_bs' => $this->input->post('bsno'),
            'no_kas_bank' => $this->input->post('bankcash'),
            'tanggal' => $date,
            'pemohon' => $this->input->post('applicant'),
            'jenis_transaksi' => $this->input->post('typetransaction'),
            'id_department' => $this->input->post('department_id'),
            'jumlah_awal' => $simpan,

            ];

            // var_dump($data);
            // die;

             $this->db->insert('transaksi_department', $data);
             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             New Create Added!..
             </div>');
             redirect('pettycash');

         }

}



public function cancelpettycash($id)
    {
     
      
      $this->db->delete('transaksi_department', ['id_transaksi_dept' => $id]);
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
       The Pettycash has been canceled!.
         </div>');
      
      redirect('pettycash');

    }













}
