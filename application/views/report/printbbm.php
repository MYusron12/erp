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
    <th>NO : <?=$bbm['id_transaksi_bbm'];?></th>
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
    <td></td>
  </tr>
  <tr>
    <th colspan="7">PT. MATAHARI DEPARTMENT STORE</th>
  </tr>
  <tr>
    <th colspan="7">MDS National Distribution Center</th>
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
    <th colspan="7">FORM LAPORAN BBM</th>
  </tr>
  <tr>
    <th colspan="7">LAPORAN DETAIL BBM</th>
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
  <br>
  <br>
  <tr>
    <td>Tanggal Berangkat</td>
    <td>:</td>
    <td><?= date('d-m-Y', strtotime($bbm['tanggal'])); ?></td>
    <td><br></td>
    <td>KM Awal</td>
    <td>:</td>
    <td><?=$bbm['km_awal'];?> Km</td>
  </tr>
  <tr>
    <td>Nomor Mobil</td>
    <td>:</td>
    <td><?=$bbm['no_polisi'];?></td>
    <td><br></td>
    <td>KM Akhir</td>
    <td>:</td>
    <td><?=$bbm['km_akhir'];?> Km</td>
  </tr>
  <tr>
    <td>Nomor Body</td>
    <td>:</td>
    <td><?=$bbm['no_urut'];?></td>
    <td><br></td>
    <td>Jarak</td>
    <td>:</td>
    <td><?=$bbm['jarak'];?> Km</td>
  </tr>
  <tr>
    <td>Nama Supir</td>
    <td>:</td>
    <td><?=$bbm['nama'];?></td>
    <td><br></td>
    <td>Jumlah Konsumsi</td>
    <td>:</td>
    <td><?=$bbm['jml_liter'];?> Ltr</td>
  </tr>
  <tr>
    <td>Nama Helper</td>
    <td>:</td>
    <td><?=$bbm['NAMA_HELPER'];?></td>
    <td><br></td>
    <td>Harga BBM per Liter</td>
    <td>:</td>
    <td>Rp. <?=$bbm['bbmharga'];?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><br></td>
    <td>Total Harga BBM</td>
    <td>:</td>
    <td>Rp. <?=$bbm['ttlbbm'];?></td>
  </tr>
  <br>
  <tr>
  <td colspan="7"><hr></td>
  </tr>
  <tr>
    <th>Pembuat</th>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <th colspan="3">Mengetahui</th>
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
  <br>
  <br>
  <br>
  <br>
  <tr>
    <th><?=$bbm['nama_user'];?></th>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <th colspan="3">Head Of Expedition & Transportation</th>
    <td></td>
  </tr>
</tbody>
</table>




    </body>
</html>