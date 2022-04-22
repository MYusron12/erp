<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ikhtisar Pengeluaran Bank</title>

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

  <h2>IKHTISAR PENGELUARAN KASBANK</h2>

  <table>
    <tr>
      <td style="font-weight: bold; width: 10%">Distribution Center : <?= $saldoawal->nama; ?></td>
    </tr>
    <tr>
       <td style="font-weight: bold;">Periode : <?= date('d-m-Y', strtotime($ikh->tgl_ikhtisar)); ?></td>
       <td style="width: 500px; text-align: right; font-weight: bold;">No Ikhtisar : <?= $ikh->no_ikhtisar; ?></td>
    </tr>
  </table>
	<table cellspacing='0' style="width: 100%">
  <thead>
    <tr>
    <th scope="col">Keterangan</th>
	  <th scope="col">Debet</th>
	  <th scope="col">Kredit</th>
	  <th scope="col">Saldo</th>
    </tr>
  </thead>
  <tbody>
<?php $total=0; foreach ($ikhtisar as $row) : ?>

   <?php $total = $total + $row->total; ?>
    <tr>
      <td class="tg"><?= $row->keperluan; ?></td>
      <td class="tg"></td>
      <td class="tg"><?= number_format($row->total); ?></td>
      <td class="tg"></td>
    </tr>

    
 <?php endforeach; ?>

 <tr>
   <td style=" border-bottom: 1px solid #999; border-left: 1px solid #999; padding: 8px 20px;">Total Kasbank</td>
    <td style=" border-bottom: 1px solid #999; padding: 8px 20px;"></td>
    <td style=" border-bottom: 1px solid #999; padding: 8px 20px;"><?= number_format($total); ?></td>
    <td style=" border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"><?= number_format($total); ?></td>
 </tr>

 <tr>
   <td style=" border-bottom: 1px solid #999; border-left: 1px solid #999; padding: 8px 20px;">Terbilang : &nbsp;&nbsp; <?= $terbilang; ?></td>
   <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"></td>
   <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"></td>
   <td style=" border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"></td>
 </tr>

 <tr>
   <td style=" border-bottom: 1px solid #999; border-left: 1px solid #999; padding: 8px 20px; font-weight: bold;">Summary</td>
   <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"></td>
   <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"></td>
   <td style=" border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"></td>
 </tr>

 <tr>
  <td style=" border-bottom: 1px solid #999; border-left: 1px solid #999; padding: 8px 20px; font-weight: bold;">Saldo Awal</td>
  <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"></td>
  <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"></td>
   <td style=" border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"><?= number_format($saldoawal->saldo1); ?></td>
  </tr>

  <tr>
    <td style=" border-bottom: 1px solid #999; border-left: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px; font-weight: bold;">Total kasbank</td>
    <td style=" border-right: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"></td>
    <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"><?= number_format($total); ?></td>
    <td style=" border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"></td>
  </tr>

  <tr>
     <td style=" border-bottom: 1px solid #999; border-left: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px; font-weight: bold;">Outstanding Ikhtisar &nbsp;&nbsp; <?= date('d-m-Y', strtotime($ikh->tgl_ikhtisar)); ?></td>
    <td style=" border-right: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"></td>
    <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"><?= number_format($total); ?></td>
    <td style=" border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"></td>
  </tr>

  <tr>
     <td style=" border-bottom: 1px solid #999; border-left: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px; font-weight: bold;">Outstanding Reimburstment HO</td>
    <td style=" border-right: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"><?= number_format($posisi->outstanding_r_ho); ?></td>
    <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"></td>
    <td style=" border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"></td>
  </tr>

   <tr>
     <td style=" border-bottom: 1px solid #999; border-left: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px; font-weight: bold;">Saldo Akhir</td>
    <td style=" border-right: 1px solid #999; border-bottom: 1px solid #999; padding: 8px 20px;"></td>
    <td style=" border-bottom: 1px solid #999; border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"></td>
    <td style=" border-bottom: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px;"><?= number_format($posisi->gtotal); ?></td>
  </tr>

  <tr>
     <td colspan="4" style=" border-bottom: 1px solid #999; border-left: 1px solid #999; border-right: 1px solid #999; padding: 8px 20px; font-weight: bold; height: 30px;"></td>
  </tr>
  </tbody>
