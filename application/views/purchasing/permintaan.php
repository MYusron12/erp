<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('purchasing/create') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i>Create Form</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100" id="dataTable">
                            <thead class="bg-primary text-white"> 
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">No Permintaan</th>
                                    <th scope="col">Nama Request</th>
                                    <th scope="col">Bagian</th>
                                    <th scope="col">Grandtotal</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Status Dokumen</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($permintaan as $row) : ?>
                                    <?php if ($row->status == 1) : ?>
                                        <?php $status = '<p class ="text-primary" ><b>Waiting Approval</b></p>';  ?>
                                    <?php elseif ($row->status == 2) : ?>
                                        <?php $status = '<p class ="text-success" ><b>Approved</b></p>';  ?>
                                    <?php elseif ($row->status == 3) : ?>
                                        <?php $status = 'Di Order';  ?>
                                    <?php elseif ($row->status == 4) : ?>
                                        <?php $status = 'Finished';  ?>
                                    <?php else : ?>
                                        <?php $status = 'Rejected';  ?>
                                    <?php endif;  ?>
                                <?php if (($row->status_global == 0) && ($row->grandtotal < 1000000)): ?>
                                        <?php $statusg = '<p class ="text-success" ><b>Silahkan Buat PV</b></p>';  ?>
                                    <?php elseif (($row->status_global == 0) && ($row->grandtotal > 1000000)): ?>
                                        <?php $statusg = '<p class ="text-secondary" ><b>Belum Buat IPO</b></p>';  ?>
                                    <?php elseif ($row->status_global == 1) : ?>
                                        <?php $statusg = '<p class ="text-primary" ><b>Sudah Buat IPO</b></p>';  ?>
                                    <?php endif;  ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row->tanggal_minta)); ?></td>
                                        <td><?= $row->no_permintaan; ?></td>
                                        <td><?= $row->nama_request; ?></td>
                                        <td><?= $row->nama_bagian; ?></td>
                                        <td>Rp. <?= number_format($row->grandtotal); ?></td>
                                        <td><?= $status; ?></td>
                                        <td><?= $status; ?></td>
                                       <td>
                                           <?php if ($row->status == 1) { ?>
                                                <a href="<?= base_url('purchasing/view/') . $row->id_permintaan; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                                <a href="<?= base_url('purchasing/edit/') . $row->id_permintaan; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>
                                                <a href="<?= base_url('purchasing/hapuspr/') . $row->id_permintaan; ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-times"></i>Batal</a>
                                           <?php }elseif (($row->status == 2) &&  ($row->grandtotal > 1000000) && ($row->status_global == 1) ){?>
                                                 <a href="<?= base_url('report/printpr/') . $row->id_permintaan; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                                <a href="<?= base_url('purchasing/view/') . $row->id_permintaan; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                               <?php }elseif(($row->status == 2) &&  ($row->grandtotal > 1000000) && ($row->status_global == 0) ){?>
                                                 <a href="<?= base_url('purchasing/addipopr/') . $row->id_permintaan; ?>" class="btn btn-secondary  btn-sm"><i class="fa fa-book"></i> IPO</a>
                                                <a href="<?= base_url('report/printpr/') . $row->id_permintaan; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                                <a href="<?= base_url('purchasing/view/') . $row->id_permintaan; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                                  <?php }elseif(($row->status == 2) &&  ($row->grandtotal < 1000000) && ($row->status_global == 0) ){?>
                                              <!-- <a href="<?= base_url('purchasing/addipv/') . $row->id_permintaan; ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i>PV</a>-->
                                                <a href="<?= base_url('report/printpr/') . $row->id_permintaan; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                                <a href="<?= base_url('purchasing/view/') . $row->id_permintaan; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                           <?php }elseif($row->status == 2) { ?>
                                                <a href="<?= base_url('report/printpr/') . $row->id_permintaan; ?>" class="btn btn-secondary btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                                <a href="<?= base_url('purchasing/view/') . $row->id_permintaan; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                            <?php }elseif ($row->status == 0) { ?>
                                             <a href="<?= base_url('purchasing/hapuspr/') . $row->id_permintaan; ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-times"></i>Batal</a>
                                      
                                             <?php }else{ ?>
                                                <a href="<?= base_url('report/printpr/') . $row->id_permintaan; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-print"></i>Cetak</a>
                                                <a href="<?= base_url('purchasing/view/') . $row->id_permintaan; ?>" class="btn btn-success btn-sm"><i class="far fa-eye"></i>View</a>
                                               <!-- <a href="<?= base_url('purchasing/addipv/') . $row->id_permintaan; ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i>PV</a>-->
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