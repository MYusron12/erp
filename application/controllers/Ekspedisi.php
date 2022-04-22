<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ekspedisi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('Laporan_model', 'laporan');
        //$this->db2 = $this->load->database('oracle', TRUE);
    }

    public function index() {
        $data['title'] = "Ekspedisi";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer');
    }

    public function jenismobil() {
        $data['title'] = "Jenis Mobil";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jenismobil'] = $this->db->get('jenismobil')->result();
        $this->form_validation->set_rules(
                'jenismobil', 'Jenis Mobil', 'required', [
            'required' => 'Jenis mobil wajib di isi!..'
                ]
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/jenismobil', $data);
            $this->load->view('templates/footer');
        } else {
            $jenismobil = $this->input->post('jenismobil', TRUE);
            $data = [
                'jenismobil' => $jenismobil,
                'id_user' => $this->session->userdata('iduser'),
                'hub' => $this->session->userdata('hub')
            ];
            $this->db->insert('jenismobil', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Jenis Mobil Sudah Dirubah!.
         </div>');
            redirect('ekspedisi/jenismobil');
        }
    }

    public function getubahjenismobilbyId() {
        $id = $this->input->post('id', TRUE);
        $data = $this->db->get_where('jenismobil', ['idjenismobil' => $id])->row_array();
        echo json_encode($data);
    }

    public function ubahjenismobil() {
        $idjenismobil = $this->input->post('idjenismobil', true);
        $jenismobil = $this->input->post('jenismobil', true);

        $data = [
            'jenismobil' => $jenismobil,
            'id_user' => $this->session->userdata('iduser'),
            'hub' => $this->session->userdata('hub')
        ];

        $this->db->set($data);
        $this->db->where('idjenismobil', $idjenismobil);
        $this->db->update('jenismobil');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Data Jenis Mobil Sudah Dirubah!.
         </div>');
        redirect('ekspedisi/jenismobil');
    }

    public function hapusjenismobil($id) {

        $data = [
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa"),
            'deleted_by' => $this->session->userdata('iduser')
        ];
        $this->db->where('idjenismobil', $id);
        $this->db->update('jenismobil', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Data Jenis Mobil Sudah Dihapus!.
         </div>');
        redirect('ekspedisi/jenismobil');
    }

    public function tipemobil() {
        $data['title'] = "Tipe Mobil";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tipemobil'] = $this->db->get('tipemobil')->result();
        $this->form_validation->set_rules(
                'tipemobil', 'Tipe Mobil', 'required', [
            'required' => 'Tipe mobil wajib di isi!..'
                ]
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/tipemobil', $data);
            $this->load->view('templates/footer');
        } else {
            $tipemobil = $this->input->post('tipemobil', TRUE);
            $data = [
                'tipemobil' => $tipemobil,
                'id_user' => $this->session->userdata('iduser'),
                'hub' => $this->session->userdata('hub')
            ];
            $this->db->insert('tipemobil', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Tipe Mobil Sudah Tersimpan!.
           </div>');
            redirect('ekspedisi/tipemobil');
        }
    }

    public function getubahtipemobilbyId() {
        $id = $this->input->post('id', TRUE);
        $data = $this->db->get_where('tipemobil', ['idtipemobil' => $id])->row_array();
        echo json_encode($data);
    }

    public function ubahtipemobil() {
        $idtipemobil = $this->input->post('idtipemobil', true);
        $tipemobil = $this->input->post('tipemobil', true);

        $data = [
            'tipemobil' => $tipemobil,
            'id_user' => $this->session->userdata('iduser'),
            'hub' => $this->session->userdata('hub')
        ];

        $this->db->set($data);
        $this->db->where('idtipemobil', $idtipemobil);
        $this->db->update('tipemobil');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Data Tipe Mobil Sudah Dirubah!.
           </div>');
        redirect('ekspedisi/tipemobil');
    }

    public function hapustipemobil($id) {

        $data = [
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa"),
            'deleted_by' => $this->session->userdata('iduser')
        ];
        $this->db->where('idtipemobil', $id);
        $this->db->update('tipemobil', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Data Tipe Mobil Sudah Dihapus!.
           </div>');
        redirect('ekspedisi/tipemobil');
    }

    public function mobil() {
        $data['title'] = "Mobil";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mobil'] = $this->db->query("
                select a.*, b.jenismobil, c.tipemobil
                from mobil a 
                join jenismobil b on a.idjenis = b.idjenismobil
                join tipemobil c on a.idtype = c.idtipemobil")->result();

        $data['tipemobil'] = $this->db->get('tipemobil')->result();
        $data['jenismobil'] = $this->db->get('jenismobil')->result();

        $this->form_validation->set_rules('merekmobil', 'Merek Mobil', 'required');
        $this->form_validation->set_rules('tipemobil', 'Tipe Mobil', 'required');
        $this->form_validation->set_rules('jenismobil', 'Jenis Mobil', 'required');
        $this->form_validation->set_rules('tglpembelian', 'Tanggal Pembelian', 'required');
        $this->form_validation->set_rules('tglpenggunaan', 'Tanggal Penggunaan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/mobil', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'merek' => $this->input->post('merekmobil', true),
                'idjenis' => $this->input->post('jenismobil', true),
                'idtype' => $this->input->post('tipemobil', true),
                'tglbeli' => date('Y-m-d', strtotime($this->input->post('tglpembelian', true))),
                'tglpakai' => date('Y-m-d', strtotime($this->input->post('tglpenggunaan', true))),
                'id_user' => $this->session->userdata('iduser'),
                'hub' => $this->session->userdata('hub')
            ];
            $this->db->insert('mobil', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Data Mobil Sudah Disimpan!.
         </div>');
            redirect('ekspedisi/mobil');
        }
    }

    public function getubahmobilbyId() {
        $id = $this->input->post('id', TRUE);
        $data = $this->db->get_where('mobil', ['idmobil' => $id])->row_array();
        echo json_encode($data);
    }

    public function ubahmobil() {
        $idmobil = $this->input->post('idmobil', true);
        $merekmobil = $this->input->post('merekmobil', true);
        $tipemobil = $this->input->post('tipemobil', true);
        $jenismobil = $this->input->post('jenismobil', true);
        $tglbeli = date('Y-m-d', strtotime($this->input->post('tglpembelian', true)));
        $tglpakai = date('Y-m-d', strtotime($this->input->post('tglpenggunaan', true)));

        $data = [
            'merek' => $merekmobil,
            'idjenis' => $jenismobil,
            'idtype' => $tipemobil,
            'tglbeli' => $tglbeli,
            'tglpakai' => $tglpakai,
            'id_user' => $this->session->userdata('iduser'),
            'hub' => $this->session->userdata('hub')
        ];
        $this->db->set($data);
        $this->db->where('idmobil', $idmobil);
        $this->db->update('mobil');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Data Mobil Sudah Dirubah!.
         </div>');
        redirect('ekspedisi/mobil');
    }

    public function hapusmobil($id) {
        $data = [
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa"),
            'deleted_by' => $this->session->userdata('iduser')
        ];
        $this->db->where('idmobil', $id);
        $this->db->update('mobil', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Data Mobil Sudah Dihapus!.
    </div>');
        redirect('ekspedisi/mobil');
    }

    public function driver() {
        $data['title'] = "Driver";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['driver'] = $this->db->query("select a.*,b.nama as wh from driver a join departement b on a.hub=b.id_departement")->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/driver', $data);
        $this->load->view('templates/footer');
    }

    public function tambahdriver() {
        $data['title'] = "Form Tambah Driver";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pendidikan'] = ['SD', 'SMP', 'SMA', 'DIPLOMA'];
        $this->load->model('Driver_model', 'driver');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nik', 'Nik', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tgllahir', 'Tgl_lahir', 'required');
        $this->form_validation->set_rules('notelp', 'No tlp', 'required');
        $this->form_validation->set_rules('sim1', 'Sim', 'required');
        $this->form_validation->set_rules('sim2', 'Sim');
        $this->form_validation->set_rules('masaberlaku1', 'Masa berlaku', 'required');
        $this->form_validation->set_rules('masaberlaku2', 'Masa berlaku');
        $this->form_validation->set_rules('tglmasuk', 'Tgl Masuk', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        //$list['datatgl'] = $this->input->get('tgllahir');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/tambahdriver', $data);
            $this->load->view('templates/footer');
        } else {
            $this->driver->simpanDriver();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Driver Sudah ditambah!.</div>');
            redirect('ekspedisi/driver');
        }
    }

    public function editdriver($id) {
        $data['title'] = "Form Edit Driver";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['driver'] = $this->db->query("select a.*,b.nama as wh from driver a join departement b on a.hub=b.id_departement where a.id_driver='$id'")->row();
        $data['pendidikan'] = ['SD', 'SMP', 'SMA', 'DIPLOMA'];
        $this->load->model('Driver_model', 'driver');

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nik', 'Nik', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tgllahir', 'Tgl_lahir', 'required');
        $this->form_validation->set_rules('notelp', 'No tlp', 'required');
        $this->form_validation->set_rules('sim1', 'Sim', 'required');
        $this->form_validation->set_rules('sim2', 'Sim');
        $this->form_validation->set_rules('masaberlaku1', 'Masa berlaku', 'required');
        $this->form_validation->set_rules('masaberlaku2', 'Masa berlaku');
        $this->form_validation->set_rules('tglmasuk', 'Tgl Masuk', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editdriver', $data);
            $this->load->view('templates/footer');
        } else {
            $this->driver->ubahDriver();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Driver Sudah dirubah!.</div>');
            redirect('ekspedisi/driver');
        }
    }

    public function detaildriver($id) {
        $data['title'] = "Detail Driver";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['driver'] = $this->db->query("select a.*,b.nama as wh from driver a join departement b on a.hub=b.id_departement where a.id_driver='$id'")->row();
        $data['pendidikan'] = ['SD', 'SMP', 'SMA', 'DIPLOMA'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/detaildriver', $data);
        $this->load->view('templates/footer');
    }

    public function hapusdriver($id) {

        $data = [
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa"),
            'deleted_by' => $this->session->userdata('iduser')
        ];
        $this->db->where('id_driver', $id);
        $this->db->update('driver', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The driver have been Deleted..</div>');
        redirect('ekspedisi/driver');
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
            $this->load->view('ekspedisi/truck', $data);
            $this->load->view('templates/footer');
        } else {
            $this->truck->simpandatatruck();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Data Truck Sudah Tersimpan!.
         </div>');
            redirect('ekspedisi/truck');
        }
    }

    public function getubahtruckById() {
        $id = $this->input->post('id', TRUE);
        $data = $this->db->get_where('truck', ['id_truck' => $id])->row_array();
        echo json_encode($data);
    }

    public function ubahtruck() {
        $idtruck = $this->input->post('idtruck', true);
        $nourut = $this->input->post('nourut', true);
        $nopolisi = $this->input->post('nopolisi', true);
        $mobil = $this->input->post('mobil', true);
        $bbmperliter = $this->input->post('bbmperliter', true);
        $bbmakumulasi = $this->input->post('bbmakumulasi', true);
        $toleran = $this->input->post('toleran', true);
        $driver = $this->input->post('driver', true);
        $helper = $this->input->post('helper', true);
        $km_service = $this->input->post('km_service', true);
        $tgl_stnk = date('Y-m-d', strtotime($this->input->post('tgl_stnk', true)));
        $tgl_bpkb = date('Y-m-d', strtotime($this->input->post('tgl_bpkb', true)));
        $tgl_kir = date('Y-m-d', strtotime($this->input->post('tgl_kir', true)));
        $tgl_sipa_bek = date('Y-m-d', strtotime($this->input->post('tgl_sipa_bek', true)));
        $tgl_sipa_bog = date('Y-m-d', strtotime($this->input->post('tgl_sipa_bog', true)));
        $tgl_ibm_bek = date('Y-m-d', strtotime($this->input->post('tgl_ibm_bek', true)));
        $tgl_ibm_cil = date('Y-m-d', strtotime($this->input->post('tgl_ibm_cil', true)));
        $tgl_izin_lintas = date('Y-m-d', strtotime($this->input->post('tgl_izin_lintas', true)));

        $data = [
            'no_urut' => $nourut,
            'no_polisi' => $nopolisi,
            'idmobil' => $mobil,
            'bbm_perliter' => $bbmperliter,
            'bbm_akumulasi' => $bbmakumulasi,
            'driver_id' => $driver,
            'helper_id' => $helper,
            'toleran' => $toleran,
            'id_user' => $this->session->userdata('iduser'),
            'hub' => $this->session->userdata('hub'),
            'updated_by' => $this->session->userdata('iduser'),
            'updated_at' => date("Y-m-d h:i:sa"),
            'km_service' => $km_service,
            'tgl_stnk' => $tgl_stnk,
            'tgl_bpkb' => $tgl_bpkb,
            'tgl_kir' => $tgl_kir,
            'sipa_bekasi' => $tgl_sipa_bek,
            'sipa_bogor' => $tgl_sipa_bog,
            'ibm_bekasi' => $tgl_ibm_bek,
            'ibm_cilegon' => $tgl_ibm_cil,
            'izin_lintas' => $tgl_izin_lintas
        ];
        //var_dump($data);
        // die;
        $this->db->where('id_truck', $idtruck);
        $this->db->update('truck', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
       Data Truck Sudah Dirubah!.
       </div>');
        redirect('ekspedisi/truck');
    }

    public function hapusTruck($id) {
        $data = [
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa"),
            'deleted_by' => $this->session->userdata('iduser')
        ];
        $this->db->where('id_truck', $id);
        $this->db->update('truck', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Data Truck Sudah Dihapus!.
    </div>');
        redirect('ekspedisi/truck');
    }

    public function bbm() {
        $data['title'] = "BBM";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Truck_model', 'truck');
        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $base = "http://" . $_SERVER['HTTP_HOST'];
        $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $config['base_url'] = $base . "ekspedisi/bbm";

        $data['kendaraan'] = $this->db->query("
    SELECT a.*, 
    d.merek,
    b.nama as driver, 
    c.nama as helper
    FROM truck a
    left JOIN driver b on a.driver_id = b.id_driver
    left JOIN  driver c on a.helper_id = c.id_driver
   JOIN mobil d on a.idmobil=d.idmobil
    ")->result();

        $params['conditions'] = [
            'transaksi_bbm.is_deleted' => 0
        ];
        $this->db->group_start();
        $this->db->like('no_polisi', $data['keyword']);
        $this->db->or_like('no_urut', $data['keyword']);
        $this->db->group_end();

        $this->db->from('transaksi_bbm');
        $this->db->join('truck', 'transaksi_bbm.id_kendaraan = truck.id_truck');
        $this->db->join('driver', 'transaksi_bbm.id_driver = driver.id_driver', 'left');
        $this->db->join('driver as t', 'transaksi_bbm.id_helper = driver.id_driver', 'left');
        $this->db->join('mobil', 'truck.idmobil = mobil.idmobil');
        $this->db->join('jenismobil', 'mobil.idjenis = jenismobil.idjenismobil');
        $this->db->join('tipemobil', 'mobil.idtype = tipemobil.idtipemobil');

        $where = $params['conditions'];
        $this->db->where($where);


        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 12;

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);


        $data['bbm'] = $this->truck->bbmtruck($config['per_page'], $data['start'], $data['keyword']);

        $this->form_validation->set_rules('tanggalbbm', 'Tanggalbbm', 'required');
        $this->form_validation->set_rules('kendaraan', 'Kendaraan', 'required');
        $this->form_validation->set_rules('kmawal', 'Kilo Meter Awal', 'required');
        $this->form_validation->set_rules('kmakhir', 'Kilo Meter akhir', 'required');
        $this->form_validation->set_rules('kmawal', 'Kilo Meter Awal', 'required');
        $this->form_validation->set_rules('jmlliter', 'Jumlah Liter', 'required');
        $this->form_validation->set_rules('hargabbm', 'Harga BBM', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/bbm', $data);
            $this->load->view('templates/footer');
        } else {
            $tanggal = date('Y-m-d', strtotime($this->input->post('tanggalbbm', true)));
            $kendaraan = $this->input->post('kendaraan', true);
            $iddriver1 = $this->input->post('iddriver1', true);
            $iddriver2 = $this->input->post('iddriver2', true);
            $kmawal = $this->input->post('kmawal', true);
            $kmakhir = $this->input->post('kmakhir', true);
            $jarak = $this->input->post('jarak', true);
            $jmlliter = $this->input->post('jmlliter', true);
            $hargabbm = str_replace('.', '', $_POST['hargabbm']); // menghilangkan titik
            $hargabbm = str_replace(',', '.', $hargabbm); // mengganti koma dengan titik
            //$hargabbm = $this->input->post('hargabbm', true);
            //$hargabbm1 = str_replace(['.', ','], ['', '.'], $this->input->post('hargabbm', true));
            //$totalbbm1 = $this->input->post('totalbbm');
            $totalbbm = str_replace(['.', ','], ['', '.'], $this->input->post('totalbbm', true));
            // var_dump("BBM->" . $hargabbm);
            // var_dump("TotalBBm->" . $totalbbm);
            // var_dump("liter->" . $jmlliter);
            // die;

            $data = [
                'tanggal' => $tanggal,
                'id_kendaraan' => $kendaraan,
                'id_driver' => $iddriver1,
                'id_helper' => $iddriver2,
                'km_awal' => $kmawal,
                'km_akhir' => $kmakhir,
                'jml_liter' => $jmlliter,
                'jarak' => $jarak,
                'bbmharga' => $hargabbm,
                'ttlbbm' => $totalbbm,
                'id_user' => $this->session->userdata('iduser'),
                'hub' => $this->session->userdata('hub'),
                'created_by' => $this->session->userdata('iduser'),
                'created_at' => date("Y-m-d h:i:sa")
            ];
			$update_bbm=date("Y-m-d h:i:sa");
            $data_truck = $this->db->query("select bbm_akumulasi,km_akumulasi from truck where id_truck='$kendaraan'")->row();
            $this->db->insert('transaksi_bbm', $data);
            $data_bbm = $data_truck->bbm_akumulasi + $jmlliter;
            $data_km = $data_truck->km_akumulasi + $jarak;
            $update = $this->db->query("update truck set bbm_akumulasi='$data_bbm',km_akumulasi='$data_km',km_pemakaian=km_pemakaian+'$jarak',updated_at='$update_bbm' where id_truck='$kendaraan'");


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Sudah Disimpan!.
    </div>');
            redirect('ekspedisi/bbm');
        }
    }

    public function datakendaraanById() {
        $id = $this->input->post('id', true);
        $datakendaraan = $this->db->query("
    SELECT a.*, b.nama as driver1,
    b.id_driver as iddriver1,
    c.id_driver as iddriver2,
    c.nama as driver2
    FROM truck a
    left JOIN driver b on a.driver_id = b.id_driver
    left JOIN driver c on a.helper_id = c.id_driver
    where a.id_truck='$id'
    ")->row();
        echo json_encode($datakendaraan);
    }

    public function getdataUbahBbmbyId() {
        $id = $this->input->post('id', true);
        $transaksibbm = $this->db->query("
    SELECT a.*, b.no_urut, b.no_polisi, e.merek, c.nama as driver1, d.nama as driver2
    FROM transaksi_bbm a
    JOIN truck b on a.id_kendaraan = b.id_truck
    LEFT JOIN driver c on a.id_driver = c.id_driver
    LEFT JOIN driver d on a.id_helper = d.id_driver
    JOIN mobil e on b.idmobil = e.idmobil
    JOIN jenismobil f on e.idjenis = f.idjenismobil
    JOIN tipemobil g on e.idtype = g.idtipemobil
    Where a.id_transaksi_bbm='$id'
    ")->row();
        echo json_encode($transaksibbm);
    }

    public function ubahBBM() {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggalbbm', true)));
        $kendaraan = $this->input->post('kendaraan', true);
        $iddriver1 = $this->input->post('iddriver1', true);
        $iddriver2 = $this->input->post('iddriver2', true);
        $kmawal = $this->input->post('kmawal', true);
        $kmakhir = $this->input->post('kmakhir', true);
        $jarak = $this->input->post('jarak', true);
        $jmlliter = $this->input->post('jmlliter', true);
        $hargabbm = str_replace('.', '', $_POST['hargabbm']);
        $hargabbm = str_replace(',', '.', $hargabbm);
        // $totalbbm1 = $this->input->post('totalbbm');
        $totalbbm = str_replace(['.', ','], ['', '.'], $this->input->post('totalbbm', true));
        $id = $this->input->post('idtransaksibbm');
        $data = [
            'tanggal' => $tanggal,
            'id_kendaraan' => $kendaraan,
            'id_driver' => $iddriver1,
            'id_helper' => $iddriver2,
            'km_awal' => $kmawal,
            'km_akhir' => $kmakhir,
            'jml_liter' => $jmlliter,
            'jarak' => 0,
            'bbmharga' => $hargabbm,
            'ttlbbm' => $totalbbm,
            'id_user' => $this->session->userdata('iduser'),
            'hub' => $this->session->userdata('hub'),
            'updated_by' => $this->session->userdata('iduser'),
            'updated_at' => date("Y-m-d h:i:sa")
        ];

        $truck = $this->db->query("select jarak,jml_liter from transaksi_bbm where id_transaksi_bbm='$id'")->row();
        $data_bbm_lama = $truck->jml_liter;
        if ($data_bbm_lama < $jmlliter) {
            $hasil_bbm = $jmlliter - $data_bbm_lama;
        } elseif ($data_bbm_lama > $jmlliter) {
            $hasil_bbm_min = $data_bbm_lama - $jmlliter;
        }
        $data_km_lama = $truck->jarak;
        if ($data_km_lama < $jarak) {
            $hasil_km = $jarak - $data_km_lama;
        } elseif ($data_km_lama > $jarak) {
            $hasil_km_min = $data_km_lama - $jmlliter;
        }

        $update = $this->db->query("update truck set bbm_akumulasi=bbm_akumulasi+'$hasil_bbm',km_akumulasi=km_akumulasi+'$hasil_km',km_pemakaian=km_pemakaian+'$hasil_km' where id_truck='$kendaraan'");
        $update1 = $this->db->query("update truck set bbm_akumulasi=bbm_akumulasi-'$hasil_bbm_min',km_akumulasi=km_akumulasi-'$hasil_km_min',km_pemakaian=km_pemakaian-'$hasil_km_min' where id_truck='$kendaraan'");

        $this->db->where('id_transaksi_bbm', $this->input->post('idtransaksibbm'));
        $this->db->update('transaksi_bbm', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Sudah Diubah!.
  </div>');
        redirect('ekspedisi/bbm');
    }

    public function hapusbbm($id) {
        $data = [
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa"),
            'deleted_by' => $this->session->userdata('iduser')
        ];
        $this->db->where('id_transaksi_bbm', $id);
        $this->db->update('transaksi_bbm', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Sudah Dihapus!.
    </div>');
        redirect('ekspedisi/bbm');
    }

    public function workorder() {
        $data['title'] = "Work Order";
       $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email=''")->row_array();
       // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select a.*,b.no_polisi,c.nama_bagian from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.is_deleted='0' order by id_permintaan_pengerjaan desc")->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/wo', $data);
        $this->load->view('templates/footer');
    }

    public function tambahwo() {
        $this->load->model('wo_model', 'wo');
        $this->load->model('General_model','gnrl');
        $data['title'] = "Form Tambah Work Order";
        $email=$this->session->userdata('email');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
      
       // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
         $data['loc'] = $this->db->get('bagian')->result_array();
        $data['no'] = $this->gnrl->no('WO');
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
        // var_dump($data['loc']);

        $this->form_validation->set_rules('no_pengerjaan', 'No Pengerjaan', 'required');
        $this->form_validation->set_rules('tgl_order', 'Tgl Pemohon', 'required');
        $this->form_validation->set_rules('id_bagian', 'Dept', 'required');
        $this->form_validation->set_rules('deskripsi_supir', 'Supir', 'required');
        $this->form_validation->set_rules('deskripsi_peminta', 'Jenis Pengerjaan', 'required');
        $this->form_validation->set_rules('id_truck', 'Mobil', 'required');
        $this->form_validation->set_rules('categori', 'categori', 'required');

        //$list['datatgl'] = $this->input->get('tgllahir');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/tambahwo', $data);
            $this->load->view('templates/footer');
        } else {
            $this->wo->simpanwo();
            $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='WO' and status=0");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Work Order Sudah ditambah!.</div>');
            redirect('ekspedisi/workorder');
        }
    }

    public function tambahwoid($id) {
        $this->load->model('wo_model', 'wo');
        $this->load->model('General_model','gnrl');
        $email=$this->session->userdata('email');
        $bagian_id=$this->session->userdata('bagian_id');
        $data['title'] = "Form Tambah Work Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['loc'] = $this->db->get('bagian')->result_array();
        $data['no'] = $this->gnrl->no('WO');
        $data['categori'] = ['Perawatan', 'Pergantian Suku cadang', 'Perawatan & Pergantian Suku cadang'];
        $data['kendaraan'] = $this->db->query("
    SELECT a.*, 
    d.merek,
    b.nama as driver, 
    c.nama as helper
    FROM truck a
    left JOIN driver b on a.driver_id = b.id_driver
    left JOIN driver c on a.helper_id = c.id_driver
   JOIN mobil d on a.idmobil=d.idmobil where a.id_truck='$id';
    ")->result();

        $this->form_validation->set_rules('no_pengerjaan', 'No Pengerjaan', 'required');
        $this->form_validation->set_rules('tgl_order', 'Tgl Pemohon', 'required');
        $this->form_validation->set_rules('id_bagian', 'Dept', 'required');
        $this->form_validation->set_rules('deskripsi_supir', 'Supir', 'required');
        $this->form_validation->set_rules('deskripsi_peminta', 'Jenis Pengerjaan', 'required');
        $this->form_validation->set_rules('id_truck', 'Mobil', 'required');
        $this->form_validation->set_rules('categori', 'categori', 'required');

        //$list['datatgl'] = $this->input->get('tgllahir');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/tambahwoid', $data);
            $this->load->view('templates/footer');
        } else {
            $this->wo->simpanwo();
            $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='WO' and status=0");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Work Order Sudah ditambah!.</div>');
            redirect('ekspedisi/workorder');
        }
    }

    public function editwo($id) {
        $data['title'] = "Form Edit Work Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select a.*,b.no_polisi,b.no_urut,c.nama_bagian from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.id_permintaan_pengerjaan='$id'")->row();
        $data['categori'] = ['Perawatan', 'Pergantian Suku cadang', 'Perawatan & Pergantian Suku cadang'];
        $data['loc'] = $this->db->get('bagian')->result_array();
        $this->load->model('wo_model', 'wo');
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
            $this->load->view('ekspedisi/editwo', $data);
            $this->load->view('templates/footer');
        } else {
            $this->wo->ubahWo();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Work Order Sudah dirubah!.</div>');
            redirect('ekspedisi/workorder');
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
        $this->load->view('ekspedisi/detailwo', $data);
        $this->load->view('templates/footer');
    }

    public function hapuswo($id) {
        $this->load->model('Wo_model', 'wo');
        $this->wo->hapusWo($id);
        $update = $this->db->query("update counter set jumlah=jumlah-1 where transaksi='WO'");
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The driver have been Deleted..</div>');
        redirect('ekspedisi/workorder');
    }

    public function checkwo($id) {
        $data['title'] = "Form Edit Work Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select a.*,b.no_polisi,b.no_urut,c.nama_bagian from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.id_permintaan_pengerjaan='$id'")->row();
        $data['loc'] = $this->db->get('bagian')->result_array();
        $data['categori'] = ['Perawatan', 'Pergantian Suku cadang', 'Perawatan & Pergantian Suku cadang'];
        $this->load->model('wo_model', 'wo');
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
        $this->form_validation->set_rules('deskripsi_komponen', 'Kompen yang di ganti', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/checkwo', $data);
            $this->load->view('templates/footer');
        } else {
            $this->wo->checkWo();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Work Order Sudah dirubah!.</div>');
            redirect('ekspedisi/workorder');
        }
    }

    public function ubahstatusstnk($id) {
        $data['title'] = "Reset STNK";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $idtruck = $this->input->post('idtruck', true);
        $tgl_stnk = date('Y-m-d', strtotime($this->input->post('tgl_stnk', true)));
        $data['wo'] = $this->db->query("select * from truck where id_truck='$id'")->row();
        $this->form_validation->set_rules('tgl_stnk', 'STNK', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editstnk', $data);
            $this->load->view('templates/footer');
        } else {
            $update = $this->db->query("update truck set tgl_stnk='$tgl_stnk' where id_truck='$idtruck'");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data STNK Truck Sudah Dirubah!.
         </div>');
            redirect('adminops/totstnk');
        }
    }

    public function ubahstatuskm($id) {
        $data['title'] = "Reset KM Pemakaian";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select a.*,b.* from truck a left join permintaan_pengerjaan b on a.id_truck=b.id_truck where b.id_permintaan_pengerjaan='$id'")->row();
        $a = $this->db->query("select a.*,b.* from truck a left join permintaan_pengerjaan b on a.id_truck=b.id_truck where b.id_permintaan_pengerjaan='$id'")->result_array();
        foreach ($a as $i) {
            
        }
		$km_akhir="";
		$km_akhir=0;
		$real_km =0;
        $real_km ="";
        $id_truck = $i['id_truck'];
        $dk = $i['deskripsi_komponen'];
        $dp = $i['deskripsi_peminta'];
        $nowo = $i['no_pengerjaan'];
        $km = $i['km_pemakaian'];
        $idtruck = $this->input->post('idtruck', true);
        $km_wo = $this->input->post('km_pemakaian', true);
        $tgl_service = date('Y-m-d', strtotime($this->input->post('tgl_service', true)));
		$km_akhir = str_replace(['.', ','], ['', ''], $this->input->post('km_akhir', true));
       
		//$real_km = $km_akhir - $km_wo;
        $tgl_sp_part = date('Y-m-d', strtotime($this->input->post('tgl_service_suku', true)));
        $this->form_validation->set_rules('km_pemakaian', 'KM', 'required');
        //var_dump($real_km);
        //var_dump($_POST);
       // die;
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editkm', $data);
            $this->load->view('templates/footer');
        } else {
			 if($km_wo < 5000){
                $real_km = $km_wo;
            }else{
               
			   
				$real_km = $km_akhir - $km_wo;
            }
			//var_dump($km_wo);
			//var_dump($real_km);
			//die;
			//exit();
            
            $update = $this->db->query("update truck set km_pemakaian='$real_km' where id_truck='$idtruck'");
            $update_wo = $this->db->query("update permintaan_pengerjaan set status='3' where id_permintaan_pengerjaan='$id'");
            $data_truck = $this->db->query("select * from truck where id_truck='$idtruck'")->row();
            $data_no_body = $data_truck->no_urut;
            $data_no_polisi = $data_truck->no_polisi;
            $update_service = $this->db->query("insert into report_service(id_truck,no_body,no_polisi,tgl,tgl_sp_part,wo,keterangan)values('$idtruck','$data_no_body','$data_no_polisi','$tgl_service','$tgl_sp_part','$nowo','$dk $dp')");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data Service Truck Sudah Dirubah!.
         </div>');
            redirect('adminops/totservice');
        }
    }

    public function ubahstatusbpkb($id) {
        $data['title'] = "Reset Tanggal BPKB";
        $idtruck = $this->input->post('idtruck', true);
        $tgl_bpkb = date('Y-m-d', strtotime($this->input->post('tgl_bpkb', true)));
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select * from truck where id_truck='$id'")->row();
        $this->form_validation->set_rules('tgl_bpkb', 'BPKB', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editbpkb', $data);
            $this->load->view('templates/footer');
        } else {
            $update = $this->db->query("update truck set tgl_bpkb='$tgl_bpkb' where id_truck='$idtruck'");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data BPKB Truck Sudah Dirubah!.
         </div>');
            redirect('adminops/totbpkb');
        }
    }

    public function ubahstatuskir($id) {
        $data['title'] = "Reset Tanggal KIR";
        $idtruck = $this->input->post('idtruck', true);
        $tgl_kir = date('Y-m-d', strtotime($this->input->post('tgl_kir', true)));
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select * from truck where id_truck='$id'")->row();
        $this->form_validation->set_rules('tgl_kir', 'KIR', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editkir', $data);
            $this->load->view('templates/footer');
        } else {
            $update = $this->db->query("update truck set tgl_kir='$tgl_kir' where id_truck='$idtruck'");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data KIR Truck Sudah Dirubah!.
         </div>');
            redirect('adminops/totkir');
        }
    }

    public function ubahstatussipabks($id) {
        $data['title'] = "Reset Tanggal SIPA BKS";
        $idtruck = $this->input->post('idtruck', true);
        $tgl_sipa_bks = date('Y-m-d', strtotime($this->input->post('sipa_bekasi', true)));
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select * from truck where id_truck='$id'")->row();
        $this->form_validation->set_rules('sipa_bekasi', 'SIPA BEKASI', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editspbks', $data);
            $this->load->view('templates/footer');
        } else {
            $update = $this->db->query("update truck set sipa_bekasi='$tgl_sipa_bks' where id_truck='$idtruck'");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data SIPA BEKASI Truck Sudah Dirubah!.
         </div>');
            redirect('adminops/totbks');
        }
    }

    public function ubahstatussipabgr($id) {
        $data['title'] = "Reset Tanggal SIPA BGR";
        $idtruck = $this->input->post('idtruck', true);
        $tgl_sipa_bgr = date('Y-m-d', strtotime($this->input->post('sipa_bogor', true)));
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select * from truck where id_truck='$id'")->row();
        $this->form_validation->set_rules('sipa_bogor', 'SIPA Bogor', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editspbgr', $data);
            $this->load->view('templates/footer');
        } else {
            $update = $this->db->query("update truck set sipa_bogor='$tgl_sipa_bgr' where id_truck='$idtruck'");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data SIPA BOGOR Truck Sudah Dirubah!.
         </div>');
            redirect('adminops/totspbgr');
        }
    }

    public function ubahstatusibmbks($id) {
        $data['title'] = "Reset Tanggal IBM BKS";
        $idtruck = $this->input->post('idtruck', true);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $tgl_ibm_bekasi = date('Y-m-d', strtotime($this->input->post('ibm_bekasi', true)));
        $data['wo'] = $this->db->query("select * from truck where id_truck='$id'")->row();
        $this->form_validation->set_rules('ibm_bekasi', 'SIPA BEKASI', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editibmbks', $data);
            $this->load->view('templates/footer');
        } else {
            $update = $this->db->query("update truck set ibm_bekasi='$tgl_ibm_bekasi' where id_truck='$idtruck'");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data IBM BEKASI Truck Sudah Dirubah!.
         </div>');
            redirect('adminops/totimbbks');
        }
    }

    public function ubahstatusibmclg($id) {
        $data['title'] = "Reset Tanggal IBM Cilegon";
        $idtruck = $this->input->post('idtruck', true);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $tgl_ibm_clg = date('Y-m-d', strtotime($this->input->post('ibm_cilegon', true)));
        $data['wo'] = $this->db->query("select * from truck where id_truck='$id'")->row();
        $this->form_validation->set_rules('ibm_cilegon', 'IBM Bekasi', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editibmclg', $data);
            $this->load->view('templates/footer');
        } else {
            $update = $this->db->query("update truck set ibm_cilegon='$tgl_ibm_clg' where id_truck='$idtruck'");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data IBM CILEGON Truck Sudah Dirubah!.
         </div>');
            redirect('adminops/totibmclg');
        }
    }

    public function ubahstatusizinlnts($id) {
        $data['title'] = "Reset Tanggal IBM Cilegon";
        $idtruck = $this->input->post('idtruck', true);
        $tgl_izin_lintas = date('Y-m-d', strtotime($this->input->post('izin_lintas', true)));
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wo'] = $this->db->query("select * from truck where id_truck='$id'")->row();
        $this->form_validation->set_rules('izin_lintas', 'Ijin Bekasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ekspedisi/editlantas', $data);
            $this->load->view('templates/footer');
        } else {
            $update = $this->db->query("update truck set izin_lintas='$tgl_izin_lintas' where id_truck='$idtruck'");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data IZIN LINTAS Truck Sudah Dirubah!.
                </div>');
            redirect('adminops/totizin');
        }
    }

    public function detailbbm($id) {
        $data['title'] = "Detail BBM";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //$data['truck'] = $this->truck->getDataTruck();
        $data['detil_bbm'] = $this->db->query("select a.*,b.*,c.*,d.nama as NAMA_HELPER from truck a join transaksi_bbm b on a.id_truck=b.id_kendaraan left join driver c on c.id_driver=b.id_driver left outer join driver d on d.id_driver=b.id_helper where b.id_transaksi_bbm='$id'")->row();
        //$data['pendidikan'] = ['SD', 'SMP', 'SMA', 'DIPLOMA'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/detailbbm', $data);
        $this->load->view('templates/footer');
    }

    /* ===============================REPORT EKSPEDISI================================= */

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

    public function reportdetailtruck() {

        $data['title'] = "Report truck service";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/report/tgl_service', $data);
        $this->load->view('templates/footer');
    }

    public function Detailtruckall() {
        $data['title'] = "Detail service mobil";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Truck_model', 'truck');


        //die;
        $data['t'] = $this->truck->truck_detailall();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/report/printdetailtruck', $data);
        $this->load->view('templates/footer');
    }

    public function reportworkorder() {


        $data['title'] = "Report Work Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post('submit')) {
            $tgl1 = $this->input->post('tgl1');
            $tgl2 = $this->input->post('tgl2');
        } else {
            $tgl1 = null;
            $tgl2 = null;
        }

        $data['rptwo'] = $this->laporan->getReportWO($tgl1, $tgl2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/reportworkorder', $data);
        $this->load->view('templates/footer');
    }

    public function aktivitas() {

        $data['title'] = "Pilih No Mobil";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $sj_save = $this->db->query("select * from aktivitas")->result_array();
        foreach($sj_save as $sj){
            $mbl=$sj['no_mobil'];
         //   var_dump($sj['no_mobil']);
        }
       // die;
        $data['sj_hari_ini'] = $this->db2->query("select b.auth_nbr from wmswmprd.lpn a join wmswmprd.shipment b on a.tc_shipment_id=b.tc_shipment_id
        where lpn_facility_status='90' AND 
        TRUNC(a.last_updated_dttm)= trunc(SYSDATE) and a.tc_company_id in ('73','70') 
        and a.inbound_outbound_indicator='O' AND b.dsg_carrier_code IN('U6','MBAL')AND b.auth_nbr not in('$mbl') group by b.auth_nbr")->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/pilihsj', $data);
        $this->load->view('templates/footer');
    }

    public function detailaktivitas() {
        $nopol = $this->input->post('nopol');
        $data['title'] = "Detail aktivitas No Mobil '$nopol'";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
       
        $data['detail_aktv'] = $this->db2->query("SELECT
case 
        when a.tc_company_id='73' and  b.d_facility_name like '%MDS%' Then ('CV MDS')
        when a.tc_company_id='70' and  b.ref_shipment_nbr like '%MDS-X%' Then ('DP MDS')
        when a.tc_company_id='73' and  b.d_facility_name not like '%MDS%' Then ('NON CV MDS')
        ELSE ( 'DP 361' )
       end BU,
a.shipped_dttm,
a.tc_shipment_id,
a.d_facility_alias_id,
b.d_facility_name,
e.company_description,
b.ref_shipment_nbr,
b.ref_field_6,
c.auth_nbr,
c.seal_number,
c.tractor_number,
c.trailer_number,
d.state_prov_name as region,
count (distinct a.tc_lpn_id) as total_coli
from
wmswmprd.lpn a
join wmswmprd.orders b on b.tc_order_id = a.tc_order_id
join wmswmprd.shipment c on c.tc_shipment_id = a.tc_shipment_id
left JOIN wmswmprd.state_prov d ON d.state_prov = b.d_state_prov
left join wmswmprd.company e on e.company_name=a.business_partner_id
where
a.tc_company_id in ('70','73')
and c.auth_nbr = '$nopol'
and a.inbound_outbound_indicator = 'O'
and a.lpn_facility_status = '90'
and trunc (a.shipped_dttm) = trunc(sysdate)
group by
a.tc_company_id,
a.shipped_dttm,
a.tc_shipment_id,
e.company_description,
a.d_facility_alias_id,
b.d_facility_name,
b.ref_shipment_nbr,
b.ref_field_6,
c.auth_nbr,
c.seal_number,
c.tractor_number,
c.trailer_number,
 d.state_prov_name
order by a.d_facility_alias_id")->result_array();
  
       $data['sj_blm_close']=$this->db2->query("select  b.tc_shipment_id,a.lpn_facility_status,b.auth_nbr from wmswmprd.lpn a join wmswmprd.shipment b on a.tc_shipment_id=b.tc_shipment_id
        where a.lpn_facility_status in('50') AND 
        TRUNC(a.last_updated_dttm)= trunc(SYSDATE) and a.tc_company_id in ('73','70') 
        and a.inbound_outbound_indicator='O' AND b.dsg_carrier_code IN('U6','MBAL')and b.auth_nbr = '$nopol' group by b.tc_shipment_id,a.lpn_facility_status,b.auth_nbr")->result_array();
  
         $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ekspedisi/detailsj', $data);
        $this->load->view('templates/footer');
          }

}
