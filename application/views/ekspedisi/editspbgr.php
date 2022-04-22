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
                    <input type="hidden" id="id_permintaan_pengerjaan" name="idtruck" value="<?= $wo->id_truck ?>">
                    <label for="nik" class="col-sm-2 col-form-label">Tanggal SIPA BGR Saat ini</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control tanggal" id="no_pengerjaan" name="" value="<?= $wo->sipa_bekasi; ?>" readonly>
                    </div>
                </div>
                 <div class="form-group row">
                  
                    <label for="nik" class="col-sm-2 col-form-label">Reset Tanggal SIPA BGR</label>
                   <div class="col-sm-5">
                        <input type="text" class="form-control tanggal" id="sipa_bogor" name="sipa_bogor">
                    </div>
                </div>
                
        
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group row mt-5">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Ubah</button>
                    <a href="<?= base_url('adminops/totspbgr'); ?>" class="btn btn-danger"><i class="fas fa-times"></i>Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->