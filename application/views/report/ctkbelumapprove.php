<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Outstanding BS</title>

	<style>



	body {

    font-size: 12px;
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

 <?php if ($tgl == "") : ?>

  <?php $tg ="All data"; ?>

  <?php else : ?>

    <?php $tg = date('d-M-Y', strtotime($tgl)); ?>

   <?php endif; ?>

 
<table style="font-size: 12px;">
  <tr>
    <td>LAPORAN OUT STANDING KASBON SEMENTARA</td> 
  </tr>
  <tr>
    <td>Distribution Center : <?= $dc->nama; ?></td> 
  </tr>
  <tr>
    <td>Periode sampai dengan Tanggal: <?= $tg ?></td>
  </tr>
</table>
	<table cellspacing='0' style="width: 100%; margin-top: 20px;" class="table">
  <thead>
    <tr>
    <th scope="col">No</th>
    <th scope="col">No BS</th>
    <th scope="col">No Kas Bank</th>
    <th scope="col">Tgl</th>
    <th scope="col">Tgl Terima</th>
    <th scope="col">Aging</th>
    <th scope="col">Pemohon</th>
    <th scope="col">Keterangan</th>
    <th scope="col">Jumlah</th>
    </tr>
  </thead>
  <tbody>
  	<?php $i = 1; foreach ($lap as $row) : ?>
    <?php $start_date = new DateTime($row['tanggal']); ?>
    <?php $end_date = new dateTime(date('Y-m-d')); ?>
    <?php $interval = $start_date->diff($end_date); ?>
   	  <tr>
	   <td class="tg"><?= $i++; ?></td>
     <td class="tg"><?= $row['no_bs']; ?></td>
     <td class="tg"><?= $row['no_kas_bank']; ?></td>
     <td class="tg"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
     <td class="tg"><?= date('d-m-Y', strtotime($row['tgl_terima'])) ?></td>
     <td class="tg"><?= $interval->days ?></td>
     <td class="tg"><?= $row['pemohon']; ?></td>
     <td class="tg"><?= $row['jenis_transaksi']; ?></td>
     <td class="tg"><?= number_format($row['jmlajuan'],2,",","."); ?></td>
	  </tr>
   	 <?php endforeach; ?>
  </tbody>
</table>
	
</body>
</html>