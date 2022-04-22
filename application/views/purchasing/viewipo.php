<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class=" row">
                <div class="col-lg-6">

                    <div class="form-group row">
                        <label for="nopr" class="col-sm-3 col-form-label">No IPO</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="noipo" name="noipo" value="<?= $ipo['headeripo']->no_ipo; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tglpr" class="col-sm-3 col-form-label">Tgl IPO</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control tanggal" id="tglipo" name="tglipo" value="<?= date('d-m-Y', strtotime($ipo['headeripo']->tgl_ipo)); ?>" readonly>
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
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="verifikasikode" class="col-sm-3 col-form-label">Supplier Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="suppliername" name="suppliername" value="<?= $ipo['headeripo']->nama_supplier; ?>" readonly>
                        </div>
                    </div>

                    <div class=" form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Remarks</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="keteranganipo" name="keteranganipo" rows="3" readonly> <?= $ipo['headeripo']->remarks; ?> </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="form-group row">
                        <label for="coding" class="col-sm-3 col-form-label">Location</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="location" name="location" value="<?= $ipo['headeripo']->nama_department; ?>" readonly>
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
                            <input type="text" class="form-control" id="budget" name="budget" value="<?= $ipo['headeripo']->budget; ?>" readonly>
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12 mt-3">
                    <table class="table table-responsive w-100">
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
                            <?php $i = 1;
                            $gt = 0;

                            foreach ($ipo['ipodetail'] as $key => $value) : ?>

                                <?php if ($value->barang_id == 0) {
                                    $des = $value->barang_nama;
                                } else {
                                    $des = $value->nama_bar;
                                } ?>

                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $value->loc; ?></td>
                                    <td><?= $value->ec; ?></td>
                                    <td><?= $value->na; ?></td>
                                    <td><?= $value->tb; ?></td>
                                    <td><?= $value->ea; ?></td>
                                    <td><?= $des; ?></td>
                                    <td><?= $value->qty; ?></td>
                                    <td><?= $value->nama_satuan; ?></td>
                                    <td><?= number_format($value->harga); ?></td>
                                    <td><?= number_format($value->subtotal); ?></td>
                                </tr>

                            <?php $gt += $value->subtotal;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">


                    <div class="form-group row justify-content-end">
                        <label for="totalbarang" class="col-sm-2 col-form-label font-weight-bold">Total </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control font-weight-bold" id="totalbarang" name="totalbarang" value="<?= number_format($gt); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <label for="totalbarang" class="col-sm-2 col-form-label font-weight-bold">PPN IPO </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control font-weight-bold" id="totalbarang" name="totalbarang" value="<?= $ipo['headeripo']->ppn_header; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <label for="totalbarang" class="col-sm-2 col-form-label font-weight-bold">PPH IPO </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control font-weight-bold" id="totalbarang" name="totalbarang" value="<?= $ipo['headeripo']->pph_header; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <label for="totalbarang" class="col-sm-2 col-form-label font-weight-bold">Grand Total </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control font-weight-bold" id="totalbarang" name="totalbarang" value="<?= number_format($ipo['headeripo']->grandtotal); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-6">
                    <a href="<?= base_url('purchasing/dataipo') ?>" class="btn btn-danger"><i class="fas fa-exchange-alt"></i>Kembali</a>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->