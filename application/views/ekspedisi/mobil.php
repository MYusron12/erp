<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-3 mb-3">
            <a href="" class="btn btn-primary tambahDataMobil" data-toggle="modal" data-target="#tambahMobilModal"><i class="fas fa-plus"></i>Tambah</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if (validation_errors()) : ?>
                <div class=" alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message') ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Merek Mobil</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Tgl Pembelian</th>
                            <th scope="col">Tgl Pakai</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($mobil as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row->merek; ?></td>
                                <td><?= $row->tipemobil;  ?></td>
                                <td><?= $row->jenismobil;  ?></td>
                                <td><?= $row->tglbeli;  ?></td>
                                <td><?= $row->tglpakai;  ?></td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm tampilUbahMobil" data-toggle="modal" data-target="#tambahMobilModal" data-id="<?= $row->idmobil; ?>">Edit</a>
                                    <a href="<?= base_url('ekspedisi/hapusmobil/') . $row->idmobil ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?..');">Delete</a>
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
<div class="modal fade" id="tambahMobilModal" tabindex="-1" role="dialog" aria-labelledby="tambahMobilModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMobilModaLabel">Tambah Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" id="idmobil" name="idmobil">
                    <div class="form-group">
                        <label for="merekmobil">Merek Mobil</label>
                        <input type="text" class="form-control" id="merekmobil" name="merekmobil" placeholder="Merek Mobil" required>
                    </div>

                    <div class="form-group">
                        <label for="tipemobil">Tipe Mobil</label>
                        <select class="form-control selectpicker" name="tipemobil" id="tipemobil" data-style="btn-primary" data-live-search="true" required>
                            <option value="">Pilih</option>
                            <?php foreach ($tipemobil as $row) : ?>
                                <option value="<?= $row->idtipemobil ?>"><?= $row->tipemobil ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jenismobil">Jenis Mobil</label>
                        <select class="form-control selectpicker" name="jenismobil" id="jenismobil" data-style="btn-primary" data-live-search="true" required>
                            <option value="">Pilih</option>
                            <?php foreach ($jenismobil as $row) : ?>
                                <option value="<?= $row->idjenismobil ?>"><?= $row->jenismobil ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tglpembelian">Tanggal Pembelian</label>
                        <input type="text" class="form-control tanggal" id="tglpembelian" name="tglpembelian" placeholder="Tanggal Pembelian" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="tglpenggunaan">Tanggal Penggunaan</label>
                        <input type="text" class="form-control tanggal" id="tglpenggunaan" name="tglpenggunaan" placeholder="Tanggal penggunaan" required autocomplete="off">
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