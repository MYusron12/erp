
        <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
    <div class="col-lg-6">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
        <?php foreach($obatid as $row) : ?>
        <form action="<?= base_url('hrd/ubahMasterObat/' . $row->id); ?>" method="post">
            <div class="form-group">
            <input type="text" name="id" id="id" value="<?= $row->id ?>">
                <label for="kode_obat">Kode Obat</label>
                <input type="text" class="form-control" id="kode_obat" name="kode_obat" value="<?= $row->kode_obat ?>" required>
            </div>
            <div class="form-group">
                <label for="nama_obat">Nama Obat</label>
                <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?= $row->nama_obat ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
        <?php endforeach; ?>
    </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

     