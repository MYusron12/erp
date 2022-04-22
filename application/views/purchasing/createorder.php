<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="nopo" class="col-sm-3 col-form-label">No PO</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nopo" name="nopo" value="<?= $nopo; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nopo" class="col-sm-3 col-form-label">Tgl PO</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control tanggal" id="tglpo" name="tglpo" value="<?= date('d-m-Y'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nopo" class="col-sm-3 col-form-label">No PR</label>
                        <div class="col-sm-6">
                            <select name="nomorper" id="nomorper" class="form-control">
                                <option value="">Pilih</option>
                                <?php foreach ($noper as $row) : ?>
                                    <option value="<?= $row->id_permintaan; ?>"><?= $row->no_permintaan; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglpr" class="col-sm-3 col-form-label">Tgl PR</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tglpr" name="tglpr" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                        <div class="col-sm-6">
                            <input type="text" id="bagian" name="bagian" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="namarequest" name="namarequest" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cprno" name="cprno" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="verifikasikode" name="verifikasikode" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="coding" name="coding" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglaproved" class="col-sm-3 col-form-label">Tanggal Aproved</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="tglaproved" name="tglaproved" readonly>
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
                            <tbody id="tablecreateorder">

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
                            <input type="text" class="form-control font-weight-bold" id="totalbarang" name="totalbarang" value="0" readonly>
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
                                    <option value="<?= $row->id_suplier; ?>"><?= $row->suplier; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ppnpersen" class="col-sm-2 col-form-label">PPN %</label>
                        <div class="col-sm-6">
                            <select name="ppnpersen" id="ppnpersen" class="form-control" onchange="ppn();">
                                <option value="">Pilih</option>
                                <?php foreach ($ppn as $row) : ?>
                                    <option value="<?= $row['nppn'] ?>"><?= $row['persen'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ppnrupiah" class="col-sm-2 col-form-label">PPN Rp</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="ppnrupiah" name="ppnrupiah" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="pphpersen" class="col-sm-2 col-form-label">PPH %</label>
                        <div class="col-sm-6">
                            <select name="pphpersen" id="pphpersen" class="form-control" onchange="pph();">
                                <option value="">Pilih</option>
                                <?php foreach ($pph as $row) : ?>
                                    <option value="<?= $row['npph']; ?>"><?= $row['persen']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pphrupiah" class="col-sm-2 col-form-label">PPH Rp</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="pphrupiah" name="pphrupiah" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="totalnet" class="col-sm-2 col-form-label">Total</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="totalnet" name="totalnet" value="0" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6">
                    <button id="simpanorder" class="btn btn-primary"><i class="far fa-save"></i>Simpan</button>
                    <a href="<?= base_url('purchasing/pembelianorder') ?>" class="btn btn-danger"><i class="fas fa-exchange-alt"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->