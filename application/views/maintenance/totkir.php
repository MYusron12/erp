 <div class="container-fluid">

          <!-- Page Heading -->
        
          <div id="layoutSidenav_content">
<div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"><h3><?= $title;?></h3></i>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
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
                        foreach ($wo3 as $row) : ?>
                             <?php if ($row->status == 1) : ?>
                                <?php $status = 'Belum di Check MTC'; ?>
                                <?php $warna = 'style="color:red;"'; ?>
								 <?php elseif($row->status==3 ): ?>
                                <?php $status = 'Pengerjaan Sudah selesai' ?>
                                <?php $warna = 'style="color:green;"' ?>
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
								<?php if ($row->status == 3) : ?>
                                    <a href="<?= base_url('report/printwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-secondary btn-sm">Cetak</a>
                                    <a href="<?= base_url('ekspedisi/detailwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-info btn-sm">Detail</a>
                                   
                                <?php else : ?>
								<a href="<?= base_url('report/printwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-secondary btn-sm">Cetak</a>
                                    <a href="<?= base_url('ekspedisi/detailwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-info btn-sm">Detail</a>
                                    <a href="<?= base_url('ekspedisi/editwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="<?= base_url('ekspedisi/checkwo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-warning btn-sm">Check</a>
                                    <a href="<?= base_url('ekspedisi/hapuswo/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?..');">Hapus</a>
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