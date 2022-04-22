<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-3">
            <a href="" class="btn btn-primary mb-3 tambahDataBarang" data-toggle="modal" data-target="#newBarangModal"><i class="fas fa-plus"></i>Tambah</a>
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
                <table class="table table-hover w-100" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $total = 0;
                        foreach ($barang as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row->kode_barang; ?></td>
                                <td><?= $row->nama_barang; ?></td>
                                <td><?= $row->nama_categori; ?></td>
                                <td><?= $row->harga; ?></td>
                                <td><?= $row->nama_satuan; ?></td>


                                <td>
                                    <a href="" class="btn btn-success btn-sm ubahBarang" data-toggle="modal" data-target="#newBarangModal" data-id="<?= $row->id_barang; ?>">Edit</a>
                                    <a href="<?= base_url('purchasing/hapusbarang/') . $row->id_barang ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?..');">hapus</a>
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
<div class="modal fade" id="newBarangModal" tabindex="-1" role="dialog" aria-labelledby="newBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBarangModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('purchasing/barang') ?>" method="post">
                    <input type="hidden" id="idbarang" name="idbarang">
                    <div class="form-group row">
                        <label for="kodebarang" class="col-sm-3 col-form-label">Kode Barang</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="kodebarang" name="kodebarang" value="<?= $id_barang; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="namabarang" class="col-sm-3 col-form-label">Nama Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="namabarang" name="namabarang">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">Pilih</option>
                                <?php foreach ($kategori as $row) : ?>
                                    <option value="<?= $row->id_categori; ?>"><?= $row->nama_categori; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="namabarang" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="harga" name="harga">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                        <div class="col-sm-9">
                            <select name="satuan" id="satuan" class="form-control">
                                <option value="">Pilih</option>
                                <?php foreach ($satuan as $row) : ?>
                                    <option value="<?= $row->id_satuan; ?>"><?= $row->nama_satuan; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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