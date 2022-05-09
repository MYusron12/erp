<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('purchasing/createpermintaanjasa') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Create PJ</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100" id="dataTable">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tgl PJ</th>
                                    <th scope="col">No. PJ</th>
                                    <th scope="col">Request</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($jasa as $row) : ?>
                                    <?php if ($row->status == 0) ?>
                                        <?php $status = '<p class ="text-danger" ><b>Rejected</b></p>'; ?>
                                    <?php if ($row->status == 1) : ?>
                                        <?php $status = '<p class ="text-primary" ><b>PR Baru (Waiting Approval)</b></p>';  ?>
                                    <?php elseif ($row->status == 2) : ?>
                                        <?php $status = '<p class ="text-success" ><b>Approved</b></p>';  ?>
                                    <?php elseif ($row->status == 3) : ?>
                                        <?php $status = '<p class ="text-secondary" ><b>Sudah Buat IPO</b></p>';  ?>
                                    <?php endif;  ?>

                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row->tgl_pr_jasa)); ?></td>
                                        <td><?= $row->no_pr_jasa; ?></td>
                                        <td><?= $row->name; ?></td>
                                        <td> Rp. <?= number_format(($row->total_1) + ($row->total_2) + ($row->total_3)); ?></td>
                                        <td><?= $status; ?></td>
                                        <td>
                                            <?php if ($row->status == 2) : ?>
                                                <a href="<?= base_url('report/cetakbelijasa/') . $row->id_permintaan_jasa; ?>" class="btn btn-secondary btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                            <?php endif ?>
                                            <a href="<?= base_url('purchasing/viewbelijasa/') . $row->id_permintaan_jasa; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                            <?php
                                            if ($row->status < 2) : ?>
                                                <a href="<?= base_url('purchasing/updatebelijasa/') . $row->id_permintaan_jasa; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>

                                                <a href="<?= base_url('purchasing/batalbelijasa/') . $row->id_permintaan_jasa; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin Batal ?..')"><i class="fas fa-times"></i>Batal</a>
                                            <?php endif; ?>
                                            <?php

                                            $t1 = $row->total_1;
                                            $t2 = $row->total_2;
                                            $t3 = $row->total_3;
                                            $gt = $t1 + $t2 + $t3;

                                            if (($gt > 1000000) && $row->status == 2) : ?>
                                                <a href="<?= base_url('purchasing/addipo/') . $row->id_permintaan_jasa; ?>" class="btn btn-secondary btn-sm"><i class="far fa-eye"></i>IPO</a>
                                            <?php endif; ?>
                                            <?php if ($row->status_global == 2) : ?>
                                                <a href="<?= base_url('report/cetakbelijasa/') . $row->id_permintaan_jasa; ?>" class="btn btn-secondary btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                                <!-- <a href="<?= base_url('purchasing/addpv/') . $row->id_permintaan_jasa; ?>" class="btn btn-warning btn-sm"><i class="far fa-eye"></i>pv</a> -->
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