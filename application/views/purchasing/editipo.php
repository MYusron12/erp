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

            <form action="<?= base_url('purchasing/updateipo'); ?>" method="post" onsubmit="return validateForm()">

                <div class=" row">
                    <div class="col-lg-6">

                        <div class="form-group row">
                            <label for="nopr" class="col-sm-3 col-form-label">No IPO</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="noipo" name="noipo" value="<?= $ipo['headeripo']->no_ipo; ?>" readonly>
                                <input type="hidden" class="form-control" id="idipo" name="idipo" value="<?= $ipo['headeripo']->id_ipo; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Tgl IPO</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control tanggal" id="tglipo" name="tglipo" value="<?= date('d-m-Y', strtotime($ipo['headeripo']->tgl_ipo)); ?>">
                            </div>
                        </div>

                        <?php
                        $des2 = '';
                        if ($ipo['headeripo']->bagian_jasa == $user['bagian_id']) {
                            $des2 = $ipo['headeripo']->no_jasa;
                        } else {
                            $des2 = $ipo['headeripo']->no_pembelian;
                        }
                        ?>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">No PR</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nopr" name="nopr" value="<?= $des2; ?>" readonly>
                                <input type="hidden" class="form-control" id="idpr" name="idpr" value="<?= $ipo['headeripo']->pr_id; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="verifikasikode" class="col-sm-3 col-form-label">Supplier Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="suppliername" name="suppliername" value="<?= $ipo['headeripo']->nama_supplier; ?>" readonly>
                                <input type="hidden" class="form-control" id="supplierid" name="supplierid" value="<?= $ipo['headeripo']->supplier_id; ?>" readonly>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="keteranganipo" name="keteranganipo" rows="3"> <?= $ipo['headeripo']->remarks; ?> </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="location" name="location" value="<?= $ipo['headeripo']->nama_department; ?>" readonly>
                                <input type="hidden" class="form-control" id="locationid" name="locationid" value="<?= $ipo['headeripo']->dept_id; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Store</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="store" name="store" value="<?= $ipo['headeripo']->store; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Delivery Period</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control tanggal" id="delivery" name="delivery" value="<?= date('d-m-Y', strtotime($ipo['headeripo']->delivery_periode)); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Periode</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control tanggal" id="period" name="period" value="<?= date('d-m-Y', strtotime($ipo['headeripo']->periode)); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Budget Reserved</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="budget" name="budget" value="<?= $ipo['headeripo']->budget; ?>">
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
                                    <th scope="col">LOC</th>
                                    <th scope="col">EC</th>
                                    <th scope="col">NA</th>
                                    <th scope="col">TB</th>
                                    <th scope="col">EA</th>
                                    <th scope="col">Item Desc</th>
                                    <th scope="col" width="8%">Jumlah</th>
                                    <th scope="col" width="10%">Satuan</th>
                                    <th scope="col" width="15%">Harga</th>
                                    <th scope="col" width="15%">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; $j = 0;
                                $gt = 0;
                                foreach ($ipo['ipodetail'] as $key => $value) : ?>

                                    <?php if ($value->barang_id == 0) {
                                        $des = $value->barang_nama;
                                    } else {
                                        $des = $value->nama_bar;
                                    } ?>

                                    <tr id="row_<?php echo $j++; ?>">
                                        <input type="hidden" class="form-control id_detail_" id="id_detail_<?= $j; ?>" name="id_detail[]" value="<?= $value->id_ipo_detail; ?>">
                                        <td><?= $i++; ?></td>
                                        <td>
                                            <select id="loc" name="loc[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" readonly>
                                                <option value="">Pilih</option>
                                                <?php foreach ($loc as $row) : ?>

                                                    <?php if ($row->kode_loc == $value->loc) : ?>
                                                        <option value="<?= $value->loc; ?>" selected><?= $value->loc; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row->kode_loc; ?>"><?= $row->kode_loc; ?> | <?= $row->nama; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach ?>
                                            </select>
                                        </td>

                                        <td><select id="ec" name="ec[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" readonly>
                                                <option value="">Pilih</option>
                                                <?php foreach ($ec as $row) : ?>

                                                    <?php if ($row->account == $value->ec) : ?>
                                                        <option value="<?= $value->ec; ?>" selected><?= $value->ec; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row->account; ?>"><?= $row->account; ?> | <?= $row->nama; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach ?>
                                            </select></td>
                                        <td><select id="na" name="na[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" readonly>
                                                <option value="">Pilih</option>
                                                <?php foreach ($na as $row) : ?>

                                                    <?php if ($row->account == $value->na) : ?>
                                                        <option value="<?= $value->na; ?>" selected><?= $value->na; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row->account; ?>"><?= $row->account; ?> | <?= $row->nama; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach ?>
                                            </select></td>
                                        <td><select id="tb" name="tb[]" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" readonly>
                                                <option value="">Pilih</option>
                                                <?php foreach ($tb as $row) : ?>

                                                    <?php if ($row->account == $value->tb) : ?>
                                                        <option value="<?= $value->tb; ?>" selected><?= $value->tb; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row->account; ?>"><?= $row->account; ?> | <?= $row->nama; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach ?>
                                            </select></td>
                                        <!-- <td><select id="ea" name="ea" class="form-control selectpicker" data-style="btn-primary" data-live-search="true">
                                                <option value="">Pilih</option>
                                                <?php foreach ($ea as $row) : ?>

                                                    <?php if ($row->account == $value->ea) : ?>
                                                        <option value="<?= $value->ea; ?>" selected><?= $value->ea; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row->account; ?>"><?= $row->account; ?> | <?= $row->nama; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach ?>
                                            </select></td> -->
                                        <td><?= $value->ea; ?></td>
                                        <td><?= $des; ?></td>
                                        <td><input class="form-control" type="text" id="qty_<?= $j; ?>" name="qty[]" value="<?= $value->qty; ?>" onkeyup="getTotal(<?php echo $j; ?>)"></td>
                                        <td><?= $value->nama_satuan; ?></td>
                                        <td><input class="form-control" type="text" id="harga_<?= $j; ?>" name="harga[]" value="<?= $value->harga; ?>" onkeyup="myfunctionHarga(<?php echo $j; ?>)"></td>
                                        <td><input class="form-control" type="text" id="total_<?= $j; ?>" name="total[]" value="<?= $value->subtotal; ?>" readonly></td>
                                    </tr>

                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="form-group row justify-content-end">
                            <label for="grandtotalbarang" class="col-sm-2 col-form-label font-weight-bold">Grand Total</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control font-weight-bold" id="grandtotalbarang" name="grandtotalbarang" value="<?= number_format($ipo['headeripo']->grandtotal); ?>" readonly>
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
                                <input type="text" class="form-control" id="ppnrupiah" name="ppnrupiah" value="<?= $ipo['headeripo']->ppn_header; ?>" readonly>
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
                                <input type="text" class="form-control" id="pphrupiah" name="pphrupiah" value="<?= $ipo['headeripo']->pph_header; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="totalnet" class="col-sm-2 col-form-label font-weight-bold"> Grand Total</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="totalnet" name="totalnet" value="<?= $ipo['headeripo']->grandtotal; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Simpan</button>
                        <a href="<?= base_url('purchasing/dataipo') ?>" class="btn btn-danger"><i class="fas fa-exchange-alt"></i>Kembali</a>
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
            $("#qty_1, #harga_1, #qty_2, #harga_2, #qty_3, #harga_3").keyup(function() {
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
                $("#grandtotalbarang").val(formatMoney(result));
            });
        });
</script>