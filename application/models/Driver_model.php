<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Driver_model extends yidas\Model {
     

    public function simpanDriver() {
        $nama = $this->input->post('nama', TRUE);
        $nik = $this->input->post('nik', TRUE);
        $alamat = $this->input->post('alamat', TRUE);
        $tgl_lahir = date('Y-m-d', strtotime($this->input->post('tgllahir', TRUE)));
        $no_tlp = $this->input->post('notelp', TRUE);
        $sim1 = $this->input->post('sim1', TRUE);
        $sim2 = $this->input->post('sim2', TRUE);
        $masa_berlaku1 = date('Y-m-d', strtotime($this->input->post('masaberlaku1', TRUE)));
        $masa_berlaku2 = date('Y-m-d', strtotime($this->input->post('masaberlaku2', TRUE)));
        $tgl_masuk = date('Y-m-d', strtotime($this->input->post('tglmasuk', TRUE)));
        $pendidikan = $this->input->post('pendidikan', TRUE);
        $aktif = $this->input->post('aktif', TRUE);
        $no_ijasah = $this->input->post('no_ijasah', TRUE);

        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'alamat' => $alamat,
            'tgl_lahir' => $tgl_lahir,
            'no_tlp' => $no_tlp,
            'sim1' => $sim1,
            'sim2' => $sim2,
            'masa_berlaku1' => $masa_berlaku1,
            'masa_berlaku2' => $masa_berlaku2,
            'tgl_masuk' => $tgl_masuk,
            'pendidikan' => $pendidikan,
            'status' => $aktif,
            'id_user' => $this->session->userdata('iduser'),
            'id_user' => $this->session->userdata('iduser'),
            'hub' => $this->session->userdata('hub'),
            'no_ijasah' => $no_ijasah
        ];
        $this->db->insert('driver', $data);
    }

    public function ubahDriver() {
        $nama = $this->input->post('nama', TRUE);
        $nik = $this->input->post('nik', TRUE);
        $alamat = $this->input->post('alamat', TRUE);
        $tgl_lahir = date('Y-m-d', strtotime($this->input->post('tgllahir', TRUE)));
        $no_tlp = $this->input->post('notelp', TRUE);
        $sim1 = $this->input->post('sim1', TRUE);
        $sim2 = $this->input->post('sim2', TRUE);
        $masa_berlaku1 = date('Y-m-d', strtotime($this->input->post('masaberlaku1', TRUE)));
        $masa_berlaku2 = date('Y-m-d', strtotime($this->input->post('masaberlaku2', TRUE)));
        $tgl_masuk = date('Y-m-d', strtotime($this->input->post('tglmasuk', TRUE)));
        $pendidikan = $this->input->post('pendidikan', TRUE);
        $aktif = $this->input->post('aktif', TRUE);
        $iddriver = $this->input->post('iddriver', TRUE);
        $no_ijasah = $this->input->post('no_ijasah', TRUE);

        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'alamat' => $alamat,
            'tgl_lahir' => $tgl_lahir,
            'no_tlp' => $no_tlp,
            'sim1' => $sim1,
            'sim2' => $sim2,
            'masa_berlaku1' => $masa_berlaku1,
            'masa_berlaku2' => $masa_berlaku2,
            'tgl_masuk' => $tgl_masuk,
            'pendidikan' => $pendidikan,
            'status' => $aktif,
            'id_user' => $this->session->userdata('iduser'),
            'no_ijasah' => $no_ijasah
        ];
        $this->db->where('id_driver', $iddriver);
        $this->db->update('driver', $data);
    }

   

   /* public function simpanwo() {
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
            'created_by'=> $this->session->userdata('iduser')
        ];
        $this->db->insert('permintaan_pengerjaan', $data);
    }

    public function ubahWo() {
        $no_pengerjaan = $this->input->post('no_pengerjaan', TRUE);
        $id_bagian = $this->input->post('id_bagian', TRUE);
        $tgl_order = date('Y-m-d', strtotime($this->input->post('tgl_order', TRUE)));
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
            'updated_by' => $this->session->userdata('iduser')
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
            'updated_by' => $this->session->userdata('iduser')
        ];

        $this->db->where('id_permintaan_pengerjaan', $id_permintaan_pengerjaan);
        $this->db->update('permintaan_pengerjaan', $data);
    }

    public function hapusWo($id) {
        $this->db->where('id_permintaan_pengerjaan', $id);
        $this->db->delete('permintaan_pengerjaan');
    }
*/
    public function Wo($id) {
        $query = "select a.*,b.no_polisi,c.nama_bagian,d.name from permintaan_pengerjaan a 
join truck b on a.id_truck=b.id_truck 
join bagian c on a.id_bagian=c.idbagian 
left JOIN driver e on b.driver_id = e.id_driver
left JOIN driver f on b.helper_id = f.id_driver
join user d on a.id_user=d.id where a.id_permintaan_pengerjaan='$id'";
        return $this->db->query($query)->row_array();
    }
    public function Bbm($id){
        $query = "select a.*,b.*,c.*,d.nama as NAMA_HELPER,e.name as nama_user from truck a join transaksi_bbm b on a.id_truck=b.id_kendaraan left join driver c on c.id_driver=b.id_driver left outer join driver d on d.id_driver=b.id_helper join user e on e.id=a.id_user where b.id_transaksi_bbm='$id'";
        return $this->db->query($query)->row_array();
    }

}
