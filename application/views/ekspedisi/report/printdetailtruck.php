<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laporan Belum Proses HO</title>

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


     

        <table style="font-size: 13px;">
            <tr>
                <td><b>LAPORAN BELUM PROSES HO</b></td> 
            </tr>
            <tr>
                <td>Distribution Center</td> 
            </tr>


            <tr>
                <td>Periode </td>
            </tr>
        </table>
           <?php $arrDisplay = []; ?>
           <?php foreach ($t as $c) : ?>
            <?php $arrDisplay[$c['id_truck']][]=$c; ?>
        <table class="table table-bordered">
            <tr>
                <td>No Urut</td>
                <td><strong><?= $c['no_urut'];?></strong></td>
            </tr>
            <tr>
                <td>Kendaraan</td>
                <td><strong><?= $c['no_polisi'];?></strong></td>
            </tr>

        </table>
      
        <?php endforeach; ?>
        
       
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No Urtu</th>
                    <th>No Polisi</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Request</th>
                    <th>Part yg di ganti</th>
                    <th>tgl req</th>
                    <th>tgl cek</th>
                    <th>pic</th>
                    <th>hasil Cek</th>
                </tr>
            </thead>
            <tbody>
                
               <?php foreach ($arrDisplay as $key => $c1) : ?> 
                 <?=  '<pre>';print_r($c1);echo '</pre>'; ?>    
                  <?php if (! empty($c1)) : ?>
                     <?php foreach ($c1 as $c) : ?>
                    <tr>
                        <td><?= $c['no_urut']; ?></td>
                                <td><?= $c['no_polisi']; ?></td>
                                <td><?= $c['categori']; ?></td>
                                <td><?= $c['deskripsi_supir']; ?></td>
                                <td><?= $c['deskripsi_komponen']; ?></td>
                                <td><?= $c['deskripsi_peminta']; ?></td>
                                <td><?= $c['tgl_order']; ?></td>
                                <td><?= $c['tanggal_cek']; ?></td>
                                <td><?= $c['pic_cek']; ?></td>
                                <td><?= $c['deskripsi_perkerja']; ?></td>
                            </tr>

                    </tr>
                 <?php endforeach; ?>
                     <?php endif; ?>
                  
                <?php endforeach; ?>
            </tbody>
            
        </table>

    </body>
</html>