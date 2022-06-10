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
            padding: 0px;
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
            padding: 0px;
            word-break: normal;
        }

        .tgs td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tgs th {
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
            vertical-align: top;

        }

        .tg .tg-zv3m {
            border-left-color: black;
            border-right-color: black;
            border-bottom-color: white;
            border-top-color: white;
            text-align: center;
            border-spacing: 100%;
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
            border-bottom-color: black;
            cellspacing: 0;
            cellpadding: 0;
            font-weight: bold;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-aw21 {
            border-color: #ffffff;
            font-size: 9px;
            text-align: center;
            vertical-align: top;
            padding: 50px 5px
        }

        div {
            width: 80%;
            height: 80%;
            float: left;
            margin: 100%;
            text-align: center;
            border-left: 100px solid green;
            border-right: 100px solid blue
        }

        .empat {
            border: 5px double green;
        }
        </style>
    </head>

<body>
    <div class="empat">
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
                    <td class="tg-8jgo" colspan="16"><span style="font-weight:bold;text-decoration:underline">PURCHASE
                            REQUEST</span><br><span style="font-weight:bold">(PERMINTAAN PEMBELIAN)</span></td>
                </tr>
                <tr>
                    <td class="tg-zv4m"></td>
                    <td class="tg-zv4m" colspan="4"></td>
                    <td class="tg-zv4m" colspan="2"></td>
                    <td class="tg-zv4m"></td>
                    <td class="tg-zv4m"></td>
                    <td class="tg-zv4m"></td>
                    <td class="tg-km2t"></td>
                    <td class="tg-km2t" colspan="5">No. PR : <?= $jasa['headerjasa']->no_pr_jasa; ?></td>
                </tr>
                <tr>
                    <td class="tg-zv4m"></td>
                    <td class="tg-km2t" colspan="4">TO</td>
                    <td class="tg-km2t" colspan="2">: Purchasing</td>
                    <td class="tg-km2t"></td>
                    <td class="tg-km2t"></td>
                    <td class="tg-km2t"></td>
                    <td class="tg-km2t" colspan="2">BUDGET RESERVED NO</td>
                    <td class="tg-km2t" colspan="4">: <?= $jasa['headerjasa']->budget_reserved; ?></td>
                </tr>
                <tr>
                    <td class="tg-zv4m"></td>
                    <td class="tg-km2t" colspan="4">FROM</td>
                    <td class="tg-km2t" colspan="2">: <?= $jasa['headerjasa']->nama_request; ?></td>
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
                    <td class="tg-km2t">:
                        <?= date('d-m-Y', strtotime($jasa['headerjasa']->tgl_pr_jasa)) ?></td>
                    <td class="tg-km2t"></td>
                    <td class="tg-km2t"></td>
                    <td class="tg-km2t"></td>
                    <td class="tg-km2t"></td>
                    <td class="tg-km2t" colspan="2">CODING</td>
                    <td class="tg-km2t" colspan="4">: <?= $jasa['headerjasa']->coding; ?></td>
                </tr>
                <tr>
                    <td class="tg-zv4m"></td>
                    <td class="tg-km2t" colspan="4">DELIVERY PERIOD</td>
                    <td class="tg-km2t">: <?= date('Y', strtotime($jasa['headerjasa']->created_at)); ?>
                    </td>
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
                <!-- tandain -->

                <!-- tandain -->

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
                    <td class="tg-mqa1" style="border-top-color: white" colspan="2">USD / IDR</td>
                    <td class="tg-mqa1" style="border-top-color: white" colspan="4">USD / IDR</td>
                </tr>
                <?php $i = 1;
                $gt = 0;
                foreach ($jasa['detailjasa'] as $key => $value) : ?>
                <tr class="tr">
                    <td class="tg-zv3m"><?= $i++; ?></td>
                    <td class="tg-zv4m" style="border-right-color: black; border-top-color: white" colspan="3">
                        <?= $value->deskripsi_jasa; ?></td>
                    <td class="tg-zv4m" style="border-right-color: black"><?= $value->qty; ?>
                        <?= $value->nama_satuan; ?></td>
                    <td class="tg-zv4m" style="border-right-color: black; border-top-color: white" colspan="2">
                        <?= number_format($value->harga); ?></td>
                    <td class="tg-zv4m" style="border-right-color: black; border-top-color: white" colspan="4">
                        <?= number_format($value->total); ?></td>
						
					<?php if($jasa['headerjasa']->remarks <= $i) : ?>
                    <td class="tg-zv4m" style="border-right-color: black; border-top-color: white" colspan="2">
                        <?= $jasa['headerjasa']->remarks; ?></td>
						<?php else : ?>
					<?= " "; ?>	
						<?php endif; ?>	
						
                    <td class="tg-zv4m" style="border-right-color: black; border-top-color: white" colspan="3"></td>
                </tr>
                <?php
                    $gt += $value->total;
                endforeach; ?>

                <!-- cara bar-bar -->
                <tr>
                    <td class="tg-zv3m"></td>
                    <td class="tg-zv4m"
                        style="border-right-color: black; border-bottom-color: black; padding: 100px 5px;" colspan="3">
                    </td>
                    <td class="tg-zv4m" style="border-right-color: black; border-bottom-color: black"></td>
                    </td>
                    <td class="tg-zv4m" style="border-right-color: black" colspan="2"></td>
                    <td class="tg-zv4m" style="border-right-color: black" colspan="4"></td>
                    <td class="tg-zv4m" style="border-right-color: black; border-bottom-color: black" colspan="2"></td>
                    <td class="tg-zv4m" style="border-right-color: black; border-bottom-color: black" colspan="3"></td>
                </tr>
                <!-- cara bar-bar -->

                <tr>
                    <td class="tg-zv4m" style="border-right-color:black; border-top-color:black" colspan="5"></td>
                    <td class="tg-c3ow" colspan="2"><span style="font-weight:bold">TOTAL</span></td>
                    <td class="tg-c3ow" colspan="4"><span style="font-weight:bold"><?= number_format($gt); ?></span>
                    </td>
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
                <?php if ($jasa['headerjasa']->status = 2) {
                    $approve = 'APPROVED';
                } else {
                    $approve = 'WAITING';
                } ?>
                <tr>
                    <td class="tg-zv4m"></td>
                    <td class="tg-zv4m"></td>
                    <td class="tg-zv4m"></td>
                    <td class="tg-zv4m"></td>
                    <td class="tg-zv4m"></td>
                    <td class="tg-zv4m"></td>
                    <td class="tg-zv4m" colspan="3"><?= $approve; ?></td>
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
                    <td class="tg-aw21" colspan="5">(<?= $jasa['headerjasa']->nama_request; ?>)
                    </td>
                    <td class="tg-aw21" colspan="6">(<?= $jasa['headerjasa']->kepala_bagian; ?>)</td>
                    <td class="tg-aw21" colspan="5">(Ian David Pemberton)</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>