<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header">Detail BBM</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="nomo" class="col-sm-3 col-form-label">Nomor Mobil</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nomo" name="nomo" value="<?= $detil_bbm->no_polisi; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nobo" class="col-sm-3 col-form-label">Nomor Body</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nobo" name="nobo" value="<?= $detil_bbm->no_urut; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supir" class="col-sm-3 col-form-label">Nama Supir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="supir" name="supir" value="<?= $detil_bbm->nama ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="helper" class="col-sm-3 col-form-label">Nama Helper</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="helper" name="helper" value="<?= $detil_bbm->NAMA_HELPER ?>" readonly>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="brgkt" class="col-sm-3 col-form-label">Tgl Berangkat</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="brgkt" name="brgkt" value="<?= date('d-m-Y', strtotime($detil_bbm->tanggal)); ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group row">
                                <label for="kmawal" class="col-sm-3 col-form-label">KM Awal</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="kmawal" name="kmawal" value="<?= $detil_bbm->km_awal ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kmakhir" class="col-sm-3 col-form-label">KM Akhir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="kmakhir" name="kmakhir" value="<?= $detil_bbm->km_akhir ?>" readonly>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jarak" class="col-sm-3 col-form-label">Jarak</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="jarak" name="jarak" value="<?= $detil_bbm->jarak ?>" readonly>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlahkonsumsi" class="col-sm-3 col-form-label">Jumlah Konsumsi</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control tanggal" id="jumlahkonsumsi" name="jumlahkonsumsi" value="<?= $detil_bbm->jml_liter ?>" readonly> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hargaliter" class="col-sm-3 col-form-label">Harga BBM Per Liter</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="hargaliter" name="hargaliter" value="<?= $detil_bbm->bbmharga ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="totalharga" class="col-sm-3 col-form-label">Total Harga BBM</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="totalharga" name="totalharga" value="<?= $detil_bbm->ttlbbm ?>" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a href="<?= base_url('ekspedisi/bbm'); ?>" class="btn btn-primary btn-sm mt-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->