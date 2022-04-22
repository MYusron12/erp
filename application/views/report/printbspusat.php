<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kasbon Pusat</title>

	

  <style>

  	.line-title {
  		border:0;
  		border-style: inset;
  		border-top: 1px solid #000;

  	}

  
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-lboi{border-color:inherit;text-align:left;vertical-align:middle}
.tg .tg-9wq8{border-color:inherit;text-align:center;vertical-align:middle}
.tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
   
  	

  </style>

</head>
<body>

  
    
  
	
   <img src="assets/img/matahari.jpg" style="position: absolute; height: auto;">
   <p><?= $bspusat['namaloc']; ?></p>
         
         <table width="100%">
         	<tr class="judul">
         		<td width="75%" align="right">
         			<span style="line-height: 1.6; margin-left: 200px;">Tanggal Pengambilan</span>         		</td>
       		  <td width="1%">:</td>
       		  <td width="24%"><?= date('d-M-Y', strtotime($bspusat['tanggal'])); ?></td>
       	   </tr>
         	<tr>
         		<td align="right">
         			<span style="line-height: 1.6; margin-left: 200px;">Perkiraan tgl penyelesaian</span>
         		</td>
         		<td>:</td>
         		<td><?= date('d-M-Y', strtotime($bspusat['tglperkiraanrealisasi'])); ?></td>
         	</tr>
         </table>

         <table>
         	<th>
         		<td><?= $bspusat['namaloc']; ?></td>
         	</th>
         </table> <br> <br>


         <div style="text-align: center; font-size: 18px; font-weight: bold; text-decoration: underline;">
          <p>BON SEMENTARA</p>
         </div>

         <div style="text-align: center; line-height: -10px;">  
           <span>Nomor__________________</span>
         </div>

         <br>
         <table style="margin-top: 20px; margin-left: 50px; line-height: 30px;">
           <tr>
             <td style="width: 100px;">Jumlah</td>
             <td>:</td>
             <td>Rp. <?= number_format($bspusat['jumlah'],2,",","."); ?></td>
           </tr>
           <tr>
             <td>Terbilang</td>
             <td>:</td>
             <td><?= $terbilang; ?></td>
           </tr>
           <tr>
             <td>Keperluan</td>
             <td>:</td>
             <td><?= $bspusat['keperluan']; ?></td>
           </tr>
           <tr>
             <td>Koding NA</td>
             <td>:</td>
             <td><?= $bspusat['kode_loc'] ."-". $bspusat['account'] ."-". $bspusat['accountna'] ."-". $bspusat['nama_bisnis']; ?></td>
           </tr>
         </table>

  <table class="tg" style="margin-left: 20px; margin-top: 10px;">
  <tr>
    <th class="tg-9wq8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Diminta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br><br><br><br></th>
    <th class="tg-0pky">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Disetujui&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th class="tg-0pky">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diterima&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
  </tr>
  <tr>
    <td class="tg-lboi" align="center">kepala bagian</td>
    <td class="tg-0pky" align="center">Bagian Finance</td>
    <td class="tg-c3ow" align="center">Yang Menerima</td>
  </tr>
</table>











</body>
</html>