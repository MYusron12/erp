
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mt-2">
        <div class="col-md-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message') ?>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-kantorpusat-modal-lg">Tambah</button>

            <div class="table-responsive-md mt-3">
                <table class="table table-bordered" id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>

                            <th scope="col">No</th>
                            <th scope="col">No BS</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Bagian</th>
                            <th scope="col">Pemohon</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Aksi</th>
                            <th scope="col">Batal</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1;
                        foreach ($tampil as $c) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $c['nobs']; ?></td>
                                <td><?= date('d-m-Y', strtotime($c['tanggal'])); ?></td>
                                <td><?= $c['nama_bagian']; ?></td>
                                <td><?= $c['pemohon']; ?></td>
                                <td><?= number_format($c['jumlah'], 2, ",", "."); ?></td>
                                <td>

                                    <a href="" class="btn btn-info btn-sm editbspusat" data-toggle="modal" data-target=".bd-editkantorpusat-modal-lg" data-id="<?= $c['idbskantorpusat']; ?>" <?= href_batalbspusat($c['idbskantorpusat']); ?>><i class="far fa-edit"></i>Edit</a>

                                    <a href="<?= base_url('report/printbskantorpusat/') . $c['idbskantorpusat']; ?>" class="btn btn-success btn-sm" title="Cetak" target="_blank" <?= href_batalbspusat($c['idbskantorpusat']); ?>><i class="fas fa-print"></i>Cetak</a>

                                </td>

                                <td><input type="checkbox" id="batalbspusat" name="batalbspusat" class="bskantorpusat-check-input" <?= check_batalbspusat($c['idbskantorpusat']); ?> data-id="<?= $c['idbskantorpusat']; ?>" data-nobspusat="<?= $c['nobs']; ?>"></td>
                            </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade bd-kantorpusat-modal-lg" tabindex="-1" role="dialog" aria-labelledby="kantorpusatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kantorpusatModalLabel">Tambah BS Kantor Pusat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-4 ml-auto">
                            <table>
                                <tr>
                                    <td width="100px;">Nomor Bs</td>
                                    <td><input type="text" class="form-control" id="nobs" name="nobs" value="<?= $nobs; ?>"></td>
                                </tr>
                                <tr>
                                    <td width="85px;">No Kas/Bank</td>
                                    <td><input type="text" class="form-control" id="nokasbank" name="nokasbank" readonly></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="tgl" class="col-sm-5 col-form-label">Tanggal</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control tanggal" id="tgl" name="tgl" value="<?= date('d-m-Y'); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pemohon" class="col-sm-5 col-form-label">Pemohon</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="pemohon" name="pemohon">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jumlah" class="col-sm-5 col-form-label">Jumlah</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="jumlah" name="jumlah">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="keperluan" class="col-sm-5 col-form-label">Keperluan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="keperluan" name="keperluan">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bagian" class="col-sm-5 col-form-label">Bagian</label>
                                <div class="col-sm-6">
                                    <select  id="bagian" name="bagian" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($bagian as $d) : ?>
                                            <option value="<?= $d['idbagian']; ?>"><?= $d['kode_bagian'] . "-" . $d['nama_bagian']; ?></option>
<?php endforeach; ?>
                                    </select> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kodelokasi" class="col-sm-5 col-form-label">Kode lokasi</label>
                                <div class="col-sm-6">
                                    <select  id="kodelokasi" name="kodelokasi" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($lok as $loc) : ?>
                                            <option value="<?= $loc['id_departement'] ?>"><?= $loc['kode_loc'] . "-" . $loc['nama'] ?></option>
<?php endforeach; ?> 	
                                    </select> 
                                </div>
                            </div>


                        </div>
                        <div class="col-md-6">

                            <div class="form-group row">
                                <label for="kodeec" class="col-sm-5 col-form-label">Kode EC</label>
                                <div class="col-sm-6">
                                    <select  id="kodeec" name="kodeec" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($ec as $row) : ?>
                                            <option value="<?= $row['id_coa_ec'] ?>"><?= $row['account'] . "-" . $row['nama'] ?></option>
<?php endforeach; ?> 	
                                    </select> 
                                    </select> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kodena" class="col-sm-5 col-form-label">Kode NA</label>
                                <div class="col-sm-6">
                                    <select  id="kodena" name="kodena" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($na as $row) : ?>
                                            <option value="<?= $row['id_coa_na'] ?>"><?= $row['account'] . "-" . $row['nama'] ?></option>
