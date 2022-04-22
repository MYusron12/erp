<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="vnopo" class="col-sm-3 col-form-label">No PO</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="vnopo" name="vnopo" value="<?= $pembelian['headerpembelian']->no_po; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="vtglpo" class="col-sm-3 col-form-label">Tgl PO</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control tanggal" id="vtglpo" name="vtglpo" value="<?= date('d-m-Y', strtotime($pembelian['headerpembelian']->tgl_po)); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vnomorper" class="col-sm-3 col-form-label">No PR</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="vnomorper" name="vnomorper" value="<?= $pembelian['headerpembelian']->no_permintaan; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglpr" class="col-sm-3 col-form-label">Tgl PR</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tglpr" name="tglpr" autocomplete="off" value="<?= date('d-m-Y', strtotime($pembelian['headerpembelian']->tanggal_minta)); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                        <div class="col-sm-6">
                            <input type="text" id="bagian" name="bagian" class="form-control" value="<?= $pembelian['headerpembelian']->nama_bagian; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="namarequest" name="namarequest" value="<?= $pembelian['headerpembelian']->nama_request; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" readonly><?= $pembelian['headerpembelian']->keterangan; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cprno" name="cprno" value="<?= $pembelian['headerpembelian']->cpr_no; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="verifikasikode" name="verifikasikode" value="<?= $pembelian['headerpembelian']->verifikasi_kode; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="coding" name="coding" value="<?= $pembelian['headerpembelian']->coding; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglaproved" class="col-sm-3 col-form-label">Tanggal Aproved</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="tglaproved" name="tglaproved" value="<?= date('d-m-Y', strtotime($pembelian['headerpembelian']->tanggal_approve)); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive mt-5">
                        <table class="table table-bordered table-hover w-100" id="dataTable12">
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
                                $total = 0;
                                foreach ($pembelian['detailpembelian'] as $key => $value) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $value->kode_barang; ?></td>
                                        <td><?= $value->nama_barang; ?></td>
                                        <td><?= $value->nama_satuan; ?></td>
                                        <td><?= $value->qty; ?></td>
                                        <td><?= $value->harga; ?></td>
                                        <td><?= number_format($value->qty * $value->harga, 2, ",", "."); ?></td>
                                    </tr>
                                    <?php $total = $total + ($value->qty * $value->harga);  ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="form-group row justify-content-end">
                        <label for="totalbarang" class="col-sm-2 col-form-label font-weight-bold">Grand Total</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control font-weight-bold" id="totalbarang" name="totalbarang" value="<?= number_format($total, 2, ",", "."); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="suplierorder" class="col-sm-2 col-form-label">Suplier</label>
                        <div class="col-sm-6">
                            <select name="suplierorder" id="suplierorder" class="form-control">
                                <option value="">Pilih</option>
                                <?php foreach ($suplier as $row) : ?>
                                    <?php if ($row->id_suplier == $pembelian['headerpembelian']->id_suplier) : ?>
                                        <option value="<?= $row->id_suplier; ?>" selected><?= $row->suplier; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $row->id_suplier; ?>"><?= $row->suplier; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ppnpersen" class="col-sm-2 col-form-label">PPN %</label>
                        <div class="col-sm-6">
                            <select name="ppnpersen" id="ppnpersen" class="form-control">
                                <option value="">Pilih</option>
                                <?php foreach ($ppn as $row) : ?>
                                    <?php if ($row['nppn'] == $pembelian['headerpembelian']->ppnpersen) : ?>
                                        <option value="<?= $row['nppn'] ?>" selected><?= $row['persen'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $row['nppn'] ?>"><?= $row['persen'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ppnrupiah" class="col-sm-2 col-form-label">PPN Rp</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="ppnrupiah" name="ppnrupiah" value="<?= number_format($pembelian['headerpembelian']->ppnrupiah, 2, ",", "."); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="pphpersen" class="col-sm-2 col-form-label">PPH %</label>
                        <div class="col-sm-6">
                            <select name="pphpersen" id="pphpersen" class="form-control">
                                <option value="">Pilih</option>
                                <?php foreach ($pph as $row) : ?>
                                    <?php if ($row['npph'] == $pembelian['headerpembelian']->pphpersen) : ?>
                                        <option value="<?= $row['npph']; ?>" selected><?= $row['persen']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $row['npph']; ?>"><?= $row['persen']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pphrupiah" class="col-sm-2 col-form-label">PPH Rp</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="pphrupiah" name="pphrupiah" value="<?= number_format($pembelian['headerpembelian']->pphrupiah, 2, ",", "."); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="totalnet" class="col-sm-2 col-form-label">Total Net</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="totalnet" name="totalnet" value="<?= number_format($pembelian['headerpembelian']->jumlah, 2, ",", "."); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6">
                    <a href="<?= base_url('purchasing/pembelianorder') ?>" class="btn btn-danger"><i class="fas fa-exchange-alt"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->