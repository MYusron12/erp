<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <form action="<?= base_url('purchasing/addipos'); ?>" method="post" onsubmit="return validateForm()">

        <div class="card">
            <div class="card-body">
                <div class=" row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="nopr" class="col-sm-3 col-form-label">No PJ</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nopr" name="nopr" value="<?= $jasa->no_pr_jasa; ?>" readonly>
                                <input type="hidden" class="form-control" id="idprjasa" name="idprjasa" value="<?= $jasa->id_permintaan_jasa; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nopr" class="col-sm-3 col-form-label">No IPO</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="noipo" name="noipo" value="<?= $noipo; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Tgl IPO</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control tanggal" id="tglipo" name="tglipo" value="<?= date('d-m-Y'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Bagian</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="bagianipo" name="bagianipo" value="<?= $jasa->nama_bagian; ?>" readonly>
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
                                <textarea class="form-control" id="keteranganipo" name="keteranganipo" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="cprno" class="col-sm-3 col-form-label">Supplier</label>
                            <div class="col-sm-6">
                                <select name="supplierid" id="supplierid" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                    <option value="">Pilih</option>
                                    <?php foreach ($suplier as $row) : ?>
                                        <option value="<?= $row->id_suplier; ?>">
                                            <?= $row->kode_suplier ?> - <?= $row->suplier; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="verifikasikode" class="col-sm-3 col-form-label">Supplier Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="suppliername" name="suppliername" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="location" name="location" value="<?= $jasa->nama; ?>" readonly>
                                <input type="hidden" class="form-control" id="locationid" name="locationid" value="<?= $jasa->id_departement; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Store</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="store" name="store" value="<?= $jasa->kode_loc; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Delivery Period</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control tanggal" id="delivery" name="delivery">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Periode</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control tanggal" id="period" name="period">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Budget Reserved</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="budget" name="budget" value="<?= $jasa->budget_reserved; ?>" readonly>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <table class="table table-responsive w-100" id="data_table_barang">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <!-- <th scope="col">LOC - EC - NA - TB - EA</th> -->
                                    <th scope="col" width="7%">LOC</th>
                                    <th scope="col" width="7%">EC</th>
                                    <th scope="col" width="7%">NA</th>
                                    <th scope="col" width="7%">TB</th>
                                    <th scope="col" width="7%">EA</th>
                                    <th scope="col" width="25%">Detail Permintaan</th>
                                    <th scope="col" width="8%">Satuan</th>
                                    <th scope="col" width="8%">Jumlah</th>
                                    <th scope="col" width="10%">Harga</th>
                                    <th scope="col" width="15%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row_1">
                                    <td>1</td>
                                    <td><select id="loc" name="loc[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($loc as $row) : ?>
                                                <option value="<?= $row->kode_loc ?>"><?= $row->kode_loc . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="ec" name="ec[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($ec as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="na" name="na[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($na as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="tb" name="tb[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($tb as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input class="form-control" type="text" name="ea[]" value="000" readonly></td>
                                    <td><input class="form-control" type="text" name="barang[]" value="<?= $jasa->item_1; ?>" readonly></td>
                                    <td><input class="form-control" type="text" name="satuan[]" value="<?= $jasa->satuan_nama1; ?>" readonly> <input class="form-control" type="hidden" name="satuan[]" value="<?= $jasa->id_satuan1; ?>" readonly></td>
                                    <td><input class="form-control" type="text" id="qty_1" name="qty[]" value="<?= $jasa->qty_1; ?>" onkeyup="getTotal(1)"></td>
                                    <td><input class="form-control" type="text" id="harga_1" name="harga[]" value="<?= $jasa->harga_1; ?>" onkeyup="myfunctionHarga(1)"></td>
                                    <td><input class="form-control" type="text" id="total_1" name="total[]" value="<?= $jasa->total_1; ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><select id="loc" name="loc[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($loc as $row) : ?>
                                                <option value="<?= $row->kode_loc ?>"><?= $row->kode_loc . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="ec" name="ec[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($ec as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="na" name="na[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($na as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="tb" name="tb[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($tb as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input class="form-control" type="text" name="ea[]" value=""></td>
                                    <td><input class="form-control" type="text" name="barang[]" value="<?= $jasa->item_2; ?>" readonly></td>
                                    <td><input class="form-control" type="text" name="satuan[]" value="<?= $jasa->satuan_nama2; ?>" readonly> <input class="form-control" type="hidden" name="satuan[]" value="<?= $jasa->id_satuan2; ?>" readonly></td>
                                    <td><input class="form-control" type="text" id="qty_2" name="qty[]" value="<?= $jasa->qty_2; ?>" onkeyup="getTotal(2)"></td>
                                    <td><input class="form-control" type="text" id="harga_2" name="harga[]" value="<?= $jasa->harga_2; ?>" onkeyup="myfunctionHarga(2)"></td>
                                    <td><input class="form-control" type="text" id="total_2" name="total[]" value="<?= $jasa->total_2; ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><select id="loc" name="loc[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($loc as $row) : ?>
                                                <option value="<?= $row->kode_loc ?>"><?= $row->kode_loc . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="ec" name="ec[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($ec as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="na" name="na[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($na as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><select id="tb" name="tb[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                            <option value="">Pilih</option>
                                            <?php foreach ($tb as $row) : ?>
                                                <option value="<?= $row->account ?>"><?= $row->account . '|' . $row->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select></td>
                                    <td><input class="form-control" type="text" name="ea[]" value=""></td>
                                    <td><input class="form-control" type="text" name="barang[]" value="<?= $jasa->item_3; ?>" readonly></td>
                                    <td><input class="form-control" type="text" name="satuan[]" value="<?= $jasa->satuan_nama3; ?>" readonly> <input class="form-control" type="hidden" name="satuan[]" value="<?= $jasa->id_satuan3; ?>" readonly></td>
                                    <td><input class="form-control" type="text" id="qty_3" name="qty[]" value="<?= $jasa->qty_3; ?>" onkeyup="getTotal(3)"></td>
                                    <td><input class="form-control" type="text" id="harga_3" name="harga[]" value="<?= $jasa->harga_3; ?>" onkeyup="myfunctionHarga(3)"></td>
                                    <td><input class="form-control" type="text" id="total_3" name="total[]" value="<?= $jasa->total_3; ?>" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="form-group row justify-content-end">
                            <?= 
                                    $t=0;
                                    $t1=$jasa->total_1;
                                    $t2=$jasa->total_2;
                                    $t3=$jasa->total_3;
                                    $t=$t1+$t2+$t3;
                                    ?>
                            <label for="grandtotalbarang" class="col-sm-2 col-form-label font-weight-bold">Grand Total</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control font-weight-bold" id="grandtotalbarangs" name="grandtotalbarang" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="ppnpersen" class="col-sm-2 col-form-label">PPN %</label>
                            <div class="col-sm-6">
                                <select name="ppnpersen" id="ppnpersen" class="form-control" onchange="ppn1();">
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
                                <select name="pphpersen" id="pphpersen" class="form-control" onchange="pph1();">
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
                                <input type="text" class="form-control" id="pphrupiah" name="pphrupiah" onkeyup = "pphmanual();">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="totalnet" class="col-sm-2 col-form-label font-weight-bold"> Grand Total</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="totalnet" name="totalnet" readonly>
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
            </div>

    </form>

</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
         
        $("#qty_1, #harga_1, #qty_2, #harga_2, #qty_3, #harga_3").keyup(function() {
            var result = 0;
            var harga1 = $("#harga_1").val();
            var jumlah1 = $("#qty_1").val();
            var harga2 = $("#harga_2").val();
            var jumlah2 = $("#qty_2").val();
            var harga3 = $("#harga_3").val();
            var jumlah3 = $("#qty_3").val();
            var harga1 = harga1.replace(/[^,\d]/g, '');
            var harga1 = harga1.replace(',', '.');
            var harga2 = harga2.replace(/[^,\d]/g, '');
            var harga2 = harga2.replace(',', '.');
            var harga3 = harga3.replace(/[^,\d]/g, '');
            var harga3 = harga3.replace(',', '.');

            var result = harga1 * jumlah1 + harga2 * jumlah2 + harga3 * jumlah3;
          
              //$("#grandtotalbarangs").val(formatMoney(result));
			  $("#grandtotalbarangs").val(result);
        
           
        });
        
           //$("#grandtotalbarangs").val(formatMoney(<?php echo $t;?>));
		   $("#grandtotalbarangs").val(<?php echo $t;?>);
    });
</script>
<script>
    function pphmanual() {
        var totalbarang = document.getElementById('totalnet').value;
        var totalbarang = totalbarang.replace(/[^,\d]/g, '');
        var totalbarang = totalbarang.replace(',', '.');
        var pph = $('#pphrupiah').val();
        var resulttotal = 0;
        resulttotal = Number(totalbarang) - Number(pph)
        //console.log(resulttotal);
        //$('#totalnet').val(formatMoney(resulttotal.toFixed(2)));
		$('#totalnet').val(resulttotal.toFixed(2));
    };
</script>