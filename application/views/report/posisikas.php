<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $judul; ?></title>

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

    .rincian {
      border: 1px solid #999;
      padding: 8px 20px;
      margin-top: 20px;
    }   
	</style>
</head>
<body>

  

  <table>
  <tr>
    <td style="font-size: 18px;"><b>SERAH TERIMA STOCK OPNAME PETTY CASH</b></td> 
  </tr>
  <tr>
    <td>Distribution Center: <?= $posisi->nama; ?></td>
  </tr>

</table>


	<table class="table" cellspacing='0' style="width: 100%; margin-top: 20px;">
  <thead>
   <tr>
      <th scope="col" rowspan="2">Date</th>
      <th scope="col" rowspan="2" width="20%">Remark</th>
      <th scope="col" colspan="3">Rincian</th>
      <th scope="col" rowspan="2" style="width: 10px;">Debet</th>
      <th scope="col" rowspan="2" style="width: 10px;">Credit</th>
      <th scope="col" rowspan="2" style="width: 10px;">Balance</th>
  </tr>
    <tr>
       <th scope="col" style="width: 10px;">Pecahan</th>
       <th scope="col">Qty</th>
       <th scope="col">Nominal</th>
    </tr>
  </thead>
  <tbody>

    <?php $total = 7 + $totalrows; ?>

   <tr>
     <td class="tg" rowspan="<?= $total; ?>" style="width: 10px;"><?= date('d-m-Y', strtotime($posisi->tglposisi));  ?></td>
     <td style="font-weight: bold; border-bottom: 1px solid; border-color: #999; line-height: 30px;">Saldo Awal:</td>
     <td style="border-bottom: 1px solid; border-color: #999"></td>
     <td style="border-bottom: 1px solid; border-color: #999"></td>
     <td style="border-bottom: 1px solid; border-color: #999"></td>
     <td style="border-bottom: 1px solid; border-color: #999"></td>
     <td style="border-bottom: 1px solid; border-color: #999"></td>
     <td align="center" style="border-bottom: 1px solid; border-color: #999"><b><?= number_format($posisi->saldo1); ?></b></td>
   </tr>
   <tr>
     <td style="font-weight: bold; border-bottom: 1px solid; border-color: #999; line-height: 30px;">Outstanding BS:</td>
     <td style="border-bottom: 1px solid; border-color: #999"></td>
     <td style="border-bottom: 1px solid; border-color: #999"></td>
     <td style="border-bottom: 1px solid; border-color: #999"></td>
     <td style="border: 1px solid #999"></td>
     <td align="center" style="border: 1px solid #999;"><b><?= number_format($posisi->kasbonsementara); ?></b></td>
     <td align="center" style="font-weight: bold; padding-top: 10px; border: 1px solid #999;"><b><?= number_format($posisi->saldo1-$posisi->kasbonsementara); ?></b></td>
   </tr>
   <tr>
     <td style="font-weight: bold; line-height: 30px; border-bottom: 1px solid #999;">Kasbank Beredar:</td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border: 1px solid #999;"></td>
     <td align="center" style="border: 1px solid #999;"><b>IDR <?= number_format($posisi->oskasbank); ?></b></td>
     <td align="center" style="font-weight: bold; border: 1px solid #999;"><b><?= number_format($posisi->saldo1-$posisi->kasbonsementara-$posisi->oskasbank); ?></b></td>
   </tr>

   <tr>
     <td style="font-weight: bold; line-height: 30px; border-bottom: 1px solid #999;">O.S Reimburstment:</td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border: 1px solid #999;"></td>
     <td align="center" style="border: 1px solid #999;"><b><?= number_format($posisi->outstanding_r_ho); ?></b></td>
     <td align="center" style="font-weight: bold; border-bottom: 1px solid #999;"><b><?= number_format($posisi->saldo1-$posisi->kasbonsementara-$posisi->oskasbank-$posisi->outstanding_r_ho); ?></b></td>
   </tr>

   <tr>
     <td style="font-weight: bold; line-height: 30px; border-bottom: 1px solid #999;">Saldo Akhir:</td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border: 1px solid #999;"></td>
     <td style="border: 1px solid #999;"></td>
     <td align="center" style="font-weight: bold; border: 1px solid #999;"><b><?= number_format($posisi->saldo1-$posisi->kasbonsementara-$posisi->oskasbank-$posisi->outstanding_r_ho); ?></b></td>
   </tr>
   <tr>
     <td style="font-weight: bold; line-height: 30px; border-bottom: 1px solid #999;">Cashonhand:</td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
     <td style="border-bottom: 1px solid #999;"></td>
   </tr>
    <?php foreach ($validasi as $val) : ?>
   <tr>
       <td></td>
       <td style="padding-top: 10px; text-align: right; border-right: 1px solid #999; padding-right: 5px;"><?= number_format($val->jumlah); ?></td>
       <td style="padding-top: 10px; text-align: right; border-right: 1px solid #999; padding-right: 5px; width: 10px;"><?= number_format($val->pecahan); ?></td>
       <td style="padding-top: 10px; text-align: right; padding-right: 10px;"><?= number_format($val->jumlah*$val->pecahan); ?></td>
       <td style="border-right: 1px solid #999; border-left: 1px solid #999;" colspan="2"></td>
       <td style="border-left: 1px solid #999;"></td>

    </tr> 
   
   <?php endforeach; ?>
   <tr>
     <td style="font-weight: bold;" colspan="3" class="tg">Total Cashonhand</td>
     <td class="tg" style="font-weight: bold; width: 10px;"><?= number_format($nominal['total']); ?></td>
     <td class="tg" colspan="2"></td>
     <td class="tg"><b>+/-</b>&nbsp;<?= number_format($posisi->selisih); ?></td>
   </tr>
  </tbody>
</table>


<table style="margin-top: 50px; margin-left: 100px;">
  <tr>
    <td style="width: 400px;">Dibuat Oleh,</td>
    <td>Mengetahui,</td>
  </tr>
  <tr>
      <td><br><br><br><br></td>
  </tr>
  <tr>
    <td>________________</td>
     <td>________________</td>
  </tr>
</table>


	
</body>
</html>