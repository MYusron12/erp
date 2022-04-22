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

            <form action="<?= base_url('purchasing/create_pr_jasa'); ?>" method="post" onsubmit="return validateForm()">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="noprjasa" class="col-sm-3 col-form-label">No PR Jasa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="noprjasa" name="noprjasa" value="<?= $noprjs; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgljasa" class="col-sm-3 col-form-label">Tgl PR Jasa</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control tanggal" id="tgljasa" name="tgljasa" value="<?= date('d-m-Y'); ?>" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bagianjasa" class="col-sm-3 col-form-label">Bagian</label>
                            <div class="col-sm-6">
                                <input name="" id="bagian" value="<?= $user['nama_bagian']; ?>" class="form-control" readonly>
                                <input type="hidden" name="bagianjasa" id="bagian" value="<?= $user['idbagian']; ?>" class="form-control">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namareqjasa" class="col-sm-3 col-form-label">Nama Request</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="namareqjasa" name="nama_req" value="<?= $user['name']; ?>">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterjasa" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="keterjasa" name="keterjasa" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="cprnojasa" class="col-sm-3 col-form-label">Cpr No</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cprnojasa" name="cprnojasa" value="<?= set_value('cprnojasa'); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="verifikasikodejasa" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="verifikasikodejasa" name="verifikasikodejasa" value="<?= set_value('verifikasikodejasa'); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="codingjasa" class="col-sm-3 col-form-label">Coding</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="codingjasa" name="codingjasa" value="<?= set_value('codingjasa'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="codingjasa" class="col-sm-3 col-form-label">Budget Reserved</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="budgetjasa" name="budgetjasa" value="<?= set_value('budgetjasa'); ?>">
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
                                    <th scope="col" width="2%">No</th>
                                    <th scope="col" width="25%">Detail Permintaan</th>
                                    <th scope="col" width="6%">LOC</th>
                                    <th scope="col" width="6%">EC</th>
                                    <th scope="col" width="6%">NA</th>
                                    <th scope="col" width="6%">TB</th>
                                    <th scope="col" width="7%">EA</th>
                                    <th scope="col" width="10%">Satuan</th>
                                    <th scope="col" width="10%">Jumlah</th>
                                    <th scope="col" width="10%">Harga</th>
                                    <th scope="col" width="15%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row_1">
                                    <td>1</td>
                                    <td><input type="text" class="form-control" id="item_1" name="item_1" /></td>
                                    <td><select id="loc" name="loc_1" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($loc as $row) : ?>
                                                <option value="<?= $row->kode_loc ?>"><?= $row->kode_loc . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="ec" name="ec_1" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($ec as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="na" name="na_1" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($na as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="tb" name="tb_1" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($tb as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input type="number" class="form-control" id="ea" name="ea_1" value="000" readonly /></td>
                                    <td><select name="satuan_1" id="satuan_1" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($satuan as $row) : ?>
                                                <option value="<?= $row->id_satuan; ?>" <?= set_select('satuan', $row->id_satuan); ?>>
                                                    <?= $row->nama_satuan ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input type="text" class="form-control" id="jumlah_1" name="jumlah_1" onkeyup="getTotal(1)" /></td>
                                    <td><input type="text" class="form-control" id="harga_1" name="harga_1" onkeyup="myfunctionHarga(1)"></td>
                                    <td><input type="text" class="form-control" id="total_1" name="total_1" readonly /></td>
                                </tr>
                                <tr id="row_2">
                                    <td>2</td>
                                    <td><input type="text" class="form-control" id="item_2" name="item_2" /></td>
                                    <td><select id="loc" name="loc_2" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($loc as $row) : ?>
                                                <option value="<?= $row->kode_loc ?>"><?= $row->kode_loc . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="ec" name="ec_2" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($ec as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="na" name="na_2" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($na as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="tb" name="tb_2" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($tb as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input type="number" class="form-control" id="ea" name="ea_2" /></td>
                                    <td><select name="satuan_2" id="satuan_2" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($satuan as $row) : ?>
                                                <option value="<?= $row->id_satuan; ?>" <?= set_select('satuan', $row->id_satuan); ?>>
                                                    <?= $row->nama_satuan ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input type="text" class="form-control" id="jumlah_2" name="jumlah_2" onkeyup="getTotal(2)" /></td>
                                    <td><input type="text" class="form-control" id="harga_2" name="harga_2" onkeyup="myfunctionHarga(2)"></td>
                                    <td><input type="text" class="form-control" id="total_2" name="total_2" readonly /></td>
                                </tr>
                                <tr id="row_3">
                                    <td>3</td>
                                    <td><input type="text" class="form-control" id="item_3" name="item_3" /></td>
                                    <td><select id="loc" name="loc_3" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($loc as $row) : ?>
                                                <option value="<?= $row->kode_loc ?>"><?= $row->kode_loc . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="ec" name="ec_3" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($ec as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="na" name="na_3" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($na as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="tb" name="tb_3" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($tb as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input type="number" class="form-control" id="ea" name="ea_3" value="" /></td>
                                    <td><select name="satuan_3" id="satuan_3" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($satuan as $row) : ?>
                                                <option value="<?= $row->id_satuan; ?>" <?= set_select('satuan', $row->id_satuan); ?>>
                                                    <?= $row->nama_satuan ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input type="text" class="form-control" id="jumlah_3" name="jumlah_3" onkeyup="getTotal(3)" /></td>
                                    <td><input type="text" class="form-control" id="harga_3" name="harga_3" onkeyup="myfunctionHarga(3)"></td>
                                    <td><input type="text" class="form-control" id="total_3" name="total_3" readonly /></td>
                                </tr>
                            </tbody>
                        </table>
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
                        <a href="<?= base_url('purchasing/permintaanjasa') ?>" class="btn btn-danger"><i class="fas fa-times"></i>Batal</a>
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