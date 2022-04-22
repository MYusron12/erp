<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Wo_model extends CI_Model {
       protected $primaryKey = "id_permintaan_pengerjaan";
       protected $softDeletedTrueValue = '1';
       protected $table = "permintaan_pengerjaan";
       protected $dateFormat = 'datetime';
       protected $timestamps = true;
       const DELETED_AT = 'deleted_at';
       const CREATED_AT = 'created_at';
       const UPDATED_AT = 'updated_at';
       const SOFT_DELETED = 'is_deleted';
      
     

    public function simpanwo() {
        $no_pengerjaan = $this->input->post('no_pengerjaan', TRUE);
        $id_bagian = $this->input->post('id_bagian', TRUE);
        $deskripsi_supir = $this->input->post('deskripsi_supir', TRUE);
        $tgl_order = date('Y-m-d', strtotime($this->input->post('tgl_order', TRUE)));
        $deskripsi_peminta = $this->input->post('deskripsi_peminta', TRUE);
        $deskripsi_komponen = $this->input->post('deskripsi_komponen', TRUE);
        $categori = $this->input->post('categori', TRUE);
        $id_truck = $this->input->post('id_truck', TRUE);
        

        $data = [
            'no_pengerjaan' => $no_pengerjaan,
            'deskripsi_supir' => $deskripsi_supir,
            'id_bagian' => $id_bagian,
            'tgl_order' => $tgl_order,
            'deskripsi_komponen' => $deskripsi_komponen,
            'categori' => $categori,
            'deskripsi_peminta' => $deskripsi_peminta,
            'id_truck' => $id_truck,
            'status' => 1,
            'id_user' => $this->session->userdata('iduser'),
            'created_by'=> $this->session->userdata('iduser'),
            'created_at'=> date("Y-m-d h:i:sa"),
            'is_deleted'=>0,
            'status_global'=>1
        ];
        $this->db->insert('permintaan_pengerjaan', $data);
    }

    public function ubahWo() {
        $no_pengerjaan = $this->input->post('no_pengerjaan', TRUE);
        $id_bagian = $this->input->post('id_bagian', TRUE);
        $tgl_order = date('Y-m-d', strtotime($this->input->post('tgl_order', TRUE)));
        $deskripsi_supir = $this->input->post('deskripsi_supir', TRUE);
         $categori = $this->input->post('categori', TRUE);
        $deskripsi_peminta = $this->input->post('deskripsi_peminta', TRUE);
        $id_truck = $this->input->post('id_truck', TRUE);
        $id_permintaan_pengerjaan = $this->input->post('id_permintaan_pengerjaan', TRUE);

        $data = [
            'no_pengerjaan' => $no_pengerjaan,
            'id_bagian' => $id_bagian,
            'tgl_order' => $tgl_order,
            'deskripsi_peminta' => $deskripsi_peminta,
            'id_truck' => $id_truck,
            'status' => 1,
            'updated_by' => $this->session->userdata('iduser'),
            'updated_at'=> date("Y-m-d h:i:sa"),
             'deskripsi_supir' => $deskripsi_supir,
             'categori' => $categori
        ];

        $this->db->where('id_permintaan_pengerjaan', $id_permintaan_pengerjaan);
        $this->db->update('permintaan_pengerjaan', $data);
    }
    

    public function checkWo() {
        $no_pengerjaan = $this->input->post('no_pengerjaan', TRUE);
        $id_bagian = $this->input->post('id_bagian', TRUE);
        $tgl_order = date('Y-m-d', strtotime($this->input->post('tgl_order', TRUE)));
        $deskripsi_peminta = $this->input->post('deskripsi_peminta', TRUE);
        $id_truck = $this->input->post('id_truck', TRUE);
        $id_permintaan_pengerjaan = $this->input->post('id_permintaan_pengerjaan', TRUE);
        $deskripsi_perkerja = $this->input->post('deskripsi_perkerja', TRUE);
        $pic_cek = $this->input->post('pic_cek', TRUE);
        $tanggal_cek = date('Y-m-d', strtotime($this->input->post('tanggal_cek', TRUE)));
        $deskripsi_komponen = $this->input->post('deskripsi_komponen', TRUE);
         $categori = $this->input->post('categori', TRUE);
        $data = [
            'no_pengerjaan' => $no_pengerjaan,
            'id_bagian' => $id_bagian,
            'tgl_order' => $tgl_order,
            'deskripsi_peminta' => $deskripsi_peminta,
            'id_truck' => $id_truck,
            'deskripsi_perkerja' => $deskripsi_perkerja,
            'deskripsi_komponen' => $deskripsi_komponen,
            'pic_cek' => $pic_cek,
            'tanggal_cek' => $tanggal_cek,
            'id_permintaan_pengerjaan' => $id_permintaan_pengerjaan,
            'status' => 2,
            'updated_by' => $this->session->userdata('iduser'),
            'updated_at'=> date("Y-m-d h:i:sa"),
             'categori' => $categori
        ];

        $this->db->where('id_permintaan_pengerjaan', $id_permintaan_pengerjaan);
        $this->db->update('permintaan_pengerjaan', $data);
    }

    public function hapusWo($id) {
        $data=[
             'is_deleted' =>1,
             'deleted_at'=>date("Y-m-d h:i:sa"),
             'deleted_by'=>$this->session->userdata('iduser')
            ];
        $this->db->where('id_permintaan_pengerjaan', $id);
        $this->db->update('permintaan_pengerjaan',$data);
    }

    public function Wo($id) {
        $query = "select a.*,b.no_polisi,c.nama_bagian,d.name from permintaan_pengerjaan a 
join truck b on a.id_truck=b.id_truck 
join bagian c on a.id_bagian=c.idbagian 
left JOIN driver e on b.driver_id = e.id_driver
left JOIN driver f on b.helper_id = f.id_driver
left join user d on a.created_by=d.id where a.id_permintaan_pengerjaan='$id'";
        return $this->db->query($query)->row_array();
    }
    public function Bbm($id){
        $query = "select a.*,b.*,c.*,d.nama as NAMA_HELPER,e.name as nama_user from truck a join transaksi_bbm b on a.id_truck=b.id_kendaraan left join driver c on c.id_driver=b.id_driver left outer join driver d on d.id_driver=b.id_helper join user e on e.id=a.id_user where b.id_transaksi_bbm='$id'";
        return $this->db->query($query)->row_array();
    }
    public function jumlahwoperludicheck() {
        $query="select count(a.id_permintaan_pengerjaan) as wo  from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.is_deleted='0' and a.status=1 order by id_permintaan_pengerjaan desc";
        return $this->db->query($query)->result();;
    }
    
    public function jumlahwosudahdicheck() {
        $query="select count(id_permintaan_pengerjaan) as wo from permintaan_pengerjaan where status=2";
        return $this->db->query($query)->result();
    }
    
    public function jumlahwosudahselesai() {
        $query="select count(id_permintaan_pengerjaan) as wo from permintaan_pengerjaan where status=3";
        return $this->db->query($query)->result();
    }
    
    public function woperludicheck() {
        $query="select a.*,b.no_polisi,c.nama_bagian from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.is_deleted='0' and a.status=1 order by id_permintaan_pengerjaan desc";
        return $this->db->query($query)->result();
    }
    
    public function wosudahdicheck() {
        $query="select a.*,b.no_polisi,c.nama_bagian from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.is_deleted='0' and  a.status=2 order by id_permintaan_pengerjaan desc";
        return $this->db->query($query)->result();
    }
    
    public function wosudahselesai() {
        $query="select a.*,b.no_polisi,c.nama_bagian from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck join bagian c on a.id_bagian=c.idbagian where a.is_deleted='0' and a.status=3 order by id_permintaan_pengerjaan desc";
        return $this->db->query($query)->result();
    }
 

}
