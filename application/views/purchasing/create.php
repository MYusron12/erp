<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('purchasing/create'); ?>" method="post" onsubmit="return validateForm()">
                <div class=" row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="nopr" class="col-sm-3 col-form-label">No PR</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nopr" name="nopr" value="<?= $nopr; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Tgl PR</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control tanggal" id="tglpr" name="tglpr" value="<?= date('d-m-Y'); ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                            <div class="col-sm-6">
                                <input name="" id="bagian" value="<?= $user['nama_bagian'];?>"class="form-control" readonly>
                                <input type="hidden"name="bagian" id="bagian" value="<?= $user['idbagian'];?>"class="form-control">
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                            <div class="col-sm-6">
                                   <input type="text"name="namarequest" id="bagian" value="<?= $user['name'];?>"class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" value="<?= set_value('keterangan'); ?>" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cprno" name="cprno" value="<?= set_value('cprno'); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="verifikasikode" name="verifikasikode" value="<?= set_value('verifikasikode'); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="coding" name="coding" value="<?= set_value('coding'); ?>" required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="codingjasa" class="col-sm-3 col-form-label">Budget Reserved</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="budget" name="budget"
                                    value="<?= set_value('budget'); ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <input type="button" class="btn btn-primary mb-3" id="add_data_barang" value="Add Barang">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100" id="data_table_barang">
                                <thead>
                                    <tr>
                                        <th scope="col" width="25%">Item Barang</th>
                                        <th scope="col" width="10%">Satuan</th>
                                        <th scope="col" width="8%">Qty</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="row_1">
                                        <td>
                                            <select id="barang_1" name="barang[]" class="form-control selectpicker" data-row-id="row_1" data-style="btn-primary" data-live-search="true" onchange="getItemBarang(1)">
                                                <option value="">Pilih</option>
                                                <?php foreach ($barang as $row) : ?>
                                                    <option value="<?= $row->id_barang ?>"><?= $row->kode_barang . '|' . $row->nama_barang; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control" id="satuan_1" name="satuan[]" readonly>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control" id="qty_1" name="qty[]" onkeyup="getTotal(1)">
                                        </td>

                                        <td>
                                            <input type="text" class="form-control" id="harga_1" name="harga[]" onkeyup="myfunctionHarga(1)">
                                        </td>

                                        <td>
                                            <input type=" text" class="form-control" id="total_1" name="total[]" readonly>
                                        </td>
                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow1('1')"><i class="fas fa-times"></i></button></td>
                                    </tr>
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
                                <input type="text" class="form-control font-weight-bold" id="grandtotalbarang" name="grandtotalbarang" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Simpan</button>
                        <a href="<?= base_url('purchasing/index') ?>" class="btn btn-danger"><i class="fas fa-times"></i>Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->