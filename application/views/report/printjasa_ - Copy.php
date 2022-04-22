<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>

    <head>
        <style type="text/css">
            .tg {
                border-collapse: collapse;
                border-spacing: 0;
            }

            .tg td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }

            .tg th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-weight: normal;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }

            .tg .tg-km2t {
                border-color: #ffffff;
                font-weight: bold;
                font-size: 11px;
                text-align: left;
                vertical-align: top
            }

            .tg .tg-zv4m {
                border-color: #ffffff;
                text-align: center;
                vertical-align: top
            }

            .tg .tg-zv3m {
                border-left-color: black; 
                border-right-color: black;
                border-bottom-color: black;
                text-align: center;
                vertical-align: top
            }

            .tg .tg-zv2m {
                border-top-color: white;
                border-left-color: white;
                border-right-color: white;
                border-bottom-color: black;
                text-align: center;
                vertical-align: top
            }

            .tg .tg-8jgo {
                border-color: #ffffff;
                text-align: center;
                vertical-align: top
            }

            .tg .tg-c3ow {
                border-color: black;
                text-align: center;
                vertical-align: top
            }

            .tg .tg-wp8o {
                border-color: #000000;
                text-align: center;
                vertical-align: top
            }

            .tg .tg-mqa1 {
                border-color: #000000;
                border-bottom-color:black;
                font-weight: bold;
                text-align: center;
                vertical-align: top
            }

            .tg .tg-aw21 {
                border-color: #ffffff;
                font-weight: bold;
                text-align: center;
                vertical-align: top
            }
        </style>
    </head>

