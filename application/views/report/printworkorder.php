<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $title; ?></title>



        <style>
            .line-title {
                border:0;
                border-style: inset;
                border-top: 1px solid #000;

            }

            body {
                font-size: 13px;

            }


            .gambar {
                position: absolute;
                height: auto;

            }

            span {
                font-size: 16px;
            }


        </style>

    </head>
    <body>




        <table>
<thead>
  <tr>
    <th><img src="assets/img/matahari.jpg"></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
</thead>
<tbody>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>NO <?=$wo['no_pengerjaan'];?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="4">PT. Matahari Departement Store</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="4">MDS National Distribution Center</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="4">WORK ORDER /REQUES FORM</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td colspan="4">FORM PERMINTAAN</td>
    <td></td>
  </tr>
  <tr>
    <td>(Untuk diisi oleh pemohon)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Tanggal Pemohonan</td>
    <td>:</td>
    <td colspan="5"><?= date('d-m-Y', strtotime($wo['tgl_order'])); ?></td>
  </tr>
  <tr>
    <td>Dept</td>
    <td>:</td>
    <td colspan="5"><?=$wo['nama_bagian'];?></td>
  </tr>
  <tr>
    <td>Nama Pemohon</td>
    <td>:</td>
    <td colspan="5"><?=$wo['name'];?></td>
  </tr>
  <tr>
    <td>Jenis Pengerjaan</td>
    <td>:</td>
    <td colspan="5"><?=$wo['deskripsi_supir'];?> <?=$wo['no_polisi'];?> <?=$wo['deskripsi_peminta'];?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Ttd Pemohon</td>
    <td></td>
    <td></td>
    <td>Tgl Terima</td>
    <td><?= date('d-m-Y', strtotime($wo['tgl_order'])); ?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>maintenance Dept</td>
    <td></td>
  </tr>
  <tr>
    <td colspan="7">__________________________________________________________________________________________</td>
  </tr>
  <tr>
    <td>(Untuk Diisi Maintenance Dept)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Tanggal Cek</td>
    <td>:</td>
    <td colspan="5"><?= date('d-m-Y', strtotime($wo['tanggal_cek'])); ?></td>
  </tr>
  <tr>
    <td>Di Cek Oleh</td>
    <td>:</td>
    <td colspan="5"><?= $wo['pic_cek'];?></td>
  </tr>
  <tr>
    <td>Komponen yang diganti</td>
    <td>:</td>
    <td colspan="5"><?=$wo['deskripsi_komponen'];?> <br></td>
  </tr>
  <tr>
    <td>Keterangan</td>
    <td>:</td>
    <td colspan="5" rowspan="2"><?=$wo['deskripsi_perkerja'];?><br><br></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Pekerjaan ini disetujui Oleh</td>
    <td></td>
    <td>Maintenance</td>
    <td></td>
    <td colspan="3">note</td>
  </tr>
  <tr>
    <td>TTD</td>
    <td></td>
    <td colspan="3">TTD</td>
    <td colspan="2">Vendor wajib konfirmasikan dulu <br>Jika ada perbaikan diluar permintaan <br>Management MDS DC.Jika tidak ada <br>Approval maka tidak akan di bayar</td>
  </tr>
</tbody>
</table>












    </body>
</html>