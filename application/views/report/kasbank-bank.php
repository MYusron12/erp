
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title; ?></title>


  <style type="text/css">

  body {
    font-size: 12px;
    font-family : Arial;
  }

/*.tg {

      font-family:  Arial;
      color: #232323;
      border-collapse: collapse;
      width: 100%;

    }

    .tg, th, .i {

    border: 1px solid #999;
    padding: 8px 20px;*/

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

     <img src="assets/img/matahari.jpg" style="position: absolute; width: 35%">
         <div class="option"  style="margin-left: 50px;">
         <table style="margin-left: 300px;">
          <tr class="judul">
            <td width="40%%" align="center">
              <span style="line-height: 1.6;font-size: 13px;">BUKTI PENGELUARAN</span>            </td>
           </tr>
          </table>

          
          <?php if (substr($trans['cashbankno'],0,2) == "KK"): ?>
          <table style="margin-left: 400px; font-size: 10px; margin-bottom: 20px;"> 
          <tr>
            <td>
             <input id="option" type="radio" name="field" value="Pettycash" checked="checked">
             <label for="option"><span><span></span></span>Kas Kecil</label>
             </td>

             <td>
               <input id="option" type="radio" name="field" value="Cash">
               <label for="option"><span><span></span></span>Kas</label>
             </td>
             <td>
               <input id="option" type="radio" name="field" value="Bank">
               <label for="option"><span><span></span></span>Bank</label>
             </td>
            </tr>
          </table>
          <?php endif; ?>
       

          <?php if (substr($trans['cashbankno'],0,3) == "KAS") : ?>
            <table style="margin-left: 400px; font-size: 10px;">
              <tr>
             <td>
             <input id="option" type="radio" name="field" value="Pettycash">
             <label for="option"><span><span></span></span>Kas Kecil</label>
             </td>
             <td>
               <input id="option" type="radio" name="field" value="Cash" checked="checked">
               <label for="option"><span><span></span></span>Kas</label>
             </td>
             <td>
               <input id="option" type="radio" name="field" value="Bank">
               <label for="option"><span><span></span></span>Bank</label>
             </td>
             </tr>
             </table>
           
           <?php endif; ?>
           
            <?php if (substr($trans['cashbankno'],0,4) == "BANK") : ?>
           <table style="margin-left: 400px; font-size: 10px;">
            <tr>
              <td>
             <input id="option" type="radio" name="field" value="Pettycash">
             <label for="option"><span><span></span></span>Kas Kecil</label>
             </td>

             <td>
               <input id="option" type="radio" name="field" value="Cash">
               <label for="option"><span><span></span></span>Kas</label>
             </td>
             <td>
               <input id="option" type="radio" name="field" value="Bank" checked="checked">
               <label for="option"><span><span></span></span>Bank</label>
             </td>
           </tr>
          </table>
          <?php endif; ?>
               
      </div>


      <table style="font-size: 10px">
        <tr>
          <td>
           <?= $trans['nama']; ?> 
          </td>
        </tr>
      </table>

      <table style="font-size: 10px">
        <tr>
          <td>
            Dibayarkan Kepada : <?= $trans['suplier']; ?> 
          </td>
        </tr>
      </table>


    <table class="table" style="font-size: 9px; line-height: 8px;">
      <thead>
      <tr>
        <th scope="col">Jurnal</th>
        <th scope="col">No batch</th>
        <th scope="col">Tgl bayar</th>
        <th scope="col">No Bpkb</th>
        <th scope="col">No Permintaan</th>
        <th scope="col">Tgl Permintaan</th>
        <th scope="col">No Giro Check</th>
      </tr>
      </thead>
      <tbody>

        <?php if ($trans['tgl_penerima'] == '0000-00-00'): ?>
          <?php $tglbayar = "<center>". "-" . "</center>"; ?>
          <?php else : ?>
          <?php $tglbayar = date('d-m-Y', strtotime($trans['tgl_penerima'])); ?>
        <?php endif ?>
        <tr>
          <td></td>
          <td class="tg"><?= $trans['no_batch']; ?></td>
          <td class="tg"><?= $tglbayar; ?></td>
          <td class="tg"><?= $trans['no_bpk']; ?></td>
          <td class="tg"><?= $trans['cashbankno']; ?></td>
          <td class="tg"><?= date('d-m-Y', strtotime($trans['tgl_pengajuan'])); ?></td>
          <td class="tg"><?= $trans['no_giro']; ?></td>
        </tr>
        <tr>
         <td class="tg" colspan="2">LOC-EC-ND-SD-TB</td>
         <td class="tg" colspan="2" align="center">JUMLAH</td>
         <td class="tg" colspan="3" align="">KETERANGAN</td>
        </tr>
        
        <?php foreach($trandetail as $row) : ?>

        <tr>
          <td colspan="2" style="line-height: 15px; border-right: 1px solid #999; text-align: center; padding-top: 2px;"><?=  $row['loc'] ."-". $row['coa_ec_account'] ."-". $row['coa_na_account'] ."-". $row['coa_tb_account']; ?></td>
          <td colspan="2" style="line-height: 15px; border-right: 1px solid #999; text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IDR <?= number_format($row['nominal']); ?></td>
          <td colspan="3" style="line-height: 15px; border-right: 1px solid #999;"><?= $row['keterangan']; ?></td>
        </tr>
        
        <?php endforeach; ?>

       <!--  <?php if ($trans['id_transaksi_dept'] == null): ?>
          <?php $catatan = $trans['catatan']; ?>
        <?php else : ?>

           <?php $catatan = 'Supplier:' .' '. $trans['suplier'] ?>
          
        <?php endif ?> -->

        <?php $catatan = 'Suplier : ' .''. $trans['suplier'] .'<BR>'. 'Bank : ' .$trans['bank'] .', No Rekening : ' .$trans['rekening'] .'<BR>'. 'Cabank : ' .$trans['cabang'] ?>

        <tr>
          <td class="tg" colspan="2" style="text-align: center; font-weight: bold;">TOTAL</td>
          <td class="tg" colspan="2" style="text-align: left;">IDR <?= number_format($trans['total']) ?></td>
          <td class="tg" colspan="3"><?= $terbilang; ?></td>
        </tr>

        <tr>
          <td colspan="2" style="text-align: center;">Catatan:</td>
          <td colspan="2" style="padding: 3px;">Suplier : <?= $trans['suplier'] ?></td>
          <td>Catatan</td>
        </tr>

        <tr>
          <td colspan="2"></td>
          <td colspan="2" style="padding: 3px;">Bank : <?= $trans['bank'] .', No Rekening :' . $trans['rekening'] ?></td>
          <td style="padding: 3px;"><?= $trans['catatan']; ?></td>
        </tr>

         <tr>
          <td colspan="2"></td>
          <td colspan="2" style="padding: 3px;">Cabang : <?= $trans['cabang'] ?></td>
          <td></td>
        </tr>

    
       

        <tr>
          <td class="tg" colspan="2">Dibuat Oleh<br><br><br><br><br><br><br><br></td>
          <td class="tg">DIPERIKSA OLEH<br><br><br><br> <br><br>(Petugas Berwenang)</td>
          <td class="tg">DISETUJUI OLEH<br><br><br><br> <br><br><br>(Keuangan)</td>
          <td class="tg">DITERIMA OLEH<br><br><br><br> <br><br><br>(Penerima)</td>
          <td class="tg" colspan="2" style="width: 20px;">DIISI OLEH KEUANGAN<br>BANK:<br>AC NOMOR:<br>NAMA KA :<br></td>
          </tr>


        
      </tbody>
    </table>










  <!-- <div class="batas" style="margin-bottom: 20px;"></div> 
  <div class="container">
  <table class="tg" style="width: 100%">
  <tr>
    <th class="tg-9wq8 i">Jurnal</th>
    <th class="tg-9wq8 i">No batch</th>
    <th class="tg-c3ow i">Tgl bayar</th>
    <th class="tg-c3ow i">No Bpkb</th>
    <th class="tg-c3ow i">No Permintaan</th>
    <th class="tg-c3ow i">Tgl Permintaan</th>
    <th class="tg-c3ow i">No Giro Check</th>
  </tr>
  <tr>
    <td class="tg-0pky i"></td>
    <td class="tg-0pky i"><?= $trans['no_batch']; ?></td>
    <td class="tg-0pky i"></td>
    <td class="tg-0pky i"><?= $trans['no_bpk']; ?></td>
    <td class="tg-0pky i"><?= $trans['cashbankno']; ?></td>
    <td class="tg-0pky i"><?= date('d-m-Y', strtotime($trans['tgl_pengajuan'])); ?></td>
    <td class="tg-0pky i"><?= $trans['no_giro']; ?></td>
  
  </tr>
  <tr>
    <td class="tg-9wq8 i" colspan="3">LOC-EC-ND-SD-TB</td>
    <td class="tg-c3ow i" colspan="2" align="center">JUMLAH</td>
    <td class="tg-0pky i" colspan="2" align="">KETERANGAN</td>
  </tr>

  <?php foreach($trandetail as $row) : ?>
  <tr>
    <td class="tg-0pky i" colspan="3"><?= sprintf("%03d", $row['loc']) ." ". sprintf("%03d",$row['id_coa_ec']) ." ". sprintf("%03d",$row['id_coa_na']) ." ". sprintf("%03d",$row['id_coa_tb']) ?></td>
    <td class="tg-0pky i" colspan="2" align="center">IDR <?= number_format($row['nominal'],2,",","."); ?></td>
    <td class="tg-0pky i" colspan="2"><?= $row['keterangan'];  ?></td>
  </tr>

  <?php endforeach; ?>

 <tr>
    <td class="tg-0pky i" colspan="3" align="center">TOTAL</td>
    <td class="tg-0pky i" colspan="2" align="center"><?= number_format($trans['total'],2,",",".") ?></td>
    <td class="tg-0pky i" colspan="2" align="center"><?= $terbilang; ?></td>
  </tr>
  <tr>
    <td class="tg-0pky i" colspan="7">CATATAN BS : <?= $trans['catatan']; ?></td>
  </tr>
  <tr>
    <td class="tg-0pky i" colspan="2">Dibuat Oleh<br><br><br><br><br><br><br><br></td>
    <td class="tg-0pky i">DIPERIKSA OLEH<br><br><br><br>(Petugas Berwenang)</td>
    <td class="tg-0pky i">DISETUJUI OLEH<br><br><br><br>   (Keuangan)</td>
    <td class="tg-0pky i">DITERIMA OLEH<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;(Penerima)</td>
    <td class="tg-0pky i" colspan="2" style="width: 20px;">DIISI OLEH KEUANGAN<br>BANK:<br>AC NOMOR:<br>NAMA KA :<br></td>
  </tr>
</table> -->
</div>
</body>
</html>






