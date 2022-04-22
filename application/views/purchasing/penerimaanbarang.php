<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('purchasing/terimabarang') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Input Barang Terima</a>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover w-100" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No Transaksi Terima Barang</th>
                                    <th scope="col">Tanggal Terima</th>
                                    <th scope="col">Suplier</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($terimabarang as $row) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row->no_trans_trm_brg; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row->tgl_terima_barang)); ?></td>
                                        <td><?= $row->suplier; ?></td>
                                        <td><?= $row->keterangan; ?></td>
                                        <td><?= $row->status; ?></td>
                                        <td>
                                            <a href="" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                            <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin Batal ?..')"><i class="fas fa-times"></i>Batal</a>
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