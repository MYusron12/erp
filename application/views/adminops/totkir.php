 <div class="container-fluid">

          <!-- Page Heading -->
        
          <div id="layoutSidenav_content">
<div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"><h3><?= $title;?></h3></i>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Urut Mobil</th>
                                                 <th>No Polisi</th>
                                                 <th>Hari</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>No Urut Mobil</th>
                                                <th>No Polisi</th>
                                                <th>KM Service</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php  
                                            $i = 1;
                                            
                                           foreach ($truck_kir as $row) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row->no_urut; ?></td>
                                                <td><?= $row->no_polisi; ?></td>
                                              <?php if ($row->byr_kir < 1){ ?>
                                                <td><span class="badge rounded-pill bg-danger text-white mb-4"><?= $row->byr_kir;?></span> Sudah Melebihi <span class="badge rounded-pill bg-danger text-white mb-4">Tgl LIR </span></td>
                                                <?php }else{ ?>
                                                   <td><span class="badge rounded-pill bg-danger text-white mb-4"><?= $row->byr_kir;?></span> Hampir mendekati Jatuh Tempo</td> 
                                                <?php }?>
                                                   <td><a href="<?= base_url('ekspedisi/ubahstatuskir/'). $row->id_truck; ?>" class="btn btn-primary btn-sm">Sudah Bayar ?</a></td>
                                                
                                              <?php endforeach; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
          </div>
 </div>