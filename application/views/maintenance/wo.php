<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message') ?>
            <a href="<?= base_url('maintenance/tambahwo'); ?>" class="btn btn-primary mb-3">Tambah</a>
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Pengerjaan</th>
                            <th scope="col">No Polisi</th>
                            <th scope="col">Tgl Pemohon</th>
                             <th scope="col">Categori WO</th>
                             <th scope="col">Jenis Pengerjaan</th>
                              <th scope="col">Status</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($wo as $row) : ?>
                            <?php if ($row->status == 1) : ?>
                                <?php $status = 'Belum di Check MTC'; ?>
                                <?php $warna = 'style="color:red;"'; ?>
                            <?php else : ?>
                                <?php $status = 'Sudah di Check' ?>
                                <?php $warna = 'style="color:green;"' ?>
                            <?php endif; ?>
                            <tr <?= $warna; ?>>
                                <td><?= $i++; ?></td>
                                <td><?= $row->no_pengerjaan; ?></td>
                                <td><?= $row->no_polisi; ?></td>
                                <td><?= date('d-m-Y', strtotime($row->tgl_order)); ?></td>
                                <td><?= $row->deskripsi_peminta; ?></td>
                                <td><?= $status; ?></td>
                                <td>
                                    <a href="<?= base_url('report/printwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-secondary btn-sm">Cetak</a>
                                    <a href="<?= base_url('maintenance/detailwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-info btn-sm">Detail</a>
                                    <a href="<?= base_url('maintenance/editwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="<?= base_url('maintenance/checkwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-warning btn-sm">Check</a>
                                    <a href="<?= base_url('maintenance/hapuswo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?..');">Hapus</a>
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