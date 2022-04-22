<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laporan Realisasi Kasbank</title>

  <style>
  body {

    font-size: 11px;
    font-family : Arial;
  }

   .table {
      font-family: sans-serif;
      color: #232323;
      border-collapse: collapse;
      width: 100%;

    }

    .table, th, .tg {
    border: 1px solid #999;
    padding: 8px 20px;

}
  </style>
</head>
<body>

  
 <?php if ($tanggal['start'] == "" And $tanggal['end'] == ""): ?>

    <?php $tg ="All data"; ?>

 <?php else : ?>

  <?php $tg = date('d-m-Y', strtotime($tanggal['start'])) ." s/d ". date('d-m-Y', strtotime($tanggal['end'])) ?>
  


 <?php endif ?>



  <table style="font-size: 13px;">
  <tr>
    <td><b>LAPORAN REIMBURSTMENT KASBANK</b></td> 
  </tr>
  <tr>
    <td>Distribution Center: <?= $dc->nama; ?></td> 
  </tr>


  <tr>
    <td>Periode <?= $tg; ?></td>
  </tr>
</table>


  <table cellspacing='0' style="margin-top: 10px;">
  <thead>
    <tr>
     <th scope="col">No</th>
              <th scope="col">No KB</th>
              <th scope="col">Jenis KB</th>
              <th scope="col">Tgl KB</th>
              <th scope="col">Tgl Proses</th>
              <th scope="col">Tgl Realisasi</th>
              <th scope="col">Aging</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Jumlah</th>
    </tr>
  </thead>
  <tbody>
       <?php $i=1; $total = 0; foreach ($kasbank as $row) : ?>
                      <?php if (substr($row['cashbankno'],0,2) == "KK") : ?>
                        <?php $jenis = "Kas Kecil"; ?>
                      <?php elseif(substr($row['cashbankno'],0,3) == "KAS") : ?>
                            <?php $jenis = "Kas"; ?>
                        <?php else : ?>
                            <?php $jenis = "Bank"; ?>
                      <?php endif; ?>

                     

                 
              <?php $start_date = new DateTime($row['tgl_proses']); ?>
              <?php $end_date = new DateTime($row['tgl_penerima']); ?>
              <?php $interval = $start_date->diff($end_date); ?>

              
                     <tr>
                      <td class="tg"><?= $i++; ?></td>
                      <td class="tg"><?= $row['cashbankno']; ?></td>
                      <td class="tg"><?= $jenis; ?></td>
                      <td class="tg"><?= date('d-m-Y', strtotime($row['tgl_pengajuan'])); ?></td>
                      <td class="tg"><?= date('d-m-Y', strtotime($row['tgl_proses'])); ?></td>
                      <td class="tg"><?= date('d-m-Y', strtotime($row['tgl_penerima'])); ?></td>
                      <td class="tg"><?= $interval->days ?></td>
                      <td class="tg"><?= $row['keperluan']; ?></td>
                      <td class="tg"><?= number_format($row['total'],2,",","."); ?></td>
                     </tr>

                     <?php $total = $total + ($row['total']); ?>

                      <?php endforeach; ?>

                     <tr>
                      <td colspan="8" style="text-align: center; font-weight: bold;" class="tg">TOTAL</td>
                      <td style="font-weight: bold;" class="tg"><?= number_format($total,2,",","."); ?></td>
                     </tr>
                  
       </tbody>
</table>
  
</body>
</html>