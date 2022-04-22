<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><?= $title; ?></h1>
                <div class="md-4 card-body"><?= $this->session->flashdata('message'); ?></div>
                <div class="row">
                                <div class="col-lg-6">
                                    <li class="list-group-item">
                                        <h3 class="text-center">Cara Kirim Email</h3>
                                    </li>
                                    <li class="list-group-item">1. Klik Reset Email di <b>apps.local:8081/</b> kemudian kembali lagi ke <b>erp.local/</b></li>
                                    <li class="list-group-item">2. Klik Hapus Email Sebelumnya</li>
                                    <li class="list-group-item">3. Klik upload AR</li>
                                    <li class="list-group-item">4. Klik Pilih File, Kemudian Klik Proses</li>
                                </div>
                            </div>
                <div class="row">
                    <div class="col-md-4">
                        <a href="<?= base_url('finance/uploadAR'); ?>" class="btn btn-primary">Upload AR
                            <i class="fas fa-upload"></i>
                        </a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h4 class="card-title"><i class="far fa-paper-plane"></i> Kirim Email </h4>
                                <a class="small text-white stretched-link"
                                    href="<?= base_url('finance/emailcust'); ?>"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h4 class="card-title"><i class="fas fa-cheese"></i> Reset Email </h4>
                                <a class="small text-white stretched-link"
                                    href="<?= base_url('finance/resetflag'); ?>"></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <?php foreach ($blm as $row) : ?>
                                <h3><i class="fas fa-check-circle"></i> Invoice yang belum dikirim <span
                                        class="badge badge-secondary"><?= $row->no; ?></span></h3>
                                <?php endforeach; ?>
                                <a class="small text-white stretched-link" href=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <?php foreach ($sdh as $row) : ?>
                                <h3><i class="fas fa-check-circle"></i> Invoice yang sudah terkirim <span
                                        class="badge badge-secondary"><?= $row->no; ?></span></h3>
                                <?php endforeach; ?>
                                <a class="small text-white stretched-link" href="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="btn btn-primary btn-lg btn-block"
                                    onclick="return confirm('apakah akan di reset?')"
                                    href="<?= base_url('finance/resetflag'); ?>">Hapus Invoice Sebelumnya - <i
                                        class="fas fa-trash-alt"></i></a>
                                <div class="small text-white"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>






    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->