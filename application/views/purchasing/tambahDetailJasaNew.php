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

            <!-- <form action="<?= base_url('purchasing/addrow') ?>" method="post" onsubmit="return validateForm()"> -->
                <div class=" row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="nopr" class="col-sm-3 col-form-label">No PR Jasa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="no_pr_jasa" name="no_pr_jasa" value="<?= $jasa['headerjasa']->no_pr_jasa ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Tgl PR Jasa</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control tanggal" id="tgl_pr_jasa" name="tgl_pr_jasa" value="<?= $jasa['headerjasa']->tgl_pr_jasa ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                            <div class="col-sm-6">
                            <input type="hidden"name="bagian_id" id="bagian_id" value="<?= $jasa['headerjasa']->bagian_id;?>"class="form-control">
                                <input name="bagian" id="bagian" value="<?= $jasa['headerjasa']->nama_bagian; ?>" class="form-control" readonly>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                            <div class="col-sm-6">
                                   <input type="text" name="nama_request" id="nama_requests" value="<?=  $jasa['headerjasa']->nama_request; ?>"class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="remarks" name="remarks" rows="3" value="" required><?=  $jasa['headerjasa']->remarks ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cpr_no" name="cpr_no" value="<?=  $jasa['headerjasa']->cpr_no ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="verifikasi_kode" name="verifikasi_kode" value="<?=  $jasa['headerjasa']->verifikasi_kode ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="coding" name="coding" value="<?=  $jasa['headerjasa']->coding ?>" required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="codingjasa" class="col-sm-3 col-form-label">Budget Reserved</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="budget_reserved" name="budget_reserved" value="<?=  $jasa['headerjasa']->budget_reserved ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <form action="<?= base_url('purchasing/addrow') ?>">
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <!-- <input type="button" class="btn btn-primary mb-3" id="tambahjasa" value="Add Jasa"> -->
                        <div class="table-responsive">
                            <table class="table table-bordered w-100" id="tabel1">
                                <thead>
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <th scope="col" width="10%">Detail Permintaan</th>
                                        <th width="8%">LOC</th>
                                        <th width="8%">EC</th>
                                        <th width="8%">NA</th>
                                        <th width="8%">TB</th>
                                        <th width="8%">EA</th>
                                        <th scope="col" width="8%">Satuan</th>
                                        <th scope="col" width="5%">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="row_1">
                                        <!-- <td id="no"></td> -->
                                        <td>
                                        <textarea name="deskripsi_jasa_row" id="deskripsi_jasa" cols="15" rows="5" required></textarea>
                                        </td>
                                        <input type="hidden" name="id_permintaan_jasa" id="id_permintaan_jasa" value="<?= $jasa['headerjasa']->id_permintaan_jasa ?>">
                                        <!-- belum di buat field -->
                                        <td>
                                            <select name="loc_row" id="loc" class="form-control selectpicker" data-live-search="true" data-style="btn-primary">
                                                <option value="">Pilih</option>
                                                <?php foreach ($loc as $row) : ?>
                                                <option value="<?= $row->kode_loc ?>"><?= $row->kode_loc ?> | <?= $row->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="ec_row" id="ec" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                                <option value="">Pilih</option>
                                                <?php foreach($ec as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account ?> | <?= $row->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="na_row" id="na" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                                <option value="">Pilih</option>
                                                <?php foreach($na as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account ?> | <?= $row->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tb_row" id="tb" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                                <option value="">Pilih</option>
                                                <?php foreach($tb as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account ?> | <?= $row->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td><input type="number" class="form-control" id="ea" name="ea_row" value="0"/></td>
                                        <!-- end -->
                                        <td>
                                            <select name="satuan_row" id="satuan" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                                <option value="">Pilih</option>
                                                <?php foreach($satuan as $row) : ?>
                                                <option value="<?= $row->id_satuan ?>"><?= $row->nama_satuan ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="qtyrow" name="qty_row" onkeyup="getTotalJasaRow()">
                                        </td>
                                        <td><input type="text" class="form-control" id="hargarow" name="harga_row" onkeyup="myfunctionHargaJasaRow()"></td>
                                        <td><input type=" text" class="form-control" id="totalrow" name="total_row" readonly></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow1Jasa('1')"><i class="fas fa-times"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit">Tambah</button>
                </div>    
                </form>                              

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
                                        <td><?= $value->satuan ?></td>
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
                                <input type="text" class="form-control font-weight-bold" id="grandtotal" name="grandtotal" value="<?= number_format($jasa['headerjasa']->grandtotal) ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Simpan</button>
                        <a href="<?= base_url('purchasing/permintaanJasaNew') ?>" class="btn btn-danger"><i class="fas fa-times"></i>Batal</a>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

