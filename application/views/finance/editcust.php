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
                    <input type="hidden" id="id_permintaan_pengerjaan" name="id_customer" value="<?= $customer->id_customer ?>">
                    <label for="nik" class="col-sm-2 col-form-label">No Customer</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="no_pengerjaan" name="no" value="<?= $customer->no; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="tgl_order" name="nama" value="<?= $customer->nama; ?>">
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Top</label>
                   <div class="col-sm-5">
                        <input type="text" class="form-control" id="tgl_order" name="top" value="<?= $customer->top; ?>">
                    </div>
                </div>
                 
                <div class="form-group row">
                    <label for="pendidikan" class="col-sm-2 col-form-label">pic1</label>
                    
                    <div class="col-sm-5">
                      
                          <input type="text" class="form-control" id="tgl_order" name="pic1" value="<?= $customer->pic1; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pendidikan" class="col-sm-2 col-form-label">pic2</label>
                    
                    <div class="col-sm-5">
                      
                          <input type="text" class="form-control" id="tgl_order" name="pic2" value="<?= $customer->pic2; ?>">
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="pendidikan" class="col-sm-2 col-form-label">pic3</label>
                    
                    <div class="col-sm-5">
                      
                          <input type="text" class="form-control" id="tgl_order" name="pic3" value="<?= $customer->pic3; ?>">
                    </div>
                </div>
                
                
                 <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">email1</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="deskripsi_peminta" name="email1" value="<?= $customer->email1; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">email2</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="deskripsi_peminta" name="email2" value="<?= $customer->email2; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">email3</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="deskripsi_peminta" name="email3" value="<?= $customer->email3; ?>">
                    </div>
                </div>
                
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group row mt-5">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Ubah</button>
                    <a href="<?= base_url('finance/adminfinacc'); ?>" class="btn btn-danger"><i class="fas fa-times"></i>Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->