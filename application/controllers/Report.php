<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('mypdf');
        $this->load->model('Finance_model', 'finance');
        $this->load->model('Driver_model', 'driver');
        $this->load->helper('terbilang');
        $this->load->model('Report_model', 'report');
        $this->load->model('Wo_model', 'wo');
        $this->load->model('Purchasing_model', 'purchasing');
    }

    function printcashbon($id) {

        $data['title'] = "Cetak Kasbon";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['pettycash'] = $this->finance->getDataPettycashId($id);
        $nilai = number_format($data['pettycash']['jmlajuan'], 0);
        $conversi = str_replace([','], [''], $nilai);
        $data['terbilang'] = ucwords(number_to_words($conversi)) . " Rupiah";



        $html = $this->load->view('report/printcashbon', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 148.5]]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function printbskantorpusat($id) {
        $data['title'] = "Bon Sementara Pusat";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['bspusat'] = $this->report->getAllDataBsKantorPusatById($id);
        $nilai = number_format($data['bspusat']['jumlah'], 0);
        $conversi = str_replace([','], [''], $nilai);
        $data['terbilang'] = ucwords(number_to_words($conversi)) . " Rupiah";


        //$this->mypdf->generate('report/printbspusat', $data, 'barang keluar', 'A4', 'potrait');
        $html = $this->load->view('report/printbspusat', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function cetakkasbank($id) {

        $data['title'] = "Kas Bank";

        $this->db->select('transaksi.*, suplier.*, departement.*');
        $this->db->from('transaksi');
        $this->db->join('suplier', 'transaksi.idsuplier = suplier.id_suplier', 'left');
        $this->db->join('departement', 'transaksi.hub = departement.id_departement');
        $this->db->where('id_transaksi', $id);
        $data['trans'] = $this->db->get()->row_array();

        $nilai = number_format($data['trans']['total'], 0);
        $conversi = str_replace([','], [''], $nilai);
        $data['terbilang'] = ucwords(number_to_words($conversi)) . " Rupiah";


        $this->db->where('id_transaksi', $id);
        $data['trandetail'] = $this->db->get('transaksi_detail')->result_array();


        $html = $this->load->view('report/kasbank', $data, true);
        //$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 148.5]]);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function cetakkasbank1($id) {

        $data['title'] = "Kas Bank";

        $data['trans'] = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();
        $nilai = number_format($data['trans']['total'], 0);
        $conversi = str_replace([','], [''], $nilai);
        $data['terbilang'] = ucwords(number_to_words($conversi)) . " Rupiah";


        $this->db->where('id_transaksi', $id);
        $data['trandetail'] = $this->db->get('transaksi_detail')->result_array();


        $html = $this->load->view('report/kasbank1', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 148.5]]);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function cetakkasbankbank($id) {

        $data['title'] = "Kas Bank";

        $this->db->select('transaksi.*, suplier.*, departement.nama');
        $this->db->from('transaksi');
        $this->db->join('suplier', 'transaksi.idsuplier = suplier.id_suplier', 'left');
        $this->db->join('departement', 'transaksi.hub = departement.id_departement');
        $this->db->where('id_transaksi', $id);
        $data['trans'] = $this->db->get()->row_array();

        $nilai = number_format($data['trans']['total'], 0);
        $conversi = str_replace([','], [''], $nilai);
        $data['terbilang'] = ucwords(number_to_words($conversi)) . " Rupiah";


        $this->db->where('id_transaksi', $id);
        $data['trandetail'] = $this->db->get('transaksi_detail')->result_array();

        // var_dump($data['trans']);
        // die;

        $html = $this->load->view('report/kasbank-bank', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 148.5]]);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

