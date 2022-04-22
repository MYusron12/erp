<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class=" row">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="nopr" class="col-sm-3 col-form-label">No PJ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nopr" name="nopr" value="<?= $jasa->no_pr_jasa; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglpr" class="col-sm-3 col-form-label">Tgl PJ</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control tanggal" id="tglpr" name="tglpr" value="<?= date('d-m-Y', strtotime($jasa->tgl_pr_jasa)); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglpr" class="col-sm-3 col-form-label">Bagian</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tglpr" name="tglpr" value="<?= $jasa->nama_bagian; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="namarequest" name="namarequest" value="<?= $jasa->name; ?>" readonly>
                        </div>
                    </div>

                    <div class=" form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" readonly><?= $jasa->remarks; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cprno" name="cprno" value="<?= $jasa->cpr_no; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="verifikasikode" name="verifikasikode" value="<?= $jasa->verifikasi_kode; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="coding" name="coding" value="<?= $jasa->coding; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coding" class="col-sm-3 col-form-label">Budget</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="budget" name="budget" value="<?= $jasa->budget_reserved; ?>" readonly>
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
                                <th scope="col" width="15%">Detail Permintaan</th>
                                <th scope="col" width="10%">Jumlah</th>
								<th scope="col" width="25%">Satuan</th>
                                <th scope="col" width="8%">Harga</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <?php if ($jasa->qty_2 != 0) {
                            $qty2 = $jasa->qty_2;
                        } else {
                            $qty2 = '';
                        } ?>
                        <?php if ($jasa->qty_3 != 0) {
                            $qty3 = $jasa->qty_3;
                        } else {
                            $qty3 = '';
                        } ?>
                        <?php if ($jasa->harga_2 != 0) {
                            $harga2 = number_format($jasa->harga_2);
                        } else {
                            $harga2 = '';
                        } ?>
                        <?php if ($jasa->harga_3 != 0) {
                            $harga3 = number_format($jasa->harga_3);
                        } else {
                            $harga3 = '';
                        } ?>
                        <?php if ($jasa->total_2 != 0) {
                            $total2 = number_format($jasa->total_2);
                        } else {
                            $total2 = '';
                        } ?>
                        <?php if ($jasa->total_3 != 0) {
                            $total3 = number_format($jasa->total_3);
                        } else {
                            $total3 = '';
                        } ?>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><?= $jasa->item_1; ?></td>
                                <td><?= $jasa->qty_1; ?></td>
                                <td><?= $jasa->satuan_nama1; ?></td>
                                <td><?= number_format($jasa->harga_1); ?></td>
                                <td><?= number_format($jasa->total_1); ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><?= $jasa->item_2; ?></td>
                                <td><?= $qty2; ?></td>
                                <td><?= $jasa->satuan_nama2; ?></td>
                                <td><?= $harga2; ?></td>
                                <td><?= $total2; ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><?= $jasa->item_3; ?></td>
                                <td><?= $qty3; ?></td>
                                <td><?= $jasa->satuan_nama3; ?></td>
                                <td><?= $harga3; ?></td>
                                <td><?= $total3; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="form-group row justify-content-end">
                        <label for="totalbarang" class="col-sm-2 col-form-label font-weight-bold">Grand Total</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control font-weight-bold" id="totalbarang" name="totalbarang" value="<?= number_format(($jasa->total_1) + ($jasa->total_2) + ($jasa->total_3)); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-6">
                    <a href="<?= base_url('purchasing/permintaanjasa') ?>" class="btn btn-danger"><i class="fas fa-exchange-alt"></i>Kembali</a>
                </div>
            </div>
        </div>

    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->