<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('purchasing/createorder') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Create PO</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tgl PO</th>
                                    <th scope="col">No. PO</th>
                                    <th scope="col">Suplier</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($pembelian as $row) : ?>
                                    <?php if ($row->status == 1) : ?>
                                        <?php $status = 'Sudah Order';  ?>
                                    <?php elseif ($row->status == 2) : ?>
                                        <?php $status = 'selesai';  ?>
                                    <?php endif;  ?>

                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row->tgl_po)); ?></td>
                                        <td><?= $row->no_po; ?></td>
                                        <td><?= $row->suplier; ?></td>
                                        <td><?= number_format($row->jumlah, 2, ",", "."); ?></td>
                                        <td><?= $status; ?></td>
                                        <td>
                                            <?php if ($row->status == 1) : ?>
                                                <a href="<?= base_url('purchasing/viewbeliorder/') . $row->id_pembelian; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                                <a href="<?= base_url('purchasing/batalbeliorder/') . $row->id_pembelian; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin Batal ?..')"><i class="fas fa-times"></i>Batal</a>
                                            <?php else : ?>
                                                <a href="<?= base_url('purchasing/viewbeliorder/') . $row->id_pembelian; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
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