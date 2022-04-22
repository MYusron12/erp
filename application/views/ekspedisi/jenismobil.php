<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-3 mb-3">
            <a href="" class="btn btn-primary tambahDatajenisMobil" data-toggle="modal" data-target="#tambahJenisMobilModal"><i class="fas fa-plus"></i>Tambah</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message') ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jenis Mobil</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($jenismobil as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row->jenismobil; ?></td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm tampilUbahJenisMobil" data-toggle="modal" data-target="#tambahJenisMobilModal" data-id="<?= $row->idjenismobil; ?>">Edit</a>
                                    <a href="<?= base_url('ekspedisi/hapusjenismobil/') . $row->idjenismobil ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?..');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="tambahJenisMobilModal" tabindex="-1" role="dialog" aria-labelledby="tambahJenisMobilModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahJenisMobilModaLabel">Tambah Jenis Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="post">
                    <input type="hidden" id="idjenismobil" name="idjenismobil">
                    <div class="form-group">
                        <input type="text" class="form-control" id="jenismobil" name="jenismobil" placeholder="Jenis Mobil">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>