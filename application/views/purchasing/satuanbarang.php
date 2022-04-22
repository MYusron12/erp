<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-3">
            <a href="" class="btn btn-primary mb-3 tambahDataSatuan" data-toggle="modal" data-target="#newSatuanModal"><i class="fas fa-plus"></i>Tambah</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message') ?>

            <div class="table-responsive-lg">
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Satuan</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $total = 0;
                        foreach ($satuan as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row->nama_satuan; ?></td>
                                <td><?= $row->keterangan; ?></td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm ubahSatuan" data-toggle="modal" data-target="#newSatuanModal" data-id="<?= $row->id_satuan; ?>">Edit</a>
                                    <a href="<?= base_url('purchasing/hapussatuan/') . $row->id_satuan ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?..');">hapus</a>
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
<div class="modal fade" id="newSatuanModal" tabindex="-1" role="dialog" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSatuanModalLabel">Tambah Satuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('purchasing/satuanbarang') ?>" method="post">
                    <input type="hidden" name="idsatuan" id="idsatuan">
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan">
                    </div>
                    <div class="form-group">
                        <label for="satuan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>