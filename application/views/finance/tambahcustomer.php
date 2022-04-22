<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('finance/tambahCustomer'); ?>" method="post">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">Nomer Customer</label>
                        <div class="col-lg-12">
                            <input type="text" name="no" id="no" class="form-control">
                        </div>
                        <br>
                        <label for="">Nama Customer</label>
                        <div class="col-lg-12">
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="">Nama PIC 1</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="pic1" id="pic1">
                        </div>
                        <br>
                        <label for="">Nama PIC 2</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="pic2" id="pic2">
                        </div>
                        <br>
                        <label for="">Nama PIC 3</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="pic3" id="pic3">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="">Email 1</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="email1" id="email1">
                        </div>
                        <br>
                        <label for="">Email 2</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="email2" id="email2">
                        </div>
                        <br>
                        <label for="">Email 3</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="email3" id="email3">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('finance/customer') ?>" class="btn btn-danger">Batal</a>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->