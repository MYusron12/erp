<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message') ?>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover w-100" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">No Permintaan</th>
                                <th scope="col">Nama Request</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Grand Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($permintaan as $row) : ?>
                                <?php if ($row->status == 1) : ?>
                                    <?php $status = 'Waiting Approval';  ?>
                                <?php endif;  ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= date('d-m-Y', strtotime($row->tgl_pr_jasa)); ?></td>
                                    <td><?= $row->no_pr_jasa; ?></td>
                                    <td><?= $row->name; ?></td>
                                    <td><?= $row->nama_bagian; ?></td>
                                    <td><?= number_format($row->total_1+$row->total_2+$row->total_3, 2, ",", "."); ?></td>
                                    <td>
                                        <a href="<?= base_url('approval/viewaprovaljs/') . $row->id_permintaan_jasa; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                        <!-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-times"></i>Batal</a> -->
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
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->