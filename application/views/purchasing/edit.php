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

            <form action="<?= base_url('purchasing/updatepr'); ?>" method="post" onsubmit="return validateForm()">
                <div class=" row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="nopr" class="col-sm-3 col-form-label">No PR</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nopr" name="nopr" value="<?= $permintaan['headerpermintaan']->no_permintaan; ?>" readonly>
                                <input type="hidden" class="form-control" id="id_permintaan" name="id_permintaan" value="<?= $permintaan['headerpermintaan']->id_permintaan; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Tgl PR</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control tanggal" id="tglpr" name="tglpr" value="<?= date('d-m-Y', strtotime($permintaan['headerpermintaan']->tanggal_minta)); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="bagian" name="bagian" value="<?= $permintaan['headerpermintaan']->nama_bagian; ?>" readonly>
                                <input type="hidden" class="form-control" id="id_departement" name="id_bagian" value="<?= $permintaan['headerpermintaan']->id_bagian; ?>" readonly>


                                <!-- <select class="form-control" name="id_bagian" id="id_departement" readonly>
                                    <option value="">Pilih</option>
                                    <?php foreach ($bagian as $row) : ?>


                                        <?php if ($row['idbagian'] == $permintaan['headerpermintaan']->id_bagian) : ?>
                                            <option value="<?= $permintaan['headerpermintaan']->id_bagian; ?>" selected><?= $permintaan['headerpermintaan']->nama_bagian; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $row['idbagian']; ?>"><?= $row['nama_bagian']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach ?>
                                </select> -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="namarequest" name="namarequest" value="<?= $permintaan['headerpermintaan']->nama_request; ?>">
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= $permintaan['headerpermintaan']->keterangan; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="cprno" class="col-sm-3 col-form-label">Cpr No</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cprno" name="cprno" value="<?= $permintaan['headerpermintaan']->cpr_no; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="verifikasikode" class="col-sm-3 col-form-label">Verifikasi Kode</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="verifikasikode" name="verifikasikode" value="<?= $permintaan['headerpermintaan']->verifikasi_kode; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Coding</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="coding" name="coding" value="<?= $permintaan['headerpermintaan']->coding; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Budget Reserved</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="budget" name="budget" value="<?= $permintaan['headerpermintaan']->budget; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <table class="table table-bordered w-100">
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
                                foreach ($permintaan['detailpermintaan'] as $key => $value) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $value->kode_barang; ?></td>
                                        <td><?= $value->nama_barang; ?></td>
                                        <td><?= $value->nama_satuan; ?></td>
                                        <td><?= $value->qty; ?></td>
                                        <td><?= $value->harga; ?></td>
                                        <td><?= $value->total; ?></td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <input type="button" class="btn btn-primary mb-3" id="add_data_barang" value="Add Barang" disabled>
                        <div class="table-responsive">
                            <table class="table table-bordered w-100" id="data_table_barang">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <!-- <th scope="col" width="25%">No</th> -->
                                        <th scope="col" width="25%">Item Barang</th>
                                        <th scope="col" width="10%">Satuan</th>
                                        <th scope="col" width="8%">Qty</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
									$t = 0;
                                    foreach ($permintaan['detailpermintaan'] as $key => $value) :  ?>
                                        <tr id="row_<?php echo $i++; ?>">

                                            <input type="hidden" class="form-control" value="<?= $i; ?>" style="font-size: 13px; width: 50px;" id="no_<?= $i;  ?>" name="noinput[]" readonly>


                                            <input type="hidden" class="form-control id_detail_" id="id_detail_<?= $i; ?>" name="id_detail[]" value="<?= $value->id_permintaan_detail; ?>">


                                            <td>

                                                <select id="barang_<?= $i; ?>" name="barang[]" class="form-control selectpicker" data-row-id="row_1" data-style="btn-primary" data-live-search="true" onchange="getItemBarang(1)">
                                                    <?php foreach ($barang as $row) : ?>
                                                        <?php if ($row['id_barang'] == $value->id_barang) : ?>
                                                            <option value="<?= $value->id_barang; ?>" selected><?= $value->nama_barang; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $row['id_barang']; ?>"><?= $row['nama_barang']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach ?>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" id="satuan_<?= $i; ?>" name="satuan[]" value="<?= $value->nama_satuan; ?>">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" id="qty_<?= $i; ?>" name="qty[]" onkeyup="getTotal(<?php echo $i; ?>)" value="<?= $value->qty; ?>">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" id="harga_<?= $i; ?>" name="harga[]" onkeyup="myfunctionHarga(<?php echo $i; ?>)" value='<?= $value->harga; ?>'>
                                            </td>

                                            <td>
                                                <input type=" text" class="form-control" id="total_<?= $i; ?>" name="total[]" value="<?= $value->total; ?>"			>
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow1('<?php echo $i; ?>')" disabled><i class="fas fa-times"></i></button></td>
                                        </tr>
                                    <?php 
									$t += $value->total;
									endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row justify-content-end">
                            <label for="" class="col-sm-2 col-form-label font-weight-bold">Grand Total</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control font-weight-bold" id="grandtotalbarang" name="grandtotalbarang" value="<?= $t; ?>"
					 readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Update</button>
                        <a href="<?= base_url('purchasing/index') ?>" class="btn btn-danger"><i class="fas fa-exchange-alt"></i>Kembali</a>
                    </div>
                </div>
            </form>

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

                var result = (harga1 * jumlah1) + (harga2 * jumlah2) + (harga3 * jumlah3);
                $("#grandtotalbarang").val(formatMoney(result));
            });
        });
    </script>

    