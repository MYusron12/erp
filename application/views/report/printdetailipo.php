<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>

    <style type="text/css">
        .tg {
            border-color: black;
            border-spacing: 0;
            border-style: solid;
            border-width: 1px;
            border-top-color: black;
            border-bottom-color: black;
            border-right-color: black;
            border-left-color: black;
        }

        .tg td {
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 11px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-b7tv {
            border-color: #ffffff;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-km2t {
            border-color: #ffffff;
            font-weight: bold;
            font-size: 10px;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-zv4m {
            border-color: #ffffff;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-0pak {
            border-color: #ffffff;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-zm54 {
            border-color: #ffffff;
            font-weight: bold;
            font-size: 10px;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-73oq {
            border-color: #ffffff;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-mqa1 {
            border-color: #ffffff;
            font-weight: bold;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-mqa2 {
            border-color: #ffffff;
            border-bottom-color: black;
            font-weight: bold;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-de2y {
            border-color: black;
            text-align: center;
            vertical-align: top;
            font-weight: bold;
        }

        .tg .tg-21dp {
            border-color: black;
            text-align: center;
            vertical-align: top;
            font-weight: bold;
        }

        .tg .tg-0pky {
            border-color: inherit;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-pcvp {
            border-color: inherit;
            text-align: left;
            vertical-align: top
        }
    </style>
</head>
<?php
$des2 = '';
if ($ipo['headeripo']->dept_id == $ipo['headeripo']->bagian_pembelian ) {
    $des2 = $ipo['headeripo']->no_pembelian;
} else {
    $des2 = $ipo['headeripo']->no_jasa;
}

?>

<body>
    <table class="tg">
        <thead>
            <tr>
                <th class="tg-73oq" colspan="6"><img src="assets/img/matahari.jpg"></th>
                <th class="tg-zv4m"></th>
                <th class="tg-zv4m"></th>
                <th class="tg-zv4m"></th>
                <th class="tg-zv4m"></th>
                <th class="tg-zv4m"></th>
                <th class="tg-zv4m"></th>
                <th class="tg-zv4m"></th>
                <th class="tg-zv4m"></th>
                <th class="tg-zv4m"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-mqa1" colspan="16"><span style="font-weight:bold;text-decoration:underline">INTERNAL
                        PO</span><br><span style="font-weight:normal;font-style:italic">(for internal use only)</span>
                </td>
            </tr>
            <tr>
                <td class="tg-mqa1" colspan="16"></td>
            </tr>
            <tr>
                <td class="tg-km2t" colspan="4">Supplier No.</td>
                <td class="tg-km2t">: <?= $ipo['headeripo']->kode; ?></td>
                <td class="tg-zm54"></td>
                <td class="tg-km2t"></td>
                <td class="tg-zm54"></td>
                <td class="tg-km2t"></td>
                <td class="tg-zm54" colspan="2">No. IPO</td>
                <td class="tg-zm54" colspan="4">: <?= $ipo['headeripo']->no_ipo; ?></td>
            </tr>
            <tr>
                <td class="tg-km2t" colspan="4">Supplier Name</td>
                <td class="tg-km2t" colspan="3">: <?= $ipo['headeripo']->nama_supplier; ?></td>
                <td class="tg-zm54"></td>
                <td class="tg-km2t"></td>
                <td class="tg-zm54" colspan="2">No. PR</td>
                <td class="tg-zm54" colspan="4">: <?= $des2; ?></td>
            </tr>
            <tr>
                <td class="tg-km2t" colspan="4">Delivery Period</td>
                <td class="tg-km2t">: <?= date('Y', strtotime($ipo['headeripo']->delivery_periode)); ?></td>
                <td class="tg-zm54"></td>
                <td class="tg-km2t"></td>
                <td class="tg-zm54"></td>
                <td class="tg-km2t"></td>
                <td class="tg-zm54" colspan="2">Loc</td>
                <td class="tg-zm54" colspan="4">: <?= $ipo['headeripo']->nama_department; ?></td>
            </tr>
            <tr>
                <td class="tg-km2t" colspan="4">Budget Reserved No.</td>
                <td class="tg-km2t" colspan="3">: <?= $ipo['headeripo']->budget; ?> </td>
                <td class="tg-zm54"></td>
                <td class="tg-km2t"></td>
                <td class="tg-zm54" colspan="2">Store</td>
                <td class="tg-zm54" colspan="4">: <?= $ipo['headeripo']->store; ?></td>
            </tr>
            <tr>
                <td class="tg-mqa2" colspan="16"></td>
            </tr>
            <tr>
                <td class="tg-de2y">No</td>
                <td class="tg-21dp">LOC</td>
                <td class="tg-de2y">EC</td>
                <td class="tg-21dp">NA</td>
                <td class="tg-de2y">TB</td>
                <td class="tg-21dp">EA</td>
                <td class="tg-de2y" colspan="2">Description</td>
                <td class="tg-21dp">Quantity</td>
                <td class="tg-de2y" colspan="3">Price/Unit</td>
                <td class="tg-21dp" colspan="4">Amount</td>
            </tr>

            <?php $i = 1;
            $gt = 0;


            foreach ($ipo['detailipo'] as $key => $value) : ?>
                $des='';
                <?php if ($value->barang_id == 0) {
                    $des = $value->barang_nama;
                } else {
                    $des = $value->nama_bar;
                } ?>


                <tr>
                    <td class="tg-0pky"><?= $i++; ?></td>
                    <td class="tg-pcvp"><?= $value->loc; ?></td>
                    <td class="tg-0pky"><?= $value->ec; ?></td>
                    <td class="tg-pcvp"><?= $value->na; ?></td>
                    <td class="tg-0pky"><?= $value->tb; ?></td>
                    <td class="tg-pcvp"><?= $value->ea; ?></td>
                    <td class="tg-0pky" colspan="2"><?= $des; ?></td>
                    <td class="tg-pcvp"><?= $value->qty; ?> <?= $value->nama_satuan; ?></td>
                    <td class="tg-0pky" colspan="3"><?= number_format($value->harga); ?></td>
                    <td class="tg-pcvp" colspan="4"><?= number_format($value->subtotal); ?></td>
                </tr>
            <?php

                $gt += $value->subtotal;
            endforeach; ?>
            <tr>
                <td class="tg-0pky"></td>
                <td class="tg-pcvp"></td>
                <td class="tg-0pky"></td>
                <td class="tg-pcvp"></td>
                <td class="tg-0pky"></td>
                <td class="tg-pcvp"></td>
                <td class="tg-0pky" colspan="2"></td>
                <td class="tg-pcvp"></td>
                <td class="tg-0pky" colspan="3"></td>
                <td class="tg-pcvp" colspan="4"></td>
            </tr>
            <tr>
                <td class="tg-0pak" style="border-color: white; font-size:9px;" colspan="10"> <span style="font-weight:bold;font-style:italic;">Say</span> : Pengiriman barang/Pekerjaan : PT.
                    Matahari Department Store, Tbk <?= $ipo['headeripo']->nama_department; ?></td>
                <td class="tg-0pky" colspan="2">Total</td>
                <td class="tg-pcvp" colspan="4"> <?= number_format($gt); ?></td>
            </tr>
            <tr>
                <td class="tg-0pak" style="border-bottom-color: white; font-size:9px;" colspan="10">Jl Raya Serang KM 26-27 Ds Tobat Kec. Balaraja Kab. Tangerang
                </td>
                <td class="tg-0pky" colspan="2">VAT 10%</td>
                <td class="tg-pcvp" colspan="4"><?php
                    $t='-';
                    $ppn=$ipo['headeripo']->ppn_header;
                    if($ppn==0){
                        echo $t;
                       
                    }else{
                     
						 echo $ppn;
                    }
                     ?></td>
            </tr>
            <tr>
                <td class="tg-0pak" style="border-bottom-color: white; font-size:9px;" colspan="10">TOP 30 hari setelah
                    barang diterima lengkap (100%) dan dokumen penagihan di terima dengan lengkap,</td>
                <td class="tg-0pky" colspan="2">WHT / PPh</td>
                <td class="tg-pcvp" colspan="4"><?php
                    $t='-';
                    $pph=$ipo['headeripo']->pph_header;
                   
                    if($ppn==0){
                           echo $t;
                    }else{
                       echo $pph; //
                     
                    }
                     ?></td>
            </tr>
            <tr>
                <td class="tg-0pak" style="font-size:9px;border-bottom-color: black" colspan="10">tanpa ada kesalahan dan kekurangan pada dokumen.</td>
                <td class="tg-0pky" colspan="2">Grand Total</td>
                <td class="tg-pcvp" colspan="4"><?= number_format($ipo['headeripo']->grandtotal); ?></td>
            </tr>
            <tr>
                <td class="tg-0pak" colspan="8" style="text-align:center;font-weight:bold;border-bottom-color:white">
                    Prepared by:</td>
                <td class="tg-0pak" colspan="8" style="text-align:center;font-weight:bold;border-bottom-color:white;border-left-color: white;">
                    Approved by:</td>
            </tr>
            <tr>
                <td class="tg-0pak" colspan="4" style="border-bottom-color: white;"></td>
                <td class="tg-0pak" colspan="4" style="border-bottom-color: white;border-left-color: white;"></td>
                <td class="tg-0pak" colspan="8" style="border-bottom-color: white;border-left-color: white;"></td>
            </tr>
            <tr>
                <td class="tg-0pak" colspan="4" style="border-bottom-color: white;"></td>
                <td class="tg-0pak" colspan="4" style="border-bottom-color: white;border-left-color: white;"></td>
                <td class="tg-0pak" colspan="8" style="border-bottom-color: white;border-left-color: white;"></td>
            </tr>
            <tr>
                <td class="tg-0pak" colspan="4" style="text-align:center; border-bottom-color: black"><span style="font-weight:bold;text-decoration:underline"><?= $user['name']; ?></span><br><span style="font-weight:normal;font-style:italic"><?= $user['kode_bagian']; ?></span></td>
                <td class="tg-0pak" colspan="4" style="text-align:center;border-bottom-color: black"><span style="font-weight:bold;text-decoration:underline"><?= $ipo['headeripo']->nama_kepala; ?></span><br><span style="font-weight:normal;font-style:italic"><?= $ipo['headeripo']->nama_department; ?></span></td>
                <td class="tg-0pak" colspan="8" style="text-align:center;border-bottom-color: black"><span style="font-weight:bold;text-decoration:underline">Ian Pemberton</span><br><span style="font-weight:normal;font-style:italic">Director BOM</span></td>
            </tr>
            <tr>
                <td class="tg-0pky" colspan="8" style="text-align:left;border-color:white;font-size:10px;">
                    Note:<br> <span>Khusus pembelian peralatan IT harus ada persetujuan pihak IT Support Center</td>
                <td class="tg-0pky" colspan="8" style="text-align:left;font-size:10px;border-color: white;">Budget
                    Stamp:</td>
            </tr>
            <tr>
                <td class="tg-0pak" colspan="8" style="text-align:left;border-color:white"></td>
                <td class="tg-0pak" colspan="8" style="text-align:left;border-color: white;border-bottom-color:white"></td>
            </tr>
            <tr>
                <td class="tg-0pak" colspan="8" style="text-align:left;border-bottom-color:white"></td>
                <td class="tg-0pak" colspan="8" style="text-align:left;border-left-color: white;border-bottom-color:white"></td>
            </tr>
            <tr>
                <td class="tg-0pak" colspan="8" style="text-align:left;border-bottom-color:white"></td>
                <td class="tg-0pak" colspan="8" style="text-align:left;border-left-color: white;border-bottom-color:white"></td>
            </tr>
            <tr>
                <td class="tg-0pky" colspan="8" style="text-align:left; border-color: white;"></td>
                <td class="tg-0pky" colspan="8" style="text-align:left;border-color: white;"></td>
            </tr>
        </tbody>
    </table>

</body>

</html>