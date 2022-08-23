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
                    <?php foreach($max as $row){
                        $max = $row->max;
                    } ?>
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
                                <input type="hidden" name="parentid" id="parentid" value="<?= $max ?>" class="form-control">
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
                        <input type="button" value="Add Jasa" class="btn btn-primary mb-3" id="tambahjasa">
                        <br>
                        <table class="table table-bordered w-100" id="data_table_barang">
                            <thead class="bg-primary text-white">
                                <tr>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row_1">
                                    <td><textarea class="form-control" name="item_1" id="item_1" cols="2" rows="4"></textarea></td>
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
                                    <td><input type="text" class="form-control" id="qty_1" name="qty_1" onkeyup="getTotal(1)" /></td>
                                    <td><input type="text" class="form-control" id="harga_1" name="harga_1" onkeyup="myfunctionHarga(1)"></td>
                                    <td><input type="text" class="form-control" id="total_1" name="total_1" readonly /></td>
                                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow1('1')"><i class="fas fa-times"></i></button></td>
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
    function removeRow1(tr_id) {
        $("#data_table_barang tbody tr#row_" + tr_id).remove();
        grandtotal();
    }
    
    $(function(){
    $('#tambahjasa').on('click', function(){
        var tabel = $('#data_table_barang');
        var tr = $('#data_table_barang tbody tr').length;
        var row_id = tr + 1;
        console.log(row_id);
        var html = "";
        html += '<tr id="row_' + row_id + '">';
        html += '<input type="text" name="parentid" value=""/>';
        html += '<td><textarea name="deskripsi_jasa[]" id="deskripsi_jasa_' + row_id + '" cols="40" rows="4"></textarea></td>';
        
        $.ajax({
        url: base_url + 'purchasing/coa',
        method: 'POST',
        dataType: 'json',
        success: function(data){
        html += '<td><select name="loc[]" id="loc_' + row_id + '" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="">Pilih</option>'
        $.each(data, function (index, value) {
            html += '<option value="' + value.kode_loc + '">' + value.kode_loc + '|' + value.nama + '</option>';
        });
        '</select></td>';
        }
        });
        $.ajax({
        url: base_url + 'purchasing/ec',
        method: 'POST',
        dataType: 'json',
        success: function(data){
        html += '<td><select name="loc[]" id="loc_' + row_id + '" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="">Pilih</option>'
        $.each(data, function (index, value) {
            html += '<option value="' + value.account + '">' + value.account + '|' + value.nama + '</option>';
        });
        '</select></td>';
        }
        });
        $.ajax({
        url: base_url + 'purchasing/na',
        method: 'POST',
        dataType: 'json',
        success: function(data){
        html += '<td><select name="ec[]" id="ec_' + row_id + '" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="">Pilih</option>';
        $.each(data, function(index, value){
            html += '<option value="'+ value.account +'">'+ value.account +'|'+ value.nama +'</option>';
        });
        '</select></td>';             
        }
        });           
        $.ajax({
        url: base_url + 'purchasing/tb',
        method: 'POST',
        dataType: 'json',
        success: function(data){
        html += '<td><select name="loc[]" id="loc_' + row_id + '" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="">Pilih</option>'
        $.each(data, function (index, value) {
            html += '<option value="' + value.account + '">' + value.account + '|' + value.nama + '</option>';
        });
        '</select></td>';  
        html += '<td><input type="number" class="form-control" id="ea[]" name="ea_' + row_id + '" value="000"  /></td>';
        }
        });
        $.ajax({
        url: base_url + 'purchasing/satuan',
        method: 'POST',
        dataType: 'json',
        success: function(data){
        html += '<td><select name="loc[]" id="loc_' + row_id + '" class="form-control selectpicker" data-live-search="true" data-style="btn-primary"><option value="">Pilih</option>'
        $.each(data, function (index, value) {
            html += '<option value="' + value.id_satuan + '">' + value.id_satuan + '|' + value.nama_satuan + '</option>';
        });
        '</select></td>';
        html += '<td><input type="text" class="form-control" id="qty_' + row_id + '" name="qty[]" onkeyup="getTotal(' + row_id + ')"></td>';
        html += '<td><input type="text" class="form-control" id="harga_' + row_id + '" name="harga[]" onkeyup="myfunctionHarga(' + row_id + ')"></td>';
        html += '<td><input type=" text" class="form-control" id="total_' + row_id + '" name="total[]" readonly></td>';
        html += '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow1(' + row_id + ')"><i class="fas fa-times"></i></button></td>';
        $('#data_table_barang tbody:last-child').append(html);
        $('.selectpicker').selectpicker("refresh");
        }
        });
        });
    });
</script>