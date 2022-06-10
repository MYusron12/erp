<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <form action="" method="post" onsubmit="return validateForm()">
                <div class=" row">
                    <?php foreach($header as $row) : ?>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <input type="hidden" name="id_permintaan_jasa" id="" value="<?= $row->id_permintaan_jasa ?>">
                            <label for="nopr" class="col-sm-3 col-form-label">No PR Jasa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="no_pr_jasa" name="no_pr_jasa" value="<?= $row->no_pr_jasa ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Tgl PR Jasa</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control tanggal" id="tgl_pr_jasa" name="tgl_pr_jasa" value="<?= $row->tgl_pr_jasa ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                            <div class="col-sm-6">
                                <input name="bagian" id="bagian" value="<?= $row->nama_bagian; ?>" class="form-control" readonly>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                            <div class="col-sm-6">
                                   <input type="text" name="nama_request" id="nama_requests" value="<?= $row->nama_request; ?>"class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="remarks" name="remarks" rows="3" value="" required><?= $row->remarks ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cpr_no" name="cpr_no" value="<?= $row->cpr_no ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="verifikasi_kode" name="verifikasi_kode" value="<?= $row->verifikasi_kode ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="coding" name="coding" value="<?= $row->coding ?>">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="codingjasa" class="col-sm-3 col-form-label">Budget Reserved</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="budget_reserved" name="budget_reserved"
                                    value="<?= $row->budget_reserved ?>">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Ubah</button>
                        <a href="<?= base_url('purchasing/editPermintaanJasaNew/' . $row->id_permintaan_jasa) ?>" class="btn btn-danger"><i class="fas fa-times"></i>Selesai</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