<?php endforeach; ?> 	
                                    </select> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kodebisnis" class="col-sm-5 col-form-label">Kode Tipe bisnis</label>
                                <div class="col-sm-6">
                                    <select  id="kodebisnis" name="kodebisnis" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($bisnis as $bns) : ?>
                                            <option value="<?= $bns['idbisnis'] ?>"><?= $bns['kode_bisnis'] . "-" . $bns['nama_bisnis'] ?></option>
<?php endforeach; ?> 	
                                    </select> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl" class="col-sm-5 col-form-label">Tgl Realisasi</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control tanggal" id="tglrealisasi" name="tglrealisasi" value="<?= date('d-m-Y'); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="catatan" class="col-sm-5 col-form-label">catatan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="catatan" name="catatan">
                                </div>
                            </div>	
                        </div> 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade bd-editkantorpusat-modal-lg" tabindex="-1" role="dialog" aria-labelledby="editkantorpusatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editkantorpusatModalLabel">Edit BS Kantor Pusat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url('transaksi/ubahbspusat') ?>" method="post">
                    <div class="row">
                        <div class="col-md-4 ml-auto">
                            <input type="hidden" id=idbspusatedit name="idbspusatedit">
                            <table>
                                <tr>
                                    <td width="100px;">Nomor Bs</td>
                                    <td><input type="text" class="form-control" id="nobsedit" name="nobsedit" readonly></td>
                                </tr>
                                <tr>
                                    <td width="85px;">No Kas/Bank</td>
                                    <td><input type="text" class="form-control" id="nokasbankedit" name="nokasbankedit" readonly></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="tgl" class="col-sm-5 col-form-label">Tanggal</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control tanggal" id="tgledit" name="tgledit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pemohon" class="col-sm-5 col-form-label">Pemohon</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="pemohonedit" name="pemohonedit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jumlah" class="col-sm-5 col-form-label">Jumlah</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="jumlahedit" name="jumlahedit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="keperluan" class="col-sm-5 col-form-label">Keperluan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="keperluanedit" name="keperluanedit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bagian" class="col-sm-5 col-form-label">Bagian</label>
                                <div class="col-sm-6">
                                    <select  id="bagianedit" name="bagianedit" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($bagian as $d) : ?>
                                            <option value="<?= $d['idbagian']; ?>"><?= $d['kode_bagian'] . "-" . $d['nama_bagian']; ?></option>
<?php endforeach; ?>
                                    </select> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kodelokasi" class="col-sm-5 col-form-label">Kode lokasi</label>
                                <div class="col-sm-6">
                                    <select  id="kodelokasiedit" name="kodelokasiedit" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($lok as $row) : ?>
                                            <option value="<?= $row['id_departement'] ?>"><?= $row['kode_loc'] . "-" . $row['nama'] ?></option>
<?php endforeach ?> 
                                    </select> 
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group row">
                                <label for="kodeec" class="col-sm-5 col-form-label">Kode EC</label>
                                <div class="col-sm-6">
                                    <select  id="kodeecedit" name="kodeecedit" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($ec as $row) : ?>
                                            <option value="<?= $row['id_coa_ec'] ?>"><?= $row['account'] . "-" . $row['nama'] ?></option>
<?php endforeach; ?>  
                                    </select> 
                                    </select> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kodena" class="col-sm-5 col-form-label">Kode NA</label>
                                <div class="col-sm-6">
                                    <select  id="kodenaedit" name="kodenaedit" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($na as $row) : ?>
                                            <option value="<?= $row['id_coa_na'] ?>"><?= $row['account'] . "-" . $row['nama'] ?></option>
<?php endforeach; ?>  
                                    </select> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kodebisnis" class="col-sm-5 col-form-label">Kode Tipe bisnis</label>
                                <div class="col-sm-6">
                                    <select  id="kodebisnisedit" name="kodebisnisedit" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
                                        <option value="">Pilih</option>
                                        <?php foreach ($bisnis as $bns) : ?>
                                            <option value="<?= $bns['idbisnis'] ?>"><?= $bns['kode_bisnis'] . "-" . $bns['nama_bisnis'] ?></option>
<?php endforeach; ?>  
                                    </select> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl" class="col-sm-5 col-form-label">Tgl Realisasi</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control tanggal" id="tglrealisasiedit" name="tglrealisasiedit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="catatan" class="col-sm-5 col-form-label">catatan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="catatanedit" name="catatanedit">
                                </div>
                            </div>  
                        </div> 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>


    var jumlah = document.getElementById('jumlah');
    jumlah.addEventListener('keyup', function (e)
    {
        jumlah.value = formatRupiah(this.value);

    });

    var jumlahrealisasi = document.getElementById('jumlahrealisasi');
    jumlahrealisasi.addEventListener('keyup', function (e)
    {
        jumlahrealisasi.value = formatRupiah(this.value);

    });

    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
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
