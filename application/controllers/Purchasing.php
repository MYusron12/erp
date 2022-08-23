<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

class Purchasing extends CI_Controller {

    public function __construct() { //function yg udh ada di class berubah namanya jadi method
        parent::__construct(); 
        check_login(); 
        $this->load->model('Purchasing_model', 'purchasing');
        $this->load->model('Barang_model', 'barang');
    }

    // 1
    public function index() {
        $data['title'] = "Permintaan Pembelian"; //$title;

        $this->load->model('General_model', 'gnrl'); 
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');
        $role = $this->session->userdata('role_id');

        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array(); //select blblab

        if ($role == '1') {
            $data['permintaan'] = $this->purchasing->get_data_permintaan_all();
        } else {
            $data['permintaan'] = $this->purchasing->get_data_permintaan($bagian_id);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/permintaan', $data);
        $this->load->view('templates/footer');
    }

    // 2
    public function create() {
        $data['title'] = "Form Permintaan Pembelian";
        $this->load->model('General_model', 'gnrl');
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['nopr'] = $this->gnrl->no('PR');
        $data['bagian'] = $this->db->get('bagian')->result();
        $data['barang'] = $this->db->get('barang')->result();
        $this->form_validation->set_rules('namarequest', 'Nama Request', 'required');
        // $this->form_validation->set_rules('verifikasikode', 'Verifikasi Kode', 'required');
        $this->form_validation->set_rules('coding', 'Coding', 'required');
        //$this->form_validation->set_rules('cprno', 'Cpr No', 'required');
        $this->form_validation->set_rules('bagian', 'Bagian', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/create', $data);
            $this->load->view('templates/footer');
        } else {
            $this->purchasing->simpandatapermintaan();
            $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='PR' and status=0 and id_bagian='$bagian_id'");
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('purchasing/index');
        }
    }

    function get_data_barang() {
        $this->db->select('barang.*, satuan.nama_satuan, categori.nama_categori');
        $this->db->from('barang');
        $this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan');
        $this->db->join('categori', 'barang.id_categori = categori.id_categori');
        $data = $this->db->get()->result_array();
        echo json_encode($data);
    }
    
    function get_data_barang_id() {
        $this->db->select('barang.*, satuan.nama_satuan, categori.nama_categori');
        $this->db->from('barang');
        $this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan');
        $this->db->join('categori', 'barang.id_categori = categori.id_categori');
        $this->db->where('id_barang', $this->input->post('id_barang', true));
        $data = $this->db->get()->row_array();
        echo json_encode($data);
    }

    // 3
    public function view($id) {
        $data['title'] = "View Data Permintaan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $result = [];
        $headerpermintaan = $this->purchasing->get_data_header_id($id);
        $result['headerpermintaan'] = $headerpermintaan;
        $detailpermintaan = $this->purchasing->get_data_permintaan_detail_id($id);

        foreach ($detailpermintaan as $key => $value) {
            $result['detailpermintaan'][] = $value;
        }
        $data['permintaan'] = $result;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/viewpermintaan', $data);
        $this->load->view('templates/footer');
    }

    // 4
    public function edit($id) {
        $data['title'] = "Edit Data Permintaan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $result = [];
        $headerpermintaan = $this->purchasing->get_data_header_id($id);
        $result['headerpermintaan'] = $headerpermintaan;
        $detailpermintaan = $this->purchasing->get_data_permintaan_detail_id($id);
        $data['bagian'] = $this->db->get('bagian')->result_array();
        $data['barang'] = $this->db->get('barang')->result_array();
        foreach ($detailpermintaan as $key => $value) {
            $result['detailpermintaan'][] = $value;
        }
        $data['permintaan'] = $result;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/edit', $data);
        $this->load->view('templates/footer');
    }

    public function updatepr() {
        // echo '<pre>';
        // echo print_r($_POST);
        // echo '</pre>';
        // die;
        $data['title'] = "Update Permintaan Pembelian";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->purchasing->updatedatapr();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('purchasing/index');
    }

    // 5
    public function hapuspr($id) {
        $this->db->where('id_permintaan', $id);
        $this->db->delete('permintaan_pembelian_header');

        $this->db->where('id_permintaan', $id);
        $this->db->delete('permintaan_pembelian_detail');
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('purchasing/index');
    }

    public function pembelianorder() {
        $data['title'] = "Pembelian Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pembelian'] = $this->purchasing->getdataheaderpembelian();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/pembelianorder', $data);
        $this->load->view('templates/footer');
    }

    public function createorder() {
        $data['title'] = "Create Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nopo'] = $this->purchasing->get_no_order();
        $data['noper'] = $this->purchasing->get_no_per();
        $data['suplier'] = $this->purchasing->get_data_suplier();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/createorder', $data);
        $this->load->view('templates/footer');
    }

    public function simpanorder() {
        // simpan data header order
        $nopo = $this->input->post('nopo', true);
        $tglpo = date('Y-m-d', strtotime($this->input->post('tglpo', true)));
        $nomorper = $this->input->post('nomorper', true);
        $suplier = $this->input->post('suplierorder', true);
        $ppnpersen = $this->input->post('ppnpersen', true);
        $ppnrupiah = str_replace(['.', ','], ['', '.'], $this->input->post('ppnrupiah', true));
        $pphpersen = $this->input->post('pphpersen', true);
        $pphrupiah = str_replace(['.', ','], ['', '.'], $this->input->post('pphrupiah', true));
        $totalnet = str_replace(['.', ','], ['', '.'], $this->input->post('totalnet', true));
        $hub = $this->session->userdata('hub');
        $dataheaderbeli = [
            'tgl_po' => $tglpo,
            'no_po' => $nopo,
            'id_permintaan' => $nomorper,
            'id_suplier' => $suplier,
            'id_dept' => $hub,
            'ppnpersen' => $ppnpersen,
            'ppnrupiah' => $ppnrupiah,
            'pphpersen' => $pphpersen,
            'pphrupiah' => $pphrupiah,
            'jumlah' => $totalnet,
            'status' => 1,
            'id_user' => $this->session->userdata('iduser')
        ];

        $this->db->insert('pembelian_header', $dataheaderbeli);
        $id_pembelian = $this->db->insert_id();

        // simpan data detail pembelian order
        $datadetailpermintaan = $this->db->get_where('permintaan_pembelian_detail', ['id_permintaan' => $nomorper])->result();

        $detailpembelian = [];
        foreach ($datadetailpermintaan as $key => $value) {
            $detailpembelian[$key] = [
                'id_pembelian' => $id_pembelian,
                'id_barang' => $value->id_barang,
                'qty' => $value->qty,
                'harga' => $value->harga
            ];
        }
        $this->db->insert_batch('pembelian_detail', $detailpembelian);
        // update status permintaan sedang di order 
        $statuspermintaan = ['status' => 3];
        $this->db->where('id_permintaan', $nomorper);
        $this->db->update('permintaan_pembelian_header', $statuspermintaan);
    }

    public function get_data_permintaan() {
        $id = $this->input->post('id', true);
        $data = $this->purchasing->get_data_header_id($id);
        echo json_encode($data);
    }

    public function get_data_permintaan_detail() {
        $id = $this->input->post('id', true);
        $data = $this->purchasing->get_data_permintaan_detail_id($id);
        echo json_encode($data);
    }

    public function viewbeliorder($id) {
        $data['title'] = "View Order";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['suplier'] = $this->purchasing->get_data_suplier();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];

        $result = [];
        $headerpembelian = $this->purchasing->get_data_header_pembelian_id($id);
        $result['headerpembelian'] = $headerpembelian;
        $detailpembelian = $this->purchasing->get_data_pembelian_detail_id($id);

        foreach ($detailpembelian as $key => $value) {
            $result['detailpembelian'][] = $value;
        }
        $data['pembelian'] = $result;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/vieworder', $data);
        $this->load->view('templates/footer');
    }

