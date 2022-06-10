<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
        <?= $this->session->flashdata('message') ?>
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('purchasing/tambahPermintaanJasaNew') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Tambah Permintaan Jasa</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100" id="dataTable">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Permintaan Jasa</th>
                                    <th>No. Permintaan Jasa</th>
                                    <th>User Request</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($permintaanjasa as $p) : ?>
                                    <?php if ($p['status'] == 0) ?>
                                        <?php $status = '<p class ="text-danger" ><b>Rejected</b></p>'; ?>
                                    <?php if ($p['status'] == 1) : ?>
                                        <?php $status = '<p class ="text-primary" ><b>PR Baru (Waiting Approval)</b></p>';  ?>
                                    <?php elseif ($p['status'] == 2) : ?>
                                        <?php $status = '<p class ="text-success" ><b>Approved</b></p>';  ?>
                                    <?php elseif ($p['status'] == 3) : ?>
                                        <?php $status = '<p class ="text-secondary" ><b>Sudah Buat IPO</b></p>';  ?>
                                    <?php endif;  ?>
                                    <?php if (($p['status_global'] == 0) && ($p['grandtotal'] < 1000000)): ?>
                                        <?php $status = '<p class ="text-success" ><b>Silahkan Buat PV</b></p>';  ?>
                                    <?php elseif (($p['status_global'] == 0) && ($p['grandtotal'] > 1000000)): ?>
                                        <?php $status = '<p class ="text-secondary" ><b>Belum Buat IPO</b></p>';  ?>
                                    <?php elseif ($p['status_global'] == 1) : ?>
                                        <?php $statusg = '<p class="text-primary" ><b>Sudah Buat IPO</b></p>';  ?>
                                    <?php endif;  ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $p['tgl_pr_jasa'] ?></td>
                                    <td><?= $p['no_pr_jasa'] ?></td>
                                    <td><?= $p['nama_request'] ?></td>
                                    <td>Rp. <?= number_format($p['grandtotal']) ?></td>
                                    <td><?= $status ?></td>
                                    <td>
                                        <!-- kalo baru bikin -->
                                    <?php if ($p['status'] == 1) { ?>
                                        <a href="<?= base_url('purchasing/viewpermintaanjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                        <a href="<?= base_url('purchasing/editpermintaanjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>
                                        <a href="<?= base_url('purchasing/deletepermintaanjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah akan dihapus?')"><i class="fas fa-times"></i>Batal</a>
                                    
                                        <!-- sudah approve, grandtotal > 1.000.000 dan status global = 1 -->
                                        <?php }elseif(($p['status'] == 2) &&  ($p['grandtotal'] > 1000000)){?>
                                        <a href="<?= base_url('purchasing/addipojasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-secondary  btn-sm"><i class="fa fa-book"></i> IPO</a>
                                        <a href="<?= base_url('report/printprjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                        <a href="<?= base_url('purchasing/viewpermintaanjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                        <?php }elseif ($p['status'] == 0) { ?>
                                        <a href="<?= base_url('purchasing/deletepermintaanjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah akan dihapus?')"><i class="fas fa-times"></i>Batal</a>
                                        <?php }else{ ?>
                                        <a href="<?= base_url('report/printprjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                        <a href="<?= base_url('purchasing/viewpermintaanjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                    <?php }?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->