<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <title><?= $title; ?></title>

    <head>
        <style type="text/css">
            .ok {
                border-collapse: collapse;
                border-spacing: 0;
            }

            .ok td {
                font-family: Arial, sans-serif;
                font-size: 14px;
                overflow: hidden;
                padding: 5px 5px;
                word-break: normal;
            }

            .ok th {
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-weight: normal;
                overflow: hidden;
                padding: 5px 5px;
                word-break: normal;
            }

            .ok .ok-i3dw {
                border-color: inherit;
                font-family: "Times New Roman", Times, serif !important;
                ;
                text-align: center;
                vertical-align: top
            }

            .ok .ok-qgz6 {
                border-color: inherit;
                font-family: "Times New Roman", Times, serif !important;
                ;
                text-align: left;
                vertical-align: top
            }

            .ok .ok-0pky {
                border-color: inherit;
                text-align: left;
                vertical-align: top
            }

            .tg {
                border-collapse: collapse;

                border-spacing: 0;
            }

            .tg td {
                border-color: black;
                border-style: dotted;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }

            .tg th {
                border-color: black;
                border-style: dotted;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-weight: normal;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }

            .tg .tg-0pky {
                border-color: inherit;
                text-align: left;
                vertical-align: top
            }
        </style>
    </head>

    <body>
        <table class="ok" width="100%">
            <thead>
                <tr>
                    <th class="ok-qgz6" colspan="10"><img src="assets/img/matahari.jpg"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ok-i3dw" colspan="10"><span style="font-weight:bold">LAPORAN WORKORDER EKSPEDISI</span>
                    </td>
                </tr>
                <tr>
                    <td class="ok-i3dw" colspan="10"><span style="font-weight:bold">PT MATAHARI DEPARTMENT
                            STORE</span><br><span style="font-weight:bold">MDS National Distribution Center</span></td>
                </tr>
                <tr>
                    <td class="ok-0pky" colspan="10"></td>
                </tr>

                <?php if ($tanggal1['start'] == "" && $tanggal1['end'] == ""): ?>

                    <?php $tg = "All data"; ?>

                <?php else : ?>

                    <?php $tg = date('d-m-Y', strtotime($tanggal1['start'])) . " s/d " . date('d-m-Y', strtotime($tanggal1['end'])) ?>

                <?php endif ?>

                <tr>
                    <td class="ok-0pky" colspan="10">Periode Laporan &nbsp; : &nbsp;<?= $tg; ?></td>
                </tr>


        </table>
        <?php $arrDisplay = []; ?>
        <?php foreach ($rptwo as $c) : ?>
            <?php $arrDisplay["Dept : " . $c['no_polisi']][] = $c; ?>
        <?php endforeach; ?>
        <!--<?= '<pre>';
        print_r($arrDisplay);
        echo '</pre>'; ?> -->

        <table class="tg">
           <?php foreach ($arrDisplay as $no_polisi => $c1) : ?> 
            <tr>
                <td class="tg-0pky">No Polisi</td>
                <td class="tg-0pky">:</td>
                <td class="tg-0pky" colspan="10"><?= $no_polisi; ?></td>
            </tr>

            <tr>
                <td class="tg-0pky">no</td>
                <td class="tg-0pky">Tanggal Request</td>
                <td></td>
                <td class="tg-0pky">No Pengerjaan</td>
                <td class="tg-0pky">Tanggal Cek</td>
                <td class="tg-0pky">PIC Pengecekan</td>
                <td class="tg-0pky">Kategori</td>
                <td class="tg-0pky">Nama Supir</td>
                <td class="tg-0pky">Keterangan Request</td>
                <td class="tg-0pky">Keterangan Komponen</td>
                <td class="tg-0pky">Keterangan Pengerjaan</td>
            </tr>

          <?php 
          $start=1;
          foreach ($c1 as $c) : ?>    
            <tr>
                 <td scope="row"><?= $start++; ?></td>
                <td class="tg-0pky"><?= $c['tgl_order']?></td>
                <td></td>
                <td class="tg-0pky"><?= $c['no_pengerjaan']?></td>
                <td class="tg-0pky"><?= $c['tanggal_cek']?></td>
                <td class="tg-0pky"><?= $c['pic_cek']?></td>
                <td class="tg-0pky"><?= $c['categori']?></td>
                <td class="tg-0pky"><?= $c['deskripsi_supir']?></td>
                <td class="tg-0pky"><?= $c['deskripsi_peminta']?></td>
                <td class="tg-0pky"><?= $c['deskripsi_komponen']?></td>
                <td class="tg-0pky"><?= $c['deskripsi_perkerja']?></td>
            </tr>
           
            <tr>
                 <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td class="tg-0pky" colspan="11"></td>
            </tr>
            <?php 
                endforeach;?>
        </tbody>
    </table>

</body>

</html>