    public function batalbeliorder($id) {

        $data = $this->db->get_where('pembelian_header', ['id_pembelian' => $id])->row();
        $idpermintaan = $data->id_permintaan;

        $status = ['status' => 2];
        $this->db->where('id_permintaan', $idpermintaan);
        $this->db->update('permintaan_pembelian_header', $status);

        $this->db->where('id_pembelian', $id);
        $this->db->delete('pembelian_header');

        $this->db->where('id_pembelian', $id);
        $this->db->delete('pembelian_detail');
        redirect('purchasing/pembelianorder');
    }

    public function penerimaanbarang() {
        $data['title'] = "Penerimaan Barang";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['terimabarang'] = $this->purchasing->getTerimaBarang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/penerimaanbarang', $data);
        $this->load->view('templates/footer');
    }

    public function terimabarang() {
        $data['title'] = "Terima Barang";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['noterima'] = $this->purchasing->get_no_id_terima();
        $data['nopo'] = $this->db->get_where('pembelian_header', ['status' => 1])->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/terimabarang', $data);
        $this->load->view('templates/footer');
    }

    public function getdataorderid() {
        $id = $this->input->post('id', true);
        $data = $this->purchasing->get_data_header_pembelian_id($id);
        echo json_encode($data);
    }

    public function getdataorderdetail() {
        $id = $this->input->post('id', true);
        $data = $this->purchasing->get_data_pembelian_detail_id($id);
        echo json_encode($data);
    }

