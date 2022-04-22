<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Truck_model extends CI_Model {

    public function getDataTruck() {
        $sql = " SELECT
        a.*, b.nama as driver, c.nama AS helper, d.nama AS hub, e.merek 
        FROM truck a JOIN driver b ON a.driver_id = b.id_driver
        left JOIN driver c ON a.helper_id = c.id_driver
        left JOIN departement d ON a.hub = d.id_departement
        JOIN mobil e ON a.idmobil = e.idmobil
        ";
        return $this->db->query($sql)->result();
    }

    public function simpandatatruck() {
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
            'driver_id' => $driver,
            'helper_id' => $helper,
            'bbm_perliter' => $bbmperliter,
            'bbm_akumulasi' => $bbmakumulasi,
            'toleran' => $toleran,
            'id_user' => $this->session->userdata('iduser'),
            'hub' => $this->session->userdata('hub'),
            'created_by' => $this->session->userdata('iduser'),
            'created_at' => date("Y-m-d h:i:sa"),
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
        $this->db->insert('truck', $data);
    }

    public function getDataTax() {
        $sql = "select no_urut,no_polisi,current_date() as tgl_sekarang,datediff(tgl_stnk,current_date()) as byr_pajak,datediff(tgl_bpkb,current_date()) as byr_kaleng,
                datediff(tgl_kir,current_date()) as byr_kir,km_service,km_pemakaian,km_service-km_pemakaian as km from truck";
        return $this->db->query($sql)->result();
    }

    public function truck_stnk() {
        $sql = "select id_truck,no_urut,no_polisi,datediff(tgl_stnk,current_date()) as byr_stnk from truck where datediff(tgl_stnk,current_date()) < 45 order by datediff(tgl_stnk,current_date()) asc";
        return $this->db->query($sql)->result();
    }

    public function truck_bpkb() {
        $sql = "select id_truck,no_urut,no_polisi,datediff(tgl_bpkb,current_date()) as byr_bpkb from truck where datediff(tgl_stnk,current_date()) < 45 order by datediff(tgl_bpkb,current_date()) asc";
        return $this->db->query($sql)->result();
    }

    public function truck_kir() {
        $sql = "select id_truck,no_urut,no_polisi,datediff(tgl_kir,current_date()) as byr_kir from truck where datediff(tgl_stnk,current_date()) < 45 order by datediff(tgl_kir,current_date()) asc";
        return $this->db->query($sql)->result();
    }

    public function truck_service() {
        $sql = "select * from truck where km_pemakaian >4200 and id_truck not in(select id_truck from permintaan_pengerjaan where status in('1','0','2'))";
        return $this->db->query($sql)->result();
    }

    public function truck_service_wo() {
       // $sql = "select a.*,b.* from truck a left join permintaan_pengerjaan b on a.id_truck=b.id_truck where a.km_pemakaian >0 and b.status in('1','0','2') and b.is_deleted=0 order by a.km_pemakaian asc";
        $sql="select a.*,b.* from permintaan_pengerjaan a join truck b on a.id_truck=b.id_truck where a.status=2";
        return $this->db->query($sql)->result();
    }

    public function truck_sipa_bks() {
        $sql = "select id_truck,no_urut,no_polisi,datediff(tgl_kir,current_date()) as truck_sipa_bks from truck where datediff(sipa_bekasi,current_date()) < 45 order by datediff(sipa_bekasi,current_date()) asc";
        return $this->db->query($sql)->result();
    }

    public function truck_ibm_bks() {
        $sql = "select id_truck,no_urut,no_polisi,datediff(ibm_bekasi,current_date()) as truck_ibm_bks from truck where datediff(ibm_bekasi,current_date()) < 365 order by datediff(ibm_bekasi,current_date()) asc";
        return $this->db->query($sql)->result();
    }

    public function truck_sipa_bgr() {
        $sql = "select id_truck,no_urut,no_polisi,datediff(tgl_kir,current_date()) as truck_sipa_bgr from truck where datediff(sipa_bogor,current_date()) < 365 order by datediff(sipa_bogor,current_date()) asc";
        return $this->db->query($sql)->result();
    }

    public function truck_ibm_clg() {
        $sql = "select id_truck,no_urut,no_polisi,datediff(tgl_kir,current_date()) as truck_ibm_clg from truck where datediff(ibm_cilegon,current_date()) < 45 order by datediff(ibm_cilegon,current_date()) asc";
        return $this->db->query($sql)->result();
    }

    public function izin_lintas() {
        $sql = "select id_truck,no_urut,no_polisi,datediff(tgl_kir,current_date()) as izin_lintas from truck where datediff(izin_lintas,current_date()) < 45 order by datediff(izin_lintas,current_date()) asc";
        return $this->db->query($sql)->result();
    }

    public function count_service() {
       // $sql = "select count(a.id_truck) as tot_service from truck a left join permintaan_pengerjaan b on a.id_truck=b.id_truck where a.km_pemakaian >4200 and b.status in('1','0','2','4') order by a.km_pemakaian asc";
        $sql="SELECT COUNT(*) as tot 
FROM (
  select id_truck from permintaan_pengerjaan where status =2 and is_deleted=0
  UNION 
select id_truck from truck where km_pemakaian >4200 and id_truck not in(select id_truck from permintaan_pengerjaan where status in('1','0','2'))
) AS tem
";
        return $this->db->query($sql)->result();
    }
    

 
    public function count_stnk() {
        $sql = "select count(id_truck) as tot_stnk from truck where datediff(tgl_stnk,current_date()) < 45";
        return $this->db->query($sql)->result();
    }

    public function count_kir() {
        $sql = "select count(id_truck) as tot_kir from truck where datediff(tgl_kir,current_date()) < 45";
        return $this->db->query($sql)->result();
    }

    public function count_bpkb() {
        $sql = "select count(id_truck) as tot_bpkb from truck where datediff(tgl_bpkb,current_date()) < 45";
        return $this->db->query($sql)->result();
    }

    public function count_sipabks() {
        $sql = "select count(id_truck) as count_sipabks from truck where datediff(sipa_bekasi,current_date()) < 45";
        return $this->db->query($sql)->result();
    }

    public function count_sipabgr() {
        $sql = "select count(id_truck) as count_sipabgr from truck where datediff(sipa_bogor,current_date()) < 45";
        return $this->db->query($sql)->result();
    }

    public function count_ibmbks() {
        $sql = "select count(id_truck) as count_ibmbks from truck where datediff(ibm_bekasi,current_date()) < 45";
        return $this->db->query($sql)->result();
    }

    public function count_ibmclg() {
        $sql = "select count(id_truck) as count_ibmclg from truck where datediff(ibm_cilegon,current_date()) < 45";
        return $this->db->query($sql)->result();
    }

    public function count_lintas() {
        $sql = "select count(id_truck) as count_lintas from truck where datediff(izin_lintas,current_date()) < 45";
        return $this->db->query($sql)->result();
    }

    public function truck_header($id) {
        $sql = "select * from truck where id_truck='$id'";
        return $this->db->query($sql)->row();
    }

    public function truck_detail($id) {
        $sql = "select a.no_urut,a.no_polisi,b.categori,b.deskripsi_supir,b.deskripsi_komponen,b.deskripsi_peminta,b.tgl_order,b.tanggal_cek,b.pic_cek,b.deskripsi_perkerja 
        from truck a join permintaan_pengerjaan b on a.id_truck=b.id_truck where b.id_truck='$id'";
        return $this->db->query($sql)->result();
    }

    public function gettruck() {
        $sql = "select * from truck";
        return $this->db->query($sql)->result();
    }

    public function truck_header_tgl() {
        $sql = "select * from truck";
        return $this->db->query($sql)->row();
    }

    public function truck_detail_tgl($tgl1, $tgl2, $d) {

        $sql = "select a.id_truck,a.no_urut,a.no_polisi,b.categori,b.deskripsi_supir,b.deskripsi_komponen,b.deskripsi_peminta,b.tgl_order,b.tanggal_cek,b.pic_cek,b.deskripsi_perkerja 
        from truck a join permintaan_pengerjaan b on a.id_truck=b.id_truck where tgl_order between '$tgl1' and '$tgl2' and a.id_truck='$d' group by id_truck";


        return $this->db->query($sql)->result();
    }

    public function truck_headerall() {
        $sql = "select * from truck";
        return $this->db->query($sql)->result_array();
    }

    public function truck_detailall() {
        $sql = "select b.id_truck,a.no_urut,a.no_polisi,b.categori,b.deskripsi_supir,b.deskripsi_komponen,b.deskripsi_peminta,b.tgl_order,b.tanggal_cek,b.pic_cek,b.deskripsi_perkerja 
        from truck a join permintaan_pengerjaan b on a.id_truck=b.id_truck";
        return $this->db->query($sql)->result_array();
    }

    public function bbmtruck($limit, $start, $keyword = null) {
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('no_polisi', $keyword);
            $this->db->or_like('no_urut', $keyword);
            $this->db->group_end();
        }
        $params['conditions'] = [
            'transaksi_bbm.is_deleted' => 0
        ];
        
        $this->db->select('*');
        $this->db->from('transaksi_bbm');
        $this->db->join('truck', 'transaksi_bbm.id_kendaraan = truck.id_truck');
        $this->db->join('driver', 'transaksi_bbm.id_driver = driver.id_driver','left');
        $this->db->join('driver as t', 'transaksi_bbm.id_helper = driver.id_driver','left');
        $this->db->join('mobil', 'truck.idmobil = mobil.idmobil');
        $this->db->join('jenismobil', 'mobil.idjenis = jenismobil.idjenismobil');
        $this->db->join('tipemobil', 'mobil.idtype = tipemobil.idtipemobil');
        $where = $params['conditions'];
        $this->db->where($where);
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }

}
