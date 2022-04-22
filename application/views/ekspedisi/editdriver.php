<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group row">
                    <input type="hidden" id="iddriver" name="iddriver" value="<?= $driver->id_driver ?>">
                    <label for="nik" class="col-sm-2 col-form-label">Nik</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $driver->nik; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $driver->nama; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgllahir" class="col-sm-2 col-form-label">Tgl lahir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control tanggal" id="tgllahir" name="tgllahir" value="<?= date('d-m-Y', strtotime($driver->tgl_lahir)); ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $driver->alamat ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="notelp" class="col-sm-2 col-form-label">No Telp</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="notelp" name="notelp" value="<?= $driver->no_tlp ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="pendidikan" id="pendidikan">
                            <option value="">Pilih</option>
                            <?php foreach ($pendidikan as $row) : ?>
                                <?php if ($driver->pendidikan == $row) : ?>
                                    <option value="<?= $row; ?>" selected><?= $row; ?></option>
                                <?php else : ?>
                                    <option value="<?= $row; ?>"><?= $row; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <label for="tglmasuk" class=" col-sm-3 col-form-label">Tgl masuk</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control tanggal" id="tglmasuk" name="tglmasuk" value="<?= date('d-m-Y', strtotime($driver->tgl_masuk)); ?>" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="sim1" class="col-sm-3 col-form-label">Sim 1</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="sim1" name="sim1" value="<?= $driver->sim1; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="masaberlaku1" class=" col-sm-3 col-form-label">Masaberlaku1</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control tanggal" id="masaberlaku1" name="masaberlaku1" value="<?= date('d-m-Y', strtotime($driver->masa_berlaku1)); ?>" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="sim2" class="col-sm-3 col-form-label">Sim 2</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="sim2" name="sim2" value="<?= $driver->sim2; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="masaberlaku2" class=" col-sm-3 col-form-label">Masa Berlaku 2</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control tanggal" id="masaberlaku2" name="masaberlaku2" value="<?= $driver->masa_berlaku2 ?>" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="masaberlaku2" class=" col-sm-3 col-form-label">No Ijasah</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="no_ijasah" name="no_ijasah" value="<?= $driver->no_ijasah ?>" autocomplete="off">
                </div>
            </div>
            <div class="form-group row mt-4">
                <div class="form-check">
                    <input type="checkbox" value="1" name="aktif" id="aktif" checked>
                    <label class="form-check-label" for="aktif">
                        Aktif ?..
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group row mt-5">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Ubah</button>
                    <a href="<?= base_url('ekspedisi/driver'); ?>" class="btn btn-danger"><i class="fas fa-times"></i>Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->