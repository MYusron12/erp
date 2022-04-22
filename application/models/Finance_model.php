<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Finance_model extends CI_Model {

    // pettycash
    public function getAllDataPettyCash($limit, $start, $keyword = null) {

        if ($keyword) {
            $this->db->group_start();
            $this->db->like('pemohon', $keyword);
            $this->db->or_like('nama_bagian', $keyword);
            $this->db->or_like('no_bs', $keyword);
            $this->db->or_like('no_kas_bank', $keyword);
            $this->db->group_end();
        }

        $params['conditions'] = [
            'hub' => $this->session->userdata('hub'),
            'is_deleted' => 0
        ];

        // return $this->db->get_where('qpettycash', $params['conditions'], $limit, $start)->result_array();

        $this->db->select('transaksi_department.*, bagian.nama_bagian');
        $this->db->from('transaksi_department');
        $this->db->join('bagian', 'transaksi_department.idbagian = bagian.idbagian');
        $where = $params['conditions'];
        $this->db->where($where);
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }

    public function getDataPettycashId($id) {

        $hub = $this->session->userdata('hub');

        $query = "SELECT `transaksi_department`.*, `bagian`.`nama_bagian`, `departement`.nama
                  FROM `transaksi_department` JOIN `bagian`
                  ON `transaksi_department`.`idbagian` = `bagian`.`idbagian` JOIN
                  `departement` ON `transaksi_department`.`id_dept` = `departement`.`id_departement`
                  WHERE `transaksi_department`.`id_transaksi_dept` = $id and `transaksi_department`.`is_deleted`='0'
                ";
        return $this->db->query($query)->row_array();
    }

    // Data realisasi

    public function getDataRealization($limit, $start, $keyword = null) {
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('pemohon', $keyword);
            $this->db->or_like('nama_bagian', $keyword);
            $this->db->or_like('no_bs', $keyword);
            $this->db->or_like('no_kas_bank', $keyword);
            $this->db->group_end();
        }

        $params['conditions'] = [
            'status' => 2,
            'is_deleted' => 0
        ];

        // return $this->db->get_where('qpettycash', $params['conditions'], $limit, $start)->result_array();

        $this->db->select('transaksi_department.*, bagian.nama_bagian');
        $this->db->from('transaksi_department');
        $this->db->join('bagian', 'transaksi_department.idbagian = bagian.idbagian');
        $where = $params['conditions'];
        $this->db->where($where);
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }

    public function getchangeRealizationById($id) {


        $query = "SELECT `transaksi_department`.*, `bagian`.`nama_bagian`
                  FROM `transaksi_department` JOIN `bagian`
                  ON `transaksi_department`.`idbagian` = `bagian`.`idbagian`
                  WHERE `transaksi_department`.`status` = 2 AND `transaksi_department`.`id_transaksi_dept` = '$id' 
                    and `transaksi_department`.`is_deleted`='0'
                ";
        return $this->db->query($query)->row_array();
    }

    public function getDataRealizationStatus($limit, $start, $keyword = null) {
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('pemohon', $keyword);
            $this->db->or_like('nama_bagian', $keyword);
            $this->db->or_like('no_bs', $keyword);
            $this->db->or_like('no_kas_bank', $keyword);
            $this->db->group_end();
        }

        $params['conditions'] = [
            'status >=' => 0,
            'is_deleted' => 0
        ];

        // return $this->db->get_where('qpettycash', $params['conditions'], $limit, $start)->result_array();

        $this->db->select('transaksi_department.*, bagian.nama_bagian');
        $this->db->from('transaksi_department');
        $this->db->join('bagian', 'transaksi_department.idbagian = bagian.idbagian');
        $where = $params['conditions'];
        $this->db->where($where);
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }

    public function getDataResult($iddc) {

        $query = "SELECT A.department_id, A.nilaiuang,
                  A.nilaiuang AS cashonhand, 
                  b.pinjem-(b.realisasi+b.saldo) AS kasbon,
                  IFNULL(D.outstandingkb,0) AS outstanding,
                  (A.nilaiuang-B.saldo1)+(B.pinjem-B.realisasi-B.saldo)+IFNULL(D.outstandingkb,0)+IFNULL(reimburstho,0) as selisih,
                  A.nilaiuang+(IFNULL(C.jml,0)-IFNULL(C.jmlawal,0))+IFNULL(D.outstandingkb,0) AS ttlpettycash,
                  IFNULL(reimburstho,0) AS reimburstho,
                  A.nilaiuang+(IFNULL(C.jml,0)-IFNULL(C.jmlawal,0))+IFNULL(D.outstandingkb,0) + IFNULL(reimburstho,0) AS grandtotal
                           
                FROM ((SELECT validasi.department_id, SUM(validasi.jumlah*validasi.pecahan) AS nilaiuang
                FROM validasi WHERE validasi.department_id= '$iddc'
                GROUP BY validasi.department_id) AS A LEFT JOIN (SELECT departement.id_departement,  
                  SUM(saldo1) AS saldo1,
                  SUM(pinjem) AS pinjem,  
                  SUM(realisasi) AS realisasi,
                  SUM(saldo) AS saldo
                FROM departement WHERE id_departement = '$iddc'
                GROUP BY departement.id_departement) AS B ON A.department_id = B.id_departement) LEFT JOIN (SELECT transaksi_department.id_dept,
                  SUM(jumlah) AS jml, SUM(terpakai) AS terpakai, 
                  SUM(selisih) AS selisih, 
                  SUM(jumlah_awal) AS jmlawal,
                  SUM(jmlajuan) AS jmlajuan
                FROM transaksi_department WHERE id_dept = '$iddc'
                GROUP BY transaksi_department.id_dept) AS C ON A.department_id = C.id_dept LEFT JOIN (SELECT transaksi_detail.loc_iddept, SUM(nominal) AS outstandingkb
                FROM transaksi_detail WHERE loc_iddept='$iddc' AND LEFT(jenis,2)='KK' AND transaksi_detail.`status`= '1'and transaksi_detail.`is_deleted`= '0'
                GROUP BY transaksi_detail.loc_iddept) AS D ON A.department_id = D.loc_iddept LEFT JOIN (SELECT transaksi_detail.loc_iddept, SUM(nominal) AS reimburstho
                FROM transaksi_detail WHERE loc_iddept='$iddc' AND LEFT(jenis,2)='KK' AND transaksi_detail.`status`= '2'and transaksi_detail.`is_deleted`= '0'
                GROUP BY transaksi_detail.loc_iddept) AS E ON A.department_id = E.loc_iddept LEFT JOIN (SELECT transaksi_detail.loc_iddept, SUM(nominal) AS cairHo
                FROM transaksi_detail WHERE loc_iddept='$iddc' AND LEFT(jenis,2)='KK' AND transaksi_detail.`status`= '3' and transaksi_detail.`is_deleted`= '0'
                GROUP BY transaksi_detail.loc_iddept) AS F ON A.department_id = E.loc_iddept

           ";

        return $this->db->query($query)->row_array();
    }

    public function getBankCashNo($id) {
        $this->db->select('*');
        $this->db->where('transaksi="PV"');
        $query = $this->db->get('counter');
        foreach ($query->result_array() as $row):
            if ($row['jumlah'] > 8) {
                $j = $row['jumlah'] + 1;
                $kode = $row['kode'] . '00';
            } else {
                $j = $row['jumlah'] + 1;
                $kode = $row['kode'] . '000';
            }
        endforeach;

        $kodejadi = $kode . $j;
        return $kodejadi;
    }

    public function getAllDataBsno() {
        //return $this->db->get_where('transaksi_department', ['status' => 3])->result_array();
    }

    public function getBsnoId($bsno_id) {
        return $this->db->get_where('transaksi_department', ['id_transaksi_dept' => $bsno_id])->row_array();
    }

    public function getBsnoId1($id) {
        $data = $this->db->get_where('transaksi_department', ['id_transaksi_dept' => $id])->row_array();

        foreach ($data as $value) {
            $result[] = [
                'terpakai' => $value['terpakai']
            ];
        }
    }

    public function simpantransaksi() {

        $idtransgenerate = $this->input->post('cashbankno', TRUE);
        $kode = $this->input->post('pilihan', TRUE);
        //

        if ($kode == "KK") {

            $nokasbank = $this->input->post('cashbankno', TRUE);
            $datepengajuan = date('Y-m-d', strtotime($this->input->post('datepengajuan', TRUE)));
            $aplicantname = $this->input->post('aplicantname', TRUE);
            $necessity = $this->input->post('necessity', TRUE);
            $note = $this->input->post('note', TRUE);
            $ckho = $this->input->post('ckho', TRUE);
            $dateho = date('Y-m-d', strtotime($this->input->post('dateho', TRUE)));
            $suplier = $this->input->post('suplier', TRUE);
            $batchno = $this->input->post('batchno', TRUE);
            $dtpenerima = date('Y-m-d', strtotime($this->input->post('dtpenerima', TRUE)));
            $nobpkb = $this->input->post('nobpkb', TRUE);
            $chequeno = $this->input->post('chequeno', TRUE);
            $totaltrans = str_replace(['.', ','], ['', '.'], $this->input->post('totaltrans', TRUE));
            $nomorbs = $this->input->post('nomorbs', TRUE);
            $jmlterpakaiawal = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakaiawal', TRUE));
            $jmlsisabs = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakai', TRUE));
            $jmlkasbank = str_replace(['.', ','], ['', '.'], $this->input->post('nkasbank', TRUE));
            $ppn = $this->input->post('ppn', TRUE);
            $pph = $this->input->post('pph', TRUE);


            // transaksi details
            $loc = $this->input->post('locinput', TRUE);
            $ec = $this->input->post('ecinput', TRUE);
            $na = $this->input->post('nainput', TRUE);
            $tb = $this->input->post('tbinput', TRUE);
            $amount = str_replace(['.', ','], ['', '.'], $this->input->post('ammount1input', TRUE));
            $ppn = $this->input->post('ppn', TRUE);
            $pph = $this->input->post('pph', TRUE);
            $keter = $this->input->post('keterinput', TRUE);


            $totalkasbank = $totaltrans + $jmlkasbank;

            if ($jmlsisabs < $totaltrans) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Jml Realisasi ' . number_format($totaltrans) . ' Tidak Boleh Besar dari Sisa Bs ' . number_format($jmlsisabs) . ' Mohon Periksa Kembali inputan Anda!.. "Gagal Simpan Data!"
         </div>');

                redirect('transaksi/kasrupiahtambah');
            } else {


                $this->db->where_in('id_transaksi_dept', $nomorbs);
                $databs = $this->db->get('transaksi_department')->result();
                $nobarukasbank = [$idtransgenerate];


                $countbs = count($nomorbs);
                foreach ($databs as $value) {

                    $nokasbank = $value->no_kas_bank;

                    if ($nokasbank == null) {

                        $implode = implode(',', $nobarukasbank);
                        $update = ['no_kas_bank' => $implode];
                        $this->db->where_in('id_transaksi_dept', $nomorbs);
                        $this->db->update('transaksi_department', $update);
                    } else {

                        $explode = explode(",", $value->no_kas_bank);
                        $tambaharray = array_merge($explode, $nobarukasbank);
                        $implode = implode(",", $tambaharray);
                        $update = ['no_kas_bank' => $implode];
                        $this->db->where_in('id_transaksi_dept', $nomorbs);
                        $this->db->update('transaksi_department', $update);
                    }
                }

                if ($jmlterpakaiawal == $totalkasbank) {
                    $nkasbank = ['nkasbank' => $totalkasbank / $countbs, 'status' => 4];
                } else {
                    $nkasbank = ['nkasbank' => $totalkasbank / $countbs];
                }

                $this->db->where_in('id_transaksi_dept', $nomorbs);
                $this->db->update('transaksi_department', $nkasbank);
            }


            foreach ($nomorbs as $key => $val) {

                $result[] = $nomorbs[$key];
            }

            $nobs = serialize($result);


            $data = [
                'cashbankno' => $idtransgenerate,
                'type' => $kode,
                'tgl_pengajuan' => $datepengajuan,
                'id_transaksi_dept' => $nobs,
                'pemohon' => $aplicantname,
                'keperluan' => $necessity,
                'catatan' => $note,
                'no_batch' => $batchno,
                'tgl_proses' => '0000-00-00',
                'tgl_penerima' => '0000-00-00',
                'no_bpk' => $nobpkb,
                'no_giro' => $chequeno,
                'total' => $totaltrans,
                'status' => 1,
                'id_user' => $this->session->userdata('iduser'),
                'hub' => $this->session->userdata('hub'),
                'created_by' => $this->session->userdata('iduser'),
                'created_at' => date("Y-m-d h:i:sa")
            ];

            $this->db->insert('transaksi', $data);
            $id_transaksi = $this->db->insert_id();


            // details


            $a = count($this->input->post('noinput'));

            for ($i = 0; $i < $a; $i++) {

                $coa_ec = $this->db->get_where('coa_ec', ['account' => $ec[$i]])->row_array();
                $hslcoa_ec = $coa_ec;

                $coa_na = $this->db->get_where('coa_na', ['account' => $na[$i]])->row_array();
                $hslcoa_na = $coa_na;

                $coa_tb = $this->db->get_where('coa_tb', ['account' => $tb[$i]])->row_array();
                $hslcoa_tb = $coa_tb;

                $loc1 = $this->db->get_where('departement', ['kode_loc' => $loc[$i]])->row_array();
                $hslloc = $loc1['id_departement'];


                $this->db->where_in('id_transaksi_dept', $nomorbs);
                $transaksi_department = $this->db->get('transaksi_department')->row_array();
                $hsltransdept = $transaksi_department;




                $details = [
                    'id_transaksi' => $id_transaksi,
                    'jenis' => $kode,
                    'loc_iddept' => $hslloc,
                    'loc' => $loc[$i],
                    'id_coa_ec' => $hslcoa_ec['id_coa_ec'],
                    'id_coa_na' => $hslcoa_na['id_coa_na'],
                    'id_coa_tb' => $hslcoa_tb['id_coa_tb'],
                    'nominal' => $amount[$i],
                    'ppn' => $ppn[$i],
                    'pph' => $pph[$i],
                    'coa_ec_account' => $ec[$i],
                    'coa_na_account' => $na[$i],
                    'coa_tb_account' => $tb[$i],
                    'coa_ec_nama' => $hslcoa_ec['nama'],
                    'coa_na_nama' => $hslcoa_na['nama'],
                    'coa_tb_nama' => $hslcoa_tb['nama'],
                    'tanggal_kas_bon' => $hsltransdept['tgl_realisasi'],
                    'tgl_penerima' => $hsltransdept['tgl_terima'],
                    'tgl_penajuan' => $hsltransdept['tgl_buat'],
                    'keterangan' => $keter[$i],
                    'status' => 1,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub')
                ];

                $this->db->insert('transaksi_detail', $details);


                $createpph = [];

                if ($pph[$i] > 0) {

                    $ttlpph = '-' . $amount[$i] * $pph[$i] / 100;

                    $createpph = [
                        'id_transaksi' => $id_transaksi,
                        'jenis' => $kode,
                        'loc_iddept' => $hslloc,
                        'loc' => $loc[$i],
                        'coa_ec_account' => '000',
                        'coa_na_account' => '5141',
                        'coa_tb_account' => '10',
                        'nominal' => $ttlpph,
                        'keterangan' => $pph[$i] . '%' . ' ' . $keter[$i],
                        'status' => 1,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub')
                    ];

                    $this->db->insert('transaksi_detail', $createpph);
                }

                if ($ppn[$i] > 0) {

                    $ttlpph = $amount[$i] * $ppn[$i] / 100;

                    $createpph = [
                        'id_transaksi' => $id_transaksi,
                        'jenis' => $kode,
                        'loc_iddept' => $hslloc,
                        'loc' => $loc[$i],
                        'coa_ec_account' => '000',
                        'coa_na_account' => '5141',
                        'coa_tb_account' => '10',
                        'nominal' => $ttlpph,
                        'keterangan' => $ppn[$i] . '%' . ' ' . $keter[$i],
                        'status' => 1,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub')
                    ];

                    $this->db->insert('transaksi_detail', $createpph);
                }
            }
        } elseif ($kode == "KAS") {

            $nokasbank = $this->input->post('cashbankno', TRUE);
            $datepengajuan = date('Y-m-d', strtotime($this->input->post('datepengajuan', TRUE)));
            $aplicantname = $this->input->post('aplicantname', TRUE);
            $necessity = $this->input->post('necessity', TRUE);
            $note = $this->input->post('note', TRUE);
            $ckho = $this->input->post('ckho', TRUE);
            $dateho = date('Y-m-d', strtotime($this->input->post('dateho', TRUE)));
            $suplier = $this->input->post('suplier', TRUE);
            $batchno = $this->input->post('batchno', TRUE);
            $dtpenerima = date('Y-m-d', strtotime($this->input->post('dtpenerima', TRUE)));
            $nobpkb = $this->input->post('nobpkb', TRUE);
            $chequeno = $this->input->post('chequeno', TRUE);
            $totaltrans = str_replace(['.', ','], ['', '.'], $this->input->post('totaltrans', TRUE));
            $nomorbs = $this->input->post('nomorbs', TRUE);
            $jmlterpakaiawal = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakaiawal', TRUE));
            $jmlsisabs = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakai', TRUE));
            $jmlkasbank = str_replace(['.', ','], ['', '.'], $this->input->post('nkasbank', TRUE));
            $ppn = $this->input->post('ppn', TRUE);
            $pph = $this->input->post('pph', TRUE);

            // transaksi details
            $loc = $this->input->post('locinput', TRUE);
            $ec = $this->input->post('ecinput', TRUE);
            $na = $this->input->post('nainput', TRUE);
            $tb = $this->input->post('tbinput', TRUE);
            $amount = str_replace(['.', ','], ['', '.'], $this->input->post('ammount1input', TRUE));
            $keter = $this->input->post('keterinput', TRUE);

            $totalkasbank = $totaltrans + $jmlkasbank;

            $nobs = '';


            if ($nomorbs) {

                if ($jmlsisabs < $totaltrans) {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Jml Realisasi ' . number_format($totaltrans) . ' Tidak Boleh Besar dari Sisa Bs ' . number_format($jmlsisabs) . ' Mohon Periksa Kembali inputan Anda!.. "Gagal Simpan Data!"
         </div>');

                    redirect('transaksi/kasrupiahtambah');
                } else {


                    $this->db->where_in('idbskantorpusat', $nomorbs);
                    $databs = $this->db->get('bskantorpusat')->result();
                    $nobarukasbank = [$idtransgenerate];


                    $countbs = count($nomorbs);
                    foreach ($databs as $value) {

                        $nokasbank = $value->nokasbank;

                        if ($nokasbank == null) {

                            $implode = implode(',', $nobarukasbank);
                            $update = ['nokasbank' => $implode];
                            $this->db->where_in('idbskantorpusat', $nomorbs);
                            $this->db->update('bskantorpusat', $update);
                        } else {

                            $explode = explode(",", $value->nokasbank);
                            $tambaharray = array_merge($explode, $nobarukasbank);
                            $implode = implode(",", $tambaharray);
                            $update = ['nokasbank' => $implode];
                            $this->db->where_in('idbskantorpusat', $nomorbs);
                            $this->db->update('bskantorpusat', $update);
                        }
                    }

                    if ($jmlterpakaiawal == $totalkasbank) {
                        $nkasbank = ['nkasbank' => $totalkasbank / $countbs, 'status' => 2];
                    } else {
                        $nkasbank = ['nkasbank' => $totalkasbank / $countbs];
                    }

                    $this->db->where_in('idbskantorpusat', $nomorbs);
                    $this->db->update('bskantorpusat', $nkasbank);
                }

                $nobs = serialize($nomorbs);
            }


            $data = [
                'cashbankno' => $idtransgenerate,
                'tgl_pengajuan' => $datepengajuan,
                'type' => $kode,
                'id_transaksi_dept' => $nobs,
                'pemohon' => $aplicantname,
                'keperluan' => $necessity,
                'catatan' => $note,
                'no_batch' => $batchno,
                'tgl_proses' => '0000-00-00',
                'tgl_penerima' => '0000-00-00',
                'no_bpk' => $nobpkb,
                'no_giro' => $chequeno,
                'total' => $totaltrans,
                'status' => 1,
                'id_user' => $this->session->userdata('iduser'),
                'hub' => $this->session->userdata('hub'),
                'created_by' => $this->session->userdata('iduser'),
                'created_at' => date("Y-m-d h:i:sa")
            ];

            $this->db->insert('transaksi', $data);
            $id_transaksi = $this->db->insert_id();


            // details


            $a = count($this->input->post('noinput'));

            for ($i = 0; $i < $a; $i++) {

                $coa_ec = $this->db->get_where('coa_ec', ['account' => $ec[$i]])->row_array();
                $hslcoa_ec = $coa_ec;

                $coa_na = $this->db->get_where('coa_na', ['account' => $na[$i]])->row_array();
                $hslcoa_na = $coa_na;

                $coa_tb = $this->db->get_where('coa_tb', ['account' => $tb[$i]])->row_array();
                $hslcoa_tb = $coa_tb;


                $loc1 = $this->db->get_where('departement', ['kode_loc' => $loc[$i]])->row_array();
                $hslloc = $loc1['id_departement'];



                $this->db->where_in('idbskantorpusat', $nomorbs);
                $bspusat = $this->db->get('bskantorpusat')->row_array();
                $hslbspusat = $bspusat;


                $details = [
                    'id_transaksi' => $id_transaksi,
                    'jenis' => $kode,
                    'loc_iddept' => $hslloc,
                    'loc' => $loc[$i],
                    'id_coa_ec' => $hslcoa_ec['id_coa_ec'],
                    'id_coa_na' => $hslcoa_na['id_coa_na'],
                    'id_coa_tb' => $hslcoa_tb['id_coa_tb'],
                    'nominal' => $amount[$i],
                    'ppn' => $ppn[$i],
                    'pph' => $pph[$i],
                    'coa_ec_account' => $ec[$i],
                    'coa_na_account' => $na[$i],
                    'coa_tb_account' => $tb[$i],
                    'coa_ec_nama' => $hslcoa_ec['nama'],
                    'coa_na_nama' => $hslcoa_na['nama'],
                    'coa_tb_nama' => $hslcoa_tb['nama'],
                    'tanggal_kas_bon' => $hslbspusat['tanggal'],
                    'tgl_penerima' => '0000-00-00',
                    'tgl_penajuan' => '0000-00-00',
                    'keterangan' => $keter[$i],
                    'status' => 1,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub')
                ];

                $this->db->insert('transaksi_detail', $details);


                $createpph = [];

                if ($pph[$i] > 0) {

                    $ttlpph = '-' . $amount[$i] * $pph[$i] / 100;

                    $createpph = [
                        'id_transaksi' => $id_transaksi,
                        'jenis' => $kode,
                        'loc_iddept' => $hslloc,
                        'loc' => $loc[$i],
                        'coa_ec_account' => '000',
                        'coa_na_account' => '5141',
                        'coa_tb_account' => '10',
                        'nominal' => $ttlpph,
                        'keterangan' => $pph[$i] . '%' . ' ' . $keter[$i],
                        'status' => 1,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub')
                    ];

                    $this->db->insert('transaksi_detail', $createpph);
                }

                if ($ppn[$i] > 0) {

                    $ttlpph = $amount[$i] * $ppn[$i] / 100;

                    $createpph = [
                        'id_transaksi' => $id_transaksi,
                        'jenis' => $kode,
                        'loc_iddept' => $hslloc,
                        'loc' => $loc[$i],
                        'coa_ec_account' => '000',
                        'coa_na_account' => '5141',
                        'coa_tb_account' => '10',
                        'nominal' => $ttlpph,
                        'keterangan' => $ppn[$i] . '%' . ' ' . $keter[$i],
                        'status' => 1,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub')
                    ];

                    $this->db->insert('transaksi_detail', $createpph);
                }
            }
        } else {


            $nokasbank = $this->input->post('cashbankno', TRUE);
            $datepengajuan = date('Y-m-d', strtotime($this->input->post('datepengajuan', TRUE)));
            $aplicantname = $this->input->post('aplicantname', TRUE);
            $necessity = $this->input->post('necessity', TRUE);
            $note = $this->input->post('note', TRUE);
            $ckho = $this->input->post('ckho', TRUE);
            $dateho = date('Y-m-d', strtotime($this->input->post('dateho', TRUE)));
            $suplier = $this->input->post('suplier', TRUE);
            $batchno = $this->input->post('batchno', TRUE);
            $dtpenerima = date('Y-m-d', strtotime($this->input->post('dtpenerima', TRUE)));
            $nobpkb = $this->input->post('nobpkb', TRUE);
            $chequeno = $this->input->post('chequeno', TRUE);
            $totaltrans = str_replace(['.', ','], ['', '.'], $this->input->post('totaltrans', TRUE));
            $nomorbs = $this->input->post('nomorbs', TRUE);
            $jmlterpakaiawal = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakaiawal', TRUE));
            $jmlsisabs = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakai', TRUE));
            $jmlkasbank = str_replace(['.', ','], ['', '.'], $this->input->post('nkasbank', TRUE));
            $ppn = $this->input->post('ppn', TRUE);
            $pph = $this->input->post('pph', TRUE);


            // transaksi details
            $loc = $this->input->post('locinput', TRUE);
            $ec = $this->input->post('ecinput', TRUE);
            $na = $this->input->post('nainput', TRUE);
            $tb = $this->input->post('tbinput', TRUE);
            $amount = str_replace(['.', ','], ['', '.'], $this->input->post('ammount1input', TRUE));
            $keter = $this->input->post('keterinput', TRUE);

            $totalkasbank = $totaltrans + $jmlkasbank;

            $nobs = '';


            if ($nomorbs) {

                if ($jmlsisabs < $totaltrans) {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Jml Realisasi ' . number_format($totaltrans) . ' Tidak Boleh Besar dari Sisa Bs ' . number_format($jmlsisabs) . ' Mohon Periksa Kembali inputan Anda!.. "Gagal Simpan Data!"
         </div>');

                    redirect('transaksi/kasrupiahtambah');
                } else {


                    $this->db->where_in('idbskantorpusat', $nomorbs);
                    $databs = $this->db->get('bskantorpusat')->result();
                    $nobarukasbank = [$idtransgenerate];


                    $countbs = count($nomorbs);
                    foreach ($databs as $value) {

                        $nokasbank = $value->nokasbank;

                        if ($nokasbank == null) {

                            $implode = implode(',', $nobarukasbank);
                            $update = ['nokasbank' => $implode];
                            $this->db->where_in('idbskantorpusat', $nomorbs);
                            $this->db->update('bskantorpusat', $update);
                        } else {

                            $explode = explode(",", $value->nokasbank);
                            $tambaharray = array_merge($explode, $nobarukasbank);
                            $implode = implode(",", $tambaharray);
                            $update = ['nokasbank' => $implode];
                            $this->db->where_in('idbskantorpusat', $nomorbs);
                            $this->db->update('bskantorpusat', $update);
                        }
                    }

                    if ($jmlterpakaiawal == $totalkasbank) {
                        $nkasbank = ['nkasbank' => $totalkasbank / $countbs, 'status' => 2];
                    } else {
                        $nkasbank = ['nkasbank' => $totalkasbank / $countbs];
                    }

                    $this->db->where_in('idbskantorpusat', $nomorbs);
                    $this->db->update('bskantorpusat', $nkasbank);
                }
                $nobs = serialize($nomorbs);
            }

            $data = [
                'cashbankno' => $idtransgenerate,
                'tgl_pengajuan' => $datepengajuan,
                'type' => $kode,
                'id_transaksi_dept' => $nobs,
                'pemohon' => $aplicantname,
                'keperluan' => $necessity,
                'catatan' => $note,
                'no_batch' => $batchno,
                'tgl_proses' => '0000-00-00',
                'tgl_penerima' => '0000-00-00',
                'no_bpk' => $nobpkb,
                'no_giro' => $chequeno,
                'total' => $totaltrans,
                'idsuplier' => $suplier,
                'status' => 1,
                'id_user' => $this->session->userdata('iduser'),
                'hub' => $this->session->userdata('hub'),
                'created_by' => $this->session->userdata('iduser'),
                'created_at' => date("Y-m-d h:i:sa")
            ];

            $this->db->insert('transaksi', $data);
            $id_transaksi = $this->db->insert_id();
            // details
            $a = count($this->input->post('noinput'));

            for ($i = 0; $i < $a; $i++) {

                $coa_ec = $this->db->get_where('coa_ec', ['account' => $ec[$i]])->row_array();
                $hslcoa_ec = $coa_ec;

                $coa_na = $this->db->get_where('coa_na', ['account' => $na[$i]])->row_array();
                $hslcoa_na = $coa_na;

                $coa_tb = $this->db->get_where('coa_tb', ['account' => $tb[$i]])->row_array();
                $hslcoa_tb = $coa_tb;


                $loc1 = $this->db->get_where('departement', ['kode_loc' => $loc[$i]])->row_array();
                $hslloc = $loc1['id_departement'];



                $this->db->where_in('idbskantorpusat', $nomorbs);
                $bspusat = $this->db->get('bskantorpusat')->row_array();
                $hslbspusat = $bspusat;


                $details = [
                    'id_transaksi' => $id_transaksi,
                    'jenis' => $kode,
                    'loc_iddept' => $hslloc,
                    'loc' => $loc[$i],
                    'id_coa_ec' => $hslcoa_ec['id_coa_ec'],
                    'id_coa_na' => $hslcoa_na['id_coa_na'],
                    'id_coa_tb' => $hslcoa_tb['id_coa_tb'],
                    'nominal' => $amount[$i],
                    'ppn' => $ppn[$i],
                    'pph' => $pph[$i],
                    'coa_ec_account' => $ec[$i],
                    'coa_na_account' => $na[$i],
                    'coa_tb_account' => $tb[$i],
                    'coa_ec_nama' => $hslcoa_ec['nama'],
                    'coa_na_nama' => $hslcoa_na['nama'],
                    'coa_tb_nama' => $hslcoa_tb['nama'],
                    'tanggal_kas_bon' => $hslbspusat['tanggal'],
                    'tgl_penerima' => '0000-00-00',
                    'tgl_penajuan' => '0000-00-00',
                    'keterangan' => $keter[$i],
                    'status' => 1,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub')
                ];

                $this->db->insert('transaksi_detail', $details);

                $createpph = [];

                if ($pph[$i] > 0) {

                    $ttlpph = '-' . $amount[$i] * $pph[$i] / 100;

                    $createpph = [
                        'id_transaksi' => $id_transaksi,
                        'jenis' => $kode,
                        'loc_iddept' => $hslloc,
                        'loc' => $loc[$i],
                        'coa_ec_account' => '000',
                        'coa_na_account' => '5141',
                        'coa_tb_account' => '10',
                        'nominal' => $ttlpph,
                        'keterangan' => $pph[$i] . '%' . ' ' . $keter[$i],
                        'status' => 1,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub')
                    ];

                    $this->db->insert('transaksi_detail', $createpph);
                }

                if ($ppn[$i] > 0) {

                    $ttlpph = $amount[$i] * $ppn[$i] / 100;

                    $createpph = [
                        'id_transaksi' => $id_transaksi,
                        'jenis' => $kode,
                        'loc_iddept' => $hslloc,
                        'loc' => $loc[$i],
                        'coa_ec_account' => '000',
                        'coa_na_account' => '5141',
                        'coa_tb_account' => '10',
                        'nominal' => $ttlpph,
                        'keterangan' => $ppn[$i] . '%' . ' ' . $keter[$i],
                        'status' => 1,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub')
                    ];

                    $this->db->insert('transaksi_detail', $createpph);
                }
            }
        }
    }

    public function updatetransaksi($id) {

        $idtransgenerate = $this->input->post('cashbankno');

        if (substr($idtransgenerate, 0, 2) == "KK") {

            $nokasbank = $this->input->post('cashbankno', TRUE);
            $datepengajuan = date('Y-m-d', strtotime($this->input->post('datepengajuan', TRUE)));
            $aplicantname = $this->input->post('aplicantname', TRUE);
            $necessity = $this->input->post('necessity', TRUE);
            $note = $this->input->post('note', TRUE);
            $ckho = $this->input->post('ckho', TRUE);
            $dateho = date('Y-m-d', strtotime($this->input->post('dateho', TRUE)));
            $suplier = $this->input->post('suplier', TRUE);
            $batchno = $this->input->post('batchno', TRUE);
            $dtpenerima = date('Y-m-d', strtotime($this->input->post('dtpenerima', TRUE)));
            $nobpkb = $this->input->post('nobpkb', TRUE);
            $chequeno = $this->input->post('chequeno', TRUE);
            $totaltrans = str_replace(['.', ','], ['', '.'], $this->input->post('totaltrans', TRUE));
            $nomorbs = $this->input->post('nomorbs', TRUE);
            $jmlterpakaiawal = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakaiawal', TRUE));
            $jmlsisabs = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakai', TRUE));
            $jmlkasbank = str_replace(['.', ','], ['', '.'], $this->input->post('nkasbank', TRUE));
            $id_transaksi = $this->input->post('id_transaksi', TRUE);
            $ppn = $this->input->post('ppn', TRUE);
            $pph = $this->input->post('pph', TRUE);




            // transaksi details
            $loc = $this->input->post('locinput', TRUE);
            $ec = $this->input->post('ecinput', TRUE);
            $na = $this->input->post('nainput', TRUE);
            $tb = $this->input->post('tbinput', TRUE);
            $amount = str_replace(['.', ','], ['', '.'], $this->input->post('ammount1input', TRUE));
            $keter = $this->input->post('keterinput', TRUE);

            $status = 1;
            $tglpenerima = '0000-00-00';

            if ($ckho == true) {
                $status = 3;
                $tglpenerima = $dtpenerima;

                $updatestatus = [
                    'no_batch' => $batchno,
                    'tgl_penerima' => $tglpenerima,
                    'no_bpk' => $nobpkb,
                    'no_giro' => $chequeno,
                    'status' => $status,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub'),
                    'updated_by' => $this->session->userdata('iduser'),
                    'updated_at' => date("Y-m-d h:i:sa")
                ];

                $this->db->set($updatestatus);
                $this->db->where('id_transaksi', $id_transaksi);
                $this->db->update('transaksi');
            } else {

                $updatestatus = [
                    'keperluan' => $necessity,
                    'catatan' => $note,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub'),
                    'updated_by' => $this->session->userdata('iduser'),
                    'updated_at' => date("Y-m-d h:i:sa")
                ];

                $this->db->set($updatestatus);
                $this->db->where('id_transaksi', $id_transaksi);
                $this->db->update('transaksi');
            }

            //now remove the details 
            $data = [
                'is_deleted' => 1,
                'deleted_at' => date("Y-m-d h:i:sa"),
                'deleted_by' => $this->session->userdata('iduser')
            ];
            $this->db->where('id_transaksi', $this->input->post('id_transaksi'));
            $this->db->update('transaksi_detail', $data);

            $a = count($this->input->post('noinput'));

            for ($i = 0; $i < $a; $i++) {

                $coa_ec = $this->db->get_where('coa_ec', ['account' => $ec[$i]])->row_array();
                $hslcoa_ec = $coa_ec;

                $coa_na = $this->db->get_where('coa_na', ['account' => $na[$i]])->row_array();
                $hslcoa_na = $coa_na;

                $coa_tb = $this->db->get_where('coa_tb', ['account' => $tb[$i]])->row_array();
                $hslcoa_tb = $coa_tb;


                $loc1 = $this->db->get_where('departement', ['kode_loc' => $loc[$i]])->row_array();
                $hslloc = $loc1['id_departement'];

                $this->db->where_in('id_transaksi_dept', $nomorbs);
                $transaksi_department = $this->db->get('transaksi_department')->row_array();
                $hsltransdept = $transaksi_department;


                $details = [
                    'id_transaksi' => $id_transaksi,
                    'jenis' => substr($idtransgenerate, 0, 2),
                    'loc_iddept' => $hslloc,
                    'loc' => $loc[$i],
                    'id_coa_ec' => $hslcoa_ec['id_coa_ec'],
                    'id_coa_na' => $hslcoa_na['id_coa_na'],
                    'id_coa_tb' => $hslcoa_tb['id_coa_tb'],
                    'nominal' => $amount[$i],
                    'coa_ec_account' => $ec[$i],
                    'coa_na_account' => $na[$i],
                    'coa_tb_account' => $tb[$i],
                    'coa_ec_nama' => $hslcoa_ec['nama'],
                    'coa_na_nama' => $hslcoa_na['nama'],
                    'coa_tb_nama' => $hslcoa_tb['nama'],
                    'tanggal_kas_bon' => $hsltransdept['tgl_terima'],
                    'tgl_penerima' => $tglpenerima,
                    'tgl_penajuan' => $hsltransdept['tgl_buat'],
                    'keterangan' => $keter[$i],
                    'status' => $status,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub'),
                    'updated_by' => $this->session->userdata('iduser'),
                    'updated_at' => date("Y-m-d h:i:sa")
                ];

                $this->db->insert('transaksi_detail', $details);
            }



            $datas = [
                'is_deleted' => 1,
                'deleted_at' => date("Y-m-d h:i:sa"),
                'deleted_by' => $this->session->userdata('iduser')
            ];
            $this->db->where('id_transaksi', $id_transaksi);
            $this->db->like('keterangan', '%');
            $this->db->update('transaksi_detail', $datas);

            $this->db->where('id_transaksi', $id_transaksi);
            $data = $this->db->get('transaksi_detail')->result();

            $result = [];
            $d = [];
            $ec = 1;
            foreach ($data as $key => $value) {

                if ($value->pph > 0) {

                    $d1 = [
                        'id_transaksi' => $value->id_transaksi,
                        'jenis' => $value->jenis,
                        'loc_iddept' => $value->loc_iddept,
                        'loc' => $value->loc,
                        'coa_ec_account' => '000',
                        'coa_na_account' => '5141',
                        'coa_tb_account' => '10',
                        'nominal' => '-' . $value->nominal * $value->pph / 100,
                        'keterangan' => $value->pph . '%' . ' ' . $value->keterangan,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub'),
                        'created_by' => $this->session->userdata('iduser'),
                        'created_at' => date("Y-m-d h:i:sa")
                    ];

                    $this->db->insert('transaksi_detail', $d);
                }

                if ($value->ppn > 0) {
                    $d = [
                        'id_transaksi' => $value->id_transaksi,
                        'jenis' => $value->jenis,
                        'loc_iddept' => $value->loc_iddept,
                        'loc' => $value->loc,
                        'coa_ec_account' => '000',
                        'coa_na_account' => '3834',
                        'coa_tb_account' => '10',
                        'nominal' => $value->nominal * $value->ppn / 100,
                        'keterangan' => $value->ppn . '%' . ' ' . $value->keterangan,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub'),
                        'created_by' => $this->session->userdata('iduser'),
                        'created_at' => date("Y-m-d h:i:sa")
                    ];

                    $this->db->insert('transaksi_detail', $d);
                }
            }
        } elseif (substr($idtransgenerate, 0, 3) == "KAS") {

            $nokasbank = $this->input->post('cashbankno', TRUE);
            $datepengajuan = date('Y-m-d', strtotime($this->input->post('datepengajuan')));
            $aplicantname = $this->input->post('aplicantname');
            $necessity = $this->input->post('necessity');
            $note = $this->input->post('note');
            $ckho = $this->input->post('ckho');
            $dateho = date('Y-m-d', strtotime($this->input->post('dateho')));
            $suplier = $this->input->post('suplier');
            $batchno = $this->input->post('batchno');
            $dtpenerima = date('Y-m-d', strtotime($this->input->post('dtpenerima')));
            $nobpkb = $this->input->post('nobpkb');
            $chequeno = $this->input->post('chequeno');
            $totaltrans = str_replace(['.', ','], ['', '.'], $this->input->post('totaltrans'));
            $nomorbs = $this->input->post('nomorbs');
            $jmlterpakaiawal = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakaiawal'));
            $jmlsisabs = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakai'));
            $jmlkasbank = str_replace(['.', ','], ['', '.'], $this->input->post('nkasbank'));
            $id_transaksi = $this->input->post('id_transaksi');
            $ppn = $this->input->post('ppn', TRUE);
            $pph = $this->input->post('pph', TRUE);



            // transaksi details
            $loc = $this->input->post('locinput');
            $ec = $this->input->post('ecinput');
            $na = $this->input->post('nainput');
            $tb = $this->input->post('tbinput');
            $amount = str_replace(['.', ','], ['', '.'], $this->input->post('ammount1input'));
            $keter = $this->input->post('keterinput');

            $status = 1;
            $tglpenerima = '0000-00-00';

            if ($ckho == true) {
                $status = 2;
                $tglpenerima = $dtpenerima;

                $updatestatus = [
                    'no_batch' => $batchno,
                    'tgl_proses' => $dateho,
                    'tgl_penerima' => $tglpenerima,
                    'no_bpk' => $nobpkb,
                    'no_giro' => $chequeno,
                    'status' => $status,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub'),
                    'updated_by' => $this->session->userdata('iduser'),
                    'updated_at' => date("Y-m-d h:i:sa")
                ];

                $this->db->set($updatestatus);
                $this->db->where('id_transaksi', $id_transaksi);
                $this->db->update('transaksi');
            } else {


                $updatestatus = [
                    'tgl_pengajuan' => $datepengajuan,
                    'pemohon' => $aplicantname,
                    'keperluan' => $necessity,
                    'catatan' => $note,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub'),
                    'updated_by' => $this->session->userdata('iduser'),
                    'updated_at' => date("Y-m-d h:i:sa")
                ];

                $this->db->set($updatestatus);
                $this->db->where('id_transaksi', $id_transaksi);
                $this->db->update('transaksi');
            }

            // now remove the order item data 
            $this->db->where('id_transaksi', $this->input->post('id_transaksi'));
            $this->db->delete('transaksi_detail');

            $a = count($this->input->post('noinput'));

            for ($i = 0; $i < $a; $i++) {

                $coa_ec = $this->db->get_where('coa_ec', ['account' => $ec[$i]])->row_array();
                $hslcoa_ec = $coa_ec;

                $coa_na = $this->db->get_where('coa_na', ['account' => $na[$i]])->row_array();
                $hslcoa_na = $coa_na;

                $coa_tb = $this->db->get_where('coa_tb', ['account' => $tb[$i]])->row_array();
                $hslcoa_tb = $coa_tb;

                $loc1 = $this->db->get_where('departement', ['kode_loc' => $loc[$i]])->row_array();
                $hslloc = $loc1['id_departement'];


                if ($nomorbs == null) {
                    $hslbspusat = '0000-00-00';
                } else {
                    $this->db->where_in('idbskantorpusat', $nomorbs);
                    $bspusat = $this->db->get('bskantorpusat')->row_array();
                    $hslbspusat = $bspusat['tanggal'];
                }


                $details = [
                    'id_transaksi' => $id_transaksi,
                    'jenis' => substr($idtransgenerate, 0, 4),
                    'loc_iddept' => $hslloc,
                    'loc' => $loc[$i],
                    'id_coa_ec' => $hslcoa_ec['id_coa_ec'],
                    'id_coa_na' => $hslcoa_na['id_coa_na'],
                    'id_coa_tb' => $hslcoa_tb['id_coa_tb'],
                    'nominal' => $amount[$i],
                    'ppn' => $ppn[$i],
                    'pph' => $pph[$i],
                    'coa_ec_account' => $ec[$i],
                    'coa_na_account' => $na[$i],
                    'coa_tb_account' => $tb[$i],
                    'coa_ec_nama' => $hslcoa_ec['nama'],
                    'coa_na_nama' => $hslcoa_na['nama'],
                    'coa_tb_nama' => $hslcoa_tb['nama'],
                    'tanggal_kas_bon' => $hslbspusat,
                    'tgl_penerima' => $dtpenerima,
                    'tgl_penajuan' => $dateho,
                    'keterangan' => $keter[$i],
                    'status' => $status,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub')
                ];

                $this->db->insert('transaksi_detail', $details);
            }

            $this->db->where('id_transaksi', $id_transaksi);
            $this->db->like('keterangan', '%');
            $this->db->delete('transaksi_detail');

            $this->db->where('id_transaksi', $id_transaksi);
            $data = $this->db->get('transaksi_detail')->result();

            $result = [];
            $d = [];
            $ec = 1;
            foreach ($data as $key => $value) {

                if ($value->pph > 0) {

                    $d1 = [
                        'id_transaksi' => $value->id_transaksi,
                        'jenis' => $value->jenis,
                        'loc_iddept' => $value->loc_iddept,
                        'loc' => $value->loc,
                        'coa_ec_account' => '000',
                        'coa_na_account' => '5141',
                        'coa_tb_account' => '10',
                        'nominal' => '-' . $value->nominal * $value->pph / 100,
                        'keterangan' => $value->pph . '%' . ' ' . $value->keterangan,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub')
                    ];

                    $this->db->insert('transaksi_detail', $d);
                }

                if ($value->ppn > 0) {
                    $d = [
                        'id_transaksi' => $value->id_transaksi,
                        'jenis' => $value->jenis,
                        'loc_iddept' => $value->loc_iddept,
                        'loc' => $value->loc,
                        'coa_ec_account' => '000',
                        'coa_na_account' => '3834',
                        'coa_tb_account' => '10',
                        'nominal' => $value->nominal * $value->ppn / 100,
                        'keterangan' => $value->ppn . '%' . ' ' . $value->keterangan,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub')
                    ];

                    $this->db->insert('transaksi_detail', $d);
                }
            }
        } else {

            $nokasbank = $this->input->post('cashbankno', TRUE);
            $datepengajuan = date('Y-m-d', strtotime($this->input->post('datepengajuan', TRUE)));
            $aplicantname = $this->input->post('aplicantname', TRUE);
            $necessity = $this->input->post('necessity', TRUE);
            $note = $this->input->post('note', TRUE);
            $ckho = $this->input->post('ckho', TRUE);
            $dateho = date('Y-m-d', strtotime($this->input->post('dateho', TRUE)));
            $suplier = $this->input->post('suplier', TRUE);
            $batchno = $this->input->post('batchno', TRUE);
            $dtpenerima = date('Y-m-d', strtotime($this->input->post('dtpenerima', TRUE)));
            $nobpkb = $this->input->post('nobpkb', TRUE);
            $chequeno = $this->input->post('chequeno', TRUE);
            $totaltrans = str_replace(['.', ','], ['', '.'], $this->input->post('totaltrans', TRUE));
            $nomorbs = $this->input->post('nomorbs', TRUE);
            $jmlterpakaiawal = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakaiawal', TRUE));
            $jmlsisabs = str_replace(['.', ','], ['', '.'], $this->input->post('jmlterpakai', TRUE));
            $jmlkasbank = str_replace(['.', ','], ['', '.'], $this->input->post('nkasbank', TRUE));
            $id_transaksi = $this->input->post('id_transaksi', TRUE);
            $ppn = $this->input->post('ppn', TRUE);
            $pph = $this->input->post('pph', TRUE);



            // transaksi details
            $loc = $this->input->post('locinput', TRUE);
            $ec = $this->input->post('ecinput', TRUE);
            $na = $this->input->post('nainput', TRUE);
            $tb = $this->input->post('tbinput', TRUE);
            $amount = str_replace(['.', ','], ['', '.'], $this->input->post('ammount1input', TRUE));
            $keter = $this->input->post('keterinput', TRUE);

            $status = 1;
            $tglpenerima = '0000-00-00';

            if ($ckho == true) {
                $status = 2;
                $tglpenerima = $dtpenerima;

                $updatestatus = [
                    'no_batch' => $batchno,
                    'tgl_proses' => $dateho,
                    'tgl_penerima' => $tglpenerima,
                    'no_bpk' => $nobpkb,
                    'no_giro' => $chequeno,
                    'status' => $status,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub'),
                    'updated_by' => $this->session->userdata('iduser'),
                    'updated_at' => date("Y-m-d h:i:sa")
                ];

                $this->db->set($updatestatus);
                $this->db->where('id_transaksi', $id_transaksi);
                $this->db->update('transaksi');
            } else {

                $updatestatus = [
                    'tgl_pengajuan' => $datepengajuan,
                    'idsuplier' => $suplier,
                    'pemohon' => $aplicantname,
                    'keperluan' => $necessity,
                    'catatan' => $note,
                    'total' => $totaltrans,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub'),
                    'updated_by' => $this->session->userdata('iduser'),
                    'updated_at' => date("Y-m-d h:i:sa")
                ];

                $this->db->set($updatestatus);
                $this->db->where('id_transaksi', $id_transaksi);
                $this->db->update('transaksi');
            }



            // now remove the order item data 
            $this->db->where('id_transaksi', $this->input->post('id_transaksi'));
            $this->db->delete('transaksi_detail');

            $a = count($this->input->post('noinput'));



            for ($i = 0; $i < $a; $i++) {

                $coa_ec = $this->db->get_where('coa_ec', ['account' => $ec[$i]])->row_array();
                $hslcoa_ec = $coa_ec;

                $coa_na = $this->db->get_where('coa_na', ['account' => $na[$i]])->row_array();
                $hslcoa_na = $coa_na;

                $coa_tb = $this->db->get_where('coa_tb', ['account' => $tb[$i]])->row_array();
                $hslcoa_tb = $coa_tb;

                $loc1 = $this->db->get_where('departement', ['kode_loc' => $loc[$i]])->row_array();
                $hslloc = $loc1['id_departement'];


                $this->db->where_in('idbskantorpusat', $nomorbs);
                $bspusat = $this->db->get('bskantorpusat')->row_array();
                $hslbspusat = $bspusat;


                $details = [
                    'id_transaksi' => $id_transaksi,
                    'jenis' => substr($idtransgenerate, 0, 3),
                    'loc_iddept' => $hslloc,
                    'loc' => $loc[$i],
                    'id_coa_ec' => $hslcoa_ec['id_coa_ec'],
                    'id_coa_na' => $hslcoa_na['id_coa_na'],
                    'id_coa_tb' => $hslcoa_tb['id_coa_tb'],
                    'nominal' => $amount[$i],
                    'ppn' => $ppn[$i],
                    'pph' => $pph[$i],
                    'coa_ec_account' => $ec[$i],
                    'coa_na_account' => $na[$i],
                    'coa_tb_account' => $tb[$i],
                    'coa_ec_nama' => $hslcoa_ec['nama'],
                    'coa_na_nama' => $hslcoa_na['nama'],
                    'coa_tb_nama' => $hslcoa_tb['nama'],
                    'tanggal_kas_bon' => $hslbspusat['tanggal'],
                    'tgl_penerima' => $dtpenerima,
                    'tgl_penajuan' => $dateho,
                    'keterangan' => $keter[$i],
                    'status' => $status,
                    'id_user' => $this->session->userdata('iduser'),
                    'hub' => $this->session->userdata('hub'),
                    'created_by' => $this->session->userdata('iduser'),
                    'created_at' => date("Y-m-d h:i:sa")
                ];

                $this->db->insert('transaksi_detail', $details);
            }


            $datas = [
                'is_deleted' => 1,
                'deleted_at' => date("Y-m-d h:i:sa"),
                'deleted_by' => $this->session->userdata('iduser')
            ];
            $this->db->where('id_transaksi', $id_transaksi);
            $this->db->like('keterangan', '%');
            $this->db->update('transaksi_detail', $datas);

            $this->db->where('id_transaksi', $id_transaksi);
            $data = $this->db->get('transaksi_detail')->result();

            $result = [];
            $d = [];
            foreach ($data as $key => $value) {

                if ($value->pph > 0) {

                    $d = [
                        'id_transaksi' => $value->id_transaksi,
                        'jenis' => $value->jenis,
                        'loc_iddept' => $value->loc_iddept,
                        'loc' => $value->loc,
                        'coa_ec_account' => '000',
                        'coa_na_account' => '5141',
                        'coa_tb_account' => '10',
                        'nominal' => '-' . $value->nominal * $value->pph / 100,
                        'keterangan' => $value->pph . '%' . ' ' . $value->keterangan,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub'),
                        'created_by' => $this->session->userdata('iduser'),
                        'created_at' => date("Y-m-d h:i:sa")
                    ];

                    $this->db->insert('transaksi_detail', $d);
                }

                if ($value->ppn > 0) {
                    $d = [
                        'id_transaksi' => $value->id_transaksi,
                        'jenis' => $value->jenis,
                        'loc_iddept' => $value->loc_iddept,
                        'loc' => $value->loc,
                        'coa_ec_account' => '000',
                        'coa_na_account' => '3834',
                        'coa_tb_account' => '10',
                        'nominal' => $value->nominal * $value->ppn / 100,
                        'keterangan' => $value->ppn . '%' . ' ' . $value->keterangan,
                        'id_user' => $this->session->userdata('iduser'),
                        'hub' => $this->session->userdata('hub'),
                        'created_by' => $this->session->userdata('iduser'),
                        'created_at' => date("Y-m-d h:i:sa")
                    ];

                    $this->db->insert('transaksi_detail', $d);
                }
            }
        }
    }

    public function getAllDataTransHeader() {
        return $this->db->get_where('transaksi', ['hub' => $this->session->userdata('hub')])->result();
    }

    public function getDataSuplier() {
        return $this->db->get('suplier')->result_array();
    }

    public function getdatatransaksi($id = null) {

        if (!$id) {
            return false;
        }

        $sql = "SELECT * FROM transaksi WHERE id_transaksi = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function getdatatransdepartment($id = null) {
        if ($id) {
            $sql = "SELECT * FROM transaksi_department where no_bs = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }
    }

    public function update($data, $id) {
        if ($data && $id) {
            $this->db->where('no_bs', $id);
            $update = $this->db->update('transaksi_department', $data);
            return ($update == true) ? true : false;
        }
    }

    public function getTampilKantorDataPusat() {

        $this->db->select('*');
        $this->db->from('bskantorpusat');
        $this->db->join('bagian', 'bskantorpusat.idbagian = bagian.idbagian');
        $this->db->join('departement', 'bskantorpusat.id_department = departement.id_departement');
        $this->db->where('hub', $this->session->userdata('hub'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function simpanKasbonKantorPusat() {
        $nobs = $this->input->post('nobs', TRUE);
        $nokasbank = $this->input->post('nokasbank', TRUE);
        $tgl = date('Y-m-d', strtotime($this->input->post('tgl', TRUE)));
        $pemohon = $this->input->post('pemohon', TRUE);
        $jumlah = str_replace(['.', ','], ['', '.'], $this->input->post('jumlah', TRUE));
        $keperluan = $this->input->post('keperluan', TRUE);
        $bagian = $this->input->post('bagian', TRUE);
        $kodelokasi = $this->input->post('kodelokasi', TRUE);
        $kodeec = $this->input->post('kodeec', TRUE);
        $kodena = $this->input->post('kodena', TRUE);
        $kodebisnis = $this->input->post('kodebisnis', TRUE);
        $tglrealisasi = date('Y-m-d', strtotime($this->input->post('tglrealisasi', TRUE)));
        $catatan = $this->input->post('catatan', TRUE);


        $data = [
            'nobs' => $nobs,
            'nokasbank' => $nokasbank,
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
            'status' => 1,
            'id_user' => $this->session->userdata('iduser'),
            'hub' => $this->session->userdata('hub'),
            'created_by' => $this->session->userdata('iduser'),
            'created_at' => date("Y-m-d h:i:sa")
        ];

        $this->db->insert('bskantorpusat', $data);
    }

    public function getNomorBsKantor() {
        $this->db->select('RIGHT(bskantorpusat.nobs,8) as kode', FALSE);
        $this->db->order_by('idbskantorpusat', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('bskantorpusat');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 8, "0", STR_PAD_LEFT);
        $kodejadi = "BSP-" . $kodemax;
        return $kodejadi;
    }

    public function getAllDataBsKantorPusatById($id) {

        $this->db->select('bskantorpusat.*,');
        $this->db->from('bskantorpusat');
        $this->db->join('bagian', 'bskantorpusat.idbagian = bagian.idbagian');
        $this->db->join('departement', 'bskantorpusat.id_department = departement.id_departement');
        $this->db->where('idbskantorpusat', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // public function getTampilStatus()
    // {
    //   $this->db->select('*');
    //   $this->db->from('bskantorpusat');
    //   $this->db->join('bagian', 'bskantorpusat.idbagian = bagian.idbagian');
    //   $this->db->join('departement', 'bskantorpusat.id_department = departement.id_departement');
    //   $query = $this->db->get();
    //   return $query->result_array();
    // }

    public function getNoIkhtisar() {
        $this->db->select('RIGHT(ikhtisar_header.no_ikhtisar,8) as kode', FALSE);
        $this->db->order_by('id_ikhtisar', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('ikhtisar_header');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 8, "0", STR_PAD_LEFT);
        $kodejadi = "Ikh-" . $kodemax;
        return $kodejadi;
    }

    public function simpanikhtisar() {
        $noikhtisar = $this->input->post('noikhtisar', TRUE);
        $tglikhtisar = date('Y-m-d', strtotime($this->input->post('tglikhtisar', TRUE)));
        $tglproses = date('Y-m-d', strtotime($this->input->post('tglproses', TRUE)));
        $pilihkasbank = $this->input->post('pilih', TRUE);

        //$lokasi = $this->input->post('lokasi');
        // $this->db->where_in('id_transaksi', $pilihkasbank);
        // $data = $this->db->get('transaksi')->result();
        // foreach ($data as $value) {
        //  $hasil[] = unserialize($value->id_transaksi_dept);
        // }
        //  $result = call_user_func_array("array_merge", $hasil);
        //  $implode = implode(",", $result);
        // dengan cara ini juga bisa... keep refrense for merge array :)
        // $new = [];
        // foreach ($hasil as $key => $val)
        //  {
        //      sort($val);
        //     $new = array_merge($val, $new);
        // }

        $data = [
            'no_ikhtisar' => $noikhtisar,
            'tgl_ikhtisar' => $tglikhtisar,
            'tgl_proses_ho' => $tglproses,
            'status' => 1,
            'id_lokasi' => $this->session->userdata('hub'),
            'id_user' => $this->session->userdata('iduser'),
            'hub' => $this->session->userdata('hub'),
            'created_by' => $this->session->userdata('iduser'),
            'created_at' => date("Y-m-d h:i:sa")
        ];



        $this->db->insert('ikhtisar_header', $data);
        $idikhtisar = $this->db->insert_id();


        $jmldata = count($pilihkasbank);
        for ($i = 0; $i < $jmldata; $i++) {

            $this->db->where_in('id_transaksi', $pilihkasbank[$i]);
            $kasbank = $this->db->get('transaksi')->row();



            $details = [
                'id_ikhtisar' => $idikhtisar,
                'idkasbank' => $pilihkasbank[$i],
                'cashbankno' => $kasbank->cashbankno,
                'tgl_pengajuan' => $kasbank->tgl_pengajuan,
                'id_transaksi_dept' => $kasbank->id_transaksi_dept,
                'pemohon' => $kasbank->pemohon,
                'keperluan' => $kasbank->keperluan,
                'catatan' => $kasbank->catatan,
                'total' => $kasbank->total,
                'status' => 1,
                'idlokasi' => $this->session->userdata('hub'),
                'id_user' => $this->session->userdata('iduser'),
                'hub' => $this->session->userdata('hub'),
                'created_by' => $this->session->userdata('iduser'),
                'created_at' => date("Y-m-d h:i:sa")
            ];

            $this->db->insert('ikhtisar_detail', $details);


            $this->db->set('status', 2);
            $this->db->set('tgl_proses', $tglproses);
            $this->db->set('tgl_penerima', '0000-00-00');
            $this->db->set('id_user', $this->session->userdata('iduser'));
            $this->db->set('hub', $this->session->userdata('hub'));
            $this->db->where_in('id_transaksi', $pilihkasbank);
            $this->db->update('transaksi');


            $this->db->set('status', 2);
            $this->db->set('tgl_penerima', $tglproses);
            $this->db->set('id_user', $this->session->userdata('iduser'));
            $this->db->set('hub', $this->session->userdata('hub'));
            $this->db->where_in('id_transaksi', $pilihkasbank);
            $this->db->update('transaksi_detail');
        }
    }

    public function upload_file($filename) {
        $this->load->library('upload'); // Load librari upload

        $config['upload_path'] = './excel/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size'] = '2048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;

        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    public function insert_multiple($data) {
        $this->db->insert_batch('ar_aging', $data);
    }

    public function getAllDataCusotmer($limit, $start, $keyword = null) {

        if ($keyword) {
            $this->db->group_start();
            $this->db->like('no', $keyword);
            $this->db->or_like('nama', $keyword);
            $this->db->or_like('hub', $keyword);
            $this->db->or_like('pic1', $keyword);
            $this->db->group_end();
            
            
        }
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
      
    }
    
    public function count_invoice_sudah() {
        $sql = "select count(id_ar) as no from ar_aging a join customer b on b.no=a.no_cs where b.flag=1";
        return $this->db->query($sql)->result();
    }

    public function count_invoice_blm() {
        $sql = "select count(id_ar) as no from ar_aging a join customer b on b.no=a.no_cs where b.flag=0";
        return $this->db->query($sql)->result();
    }
    public function d120() {
        $sql="select sum(os) no from ar_aging where datediff(current_date(), due_date) >=120";
                return $this->db->query($sql)->result();
}
    public function d90120() {
        $sql="select sum(os) no from ar_aging where datediff(current_date(), due_date) >=90 and datediff(current_date(), due_date) <=120";
                return $this->db->query($sql)->result();
}

    public function d6090() {
        $sql=" select sum(os)no from ar_aging where datediff(current_date(), due_date) >=60 and datediff(current_date(), due_date) < 90";
                return $this->db->query($sql)->result();
}
    public function d3060() {
        $sql=" select sum(os)no from ar_aging where datediff(current_date(), due_date) >=30 and datediff(current_date(), due_date) < 60";
                return $this->db->query($sql)->result();
}
   public function d060() {
        $sql=" select sum(os)no from ar_aging where datediff(current_date(), due_date) >=0 and datediff(current_date(), due_date) < 30";
                return $this->db->query($sql)->result();
}
 public function d0() {
        $sql=" select sum(os)no from ar_aging where datediff(current_date(), due_date) < 0";
                return $this->db->query($sql)->result();
}
public function d120s() {
        $sql="select *,sum(freight) as f,sum(insurance) i,sum(total) t,sum(os) o from ar_aging where datediff(current_date(), due_date) >=120 group by no_cs";
                return $this->db->query($sql)->result();
}
  public function d90120s() {
        $sql="select *,sum(freight) as f,sum(insurance) i,sum(total) t,sum(os) o from ar_aging where datediff(current_date(), due_date) >=90 and datediff(current_date(), due_date) <=120 group by no_cs";
                return $this->db->query($sql)->result();
}

    public function d6090s() {
        $sql="select *,sum(freight) as f,sum(insurance) i,sum(total) t,sum(os) o from ar_aging where datediff(current_date(), due_date) >=60 and datediff(current_date(), due_date) < 90 group by no_cs";
                return $this->db->query($sql)->result();
}
    public function d3060s() {
        $sql="select *,sum(freight) as f,sum(insurance) i,sum(total) t,sum(os) o from ar_aging where datediff(current_date(), due_date) >=30 and datediff(current_date(), due_date) < 60 group by no_cs";
                return $this->db->query($sql)->result();
}
   public function d060s() {
        $sql="select *,sum(freight) as f,sum(insurance) i,sum(total) t,sum(os) o from ar_aging where datediff(current_date(), due_date) >=0 and datediff(current_date(), due_date) < 30 group by no_cs";
                return $this->db->query($sql)->result();
}
 public function d0s() {
        $sql="select *,sum(freight) as f,sum(insurance) i,sum(total) t,sum(os) o from ar_aging where datediff(current_date(), due_date) < 0 group by no_cs";
                return $this->db->query($sql)->result();
}

public function ubahCust() {
        $no = $this->input->post('no', TRUE);
        $nama = $this->input->post('nama', TRUE);
        $top = $this->input->post('top', TRUE);
        $pic1 = $this->input->post('pic1', TRUE);
        $pic2 = $this->input->post('pic2', TRUE);
        $pic3 = $this->input->post('pic3', TRUE);
        $email1 = $this->input->post('email1', TRUE);
        $email2 = $this->input->post('email2', TRUE);
        $email3 = $this->input->post('email3', TRUE);
        $id_customer = $this->input->post('id_customer', TRUE);

        $data = [
            'no' => $no,
            'nama' => $nama,
            'top' => $top,
            'pic1' => $pic1,
            'pic2' => $pic2,
            'pic3' => $pic3,
            'email1' => $email1,
            'email2' => $email2,
            'email3' => $email3,
            'updated_by' => $this->session->userdata('iduser'),
            'updated_at'=> date("Y-m-d h:i:sa"),
        ];

        $this->db->where('id_customer', $id_customer);
        $this->db->update('customer', $data);
    }
   
}
