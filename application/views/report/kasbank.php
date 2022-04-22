<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <head>
        <style type="text/css">
            .ok  {border-collapse:collapse;border-spacing:0;}
            .ok td{border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                   overflow:hidden;padding:10px 5px;word-break:normal;}
            .ok th{ border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                    font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
            .ok .ok-0pky{border-color:inherit;text-align:left;vertical-align:top}
            .ok .ok-0lap{border-color:inherit;text-align:center;font-weight:bold;vertical-align:top}
        </style>
    </head>
    <body>
        <table class="ok" style=table-layout: fixed; width: 988px">
            <colgroup>
                <col style="width: 120.5px">
                <col style="width: 22.5px">
                <col style="width: 200.5px">
                <col style="width: 194.5px">
                <col style="width: 236.5px">
                <col style="width: 23.5px">
                <col style="width: 92.5px">
                <col style="width: 92.5px">
            </colgroup>
            <thead>
                <tr>
                    <th class="ok-0pky" colspan="6"><img src="assets/img/matahari.jpg"></th>
                    <th class="ok-0lap" colspan="2">Ext/Phone :<br>Payment Voucher (PV)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ok-0pky" colspan="8"></td>
                </tr>
                <tr>
                    <td class="ok-0pky" colspan="8">DC Balaraja</td>
                </tr>
                <tr>
                    <td class="ok-0pky" colspan="2">Dibayarkan Kepada :</td>
                    <td class="ok-0pky" colspan="6"><?= $trans['suplier']; ?></td>
                </tr>
            </tbody>
        </table>

        <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;}
            .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                   overflow:hidden;padding:10px 5px;word-break:normal;}
            .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                   font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
            .tg .tg-8bgf{border-color:inherit;font-style:italic;text-align:center;vertical-align:top}
            .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
            .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
            .tg .tg-0pkb{border-color:inherit;text-align:center;vertical-align:top}
            .tg .tg-f8tv{border-color:inherit;font-style:italic;text-align:left;vertical-align:top}
            .tg .tg-0pka{border-color:inherit;text-align:left;vertical-align:top}
            .tg .tg-fymr{border-color:inherit;font-weight:bold;text-align:left;vertical-align:top}
        </style>

        <table class="tg" style=table-layout: fixed; width: 988px">
            <colgroup>
                <col style="width: 120.5px">
                <col style="width: 22.5px">
                <col style="width: 200.5px">
                <col style="width: 194.5px">
                <col style="width: 236.5px">
                <col style="width: 23.5px">
                <col style="width: 92.5px">
                <col style="width: 92.5px">
            </colgroup>
            <thead>
                <tr>
                    <th class="tg-c3ow" colspan="2">Payment Date</th>
                    <th class="tg-c3ow">PV No.</th>
                    <th class="tg-c3ow">Request No</th>
                    <th class="tg-c3ow" colspan="2">Request Date</th>
                    <th class="tg-c3ow" colspan="2">Budget Reserve No.</th>
                </tr>
            </thead>
            <?php if ($trans['tgl_penerima'] == '0000-00-00'): ?>
                <?php $tglbayar = "<center>" . "-" . "</center>"; ?>
            <?php else : ?>
                <?php $tglbayar = date('d-m-Y', strtotime($trans['tgl_penerima'])); ?>
            <?php endif ?>
            <tbody>
                <tr>
                    <td class="tg-0pkb" colspan="2"><?= $tglbayar; ?></td>
                    <td class="tg-0pkb"><?= substr($trans['nama'], 0, 2); ?>/<?= substr($trans['id_transaksi_dept'], 14, 3); ?>/<?= $trans['kode_loc']; ?></td>
                    <td class="tg-0pkb"><?= $trans['cashbankno']; ?></td>
                    <td class="tg-0pkb" colspan="2"><?= date('d-m-Y', strtotime($trans['tgl_pengajuan'])); ?></td>
                    <td class="tg-0pkb" colspan="2"></td>
                </tr>
                <tr>
                    <td class="tg-c3ow" colspan="2">COMP-LOC-EC-NA-TB-EA</td>
                    <td class="tg-c3ow">AMOUNT</td>
                    <td class="tg-c3ow" colspan="5">DESCRIPTION</td>
                </tr>
                <?php 
                $gt=0;
                foreach ($trandetail as $row) : ?>
                    <tr>
                        <td class="tg-0pky" colspan="2" style ="tex-align:center">COMP-<?= $row['loc'] . "-" . $row['coa_ec_account'] . "-" . $row['coa_na_account'] . "-" . $row['coa_tb_account']; ?></td>
                        <td class="tg-0pky">IDR <?= number_format($row['nominal']); ?></td>
                        <td class="tg-0pky" colspan="5"><?= $row['keterangan']; ?></td>
                    </tr>

                    <?php
                    $gt += $row['nominal'];
                endforeach;
                ?>
                <tr>
                    <td class="tg-fymr" colspan="2">Total</td>
                    <td class="tg-0pky">IDR <?= number_format($gt); ?></td>
                    <td class="tg-0pky" colspan="5"><?= ucwords(number_to_words($gt)) . " Rupiah"; ?></td>
                </tr>
                <tr>
                    <td class="tg-0pky">Note</td>
                    <td class="tg-0pky" colspan="4">Supplier. <?= $trans['suplier']; ?> (<?= $trans['suplier']; ?>)<br>No Rekening <?= $trans['rekening']; ?></td>
                    <td class="tg-0pky" colspan="3">Catatan :<br><?= $trans['catatan']; ?></td>
                </tr>
                <tr>
                    <td class="tg-8bgf">Prepared  by :<br></td>
                    <td class="tg-8bgf" colspan="7">Approved by :</td>
                </tr>
                <tr>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky" colspan="7"><br><br><br><br><br><br></td>
                </tr>
                <tr>
                    <td class="tg-8bgf">Dept Head</td>
                    <td class="tg-8bgf">Div Head</td>
                    <td class="tg-8bgf">BOM</td>
                    <td class="tg-8bgf">Direct Report to CEO</td>
                    <td class="tg-8bgf">CFO</td>
                    <td class="tg-8bgf" colspan="2">CSO</td>
                    <td class="tg-8bgf">CEO</td>
                </tr>
                <tr>
                    <td class="tg-f8tv" colspan="8">Checked By :</td>
                </tr>
                <tr>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky" colspan="7"><br><br><br><br><br><br></td>
                </tr>
                <tr>
                    <td class="tg-f8tv" colspan="2">Checked By :</td>
                    <td class="tg-8bgf" colspan="3">Finance Dept</td>
                    <td class="tg-f8tv" colspan="3">Tax Dept.</td>
                </tr>
                <tr>
                    <td class="tg-f8tv" colspan="2">Input by :</td>
                    <td class="tg-f8tv" colspan="6">(Filled by Finance Dept)</td>
                </tr>
                <tr>
                    <td class="tg-0pky" colspan="2" rowspan="3"></td>
                    <td class="tg-0pky">Bank :</td>
                    <td class="tg-0pky" colspan="5"></td>
                </tr>
                <tr>
                    <td class="tg-0pky" colspan="6"></td>
                </tr>
                <tr>
                    <td class="tg-0pky">Account No :</td>
                    <td class="tg-0pky" colspan="5"></td>
                </tr>
                <tr>
                    <td class="tg-f8tv" colspan="2">GL Dept.</td>
                    <td class="tg-f8tv" colspan="6"></td>
                </tr>

            </tbody>
        </table>
    </body>

</html>