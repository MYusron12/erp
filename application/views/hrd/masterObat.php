<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-3">
            <a href="<?= base_url('hrd/tambahMasterObat/') ?>" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus"></i>Tambah</a>
        </div>
    </div>
    <form action="<?= base_url('hrd/tambahMasterObat'); ?>" method="post">
        <div class="row">
        <?php foreach($getallobat as $row) ?>
        <?php $total = $row->total; ?>
            <div class="col-3">
                <div class="form-group">
                    <label for="kode_obat">Kode Obat</label>
                    <input type="text" class="form-control" id="kode_obat" name="kode_obat" required readonly value="hrmdcn00<?= $total; ?>">
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" autofocus required>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <br>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <?php if (validation_errors() ) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" cellspacing="0" id="dataTable">
                    <thead>
                    <tr>
                        <th scope="col" width="5%">No</th>
                        <th scope="col" width="20%">Kode Obat</th>
                        <th scope="col" width="25%">Nama Obat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($masterobat as $row) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row->kode_obat; ?></td>
                            <td><?= $row->nama_obat; ?></td>
                            <td>
                                <a href="<?= base_url('hrd/ubahMasterObat/' . $row->id) ?>" class="btn btn-success btn-sm"><i class="far fa-edit">Edit</i></a>
                                <a href="<?= base_url('hrd/hapusMasterObat/') .$row->id; ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash">Hapus</i></a>
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
