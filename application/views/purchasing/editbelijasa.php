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

            <form action="<?= base_url('purchasing/updatebelijasa/') . $jasa->id_permintaan_jasa; ?>" method="post" onsubmit="return validateForm()">

                <div class=" row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="nopr" class="col-sm-3 col-form-label">No PJ</label>
                            <div class="col-sm-6">
                                <input type="hidden" id="id_permintaan_pengerjaan" name="id_permintaan_pengerjaan" value="<?= $jasa->id_permintaan_jasa ?>">
                                <input type="text" class="form-control" id="noprjasa" name="noprjasa" value="<?= $jasa->no_pr_jasa; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Tgl PJ</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control tanggal" id="tgljasa" name="tgljasa" value="<?= date('d-m-Y', strtotime($jasa->tgl_pr_jasa)); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Bagian</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="bagianjasa" name="bagianjasa" value="<?= $jasa->nama_bagian; ?>" readonly>
                                <input type="hidden" class="form-control" id="bagianjasa1" name="bagianjasa1" value="<?= $jasa->bagian_id; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="namareqjasa" name="nama_req" value="<?= $jasa->name; ?>" readonly>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="keterjasa" name="keterjasa" rows="3"><?= $jasa->remarks; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cprnojasa" name="cprnojasa" value="<?= $jasa->cpr_no; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="verifikasikodejasa" name="verifikasikodejasa" value="<?= $jasa->verifikasi_kode; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="codingjasa" name="codingjasa" value="<?= $jasa->coding; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Budget Reserved</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="budgetjasa" name="budgetjasa" value="<?= $jasa->budget_reserved; ?>">
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <table class="table table-bordered w-100" id="data_table_barang">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="20%">Detail Permintaan</th>
                                    <th scope="col" width="15%">Coa</th>
                                    <th scope="col" width="15%">Satuan</th>
                                    <th scope="col" width="8%">Jumlah</th>
                                    <th scope="col" width="15%">Harga</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row_1">
                                    <td>1</td>
                                    <td><input type="text" class="form-control" id="item_1" name="item_1" value="<?= $jasa->item_1; ?>" readonly /></td>
                                    <td><input type="text" class="form-control" id="coa1" name="coa1" value="<?= $jasa->coa1; ?>" readonly /></td>
                                    <td><select name="satuan_1" id="satuan_1" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required> 
                                            <option value="">Pilih</option>
                                            <?php foreach ($satuan as $row) : ?>
                                                    <?php if ($row->id_satuan == $jasa->id_satuan1) : ?>
                                                            <option value="<?= $jasa->id_satuan1; ?>" selected><?= $jasa->satuan_nama1; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $row->id_satuan; ?>"><?= $row->nama_satuan; ?></option>
                                                        <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input type="text" class="form-control" id="jumlah_1" name="jumlah_1" value="<?= $jasa->qty_1; ?>" onkeyup="getTotal(1)" /></td>
                                    <td><input type="text" class="form-control" id="harga_1" name="harga_1" value="<?= $jasa->harga_1; ?>" onkeyup="myfunctionHarga(1)" /></td>
                                    <td><input type="text" class="form-control" id="total_1" name="total_1" value="<?= $jasa->total_1; ?>" readonly /></td>
                                </tr>
                                <tr id="row_2">
                                    <td>2</td>
                                    <td><input type="text" class="form-control" id="item_2" name="item_2" value="<?= $jasa->item_2; ?>" readonly /></td>
                                    <td><input type="text" class="form-control" id="coa1" name="coa2" value="<?= $jasa->coa2; ?>" readonly /></td>
                                    <td><select name="satuan_2" id="satuan_2" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($satuan as $row) : ?>
                                                    <?php if ($row->id_satuan == $jasa->id_satuan2) : ?>
                                                            <option value="<?= $jasa->id_satuan2; ?>" selected><?= $jasa->satuan_nama2; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $row->id_satuan; ?>"><?= $row->nama_satuan; ?></option>
                                                        <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input type="text" class="form-control" id="jumlah_2" name="jumlah_2" value="<?= $jasa->qty_2; ?>" onkeyup="getTotal(2)" /></td>
                                    <td><input type="text" class="form-control" id="harga_2" name="harga_2" value="<?= $jasa->harga_2; ?>" onkeyup="myfunctionHarga(2)" /></td>
                                    <td><input type="text" class="form-control" id="total_2" name="total_2" value="<?= $jasa->total_2; ?>" readonly /></td>
                                </tr>
                                <tr id="row_3">
                                    <td>3</td>
                                    <td><input type="text" class="form-control" id="item_3" name="item_3" value="<?= $jasa->item_3; ?>" readonly /></td>
                                    <td><input type="text" class="form-control" id="coa1" name="coa3" value="<?= $jasa->coa3; ?>" readonly /></td>
                                    <td><select name="satuan_3" id="satuan_3" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($satuan as $row) : ?>
                                                    <?php if ($row->id_satuan == $jasa->id_satuan3) : ?>
                                                            <option value="<?= $jasa->id_satuan3; ?>" selected><?= $jasa->satuan_nama3; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $row->id_satuan; ?>"><?= $row->nama_satuan; ?></option>
                                                        <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input type="text" class="form-control" id="jumlah_3" name="jumlah_3" value="<?= $jasa->qty_3; ?>" onkeyup="getTotal(3)" /></td>
                                    <td><input type="text" class="form-control" id="harga_3" name="harga_3" value="<?= $jasa->harga_3; ?>" onkeyup="myfunctionHarga(3)" /></td>
                                    <td><input type="text" class="form-control" id="total_3" name="total_3" value="<?= $jasa->total_3; ?>" readonly /></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php 

                ?>
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="form-group row justify-content-end">
                            <label for="grandtotalbarang" class="col-sm-2 col-form-label font-weight-bold">Grand Total</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control font-weight-bold" id="grandtotalbarang" name="grandtotalbarang" value="<?= number_format(($jasa->total_1) + ($jasa->total_2) + ($jasa->total_3)); ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Simpan</button>
                        <a href="<?= base_url('purchasing/permintaanjasa') ?>" class="btn btn-danger"><i class="fas fa-exchange-alt"></i>Kembali</a>
                    </div>
                </div>
            </form>
        </div>

    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#jumlah_1, #harga_1").keyup(function() {
            var harga = $("#harga_1").val();
            var jumlah = $("#jumlah_1").val();
            var harga = harga.replace(/[^,\d]/g, '');
            var harga = harga.replace(',', '.');

            var total = harga * jumlah;
            $("#total_1").val(formatMoney(total));
        });
    });
    $(document).ready(function() {
        $("#jumlah_2, #harga_2").keyup(function() {
            var harga = $("#harga_2").val();
            var jumlah = $("#jumlah_2").val();
            var harga = harga.replace(/[^,\d]/g, '');
            var harga = harga.replace(',', '.');

            var total = harga * jumlah;
            $("#total_2").val(formatMoney(total));
        });
    });
    $(document).ready(function() {
        $("#jumlah_3, #harga_3").keyup(function() {
            var harga = $("#harga_3").val();
            var jumlah = $("#jumlah_3").val();
            var harga = harga.replace(/[^,\d]/g, '');
            var harga = harga.replace(',', '.');

            var total = harga * jumlah;
            $("#total_3").val(formatMoney(total));
        });
    });
    $(document).ready(function() {
        $("#jumlah_1, #harga_1, #jumlah_2, #harga_2, #jumlah_3, #harga_3").keyup(function() {
            var harga1 = $("#harga_1").val();
            var jumlah1 = $("#jumlah_1").val();
            var harga2 = $("#harga_2").val();
            var jumlah2 = $("#jumlah_2").val();
            var harga3 = $("#harga_3").val();
            var jumlah3 = $("#jumlah_3").val();
            var harga1 = harga1.replace(/[^,\d]/g, '');
            var harga1 = harga1.replace(',', '.');
            var harga2 = harga2.replace(/[^,\d]/g, '');
            var harga2 = harga2.replace(',', '.');
            var harga3 = harga3.replace(/[^,\d]/g, '');
            var harga3 = harga3.replace(',', '.');

            var result = harga1 * jumlah1 + harga2 * jumlah2 + harga3 * jumlah3;
            $("#grandtotalbarang").val(formatMoney(result));
        });
    });
</script>