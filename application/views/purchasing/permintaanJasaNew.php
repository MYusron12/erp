<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('purchasing/tambahPermintaanJasaNew') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Tambah Permintaan Jasa</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100" id="dataTable">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tgl Permintaan Jas</th>
                                    <th scope="col">No. Permintaan Jasa</th>
                                    <th scope="col">User Request</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($permintaanjasa as $p) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $p['tgl_pr_jasa'] ?></td>
                                    <td><?= $p['no_pr_jasa'] ?></td>
                                    <td><?= $p['bagian_id'] ?></td>
                                    <td><?= $p['grandtotal'] ?></td>
                                    <td><?= $p['status'] ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>" class="badge badge-success">edit</a>
                                        <a href="<?= base_url() ?>" class="badge badge-danger">hapus</a>
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