<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-3 mb-3">
            <a href="" class="btn btn-primary tambahDatatipeMobil" data-toggle="modal" data-target="#tambahTipeMobilModal"><i class="fas fa-plus"></i>Tambah</a>
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
                            <th scope="col">Tipe Mobil</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($tipemobil as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row->tipemobil; ?></td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm tampilUbahTipeMobil" data-toggle="modal" data-target="#tambahTipeMobilModal" data-id="<?= $row->idtipemobil; ?>">Edit</a>
                                    <a href="<?= base_url('ekspedisi/hapustipemobil/') . $row->idtipemobil ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?..');">Delete</a>
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
<div class="modal fade" id="tambahTipeMobilModal" tabindex="-1" role="dialog" aria-labelledby="tambahTipeMobilModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTipeMobilModaLabel">Tambah Tipe Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="post">
                    <input type="hidden" id="idtipemobil" name="idtipemobil">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tipemobil" name="tipemobil" placeholder="Tipe Mobil">
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