    public function simpanpenerimaan() {
        $notransterima = $this->input->post('notransterima');
        $tglterima = date('Y-m-d', strtotime($this->input->post('tglterima')));
        $nopoterima = $this->input->post('nopoterima');
        $keterangan = $this->input->post('keteranganterima');
        $dataterimaheader = [
            'no_trans_trm_brg' => $notransterima,
            'id_po' => $nopoterima,
            'tgl_terima_barang' => $tglterima,
            'keterangan' => $keterangan,
            'status' => 1
        ];
        $this->db->insert('terima_barang_header', $dataterimaheader);
        $idterimabarang = $this->db->insert_id();

        // details
        $qtytrim = $this->input->post('qtyterima');
        $keterangan = $this->input->post('keterterimadetail');
        $databeli = $this->purchasing->get_data_pembelian_detail_id($nopoterima);
        $simpanterimadetail = [];
        foreach ($databeli as $x => $value) {
            $simpanterimadetail[] = [
                'id_terimabarang' => $idterimabarang,
                'id_barang' => $value->id_barang,
                'qty_order' => $value->qty,
                'id_satuan' => $value->id_satuan,
                'qty_terima' => $qtytrim[$x],
                'keterangan' => $keterangan[$x]
            ];
        }
        $this->db->insert_batch('terima_barang_detail', $simpanterimadetail);

        // updatestatus pembelian order 
        $statusorder = ['status' => 2];
        $this->db->where('id_pembelian', $nopoterima);
        $this->db->update('pembelian_header', $statusorder);
    }

    public function permintaanjasa() {
        $data['title'] = "Permintaan Jasa";
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');
        $role = $this->session->userdata('role_id');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        if ($role == '1') {
            $data['jasa'] = $this->purchasing->get_data_jasa();
        } else {
            $data['jasa'] = $this->purchasing->get_data_jasa_bagian_id($bagian_id);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/permintaanjasa', $data);
        $this->load->view('templates/footer');
    }

    public function create_pr_jasa() {
        $data['title'] = "Form Permintaan Jasa";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['noprjs'] = $this->purchasing->get_no_pr_jasa();
        $data['bagian'] = $this->db->get('bagian')->result();
        $data['satuan'] = $this->db->get('satuan')->result();
        $bagian_id = $this->session->userdata('bagian_id');
        $this->form_validation->set_rules('nama_req', 'Nama Request', 'required');
        //$this->form_validation->set_rules('verifikasikodejasa', 'Verifikasi Kode', 'required');
        //$this->form_validation->set_rules('codingjasa', 'Coding', 'required');
        //$this->form_validation->set_rules('cprnojasa', 'Cpr No', 'required');
        $this->form_validation->set_rules('bagianjasa', 'Bagian', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/createjasa', $data);
            $this->load->view('templates/footer');
        } else {
            $this->purchasing->simpandataprjasa();
            $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='PR' and status=0 and id_bagian='$bagian_id'");
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('purchasing/permintaanjasa');
        }
    }

    public function createpermintaanjasa() {
        $data['title'] = "Create Permintaan Jasa";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //$data['nopr'] = $this->purchasing->get_no_permintaan();
        $this->load->model('General_model', 'gnrl');
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['noprjs'] = $this->gnrl->no('PR');
        $data['loc'] = $this->db->get('departement')->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get('coa_tb')->result();
        $data['satuan'] = $this->db->get('satuan')->result();
        $data['bagian'] = $this->db->get('bagian')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        $data['max'] = $this->purchasing->max();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/createjasa', $data);
        $this->load->view('templates/footer');
    }

    public function satuanbarang() {
        $data['title'] = "Satuan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['satuan'] = $this->db->get('satuan')->result();
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/satuanbarang', $data);
            $this->load->view('templates/footer');
        } else {
            $satuan = $this->input->post('satuan', true);
            $keterangan = $this->input->post('keterangan', true);
            $data = [
                'nama_satuan' => $satuan,
                'keterangan' => $keterangan,
                'id_user' => $this->session->userdata('iduser')
            ];
            $this->db->insert('satuan', $data);
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('purchasing/satuanbarang');
        }
    }

    public function getdataUbahSatuanId() {
        $id = $this->input->post('id', TRUE);
        $data = $this->db->get_where('satuan', ['id_satuan' => $id])->row_array();
        echo json_encode($data);
    }

    public function ubahSatuan() {
        $idsatuan = $this->input->post('idsatuan', true);
        $satuan = $this->input->post('satuan', true);
        $keterangan = $this->input->post('keterangan', true);
        $data = [
            'nama_satuan' => $satuan,
            'keterangan' => $keterangan,
            'id_user' => $this->session->userdata('iduser')
        ];
        $this->db->where('id_satuan', $idsatuan);
        $this->db->update('satuan', $data);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('purchasing/satuanbarang');
    }

    public function hapusSatuan($id) {
        $this->db->where('id_satuan', $id);
        $this->db->delete('satuan');
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('purchasing/satuanbarang');
    }

