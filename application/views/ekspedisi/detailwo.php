<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header">Detail WO</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="no_wo" class="col-sm-3 col-form-label">Nomor WO</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_wo" name="no_wo" value="<?= $detil_wo->no_pengerjaan; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nopol" class="col-sm-3 col-form-label">Nomor Polisi</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nopol" name="nopol" value="<?= $detil_wo->no_polisi; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nobody" class="col-sm-3 col-form-label">No Body</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nobody" name="nobody" value="<?= $detil_wo->no_urut ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama Pemohon</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $detil_wo->name ?>" readonly>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_bag" class="col-sm-3 col-form-label">Department Pemohon</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nama_bag" name="nama_bag" value="<?= $detil_wo->nama_bagian ?>" readonly>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tglorder" class="col-sm-3 col-form-label">Tgl Permintaan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control tanggal" id="tglorder" name="tglorder" value="<?= date('d-m-Y', strtotime($detil_wo->tgl_order)); ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis" class="col-sm-3 col-form-label">Jenis Pengerjaan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $detil_wo->deskripsi_peminta ?>" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="tglcek" class="col-sm-3 col-form-label">Tanggal Pengecekan</label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control tanggal" id="tglcek" name="tglcek" value="<?= date('d-m-Y', strtotime($detil_wo->tanggal_cek)); ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nopol" class="col-sm-3 col-form-label">PIC Pengecekan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nopol" name="nopol" value="<?= $detil_wo->pic_cek; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="namasupir" class="col-sm-3 col-form-label">Nama Supir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="namasupir" name="namasupir" value="<?= $detil_wo->deskripsi_supir ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Komponen yang diganti</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $detil_wo->deskripsi_komponen ?>" readonly>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deskrip" class="col-sm-3 col-form-label">Deskripsi Pengerjaan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="deskrip" name="deskrip" value="<?= $detil_wo->deskripsi_perkerja ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status Pengerjaan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="status" name="status" value="<?php if ($detil_wo->status == 1) {echo "Belum di Check MTC"; $warna = 'style="color:red;"';} else {echo "Sudah di Check";}?>" readonly>
                                </div>
                            </div>
                           
                        </div>

                    </div>
                    <a href="<?= base_url('ekspedisi/workorder'); ?>" class="btn btn-primary btn-sm mt-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->