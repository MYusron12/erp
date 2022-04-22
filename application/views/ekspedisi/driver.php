<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message') ?>
            <a href="<?= base_url('ekspedisi/tambahdriver'); ?>" class="btn btn-primary mb-3">Tambah</a>
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nik</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tgl Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No Telp</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($driver as $row) : ?>
                            <?php if ($row->status == 1) : ?>
                                <?php $status = 'Aktif'; ?>
                                <?php $warna = ''; ?>
                            <?php else : ?>
                                <?php $status = 'Tidak Aktif' ?>
                                <?php $warna = 'style="color:red;"' ?>
                            <?php endif; ?>
                            <tr <?= $warna; ?>>
                                <td><?= $i++; ?></td>
                                <td><?= $row->nik; ?></td>
                                <td><?= $row->nama; ?></td>
                                <td><?= date('d-m-Y', strtotime($row->tgl_lahir)); ?></td>
                                <td><?= $row->alamat; ?></td>
                                <td><?= $row->no_tlp; ?></td>
                                <td><?= $status; ?></td>
                                <td>
                                    <a href="<?= base_url('ekspedisi/detaildriver/') . $row->id_driver; ?>" class="btn btn-info btn-sm">Detail</a>
                                    <a href="<?= base_url('ekspedisi/editdriver/') . $row->id_driver; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="<?= base_url('ekspedisi/hapusdriver/') . $row->id_driver; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?..');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->