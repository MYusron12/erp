<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_STRICT | E_ALL);
require FCPATH . 'vendor/autoload.php';
require_once BASEPATH . 'core/CodeIgniter.php';

class Finance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('Finance_model', 'fin');
        //$this->db2=$this->load->database('oracle', TRUE);
    }

    public function index() {

        $this->session->unset_userdata('keyword');

        $data['title'] = "Petty-cash List";
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
        $config['base_url'] = $base . "finance/index";

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

        $this->load->model('Finance_model', 'pettycash');

        $data['pettycash'] = $this->pettycash->getAllDataPettyCash($config['per_page'], $data['start'], $data['keyword']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/index', $data);
        $this->load->view('templates/footer');
    }

    public function pettycashprocess($id) {

        $data['title'] = "Petty-cash Process";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('finance_model', 'pettycash');
        $data['pettycash'] = $this->pettycash->getDataPettycashId($id);

        $data['department'] = $this->db->get('departement')->result_array();



        $this->form_validation->set_rules('approvedby', 'Approved By', 'required');
        $this->form_validation->set_rules('ammount', 'Ammount', 'required');
        $this->form_validation->set_rules('receivedby', 'Received By', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('finance/pettycashprocess', $data);
            $this->load->view('templates/footer');
        } else {

            $idtransdept = $this->input->post('id_transaksi_dept');
            $iddepartment = $this->input->post('iddepartment');
            $ammount = $this->input->post('ammount');
            $simpan = str_replace(['.', ','], ['', '.'], $ammount);


            $data = [
                'tgl_setuju' => date('Y-m-d', strtotime($this->input->post('approvaldate'))),
                'disetujui' => $this->input->post('approvedby'),
                'jumlah' => $simpan,
                'penerima' => $this->input->post('receivedby'),
                'tgl_terima' => date('Y-m-d', strtotime($this->input->post('receivingdate'))),
                'status' => 1
            ];

            $this->db->where('id_transaksi_dept', $idtransdept);
            $this->db->update('transaksi_department', $data);



            $this->db->query("update departement set pinjem=pinjem+$simpan 
           where id_departement=$iddepartment");

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Finished Processed..
         </div>');
            redirect('finance');
        }
    }

    public function realization() {

        $this->session->unset_userdata('keyword');

        $data['title'] = "Realization";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Finance_model', 'finance');

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
        $config['base_url'] = $base . "finance/realization/index";

        $params['conditions'] = [
            'status' => 1
        ];

        $this->db->group_start();
        $this->db->like('pemohon', $data['keyword']);
        $this->db->or_like('nama', $data['keyword']);
        $this->db->or_like('no_bs', $data['keyword']);
        $this->db->or_like('no_kas_bank', $data['keyword']);
        $this->db->group_end();

        $this->db->select('transaksi_department.*, departement.nama');
        $this->db->from('transaksi_department');
        $this->db->join('departement', 'transaksi_department.id_department = departement.id_departement');
        $where = $params['conditions'];
        $this->db->where($where);
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 12;

        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(4);

        $data['realization'] = $this->finance->getDataRealization($config['per_page'], $data['start'], $data['keyword']);

        $this->form_validation->set_rules('realization', 'Realization', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('finance/realization', $data);
            $this->load->view('templates/footer');
        } else {

            $iddepartment = $this->input->post('iddepartment');
            $idtransdept = $this->input->post('idtransaksidept');
            $date = date('Y-m-d', strtotime($this->input->post('realizationdate')));
            $credittotal = $this->input->post('credittotal');
            $realization = $this->input->post('realization');
            $balance = $this->input->post('balance');
            $note = $this->input->post('note');
            $realization1 = str_replace(['.', ','], ['', '.'], $realization);

            $balance1 = str_replace(['.', ','], ['', '.'], $balance);


            $data = [
                'tgl_realisasi' => $date,
                'terpakai' => $realization1,
                'selisih' => $balance1,
                'tgl_hapus' => date("Y-m-d"),
                'keterangan' => $note,
                'status' => 2
            ];

            $this->db->where('id_transaksi_dept', $idtransdept);
            $this->db->update('transaksi_department', $data);

            $this->db->query("update departement set realisasi=realisasi+$realization1, saldo=saldo+$balance1
            where id_departement = $iddepartment");

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           The Realization have been proccesed..
           </div>');

            redirect('finance/realization');
        }
    }

    public function getchangedRealization() {
        $id = $this->input->post('id');

        $this->load->model('Finance_model', 'finance');

        echo json_encode($data['finance'] = $this->finance->getchangeRealizationById($id));
    }

    public function realizationstatus() {



        $data['title'] = "Realization Status";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Finance_model', 'finance');

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
        $config['base_url'] = $base . "finance/realizationstatus/index";

        $params['conditions'] = [
            'status' => 2
        ];

        $this->db->group_start();
        $this->db->like('pemohon', $data['keyword']);
        $this->db->or_like('nama', $data['keyword']);
        $this->db->or_like('no_bs', $data['keyword']);
        $this->db->or_like('no_kas_bank', $data['keyword']);
        $this->db->group_end();

        $this->db->from('transaksi_department');
        $this->db->join('departement', 'transaksi_department.id_department = departement.id_departement');
        $params['conditions'] = ['status >=' => 1];
        $where = $params['conditions'];
        $this->db->where($where);
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 12;


        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(4);



        $data['realizationstatus'] = $this->finance->getDataRealizationStatus($config['per_page'], $data['start'], $data['keyword']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/realizationstatus', $data);
        $this->load->view('templates/footer');

        $this->session->unset_userdata('keyword');
    }

    public function posisikas() {

        $data['title'] = "Posisi Kas";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['department'] = $this->db->get('departement')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/posisikas', $data);
        $this->load->view('templates/footer');
    }

    public function kasprocess() {

        $data['title'] = "Result Process";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Finance_model', 'finance');

        $date = date('Y-m-d', strtotime($this->input->post('dateposisi')));
        $iddc = $this->input->post('department_id');

        $data['dc'] = $this->db->get_where('departement', ['id_departement' => $iddc])->row_array();

        $data['bills'] = $this->db->get_where('validasi', ['department_id' => $iddc])->result_array();

        $data['result'] = $this->finance->getDataResult($iddc, $date);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/posisikasproses', $data);
        $this->load->view('templates/footer');
    }

    public function managetransaction() {


        $data['title'] = "Ikhtisar Kas Kecil";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Finance_model', 'finance');

        $data['transHead'] = $this->finance->getAllDataTransHeader();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/transaksiindex', $data);
        $this->load->view('templates/footer');
    }

    public function transaksiproses() {

        $data['title'] = "Transaction Process";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');



        $data['suplier'] = $this->finance->getDataSuplier();

        $this->db->where('status', 2);
        $data['bsno'] = $this->db->get('transaksi_department')->result_array();

        $data['loc'] = $this->db->get('departement')->result_array();
        $data['ec'] = $this->db->get('coa_ec')->result_array();
        $data['na'] = $this->db->get('coa_na')->result_array();
        $data['tb'] = $this->db->get('coa_tb')->result_array();

        $this->form_validation->set_rules('cashbankno', 'No Cash / Bank', 'required');
        $this->form_validation->set_rules('ecinput[]', 'EC', 'required');
        $this->form_validation->set_rules('nainput[]', 'NA', 'required');
        $this->form_validation->set_rules('tbinput[]', 'TB', 'required');
        $this->form_validation->set_rules('bsnoinput[]', 'BS No', 'required');



        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('finance/transaksiprocess', $data);
            $this->load->view('templates/footer');
        } else {


            $this->finance->simpantransaksi();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data have been saved.
         </div>');
            redirect('finance/managetransaction');
        }
    }

    public function updatetrans($id) {
        $data['title'] = "Edit Transaction";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');

        $data['suplier'] = $this->finance->getDataSuplier();

        $this->db->where('status', 2);
        $data['bsno'] = $this->db->get('transaksi_department')->result_array();

        $data['loc'] = $this->db->get('departement')->result_array();
        $data['ec'] = $this->db->get('coa_ec')->result_array();
        $data['na'] = $this->db->get('coa_na')->result_array();
        $data['tb'] = $this->db->get('coa_tb')->result_array();

        $data['uri'] = $this->uri->segment(3);



        $result = [];
        $transaksi = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();

        $result['trans'] = $transaksi;
        $transitem = $this->db->get_where('transaksi_detail', ['id_transaksi' => $id])->result_array();

        foreach ($transitem as $k => $v) {
            $result['items'][] = $v;
        }

        $data['transaksi'] = $result;

        $this->form_validation->set_rules('cashbankno', 'No Cash / Bank', 'required');
        // $this->form_validation->set_rules('ecinput[]', 'EC', 'required');
        // $this->form_validation->set_rules('nainput[]', 'NA', 'required');
        // $this->form_validation->set_rules('tbinput[]', 'TB', 'required');
        $this->form_validation->set_rules('bsnoinput[]', 'BS No', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('finance/edittransproces', $data);
            $this->load->view('templates/footer');
        } else {

            $this->finance->updatetransaksi($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data have been Changed.
         </div>');
            redirect('finance/managetransaction');
        }
    }

    public function hapus($id) {
        $this->db->where('id_transaksi', $id);
        $deltrans = $this->db->delete('transaksi');

        $this->db->where('id_transaksi', $id);
        $deldetail = $this->db->delete('transaksi_detail');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Data have been Deleted.
         </div>');
        redirect('finance/managetransaction');
    }

    public function getDataNumber() {
        $this->load->model('Finance_model', 'finance');
        $id = $this->input->post('id');

        echo json_encode($this->finance->getBankCashNo($id));
    }

    public function getDataBs() {

        $this->load->model('Finance_model', 'finance');
        echo json_encode($this->finance->getAllDataBsNo());
    }

    public function getBsValueById() {
        $this->load->model('Finance_model', 'finance');

        $bsno_id = $this->input->post('id');

        if ($bsno_id) {
            $bsno_data = $this->finance->getBsnoId($bsno_id);
            echo json_encode($bsno_data);
        }
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

    public function prepare() {
        $data['title'] = "Kirim & Reset email";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $data['blm'] = $this->finance->count_invoice_blm();
        $data['sdh'] = $this->finance->count_invoice_sudah();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/prepare', $data);
        $this->load->view('templates/footer');
    }
    
     public function delete() {
        $data['title'] = "Kirim & Reset email";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $update = $this->db->query("truncate ar_aging");
        redirect('finance/prepare');
    }
    public function emailcust() {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya


        $mail = new PHPMailer(true);

        //$body = file_get_contents('contents.html');

        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPKeepAlive = true; //SMTP connection will not close after each email sent, reduces SMTP overhead
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'm081250@matahari.co.id';
        $mail->Password = 'Matahari11';
        $mail->setFrom('widian.tikasari@matahari.co.id', 'Collection DC Balaraja');
        $mail->addReplyTo('desitilia.erawati@matahari.co.id', 'Collection DC Balaraja');

        $mail->Subject = 'OUSTANDING CUSTOMER';
        //$body = file_get_contents('excel/content.html');
//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
       // $mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        
//Connect to the database and select the recipients from your mailing list that have not yet been sent to
//You'll need to alter this to match your database
        $data['title'] = "Petty-cash List";
        $cust = $this->db->query("select * from customer where flag='0' limit 10")->result_array();
        $data['list'] = $this->db->get('customer')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        foreach ($cust as $row) {
            $kode = $row['no'];
            $date = date("Y-m-d");
            $ids=$row['no'];
            $agings = $this->db->query("select sum(os) as t from ar_aging  where no_cs='$ids'")->result_array();
            foreach ($agings as $datas) {
            $total= number_format($datas['t'],2);
            $mail->msgHTML('<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
	<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-zv4m{border-color:#ffffff;text-align:left;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-zv4m" colspan="5">Dengan Hormat,</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Terima kasih atas kepercayaan anda telah memilih kami sebagai mitra transporter anda.<br>Berikut adalah data invoice yang belum kami terima pembayaranya sebesar <strong>Rp.'.$total.'</strong>. (Detail file terlampir)<br>Mohon konfirmasi dan informasi untuk jadwal pembayaran atas invoice tersebut.</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Untuk pembayaran data ditransfer ke nomor rekening di bawah ini:</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"><span style="font-weight:bold">Invoice atas nama PT. Matahari Department Store, TBK</span><br>Bank : CIMB Niaga<br>Cabang : Graha Sudirman<br>No Rekening : 800036037500<br>Atas Nama : PT. Matahari Department Store, TBK<br></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"><span style="font-weight:bold">Invoice atas nama PT. Matahari Nusantara Logistik</span><br>Bank : CIMB Niaga<br>Cabang : Menara Asia Karawaci<br>No Rekening : 704698804800<br>Atas Nama : PT. Matahari Nusantara Logistik</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Jika ada pertanyaan/ masalah mengenai invoice tersebut harap menghubungi kami di 021-595-4846/47 (Tika/Era)</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Atas perhatianya kami ucapkan terima kasih banyak.</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Best regards,</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Collection DC Balaraja</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5" rowspan="2">Kawasan Industri Graha Balaraja<br>Jl. Raya Serang KM 26-27, Desa Tobat, <br>Kec. Balaraja, Kab. Tangerang - Banten 15610<br>Telp : (021) 5954846–47 Ext. 8109</td>
  </tr>
  <tr>
  </tr>
</tbody>
</table>
</html>');
            }
            $excel = new PHPExcel();
            // Settingan awal fil excel
            $excel->getProperties()->setCreator('AR AGING')
                    ->setLastModifiedBy('AR AGING')
                    ->setTitle("Data AR AGING")
                    ->setSubject("AR AGING")
                    ->setDescription("AGING")
                    ->setKeywords("AR AGING");
            // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
            $style_col = array(
                'font' => array('bold' => true), // Set font nya jadi bold
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
                )
            );
            // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
            $style_row = array(
                'alignment' => array(
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
                )
            );
            $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA AR CUSTOMER"); // Set kolom A1 dengan tulisan "DATA SISWA"
            $excel->getActiveSheet()->mergeCells('A1:K1'); // Set Merge Cell pada kolom A1 sampai E1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
            // Buat header tabel nya pada baris ke 3
            $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
            $excel->setActiveSheetIndex(0)->setCellValue('B3', "Invoice/DN No"); // Set kolom B3 dengan tulisan "NIS"
            $excel->setActiveSheetIndex(0)->setCellValue('C3', "Sent Date"); // Set kolom C3 dengan tulisan "NAMA"
            $excel->setActiveSheetIndex(0)->setCellValue('D3', "Customer Number"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('E3', "Customer Name"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('F3', "freight"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('G3', "Insurance Cost"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('H3', "VAT"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('I3', "Total"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('J3', "Due Date"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('K3', "OS"); // Set kolom E3 dengan tulisan "ALAMAT"
           
            //$excel->setActiveSheetIndex(0)->setCellValue('E3', "TOTAL"); // Set kolom E3 dengan tulisan "ALAMAT"
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
            // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
            $id = $row['no'];
            $aging = $this->db->query("select * from ar_aging  where no_cs='$id'")->result_array();
            foreach ($aging as $datas) {
            
            
            
            
                $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $datas['no_inv']);
                $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $datas['sent_date']);
                $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $datas['no_cs']);
                $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $datas['name_cs']);
                $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, number_format($datas['freight'], 2));
                $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, number_format($datas['insurance'], 2));
                $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, number_format($datas['vat'], 2));
                $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, number_format($datas['total'], 2));
                $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $datas['due_date']);
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, number_format($datas['os'], 2));

                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);


                $no++; // Tambah 1 setiap kali looping
                $numrow++; // Tambah 1 setiap kali looping
            }

            $kode = $row['no'];
            $date = date("Y-m-d");
            // Set width kolom
            $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('J')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('K')->setWidth(30); // Set width kolom E
            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $excel->getActiveSheet(0)->setTitle("Laporan Data AR CUSTOMER");
            $excel->setActiveSheetIndex(0);
            // Proses file excel

            $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            $writer = new PHPExcel_Writer_Excel5($excel, 'Excel2007');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename=' . $kode . '_' . $date . '.xlsx'); // Set nama file excel nya
            header('Cache-Control: max-age=0');



            try {
                $write->save('excel/' . $kode . '_' . $date . '.xlsx');
                $mail->addAttachment("excel/" . $kode . '_' . $date . '.xlsx');
                $mail->addAddress($row['email1'], $row['pic1']);
                if (!empty($row['email2'])) {
                    //Assumes the image data is stored in the DB
                    $mail->addAddress($row['email2'], $row['pic2']);
                }
                if (!empty($row['email3'])) {
                    //Assumes the image data is stored in the DB
                    $mail->addAddress($row['email3'], $row['pic3']);
                }
                $mail->AddCC('desitilia.erawati@matahari.co.id', 'Collection 1 DC Balaraja');
                $mail->AddCC('widian.tikasari@matahari.co.id', 'Collection 2 DC Balaraja');
              
            } catch (Exception $e) {
                //    echo 'Invalid address skipped: ' . htmlspecialchars($row['emai11']) . '<br>';
                echo $mail->ErrorInfo . '<br>';
                // continue;
                $mail->getSMTPInstance()->reset();
            }

            $id = $row['no'];
            try {

                $mail->send();

                $this->db->query("update customer set flag=1 where no='$id'");
            } catch (Exception $e) {
                echo $mail->ErrorInfo . '<br>';

                //Reset the connection to abort sending this message
                //The loop will continue trying to send to the rest of the list
                $mail->getSMTPInstance()->reset();
            }
            //Clear all addresses and attachments for the next iteration
            $mail->clearAddresses();
            $mail->clearAttachments();
        }
        redirect('finance/prepare');
    }

    public function uploadAR() {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $data['title'] = "Upload AR Terbaru";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/listcustomer', $data);
        $this->load->view('templates/footer');
    }

    public function import() {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $fileName = $_FILES['file']['name'];

        $config['upload_path'] = './excel/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file'))
            $this->upload->display_errors();
        $media = $this->upload->data('file');
        $inputFileName = './excel/' . $media['file_name'];



        try {
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('excel/' . $fileName); // Load file yang tadi diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data = array();
            $numrow = 1;
           
           
            //die;
            foreach ($sheet as $row) {
                if($row['B']!=''){
                     $no_inv = $row['B'];
                $no_vat = $row['C'];
                $sent_date = strtotime($row['D']);
                $a = date('Y-m-d', $sent_date);
                $no_cs = $row['E'];
                $name_cs = $row['F'];
                $freight = $row['G'];
                $insurance = $row['H'];
                $vat = $row['I'];
                $total = $row['J'];
                $due_date = strtotime($row['K']);
                $b = date('Y-m-d', $due_date);
                $os = $row['L'];



                if ($numrow > 0) {
                    // Kita push (add) array data ke variabel data
                    array_push($data, array(
                        'no_inv' => $no_inv,
                        'no_vat' => $no_vat,
                        'sent_date' => $a,
                        'no_cs' => $no_cs,
                        'name_cs' => $name_cs,
                        'freight' => $freight,
                        'insurance' => $insurance,
                        'vat' => $vat,
                        'total' => $total,
                        'due_date' => $b,
                        'os' => $os
                    ));
                }

                $numrow++; // Tambah 1 setiap kali looping
                }
               
            }
            $this->fin->insert_multiple($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           File Berhasil di aupload!.
           </div>');
            redirect("http://apps.local:8081/finance/prepare");
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }
    }
	
	#method customer
    public function customer()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Customer';
        $data['customer'] = $this->db->get('customer')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('finance/customer', $data);
        $this->load->view('templates/footer');
    }
    public function tambahCustomer()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Tambah Customer';
        $data['customer'] = $this->db->get('customer')->result_array();
        $this->form_validation->set_rules('no', 'Nomer Customer', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('finance/tambahcustomer', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'no' => $this->input->post('no', true),
                'nama' => $this->input->post('nama', true),
                'hub' => 0,
                'top' => 30,
                'pic1' => $this->input->post('pic1'),
                'pic2' => $this->input->post('pic2'),
                'pic3' => $this->input->post('pic3'),
                'email1' => $this->input->post('email1'),
                'email2' => $this->input->post('email2'),
                'email3' => $this->input->post('email3'),
                'flag' => 0,
                'created_at' => time(),
                'is_deleted' => 0
            ];
            $this->db->insert('customer', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Menambah Customer</div>');
            redirect('finance/customer');
        }
    }
    public function editCustomer($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Customer';
        $data['customer'] = $this->db->get('customer')->result_array();
        $data['cust'] = $this->db->get_where('customer', ['id_customer' => $id])->row_array();
        $this->form_validation->set_rules('no', 'Nomer Customer', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('finance/editcustomer', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'no' => $this->input->post('no', true),
                'nama' => $this->input->post('nama', true),
                'hub' => 0,
                'top' => 30,
                'pic1' => $this->input->post('pic1'),
                'pic2' => $this->input->post('pic2'),
                'pic3' => $this->input->post('pic3'),
                'email1' => $this->input->post('email1'),
                'email2' => $this->input->post('email2'),
                'email3' => $this->input->post('email3'),
                'flag' => 0,
                'created_at' => time(),
                'is_deleted' => 0
            ];
            $this->db->where('id_customer', $this->input->post('id_customer'));
            $this->db->update('customer', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Mengubah Customer</div>');
            redirect('finance/customer');
        }
    }
    public function hapusCustomer($id)
    {
        $this->db->delete('customer', ['id_customer' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil DIhapus.</div>');
        redirect('finance/customer');
    }

    public function adminfinacc() {
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $base = "http://" . $_SERVER['HTTP_HOST'];
        $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $config['base_url'] = $base . "finance/adminfinacc";
        $this->db->group_start();
        $this->db->like('no', $data['keyword']);
        $this->db->or_like('nama', $data['keyword']);
        $this->db->or_like('hub', $data['keyword']);
        $this->db->or_like('pic1', $data['keyword']);

        $this->db->group_end();


        $this->db->from('customer');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 12;

        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $data['pettycash'] = $this->fin->getAllDataCusotmer($config['per_page'], $data['start'], $data['keyword']);
        //var_dump($data['pettycash']);
        //die;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminfinacc/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function monitoringemail(){
        $data['title'] = "Dashboard AR";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $data['d120'] = $this->finance->d120();
        $data['d90120'] = $this->finance->d90120();
        $data['d6090'] = $this->finance->d6090();
        $data['d3060'] = $this->finance->d3060();
        $data['d060'] = $this->finance->d060();
        $data['d0'] = $this->finance->d060();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminfinacc/dashboard', $data);
        $this->load->view('templates/footer');
        
    }
    public function d120s(){
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $data['d120'] = $this->finance->d120s();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminfinacc/120', $data);
        $this->load->view('templates/footer');
        
    }
    
     public function d90120s(){
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $data['d90120'] = $this->finance->d90120s();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminfinacc/90120', $data);
        $this->load->view('templates/footer');
        
    }
    
     public function d6090s(){
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $data['d6090'] = $this->finance->d6090s();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminfinacc/6090', $data);
        $this->load->view('templates/footer');
        
    }
    
     public function d3060s(){
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $data['d3060'] = $this->finance->d3060s();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminfinacc/3060', $data);
        $this->load->view('templates/footer');
        
    }
    
     public function d060s(){
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $data['d060'] = $this->finance->d060s();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminfinacc/060', $data);
        $this->load->view('templates/footer');
        
    }
    
     public function d0s(){
        $data['title'] = "Dashboard Ops";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $data['d0'] = $this->finance->d0s();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('adminfinacc/0', $data);
        $this->load->view('templates/footer');
        
    }
    
    public function resetflag() {
        $data['title'] = "Kirim & Reset email";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Finance_model', 'finance');
        $update = $this->db->query("truncate ar_aging");
		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
        File Berhasil di hapus!.
        </div>');
        redirect('finance/prepare');
        
    }
    
    public function editcust($id) {
        $data['title'] = "Form Edit Customer";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['customer'] = $this->db->query("select * from customer")->row();
         $this->load->model('Finance_model', 'finance');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('top', 'top', 'required');
        $this->form_validation->set_rules('pic1', 'pic1', 'required');
        $this->form_validation->set_rules('pic2', 'pic2', 'required');
        $this->form_validation->set_rules('email1', 'email1', 'required');
        $this->form_validation->set_rules('email2', 'email2', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('finance/editcust', $data);
            $this->load->view('templates/footer');
        } else {
            $this->finance->ubahCust();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Customer Sudah dirubah!.</div>');
            redirect('finance/adminfinacc');
        }
       
    }
     public function resetflagbyid($id) {
        $data['title'] = "Kirim & Reset email";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $update = $this->db->query("update customer set flag=0 where id_customer='$id'");
        redirect('finance/adminfinacc');
        
    }
    
    public function emailcustbyid($id) {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya


        $mail = new PHPMailer(true);

        //$body = file_get_contents('contents.html');

        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPKeepAlive = true; //SMTP connection will not close after each email sent, reduces SMTP overhead
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'm081250@matahari.co.id';
        $mail->Password = 'Matahari22';
        $mail->setFrom('widian.tikasari@matahari.co.id', 'Collection DC Balaraja');
        $mail->addReplyTo('melda.agustin@matahari.co.id', 'Collection DC Balaraja');

        $mail->Subject = 'OUSTANDING CUSTOMER';
        //$body = file_get_contents('excel/content.html');
//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
       // $mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        
//Connect to the database and select the recipients from your mailing list that have not yet been sent to
//You'll need to alter this to match your database
        $data['title'] = "OUSTANDING CUSTOMER";
        $cust = $this->db->query("select * from customer where flag='0' and id_customer='$id'")->result_array();
        $data['list'] = $this->db->get('customer')->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        foreach ($cust as $row) {
            $kode = $row['no'];
            $date = date("Y-m-d");
            $ids=$row['no'];
            $agings = $this->db->query("select sum(os) as t from ar_aging  where no_cs='$ids'")->result_array();
            foreach ($agings as $datas) {
            $total= number_format($datas['t'],2);
            $mail->msgHTML('<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
	<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-zv4m{border-color:#ffffff;text-align:left;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-zv4m" colspan="5">Dengan Hormat,</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Terima kasih atas kepercayaan anda telah memilih kami sebagai mitra transporter anda.<br>Berikut adalah data invoice yang belum kami terima pembayaranya sebesar <strong>Rp.'.$total.'</strong>. (Detail file terlampir)<br>Mohon konfirmasi dan informasi untuk jadwal pembayaran atas invoice tersebut.</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Untuk pembayaran data ditransfer ke nomor rekening di bawah ini:</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"><span style="font-weight:bold">Invoice atas nama PT. Matahari Department Store, TBK</span><br>Bank : CIMB Niaga<br>Cabang : Graha Sudirman<br>No Rekening : 800036037500<br>Atas Nama : PT. Matahari Department Store, TBK<br></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"><span style="font-weight:bold">Invoice atas nama PT. Matahari Nusantara Logistik</span><br>Bank : CIMB Niaga<br>Cabang : Menara Asia Karawaci<br>No Rekening : 704698804800<br>Atas Nama : PT. Matahari Nusantara Logistik</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Jika ada pertanyaan/ masalah mengenai invoice tersebut harap menghubungi kami di 021-595-4846/47 (Tika/Era)</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Atas perhatianya kami ucapkan terima kasih banyak.</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Best regards,</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5">Collection DC Balaraja</td>
  </tr>
  <tr>
    <td class="tg-zv4m" colspan="5" rowspan="2">Kawasan Industri Graha Balaraja<br>Jl. Raya Serang KM 26-27, Desa Tobat, <br>Kec. Balaraja, Kab. Tangerang - Banten 15610<br>Telp : (021) 5954846–47 Ext. 8109</td>
  </tr>
  <tr>
  </tr>
</tbody>
</table>
</html>');
            }
            $excel = new PHPExcel();
            // Settingan awal fil excel
            $excel->getProperties()->setCreator('AR AGING')
                    ->setLastModifiedBy('AR AGING')
                    ->setTitle("Data AR AGING")
                    ->setSubject("AR AGING")
                    ->setDescription("AGING")
                    ->setKeywords("AR AGING");
            // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
            $style_col = array(
                'font' => array('bold' => true), // Set font nya jadi bold
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
                )
            );
            // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
            $style_row = array(
                'alignment' => array(
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
                )
            );
            $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA AR CUSTOMER"); // Set kolom A1 dengan tulisan "DATA SISWA"
            $excel->getActiveSheet()->mergeCells('A1:K1'); // Set Merge Cell pada kolom A1 sampai E1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
            // Buat header tabel nya pada baris ke 3
            $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
            $excel->setActiveSheetIndex(0)->setCellValue('B3', "Invoice/DN No"); // Set kolom B3 dengan tulisan "NIS"
            $excel->setActiveSheetIndex(0)->setCellValue('C3', "Sent Date"); // Set kolom C3 dengan tulisan "NAMA"
            $excel->setActiveSheetIndex(0)->setCellValue('D3', "Customer Number"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('E3', "Customer Name"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('F3', "freight"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('G3', "Insurance Cost"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('H3', "VAT"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('I3', "Total"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('J3', "Due Date"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
            $excel->setActiveSheetIndex(0)->setCellValue('K3', "OS"); // Set kolom E3 dengan tulisan "ALAMAT"
           
            //$excel->setActiveSheetIndex(0)->setCellValue('E3', "TOTAL"); // Set kolom E3 dengan tulisan "ALAMAT"
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
            // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
            $id = $row['no'];
            $aging = $this->db->query("select * from ar_aging  where no_cs='$id'")->result_array();
            foreach ($aging as $datas) {
            
            
            
            
                $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $datas['no_inv']);
                $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $datas['sent_date']);
                $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $datas['no_cs']);
                $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $datas['name_cs']);
                $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, number_format($datas['freight'], 2));
                $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, number_format($datas['insurance'], 2));
                $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, number_format($datas['vat'], 2));
                $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, number_format($datas['total'], 2));
                $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $datas['due_date']);
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, number_format($datas['os'], 2));

                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);


                $no++; // Tambah 1 setiap kali looping
                $numrow++; // Tambah 1 setiap kali looping
            }

            $kode = $row['no'];
            $date = date("Y-m-d");
            // Set width kolom
            $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('J')->setWidth(30); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('K')->setWidth(30); // Set width kolom E
            // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
            $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
            // Set orientasi kertas jadi LANDSCAPE
            $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $excel->getActiveSheet(0)->setTitle("Laporan Data AR CUSTOMER");
            $excel->setActiveSheetIndex(0);
            // Proses file excel

            $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            $writer = new PHPExcel_Writer_Excel5($excel, 'Excel2007');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename=' . $kode . '_' . $date . '.xlsx'); // Set nama file excel nya
            header('Cache-Control: max-age=0');



            try {
                $write->save('excel/' . $kode . '_' . $date . '.xlsx');
                $mail->addAttachment("excel/" . $kode . '_' . $date . '.xlsx');
                $mail->addAddress($row['email1'], $row['pic1']);
                if (!empty($row['email2'])) {
                    //Assumes the image data is stored in the DB
                    $mail->addAddress($row['email2'], $row['pic2']);
                }
                if (!empty($row['email3'])) {
                    //Assumes the image data is stored in the DB
                    $mail->addAddress($row['email3'], $row['pic3']);
                }
                $mail->AddCC('desitilia.erawati@matahari.co.id', 'Collection 1 DC Balaraja');
                $mail->AddCC('widian.tikasari@matahari.co.id', 'Collection 2 DC Balaraja');
              
            } catch (Exception $e) {
                //    echo 'Invalid address skipped: ' . htmlspecialchars($row['emai11']) . '<br>';
                echo $mail->ErrorInfo . '<br>';
                // continue;
                $mail->getSMTPInstance()->reset();
            }

            $id = $row['no'];
            try {

                $mail->send();

                $this->db->query("update customer set flag=1 where no='$id'");
            } catch (Exception $e) {
                echo $mail->ErrorInfo . '<br>';

                //Reset the connection to abort sending this message
                //The loop will continue trying to send to the rest of the list
                $mail->getSMTPInstance()->reset();
            }
            //Clear all addresses and attachments for the next iteration
            $mail->clearAddresses();
            $mail->clearAttachments();
        }
        redirect('finance/adminfinacc');
    }
    
   // public function costing() {
     //   $lpn= $this->db2->query("select * from wmswmprd.lpn where lpn_id='11098186'")->result_array();
       // var_dump($lpn);
        
    //}
}
