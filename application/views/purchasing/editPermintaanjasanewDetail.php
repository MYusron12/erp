<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card">
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-success" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <form action="" method="post" onsubmit="return validateForm()">
                <div class=" row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="nopr" class="col-sm-3 col-form-label">Deskripsi Jasa</label>
                            <div class="col-sm-6">
                                <input type="hidden" name="id_jasa_detail" id="" value="<?= $detailJasa['id_permintaan_jasa'] ?>">
                                <input type="hidden" name="id_jasa_detail" id="" value="<?= $detailJasa['id_jasa_detail'] ?>">
                                <input type="text" class="form-control" id="deskripsi_jasa" name="deskripsi_jasa" value="<?= $detailJasa['deskripsi_jasa'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">COA</label>
                            <div class="col-6">
                                <!-- <input type="text" class="form-control" id="coa" name="coa" value="<?= $detailJasa['coa'] ?>"> -->
                                <?php $coa = $detailJasa['coa']; 
                                $array = str_split($coa);
                                // loc
                                $sebelumLoc = array_slice($array, 0, 3);
                                $locSlice = implode($sebelumLoc);

                                // ec
                                $sebelumEc = array_slice($array, 4, 3);
                                $ecSlice = implode($sebelumEc);
                                
                                // na
                                $sebelumNa = array_slice($array, 8, 4);
                                $naSlice = implode($sebelumNa);
                                
                                // tb
                                $sebelumTb = array_slice($array, 13, 2);
                                $tbSlice = implode($sebelumTb);
                                ?>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">LOC</label>
                                        <select name="loc" id="loc" class="form-control selectpicker" data-live-search="true" data-style="btn-primary">
                                            <option value="<?= $locSlice; ?>"><?= $locSlice; ?></option>
                                            <?php foreach($loc as $row) : ?>
                                            <option value="<?= $row->kode_loc ?>"><?= $row->kode_loc ?> | <?= $row->nama ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="">EC</label>
                                        <select name="ec" id="ec" class="form-control selectpicker" data-live-search="true" data-style="btn-primary">
                                            <option value="<?= $ecSlice; ?>"><?= $ecSlice; ?></option>
                                            <?php foreach($ec as $row) : ?>
                                            <option value="<?= $row->account ?>"><?= $row->account ?> | <?= $row->nama ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="">NA</label>
                                        <select name="na" id="na" class="form-control selectpicker" data-live-search="true" data-style="btn-primary">
                                            <option value="<?= $naSlice; ?>"><?= $naSlice; ?></option>
                                            <?php foreach($na as $row) : ?>
                                            <option value="<?= $row->account ?>"><?= $row->account ?> | <?= $row->nama ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="">TB</label>
                                        <select name="tb" id="tb" class="form-control selectpicker" data-live-search="true" data-style="btn-primary">
                                            <option value="<?= $tbSlice; ?>"><?= $tbSlice; ?></option>
                                            <?php foreach($tb as $row) : ?>
                                            <option value="<?= $row->account ?>"><?= $row->account ?> | <?= $row->nama ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="">EA</label>
                                        <input type="text" class="form-control" name="ea" id="ea" value="000">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tglpr" class="col-sm-3 col-form-label">Satuan</label>
                            <div class="col-sm-4">
                                <select name="satuan" id="satuan" class="form-control">
                                    <?php foreach($satuan as $s) : ?>
                                        <?php if($detailJasa['satuan'] == $s->id_satuan) : ?>
                                        <option value="<?= $s->id_satuan ?>" selected><?= $s->nama_satuan ?></option>
                                    <?php else : ?>
                                        <option value="<?= $s->id_satuan ?>"><?= $s->nama_satuan ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bagian" class="col-sm-3 col-form-label">QTY</label>
                            <div class="col-sm-6">
                                <input name="qty" id="qty" value="<?= $detailJasa['qty'] ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namarequest" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-6">
                                   <input type="text" name="harga" id="harga" value="<?= $detailJasa['harga'] ?>" class="form-control" onkeyup="total()">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namarequest" class="col-sm-3 col-form-label">Total</label>
                            <div class="col-sm-6">
                                   <input type="text" name="total" id="total" value="<?= $detailJasa['total'] ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>      
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>Simpan</button>
                        <a href="<?= base_url('purchasing/editPermintaanJasaNew/' . $detailJasa['id_permintaan_jasa']) ?>" class="btn btn-danger"><i class="fas fa-times"></i>Kembali</a>
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
        $("#qty, #harga").keyup(function() {
            var qty  = $("#qty").val();
            var harga = $("#harga").val();

            var total = parseInt(harga) * parseInt(qty);
            $("#total").val(total);
        });
    });
</script>

