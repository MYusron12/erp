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
                            <label for="nopr" class="col-sm-3 col-form-label">No Permintaan Jasa New</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nopr" name="nopr" value="<?= $jasa['headerjasa']->no_pr_jasa; ?>" readonly>
                                <input type="hidden" class="form-control" id="idprjasa" name="idprjasa" value="<?= $jasa['headerjasa']->id_permintaan_jasa; ?>" readonly>
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
                                <input type="text" class="form-control" id="bagianipo" name="bagianipo" value="<?= $jasa['headerjasa']->nama_bagian; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namarequest" class="col-sm-3 col-form-label">Nama Request</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="namarequest" name="namarequest" value="<?= $jasa['headerjasa']->nama_request; ?>" readonly>
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
                                <input type="text" class="form-control" id="location" name="location" value="<?= $jasa['headerjasa']->nama; ?>" readonly>
                                <input type="hidden" class="form-control" id="locationid" name="locationid" value="<?= $jasa['headerjasa']->department_id; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coding" class="col-sm-3 col-form-label">Store</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="store" name="store" value="<?= $jasa['headerjasa']->kode_loc; ?>">
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
                                <input type="text" class="form-control" id="budget" name="budget" value="<?= $jasa['headerjasa']->budget_reserved; ?>" readonly>
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
                                    <th scope="col" width="2">No</th>
                                    <th scope="col" width="25%">COA</th>
                                    <th scope="col" width="15%">Detail Permintaan</th>
                                    <th scope="col" width="10%">Satuan</th>
                                    <th scope="col" width="8%">Jumlah</th>
                                    <th scope="col" width="15%">Harga</th>
                                    <th scope="col" width="15%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                      $j = 0;
                                       $t=0;
                                foreach ($jasa['detailjasa'] as $key => $value) : ?>
                                    <tr id="row_<?php echo $j++; ?>">
                                        <td><?= $i++; ?></td>
                                        <td><input class="form-control" type="text" name="coa[]" value="<?= $value->coa ?>" readonly></td>
                                        <td><input class="form-control" type="text" value="<?= $value->deskripsi_jasa; ?>" readonly></td>
                                        <td><input class="form-control" type="text" value="<?= $value->nama_satuan; ?>" readonly><input class="form-control" type="hidden" name="satuan1[]" value="<?= $value->satuan; ?>"></td>
                                        <td><input class="form-control" type="text" id="qty_<?= $j; ?>" name="qty[]" value="<?= $value->qty; ?>" onkeyup="getTotal(<?php echo $j; ?>)"></td>
                                        <td><input class="form-control" type="text" id="harga_<?= $j; ?>" name="harga[]" value="<?= $value->harga; ?>" onkeyup="myfunctionHarga(<?php echo $j; ?>)"></td>
                                        <td><input class="form-control" type="text" id="total_<?= $j; ?>" name="total[]" value="<?= $value->total; ?>" readonly></td>
                                    </tr>
                                <?php 
                                     $t+=$value->total;
                                    
                                endforeach; 
                                
                                   
                                   
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                <div class="col-lg-12">
                        <div class="form-group row justify-content-end">
                            <label for="grandtotalbarang" class="col-sm-2 col-form-label font-weight-bold">Grand Total</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control font-weight-bold" id="totalbarang" name="totalbarang" value="<?= $jasa['headerjasa']->grandtotal ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6">
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
                                <input type="text" class="form-control" id="pphrupiah" name="pphrupiah">
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

