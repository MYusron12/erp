<!-- Begin Page Content -->
<div class="container-fluid">

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
                                    <th scope="col">No</th>
                                    <th scope="col">Tgl Permintaan Jasa</th>
                                    <th scope="col">No. Permintaan Jasa</th>
                                    <th scope="col">User Request</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
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
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $p['tgl_pr_jasa'] ?></td>
                                    <td><?= $p['no_pr_jasa'] ?></td>
                                    <td><?= $p['nama_request'] ?></td>
                                    <td>Rp. <?= number_format($p['grandtotal']) ?></td>
                                    <td><?= $status ?></td>
                                    <td>
                                    <?php if ($p['status'] == 2) : ?>
                                                <a href="<?= base_url('report/cetakpermintaanjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-secondary btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                            <?php endif ?>
                                            <a href="<?= base_url('purchasing/viewpermintaanjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                            <?php
                                            if ($p['status'] < 2) : ?>
                                                <a href="<?= base_url('purchasing/editpermintaanjasanew/') . $p['id_permintaan_jasa']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>

                                                <a href="<?= base_url('purchasing/deletepermintaanjasa/') . $p['id_permintaan_jasa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin Batal ?..')"><i class="fas fa-times"></i>Batal</a>
                                            <?php endif; ?>
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