    public function categoribarang() {
        $data['title'] = "Categori Barang";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['categori'] = $this->db->get('categori')->result();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/categoribarang', $data);
            $this->load->view('templates/footer');
        } else {
            $kategori = $this->input->post('kategori', true);
            $data = [
                'nama_categori' => $kategori,
                'id_user' => $this->session->userdata('iduser')
            ];
            $this->db->insert('categori', $data);
            $this->session->set_flashdata('flash', 'Disimpan');
            redirect('purchasing/categoribarang');
        }
    }

    public function getdataUbahKategoriById() {
        $id = $this->input->post('id', true);
        $data = $this->db->get_where('categori', ['id_categori' => $id])->row_array();
        echo json_encode($data);
    }

    public function ubahKategori() {
        $idkategori = $this->input->post('idkategori', true);
        $kategori = $this->input->post('kategori', true);
        $data = [
            'nama_categori' => $kategori,
            'id_user' => $this->session->userdata('iduser')
        ];
        $this->db->where('id_categori', $kategori);
        $this->db->update('categori', $data);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('purchasing/categoribarang');
    }

    public function hapuscategori($id) {
        $this->db->where('id_categori', $id);
        $this->db->delete('categori');
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('purchasing/categoribarang');
    }

    public function barang() {
        $data['title'] = "Barang";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->db->query("
    SELECT a.*, b.nama_satuan, c.nama_categori
    FROM barang a 
    JOIN satuan b on a.id_satuan = b.id_satuan
    JOIN categori c on a.id_categori=c.id_categori
    ")->result();

        $data['kategori'] = $this->db->get('categori')->result();
        $data['satuan'] = $this->db->get('satuan')->result();
        // Mengenerate ID Barang
        $kode_terakhir = $this->barang->getMax('barang', 'kode_barang');
        $kode_tambah = substr($kode_terakhir, -6, 6);
        $kode_tambah++;
        $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
        $data['id_barang'] = 'B' . $number;

        $this->form_validation->set_rules('namabarang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/barang', $data);
            $this->load->view('templates/footer');
        } else {
            $kodebarang = $this->input->post('kodebarang', true);
            $namabarang = $this->input->post('namabarang', true);
            $kategori = $this->input->post('kategori', true);
            $satuan = $this->input->post('satuan', true);
            $harga = $this->input->post('harga', true);
            $data = [
                'kode_barang' => $kodebarang,
                'nama_barang' => $namabarang,
                'id_categori' => $kategori,
                'harga' => $harga,
                'id_satuan' => $satuan,
                'id_user' => $this->session->userdata('iduser'),
                'created_by' => $this->session->userdata('iduser'),
                'created_at' => date("Y-m-d h:i:sa"),
                'is_deleted' => 0,
                'id_user' => $this->session->userdata('iduser')
            ];
            $this->db->insert('barang', $data);
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('purchasing/barang');
        }
    }

    public function getdataUbahBarangById() {
        $id = $this->input->post('id', true);
        $data = $this->db->get_where('barang', ['id_barang' => $id])->row_array();
        echo json_encode($data);
    }

    public function ubahBarang() {
        $idbarang = $this->input->post('idbarang', true);
        $kodebarang = $this->input->post('kodebarang', true);
        $namabarang = $this->input->post('namabarang', true);
        $kategori = $this->input->post('kategori', true);
        $satuan = $this->input->post('satuan', true);
        $data = [
            'kode_barang' => $kodebarang,
            'nama_barang' => $namabarang,
            'id_categori' => $kategori,
            'id_satuan' => $satuan,
            'updated_by' => $this->session->userdata('iduser'),
            'updated_at' => date("Y-m-d h:i:sa"),
            'id_user' => $this->session->userdata('iduser')
        ];
        $this->db->where('id_barang', $idbarang);
        $this->db->update('barang', $data);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('purchasing/barang');
    }

    public function hapusbarang($id) {
        $data = [
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa"),
            'deleted_by' => $this->session->userdata('iduser')
        ];
        $this->db->where('id_barang', $id);
        $this->db->update('barang', $data);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('purchasing/barang');
    }

    public function viewbelijasa($id) {
        $data['title'] = "View Permintaan Jasa";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jasa'] = $this->purchasing->get_data_jasa_id($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/viewjasa', $data);
        $this->load->view('templates/footer');
    }

    public function updatebelijasa($id) {

        $data['title'] = "Form Edit Permintaan Jasa";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //$data['noprjs'] = $this->purchasing->get_no_pr_jasa();
        //$data['bagian'] = $this->db->get('bagian')->result();
        $data['jasa'] = $this->purchasing->get_data_jasa_id($id);
        $data['satuan'] = $this->db->get('satuan')->result();

        $this->form_validation->set_rules('nama_req', 'Nama Request', 'required');
        //$this->form_validation->set_rules('verifikasikodejasa', 'Verifikasi Kode', 'required');
        //$this->form_validation->set_rules('codingjasa', 'Coding', 'required');
        //$this->form_validation->set_rules('cprnojasa', 'Cpr No', 'required');
        $this->form_validation->set_rules('bagianjasa', 'Bagian', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/editbelijasa', $data);
            $this->load->view('templates/footer');
        } else {
            $this->purchasing->updatedataprjasa();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('purchasing/permintaanjasa');
        }
    }

    public function batalbelijasa($id) {

        $data = [
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa"),
            'deleted_by' => $this->session->userdata('iduser')
        ];
        $this->db->where('id_permintaan_jasa', $id);
        $this->db->update('permintaan_jasa_all', $data);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('purchasing/permintaanjasa');
    }

    public function addipo($id) {
        $data['title'] = "Create IPO PR Jasa";
        //$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('General_model', 'gnrl');
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['noipo'] = $this->gnrl->no('IPO');
        $data['jasa'] = $this->purchasing->get_data_jasa_id($id);
        $data['suplier'] = $this->db->get('suplier')->result();
        $data['loc'] = $this->db->get('departement')->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get('coa_tb')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        //$data['ea'] = $this->db->get('departement')->result();
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/addipo', $data);
            $this->load->view('templates/footer');
        } else {
            $this->purchasing->ipo();
            $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='IPO' and status=0 and id_bagian='$bagian_id'");
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('purchasing/dataipo');
        }
    }

    public function addipos() {
        $data['title'] = "Create IPO PR";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->purchasing->ipo();
		$update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='IPO' and status=0 and id_bagian=''");
        $this->session->set_flashdata('flash', 'Ditambah');
        redirect('purchasing/dataipo');
    }

    public function dataipo() {
        $data['title'] = "Data Internal PO";
        $this->load->model('General_model', 'gnrl');
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');
        $data['ipo'] = $this->purchasing->get_data_ipo();
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/dataipo', $data);
        $this->load->view('templates/footer');
    }

    public function viewipo($id) {
        $data['title'] = "View Detail IPO";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $result = [];
        $headeripo = $this->purchasing->get_data_ipo_id($id);
        $result['headeripo'] = $headeripo;
        $ipodetail = $this->purchasing->get_data_ipo_detail_id($id);

        // var_dump($ipodetail);
        // die;

        foreach ($ipodetail as $key => $value) {
            $result['ipodetail'][] = $value;
        }
        $data['ipo'] = $result;

        // var_dump($data['ipo']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/viewipo', $data);
        $this->load->view('templates/footer');
    }

    public function batalipo($id) {

        $data = [
            'is_deleted' => 1,
            'deleted_at' => date("Y-m-d h:i:sa"),
            'deleted_by' => $this->session->userdata('iduser')
        ];
        $this->db->where('id_ipo', $id);
        $this->db->update('ipoheader', $data);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('purchasing/dataipo');
    }

    public function editipo($id) {
        $data['title'] = "Edit Internal PO";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['suplier'] = $this->db->get('suplier')->result();
        $data['loc'] = $this->db->get('departement')->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get('coa_tb')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        $result = [];
        $headeripo = $this->purchasing->get_data_ipo_id($id);
        $result['headeripo'] = $headeripo;
        $ipodetail = $this->purchasing->get_data_ipo_detail_id($id);
        foreach ($ipodetail as $key => $value) {
            $result['ipodetail'][] = $value;
        }
        $data['ipo'] = $result;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/editipo', $data);
        $this->load->view('templates/footer');
    }

    public function updateipo() {
        $data['title'] = "Form Edit Internal PO";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->purchasing->updatedataipo();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('purchasing/dataipo');
    }

    public function addipopr($id) {

        $data['title'] = "Create IPO PR";
        $this->load->model('General_model', 'gnrl');
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');

        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['noipo'] = $this->gnrl->no('IPO');

        $data['suplier'] = $this->db->get('suplier')->result();
        $data['loc'] = $this->db->get('departement')->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get('coa_tb')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'],['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        $result = [];
        $headerpermintaan = $this->purchasing->get_data_header_id($id);
        $result['headerpermintaan'] = $headerpermintaan;
        $detailpermintaan = $this->purchasing->get_data_permintaan_detail_id($id);
        $bagian = $this->session->userdata('hub');
        foreach ($detailpermintaan as $key => $value) {
            $result['detailpermintaan'][] = $value;
        }
        $data['permintaan'] = $result;
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/addipopr', $data);
            $this->load->view('templates/footer');
        } else {
            $pr = $this->db->query("update permintaan_pembelian_header set status_global='1' where id_permintaan='$id'");
            $this->addipospr();
        }
    }

    public function addipospr() {
        /* echo '<pre>';
          echo print_r($_POST);
          echo '</pre>';
          die; */
        $this->load->model('General_model', 'gnrl');
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');

        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();

        $data['title'] = "Create IPO PR";

        $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='IPO' and id_bagian='$bagian_id' and status=0");

        $this->purchasing->ipopr();


        $this->session->set_flashdata('flash', 'Ditambah');
        redirect('purchasing/dataipo');
    }

    public function addipojasanew($id)
    {
        $data['title'] = "Create IPO JASA NEW";
        $this->load->model('General_model', 'gnrl');
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');

        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['noipo'] = $this->gnrl->no('IPO');

        $data['suplier'] = $this->db->get('suplier')->result();
        $data['loc'] = $this->db->get_where('departement', ['kode_loc' => '097'])->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get_where('coa_tb', ['account' => 10])->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'],['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        $result = [];
        $headerjasa = $this->purchasing->get_data_jasa_header_id($id);
        $result['headerjasa'] = $headerjasa;
        $detailjasa = $this->purchasing->get_data_jasa_detail_id($id);
        $bagian = $this->session->userdata('hub');
        foreach ($detailjasa as $key => $value) {
            $result['detailjasa'][] = $value;
        }
        $data['jasa'] = $result;
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/addipoprjasa', $data);
            $this->load->view('templates/footer');
        } else {
            // $this->db->query("update permintaan_jasa_header set status_global='1' where id_permintaan_jasa='$id'");
            $this->db->query("update permintaan_jasa_header set status='3' where id_permintaan_jasa='$id'");
            // $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='IPO' and status=0 and id_bagian='$bagian_id'");        
            // $this->purchasing->ipoprjasa();
            $this->addiposprjasa();
            // redirect('purchasing/dataipo');
        }
    }

    public function addiposprjasa() {
        /* echo '<pre>';
          echo print_r($_POST);
          echo '</pre>';
          die; */
        $this->load->model('General_model', 'gnrl');
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');

        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();

        $data['title'] = "Create IPO PR";

        $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='IPO' and id_bagian='$bagian_id' and status=0");

        // $this->purchasing->ipopr();
        $this->purchasing->ipoprjasa();


        $this->session->set_flashdata('flash', 'Ditambah');
        redirect('purchasing/dataipo');
    }

    public function get_data_supplier_id() {
        $id = $this->input->post('id_suplier', TRUE);
        $data = $this->db->get_where('suplier', ['id_suplier' => $id])->row_array();
        echo json_encode($data);
    }

    public function addpv($id) 
    {
        $data['title'] = "Create Payment Voucher";
        $this->load->model('General_model', 'gnrl');
        $email = $this->session->userdata('email');
        $bagian_id = $this->session->userdata('bagian_id');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['nopv'] = $this->gnrl->no('PV');
        $data['jasa'] = $this->purchasing->get_data_jasa_id($id);
        $data['suplier'] = $this->db->get('suplier')->result();
        $data['loc'] = $this->db->get('departement')->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get('coa_tb')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        //$data['ea'] = $this->db->get('departement')->result();
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/addpv', $data);
            $this->load->view('templates/footer');
        } else {
            $this->purchasing->pv();
            $update = $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='PV' and status=0 and bagian_id='$bagian_id'");
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('purchasing/datapv');
        }
    }

    public function permintaanJasaNew() //permintaan jasa new
    {
        # code...
        // no, tanggal pj, no pj, request, total, status, action
        $data['title'] = 'Permintaan Jasa New';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['permintaanjasa'] = $this->purchasing->getPermintaanJasaNew();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/permintaanjasanew', $data);
        $this->load->view('templates/footer');
    }
    public function viewPermintaanJasaNew($id) //view oermintaan jasa new
    {
        $data['title'] = 'View Permintaan Jasa New';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('General_model', 'gnrl');
        $data['loc'] = $this->db->get('departement')->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get('coa_tb')->result();
        $data['noprjs'] = $this->gnrl->no('PR');
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['satuan'] = $this->db->get('satuan')->result();
        $data['bagian'] = $this->db->get('bagian')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        $data['permintaanbyid'] = $this->purchasing->permintaanJasaNewHeaderDetailId($id);
        // var_dump($data['permintaanbyid']); die; 
        $result = [];
        $headerjasa = $this->purchasing->get_data_jasa_header_id($id);
        $result['headerjasa'] = $headerjasa;
        $detailjasa = $this->purchasing->get_data_jasa_detail_id($id);
        foreach ($detailjasa as $key => $value) {
            $result['detailjasa'][] = $value;
        }
        $data['jasa'] = $result;
        // var_dump($data['jasa']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/viewpermintaanjasanew', $data);
        $this->load->view('templates/footer');

    }
    public function tambahPermintaanJasaNew($id = 0) //tambah oermintaan jasa new
    {
        $data['title'] = 'Tambah Permintaan Jasa New';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('General_model', 'gnrl');
        $data['loc'] = $this->db->get('departement')->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get('coa_tb')->result();
        $data['noprjs'] = $this->gnrl->no('PR');
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['satuan'] = $this->db->get('satuan')->result();
        $data['bagian'] = $this->db->get('bagian')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        $this->form_validation->set_rules('remarks','Remarks', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/tambahPermintaanjasanew', $data);
            $this->load->view('templates/footer');
        } else {
            $this->purchasing->insertPermintaanJasaNew(); //fungsi model untuk insert permintaan_jasa_header dan detai
            $this->session->set_flashdata('flash', 'Ditambah');
            $maxid = $this->purchasing->idmax();
            foreach($maxid as $row){
                // $max = $row->id + 1;
                $max = $row->id;
            }
            redirect('purchasing/editPermintaanJasaNew/' . $max);
        }
    }

    public function editPermintaanJasaNew($id) //edit permintaan jasa new
    {
        $data['title'] = 'Edit Permintaan Jasa New';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('General_model', 'gnrl');
        $data['loc'] = $this->db->get_where('departement', ['kode_loc' => '097'])->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get_where('coa_tb', ['account' => 10])->result();
        $data['noprjs'] = $this->gnrl->no('PR');
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['satuan'] = $this->db->get('satuan')->result();
        $data['bagian'] = $this->db->get('bagian')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        $data['permintaanbyid'] = $this->purchasing->permintaanJasaNewHeaderDetailId($id);
        $data['getgrandtotal'] = $this->purchasing->getGrandTotal($id);
        
        $result = [];
        $headerjasa = $this->purchasing->get_data_jasa_header_id($id);
        $result['headerjasa'] = $headerjasa;
        $detailjasa = $this->purchasing->get_data_jasa_detail_id($id);
        foreach ($detailjasa as $key => $value) {
            $result['detailjasa'][] = $value;
        }
        $data['jasa'] = $result;
        $this->form_validation->set_rules('remarks','Remarks', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/editPermintaanjasanew', $data);
            $this->load->view('templates/footer');
        } else {
            // $this->purchasing->tambahRowPermintaanJasaNew(); //fungsi model untuk insert permintaan_jasa_header dan detai
            $getgrandtotal = $this->purchasing->getGrandTotal($id);
            $loc = $this->input->post('loc_row');
            $ec = $this->input->post('ec_row');
            $na = $this->input->post('na_row');
            $tb = $this->input->post('tb_row');
            $ea = $this->input->post('ea_row');
            // $total = $this->input->post('total_row');
            $data = $this->db->insert('permintaan_jasa_detail', [ //1
                'id_permintaan_jasa' => $this->input->post('id_permintaan_jasa'),
                'deskripsi_jasa' => $this->input->post('deskripsi_jasa_row'),
                'satuan' => $this->input->post('satuan_row'),
                'qty' => $this->input->post('qty_row'),
                'harga' => $this->input->post('harga_row'),
                'total' => $this->input->post('total_row'),
                'coa' => $loc .'-'. $ec .'-'. $na .'-'. $tb .'-'. $ea
            ]);
            // $total = $this->input->post('total_row');
            // $data['getgrandtotal'] = $this->purchasing->getGrandTotal($id);
            // var_dump($grandtotal);
            // die;
            // $grandtotal = $this->input->post('grandtotal');
            // $totalAll = $total + $grandtotal;

            $total = $this->purchasing->getTotal($id); //2
            foreach ($total as $key => $value) {
                $totalAll = $value->total;
            }                      
            $this->db->set('grandtotal', $totalAll);
            $this->db->where('id_permintaan_jasa', $id);
            $this->db->update('permintaan_jasa_header');

            $this->db->where('id_permintaan_jasa', $this->input->post('id_permintaan_jasa'));
            $this->db->update('permintaan_jasa_header', [
                'id_permintaan_jasa' => $this->input->post('id_permintaan_jasa'),
                'bagian_id' => $this->input->post('bagian_id'),
                'tgl_pr_jasa' => $this->input->post('tgl_pr_jasa'),
                'department_id' => $this->input->post('department_id'),
                // 'grandtotal' => $this->db->query("select ($grandtotal+$total) as grandtotal from permintaan_jasa_header")
            ]);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('purchasing/editPermintaanJasaNew/' . $id);
        }
    }

    public function tambahDetailJasaNew($id)
    {
        $data['title'] = 'Tambah Detail Permintaan Jasa New';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('General_model', 'gnrl');
        $data['loc'] = $this->db->get('departement')->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get('coa_tb')->result();
        $data['noprjs'] = $this->gnrl->no('PR');
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['satuan'] = $this->db->get('satuan')->result();
        $data['bagian'] = $this->db->get('bagian')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        
        $result = [];
        $headerjasa = $this->purchasing->get_data_jasa_header_id($id);
        $result['headerjasa'] = $headerjasa;
        $detailjasa = $this->purchasing->get_data_jasa_detail_id($id);
        foreach ($detailjasa as $key => $value) {
            $result['detailjasa'][] = $value;
        }
        $data['jasa'] = $result;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('purchasing/tambahDetailJasaNew', $data);
        $this->load->view('templates/footer');
    }
    public function addRow()
    {
        $this->purchasing->tambahRowPermintaanJasaNew(); //fungsi model untuk insert permintaan_jasa_header dan detai
        $this->session->set_flashdata('flahs', 'Ditambah');
        redirect('purchasing/editPermintaanJasaNew');
    }
    public function deletePermintaanJasaNew($id) // hapus permintaan jasa new
    {
        $this->db->delete('permintaan_jasa_detail', ['id_permintaan_jasa' => $id]);
        $this->db->delete('permintaan_jasa_header', ['id_permintaan_jasa' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('purchasing/permintaanJasaNew');
    }
    public function deletePermintaanJasaNewId($id)
    {
        $query = $this->purchasing->getIdJasaHeader($id);
        foreach($query as $row){
            $idJasa = $row->id;
        }
        $this->db->delete('permintaan_jasa_detail', ['id_jasa_detail' => $id]);
        
        $id = $idJasa;
        $total = $this->purchasing->getTotal($id);
        foreach ($total as $key => $value) {
            $totalAll = $value->total;
        }
        // var_dump($totalAll);
        // die;
        $this->db->set('grandtotal', $totalAll);
        $this->db->where('id_permintaan_jasa', $id);
        $this->db->update('permintaan_jasa_header');

        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('purchasing/editPermintaanJasaNew/' . $id);
    }
    public function simpanJasaAll()
    {
        $id = $this->input->post('id_permintaan_jasa');
        // $grandtotal = $this->input->post('grandtotal');
        // $budget = $this->input->post('budget_reserved');
        // $remarks = $this->input->post('remarks');
        // $this->db->set('grandtotal', $grandtotal);
        // $this->db->set('budget_reserved', $budget);
        // $this->db->set('remarks', $remarks);
        $data = [
            // 'budget_reserved' => $this->input->post('budget_reserved'),
            // 'remarks' => $this->input->post('remarks'),
            'grandtotal' => $this->input->post('grandtotal')
        ];
        $this->db->where('id_permintaan_jasa', $id);
        $this->db->update('permintaan_jasa_header', $data);

       $this->session->set_flashdata('flash', 'Diubah');
       redirect('purchasing/permintaanJasaNew/');
    //    redirect('purchasing/editPermintaanJasaNew/' . $id);
    }

    function coa() {
        $data = $this->db->get('departement')->result_array();
        echo json_encode($data);
    }

    function ec()
    {
        $data = $this->db->get('coa_ec')->result_array();
        echo json_encode($data);
    }
    function tb()
    {
        $data = $this->db->get('coa_tb')->result_array();
        echo json_encode($data);
    }
    function na()
    {
        $data = $this->db->get('coa_na')->result_array();
        echo json_encode($data);
    }
    function satuan(){
        $data = $this->db->get('satuan')->result_array();
        echo json_encode($data);
    }

    public function editDetail($id)
    {
        $data['title'] = 'Edit Permintaan Jasa New Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('General_model', 'gnrl');
        $data['loc'] = $this->db->get_where('departement', ['kode_loc' => '097'])->result();
        $data['ec'] = $this->db->get('coa_ec')->result();
        $data['na'] = $this->db->get('coa_na')->result();
        $data['tb'] = $this->db->get_where('coa_tb', ['account' => 10])->result();
        $data['noprjs'] = $this->gnrl->no('PR');
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
        $data['satuan'] = $this->db->get('satuan')->result();
        $data['bagian'] = $this->db->get('bagian')->result();
        $data['ppn'] = [['nppn' => 1, 'persen' => '1%'], ['nppn' => 10, 'persen' => '10%'], ['nppn' => 11, 'persen' => '11%']];
        $data['pph'] = [['npph' => 2, 'persen' => '2%'], ['npph' => 4, 'persen' => '4%'], ['npph' => 10, 'persen' => '10%']];
        $data['permintaanbyid'] = $this->purchasing->permintaanJasaNewHeaderDetailId($id);
        $data['detailJasa'] = $this->purchasing->detailJasa($id);
        // $detail = $this->purchasing->detailJasa($id);
        // var_dump($detail);
        // die;

        $this->form_validation->set_rules('deskripsi_jasa', 'Deskripsi Jasa', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/editPermintaanjasanewDetail', $data);
            $this->load->view('templates/footer');
        } else {
            $query = $this->purchasing->getIdJasaHeader($id);
            foreach($query as $row){
                $idJasa = $row->id;
            }
            // var_dump($idJasa);
            // die;

            $loc = $this->input->post('loc');
            $ec = $this->input->post('ec');
            $na = $this->input->post('na');
            $tb = $this->input->post('tb');
            $ea = $this->input->post('ea');
            $data = [
                'deskripsi_jasa' => $this->input->post('deskripsi_jasa'),
                // 'coa' => $this->input->post('coa'),
                'coa' => $loc.'-'.$ec.'-'.$na.'-'.$tb.'-'.$ea.'-'.'000',
                'satuan' => $this->input->post('satuan'),
                'qty' => $this->input->post('qty'),
                'harga' => $this->input->post('harga'),
                'total' => $this->input->post('total')
            ];

            $this->db->where('id_jasa_detail', $id);
            $this->db->update('permintaan_jasa_detail', $data);
            $this->session->set_flashdata('flash', 'Diubah');

            $id = $idJasa;
            $total = $this->purchasing->getTotal($id);
            foreach ($total as $key => $value) {
                $totalAll = $value->total;
            }
            // var_dump($totalAll);
            // die;
            $this->db->set('grandtotal', $totalAll);
            $this->db->where('id_permintaan_jasa', $id);
            $this->db->update('permintaan_jasa_header');

            redirect('purchasing/editPermintaanJasaNew/' . $id);
        }
    }

    public function editHeader($id) //tambah oermintaan jasa new
    {
        $data['title'] = 'Edit Header';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['header'] = $this->purchasing->getEditHeader($id);
        $this->form_validation->set_rules('remarks','Remarks', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('purchasing/editHeader', $data);
            $this->load->view('templates/footer');
        } else {
            $this->purchasing->editHeader($id); //fungsi model untuk insert permintaan_jasa_header dan detai
            $this->session->set_flashdata('flash', 'Diubah');
            
            redirect('purchasing/editPermintaanJasaNew/' . $id);
        }
    }
}
