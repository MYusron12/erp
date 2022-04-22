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
            <?= $this->session->flashdata('message') ?>  
            <form action="" method="post">
                <div class="form-group row">
                    <input type="hidden" id="id_permintaan_pengerjaan" name="idtruck" value="<?= $wo->id_truck ?>">
                    <label for="nik" class="col-sm-2 col-form-label">KM Kendaraan</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="" name="" value="<?= $wo->km_pemakaian; ?>" readonly>
                    </div>
                   
                </div>
                   <div class="form-group row">
                    <input type="hidden" id="id_permintaan_pengerjaan" name="idtruck" value="<?= $wo->id_truck ?>">
                    <label for="nik" class="col-sm-2 col-form-label">KM Kendaraan Terakhir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="" name="km_akhir" value="<?= number_format($wo->km_akumulasi); ?>" readonly>
                    </div>
                   
                </div>
                <div class="form-group row">
                  
                    <label for="nik" class="col-sm-2 col-form-label">Km Service di WO</label>
                   <div class="col-sm-5">
                        <input type="text" class="form-control" id="no_pengerjaan" name="km_pemakaian" value="<?= $wo->km_pemakaian; ?>">
                    </div>
                </div>
                
                 <div class="form-group row">
                  
                    <label for="nik" class="col-sm-2 col-form-label">Tanggal Service</label>
                   <div class="col-sm-5">
                        <input type="text" class="form-control tanggal" id="tgl_service" name="tgl_service" value="">
                    </div>
                </div>
                <div class="form-group row">
                  
                    <label for="nik" class="col-sm-2 col-form-label">Tanggal Pergantian suku cadang</label>
                   <div class="col-sm-5">
                        <input type="text" class="form-control tanggal" id="tgl_service" name="tgl_service_suku" value="">
                    </div>
                </div>
                
        
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group row mt-5">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Ubah</button>
                    <a href="<?= base_url('adminops/totservice'); ?>" class="btn btn-danger"><i class="fas fa-times"></i>Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->