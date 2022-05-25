<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class=" row">
                <div class="col-lg-6">
                    <input type="hidden" id="id_permintaan_jasa" name="id_permintaan_jasa" value="<?= $jasa['headerjasa']->id_permintaan_jasa; ?>">
                    <div class="form-group row">
                        <label for="nopr" class="col-sm-3 col-form-label">No PR</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nopr" name="nopr" value="<?= $jasa['headerjasa']->no_pr_jasa; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglpr" class="col-sm-3 col-form-label">Tgl PR</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control tanggal" id="tglpr" name="tglpr" value="<?= date('d-m-Y', strtotime($jasa['headerjasa']->tgl_pr_jasa)); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bagian" name="bagian" value="<?= $jasa['headerjasa']->nama_bagian; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="namarequest" name="namarequest" value="<?= $jasa['headerjasa']->nama_request; ?>" readonly>
                        </div>
                    </div>

                    <div class=" form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" readonly><?= $jasa['headerjasa']->remarks; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cprno" name="cprno" value="<?= $jasa['headerjasa']->cpr_no; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="verifikasikode" name="verifikasikode" value="<?= $jasa['headerjasa']->verifikasi_kode; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="coding" name="coding" value="<?= $jasa['headerjasa']->coding; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-lg-12 mt-3">
                        <!-- <input type="button" class="btn btn-primary mb-3" id="tambahjasa" value="Add Jasa"> -->
                        <div class="table-responsive">
                            <table class="table table-bordered w-100" id="tabel1">
                                <thead>
                                    <tr>
                                        <th width="3%">No</th>
                                        <th scope="col" width="25%">Detail Permintaan</th>
                                        <th width="20%">COA</th>
                                        <th scope="col" width="8%">Satuan</th>
                                        <th scope="col" width="5%">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach($jasa['detailjasa'] as $key => $value) : ?>
                                        <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $value->deskripsi_jasa ?></td>
                                        <td><?= $value->coa ?></td>
                                        <td><?= $value->nama_satuan ?></td>
                                        <td><?= number_format($value->qty) ?></td>
                                        <td><?= number_format($value->harga) ?></td>
                                        <td><?= number_format($value->total) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group row justify-content-end">
                        <label for="grandtotalbarang" class="col-sm-2 col-form-label font-weight-bold">Grand Total</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control font-weight-bold" id="grandtotalbarang" name="grandtotalbarang" value="<?= number_format($jasa['headerjasa']->grandtotal); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row mt-5 justify-content-center">
        <div class="col-lg-3">
            <p class="font-weight-bold">Apakah Anda Setuju ?..</p>
            <form action="<?= base_url('Approval/getSetujuPrJasa') ?>" method="post">
            <input type="hidden" name="id_permintaan_jasa" id="id_permintaan_jasa" value="<?= $jasa['headerjasa']->id_permintaan_jasa ?>">
            <input type="hidden" name="tanggal_approve" id="tanggal_approve" value="<?= $jasa['headerjasa']->tanggal_approve ?>">
            <input type="hidden" name="status" id="status" value="<?= $jasa['headerjasa']->status ?>">
                <button type="submit" class="btn btn-primary mr-3">Ya, Setuju</button>
            </form>
            <form action="<?= base_url('Approval/getTidakSetujuPrJasa') ?>" method="post">
            <input type="hidden" name="id_permintaan_jasa" id="id_permintaan_jasa" value="<?= $jasa['headerjasa']->id_permintaan_jasa ?>">
            <input type="hidden" name="tanggal_approve" id="tanggal_approve" value="<?= $jasa['headerjasa']->tanggal_approve ?>">
            <input type="hidden" name="status" id="status" value="<?= $jasa['headerjasa']->status ?>">
                <button type="submit" class="btn btn-danger mr-3">Tidak Setuju</button>
            </form>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6">
            <a href="<?= base_url('approval/listjsnew') ?>" class="btn btn-success"><i class="fas fa-exchange-alt"></i>Kembali</a>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->