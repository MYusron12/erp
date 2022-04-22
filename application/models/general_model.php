<?php

defined('BASEPATH') or exit('No direct script access allowed');

class General_model extends CI_Model {

    public function no($trx) {
        if ($trx == 'PR') {
            $kode = '';
            $idbagian = $this->session->userdata('bagian_id');
            $query = $this->db->query("select * from counter a join bagian b on b.idbagian = a.id_bagian where a.id_bagian='$idbagian' and a.transaksi='$trx'");
            foreach ($query->result_array() as $row):
                if ($row['jumlah'] > 8) {
                    $j = $row['jumlah'] + 1;
                    $kode = $row['kode'];
                    $dept = $row['kode_bagian'];
                    $no = '00';
                    $emd=date('m-y');
                    $trans=$row['transaksi'];
                    
                } else {
                    $j = $row['jumlah'] + 1;
                    $kode = $row['kode'];
                    $dept = $row['kode_bagian'];
                    $no = '000';
                    $emd=date('m-y');
                    $trans=$row['transaksi'];
                }
            endforeach;

            $kodejadi = $trans.'-'.$kode.$dept.'-'.$no.$j.'-'.$emd;
            return $kodejadi;
        }elseif($trx == 'IPO'){
             $kode = '';
            $idbagian = $this->session->userdata('bagian_id');
            $query = $this->db->query("select * from counter a join bagian b on b.idbagian = a.id_bagian where a.id_bagian='$idbagian' and a.transaksi='$trx'");
            foreach ($query->result_array() as $row):
                if ($row['jumlah'] > 8) {
                    $j = $row['jumlah'] + 1;
                    $kode = $row['kode'];
                    $dept = $row['kode_bagian'];
                    $no = '00';
                    $emd=date('m-y');
                    $trans=$row['transaksi'];
                    
                } else {
                    $j = $row['jumlah'] + 1;
                    $kode = $row['kode'];
                    $dept = $row['kode_bagian'];
                    $no = '000';
                    $emd=date('m-y');
                    $trans=$row['transaksi'];
                }
            endforeach;

            $kodejadi = $trans.'-'.$kode.$dept.'-'.$no.$j.'-'.$emd;
            return $kodejadi;
        }else{
			
        $kode = '';
        $idbagian = $this->session->userdata('bagian_id');
        $query = $this->db->query("select * from counter where id_bagian='$idbagian' and transaksi='$trx'");
		
        foreach ($query->result_array() as $row):
            if ($row['jumlah'] > 8) {
                $j = $row['jumlah'] + 1;
                $kode = $row['kode'];
            } else {
                $j = $row['jumlah'] + 1;
                $kode = $row['kode'];
            }
        endforeach;

        $kodejadi = $kode . $j;
        return $kodejadi;
    }
    }

}
