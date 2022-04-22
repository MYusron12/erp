<div class="container-fluid">

    <!-- Page Heading -->

    <div id="layoutSidenav_content">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"><h3><?= $title; ?></h3></i>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Belum ada wo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sudah ada wo</a>
                </li>
                 </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Urut Mobil</th>
                                <th>No Polisi</th>
                                <th>KM Service</th>
                                <th>KM Terakhir</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>No Urut Mobil</th>
                                <th>No Polisi</th>
                                <th>KM Service</th>
                                <th>KM Terakhir</th>
                               
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $i = 1;

                            foreach ($truck_service as $row) :
                                ?>
                      
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $row->no_urut; ?></td>
                                    <td><?= $row->no_polisi; ?></td>
                                    <?php if ($row->km_pemakaian > 5000) { ?>
                                        <td><span class="badge rounded-pill bg-danger text-white mb-4"><?= $row->km_pemakaian; ?></span> Sudah Melebihin <span class="badge rounded-pill bg-danger text-white mb-4">5000 KM </span></td>
                                    <?php } else { ?>
                                        <td><span class="badge rounded-pill bg-danger text-white mb-4"><?= $row->km_pemakaian; ?></span> Hampir mendekati 5000 KM</td> 
                                    <?php } ?>
                                    <td><?= number_format($row->km_akumulasi, 0); ?></td>
                                    <td><a href="<?= base_url('ekspedisi/tambahwoid/') . $row->id_truck; ?>" class="btn btn-success btn-sm">Buat Wo</a></td>
                                <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Urut Mobil</th>
                                <th>No Polisi</th>
                                <th>KM Service</th>
                                <th>KM Terakhir</th>
                                <th>Keterangan</th>
                                 <th>Pengerjaan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>No Urut Mobil</th>
                                <th>No Polisi</th>
                                <th>KM Service</th>
                                <th>KM Terakhir</th>
                                <th>Keterangan</th>
                                <th>Pengerjaan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $i = 1;

                            foreach ($truck_service_wo as $row) :
                                ?>
                                <?php if ($row->no_pengerjaan == '') : ?>
                                    <?php $status = 'Belum Buat WO'; ?>

                                <?php else : ?>
                                    <?php $status = 'No Wo ' . $row->no_pengerjaan ?>

                                <?php endif; ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $row->no_urut; ?></td>
                                    <td><?= $row->no_polisi; ?></td>
                                    <?php if ($row->km_pemakaian > 5000) { ?>
                                        <td><span class="badge rounded-pill bg-danger text-white mb-4"><?= $row->km_pemakaian; ?></span> Sudah Melebihin <span class="badge rounded-pill bg-danger text-white mb-4">5000 KM </span></td>
                                    <?php } else { ?>
                                        <td><span class="badge rounded-pill bg-danger text-white mb-4"><?= $row->km_pemakaian; ?></span> Hampir mendekati 5000 KM</td> 
                                    <?php } ?>
                                    <td><?= number_format($row->km_akumulasi, 0); ?></td>
                                     <td><?= $status; ?></td>
                                    <td><?= $row->deskripsi_peminta; ?></td>
                                    <td><a href="<?= base_url('ekspedisi/ubahstatuskm/') . $row->id_permintaan_pengerjaan; ?>" class="btn btn-primary btn-sm">Sudah Service ?</a></td>
                                  
                                <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div></div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
                
        </div>
    </div>
</div>