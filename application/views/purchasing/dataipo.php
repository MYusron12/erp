<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100" id="dataTable">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tgl IPO</th>
                                    <th scope="col">No. IPO</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($ipo as $row) : ?>
                                <?php if ($row->status == 1) : ?>
                                <?php $status = 'Sudah Order';  ?>
                                <?php elseif ($row->status == 2) : ?>
                                <?php $status = 'selesai';  ?>
                                <?php endif;  ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= date('d-m-Y', strtotime($row->tgl_ipo)); ?></td>
                                    <td><?= $row->no_ipo; ?></td>
                                    <td><?= $row->nama_supplier; ?></td>
                                    <td><?= $row->nama_department; ?></td>
                                    <td><?= $row->remarks; ?></td>
                                    <td>Rp. <?= number_format($row->grandtotal); ?></td>
                                    <td>
                                        <a href="<?= base_url('report/cetakipo/') . $row->id_ipo; ?>"
                                            class="btn btn-secondary btn-sm" target="_blank"><i
                                                class="fa fa-print"></i>Cetak</a>
                                        <a href="<?= base_url('purchasing/viewipo/') . $row->id_ipo; ?>"
                                            class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                        <a href="<?= base_url('purchasing/editipo/') . $row->id_ipo; ?>"
                                            class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>
                                        <a href="<?= base_url('purchasing/batalipo/') . $row->id_ipo; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Anda yakin Batal ?..')"><i
                                                class="fas fa-times"></i>Batal</a>
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