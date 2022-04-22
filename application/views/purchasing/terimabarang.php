<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="notranstrm" class="col-sm-4 col-form-label">No Terima Barang</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="notransterima" name="notransterima" value="<?= $noterima;  ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglterima" class="col-sm-4 col-form-label">Tanggal Terima</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control tanggal" id="tglterima" name="tglterima" value="<?= date('d-m-Y'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nopoterima" class="col-sm-4 col-form-label">No Po</label>
                        <div class="col-sm-6">
                            <select name="nopoterima" id="nopoterima" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" onchange="getdatapermintaan();">
                                <option value="">Pilih</option>
                                <?php foreach ($nopo as $row) : ?>
                                    <option value="<?= $row->id_pembelian; ?>"><?= $row->no_po; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="noperterima" class="col-sm-4 col-form-label">No Permintaan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="noperterima" name="noperterima" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keteranganterima" class="col-sm-4 col-form-label">keterangan</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="keteranganterima" name="keteranganterima" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="dataTable13">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="10%">Kode Barang</th>
                                    <th scope="col" width="20%">Nama Barang</th>
                                    <th scope="col" width="5%">Satuan</th>
                                    <th scope="col" width="10%">Qty Order</th>
                                    <th scope="col" width="10%">Qty Terima</th>
                                    <th scope="col" width="10%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6">
                    <button id="simpanterimabarang" class="btn btn-primary" onclick="simpanterimabarang();"><i class="far fa-save"></i>Simpan</button>
                    <a href="<?= base_url('purchasing/penerimaanbarang') ?>" class="btn btn-danger"><i class="fas fa-exchange-alt"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->