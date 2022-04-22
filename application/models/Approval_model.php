<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval_model extends CI_Model
{
    public function get_data_permintaan()
    {
        $this->db->select('permintaan_pembelian_header.*, departement.nama, bagian.nama_bagian');
        $this->db->from('permintaan_pembelian_header');
        $this->db->join('departement', 'permintaan_pembelian_header.id_departement = departement.id_departement');
        $this->db->join('bagian', 'permintaan_pembelian_header.id_bagian = bagian.idbagian');
        $array=array('status'=> 1,'permintaan_pembelian_header.id_bagian'=>$this->session->userdata('bagian_id'));
        $this->db->where($array);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_data_header_id($id)
    {
        $this->db->select('permintaan_pembelian_header.*, departement.nama, bagian.nama_bagian');
        $this->db->from('permintaan_pembelian_header');
        $this->db->join('departement', 'permintaan_pembelian_header.id_departement = departement.id_departement');
        $this->db->join('bagian', 'permintaan_pembelian_header.id_bagian = bagian.idbagian');
        $this->db->where('id_permintaan', $id);
        $query = $this->db->get()->row();
        return $query;
    }
    public function get_data_permintaan_detail_id($id)
    {
        $this->db->select('a.*, b.kode_barang, b.nama_barang, c.nama_satuan, d.nama_categori');
        $this->db->from('permintaan_pembelian_detail a');
        $this->db->join('barang b', 'a.id_barang = b.id_barang');
        $this->db->join('satuan c', 'b.id_satuan = c.id_satuan');
        $this->db->join('categori d', 'b.id_categori = d.id_categori');
        $this->db->where('id_permintaan', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    
    /* =================================================Jasa========================*/
    
   
    public function get_data_permintaan_jasa()
    {
        $this->db->select('permintaan_jasa_all.*, departement.nama, bagian.nama_bagian,user.name');
        $this->db->from('permintaan_jasa_all');
        $this->db->join('departement', 'permintaan_jasa_all.department_id = departement.id_departement');
        $this->db->join('bagian', 'permintaan_jasa_all.bagian_id = bagian.idbagian');
        $this->db->join('user','permintaan_jasa_all.created_by=user.id');
        $array=array('status'=> 1,'permintaan_jasa_all.bagian_id'=>$this->session->userdata('bagian_id'));
        $this->db->where($array);
        $query = $this->db->get()->result();
        return $query;
    }
   
}
