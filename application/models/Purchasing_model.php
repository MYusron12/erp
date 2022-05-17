<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchasing_model extends CI_Model
{

    public function get_data_permintaan($id)
    {
        $this->db->select('permintaan_pembelian_header.*, departement.nama, bagian.nama_bagian');
        $this->db->from('permintaan_pembelian_header');
        $this->db->join('departement', 'permintaan_pembelian_header.id_departement = departement.id_departement');
        $this->db->join('bagian', 'permintaan_pembelian_header.id_bagian = bagian.idbagian');
        $this->db->where('permintaan_pembelian_header.id_bagian', $id);
		$this->db->where('is_deleted', 0);
        $this->db->order_by('id_permintaan', 'desc');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_data_permintaan_all()
    {
        $this->db->select('permintaan_pembelian_header.*, departement.nama, bagian.nama_bagian');
        $this->db->from('permintaan_pembelian_header');
        $this->db->join('departement', 'permintaan_pembelian_header.id_departement = departement.id_departement');
        $this->db->join('bagian', 'permintaan_pembelian_header.id_bagian = bagian.idbagian');
        $this->db->order_by('id_permintaan', 'desc');
        $query = $this->db->get()->result();
        return $query;

    }
    public function get_data_header_id($id)
    {
        $this->db->select('permintaan_pembelian_header.*, departement.nama, bagian.nama_bagian, bagian.kepala_bagian, bagian.kode_wh');
        $this->db->from('permintaan_pembelian_header');
        $this->db->join('departement', 'permintaan_pembelian_header.id_departement = departement.id_departement');
        $this->db->join('bagian', 'permintaan_pembelian_header.id_bagian = bagian.idbagian');
        $this->db->where('id_permintaan', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_data_permintaan_detail_id($id)
    {
        $this->db->select('a.*, b.id_satuan, b.kode_barang, b.nama_barang, c.nama_satuan, d.nama_categori');
        $this->db->from('permintaan_pembelian_detail a');
        $this->db->join('barang b', 'a.id_barang = b.id_barang');
        $this->db->join('satuan c', 'b.id_satuan = c.id_satuan');
        $this->db->join('categori d', 'b.id_categori = d.id_categori');
        $this->db->where('id_permintaan', $id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function simpandatapermintaan()
    {
        // menangkap data post untuk header 
        $iddepartment = $this->session->userdata('hub');
        $hub = $this->session->userdata('hub');
        $iduser = $this->session->userdata('iduser');
        $nopr = $this->input->post('nopr', true);
        $tglpr = date('Y-m-d', strtotime($this->input->post('tglpr', true)));
        $bagian = $this->input->post('bagian', true);
        $namarequest = $this->input->post('namarequest', true);
        $remarks = $this->input->post('keterangan', true);
        $cprno = $this->input->post('cprno', true);
        $verifikasikode = $this->input->post('verifikasikode', true);
        $coding = $this->input->post('coding', true);
        $budget = $this->input->post('budget', true);
        $grandtotal = str_replace(['.', ','], ['', '.'], $this->input->post('grandtotalbarang', true));

        $data = [
            'id_departement' => $iddepartment,
            'no_permintaan' => $nopr,
            'nama_request' => $namarequest,
            'keterangan' => $remarks,
            'id_bagian' => $bagian,
            'tanggal_minta' => $tglpr,
            'cpr_no' => $cprno,
            'verifikasi_kode' => $verifikasikode,
            'coding' => $coding,
            'budget' => $budget,
            'status' => 1,
            'status_global' => 0,
            'grandtotal' => $grandtotal,
            'id_user' => $iduser,
            'hub' => $hub
        ];

        $this->db->insert('permintaan_pembelian_header', $data);
        $id_permintaan = $this->db->insert_id();

        // details
        $barangitems = $this->input->post('barang', true);
        $qty = $this->input->post('qty', true);
        $harga = str_replace(['.', ','], ['', '.'], $this->input->post('harga', true));
        $total = str_replace(['.', ','], ['', '.'], $this->input->post('total', true));

        $detail = [];
        foreach ($barangitems as $key => $val) {
            $detail[$key] = [
                'id_permintaan' => $id_permintaan,
                'id_barang' => $val,
                'harga' => $harga[$key],
                'qty' => $qty[$key],
                'total' => $total[$key],
                'status' => 1
            ];
        }

        $this->db->insert_batch('permintaan_pembelian_detail', $detail);
    }

    public function get_no_order()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_po,4)) AS kd_max FROM pembelian_header WHERE DATE(tanggal_no_po)=CURDATE()");
        $kd = "";
        $dc = substr($this->session->userdata('dc'), 2, 20);
        $kodelokasi = str_replace(' ', '', $dc);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'PO-' . $kodelokasi . '/' . date('dmy') . '/' . $kd;
    }
    public function get_no_per()
    {
        $this->db->where('status', 2);
        return $this->db->get('permintaan_pembelian_header')->result();
    }
    public function get_data_suplier()
    {
        return $this->db->get_where('suplier', ['approve' => 1])->result();
    }

    public function getdataheaderpembelian()
    {
        $this->db->select('pembelian_header.*, departement.nama, suplier.suplier');
        $this->db->from('pembelian_header');
        $this->db->join('departement', 'pembelian_header.id_dept = departement.id_departement');
        $this->db->join('suplier', 'pembelian_header.id_suplier = suplier.id_suplier');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_data_header_pembelian_id($id)
    {
        $this->db->select('pembelian_header.*, permintaan_pembelian_header.no_permintaan,
        permintaan_pembelian_header.tanggal_minta, permintaan_pembelian_header.nama_request,
        permintaan_pembelian_header.cpr_no, permintaan_pembelian_header.verifikasi_kode,
        permintaan_pembelian_header.coding, permintaan_pembelian_header.keterangan,
        permintaan_pembelian_header.tanggal_approve,
         departement.nama, suplier.suplier, bagian.nama_bagian');
        $this->db->from('pembelian_header');
        $this->db->join('permintaan_pembelian_header', 'pembelian_header.id_permintaan = permintaan_pembelian_header.id_permintaan ');
        $this->db->join('departement', 'pembelian_header.id_dept = departement.id_departement');
        $this->db->join('suplier', 'pembelian_header.id_suplier = suplier.id_suplier');
        $this->db->join('bagian', 'permintaan_pembelian_header.id_bagian = bagian.idbagian');
        $this->db->where('id_pembelian', $id);
        $query = $this->db->get()->row();
        return $query;
    }
    public function get_data_pembelian_detail_id($id)
    {
        $this->db->select('pembelian_detail.*, barang.kode_barang, barang.nama_barang, satuan.id_satuan, satuan.nama_satuan');
        $this->db->from('pembelian_detail');
        $this->db->join('barang', 'pembelian_detail.id_barang = barang.id_barang ');
        $this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan');
        $this->db->where('id_pembelian', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_no_id_terima()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_trans_trm_brg,4)) AS kd_max FROM terima_barang_header WHERE DATE(tanggal)=CURDATE()");
        $kd = "";
        $dc = substr($this->session->userdata('dc'), 2, 20);
        $kodelokasi = str_replace(' ', '', $dc);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'TRM-' . $kodelokasi . '/' . date('dmy') . '/' . $kd;
    }
    public function getTerimaBarang()
    {
        $this->db->select('terima_barang_header.*, suplier.suplier');
        $this->db->from('terima_barang_header');
        $this->db->join('pembelian_header', 'terima_barang_header.id_po = pembelian_header.id_pembelian');
        $this->db->join('suplier', 'pembelian_header.id_suplier = suplier.id_suplier');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_no_pr_jasa()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_pr_jasa,4)) AS kd_max FROM permintaan_jasa_all WHERE DATE(tgl_pr_jasa)=CURDATE()");
        $kd = "";
        $dc = substr($this->session->userdata('dc'), 2, 20);
        $kodelokasi = str_replace(' ', '', $dc);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $kodelokasi . '/' . date('dmy') . '/' . $kd;
    }
    public function simpandataprjasa()
    {
        // menangkap data post untuk header 
        $iddepartment = $this->session->userdata('hub');
        $hub = $this->session->userdata('hub');
        $nopr = $this->input->post('noprjasa', true);
        $tglprjasa = date('Y-m-d', strtotime($this->input->post('tgljasa', true)));
        $bagian = $this->input->post('bagianjasa', true);
        $remarks = $this->input->post('keterjasa', true);
        $cprno = $this->input->post('cprnojasa', true);
        $verifikasikode = $this->input->post('verifikasikode', true);
        $budget = $this->input->post('budgetjasa', true);
        $coding = $this->input->post('codingjasa', true);
        $item_1 = $this->input->post('item_1', true);
        $item_2 = $this->input->post('item_2', true);
        $item_3 = $this->input->post('item_3', true);
        $satuan_1 = $this->input->post('satuan_1', true);
        $satuan_2 = $this->input->post('satuan_2', true);
        $satuan_3 = $this->input->post('satuan_3', true);
        $jumlah_1 = $this->input->post('jumlah_1', true);
        $jumlah_2 = $this->input->post('jumlah_2', true);
        $jumlah_3 = $this->input->post('jumlah_3', true);
        $harga_1 = str_replace(['.', ','], ['', '.'],$this->input->post('harga_1', true));
        $harga_2 = str_replace(['.', ','], ['', '.'],$this->input->post('harga_2', true));
        $harga_3 = str_replace(['.', ','], ['', '.'],$this->input->post('harga_3', true));
        $total_1 = str_replace(['.', ','], ['', '.'],$this->input->post('total_1', true));
        $total_2 = str_replace(['.', ','], ['', '.'],$this->input->post('total_2', true));
        $total_3 = str_replace(['.', ','], ['', '.'],$this->input->post('total_3', true));
        $loc1 = $this->input->post('loc_1', true);
        $ec1 = $this->input->post('ec_1', true);
        $na1 = $this->input->post('na_1', true);
        $tb1 = $this->input->post('tb_1', true);
        $ea1 = $this->input->post('ea_1', true);
        $loc2 = $this->input->post('loc_2', true);
        $ec2 = $this->input->post('ec_2', true);
        $na2 = $this->input->post('na_2', true);
        $tb2 = $this->input->post('tb_2', true);
        $ea2 = $this->input->post('ea_2', true);
        $loc3 = $this->input->post('loc_3', true);
        $ec3 = $this->input->post('ec_3', true);
        $na3 = $this->input->post('na_3', true);
        $tb3 = $this->input->post('tb_3', true);
        $ea3 = $this->input->post('ea_3', true);


        $data = [
            'department_id' => $iddepartment,
            'no_pr_jasa' => $nopr,
            'remarks' => $remarks,
            'bagian_id' => $bagian,
            'tgl_pr_jasa' => $tglprjasa,
            'cpr_no' => $cprno,
            'verifikasi_kode' => $verifikasikode,
            'coding' => $coding,
            'budget_reserved' => $budget,
            'status' => 1,
            'status_global' => 1,
            'user_id' => $this->session->userdata('iduser'),
            'created_by' => $this->session->userdata('iduser'),
            'created_at' => date("Y-m-d h:i:sa"),
            'is_deleted' => 0,
            'hub' => $hub,
            'coa1' => $loc1 . '-' . $ec1 . '-' . $na1 . '-' . $tb1 . '-' . $ea1,
            'coa2' => $loc2 . '-' . $ec2 . '-' . $na2 . '-' . $tb2 . '-' . $ea2,
            'coa3' => $loc3 . '-' . $ec3 . '-' . $na3 . '-' . $tb3 . '-' . $ea3,
            'item_1' => $item_1,
            'item_2' => $item_2,
            'item_3' => $item_3,
            'satuan_1' => $satuan_1,
            'satuan_2' => $satuan_2,
            'satuan_3' => $satuan_3,
            'harga_1' => $harga_1,
            'harga_2' => $harga_2,
            'harga_3' => $harga_3,
            'qty_1' => $jumlah_1,
            'qty_2' => $jumlah_2,
            'qty_3' => $jumlah_3,
            'total_1' => $total_1,
            'total_2' => $total_2,
            'total_3' => $total_3

        ];

        $this->db->insert('permintaan_jasa_all', $data);
    }
    public function get_data_jasa()
    {
        $this->db->select('*');
        $this->db->from('permintaan_jasa_all');
        $this->db->join('departement', 'permintaan_jasa_all.department_id = departement.id_departement');
        $this->db->join('bagian', 'permintaan_jasa_all.bagian_id = bagian.idbagian');
        $this->db->join('user', 'permintaan_jasa_all.user_id = user.id');
        $this->db->where('is_deleted', 0);
         $this->db->order_by('tgl_pr_jasa', 'desc');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_data_jasa_bagian_id($id)
    {
        $this->db->select('*');
        $this->db->from('permintaan_jasa_all');
        $this->db->join('departement', 'permintaan_jasa_all.department_id = departement.id_departement');
        $this->db->join('bagian', 'permintaan_jasa_all.bagian_id = bagian.idbagian');
        $this->db->join('user', 'permintaan_jasa_all.user_id = user.id');
        $this->db->where('is_deleted', 0)
                ->where('permintaan_jasa_all.bagian_id',$id);
         $this->db->order_by('tgl_pr_jasa', 'desc');
        $query = $this->db->get()->result();
        return $query;
    }
    
    public function get_data_jasa_id($id)
    {
        $this->db->select('a.*, b.*, c.*, d.*, e.nama_satuan as satuan_nama1, f.nama_satuan as satuan_nama2, g.nama_satuan as satuan_nama3, e.id_satuan as id_satuan1, f.id_satuan as id_satuan2, g.id_satuan as id_satuan3');
        $this->db->from('permintaan_jasa_all a');
        $this->db->join('departement b', 'a.department_id = b.id_departement');
        $this->db->join('bagian c', 'a.bagian_id = c.idbagian');
        $this->db->join('user d', 'a.user_id = d.id');
        $this->db->join('satuan e', 'a.satuan_1 = e.id_satuan', 'left outer');
        $this->db->join('satuan f', 'a.satuan_2 = f.id_satuan', 'left outer');
        $this->db->join('satuan g', 'a.satuan_3 = g.id_satuan', 'left outer');
        $this->db->where('id_permintaan_jasa', $id);
        $query = $this->db->get()->row();
        return $query;
    }
    public function get_no_ipo()
    {
        $this->db->select('*');
        $this->db->where('transaksi="IPO"');
        $query = $this->db->get('counter');
        foreach ($query->result_array() as $row) :
            if ($row['jumlah'] > 8) {
                $j = $row['jumlah'] + 1;
                $kode = '00';
                $BG = $row['nama'];
                $bln = date('m');
                $kde = $row['kode'];
            } else {
                $j = $row['jumlah'] + 1;
                $kode = '000';
                $BG = $row['nama'];
                $bln = date('m');
                $kde = $row['kode'];
            }
        endforeach;

        $kodejadi = $kode . $j . '/' . $BG . '/' . $bln . '/' . $kde;
        return $kodejadi;
    }
    public function ipo()
    {

        //tangkap data header ipo
        $noipo = $this->input->post('noipo', true);
        $tglpr = date('Y-m-d', strtotime($this->input->post('tglipo', true)));
        $store = $this->input->post('store', true);
        // $locationid = $this->input->post('locationid', true);
        $remarks = $this->input->post('keteranganipo', true);
        $delivery = $this->input->post('delivery', true);
        $period = $this->input->post('period', true);
        $idpr = $this->input->post('idprjasa', true);
        $supplierid = $this->input->post('supplierid', true);
        $budget = $this->input->post('budget', true);
        $gt = str_replace(['.', ','], ['', '.'],$this->input->post('totalnet', true));
        $pphheader = str_replace(['.', ','], ['', '.'], $this->input->post('pphrupiah', true));
        $ppnheader = str_replace(['.', ','], ['', '.'], $this->input->post('ppnrupiah', true));

        $data = [
            'dept_id' => $this->session->userdata('bagian_id'),
            'no_ipo' => $noipo,
            'remarks' => $remarks,
            'pr_id' => $idpr,
            'tgl_ipo' => $tglpr,
            'supplier_id' => $supplierid,
            'delivery_periode' => $delivery,
            'grandtotal' => $gt,
            'ppn_header' => $ppnheader,
            'pph_header' => $pphheader,
            'periode' => $period,
            'store' => $store,
            'budget' => $budget,
            'status' => 3,
            'status_global' => 1,
            'created_by' => $this->session->userdata('iduser'),
            'created_at' => date("Y-m-d h:i:sa"),
            'is_deleted' => 0,
        ];

        $this->db->insert('ipoheader', $data);
        $id_permintaan = $this->db->insert_id();
        $update = $this->db->query("update permintaan_jasa_all set status=3,status_global=2 where id_permintaan_jasa='$idpr'");
        $barangitems = $this->input->post('barang', true);
        $qty = $this->input->post('qty', true);
        $satuan = $this->input->post('satuan', true);
        $loc = $this->input->post('loc', true);
        $ec = $this->input->post('ec', true);
        $na = $this->input->post('na', true);
        $tb = $this->input->post('tb', true);
        $ea = $this->input->post('ea', true);
        $harga = str_replace(['.', ','], ['', '.'], $this->input->post('harga', true));
        $total = str_replace(['.', ','], ['', '.'], $this->input->post('total', true));

        //var_dump($satuan);
        //die;

        $detail = [];

        foreach ($barangitems as $key => $val) {
            if ($val != '') {
                $detail[$key] = [
                    'ipo_id' => $id_permintaan,
                    'pr_id' => $idpr,
                    'loc' => $loc[$key],
                    'ec' => $ec[$key],
                    'na' => $na[$key],
                    'tb' => $tb[$key],
                    'ea' => $ea[$key],
                    'barang_nama' => $val,
                    'qty' => $qty[$key],
                    'harga' => $harga[$key],
                    'satuan_id' => $satuan[$key],
                    'subtotal' => $total[$key]
                ];
            }
        }

        $this->db->insert_batch('ipodetail', $detail);
    }
    public function get_data_ipo()
    {
        $id = $this->session->userdata('bagian_id');
        $this->db->select('ipoheader.*, suplier.suplier as nama_supplier, bagian.nama_bagian as nama_department');
        $this->db->from('ipoheader');
        //$this->db->join('ipodetail', 'ipoheader.id_ipo = ipodetail.ipo_id');
        $this->db->join('suplier', 'suplier.id_suplier = ipoheader.supplier_id');
        $this->db->join('bagian', 'bagian.idbagian = ipoheader.dept_id');
        //$this->db->join('permintaan_jasa_all', 'permintaan_jasa_all.id_permintaan_jasa = ipoheader.pr_id','left outer');
        //$this->db->join('permintaan_pembelian_header', 'permintaan_pembelian_header.id_permintaan = ipoheader.pr_id','left outer');
        $this->db->where('ipoheader.is_deleted', 0);
        $this->db->where('dept_id', $id);
        $this->db->order_by('no_ipo', 'desc');
        //$this->db->group_by('no_ipo');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_data_ipo_id($id)
    {
        $this->db->select('ipoheader.*, bagian.kepala_bagian as nama_kepala, suplier.kode_suplier as kode, suplier.suplier as nama_supplier, bagian.nama_bagian as nama_department, permintaan_jasa_all.no_pr_jasa as no_jasa, permintaan_pembelian_header.no_permintaan as no_pembelian, permintaan_jasa_all.bagian_id as bagian_jasa, permintaan_pembelian_header.id_bagian as bagian_pembelian');
        $this->db->from('ipoheader');
        //$this->db->join('ipodetail', 'ipoheader.id_ipo = ipodetail.ipo_id');
        $this->db->join('suplier', 'suplier.id_suplier = ipoheader.supplier_id');
        $this->db->join('bagian', 'bagian.idbagian = ipoheader.dept_id');
        $this->db->join('permintaan_jasa_all', 'permintaan_jasa_all.id_permintaan_jasa = ipoheader.pr_id', 'left outer');
        $this->db->join('permintaan_pembelian_header', 'permintaan_pembelian_header.id_permintaan = ipoheader.pr_id', 'left outer');
        $this->db->where('ipoheader.id_ipo', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_data_ipo_detail_id($id)
    {
        $this->db->select('ipodetail.* , satuan.nama_satuan, barang.kode_barang as kode_bar, barang.nama_barang as nama_bar, ipodetail.barang_nama as nama_jasa');
        $this->db->from('ipodetail');
        $this->db->join('satuan', 'satuan.id_satuan = ipodetail.satuan_id', 'left');
        $this->db->join('barang', 'barang.id_barang = ipodetail.barang_id', 'left');
        //$this->db->join('suplier', 'suplier.id_suplier = ipoheader.supplier_id');
        //$this->db->join('departement', 'departement.id_departement = ipoheader.dept_id');
        //$this->db->join('permintaan_jasa_all', 'permintaan_jasa_all.id_permintaan_jasa = ipoheader.pr_id','left outer');
        //$this->db->join('permintaan_pembelian_header', 'permintaan_pembelian_header.id_permintaan = ipoheader.pr_id','left outer');
        $this->db->where('ipodetail.ipo_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function updatedataipo()
    {

        //tangkap data header ipo
        //$noipo = $this->input->post('noipo', true);
        $idipo = $this->input->post('idipo', true);
        $tglipo = date('Y-m-d', strtotime($this->input->post('tglipo', true)));
        $store = $this->input->post('store', true);
        //$locationid = $this->input->post('locationid', true);
        $remarks = $this->input->post('keteranganipo', true);
        $delivery = $this->input->post('delivery', true);
        $period = $this->input->post('period', true);
        //$idpr = $this->input->post('idpr', true);
        //$supplierid = $this->input->post('supplierid', true);
        $budget = $this->input->post('budget', true);
        $gt = str_replace(['.', ','], ['', '.'],$this->input->post('totalnet', true));
        $pphheader = str_replace(['.', ','], ['', '.'], $this->input->post('pphrupiah', true));
        $ppnheader = str_replace(['.', ','], ['', '.'], $this->input->post('ppnrupiah', true));

        $data = [
            //'dept_id' => $locationid,
            //'no_ipo' => $noipo,
            'remarks' => $remarks,
            //'pr_id' => $idpr,
            'tgl_ipo' => $tglipo,
            //'supplier_id' => $supplierid,
            'delivery_periode' => $delivery,
            'grandtotal' => $gt,
            'ppn_header' => $ppnheader,
            'pph_header' => $pphheader,
            'periode' => $period,
            'store' => $store,
            'budget' => $budget,
            'status' => 1,
            'status_global' => 1,
            'updated_by' => $this->session->userdata('iduser'),
            'updated_at' => date("Y-m-d h:i:sa"),
            'is_deleted' => 0,
        ];

        // // var_dump($data);
        // // die;

        $this->db->where('id_ipo', $idipo);
        $this->db->update('ipoheader', $data);

        // $loc = $this->input->post('loc', true);
        // $ec = $this->input->post('ec', true);
        // $na = $this->input->post('na', true);
        // $tb = $this->input->post('tb', true);
        // $ea = $this->input->post('ea', true);
        // $qty = $this->input->post('qty', true);
        // $harga = str_replace(['.', ','], ['', '.'], $this->input->post('harga', true));
        // $total = str_replace(['.', ','], ['', '.'], $this->input->post('total', true));

        // $detail = [
        //     'loc' => $loc,
        //     'ec' => $ec,
        //     'na' => $na,
        //     'tb' => $tb,
        //     'ea' => $ea,
        //     'qty' => $qty,
        //     'harga' => $harga,
        //     'subtotal' => $total
        // ];
        // $this->db->where('ipo_id', $idipo);
        // $this->db->update('ipodetail', $detail);

        // $this->db->where('id_ipo', $idipo);
        // $this->db->update('ipoheader', $data);

        // details
        //$barangitems = $this->input->post('barang1', true);
        $id_detail = $this->input->post('id_detail', true);
        $loc = $this->input->post('loc', true);
        $ec = $this->input->post('ec', true);
        $na = $this->input->post('na', true);
        $tb = $this->input->post('tb', true);
        $ea = $this->input->post('ea', true);
        $qty = $this->input->post('qty', true);
        $harga = str_replace(['.', ','], ['', '.'], $this->input->post('harga', true));
        $total = str_replace(['.', ','], ['', '.'], $this->input->post('total', true));

        $detail = [];
        foreach ($id_detail as $key => $val) {
            $detail[$key] = [
                'loc' => $loc[$key],
                'ec' => $ec[$key],
                'na' => $na[$key],
                'tb' => $tb[$key],
                'ea' => $ea[$key],
                'id_ipo_detail' => $val,
                'harga' => $harga[$key],
                'qty' => $qty[$key],
                'subtotal' => $total[$key]
            ];
        }

        $this->db->update_batch('ipodetail', $detail, 'id_ipo_detail');

    }
    public function ipopr()
    {

        //tangkap data header ipo
        $noipo = $this->input->post('noipo', true);
        $tglpr = date('Y-m-d', strtotime($this->input->post('tglipo', true)));
        $store = $this->input->post('store', true);
        $locationid = $this->input->post('locationid', true);
        $remarks = $this->input->post('keteranganipo', true);
        $delivery = $this->input->post('delivery', true);
        $period = $this->input->post('period', true);
        $idpr = $this->input->post('idprjasa', true);
        $supplierid = $this->input->post('supplierid', true);
        $budget = $this->input->post('budget', true);
        $gt = str_replace(['.', ','], ['', '.'], $this->input->post('totalnet', true));
        $pphheader = str_replace(['.', ','], ['', '.'], $this->input->post('pphrupiah', true));
        $ppnheader = str_replace(['.', ','], ['', '.'], $this->input->post('ppnrupiah', true));
        $data = [
            'dept_id' => $this->session->userdata('bagian_id'),
            'no_ipo' => $noipo,
            'remarks' => $remarks,
            'pr_id' => $idpr,
            'tgl_ipo' => $tglpr,
            'supplier_id' => $supplierid,
            'delivery_periode' => $delivery,
            'grandtotal' => $gt,
            'ppn_header' => $ppnheader,
            'pph_header' => $pphheader,
            'periode' => $period,
            'store' => $store,
            'budget' => $budget,
            'status' => 3,
            'status_global' => 1,
            'created_by' => $this->session->userdata('iduser'),
            'created_at' => date("Y-m-d h:i:sa"),
            'is_deleted' => 0,
        ];

        $this->db->insert('ipoheader', $data);
        $id_permintaan = $this->db->insert_id();
        $pr = $this->db->query("update permintaan_pembelian_header set status_global='1' where id_permintaan='$idpr'");

        $barangitems = $this->input->post('barang1', true);
        $qty = $this->input->post('qty', true);
        $satuan = $this->input->post('satuan1', true);
        //$harga = $this->input->post('harga', true);
        //$total = $this->input->post('total', true);
        $loc = $this->input->post('loc', true);
        $ec = $this->input->post('ec', true);
        $na = $this->input->post('na', true);
        $tb = $this->input->post('tb', true);
        $ea = $this->input->post('ea', true);
        $harga = str_replace(['.', ','], ['', '.'], $this->input->post('harga', true));
        $total = str_replace(['.', ','], ['', '.'],$this->input->post('total', true));


        $detail = [];
        foreach ($barangitems as $key => $val) {

            if ($val != '') {
                $detail[$key] = [
                    'ipo_id' => $id_permintaan,
                    'pr_id' => $idpr,
                    'loc' => $loc[$key],
                    'ec' => $ec[$key],
                    'na' => $na[$key],
                    'tb' => $tb[$key],
                    'ea' => $ea[$key],
                    'barang_id' => $val,
                    'qty' => $qty[$key],
                    'harga' => $harga[$key],
                    'satuan_id' => $satuan[$key],
                    'subtotal' => $total[$key]
                ];
            }
        }



        $this->db->insert_batch('ipodetail', $detail);
    }
    public function updatedataprjasa()
    {

        // menangkap data post untuk header 
        $iddepartment = $this->session->userdata('hub');
        $hub = $this->session->userdata('hub');
        $id_permintaan_pengerjaan = $this->input->post('id_permintaan_pengerjaan', true);
        $nopr = $this->input->post('noprjasa', true);
        $tglprjasa = date('Y-m-d', strtotime($this->input->post('tgljasa', true)));
        $bagian = $this->input->post('bagianjasa1', true);
        $remarks = $this->input->post('keterjasa', true);
        $cprno = $this->input->post('cprnojasa', true);
        $verifikasikode = $this->input->post('verifikasikode', true);
        $coding = $this->input->post('codingjasa', true);
        $budget = $this->input->post('budgetjasa', true);
        $item_1 = $this->input->post('item_1', true);
        $item_2 = $this->input->post('item_2', true);
        $item_3 = $this->input->post('item_3', true);
        $satuan_1 = $this->input->post('satuan_1', true);
        $satuan_2 = $this->input->post('satuan_2', true);
        $satuan_3 = $this->input->post('satuan_3', true);
        $jumlah_1 = $this->input->post('jumlah_1', true);
        $jumlah_2 = $this->input->post('jumlah_2', true);
        $jumlah_3 = $this->input->post('jumlah_3', true);
        $harga_1 = str_replace(['.', ','], ['', '.'],$this->input->post('harga_1', true));
        $harga_2 = str_replace(['.', ','], ['', '.'],$this->input->post('harga_2', true));
        $harga_3 = str_replace(['.', ','], ['', '.'],$this->input->post('harga_3', true));
        $total_1 = str_replace(['.', ','], ['', '.'],$this->input->post('total_1', true));
        $total_2 = str_replace(['.', ','], ['', '.'],$this->input->post('total_2', true));
        $total_3 = str_replace(['.', ','], ['', '.'],$this->input->post('total_3', true));
        $coa1 = $this->input->post('coa1', true);
        $coa2 = $this->input->post('coa2', true);
        $coa3 = $this->input->post('coa3', true);
        $data = [
            'department_id' => $iddepartment,
            'no_pr_jasa' => $nopr,
            'remarks' => $remarks,
            'bagian_id' => $bagian,
            'tgl_pr_jasa' => $tglprjasa,
            'cpr_no' => $cprno,
            'verifikasi_kode' => $verifikasikode,
            'coding' => $coding,
            'budget_reserved' => $budget,
            'status' => 1,
            'status_global' => 1,
            'user_id' => $this->session->userdata('iduser'),
            'updated_by' => $this->session->userdata('iduser'),
            'updated_at' => date("Y-m-d h:i:sa"),
            'is_deleted' => 0,
            'hub' => $hub,
            'coa1' => $coa1,
            'coa2' => $coa2,
            'coa3' => $coa3,
            'item_1' => $item_1,
            'item_2' => $item_2,
            'item_3' => $item_3,
            'satuan_1' => $satuan_1,
            'satuan_2' => $satuan_2,
            'satuan_3' => $satuan_3,
            'harga_1' => $harga_1,
            'harga_2' => $harga_2,
            'harga_3' => $harga_3,
            'qty_1' => $jumlah_1,
            'qty_2' => $jumlah_2,
            'qty_3' => $jumlah_3,
            'total_1' => $total_1,
            'total_2' => $total_2,
            'total_3' => $total_3

        ];


        $this->db->where('id_permintaan_jasa', $id_permintaan_pengerjaan);
        $this->db->update('permintaan_jasa_all', $data);
    }

    public function updatedatapr()
    {

        // menangkap data post untuk header permintaan pembelian
        $iddepartment = $this->session->userdata('hub');
        $hub = $this->session->userdata('hub');
        $iduser = $this->session->userdata('iduser');
        $id_permintaan = $this->input->post('id_permintaan');
        $nopr = $this->input->post('nopr', true);
        $tglpr = date('Y-m-d', strtotime($this->input->post('tglpr', true)));
        $bagian = $this->input->post('id_bagian', true);
        $namarequest = $this->input->post('namarequest', true);
        $remarks = $this->input->post('keterangan', true);
        $cprno = $this->input->post('cprno', true);
        $verifikasikode = $this->input->post('verifikasikode', true);
        $coding = $this->input->post('coding', true);
        $budget = $this->input->post('budget', true);
        //$grandtotal = str_replace(['.', ','], ['', '.'], $this->input->post('grandtotalbarang', true));
		$grandtotal = $this->input->post('grandtotalbarang', true);

        $data = [
            'id_departement' => $iddepartment,
            'no_permintaan' => $nopr,
            'nama_request' => $namarequest,
            'keterangan' => $remarks,
            'id_bagian' => $bagian,
            'tanggal_minta' => $tglpr,
            'budget' => $budget,
            'cpr_no' => $cprno,
            'verifikasi_kode' => $verifikasikode,
            'coding' => $coding,
            'status' => 1,
            'status_global' => 0,
            'grandtotal' => $grandtotal,
            'id_user' => $iduser,
            'updated_by' => $this->session->userdata('iduser'),
            'updated_at' => date("Y-m-d h:i:sa"),
            'hub' => $hub
        ];


        $this->db->where('id_permintaan', $id_permintaan);
        $this->db->update('permintaan_pembelian_header', $data);

        // details
        $barangitems = $this->input->post('barang', true);
        $id_detail = $this->input->post('id_detail', true);
        $qty = $this->input->post('qty', true);
        $harga = str_replace(['.', ','], ['', '.'], $this->input->post('harga', true));
        $total = str_replace(['.', ','], ['', '.'], $this->input->post('total', true));

        $detail = [];
        foreach ($barangitems as $key => $val) {
            $detail[$key] = [
                'id_permintaan_detail' => $id_detail[$key],
                'id_barang' => $val,
                'harga' => $harga[$key],
                'qty' => $qty[$key],
                'total' => $total[$key],
                'status' => 1
            ];
        }

        $this->db->update_batch('permintaan_pembelian_detail', $detail, 'id_permintaan_detail');
    }

    public function insertPermintaanJasaNew()
    {
        $department = $this->session->userdata('hub');
        $userid = $this->session->userdata('iduser');

        // baris 822 - 840 blok program insert header
        $this->db->insert('permintaan_jasa_header', [
            'bagian_id' => $this->input->post('bagian_id'), //
            'tgl_pr_jasa' => date('Y-m-d', strtotime($this->input->post('tgl_pr_jasa') )), //
            'department_id' => $department, 
            'no_pr_jasa' => $this->input->post('no_pr_jasa'), //
            'nama_request' => $this->input->post('nama_request'), //
            'remarks' => $this->input->post('remarks'), //
            'cpr_no' => $this->input->post('cpr_no'), //
            'verifikasi_kode' => $this->input->post('verifikasi_kode'), //
            'coding' => $this->input->post('coding'), //
            'budget_reserved' => $this->input->post('budget_reserved'), //
            'status' => 1,
            'status_global' => 1,
            'created_by' => $userid,
            'created_at' => date("Y-m-d h:i:sa"),
            'grandtotal' => $this->input->post('grandtotal'), //
            'user_id' => $userid,
            'hub' => $department
        ]);

        $idpermintaanjasa = $this->db->insert_id();
        $loc = $this->input->post('loc');
        $ec = $this->input->post('ec');
        $na = $this->input->post('na');
        $tb = $this->input->post('tb');
        $ea = $this->input->post('ea');
        $desk = $this->input->post('deskripsi_jasa');
        $satuan = $this->input->post('satuan');
        $qty = $this->input->post('qty');
        $harga = $this->input->post('harga');
        $total = $this->input->post('total');
        // blok program insert detail
        // $this->db->insert('permintaan_jasa_detail', [
        //     'id_permintaan_jasa' => $idpermintaanjasa,
        //     'deskripsi_jasa' => $this->input->post('deskripsi_jasa'),
        //     'satuan' => $this->input->post('satuan'),
        //     'qty' => $this->input->post('qty'), //jumlah
        //     'harga' => $this->input->post('harga'),
        //     'total' => $this->input->post('total'), //
        //     'coa' => $loc . '-' . $ec . '-' . $na . '-' . $tb . '-' . $ea
        // ]);

        $detail = [];
        foreach ($satuan as $key => $value) {
            $detail[$key] = [
                'id_permintaan_jasa' => $idpermintaanjasa,
                'satuan' => $value,
                'deskripsi_jasa' => $desk[$key],
                'qty' => $qty[$key],
                'harga' => $harga[$key],
                'total' => $total[$key],
                'coa' => $loc[$key] . '-' . $ec[$key] . '-' . $na[$key] . '-' . $tb[$key] . '-' . $ea[$key]
            ];
        }
        $this->db->insert_batch('permintaan_jasa_detail', $detail);
        $bagian_id = $this->session->userdata('bagian_id');

        $this->db->query("update counter set jumlah=+jumlah+1 where transaksi='PR' and status=0 and id_bagian='$bagian_id'");
    }

    public function getPermintaanJasaNew()
    {
        $query = "select 
        * 
        from permintaan_jasa_header
        order by id_permintaan_jasa desc";
        return $this->db->query($query)->result_array();
    }
    public function permintaanJasaNewHeaderDetailId($id)
    {
        $query = "select a.*, b.* from permintaan_jasa_header as a 
                join permintaan_jasa_detail as b 
                on b.id_permintaan_jasa=a.id_permintaan_jasa 
                where a.id_permintaan_jasa = $id";
        return $this->db->query($query)->row_array();
    }

    public function get_data_jasa_header_id($id)
    {
        $query = "select a.*, b.nama_bagian from permintaan_jasa_header as a
                    join bagian b on a.bagian_id=b.idbagian
                    where id_permintaan_jasa = $id";
        return $this->db->query($query)->row();
    }
    public function get_data_jasa_detail_id($id)
    {
        $query = "select * from permintaan_jasa_detail a
                    where id_permintaan_jasa = $id";
        return $this->db->query($query)->result();
    }
    
}
