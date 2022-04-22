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
                    <label for="nik" class="col-sm-2 col-form-label">No Work Order</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="no_pengerjaan" name="no_pengerjaan" value="<?= set_value('no_pengerjaan'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nik" class="col-sm-2 col-form-label">Tanggal Pemohon</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control tanggal" id="tgl_order" name="tgl_order" value="<?= set_value('tgl_order'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Dept</label>
                    <div class="col-sm-5">
                          <select class="form-control" name="id_bagian" id="id_departement">
                            <option value="">Pilih</option>
                            <?php foreach ($loc as $row) : ?>
                                <option value="<?= $row['idbagian']; ?>"><?= $row['nama_bagian'];?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Kendaraan</label>
                    <div class="col-sm-5">
                       
                               <select id="eccmb" class="selectpicker form-control" name="id_truck" data-style="btn-success" data-live-search="true">
                            <option value="">Pilih</option>
                            <?php foreach ($kendaraan as $row) : ?>
                                <option value="<?= $row->id_truck; ?>">No Body <?= $row->no_urut ?> <?= $row->no_polisi ?> <?= $row->merek ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
               
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Jenis Pengerjaan</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="deskripsi_peminta" name="deskripsi_peminta" value="<?= set_value('deskripsi_peminta'); ?>">
                    </div>
                </div>
               
        </div>
        
    </div>

    <div class="row mt-5">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Simpan</button>
            <a href="<?= base_url('maintenance/driver'); ?>" class="btn btn-danger float-center"><i class="fas fa-times"></i>Cancel</a>
        </div>
        </form>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->