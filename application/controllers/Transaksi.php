<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
    }

    public function index() {

        // menghapus data session di keyword
        $this->session->unset_userdata('keyword');

        $data['title'] = "Pengajuan Kasbon Sementara";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // load library

        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $base = "http://" . $_SERVER['HTTP_HOST'];
        $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $config['base_url'] = $base . "transaksi/index";
        //$config['base_url'] = 'http://localhost/dc-finance/pettycash/index';

        $params['conditions'] = [
            'status' => 1,
            'hub' => $this->session->userdata('hub')
        ];

        $this->db->group_start();
        $this->db->like('pemohon', $data['keyword']);
        $this->db->or_like('nama_bagian', $data['keyword']);
        $this->db->or_like('no_bs', $data['keyword']);
        $this->db->or_like('no_kas_bank', $data['keyword']);
        $this->db->group_end();


        $this->db->from('transaksi_department');
        $this->db->join('bagian', 'transaksi_department.idbagian = bagian.idbagian');
        $where = $params['conditions'];
        $this->db->where($where);
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 12;




        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $this->load->model('Pettycash_model', 'pettycash');


        $data['pettycash'] = $this->pettycash->getDataPettycash($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = "Create Form";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Pettycash_model', 'pettycash');
        $data['bsno'] = $this->pettycash->generateBsNo();

        $data['bagian'] = $this->db->get('bagian')->result_array();

        //$this->db->where('id_departement', $this->session->userdata('hub'));
        //$data['lokasi'] = $this->db->get('departement')->result_array();

        $this->form_validation->set_rules('bagian', 'Bagian', 'required');
        $this->form_validation->set_rules('applicant', 'Aplicant Name', 'required');
        $this->form_validation->set_rules('typetransaction', 'Type Of Transaction', 'required');
        $this->form_validation->set_rules('credit', 'Credit', 'required');
        //$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        // $this->form_validation->set_rules('approvaldate', 'Tgl Persetujuan', 'required');
        // $this->form_validation->set_rules('approvedby', 'Disetujui Oleh', 'required');
        // $this->form_validation->set_rules('receivedby', 'Diterima Oleh', 'required');
        // $this->form_validation->set_rules('receivingdate', 'Tgl Terima', 'required');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/create', $data);
            $this->load->view('templates/footer');
        } else {

            date_default_timezone_set('Asia/Jakarta');

            $date = date("Y-m-d H:i:s");
            $credit = $this->input->post('credit');
            $simpan = str_replace(['.', ','], ['', '.'], $credit);

            $data = [
                'no_bs' => $this->input->post('bsno', TRUE),
                'no_kas_bank' => $this->input->post('bankcash', TRUE),
                'tanggal' => $date,
                'pemohon' => $this->input->post('applicant', TRUE),
                'keterangan' => $this->input->post('typetransaction', TRUE),
                'id_dept' => $this->session->userdata('hub'),
                'idbagian' => $this->input->post('bagian', TRUE),
                'jmlajuan' => $simpan,
                // 'tgl_setuju' => date('Y-m-d', strtotime($this->input->post('receivingdate', TRUE))),
                // 'disetujui' => $this->input->post('approvedby', TRUE),
                // 'penerima' => $this->input->post('receivedby', TRUE),
                // 'tgl_terima' => date('Y-m-d', strtotime($this->input->post('receivingdate', TRUE))),
                'tgl_buat' => date('Y-m-d H:i:s'),
                'status' => 1,
                'id_user' => $this->session->userdata('iduser'),
                'hub' => $this->session->userdata('hub'),
                'created_by'=> $this->session->userdata('iduser'),
                'created_at'=> date("Y-m-d h:i:sa")
            ];
            try {
                $this->db->insert('transaksi_department', $data);
                $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='BS' and status=0");
                $this->db->trans_commit();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             New Create Added!..
             </div>');
                redirect('transaksi');
            } catch (Exception $e) {
                $this->db->trans_rollback();
                echo $error = $db->error();
            }
        }
    }

    public function bssementarabatal($id) {
        try {
             $data=[
             'is_deleted' =>1,
             'deleted_at'=>date("Y-m-d h:i:sa"),
             'deleted_by'=>$this->session->userdata('iduser')
            ];
             $this->db->where('id_transaksi_dept', $id);
              $this->db->update('transaksi_department',$data);
            $this->db->trans_commit();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Sudah Di Batalkan. ' . $id . '
          </div>');
            redirect('transaksi');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo $error = $db->error();
        }
    }

    public function editbssementara($id) {

        $data['title'] = "Edit Bs Sementara";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['bagian'] = $this->db->get('bagian')->result_array();

        // $this->db->where('id_departement', $this->session->userdata('hub'));
        // $data['lokasi'] = $this->db->get('departement')->result_array();

        $this->load->model('finance_model', 'pettycash');

        $data['bssementara'] = $this->pettycash->getDataPettycashId($id);

        $this->form_validation->set_rules('bagian', 'Bagian', 'required');
        $this->form_validation->set_rules('applicant', 'Aplicant Name', 'required');
        $this->form_validation->set_rules('typetransaction', 'Type Of Transaction', 'required');
        $this->form_validation->set_rules('credit', 'Credit', 'required');
        //$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('approvaldate', 'Tgl Persetujuan', 'required');
        $this->form_validation->set_rules('approvedby', 'Disetujui Oleh', 'required');
        $this->form_validation->set_rules('receivedby', 'Diterima Oleh', 'required');
        $this->form_validation->set_rules('receivingdate', 'Tgl Terima', 'required');
        $this->form_validation->set_rules('realizationdate', 'Tgl Realisasi', 'required');
        $this->form_validation->set_rules('realization', 'Jumalah Realisasi', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/editbssementara', $data);
            $this->load->view('templates/footer');
        } else {

            $idbssementara = $this->input->post('idbssementara', TRUE);
            $lokasi = $this->session->userdata('hub');
            $bagian = $this->input->post('bagian', TRUE);
            $pemohon = $this->input->post('applicant', TRUE);
            $keterangan = $this->input->post('typetransaction', TRUE);
            $jumlah = str_replace(['.', ','], ['', '.'], $this->input->post('credit', TRUE));
            $tglpersetujuan = date('Y-m-d', strtotime($this->input->post('approvaldate')));
            $disetujui = $this->input->post('approvedby', TRUE);
            $diterima = $this->input->post('receivedby', TRUE);
            $tglterima = date('Y-m-d', strtotime($this->input->post('receivingdate', TRUE)));
            $tglrealisasi = date('Y-m-d', strtotime($this->input->post('realizationdate', TRUE)));
            $realization = $this->input->post('realization', TRUE);
            $balance = str_replace(['.', ','], ['', '.'], $this->input->post('balance', TRUE));
            $bsno = $this->input->post('bsno', TRUE);

            if ($realization == 0) {

                $data = [
                    'id_dept' => $this->session->userdata('hub'),
                    'idbagian' => $bagian,
                    'pemohon' => $pemohon,
                    'keterangan' => $keterangan,
                    'jmlajuan' => $jumlah,
                    'jumlah' => $jumlah,
                    //'jumlah_awal' => $jumlah,
                    'tgl_setuju' => $tglpersetujuan,
                    'disetujui' => $disetujui,
                    'penerima' => $diterima,
                    'tgl_terima' => $tglterima,
                    'tgl_realisasi' => $tglrealisasi,
                    'terpakai' => $realization,
                    'selisih' => $balance,
                    'tgl_edit' => date('Y-m-d'),
                    'status' => 2,
                    'id_user' => $this->session->userdata('iduser'),
                    'updated_by' => $this->session->userdata('iduser'),
                    'updated_at'=> date("Y-m-d h:i:sa")
                ];

                $this->db->query("update departement set 
             pinjem=pinjem+$jumlah 
             where id_departement=$lokasi");
            } else {

                $data = [
                    'id_dept' => $this->session->userdata('hub'),
                    'idbagian' => $bagian,
                    'pemohon' => $pemohon,
                    'keterangan' => $keterangan,
                    'jmlajuan' => $jumlah,
                    'jumlah' => $jumlah,
                    'jumlah_awal' => $jumlah,
                    'tgl_setuju' => $tglpersetujuan,
                    'disetujui' => $disetujui,
                    'penerima' => $diterima,
                    'tgl_terima' => $tglterima,
                    'tgl_realisasi' => $tglrealisasi,
                    'terpakai' => $realization,
                    'selisih' => $balance,
                    'tgl_edit' => date('Y-m-d'),
                    'status' => 3,
                    'id_user' => $this->session->userdata('iduser')
                ];
            }
            try {
                $this->db->where('id_transaksi_dept', $idbssementara);
                $this->db->update('transaksi_department', $data);

                // update realisasi dan saldo di table department

                $this->db->set('realisasi', 'realisasi+' . $realization, false);
                $this->db->set('saldo', 'saldo+' . $balance, false);
                $this->db->where('id_departement', $lokasi);
                $this->db->update('departement');
                $this->db->trans_commit();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
              Sudah Di Edit. ' . $bsno . '
             </div>');
                redirect('transaksi/kaskecil');
            } catch (Exception $e) {
                $this->db->trans_rollback();
                echo $error = $db->error();
            }
        }
    }

    public function kaskecil() {

        $this->session->unset_userdata('keyword');

        $data['title'] = "Kas Kecil";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //load library
        $this->load->library('pagination');


        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $base = "http://" . $_SERVER['HTTP_HOST'];
        $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $config['base_url'] = $base . "transaksi/kaskecil";

        $params['conditions'] = [
            'status' => 1,
            'hub' => $this->session->userdata('hub')
        ];

        $this->db->group_start();
        $this->db->like('pemohon', $data['keyword']);
        $this->db->or_like('nama_bagian', $data['keyword']);
        $this->db->or_like('no_bs', $data['keyword']);
        $this->db->or_like('no_kas_bank', $data['keyword']);
        $this->db->group_end();

        $this->db->from('transaksi_department');
        $this->db->join('bagian', 'transaksi_department.idbagian = bagian.idbagian');
        $where = $params['conditions'];
        $this->db->where($where);
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 12;


        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $this->load->model('Finance_model', 'pettycash');

        $data['pettycash'] = $this->pettycash->getAllDataPettyCash($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/pettycashlist', $data);
        $this->load->view('templates/footer');
    }

    // Public function pettycashprocess($id)
    //  {
    //          $data['title'] = "Petty-cash Process";
    //          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //          $this->load->model('finance_model', 'pettycash');
    //          $data['pettycash'] = $this->pettycash->getDataPettycashId($id);
    //          $data['bagian'] = $this->db->get('bagian')->result_array();
    //           $this->form_validation->set_rules('approvedby', 'Approved By', 'required');
    //           $this->form_validation->set_rules('ammount', 'Ammount', 'required');
    //           $this->form_validation->set_rules('receivedby', 'Received By', 'required');
    //         if ($this->form_validation->run() == false) {
    //             $this->load->view('templates/header', $data);
    //             $this->load->view('templates/sidebar', $data);
    //             $this->load->view('templates/topbar', $data);
    //             $this->load->view('transaksi/pettycashprocess', $data);
    //             $this->load->view('templates/footer');
    //         } else {
    //            $idtransdept = $this->input->post('id_transaksi_dept', TRUE);
    //            $ammount = $this->input->post('ammount', TRUE);
    //            $simpan = str_replace(['.',','],['','.'], $ammount);
    //            $lokasi = $this->input->post('lokasi', TRUE);
    //             $data = [
    //                 'tgl_setuju' => date('Y-m-d', strtotime($this->input->post('approvaldate'))),
    //                 'disetujui' => $this->input->post('approvedby'),
    //                 'jumlah' => $simpan,
    //                 'penerima' => $this->input->post('receivedby'),
    //                 'tgl_terima' => date('Y-m-d', strtotime($this->input->post('receivingdate'))),
    //                 'status' => 2,
    //                 'id_user' => $this->session->userdata('iduser')
    //             ];          
    //             $this->db->where('id_transaksi_dept', $idtransdept);
    //             $this->db->update('transaksi_department', $data);
    //             // cashonhand=cashonhand-$simpan, 
    //             $this->db->query("update departement set 
    //             pinjem=pinjem+$simpan 
    //             where id_departement=$lokasi");
    //           $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //           Finished Processed..
    //          </div>');
    //          redirect('transaksi/pettycashlist');
    //         }
    //         }
    //   public function realization()
    //   {
    //       $this->session->unset_userdata('keyword');
    //       $data['title'] = "Realization";
    //       $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //        $this->load->model('Finance_model', 'finance');
    //         //load library
    //         $this->load->library('pagination');
    //          if ($this->input->post('submit')) {
    //          $data['keyword'] = $this->input->post('keyword');
    //          $this->session->set_userdata('keyword', $data['keyword']);
    //        } else {
    //          $data['keyword'] = $this->session->userdata('keyword');
    //        }
    //         $base  = "http://" . $_SERVER['HTTP_HOST'];
    //         $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    //         $config['base_url'] = $base . "transaksi/realization/index";
    //          $params['conditions'] = [
    //          'status' => 1
    //         ];
    //        $this->db->group_start();
    //        $this->db->like('pemohon', $data['keyword']);
    //        $this->db->or_like('nama_bagian', $data['keyword']);
    //        $this->db->or_like('no_bs', $data['keyword']);
    //        $this->db->or_like('no_kas_bank', $data['keyword']);
    //        $this->db->group_end();
    //         $this->db->select('transaksi_department.*, bagian.nama_bagian');
    //         $this->db->from('transaksi_department');
    //         $this->db->join('bagian', 'transaksi_department.idbagian = bagian.idbagian');
    //         $where = $params['conditions'];
    //         $this->db->where($where);
    //         $config['total_rows'] = $this->db->count_all_results();
    //         $data['total_rows'] = $config['total_rows'];
    //         $config['per_page'] = 12;
    //          // initialize
    //         $this->pagination->initialize($config);
    //         $data['start'] = $this->uri->segment(4);
    //         $data['realization'] = $this->finance->getDataRealization($config['per_page'],$data['start'], $data['keyword']);
    //          $this->form_validation->set_rules('realization', 'Realization', 'required');
    //         if ($this->form_validation->run() == false) {
    //          $this->load->view('templates/header', $data);
    //          $this->load->view('templates/sidebar', $data);
    //          $this->load->view('templates/topbar', $data);
    //          $this->load->view('transaksi/realization', $data);
    //          $this->load->view('templates/footer');
    //         } else {
    //           $idtransdept = $this->input->post('idtransaksidept');
    //           $date = date('Y-m-d', strtotime($this->input->post('realizationdate')));
    //           $credittotal = str_replace(['.',','],['','.'], $this->input->post('credittotal'));
    //           $realization = $this->input->post('realization');
    //           $balance = $this->input->post('balance');
    //           $realization1 = str_replace(['.',','],['','.'], $realization);
    //           $balance1 = str_replace(['.',','],['','.'], $balance);
    //           $lokasi = $this->input->post('lokasi');
    //           $data = [
    //           'tgl_realisasi' => $date,
    //            'jumlah_awal' =>  $credittotal,
    //           'terpakai' =>  $realization1,
    //           'selisih' => $balance1,
    //           'status' => 3,
    //           'id_user' => $this->session->userdata('iduser')
    //           ];
    //             $this->db->where('id_transaksi_dept', $idtransdept);
    //             $this->db->update('transaksi_department', $data);
    //             // $this->db->query("update departement set realisasi=realisasi+$realization1, saldo=saldo+$balance1
    //             // where id_departement = $lokasi");
    //             // $this->db->query("update departement set keluaruang=keluaruang-$realization1
    //             // where id_departement = $lokasi");
    //            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //            The Realization have been proccesed..
    //            </div>');
    //            redirect('transaksi/realization');
    //         } 
    //   }
    // public function realizationstatus()
    // {
    //   $data['title'] = "Status Bon Sementara";
    //    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //      $this->load->model('Finance_model', 'finance');
    //       //load library
    //      $this->load->library('pagination');
    //      if ($this->input->post('submit')) {
    //        $data['keyword'] = $this->input->post('keyword');
    //        $this->session->set_userdata('keyword', $data['keyword']);
    //      } else {
    //        $data['keyword'] = $this->session->userdata('keyword');
    //      }
    //      $base  = "http://" . $_SERVER['HTTP_HOST'];
    //      $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    //      $config['base_url'] = $base ."transaksi/realizationstatus/index";
    //       $params['conditions'] = [
    //        'status' => 2
    //      ];
    //     $this->db->group_start();
    //     $this->db->like('pemohon', $data['keyword']);
    //     $this->db->or_like('nama_bagian', $data['keyword']);
    //     $this->db->or_like('no_bs', $data['keyword']);
    //     $this->db->or_like('no_kas_bank', $data['keyword']);
    //     $this->db->group_end();
    //     $this->db->from('transaksi_department');
    //     $this->db->join('bagian', 'transaksi_department.idbagian = bagian.idbagian');
    //     $params['conditions'] = ['status >=' => 1 ];  
    //     $where = $params['conditions'];
    //     $this->db->where($where);
    //     $config['total_rows'] = $this->db->count_all_results();
    //     $data['total_rows'] = $config['total_rows'];
    //     $config['per_page'] = 12;
    //       // initialize
    //      $this->pagination->initialize($config);
    //      $data['start'] = $this->uri->segment(4);
    //       $data['realizationstatus'] = $this->finance->getDataRealizationStatus($config['per_page'],$data['start'], $data['keyword']);
    //          $this->load->view('templates/header', $data);
    //          $this->load->view('templates/sidebar', $data);
    //          $this->load->view('templates/topbar', $data);
    //          $this->load->view('transaksi/realizationstatus', $data);
    //          $this->load->view('templates/footer');
    //          $this->session->unset_userdata('keyword');
    // }


    public function getchangedRealization() {
        $id = $this->input->post('id');

        $this->load->model('Finance_model', 'finance');

        echo json_encode($data['finance'] = $this->finance->getchangeRealizationById($id));
    }

    public function kasrupiah() {
        $data['title'] = "Kas Rupiah";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Finance_model', 'finance');

        $data['transHead'] = $this->finance->getAllDataTransHeader();


        // --------- Batal Mengurangi kasbank dan mengembalikan status 
        // $id = 217;
        // $bs = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
        // $nobs = unserialize($bs->id_transaksi_dept);
        // $total = $bs->total;
        // $nokasbank = $bs->cashbankno;
        // $countbs = count($nobs);
        // $jmlkasbank = $total/$countbs;
        // $this->db->set('nkasbank', 'nkasbank-'.$jmlkasbank,false);
        // $this->db->where_in('id_transaksi_dept', $nobs);
        // $this->db->update('transaksi_department');
        // $this->db->where_in('id_transaksi_dept', $nobs);
        // $databs = $this->db->get('transaksi_department')->result();
        // foreach ($databs as $value) {
        //   $nkasbank = $value->nkasbank;
        //   $no_kas_bank = explode(',', $value->no_kas_bank);
        //   // menghapus array 
        //   $arr = array_diff($no_kas_bank, array($nokasbank));
        //   $implode = implode(',', $arr);
        //   $this->db->set('no_kas_bank', $implode);
        //   $this->db->where_in('id_transaksi_dept', $value->id_transaksi_dept);
        //   $this->db->update('transaksi_department');
        //   if ($nkasbank == 0) {
        //      $update = ['status' => 3];
        //   $this->db->set($update);
        //   $this->db->where_in('id_transaksi_dept', $value->id_transaksi_dept);
        //   $this->db->update('transaksi_department');
        //    }
        // }
        // $hpskasbank = ['no_kas_bank' => '', 'status' => 3];
        // $this->db->set($hpskasbank);
        // $this->db->where_in('id_transaksi_dept', $nobs);
        // $this->db->update('transaksi_department');
        // -------------------------------


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/kasrupiah', $data);
        $this->load->view('templates/footer');
    }

    public function kasrupiahtambah() {
        $data['title'] = "Kas Bank Rupiah";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');

        $data['suplier'] = $this->finance->getDataSuplier();

        //$this->db->where('status', 2);
        //$data['bsno'] = $this->db->get('transaksi_department')->result_array();

        $this->db->where('id_departement', $this->session->userdata('hub'));
        $data['loc'] = $this->db->get('departement')->result_array();
        $data['ec'] = $this->db->get('coa_ec')->result_array();
        $data['na'] = $this->db->get('coa_na')->result_array();
        $data['tb'] = $this->db->get('coa_tb')->result_array();

        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%']];

        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];



        $this->form_validation->set_rules('cashbankno', 'No Cash / Bank', 'required');
        $this->form_validation->set_rules('ecinput[]', 'EC', 'required');
        $this->form_validation->set_rules('nainput[]', 'NA', 'required');
        $this->form_validation->set_rules('tbinput[]', 'TB', 'required');
        //$this->form_validation->set_rules('nomorbs[]', 'Nomor Bs', 'required');
        // -------Simulasi tambahn no kasbank --------------------
        // $this->db->select('*');
        // $this->db->where('id_transaksi', 354);
        // $this->db->like('keterangan', '%');
        // $data = $this->db->get('transaksi_detail')->result();
        // var_dump($data);
        // die;
        // $nobarukasbank = ['KK-00000001'];
        // $idbs = ['142'];
        // $totalbskasbank = "1000000";
        // //$jmlterpakai = "2000000"; 
        // $this->db->where_in('id_transaksi_dept', $idbs);
        // $databs = $this->db->get('transaksi_department')->result();
        // $countbs= count($idbs);
        // foreach ($databs as $value) {
        //   $nokasbank = $value->no_kas_bank;
        //   if ($nokasbank == null) {
        //    $implode = implode(',', $nobarukasbank );
        //    $update = ['no_kas_bank' => $implode];
        //    $this->db->where_in('id_transaksi_dept', $idbs);
        //    $this->db->update('transaksi_department', $update);
        //    var_dump($implode);
        //   } else {
        //     $eplode = explode(",", $value->no_kas_bank);
        //     $tambaharray = array_merge($eplode,  $nobarukasbank );
        //     $implode = implode(",", $tambaharray);
        //     $update = ['no_kas_bank' => $implode];
        //     $this->db->where_in('id_transaksi_dept', $idbs);
        //     $this->db->update('transaksi_department', $update);
        //     var_dump($implode);   
        //   }
        // } 
        //   if ($terpakai == $nilaikas ) {
        //      $nkasbank = ['nkasbank' => 'nkasbank+'.$totalbskasbank/$countbs,false];
        //   } else {
        //      $nkasbank = ['nkasbank' => 'nkasbank+'.$totalbskasbank/$countbs,false];
        //   }
        //        //update field=field+1 with varibale 
        //    //$this->db->set('nkasbank','nkasbank+'.$totalbskasbank,false); // cara hard
        //    $this->db->set($nkasbank);
        //    $this->db->where_in('id_transaksi_dept', $idbs);
        //    $this->db->update('transaksi_department');
        //  var_dump($nilaikas);
        //  die;
        // ------------------------------------------------------------
        // $this->db->where('id_transaksi', 268);
        // $data = $this->db->get('transaksi_detail')->result();
        // $result = [];
        // $d = [];
        // foreach ($data as $key => $value) {
        //  $result[] = [
        //   'id_transaksi' => $value->id_transaksi,
        //   'nominal' => $value->nominal,
        //   'ppn' => $value->ppn,
        //   'pph' => $value->pph,
        //   'keterangan' => $value->keterangan
        //  ];
        //  if ($value->pph > 0) {
        //    $d[] = [
        //    'id_transaksi' => $value->id_transaksi,
        //    'jenis' => $value->jenis,
        //    'loc_iddept' => $value->loc_iddept,
        //    'loc' => $value->loc,
        //    'coa_ec_account' => '000',
        //    'coa_na_account' => '5141',
        //    'coa_tb_account' => '10',  
        //    'nominal' => '-'.$value->nominal*$value->pph/100,
        //    'keterangan' => $value->pph .'%' .' '. $value->keterangan
        //    ];
        //    if ($value->ppn <> 0) {
        //       $d[] = [
        //      'id_transaksi' => $value->id_transaksi,
        //      'jenis' => $value->jenis,
        //      'loc_iddept' => $value->loc_iddept,
        //      'loc' => $value->loc,
        //      'coa_ec_account' => '000',
        //      'coa_na_account' => '3834',
        //      'coa_tb_account' => '10',
        //      'nominal' => $value->nominal*$value->ppn/100,
        //      'keterangan' => $value->ppn .'%' .' '. $value->keterangan
        //      ];
        //    }   
        //  } 
        // }
        // $this->db->insert_batch('transaksi_detail', $d);
        // var_dump($d); 
        // die;
        // foreach ($data as $key => $val) {
        //  $result[] = [
        //  'id_transaksi_detail' => string '410' (length=3)
        //  'id_transaksi' => string '268' (length=3)
        //  'jenis' => string 'KK' (length=2)
        //  'loc_iddept' => string '4' (length=1)
        //  'loc' => string '094' (length=3)
        //  'id_coa_ec' => string '7' (length=1)
        //  'id_coa_na' => string '10' (length=2)
        //  'id_coa_tb' => string '2' (length=1)
        //  'nominal' => string '500000.00' (length=9)
        //  'ppn' => string '0' (length=1)
        //  'pph' => string '2' (length=1)
        //  'coa_ec_account' => string '110' (length=3)
        //  'coa_na_account' => string '11' (length=2)
        //  'coa_tb_account' => string '555' (length=3)
        //  'coa_ec_nama' => string 'Director' (length=8)
        //  'coa_na_nama' => string 'Incentive Magang' (length=16)
        //  'coa_tb_nama' => string 'ggg' (length=3)
        //  'tanggal_kas_bon' => string '2020-01-16 00:00:00' (length=19)
        //  'tgl_penerima' => string '0000-00-00 00:00:00' (length=19)
        //  'tgl_penajuan' => string '0000-00-00 00:00:00' (length=19)
        //  'keterangan' => string '' (length=0)
        //  'status' => string '1' (length=1)
        //  'id_user' => string '1' (length=1)   
        //  ];
        // }


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/kasrupiahtambah', $data);
            $this->load->view('templates/footer');
        } else {
            try {
                $this->finance->simpantransaksi();
                  $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='PV' and status=0");
                $this->db->trans_commit();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data have been saved.
         </div>');
                redirect('transaksi/kasrupiah');
            } catch (Exception $e) {
                $this->db->trans_rollback();
                echo $error = $db->error();
            }
        }
    }

    public function kasrupiaheditkk($id) {

        $data['title'] = "Edit Kas Bank";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');

        $data['suplier'] = $this->finance->getDataSuplier();


        $this->db->where('status', 1);
        $data['bspusat'] = $this->db->get('bskantorpusat')->result_array();


        $data['loc'] = $this->db->get('departement')->result_array();
        $data['ec'] = $this->db->get('coa_ec')->result_array();
        $data['na'] = $this->db->get('coa_na')->result_array();
        $data['tb'] = $this->db->get('coa_tb')->result_array();

        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%']];

        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];


        $result = [];
        $transaksi = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();

        $idbs = unserialize($transaksi['id_transaksi_dept']);


        //$this->db->where_in('id_transaksi_dept', $idbs);
        $data['bsno'] = $this->db->get('transaksi_department')->result_array();



        $implodebs = implode(",", $idbs);

        $sql = "SELECT SUM(terpakai) AS terpakai,
                       SUM(terpakai-nkasbank) AS sisabs,
                       SUM(nkasbank) AS nkasbank
                FROM transaksi_department 
                WHERE id_transaksi_dept IN ($implodebs)
         ";

        $data['total'] = $this->db->query($sql)->row();


        $result['trans'] = $transaksi;
        $transitem = $this->db->get_where('transaksi_detail', ['id_transaksi' => $id])->result_array();

        foreach ($transitem as $k => $v) {
            $result['items'][] = $v;
        }

        $data['transaksi'] = $result;


        $this->form_validation->set_rules('cashbankno', 'No Cash / Bank', 'required');
        // $this->form_validation->set_rules('nomorbs[]', 'Nomor Bs', 'required');
        $this->form_validation->set_rules('ecinput[]', 'EC', 'required');
        $this->form_validation->set_rules('nainput[]', 'NA', 'required');
        $this->form_validation->set_rules('tbinput[]', 'TB', 'required');
        $this->form_validation->set_rules('ammount1input[]', 'Jumlah', 'required');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/editkasrupiah', $data);
            $this->load->view('templates/footer');
        } else {
            try {
                $this->finance->updatetransaksi($id);
                $this->db->trans_commit();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data have been Changed.
         </div>');
                redirect('transaksi/kasrupiah');
            } catch (Exception $e) {
                $this->db->trans_rollback();
                echo $error = $db->error();
            }
        }
    }

    public function kasrupiaheditkas($id) {

        $data['title'] = "Edit Kas Bank";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');

        $data['suplier'] = $this->finance->getDataSuplier();


        $this->db->where('status', 1);
        $data['bspusat'] = $this->db->get('bskantorpusat')->result_array();

        $data['loc'] = $this->db->get('departement')->result_array();
        $data['ec'] = $this->db->get('coa_ec')->result_array();
        $data['na'] = $this->db->get('coa_na')->result_array();
        $data['tb'] = $this->db->get('coa_tb')->result_array();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%']];

        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];


        $result = [];
        $transaksi = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();

        $idbs = unserialize($transaksi['id_transaksi_dept']);

        //$this->db->where_in('id_transaksi_dept', $idbs)

        $data['bspusat'] = $this->db->get('bskantorpusat')->result_array();

        if ($idbs) {

            $implodebs = implode(",", $idbs);

            $sql = "SELECT SUM(jumlah) AS jumlah,
                       SUM(jumlah-nkasbank) AS sisabs,
                       SUM(nkasbank) AS nkasbank
                FROM bskantorpusat 
                WHERE idbskantorpusat IN ($implodebs)
         ";

            $data['total'] = $this->db->query($sql)->row_array();
        } else {
            $data['total'] = [
                'jumlah' => 0,
                'sisabs' => 0,
                'nkasbank' => 0
            ];
        }



        $result['trans'] = $transaksi;
        $transitem = $this->db->get_where('transaksi_detail', ['id_transaksi' => $id])->result_array();

        foreach ($transitem as $k => $v) {
            $result['items'][] = $v;
        }

        $data['transaksi'] = $result;


        $this->form_validation->set_rules('cashbankno', 'No Cash / Bank', 'required');
        // $this->form_validation->set_rules('nomorbs[]', 'Nomor Bs', 'required');
        $this->form_validation->set_rules('ecinput[]', 'EC', 'required');
        $this->form_validation->set_rules('nainput[]', 'NA', 'required');
        $this->form_validation->set_rules('tbinput[]', 'TB', 'required');
        $this->form_validation->set_rules('ammount1input[]', 'Jumlah', 'required');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/editkasrupiah1', $data);
            $this->load->view('templates/footer');
        } else {
            try {
                $this->finance->updatetransaksi($id);
                $this->db->trans_commit();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data have been Changed.
         </div>');
                redirect('transaksi/kasrupiah');
            } catch (Exception $e) {
                $this->db->trans_rollback();
                echo $error = $db->error();
            }
        }
    }

    public function kasrupiaheditbank($id) {

        $data['title'] = "Edit Kas Bank";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');

        $data['suplier'] = $this->finance->getDataSuplier();


        $this->db->where('status', 1);
        $data['bspusat'] = $this->db->get('bskantorpusat')->result_array();

        $data['loc'] = $this->db->get('departement')->result_array();
        $data['ec'] = $this->db->get('coa_ec')->result_array();
        $data['na'] = $this->db->get('coa_na')->result_array();
        $data['tb'] = $this->db->get('coa_tb')->result_array();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%']];

        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];


        $result = [];
        $transaksi = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();

        $idbs = unserialize($transaksi['id_transaksi_dept']);

        //$this->db->where_in('id_transaksi_dept', $idbs)

        $data['bspusat'] = $this->db->get('bskantorpusat')->result_array();

        if ($idbs) {

            $implodebs = implode(",", $idbs);

            $sql = "SELECT SUM(jumlah) AS jumlah,
                       SUM(jumlah-nkasbank) AS sisabs,
                       SUM(nkasbank) AS nkasbank
                FROM bskantorpusat 
                WHERE idbskantorpusat IN ($implodebs)
         ";

            $data['total'] = $this->db->query($sql)->row_array();
        } else {
            $data['total'] = [
                'jumlah' => 0,
                'sisabs' => 0,
                'nkasbank' => 0
            ];
        }



        $result['trans'] = $transaksi;
        $transitem = $this->db->get_where('transaksi_detail', ['id_transaksi' => $id])->result_array();

        foreach ($transitem as $k => $v) {
            $result['items'][] = $v;
        }

        $data['transaksi'] = $result;


        $this->form_validation->set_rules('cashbankno', 'No Cash / Bank', 'required');
        // $this->form_validation->set_rules('nomorbs[]', 'Nomor Bs', 'required');
        $this->form_validation->set_rules('ecinput[]', 'EC', 'required');
        $this->form_validation->set_rules('nainput[]', 'NA', 'required');
        $this->form_validation->set_rules('tbinput[]', 'TB', 'required');
        $this->form_validation->set_rules('ammount1input[]', 'Jumlah', 'required');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/editkasrupiah2', $data);
            $this->load->view('templates/footer');
        } else {
            try{
            $this->finance->updatetransaksi($id);
            $this->db->trans_commit();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data have been Changed.
         </div>');
            redirect('transaksi/kasrupiah');     
            } catch (Exception $e) {
        $this->db->trans_rollback();
        echo  $error = $db->error();
            }
           
        }
    }

    public function getbatalkasbank() {

        $id = $this->input->post('id');
        $nokasbank = $this->input->post('nokasbank');
        $total = $this->input->post('total');

        $this->db->where('id_transaksi', $id);
        $data = $this->db->get('transaksi');
        $cekstatus = $data->row()->status;

        $ikhtisardetail = $this->db->get_where('ikhtisar_detail', ['cashbankno' => $nokasbank], ['status >', 0]);
        $idikhtisar = $ikhtisardetail->row()->id_ikhtisar;


        $dtikhtisar = $this->db->get_where('ikhtisar_header', ['id_ikhtisar' => $idikhtisar])->row();
        $noikhtisar = $dtikhtisar->no_ikhtisar;

        if ($cekstatus >= 2) {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No Kasbank : ' . $nokasbank . ' <b>Gagal Dibatalkan!..</b> Mohon Ikhtisar Dibatalkan Terlebih Dahulu No. ' . $noikhtisar . '</div>');
        } else {

            if ($data->num_rows()) {
                try{
                    $this->db->set('status', 0);
                $this->db->set('id_user', $this->session->userdata('iduser'));
                $this->db->where('id_transaksi', $id);
                $this->db->update('transaksi');

                $this->db->set('status', 0);
                $this->db->set('id_user', $this->session->userdata('iduser'));
                $this->db->where('id_transaksi', $id);
                $this->db->update('transaksi_detail');


                $bs = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
                $nobs = unserialize($bs->id_transaksi_dept);
                $total = $bs->total;
                $nokasbank = $bs->cashbankno;

                $countbs = count($nobs);

                $jmlkasbank = $total / $countbs;

                $this->db->set('nkasbank', 'nkasbank-' . $jmlkasbank, false);
                $this->db->set('id_user', $this->session->userdata('iduser'));
                $this->db->where_in('id_transaksi_dept', $nobs);
                $this->db->update('transaksi_department');

                $this->db->where_in('id_transaksi_dept', $nobs);
                $this->db->trans_commit();
                $databs = $this->db->get('transaksi_department')->result();
                } catch (Exception $e) {
                    $this->db->trans_rollback();
                    echo  $error = $db->error();
                }
                

                foreach ($databs as $value) {

                    $nkasbank = round($value->nkasbank);
                    $no_kas_bank = explode(',', $value->no_kas_bank);
                    // menghapus array 
                    $arr = array_diff($no_kas_bank, array($nokasbank));
                    $implode = implode(',', $arr);

                    try{
                    $this->db->set('no_kas_bank', $implode);
                    $this->db->set('id_user', $this->session->userdata('iduser'));
                    $this->db->where_in('id_transaksi_dept', $value->id_transaksi_dept);
                    $this->db->update('transaksi_department');
                    $this->db->trans_commit();
                    } catch (Exception $e) {
                        $this->db->trans_rollback();
                         echo  $error = $db->error();
                    }
                    


                    if ($nkasbank == 0) {

                        $update = ['nkasbank' => 0, 'status' => 3, 'id_user' => $this->session->userdata('iduser')];

                        try{
                        $this->db->set($update);
                        $this->db->where_in('id_transaksi_dept', $value->id_transaksi_dept);
                        $this->db->update('transaksi_department');     
                        $this->db->trans_commit();
                        } catch (Exception $ex) {
                        $this->db->trans_rollback();
                         echo  $error = $db->error();
                        }
                       
                    }
                }


                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No : ' . $nokasbank . ' Sudah Dibatalkan!..</div>');
            }
        }
    }

    public function getbatalkasbankkas() {

        $id = $this->input->post('id');
        $nokasbank = $this->input->post('nokasbank');
        $total = $this->input->post('total');

        $this->db->where('id_transaksi', $id);
        $data = $this->db->get('transaksi');
        //$cekstatus = $data->row()->status;
        // $ikhtisardetail = $this->db->get_where('ikhtisar_detail', ['cashbankno' => $nokasbank], ['status >', 0]);
        // $idikhtisar = $ikhtisardetail->row()->id_ikhtisar;
        // $dtikhtisar = $this->db->get_where('ikhtisar_header', ['id_ikhtisar' => $idikhtisar])->row();
        // $noikhtisar = $dtikhtisar->no_ikhtisar;
        // if ($cekstatus >= 2) {
        //    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No Kasbank : '.$nokasbank.' <b>Gagal Dibatalkan!..</b> Mohon Ikhtisar Dibatalkan Terlebih Dahulu No. '.$noikhtisar.'</div>');
        // } else {

        if ($data->num_rows()) {
            try{
            $this->db->set('status', 0);
            $this->db->set('id_user', $this->session->userdata('iduser'));
            $this->db->where('id_transaksi', $id);
            $this->db->update('transaksi');

            $this->db->set('status', 0);
            $this->db->set('id_user', $this->session->userdata('iduser'));
            $this->db->where('id_transaksi', $id);
            $this->db->update('transaksi_detail');
            $this->db->trans_commit();
            } catch (Exception $ex) {
            $this->db->trans_rollback();
             echo  $error = $db->error();
            }
            


            $bs = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
            $nobs = unserialize($bs->id_transaksi_dept);
            $total = $bs->total;
            $nokasbank = $bs->cashbankno;

            $countbs = count($nobs);

            // jika jumlah bs tidak ada bukan untuk penginputan utk bs pusat
            if ($countbs == 0) {

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No : ' . $nokasbank . ' Sudah Dibatalkan!..</div>');
            } else {

                $jmlkasbank = $total / $countbs;

                try{
                $this->db->set('nkasbank', 'nkasbank-' . $jmlkasbank, false);
                $this->db->set('id_user', $this->session->userdata('iduser'));
                $this->db->where_in('idbskantorpusat', $nobs);
                $this->db->update('bskantorpusat');

                $this->db->where_in('idbskantorpusat', $nobs);
                $databs = $this->db->get('bskantorpusat')->result(); 
                $this->db->trans_commit();
                } catch (Exception $ex) {
                $this->db->trans_rollback();
                 echo  $error = $db->error();
                }
     
             
                

                foreach ($databs as $value) {

                    $nkasbank = round($value->nkasbank);
                    $no_kas_bank = explode(',', $value->nokasbank);
                    // menghapus array 
                    $arr = array_diff($nokasbank, array($nokasbank));
                    $implode = implode(',', $arr);

                    try{
                    $this->db->set('nokasbank', $implode);
                    $this->db->set('id_user', $this->session->userdata('iduser'));
                    $this->db->where_in('idbskantorpusat', $value->idbskantorpusat);
                    $this->db->update('bskantorpusat');
                    $this->db->trans_commit();
                    } catch (Exception $ex) {
                            $this->db->trans_rollback();
                 echo  $error = $db->error();
                    }
                    


                    if ($nkasbank == 0) {

                        $update = ['nkasbank' => 0, 'status' => 1, 'id_user' => $this->session->userdata('iduser')];

                        try{
                         $this->db->set($update);
                        $this->db->where_in('idbskantorpusat', $value->idbskantorpusat);
                        $this->db->update('bskantorpusat');
                        
                        $this->db->trans_commit();
                        } catch (Exception $ex) {
                            $this->db->trans_rollback();
        echo  $error = $db->error();
                        }
                        
                    }
                }

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No : ' . $nokasbank . ' Sudah Dibatalkan!..</div>');
            }
        }
    }

    public function getbatalkasbankbank() {

        $id = $this->input->post('id');
        $nokasbank = $this->input->post('nokasbank');
        $total = $this->input->post('total');

        $this->db->where('id_transaksi', $id);
        $data = $this->db->get('transaksi');
        //$cekstatus = $data->row()->status;
        // $ikhtisardetail = $this->db->get_where('ikhtisar_detail', ['cashbankno' => $nokasbank], ['status >', 0]);
        // $idikhtisar = $ikhtisardetail->row()->id_ikhtisar;
        // $dtikhtisar = $this->db->get_where('ikhtisar_header', ['id_ikhtisar' => $idikhtisar])->row();
        // $noikhtisar = $dtikhtisar->no_ikhtisar;
        // if ($cekstatus >= 2) {
        //    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No Kasbank : '.$nokasbank.' <b>Gagal Dibatalkan!..</b> Mohon Ikhtisar Dibatalkan Terlebih Dahulu No. '.$noikhtisar.'</div>');
        // } else {

        if ($data->num_rows()) {
            try{
             $this->db->set('status', 0);
            $this->db->set('id_user', $this->session->userdata('iduser'));
            $this->db->where('id_transaksi', $id);
            $this->db->update('transaksi');

            $this->db->set('status', 0);
            $this->db->set('id_user', $this->session->userdata('iduser'));
            $this->db->where('id_transaksi', $id);
            $this->db->update('transaksi_detail');
            
            $this->db->trans_commit();
            } catch (Exception $ex) {
                    $this->db->trans_rollback();
        echo  $error = $db->error();
            }
           


            $bs = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
            $nobs = unserialize($bs->id_transaksi_dept);
            $total = $bs->total;
            $nokasbank = $bs->cashbankno;

            $countbs = count($nobs);

            // jika jumlah bs tidak ada bukan untuk penginputan utk bs pusat
            if ($countbs == 0) {

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No : ' . $nokasbank . ' Sudah Dibatalkan!..</div>');
            } else {

                $jmlkasbank = $total / $countbs;
                try{
                 $this->db->set('nkasbank', 'nkasbank-' . $jmlkasbank, false);
                $this->db->set('id_user', $this->session->userdata('iduser'));
                $this->db->where_in('idbskantorpusat', $nobs);
                $this->db->update('bskantorpusat');

                $this->db->where_in('idbskantorpusat', $nobs);
                $this->db->trans_commit();
                } catch (Exception $ex) {
        $this->db->trans_rollback();
        echo  $error = $db->error();
                }

                
                $databs = $this->db->get('bskantorpusat')->result();

                foreach ($databs as $value) {

                    $nkasbank = round($value->nkasbank);
                    $no_kas_bank = explode(',', $value->nokasbank);
                    // menghapus array 
                    $arr = array_diff($nokasbank, array($nokasbank));
                    $implode = implode(',', $arr);

                    try{
                     $this->db->set('nokasbank', $implode);
                    $this->db->set('id_user', $this->session->userdata('iduser'));
                    $this->db->where_in('idbskantorpusat', $value->idbskantorpusat);
                    $this->db->update('bskantorpusat');
                    $this->db->trans_commit();
                    } catch (Exception $ex) {
$this->db->trans_rollback();
        echo  $error = $db->error();
                    }
                   


                    if ($nkasbank == 0) {

                        $update = ['nkasbank' => 0, 'status' => 1, 'id_user' => $this->session->userdata('iduser')];

                        try{
                            $this->db->set($update);
                        $this->db->where_in('idbskantorpusat', $value->idbskantorpusat);
                        $this->db->update('bskantorpusat');
                        $this->db->trans_commit();
                        } catch (Exception $ex) {
$this->db->trans_rollback();
        echo  $error = $db->error();
                        }
                        
                    }
                }

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No : ' . $nokasbank . ' Sudah Dibatalkan!..</div>');
            }
        }
    }

    public function get_data_bs() {
        $id = $this->input->post('id');
        $data = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();
        $idbs = unserialize($data['id_transaksi_dept']);
        $idbs1 = implode(",", $idbs);
        echo json_encode($idbs1);
    }

    public function ikhtisar() {
        $data['title'] = "Ikhtisar";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');

        $this->db->where('type="KK"');
        $this->db->where('status', 1);
        $data['kasbank'] = $this->db->get('Transaksi')->result();

        $data['noikhtisar'] = $this->finance->getNoIkhtisar();

        $ikhtisar = $this->db->get_where('ikhtisar_header',['is_deleted'=>0])->result_array();

        $result = [];
        foreach ($ikhtisar as $value) {
            $id = $value['id_ikhtisar'];
            $jmlkasbank = $this->db->get_where('ikhtisar_detail', ['id_ikhtisar' => $id,'is_deleted'=>0])->num_rows();

            $result[] = [
                'id_ikhtisar' => $value['id_ikhtisar'],
                'no_ikhtisar' => $value['no_ikhtisar'],
                'tgl_ikhtisar' => $value['tgl_ikhtisar'],
                'tgl_proses_ho' => $value['tgl_proses_ho'],
                'jmlkasbank' => $jmlkasbank
            ];
        }

        $data['rst'] = $result;

        //$data['loc'] = $this->db->get('departement')->result_array();



        $this->form_validation->set_rules('pilih[]', 'No Kasbank', 'required');
        $this->form_validation->set_rules('tglikhtisar', 'Tanggal ikhtisar', 'required');
        $this->form_validation->set_rules('tglproses', 'Tanggal Proses', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/ikhtisar', $data);
            $this->load->view('templates/footer');
        } else {
            try{
                $this->finance->simpanikhtisar();
                $this->db->trans_commit();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data have been Saved!.
         </div>');
            redirect('transaksi/ikhtisar');
            } catch (Exception $ex) {
                $this->db->trans_rollback();
        echo  $error = $db->error();

            }
            
        }
    }

    public function getValueIkhtisarId() {
        $id = $this->input->post('id');
        //echo $id;

        $ikhtisar = $this->db->get_where('ikhtisar_header', ['id_ikhtisar' => $id])->row();
        echo json_encode($ikhtisar);
    }

    public function getTampilIkhtisarId() {
        $id = $this->input->post('id');
        $this->db->where('id_ikhtisar', $id);
        $detailikhtisar = $this->db->get('ikhtisar_detail')->result();
        echo json_encode($detailikhtisar);
    }

    public function getbatalikhtisar() {
        $idikhtisar = $this->input->post('id');
        $noikhtisar = $this->input->post('noikhtisar');



        $data = $this->db->get_where('ikhtisar_header', ['id_ikhtisar' => $idikhtisar]);

        if ($data->num_rows() > 0) {
            try{
            $this->db->set('status', 0);
            $this->db->where('id_ikhtisar', $idikhtisar);
            $this->db->update('ikhtisar_header');


            $this->db->set('status', 0);
            $this->db->where('id_ikhtisar', $idikhtisar);
            $this->db->update('ikhtisar_detail');


            $this->db->where('id_ikhtisar', $idikhtisar);
            $ikhtisardetail = $this->db->get('ikhtisar_detail')->result(); 
            
            $this->db->trans_commit();
            } catch (Exception $ex) {
            $this->db->trans_rollback();
             echo  $error = $db->error();
            }
            

            foreach ($ikhtisardetail as $key => $value) {
                $nokasbank[] = $value->idkasbank;
            }
            try{
                $this->db->set('status', 1);
            $this->db->where_in('id_transaksi', $nokasbank);
            $this->db->update('transaksi');

            $this->db->set('status', 1);
            $this->db->where_in('id_transaksi', $nokasbank);
            $this->db->update('transaksi_detail');
            $this->db->trans_commit();
            } catch (Exception $ex) {
$this->db->trans_rollback();
        echo  $error = $db->error();
            }
            



            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No : ' . $noikhtisar . ' Sudah Dibatalkan!..</div>');
        }
    }

    public function hapus($id) {

        $dttransdept = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();
        $databs = unserialize($dttransdept['id_transaksi_dept']);

        try{
            $this->db->set('status', 3);
        $this->db->where_in('id_transaksi_dept', $databs);
        $this->db->update('transaksi_department');

        $this->db->where('id_transaksi', $id);
        $deltrans = $this->db->delete('transaksi');

        $this->db->where('id_transaksi', $id);
        $deldetail = $this->db->delete('transaksi_detail');

        $this->db->trans_commit();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data have been Deleted.
         </div>');
        redirect('transaksi/kasrupiah');
        } catch (Exception $ex) {
$this->db->trans_rollback();
        echo  $error = $db->error();
        }
        
    }

    public function getDataNumber() {
        $this->load->model('Finance_model', 'finance');
        $id = $this->input->post('id');

        echo json_encode($this->finance->getBankCashNo($id));
    }

    public function getDataBs() {

        $this->db->where('status', 3);
        $this->db->where('hub', $this->session->userdata('hub'));
        $databs = $this->db->get('transaksi_department')->result_array();
        foreach ($databs as $value) {
            $data[] = [
                'id_transaksi_dept' => $value['id_transaksi_dept'],
                'no_bs' => $value['no_bs'],
                'pemohon' => $value['pemohon']
            ];
        }
        echo json_encode($data);
    }

    // public function getBsValueById()
    // {
    //   $this->load->model('Finance_model', 'finance');
    //   $bsno_id = $this->input->post('id');
    //  if($bsno_id) {
    //    $bsno_data = $this->finance->getBsnoId($bsno_id);
    //    echo json_encode($bsno_data);
    //  }
    // }

    public function getBsValueId() {

        $this->load->model('Finance_model', 'finance');

        $id = $this->input->post('id');

        $query = "SELECT * FROM transaksi_department WHERE id_transaksi_dept IN ($id)";
        $data = $this->db->query($query)->result();


        // fetch data
        $result = [];
        foreach ($data as $row) {

            $result[] = [
                'terpakai' => $row->terpakai,
                'nkasbank' => $row->nkasbank,
                'keterangan' => $row->keterangan,
                'pemohon' => $row->pemohon,
                'no_bs' => $row->no_bs
            ];
        }

        echo json_encode($result);
    }

    public function getTableEcRow() {
        $this->load->model('Cruda_model', 'cruda');

        // $searchTerm = $this->input->post('searchTerm');
        $ec = $this->cruda->getAllCruda();
        echo json_encode($ec);
    }

    public function getTableNaRow() {
        $this->load->model('Crudb_model', 'crudb');
        $na = $this->crudb->getAllCrudb();
        echo json_encode($na);
    }

    public function getChangingStatus() {

        $uri = $this->uri->segment(3);

        $this->load->model('Finance_model', 'finance');

        $bs = $this->input->post('bs');

        $data = [
            'status' => 2
        ];

        $this->db->where('no_bs', $bs);
        $this->db->update('transaksi_department', $data);
    }

    public function kantorpusat() {
        $data['title'] = "Bon Sementara - Kantor Pusat";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');

        $data['bagian'] = $this->db->get('bagian')->result_array();

        $this->db->where('id_departement', $this->session->userdata('hub'));
        $data['lok'] = $this->db->get('departement')->result_array();

        $data['ec'] = $this->db->get('coa_ec')->result_array();
        $data['na'] = $this->db->get('coa_na')->result_array();
        $data['bisnis'] = $this->db->get('bisnis')->result_array();

        $data['tampil'] = $this->finance->getTampilKantorDataPusat();
        // $data['realstatus'] = $this->finance->getTampilStatus();

        $data['nobs'] = $this->finance->getNomorBsKantor();


        $this->form_validation->set_rules('nobs', 'No Bs', 'required');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('pemohon', 'Pemohon', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('keperluan', 'Keperluan', 'required');
        $this->form_validation->set_rules('bagian', 'Bagian', 'required');
        $this->form_validation->set_rules('kodelokasi', 'Kode Lokasi', 'required');
        $this->form_validation->set_rules('kodeec', 'Kode Ec', 'required');
        $this->form_validation->set_rules('kodena', 'Kode Na', 'required');
        $this->form_validation->set_rules('kodebisnis', 'Kode Bisnis', 'required');
        $this->form_validation->set_rules('tglrealisasi', 'Tgl Perkiraan Realisasi', 'required');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/kantorpusat', $data);
            $this->load->view('templates/footer');
        } else {
            try{
               $this->finance->simpanKasbonKantorPusat();
               $this->db->trans_commit();   
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data Kasbon Kantor Pusat Sudah Ditambahkan!.
         </div>');
            redirect('transaksi/kantorpusat'); 
            } catch (Exception $ex) {
                $this->db->trans_rollback();
        echo  $error = $db->error();
            }
            
        }
    }

    public function getbspusatid() {

        $this->load->model('Finance_model', 'finance');
        $id = $this->input->post('id');
        echo json_encode($this->finance->getAllDataBsKantorPusatById($id));
    }

    public function ubahbspusat() {
        $idbspusat = $this->input->post('idbspusatedit', TRUE);
        $nobspusat = $this->input->post('nobsedit', TRUE);
        $tgl = date('Y-m-d', strtotime($this->input->post('tgledit', TRUE)));
        $pemohon = $this->input->post('pemohonedit', TRUE);
        $jumlah = str_replace(['.', ','], ['', '.'], $this->input->post('jumlahedit', TRUE));
        $keperluan = $this->input->post('keperluanedit', TRUE);
        $bagian = $this->input->post('bagianedit', TRUE);
        $kodelokasi = $this->input->post('kodelokasiedit', TRUE);
        $kodeec = $this->input->post('kodeecedit', TRUE);
        $kodena = $this->input->post('kodenaedit', TRUE);
        $kodebisnis = $this->input->post('kodebisnisedit', TRUE);
        $tglrealisasi = date('Y-m-d', strtotime($this->input->post('tglrealisasiedit', TRUE)));
        $catatan = $this->input->post('catatanedit', TRUE);

        $data = [
            'tanggal' => $tgl,
            'pemohon' => $pemohon,
            'jumlah' => $jumlah,
            'mata_uang' => "IDR",
            'keperluan' => $keperluan,
            'idbagian' => $bagian,
            'id_department' => $kodelokasi,
            'ec' => $kodeec,
            'na' => $kodena,
            'idbisnis' => $kodebisnis,
            'tglperkiraanrealisasi' => $tglrealisasi,
            'catatan' => $catatan,
            'id_user' => $this->session->userdata('iduser')
        ];
            try{
               $this->db->update('bskantorpusat', $data, ['idbskantorpusat' => $idbspusat]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No : ' . $nobspusat . ' Sudah Dirubah!..
         </div>');
        $this->db->trans_commit();
            } catch (Exception $ex) {
$this->db->trans_rollback();
        echo  $error = $db->error();
            }
        



        redirect('transaksi/kantorpusat');
    }

    public function getbatalbspusat() {
        $id = $this->input->post('id');
        $nobs = $this->input->post('nobs');
        $this->db->update('bskantorpusat', ['status' => 0, 'id_user' => $this->session->userdata('iduser')], ['idbskantorpusat' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No : ' . $nobs . ' Sudah Dibatalkan!..
         </div>');
    }

    public function getbatalbssementara() {
        $id = $this->input->post('id', TRUE);
        $nobs = $this->input->post('nobs', TRUE);

        $bssementara = $this->db->get_where('transaksi_department', ['id_transaksi_dept' => $id]);
        $cekstatus = $bssementara->row()->status;
        $nokasbank = $bssementara->row()->no_kas_bank;

        if ($cekstatus >= 4) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No Bs : ' . $nobs . ' <b>Gagal Dibatalkan!..</b> Mohon Kasbank Dibatalkan Terlebih Dahulu No. ' . $nokasbank . '</div>');
        } else {

            $this->db->update('transaksi_department', ['status' => 0, 'id_user' => $this->session->userdata('iduser')], ['id_transaksi_dept' => $id]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">No : ' . $nobs . ' Sudah Dibatalkan!..
         </div>');
        }
    }

    public function kasharian() {

        $data['title'] = "Posisi Kas";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['department'] = $this->db->get('departement')->result_array();

        // $this->db->where('id_validasi', 58);
        // $rst = $this->db->get('validasi')->row();
        // $jml = number_format($rst->jumlah);
        // $jml1 = $jml-1;
        // var_dump($jml1);
        // die; 
        // $this->db->where('department_id', 4);
        // $uang = $this->db->get('validasi')->result();
        //  $sum = 0;
        //  foreach ($uang as $value) {
        //     $sum = $sum + $value->jumlah * $value->pecahan;
        //   }
        //   var_dump($sum);
        // $this->db->where('id_departement', 4);
        // $deptnilai = $this->db->get('departement')->row();
        // var_dump($deptnilai->saldo1-$sum);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/posisikas', $data);
        $this->load->view('templates/footer');
    }

    public function data_uang() {

        $id = $this->input->post('id');

        $this->db->where('department_id', $id);
        $data = $this->db->get('validasi')->result();
        echo json_encode($data);
    }

    public function datarincian() {
        $id = $this->input->post('id');
        $this->load->model('Finance_model', 'finance');

        $data = $this->finance->getDataResult($id);
        echo json_encode($data);
    }

    public function getdatauang() {
        $id = $this->input->post('id');
        $this->load->model('Finance_model', 'finance');

        $data = $this->db->get_where('validasi', ['id_validasi' => $id])->row_array();
        echo json_encode($data);
    }

    public function updatedatauang() {

        $id = $this->input->post('id');
        $jumlah = $this->input->post('jumlah');
        $iddept = $this->input->post('iddept');
        $pecahan = $this->input->post('pecahan');


        $this->db->set('jumlah', $jumlah);
        $this->db->where('id_validasi', $id);
        $validasi = $this->db->update('validasi');
        echo json_encode($validasi);

        $this->db->where('department_id', $iddept);
        $uang = $this->db->get('validasi')->result();

        // $sum = 0;
        // foreach ($uang as $value) {
        //    $sum = $sum + $value->jumlah * $value->pecahan;
        //  }
        //  $this->db->where('id_departement', $iddept);
        //  $deptnilai = $this->db->get('departement')->row();
        //  $saldo = $deptnilai->saldo1-$sum;
        //  $saldo1 = $deptnilai->pinjem-$saldo;
        // $hsl = [
        // 'cashonhand' => $sum,
        // 'keluaruang' => 'keluaruang'$jumlah*$pecahan,
        // 'realisasi' => $saldo,
        // 'saldo' => $saldo1
        // ];    
        // $this->db->set('cashonhand', $sum);
        // $this->db->set('realisasi', $saldo);
        // $this->db->set('saldo', $saldo1);
        // $this->db->where('id_departement', $iddept);
        // $this->db->update('departement');
    }

    public function simpanposisi() {
        $id = $this->input->post('iddept');
        $cashonhand = str_replace(['.', ','], ['', '.'], $this->input->post('cashonhand'));
        $kbs = str_replace(['.', ','], ['', '.'], $this->input->post('kbs'));
        $outstandingho = str_replace(['.', ','], ['', '.'], $this->input->post('outstandingho'));
        $outstandingkasbank = str_replace(['.', ','], ['', '.'], $this->input->post('outstandingkasbank'));
        $gtotal = str_replace(['.', ','], ['', '.'], $this->input->post('gtotal'));
        $ttlpettycash = str_replace(['.', ','], ['', '.'], $this->input->post('totalpettycash'));
        $tanggal = date('Y-m-d', strtotime($this->input->post('tglposisi')));
        $selisih = str_replace(['.', ','], ['', '.'], $this->input->post('selisih'));


        $data = [
            'tglposisi' => $tanggal,
            'cashonhand' => $cashonhand,
            'kasbonsementara' => $kbs,
            'oskasbank' => $outstandingkasbank,
            'selisih' => $selisih,
            'ttlpettycash' => $ttlpettycash,
            'outstanding_r_ho' => $outstandingho,
            'gtotal' => $gtotal,
            'id_user' => $this->session->userdata('iduser'),
            'id_department' => $id
        ];

        $this->db->where('id_department', $id);
        $result = $this->db->get('posisikas');

        if ($result->num_rows() < 1) {

            $this->db->insert('posisikas', $data);
        } else {

            $this->db->where('id_department', $id);
            $this->db->update('posisikas', $data);
        }

        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Posisi Tersimpan !...</div>');
    }

    public function getdatabspusat() {

        $this->db->where('status', 1);
        $databspusat = $this->db->get('bskantorpusat')->result();
        $data = [];

        foreach ($databspusat as $value) {
            $data[] = [
                'idbskantorpusat' => $value->idbskantorpusat,
                'nobs' => $value->nobs,
                'pemohon' => $value->pemohon
            ];
        }

        echo json_encode($data);
    }

    public function getBsValuePusatId() {

        $this->load->model('Finance_model', 'finance');

        $id = $this->input->post('id');

        $query = "SELECT * FROM bskantorpusat WHERE idbskantorpusat IN ($id)";
        $data = $this->db->query($query)->result();

        // fetch data
        $result = [];
        foreach ($data as $row) {

            $result[] = [
                'jumlah' => $row->jumlah,
                'nkasbank' => $row->nkasbank,
                'pemohon' => $row->pemohon,
                'keperluan' => $row->keperluan,
                'nobs' => $row->nobs
            ];
        }
        echo json_encode($result);
    }

}
