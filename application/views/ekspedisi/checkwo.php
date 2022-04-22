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
                    <input type="hidden" id="id_permintaan_pengerjaan" name="id_permintaan_pengerjaan" value="<?= $wo->id_permintaan_pengerjaan ?>">
                    <label for="nik" class="col-sm-2 col-form-label">No Work Order</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="no_pengerjaan" name="no_pengerjaan" value="<?= $wo->no_pengerjaan; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Tanggal Pemohon</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="tgl_order" name="tgl_order" value="<?= $wo->tgl_order; ?>" readonly>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Dept</label>
                    <div class="col-sm-5">
                          <select class="form-control" name="id_bagian" id="id_departement" readonly>
                              <option value="">Pilih</option>
                            <?php foreach ($loc as $row) : ?>
                          
                          
                                 <?php if ($row['idbagian'] == $wo->id_bagian) : ?>
                                    <option value="<?= $wo->id_bagian; ?>" selected><?= $wo->nama_bagian; ?></option>
                                <?php else : ?>
                                     <option value="<?= $row['idbagian']; ?>"><?= $row['nama_bagian'];?></option>
                                <?php endif; ?>
                                  <?php endforeach ?>
                        </select>
                    </div>
                </div>
               
                 
                 <div class="form-group row">
                    <label for="pendidikan" class="col-sm-2 col-form-label">Kendaraan</label>
                    <input type="hidden" class="form-control tanggal" id="" name="id_truck" value="<?= $wo->id_truck; ?>">
                    
                    <div class="col-sm-5">
                      
                        <input type="input" class="form-control" id="tgl_order" name="" value="No Body <?= $wo->no_urut; ?> <?= $wo->no_polisi ?>" readonly/>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Jenis Pengerjaan</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="deskripsi_peminta" name="deskripsi_peminta" value="<?= $wo->deskripsi_peminta; ?>" readonly>
                    </div>
                </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <label for="tglmasuk" class=" col-sm-3 col-form-label">Tgl Check</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control tanggal" id="tanggal_cek" name="tanggal_cek"  autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="sim1" class="col-sm-3 col-form-label">pic_cek</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="pic_cek" name="pic_cek">
                </div>
            </div>
            <div class="form-group row">
                <label for="masaberlaku1" class=" col-sm-3 col-form-label">Komponen yang di ganti</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="deskripsi_perkerja" name="deskripsi_komponen"  autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="masaberlaku1" class=" col-sm-3 col-form-label">deskripsi_perkerja</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="deskripsi_perkerja" name="deskripsi_perkerja"  autocomplete="off">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="masaberlaku1" class=" col-sm-3 col-form-label">Categori</label>
                <div class="col-sm-5">
                    <select class="form-control" name="categori" id="pendidikan">
                            <option value="">Pilih</option>
                            <?php foreach ($categori as $row) : ?>
                                <?php if ($wo->categori == $row) : ?>
                                    <option value="<?= $row; ?>" selected><?= $row; ?></option>
                                <?php else : ?>
                                    <option value="<?= $row; ?>"><?= $row; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                </div>
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group row mt-5">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Ubah</button>
                    <a href="<?= base_url('ekspedisi/workorder'); ?>" class="btn btn-danger"><i class="fas fa-times"></i>Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->