<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-5">
            <form action="<?= base_url('ekspedisi/bbm'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Keyword.." name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <div class=" alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message') ?>
            <a href="" class="btn btn-primary mb-3 tambahDataBbm" data-toggle="modal" data-target="#newBbmModal"><i class="fas fa-plus"></i>Tambah</a>
            <div class="table-responsive-lg">
                <div class="card mb-4 text-white">
                    <div class="card-header py-3 bg-primary">
                        Total : <?= $total_rows; ?> Data Results
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Polisi</th>
                            <th scope="col">KM Awal</th>
                            <th scope="col">KM Akhir</th>
                            <th scope="col">Jarak</th>
                            <th scope="col">Jml Liter</th>
                            <th scope="col">harga BBm</th>
                            <th scope="col">Total BBm</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($bbm)) : ?>
                            <tr>
                                <td colspan="10" style="text-align: center;">
                                    <div class="alert alert-danger" role="alert">
                                        Data not found!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>   
                        <?php
                       
                        foreach ($bbm as $row) :
                            ?>
                            <tr>
                              <th scope="row"><?= ++$start; ?></th>
                                <td><?= $row['no_polisi']; ?></td>
                                <td><?= $row['km_awal']; ?></td>
                                <td><?= $row['km_akhir']; ?></td>
                                <td><?= $row['jarak']; ?></td>
                                <td><?= $row['jml_liter']; ?></td>
                                <td><?= number_format($row['bbmharga'], 2, ",", "."); ?></td>
                                <td><?= number_format($row['ttlbbm'], 2, ",", "."); ?></td>
                                <td>
                                    <a href="<?= base_url('report/printbbm/') . $row['id_transaksi_bbm']; ?>" class="btn btn-secondary btn-sm">Cetak</a>
                                    <a href="<?= base_url('ekspedisi/detailbbm/') . $row['id_transaksi_bbm']; ?>" class="btn btn-info btn-sm">Detail</a>
                                    <a href="" class="btn btn-success btn-sm ubahTampilBbm" data-toggle="modal" data-target="#newBbmModal" data-id="<?= $row['id_transaksi_bbm']; ?>">Edit</a>
                                    <a href="<?= base_url('ekspedisi/hapusbbm/') . $row['id_transaksi_bbm']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?...');">hapus</a>
                                </td>
                            </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?= $this->pagination->create_links(); ?> 
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newBbmModal" tabindex="-1" role="dialog" aria-labelledby="newBbmModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBbmModalLabel">Tambah BBM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" id="idtransaksibbm" name="idtransaksibbm">
                    <div class="form-group">
                        <label for="merekmobil">Tanggal Berangkat</label>
                        <input type="text" class="form-control tanggal" id="tanggalbbm" name="tanggalbbm" placeholder="Tanggal" autocomplete="off">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kmawal">Kilo Meter Awal</label>
                            <input type="number" class="form-control" id="kmawal" name="kmawal" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kmakhir">Kilo Meter Akhir</label>
                            <input type="number" class="form-control" id="kmakhir" name="kmakhir" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="jarak">Jarak</label>
                            <input type="text" class="form-control" id="jarak" name="jarak" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kendaraan">Kendaraan</label>
                        <select name="kendaraan" id="kendaraan" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                            <option value="">Pilih</option>
                            <?php foreach ($kendaraan as $row) : ?>
                                <option value="<?= $row->id_truck; ?>">No Body <?= $row->no_urut ?> <?= $row->no_polisi ?> <?= $row->merek ?></option>
<?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="driver1">Driver 1</label>
                            <input type="hidden" id="iddriver1" name="iddriver1">
                            <input type="text" class="form-control" id="driver1" name="driver1" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kmakhir">Driver 2</label>
                            <input type="hidden" id="iddriver2" name="iddriver2">
                            <input type="text" class="form-control" id="driver2" name="driver2" readonly>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="jmlliter">Jumlah Liter</label>
                            <input type="text" class="form-control" id="jmlliter" name="jmlliter" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hargabbm">Harga Bbm</label>
                            <input type="text" class="form-control" id="hargabbm" name="hargabbm" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="totalbbm">Total BBM</label>
                            <input type="text" class="form-control" id="totalbbm" name="totalbbm">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    var kmawal1 = document.getElementById('kmawal');
    kmawal1.addEventListener('keyup', function () {
        kmawal.value = Angka(this.value);
        jumlahkilometer();
    });

    var kmawal2 = document.getElementById('kmakhir');
    kmawal2.addEventListener('keyup', function () {
        kmakhir.value = Angka(this.value);
        jumlahkilometer();
    });

    var jmlliter = document.getElementById('jmlliter');
    jmlliter.addEventListener('keyup', function () {
        jmlliter.value = this.value;
        totalbiayabbm();

    });

    var hargabbm = document.getElementById('hargabbm');
    hargabbm.addEventListener('keyup', function () {
        hargabbm.value = formatRupiah(this.value);
        totalbiayabbm();
    });


    function jumlahkilometer() {
        const kmawal = document.getElementById('kmawal').value;
        const xkmawal = kmawal.replace(/[^,\d]/g, '');
        // var xkmawal1 = xkmawal.replace(',', '.');
        const kmakhir = document.getElementById('kmakhir').value;
        const xkmakhir = kmakhir.replace(/[^,\d]/g, '');
        //var xkmakhir1 = xkmakhir.replace(',', '.');
        var result = Number(xkmakhir) - Number(xkmawal);

        if (!isNaN(result)) {
            document.getElementById('jarak').value = result;
        }
    }

    function totalbiayabbm() {
        const jmlliter = document.getElementById('jmlliter').value;
        // const xjmlliter = jmlliter.replace(/[^,\d]/g, '');
        var xjmlliter1 = jmlliter.replace(',', '.');
        // console.log(xjmlliter1);

        const hargabbm = document.getElementById('hargabbm').value;
        //console.log(hargabbm);
        const xhargabbm = hargabbm.replace(/[^,\d]/g, '');
        var xhargabbm1 = xhargabbm.replace(',', '.');
        //console.log(xhargabbm1);


        const result = parseFloat(xhargabbm1) * parseFloat(xjmlliter1);



        if (!isNaN(result)) {

            document.getElementById('totalbbm').value = formatMoney(result.toFixed(2));

            //document.getElementById('totalbbm').value = formatMoney(result);
            // $('#totalbbm').val(Math.round(result)).mask("###.###.000");
            // $('#totalbbm').mask("###.###.000", {
            //     reverse: true
            // });
        }
    }

    // function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
    //     try {
    //         decimalCount = Math.abs(decimalCount);
    //         decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    //         const negativeSign = amount < 0 ? "-" : "";

    //         let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    //         let j = (i.length > 3) ? i.length % 3 : 0;

    //         return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    //     } catch (e) {
    //         console.log(e)
    //     }
    // };

    function Angka(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString();
        var hasil = number_string;
        return hasil;
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>