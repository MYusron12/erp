<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    check_login();
  }


  public function index()
  {

    // menghapus data session di keyword
    $this->session->unset_userdata('keyword');

    $data['title'] = "Crud A";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->model('Cruda_model', 'cruda');

    // load library

    $this->load->library('pagination');

    // ambil search

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }


    //config

    $base  = "http://" . $_SERVER['HTTP_HOST'];
    $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    $config['base_url'] = $base . "master/index";
    //$config['base_url'] = 'http://localhost/dc-finance/master/index';


    $this->db->like('nama', $data['keyword']);
    $this->db->or_like('account', $data['keyword']);
    $this->db->from('coa_ec');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 8;




    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $data['cruda'] = $this->cruda->getDataCruda($config['per_page'], $data['start'], $data['keyword']);
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('master/index', $data);
    $this->load->view('templates/footer');
  }


  public function crudatambah()
  {

    $this->form_validation->set_rules('accountno', 'account', 'required');

    if ($this->form_validation->run() == false) {
      $this->index();
    } else {
      $account = $this->input->post('accountno');
      $sql = $this->db->get_where('coa_ec', ['account' => $account]);
      $cek = $sql->row_array();


      if ($cek['account'] == $account) {


        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         Warning!!!...The account <b>' . $account . '</b> have been entered in database already!
         </div>');

        redirect('master');
      } else {

        $data = [

          'account' => $this->input->post('accountno'),
          'nama' => $this->input->post('name'),
          'id_user' => $this->session->userdata('iduser')


        ];

        $this->db->insert('coa_ec', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         New Account Number Added
         </div>');

        $this->session->unset_userdata('keyword');
        redirect('master');
      }
    }
  }


  public function getchangedcruda()
  {
    $id = $this->input->post('id');

    $this->load->model('Cruda_model', 'cruda');

    echo json_encode($data['cruda'] = $this->cruda->getchangeCrudaById($id));
  }

  public function getchangingcruda()
  {
    $id = $this->input->post('id');
    $accountno = $this->input->post('accountno');
    $name = $this->input->post('name');
    $iduser = $this->session->userdata('id');


    if ($id > 0) {

      $data = [

        'account' => $accountno,
        'nama' => $name,
        'id_user' => $this->session->userdata('iduser')


      ];

      $this->db->where('id_coa_ec', $id);
      $this->db->update('coa_ec', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         The account success to be changed!.
         </div>');
      redirect('master');
    } else {

      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         The account fail to be changed!.
         </div>');
      redirect('master');
    }
  }

  public function deletecruda($id)
  {
    $this->db->delete('coa_ec', ['id_coa_ec' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
       The account has been deleted!.
         </div>');
    redirect('master');
  }


  public function crudb()
  {


    // menghapus data session di keyword
    $this->session->unset_userdata('keyword');

    $data['title'] = "Crud B";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();



    $this->load->model('Crudb_model', 'crudb');

    // load library

    $this->load->library('pagination');

    // ambil search

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }


    //config

    $base  = "http://" . $_SERVER['HTTP_HOST'];
    $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    $config['base_url'] = $base . "master/crudb";
    //$config['base_url'] = 'http://localhost/dc-finance/master/index';




    $this->db->like('nama', $data['keyword']);
    $this->db->or_like('account', $data['keyword']);
    $this->db->from('coa_na');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 8;




    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $data['crudb'] = $this->crudb->getDataCrudb($config['per_page'], $data['start'], $data['keyword']);


    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('master/crudb', $data);
    $this->load->view('templates/footer');
  }


  public function crudbtambah()
  {
    $this->form_validation->set_rules('accountno', 'Account Number', 'required');
    $this->form_validation->set_rules('name', 'Name', 'required');

    if ($this->form_validation->run() == false) {

      $this->crudb();
    } else {

      $account = $this->input->post('accountno');
      $sql = $this->db->get_where('coa_na', ['account' => $account]);
      $cek = $sql->row_array();


      if ($cek['account'] == $account) {


        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         Warning!!!...The account <b>' . $account . '</b> have been entered in database already!
         </div>');

        redirect('master/crudb');
      } else {

        $data = [

          'account' => $this->input->post('accountno'),
          'nama' => $this->input->post('name')


        ];

        $this->db->insert('coa_na', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         New Account Number Added
         </div>');
        $this->session->unset_userdata('keyword');
        redirect('master/crudb');
      }
    }
  }


  public function getchangedcrudb()
  {
    $id = $this->input->post('id');

    $this->load->model('Crudb_model', 'crudb');

    echo json_encode($data['crudb'] = $this->crudb->getchangeCrudbById($id));
  }


  public function getchangingcrudb()
  {
    $id = $this->input->post('id');
    $accountno = $this->input->post('accountno');
    $name = $this->input->post('name');

    if ($id > 0) {

      $data = [

        'account' => $accountno,
        'nama' => $name

      ];

      $this->db->where('id_coa_na', $id);
      $this->db->update('coa_na', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         The account success to be changed!.
         </div>');
      redirect('master/crudb');
    } else {

      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         The account fail to be changed!.
         </div>');
      redirect('master/crudb');
    }
  }


  public function deletecrudb($id)
  {
    $this->db->delete('coa_na', ['id_coa_na' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
       The account has been deleted!.
         </div>');
    redirect('master/crudb');
  }


  public function crudc()
  {

    $this->session->unset_userdata('keyword');

    $data['title'] = "Crud C";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->model('Crudc_model', 'crudc');



    $this->load->library('pagination');

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {

      $data['keyword'] = $this->session->userdata('keyword');
    }


    $base  = "http://" . $_SERVER['HTTP_HOST'];
    $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    $config['base_url'] = $base . "crudc/index";
    //$config['base_url'] = 'http://localhost/dc-finance/master/crudc/index';

    $this->db->like('nama', $data['keyword']);
    $this->db->or_like('account', $data['keyword']);
    $this->db->from('coa_tb');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 8;


    $this->pagination->initialize($config);


    $data['start'] = $this->uri->segment(3);
    $data['crudc'] = $this->crudc->getDataCrudc($config['per_page'], $data['start'], $data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('master/crudc', $data);
    $this->load->view('templates/footer');
  }


  public function crudctambah()
  {

    $this->form_validation->set_rules('accountno', 'Account Number', 'required');
    $this->form_validation->set_rules('name', 'Name', 'required');

    if ($this->form_validation->run() == false) {

      $this->crudc();
    } else {

      $account = $this->input->post('accountno');
      $sql = $this->db->get_where('coa_tb', ['account' => $account]);
      $cek = $sql->row_array();


      if ($cek['account'] == $account) {


        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Warning!!!...The account <b>' . $account . '</b> have been entered in database already!
          </div>');

        redirect('master/crudc');
      } else {

        $data = [

          'account' => $this->input->post('accountno'),
          'nama' => $this->input->post('name')


        ];

        $this->db->insert('coa_tb', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          New Account Number Added
          </div>');
        $this->session->unset_userdata('keyword');
        redirect('master/crudc');
      }
    }
  }


  public function getchangedcrudc()
  {
    $id = $this->input->post('id');

    $this->load->model('Crudc_model', 'crudc');

    echo json_encode($data['crudc'] = $this->crudc->getchangeCrudcById($id));
  }


  public function getchangingcrudc()
  {
    $id = $this->input->post('id');
    $accountno = $this->input->post('accountno');
    $name = $this->input->post('name');

    if ($id > 0) {

      $data = [

        'account' => $accountno,
        'nama' => $name

      ];

      $this->db->where('id_coa_tb', $id);
      $this->db->update('coa_tb', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         The account success to be changed!.
         </div>');
      redirect('master/crudc');
    } else {

      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         The account fail to be changed!.
         </div>');
      redirect('master/crudc');
    }
  }


  public function deletecrudc($id)
  {
    $this->db->delete('coa_tb', ['id_coa_tb' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
       The account has been deleted!.
         </div>');
    redirect('master/crudc');
  }

  public function lokasi()
  {

    $this->session->unset_userdata('keyword');

    $data['title'] = "Lokasi";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->model('Lokasi_model', 'lokasi');

    //    // pagination

    $this->load->library('pagination');

    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword');
    } else {

      $data['keyword'] = $this->session->userdata('keyword');
    }


    $base  = "http://" . $_SERVER['HTTP_HOST'];
    $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    $config['base_url'] = $base . "master/lokasi";
    //$config['base_url'] = 'http://localhost/dc-finance/master/department/index';

    $this->db->like('nama', $data['keyword']);
    $this->db->or_like('kode_loc', $data['keyword']);
    $this->db->from('departement');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 8;


    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $data['lokasi'] = $this->lokasi->getDataLokasi($config['per_page'], $data['start'], $data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('master/lokasi', $data);
    $this->load->view('templates/footer');
  }

  public function lokasitambah()
  {
    $this->form_validation->set_rules('accountno', 'Account No', 'required');
    $this->form_validation->set_rules('name', 'Name', 'required');

    if ($this->form_validation->run() == false) {

      $this->lokasi();
    } else {

      $account = $this->input->post('accountno');
      $sql = $this->db->get_where('departement', ['kode_loc' => $account]);
      $cek = $sql->row_array();

      if ($cek['kode_loc'] == $account) {

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             Warning!!!...Lokasi ini  <b>' . $account . '</b> Sudah ada didatabase!
             </div>');

        redirect('master/lokasi');
      } else {

        $data = [

          'kode_loc' => $this->input->post('accountno', TRUE),
          'nama' => $this->input->post('name', TRUE),
          'pinjem' => $this->input->post('credit', TRUE),
          'realisasi' => $this->input->post('realization', TRUE),
          'saldo' => $this->input->post('balance', TRUE)

        ];

        $this->db->insert('departement', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Lokasi Sudah Ditambahkan
             </div>');
        $this->session->unset_userdata('keyword');
        redirect('master/lokasi');
      }
    }
  }


  public function getchangedlokasi()
  {
    $id = $this->input->post('id');

    $this->load->model('Lokasi_model', 'lokasi');

    echo json_encode($data['department'] = $this->lokasi->getchangeLokasiById($id));
  }


  public function getchanginglokasi()
  {
    $id = $this->input->post('id');
    $accountno = $this->input->post('accountno');
    $name = $this->input->post('name');

    if ($id > 0) {

      $data = [

        'kode_loc' => $accountno,
        'nama' => $name

      ];

      $this->db->where('id_departement', $id);
      $this->db->update('departement', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         The account success to be changed!.
         </div>');
      redirect('master/lokasi');
    } else {

      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         The account fail to be changed!.
         </div>');
      redirect('master/lokasi');
    }
  }


  public function deletelokasi($id)

  {
    $this->db->delete('departement', ['id_departement' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
       Lokasi ini sudah Dihapus!.
         </div>');
    redirect('master/lokasi');
  }


  public function moneydetails($id)
  {
    $data['title'] = "Money Details";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['dc'] = $this->db->get_where('departement', ['id_departement' => $id])->row_array();

    $iddepartment = $this->uri->segment(3);

    $this->db->where('department_id', $iddepartment);
    $data['money'] = $this->db->get('validasi')->result_array();


    $this->form_validation->set_rules('pieces', 'Pieces', 'required');
    $this->form_validation->set_rules('bills', 'Bills', 'required');


    if ($this->form_validation->run() == false) {

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('master/moneydetails', $data);
      $this->load->view('templates/footer');
    } else {

      $pieces = $this->input->post('pieces');
      $bills =  str_replace(['.', ','], ['', '.'], $this->input->post('bills'));
      $id = $this->input->post('iddepartment');


      $jumlah = $pieces * $bills;

      $data = [

        'department_id' => $id,
        'jumlah' => $pieces,
        'pecahan' => $bills

      ];


      $this->db->insert('validasi', $data);


      // $validasi = $this->db->get_where('validasi', ['department_id' => $id])->result();
      //  $total = 0;
      //  foreach ($validasi as $value) {
      //    $total = $total + $value->jumlah*$value->pecahan;
      //  }

      //   $cashonhand = ['cashonhand' => $total];
      //   $this->db->set($cashonhand);
      //   $this->db->where('id_departement', $iddept);
      //   $this->db->update('departement');

      // $this->db->where('department_id', $id);
      // $uang = $this->db->get('validasi')->result();

      // $sum = 0;
      // foreach ($uang as $val) {
      //   $sum = $sum + $val->jumlah*$val->pecahan;
      // }

      //  $dept = $this->db->get_where('departement', ['id_departement' => $id]);
      //  $cek = $dept->row();



      //  if ($cek->saldo1 && $cek->cashonhand  == 0) {
      //    $this->db->set('saldo1', $sum);
      //    $this->db->set('cashonhand', $sum);
      //    $this->db->where('id_departement', $id);
      //    $this->db->update('departement');
      //  } else {

      //     $this->db->set('cashonhand ', 'cashonhand'+ $sum);
      //     $this->db->where('id_departement', $id);
      //     $this->db->update('departement');
      //  }

      // $this->db->set('cashonhand ', 'cashonhand+'.$jumlah,false);
      // $this->db->where('id_departement', $id);
      // $this->db->update('departement');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
     New bills Added
     </div>');
      redirect("master/moneydetails/$id");
    }
  }


  function getchangedmoney()
  {

    $id = $this->input->post('id');
    $this->load->model('Department_model', 'department');
    echo json_encode($data['validasi'] = $this->department->getchangeMoneyById($id));
  }



  public function getchangingmoney()
  {

    $id = $this->input->post('idvalidasi');
    $pieces = $this->input->post('pieces');
    $bills = str_replace(['.', ','], ['', '.'], $this->input->post('bills'));
    $iddept = $this->input->post('iddepartment');

    $querydepartement = $this->db->get_where('departement', ['id_departement' => $iddept])->row();
    $plafon = $querydepartement->saldo1;


    if ($id > 0) {

      $data = [

        'jumlah' => $pieces,
        'pecahan' => $bills

      ];

      $this->db->where('id_validasi', $id);
      $this->db->update('validasi', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         The Bills success to be changed!.
         </div>');
      redirect("master/moneydetails/$iddept");
    } else {

      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         The bills fail to be changed!.
         </div>');
      redirect("master/moneydetails/$iddept");
    }
  }


  public function deletemoneybills()
  {

    $idvalidasi = $this->input->post('idvalidasi');
    $iddept = $this->input->post('iddept');
    // $this->db->delete('validasi', ['id_validasi' =>  $idvalidasi]);

    $data = [

      'id_validasi' => $idvalidasi,
      'department_id' => $iddept
    ];


    $result = $this->db->get_where('validasi', $data);

    if ($result->num_rows() > 0) {
      $this->db->delete('validasi', $data);
    }


    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The bills have been deleted..</div>');
  }


  public function supplier()
  {
    $data['title'] = "Supplier";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->model('Supplier_model', 'supplier');

    $data['supplier'] = $this->db->get('suplier')->result_array();
    $data['kodesuplier'] = $this->supplier->getSupplierCode();

    $this->form_validation->set_rules('suplier', 'Supplier', 'required');
    $this->form_validation->set_rules('bank', 'Bank', 'required');
    $this->form_validation->set_rules('account', 'Account', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('branch', 'Branch', 'required');

    if ($this->form_validation->run() == false) {

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('master/supplier', $data);
      $this->load->view('templates/footer');
    } else {

      $this->supplier->simpanSupplier();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Sudah Di Tambahkan!..</div>');
      redirect('master/supplier');
    }
  }

  public function getchangedsuplier()
  {
    $id = $this->input->post('id');

    $this->load->model('Supplier_model', 'supplier');

    echo json_encode($data['supplier'] = $this->supplier->getchangeSupplierById($id));
  }

  public function getchangingsuplier()
  {
    $this->load->model('Supplier_model', 'supplier');
    $this->supplier->getUpdateSuplier();
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Sudah Diganti!..</div>');
    redirect('master/supplier');
  }


  public function hapussuplier($id)
  {
    $this->load->model('Supplier_model', 'supplier');
    $this->supplier->getHapusSuplier($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The supplier have been Deleted..</div>');
    redirect('master/supplier');
  }



  public function department()
  {

    $data['title'] = "Department";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['bagian'] = $this->db->get('bagian')->result();

    $this->form_validation->set_rules('kodebagian', 'Kode Bagian', 'required');
    $this->form_validation->set_rules('namabagian', 'Nama Bagian', 'required');
    $this->form_validation->set_rules('kepalabagian', 'Kepala bagian', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('master/department', $data);
      $this->load->view('templates/footer');
    } else {

      $kodebagian = $this->input->post('kodebagian', TRUE);
      $namabagian = $this->input->post('namabagian', TRUE);
      $kepalabagian = $this->input->post('kepalabagian', TRUE);

      $bagian = $this->db->get_where('bagian', ['kode_bagian' => $kodebagian]);
      $cek = $bagian->num_rows();

      if ($cek > 0) {

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
         Warning!!!... Kode Bagian <b>' . $kodebagian . '</b> Sudah Ada Di Database!
         </div>');

        redirect('master/department');
      } else {

        $data = [
          'kode_bagian' => $kodebagian,
          'nama_bagian' => $namabagian,
          'kepala_bagian' => $kepalabagian,
          'id_user' => $this->session->userdata('iduser')
        ];

        $this->db->insert('bagian', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Data Sudah Disimpan!.
         </div>');

        redirect('master/department');
      }
    }
  }

  public function getubahdepartment()
  {
    $id = $this->input->post('id', TRUE);
    $data = $this->db->get_where('bagian', ['idbagian' => $id])->row_array();
    echo json_encode($data);
  }

  public function ubahdepartment()
  {
    $kodebagian = $this->input->post('kodebagian', TRUE);
    $namabagian = $this->input->post('namabagian', TRUE);
    $kepalabagian = $this->input->post('kepalabagian', TRUE);
    $idbagian = $this->input->post('idbagian', TRUE);

    $data = [
      'kode_bagian' => $kodebagian,
      'nama_bagian' => $namabagian,
      'kepala_bagian' => $kepalabagian,
      'id_user' => $this->session->userdata('iduser')
    ];

    $this->db->set($data);
    $this->db->where('idbagian', $idbagian);
    $this->db->update('bagian');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Data Sudah Dirubah!.
         </div>');
    redirect('master/department');
  }

  public function hapusdepartment($id)
  {
    $this->db->where('idbagian', $id);
    $this->db->delete('bagian');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Data Sudah Dihapus!.
         </div>');
    redirect('master/department');
  }
}