</table>
<table cellspacing='0'>
  <tr>
    <th width="40%">Diminta</th>
    <th width="40%">Disetujui</th>
    <th width="25%">Diterima</th>
    <th width="40%">Diisi Bag Keuangan</th>  
  </tr>

  <tr>
    <th style="height: 80px;"></th>
    <th style="height: 80px;"></th>
    <th style="height: 80px;"></th>
    <th style="height: 80px; text-align: left; line-height: 20px;">Ac No: <br> Tgl: <br> Kasa:</th>
  </tr>  
 </table>


 <table style="margin-top: 20px; border-spacing: 0; margin-left: 210px;">
  <thead>
   <tr>
     <th colspan="3">Rincian uang</th>
   </tr>
 </thead>
 <tbody>
   <tr>
     <td style="border: 1px solid #999; padding: 2px 2px; width: 40%">Jumlah</td>
     <td style="border: 1px solid #999; padding: 2px 2px; width: 40%">pecahan</td>
     <td style="border: 1px solid #999; padding: 2px 2px; width: 40%">total</td>
   </tr>
  
  <?php foreach ($validasi as $row) : ?>
   <tr>
     <td style="border: 1px solid #999; padding: 2px 2px;"><?= number_format($row->jumlah); ?></td>
     <td style="border: 1px solid #999; padding: 2px 2px;"><?= number_format($row->pecahan); ?></td>
      <td style="border: 1px solid #999; padding: 2px 2px;"><?= number_format($row->jumlah*$row->pecahan); ?></td>
   </tr>
 <?php endforeach; ?>
 <tr>
   <td style="border-left: 1px solid #999; padding: 2px 2px;">Cashonhand</td>
   <td></td>
   <td style="border-right: 1px solid #999; padding: 2px 2px;"><?= number_format($posisi->cashonhand); ?></td>
 </tr>
 <tr>
   <td colspan="2" style="border-left: 1px solid #999; padding: 2px 2px;">Kasbon Sementara</td>
   <td style="border-right: 1px solid #999; padding: 2px 2px;"><?= number_format($posisi->kasbonsementara); ?></td>
 </tr>
  <tr>
   <td colspan="2" style="border-left: 1px solid #999; padding: 2px 2px;">Outstanding Kasbank</td>
   <td style="border-right: 1px solid #999; padding: 2px 2px;"><?= number_format($posisi->oskasbank); ?></td>
 </tr>
 <tr>
   <td colspan="2" style="border-left: 1px solid #999; padding: 2px 2px;">Selisih Lebih/Kurang</td>
   <td style="border-right: 1px solid #999; padding: 2px 2px;"><?= number_format($posisi->selisih); ?></td>
 </tr>
 <tr>
   <td style="border-left: 1px solid #999; padding: 2px 2px;">Total Pettycash</td>
   <td></td>
   <td style="border-right: 1px solid #999; border-top: 1px solid black; padding: 2px 2px;"><?= number_format($posisi->ttlpettycash); ?></td>
 </tr>
 <tr>
   <td colspan="2" style="border-left: 1px solid #999; padding: 2px 2px;">O.S Reimburstmen Ho</td>
   <td style="border-right: 1px solid #999; padding: 2px 2px;"><?= number_format($posisi->outstanding_r_ho); ?></td>
 </tr>
 <tr>
   <td colspan="2" style="border-left: 1px solid #999; border-bottom: 1px solid #999; padding: 2px 2px;">GrandTotal Pettycash</td>
   <td style="border-bottom: 1px solid #999; border-right: 1px solid #999; border-top: 1px solid black; padding: 2px 2px;"><?= number_format($posisi->gtotal); ?></td>
 </tr>
</tbody>
 </table>


</body>
</html>