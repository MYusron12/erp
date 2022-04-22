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
  
   <div class="gambar">
   <img src="assets/img/matahari.jpg">
   </div>

   <table style="width: 100%">
     <tr>
       <td align="center">
       <span style="line-height: 1.8; font-weight: bold; margin-top: 20px; position: relative; bottom: 100px;">KASBON SEMENTARA <br> <?= $pettycash['nama']; ?></span>
     </td>
     </tr>
   </table>


   <table style="font-size: 12px; margin-top: 20px;">
                <tr>
                  <td>Tanggal</td>
                  <td>:</td>
                  <td style="width: 400px;"><?= date('d-m-Y', strtotime($pettycash['tanggal'])); ?></td>
                  <td>No BS</td>
                  <td>:</td>
                  <td><?= $pettycash['no_bs']; ?></td>

                </tr>
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td><?= $pettycash['pemohon']; ?></td>
                  <td>No KB</td> 
                  <td>:</td>
                </tr>

                <tr>
                  <td>Jumlah</td>
                  <td>:</td>
                  <td>Rp. <?= number_format($pettycash['jmlajuan']); ?></td>
                </tr>

                <tr>
                  <td>Terbilang</td>
                  <td>:</td>
                  <td><?= $terbilang; ?></td>
                </tr>

                <tr>
                  <td>Keperluan</td>
                  <td>:</td>
                  <td><?= $pettycash['keterangan'];  ?></td>
                </tr>

                <tr>
                  <td>Department</td>
                  <td>:</td>
                  <td><?= $pettycash['nama_bagian']; ?></td>
                </tr>
              </table>
           

         
              <table class="mt-5" style="font-size: 12px; margin-top: 20px;">
                <tr>
                  <td>Disetujui Oleh</td>
                  <td>:</td>
                  <td>________________________</td>
                  <td>DiBayarkan Oleh</td>
                  <td>:</td>
                  <td>________________________</td>
                </tr>
                <tr class="pb-0">
                  <td></td>
                  <td></td>
                  <td>Manager</td>
                  <td></td>
                  <td></td>
                  <td>Cashier</td>
                </tr>
                <tr>
                  <td><br><br><br></td>
                </tr>
                <tr class="mt-4">
                    <td></td>
                  <td></td>
                  <td>________________________</td>
                  <td>DiBayarkan Oleh</td>
                  <td></td>
                  <td>________________________</td>
                </tr>
                <tr class="pb-0">
                  <td></td>
                  <td></td>
                  <td>Finance Manager</td>
                  <td></td>
                  <td></td>
                  <td>Nama Lengkap & Ttd</td>
                </tr>
              </table>
            </div>
           </div>

        
         <table style="margin-top: 20PX; font-size: 12px;">
           <tr>
             <td>PERTANGGUNG JAWABAN KASBON</td>
           </tr>
         </table>

         <table style="font-size: 10px;">
          <tr>&nbsp; &nbsp;
            <td width="130">Tanggal</td>
            <td width="10">:</td>
           <?php if ($pettycash['tgl_realisasi'] == 0000-00-00) : ?>
                   <?php $tanggal = "-"; ?>
                  <?php else : ?>
                    <?php $tanggal = date('d-m-Y', strtotime($pettycash['tgl_realisasi'])); ?>
                <?php endif; ?>
            <td width="182"><?= $tanggal; ?></td>
            <td width="128">Diterima Oleh</td>
            <td width="10"><div align="center">:</div></td>
            <td width="153">___________________</td>
             </tr>
          <tr>
            <td>Jumlah Awal</td>
            <td>:</td>
            <td>Rp. <?= number_format($pettycash['jmlajuan']); ?></td>
            <td>Dibayarkan Oleh</td>
            <td><div align="center">:</div></td>
            <td>___________________</td>
          </tr>
          <tr>
            <td>Terpakai</td>
            <td>:</td>
            <td>Rp. <?= number_format($pettycash['terpakai']); ?></td>
            <td>Catatan</td>
            <td>:</td>
          </tr>
          <tr>
            <td>Selisih lebih/kurang</td>
            <td>:</td>
            <td>Rp. <?= number_format($pettycash['jmlajuan']-$pettycash['terpakai']); ?></td>
          </tr>
         </table>

  
   

  
        






</body>
</html>