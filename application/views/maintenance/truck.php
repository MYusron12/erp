<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message') ?>
             <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Urut/Body</th>
                            <th scope="col">No Pol</th>
                            <th scope="col">Merek Mobil</th>
                            <th scope="col">BBM / Liter</th>
                            <th scope="col">Akumulasi Ltr</th>
                            <th scope="col">Akumulasi KM</th>
                            <th scope="col">KM service</th>
                            <th scope="col">Toleran</th>
                            <th scope="col">Driver</th>
                            <th scope="col">Helper</th>
                            <th scope="col">Tgl Pajak</th>
                            <th scope="col">Tgl BPKP</th>
                            <th scope="col">Tgl Kir</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($truck as $row) :
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row->no_urut; ?></td>
                                <td><?= $row->no_polisi; ?></td>
                                <td><?= $row->merek; ?></td>
                                <td><?= $row->bbm_perliter; ?></td>
                                <td><?= $row->bbm_akumulasi; ?></td>
                                <td><?= number_format($row->km_akumulasi,0); ?></td>
                                <td><?= $row->km_service; ?></td>
                                <td><?= $row->toleran; ?></td>
                                <td><?= $row->driver; ?></td>
                                <td><?= $row->helper; ?></td>
                                <td><?= $row->tgl_stnk; ?></td>
                                <td><?= $row->tgl_bpkb; ?></td>
                                <td><?= $row->tgl_kir; ?></td>
                                <td>
                                     <a href="<?= base_url('maintenance/Detailtruck/') . $row->id_truck; ?>" class="btn btn-info">Detail</a>
                                  
                                </td>
                            </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="newTruckModal" tabindex="-1" role="dialog" aria-labelledby="newTruckModall" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTruckModaLabel">Tambah Truck</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="post">
                    <input type="hidden" id="idtruck" name="idtruck">
                    <div class="form-group row">
                        <label for="nourut" class="col-sm-2 col-form-label">No Urut/Body</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="nourut" name="nourut" placeholder="No Urut">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nopolisi" class="col-sm-2 col-form-label">No Polisi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nopolisi" name="nopolisi" placeholder="No Polisi">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="mobil" class="col-sm-2 col-form-label">Mobil</label>
                        <div class="col-sm-10">
                            <select name="mobil" id="mobil" class="form-control select-picker">
                                <option value="">Pilih</option>
                                <?php foreach ($mobil as $row) : ?>
                                    <option value="<?= $row->idmobil; ?>"><?= $row->merek; ?></option>
<?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bbmperliter" class="col-sm-2 col-form-label">BBM/Liter</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control formatliter" id="bbmperliter" name="bbmperliter" placeholder="BBM / Liter" size="5">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="akumulasi" class="col-sm-2 col-form-label">Akumulasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control formatliter" id="bbmakumulasi" name="bbmakumulasi" placeholder="BBM Akumulasi">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Toleran" class="col-sm-2 col-form-label">Toleran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control formatliter" id="toleran" name="toleran" placeholder="Toleran">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="driver" class="col-sm-2 col-form-label">Driver</label>
                        <div class="col-sm-10">
                            <select name="driver" id="driver" class="form-control">
                                <option value="">Pilih</option>
                                <?php foreach ($driver as $row) : ?>
                                    <option value="<?= $row->id_driver; ?>"><?= $row->nama; ?></option>
<?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="helper" class="col-sm-2 col-form-label">helper</label>
                        <div class="col-sm-10">
                            <select name="helper" id="helper" class="form-control">
                                <option value="">Pilih</option>
                                <?php foreach ($driver as $row) : ?>
                                    <option value="<?= $row->id_driver; ?>"><?= $row->nama; ?></option>
<?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                      <div class="form-group row">
                        <label for="Toleran" class="col-sm-2 col-form-label">KM Service</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="km_service" name="km_service" placeholder="KM service">
                        </div>
                    </div>
                   <div class="form-group row">
                        <label for="helper" class="col-sm-2 col-form-label">Tgl STNK</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control tanggal" id="tgl_stnk" name="tgl_stnk" placeholder="Tanggal" autocomplete="off">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="helper" class="col-sm-2 col-form-label">Tgl BPKB</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control tanggal" id="tgl_bpkb" name="tgl_bpkb" placeholder="Tanggal" autocomplete="off">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="helper" class="col-sm-2 col-form-label">Tgl Kir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control tanggal" id="tgl_kir" name="tgl_kir" placeholder="Tanggal" autocomplete="off">

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>