// cetak outstanding bs
    public function cetakosbs($tgl = null) {


        $data['dc'] = $this->db->get_where('departement', ['id_departement' => $this->session->userdata('hub')])->row();


        if ($tgl == null) {
            $this->db->select('transaksi_department.*, departement.nama');
            $this->db->from('transaksi_department');
            $this->db->join('departement', 'departement.id_departement = transaksi_department.id_dept');
            $this->db->where('status ', 2);
            $sql = $this->db->get()->result_array();
        } else {

            $this->db->select('transaksi_department.*, departement.nama');
            $this->db->from('transaksi_department');
            $this->db->join('departement', 'departement.id_departement = transaksi_department.id_dept');
            $this->db->where('tgl_terima <=', $tgl);
            $this->db->where('status ', 2);
            $sql = $this->db->get()->result_array();
        }

        $data['lap'] = $sql;
        $data['tgl'] = $tgl;


        $html = $this->load->view('report/cetakosbs', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function cetakbelumapprove($tgl = null) {

        $data['dc'] = $this->db->get_where('departement', ['id_departement' => $this->session->userdata('hub')])->row();

        if ($tgl == null) {

            $this->db->select('transaksi_department.*, departement.nama');
            $this->db->from('transaksi_department');
            $this->db->join('departement', 'departement.id_departement = transaksi_department.id_dept');
            $this->db->where('status ', 1);
            $sql = $this->db->get()->result_array();
        } else {

            $this->db->select('transaksi_department.*, departement.nama');
            $this->db->from('transaksi_department');
            $this->db->join('departement', 'departement.id_departement = transaksi_department.id_dept');
            $this->db->where('tanggal<=', $tgl);
            $this->db->where('status ', 1);
            $sql = $this->db->get()->result_array();
        }

        $data['lap'] = $sql;
        $data['tgl'] = $tgl;


        $html = $this->load->view('report/ctkbelumapprove', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function cetakrealisasi($tgl = null) {

        $data['dc'] = $this->db->get_where('departement', ['id_departement' => $this->session->userdata('hub')])->row();

        if ($tgl == null) {

            $this->db->select('transaksi_department.*, departement.nama');
            $this->db->from('transaksi_department');
            $this->db->join('departement', 'departement.id_departement = transaksi_department.id_dept');
            $this->db->where('status >', 2);
            $sql = $this->db->get()->result_array();
        } else {

            $this->db->select('transaksi_department.*, departement.nama');
            $this->db->from('transaksi_department');
            $this->db->join('departement', 'departement.id_departement = transaksi_department.id_dept');
            $this->db->where('tgl_realisasi <=', $tgl);
            $this->db->where('status ', 2);
            $sql = $this->db->get()->result_array();
        }

        $data['lap'] = $sql;
        $data['tgl'] = $tgl;


        $html = $this->load->view('report/realisasibs', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function kasbank() {
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');


        $data['dc'] = $this->db->get_where('departement', ['id_departement' => $this->session->userdata('hub')])->row();
        if ($startdate == null And $enddate == null) {
            $sql = $this->db->get('transaksi')->result_array();
        } else {
            $this->db->where('tgl_pengajuan >=', $startdate);
            $this->db->where('tgl_pengajuan <=', $enddate);
            $sql = $this->db->get('transaksi')->result_array();
        }

        $data['kasbank'] = $sql;



        $data['tanggal'] = [
            'start' => $startdate,
            'end' => $enddate
        ];


        $html = $this->load->view('report/lapkasbank', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function reimburst() {
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');

        $data['dc'] = $this->db->get_where('departement', ['id_departement' => $this->session->userdata('hub')])->row();

        if ($startdate == null And $enddate == null) {
            $this->db->where('status', 1);
            $sql = $this->db->get('transaksi')->result_array();
        } else {
            $this->db->where('tgl_pengajuan >=', $startdate);
            $this->db->where('tgl_pengajuan <=', $enddate);
            $this->db->where('status', 1);
            $sql = $this->db->get('transaksi')->result_array();
        }

        $data['kasbank'] = $sql;



        $data['tanggal'] = [
            'start' => $startdate,
            'end' => $enddate
        ];



        $html = $this->load->view('report/lapreimburst', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function realisasi() {
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');

        $data['dc'] = $this->db->get_where('departement', ['id_departement' => $this->session->userdata('hub')])->row();
        if ($startdate == null And $enddate == null) {

            $this->db->where('status', 2);
            $sql = $this->db->get('transaksi')->result_array();
        } else {
            $this->db->where('tgl_penerima >=', $startdate);
            $this->db->where('tgl_penerima <=', $enddate);
            $this->db->where('status', 2);
            $sql = $this->db->get('transaksi')->result_array();
        }

        $data['kasbank'] = $sql;



        $data['tanggal'] = [
            'start' => $startdate,
            'end' => $enddate
        ];



        $html = $this->load->view('report/laprealisasi', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function belumprosesho() {
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');

        $data['dc'] = $this->db->get_where('departement', ['id_departement' => $this->session->userdata('hub')])->row();
        if ($startdate == null And $enddate == null) {
            $this->db->where('status', 0);
            $sql = $this->db->get('transaksi')->result_array();
        } else {
            $this->db->where('tgl_pengajuan >=', $startdate);
            $this->db->where('tgl_pengajuan <=', $enddate);
            $this->db->where('status', 0);
            $sql = $this->db->get('transaksi')->result_array();
        }

        $data['kasbank'] = $sql;



        $data['tanggal'] = [
            'start' => $startdate,
            'end' => $enddate
        ];


        $html = $this->load->view('report/belumprosesho', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function kasbankhobelumrealisasi() {
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');

        $data['dc'] = $this->db->get_where('departement', ['id_departement' => $this->session->userdata('hub')])->row();
        if ($startdate == null And $enddate == null) {
            $this->db->where('status', 1);
            $sql = $this->db->get('transaksi')->result_array();
        } else {
            $this->db->where('tgl_proses >=', $startdate);
            $this->db->where('tgl_proses <=', $enddate);
            $this->db->where('status', 1);
            $sql = $this->db->get('transaksi')->result_array();
        }

        $data['kasbank'] = $sql;



        $data['tanggal'] = [
            'start' => $startdate,
            'end' => $enddate
        ];


        $html = $this->load->view('report/kasbankhobelumreal', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function cetakposisi() {
        $id = $this->uri->segment(3);


        $this->db->where('department_id', $id);
        $data['validasi'] = $this->db->get('validasi')->result();

        $this->db->where('department_id', $id);
        $data['totalrows'] = $this->db->get('validasi')->num_rows();

        $query = " SELECT sum(jumlah*pecahan) as total
              FROM validasi
              WHERE department_id= '$id'
             GROUP BY department_id
           ";
        $data['nominal'] = $this->db->query($query)->row_array();



        // $this->db->select('*');
        // $this->db->from('posisikas');
        // $this->db->join('departement', 'departement.id_departement = posisi.id_department');
        // $this->db->where('id_department', $id);
        // $data['tes'] = $this->db->get()->row_array();


        $data['judul'] = "Posisi Kas";

        $this->db->select('*');
        $this->db->from('posisikas');
        $this->db->join('departement', 'departement.id_departement = posisikas.id_department');
        $this->db->where('id_department', $id);
        $data['posisi'] = $this->db->get()->row();

        $html = $this->load->view('report/posisikas', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function ikhtisar($id) {

        $data['ikhtisar'] = $this->db->get_where('ikhtisar_detail', ['id_ikhtisar' => $id])->result();



        $this->db->select('SUM(total) as total');
        $this->db->from('ikhtisar_detail');
        $this->db->where('id_ikhtisar', $id);
        $hasil = $this->db->get()->row()->total;


        $nilai = number_format($hasil, 0);
        $conversi = str_replace([','], [''], $nilai);
        $data['terbilang'] = ucwords(number_to_words($conversi)) . " Rupiah";



        $this->db->where('id_ikhtisar', $id);
        $ikhtisar = $this->db->get('ikhtisar_header')->row();
        $iddept = $ikhtisar->id_lokasi;


        $data['ikh'] = $this->db->get_where('ikhtisar_header', ['id_ikhtisar' => $id])->row();
        $data['saldoawal'] = $this->db->get_where('departement', ['id_departement' => $iddept])->row();
        $data['posisi'] = $this->db->get_where('posisikas', ['id_department' => $iddept])->row();

        $this->db->where('department_id', $iddept);
        $data['validasi'] = $this->db->get('validasi')->result();







        $html = $this->load->view('report/ikhtisar', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function printwo($id) {

        $data['title'] = "Cetak WorkOrder";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['wo'] = $this->wo->wo($id);
        $html = $this->load->view('report/printworkorder', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function truckdetail() {

        $data['title'] = "Cetak Service Truck";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Truck_model', 'truck');

        if ($this->input->post('submit')) {
            $tgl1 = $this->input->post('tgl1');
            $tgl2 = $this->input->post('tgl2');
        } else {
            $tgl1 = null;
            $tgl2 = null;
        }
        $data['headers'] = $this->truck->gettruck();
        foreach ($headers as $data) {
            
        }

        $data['truck_detail'] = $this->truck->truck_detail_tgl($tgl1, $tgl2, $id);

        $html = $this->load->view('ekspedisi/report/printdetailtruck', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function printbbm($id) {

        $data['title'] = "Cetak BBM";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['bbm'] = $this->driver->bbm($id);
        //  var_dump($data);



        $html = $this->load->view('report/printbbm', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function printpr($id) {

        $data['title'] = "Cetak PR";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $result = [];
        $headerpermintaan = $this->purchasing->get_data_header_id($id);
        $result['headerpermintaan'] = $headerpermintaan;
        $detailpermintaan = $this->purchasing->get_data_permintaan_detail_id($id);

        foreach ($detailpermintaan as $key => $value) {
            $result['detailpermintaan'][] = $value;
        }
        $data['permintaan'] = $result;
        // $data['pr'] = $this->purchasing->pr($id);
        //  var_dump($data);

        $html = $this->load->view('report/printpr', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function printprjasanew($id) {

        $data['title'] = "Cetak PR Jasa New";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $result = [];
        $headerjasa = $this->purchasing->get_data_jasa_header_id($id);
        $result['headerjasa'] = $headerjasa;
        $detailjasa = $this->purchasing->get_data_jasa_detail_id($id);

        foreach ($detailjasa as $key => $value) {
            $result['detailjasa'][] = $value;
        }
        $data['jasa'] = $result;
        // $data['pr'] = $this->purchasing->pr($id);
        //  var_dump($data);

        $html = $this->load->view('report/printprjasanew', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function cetaklaporanwo() {

        $data['title'] = "Cetak Laporan Workorder";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $startdate = $this->input->post('tgl1');
        $enddate = $this->input->post('tgl2');


        if (!empty($startdate) && !empty($enddate)) {

            $sql = $this->db->query("select a.*,b.*,c.* from truck a join permintaan_pengerjaan b on a.id_truck=b.id_truck join user c on a.id_user=c.id where tgl_order between '$startdate' and '$enddate' and b.is_deleted=0")->result_array();
            $dts = array();
            foreach ($sql as $row) {
                $kode = $row['id_truck'];
                $detail = $this->db->query("select a.*,b.*,c.* from truck a join permintaan_pengerjaan b on a.id_truck=b.id_truck join user c on a.id_user=c.id where b.id_truck='$kode' and b.is_deleted=0")->result_array();
                ;
                foreach ($detail as $dt) {
                    $dts[] = ['tgl_order' => $dt['tgl_order'],
                        'no_wo' => $dt['no_pengerjaan'],
                        'id_truck' => $row['id_truck']
                    ];
                }
            }
        } else {
            $this->db->select('a.no_urut, a.no_polisi, a.driver_id, a.helper_id, b.*, c.kode_bagian, c.nama_bagian, c.kepala_bagian, d.name, d.role_id');
            $this->db->from('truck a');
            $this->db->join('permintaan_pengerjaan b', 'a.id_truck=b.id_truck');
            $this->db->join('bagian c', 'c.idbagian=b.id_bagian');
            $this->db->join('user d', 'd.id=b.id_user');
            //$this->db->where('b.tgl_order >=', $startdate);
            //$this->db->where('b.tgl_order <=', $enddate);
            $sql = $this->db->get()->result_array();
        }

        $data['rptwo'] = $sql;
        $data['detail'] = $dts;
        $data['start'] = $this->uri->segment(3);

        $data['tanggal1'] = [
            'start' => $startdate,
            'end' => $enddate
        ];

        $html = $this->load->view('report/laporanwo', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function reportwoexcel() {

        $startdate = $this->input->post('tgl1');
        $enddate = $this->input->post('tgl2');


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
      //  $header = $this->db->query("select id_truck from permintaan_pengerjaan where tgl_order between '$startdate' and '$enddate' and is_deleted=0")->result_array();
      //  foreach ($header as $d) {
            
            
            $n = 1;
            $id=$d['id_truck'];
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'No Polisi'); 
            $sheet->setCellValue('C1', 'Tanggal Request');
            $sheet->setCellValue('D1', 'No Pengerjaan');
            $sheet->setCellValue('E1', 'Tanggal Cek');
            $sheet->setCellValue('F1', 'PIC Pengecekan');
            $sheet->setCellValue('G1', 'Kategori');
            $sheet->setCellValue('H1', 'Nama Supir');
            $sheet->setCellValue('I1', 'Keterangan Request');
            $sheet->setCellValue('J1', 'Keterangan Komponen');
            $sheet->setCellValue('K1', 'Keterangan Pengerjaan');
            $sql = $this->db->query("select a.*,b.*,c.* from truck a join permintaan_pengerjaan b on a.id_truck=b.id_truck join user c on a.id_user=c.id where b.tgl_order between '$startdate' and '$enddate' and b.is_deleted=0 and b.id_truck='$id'")->result_array();

            $no = 1;
            $x = 2;
            foreach ($sql as $row) {
                $sheet->setCellValue('A' . $x, $no++);
                $sheet->setCellValue('B' . $x, $row['no_polisi']);
                $sheet->setCellValue('C' . $x, $row['tgl_order']);
                $sheet->setCellValue('D' . $x, $row['no_pengerjaan']);
                $sheet->setCellValue('E' . $x, $row['tanggal_cek']);
                $sheet->setCellValue('F' . $x, $row['pic_cek']);
                $sheet->setCellValue('G' . $x, $row['categori']);
                $sheet->setCellValue('H' . $x, $row['deskripsi_supir']);
                $sheet->setCellValue('I' . $x, $row['deskripsi_peminta']);
                $sheet->setCellValue('J' . $x, $row['deskripsi_komponen']);
                $sheet->setCellValue('K' . $x, $row['deskripsi_perkerja']);
              

                $x++;
            }
        //}
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan-service';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    public function cetakbelijasa($id)
        {

                $data['title'] = "Cetak Permintaan Jasa";
                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                //$this->load->model('Purchasing_model','purchasing');
                $data['jasa']= $this->purchasing->get_data_jasa_id($id);
              //  var_dump($data);

                $html = $this->load->view('report/printjasa', $data, true);
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
                $mpdf->WriteHTML($html);
                $mpdf->Output();
            }
            public function cetakipo($id)
            {

              $data['title'] = "Cetak IPO";
              $email = $this->session->userdata('email');
			  //$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			  $data['user'] = $this->db->query("select a.*,b.* from user a join bagian b on a.bagian_id=b.idbagian where a.email='$email'")->row_array();
    
              $result = [];
              $headeripo = $this->purchasing->get_data_ipo_id($id);
              $result['headeripo'] = $headeripo;
              $detailipo = $this->purchasing->get_data_ipo_detail_id($id);
             
              foreach ($detailipo as $key => $value) {
                  $result['detailipo'][] = $value;
              }
              $data['ipo'] = $result;
    
                    $html = $this->load->view('report/printdetailipo', $data, true);
                    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
                    $mpdf->WriteHTML($html);
                    $mpdf->Output();
          }

}


