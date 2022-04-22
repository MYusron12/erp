<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class=" row">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="nopr" class="col-sm-3 col-form-label">No PR</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nopr" name="nopr" value="<?= $permintaan['headerpermintaan']->no_permintaan; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglpr" class="col-sm-3 col-form-label">Tgl PR</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control tanggal" id="tglpr" name="tglpr" value="<?= date('d-m-Y', strtotime($permintaan['headerpermintaan']->tanggal_minta)); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bagian" name="bagian" value="<?= $permintaan['headerpermintaan']->nama_bagian; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="namarequest" name="namarequest" value="<?= $permintaan['headerpermintaan']->nama_request; ?>" readonly>
                        </div>
                    </div>

                    <div class=" form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" readonly><?= $permintaan['headerpermintaan']->keterangan; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cprno" name="cprno" value="<?= $permintaan['headerpermintaan']->cpr_no; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="verifikasikode" name="verifikasikode" value="<?= $permintaan['headerpermintaan']->verifikasi_kode; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="coding" name="coding" value="<?= $permintaan['headerpermintaan']->coding; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coding" class="col-sm-3 col-form-label">Budget Reserved</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="budget" name="budget" value="<?= $permintaan['headerpermintaan']->budget; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12 mt-3">
                    <table class="table table-bordered w-100">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col" width="8%">No</th>
                                <th scope="col" width="15%">Kode Barang</th>
                                <th scope="col" width="25%">Nama Barang</th>
                                <th scope="col" width="10%">Satuan</th>
                                <th scope="col" width="8%">Qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($permintaan['detailpermintaan'] as $key => $value) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $value->kode_barang; ?></td>
                                    <td><?= $value->nama_barang; ?></td>
                                    <td><?= $value->nama_satuan; ?></td>
                                    <td><?= $value->qty; ?></td>
                                    <td><?= number_format($value->harga); ?></td>
                                    <td><?= number_format($value->total); ?></td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	
	<div class="row mt-4">
        <div class="col-lg-12">
            <div class="form-group row justify-content-end">
                <label for="totalbarang" class="col-sm-2 col-form-label font-weight-bold">Grand Total</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control font-weight-bold" id="totalbarang" name="totalbarang" value="Rp. <?= number_format($permintaan['headerpermintaan']->grandtotal); ?>" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6">
            <a href="<?= base_url('purchasing/index') ?>" class="btn btn-danger"><i class="fas fa-exchange-alt"></i>Kembali</a>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 