<body>
    <table class="tg" style="table-layout: fixed; width: 765px">
        <colgroup>
            <col style="width: 34px">
            <col style="width: 39px">
            <col style="width: 37px">
            <col style="width: 45px">
            <col style="width: 56px">
            <col style="width: 132px">
            <col style="width: 27px">
            <col style="width: 28px">
            <col style="width: 28px">
            <col style="width: 28px">
            <col style="width: 54px">
            <col style="width: 146px">
            <col style="width: 28px">
            <col style="width: 27px">
            <col style="width: 28px">
            <col style="width: 28px">
        </colgroup>
        <thead>
            <tr>
                <th class="tg-zv4m"></th>
                <th class="tg-zv4m" colspan="6"><img src="assets/img/matahari.jpg"></th>
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
                <td class="tg-8jgo" colspan="16"><span style="font-weight:bold;text-decoration:underline">PURCHASE REQUEST</span><br><span style="font-weight:bold">(PERMINTAAN PEMBELIAN)</span></td>
            </tr>
            <tr>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m" colspan="4"></td>
                <td class="tg-zv4m" colspan="2"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t" colspan="5">No. PR : <?= $jasa->no_pr_jasa; ?></td>
            </tr>
            <tr>
                <td class="tg-zv4m"></td>
                <td class="tg-km2t" colspan="4">TO</td>
                <td class="tg-km2t" colspan="2">: Purchasing</td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t" colspan="2">BUDGET RESERVED NO</td>
                <td class="tg-km2t" colspan="4">: <?= $jasa->budget_reserved; ?></td>
            </tr>
            <tr>
                <td class="tg-zv4m"></td>
                <td class="tg-km2t" colspan="4">FROM</td>
                <td class="tg-km2t" colspan="2">: <?= $jasa->nama_bagian; ?></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t" colspan="2">CPR NO</td>
                <td class="tg-km2t" colspan="4">: </td>
            </tr>
            <tr>
                <td class="tg-zv4m"></td>
                <td class="tg-km2t" colspan="4">STORES/HO/DC</td>
                <td class="tg-km2t" colspan="2">: DC Balaraja</td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t" colspan="2">VERIFICATION CODE</td>
                <td class="tg-km2t" colspan="4">: </td>
            </tr>
            <tr>
                <td class="tg-zv4m"></td>
                <td class="tg-km2t" colspan="4">DATE of PR</td>
                <td class="tg-km2t">:  <?= date('d-m-Y', strtotime($jasa->tgl_pr_jasa)); ?></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t" colspan="2">CODING</td>
                <td class="tg-km2t" colspan="4">: <?= $jasa->coding; ?></td>
            </tr>
            <tr>
                <td class="tg-zv4m"></td>
                <td class="tg-km2t" colspan="4">DELIVERY PERIOD</td>
                <td class="tg-km2t">: <?= date('Y', strtotime($jasa->created_at)); ?></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-km2t"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
            </tr>
            <tr>
                <td class="tg-zv2m" colspan="16"></td>
            </tr>
            <?php if ($jasa->qty_2 != 0){
                $qty2 = $jasa->qty_2;
            } else {
                $qty2 = '';
            }?>
            <?php if ($jasa->qty_3 != 0){
                $qty3 = $jasa->qty_3;
            } else {
                $qty3 = '';
            }?>
            <?php if ($jasa->harga_2 != 0){
                $harga2 = number_format($jasa->harga_2);
            } else {
                $harga2 = '';
            }?>
            <?php if ($jasa->harga_3 != 0){
                $harga3 = number_format($jasa->harga_3);
            } else {
                $harga3 = '';
            }?>
            <?php if ($jasa->total_2 != 0){
                $total2 = number_format($jasa->total_2);
            } else {
                $total2 = '';
            }?>
            <?php if ($jasa->total_3 != 0){
                $total3 = number_format($jasa->total_3);
            } else {
                $total3 = '';
            }?>
            <tr>
                <td class="tg-wp8o" rowspan="2"> <span style="font-weight:bold">NO.</span></td>
                <td class="tg-wp8o" colspan="3" rowspan="2"><span style="font-weight:bold">DESCRIPTION</span></td>
                <td class="tg-mqa1" rowspan="2"><span style="font-weight:bold">UNIT</span></td>
                <td class="tg-mqa1" colspan="2">TOTAL PRICE</td>
                <td class="tg-mqa1" colspan="4">TOTAL VALUE</td>
                <td class="tg-mqa1" colspan="2" rowspan="2"><span style="font-weight:bold">REASON FOR REQUEST</span></td>
                <td class="tg-wp8o" colspan="3" rowspan="2"><span style="font-weight:bold">BENEFIT</span></td>
            </tr>
            <tr>
                <td class="tg-mqa1" style="border-bottom-color: black" colspan="2">USD / IDR</td>
                <td class="tg-mqa1" style="border-bottom-color: black" colspan="4">USD / IDR</td>
            </tr>
            <tr>
                <td class="tg-zv3m" >1</td>
                <td class="tg-zv4m" style="border-right-color: black; border-top-color: black" colspan="3"><?= $jasa->item_1; ?></td>
                <td class="tg-zv4m" style="border-right-color: black"><?= $jasa->qty_1; ?> <?= $jasa->satuan_nama1; ?></td>
                <td class="tg-zv4m" style="border-right-color: black; border-top-color: black" colspan="2"><?= number_format($jasa->harga_1); ?></td>
                <td class="tg-zv4m" style="border-right-color: black; border-top-color: black" colspan="4"><?= number_format($jasa->total_1); ?></td>
                <td class="tg-zv4m" style="border-right-color: black; border-top-color: black" colspan="2"><?= $jasa->remarks; ?></td>
                <td class="tg-zv4m" style="border-right-color: black; border-top-color: black" colspan="3"></td>
            </tr>
            <tr>
                <td class="tg-zv3m" >2</td>
                <td class="tg-zv4m" style="border-right-color: black" colspan="3"><?= $jasa->item_2; ?></td>
                <td class="tg-zv4m" style="border-right-color: black"><?= $qty2; ?> <?= $jasa->satuan_nama2; ?></td>
                <td class="tg-zv4m" style="border-right-color: black" colspan="2"><?= $harga2; ?></td>
                <td class="tg-zv4m" style="border-right-color: black" colspan="4"><?= $total2; ?></td>
                <td class="tg-zv4m" style="border-right-color: black" colspan="2"></td>
                <td class="tg-zv4m" style="border-right-color: black" colspan="3"></td>
            </tr>
            <tr>
                <td class="tg-zv3m" >3</td>
                <td class="tg-zv4m" style="border-right-color: black; border-bottom-color: black" colspan="3"><?= $jasa->item_3; ?></td>
                <td class="tg-zv4m" style="border-right-color: black; border-bottom-color: black"></td><?= $qty3; ?> <?= $jasa->satuan_nama3; ?></td>
                <td class="tg-zv4m" style="border-right-color: black" colspan="2"><?= $harga3; ?></td>
                <td class="tg-zv4m" style="border-right-color: black" colspan="4"><?= $total3; ?></td>
                <td class="tg-zv4m" style="border-right-color: black; border-bottom-color: black" colspan="2"></td>
                <td class="tg-zv4m" style="border-right-color: black; border-bottom-color: black" colspan="3"></td>
            </tr>
            <tr>
                <td class="tg-zv4m" style="border-right-color:black; border-top-color:black" colspan="5"></td>
                <td class="tg-c3ow"  colspan="2"><span style="font-weight:bold">TOTAL</span></td>
                <td class="tg-c3ow" colspan="4"><span style="font-weight:bold"><?= number_format(($jasa->total_1) + ($jasa->total_2) + ($jasa->total_3)); ?></span></td>
                <td class="tg-zv4m" style="border-left-color:black; border-top-color:black" colspan="5"></td>
            </tr>
            <tr>
                <td class="tg-zv4m" colspan="16"></td>
            </tr>
            <tr>
                <td class="tg-aw21" colspan="5">Request By,</td>
                <td class="tg-aw21" colspan="6">Verify By,</td>
                <td class="tg-aw21" colspan="5">Approved By,</td>
            </tr>
            <tr>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
            </tr>
            <?php if ($jasa->status = 2) {
                $approve = 'APPROVED';
            } else {
                $approve = 'WAITING';
            }?>
            <tr>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m" colspan="2"><?=$approve;?></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
            </tr>
            <tr>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
                <td class="tg-zv4m"></td>
            </tr>
            <tr>
                <td class="tg-aw21" colspan="5">(<?= $user['name']; ?>)</td>
                <td class="tg-aw21" colspan="6">(<?= $jasa->kepala_bagian; ?>)(Doni Petra Roosadi)</td>
                <td class="tg-aw21" colspan="5">(Ian David Pemberton)</td>
            </tr>
        </tbody>
    </table>
</body>

</html>