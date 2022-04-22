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
            <form action="<?= base_url('ekspedisi/detailaktivitas'); ?>" method="post">
                
                
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">No Polisi</label>
                    <div class="col-sm-5">
                          <select class="form-control select2-chosen" name="nopol" id="id_departement">
                            <option value="">No Polisi</option>
                            <?php foreach ($sj_hari_ini as $row) : ?>
                                <option value="<?= $row['AUTH_NBR']; ?>"><?= $row['AUTH_NBR'];?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
        </div>
        
    </div>

    <div class="row mt-5">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Simpan</button>
            <a href="<?= base_url('ekspedisi/driver'); ?>" class="btn btn-danger float-center"><i class="fas fa-times"></i>Cancel</a>
        </div>
        </form>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main 